@extends('layouts.admin')

@section('title', 'Quản lý Nội dung Trang')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Quản lý Tiêu Đề Trang</h1>
    <a href="{{ route('admin.page_contents.create') }}" class="btn btn-primary">
        <i class="fas fa-plus"></i> Thêm Tiêu Đề Trang Mới
    </a>
</div>


<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Danh sách Tiêu Đề Trang</h5>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-striped table-hover table-bordered align-middle">
                <thead class="table-dark">
                    <tr>
                        <th>ID</th>
                        <th>Trang</th>
                        <th>Tiêu đề</th>
                        <th>Ngày tạo</th>
                        <th>Thao tác</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($pages as $page)
                        <tr>
                            <td>{{ $page->id }}</td>
                            <td>{{ $page->page }}</td>
                            <td>{{ $page->title }}</td>
                            <td>{{ $page->created_at->format('d/m/Y H:i') }}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Actions">
                                    <a href="{{ route('admin.page_contents.show', $page->id) }}" class="btn btn-sm btn-info" title="Xem">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.page_contents.edit', $page->id) }}" class="btn btn-sm btn-warning" title="Sửa">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" class="btn btn-sm btn-danger" title="Xóa"
                                        onclick="confirmDelete({{ $page->id }}, '{{ $page->title }}')">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                    <form id="delete-form-{{ $page->id }}" action="{{ route('admin.page_contents.destroy', $page->id) }}"
                                        method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </div>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="text-center">Không có nội dung trang nào.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, title) {
    if (confirm('Bạn có chắc muốn xóa nội dung trang "' + title + '"?')) {
        document.getElementById('delete-form-' + id).submit();
    }
}
</script>
@endsection
