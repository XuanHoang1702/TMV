@extends('layouts.admin')

@section('title', 'Quản lý danh mục')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Danh sách danh mục</h3>
                        <div class="card-tools d-flex align-items-center">
                            <!-- Type Filter -->
                            <div class="me-3">
                                <select class="form-select form-select-sm" id="type-filter"
                                    onchange="filterByType(this.value)">
                                    <option value="all" {{ $type == 'all' ? 'selected' : '' }}>Tất cả</option>
                                    {{-- <option value="general" {{ $type == 'general' ? 'selected' : '' }}>Chung</option> --}}
                                    <option value="services" {{ $type == 'services' ? 'selected' : '' }}>Dịch vụ</option>
                                    <option value="news" {{ $type == 'news' ? 'selected' : '' }}>Tin tức</option>
                                </select>
                            </div>
                            <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Thêm danh mục
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped">
                                <thead>
                                    <tr>
                                        <th>ID</th>

                                        <th>Tên danh mục</th>
                                        <th>Slug</th>
                                        <th>Trạng thái</th>
                                        <th>Thứ tự</th>
                                        <th>Thao tác</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @include('admin.categories.partials.children', [
                                        'categories' => $categories->whereNull('parent_id'),
                                        'level' => 0,
                                    ])
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        @if ($categories->hasPages())
                            <div class="d-flex justify-content-center mt-3">
                                {{ $categories->links() }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function filterByType(type) {
            const url = new URL(window.location);
            if (type === 'all') {
                url.searchParams.delete('type');
            } else {
                url.searchParams.set('type', type);
            }
            window.location.href = url.toString();
        }
    </script>
@endsection
