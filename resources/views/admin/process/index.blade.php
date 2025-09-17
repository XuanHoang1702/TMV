@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Danh sách Quy trình</h1>
    <a href="{{ route('admin.process.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>

  
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Ảnh</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($process as $item)
                <tr>
                    <td>
                        @if($item->image)
                            <img src="{{ asset('storage/' . $item->image) }}" width="100">
                        @endif
                    </td>
                    <td>{{ $item->title }}</td>
                    <td>{{ Str::limit($item->content, 50) }}</td>
                    <td>
                        <a href="{{ route('admin.process.show', $item->id) }}" class="btn btn-info btn-sm">Xem</a>
                        <a href="{{ route('admin.process.edit', $item->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('admin.process.destroy', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
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
