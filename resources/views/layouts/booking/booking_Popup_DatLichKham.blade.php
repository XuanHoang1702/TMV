<div class="cl-sec04">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="h-sec4-info">
                    <h4>ĐẶT LỊCH KHÁM NGAY!</h4>
                    <p>Để được tư vấn trực tiếp bởi Dr. Đạt, hãy để lại thông tin của bạn ngay tại đây nhé!</p>
                </div>
            </div>
            <div class="col-12 col-sm-6 h-sec4-form">
                <!-- Debug Route -->
                <p>Debug: Form action = {{ route('appointments.store') }}</p>
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{ route('appointments.store') }}" method="POST" class="smart-form">
                    @csrf
                    <input type="hidden" name="datlichkham" value="1">
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <label for="customer_name" class="form-label">Họ & tên</label>
                            <input type="text" id="customer_name" name="customer_name" placeholder="Họ & tên" class="ctr-h-input" value="{{ old('customer_name') }}" required />
                            <div class="text-danger" id="error_customer_name"></div>
                            @error('customer_name')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="customer_email" class="form-label">Email</label>
                            <input type="email" id="customer_email" name="customer_email" placeholder="Email" class="ctr-h-input" value="{{ old('customer_email') }}" required />
                            <div class="text-danger" id="error_customer_email"></div>
                            @error('customer_email')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-12 col-sm-4">
                            <label for="customer_phone" class="form-label">Số điện thoại</label>
                            <input type="text" id="customer_phone" name="customer_phone" placeholder="Số điện thoại" class="ctr-h-input" value="{{ old('customer_phone') }}" required />
                            <div class="text-danger" id="error_customer_phone"></div>
                            @error('customer_phone')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <button type="submit" class="cl-btn-full" id="submit-btn">
                                <span>Gọi lại cho tôi</span>
                                <i class="fa fa-angle-right"></i>
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Toast notifications
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

    // Form validation
    document.querySelector('.smart-form').addEventListener('submit', function(e) {
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.disabled = true; // Prevent double submission

        // Clear previous errors
        document.querySelectorAll('.text-danger[id^="error_"]').forEach(el => el.innerText = '');

        let hasError = false;
        let name = document.querySelector('[name="customer_name"]').value.trim();
        let email = document.querySelector('[name="customer_email"]').value.trim();
        let phone = document.querySelector('[name="customer_phone"]').value.trim();

        // Validate name
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
        } else if (!/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/.test(email)) {
            document.getElementById('COORD:email').innerText = 'Email không hợp lệ';
            hasError = true;
        }

        // Validate phone
        let invalidNumbers = ['0000000000', '1234567890', '1111111111', '2222222222'];
        if (!phone) {
            document.getElementById('error_customer_phone').innerText = 'Số điện thoại không được để trống';
            hasError = true;
        } else if (!/^\d{10}$/.test(phone) || !/^(03|05|07|08|09)/.test(phone) || invalidNumbers.includes(phone)) {
            document.getElementById('error_customer_phone').innerText = 'Số điện thoại không hợp lệ';
            hasError = true;
        }

        if (hasError) {
            e.preventDefault();
            submitBtn.disabled = false; // Re-enable button
            console.log('Validation failed:', { name, email, phone });
        } else {
            console.log('Validation passed, submitting form:', { name, email, phone });
        }
    });
</script>
