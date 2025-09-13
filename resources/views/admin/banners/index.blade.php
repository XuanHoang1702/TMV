@extends('layouts.admin')

@section('title', 'Quản lý Banner')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Danh sách Banner</h1>
    <a href="{{ route('admin.banners.create') }}" class="btn btn-primary">Thêm banner mới</a>
</div>



<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Tiêu đề</th>
            <th>Hình ảnh</th>
            <th>Liên kết</th>
            <th>Thứ tự</th>
            <th>Trạng thái</th>
            <th>Section</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody>
        @forelse($banners as $banner)
        <tr>
            <td>{{ $banner->id }}</td>
            <td>{{ $banner->title }}</td>
<td><img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" style="width: 100px;"></td>
            <td>{{ $banner->link }}</td>
            <td>{{ $banner->order }}</td>
            <td>
                @if($banner->is_active)
                    <span class="badge bg-success">Kích hoạt</span>
                @else
                    <span class="badge bg-secondary">Không kích hoạt</span>
                @endif
            </td>
            <td>{{ $banner->section }}</td>
            <td>
                <a href="{{ route('admin.banners.show', $banner) }}" class="btn btn-sm btn-info">Xem</a>
                <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('admin.banners.destroy', $banner) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa banner này?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="8" class="text-center">Không có banner nào.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
