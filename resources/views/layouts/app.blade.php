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
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!--Lib-->
    <title>{{ $title ?? 'Thẩm mỹ Dr.DAT' }}</title>
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/lib/slick_slider.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dichvu.css') }}">
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
    <!-- Flatpickr CSS -->

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
                                                    onclick="translateLanguage('en'); changeLanguageUI(this, 'en')">
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
                        <a href="#" class="zalo-link" onclick="openZaloChat(event)">
                            <img id="zalo-icon" src="{{ asset('images/icon/icon_zalo.png') }}" alt="Zalo" />
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="showMessengerModal(event)">
                            <img id="messenger-icon" src="{{ asset('images/icon/icon_mess.png') }}" alt="Messenger" />
                        </a>
                    </li>
                    <li>
                        <a href="#" onclick="openCall(event)">
                            <img id="call-icon" src="{{ asset('images/icon/icon_call.png') }}" alt="Call" />
                        </a>
                    </li>
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

    <script>
        // Dynamic Contact System - Updated to support all three contact methods
        let contactData = null;

        async function loadContactData() {
            if (!contactData) {
                try {
                    const response = await fetch('/api/zalo-contact');
                    contactData = await response.json();
                } catch (error) {
                    // Fallback data
                    contactData = {
                        zalo: {
                            contact: '0367881230',
                            type: 'phone',
                            icon: 'fas fa-comment',
                            url: 'https://zalo.me/0367881230',
                        },
                        messenger: {
                            contact: 'drdatclinic',
                            type: 'facebook',
                            icon: 'fab fa-facebook-messenger',
                            url: 'https://m.me/drdatclinic',
                        },
                        call: {
                            contact: '0367881230',
                            type: 'phone',
                            icon: 'fas fa-phone',
                            url: 'tel:0367881230',
                        }
                    };
                }
            }
            return contactData;
        }

        async function openZaloChat(event) {
            event.preventDefault();

            const data = await loadContactData();
            const zaloUrl = data.zalo.url;

            // Kiểm tra mobile
            const isMobile = /Android|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent);

            if (isMobile) {
                // Mobile: thử mở app Zalo
                const phoneNumber = zaloUrl.match(/zalo\.me\/(\d+)/)?.[1];
                if (phoneNumber) {
                    window.location.href = `zalo://chat?phone=${phoneNumber}`;
                    setTimeout(() => window.open(zaloUrl, '_blank'), 1500);
                } else {
                    window.open(zaloUrl, '_blank');
                }
            } else {
                // Desktop: mở web
                window.open(zaloUrl, '_blank');
            }
        }

        async function showMessengerModal(event) {
            event.preventDefault();

            const data = await loadContactData();
            const messengerUrl = data.messenger.url;

            window.open(messengerUrl, '_blank');
        }

        async function openCall(event) {
            event.preventDefault();

            const data = await loadContactData();
            const callUrl = data.call.url;

            window.location.href = callUrl;
        }

        function scrollToTop() {
            window.scrollTo({
                top: 0,
                behavior: 'smooth'
            });
        }

        function show_hide_ribon(element) {
            const subRibon = element.parentElement.querySelector('.cl-sub-ribon');
            const parentLi = element.parentElement;

            if (subRibon.style.display === 'none' || !subRibon.style.display) {
                subRibon.style.display = 'block';
                element.classList.add('active');
            } else {
                subRibon.style.display = 'none';
                element.classList.remove('active');
            }
        }

        // GIỮ NGUYÊN INITIALIZE
        document.addEventListener('DOMContentLoaded', function() {
            const subRibon = document.querySelector('.cl-sub-ribon');
            if (subRibon) {
                subRibon.style.display = 'none';
            }
        });
    </script>
    <!-- Google Translate init + robust translateLanguage -->
    <script>
        // expose init function globally (required by google script cb)
        window.googleTranslateElementInit = function() {
            new google.translate.TranslateElement({
                pageLanguage: 'vi',
                includedLanguages: 'vi,en',
                autoDisplay: false
            }, 'google_translate_element');
        };

        // expose translateLanguage on window so onclick attr can find it
        window.translateLanguage = function(lang) {
            var tries = 0;

            function trySelect() {
                var selectField = document.querySelector(".goog-te-combo");
                if (selectField) {
                    // set value and fire change
                    selectField.value = lang;
                    selectField.dispatchEvent(new Event("change"));
                    return;
                }
                tries++;
                if (tries < 25) {
                    // thử lại mỗi 200ms (tổng ~5s)
                    setTimeout(trySelect, 200);
                } else {
                    console.warn("translateLanguage: .goog-te-combo not found");
                }
            }

            trySelect();
        };

        function changeLanguageUI(el, lang) {
            // Bỏ active tất cả
            $(el).closest("ul").find("li").removeClass("active");

            // Active cái đang chọn
            $(el).parent().addClass("active");

            // Ẩn tất cả dấu tích
            $(el).closest("ul").find(".icon-check").hide();

            // Hiện dấu tích cho cái đang chọn
            $(el).find(".icon-check").show();

            // Đổi cờ trên nút chính
            var selectedFlag = $(el).find(".icon-flag").attr("src");
            var $mainBtn = $(el).closest(".li-group").children("a");
            $mainBtn.find(".icon-flag").attr("src", selectedFlag);

            // Đổi text nút chính (nếu muốn)
            var selectedText = $(el).find("span").text();
            $mainBtn.find("span").text(selectedText);
        }
    </script>

    <!-- Google Translate script (async từ Google) -->
    <script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

    @yield('scripts')
    @yield('meta')
</body>

</html>
