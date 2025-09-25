<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\AboutUs;
use App\Models\Service;
use App\Models\Category;
use App\Models\Process;
use App\Models\Advertisement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontendServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->whereNull('parent_id')
            ->with(['children', 'category'])
            ->orderBy('sort_order')
            ->get();

        $servicesBanner = \App\Models\PageContent::where('page', 'services_banner')->first();

        $bannersSection1 = \App\Models\Banner::where('section', '1')
            ->where('page', 'services')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        return view('layouts.services.index', compact('services', 'servicesBanner', 'bannersSection1'));
    }

    public function show($slug)
    {
        // DEBUG: Log để kiểm tra slug
        Log::info('Service show method called with slug: ' . $slug);

        // Tìm service trước
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->with(['children' => function($query) {
                $query->where('is_active', true);
            }, 'category'])
            ->first();

        // DEBUG: Log service data
        if ($service) {
            Log::info('Service found:', [
                'id' => $service->id,
                'name' => $service->name,
                'description' => $service->description ? 'YES' : 'NULL',
                'content' => $service->content ? 'YES' : 'NULL',
                'price_range' => $service->price_range ?? 'NULL',
                'duration' => $service->duration ?? 'NULL',
                'children_count' => $service->children->count()
            ]);
        } else {
            Log::info('Service NOT found for slug: ' . $slug);
        }

        // Các biến chung
        $serviceBanner = \App\Models\PageContent::where('page', 'services_banner')->first();
        $bannersSection1 = \App\Models\Banner::where('section', '1')
            ->where('page', 'services')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        if ($service) {
            // Xử lý cho SERVICE
            $processesQuyTrinh = Process::with('processImages')
                ->where('section', 'quy_trình')
                ->where('service_id', $service->id)
                ->orderBy('order')
                ->get();

            $processesLiDo = Process::with('processImages')
                ->where('section', 'lí_do')
                ->where('service_id', $service->id)
                ->orderBy('order')
                ->get();

            $advertisements = Advertisement::where('service_id', $service->id)
                ->where('is_active', true)
                ->orderBy('order')
                ->get();

            $pageTitle = $service->title ?? $service->name;

            return view('layouts.services.show', compact(
                'service', // Quan trọng: truyền service
                'serviceBanner',
                'processesQuyTrinh',
                'processesLiDo',
                'advertisements',
                'pageTitle',
                'bannersSection1'
            ));
        }

        // Nếu không tìm thấy service, tìm category
        $category = Category::where('slug', $slug)
            ->where('type', 'services')
            ->where('is_active', true)
            ->with(['services' => function ($query) {
                $query->where('is_active', true)->with(['children' => function($childQuery) {
                    $childQuery->where('is_active', true);
                }]);
            }])
            ->first();

        if (!$category) {
            Log::error('Neither service nor category found for slug: ' . $slug);
            abort(404, 'Dịch vụ hoặc danh mục không tồn tại.');
        }

        Log::info('Category found:', ['name' => $category->name, 'services_count' => $category->services->count()]);

        // Lấy processes theo service_ids của category
        $serviceIds = $category->services->pluck('id');
        $processesQuyTrinh = Process::with('processImages')
            ->where('section', 'quy_trình')
            ->whereIn('service_id', $serviceIds)
            ->orderBy('order')
            ->get();

        $processesLiDo = Process::with('processImages')
            ->where('section', 'lí_do')
            ->whereIn('service_id', $serviceIds)
            ->orderBy('order')
            ->get();

        $advertisements = Advertisement::whereIn('service_id', $serviceIds)
            ->where('is_active', true)
            ->orderBy('order')
            ->get();

        $pageTitle = $category->title ?? $category->name;

        return view('layouts.services.show', compact(
            'category', // Quan trọng: truyền category
            'serviceBanner',
            'processesQuyTrinh',
            'processesLiDo',
            'advertisements',
            'pageTitle',
            'bannersSection1'
        ));
    }

    public function about()
    {
        $abouts = About::all();
        $aboutUs1 = AboutUs::with('icons')->where('section', 'Phần 1')->first();
        $aboutUs2 = AboutUs::with('icons')->where('section', 'Phần 2')->first();
        $pageContent = \App\Models\PageContent::where('page', 'about_banner')->first();
        $bannersSection1 = \App\Models\Banner::where('section', '1')
            ->where('page', 'about')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
        $bannersSection2 = \App\Models\Banner::where('section', '2')
            ->where('page', 'about')
            ->where('is_active', true)
            ->orderBy('order')
            ->get();
        return view('abouts', compact('abouts', 'aboutUs1', 'aboutUs2', 'pageContent', 'bannersSection1', 'bannersSection2'));
    }
}
