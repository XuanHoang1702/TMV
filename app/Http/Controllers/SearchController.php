<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Service;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function index()
    {
        return view('search.index');
    }

    public function search(Request $request)
    {
        $keyword = $request->input('keyword', '');
        $results = collect(); // Initialize as collection instead of array

        // Nếu có keyword, tìm kiếm trong 2 bảng
        if (!empty($keyword)) {
            // Tìm kiếm trong bảng News
            $newsResults = News::where('is_active', true)
                ->whereNotNull('published_at')
                ->where(function ($query) use ($keyword) {
                    $query->where('title', 'LIKE', "%{$keyword}%")
                          ->orWhere('content', 'LIKE', "%{$keyword}%")
                          ->orWhere('summary', 'LIKE', "%{$keyword}%");
                })
                ->orderBy('published_at', 'desc')
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'news',
                        'title' => $item->title,
                        'content' => $item->summary ?? substr(strip_tags($item->content), 0, 150) . '...',
                        'url' => route('news.detail', [$item->category->slug, $item->slug]),
                        'date' => $item->published_at,
                        'image' => $item->images ? $item->images[0] : null
                    ];
                });

            // Tìm kiếm trong bảng Services (bao gồm price_range)
            $serviceResults = Service::where('is_active', true)
                ->where(function ($query) use ($keyword) {
                    $query->where('name', 'LIKE', "%{$keyword}%")
                          ->orWhere('description', 'LIKE', "%{$keyword}%")
                          ->orWhere('content', 'LIKE', "%{$keyword}%")
                          ->orWhere('price_range', 'LIKE', "%{$keyword}%");
                })
                ->orderBy('sort_order')
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'service',
                        'title' => $item->name,
                        'content' => $item->description ?? substr(strip_tags($item->content), 0, 150) . '...',
                        'url' => route('services.detail', $item->slug),
                        'date' => $item->updated_at,
                        'image' => $item->image
                    ];
                });

            // Tìm kiếm báo giá từ price_range trong Services
            $pricingResults = Service::where('is_active', true)
                ->whereNotNull('price_range')
                ->where('price_range', 'LIKE', "%{$keyword}%")
                ->orderBy('sort_order')
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'pricing',
                        'title' => $item->name,
                        'content' => $item->price_range,
                        'url' => route('services.detail', $item->slug),
                        'date' => $item->updated_at,
                        'image' => $item->image
                    ];
                });

            $results = $newsResults->concat($serviceResults)->concat($pricingResults);
        }

        // Nếu không có keyword hoặc không có kết quả tìm kiếm, lấy dữ liệu mới nhất từ 2 bảng
        if (empty($keyword) || $results->isEmpty()) {
            $newsLatest = News::where('is_active', true)
                ->whereNotNull('published_at')
                ->orderBy('published_at', 'desc')
                ->take(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'news',
                        'title' => $item->title,
                        'content' => $item->summary ?? substr(strip_tags($item->content), 0, 150) . '...',
                        'url' => route('news.detail', [$item->category->slug, $item->slug]),
                        'date' => $item->published_at,
                        'image' => $item->images ? $item->images[0] : null
                    ];
                });

            $serviceLatest = Service::where('is_active', true)
                ->orderBy('sort_order')
                ->take(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'service',
                        'title' => $item->name,
                        'content' => $item->description ?? substr(strip_tags($item->content), 0, 150) . '...',
                        'url' => route('services.detail', $item->slug),
                        'date' => $item->updated_at,
                        'image' => $item->image
                    ];
                });

            // Lấy báo giá từ price_range cho phần hiển thị mới nhất
            $pricingLatest = Service::where('is_active', true)
                ->whereNotNull('price_range')
                ->orderBy('sort_order')
                ->take(5)
                ->get()
                ->map(function ($item) {
                    return [
                        'type' => 'pricing',
                        'title' => $item->name,
                        'content' => $item->price_range,
                        'url' => route('services.detail', $item->slug),
                        'date' => $item->updated_at,
                        'image' => $item->image
                    ];
                });

            $results = $newsLatest->concat($serviceLatest)->concat($pricingLatest);
        }

        return view('search.results', compact('results', 'keyword'));
    }
}
