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
        $news = $query->paginate(10);
        $newsList = $query->orderBy('published_at', 'desc')->paginate(12);

        $newsBanner = \App\Models\PageContent::where('page', 'news_banner')->first();
        

        return view('news.index', compact('newsCategories', 'newsList', 'newsBanner','news'));
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

        // Use the model's getRelatedNews() method for consistent behavior
        $relatedNews = $news->getRelatedNews();

        $newsBanner = \App\Models\PageContent::where('page', 'news_banner')->first();
        return view('news.detail', compact('news', 'relatedNews', 'newsBanner'));
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

        $newsBanner = \App\Models\PageContent::where('page', 'news_banner')->first();

        return view('news.index', compact('newsCategories', 'newsList', 'newsBanner', 'category'));
    }
}
