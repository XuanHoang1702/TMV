@extends('layouts.admin')

@section('title', 'Sửa tin tức')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">Sửa tin tức</h3>
                        <div>
                            <a href="{{ route('admin.news.show', $news) }}" class="btn btn-info"><i class="fas fa-eye"></i>
                                Xem</a>
                            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary"><i
                                    class="fas fa-arrow-left"></i> Quay lại</a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <!-- Left Column -->
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label>Tiêu đề *</label>
                                        <input type="text" class="form-control" id="title" name="title"
                                            value="{{ old('title', $news->title) }}" required>
                                    </div>

                                    <div class="form-group">
                                        <label>Slug</label>
                                        <input type="text" class="form-control" id="slug" name="slug"
                                            value="{{ old('slug', $news->slug) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Tóm tắt</label>
                                        <textarea class="form-control" name="summary" rows="3">{{ old('summary', $news->summary) }}</textarea>
                                    </div>

                                    <div class="form-group">
                                        <label>Nội dung *</label>
                                        <textarea class="form-control" name="content" rows="10">{{ old('content', $news->content) }}</textarea>
                                    </div>
                                </div>

                                <!-- Right Column -->
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Danh mục</label>
                                        <select class="form-control" name="category_id">
                                            <option value="">Chọn danh mục</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Ảnh hiện tại</label>
                                        @if ($news->images && count($news->images) > 0)
                                            <div class="row">
                                                @foreach ($news->images as $image)
                                                    <div class="col-md-3 mb-2">
                                                        <div class="border p-2 position-relative">
                                                            <img src="{{ Storage::url($image) }}" class="img-fluid"
                                                                style="max-width:100px">
                                                            <button type="button"
                                                                class="btn btn-danger btn-sm remove-existing-image mt-1 position-absolute top-0 end-0"
                                                                style="z-index: 10;"
                                                                data-image-path="{{ $image }}"
                                                                data-news-id="{{ $news->id }}">
                                                                <i class="fas fa-times"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>

                                    <div class="form-group">
                                        <label>Thêm ảnh mới</label>
                                        <div id="images-container">
                                            <div class="image-item mb-3 border p-3">
                                                <h6>Ảnh mới 1</h6>
                                                <input type="file" name="images[]" class="form-control" accept="image/*">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm remove-image mt-2">Xóa</button>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-secondary btn-sm" id="add-image">Thêm
                                            ảnh</button>
                                    </div>

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="is_featured"
                                                value="1"
                                                {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}>
                                            <label class="form-check-label">Tin nổi bật</label>
                                        </div>
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" name="is_active" value="1"
                                                {{ old('is_active', $news->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label">Kích hoạt</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label>Ngày xuất bản</label>
                                        <input type="datetime-local" class="form-control" name="published_at"
                                            value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Title</label>
                                        <input type="text" class="form-control" name="meta_title"
                                            value="{{ old('meta_title', $news->meta_title) }}">
                                    </div>

                                    <div class="form-group">
                                        <label>Meta Description</label>
                                        <textarea class="form-control" name="meta_description" rows="3">{{ old('meta_description', $news->meta_description) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary"><i class="fas fa-save"></i> Cập nhật</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                let imageCount = 1;

                document.getElementById('add-image').addEventListener('click', function() {
                    imageCount++;
                    const container = document.getElementById('images-container');
                    const newItem = document.createElement('div');
                    newItem.className = 'image-item mb-3 border p-3';
                    newItem.innerHTML = `
            <h6>Ảnh mới ${imageCount}</h6>
            <input type="file" name="images[]" class="form-control" accept="image/*">
            <button type="button" class="btn btn-danger btn-sm remove-image mt-2">Xóa</button>
        `;
                    container.appendChild(newItem);
                });

                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-image')) {
                        const items = document.querySelectorAll('#images-container .image-item');
                        if (items.length > 1) e.target.closest('.image-item').remove();
                    }

                    if (e.target.classList.contains('remove-existing-image')) {
                        if (confirm('Bạn có chắc muốn xóa ảnh này?')) {
                            const imagePath = e.target.dataset.imagePath;
                            const url = `/admin/news/${e.target.dataset.newsId}/remove-image`;

                            fetch(url, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                        'Content-Type': 'application/json',
                                    },
                                    body: JSON.stringify({
                                        image: imagePath
                                    })
                                })
                                .then(res => res.json())
                                .then(data => {
                                    if (data.success) {
                                        e.target.closest('.col-md-3').remove();
                                    } else {
                                        alert('Xóa ảnh thất bại');
                                    }
                                });
                        }
                    }

                });

                // Auto-generate slug
                document.getElementById('title').addEventListener('input', function() {
                    const slug = this.value.toLowerCase()
                        .replace(/[^a-z0-9\s-]/g, '')
                        .replace(/\s+/g, '-')
                        .replace(/-+/g, '-')
                        .replace(/^-+|-+$/g, '');
                    document.getElementById('slug').value = slug;
                });
            });
        </script>
    @endpush
@endsection
