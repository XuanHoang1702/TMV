@extends('layouts.app')

@section('title', $news->meta_title ?? $news->title . ' - Thẩm mỹ Dr.DAT')

@section('meta_description', $news->meta_description ?? ($news->summary ?? 'Chi tiết tin tức về thẩm mỹ Dr.DAT'))

@section('meta_keywords', $news->meta_keywords ?? 'tin tức thẩm mỹ, Dr.DAT, ' . $news->title)

@section('og_title', $news->title . ' - Thẩm mỹ Dr.DAT')

@section('og_description', $news->meta_description ?? ($news->summary ?? 'Chi tiết tin tức về thẩm mỹ Dr.DAT'))

@section('og_image', $news->images ? asset('storage/' . $news->images[0]) : asset('images/logo_Dr_Dat.png'))

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/tintuc.css') }}">
@endsection

@section('content')
    <div class="cl-body-bg">
        <div class="container">

            <!-- Banner -->
            @if ($newsBanner && $newsBanner->title && $newsBanner->content)
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

            <!-- News Section -->
            <div class="cl-news">
                <div class="row">

                    <!-- Left Column - News Detail -->
                    <div class="col-12 col-sm-9">

                        <!-- News detail -->
                        <div class="cl-ct-new-Details">
                            <div class="dv-info">
                                <h4>{{ $news->title }}</h4>
                                <p class="cl-info-date">
                                    <label>{{ $news->category->name ?? 'Chưa phân loại' }}</label>
                                    <i>{{ $news->published_at->format('H:i, d/m/Y') }}</i>
                                </p>
                            </div>
                            <div class="dv-desc">
                                {!! $news->content !!}
                            </div>
                        </div>

                    </div>

                    <!-- Right Column - Related News -->
                    <div class="col-12 col-sm-3">
                        <!--div button-->
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <h3 class="cl-title">Bài viết liên quan</h3>
                            </div>
                        </div>
                        <!--Form-->
                        <div class="cl-ct-news-left">
                            <div class="row">
                                @if ($relatedNews->count() > 0)
                                    @foreach ($relatedNews as $related)
                                        <div class="col-12 col-sm-12">
                                            <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                                <div class="dv-img">
                                                    @if ($related->images && is_array($related->images) && count($related->images) > 0)
                                                        <img src="{{ Storage::url($related->images[0]) }}"
                                                            alt="{{ $related->title }}" />
                                                    @else
                                                        <img src="{{ asset('images/tintuc/tin-tuc_img_default.png') }}"
                                                            alt="Default Image" />
                                                    @endif
                                                </div>
                                                <div class="dv-info">
                                                    <h2>{{ $related->title }}</h2>
                                                    <p class="cl-info-date">
                                                        <label>{{ $related->category->name ?? 'Chuyên môn' }}</label>
                                                        <i>{{ $related->created_at->format('H:i, d/m/Y') }}</i>
                                                    </p>
                                                    <p class="cl-desc">
                                                        {{ Str::limit($related->summary ?: strip_tags($related->content), 120) }}
                                                    </p>
                                                    <a href="{{ route('news.detail', [$related->category->slug ?? 'chuyen-mon', $related->slug]) }}"
                                                        class="btn-more">xem thêm</a>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                @else
                                    <!-- Fallback content when no related news -->
                                    <div class="col-12 col-sm-12">
                                        <div class="text-center py-4">
                                            <p>Chưa có bài viết liên quan</p>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>

                </div>
            </div>

        </div>
    </div>
    </div>
@endsection
