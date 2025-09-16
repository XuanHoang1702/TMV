@extends('layouts.app')

@section('title', 'Tin tức - Thẩm mỹ Dr.DAT')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/tintuc.css') }}">
@endsection

@section('content')
    <div class="cl-body-bg">
        <div class="container">
            <!--banner-->
            @if ($newsBanner)
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
                                <a class="cl-btn-full" href="{{ route('news.index') }}">
                                    <span>Tất cả</span>
                                </a>
                            </div>
                            @foreach ($newsCategories as $category)
                                <div class="col-12">
                                    <a class="cl-btn-full-2" href="{{ route('news.category', $category->slug) }}">
                                        <span>{{ $category->name }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>

                        <!--Ảnh quảng cáo-->
                        <div class="row cl-img-left mt-4">
                            <div class="col-12">
                                <img src="{{ asset('images/tintuc/tin-tuc-banner_1.png') }}" alt="Banner">
                            </div>
                        </div>

                        <!--Form tư vấn-->
                        @include('layouts.booking.tuvan_no_popup')
                    </div>

                    <!--Right Content-->
                    <div class="col-12 col-sm-9">
                        <div class="row">
                            @forelse($newsList as $news)
                                <div class="col-12 col-sm-4 mb-4">
                                    <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                        <div class="dv-img">
                                            <img src="{{ $news->images[0] ? asset('storage/' . $news->images[0]) : asset('images/default-news.png') }}" />
                                        </div>
                                        <div class="dv-info">
                                            <h2>{{ Str::limit($news->title, 70) }}</h2>
                                            <p class="cl-info-date"><label>{{ $news->category->name ?? 'Chưa phân loại' }}</label><i>{{ $news->published_at ? $news->published_at->format('H:i, d/m/Y') : 'Bản nháp' }}</i></p>
                                            <p class="cl-desc">{{ Str::limit($news->summary, 120) }}</p>
                                            <a href="{{ route('news.detail', $news->slug) }}" class="btn-more">xem thêm</a>
                                        </div>
                                    </div>
                                </div>
                            @empty
                                <p>Chưa có tin tức nào.</p>
                            @endforelse
                        </div>

                        <!--Phân trang-->
                        <div class="row">
                            <div class="col-12">
                                <ul class="cl-pagging">
                                    @if ($newsList->onFirstPage())
                                        <li class="p-first disabled"><a href="#"><img src="{{ asset('images/icon/icon_btn_left.png') }}" /></a></li>
                                    @else
                                        <li class="p-first"><a href="{{ $newsList->previousPageUrl() }}"><img src="{{ asset('images/icon/icon_btn_left.png') }}" /></a></li>
                                    @endif

                                    @foreach ($newsList->getUrlRange(1, $newsList->lastPage()) as $page => $url)
                                        <li class="{{ $page == $newsList->currentPage() ? 'active' : '' }}">
                                            <a href="{{ $url }}"><span>{{ $page }}</span></a>
                                        </li>
                                    @endforeach

                                    @if ($newsList->hasMorePages())
                                        <li class="p-last"><a href="{{ $newsList->nextPageUrl() }}"><img src="{{ asset('images/icon/icon_btn_right.png') }}" /></a></li>
                                    @else
                                        <li class="p-last disabled"><a href="#"><img src="{{ asset('images/icon/icon_btn_right.png') }}" /></a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <!--Sec 4 - Đặt lịch khám ngay-->
            </div>
        </div>

        @include('layouts.booking.booking_Popup_DatLichKham')
    </div>
@endsection
