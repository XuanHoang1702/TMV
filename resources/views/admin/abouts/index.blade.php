@extends('layouts.admin')

@section('title', 'Quản lý Nội dung Giới thiệu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách Nội dung Giới thiệu</h3>
                    <div class="card-tools d-flex align-items-center">
                        <a href="{{ route('admin.abouts.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Thêm Nội dung Giới thiệu Mới
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tiêu đề</th>
                                    <th>Nội dung</th>
                                    <th>Hình ảnh</th>
                                    <th>Ngày tạo</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($abouts as $about)
                                    <tr>
                                        <td>{{ $about->id }}</td>
                                        <td>{{ $about->title }}</td>
                                        <td>{{ Str::limit(strip_tags($about->content), 50) }}</td>
                                        <td>
                                            @if($about->image)
                                                <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}" width="50" height="50">
                                            @else
                                                Không có
                                            @endif
                                        </td>
                                        <td>{{ $about->created_at->format('d/m/Y H:i') }}</td>
                                        <td>
                                            <div class="btn-group" role="group" aria-label="Actions">
                                                <a href="{{ route('admin.abouts.show', $about->id) }}" class="btn btn-sm btn-info" title="Xem">
                                                    <i class="fas fa-eye"></i>
                                                </a>
                                                <a href="{{ route('admin.abouts.edit', $about->id) }}" class="btn btn-sm btn-warning" title="Sửa">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <button type="button" class="btn btn-sm btn-danger" title="Xóa"
                                                    onclick="confirmDelete({{ $about->id }}, '{{ $about->title }}')">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                                <form id="delete-form-{{ $about->id }}" action="{{ route('admin.abouts.destroy', $about->id) }}"
                                                    method="POST" style="display: none;">
                                                    @csrf
                                                    @method('DELETE')
                                                </form>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="6" class="text-center">Không có nội dung giới thiệu nào.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, title) {
    if (confirm('Bạn có chắc muốn xóa nội dung giới thiệu "' + title + '"?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endsection
