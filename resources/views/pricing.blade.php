@extends('layouts.app')

@section('title', 'Bảng giá - Thẩm mỹ Dr.DAT')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/bang-gia.css') }}">
@endsection

@section('content')
<div class="cl-body-bg">
    <div class="container">
        <!--banner-->
        <div class="cl-jCenter">
            <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                <div class="col-12 col-sm-12">
                    <h4 class="cl-title">BẢNG GIÁ DỊCH VỤ</h4>
                </div>
                <div class="col-12 col-sm-12 cl-desc">
                    <p>
                        Chúng tôi cam kết mang đến cho khách hàng những dịch vụ thẩm mỹ chất lượng cao với mức giá hợp lý và minh bạch.
                        Tất cả chi phí đều được công khai rõ ràng, không phát sinh thêm bất kỳ khoản phí nào.
                    </p>
                </div>
            </div>
        </div>

        <!--contents-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-info">
                        <h4>DỊCH VỤ PHẪU THUẬT THẨM MỸ</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6" data-aos="fade-right" data-aos-duration="3000">
                        <div class="cl-price-item">
                            <div class="cl-price-header">
                                <h5>PHẪU THUẬT THẨM MỸ CÔ BÉ</h5>
                            </div>
                            <div class="cl-price-body">
                                <ul>
                                    <li>
                                        <span>Thu hẹp âm đạo</span>
                                        <strong>35.000.000 - 45.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Tạo hình môi âm đạo</span>
                                        <strong>30.000.000 - 40.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Tạo hình màng trinh</span>
                                        <strong>25.000.000 - 35.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Nâng cơ vùng kín</span>
                                        <strong>40.000.000 - 50.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Làm hồng vùng kín</span>
                                        <strong>20.000.000 - 30.000.000 VND</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6" data-aos="fade-left" data-aos-duration="3000">
                        <div class="cl-price-item">
                            <div class="cl-price-header">
                                <h5>PHẪU THUẬT THẨM MỸ NGỰC</h5>
                            </div>
                            <div class="cl-price-body">
                                <ul>
                                    <li>
                                        <span>Tăng ngực silicone</span>
                                        <strong>80.000.000 - 120.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Thu nhỏ ngực</span>
                                        <strong>60.000.000 - 90.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Nâng ngực</span>
                                        <strong>50.000.000 - 70.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Chỉnh hình ngực</span>
                                        <strong>40.000.000 - 60.000.000 VND</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top:30px;">
                    <div class="col-12 col-sm-6" data-aos="fade-right" data-aos-duration="3000">
                        <div class="cl-price-item">
                            <div class="cl-price-header">
                                <h5>PHẪU THUẬT THẨM MỸ MÔNG</h5>
                            </div>
                            <div class="cl-price-body">
                                <ul>
                                    <li>
                                        <span>Tăng kích thước mông</span>
                                        <strong>60.000.000 - 80.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Nâng mông</span>
                                        <strong>50.000.000 - 70.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Chỉnh hình mông</span>
                                        <strong>40.000.000 - 60.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Cấy mỡ mông</span>
                                        <strong>45.000.000 - 65.000.000 VND</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6" data-aos="fade-left" data-aos-duration="3000">
                        <div class="cl-price-item">
                            <div class="cl-price-header">
                                <h5>HÚT MỠ & CẤY MỠ</h5>
                            </div>
                            <div class="cl-price-body">
                                <ul>
                                    <li>
                                        <span>Hút mỡ bụng</span>
                                        <strong>35.000.000 - 50.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Hút mỡ đùi</span>
                                        <strong>30.000.000 - 45.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Hút mỡ cánh tay</span>
                                        <strong>25.000.000 - 40.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Cấy mỡ mặt</span>
                                        <strong>40.000.000 - 60.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Cấy mỡ mông</span>
                                        <strong>45.000.000 - 65.000.000 VND</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Dich vu mat-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-info">
                        <h4>DỊCH VỤ THẨM MỸ MẮT & MŨI</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6" data-aos="fade-right" data-aos-duration="3000">
                        <div class="cl-price-item">
                            <div class="cl-price-header">
                                <h5>PHẪU THUẬT THẨM MỸ MẮT</h5>
                            </div>
                            <div class="cl-price-body">
                                <ul>
                                    <li>
                                        <span>Cắt mí mắt</span>
                                        <strong>15.000.000 - 25.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Nâng mí mắt</span>
                                        <strong>20.000.000 - 30.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Mở rộng khoé mắt</span>
                                        <strong>18.000.000 - 28.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Chỉnh hình mắt hai mí</span>
                                        <strong>25.000.000 - 35.000.000 VND</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6" data-aos="fade-left" data-aos-duration="3000">
                        <div class="cl-price-item">
                            <div class="cl-price-header">
                                <h5>PHẪU THUẬT THẨM MỸ MŨI</h5>
                            </div>
                            <div class="cl-price-body">
                                <ul>
                                    <li>
                                        <span>Nâng mũi S line</span>
                                        <strong>40.000.000 - 60.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Nâng mũi bọc sụn</span>
                                        <strong>25.000.000 - 45.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Chỉnh hình mũi</span>
                                        <strong>30.000.000 - 50.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Thu hẹp cánh mũi</span>
                                        <strong>20.000.000 - 35.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Sửa mũi lệch</span>
                                        <strong>35.000.000 - 55.000.000 VND</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Dich vu noi khoa-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-info">
                        <h4>THẨM MỸ NỘI KHOA</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6" data-aos="fade-right" data-aos-duration="3000">
                        <div class="cl-price-item">
                            <div class="cl-price-header">
                                <h5>TIÊM FILLER & BOTOX</h5>
                            </div>
                            <div class="cl-price-body">
                                <ul>
                                    <li>
                                        <span>Tiêm filler mũi</span>
                                        <strong>8.000.000 - 15.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Tiêm filler má</span>
                                        <strong>10.000.000 - 18.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Tiêm filler cằm</span>
                                        <strong>6.000.000 - 12.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Tiêm Botox chống nhăn</span>
                                        <strong>12.000.000 - 20.000.000 VND</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6" data-aos="fade-left" data-aos-duration="3000">
                        <div class="cl-price-item">
                            <div class="cl-price-header">
                                <h5>TRẺ HÓA DA & ĐIỀU TRỊ</h5>
                            </div>
                            <div class="cl-price-body">
                                <ul>
                                    <li>
                                        <span>Trẻ hóa da bằng laser</span>
                                        <strong>5.000.000 - 10.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Điều trị nám, tàn nhang</span>
                                        <strong>8.000.000 - 15.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Điều trị mụn</span>
                                        <strong>3.000.000 - 8.000.000 VND</strong>
                                    </li>
                                    <li>
                                        <span>Lột da hóa học</span>
                                        <strong>4.000.000 - 9.000.000 VND</strong>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Luu y-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-info">
                        <h4>LƯU Ý QUAN TRỌNG</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-12" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="cl-note">
                            <ul>
                                <li>Giá trên chưa bao gồm chi phí thăm khám và tư vấn trước phẫu thuật</li>
                                <li>Chi phí có thể thay đổi tùy theo mức độ phức tạp của từng trường hợp</li>
                                <li>Khách hàng sẽ được tư vấn cụ thể về chi phí sau khi thăm khám</li>
                                <li>Thanh toán có thể thực hiện theo nhiều hình thức linh hoạt</li>
                                <li>Chúng tôi cam kết không phát sinh thêm bất kỳ khoản phí nào ngoài thỏa thuận</li>
                            </ul>
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
