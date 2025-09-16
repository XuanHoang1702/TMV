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
                {!! $news->content !!}  {{-- lưu ý: content nên chứa HTML --}}
            </div>
        </div>

        <!-- Sidebar -->
        <div class="row mt-4">
            <div class="col-12 col-sm-3">
                <a class="cl-btn-full" href="{{ route('news.index') }}">
                    <span>Tất cả</span>
                </a>
                @foreach ($newsCategories as $category)
                    <a class="cl-btn-full-2" href="{{ route('news.category', $category->slug) }}">
                        <span>{{ $category->name }}</span>
                    </a>
                @endforeach
            </div>
        </div>

    </div>
</div>
@endsection
