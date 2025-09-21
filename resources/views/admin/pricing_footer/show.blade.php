@extends('layouts.admin')

@section('title', $pricingFooter->title ?? 'Pricing Footer Item')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">

    <div>
        <a href="{{ route('admin.pricing_footer.edit', $pricingFooter) }}" class="btn btn-warning mr-2">
            <i class="fas fa-edit"></i> Sửa
        </a>
        <a href="{{ route('admin.pricing_footer.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>
</div>

<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4 class="mb-0"><i class="fas fa-info-circle"></i> {{ $pricingFooter->title ?? 'Pricing Footer Item' }}</h4>
            </div>
            <div class="card-body">
                <!-- Thông tin chi tiết -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <p><strong><i class="fas fa-sort text-primary"></i> Thứ tự sắp xếp:</strong>
                            <span class="badge badge-info">{{ $pricingFooter->sort_order }}</span>
                        </p>
                    </div>
                    <div class="col-md-6">
                        <p><strong><i class="fas fa-toggle-on text-primary"></i> Trạng thái:</strong>
                            @if($pricingFooter->is_active)
                                <span class="badge badge-success">Đã kích hoạt</span>
                            @else
                                <span class="badge badge-warning">Chờ duyệt</span>
                            @endif
                        </p>
                    </div>
                </div>

                <!-- Nội dung chính -->
                <div class="content-preview">
                    <h6 class="mb-3"><i class="fas fa-file-alt text-primary"></i> Nội dung:</h6>
                    <div class="pricing-footer-content">
                        <p class="mb-0">{{ $pricingFooter->content }}</p>
                    </div>
                </div>



                <!-- Meta information -->
                <div class="mt-4 p-3 bg-light rounded">
                    <h6 class="mb-3"><i class="fas fa-info-circle text-primary"></i> Thông tin hệ thống:</h6>
                    <p class="mb-2"><strong>Tạo lúc:</strong> {{ $pricingFooter->created_at->format('d/m/Y H:i') }}</p>
                    <p class="mb-0"><strong>Cập nhật:</strong> {{ $pricingFooter->updated_at->format('d/m/Y H:i') }}</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Sidebar với thông tin nhanh -->
        <div class="card mb-3">
            <div class="card-header bg-info text-white">
                <h6 class="mb-0"><i class="fas fa-info"></i> Thông tin nhanh</h6>
            </div>
            <div class="card-body">
                <ul class="list-unstyled">
                    <li class="mb-2">
                        <strong>ID:</strong> <span class="text-muted">#{{ $pricingFooter->id }}</span>
                    </li>
                    <li class="mb-2">
                        <strong>Trạng thái:</strong>
                        @if($pricingFooter->is_active)
                            <span class="badge badge-success">Kích hoạt</span>
                        @else
                            <span class="badge badge-secondary">Không kích hoạt</span>
                        @endif
                    </li>
                    <li class="mb-2">
                        <strong>Thứ tự:</strong> <span class="text-muted">{{ $pricingFooter->sort_order }}</span>
                    </li>
                   
                </ul>
            </div>
        </div>

        <!-- Actions -->
        <div class="card mb-3">
            <div class="card-header bg-success text-white">
                <h6 class="mb-0"><i class="fas fa-cogs"></i> Hành động</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('admin.pricing_footer.edit', $pricingFooter) }}"
                       class="btn btn-warning">
                        <i class="fas fa-edit"></i> Chỉnh sửa
                    </a>
                    <button type="button"
                            class="btn btn-info"
                            onclick="toggleStatus({{ $pricingFooter->id }})">
                        <i class="fas fa-toggle-on"></i>
                        {{ $pricingFooter->is_active ? 'Tắt' : 'Bật' }}
                    </button>
                    <button type="button"
                            class="btn btn-danger"
                            onclick="deleteItem({{ $pricingFooter->id }})">
                        <i class="fas fa-trash"></i> Xóa
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
function toggleStatus(id) {
    if (confirm('Bạn có chắc chắn muốn thay đổi trạng thái?')) {
        // Create a form to submit POST request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/pricing_footer/${id}/toggle-status`;

        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        // Add method field
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'POST';
        form.appendChild(methodField);

        document.body.appendChild(form);
        form.submit();
    }
}

function deleteItem(id) {
    if (confirm('Bạn có chắc chắn muốn xóa mục này?')) {
        // Create a form to submit DELETE request
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/pricing_footer/${id}`;

        // Add CSRF token
        const csrfToken = document.createElement('input');
        csrfToken.type = 'hidden';
        csrfToken.name = '_token';
        csrfToken.value = '{{ csrf_token() }}';
        form.appendChild(csrfToken);

        // Add method field
        const methodField = document.createElement('input');
        methodField.type = 'hidden';
        methodField.name = '_method';
        methodField.value = 'DELETE';
        form.appendChild(methodField);

        document.body.appendChild(form);
        form.submit();
    }
}
</script>
@endpush

@push('styles')
<style>
    .pricing-footer-content {
        line-height: 1.7;
        font-size: 1.1em;
        padding: 15px;
        background: #f8f9fa;
        border-radius: 0.375rem;
        border-left: 4px solid #007bff;
    }

    .pricing-footer-content p {
        margin-bottom: 0;
    }

    .content-preview {
        margin-bottom: 20px;
    }
</style>
@endpush
@endsection
