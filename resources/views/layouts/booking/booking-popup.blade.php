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

<!-- JavaScript Dependencies and Logic -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Define onClose_Popup function
    function onClose_Popup() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('booking_Popup'));
        modal.hide();
    }

    // Toast from Laravel session
    @if (session('success'))
        Swal.fire({
            icon: 'success',
            title: 'Thành công',
            text: '{{ session('success') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif

    @if (session('error'))
        Swal.fire({
            icon: 'error',
            title: 'Thất bại',
            text: '{{ session('error') }}',
            timer: 3000,
            showConfirmButton: false,
            toast: true,
            position: 'top-end'
        });
    @endif

    // Form validation and AJAX submission
    document.querySelector('.smart-form').addEventListener('submit', function(e) {
            e.preventDefault();
            document.querySelectorAll('.text-danger[id^="error_"]').forEach(el => el.innerText = '');


        };

        if (!fields.customer_name.value) {
            document.getElementById(fields.customer_name.errorEl).innerText = 'Tên không được để trống';
            hasError = true;
        } else if (fields.customer_name.value.length < fields.customer_name.minLength) {
            document.getElementById(fields.customer_name.errorEl).innerText = 'Tên phải có ít nhất 3 ký tự';
            hasError = true;
        } else if (!fields.customer_name.regex.test(fields.customer_name.value)) {
            document.getElementById(fields.customer_name.errorEl).innerText =
                'Tên không hợp lệ, chỉ chứa chữ cái';
            hasError = true;
        }

        if (!fields.customer_phone.value) {
            document.getElementById(fields.customer_phone.errorEl).innerText =
                'Số điện thoại không được để trống';
            hasError = true;
        } else if (!fields.customer_phone.regex.test(fields.customer_phone.value)) {
            document.getElementById(fields.customer_phone.errorEl).innerText =
                'Số điện thoại phải có đúng 10 chữ số';
            hasError = true;
        }

        if (!fields.customer_email.value) {
            document.getElementById(fields.customer_email.errorEl).innerText = 'Email không được để trống';
            hasError = true;
        } else if (!fields.customer_email.regex.test(fields.customer_email.value)) {
            document.getElementById(fields.customer_email.errorEl).innerText = 'Email không hợp lệ';
            hasError = true;
        }

        if (!fields.service_id.value) {
            document.getElementById(fields.service_id.errorEl).innerText = 'Vui lòng chọn dịch vụ';
            hasError = true;
        }

        if (!fields.appointment_time.value) {
            document.getElementById(fields.appointment_time.errorEl).innerText = 'Vui lòng chọn giờ hẹn';
            hasError = true;
        }

        if (!fields.appointment_date.value) {
            document.getElementById(fields.appointment_date.errorEl).innerText = 'Vui lòng chọn ngày hẹn';
            hasError = true;
        }

        if (fields.notes.value.length > fields.notes.maxLength) {
            document.getElementById(fields.notes.errorEl).innerText = 'Ghi chú tối đa 1000 ký tự';
            hasError = true;
        }

        if (!hasError) {
            const form = this;
            fetch(form.action, {
                    method: 'POST',
                    body: new FormData(form),
                    headers: {
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        Swal.fire({
                            icon: 'success',
                            title: 'Thành công',
                            text: data.message,
                            timer: 3000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                        form.reset();
                        bootstrap.Modal.getInstance(document.getElementById('booking_Popup')).hide();
                    } else {
                        Swal.fire({
                            icon: 'error',
                            title: 'Lỗi',
                            text: data.message || 'Đã có lỗi xảy ra, vui lòng thử lại!',
                            timer: 3000,
                            showConfirmButton: false,
                            toast: true,
                            position: 'top-end'
                        });
                    }
                })
                .catch(error => {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi',
                        text: 'Đã có lỗi xảy ra, vui lòng thử lại!',
                        timer: 3000,
                        showConfirmButton: false,
                        toast: true,
                        position: 'top-end'
                    });
                });
        }
    );
</script>
