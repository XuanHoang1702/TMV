@extends('layouts.admin')

@section('title', 'Quản lý Tin tức')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Danh sách Tin tức</h1>
    <a href="{{ route('admin.news.create') }}" class="btn btn-primary">Thêm tin tức mới</a>
</div>

@if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
@endif

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($news as $item)
        <tr>
            <td>{{ $item->id }}</td>
            <td>{{ $item->title }}</td>
            <td>
                @if($item->is_published)
                    <span class="badge bg-success">Đã xuất bản</span>
                @else
                    <span class="badge bg-secondary">Chưa xuất bản</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.news.edit', $item) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('admin.news.destroy', $item) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa tin tức này?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4" class="text-center">Không có tin tức nào.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $news->links() }}
@endsection
