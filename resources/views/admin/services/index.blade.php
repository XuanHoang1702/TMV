
@extends('layouts.admin')

@section('title', 'Quản lý Dịch vụ')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách Dịch vụ</h3>
                    <div class="card-tools d-flex align-items-center">
                        <a href="{{ route('admin.services.create') }}" class="btn btn-primary">
                            <i class="fas fa-plus"></i> Thêm dịch vụ mới
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Tên dịch vụ</th>
                                    <th>Danh mục</th>
                                    <th>Icon</th>
                                    <th>Trạng thái</th>
                                    <th>Thao tác</th>
                                </tr>
                            </thead>
                            <tbody>
                                @include('admin.services.partials.children', [
                                    'services' => $services->whereNull('parent_id'),
                                    'depth' => 0
                                ])
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    @if($services->hasPages())
                        <div class="d-flex justify-content-center mt-3">
                            {{ $services->links() }}
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<script>
function confirmDelete(id, name) {
    if (confirm(`Bạn có chắc muốn xóa dịch vụ "${name}"? Các dịch vụ con sẽ bị xóa theo.`)) {
        document.getElementById(`delete-form-${id}`).submit();
    }
}
</script>
@endsection

