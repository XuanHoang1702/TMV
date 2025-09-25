@php
    use App\Models\HomeSection;
    $homeSection = HomeSection::where('position', '1')->where('is_active', true)->first();
@endphp

@if($homeSection)
<div class="cl-sec01-desc">
    <div class="row">
        {{-- Cột hình ảnh --}}
        <div class="col-12 col-sm-5 cl-sec01-desc-img" data-aos="zoom-in" data-aos-duration="3000">
            @if($homeSection->images && is_array($homeSection->images))
                <div class="row">
                    @foreach($homeSection->images as $index => $img)
                        @if($index < 2)
                        <div class="col-12 col-sm-6 mb-2">
                            <img src="{{ asset('storage/' . $img) }}" class="img-fluid" alt="Image {{ $index+1 }}">
                        </div>
                        @endif
                    @endforeach
                </div>
                @if(count($homeSection->images) > 2)
                <div class="row mt-2">
                    <div class="col-12">
                        <img src="{{ asset('storage/' . $homeSection->images[2]) }}" class="img-fluid" alt="Image 3">
                    </div>
                </div>
                @endif
            @endif
        </div>

        {{-- Cột nội dung --}}
        <div class="col-12 col-sm-7" data-aos="zoom-in" data-aos-duration="3000">
            <div class="cl-desc">
                <h3 class="cl-desc-title">{{ $homeSection->title }}</h3>
                <div>{!! $homeSection->content !!}</div>

                @if($homeSection->list_items && is_array($homeSection->list_items))
                <hr class="h-hr" />
                <ul class="cl-ul-desc">
                    @foreach($homeSection->list_items as $item)
                    <li>
                        <div class="dv-li-item">
                            @if(isset($item['icon']) && $item['icon'])
                                <img src="{{ asset('storage/' . $item['icon']) }}" />
                            @endif
                            <div class="dv-li-desc">
                                <h4>{{ $item['title'] ?? '' }}</h4>
                                <p>{{ $item['description'] ?? '' }}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif

                @include('layouts.booking.booking-button')
            </div>
        </div>
    </div>
</div>
@endif

