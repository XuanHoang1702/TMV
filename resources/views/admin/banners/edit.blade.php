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
                <label for="image" class="form-label">Hình ảnh banner <span class="text-danger">*</span></label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
                @if($banner->image_path)
                <div class="mt-2">
                    <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" style="width: 150px;">
                </div>
                @endif
            </div>

            

            <div class="mb-3">
                <label for="page" class="form-label">Page</label>
                <input type="text" class="form-control @error('page') is-invalid @enderror" id="page" name="page" value="{{ old('page', $banner->page) }}">
                @error('page')
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

            <div class="mb-3">
                <label for="section" class="form-label">Section</label>
                <select class="form-control @error('section') is-invalid @enderror" id="section" name="section">
                    <option value="1" {{ old('section', $banner->section) == '1' ? 'selected' : '' }}>1</option>
                    <option value="2" {{ old('section', $banner->section) == '2' ? 'selected' : '' }}>2</option>
                </select>
                @error('section')
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
