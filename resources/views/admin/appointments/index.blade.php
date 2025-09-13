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
            <td>{{ $appointment->appointment_date->format('d/m/Y H:i') }}</td>
            <td>
                @if($appointment->status == 'pending')
                    <span class="badge bg-warning">Chờ xử lý</span>
                @elseif($appointment->status == 'confirmed')
                    <span class="badge bg-success">Đã xác nhận</span>
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
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">Không có lịch hẹn nào.</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{ $appointments->links() }}
@endsection
