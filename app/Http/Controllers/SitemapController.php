<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Sitemap\Sitemap;
use Spatie\Sitemap\Tags\Url;
use App\Models\Service;
use App\Models\Information;
use App\Models\Banner;
use Carbon\Carbon;

class SitemapController extends Controller
{
    public function index()
    {
        $sitemap = Sitemap::create()
            ->add(Url::create('/')->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_DAILY)->setPriority(1.0))
            ->add(Url::create('/lien-he')->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)->setPriority(0.8))
            ->add(Url::create('/bao-gia')->setLastModificationDate(Carbon::yesterday())->setChangeFrequency(Url::CHANGE_FREQUENCY_MONTHLY)->setPriority(0.8));

        // Add services
        $services = Service::where('is_active', true)->get();
        foreach ($services as $service) {
            $sitemap->add(Url::create("/dich-vu/{$service->slug}")
                ->setLastModificationDate($service->updated_at ?? Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.9));
        }

        // Add information/news if exists
        $informations = Information::where('is_active', true)->get();
        foreach ($informations as $info) {
            $sitemap->add(Url::create("/tin-tuc/{$info->slug}")
                ->setLastModificationDate($info->updated_at ?? Carbon::now())
                ->setChangeFrequency(Url::CHANGE_FREQUENCY_WEEKLY)
                ->setPriority(0.7));
        }

        return $sitemap->toResponse(request());
    }
}
