@extends('layouts.app')

@section('title', isset($category) ? $category->name . ' - Thẩm mỹ Dr.DAT' : 'Tin tức - Thẩm mỹ Dr.DAT')

@section('meta')
    {{-- Meta Description --}}
    @if (isset($category) && $category->description)
        <meta name="description" content="{{ Str::limit(strip_tags($category->description), 160) }}">
    @elseif(isset($newsBanner) && $newsBanner && $newsBanner->content)
        <meta name="description" content="{{ Str::limit(strip_tags($newsBanner->content), 160) }}">
    @else
        <meta name="description" content="Tin tức mới nhất về thẩm mỹ, làm đẹp tại Thẩm mỹ Dr.DAT. Cập nhật thông tin, kiến thức, xu hướng làm đẹp hàng ngày.">
    @endif

    {{-- Meta Keywords --}}
    @if (isset($category) && $category->name)
        <meta name="keywords" content="{{ $category->name }}, {{ Str::slug($category->name) }}, thẩm mỹ, làm đẹp, Dr.DAT, tin tức thẩm mỹ, xu hướng làm đẹp, kiến thức thẩm mỹ">
    @else
        <meta name="keywords" content="tin tức thẩm mỹ, làm đẹp, thẩm mỹ Dr.DAT, xu hướng làm đẹp, kiến thức thẩm mỹ, tin tức làm đẹp mới nhất, tư vấn thẩm mỹ, dịch vụ thẩm mỹ chuyên nghiệp">
    @endif

    {{-- Open Graph Meta Tags --}}
    <meta property="og:title" content="{{ isset($category) ? $category->name . ' - Thẩm mỹ Dr.DAT' : 'Tin tức - Thẩm mỹ Dr.DAT' }}">

    @php
        $metaDescription = '';
        if (isset($category) && $category->description) {
            $metaDescription = Str::limit(strip_tags($category->description), 160);
        } elseif (isset($newsBanner) && $newsBanner && $newsBanner->content) {
            $metaDescription = Str::limit(strip_tags($newsBanner->content), 160);
        } else {
            $metaDescription = 'Tin tức thẩm mỹ và làm đẹp mới nhất';
        }
    @endphp

    <meta property="og:description" content="{{ $metaDescription }}">
    <meta property="og:type" content="website">
    <meta property="og:url" content="{{ request()->fullUrl() }}">
    <meta property="og:site_name" content="Thẩm mỹ Dr.DAT">
    <meta property="og:locale" content="vi_VN">
    <meta property="og:image" content="{{ asset('images/og-image-tintuc.jpg') }}">
    <meta property="og:image:width" content="1200">
    <meta property="og:image:height" content="630">

    {{-- Twitter Card Meta Tags --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ isset($category) ? $category->name . ' - Thẩm mỹ Dr.DAT' : 'Tin tức - Thẩm mỹ Dr.DAT' }}">
    <meta name="twitter:description" content="{{ $metaDescription }}">
    <meta name="twitter:image" content="{{ asset('images/og-image-tintuc.jpg') }}">
    <meta name="twitter:site" content="@ThammyDrDAT">

    {{-- Canonical URL --}}
    <link rel="canonical" href="{{ request()->fullUrl() }}">
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/tintuc.css') }}">
@endsection

