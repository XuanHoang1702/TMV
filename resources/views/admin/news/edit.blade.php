@extends('layouts.admin')

@section('title', 'Sửa tin tức')

@push('styles')
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" rel="stylesheet">
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

        .related-news-container {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 0.375rem;
            padding: 1rem;
            min-height: 100px;
        }

        .related-news-item {
            display: flex;
            align-items: center;
            background: #fff;
            border: 1px solid #dee2e6;
            border-radius: 0.25rem;
            padding: 0.75rem;
            margin-bottom: 0.5rem;
            box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
            cursor: move;
        }

        .related-news-item:hover {
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.15);
        }

        .related-news-item img {
            width: 50px;
            height: 50px;
            object-fit: cover;
            border-radius: 0.25rem;
            margin-right: 1rem;
        }

        .related-news-item .details {
            flex-grow: 1;
        }

        .related-news-item .title {
            font-weight: 600;
            color: #495057;
            margin-bottom: 0.25rem;
        }

        .related-news-item .date {
            color: #6c757d;
            font-size: 0.875rem;
        }

        .related-news-item .remove-btn {
            color: #dc3545;
            font-size: 1rem;
            cursor: pointer;
        }

        .related-news-item .remove-btn:hover {
            color: #bd2130;
        }

        .add-related-btn {
            background-color: #007bff;
            color: white;
            border-radius: 0.375rem;
            padding: 0.5rem 1rem;
            font-size: 0.875rem;
        }

        .add-related-btn:hover {
            background-color: #0056b3;
        }

        .modal-content {
            border-radius: 0.375rem;
        }

        .modal-header {
            background: #f8f9fa;
            border-bottom: 1px solid #dee2e6;
        }

        .modal-body .search-input {
            border: 2px solid #007bff;
            border-radius: 0.375rem;
            padding: 0.5rem;
            width: 100%;
            margin-bottom: 1rem;
        }

        .modal-body .news-option {
            display: flex;
            align-items: center;
            padding: 0.75rem;
            border-bottom: 1px solid #dee2e6;
            cursor: pointer;
        }

        .modal-body .news-option:hover {
            background: #e9ecef;
        }

        .modal-body .news-option img {
            width: 40px;
            height: 40px;
            object-fit: cover;
            border-radius: 0.25rem;
            margin-right: 1rem;
        }

        .modal-body .news-option .title {
            font-weight: 600;
            color: #495057;
        }

        .modal-body .news-option .date {
            color: #6c757d;
            font-size: 0.875rem;
        }

        .form-check-input:checked {
            background-color: #007bff;
            border-color: #007bff;
        }
    </style>
