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
<div id="appointments-pagination-links" class="d-flex justify-content-center">
    {{ $appointments->links('vendor.pagination.bootstrap-4') }}
</div>
