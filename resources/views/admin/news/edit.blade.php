@extends('layouts.admin')

@section('title', 'Sửa tin tức')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Sửa tin tức</h1>
        <div>
            <a href="{{ route('admin.news.show', $news) }}" class="btn btn-info"><i class="fas fa-eye"></i>
                Xem</a>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
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
            <form action="{{ route('admin.news.update', $news) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title" class="form-label">Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title', $news->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug', $news->slug) }}" required>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Slug sẽ được sử dụng trong URL</small>
                        </div>

                        <div class="form-group">
                            <label for="summary" class="form-label">Tóm tắt</label>
                            <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" rows="3">{{ old('summary', $news->summary) }}</textarea>
                            @error('summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content" class="form-label">Nội dung <span class="text-danger">*</span></label>
                            <textarea class="form-control summernote @error('content') is-invalid @enderror" id="content" name="content"
                                rows="10">{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <button type="button" class="btn btn-outline-primary mt-2" data-toggle="modal"
                                data-target="#fullscreenEditorModal">
                                Mở toàn màn hình
                            </button>
                        </div>

                       
                        <!-- Related News Section -->
                        <div class="form-group">
                            <label for="related-news-select" class="form-label">Bài viết liên quan</label>
                            <select class="form-control select2" id="related-news-select" name="related_news[]"
                                multiple="multiple" style="width: 100%;">
                                @php
                                    // Sửa lỗi json_decode - kiểm tra kiểu dữ liệu trước khi decode
                                    $selectedRelated = [];
                                    if (is_string($news->related_news)) {
                                        $selectedRelated = json_decode($news->related_news, true) ?? [];
                                    } elseif (is_array($news->related_news)) {
                                        $selectedRelated = $news->related_news;
                                    } else {
                                        $selectedRelated = json_decode(json_encode($news->related_news), true) ?? [];
                                    }
                                    // Đảm bảo là array
                                    $selectedRelated = is_array($selectedRelated) ? $selectedRelated : [];
                                @endphp
                                @foreach (\App\Models\News::where('is_active', true)->whereNotNull('published_at')->where('id', '!=', $news->id)->orderBy('published_at', 'desc')->get() as $relatedOption)
                                    <option value="{{ $relatedOption->id }}"
                                        {{ in_array($relatedOption->id, $selectedRelated) ? 'selected' : '' }}>
                                        {{ $relatedOption->title }} ({{ $relatedOption->published_at->format('d/m/Y') }})
                                    </option>
                                @endforeach
                            </select>
                            <small class="form-text text-muted">Chọn các bài viết liên quan. Nếu không chọn, hệ thống sẽ tự
                                động hiển thị bài viết cùng chuyên mục.</small>
                        </div>

                        <!-- Modal Fullscreen -->
                        <div class="modal fade" id="fullscreenEditorModal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog modal-lg" style="width: 90%; max-width: none;">
                                <div class="modal-content" style="height: 90vh;">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Soạn thảo nội dung</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body" style="height: calc(90vh - 120px); overflow-y: auto;">
                                        <textarea class="summernote" id="content_fullscreen"></textarea>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                        <button type="button" class="btn btn-primary" id="saveFullscreenContent">Lưu vào
                                            form</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_id" class="form-label">Danh mục <span
                                    class="text-danger">*</span></label>
                            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id"
                                name="category_id" required>
                                <option value="">Chọn danh mục</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->id }}"
                                        {{ old('category_id', $news->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Hình ảnh hiện tại</label>
                            @if ($news->images && count($news->images) > 0)
                                <div class="row">
                                    @foreach ($news->images as $image)
                                        <div class="col-md-3 mb-2">
                                            <div class="border p-2 position-relative">
                                                <img src="{{ Storage::url($image) }}" class="img-fluid"
                                                    style="max-width:100px">
                                                <button type="button"
                                                    class="btn btn-danger btn-sm remove-existing-image mt-1 position-absolute"
                                                    style="top: 5px; right: 5px; z-index: 10;"
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
                            <label class="form-label">Thêm ảnh mới</label>
                            <div id="images-container">
                                <div class="image-item mb-3 border p-3">
                                    <h6>Ảnh mới 1</h6>
                                    <input type="file" name="images[]" class="form-control" accept="image/*">
                                    <button type="button" class="btn btn-danger btn-sm remove-image mt-2">Xóa</button>
                                </div>
                            </div>
                            <button type="button" class="btn btn-secondary btn-sm" id="add-image">Thêm ảnh</button>
                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured"
                                    value="1" {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">Tin nổi bật</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', $news->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">Kích hoạt</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="published_at" class="form-label">Ngày xuất bản</label>
                            <input type="datetime-local" class="form-control" id="published_at" name="published_at"
                                value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="meta_title" class="form-label">Meta Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title"
                                value="{{ old('meta_title', $news->meta_title) }}">
                        </div>

                        <div class="mb-3">
                            <label for="meta_description" class="form-label">Meta Description</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $news->meta_description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập nhật tin tức
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('styles')
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <style>
            .note-editor {
                border: 2px solid #e3e6f0;
                border-radius: 0.375rem;
            }

            .note-toolbar {
                background-color: #f8f9fc;
                border-bottom: 1px solid #e3e6f0;
            }

            .note-statusbar {
                background-color: #f8f9fc;
            }

            .note-editing-area .note-editable {
                min-height: 200px;
                padding: 1rem;
                font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            }

            .note-popover .popover {
                max-width: 400px;
            }

            .note-table-popover .popover-content {
                padding: 10px;
            }

            .note-table-popover .btn-group {
                margin: 5px;
            }

            .note-editable {
                line-height: 1.6;
            }

            .note-editable h1,
            .note-editable h2,
            .note-editable h3 {
                margin-top: 1em;
                margin-bottom: 0.5em;
                font-weight: bold;
            }

            .note-editable p {
                margin-bottom: 1em;
            }

            .note-editable ul,
            .note-editable ol {
                margin-bottom: 1em;
                padding-left: 2em;
            }

            .note-editable table {
                border-collapse: collapse;
                width: 100%;
                margin-bottom: 1em;
            }

            .note-editable table td,
            .note-editable table th {
                border: 1px solid #ddd;
                padding: 8px;
            }

            .select2-container--default .select2-selection--multiple {
                border: 2px solid #e3e6f0;
                border-radius: 0.375rem;
                min-height: 38px;
            }

            .select2-container--default.select2-container--focus .select2-selection--multiple {
                border-color: #80bdff;
                box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
            }

            /* Bootstrap 4 specific adjustments */
            .modal-header .close {
                padding: 0.5rem 0.5rem;
                margin: -0.5rem -0.5rem -0.5rem auto;
            }

            .form-check-input:checked {
                background-color: #007bff;
                border-color: #007bff;
            }
        </style>
    @endpush

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

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-vi-VN.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <script>
            $(document).ready(function() {
                // Initialize Select2 for related news
                $('#related-news-select').select2({
                    placeholder: 'Chọn bài viết liên quan...',
                    allowClear: true,
                    theme: 'bootstrap'
                });

                // Update hidden input when selection changes
                $('#related-news-select').on('change', function() {
                    const selectedValues = $(this).val();
                    $('#related-news-input').val(JSON.stringify(selectedValues || []));
                });

                // Custom Word-like toolbar configuration
                const customToolbar = [
                    ['style', ['style']],
                    ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript', 'subscript', 'clear']],
                    ['fontname', ['fontname']],
                    ['fontsize', ['fontsize']],
                    ['color', ['color']],
                    ['para', ['ul', 'ol', 'paragraph', 'lineheight']],
                    ['table', ['table']],
                    ['insert', ['link', 'picture', 'video', 'hr', 'table']],
                    ['view', ['fullscreen', 'undo', 'redo', 'help', 'codeview']],
                    ['height', ['height']],
                    ['mybutton', ['myCustomButton']]
                ];

                // Khởi tạo Summernote cho textarea chính
                $('#content').summernote({
                    height: 400,
                    lang: 'vi-VN',
                    placeholder: 'Nhập nội dung tin tức...',
                    toolbar: customToolbar,
                    popover: {
                        image: [
                            ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                            ['float', ['floatLeft', 'floatRight', 'floatNone']],
                            ['remove', ['removeMedia']],
                            ['custom', ['imageTitle', 'imageCaption']]
                        ],
                        link: [
                            ['link', ['linkDialogShow', 'unlink']]
                        ],
                        table: [
                            ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                            ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                            ['custom', ['tableStyle']]
                        ],
                        air: [
                            ['color', ['color']],
                            ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                            ['para', ['ul', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture']]
                        ]
                    },
                    callbacks: {
                        onImageUpload: function(files) {
                            for (let i = 0; i < files.length; i++) {
                                uploadImage(files[i]);
                            }
                        },
                        onPaste: function(e) {
                            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData)
                                .getData('text/html');
                            if (bufferText) {
                                e.preventDefault();
                                document.execCommand('insertHTML', false, bufferText);
                            }
                        }
                    },
                    codeviewFilter: true,
                    codeviewIframeFilter: true
                });

                // Khởi tạo Summernote cho modal fullscreen
                $('#content_fullscreen').summernote({
                    height: 500,
                    lang: 'vi-VN',
                    placeholder: 'Nhập nội dung tin tức...',
                    toolbar: customToolbar,
                    popover: {
                        image: [
                            ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                            ['float', ['floatLeft', 'floatRight', 'floatNone']],
                            ['remove', ['removeMedia']],
                            ['custom', ['imageTitle', 'imageCaption']]
                        ],
                        link: [
                            ['link', ['linkDialogShow', 'unlink']]
                        ],
                        table: [
                            ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                            ['delete', ['deleteRow', 'deleteCol', 'deleteTable']],
                            ['custom', ['tableStyle']]
                        ],
                        air: [
                            ['color', ['color']],
                            ['font', ['bold', 'italic', 'underline', 'strikethrough']],
                            ['para', ['ul', 'paragraph']],
                            ['table', ['table']],
                            ['insert', ['link', 'picture']]
                        ]
                    },
                    callbacks: {
                        onImageUpload: function(files) {
                            for (let i = 0; i < files.length; i++) {
                                uploadImage(files[i], true);
                            }
                        },
                        onPaste: function(e) {
                            var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData)
                                .getData('text/html');
                            if (bufferText) {
                                e.preventDefault();
                                document.execCommand('insertHTML', false, bufferText);
                            }
                        }
                    },
                    codeviewFilter: true,
                    codeviewIframeFilter: true
                });

                // Khi mở modal → đồng bộ nội dung
                $('#fullscreenEditorModal').on('show.bs.modal', function() {
                    const mainContent = $('#content').summernote('code');
                    $('#content_fullscreen').summernote('code', mainContent);
                });

                // Khi bấm Lưu → copy ngược về form
                $('#saveFullscreenContent').click(function() {
                    const fullscreenContent = $('#content_fullscreen').summernote('code');
                    $('#content').summernote('code', fullscreenContent);
                    $('#fullscreenEditorModal').modal('hide');
                });

                // Custom button functionality
                $('.note-toolbar').on('click', '.btn[data-event="myCustomButton"]', function() {
                    alert('Custom button clicked!');
                });
            });

            // Hàm upload ảnh
            function uploadImage(file, isFullscreen = false) {
                const formData = new FormData();
                formData.append('image', file);

                $.ajax({
                    url: '{{ route('admin.news.upload-image') }}',
                    method: 'POST',
                    data: formData,
                    processData: false,
                    contentType: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        if (response.success) {
                            const imageUrl = response.url;
                            if (isFullscreen) {
                                $('#content_fullscreen').summernote('insertImage', imageUrl);
                            } else {
                                $('#content').summernote('insertImage', imageUrl);
                            }
                        } else {
                            alert('Upload ảnh thất bại: ' + response.message);
                        }
                    },
                    error: function() {
                        alert('Có lỗi xảy ra khi upload ảnh');
                    }
                });
            }

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
                                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]')
                                            .getAttribute('content'),
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
