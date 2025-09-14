@extends('layouts.admin')

@section('title', 'Quản lý Chứng chỉ')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách Chứng chỉ</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.certificates.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Thêm mới
                        </a>
                    </div>
                </div>
                <div class="card-body table-responsive p-0">
                    <table class="table table-hover text-nowrap">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Tiêu đề</th>
                                <th>Hình ảnh</th>
                                <th>Thứ tự</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($certificates as $certificate)
                            <tr>
                                <td>{{ $certificate->id }}</td>
                                <td>{{ $certificate->title }}</td>
                                <td>
                                    @if($certificate->image_path)
                                        <img src="{{ asset('storage/' . $certificate->image_path) }}" alt="{{ $certificate->title }}" width="50">
                                    @endif
                                </td>
                                <td>{{ $certificate->order }}</td>
                                <td>
                                    <a href="{{ route('admin.certificates.show', $certificate) }}" class="btn btn-info btn-sm">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.certificates.edit', $certificate) }}" class="btn btn-warning btn-sm">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <form action="{{ route('admin.certificates.destroy', $certificate) }}" method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="5" class="text-center">Không có chứng chỉ nào</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                @if($certificates->hasPages())
                <div class="card-footer">
                    {{ $certificates->links() }}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
