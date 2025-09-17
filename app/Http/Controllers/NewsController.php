<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $newsCategories = Category::where('type', 'news')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $query = News::whereNotNull('published_at')
            ->where('is_active', true)
            ->with('category');

        if ($request->category) {
            $query->where('category_id', $request->category);
        }

        $newsList = $query->orderBy('published_at', 'desc')->paginate(12);

        $newsBanner = \App\Models\Banner::where('section', '1')
            ->where('page', 'news')
            ->where('is_active', true)
            ->orderBy('order')
            ->first();

        return view('news.index', compact('newsCategories', 'newsList', 'newsBanner'));
    }

    public function category($categorySlug)
    {
        $category = Category::where('slug', $categorySlug)
            ->where('type', 'news')
            ->where('is_active', true)
            ->firstOrFail();

        $newsCategories = Category::where('type', 'news')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $newsList = News::where('category_id', $category->id)
            ->whereNotNull('published_at')
            ->where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->paginate(12);

        $newsBanner = \App\Models\Banner::where('section', '1')
            ->where('page', 'news')
            ->where('is_active', true)
            ->orderBy('order')
            ->first();

        return view('news.category', compact('category', 'newsCategories', 'newsList', 'newsBanner'));
    }

    public function show($categorySlug, $newsSlug)
    {
        $news = News::where('slug', $newsSlug)
            ->whereHas('category', function ($query) use ($categorySlug) {
                $query->where('slug', $categorySlug);
            })
            ->whereNotNull('published_at')
            ->where('is_active', true)
            ->firstOrFail();

        $relatedNews = News::where('category_id', $news->category_id)
            ->where('id', '!=', $news->id)
            ->whereNotNull('published_at')
            ->where('is_active', true)
            ->orderBy('published_at', 'desc')
            ->take(4)
            ->get();

        return view('news.show_detail', compact('news', 'relatedNews'));
    }
}
