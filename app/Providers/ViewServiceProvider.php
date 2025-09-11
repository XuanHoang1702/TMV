<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use App\Models\Menu;

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

        View::composer('layouts.app', function ($view) use ($frontendMenu) {
            $view->with('frontendMenu', $frontendMenu);
        });
    }
}
