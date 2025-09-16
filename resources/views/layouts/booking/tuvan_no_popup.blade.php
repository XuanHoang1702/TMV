<div class="cl-form-left">
    <form action="{{ route('appointments.store') }}" method="POST" class="smart-form">
        @csrf
        <div class="row">
            <div class="col-12 col-sm-12">
                <h3>BẠN CẦN TƯ VẤN?</h3>
                <p>Để lại thông tin cho chúng tôi</p>
            </div>

            <div class="col-12 col-sm-12">
                <input type="text" name="customer_name" placeholder="Họ & tên"
                       class="ctr-h-input-left" value="{{ old('customer_name') }}" required />
                <div class="text-danger" id="error_customer_name"></div>
                @error('customer_name')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-sm-12">
                <input type="email" name="customer_email" placeholder="Email"
                       class="ctr-h-input-left" value="{{ old('customer_email') }}" required />
                <div class="text-danger" id="error_customer_email"></div>
                @error('customer_email')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-sm-12">
                <input type="text" name="customer_phone" placeholder="Số điện thoại"
                       class="ctr-h-input-left" value="{{ old('customer_phone') }}" required />
                <div class="text-danger" id="error_customer_phone"></div>
                @error('customer_phone')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-sm-12">
                <textarea name="notes" placeholder="Nội dung"
                          class="ctr-h-input-left" required>{{ old('notes') }}</textarea>
                <div class="text-danger" id="error_notes"></div>
                @error('notes')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-12 col-sm-12">
                <button type="submit" class="cl-btn-full">
                    <span>Gửi thông tin</span>
                    <i class="fa fa-angle-right"></i>
                </button>
            </div>
        </div>
    </form>
</div>
<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("form-tu-van");

    if (form) {
        form.addEventListener("submit", async function (e) {
            e.preventDefault();

            // Reset lỗi cũ
            document.querySelectorAll("#form-tu-van .text-danger").forEach(el => el.innerHTML = "");

            let formData = new FormData(form);

            try {
                let response = await fetch(form.action, {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                        "Accept": "application/json",
                    },
                    body: formData
                });

                if (response.ok) {
                    alert("Gửi thông tin thành công!");
                    form.reset();
                } else if (response.status === 422) {
                    let errors = await response.json();
                    for (let field in errors.errors) {
                        let el = document.getElementById(`error_${field}`);
                        if (el) {
                            el.innerHTML = errors.errors[field][0];
                        }
                    }
                } else {
                    alert("Có lỗi xảy ra, vui lòng thử lại!");
                }
            } catch (error) {
                console.error(error);
                alert("Không thể gửi form!");
            }
        });
    }
});
</script>
