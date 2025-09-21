<?php

namespace App\Http\Controllers;

use App\Models\Service;
use App\Models\Category;
use App\Models\Process;
use App\Models\Advertisement;
use App\Models\PageContent;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FrontendServiceController extends Controller
{
    public function show($slug)
    {
        Log::info('Service show method called with slug: ' . $slug);

        // Tìm service trước
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->with(['children' => function($query) {
                $query->where('is_active', true)->orderBy('sort_order');
            }, 'category'])
            ->first();

        // Các biến chung
        $serviceBanner = PageContent::where('page', 'services_banner')->first();
        $bannersSection1 = Banner::where('section', '1')
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
            ->with(['services' => function ($query) {
                $query->where('is_active', true)
                      ->whereNull('parent_id')
                      ->with(['children' => function($childQuery) {
                          $childQuery->where('is_active', true)->orderBy('sort_order');
                      }]);
            }])
            ->first();

        if (!$category) {
            Log::error('Neither service nor category found for slug: ' . $slug);
            abort(404, 'Dịch vụ hoặc danh mục không tồn tại.');
        }

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
}
