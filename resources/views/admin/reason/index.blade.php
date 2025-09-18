@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Danh sách Lí do</h1>

    <a href="{{ route('admin.reason.create') }}" class="btn btn-primary mb-3">Thêm mới</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Tiêu đề</th>
                <th>Thứ tự</th>
                <th>Trang</th>
                <th>Dịch vụ</th>
                <th>Nơi hiển thị</th>
                <th>Số ảnh</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($process as $item)
                <tr>
                    <td>{{ $item->title }}</td>
                    <td>{{ $item->order }}</td>
                    <td>{{ $item->page }}</td>
                    <td>{{ $item->service ? $item->service->name : '' }}</td>
                    <td>{{ $item->section == 'quy_trình' ? 'Quy trình' : 'Lí do' }}</td>
                    <td>{{ $item->processImages->count() }}</td>
                    <td>
                        <a href="{{ route('admin.reason.show', $item->id) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('admin.reason.edit', $item->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.reason.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
