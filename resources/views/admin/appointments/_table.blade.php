<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Khách hàng</th>
            <th>Dịch vụ</th>
            <th>Ngày hẹn</th>
            <th>Giờ hẹn</th>
            <th>Trạng thái</th>
            <th>Hành động</th>
        </tr>
    </thead>
    <tbody id="appointments-table-body">
        @forelse($appointments as $appointment)
        <tr>
            <td>{{ $appointment->id }}</td>
            <td>{{ $appointment->customer_name }}</td>
            <td>{{ $appointment->service->name ?? '' }} @if($appointment->service && $appointment->service->category) ({{ $appointment->service->category }}) @endif</td>
            <td>{{ $appointment->appointment_date->format('d/m/Y') }}</td>
            <td>{{ $appointment->appointment_time->format('H:i') }}</td>
            <td>
                @if($appointment->status == 'pending')
                    <span class="badge bg-warning">Chờ xử lý</span>
                @elseif($appointment->status == 'confirmed')
                    <span class="badge bg-success">Đã xác nhận</span>
                @elseif($appointment->status == 'completed')
                    <span class="badge bg-success">Hoàn thành</span>
                @elseif($appointment->status == 'cancelled')
                    <span class="badge bg-danger">Đã hủy</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.appointments.show', $appointment) }}" class="btn btn-sm btn-info">Xem</a>
                <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-sm btn-warning">Sửa</a>
                <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST" class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa lịch hẹn này?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Xóa</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7" class="text-center">Không có lịch hẹn nào.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{-- Phân trang Bootstrap --}}
@if($appointments->hasPages())
<div class="row mt-4">
    <div class="col-md-6 d-flex align-items-center">
        <div class="small text-muted">
            <i class="fas fa-list me-1"></i>
            Hiển thị {{ $appointments->firstItem() }} - {{ $appointments->lastItem() }}
            của {{ number_format($appointments->total()) }} lịch hẹn
        </div>
    </div>
    <div class="col-md-6">
        <nav aria-label="Phân trang lịch hẹn">
            <ul class="pagination justify-content-center justify-content-md-end mb-0">
                {{-- Nút Previous --}}
                @if($appointments->onFirstPage())
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            <i class="fas fa-chevron-left me-1"></i> Trước
                        </a>
                    </li>
                @else
                    <li class="page-item">
                        <a class="page-link" href="{{ $appointments->previousPageUrl() }}" rel="prev">
                            <i class="fas fa-chevron-left me-1"></i> Trước
                        </a>
                    </li>
                @endif

                {{-- Các trang (hiển thị tối đa 5 trang) --}}
                @php
                    $start = max(1, $appointments->currentPage() - 2);
                    $end = min($appointments->lastPage(), $appointments->currentPage() + 2);
                @endphp

                @if($start > 1)
                    <li class="page-item">
                        <a class="page-link" href="{{ $appointments->url(1) }}">1</a>
                    </li>
                    @if($start > 2)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                @endif

                @for($i = $start; $i <= $end; $i++)
                    @if($i == $appointments->currentPage())
                        <li class="page-item active" aria-current="page">
                            <span class="page-link">{{ $i }}</span>
                        </li>
                    @else
                        <li class="page-item">
                            <a class="page-link" href="{{ $appointments->url($i) }}">{{ $i }}</a>
                        </li>
                    @endif
                @endfor

                @if($end < $appointments->lastPage())
                    @if($end < $appointments->lastPage() - 1)
                        <li class="page-item disabled">
                            <span class="page-link">...</span>
                        </li>
                    @endif
                    <li class="page-item">
                        <a class="page-link" href="{{ $appointments->url($appointments->lastPage()) }}">{{ $appointments->lastPage() }}</a>
                    </li>
                @endif

                {{-- Nút Next --}}
                @if($appointments->hasMorePages())
                    <li class="page-item">
                        <a class="page-link" href="{{ $appointments->nextPageUrl() }}" rel="next">
                            Sau <i class="fas fa-chevron-right ms-1"></i>
                        </a>
                    </li>
                @else
                    <li class="page-item disabled">
                        <a class="page-link" href="#" tabindex="-1" aria-disabled="true">
                            Sau <i class="fas fa-chevron-right ms-1"></i>
                        </a>
                    </li>
                @endif
            </ul>
        </nav>

        {{-- Dropdown số item mỗi trang --}}
        <div class="d-flex align-items-center justify-content-center justify-content-md-end mt-2 mt-md-0 ms-md-3">
            <label class="mb-0 small text-muted me-2">Hiển thị:</label>
            <select class="form-select form-select-sm" style="width: auto;" onchange="changePerPage(this.value)">
                @foreach([10, 25, 50, 100] as $perPage)
                    <option value="{{ $perPage }}"
                            {{ request('per_page', 15) == $perPage ? 'selected' : '' }}>
                        {{ $perPage }}
                    </option>
                @endforeach
            </select>
            <span class="small text-muted ms-1">/ trang</span>
        </div>
    </div>
</div>
@endif
