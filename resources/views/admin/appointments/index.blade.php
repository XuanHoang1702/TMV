@extends('layouts.admin')

@section('title', 'Quản lý Lịch hẹn')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Danh sách Lịch hẹn</h1>
        <a href="{{ route('admin.appointments.create') }}" class="btn btn-primary">Thêm mới</a>
    </div>



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
        <tbody>
            @forelse($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->id }}</td>
                    <td>{{ $appointment->customer_name }}</td>
                    <td>{{ $appointment->service->name ?? '' }}</td>
                    <td>{{ $appointment->appointment_date->format('d/m/Y') }}</td>
                    <td>{{ \Carbon\Carbon::parse($appointment->appointment_time)->format('H:i') }}</td>

                    <td>
                        @if ($appointment->status == 'pending')
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
                        <a href="{{ route('admin.appointments.edit', $appointment) }}"
                            class="btn btn-sm btn-warning">Sửa</a>
                        <form action="{{ route('admin.appointments.destroy', $appointment) }}" method="POST"
                            class="d-inline" onsubmit="return confirm('Bạn có chắc muốn xóa lịch hẹn này?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger">Xóa</button>
                        </form>
                </tr>
            @empty
                <tr>
                    <td colspan="6" class="text-center">Không có lịch hẹn nào.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
    {{-- Phân trang Bootstrap đẹp --}}
    @if ($appointments->hasPages())
        <div class="row mt-4">
            <div class="col-sm-12 col-md-6 d-flex align-items-center">
                <div class="small text-muted">
                    <i class="fas fa-list me-1"></i>
                    Hiển thị {{ $appointments->firstItem() }} - {{ $appointments->lastItem() }}
                    của {{ number_format($appointments->total()) }} lịch hẹn
                </div>
            </div>
            <div class="col-sm-12 col-md-6">
                <nav aria-label="Phân trang lịch hẹn">
                    <ul class="pagination justify-content-center justify-content-md-end mb-0">
                        {{-- Previous --}}
                        @if ($appointments->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i class="fas fa-chevron-left me-1"></i> Trước
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $appointments->previousPageUrl() }}">
                                    <i class="fas fa-chevron-left me-1"></i> Trước
                                </a>
                            </li>
                        @endif

                        {{-- Pages (hiển thị tối đa 5 trang xung quanh trang hiện tại) --}}
                        @php
                            $start = max(1, $appointments->currentPage() - 2);
                            $end = min($appointments->lastPage(), $appointments->currentPage() + 2);
                        @endphp

                        @if ($start > 1)
                            <li class="page-item">
                                <a class="page-link" href="{{ $appointments->url(1) }}">1</a>
                            </li>
                            @if ($start > 2)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                        @endif

                        @for ($i = $start; $i <= $end; $i++)
                            @if ($i == $appointments->currentPage())
                                <li class="page-item active">
                                    <span class="page-link">{{ $i }}</span>
                                </li>
                            @else
                                <li class="page-item">
                                    <a class="page-link" href="{{ $appointments->url($i) }}">{{ $i }}</a>
                                </li>
                            @endif
                        @endfor

                        @if ($end < $appointments->lastPage())
                            @if ($end < $appointments->lastPage() - 1)
                                <li class="page-item disabled">
                                    <span class="page-link">...</span>
                                </li>
                            @endif
                            <li class="page-item">
                                <a class="page-link"
                                    href="{{ $appointments->url($appointments->lastPage()) }}">{{ $appointments->lastPage() }}</a>
                            </li>
                        @endif

                        {{-- Next --}}
                        @if ($appointments->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $appointments->nextPageUrl() }}">
                                    Sau <i class="fas fa-chevron-right ms-1"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">
                                    Sau <i class="fas fa-chevron-right ms-1"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                </nav>
            </div>
        </div>
    @endif
@endsection
