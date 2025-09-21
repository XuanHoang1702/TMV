@extends('layouts.admin')
@php
    use App\Models\Information;
    use Illuminate\Support\Str;
@endphp
@section('title', 'Quản lý Thông tin liên hệ')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">📞 Quản lý Thông tin liên hệ</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.informations.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Thêm mới
                        </a>
                    </div>
                </div>

                <div class="card-body">


                    @if ($informations->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>ID</th>
                                        <th>Tên</th>
                                        <th>Email</th>
                                        <th>Hotline</th>
                                        <th>Địa chỉ</th>
                                        <th>Tọa độ</th>

                                        <th>Trạng thái</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($informations as $info)
                                        @php
                                            $images = $info->images_address
                                                ? json_decode($info->images_address, true)
                                                : [];
                                        @endphp
                                        <tr>
                                            <td>{{ $info->id }}</td>
                                            <td>{{ $info->name }}</td>
                                            <td>{{ $info->email }}</td>
                                            <td>{{ $info->hotline ?: 'Chưa có' }}</td>
                                            <td>{{ Str::limit($info->address ?: $info->display_address ?? 'Chưa có địa chỉ', 30) }}</td>
                                            <td>
                                                @if($info->latitude && $info->longitude)
                                                    {{ number_format($info->latitude, 4) }}, {{ number_format($info->longitude, 4) }}
                                                @else
                                                    Chưa xác định
                                                @endif
                                            </td>

                                            <td>
                                                <span class="badge bg-success">Hoạt động</span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.informations.show', $info) }}" class="btn btn-sm btn-info">Xem</a>
                                                <a href="{{ route('admin.informations.edit', $info) }}" class="btn btn-sm btn-warning">Sửa</a>
                                                <form action="{{ route('admin.informations.destroy', $info) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa thông tin liên hệ này?');">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-sm btn-danger">Xóa</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    @else
                        <tr>
                            <td colspan="9" class="text-center">Không có thông tin liên hệ nào.</td>
                        </tr>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
