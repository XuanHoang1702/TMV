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
                                    <label for="name">Họ tên *</label>
                                    <input type="text" class="form-control @error('name') is-invalid @enderror"
                                           id="name" name="name" value="{{ old('name') }}" required>
                                    @error('name')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="email">Email *</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                                           id="email" name="email" value="{{ old('email') }}" required>
                                    @error('email')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="phone">Số điện thoại *</label>
                                    <input type="text" class="form-control @error('phone') is-invalid @enderror"
                                           id="phone" name="phone" value="{{ old('phone') }}" required>
                                    @error('phone')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="service">Dịch vụ</label>
                                    <select class="form-control @error('service') is-invalid @enderror" id="service" name="service">
                                        <option value="">Chọn dịch vụ</option>
                                        <option value="phau-thuat-tham-my-co-be" {{ old('service') == 'phau-thuat-tham-my-co-be' ? 'selected' : '' }}>Phẫu thuật thẩm mỹ cô bé</option>
                                        <option value="phau-thuat-tham-my-nguc" {{ old('service') == 'phau-thuat-tham-my-nguc' ? 'selected' : '' }}>Phẫu thuật thẩm mỹ ngực</option>
                                        <option value="phau-thuat-tham-my-mong" {{ old('service') == 'phau-thuat-tham-my-mong' ? 'selected' : '' }}>Phẫu thuật thẩm mỹ mông</option>
                                        <option value="hut-mo-cay-mo" {{ old('service') == 'hut-mo-cay-mo' ? 'selected' : '' }}>Hút mỡ, cấy mỡ</option>
                                        <option value="phau-thuat-tham-my-mat" {{ old('service') == 'phau-thuat-tham-my-mat' ? 'selected' : '' }}>Phẫu thuật thẩm mỹ mắt</option>
                                        <option value="phau-thuat-tham-my-mui" {{ old('service') == 'phau-thuat-tham-my-mui' ? 'selected' : '' }}>Phẫu thuật thẩm mỹ mũi</option>
                                        <option value="phau-thuat-tham-my-mat" {{ old('service') == 'phau-thuat-tham-my-mat' ? 'selected' : '' }}>Phẫu thuật thẩm mỹ mặt</option>
                                        <option value="tham-my-noi-khoa" {{ old('service') == 'tham-my-noi-khoa' ? 'selected' : '' }}>Thẩm mỹ nội khoa</option>
                                    </select>
                                    @error('service')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="appointment_date">Ngày hẹn *</label>
                                    <input type="date" class="form-control @error('appointment_date') is-invalid @enderror"
                                           id="appointment_date" name="appointment_date" value="{{ old('appointment_date') }}" required>
                                    @error('appointment_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="appointment_time">Giờ hẹn *</label>
                                    <input type="time" class="form-control @error('appointment_time') is-invalid @enderror"
                                           id="appointment_time" name="appointment_time" value="{{ old('appointment_time') }}" required>
                                    @error('appointment_time')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="status">Trạng thái</label>
                                    <select class="form-control @error('status') is-invalid @enderror" id="status" name="status">
                                        <option value="pending" {{ old('status', 'pending') == 'pending' ? 'selected' : '' }}>Chờ xác nhận</option>
                                        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Đã xác nhận</option>
                                        <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Hoàn thành</option>
                                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Đã hủy</option>
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="notes">Ghi chú</label>
                                    <textarea class="form-control @error('notes') is-invalid @enderror"
                                              id="notes" name="notes" rows="3">{{ old('notes') }}</textarea>
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
