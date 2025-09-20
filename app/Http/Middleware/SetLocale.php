<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class SetLocale
{
    public function handle($request, Closure $next)
    {
        if ($locale = session('locale')) {
            \Log::info("Middleware SetLocale: " . $locale);
            App::setLocale($locale);
        } else {
            \Log::info("Middleware SetLocale: không có session");
        }

        return $next($request);
    }

}
