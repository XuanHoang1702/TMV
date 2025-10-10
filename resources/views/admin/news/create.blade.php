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
                            <label for="slug" class="form-label">Đường dẫn <span class="text-danger">*</span></label>
                            <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug"
                                name="slug" value="{{ old('slug') }}" required>
                            @error('slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <div class="form-text">đường dẫn sẽ được sử dụng trong URL</div>
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
                            <textarea class="form-control summernote @error('content') is-invalid @enderror" id="content" name="content" rows="10">{{ old('content') }}</textarea>
                            @error('content')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror

                        </div>

                        <!-- Modal Fullscreen -->

                        @push('styles')
                            {{-- Summernote 0.9.0 với Bootstrap 4 --}}
                            <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.css" rel="stylesheet">

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
                                /* Custom Word-like styling */
                                .note-editable {
                                    line-height: 1.6;
                                }
                                .note-editable h1, .note-editable h2, .note-editable h3 {
                                    margin-top: 1em;
                                    margin-bottom: 0.5em;
                                    font-weight: bold;
                                }
                                .note-editable p {
                                    margin-bottom: 1em;
                                }
                                .note-editable ul, .note-editable ol {
                                    margin-bottom: 1em;
                                    padding-left: 2em;
                                }
                                .note-editable table {
                                    border-collapse: collapse;
                                    width: 100%;
                                    margin-bottom: 1em;
                                }
                                .note-editable table td, .note-editable table th {
                                    border: 1px solid #ddd;
                                    padding: 8px;
                                }
                                /* Loading overlay cho upload */
                                .note-editor.uploading .note-editable {
                                    opacity: 0.6;
                                    position: relative;
                                }
                                .note-editor.uploading::after {
                                    content: 'Đang tải ảnh...';
                                    position: absolute;
                                    top: 50%;
                                    left: 50%;
                                    transform: translate(-50%, -50%);
                                    background: rgba(0,0,0,0.7);
                                    color: white;
                                    padding: 10px 20px;
                                    border-radius: 5px;
                                    z-index: 1000;
                                }
                                /* Modal fullscreen adjustments */
                                .modal-fullscreen .modal-body {
                                    padding: 0;
                                }
                                .modal-fullscreen .note-editor {
                                    margin: 0;
                                    border: none;
                                    border-radius: 0;
                                }
                            </style>
                        @endpush

                        @push('scripts')
                            {{-- jQuery và Bootstrap 4 --}}
                            <script src="https://code.jquery.com/jquery-3.5.1.min.js" crossorigin="anonymous"></script>
                            <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
                            <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>

                            {{-- Summernote 0.9.0 --}}
                            <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote-bs4.min.js"></script>

                            {{-- Language tiếng Việt (cần cập nhật cho v0.9.0) --}}
                            <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/lang/summernote-vi-VN.min.js"></script>

                            <script>
                                $(document).ready(function() {
                                    // Cấu hình toolbar tùy chỉnh cho Summernote 0.9.0
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
                                        ['height', ['height']]
                                    ];

                                    // Hàm khởi tạo Summernote với focus management (tương thích v0.9.0)
                                    function initSummernote(selector, isFullscreen = false) {
                                        const $editor = $(selector);

                                        $editor.summernote({
                                            height: isFullscreen ? 600 : 400,
                                            minHeight: isFullscreen ? 500 : 200,
                                            lang: 'vi-VN',
                                            placeholder: 'Nhập nội dung tin tức...',
                                            tabsize: 2,
                                            toolbar: customToolbar,
                                            popover: {
                                                image: [
                                                    ['image', ['resizeFull', 'resizeHalf', 'resizeQuarter', 'resizeNone']],
                                                    ['float', ['floatLeft', 'floatRight', 'floatNone']],
                                                    ['remove', ['removeMedia']]
                                                ],
                                                link: [
                                                    ['link', ['linkDialogShow', 'linkDialogShow', 'unlink']]
                                                ],
                                                table: [
                                                    ['add', ['addRowDown', 'addRowUp', 'addColLeft', 'addColRight']],
                                                    ['delete', ['deleteRow', 'deleteCol', 'deleteTable']]
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
                                                        uploadImage(files[i], isFullscreen, $editor);
                                                    }
                                                },
                                                onPaste: function (e) {
                                                    var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('text/html');
                                                    if (bufferText) {
                                                        e.preventDefault();
                                                        document.execCommand('insertHTML', false, bufferText);
                                                    }
                                                },
                                                onInit: function() {
                                                    console.log('Summernote initialized');
                                                    // Đảm bảo focus được duy trì khi init
                                                    if (!isFullscreen) {
                                                        setTimeout(function() {
                                                            $editor.summernote('focus');
                                                        }, 100);
                                                    }
                                                },
                                                onChange: function(contents, $editable) {
                                                    // Lưu range để khôi phục khi cần
                                                    if (window.currentRange) {
                                                        window.currentRange = null;
                                                    }
                                                },
                                                onFocus: function() {
                                                    window.currentEditor = selector;
                                                    console.log('Editor focused:', selector);
                                                }
                                            },
                                            // Cấu hình XSS protection cho v0.9.0
                                            codeviewFilter: true,
                                            codeviewIframeFilter: true,
                                            // Disable drag and drop nếu cần
                                            disableDragAndDrop: false,
                                            // Dialogs in body cho modal
                                            dialogsInBody: true,
                                            // Font settings
                                            fontNames: [
                                                'Arial', 'Arial Black', 'Comic Sans MS', 'Courier New',
                                                'Helvetica', 'Impact', 'Tahoma', 'Times New Roman', 'Verdana'
                                            ],
                                            // Line heights
                                            lineHeights: ['0.6', '0.8', '1.0', '1.2', '1.4', '1.5', '1.6', '2.0'],
                                            // Style tags
                                            styleTags: ['p', 'blockquote', 'pre', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6']
                                        });

                                        // Event handlers cho focus và range management
                                        $editor.closest('.note-editor').on('dragover dragenter', function(e) {
                                            // Lưu range khi drag
                                            window.currentRange = $editor.summernote('createRange');
                                        });

                                        $editor.on('click focus', function() {
                                            window.currentEditor = selector;
                                        });
                                    }

                                    // Khởi tạo cho textarea chính
                                    initSummernote('#content');

                                    // Khởi tạo cho modal fullscreen
                                    initSummernote('#content_fullscreen', true);

                                    // Xử lý modal fullscreen (Bootstrap 4 syntax)
                                    $('#fullscreenEditorModal').on('show.bs.modal', function() {
                                        // Đồng bộ nội dung từ editor chính
                                        const mainContent = $('#content').summernote('code');
                                        $('#content_fullscreen').summernote('code', mainContent);

                                        // Delay để đảm bảo modal đã render xong
                                        setTimeout(function() {
                                            $('#content_fullscreen').summernote('focus');
                                            window.currentEditor = '#content_fullscreen';
                                        }, 200);
                                    });

                                    // Khi đóng modal
                                    $('#fullscreenEditorModal').on('hidden.bs.modal', function() {
                                        $('#content').summernote('focus');
                                        window.currentEditor = '#content';
                                    });

                                    // Khi bấm Lưu → copy ngược về form
                                    $('#saveFullscreenContent').click(function() {
                                        const fullscreenContent = $('#content_fullscreen').summernote('code');
                                        $('#content').summernote('code', fullscreenContent);
                                        $('#fullscreenEditorModal').modal('hide');

                                        // Focus về editor chính
                                        setTimeout(function() {
                                            $('#content').summernote('focus');
                                            window.currentEditor = '#content';
                                        }, 300);
                                    });

                                    // Global focus tracking
                                    $(document).on('click', function(e) {
                                        if ($(e.target).closest('.note-editor').length > 0) {
                                            const editorId = $(e.target).closest('.note-editor').find('textarea').attr('id');
                                            if (editorId) {
                                                window.currentEditor = '#' + editorId;
                                            }
                                        }
                                    });

                                    // Custom buttons nếu cần (cho v0.9.0)
                                    $.extend($.summernote.plugins, {
                                        'myCustomButton': function(context) {
                                            var ui = $.summernote.ui;
                                            var button = ui.button({
                                                contents: '<i class="fa fa-star"></i> Custom',
                                                tooltip: 'Custom Button',
                                                click: function() {
                                                    alert('Custom button clicked in Summernote 0.9.0!');
                                                    // Insert custom content
                                                    context.invoke('editor.insertText', '⭐ Custom Content ⭐');
                                                }
                                            });
                                            return button.render();
                                        }
                                    });

                                    // Thêm custom button vào toolbar nếu muốn
                                    // ['mybutton', ['myCustomButton']]
                                });

                                // Hàm upload ảnh được cải tiến cho v0.9.0
                                function uploadImage(file, isFullscreen = false, $editor) {
                                    const editorId = window.currentEditor || ($editor ? $editor.attr('id') : '#content');
                                    const $targetEditor = $(editorId);

                                    // Lưu range hiện tại trước khi upload (v0.9.0 API)
                                    const currentRange = $targetEditor.summernote('createRange');
                                    window.currentRange = currentRange;

                                    // Hiển thị loading
                                    $targetEditor.closest('.note-editor').addClass('uploading');

                                    const formData = new FormData();
                                    formData.append('image', file);

                                    $.ajax({
                                        url: '{{ route("admin.news.upload-image") }}',
                                        method: 'POST',
                                        data: formData,
                                        processData: false,
                                        contentType: false,
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                        success: function(response) {
                                            $targetEditor.closest('.note-editor').removeClass('uploading');

                                            if (response.success) {
                                                const imageUrl = response.url;

                                                // Khôi phục range và insert ảnh tại vị trí đúng (v0.9.0 API)
                                                if (window.currentRange && !window.currentRange.isCollapsed()) {
                                                    // Nếu có selection, insert tại selection
                                                    window.currentRange.select();
                                                    $targetEditor.summernote('editor.insertImage', imageUrl);
                                                } else {
                                                    // Insert tại cursor position
                                                    $targetEditor.summernote('insertImage', imageUrl);
                                                }

                                                // Clear range sau khi insert
                                                window.currentRange = null;

                                                // Đảm bảo focus được duy trì
                                                setTimeout(function() {
                                                    $targetEditor.summernote('focus');
                                                }, 50);

                                                // Notification thành công
                                                showNotification('Ảnh đã được tải lên thành công!', 'success');

                                            } else {
                                                showNotification('Upload ảnh thất bại: ' + response.message, 'error');
                                            }
                                        },
                                        error: function(xhr, status, error) {
                                            $targetEditor.closest('.note-editor').removeClass('uploading');
                                            showNotification('Có lỗi xảy ra khi upload ảnh: ' + error, 'error');
                                        }
                                    });
                                }

                                // Hàm helper để hiển thị notification (tương thích Bootstrap 4)
                                function showNotification(message, type = 'info') {
                                    const alertClass = type === 'success' ? 'alert-success' :
                                                     type === 'error' ? 'alert-danger' : 'alert-info';

                                    const notification = `
                                        <div class="alert ${alertClass} alert-dismissible fade show position-fixed"
                                             style="top: 20px; right: 20px; z-index: 9999; min-width: 300px;">
                                            ${message}
                                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                    `;

                                    $('body').append(notification);

                                    // Auto remove sau 5 giây
                                    setTimeout(function() {
                                        $('.alert').fadeOut(function() {
                                            $(this).remove();
                                        });
                                    }, 5000);
                                }

                                // Hàm helper để khôi phục focus và range
                                function restoreEditorFocus(selector) {
                                    const $editor = $(selector);
                                    if ($editor.summernote) {
                                        setTimeout(function() {
                                            if (window.currentRange) {
                                                window.currentRange.select();
                                            }
                                            $editor.summernote('focus');
                                        }, 100);
                                    }
                                }

                                // API usage examples (v0.9.0)
                                // Ví dụ: Bold text bằng API
                                // $('#content').summernote('bold');
                                // $('#content').summernote('editor.insertText', 'Hello World');
                                // $('#content').summernote('editor.createLink', { text: 'Link', url: 'https://example.com' });
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
