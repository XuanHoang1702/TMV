@extends('layouts.admin')

@section('title', 'Chỉnh sửa Nội dung Trang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Chỉnh sửa Nội dung Trang</h1>
    <a href="{{ route('admin.page_contents.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
</div>

@if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<div class="card shadow-sm">
    <div class="card-header bg-warning text-dark">
        <h5 class="mb-0"><i class="fas fa-edit"></i> Chỉnh sửa Nội dung Trang</h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.page_contents.update', $page->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="row">
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="page" class="form-label fw-bold">Trang <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('page') is-invalid @enderror" id="page" name="page" value="{{ old('page', $page->page) }}" required placeholder="Ví dụ: home, about, contact">
                        @error('page')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Tên trang duy nhất, ví dụ: home, about, contact</div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="mb-3">
                        <label for="title" class="form-label fw-bold">Tiêu đề <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $page->title) }}" required placeholder="Nhập tiêu đề nội dung trang">
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label fw-bold">Nội dung <span class="text-danger">*</span></label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10" required placeholder="Nhập nội dung chi tiết">{{ old('content', $page->content) }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>
            <div class="d-flex justify-content-end gap-2">
                <a href="{{ route('admin.page_contents.index') }}" class="btn btn-outline-secondary">
                    <i class="fas fa-times"></i> Hủy
                </a>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Cập nhật Nội dung Trang
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
