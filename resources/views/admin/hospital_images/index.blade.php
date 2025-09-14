@extends('layouts.admin')

@section('title', 'Quản lý Ảnh Bệnh viện')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Danh sách Ảnh Bệnh viện</h1>
        @if ($total = 5)
            <a href="{{ route('admin.hospital_images.create') }}" class="btn btn-primary">Thêm ảnh mới</a>
        @endif
    </div>

    @if (session('warning'))
        <div class="alert alert-warning">{{ session('warning') }}</div>
    @endif

    @if ($images->isNotEmpty())
        <h3 class="bg-primary text-white p-2 rounded">{{ $images->first()->title }}</h3>
    @endif

    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($images as $image)
                <tr>
                    <td>{{ $image->id }}</td>
                    <td><img src="{{ asset('storage/' . $image->image) }}" alt="Hospital Image" style="width: 150px;"></td>
                    <td>
                        <a href="{{ route('admin.hospital_images.edit', $image) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.hospital_images.destroy', $image) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Bạn có chắc muốn xóa ảnh này?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center">Không có ảnh nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
@endsection
