@extends('layouts.admin')

@section('title', 'Thêm Pricing Footer')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thêm Pricing Footer</h1>
        <a href="{{ route('admin.pricing_footer.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin Pricing Footer</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.pricing_footer.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề <span class="text-muted">(không bắt buộc)</span></label>
                            <input type="text" class="form-control" id="title" name="title"
                                   value="{{ old('title') }}" placeholder="Nhập tiêu đề">
                            @error('title')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                            <textarea class="form-control" id="content" name="content" rows="4"
                                      placeholder="Nhập nội dung" required>{{ old('content') }}</textarea>
                            @error('content')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="icon" class="form-label">Icon</label>
                            <input type="file" class="form-control" id="icon" name="icon"
                                   accept="image/*" onchange="previewImage(this)">
                            <div class="form-text">Chọn file ảnh (JPEG, PNG, JPG, GIF, SVG, tối đa 2MB)</div>
                            @error('icon')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                            <div id="imagePreview" class="mt-2" style="display: none;">
                                <img id="previewImg" src="" alt="Preview" style="max-width: 200px; max-height: 200px;">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="sort_order" class="form-label">Thứ tự hiển thị</label>
                            <input type="number" class="form-control" id="sort_order" name="sort_order"
                                   value="{{ old('sort_order', 0) }}" min="0">
                            @error('sort_order')
                                <div class="text-danger small">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3 form-check">
                            <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                   value="1" {{ old('is_active', true) ? 'checked' : '' }}>
                            <label class="form-check-label" for="is_active">
                                Hiển thị
                            </label>
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Lưu
                            </button>
                            <a href="{{ route('admin.pricing_footer.index') }}" class="btn btn-secondary">
                                <i class="fas fa-times"></i> Hủy
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Preview</h6>
                </div>
                <div class="card-body">
                    <div class="cl-pl-footer-info">
                        <div class="row">
                            <div class="col-12 col-sm-3 cl-img">
                                <img id="previewIcon" src="{{ asset('images/baogia/icon_pages.png') }}"
                                     alt="Icon Preview" style="max-width: 60px;">
                            </div>
                            <div class="col-12 col-sm-9 cl-info">
                                <ul class="ul-info">
                                    <li id="previewContent">Nội dung sẽ hiển thị ở đây...</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function previewImage(input) {
    const preview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');
    const previewIcon = document.getElementById('previewIcon');

    if (input.files && input.files[0]) {
        const reader = new FileReader();

        reader.onload = function(e) {
            previewImg.src = e.target.result;
            previewIcon.src = e.target.result;
            preview.style.display = 'block';
        }

        reader.readAsDataURL(input.files[0]);
    } else {
        preview.style.display = 'none';
        previewIcon.src = "{{ asset('images/baogia/icon_pages.png') }}";
    }
}

// Update preview when content changes
document.getElementById('content').addEventListener('input', function() {
    document.getElementById('previewContent').textContent = this.value || 'Nội dung sẽ hiển thị ở đây...';
});
</script>
@endsection
