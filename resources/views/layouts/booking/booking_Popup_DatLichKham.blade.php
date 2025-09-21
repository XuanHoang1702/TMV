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
                <form id="appointmentForm" action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="datlichkham" value="1">

                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <input type="text" name="customer_name" placeholder="Họ & tên" class="ctr-h-input"
                                required />
                            <div class="text-danger" id="error_customer_name"></div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <input type="email" name="customer_email" placeholder="Email" class="ctr-h-input"
                                required />
                            <div class="text-danger" id="error_customer_email"></div>
                        </div>
                        <div class="col-12 col-sm-4">
                            <input type="text" name="customer_phone" placeholder="Số điện thoại" class="ctr-h-input"
                                required />
                            <div class="text-danger" id="error_customer_phone"></div>
                        </div>
                    </div>

                    <div class="row mt-3">
                        <div class="col-12">
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
    document.getElementById('appointmentForm').addEventListener('submit', function(e) {
        e.preventDefault();

        const form = this;
        const submitBtn = document.getElementById('submit-btn');
        submitBtn.disabled = true;

        // Xóa lỗi cũ
        document.querySelectorAll('.text-danger').forEach(el => el.innerText = '');

        const formData = new FormData(form);

        fetch(form.action, {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
                    'X-Requested-With': 'XMLHttpRequest', // 👈 báo cho Laravel biết là AJAX
                    'Accept': 'application/json' // 👈 để luôn nhận JSON
                },
                body: formData
            })
            .then(data => {
                if (data) {
                    Swal.fire({
                        icon: 'success',
                        title: 'Thành công',
                        text: data.message,
                        timer: 3000,
                        showConfirmButton: false
                    });
                    form.reset();
                }
            })
            .catch(async err => {
                // Nếu có lỗi validation từ Laravel
                Swal.fire({
                    icon: 'error',
                    title: 'Lỗi',
                    text: 'Không thể gửi form!'
                });

            });
    });
</script>
