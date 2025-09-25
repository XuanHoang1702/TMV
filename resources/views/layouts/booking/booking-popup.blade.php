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
                        <input type="time" name="appointment_time" placeholder="Chọn giờ hẹn" class="ctr-h-input"
                            style="border-radius: 8px;"
                            value="{{ old('appointment_time', now()->setTimezone('Asia/Ho_Chi_Minh')->format('H:i')) }}"
                            required />
                        <div class="text-danger" id="error_appointment_time"></div>
                        @error('appointment_time')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="date" name="appointment_date" placeholder="Chọn ngày hẹn" class="ctr-h-input"
                            style="border-radius: 8px;"
                            value="{{ old('appointment_date', now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d')) }}"
                            required />
                        <div class="text-danger" id="error_appointment_date"></div>
                        @error('appointment_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12">
                        <textarea name="notes" rows="3" placeholder="Ghi chú" class="ctr-h-input" style="border-radius: 8px;">{{ old('notes') }}</textarea>
                        <div class="text-danger" id="error_notes"></div>
                        @error('notes')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12">
                        <button type="submit" class="cl-btn-full" style="border-radius: 8px;" id="submit-btn">
                            <span>Đặt lịch ngay</span>
                            <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Bootstrap Toast Container -->
<div class="toast-container position-fixed top-0 end-0 p-3" style="z-index: 9999;">
    <div id="successToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="3000">
        <div class="toast-header bg-success text-white">
            <i class="fa fa-check-circle me-2"></i>
            <strong class="me-auto">Thành công!</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <span id="successMessage"></span>
        </div>
    </div>

    <div id="errorToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="5000">
        <div class="toast-header bg-danger text-white">
            <i class="fa fa-exclamation-circle me-2"></i>
            <strong class="me-auto">Lỗi!</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <span id="errorMessage"></span>
        </div>
    </div>

    <div id="loadingToast" class="toast" role="alert" aria-live="assertive" aria-atomic="true" data-bs-autohide="false">
        <div class="toast-header bg-primary text-white">
            <div class="spinner-border spinner-border-sm me-2" role="status">
                <span class="visually-hidden">Đang xử lý...</span>
            </div>
            <strong class="me-auto">Đang xử lý...</strong>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="toast" aria-label="Close"></button>
        </div>
        <div class="toast-body">
            <span>Đang gửi thông tin đặt lịch...</span>
        </div>
    </div>
</div>

<!-- CSS for better toast styling -->
<style>
.toast-container {
    z-index: 9999;
}

.toast {
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    border: none;
    border-radius: 8px;
}

.toast-header {
    border-bottom: none;
    padding: 0.75rem 1rem;
}

.toast-body {
    padding: 1rem;
    font-size: 0.875rem;
}

#loadingToast {
    display: none;
}

