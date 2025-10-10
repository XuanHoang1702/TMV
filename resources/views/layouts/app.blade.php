<!DOCTYPE html>
<html lang="vi">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? 'Thẩm mỹ Dr.DAT' }}</title>
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

    <!-- CSS Libraries -->
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/aos.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/slick_slider.css') }}">
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dichvu.css') }}">
    @yield('styles')

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:ital,opsz,wght@0,14..32,100..900;1,14..32,100..900&display=swap"
        rel="stylesheet">
    @yield('fonts')
</head>

<body>
    <div class="body-content">
        <!-- Header -->
        <div class="cl-header">
            <div class="m-head">
                <div class="container">
                    <div class="row">
                        <div class="col-md-7">
                            <h3 class="head-h3">{{ $siteInfo->slogan }}</h3>
                        </div>

                        @include('search.index')

                        <div class="col-md-2" style="padding:0 5px;">
                            <div class="head-sel-g">
                                <ul class="ul-lang">
                                    <li class="li-group">
                                        <a onclick="onChange_Lang(this)">
                                            <img class="icon-flag" src="{{ asset('images/icon/Flage_vn.png') }}" />
                                            <span>Ngôn ngữ</span>
                                            <i class="fa fa-angle-down"></i>
                                        </a>
                                        <ul class="m-ul-sub" style="width:180px; top:30px; left:-15px;">
                                            <li>
                                                <a href="javascript:void(0)"
                                                    onclick="translateLanguage('vi');changeLanguageUI(this, 'vi')">
                                                    <img class="icon-flag"
                                                        src="{{ asset('images/icon/icon_flag_vn.png') }}" />
                                                    <span>Tiếng Việt</span>
                                                    <img class="icon-check"
                                                        src="{{ asset('images/icon/icon_lang_check.png') }}" />
                                                </a>
                                            </li>
                                            <li>
                                                <a href="javascript:void(0)"
                                                    onclick="translateLanguage('en');changeLanguageUI(this, 'en')">
                                                    <img class="icon-flag"
                                                        src="{{ asset('images/icon/icon_flag_en.png') }}" />
                                                    <span>English</span>
                                                    <img class="icon-check"
                                                        src="{{ asset('images/icon/icon_lang_check.png') }}" />
                                                </a>
                                            </li>
                                        </ul>
                                    </li>
                                    <div id="google_translate_element" style="display:none;"></div>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @include('layouts.menu')
        </div>

        <!-- Content -->
        @yield('content')

        <!-- Footer -->
        @include('layouts.footer')
    </div>

    @include('layouts.booking.booking-popup')

    <!-- Floating Ribon -->
    <div class="cl-ribon">
        <ul class="ul-ribon">
            <li class="cl-group">
                <ul class="cl-sub-ribon">
                    <li><a href="#" onclick="openZaloChat(event)">
                            <img src="{{ asset('images/icon/icon_zalo.png') }}" alt="Zalo" />
                        </a></li>
                    <li><a href="#" onclick="showMessengerModal(event)">
                            <img src="{{ asset('images/icon/icon_mess.png') }}" alt="Messenger" />
                        </a></li>
                    <li><a href="#" onclick="openCall(event)">
                            <img src="{{ asset('images/icon/icon_call.png') }}" alt="Call" />
                        </a></li>
                </ul>
                <a class="show-hide-child" onclick="show_hide_ribon(this)">
                    <img class="cl-icon-plus" src="{{ asset('images/icon/icon_plus.png') }}" />
                    <img class="cl-icon-minus" src="{{ asset('images/icon/icon_minus.png') }}" />
                </a>
            </li>
            <li class="cl-scroll-top">
                <a href="#" onclick="scrollToTop()">
                    <img src="{{ asset('images/icon/icon_scroll_top.png') }}" alt="Scroll Top" />
                </a>
            </li>
        </ul>
    </div>

    <!-- JS Libraries -->
    <script src="{{ asset('js/lib/jquery.min.js') }}"></script>
    <script src="{{ asset('js/lib/popper.min.js') }}"></script>
    <script src="{{ asset('js/lib/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/lib/aos.js') }}"></script>
    <script src="{{ asset('js/_jquery.js') }}"></script>
    <script src="{{ asset('js/lib/slide-slick.js') }}"></script>
    <script src="{{ asset('js/menu.js') }}"></script>

    <!-- Scripts -->
    <script>
        let contactData = null;

        async function loadContactData() {
            if (!contactData) {
                try {
                    const response = await fetch('/api/zalo-contact');
                    contactData = await response.json();
                } catch {
                    contactData = {
                        zalo: {
                            url: 'https://zalo.me/0367881230'
                        },
                        messenger: {
                            url: 'https://m.me/drdatclinic'
                        },
                        call: {
                            url: 'tel:0367881230'
                        }
                    };
                }
            }
            return contactData;
        }

        async function openZaloChat(e) {
            e.preventDefault();
            const data = await loadContactData();
            const zaloUrl = data.zalo.url;
            const isMobile = /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);
            if (isMobile) {
                const phone = zaloUrl.match(/zalo\.me\/(\d+)/)?.[1];
                if (phone) window.location.href = `zalo://chat?phone=${phone}`;
                setTimeout(() => window.open(zaloUrl, '_blank'), 1500);
            } else {
                window.open(zaloUrl, '_blank');
            }
        }

        async function showMessengerModal(e) {
            e.preventDefault();
            const data = await loadContactData();
            window.open(data.messenger.url, '_blank');
        }

        async function openCall(e) {
            e.preventDefault();
            const data = await loadContactData();
            window.location.href = data.call.url;
        }

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function show_hide_ribon(el) {
            const sub = el.parentElement.querySelector('.cl-sub-ribon');
            sub.style.display = (sub.style.display === 'block') ? 'none' : 'block';
        }

        document.addEventListener('DOMContentLoaded', () => {
            const sub = document.querySelector('.cl-sub-ribon');
            if (sub) sub.style.display = 'none';
        });
    </script>

    <!-- GOOGLE TRANSLATE SETUP -->
    <div id="google_translate_element" style="display:none!important;"></div>

    <style>
        /* ẨN HOÀN TOÀN GIAO DIỆN GOOGLE DỊCH */
        body>.skiptranslate,
        .goog-logo-link,
        .goog-te-gadget span,
        .goog-te-banner-frame,
        #goog-gt-tt,
        .goog-tooltip,
        .goog-tooltip:hover,
        .goog-text-highlight,
        .goog-te-balloon-frame,
        iframe.goog-te-banner-frame {
            display: none !important;
            visibility: hidden !important;
            opacity: 0 !important;
        }

        .goog-te-gadget {
            color: transparent !important;
            font-size: 0 !important;
        }

        /* XÓA KHOẢNG TRẮNG DO GOOGLE DỊCH TẠO RA */
        body {
            top: 0 !important;
        }
    </style>

    <script>
        // KHỞI TẠO GOOGLE DỊCH (ẨN MẶC ĐỊNH)
        window.googleTranslateElementInit = function() {
            new google.translate.TranslateElement({
                pageLanguage: 'vi',
                includedLanguages: 'vi,en',
                autoDisplay: false
            }, 'google_translate_element');
        };

        // HÀM CHUYỂN NGÔN NGỮ
        window.translateLanguage = function(lang) {
            let tries = 0;

            function trySelect() {
                const select = document.querySelector(".goog-te-combo");
                if (select) {
                    select.value = lang;
                    select.dispatchEvent(new Event("change"));
                    return;
                }
                if (++tries < 25) setTimeout(trySelect, 200);
            }
            trySelect();
        };

        // CẬP NHẬT GIAO DIỆN MENU SAU KHI DỊCH
        function changeLanguageUI(el, lang) {
            $(el).closest("ul").find("li").removeClass("active");
            $(el).parent().addClass("active");
            $(el).closest("ul").find(".icon-check").hide();
            $(el).find(".icon-check").show();
            const flag = $(el).find(".icon-flag").attr("src");
            const $btn = $(el).closest(".li-group").children("a");
            $btn.find(".icon-flag").attr("src", flag);
            const text = $(el).find("span").text();
            $btn.find("span").text(text);
        }
    </script>

    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    @yield('scripts')
    @yield('meta')
</body>

</html>
