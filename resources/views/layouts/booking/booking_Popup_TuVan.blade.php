{{-- <div id="booking_Popup_TuVan" class="modal fade cl-bgPop" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" style="max-width: 30%;">
        <div class="modal-content">
            <div class="modal-header" style="flex-direction: unset;">
                <h5 id="myModalLabel" class="modal-title" style="font-weight: bold">
                    BẠN CẦN TƯ VẤN?
                </h5>
                <p>Để lại thông tin cho chúng tôi</p>
                <button type="button" class="btn btn-pop" data-bs-dismiss="modal" aria-label="Close" onclick="onClose_Popup2()"><i class="fa fa-times"></i></button>
            </div>
            <form action="{{ route('appointments.store') }}" method="POST" class="smart-form">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <input type="text" name="customer_name" placeholder="Họ & tên" class="ctr-h-input" value="{{ old('customer_name') }}" required />
                        <div class="text-danger" id="error_customer_name"></div>
                        @error('customer_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12">
                        <input type="email" name="customer_email" placeholder="Email" class="ctr-h-input" value="{{ old('customer_email') }}" required />
                        <div class="text-danger" id="error_customer_email"></div>
                        @error('customer_email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12">
                        <input type="text" name="customer_phone" placeholder="Số điện thoại" class="ctr-h-input" value="{{ old('customer_phone') }}" required />
                        <div class="text-danger" id="error_customer_phone"></div>
                        @error('customer_phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <textarea name="notes" rows="3" placeholder="Ghi chú" class="ctr-h-input" required>{{ old('notes') }}</textarea>
                        <div class="text-danger" id="error_notes"></div>
                        @error('notes')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <button type="submit" class="cl-btn-full">
                            <span>Gửi thông tin</span>
                            <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Toast từ session Laravel
    @if(session('success'))
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

    @if(session('error'))
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

    // Validation cho form
    document.querySelector('.smart-form').addEventListener('submit', function(e) {
        // Xóa lỗi cũ
        document.querySelectorAll('.text-danger[id^="error_"]').forEach(el => el.innerText = '');

        let hasError = false;
        let name = document.querySelector('[name="customer_name"]').value.trim();
        let email = document.querySelector('[name="customer_email"]').value.trim();
        let phone = document.querySelector('[name="customer_phone"]').value.trim();


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

        // Validate email
        if (!email) {
            document.getElementById('error_customer_email').innerText = 'Email không được để trống';
            hasError = true;
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            document.getElementById('error_customer_email').innerText = 'Email không hợp lệ';
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


        if (hasError) e.preventDefault();
    });

    // Hiệu ứng cuộn mượt khi nhấp vào nút mở popup
    document.querySelectorAll('.open-tuvan-popup').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            const popup = document.getElementById('booking_Popup_TuVan');
            popup.scrollIntoView({ behavior: 'smooth', block: 'center' });
            // Mở popup bằng Bootstrap
            const modal = new bootstrap.Modal(popup);
            modal.show();
        });
    });
</script> --}}
