@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Danh sách quảng cáo</h2>
    <a href="{{ route('admin.advertisement.create') }}" class="btn btn-primary mb-3">+ Thêm quảng cáo</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Page</th>
                <th>Ảnh chính</th>
                <th>Ảnh phụ</th>
                <th>Tiêu đề</th>
                <th>Nội dung</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($advertisement as $ad)
            <tr>
                <td>{{ $ad->id }}</td>
                <td>{{ $ad->page }}</td>
                <td><img src="{{ asset('storage/' . $ad->main_image) }}" width="100"></td>
                <td>
                    @foreach($ad->sub_images ?? [] as $sub)
                        <img src="{{ asset('storage/' . $sub) }}" width="60">
                    @endforeach
                </td>
                <td>
                    <ul>
                        @foreach($ad->titles ?? [] as $title)
                            <li>{{ $title }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <ul>
                        @foreach($ad->contents ?? [] as $content)
                            <li>{{ $content }}</li>
                        @endforeach
                    </ul>
                </td>
                <td>
                    <a href="{{ route('admin.advertisement.edit', $ad->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.advertisement.destroy', $ad->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" onclick="return confirm('Xóa quảng cáo này?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