<div id="booking_Popup_TuVan" class="modal fade cl-bgPop" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" style="max-width: 30%;">
        <div class="modal-content">
            <div class="modal-header" style="flex-direction: unset;">
                <h5 id="myModalLabel" class="modal-title" style="font-weight: bold">
                    BẠN CẦN TƯ VẤN?
                </h5>
                <p>Để lại thông tin cho chúng tôi</p>
                <button type="button" class="btn btn-pop" data-bs-dismiss="modal" aria-label="Close" onclick="onClose_Popup2()"><i class="fa fa-times"></i></button>
            </div>
            <form action="{{ route('appointments.store') }}" method="POST" class="smart-form" id="tuvan-form">
                @csrf
                <input type="hidden" name="datlichkham" value="1">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <input type="text" name="customer_name" placeholder="Họ & tên" class="ctr-h-input"
                               value="{{ old('customer_name') }}" required />
                        <div class="text-danger" id="error_customer_name"></div>
                        @error('customer_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12">
                        <input type="email" name="customer_email" placeholder="Email" class="ctr-h-input"
                               value="{{ old('customer_email') }}" required />
                        <div class="text-danger" id="error_customer_email"></div>
                        @error('customer_email')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12">
                        <input type="text" name="customer_phone" placeholder="Số điện thoại" class="ctr-h-input"
                               value="{{ old('customer_phone') }}" required />
                        <div class="text-danger" id="error_customer_phone"></div>
                        @error('customer_phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <textarea name="notes" rows="3" placeholder="Ghi chú" class="ctr-h-input">{{ old('notes') }}</textarea>
                        <div class="text-danger" id="error_notes"></div>
                        @error('notes')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <button type="submit" class="cl-btn-full" id="tuvan-submit-btn">
                            <span>Gửi thông tin</span>
                            <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
/* Validation styling cho popup */
.ctr-h-input.is-invalid {
    border-color: #dc3545 !important;
    box-shadow: 0 0 0 0.2rem rgba(220, 53, 69, 0.25);
}

.ctr-h-input.is-valid {
    border-color: #198754 !important;
    box-shadow: 0 0 0 0.2rem rgba(25, 135, 84, 0.25);
}

/* Button loading state cho popup */
.cl-btn-full.loading {
    opacity: 0.7;
    cursor: not-allowed;
}

.cl-btn-full.loading i {
    animation: spin 1s linear infinite;
}

@keyframes spin {
    0% { transform: rotate(0deg); }
    100% { transform: rotate(360deg); }
}
</style>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    // Define onClose_Popup2 function
    function onClose_Popup2() {
        const modal = bootstrap.Modal.getInstance(document.getElementById('booking_Popup_TuVan'));
        if (modal) {
            modal.hide();
        }
    }

    // TuVan Form validation and submission với SweetAlert2
    document.addEventListener('DOMContentLoaded', function() {
        const tuvanForm = document.getElementById('tuvan-form');
        if (!tuvanForm) return;

        // Form submit handler cho popup tư vấn
        tuvanForm.addEventListener('submit', function(e) {
            e.preventDefault();

            // Xóa lỗi cũ
            document.querySelectorAll('.text-danger[id^="error_"]').forEach(el => el.innerText = '');

            let hasError = false;
            let name = tuvanForm.querySelector('[name="customer_name"]').value.trim();
            let email = tuvanForm.querySelector('[name="customer_email"]').value.trim();
            let phone = tuvanForm.querySelector('[name="customer_phone"]').value.trim();
            let notes = tuvanForm.querySelector('[name="notes"]').value.trim();

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

            // Validate notes
            if (!notes) {
                document.getElementById('error_notes').innerText = 'Ghi chú không được để trống';
                hasError = true;
            } else if (notes.length > 1000) {
                document.getElementById('error_notes').innerText = 'Ghi chú tối đa 1000 ký tự';
                hasError = true;
            }

            if (hasError) {
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi!',
                    text: 'Vui lòng kiểm tra lại thông tin đã nhập!',
                    timer: 3000,
                    showConfirmButton: false
                });
                return;
            }

            // Show loading và disable button
            const submitBtn = document.getElementById('tuvan-submit-btn');
            if (submitBtn) {
                submitBtn.disabled = true;
                submitBtn.classList.add('loading');
                submitBtn.innerHTML = '<span>Đang gửi...</span><i class="fa fa-spinner"></i>';
            }

            // Show loading alert
            Swal.fire({
                title: 'Đang xử lý...',
                text: 'Đang gửi thông tin tư vấn...',
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => {
                    Swal.showLoading();
                }
            });

            // Submit via AJAX
            const formData = new FormData(tuvanForm);

            fetch(tuvanForm.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest',
                    'Accept': 'application/json'
                },
                body: formData
            })
            .then(response => {
                console.log('Response status:', response.status);

                if (!response.ok) {
                    if (response.status === 422) {
                        return response.json().then(data => {
                            console.log('Validation errors:', data);
                            throw {
                                name: 'ValidationError',
                                data: data
                            };
                        });
                    }
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => {
                console.log('Success data:', data);

                // Đóng loading alert
                Swal.close();

                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('loading');
                    submitBtn.innerHTML = '<span>Gửi thông tin</span><i class="fa fa-angle-right"></i>';
                }

                if (data.success) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công!',
                        text: data.message || 'Gửi thông tin tư vấn thành công! Chúng tôi sẽ liên hệ với bạn sớm nhất.',
                        timer: 3000,
                        showConfirmButton: false
                    });

                    // Reset form
                    tuvanForm.reset();

                    // Đóng modal sau 2s
                    setTimeout(() => {
                        const modal = bootstrap.Modal.getInstance(document.getElementById('booking_Popup_TuVan'));
                        if (modal) {
                            modal.hide();
                        }
                    }, 2000);
                } else {
                    // Handle server validation errors
                    if (data.errors) {
                        console.log('Server errors:', data.errors);
                        Object.keys(data.errors).forEach(key => {
                            const errorEl = document.getElementById(`error_${key}`);
                            if (errorEl) {
                                errorEl.innerText = data.errors[key][0];
                            }
                        });
                    }

                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: data.message || 'Đã có lỗi xảy ra, vui lòng thử lại!',
                        timer: 4000,
                        showConfirmButton: false
                    });
                }
            })
            .catch(error => {
                console.error('Fetch error:', error);

                // Đóng loading alert
                Swal.close();

                if (submitBtn) {
                    submitBtn.disabled = false;
                    submitBtn.classList.remove('loading');
                    submitBtn.innerHTML = '<span>Gửi thông tin</span><i class="fa fa-angle-right"></i>';
                }

                // Handle validation errors from server
                if (error.name === 'ValidationError' && error.data && error.data.errors) {
                    console.log('Validation errors from catch:', error.data.errors);
                    Object.keys(error.data.errors).forEach(key => {
                        const errorEl = document.getElementById(`error_${key}`);
                        if (errorEl) {
                            errorEl.innerText = error.data.errors[key][0];
                        }
                    });
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: 'Vui lòng kiểm tra lại thông tin đã nhập!',
                        timer: 3000,
                        showConfirmButton: false
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Lỗi!',
                        text: 'Không thể gửi form! ' + (error.message || ''),
                        timer: 4000,
                        showConfirmButton: false
                    });
                }
            });
        });

        // Real-time validation
        const fields = ['customer_name', 'customer_email', 'customer_phone', 'notes'];
        fields.forEach(fieldName => {
            const field = tuvanForm.querySelector(`[name="${fieldName}"]`);
            if (field) {
                field.addEventListener('blur', function() {
                    const errorEl = document.getElementById(`error_${fieldName}`);
                    const value = this.value.trim();

                    // Clear previous error
                    if (errorEl) errorEl.innerText = '';
                    this.classList.remove('is-invalid', 'is-valid');

                    let isValid = true;

                    if (fieldName === 'customer_name' && value) {
                        if (value.length < 3 || !/^[a-zA-ZÀ-ỹ\s]+$/u.test(value)) {
                            if (errorEl) errorEl.innerText = 'Tên không hợp lệ';
                            isValid = false;
                        }
                    } else if (fieldName === 'customer_email' && value) {
                        if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(value)) {
                            if (errorEl) errorEl.innerText = 'Email không hợp lệ';
                            isValid = false;
                        }
                    } else if (fieldName === 'customer_phone' && value) {
                        let invalidNumbers = ['0000000000', '1234567890', '1111111111', '2222222222'];
                        if (!/^\d{10}$/.test(value) || !/^(03|05|07|08|09)/.test(value) || invalidNumbers.includes(value)) {
                            if (errorEl) errorEl.innerText = 'Số điện thoại không hợp lệ';
                            isValid = false;
                        }
                    } else if (fieldName === 'notes' && value) {
                        if (value.length > 1000) {
                            if (errorEl) errorEl.innerText = 'Ghi chú tối đa 1000 ký tự';
                            isValid = false;
                        }
                    }

                    if (!isValid) {
                        this.classList.add('is-invalid');
                    } else if (value) {
                        this.classList.add('is-valid');
                    }
                });
            }
        });

        // Clear errors when modal closes
        const modalElement = document.getElementById('booking_Popup_TuVan');
        if (modalElement) {
            modalElement.addEventListener('hidden.bs.modal', function() {
                document.querySelectorAll('.text-danger[id^="error_"]').forEach(el => el.innerText = '');
                fields.forEach(fieldName => {
                    const field = tuvanForm.querySelector(`[name="${fieldName}"]`);
                    if (field) {
                        field.classList.remove('is-invalid', 'is-valid');
                    }
                });
            });
        }

        // Handle Laravel session messages với SweetAlert2
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Thành công!',
                text: '{{ session('success') }}',
                timer: 3000,
                showConfirmButton: false
            });
        @endif

        @if (session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Lỗi!',
                text: '{{ session('error') }}',
                timer: 4000,
                showConfirmButton: false
            });
        @endif
    });

    // Hiệu ứng cuộn mượt khi nhấp vào nút mở popup
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.open-tuvan-popup').forEach(button => {
            button.addEventListener('click', function(e) {
                e.preventDefault();
                const popup = document.getElementById('booking_Popup_TuVan');
                if (popup) {
                    const modal = new bootstrap.Modal(popup);
                    modal.show();
                }
            });
        });
    });
</script>
