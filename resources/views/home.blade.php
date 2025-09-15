@extends('layouts.app')

@section('title', 'Trang chủ - Thẩm mỹ Dr.DAT')

@section('meta_description', 'Thẩm mỹ Dr.DAT - Trung tâm thẩm mỹ hàng đầu với dịch vụ phẫu thuật thẩm mỹ chuyên nghiệp, đội ngũ bác sĩ giàu kinh nghiệm. Tư vấn miễn phí 24/7.')

@section('meta_keywords', 'thẩm mỹ dr dat, phẫu thuật thẩm mỹ, làm đẹp, spa thẩm mỹ, cắt mí, nâng mũi, hút mỡ, trẻ hóa da')

@section('og_title', 'Trang chủ - Thẩm mỹ Dr.DAT')

@section('og_description', 'Thẩm mỹ Dr.DAT - Trung tâm thẩm mỹ hàng đầu với dịch vụ phẫu thuật thẩm mỹ chuyên nghiệp, đội ngũ bác sĩ giàu kinh nghiệm. Tư vấn miễn phí 24/7.')

@section('og_image', asset('images/logo_Dr_Dat.png'))

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <!-- Banners -->
    @if(isset($banners) && $banners->isNotEmpty())
        @include('layouts.banners', ['banners' => $banners])
    @else
        <!-- Fallback nếu không có banners -->
        <p>Không có banner để hiển thị.</p>
    @endif

    <div class="cl-h-sec01">
        <div class="container">
            <!-- Service List -->
            @php
                $services = isset($services) ? $services : \App\Models\Service::where('is_active', true)->whereNull('parent_id')->with(['children', 'category'])->orderBy('sort_order')->get();
            @endphp
            @if(isset($services) && $services->isNotEmpty())
                @include('layouts.service-list', ['services' => $services])
            @else
                <p>Không có dịch vụ để hiển thị.</p>
            @endif

            <!-- Vững Chuyên Môn, Giàu Tâm Đức -->
            @include('home.section1')
        </div>
    </div>

    <!-- Section Banner 2 -->
    @php
        $sec02Banner = \App\Models\Banner::where('section', '2')
            ->where('page', 'home')
            ->where('is_active', true)
            ->orderBy('order')
            ->first();
    @endphp
    @if($sec02Banner)
        @include('layouts.section_banner', ['sec02Banner' => $sec02Banner])
    @else
        <p>Không có banner cho section 2.</p>
    @endif

    <div class="cl-bg-g1">
        <!-- Section 3 -->
        <div class="cl-sec03">
            <div class="container">
                <div class="cl-sec01-desc">
                    <div class="row">
                        @include('home.section2')
                    </div>
                </div>
                <!-- Chung chi hanh nghe -->
                @if(isset($certificates) && $certificates->isNotEmpty())
                    @include('layouts.certificate', ['certificates' => $certificates])
                @else
                    <p>Không có chứng chỉ để hiển thị.</p>
                @endif
                <!-- End chung chi hanh nghe -->
            </div>
        </div>

        <!-- Section 4 - Dat lich kham ngay -->
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

        <div class="cl-sec5">
            <div class="container" data-aos="zoom-in" data-aos-duration="2000">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <h4 class="cl-title-sec">TIN TỨC</h4>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="cl-tab">
                            <div class="cl-tab-head">
                                <div class="row">
                                    <div class="col-12 col-sm-3 cl-tab-head-item active" onclick="onChangeTab(this,'tab1')">
                                        <a href="javascript:void(0)">Chuyên môn</a>
                                    </div>
                                    <div class="col-12 col-sm-3 cl-tab-head-item" onclick="onChangeTab(this,'tab2')">
                                        <a href="javascript:void(0)">Đào tạo</a>
                                    </div>
                                    <div class="col-12 col-sm-3 cl-tab-head-item" onclick="onChangeTab(this,'tab3')">
                                        <a href="javascript:void(0)">Từ thiện</a>
                                    </div>
                                    <div class="col-12 col-sm-3 cl-tab-head-item" onclick="onChangeTab(this,'tab4')">
                                        <a href="javascript:void(0)">Báo chí, Truyền thông</a>
                                    </div>
                                </div>
                            </div>
                            <div class="cl-tab-bodys">
                                <div class="cl-content-news active" id="tab1">
                                    <div class="btn-left">
                                        <a href="javascript:void(0)"><img src="images/icon/icon_left.png" /> </a>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <section class="nl-sx-slider slider">
                                                <div class="slide nl-sx-item-slide">
                                                    <div class="item-news">
                                                        <img src="images/home/new_1.png" />
                                                        <p class="cl-date">13.12.2024</p>
                                                        <h2>Cắt mí có ảnh hưởng đến chức năng thị lực?</h2>
                                                        <div class="dv-button">
                                                            <a class="cl-btn-full-2" href="tin-tuc/tin-tuc-chit-tiet.html" style="width:90%;">
                                                                <span>Xem thêm</span>
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slide nl-sx-item-slide">
                                                    <div class="item-news">
                                                        <img src="images/home/new_2.png" />
                                                        <p class="cl-date">13.12.2024</p>
                                                        <h2>Phẫu Thuật Thẩm Mỹ: Làm Đẹp Hay Đánh Mất Chính Mình?</h2>
                                                        <div class="dv-button">
                                                            <a class="cl-btn-full-2" href="tin-tuc/tin-tuc-chit-tiet.html" style="width:90%;">
                                                                <span>Xem thêm</span>
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slide nl-sx-item-slide">
                                                    <div class="item-news">
                                                        <img src="images/home/new_3.png" />
                                                        <p class="cl-date">13.12.2024</p>
                                                        <h2>Phẫu Thuật Thẩm Mỹ: Làm Đẹp Hay Đánh Mất Chính Mình?</h2>
                                                        <div class="dv-button">
                                                            <a class="cl-btn-full-2" href="tin-tuc/tin-tuc-chit-tiet.html" style="width:90%;">
                                                                <span>Xem thêm</span>
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slide nl-sx-item-slide">
                                                    <div class="item-news">
                                                        <img src="images/home/new_3.png" />
                                                        <p class="cl-date">13.12.2024</p>
                                                        <h2>Phẫu Thuật Thẩm Mỹ: Làm Đẹp Hay Đánh Mất Chính Mình?</h2>
                                                        <div class="dv-button">
                                                            <a class="cl-btn-full-2" href="tin-tuc/tin-tuc-chit-tiet.html" style="width:90%;">
                                                                <span>Xem thêm</span>
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="slide nl-sx-item-slide">
                                                    <div class="item-news">
                                                        <img src="images/home/new_3.png" />
                                                        <p class="cl-date">13.12.2024</p>
                                                        <h2>Phẫu Thuật Thẩm Mỹ: Làm Đẹp Hay Đánh Mất Chính Mình?</h2>
                                                        <div class="dv-button">
                                                            <a class="cl-btn-full-2" href="tin-tuc/tin-tuc-chit-tiet.html" style="width:90%;">
                                                                <span>Xem thêm</span>
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </section>
                                        </div>
                                    </div>
                                    <div class="btn-right">
                                        <a href="javascript:void(0)"><img src="images/icon/icon_right.png" /> </a>
                                    </div>
                                </div>
                                <!-- Tab 2 -->
                                <div class="cl-content-news" id="tab2">
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <i>Đào tạo đang cập nhật dữ liệu...</i>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tab 3 -->
                                <div class="cl-content-news" id="tab3">
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <i>Từ thiện đang cập nhật dữ liệu...</i>
                                        </div>
                                    </div>
                                </div>
                                <!-- Tab 4 -->
                                <div class="cl-content-news" id="tab4">
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <i>Báo chí, Truyền thông đang cập nhật dữ liệu...</i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
