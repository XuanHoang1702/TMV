@extends('layouts.admin')

@section('title', 'Chỉnh sửa Banner')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Chỉnh sửa Banner</h1>
    <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Thông tin Banner</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.banners.update', $banner) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $banner->title) }}">
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="image_path" class="form-label">Đường dẫn hình ảnh <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('image_path') is-invalid @enderror" id="image_path" name="image_path" value="{{ old('image_path', $banner->image_path) }}" required>
                @error('image_path')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                <div class="form-text">Ví dụ: images/banners/banner_1.png</div>
            </div>

            <div class="mb-3">
                <label for="link" class="form-label">Liên kết</label>
                <input type="text" class="form-control @error('link') is-invalid @enderror" id="link" name="link" value="{{ old('link', $banner->link) }}">
                @error('link')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="order" class="form-label">Thứ tự</label>
                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', $banner->order) }}" min="0">
                @error('order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $banner->is_active) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    Kích hoạt banner
                </label>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary me-2">Hủy</a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Cập nhật banner
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
