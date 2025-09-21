@extends('layouts.admin')

@section('title', 'Chỉnh sửa Liên hệ')

@push('styles')
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<style>
    .time-input-group .input-group-text {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #6c757d;
        font-weight: 500;
    }

    .working-hours-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .hour-item {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
    }

    .hour-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #495057;
    }

    .reminder-note {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border: 1px solid #2196f3;
        border-radius: 0.375rem;
        padding: 1rem;
        margin-top: 0.5rem;
        display: flex;
        align-items: center;
        gap: 0.75rem;
        font-size: 0.9rem;
        color: #495057;
    }

    .reminder-note i {
        color: #007bff;
        font-size: 1.2rem;
    }

    /* Flatpickr custom styles */
    .flatpickr-input {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        width: 100%;
    }

    .flatpickr-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .flatpickr-calendar {
        border-radius: 0.375rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .flatpickr-time input {
        color: #495057;
    }

    .flatpickr-time .numInputWrapper:hover {
        background: #e9ecef;
    }

    .flatpickr-time .arrowUp, .flatpickr-time .arrowDown {
        color: #007bff;
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">✏️ Chỉnh sửa Thông tin liên hệ</h3>
                <div>
                    <span class="badge bg-primary me-2">{{ $information->name }}</span>
                    <a href="{{ route('admin.informations.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Danh sách
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.informations.update', $information->id) }}" method="POST" id="contactForm">
                    @csrf
                    @method('PUT')

                    <!-- Basic Info -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">🏢 Tên <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $information->name) }}"
                                   placeholder="Tên công ty/đơn vị"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">📧 Email <span class="text-danger">*</span></label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $information->email) }}"
                                   placeholder="example@company.com"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Address Section -->
                    <div class="mb-4">
                        <label class="form-label">📍 Địa chỉ <span class="text-danger">*</span></label>
                        <div class="mb-3">
                            <input type="text"
                                   name="address"
                                   id="addressInput"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{ old('address', $information->address) }}"
                                   placeholder="Nhập địa chỉ (VD: 435/67 Huỳnh Tấn Phát, Quận 7)"
                                   readonly>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="reminder-note">
                            <i class="fas fa-info-circle"></i>
                            <span>Để thay đổi địa chỉ, vui lòng xóa liên hệ hiện tại và tạo mới trong phần "Thêm mới Liên hệ".</span>
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div class="mb-4">
                        <h5 class="mb-3"><i class="fas fa-clock me-2 text-primary"></i>⏰ Thời gian làm việc</h5>
                        <div class="working-hours-grid">
                            <div class="hour-item">
                                <div class="hour-title">📅 Thứ 2 - Thứ 6</div>
                                <div class="input-group">
                                    <input type="text" name="working_time[monday_friday][open]" class="form-control flatpickr-time"
                                           value="{{ old('working_time.monday_friday.open', $information->working_time['monday_friday']['open'] ?? '08:00') }}">
                                    <span class="input-group-text">-</span>
                                    <input type="text" name="working_time[monday_friday][close]" class="form-control flatpickr-time"
                                           value="{{ old('working_time.monday_friday.close', $information->working_time['monday_friday']['close'] ?? '18:00') }}">
                                </div>
                            </div>
                            <div class="hour-item">
                                <div class="hour-title">🗓️ Thứ 7</div>
                                <div class="input-group">
                                    <input type="text" name="working_time[saturday][open]" class="form-control flatpickr-time"
                                           value="{{ old('working_time.saturday.open', $information->working_time['saturday']['open'] ?? '08:00') }}">
                                    <span class="input-group-text">-</span>
                                    <input type="text" name="working_time[saturday][close]" class="form-control flatpickr-time"
                                           value="{{ old('working_time.saturday.close', $information->working_time['saturday']['close'] ?? '12:00') }}">
                                </div>
                            </div>
                            <div class="hour-item">
                                <div class="hour-title">📆 Chủ nhật</div>
                                <input type="text" name="working_time[sunday]" class="form-control"
                                       value="{{ old('working_time.sunday', $information->working_time['sunday'] ?? 'Nghỉ') }}"
                                       placeholder="Nghỉ hoặc giờ làm việc">
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="hotline" class="form-label">📞 Hotline</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" name="hotline" id="hotline" class="form-control @error('hotline') is-invalid @enderror"
                                       value="{{ old('hotline', $information->hotline) }}" placeholder="0123 456 789">
                            </div>
                            @error('hotline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="website" class="form-label">🌐 Website</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror"
                                       value="{{ old('website', $information->website) }}" placeholder="https://example.com">
                            </div>
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.informations.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Hủy
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>💾 Cập nhật thông tin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vi.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Initialize Flatpickr for time inputs
    flatpickr('.flatpickr-time', {
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        time_24hr: true,
        locale: 'vi',
        minuteIncrement: 5,
        defaultHour: 8,
        defaultMinute: 0
    });

    const form = document.getElementById('contactForm');

    form.addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const address = document.getElementById('addressInput').value.trim();

        if (!name) {
            e.preventDefault();
            alert('Vui lòng nhập tên!');
            return false;
        }

        if (!email) {
            e.preventDefault();
            alert('Vui lòng nhập email!');
            return false;
        }

        if (!address) {
            e.preventDefault();
            alert('Vui lòng nhập địa chỉ!');
            return false;
        }
    });

    const hotlineInput = document.getElementById('hotline');
    if (hotlineInput) {
        hotlineInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 10) value = value.slice(0, 10);
            e.target.value = value;
        });
    }

    const websiteInput = document.getElementById('website');
    if (websiteInput) {
        websiteInput.addEventListener('blur', function(e) {
            let value = e.target.value.trim();
            if (value && !value.startsWith('http')) {
                e.target.value = 'https://' + value;
            }
        });
    }
});
</script>
@endpush
