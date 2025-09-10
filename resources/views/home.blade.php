@extends('layouts.app')

@section('title', 'Trang chủ - Thẩm mỹ Dr.DAT')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
<div class="cl-banner">
    <div class="container" data-aos="zoom-in" data-aos-duration="3000">
        <div class="row">
            <div class="col-md-12 ct-banner"></div>
        </div>
    </div>
</div>
<div class="cl-h-sec01">
    <div class="container">
        <div class="cl-sec01-cate" data-aos="zoom-in" data-aos-duration="3000">
            <div class="row">
                <div class="col-12 col-sm-3">
                    <div class="col-item">
                        <a href="{{ route('services.detail', 'dich-vu-tham-my-co-be') }}" class="a-cate-item">
                            <img src="{{ asset('images/home/icon_cate1.png') }}" />
                            <label>PHẪU THUẬT THẨM MỸ CÔ BÉ</label>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="col-item">
                        <a href="{{ route('services.detail', 'dich-vu-phau-thuat-tao-hinh-tham-my-nguc') }}" class="a-cate-item">
                            <img src="{{ asset('images/home/icon_cate2.png') }}" />
                            <label>PHẪU THUẬT TẠO HÌNH THẨM MỸ NGỰC</label>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="col-item">
                        <a href="{{ route('services.detail', 'dich-vu-phau-thuat-tao-hinh-tham-my-mong') }}" class="a-cate-item">
                            <img src="{{ asset('images/home/icon_cate3.png') }}" />
                            <label>PHẪU THUẬT TẠO HÌNH THẨM MỸ MÔNG</label>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="col-item">
                        <a href="{{ route('services.detail', 'hut-mo-cay-mo') }}" class="a-cate-item">
                            <img src="{{ asset('images/home/icon_cate4.png') }}" />
                            <label>HÚT MỠ <br />CẤY MỠ</label>
                        </a>
                    </div>
                </div>
            </div>
            <!--row 2-->
            <div class="row">
                <div class="col-12 col-sm-3">
                    <div class="col-item">
                        <a href="{{ route('services.detail', 'dich-vu-phau-thuat-tao-hinh-tham-my-mat') }}" class="a-cate-item">
                            <img src="{{ asset('images/home/icon_cate5.png') }}" />
                            <label>PHẪU THUẬT TẠO HÌNH THẨM MỸ MẮT</label>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="col-item">
                        <a href="{{ route('services.detail', 'dich-vu-phau-thuat-tao-hinh-tham-my-mui') }}" class="a-cate-item">
                            <img src="{{ asset('images/home/icon_cate6.png') }}" />
                            <label>PHẪU THUẬT TẠO HÌNH THẨM MỸ MŨI</label>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="col-item">
                        <a href="{{ route('services.detail', 'dich-vu-phau-thuat-tao-hinh-tham-my-vung-mat') }}" class="a-cate-item">
                            <img src="{{ asset('images/home/icon_cate7.png') }}" />
                            <label>PHẪU THUẬT TẠO HÌNH THẨM MỸ VÙNG MẶT</label>
                        </a>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="col-item">
                        <a href="{{ route('services.detail', 'tham-my-noi-khoa') }}" class="a-cate-item">
                            <img src="{{ asset('images/home/icon_cate8.png') }}" />
                            <label>THẨM MỸ <br />NỘI KHOA</label>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        <!--Vững Chuyên Môn, Giàu Tâm Đức-->
        <div class="cl-sec01-desc">
            <div class="row">
                <div class="col-12 col-sm-5 cl-sec01-desc-img" data-aos="zoom-in" data-aos-duration="3000">
                    <div class="row">
                        <div class="col-12 col-sm-6">
                            <img src="{{ asset('images/home/h_image1.png') }}" />
                        </div>
                        <div class="col-12 col-sm-6">
                            <img src="{{ asset('images/home/h_image2.png') }}" />
                        </div>
                    </div>
                    <div class="row" style="margin-top:20px;">
                        <div class="col-12 col-sm-12">
                            <img src="{{ asset('images/home/h_image3.png') }}" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-7" data-aos="zoom-in" data-aos-duration="3000">
                    <div class="cl-desc">
                        <h3 class="cl-desc-title">Vững Chuyên Môn, Giàu Tâm Đức</h3>
                        <p>
                            Thẩm Mỹ Tận Tâm Dr. Đạt tự hào là đội ngũ bác sĩ phẫu thuật tạo hình thẩm mỹ chính thống,
                            dẫn dắt bởi Dr. Hà Quốc Đạt, Trưởng khoa Tạo hình Thẩm mỹ, Bệnh viện Lê Văn Thịnh.
                            Với hơn 25 năm kinh nghiệm trong ngành Y, Dr. Đạt là một trong những bác sĩ chuyên khoa uy
                            tín trong lĩnh vực phẫu thuật Tạo Hình Thẩm Mỹ tại TP. HCM.
                        </p>
                        <p>
                            Bên cạnh công tác tại Bệnh viện Lê Văn Thịnh, Dr. Đạt còn hợp tác với nhiều bệnh viện quốc
                            tế danh tiếng, cùng đội ngũ bác sĩ chuyên khoa giàu kinh nghiệm. Qua từng ca phẫu thuật thành công,
                            Dr. Đạt đã mang lại sự tự tin và vẻ đẹp hoàn mỹ cho hàng trăm khách hàng trong và ngoài nước.
                        </p>
                        <hr class="h-hr" />
                        <ul class="cl-ul-desc">
                            <li>
                                <div class="dv-li-item">
                                    <img src="{{ asset('images/home/icon_sec01_1.png') }}" />
                                    <div class="dv-li-desc">
                                        <h4>Chuyên nghiệp</h4>
                                        <p>
                                            Bằng kinh nghiệm chuyên môn vững vàng và công nghệ, máy móc hiện đại và tiêu chí chuẩn Y khoa,
                                            Dr. Đạt cùng đội ngũ luôn mang đến những dịch vụ chuyên nghiệp và đẳng cấp hàng đầu.
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dv-li-item">
                                    <img src="{{ asset('images/home/icon_sec01_2.png') }}" />
                                    <div class="dv-li-desc">
                                        <h4>Tận tâm</h4>
                                        <p>
                                            Không chỉ phụ trách khoa phẫu thuật tạo hình thẩm mỹ,
                                            Dr. Đạt còn là người trực tiếp tư vấn và đồng hành cùng khách hàng xuyên suốt hành trình tìm lại sự tự tin
                                        </p>
                                    </div>
                                </div>
                            </li>
                            <li>
                                <div class="dv-li-item">
                                    <img src="{{ asset('images/home/icon_sec01_3.png') }}" />
                                    <div class="dv-li-desc">
                                        <h4>Thấu hiểu</h4>
                                        <p>
                                            Tận tuỵ lắng nghe để thấu hiểu mong muốn của từng khách hàng. Đó chính là phong cách làm việc đặc trưng của
                                            “Bác sĩ thẩm mỹ tận tâm” Dr. Đạt.
                                        </p>
                                    </div>
                                </div>
                            </li>
                        </ul>
                        <div>
                            <a class="btn-booking" href="javascript:void(0)" onclick="onOpen_Popup2()">
                                <span>Đặt lịch tư vấn ngay</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!--Tam biet CLD-->
