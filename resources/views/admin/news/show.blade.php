@extends('layouts.admin')

@section('title', 'Chi tiết tin tức')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết tin tức: {{ $news->title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.news.edit', $news) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <a href="{{ route('admin.news.index') }}" class="btn btn-secondary">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <table class="table table-bordered">
                                <tr>
                                    <th width="200">Tiêu đề</th>
                                    <td>{{ $news->title }}</td>
                                </tr>
                                <tr>
                                    <th>Slug</th>
                                    <td>{{ $news->slug }}</td>
                                </tr>
                                <tr>
                                    <th>Danh mục</th>
                                    <td>{{ $news->category }}</td>
                                </tr>
                                <tr>
                                    <th>Tóm tắt</th>
                                    <td>{{ $news->excerpt }}</td>
                                </tr>
                                <tr>
                                    <th>Nội dung</th>
                                    <td>{!! $news->content !!}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái</th>
                                    <td>
                                        <span class="badge {{ $news->is_published ? 'badge-success' : 'badge-danger' }}">
                                            {{ $news->is_published ? 'Đã xuất bản' : 'Chưa xuất bản' }}
                                        </span>
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ngày xuất bản</th>
                                    <td>{{ $news->published_at ? $news->published_at->format('d/m/Y H:i') : 'Chưa đặt' }}</td>
                                </tr>
                                <tr>
                                    <th>Meta Title</th>
                                    <td>{{ $news->meta_title }}</td>
                                </tr>
                                <tr>
                                    <th>Meta Description</th>
                                    <td>{{ $news->meta_description }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo</th>
                                    <td>{{ $news->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày cập nhật</th>
                                    <td>{{ $news->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-4">
                            @if($news->image)
                                <div class="mb-3">
                                    <label>Hình ảnh</label>
                                    <br>
                                    <img src="{{ Storage::url($news->image) }}" alt="{{ $news->title }}" class="img-fluid">
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
