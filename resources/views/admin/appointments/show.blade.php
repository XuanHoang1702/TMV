@extends('layouts.admin')

@section('title', 'Chi tiết Lịch hẹn')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h3 class="card-title">Chi tiết Lịch hẹn #{{ $appointment->id }}</h3>
                    <div>
                        <a href="{{ route('admin.appointments.edit', $appointment) }}" class="btn btn-warning btn-sm">Chỉnh sửa</a>
                        <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary btn-sm">Quay lại</a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <h5>Thông tin khách hàng</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Tên:</th>
                                    <td>{{ $appointment->customer_name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $appointment->customer_email }}</td>
                                </tr>
                                <tr>
                                    <th>Số điện thoại:</th>
                                    <td>{{ $appointment->customer_phone }}</td>
                                </tr>
                            </table>
                        </div>
                        <div class="col-md-6">
                            <h5>Thông tin lịch hẹn</h5>
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">Dịch vụ:</th>
                                    <td>{{ $appointment->service->name ?? 'N/A' }}</td>
                                </tr>
                                <tr>
                                    <th>Ngày hẹn:</th>
                                    <td>{{ $appointment->appointment_date->format('d/m/Y') }}</td>
                                </tr>
                                <tr>
                                    <th>Giờ hẹn:</th>
                                    <td>{{ $appointment->appointment_time->format('H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Trạng thái:</th>
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
                                </tr>
                                <tr>
                                    <th>Giá dự kiến:</th>
                                    <td>{{ $appointment->estimated_price ? $appointment->estimated_price. ' VND' : 'N/A' }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>

                    @if($appointment->notes)
                    <div class="row">
                        <div class="col-12">
                            <h5>Ghi chú</h5>
                            <p>{{ $appointment->notes }}</p>
                        </div>
                    </div>
                    @endif

                    <div class="row">
                        <div class="col-12">
                            <h5>Thời gian tạo</h5>
                            <p>{{ $appointment->created_at->format('d/m/Y H:i:s') }}</p>
                            @if($appointment->updated_at != $appointment->created_at)
                            <h5>Thời gian cập nhật cuối</h5>
                            <p>{{ $appointment->updated_at->format('d/m/Y H:i:s') }}</p>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
