<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\EmailNotification;
use App\Mail\MailNotification;
use Illuminate\Support\Facades\Mail;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = News::query();

        // Filter by category
        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        // Filter by status
        if ($request->status) {
            if ($request->status === 'published') {
                $query->whereNotNull('published_at');
            } elseif ($request->status === 'draft') {
                $query->whereNull('published_at');
            }
        }

        $news = $query->orderBy('created_at', 'desc')->paginate(15);

        return view('admin.news.index', compact('news'));
    }

    public function create()
    {
        $categories = \App\Models\Category::ofType('news')->active()->get();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:news',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'related_news' => 'nullable|array',
            'related_news.*' => 'exists:news,id'
        ]);

        // Handle multiple images
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $file) {
                $imagePaths[] = $file->store('news', 'public');
            }
            $validated['images'] = $imagePaths;
        }

        // Handle meta fields - ensure they're not null
        if (empty($validated['meta_title'])) {
            $validated['meta_title'] = $validated['title']; // Use title as default meta title
        }
        if (empty($validated['meta_description'])) {
            $validated['meta_description'] = Str::limit(strip_tags($validated['summary'] ?: $validated['content']), 160);
        }

        // Handle related news
        if ($request->has('related_news')) {
            $validated['related_news'] = array_filter($request->related_news); // Remove empty values
        } else {
            $validated['related_news'] = [];
        }

        if ($request->has('published_at')) {
            $validated['published_at'] = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $request->published_at)->toDateTimeString();
        }
        // Auto-generate slug if empty
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        News::create($validated);
        $users = EmailNotification::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(
                new MailNotification(
                    $user,
                    'Tin tức mới: ' . $request->title,
                    'Chúng tôi vừa có một tin tức mới dành cho bạn.',
                    url('/news')
                )
            );
        }
        return redirect()->route('admin.news.index')
            ->with('success', 'Tin tức đã được tạo thành công');
    }

   public function edit(News $news)
{
    // Đảm bảo related_news là array
    if (is_string($news->related_news)) {
        $news->setAttribute('related_news', json_decode($news->related_news, true) ?? []);
    } elseif (!is_array($news->related_news)) {
        $news->setAttribute('related_news', []);
    }

    // Load categories
    $categories = \App\Models\Category::all(); // hoặc query phù hợp

    return view('admin.news.edit', compact('news', 'categories'));
}

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:news,slug,' . $news->id,
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'images' => 'nullable|array',
            'images.*' => 'image|mimes:jpeg,png,jpg|max:2048',
            'removed_images' => 'nullable|array',
            'category_id' => 'required|exists:categories,id',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500',
            'related_news' => 'nullable|array',
            'related_news.*' => 'exists:news,id'
        ]);

        // Remove selected images
        $currentImages = $news->images ?? [];
        if ($request->filled('removed_images')) {
            foreach ($request->removed_images as $removedImage) {
                if (Storage::disk('public')->exists($removedImage)) {
                    Storage::disk('public')->delete($removedImage);
                }
                $currentImages = array_filter($currentImages, fn($img) => $img !== $removedImage);
            }
        }

        // Append new uploaded images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $currentImages[] = $file->store('news', 'public');
            }
        }

        $validated['images'] = array_values($currentImages); // Reindex

        // Handle related news
        if ($request->has('related_news')) {
            $validated['related_news'] = array_filter($request->related_news); // Remove empty values
        } else {
            $validated['related_news'] = [];
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')->with('success', 'Tin tức đã được cập nhật thành công');
    }

    public function destroy(News $news)
    {
        // Delete multiple images
        if ($news->images) {
            foreach ($news->images as $imagePath) {
                Storage::disk('public')->delete($imagePath);
            }
        }

        $news->delete();

        return redirect()->route('admin.news.index')
            ->with('success', 'Tin tức đã được xóa thành công');
    }

    public function publish(News $news)
    {
        $news->update([
            'published_at' => now(),
            'is_active' => true
        ]);

        return back()->with('success', 'Tin tức đã được xuất bản');
    }

    public function unpublish(News $news)
    {
        $news->update(['published_at' => null]);

        return back()->with('success', 'Tin tức đã được gỡ xuất bản');
    }

    public function show(News $news)
    {
        $relatedNews = $news->getRelatedNews();

        return view('admin.news.show', compact('news', 'relatedNews'));
    }

    public function removeImage(News $news, Request $request)
    {
        $imagePath = $request->image;

        if ($imagePath && in_array($imagePath, $news->images)) {
            // Xóa file khỏi storage
            if (\Storage::disk('public')->exists($imagePath)) {
                \Storage::disk('public')->delete($imagePath);
            }

            // Cập nhật lại mảng images
            $updatedImages = array_values(array_filter($news->images, fn($img) => $img !== $imagePath));
            $news->update(['images' => $updatedImages]);

            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false], 400);
    }

    public function uploadImage(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $imagePath = $image->storeAs('news/content', $imageName, 'public');

        return response()->json([
            'success' => true,
            'url' => asset('storage/' . $imagePath)
        ]);
    }
}
