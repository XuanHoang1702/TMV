@extends('layouts.admin')

@section('title', 'Thêm lịch hẹn')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Thêm lịch hẹn mới</h3>
                        <div class="card-tools">
                            <a href="{{ route('admin.appointments.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.appointments.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="customer_name">Họ tên *</label>
                                        <input type="text"
                                            class="form-control @error('customer_name') is-invalid @enderror"
                                            id="customer_name" name="customer_name" value="{{ old('customer_name') }}"
                                            required>
                                        @error('customer_name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="customer_email">Email *</label>
                                        <input type="email"
                                            class="form-control @error('customer_email') is-invalid @enderror"
                                            id="customer_email" name="customer_email" value="{{ old('customer_email') }}"
                                            required>
                                        @error('customer_email')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="customer_phone">Số điện thoại *</label>
                                        <input type="text"
                                            class="form-control @error('customer_phone') is-invalid @enderror"
                                            id="customer_phone" name="customer_phone" value="{{ old('customer_phone') }}"
                                            required>
                                        @error('customer_phone')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="service_id">Dịch vụ</label>
                                        <select class="form-control @error('service_id') is-invalid @enderror"
                                            id="service_id" name="service_id">
                                            <option value="">Chọn dịch vụ</option>
                                            @foreach ($services as $service)
                                                <option value="{{ $service->id }}"
                                                    {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                                    {{ $service->name }}</option>
                                            @endforeach
                                        </select>
                                        @error('service_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="appointment_time">Giờ hẹn *</label>
                                        <input type="text"
                                            class="form-control @error('appointment_time') is-invalid @enderror"
                                            id="appointment_time" name="appointment_time"
                                            value="{{ old('appointment_time') }}" required>
                                        @error('appointment_time')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>


                                    <div class="form-group">
                                        <label for="status">Trạng thái</label>
                                        <select class="form-control @error('status') is-invalid @enderror" id="status"
                                            name="status">
                                            <option value="pending"
                                                {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Chờ xác nhận
                                            </option>
                                            <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>
                                                Đã xác nhận</option>
                                            <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>
                                                Hoàn thành</option>
                                            <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>
                                                Đã hủy</option>
                                        </select>
                                        @error('status')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="notes">Ghi chú</label>
                                        <textarea class="form-control @error('notes') is-invalid @enderror" id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
                                        @error('notes')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save"></i> Tạo lịch hẹn
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr("#appointment_time", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "H:i",
        time_24hr: true,
    });
</script>
