@extends('layouts.admin')

@section('title', 'Quản lý Dịch vụ')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Danh sách Dịch vụ</h1>
        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">Thêm dịch vụ mới</a>
    </div>



    <table class="table table-bordered table-hover">
        <thead class="table-light">
            <tr>
                <th>ID</th>
                <th>Tên dịch vụ</th>
                <th>Danh mục</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @forelse($services as $service)
                <tr>
                    <td>{{ $service->id }}</td>
                    <td>{{ $service->name }}</td>
                    <td>{{ $service->category_id ? $service->category->name : $service->category }}</td>
                    <td>
                        @if ($service->is_active)
                            <span class="badge bg-success">Kích hoạt</span>
                        @else
                            <span class="badge bg-secondary">Không kích hoạt</span>
                        @endif
                    </td>
                    <td>
                        <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.services.destroy', $service) }}" method="POST" class="d-inline"
                            onsubmit="return confirm('Bạn có chắc muốn xóa dịch vụ này?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5" class="text-center">Không có dịch vụ nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    {{ $services->links() }}
@endsection
