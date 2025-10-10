@extends('layouts.admin')

@section('title', 'Chi tiết Banner')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Chi tiết Banner: {{ $banner->title }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.banners.edit', $banner) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <a href="{{ route('admin.banners.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="200">ID</th>
                                        <td>{{ $banner->id }}</td>
                                    </tr>
                                    <tr>
                                        <th>Tiêu đề</th>
                                        <td>{{ $banner->title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Đường dẫn hình ảnh</th>
                                        <td>{{ $banner->image_path }}</td>
                                    </tr>

                                    <tr>
                                        <th>Thứ tự</th>
                                        <td>{{ $banner->order }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái</th>
                                        <td>
                                            <span class="badge {{ $banner->is_active ? 'text-black' : 'text-black' }}">
                                                {{ $banner->is_active ? 'Kích hoạt' : 'Không kích hoạt' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Ngày tạo</th>
                                        <td>{{ $banner->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày cập nhật</th>
                                        <td>{{ $banner->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}"
                                        class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