.ctr-h-input {
    transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.ctr-h-input.is-invalid {
    border-color: #dc3545;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.ctr-h-input.is-valid {
    border-color: #198754;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
}
</style>

<!-- JavaScript Dependencies and Logic -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // Define onClose_Popup function
    function onClose_Popup() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('booking_Popup'));
        modal.hide();
    }

    // Initialize Bootstrap toasts
    document.addEventListener('DOMContentLoaded', function() {
        // Initialize toasts
        const successToastEl = document.getElementById('successToast');
        const errorToastEl = document.getElementById('errorToast');
        const loadingToastEl = document.getElementById('loadingToast');

        const successToast = new bootstrap.Toast(successToastEl);
        const errorToast = new bootstrap.Toast(errorToastEl);
        const loadingToast = new bootstrap.Toast(loadingToastEl);

        // Toast functions
        function showSuccess(message) {
            document.getElementById('successMessage').textContent = message;
            successToast.show();
        }

        function showError(message) {
            document.getElementById('errorMessage').textContent = message;
            errorToast.show();
        }

        function showLoading() {
            loadingToastEl.style.display = 'block';
            loadingToast.show();
        }

        function hideLoading() {
            loadingToastEl.style.display = 'none';
            loadingToast.hide();
        }

        // Handle Laravel session messages
        @if (session('success'))
            showSuccess('{{ session('success') }}');
        @endif

        @if (session('error'))
            showError('{{ session('error') }}');
        @endif

        // Form validation and submission
        const form = document.querySelector('.smart-form');
        if (!form) return;

        // Validation fields configuration
        const fields = {
            customer_name: {
                element: form.querySelector('input[name="customer_name"]'),
                errorEl: 'error_customer_name',
                value: '',
                minLength: 3,
                regex: /^[a-zA-ZÀÁÂÃÈÉÊÌÍÒÓÔÕÙÚĂĐĨŨƠàáâãèéêìíòóôõùúăđĩũơƯĂẠẢẤẦẨẪẬẮẰẲẴẶẸẺẼỀỀỂỄỆỈỊỌỎỐỒỔỖỘỚỜỞỠỢỤỦỨỪễỬỮỰỲỴÝỶỸ\s]+$/,
                messages: {
                    required: 'Họ và tên không được để trống',
                    minLength: 'Họ và tên phải có ít nhất 3 ký tự',
                    pattern: 'Họ và tên chỉ chứa chữ cái và dấu cách'
                }
            },
            customer_phone: {
                element: form.querySelector('input[name="customer_phone"]'),
                errorEl: 'error_customer_phone',
                value: '',
                regex: /^[0-9]{10}$/,
                messages: {
                    required: 'Số điện thoại không được để trống',
                    pattern: 'Số điện thoại phải có đúng 10 chữ số'
                }
            },
            service_id: {
                element: form.querySelector('select[name="service_id"]'),
                errorEl: 'error_service_id',
                value: '',
                messages: {
                    required: 'Vui lòng chọn dịch vụ'
                }
            },
            appointment_time: {
                element: form.querySelector('input[name="appointment_time"]'),
                errorEl: 'error_appointment_time',
                value: '',
                messages: {
                    required: 'Vui lòng chọn giờ hẹn'
                }
            },
            appointment_date: {
                element: form.querySelector('input[name="appointment_date"]'),
                errorEl: 'error_appointment_date',
                value: '',
                messages: {
                    required: 'Vui lòng chọn ngày hẹn',
                    futureDate: 'Ngày hẹn không được nhỏ hơn ngày hiện tại'
                }
            },
            notes: {
                element: form.querySelector('textarea[name="notes"]'),
                errorEl: 'error_notes',
                value: '',
                maxLength: 1000,
                messages: {
                    maxLength: 'Ghi chú tối đa 1000 ký tự'
                }
            }
        };

        // Real-time validation function
        function validateField(field) {
            if (!field.element) return;

            const errorEl = document.getElementById(field.errorEl);
            const value = field.element.value.trim();
            field.value = value;

            // Clear previous error and styling
            errorEl.innerText = '';
            field.element.classList.remove('is-invalid', 'is-valid');

            let isValid = true;
            let errorMessage = '';

            if (field === fields.customer_name) {
                if (!value) {
                    errorMessage = field.messages.required;
                    isValid = false;
                } else if (value.length < field.minLength) {
                    errorMessage = field.messages.minLength;
                    isValid = false;
                } else if (!field.regex.test(value)) {
                    errorMessage = field.messages.pattern;
                    isValid = false;
                }
            } else if (field === fields.customer_phone) {
                if (!value) {
                    errorMessage = field.messages.required;
                    isValid = false;
                } else if (!field.regex.test(value)) {
                    errorMessage = field.messages.pattern;
                    isValid = false;
                }
            } else if (field === fields.service_id) {
                if (!value) {
                    errorMessage = field.messages.required;
                    isValid = false;
                }
            } else if (field === fields.appointment_time) {
                if (!value) {
                    errorMessage = field.messages.required;
                    isValid = false;
                }
            } else if (field === fields.appointment_date) {
                if (!value) {
                    errorMessage = field.messages.required;
                    isValid = false;
                } else {
                    const selectedDate = new Date(value);
                    const today = new Date();
                    today.setHours(0, 0, 0, 0);
                    if (selectedDate < today) {
                        errorMessage = field.messages.futureDate;
                        isValid = false;
                    }
                }
            } else if (field === fields.notes) {
                if (value && value.length > field.maxLength) {
                    errorMessage = field.messages.maxLength;
                    isValid = false;
                }
            }

            if (!isValid) {
                errorEl.innerText = errorMessage;
                field.element.classList.add('is-invalid');
            } else if (value) {
                field.element.classList.add('is-valid');
            }

            return isValid;
        }

        // Form submit handler
        form.addEventListener('submit', function(e) {
            e.preventDefault();

            // Clear all previous errors
            Object.values(fields).forEach(field => {
                const errorEl = document.getElementById(field.errorEl);
                if (errorEl) errorEl.innerText = '';
                if (field.element) {
                    field.element.classList.remove('is-invalid', 'is-valid');
                }
            });

            let hasError = false;

            // Validate all fields
            Object.values(fields).forEach(field => {
                if (!validateField(field)) {
                    hasError = true;
                }
            });

            if (hasError) {
                showError('Vui lòng kiểm tra lại thông tin đã nhập!');
                return;
            }

            // Show loading and disable submit button
            showLoading();
            const submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>Đang gửi...</span><i class="fa fa-spinner fa-spin"></i>';

            // Submit via AJAX
            const formData = new FormData(form);

            fetch(form.action, {
                method: 'POST',
                body: formData,
                headers: {
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                }
            })
            .then(response => response.json())
            .then(data => {
                hideLoading();
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Đặt lịch ngay</span><i class="fa fa-angle-right"></i>';

                if (data.success) {
                    showSuccess(data.message || 'Đặt lịch hẹn thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.');

                    // Reset form and modal
                    form.reset();

                    // Reset default values
                    const now = new Date();
                    form.querySelector('input[name="appointment_time"]').value = now.toTimeString().slice(0, 5);
                    form.querySelector('input[name="appointment_date"]').value = now.toISOString().split('T')[0];

                    // Hide modal
                    setTimeout(() => {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('booking_Popup'));
                        if (modal) modal.hide();
                    }, 500);
                } else {
                    // Handle validation errors from server
                    if (data.errors) {
                        Object.keys(data.errors).forEach(key => {
                            const errorEl = document.getElementById(`error_${key}`);
                            if (errorEl) {
                                errorEl.innerText = data.errors[key][0];
                            }
                        });

                        // Add invalid class to fields with errors
                        Object.keys(data.errors).forEach(key => {
                            const field = fields[key];
                            if (field && field.element) {
                                field.element.classList.add('is-invalid');
                            }
                        });
                    }

                    showError(data.message || 'Đã có lỗi xảy ra, vui lòng thử lại!');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                hideLoading();
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Đặt lịch ngay</span><i class="fa fa-angle-right"></i>';
                showError('Đã có lỗi xảy ra, vui lòng thử lại!');
            });
        });

        // Real-time validation for better UX
        Object.values(fields).forEach(field => {
            if (field.element) {
                // Validate on blur
                field.element.addEventListener('blur', function() {
                    validateField(field);
                });

                // Validate on input for better UX (except select)
                if (field.element.tagName !== 'SELECT') {
                    field.element.addEventListener('input', function() {
                        // Clear error on typing
                        const errorEl = document.getElementById(field.errorEl);
                        if (errorEl && !this.classList.contains('is-invalid')) {
                            errorEl.innerText = '';
                        }

                        // Remove invalid class while typing
                        this.classList.remove('is-invalid');

                        // Add valid class if valid
                        if (this.value.trim() && validateField(field)) {
                            this.classList.add('is-valid');
                        }
                    });
                }
            }
        });

        // Handle modal close - clear errors
        const modalElement = document.getElementById('booking_Popup');
        modalElement.addEventListener('hidden.bs.modal', function () {
            // Clear all errors when modal is closed
            Object.values(fields).forEach(field => {
                const errorEl = document.getElementById(field.errorEl);
                if (errorEl) errorEl.innerText = '';
                if (field.element) {
                    field.element.classList.remove('is-invalid', 'is-valid');
                }
            });
        });
    });
</script>
