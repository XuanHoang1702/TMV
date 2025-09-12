<!--footer-->
<div class="cl-footer">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-2">
                <img src="{{ asset('images/footer_logo.png') }}" />
            </div>
            <div class="col-12 col-sm-3">
                <h4>BỆNH VIỆN LÊ VĂN THỊNH</h4>
                <p>
                    <i class="fa fa-phone"></i>
                    0705 242 999
                </p>
                <p>
                    <i class="fa fa-map-marker"></i>
                    130 Lê Văn Thịnh, P. Bình Trưng Tây,
                    TP. Thủ Đức
                </p>
            </div>
            <div class="col-12 col-sm-3">
                <h4>ĐĂNG KÝ NHẬN BẢN TIN</h4>
                <p>Cập nhật các thông tin mới nhất về sản phẩm, dịch vụ và ưu đãi</p>
                <div>
                    <a class="cl-btn-full-2" href="#">
                        <span>Địa chỉ email của bạn</span>
                    </a>
                </div>
                <div>
                    <a class="cl-btn-full" href="javascript:void(0)" onclick="onOpen_Popup()">
                        <span>ĐĂNG KÝ NGAY</span>
                    </a>
                </div>
            </div>
            <div class="col-12 col-sm-4">
                <h4>CÁC DỊCH VỤ THẨM MỸ TẠI THẨM MỸ TẬN TÂM DR. ĐẠT</h4>
                @foreach($services as $service)
                    <p><a href="{{ route('services.detail', $service->slug) }}">{{ $service->name }}</a></p>
                @endforeach
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-sm-12">
                <p class="cl-copyright">Copyright © 2024 Aeste - All Rights Reserved.</p>
            </div>
        </div>
    </div>
</div>
<!--end footer-->
