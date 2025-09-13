@extends('layouts.admin')

@section('title', $news->title)

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>{{ $news->title }}</h1>
    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-body">
        <p><strong>Danh mục:</strong> {{ $news->category ? $news->category->name : 'Không có danh mục' }}</p>
        <p><strong>Ngày xuất bản:</strong> {{ $news->published_at ? $news->published_at->format('H:i, d/m/Y') : 'Bản nháp' }}</p>
        <p><strong>Tóm tắt:</strong> {{ $news->summary }}</p>
        <div>{!! $news->content !!}</div>

        @if($news->images && count($news->images) > 0)
        <h5 class="mt-4">Hình ảnh bổ sung:</h5>
        <div class="row">
            @foreach($news->images as $index => $imagePath)
            <div class="col-md-3 mb-3">
                <img src="{{ asset('storage/' . $imagePath) }}" class="img-fluid" alt="Image {{ $index + 1 }}">
            </div>
            @endforeach
        </div>
        @endif
    </div>
</div>

<h3 class="mt-4">Bài viết liên quan</h3>
<div class="row">
    @foreach($relatedNews as $item)
    <div class="col-md-3">
        <div class="card mb-3">
            @if($item->images && count($item->images) > 0)
            <img src="{{ asset('storage/' . $item->images[0]) }}" class="card-img-top" alt="{{ $item->title }}">
            @endif
            <div class="card-body">
                <h5 class="card-title">{{ $item->title }}</h5>
                <p class="card-text">{{ Str::limit($item->summary, 100) }}</p>
                <p class="card-text"><small class="text-muted">{{ $item->published_at->format('H:i, d/m/Y') }}</small></p>
                <a href="{{ route('admin.news.show', $item) }}" class="btn btn-primary btn-sm">Xem thêm</a>
            </div>
        </div>
    </div>
    @endforeach
</div>
@endsection
