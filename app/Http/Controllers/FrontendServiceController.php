<?php

namespace App\Http\Controllers;

use App\Models\About;
use App\Models\Service;
use App\Models\Category;
use App\Models\Process;
use App\Models\Advertisement;
use Illuminate\Http\Request;

class FrontendServiceController extends Controller
{
    public function index()
    {
        $services = Service::where('is_active', true)
            ->whereNull('parent_id')
            ->with(['children', 'category'])
            ->orderBy('sort_order')
            ->get();

        \Log::info('Services in index:', $services->map(function($s) {
            return ['id' => $s->id, 'name' => $s->name, 'slug' => $s->slug, 'is_active' => $s->is_active, 'parent_id' => $s->parent_id];
        })->toArray());

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
       $service = Service::where('slug', $slug)
        ->where('is_active', true)
        ->with(['children', 'category'])
        ->first();

       \Log::info('Service show request:', ['slug' => $slug, 'service_found' => $service ? ['id' => $service->id, 'name' => $service->name, 'is_active' => $service->is_active, 'parent_id' => $service->parent_id] : null]);

    $serviceBanner = \App\Models\PageContent::where('page', 'services_banner')->first();

    $bannersSection1 = \App\Models\Banner::where('section', '1')
        ->where('page', 'services')
        ->where('is_active', true)
        ->orderBy('order')
        ->get();

    if ($service) {
        // Lấy processes theo service_id
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

        // Debug chi tiết hơn
        [
            'service_id' => $service->id,
            'service_slug' => $service->slug,
            'service_name' => $service->name,
            'li_do_count' => $processesLiDo->count(),
            'quy_trinh_count' => $processesQuyTrinh->count(),
            'li_do_orders' => $processesLiDo->pluck('order')->toArray(),
            'li_do_data' => $processesLiDo->map(function($item) {
                return [
                    'id' => $item->id,
                    'title' => $item->title,
                    'order' => $item->order,
                    'description' => $item->description ? substr($item->description, 0, 50) . '...' : 'NULL',
                    'images_count' => $item->processImages->count()
                ];
            })->toArray()
        ];

        return view('layouts.services.show', compact(
            'service',
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
            ->with(['children', 'services' => function ($query) {
                $query->where('is_active', true)->with('children');
            }])
            ->first();



        if (!$category) {
            abort(404);
        }

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
            'category',
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
        return view('abouts', compact('abouts', 'pageContent', 'bannersSection1', 'bannersSection2'));
    }
}
