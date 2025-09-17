<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use App\Models\Service;
use App\Models\Category;
use App\Models\Certificate;
use App\Models\SiteInfo;
use App\Models\Information;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // ADMIN MENU
        $adminMenu = Menu::where('type', 'admin')
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->with('children')
            ->get();

        View::composer('layouts.admin', function ($view) use ($adminMenu) {
            $view->with('adminMenu', $adminMenu);
        });

        // FRONTEND MENU
        $frontendMenu = Menu::where('type', 'frontend')
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->with('children')
            ->get();

        // SERVICES (only parent)
        $parentServices = Service::where('is_active', true)
            ->whereNull('parent_id')
            ->with(['children', 'category'])
            ->orderBy('sort_order')
            ->get();

        // CATEGORIES
        $categories = Category::whereIn('type', ['services', 'news'])
            ->where('is_active', true)
            ->orderBy('order')
            ->with('children')
            ->get();

        // SITE INFO
        $siteInfo = SiteInfo::first();

        // INFORMATION
        $information = Information::first();

        // SHARE TO SPECIFIC VIEWS (include home & services pages, excluding certificates from unnecessary views)
        View::composer(
            ['layouts.app', 'm-menu', 'bang-gia', 'pricing', 'home', 'services.index', 'services.show'],
            function ($view) use ($frontendMenu, $parentServices, $categories, $siteInfo, $information) {
                $view->with('frontendMenu', $frontendMenu)
                     ->with('services', $parentServices)
                     ->with('categories', $categories)
                     ->with('siteInfo', $siteInfo)
                     ->with('information', $information);

            }
        );

        // SHARE CERTIFICATES ONLY TO CERTIFICATE-RELATED VIEWS


        View::composer('layouts.service-list', function ($view) use ($parentServices) {
            if (! $view->offsetExists('services')) {
                $view->with('services', $parentServices);
            }
        });
    }
}
