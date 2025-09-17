<?php

namespace App\Http\Controllers;
use App\Models\About;
use App\Models\Service;
use App\Models\Category;

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

    return view('layouts.services.index', compact('services', 'servicesBanner'));
}

    public function show($slug)
    {
        // Try to find a service first
        $service = Service::where('slug', $slug)
            ->where('is_active', true)
            ->with(['children', 'category'])
            ->first();

        $serviceBanner = \App\Models\PageContent::where('page', 'services_banner')->first();

        // If no service, try to find a category
        if (!$service) {
            $category = Category::where('slug', $slug)
                ->where('type', 'services')
                ->where('is_active', true)
                ->with(['children', 'services' => function ($query) {
                    $query->where('is_active', true)->with('children');
                }])
                ->firstOrFail();

            return view('layouts.services.show', compact('category', 'serviceBanner'));
        }

        return view('layouts.services.show', compact('service', 'serviceBanner'));
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

