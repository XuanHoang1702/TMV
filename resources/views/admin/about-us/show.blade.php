@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Chi tiết nội dung trang liên hệ</h1>

    <div class="card">
        <div class="card-body">
            <h5 class="card-title">ID: {{ $aboutUs->id }}</h5>
            <p><strong>Title:</strong> {{ $aboutUs->title }}</p>
            <p><strong>Description:</strong> {!! nl2br(e($aboutUs->description)) !!}</p>
            <p><strong>Icon:</strong>
                @if($aboutUs->icon)
                    <br><img src="{{ asset('storage/' . $aboutUs->icon) }}" alt="Icon" style="width: 60px; height: 60px;">
                @else
                    Không có
                @endif
            </p>
            <p><strong>Icon Title:</strong> {{ $aboutUs->icon_title }}</p>
            <p><strong>Icon Content:</strong> {!! nl2br(e($aboutUs->icon_content)) !!}</p>
            <p><strong>Sub Title:</strong> {{ $aboutUs->sub_title }}</p>
            <p><strong>Section:</strong> {!! nl2br(e($aboutUs->section)) !!}</p>
            <p><strong>Created At:</strong> {{ $aboutUs->created_at }}</p>
            <p><strong>Updated At:</strong> {{ $aboutUs->updated_at }}</p>
        </div>
    </div>

    <a href="{{ route('admin.about-us.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
    <a href="{{ route('admin.about-us.edit', $aboutUs->id) }}" class="btn btn-warning mt-3">Chỉnh sửa</a>
</div>
@endsection
