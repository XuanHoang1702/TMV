@extends('layouts.admin')

@section('title', 'Thêm Nội dung Giới thiệu')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Thêm Nội dung Giới thiệu</h1>
    <a href="{{ route('admin.abouts.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Thêm Nội dung Giới thiệu Mới</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.abouts.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" required>{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="image" class="form-label">Hình ảnh</label>
                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                @error('image')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn btn-primary">
                <i class="fas fa-save"></i> Lưu
            </button>
        </form>
    </div>
</div>
@endsection
