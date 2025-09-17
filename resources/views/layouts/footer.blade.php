<div class="cl-footer">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 col-sm-2">
                @if ($siteInfo && $siteInfo->footer_logo)
                    <img src="{{ asset('storage/' . $siteInfo->footer_logo) }}" alt="Footer Logo" />
                @endif
            </div>

            <div class="col-12 col-sm-3">
                @if ($information)
                    <h4>{{ $information->name }}</h4>

                    @if ($information->hotline)
                        <p><i class="fa fa-phone"></i> {{ $information->hotline }}</p>
                    @endif

                    @if ($information->address)
                        <p><i class="fa fa-map-marker"></i> {{ $information->address }}</p>
                    @endif
                @else
                    <h4>Chưa có thông tin</h4>
                @endif
            </div>

            <div class="col-12 col-sm-3">
                <h4>ĐĂNG KÝ NHẬN BẢN TIN</h4>
                <p>Cập nhật các thông tin mới nhất về sản phẩm, dịch vụ và ưu đãi</p>

                @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if ($errors->has('email'))
                    <div class="alert alert-danger">{{ $errors->first('email') }}</div>
                @endif

                <form action="{{ route('email-notification.store') }}" method="POST">
                    @csrf
                    <div class="mb-2">
                        <input type="email" name="email" class="cl-btn-full-2 w-100"
                            placeholder="Địa chỉ email của bạn" required>
                    </div>
                    <button type="submit" class="cl-btn-full w-100">
                        <span>ĐĂNG KÝ NGAY</span>
                    </button>
                </form>
            </div>

            <div class="col-12 col-sm-4">
                <h4>CÁC DỊCH VỤ THẨM MỸ TẠI THẨM MỸ TẬN TÂM DR. ĐẠT</h4>
                @foreach ($services as $service)
                    <p><a href="{{ route('services.detail', $service->slug) }}">{{ $service->name }}</a></p>
                @endforeach
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-12 text-center">
                <small>&copy; {{ date('Y') }} Thẩm mỹ Dr.DAT. All rights reserved.</small>
            </div>
        </div>
    </div>
</div>
