<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;
use App\Models\Service;
use App\Models\Category;
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

        // Load services cho booking popup, footer, và bang-gia/pricing
        $services = Service::where('is_active', true)
            ->whereNull('parent_id') // Chỉ lấy dịch vụ cha
            ->with(['children', 'category']) // Tải quan hệ con và danh mục
            ->orderBy('sort_order')
            ->get();

        // Load categories cho menu Dịch vụ và Tin tức
        $categories = Category::whereIn('type', ['services', 'news'])
            ->where('is_active', true)
            ->orderBy('order')
            ->with('children')
            ->get();

        View::composer(['layouts.app', 'm-menu', 'bang-gia', 'pricing'], function ($view) use ($frontendMenu, $services, $categories) {
            $view->with('frontendMenu', $frontendMenu)
                 ->with('services', $services)
                 ->with('categories', $categories);
        });
    }
}
