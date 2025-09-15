@extends('layouts.admin')

@section('title', 'Chi tiết dịch vụ')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Chi tiết dịch vụ: {{ $service->name }}</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-8">
                                <table class="table table-bordered">
                                    <tr>
                                        <th width="200">Tên dịch vụ</th>
                                        <td>{{ $service->name }}</td>
                                    </tr>
                                    <tr>
                                        <th>Dịch vụ cha</th>
                                        <td>{{ $service->parent ? $service->parent->name : 'Không có' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Slug</th>
                                        <td>{{ $service->slug }}</td>
                                    </tr>
                                    <tr>
                                        <th>Mô tả</th>
                                        <td>{{ $service->description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Nội dung</th>
                                        <td>{!! $service->content !!}</td>
                                    </tr>
                                    <tr>
                                        <th>Danh mục</th>
                                        <td>{{ is_object($service->category) ? $service->category->name : 'N/A' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Giá khoảng</th>
                                        <td>{{ $service->price_range }}</td>
                                    </tr>
                                    <tr>
                                        <th>Thời gian</th>
                                        <td>{{ $service->duration }}</td>
                                    </tr>
                                    <tr>
                                        <th>Trạng thái</th>
                                        <td>
                                            <span
                                                class="badge {{ $service->is_active ? 'badge-success' : 'badge-danger' }}">
                                                {{ $service->is_active ? 'Hoạt động' : 'Không hoạt động' }}
                                            </span>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th>Thứ tự</th>
                                        <td>{{ $service->sort_order }}</td>
                                    </tr>
                                    <tr>
                                        <th>Meta Title</th>
                                        <td>{{ $service->meta_title }}</td>
                                    </tr>
                                    <tr>
                                        <th>Meta Description</th>
                                        <td>{{ $service->meta_description }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày tạo</th>
                                        <td>{{ $service->created_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                    <tr>
                                        <th>Ngày cập nhật</th>
                                        <td>{{ $service->updated_at->format('d/m/Y H:i') }}</td>
                                    </tr>
                                </table>

                                @if ($service->children->count() > 0)
                                    <h4 class="mt-4">Dịch vụ con</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Tên dịch vụ</th>
                                                <th>Danh mục</th>
                                                <th>Trạng thái</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($service->children as $child)
                                                <tr>
                                                    <td>{{ $child->id }}</td>
                                                    <td>{{ $child->name }}</td>
                                                    <td>{{ $child->category ? $child->category->name : 'N/A' }}</td>
                                                    <td>
                                                        <span
                                                            class="badge {{ $service->is_active ? 'bg-success' : 'bg-danger' }}">
                                                            {{ $service->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                                                        </span>
                                                    </td>

                                                    <td>
                                                        <a href="{{ route('admin.services.show', $child) }}"
                                                            class="btn btn-sm btn-info">Xem</a>
                                                        <a href="{{ route('admin.services.edit', $child) }}"
                                                            class="btn btn-sm btn-warning">Sửa</a>
                                                        <form action="{{ route('admin.services.destroy', $child) }}"
                                                            method="POST" class="d-inline"
                                                            onsubmit="return confirm('Bạn có chắc muốn xóa dịch vụ con này?');">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-sm btn-danger">Xóa</button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                @endif
                            </div>
                            <div class="col-md-4">
                                @if ($service->image)
                                    <div class="mb-3">
                                        <label>Hình ảnh</label>
                                        <br>
                                        <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}"
                                            class="img-fluid">
                                    </div>
                                @endif
                                @if ($service->icon_page_home)
                                    <div class="mb-3">
                                        <label>Icon trang chủ</label>
                                        <br>
                                        <img src="{{ Storage::url($service->icon_page_home) }}" alt="{{ $service->name }} - Home Icon"
                                            class="img-fluid" style="max-width: 100px;">
                                    </div>
                                @endif
                                @if ($service->icon_page_service)
                                    <div class="mb-3">
                                        <label>Icon trang dịch vụ</label>
                                        <br>
                                        <img src="{{ Storage::url($service->icon_page_service) }}" alt="{{ $service->name }} - Service Icon"
                                            class="img-fluid" style="max-width: 100px;">
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
