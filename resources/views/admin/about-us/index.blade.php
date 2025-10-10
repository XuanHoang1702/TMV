@extends('layouts.admin')

@section('content')
    <div class="container">
        <h1>Danh sách nội dung trang liên hệ</h1>
        <a href="{{ route('admin.about-us.create') }}" class="btn btn-primary mb-3">
            <i class="fas fa-plus"></i> Thêm mới
        </a>

        @if ($aboutUs->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Title</th>
                        <th>Description</th>
                        <th>Icons</th>
                        <th>Sub Title</th>
                        <th>Section</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($aboutUs as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ Str::limit($item->description, 50) }}</td>
                            <td>
                                @if ($item->icons && $item->icons->count() > 0)
                                    <ul class="list-unstyled mb-0">
                                        @foreach ($item->icons as $icon)
                                            <li class="mb-2 d-flex align-items-center">
                                                @if ($icon->icon)
                                                    <img src="{{ asset('storage/' . $icon->icon) }}" alt="Icon"
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
                            <td class="text-center">
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.about-us.show', $item) }}" class="btn btn-info btn-sm"
                                        title="Xem">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.about-us.edit', $item) }}" class="btn btn-warning btn-sm"
                                        title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.about-us.destroy', $item) }}" method="POST"
                                        class="d-inline" onsubmit="return confirm('Bạn có chắc chắn muốn xóa?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" title="Xóa">
                                            <i class="fas fa-trash-alt"></i>
                                        </button>
                                    </form>
                                </div>
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
