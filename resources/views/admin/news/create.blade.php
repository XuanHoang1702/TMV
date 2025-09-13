@extends('layouts.admin')

@section('title', 'Thêm Tin tức Mới')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Thêm Tin tức Mới</h1>
        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Thông tin Tin tức</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.news.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <div class="row">
                    <div class="col-md-8">
                        <div class="mb-3">
                            <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug') }}" required>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">Slug sẽ được sử dụng trong URL</div>
                        </div>
                        <div class="mb-3">
                            <label for="summary" class="form-label">Tóm tắt</label>
                            <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" rows="3">{{ old('summary') }}</textarea>
                            @error('summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                            <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <button type="button" class="btn btn-outline-primary mt-2" data-bs-toggle="modal"
                                data-bs-target="#fullscreenEditorModal">
                                Mở toàn màn hình
                            </button>
                        </div>

                        <!-- Modal Fullscreen -->
                        <div class="modal fade" id="fullscreenEditorModal" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog modal-fullscreen">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Soạn thảo nội dung</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body">
                                        <textarea id="content_fullscreen"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Đóng</button>
                                        <button type="button" class="btn btn-primary" id="saveFullscreenContent">Lưu vào
                                            form</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @push('scripts')
                            <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>

                            <script>
                                let editorMain, editorFullscreen;

                                // CKEditor chính trong form
                                ClassicEditor.create(document.querySelector('#content')).then(ed => editorMain = ed);

                                // CKEditor trong modal fullscreen
                                ClassicEditor.create(document.querySelector('#content_fullscreen')).then(ed => editorFullscreen = ed);

                                // Khi mở modal → đồng bộ nội dung
                                document.getElementById('fullscreenEditorModal').addEventListener('show.bs.modal', function() {
                                    editorFullscreen.setData(editorMain.getData());
                                });

                                // Khi bấm Lưu → copy ngược về form
                                document.getElementById('saveFullscreenContent').addEventListener('click', function() {
                                    editorMain.setData(editorFullscreen.getData());
                                    bootstrap.Modal.getInstance(document.getElementById('fullscreenEditorModal')).hide();
                                });
                            </script>
                        @endpush

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="category_id" class="form-label">Danh mục</label>
                                    <select class="form-select @error('category_id') is-invalid @enderror" id="category_id"
                                        name="category_id">
                                        <option value="">Chọn danh mục</option>
                                        @foreach($categories as $category)
                                            <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>
                                                {{ $category->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('category_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_featured" name="is_featured"
                                            value="1" {{ old('is_featured') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_featured">Tin nổi bật</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                            value="1" {{ old('is_active') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="is_active">Kích hoạt</label>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="published_at" class="form-label">Ngày xuất bản</label>
                            <input type="datetime-local" class="form-control @error('published_at') is-invalid @enderror"
                                id="published_at" name="published_at" value="{{ old('published_at') }}">
                            @error('published_at')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control @error('meta_title') is-invalid @enderror"
                                id="meta_title" name="meta_title" value="{{ old('meta_title') }}">
                            @error('meta_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                name="meta_description" rows="2">{{ old('meta_description') }}</textarea>
                            @error('meta_description')
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
                                            <input type="file"
                                                class="form-control @error('images.0') is-invalid @enderror"
                                                name="images[]" accept="image/*">
                                            @error('images.0')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                            <button type="button"
                                                class="btn btn-danger btn-sm remove-image mt-2">Xóa</button>
                                        </div>
                                    </div>
                                    <button type="button" class="btn btn-secondary btn-sm" id="add-image">Thêm
                                        ảnh</button>
                                    <small class="form-text text-muted">Tải lên ảnh từ thiết bị của bạn.</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <a href="{{ route('admin.news.index') }}" class="btn btn-secondary me-2">Hủy</a>
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Lưu tin tức
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        // Hàm chuyển đổi tiếng Việt thành không dấu
        function removeVietnameseTones(str) {
            return str.normalize('NFD').replace(/[\u0300-\u036f]/g, '')
                .replace(/đ/g, 'd').replace(/Đ/g, 'D')
                .toLowerCase()
                .replace(/[^a-z0-9\s-]/g, '')
                .replace(/\s+/g, '-')
                .replace(/-+/g, '-')
                .trim('-');
        }

        // Auto-generate slug from title
        document.getElementById('title').addEventListener('input', function() {
            const title = this.value;
            const slug = removeVietnameseTones(title);
            document.getElementById('slug').value = slug;
        });
    </script>
@endsection

@section('scripts')
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
@endsection
