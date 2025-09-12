<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class ViewServiceProvider extends ServiceProvider
{
    public function register()
    {
        //
    }

    public function boot()
    {
        // Load admin menus from DB
        $adminMenu = Menu::where('type', 'admin')
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->with('children')
            ->get();

        View::composer('layouts.admin', function ($view) use ($adminMenu) {
            $view->with('adminMenu', $adminMenu);
        });

        // Load frontend menus from DB
        $frontendMenu = Menu::where('type', 'frontend')
            ->where('is_active', true)
            ->whereNull('parent_id')
            ->orderBy('order')
            ->with('children')
            ->get();

        // Load services cho booking popup và footer
        $services = Cache::remember('frontend_services', now()->addHours(24), function () {
            return Service::where('is_active', true)
                ->orderBy('sort_order')
                ->take(8) // Giới hạn 8 dịch vụ cho footer
                ->get();
        });

        View::composer('layouts.app', function ($view) use ($frontendMenu, $services) {
            $view->with('frontendMenu', $frontendMenu);
            $view->with('services', $services);
        });
    }
}
