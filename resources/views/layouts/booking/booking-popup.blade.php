@if (session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if ($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
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
                    <div class="col-12">
                        <input type="text" name="customer_name" placeholder="Họ & tên" class="ctr-h-input"
                            style="border-radius: 8px;" required />
                        <div class="text-danger" id="error_customer_name"></div>
                    </div>
                    <div class="col-12">
                        <input type="text" name="customer_phone" placeholder="Số điện thoại" class="ctr-h-input"
                            style="border-radius: 8px;" required />
                        <div class="text-danger" id="error_customer_phone"></div>
                    </div>
                    <div class="col-12">
                        <select name="service_id" class="ctr-h-input" id="service_id" style="border-radius: 8px;">
                            <option value="">Chọn dịch vụ</option>
                            @foreach ($services->whereNull('parent_id') as $parent)
                                <optgroup label="{{ $parent->name }}">
                                    @foreach ($parent->children as $child)
                                        <option value="{{ $child->id }}">{{ $child->name }}</option>
                                    @endforeach
                                </optgroup>
                            @endforeach
                        </select>
                        <div class="text-danger" id="error_service_id"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-6">
                        <input type="text" id="appointment_time" name="appointment_time" placeholder="Chọn giờ hẹn"
                            class="ctr-h-input" style="border-radius: 8px;"
                            value="{{ now()->setTimezone('Asia/Ho_Chi_Minh')->format('H:i') }}" required />
                        <div class="text-danger" id="error_appointment_time"></div>
                    </div>
                    <div class="col-6">
                        <input type="date" name="appointment_date" placeholder="Chọn ngày hẹn" class="ctr-h-input"
                            style="border-radius: 8px;"
                            value="{{ now()->setTimezone('Asia/Ho_Chi_Minh')->format('Y-m-d') }}" required />
                        <div class="text-danger" id="error_appointment_date"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
                        <textarea name="notes" rows="3" placeholder="Ghi chú" class="ctr-h-input"
                            style="border-radius: 8px;"></textarea>
                        <div class="text-danger" id="error_notes"></div>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12">
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

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

<script>
    function onClose_Popup() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('booking_Popup'));
        modal.hide();
    }

    document.addEventListener('DOMContentLoaded', function() {
        const form = document.querySelector('.smart-form');
        if (!form) return;

        const fields = {
            customer_name: {
                element: form.querySelector('input[name="customer_name"]'),
                errorEl: 'error_customer_name',
                minLength: 3,
                regex: /^[a-zA-ZÀ-ỹ\s]+$/,
                messages: {
                    required: 'Họ và tên không được để trống',
                    minLength: 'Họ và tên phải có ít nhất 3 ký tự',
                    pattern: 'Họ và tên chỉ chứa chữ cái và dấu cách'
                }
            },
            customer_phone: {
                element: form.querySelector('input[name="customer_phone"]'),
                errorEl: 'error_customer_phone',
                regex: /^[0-9]{10}$/,
                messages: {
                    required: 'Số điện thoại không được để trống',
                    pattern: 'Số điện thoại phải có đúng 10 chữ số'
                }
            },
            service_id: {
                element: form.querySelector('select[name="service_id"]'),
                errorEl: 'error_service_id',
                messages: { required: 'Vui lòng chọn dịch vụ' }
            },
            appointment_time: {
                element: form.querySelector('input[name="appointment_time"]'),
                errorEl: 'error_appointment_time',
                messages: { required: 'Vui lòng chọn giờ hẹn' }
            },
            appointment_date: {
                element: form.querySelector('input[name="appointment_date"]'),
                errorEl: 'error_appointment_date',
                messages: {
                    required: 'Vui lòng chọn ngày hẹn',
                    futureDate: 'Ngày hẹn không được nhỏ hơn ngày hiện tại'
                }
            },
            notes: {
                element: form.querySelector('textarea[name="notes"]'),
                errorEl: 'error_notes',
                maxLength: 1000,
                messages: { maxLength: 'Ghi chú tối đa 1000 ký tự' }
            }
        };

        function validateField(field) {
            const errorEl = document.getElementById(field.errorEl);
            const value = field.element.value.trim();
            errorEl.innerText = '';
            field.element.classList.remove('is-invalid', 'is-valid');

            let isValid = true, msg = '';

            if (field === fields.customer_name) {
                if (!value) { msg = field.messages.required; isValid = false; }
                else if (value.length < field.minLength) { msg = field.messages.minLength; isValid = false; }
                else if (!field.regex.test(value)) { msg = field.messages.pattern; isValid = false; }
            } else if (field === fields.customer_phone) {
                if (!value) { msg = field.messages.required; isValid = false; }
                else if (!field.regex.test(value)) { msg = field.messages.pattern; isValid = false; }
            } else if (field === fields.service_id) {
                if (!value) { msg = field.messages.required; isValid = false; }
            } else if (field === fields.appointment_time) {
                if (!value) { msg = field.messages.required; isValid = false; }
            } else if (field === fields.appointment_date) {
                if (!value) { msg = field.messages.required; isValid = false; }
                else {
                    const sel = new Date(value), today = new Date(); today.setHours(0,0,0,0);
                    if (sel < today) { msg = field.messages.futureDate; isValid = false; }
                }
            } else if (field === fields.notes) {
                if (value && value.length > field.maxLength) { msg = field.messages.maxLength; isValid = false; }
            }

            if (!isValid) {
                errorEl.innerText = msg;
                field.element.classList.add('is-invalid');
            } else if (value) {
                field.element.classList.add('is-valid');
            }
            return isValid;
        }

        form.addEventListener('submit', function(e) {
            e.preventDefault();
            Object.values(fields).forEach(f => {
                document.getElementById(f.errorEl).innerText = '';
                f.element.classList.remove('is-invalid', 'is-valid');
            });

            let hasError = false;
            Object.values(fields).forEach(f => { if (!validateField(f)) hasError = true; });
            if (hasError) return;

            const submitBtn = document.getElementById('submit-btn');
            submitBtn.disabled = true;
            submitBtn.innerHTML = '<span>Đang gửi...</span><i class="fa fa-spinner fa-spin"></i>';

            fetch(form.action, {
                method: 'POST',
                body: new FormData(form),
                headers: { 'X-Requested-With': 'XMLHttpRequest', 'Accept': 'application/json' }
            })
            .then(r => r.json())
            .then(data => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Đặt lịch ngay</span><i class="fa fa-angle-right"></i>';
                if (data.success) {
                    form.reset();
                    const now = new Date();
                    form.querySelector('input[name="appointment_time"]').value = now.toTimeString().slice(0,5);
                    form.querySelector('input[name="appointment_date"]').value = now.toISOString().split('T')[0];
                    const modal = bootstrap.Modal.getInstance(document.getElementById('booking_Popup'));
                    if (modal) modal.hide();
                } else if (data.errors) {
                    Object.keys(data.errors).forEach(k => {
                        const el = document.getElementById(`error_${k}`);
                        if (el) el.innerText = data.errors[k][0];
                        if (fields[k]) fields[k].element.classList.add('is-invalid');
                    });
                }
            })
            .catch(() => {
                submitBtn.disabled = false;
                submitBtn.innerHTML = '<span>Đặt lịch ngay</span><i class="fa fa-angle-right"></i>';
            });
        });
    });
</script>
