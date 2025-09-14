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

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="title" class="form-label">Tiêu đề</label>
                        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" placeholder="Nhập tiêu đề ảnh" value="{{ old('title') }}" required>
                        @error('title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Hình ảnh</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3">
                                <label class="form-label">Ảnh</label>
                                <div id="images-container">
                                    <div class="image-item mb-3 border p-3">
                                        <h6>Ảnh 1</h6>
                                        <input type="file" class="form-control @error('images.0') is-invalid @enderror" name="images[]" accept="image/*">
                                        @error('images.0')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                        <button type="button" class="btn btn-danger btn-sm remove-image mt-2">Xóa</button>
                                    </div>
                                </div>
                                <button type="button" class="btn btn-secondary btn-sm" id="add-image">Thêm ảnh</button>
                                <small class="form-text text-muted">Tải lên ảnh từ thiết bị của bạn.</small>
                            </div>
                        </div>
                    </div>
                </div>
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

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        let imageCount = 1;

        // Add new image input
        document.getElementById('add-image').addEventListener('click', function() {
            imageCount++;
            const container = document.getElementById('images-container');
            const newImageItem = document.createElement('div');
            newImageItem.className = 'image-item mb-3 border p-3';
            newImageItem.innerHTML = `
                <h6>Ảnh ${imageCount}</h6>
                <input type="file" class="form-control" name="images[]" accept="image/*">
                <button type="button" class="btn btn-danger btn-sm remove-image mt-2">Xóa</button>
            `;
            container.appendChild(newImageItem);
        });

        // Remove image input
        document.addEventListener('click', function(e) {
            if (e.target.classList.contains('remove-image')) {
                const imageItems = document.querySelectorAll('.image-item');
                if (imageItems.length > 1) {
                    e.target.closest('.image-item').remove();
                    // Renumber remaining images
                    document.querySelectorAll('.image-item h6').forEach((title, index) => {
                        title.textContent = `Ảnh ${index + 1}`;
                    });
                    imageCount = imageItems.length - 1;
                }
            }
        });
    });
</script>
@endpush
@endsection
