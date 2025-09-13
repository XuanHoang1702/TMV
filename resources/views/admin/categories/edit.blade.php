@extends('layouts.admin')

@section('title', 'Chỉnh sửa danh mục')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chỉnh sửa danh mục: {{ $category->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.categories.index', ['type' => $category->type]) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>

                <!-- Thêm enctype="multipart/form-data" -->
                <form action="{{ route('admin.categories.update', $category) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <!-- Tên danh mục -->
                                <div class="mb-3">
                                    <label for="name" class="form-label">Tên danh mục <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name"
                                           value="{{ old('name', $category->name) }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Slug -->
                                <div class="mb-3">
                                    <label for="slug" class="form-label">Slug</label>
                                    <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                           id="slug" name="slug"
                                           value="{{ old('slug', $category->slug) }}">
                                    <small class="form-text text-muted">Để trống để tự động tạo từ tên danh mục</small>
                                    @error('slug')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Mô tả -->
                                <div class="mb-3">
                                    <label for="description" class="form-label">Mô tả</label>
                                    <textarea class="form-control @error('description') is-invalid @enderror"
                                              id="description" name="description" rows="3">{{ old('description', $category->description) }}</textarea>
                                    @error('description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-4">
                                <!-- Loại danh mục -->
                                <div class="mb-3">
                                    <label for="type" class="form-label">Loại danh mục <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" id="type" name="type" required>
                                        <option value="general" {{ old('type', $category->type) == 'general' ? 'selected' : '' }}>Chung</option>
                                        <option value="services" {{ old('type', $category->type) == 'services' ? 'selected' : '' }}>Dịch vụ</option>
                                        <option value="news" {{ old('type', $category->type) == 'news' ? 'selected' : '' }}>Tin tức</option>
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Danh mục cha -->
                                <div class="mb-3">
                                    <label for="parent_id" class="form-label">Danh mục cha</label>
                                    <select class="form-select @error('parent_id') is-invalid @enderror" id="parent_id" name="parent_id">
                                        <option value="">Không có (danh mục gốc)</option>
                                        @foreach($parentCategories as $parent)
                                            <option value="{{ $parent->id }}" {{ old('parent_id', $category->parent_id) == $parent->id ? 'selected' : '' }}>
                                                {{ $parent->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('parent_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Thứ tự -->
                                <div class="mb-3">
                                    <label for="order" class="form-label">Thứ tự</label>
                                    <input type="number" class="form-control @error('order') is-invalid @enderror"
                                           id="order" name="order"
                                           value="{{ old('order', $category->order) }}" min="0">
                                    @error('order')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <!-- Hoạt động -->
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active"
                                               name="is_active" value="1"
                                               {{ old('is_active', $category->is_active) ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">
                                            Hoạt động
                                        </label>
                                    </div>
                                </div>

                               
                            </div>
                        </div>
                    </div>

                    <!-- Footer -->
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Cập nhật danh mục
                        </button>
                        <a href="{{ route('admin.categories.index', ['type' => $category->type]) }}" class="btn btn-secondary">
                            Hủy
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.getElementById('name').addEventListener('input', function() {
    const slugField = document.getElementById('slug');
    if (slugField.value === '') {
        slugField.value = this.value.toLowerCase()
            .replace(/[^a-z0-9\s-]/g, '')
            .replace(/\s+/g, '-')
            .replace(/-+/g, '-')
            .trim('-');
    }
});
</script>
@endsection
