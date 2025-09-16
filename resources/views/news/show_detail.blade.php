@extends('layouts.app')

@section('title', $news->title . ' - Thẩm mỹ Dr.DAT')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/tintuc.css') }}">
@endsection

@section('content')
<div class="cl-body-bg">
    <div class="container">

        <!-- Banner -->
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

        <!-- Related News -->
        @if ($relatedNews->count() > 0)
        <div class="row mt-4">
            <div class="col-12">
                <h5>Tin tức liên quan</h5>
                <div class="row">
                    @foreach ($relatedNews as $related)
                    <div class="col-12 col-md-3 mb-3">
                        <div class="card">
                            @if ($related->images && count($related->images) > 0)
                                <img src="{{ Storage::url($related->images[0]) }}" class="card-img-top" alt="{{ $related->title }}">
                            @endif
                            <div class="card-body">
                                <h6 class="card-title"><a href="{{ route('news.detail', $related->slug) }}">{{ $related->title }}</a></h6>
                                <p class="card-text">{{ Str::limit($related->excerpt, 100) }}</p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
