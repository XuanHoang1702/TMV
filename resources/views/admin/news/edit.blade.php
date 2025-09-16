@extends('layouts.admin')

@section('title', 'Sửa tin tức')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Sửa tin tức</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.news.show', $news) }}" class="btn btn-info">
                                <i class="fas fa-eye"></i> Xem
                            </a>
                            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-8">
                                    <div class="form-group">
                                        <label for="title">Tiêu đề *</label>
                                        <input type="text" class="form-control @error('title') is-invalid @enderror"
                                            id="title" name="title" value="{{ old('title', $news->title) }}" required>
                                        @error('title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                            id="slug" name="slug" value="{{ old('slug', $news->slug) }}">
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="excerpt">Tóm tắt</label>
                                        <textarea class="form-control @error('excerpt') is-invalid @enderror" id="excerpt" name="excerpt" rows="3">{{ old('excerpt', $news->excerpt) }}</textarea>
                                        @error('excerpt')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="content">Nội dung *</label>
                                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10">{{ old('content', $news->content) }}</textarea>
                                        @error('content')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="category_id">Danh mục</label>
                                        <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                                            name="category_id">
                                            <option value="">Chọn danh mục</option>
                                            @foreach($categories as $category)
                                                <option value="{{ $category->id }}" {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('category_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">Ảnh</label>
                                        @if ($news->images && count($news->images) > 0)
                                            <div class="mb-3">
                                                <label>Ảnh hiện tại:</label>
                                                <div class="row">
                                                    @foreach ($news->images as $index => $imagePath)
                                                        <div class="col-md-3 mb-2">
                                                            <div class="border p-2">
                                                                <img src="{{ Storage::url($imagePath) }}" alt="Image {{ $index + 1 }}"
                                                                    class="img-fluid" style="max-width: 100px;">
                                                                <button type="button" class="btn btn-danger btn-sm mt-1 remove-existing-image"
                                                                    data-image-path="{{ $imagePath }}">Xóa</button>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            </div>
                                        @endif
                                        <div id="images-container">
                                            <div class="image-item mb-3 border p-3">
                                                <h6>Ảnh mới 1</h6>
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

                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_featured"
                                                name="is_featured" value="1"
                                                {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_featured">Tin nổi bật</label>
                                        </div>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                                value="1" {{ old('is_active', $news->is_active) ? 'checked' : '' }}>
                                            <label class="form-check-label" for="is_active">Kích hoạt</label>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label for="published_at">Ngày xuất bản</label>
                                        <input type="datetime-local"
                                            class="form-control @error('published_at') is-invalid @enderror"
                                            id="published_at" name="published_at"
                                            value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}">
                                        @error('published_at')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_title">Meta Title</label>
                                        <input type="text"
                                            class="form-control @error('meta_title') is-invalid @enderror" id="meta_title"
                                            name="meta_title" value="{{ old('meta_title', $news->meta_title) }}">
                                        @error('meta_title')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="meta_description">Meta Description</label>
                                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                            name="meta_description" rows="3">{{ old('meta_description', $news->meta_description) }}</textarea>
                                        @error('meta_description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Cập nhật
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
        <script>
            // Auto-generate slug from title
            document.getElementById('title').addEventListener('input', function() {
                const title = this.value;
                const slug = title.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
                document.getElementById('slug').value = slug;
            });

            document.addEventListener('DOMContentLoaded', function() {
                let imageCount = {{ $news->images ? count($news->images) : 0 }};
                if(imageCount === 0) imageCount = 1;

                // Add new image input
                document.getElementById('add-image').addEventListener('click', function() {
                    imageCount++;
                    const container = document.getElementById('images-container');
                    const newImageItem = document.createElement('div');
                    newImageItem.className = 'image-item mb-3 border p-3';
                    newImageItem.innerHTML = `
                        <h6>Ảnh mới ${imageCount}</h6>
                        <input type="file" class="form-control" name="images[]" accept="image/*">
                        <button type="button" class="btn btn-danger btn-sm remove-image mt-2">Xóa</button>
                    `;
                    container.appendChild(newImageItem);
                });

                // Remove new image input
                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-image')) {
                        const imageItems = document.querySelectorAll('#images-container .image-item');
                        if (imageItems.length > 1) {
                            e.target.closest('.image-item').remove();
                            // Renumber remaining new images
                            document.querySelectorAll('#images-container .image-item h6').forEach((title, index) => {
                                title.textContent = `Ảnh mới ${index + 1}`;
                            });
                            imageCount = imageItems.length - 1;
                        }
                    }
                });

                // Handle removing existing images
                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-existing-image')) {
                        const imagePath = e.target.getAttribute('data-image-path');
                        if (confirm('Bạn có chắc muốn xóa ảnh này?')) {
                            // Add to removed images list
                            let removedImagesInput = document.getElementById('removed_images');
                            if (!removedImagesInput) {
                                removedImagesInput = document.createElement('input');
                                removedImagesInput.type = 'hidden';
                                removedImagesInput.name = 'removed_images[]';
                                removedImagesInput.id = 'removed_images';
                                document.querySelector('form').appendChild(removedImagesInput);
                            }
                            removedImagesInput.value += (removedImagesInput.value ? ',' : '') + imagePath;

                            // Remove from display
                            e.target.closest('.col-md-3').remove();
                        }
                    }
                });
            });
        </script>
    @endpush
@endsection
