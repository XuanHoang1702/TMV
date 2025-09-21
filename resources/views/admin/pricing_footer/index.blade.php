@extends('layouts.admin')

@section('title', 'Quản lý Pricing Footer')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3 mb-0 text-gray-800">Chú thích báo giá</h1>
        <a href="{{ route('admin.pricing_footer.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm mới
        </a>
    </div>



    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Chú thích báo giá</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>STT</th>

                            <th>Nội dung</th>

                            <th>Trạng thái</th>
                            <th>Thứ tự</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($pricingFooters as $index => $footer)
                        <tr>
                            <td>{{ $index + 1 }}</td>

                            <td>{{ Str::limit($footer->content, 50) }}</td>
                            
                            <td>
                                <span class="badge {{ $footer->is_active ? 'bg-success' : 'bg-danger' }}">
                                    {{ $footer->is_active ? 'Hiển thị' : 'Ẩn' }}
                                </span>
                            </td>
                            <td>{{ $footer->sort_order }}</td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.pricing_footer.edit', $footer) }}"
                                       class="btn btn-sm btn-warning">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <a href="{{ route('admin.pricing_footer.show', $footer) }}"
                                       class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <form action="{{ route('admin.pricing_footer.toggle-status', $footer) }}"
                                          method="POST" style="display: inline;">
                                        @csrf
                                        <button type="submit"
                                                class="btn btn-sm {{ $footer->is_active ? 'btn-secondary' : 'btn-success' }}"
                                                onclick="return confirm('Bạn có chắc muốn {{ $footer->is_active ? "ẩn" : "hiển thị" }} mục này?')">
                                            <i class="fas {{ $footer->is_active ? 'fa-eye-slash' : 'fa-eye' }}"></i>
                                        </button>
                                    </form>
                                    <form action="{{ route('admin.pricing_footer.destroy', $footer) }}"
                                          method="POST" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc muốn xóa mục này?')">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center">Không có dữ liệu</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
