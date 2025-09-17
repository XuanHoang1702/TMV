<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

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
            'meta_description' => 'nullable|string|max:500'
        ]);

        // Handle multiple images
        if ($request->hasFile('images')) {
            $imagePaths = [];
            foreach ($request->file('images') as $file) {
                $imagePaths[] = $file->store('news', 'public');
            }
            $validated['images'] = $imagePaths;
        }

        if ($request->has('published_at')) {
            $validated['published_at'] = \Carbon\Carbon::createFromFormat('Y-m-d\TH:i', $request->published_at)->toDateTimeString();
        }
        // Auto-generate slug if empty
        if (empty($validated['slug'])) {
            $validated['slug'] = Str::slug($validated['title']);
        }

        News::create($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Tin tức đã được tạo thành công');
    }

    public function edit(News $news)
    {
        $categories = \App\Models\Category::ofType('news')->active()->get();
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
            'meta_description' => 'nullable|string|max:500'
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

    $relatedNews = News::where('category_id', $news->category_id)
        ->where('id', '!=', $news->id)
        ->whereNotNull('published_at')
        ->orderBy('published_at', 'desc')
        ->take(4)
        ->get();

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

}
