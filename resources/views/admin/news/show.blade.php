@extends('layouts.admin')

@section('title', $news->title)

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>{{ $news->title }}</h1>
        <div>
            <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-warning mr-2">
                <i class="fas fa-edit"></i> Sửa
            </a>
            <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-md-8">
            <div class="card">

                <div class="card-body">
                    <!-- Thông tin chi tiết -->
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-folder text-primary"></i> Danh mục:</strong>
                                @if ($news->category)
                                    <a href="{{ route('admin.categories.show', $news->category) }}"
                                        class="text-decoration-none">
                                        {{ $news->category->name }}
                                    </a>
                                @else
                                    <span class="text-muted">Không có danh mục</span>
                                @endif
                            </p>
                        </div>
                        <div class="col-md-6">
                            <p><strong><i class="fas fa-calendar text-primary"></i> Ngày xuất bản:</strong>
                                @if ($news->published_at)
                                    <span class="badge badge-success text-black">{{ $news->published_at->format('H:i, d/m/Y') }}</span>
                                @else
                                    <span class="badge badge-secondary">Bản nháp</span>
                                @endif
                            </p>
                        </div>
                    </div>

                    @if ($news->summary)
                        <div class="mb-4 p-3 bg-light rounded">
                            <h6 class="mb-2"><i class="fas fa-align-left text-primary"></i> Tóm tắt:</h6>
                            <p class="mb-0 text-muted">{{ $news->summary }}</p>
                        </div>
                    @endif

                    <!-- Nội dung chính -->
                    <div class="content-preview">
                        <h6 class="mb-3"><i class="fas fa-file-alt text-primary"></i> Nội dung:</h6>
                        <div class="news-content">
                            {!! $news->content !!}
                        </div>
                    </div>

                    <!-- Hình ảnh chính -->
                    @if ($news->images && count($news->images) > 0)
                        <div class="mt-4">
                            <h6 class="mb-3"><i class="fas fa-images text-primary"></i> Hình ảnh:</h6>
                            <div class="row">
                                @foreach ($news->images as $index => $imagePath)
                                    <div class="col-md-4 col-sm-6 mb-3">
                                        <div class="position-relative">
                                            <img src="{{ Storage::url($imagePath) }}" class="img-fluid rounded border"
                                                alt="Hình ảnh {{ $index + 1 }}"
                                                style="height: 200px; object-fit: cover;">
                                            <small class="text-muted d-block mt-1">{{ $index + 1 }}</small>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <!-- Meta information -->
                    @if ($news->meta_title || $news->meta_description)
                        <div class="mt-4 p-3 bg-light rounded">
                            <h6 class="mb-3"><i class="fas fa-info-circle text-primary"></i> Meta thông tin:</h6>
                            @if ($news->meta_title)
                                <p class="mb-2"><strong>Meta Title:</strong> {{ $news->meta_title }}</p>
                            @endif
                            @if ($news->meta_description)
                                <p class="mb-0"><strong>Meta Description:</strong> {{ $news->meta_description }}</p>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <!-- Sidebar với thông tin nhanh -->
            <div class="card mb-3">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="fas fa-info"></i> Thông tin nhanh</h6>
                </div>
                <div class="card-body">
                    <ul class="list-unstyled">
                        <li class="mb-2">
                            <strong>ID:</strong> <span class="text-muted">#{{ $news->id }}</span>
                        </li>
                        <li class="mb-2">
                            <strong>Slug:</strong> <span class="text-muted">{{ $news->slug }}</span>
                        </li>
                        <li class="mb-2 text-black">
                            <strong>Trạng thái:</strong>
                            @if ($news->is_active)
                                <span class="badge badge-success text-black">Đã kích hoạt</span>
                            @else
                                <span class="badge badge-warning text-black">Chờ duyệt</span>
                            @endif
                        </li>
                        <li class="mb-2 text-black">

                            <strong>Nổi bật:</strong>
                            @if ($news->is_featured)
                                <span class="badge badge-primary text-black">Có</span>
                            @else
                                <span class="badge badge-secondary text-black">Không</span>
                            @endif
                        </li>

                        <li class="mb-2">
                            <strong>Tạo lúc:</strong><span class="text-muted">{{ optional($news->created_at)->format('d/m/Y H:i') }}</span>
                        </li>
                        <li class="mb-2">
                            <strong>Cập nhật:</strong> <span class="text-muted">{{ optional($news->updated_at)->format('d/m/Y H:i') }}</span>
                        </li>
                    </ul>
                </div>
            </div>


        </div>
    </div>

    <!-- Bài viết liên quan -->
    @if ($relatedNews && count($relatedNews) > 0)
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h3><i class="fas fa-link text-primary"></i> Bài viết liên quan</h3>
                <span class="badge badge-info">{{ count($relatedNews) }} bài</span>
            </div>

            <div class="row">
                @foreach ($relatedNews as $item)
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm hover-card">
                            @if ($item->images && count($item->images) > 0)
                                <div class="position-relative">
                                    <img src="{{ Storage::url($item->images[0]) }}" class="card-img-top"
                                        alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                                    @if ($item->is_featured)
                                        <span class="position-absolute top-0 right-0 badge badge-danger m-2">Nổi bật</span>
                                    @endif
                                </div>
                            @endif
                            <div class="card-body d-flex flex-column">
                                <h6 class="card-title font-weight-bold mb-2">
                                    <a href="{{ route('admin.news.show', $item->slug) }}"
                                        class="text-dark text-decoration-none">
                                        {{ Str::limit($item->title, 50) }}
                                    </a>
                                </h6>
                                @if ($item->category)
                                    <small class="text-muted mb-2">
                                        <i class="fas fa-folder"></i> {{ $item->category->name }}
                                    </small>
                                @endif
                                <p class="card-text flex-grow-1 text-muted small">
                                    {{ Str::limit($item->summary ?: strip_tags($item->content), 100) }}
                                </p>
                                <div class="mt-auto">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <small class="text-muted">
                                            <i class="fas fa-clock"></i> {{ $item->published_at->format('d/m/Y') }}
                                        </small>
                                        <a href="{{ route('admin.news.show', $item) }}"
                                            class="btn btn-outline-primary btn-sm">
                                            <i class="fas fa-eye"></i> Xem
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div class="mt-5">
            <div class="alert alert-info">
                <i class="fas fa-info-circle"></i>
                Không có bài viết liên quan.
                <a href="{{ route('admin.news.edit', $news) }}">Thêm liên kết</a> trong phần chỉnh sửa.
            </div>
        </div>
    @endif

    @push('styles')
        <style>
            .news-content {
                line-height: 1.7;
                font-size: 1.1em;
            }

            .news-content img {
                max-width: 100%;
                height: auto;
                border-radius: 0.375rem;
                margin: 1rem 0;
            }

            .news-content h1,
            .news-content h2,
            .news-content h3 {
                color: #2c3e50;
                margin-top: 2rem;
                margin-bottom: 1rem;
            }

            .news-content p {
                margin-bottom: 1rem;
            }

            .news-content ul,
            .news-content ol {
                margin-bottom: 1rem;
                padding-left: 2rem;
            }

            .hover-card {
                transition: all 0.3s ease;
            }

            .hover-card:hover {
                transform: translateY(-2px);
                box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1) !important;
            }

            .content-preview {
                border-left: 4px solid #007bff;
                padding-left: 15px;
                background: #f8f9fa;
                border-radius: 0.375rem;
                padding: 20px;
            }
        </style>
    @endpush
@endsection
