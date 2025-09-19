<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    public function handle(Request $request, Closure $next)
    {
        if ($locale = session('locale')) {
            \Log::info("Middleware SetLocale: " . $locale);
            app()->setLocale($locale);
        } else {
            \Log::info("Middleware SetLocale: không có session");
        }

        return $next($request);
    }

}
