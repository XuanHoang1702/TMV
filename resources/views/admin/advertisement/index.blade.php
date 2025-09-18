@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Quản lý Quảng cáo</h1>

    <a href="{{ route('admin.advertisement.create') }}" class="btn btn-primary mb-3">Thêm Quảng cáo</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Dịch vụ</th>
                <th>Tiêu đề</th>
                <th>Ảnh</th>
                <th>Link</th>
                <th>Section</th>
                <th>Thứ tự</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($advertisements as $advertisement)
            <tr>
                <td>{{ $advertisement->id }}</td>
                <td>{{ $advertisement->service ? $advertisement->service->name : 'Tất cả' }}</td>
                <td>{{ $advertisement->title }}</td>
                <td>
                    @if($advertisement->image)
                        <img src="{{ asset('storage/' . $advertisement->image) }}" width="100">
                    @endif
                </td>
                <td>{{ $advertisement->link }}</td>
                <td>{{ $advertisement->section }}</td>
                <td>{{ $advertisement->order }}</td>
                <td>{{ $advertisement->is_active ? 'Hoạt động' : 'Không hoạt động' }}</td>
                <td>
                    <a href="{{ route('admin.advertisement.edit', $advertisement->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.advertisement.destroy', $advertisement->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
