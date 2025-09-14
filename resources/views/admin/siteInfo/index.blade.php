@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Danh sách Site Info</h1>
    <a href="{{ route('site_info.create') }}" class="btn btn-primary">Thêm mới</a>

    @if(session('success'))
        <div class="alert alert-success mt-2">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered mt-3">
        <thead>
            <tr>
                <th>ID</th>
                <th>Slogan</th>
                <th>Logo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($siteInfo as $info)
                <tr>
                    <td>{{ $info->id }}</td>
                    <td>{{ $info->slogan }}</td>
                    <td><img src="{{ asset('storage/' . $info->logo) }}" width="80"></td>
                    <td>
                        <a href="{{ route('site_info.edit', $info->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                        <form action="{{ route('site_info.destroy', $info->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