@endpush

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>📝 Sửa tin tức</h1>
        <div>
            <a href="{{ route('admin.news.show', $news->slug) }}" class="btn btn-info"><i class="fas fa-eye"></i> Xem</a>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary"><i class="fas fa-arrow-left"></i> Quay lại</a>
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
            <h5 class="mb-0"><i class="fas fa-newspaper me-2 text-primary"></i>Thông tin Tin tức</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.news.update', $news->slug) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <div class="row">
                    <div class="col-md-8">
                        <div class="form-group">
                            <label for="title" class="form-label">📌 Tiêu đề <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title"
                                name="title" value="{{ old('title', $news->title) }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="slug" class="form-label">🔗 Đường dẫn <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug', $news->slug) }}" required>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Đường dẫn sẽ được sử dụng trong URL</small>
                        </div>

                        <div class="form-group">
                            <label for="summary" class="form-label">📄 Tóm tắt</label>
                            <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" rows="3">{{ old('summary', $news->summary) }}</textarea>
                            @error('summary')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="content" class="form-label">📑 Nội dung <span class="text-danger">*</span></label>
                            <textarea class="form-control summernote @error('content') is-invalid @enderror" id="content" name="content"
                                rows="10">{{ old('content', $news->content) }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Related News Section -->
                        <div class="form-group">
                            <label class="form-label">📰 Bài viết liên quan</label>
                            <div class="related-news-container" id="related-news-container">
                                @php
                                    $selectedRelated = [];
                                    if (is_string($news->related_news)) {
                                        $selectedRelated = json_decode($news->related_news, true) ?? [];
                                    } elseif (is_array($news->related_news)) {
                                        $selectedRelated = $news->related_news;
                                    } else {
                                        $selectedRelated = json_decode(json_encode($news->related_news), true) ?? [];
                                    }
                                    $selectedRelated = is_array($selectedRelated) ? $selectedRelated : [];
                                    $relatedNews = \App\Models\News::whereIn('id', $selectedRelated)
                                        ->where('is_active', true)
                                        ->whereNotNull('published_at')
                                        ->get();
                                @endphp
                                @foreach ($relatedNews as $related)
                                    <div class="related-news-item" data-id="{{ $related->id }}">
                                        @if ($related->images && count($related->images) > 0)
                                            <img src="{{ Storage::url($related->images[0]) }}"
                                                alt="{{ $related->title }}">
                                        @else
                                            <img src="https://via.placeholder.com/50" alt="No image">
                                        @endif
                                        <div class="details">
                                            <div class="title">{{ $related->title }}</div>
                                            <div class="date">{{ $related->published_at->format('d/m/Y') }}</div>
                                        </div>
                                        <i class="fas fa-times remove-btn"></i>
                                    </div>
                                @endforeach
                            </div>
                            <input type="hidden" id="related-news-input" name="related_news"
                                value="{{ json_encode($selectedRelated) }}">

                            <button type="button" class="btn add-related-btn mt-2" data-toggle="modal"
                                data-target="#relatedNewsModal">
                                <i class="fas fa-plus me-1"></i>Thêm bài viết liên quan
                            </button>
                            <small class="form-text text-muted">Kéo và thả để sắp xếp thứ tự. Nếu không chọn, hệ thống sẽ tự
                                động hiển thị bài viết cùng chuyên mục.</small>
                        </div>

                        <!-- Related News Modal -->
                        <div class="modal fade" id="relatedNewsModal" tabindex="-1" role="dialog"
                            aria-labelledby="relatedNewsModalLabel" aria-hidden="true">
                            <div class="modal-dialog modal-lg" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="relatedNewsModalLabel"><i
                                                class="fas fa-newspaper me-2"></i>Chọn bài viết liên quan</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <input type="text" class="search-input" id="related-news-search"
                                            placeholder="Tìm kiếm bài viết...">
                                        <div id="news-options">
                                            @foreach (\App\Models\News::where('is_active', true)->whereNotNull('published_at')->where('id', '!=', $news->id)->orderBy('published_at', 'desc')->get() as $option)
                                                <div class="news-option" data-id="{{ $option->id }}">
                                                    @if ($option->images && count($option->images) > 0)
                                                        <img src="{{ Storage::url($option->images[0]) }}"
                                                            alt="{{ $option->title }}">
                                                    @else
                                                        <img src="https://via.placeholder.com/40" alt="No image">
                                                    @endif
                                                    <div>
                                                        <div class="title">{{ $option->title }}</div>
                                                        <div class="date">{{ $option->published_at->format('d/m/Y') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-dismiss="modal">Đóng</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4">
                        <div class="form-group">
                            <label for="category_id" class="form-label">📚 Danh mục <span
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
                            <label class="form-label">🖼️ Hình ảnh hiện tại</label>
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
                            <label class="form-label">📸 Thêm ảnh mới</label>
                            <div id="images-container">
                                <div class="image-item mb-3 border p-3">
                                    <h6>Ảnh mới 1</h6>
                                    <input type="file" name="images[]" class="form-control" accept="image/*">
                                    <button type="button" class="btn btn-danger btn-sm remove-image mt-2">Xóa</button>
                                </div>
                            </div>

                        </div>

                        <div class="mb-3">
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_featured" name="is_featured"
                                    value="1" {{ old('is_featured', $news->is_featured) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_featured">🌟 Tin nổi bật</label>
                            </div>
                            <div class="form-check">
                                <input type="checkbox" class="form-check-input" id="is_active" name="is_active"
                                    value="1" {{ old('is_active', $news->is_active) ? 'checked' : '' }}>
                                <label class="form-check-label" for="is_active">✅ Kích hoạt</label>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="published_at" class="form-label">📅 Ngày xuất bản</label>
                            <input type="datetime-local" class="form-control" id="published_at" name="published_at"
                                value="{{ old('published_at', $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '') }}">
                        </div>

                        <div class="mb-3">
                            <label for="meta_title" class="form-label">🔍 Meta SEO Title</label>
                            <input type="text" class="form-control" id="meta_title" name="meta_title"
                                value="{{ old('meta_title', $news->meta_title) }}">
                        </div>

                        <div class="mb-3">
                            <label for="meta_description" class="form-label">📜 Meta SEO Description</label>
                            <textarea class="form-control" id="meta_description" name="meta_description" rows="3">{{ old('meta_description', $news->meta_description) }}</textarea>
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end">
                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> 💾 Cập nhật tin tức
                    </button>
                </div>
            </form>
        </div>
    </div>

    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/lang/summernote-vi-VN.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"></script>

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

            $(document).ready(function() {
                // Initialize Summernote
                $('#content').summernote({
                    height: 400,
                    lang: 'vi-VN',
                    placeholder: 'Nhập nội dung tin tức...',
                    toolbar: [
                        ['style', ['style']],
                        ['font', ['bold', 'italic', 'underline', 'strikethrough', 'superscript',
                            'subscript', 'clear'
                        ]],
                        ['fontname', ['fontname']],
                        ['fontsize', ['fontsize']],
                        ['color', ['color']],
                        ['para', ['ul', 'ol', 'paragraph', 'lineheight']],
                        ['table', ['table']],
                        ['insert', ['link', 'picture', 'video', 'hr', 'table']],
                        ['view', ['fullscreen', 'undo', 'redo', 'help', 'codeview']],
                        ['height', ['height']],
                    ],
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

                // Initialize SortableJS for related news
                const relatedNewsContainer = document.getElementById('related-news-container');
                new Sortable(relatedNewsContainer, {
                    animation: 150,
                    handle: '.related-news-item',
                    onEnd: function() {
                        updateRelatedNewsInput();
                    }
                });

                // Update hidden input with selected news IDs
                function updateRelatedNewsInput() {
                    const items = relatedNewsContainer.querySelectorAll('.related-news-item');
                    const selectedIds = Array.from(items).map(item => item.dataset.id);
                    document.getElementById('related-news-input').value = JSON.stringify(selectedIds);
                }

                // Handle adding related news from modal
                $('#relatedNewsModal').on('show.bs.modal', function() {
                    const selectedIds = JSON.parse(document.getElementById('related-news-input').value || '[]');
                    const options = document.querySelectorAll('#news-options .news-option');
                    options.forEach(option => {
                        option.style.display = selectedIds.includes(option.dataset.id) ? 'none' :
                        'flex';
                    });
                });

                document.getElementById('related-news-search').addEventListener('input', function() {
                    const query = this.value.toLowerCase();
                    const options = document.querySelectorAll('#news-options .news-option');
                    options.forEach(option => {
                        const title = option.querySelector('.title').textContent.toLowerCase();
                        option.style.display = title.includes(query) ? 'flex' : 'none';
                    });
                });

                document.addEventListener('click', function(e) {
                    if (e.target.closest('.news-option')) {
                        const option = e.target.closest('.news-option');
                        const id = option.dataset.id;
                        const title = option.querySelector('.title').textContent;
                        const date = option.querySelector('.date').textContent;
                        const imgSrc = option.querySelector('img').src;

                        const selectedIds = JSON.parse(document.getElementById('related-news-input').value ||
                            '[]');
                        if (!selectedIds.includes(id)) {
                            const item = document.createElement('div');
                            item.className = 'related-news-item';
                            item.dataset.id = id;
                            item.innerHTML = `
                    <img src="${imgSrc}" alt="${title}">
                    <div class="details">
                        <div class="title">${title}</div>
                        <div class="date">${date}</div>
                    </div>
                    <i class="fas fa-times remove-btn"></i>
                `;
                            relatedNewsContainer.appendChild(item);
                            updateRelatedNewsInput();
                            option.style.display = 'none';
                        }
                    }

                    if (e.target.classList.contains('remove-btn')) {
                        const item = e.target.closest('.related-news-item');
                        item.remove();
                        updateRelatedNewsInput();
                        const id = item.dataset.id;
                        const option = document.querySelector(`#news-options .news-option[data-id="${id}"]`);
                        if (option) option.style.display = 'flex';
                    }

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

                // Add new image input
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

                // Auto-generate slug
                document.getElementById('title').addEventListener('input', function() {
                    const slug = removeVietnameseTones(this.value);
                    document.getElementById('slug').value = slug;
                });

                // Image upload for Summernote
                function uploadImage(file) {
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
                                $('#content').summernote('insertImage', response.url);
                            } else {
                                alert('Upload ảnh thất bại: ' + response.message);
                            }
                        },
                        error: function() {
                            alert('Có lỗi xảy ra khi upload ảnh');
                        }
                    });
                }
            });
        </script>
    @endpush
@endsection
