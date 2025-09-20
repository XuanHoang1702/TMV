@extends('layouts.app')

@section('title', 'Bảng giá - Thẩm mỹ Dr.DAT')

@section('meta')
    <meta name="description"
        content="Bảng giá dịch vụ tạo hình thẩm mỹ tại Dr. Đạt với mức giá hợp lý, an toàn và hiệu quả. Tham khảo chi tiết các dịch vụ thẩm mỹ của chúng tôi.">
    <meta name="keywords" content="bảng giá, dịch vụ thẩm mỹ, tạo hình thẩm mỹ, Dr. Đạt, giá dịch vụ, thẩm mỹ an toàn">
    <meta property="og:title" content="Bảng giá - Thẩm mỹ Dr.DAT" />
    <meta property="og:description"
        content="Bảng giá dịch vụ tạo hình thẩm mỹ tại Dr. Đạt với mức giá hợp lý, an toàn và hiệu quả." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('images/logo_Dr_Dat.png') }}" />
    <meta name="twitter:card" content="summary_large_image" />
@endsection

@section('styles')
    <link rel="stylesheet" href="css/lib/bootstrap.min.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/lib/aos.css" />
    <link rel="stylesheet" href="css/site.css">
    <link rel="stylesheet" href="css/baogia.css">
    <script src="js/lib/jquery.min.js"></script>
    <script src="js/lib/popper.min.js"></script>
    <script src="js/lib/bootstrap.min.js"></script>
    <script src="js/lib/aos.js"></script>
    <script src="js/_jquery.js"></script>
    <!--End lib-->
    <!--Fonts inter-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
@endsection

@section('content')
    <div class="body-content">



        <!--Body bao gia-->
        <div class="cl-body-bg">
            <div class="container">
                <!--banner-->
                @if ($pricingBanner)
                    <div class="cl-jCenter">
                        <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                            <div class="col-12 col-sm-12">
                                <h4 class="cl-title">{{ $pricingBanner->title }}</h4>
                            </div>
                            <div class="col-12 col-sm-12 cl-desc">
                                <p class="ab-banner-desc">{!! nl2br(e($pricingBanner->content)) !!}</p>
                            </div>
                        </div>
                    </div>
                @endif

                <!--contents-->
                <div class="cl-panel-list">
                    <div class="cl-panel-body">
                        <div class="row">
                            @foreach ($services as $service)
                                <div class="col-12 col-sm-12">
                                    <div class="cl-pl-item" data-aos="fade-up" data-aos-duration="3000">
                                        <div class="row">
                                            <div class="col-12 col-sm-5 cl-img">
                                                @if ($service->image)
                                                    <img src="{{ asset('storage/' . $service->image) }}"
                                                        alt="{{ $service->name }}" />
                                                @else
                                                    <img src="{{ asset('images/baogia/bg1.png') }}"
                                                        alt="{{ $service->name }}" />
                                                @endif
                                            </div>
                                            <div class="col-12 col-sm-7 cl-ct-info">
                                                <div class="cl-info">
                                                    <h4>{{ $service->name }}</h4>
                                                    <ul class="ul-info">
                                                        @foreach ($service->children as $child)
                                                            <li>
                                                                <span>{{ $child->name }}:</span>
                                                                <b>{{ $child->price_range ? $child->price_range : 'Liên hệ' }}</b>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                    <div class="row">
                                                        <div class="col-12 col-sm-5">
                                                            <a class="cl-btn-full" href="javascript:void(0)"
                                                                onclick="onOpen_Popup2()">
                                                                <i class="icon-cal"><img
                                                                        src="{{ asset('images/icon/icon_support.png') }}" /></i>
                                                                <span>Gọi lại cho tôi</span>
                                                            </a>
                                                        </div>
                                                        <div class="col-12 col-sm-5">
                                                            <a class="cl-btn-full-2"
                                                                href="{{ route('services.detail', $service->slug) }}">
                                                                <i class="icon-cal">
                                                                    <img
                                                                        src="{{ asset('images/icon/icon_newPage.png') }}" />
                                                                </i>
                                                                <span>Xem chi tiết</span>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="cl-panel-footer">
                        <div class="cl-pl-footer-info" data-aos="zoom-in" data-aos-duration="3000">
                            <div class="row">
                                <div class="col-12 col-sm-3 cl-img">
                                    <img src="{{ asset('images/baogia/icon_pages.png') }}" />
                                </div>
                                <div class="col-12 col-sm-9 cl-info">
                                    <ul class="ul-info">
                                        @foreach($pricingFooterItems as $item)
                                            <li>{{ $item->content }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end body-->

        <!--Sec 4 - dat lich kham ngay-->
        @include('layouts.booking.booking_Popup_DatLichKham')

        <!--footer-->

    </div>
@endsection
