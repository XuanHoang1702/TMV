@extends('layouts.app')

@section('title', 'Liên hệ - Thẩm mỹ Dr.DAT')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lienhe.css') }}">
@endsection

@section('content')
    <div class="cl-body-bg">
        <div class="container">
            <!--banner-->
            <div class="cl-jCenter">
                <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                    <div class="col-12 col-sm-12">
                        <h4 class="cl-title">Liên Hệ Với Chúng Tôi</h4>
                    </div>
                    <div class="col-12 col-sm-12 cl-desc ">
                        <p class="ab-banner-desc">
                            Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn trong hành trình chăm sóc sắc đẹp. Mọi thắc mắc,
                            yêu cầu tư vấn hay đặt lịch hẹn,
                            đừng ngần ngại liên hệ với chúng tôi qua các phương thức dưới đây:
                        </p>
                    </div>
                </div>
            </div>

            <!--contents-->
            <div class="cl-panel-list">
                <div class="cl-panel-body">
                    <div class="row">
                        <div class="col-12 col-sm-6" data-aos="fade-right" data-aos-duration="3000">
                            <img src="{{ asset('images/lienhe/lien_he_map.png') }}" />
                        </div>
                        <div class="col-12 col-sm-6 cl-ct-info" data-aos="fade-left" data-aos-duration="3000">
                            <div class="cl-info">
                                <h4>BỆNH VIỆN LÊ VĂN THỊNH</h4>

                                <p><i class="fa fa-phone"></i> Hotline: <b>0705 242 999</b></p>
                                <p><i class="fa fa-map-marker"></i> Địa chỉ: <b>130 Lê Văn Thịnh, P. Bình Trưng Tây, TP. Thủ
                                        Đức</b></p>
                                <p><i class="fa fa-clock-o"></i> Thời gian làm việc:</p>
                                <ul class="ul-info">
                                    <li>
                                        <span>Thứ Hai - Thứ Sáu:</span>
                                        <b> 8:00 AM - 6:00 PM</b>
                                    </li>
                                    <li>
                                        <span> Thứ Bảy:</span>
                                        <b> 8:00 AM - 12:00 PM</b>
                                    </li>
                                    <li>
                                        <span>Chủ Nhật:</span>
                                        <b> Nghỉ</b>
                                    </li>
                                </ul>

                                <p><i class="fa fa-envelope-o"></i> Email:</p>
                                <p><i class="fa fa-globe"></i> Website:</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Hinh anhr-->
            <div class="cl-panel-list">
                <div class="cl-panel-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 cl-info">
                            <h4>{{ $hospitalImages->first()->title ?? 'Hình ảnh bệnh viện' }}</h4>
                        </div>

                    </div>

                    <div class="row">
                        @foreach ($hospitalImages->take(2) as $image)
                            <div class="col-12 col-sm-6" data-aos="zoom-in">
                                <img src="{{ asset('storage/' . $image->image) }}" />
                            </div>
                        @endforeach
                    </div>
                    <div class="row" style="margin-top:25px;">
                        @foreach ($hospitalImages->skip(2)->take(3) as $image)
                            <div class="col-12 col-sm-4" data-aos="zoom-in">
                                <img src="{{ asset('storage/' . $image->image) }}" />
                            </div>
                        @endforeach
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
