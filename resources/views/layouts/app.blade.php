<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description"
        content="{{ $meta_description ?? 'Thẩm mỹ Dr.DAT - Dịch vụ thẩm mỹ chuyên nghiệp với đội ngũ bác sĩ giàu kinh nghiệm.' }}">
    <meta name="keywords" content="{{ $meta_keywords ?? 'thẩm mỹ, dr dat, phẫu thuật thẩm mỹ, làm đẹp, spa, clinic' }}">
    <meta name="author" content="Thẩm mỹ Dr.DAT">
    <!-- Open Graph -->
    <meta property="og:title" content="{{ $og_title ?? ($title ?? 'Thẩm mỹ Dr.DAT') }}">
    <meta property="og:description"
        content="{{ $og_description ?? ($meta_description ?? 'Thẩm mỹ Dr.DAT - Dịch vụ thẩm mỹ chuyên nghiệp.') }}">
    <meta property="og:image" content="{{ $og_image ?? asset('images/logo_Dr_Dat.png') }}">
    <meta property="og:url" content="{{ url()->current() }}">
    <meta property="og:type" content="website">
    <!-- Twitter Card -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="{{ $og_title ?? ($title ?? 'Thẩm mỹ Dr.DAT') }}">
    <meta name="twitter:description"
        content="{{ $og_description ?? ($meta_description ?? 'Thẩm mỹ Dr.DAT - Dịch vụ thẩm mỹ chuyên nghiệp.') }}">
    <meta name="twitter:image" content="{{ $og_image ?? asset('images/logo_Dr_Dat.png') }}">
    <!--Lib-->
    <title>{{ $title ?? 'Thẩm mỹ Dr.DAT' }}</title>
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
    <script src="{{ asset('js/menu.js') }}"></script>

    <!--Fonts inter-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
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
                            <h3 class="head-h3">
                                {{ $siteInfo->slogan }}
                            </h3>
                        </div>


                        <div class="col-md-3">
                            <div class="head-seach">
                                <form action="{{ route('search') }}" method="GET" class="head-input-g">
                                    <input type="text" name="q" placeholder="Nhập từ khoá tìm kiếm" class="cl-input-seach" />
                                    <button type="submit" style="background: none; border: none; padding: 0;">
                                        <i class="fa fa-search" aria-hidden="true"></i>
                                    </button>
                                </form>
                            </div>
                        </div>
                        <div class="col-md-2" style="padding:0 5px;">
                            <div class="head-sel-g">
                                <ul class="ul-lang">
                                    <li class="li-group">
                                        <a href="{{ url('lang/en') }}" onclick="onChange_Lang(this)">
                                            <img class="icon-flag" src="{{ asset('images/icon/Flage_vn.png') }}" />
                                            <span>Tiếng Việt</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="m-ul-sub" style="width:180px; top:30px; left:-15px;">
                                            <li class="active">
                                                <a href="{{ url('lang/vi') }}">
                                                    <img class="icon-flag"
                                                        src="{{ asset('images/icon/icon_flag_vn.png') }}" />
                                                    <span>Tiếng Việt</span>
                                                    <img class="icon-check"
                                                        src="{{ asset('images/icon/icon_lang_check.png') }}" />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="{{ url('lang/en') }}">
                                                    <img class="icon-flag"
                                                        src="{{ asset('images/icon/icon_flag_en.png') }}" />
                                                    <span>Tiếng Anh</span>
                                                    <img class="icon-check"
                                                        src="{{ asset('images/icon/icon_lang_check.png') }}" />
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

    @include('layouts.booking.booking-popup')


    @include('layouts.booking.booking_Popup_TuVan')
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
    @yield('meta')
</body>

</html>
