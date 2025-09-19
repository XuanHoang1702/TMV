@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Danh sách About Us</h1>
    <a href="{{ route('admin.about-us.create') }}" class="btn btn-primary mb-3">+ Thêm mới</a>

    @if($aboutUs->count() > 0)
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Icons</th>
                    <th>Sub Title</th>
                    <th>Section</th>
                    <th>Hành động</th>
                </tr>
            </thead>
            <tbody>
                @foreach($aboutUs as $item)
                    <tr>
                        <td>{{ $item->id }}</td>
                        <td>{{ $item->title }}</td>
                        <td>{{ Str::limit($item->description, 50) }}</td>
                        <td>
                            @if($item->icons && $item->icons->count() > 0)
                                <ul class="list-unstyled mb-0">
                                    @foreach($item->icons as $icon)
                                        <li class="mb-2 d-flex align-items-center">
                                            @if($icon->icon)
                                                <img src="{{ asset('storage/' . $icon->icon) }}"
                                                     alt="Icon"
                                                     style="width: 30px; height: 30px; margin-right: 8px; border: 1px solid #ddd;">
                                            @endif
                                            <strong>{{ $icon->icon_title }}</strong> -
                                            <span>{{ Str::limit($icon->icon_content, 40) }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @else
                                Không có icon
                            @endif
                        </td>
                        <td>{{ $item->sub_title ?? '—' }}</td>
                        <td>{{ $item->section }}</td>
                        <td>
                            <a href="{{ route('admin.about-us.show', $item) }}" class="btn btn-info btn-sm">Xem</a>
                            <a href="{{ route('admin.about-us.edit', $item) }}" class="btn btn-warning btn-sm">Sửa</a>
                            <form action="{{ route('admin.about-us.destroy', $item) }}"
                                  method="POST"
                                  class="d-inline"
                                  onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <div class="alert alert-info">Chưa có dữ liệu About Us nào.</div>
    @endif
</div>
@endsection