<div class="cl-sec02" data-aos="zoom-in" data-aos-duration="3000">
    <!--<div class="cl-sec02-body"></div>-->
    <img src="{{ asset('images/home/h_sec_2.png') }}" />
</div>

<div class="cl-bg-g1">
    <!--Secion 3-->
    <div class="cl-sec03">
        <div class="container">
            <div class="cl-sec01-desc">
                <div class="row">
                    <div class="col-12 col-sm-7" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="cl-desc">
                            <h3 class="cl-desc-title">Hướng Đến Sứ Mệnh Cao Cả</h3>
                            <p>
                                Với triết lý "Tận tâm – Chính thống – An toàn," chúng tôi cam kết mang đến cho
                                khách hàng những giải pháp làm đẹp chất lượng cao, hài hòa với nét đẹp tự nhiên và bền vững theo thời gian.
                            </p>
                            <p>Ba giá trị cốt lõi mà đội ngũ Thẩm  Mỹ Tận Tâm Dr. Đạt luôn hướng tới chính là:</p>
                            <hr class="h-hr" />
                            <ul class="cl-ul-desc">
                                <li>
                                    <div class="dv-li-item">
                                        <img src="{{ asset('images/home/icon_sec3_1.png') }}" />
                                        <div class="dv-li-desc">
                                            <h4>Phục vụ khách hàng</h4>
                                            <p>Đặt sự hài lòng và an toàn của khách hàng lên hàng đầu, mang lại vẻ đẹp tự nhiên và sự tự tin bền vững.</p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dv-li-item">
                                        <img src="{{ asset('images/home/icon_sec3_2.png') }}" />
                                        <div class="dv-li-desc">
                                            <h4>Phát triển ngành nghề</h4>
                                            <p>
                                                Góp phần nâng cao tiêu chuẩn trong lĩnh vực phẫu thuật tạo hình thẩm mỹ,
                                                lan tỏa những giá trị tích cực và chuyên môn vchính thổng - chuẩn y khoa.
                                            </p>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="dv-li-item">
                                        <img src="{{ asset('images/home/icon_sec3_3.png') }}" />
                                        <div class="dv-li-desc">
                                            <h4>Phát triển bản thân</h4>
                                            <p>Không ngừng học hỏi, cải thiện kỹ năng và cập nhật công nghệ tiên tiến để luôn là người đồng hành đáng tin cậy của khách hàng.</p>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div>
                                <a class="btn-booking" href="javascript:void(0)" onclick="onOpen_Popup2()">
                                    <span>Đặt lịch tư vấn ngay</span>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-5 cl-sec01-desc-img" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="row">
                            <div class="col-12 col-sm-6">
                                <img src="{{ asset('images/home/h_image_sec3_1.png') }}" />
                            </div>
                            <div class="col-12 col-sm-6">
                                <img src="{{ asset('images/home/h_image_sec3_2.png') }}" />
                            </div>
                        </div>
                        <div class="row" style="margin-top:20px;">
                            <div class="col-12 col-sm-12">
                                <img src="{{ asset('images/home/h_image_sec3_3.png') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--chung chi hanh nghe-->
            <div class="cl-sec03-certificate" data-aos="zoom-in" data-aos-duration="3000">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="row m-hover">
                            <div class="col-12 col-sm-12 active it-hover" data-img="{{ asset('images/home/h_image_sec3_4.png') }}">
                                <a class="cl-btn-full-2" href="#">
                                    <span>Chứng Chỉ Hành Nghề</span>
                                </a>
                            </div>
                            <div class="col-12 col-sm-12 it-hover" data-img="{{ asset('images/home/h_image_sec3_3.png') }}">
                                <a class="cl-btn-full-2" href="#">
                                    <span>Cơ Sở Vật Chất</span>
                                </a>
                            </div>
                            <div class="col-12 col-sm-12 it-hover" data-img="{{ asset('images/home/h_image_sec3_4.png') }}">
                                <a class="cl-btn-full-2" href="#">
                                    <span>Chất Lượng Dịch Vụ</span>
                                </a>
                            </div>
                            <div class="col-12 col-sm-12 it-hover" data-img="{{ asset('images/home/h_image_sec3_3.png') }}">
                                <a class="cl-btn-full-2" href="#">
                                    <span>Quy Trình Thăm Khám</span>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-8 cl-item-center">
                        <div class="cl-sec03-item">
                            <div class="row">
                                <div class="col-12 col-sm-4 cl-item-center">
                                    <img id="cc_viewImg" src="{{ asset('images/home/h_image_sec3_4.png') }}" />
                                </div>
                                <div class="col-12 col-sm-8 cl-item-center" style="text-align:justify;">
                                    <p>Thẩm Mỹ Tận Tâm Dr. Đạt là đội ngũ bác sĩ PTTHTM có chuyên môn vững vàng với chứng chỉ hành nghề chuyên khoa được cấp phép bởi Sở Y Tế TP. HCM.</p>
                                    <p>
                                        Tất cả các quy trình thẩm mỹ đều được thực hiện bởi các bác sĩ, bác sĩ trực tiếp thăm khám, đảm bảo khách hàng sẽ nhận được sự chăm sóc tận
                                        tình và chuyên nghiệp nhất.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--Sec 4 - dat lich kham ngay-->
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
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <input type="text" placeholder="Họ & tên" class="ctr-h-input" />
                            </div>
                            <div class="col-12 col-sm-4">
                                <input type="text" placeholder="Email" class="ctr-h-input" />
                            </div>
                            <div class="col-12 col-sm-4">
                                <input type="text" placeholder="Số điện thoại" class="ctr-h-input" />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <a class="cl-btn-full" href="#">
                                    <span>Gọi lại cho tôi</span>
                                    <i class="fa fa-angle-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
@endsection
