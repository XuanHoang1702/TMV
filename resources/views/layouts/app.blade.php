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
            <div class="m-menu">
                <div class="container">
                    <span class="btn-miniMenu" onclick="show_miniMenu()"><i class="fa fa-list"></i></span>
                    <div class="row">
                        <div class="col-md-1 col-logo">
                            <div class="menu-logo">
                                <a href="{{ route('home') }}">
                                    <img src="{{ asset('images/logo_Dr_Dat.png') }}" />
                                </a>
                            </div>
                        </div>
                        <div class="col-md-8 col-center-item">
                            <ul class="main-menu">
                                @foreach($frontendMenu as $menuItem)
                                    <li class="{{ request()->routeIs($menuItem['route']) ? 'active' : '' }}">
                                        <a href="{{ route($menuItem['route']) }}"><span>{{ $menuItem['label'] }}</span></a>
                                    </li>
                                @endforeach
                                <li class="li-group {{ request()->routeIs('services.*') ? 'active' : '' }}">
                                    <a href="{{ route('services.index') }}"><span>Dịch vụ</span><i class="fa fa-angle-down"></i></a>
                                    <ul class="m-ul-sub">
                                        @if(isset($categories))
                                            @foreach($categories->where('type', 'service')->where('parent_id', null) as $parentCategory)
                                                <li>
                                                    <a href="{{ route('services.detail', $parentCategory->slug ?? '#') }}"><span>{{ $parentCategory->name }}</span></a>
                                                    @php
                                                        $childCategories = $categories->where('parent_id', $parentCategory->id);
                                                    @endphp
                                                    @if($childCategories->count() > 0)
                                                        <ul class="m-ul-sub-child">
                                                            @foreach($childCategories as $childCategory)
                                                                <li>
                                                                    <a href="{{ route('services.detail', $childCategory->slug ?? '#') }}"><span>{{ $childCategory->name }}</span></a>
                                                                </li>
                                                            @endforeach
                                                        </ul>
                                                    @endif
                                                </li>
                                            @endforeach
                                        @else
                                            <li>
                                                <a href="{{ route('services.detail', 'dich-vu-tham-my-co-be') }}"><span>Phẫu thuật thẩm mỹ cô bé</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('services.detail', 'dich-vu-phau-thuat-tao-hinh-tham-my-nguc') }}"><span>Phẫu thuật tạo hình thẩm mỹ ngực</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('services.detail', 'dich-vu-phau-thuat-tao-hinh-tham-my-mong') }}"><span>Phẫu thuật tạo hình thẩm mỹ mông</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('services.detail', 'hut-mo-cay-mo') }}"><span>Hút mỡ, cấy mỡ</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('services.detail', 'dich-vu-phau-thuat-tao-hinh-tham-my-mat') }}"><span>Phẫu thuật tạo hình thẩm mỹ mắt</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('services.detail', 'dich-vu-phau-thuat-tao-hinh-tham-my-mui') }}"><span>Phẫu thuật tạo hình thẩm mỹ mũi</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('services.detail', 'dich-vu-phau-thuat-tao-hinh-tham-my-vung-mat') }}"><span>Phẫu thuật tạo hình thẩm mỹ vùng mặt</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('services.detail', 'tham-my-noi-khoa') }}"><span>Thẩm mỹ nội khoa</span></a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                                <li class="li-group {{ request()->routeIs('news.*') ? 'active' : '' }}">
                                    <a href="{{ route('news.index') }}"><span>Tin tức</span><i class="fa fa-angle-down"></i></a>
                                    <ul class="m-ul-sub">
                                        @if(isset($categories))
                                            @foreach($categories->where('type', 'news') as $category)
                                                @if($category->parent_id == null)
                                                    <li>
                                                        <a href="{{ route('news.category', $category->slug ?? '#') }}"><span>{{ $category->name }}</span></a>
                                                    </li>
                                                @endif
                                            @endforeach
                                        @else
                                            <li>
                                                <a href="{{ route('news.category', 'chuyen-mon') }}"><span>Chuyên môn</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('news.category', 'dao-tao') }}"><span>Đào tạo</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('news.category', 'tu-thien') }}"><span>Từ thiện</span></a>
                                            </li>
                                            <li>
                                                <a href="{{ route('news.category', 'bao-chi-truyen-thong') }}"><span>Báo chí, truyền thông</span></a>
                                            </li>
                                        @endif
                                    </ul>
                                </li>
                                <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                                    <a href="{{ route('contact') }}"><span>Liên hệ</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-md-3 col-center-item menu-icon">
                            <a class="calendar-check" href="javascript:void(0)" onclick="onOpen_Popup()">
                                <i class="icon-cal"><img src="{{ asset('images/icon/calender_icon.png') }}" /></i>
                                <label>Đặt lịch hẹn</label>
                            </a>
                            <!-- icon search-->
                            <div class="input-icon">
                                <div class="head-input-g">
                                    <input type="text" placeholder="Nhập từ khoá tìm kiếm" class="cl-input-seach" />
                                    <i onclick="onShowHide_search(this)" class="fa fa-search" aria-hidden="true"></i>
                                </div>
                            </div>
                            <!--icon lang-->
                            <ul class="ul-lang ul-icon">
                                <li class="li-group">
                                    <a onclick="onChange_Lang(this)">
                                        <img class="icon-flag" src="{{ asset('images/icon/Flage_vn.png') }}" />
                                        <i class="fa fa-angle-down"></i>
                                    </a>
                                    <ul class="m-ul-sub" style="width:180px; top:45px; right:0; z-index:10;">
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
