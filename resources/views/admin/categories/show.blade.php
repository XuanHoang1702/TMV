@extends('layouts.admin')

@section('title', 'Chi tiết danh mục')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết danh mục: {{ $category->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Chỉnh sửa
                        </a>
                        <a href="{{ route('admin.categories.index', ['type' => $category->type]) }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại danh sách
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">Tên danh mục</th>
                                    <td>{{ $category->name }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $category->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Mô tả</th>
                                    <td>{{ $category->description ?: 'Không có mô tả' }}</td>
                                </tr>
                                <tr>
                                    <th>Loại</th>
                                    <td>
                                        <span class="badge bg-secondary">{{ $category->type }}</span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Danh mục cha</th>
                                    <td>
                                        @if($category->parent)
                                            <a href="{{ route('admin.categories.show', $category->parent) }}">
                                                {{ $category->parent->name }}
                                            </a>
                                        @else
                                            Không có (danh mục gốc)
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Thứ tự</th>
                                    <td>{{ $category->order }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-danger' }}">
                                            {{ $category->is_active ? 'Hoạt động' : 'Tạm dừng' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $category->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>

                        <div class="col-md-4">
                            @if($category->hasChildren())
                                <div class="card">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Danh mục con</h5>
                                    </div>
                                    <div class="card-body">
                                        <ul class="list-group list-group-flush">
                                            @foreach($category->children as $child)
                                                <li class="list-group-item d-flex justify-content-between align-items-center">
                                                    <a href="{{ route('admin.categories.show', $child) }}">
                                                        {{ $child->name }}
                                                    </a>
                                                    <span class="badge {{ $child->is_active ? 'bg-success' : 'bg-danger' }} rounded-pill">
                                                        {{ $child->is_active ? 'Active' : 'Inactive' }}
                                                    </span>
                                                </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            @endif

                            @if($category->parent)
                                <div class="card mt-3">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Danh mục cha</h5>
                                    </div>
                                    <div class="card-body">
                                        <a href="{{ route('admin.categories.show', $category->parent) }}" class="btn btn-outline-primary">
                                            <i class="fas fa-arrow-up"></i> {{ $category->parent->name }}
                                        </a>
                                    </div>
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