@section('content')
    <div class="cl-body-bg">
        <div class="container">
            <!--banner-->
            @if (isset($newsBanner) && $newsBanner)
                <div class="cl-jCenter">
                    <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="col-12">
                            <h4 class="cl-title">{{ $newsBanner->title }}</h4>
                        </div>
                        <div class="col-12 cl-desc">
                            <p>{!! nl2br(e($newsBanner->content)) !!}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!--contents-->
            <div class="cl-news">
                <div class="row">
                    <!--Left Sidebar-->
                    <div class="col-12 col-sm-3">
                        <!--Danh mục-->
                        <div class="row">
                            <div class="col-12">
                                <a class="cl-btn-full {{ !request('category') && !isset($category) ? 'active' : '' }}"
                                    href="{{ route('news.index') }}">
                                    <span>Tất cả</span>
                                </a>
                            </div>
                            @foreach ($newsCategories as $cat)
                                <div class="col-12">
                                    <a class="cl-btn-full-2 {{ request('category') == $cat->id || (isset($category) && $category->id == $cat->id) ? 'active' : '' }}"
                                        href="{{ isset($cat->slug) ? route('news.category', $cat->slug) : route('news.index', ['category' => $cat->id]) }}">
                                        <span>{{ $cat->name }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!--Ảnh quảng cáo-->
                        @if (isset($sidebarBanners) && $sidebarBanners->count() > 0)
                            <div class="row cl-img-left mt-4">
                                <div class="col-12">
                                    @foreach ($sidebarBanners as $banner)
                                        @if ($banner->link)
                                            <a href="{{ $banner->link }}" target="_blank" rel="noopener noreferrer">
                                                <img src="{{ asset('storage/' . $banner->image_path) }}"
                                                    alt="{{ $banner->title ?? 'Banner' }}">
                                            </a>
                                        @else
                                            <img src="{{ asset('storage/' . $banner->image_path) }}"
                                                alt="{{ $banner->title ?? 'Banner' }}">
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @else
                            <div class="row cl-img-left mt-4">
                                <div class="col-12">
                                    <img src="{{ asset('images/tintuc/tin-tuc-banner_1.png') }}" alt="Banner">
                                </div>
                            </div>
                        @endif

                        <!--Form tư vấn-->
                        @include('layouts.booking.tuvan_no_popup')
                    </div>

                    <!--Right Content-->
                    <div class="col-12 col-sm-9">
                        <!-- Category Title -->
                        @if (isset($category))
                            <div class="row mb-4">
                                <div class="col-12">
                                    <h1 class="category-title">{{ $category->name }}</h1>
                                    {{-- Removed incomplete if statement --}}
                                </div>
                            </div>
                        @endif

                        <div class="row">
                            @forelse($newsList as $news)
                                <div class="col-12 col-sm-4 mb-4">
                                    <div class="cl-item-new d-flex flex-column" data-aos="zoom-in" data-aos-duration="1000"
                                        style="height: 100%;">
                                        <div class="dv-img" style="height: 200px; overflow: hidden;">
                                            @php
                                                $firstImage = null;
                                                if (
                                                    $news->images &&
                                                    is_array($news->images) &&
                                                    count($news->images) > 0
                                                ) {
                                                    $firstImage = $news->images[0];
                                                }
                                            @endphp
                                            <img src="{{ $firstImage ? asset('storage/' . $firstImage) : asset('images/default-news.png') }}"
                                                alt="{{ Str::limit($news->title, 50) }}" class="img-fluid"
                                                style="height: 200px;" />
                                        </div>
                                        <div class="dv-info d-flex flex-column" style="flex: 1;">
                                            <h2>{{ Str::limit($news->title, 70) }}</h2>
                                            <p class="cl-info-date">
                                                <label style="display: inline;">{{ $news->category ? $news->category->name : 'Chưa phân loại' }}</label>
                                                <i style="font-size: 13px; display: inline; margin-left: 3px;">
                                                    {{ $news->published_at ? $news->published_at->format('H:i, d/m/Y') : 'Bản nháp' }}
                                                </i>
                                            </p>
                                            <p class="cl-desc">{{ Str::limit($news->summary ?? '', 120) }}</p>
                                            <a href="{{ route('news.detail', [$news->category->slug ?? 'chuyen-mon', $news->slug]) }}"
                                                class="btn-more mt-auto">xem thêm</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <div class="col-12">
                                    <div class="text-center py-5">
                                        <h4>{{ isset($category) ? 'Chưa có tin tức nào trong danh mục này.' : 'Chưa có tin tức nào.' }}</h4>
                                        <p>Vui lòng quay lại sau để xem các tin tức mới nhất.</p>
                                    </div>
                                </div>
                            @endforelse
                        </div>

                        <!--Phân trang-->
                        @if ($newsList->hasPages())
                            <div class="row">
                                <div class="col-12">
                                    <ul class="cl-pagging">
                                        @if ($newsList->onFirstPage())
                                            <li class="p-first disabled">
                                                <a href="#" aria-disabled="true">
                                                    <img src="{{ asset('images/icon/icon_btn_left.png') }}"
                                                        alt="Trang trước" />
                                                </a>
                                            </li>
                                        @else
                                            <li class="p-first">
                                                <a href="{{ $newsList->previousPageUrl() }}" rel="prev">
                                                    <img src="{{ asset('images/icon/icon_btn_left.png') }}"
                                                        alt="Trang trước" />
                                                </a>
                                            </li>
                                        @endif

                                        @foreach ($newsList->getUrlRange(1, $newsList->lastPage()) as $page => $url)
                                            <li class="{{ $page == $newsList->currentPage() ? 'active' : '' }}">
                                                <a href="{{ $url }}"
                                                    {{ $page == $newsList->currentPage() ? 'aria-current="page"' : '' }}>
                                                    <span>{{ $page }}</span>
                                                </a>
                                            </li>
                                        @endforeach

                                        @if ($newsList->hasMorePages())
                                            <li class="p-last">
                                                <a href="{{ $newsList->nextPageUrl() }}" rel="next">
                                                    <img src="{{ asset('images/icon/icon_btn_right.png') }}"
                                                        alt="Trang sau" />
                                                </a>
                                            </li>
                                        @else
                                            <li class="p-last disabled">
                                                <a href="#" aria-disabled="true">
                                                    <img src="{{ asset('images/icon/icon_btn_right.png') }}"
                                                        alt="Trang sau" />
                                                </a>
                                            </li>
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        @include('layouts.booking.booking_Popup_DatLichKham')
    </div>
@endsection
