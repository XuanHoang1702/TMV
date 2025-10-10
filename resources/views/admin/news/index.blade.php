@extends('layouts.admin')

@section('title', 'Danh sách Tin tức')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Danh sách Tin tức</h1>
        <a href="{{ route('admin.news.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm tin tức
        </a>
    </div>

    <form method="GET" action="{{ route('admin.news.index') }}" class="mb-3">
        <div class="row">
           
            <div class="col-md-3">
                <select name="status" class="form-select">
                    <option value="">Tất cả trạng thái</option>
                    <option value="published" {{ request('status') == 'published' ? 'selected' : '' }}>Đã xuất bản</option>
                    <option value="draft" {{ request('status') == 'draft' ? 'selected' : '' }}>Bản nháp</option>
                </select>
            </div>
            <div class="col-md-2">
                <button type="submit" class="btn btn-primary">Lọc</button>
            </div>
        </div>
    </form>

    <div class="row">
        @foreach ($news as $item)
            <div class="col-md-4">
                <div class="card mb-3">
                    @if ($item->images && count($item->images) > 0)
                        <img src="{{ asset('storage/' . $item->images[0]) }}" class="card-img-top"
                            alt="{{ $item->title }}">
                    @endif
                    <div class="card-body">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text">{{ Str::limit($item->summary, 100) }}</p>
                        <p class="card-text">
                            <small class="text-muted">
                                {{ $item->published_at ? $item->published_at->format('H:i, d/m/Y') : 'Bản nháp' }} |
                                {{ $item->category ? $item->category->name : 'Không có danh mục' }}
                            </small>
                        </p>
                        <div class="d-flex justify-content-between">
                            {{-- Fixed: Use $item (model instance) for route model binding --}}
                            <a href="{{ route('admin.news.show', $item) }}" class="btn btn-primary btn-sm">Xem thêm</a>
                            <div>
                                <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-warning">Sửa</a>

                                {{-- Fixed: Use $item for destroy route --}}
                                <form action="{{ route('admin.news.destroy', $item) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-danger"
                                        onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
                                </form>
                                @if ($item->published_at)
                                    {{-- Fixed: Use $item for unpublish route --}}
                                    <form action="{{ route('admin.news.unpublish', $item) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-secondary">Gỡ xuất bản</button>
                                    </form>
                                @else
                                    {{-- Fixed: Use $item for publish route --}}
                                    <form action="{{ route('admin.news.publish', $item) }}" method="POST"
                                        style="display:inline;">
                                        @csrf
                                        <button type="submit" class="btn btn-sm btn-success">Xuất bản</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center">
        {{ $news->links('pagination::bootstrap-4') }}
    </div>
@endsection
