<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--Lib-->
    <title>@yield('title', 'Thẩm mỹ Dr.DAT')</title>
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/lib/slick_slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    @yield('styles')
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/lib/aos.js') }}"></script>
    <script src="{{ asset('js/_jquery.js') }}"></script>
    <script src="{{ asset('js/lib/slide-slick.js') }}"></script>
    <!--End lib-->
    <!--Fonts inter-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap" rel="stylesheet">
    @yield('fonts')
</head>
<body>
    <div class="body-content">
        <!--head-->
        <div class="cl-header">
            <div class="m-head">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <h3 class="head-h3">Bác Sĩ Thẩm Mỹ Tận Tâm - Dr.Đạt Luôn Đồng Hành Cùng Bạn</h3>
                        </div>
                        <div class="col-md-3">
                            <div class="head-seach">
                                <div class="head-input-g">
                                    <input type="text" placeholder="Nhập từ khoá tìm kiếm" class="cl-input-seach" />
                                    <i class="fa fa-search" aria-hidden="true"></i>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-2" style="padding:0 5px;">
                            <div class="head-sel-g">
                                <ul class="ul-lang">
                                    <li class="li-group">
                                        <a href="#" onclick="onChange_Lang(this)">
                                            <img class="icon-flag" src="{{ asset('images/icon/Flage_vn.png') }}" />
                                            <span>Tiếng Việt</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="m-ul-sub" style="width:180px; top:30px; left:-15px;">
                                            <li class="active">
                                                <a href="#">
                                                    <img class="icon-flag" src="{{ asset('images/icon/icon_flag_vn.png') }}" />
                                                    <span>Tiếng Việt</span>
                                                    <img class="icon-check" src="{{ asset('images/icon/icon_lang_check.png') }}" />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="#">
                                                    <img class="icon-flag" src="{{ asset('images/icon/icon_flag_en.png') }}" />
                                                    <span>Tiếng Anh</span>
                                                    <img class="icon-check" src="{{ asset('images/icon/icon_lang_check.png') }}" />
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--menu-->
             @include('layouts.menu')
            <!--end menu-->
        </div>
        <!--end head-->

        @yield('content')

        <!--footer-->
         @include('layouts.footer')
        <!--end footer-->
    </div>

    @include('layouts.booking-popup')

    <div id="booking_Popup_TuVan" class="modal fade cl-bgPop" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog modal-lg" style="max-width: 30%; ">
            <div class="modal-content">
                <div class="modal-header" style="flex-direction:unset;">
                    <h5 id="myModalLabel" class="modal-title" style="font-weight:bold">
                        BẠN CẦN TƯ VẤN?
                    </h5>
                    <p>Để lại thông tin cho chúng tôi</p>
                    <button type="button" class="btn btn-pop" data-bs-dismiss="modal" aria-label="Close" onclick="onClose_Popup2()"><i class="fa fa-times"></i></button>
                </div>
                <div class="smart-form">
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <input type="text" placeholder="Họ & tên" class="ctr-h-input" />
                        </div>
                        <div class="col-12 col-sm-12">
                            <input type="text" placeholder="Email" class="ctr-h-input" />
                        </div>
                        <div class="col-12 col-sm-12">
                            <input type="text" placeholder="Số điện thoại" class="ctr-h-input" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <textarea type="text" rows="3" placeholder="Nội dung" class="ctr-h-input"></textarea>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <a class="cl-btn-full" href="#" onclick="onClose_Popup2()">
                                <span>Gửi thông tin</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--ribon fix-->
    <div class="cl-ribon">
        <ul class="ul-ribon">
            <li class="cl-group">
                <ul class="cl-sub-ribon">
                    <li>
                        <a>
                            <img src="{{ asset('images/icon/icon_zalo.png') }}" />
                        </a>
                    </li>
                    <li>
                        <a>
                            <img src="{{ asset('images/icon/icon_mess.png') }}" />
                        </a>
                    </li>
                    <li>
                        <a>
                            <img src="{{ asset('images/icon/icon_call.png') }}" />
                        </a>
                    </li>
                </ul>
                <a class="show-hide-child" onclick="show_hide_ribon(this)">
                    <img class="cl-icon-plus" src="{{ asset('images/icon/icon_plus.png') }}" />
                    <img class="cl-icon-minus" src="{{ asset('images/icon/icon_minus.png') }}" />
                </a>
            </li>
            <li class="cl-scroll-top">
                <a href="#">
                    <img src="{{ asset('images/icon/icon_scroll_top.png') }}" />
                </a>
            </li>
        </ul>
    </div>

    @yield('scripts')
</body>
</html>
