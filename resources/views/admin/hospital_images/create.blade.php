@extends('layouts.admin')

@section('title', 'Thêm Ảnh Bệnh viện Mới')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Thêm Ảnh Bệnh viện Mới</h1>
    <a href="{{ route('admin.hospital_images.index') }}" class="btn btn-secondary">
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
            <h5 class="mb-0">Thông tin Ảnh Bệnh viện</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.hospital_images.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="mb-3">
                    <label for="image" class="form-label">Chọn ảnh <span class="text-danger">*</span></label>
                    <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*" required>
                    @error('image')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                    <div class="form-text">Định dạng: JPG, PNG, GIF. Kích thước tối đa: 2MB</div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.hospital_images.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu ảnh
                    </button>
                </div>
            </form>
        </div>
    </div>
@endif
