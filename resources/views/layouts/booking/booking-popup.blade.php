{{-- Đảm bảo file này được include trong layout có @yield('content') --}}
<div id="booking_Popup" class="modal fade cl-bgPop" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" style="max-width: 35%;">
        <div class="modal-content" style="border-radius: 15px; overflow: hidden;">
            <div class="modal-header" style="flex-direction: unset;">
                <h5 id="myModalLabel" class="modal-title" style="font-weight: bold;">
                    ĐẶT LỊCH HẸN TƯ VẤN THẨM MỸ
                </h5>
                <p>Hãy để chúng tôi giúp bạn trở nên tự tin và rạng rỡ hơn</p>
                <button type="button" class="btn btn-pop" data-bs-dismiss="modal" aria-label="Close"
                    onclick="onClose_Popup()"><i class="fa fa-times"></i></button>
            </div>
            <form action="{{ route('appointments.store') }}" method="POST" class="smart-form">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <input type="text" name="customer_name" placeholder="Họ & tên" class="ctr-h-input"
                            style="border-radius: 8px;" value="{{ old('customer_name') }}" required />
                        <div class="text-danger" id="error_customer_name"></div>
                        @error('customer_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12">
                        <input type="text" name="customer_phone" placeholder="Số điện thoại" class="ctr-h-input"
                            style="border-radius: 8px;" value="{{ old('customer_phone') }}" required />
                        <div class="text-danger" id="error_customer_phone"></div>
                        @error('customer_phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12">
                        <input type="email" name="customer_email" placeholder="Email" class="ctr-h-input"
                            style="border-radius: 8px;" value="{{ old('customer_email') }}" required />
                        <div class="text-danger" id="error_customer_email"></div>
                        @error('customer_email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12">
                        <select name="service_id" class="ctr-h-input" id="service_id" style="border-radius: 8px;">
                            <option value="">Chọn dịch vụ</option>
                            @foreach ($services->whereNull('parent_id') as $parent)
                                <optgroup label="{{ $parent->name }}">
                                    @foreach ($parent->children as $child)
                                        <option value="{{ $child->id }}"
                                            {{ old('service_id') == $child->id ? 'selected' : '' }}>
                                            &nbsp;&nbsp;&nbsp;&nbsp;{{ $child->name }}
                                        </option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <div class="text-danger" id="error_service_id"></div>
                        @error('service_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6">
                        <input type="text"
                               name="appointment_time"
                               id="appointment_time"
                               placeholder="Chọn giờ hẹn"
                               class="ctr-h-input flatpickr-input"
                               style="border-radius: 8px;"
                               value="{{ old('appointment_time', now()->setTimezone('Asia/Ho_Chi_Minh')->format('H:i')) }}"
                               required />
                        <div class="text-danger" id="error_appointment_time"></div>
                        @error('appointment_time')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="text"
                               name="appointment_date"
                               id="appointment_date"
                               placeholder="Chọn ngày hẹn"
                               class="ctr-h-input flatpickr-input"
                               style="border-radius: 8px;"
                               value="{{ old('appointment_date', now()->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y')) }}"
                               required />
                        <div class="text-danger" id="error_appointment_date"></div>
                        @error('appointment_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12">
                        <textarea name="notes" rows="3" placeholder="Ghi chú" class="ctr-h-input"
                            style="border-radius: 8px;">{{ old('notes') }}</textarea>
                        <div class="text-danger" id="error_notes"></div>
                        @error('notes')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12">
                        <button type="submit" class="cl-btn-full" style="border-radius: 8px;">
                            <span>Đặt lịch ngay</span>
                            <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Styling chung cho Flatpickr - đồng nhất kích thước */
.flatpickr-calendar {
    font-family: 'Arial', sans-serif;
    border-radius: 8px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.15);
    border: none;
    background: white;
    width: 280px;
    min-height: 320px;
}

.flatpickr-calendar-vietnamese .flatpickr-months,
.flatpickr-time-vietnamese .flatpickr-months {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
    border-radius: 8px 8px 0 0;
    color: white;
    padding: 15px;
    height: 60px;
}

.flatpickr-calendar .flatpickr-days {
    padding: 10px;
    height: 200px;
    display: flex;
    flex-wrap: wrap;
    align-content: flex-start;
}

.flatpickr-calendar .flatpickr-day {
    border-radius: 4px;
    border: 1px solid transparent;
    transition: all 0.2s ease;
    width: 36px;
    height: 36px;
    margin: 2px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 14px;
}

.flatpickr-calendar .flatpickr-day:hover,
.flatpickr-calendar .flatpickr-day:focus {
    background: #f8f9fa;
    border-color: #667eea;
    color: #333;
    transform: scale(1.05);
}

.flatpickr-calendar .flatpickr-day.selected {
    background: #667eea;
    border-color: #667eea;
    color: white;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.3);
}

.flatpickr-time-vietnamese .flatpickr-time {
    padding: 20px;
    height: 200px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    gap: 15px;
    background: white;
    border-radius: 0 0 8px 8px;
}

.flatpickr-time-vietnamese .flatpickr-time .numInputWrapper {
    display: inline-block;
    margin: 5px;
}

.flatpickr-time-vietnamese .flatpickr-time input {
    width: 80px !important;
    height: 50px !important;
    font-size: 18px !important;
    font-weight: bold;
    text-align: center;
    border: 2px solid #e9ecef !important;
    border-radius: 8px !important;
    background: white !important;
    color: #333 !important;
    padding: 5px !important;
}

.flatpickr-time-vietnamese .flatpickr-time input:hover {
    border-color: #667eea !important;
    background: #f8f9fa !important;
    box-shadow: 0 2px 8px rgba(102, 126, 234, 0.1);
}

.flatpickr-time-vietnamese .flatpickr-time input:focus {
    outline: none;
    border-color: #667eea !important;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25) !important;
}

.flatpickr-time-vietnamese .flatpickr-am-pm {
    width: 80px !important;
    height: 50px !important;
    font-size: 16px !important;
    border: 2px solid #e9ecef !important;
    border-radius: 8px !important;
    background: white !important;
    color: #333 !important;
}

.flatpickr-time-vietnamese .flatpickr-am-pm:hover,
.flatpickr-time-vietnamese .flatpickr-am-pm:focus {
    border-color: #667eea !important;
    background: #f8f9fa !important;
}

.flatpickr-time-vietnamese .flatpickr-months .flatpickr-month {
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 10px;
}

.flatpickr-time-vietnamese .flatpickr-months .flatpickr-month::before {
    content: "🕐";
    font-size: 20px;
}

.ctr-h-input.flatpickr-input {
    background: white;
    border: 1px solid #ced4da;
    border-radius: 8px;
    padding: 12px 16px;
    font-size: 14px;
    transition: all 0.15s ease;
    width: 100%;
    box-sizing: border-box;
    position: relative;
}

.ctr-h-input.flatpickr-input:focus {
    border-color: #667eea;
    outline: 0;
    box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.25);
}

@media (max-width: 768px) {
    .modal-dialog {
        max-width: 95%;
        margin: 1rem;
    }

    .flatpickr-calendar {
        width: 90vw !important;
        left: 50% !important;
        transform: translateX(-50%) !important;
        min-height: 280px;
    }

    .flatpickr-time-vietnamese .flatpickr-time input {
        width: 70px !important;
        height: 45px !important;
        font-size: 16px !important;
    }

    .ctr-h-input.flatpickr-input {
        font-size: 16px;
        padding: 14px 16px;
    }
}
</style>

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://npmcdn.com/flatpickr/dist/l10n/vi.js"></script>
<script>
(function() {
    'use strict';

    // Khởi tạo Flatpickr sau khi DOM load
    document.addEventListener('DOMContentLoaded', function() {
        // Date picker - tiếng Việt
        if (document.getElementById('appointment_date')) {
            flatpickr('#appointment_date', {
                locale: 'vi',
                dateFormat: 'd/m/Y',
                minDate: 'today',
                defaultDate: '{{ old('appointment_date', now()->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y')) }}',
                onReady: function(selectedDates, dateStr, instance) {
                    instance.calendarContainer.classList.add('flatpickr-calendar-vietnamese');
                    addPickerIcon(instance.input, 'fa fa-calendar', 'date-icon');
                }
            });
        }

        // Time picker - cấu hình để có giao diện đầy đủ như date picker
        if (document.getElementById('appointment_time')) {
            flatpickr('#appointment_time', {
                locale: 'vi',
                enableTime: true,
                noCalendar: true,
                dateFormat: 'H:i',
                time_24hr: true,
                minuteIncrement: 15,
                defaultDate: '{{ old('appointment_time', now()->setTimezone('Asia/Ho_Chi_Minh')->format('H:i')) }}',
                onReady: function(selectedDates, dateStr, instance) {
                    instance.calendarContainer.classList.add('flatpickr-time-vietnamese');

                    // Tạo header giống date picker
                    const monthContainer = instance.calendarContainer.querySelector('.flatpickr-months');
                    if (monthContainer && !monthContainer.querySelector('.time-header')) {
                        const timeHeader = document.createElement('div');
                        timeHeader.className = 'time-header';
                        timeHeader.innerHTML = `
                            <div style="text-align: center; color: white; font-weight: bold; font-size: 16px;">
                                <i class="fa fa-clock" style="margin-right: 8px;"></i>Chọn giờ hẹn
                            </div>
                        `;
                        monthContainer.innerHTML = '';
                        monthContainer.appendChild(timeHeader);
                    }

                    addPickerIcon(instance.input, 'fa fa-clock', 'time-icon');
                }
            });
        }

        // Validation cho form
        const form = document.querySelector('.smart-form');
        if (form) {
            form.addEventListener('submit', function(e) {
                // Xóa lỗi cũ
                document.querySelectorAll('.text-danger[id^="error_"]').forEach(el => el.innerText = '');

                let hasError = false;
                let name = document.querySelector('[name="customer_name"]')?.value?.trim() || '';
                let phone = document.querySelector('[name="customer_phone"]')?.value?.trim() || '';
                let email = document.querySelector('[name="customer_email"]')?.value?.trim() || '';
                let service = document.querySelector('[name="service_id"]')?.value || '';
                let time = document.querySelector('[name="appointment_time"]')?.value?.trim() || '';
                let date = document.querySelector('[name="appointment_date"]')?.value?.trim() || '';
                let notes = document.querySelector('[name="notes"]')?.value?.trim() || '';

                // Validate tên
                if (!name) {
                    document.getElementById('error_customer_name').innerText = 'Tên không được để trống';
                    hasError = true;
                } else if (name.length < 3) {
                    document.getElementById('error_customer_name').innerText = 'Tên phải có ít nhất 3 ký tự';
                    hasError = true;
                } else if (!/^[a-zA-ZÀ-ỹ\s]+$/u.test(name)) {
                    document.getElementById('error_customer_name').innerText = 'Tên không hợp lệ, chỉ chứa chữ cái';
                    hasError = true;
                }

                // Validate số điện thoại
                let invalidNumbers = ['0000000000', '1234567890', '1111111111', '2222222222'];
                if (!phone) {
                    document.getElementById('error_customer_phone').innerText = 'Số điện thoại không được để trống';
                    hasError = true;
                } else if (!/^\d{10}$/.test(phone) || !/^(03|05|07|08|09)/.test(phone) || invalidNumbers.includes(phone)) {
                    document.getElementById('error_customer_phone').innerText = 'Số điện thoại không hợp lệ';
                    hasError = true;
                }

                // Validate email
                if (!email) {
                    document.getElementById('error_customer_email').innerText = 'Email không được để trống';
                    hasError = true;
                } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                    document.getElementById('error_customer_email').innerText = 'Email không hợp lệ';
                    hasError = true;
                }

                // Validate dịch vụ
                if (!service) {
                    document.getElementById('error_service_id').innerText = 'Vui lòng chọn dịch vụ';
                    hasError = true;
                }

                // Validate giờ hẹn
                if (!time) {
                    document.getElementById('error_appointment_time').innerText = 'Vui lòng chọn giờ hẹn';
                    hasError = true;
                } else if (!/^([0-1]?[0-9]|2[0-3]):[0-5][0-9]$/.test(time)) {
                    document.getElementById('error_appointment_time').innerText = 'Định dạng giờ không hợp lệ';
                    hasError = true;
                }

                // Validate ngày hẹn
                if (!date) {
                    document.getElementById('error_appointment_date').innerText = 'Vui lòng chọn ngày hẹn';
                    hasError = true;
                } else if (!/^\d{1,2}\/\d{1,2}\/\d{4}$/.test(date)) {
                    document.getElementById('error_appointment_date').innerText = 'Định dạng ngày không hợp lệ';
                    hasError = true;
                }

                // Validate ghi chú
                if (notes.length > 1000) {
                    document.getElementById('error_notes').innerText = 'Ghi chú tối đa 1000 ký tự';
                    hasError = true;
                }

                if (hasError) {
                    e.preventDefault();
                    // Focus vào field đầu tiên có lỗi
                    const firstErrorField = document.querySelector('.text-danger:not(:empty)');
                    if (firstErrorField) {
                        firstErrorField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                        const inputField = firstErrorField.previousElementSibling;
                        if (inputField && inputField.focus) {
                            inputField.focus();
                        }
                    }
                    // Hiển thị thông báo lỗi
                    if (typeof Swal !== 'undefined') {
                        Swal.fire({
                            icon: 'error',
                            title: 'Vui lòng kiểm tra lại thông tin',
                            text: 'Có một số trường thông tin chưa hợp lệ',
                            timer: 3000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    }
                }
            });
        }

        // Session messages - Pure JavaScript với data attributes
        // Kiểm tra session success
        const successMessage = document.querySelector('meta[name="session-success"]')?.getAttribute('content');
        if (successMessage && typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'success',
                title: 'Thành công',
                text: successMessage,
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }

        // Kiểm tra session error
        const errorMessage = document.querySelector('meta[name="session-error"]')?.getAttribute('content');
        if (errorMessage && typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Thất bại',
                text: errorMessage,
                timer: 3000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }

        // Kiểm tra validation errors từ Laravel
        const hasValidationErrors = document.querySelector('.text-danger:not(:empty)');
        if (hasValidationErrors && typeof Swal !== 'undefined') {
            Swal.fire({
                icon: 'error',
                title: 'Thông tin không hợp lệ',
                text: 'Vui lòng kiểm tra lại các trường thông tin',
                timer: 4000,
                showConfirmButton: false,
                toast: true,
                position: 'top-end'
            });
        }
    });

    // Hàm helper để thêm icon cho picker
    function addPickerIcon(input, iconClass, iconId) {
        if (!input) return;
        const inputWrapper = input.parentNode;
        if (!inputWrapper) return;

        inputWrapper.style.position = 'relative';
        if (!inputWrapper.querySelector('.' + iconId)) {
            const icon = document.createElement('i');
            icon.className = iconClass + ' ' + iconId;
            icon.style.cssText = `
                position: absolute;
                right: 12px;
                top: 50%;
                transform: translateY(-50%);
                color: #667eea;
                pointer-events: none;
                z-index: 1;
                font-size: 16px;
            `;
            inputWrapper.appendChild(icon);
        }
    }

    // Hiệu ứng cuộn mượt khi nhấp vào nút mở popup
    document.addEventListener('click', function(e) {
        if (e.target.closest('.open-booking-popup')) {
            e.preventDefault();
            const popup = document.getElementById('booking_Popup');
            if (popup) {
                popup.scrollIntoView({ behavior: 'smooth', block: 'center' });
                // Mở popup bằng Bootstrap
                if (typeof bootstrap !== 'undefined') {
                    const modal = new bootstrap.Modal(popup);
                    modal.show();
                }
            }
        }
    });

    // Xử lý khi đóng popup - reset form
    function setupModalEvents() {
        const popup = document.getElementById('booking_Popup');
        if (popup) {
            popup.addEventListener('hidden.bs.modal', function() {
                const form = document.querySelector('.smart-form');
                if (form) {
                    form.reset();
                    // Reset Flatpickr về giá trị mặc định
                    const datePicker = document.getElementById('appointment_date');
                    const timePicker = document.getElementById('appointment_time');

                    if (datePicker && datePicker._flatpickr) {
                        try {
                            datePicker._flatpickr.setDate('{{ now()->setTimezone("Asia/Ho_Chi_Minh")->format("d/m/Y") }}', false, 'd/m/Y');
                        } catch (e) {
                            console.warn('Could not reset date picker:', e);
                        }
                    }
                    if (timePicker && timePicker._flatpickr) {
                        try {
                            timePicker._flatpickr.setDate('{{ now()->setTimezone("Asia/Ho_Chi_Minh")->format("H:i") }}', false, 'H:i');
                        } catch (e) {
                            console.warn('Could not reset time picker:', e);
                        }
                    }

                    // Xóa tất cả lỗi
                    document.querySelectorAll('.text-danger[id^="error_"]').forEach(el => el.innerText = '');

                    // Xóa icons nếu cần
                    document.querySelectorAll('.date-icon, .time-icon').forEach(icon => {
                        if (icon && icon.parentNode) {
                            icon.parentNode.removeChild(icon);
                        }
                    });
                }
            });
        }
    }

    // Setup modal events sau khi DOM load
    document.addEventListener('DOMContentLoaded', setupModalEvents);

    // Hàm đóng popup
    window.onClose_Popup = function() {
        const popup = document.getElementById('booking_Popup');
        if (popup && typeof bootstrap !== 'undefined') {
            const modal = bootstrap.Modal.getInstance(popup);
            if (modal) {
                modal.hide();
            }
        }
    };
})();
</script>
@endpush
