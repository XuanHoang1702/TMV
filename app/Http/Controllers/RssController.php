<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Information;
use Carbon\Carbon;

class RssController extends Controller
{
    public function index()
    {
        $informations = Information::where('is_active', true)
            ->orderBy('created_at', 'desc')
            ->take(20)
            ->get();

        $rss = '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        $rss .= '<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom">' . "\n";
        $rss .= '<channel>' . "\n";
        $rss .= '<title>Thẩm mỹ Dr.DAT - Tin tức</title>' . "\n";
        $rss .= '<description>Tin tức và cập nhật mới nhất từ Thẩm mỹ Dr.DAT</description>' . "\n";
        $rss .= '<link>' . url('/') . '</link>' . "\n";
        $rss .= '<atom:link href="' . url('/feed.xml') . '" rel="self" type="application/rss+xml" />' . "\n";
        $rss .= '<language>vi</language>' . "\n";
        $rss .= '<lastBuildDate>' . Carbon::now()->toRfc2822String() . '</lastBuildDate>' . "\n";

        foreach ($informations as $info) {
            $rss .= '<item>' . "\n";
            $rss .= '<title><![CDATA[' . $info->title . ']]></title>' . "\n";
            $rss .= '<description><![CDATA[' . strip_tags($info->content ?? $info->description ?? '') . ']]></description>' . "\n";
            $rss .= '<link>' . url('/tin-tuc/' . $info->slug) . '</link>' . "\n";
            $rss .= '<guid>' . url('/tin-tuc/' . $info->slug) . '</guid>' . "\n";
            $rss .= '<pubDate>' . $info->created_at->toRfc2822String() . '</pubDate>' . "\n";
            $rss .= '</item>' . "\n";
        }

        $rss .= '</channel>' . "\n";
        $rss .= '</rss>';

        return response($rss)->header('Content-Type', 'application/rss+xml');
    }
}
