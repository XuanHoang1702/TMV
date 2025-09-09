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
            $query->where('category', $request->category);
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
        return view('admin.news.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:news',
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|in:chuyen-mon,dao-tao,tu-thien,bao-chi',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500'
        ]);

        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('news', 'public');
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
        return view('admin.news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|unique:news,slug,' . $news->id,
            'summary' => 'required|string|max:500',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'category' => 'required|in:chuyen-mon,dao-tao,tu-thien,bao-chi',
            'is_featured' => 'boolean',
            'published_at' => 'nullable|date',
            'is_active' => 'boolean',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string|max:500'
        ]);

        if ($request->hasFile('image')) {
            if ($news->image) {
                Storage::disk('public')->delete($news->image);
            }
            $validated['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($validated);

        return redirect()->route('admin.news.index')
            ->with('success', 'Tin tức đã được cập nhật thành công');
    }

    public function destroy(News $news)
    {
        if ($news->image) {
            Storage::disk('public')->delete($news->image);
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
}
