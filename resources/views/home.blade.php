@extends('layouts.app')

@section('title', 'Trang chủ - Thẩm mỹ Dr.DAT')

@section('meta_description',
    'Thẩm mỹ Dr.DAT - Trung tâm thẩm mỹ hàng đầu với dịch vụ phẫu thuật thẩm mỹ chuyên nghiệp,
    đội ngũ bác sĩ giàu kinh nghiệm. Tư vấn miễn phí 24/7.')

@section('meta_keywords',
    'thẩm mỹ dr dat, phẫu thuật thẩm mỹ, làm đẹp, spa thẩm mỹ, cắt mí, nâng mũi, hút mỡ, trẻ hóa
    da')

@section('og_title', 'Trang chủ - Thẩm mỹ Dr.DAT')

@section('og_description',
    'Thẩm mỹ Dr.DAT - Trung tâm thẩm mỹ hàng đầu với dịch vụ phẫu thuật thẩm mỹ chuyên nghiệp,
    đội ngũ bác sĩ giàu kinh nghiệm. Tư vấn miễn phí 24/7.')

@section('og_image', asset('images/logo_Dr_Dat.png'))

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
@endsection

@section('content')
    <!-- Banners -->
    @if (isset($banners) && $banners->isNotEmpty())
        @include('layouts.banners', ['banners' => $banners])
    @else
        <p>Không có banner để hiển thị.</p>
    @endif

    <div class="cl-h-sec01">
        <div class="container">
            <!-- Service List -->
            @php
                $services = isset($services)
                    ? $services
                    : \App\Models\Service::where('is_active', true)
                        ->whereNull('parent_id')
                        ->with(['children', 'category'])
                        ->orderBy('sort_order')
                        ->get();
            @endphp
            @if (isset($services) && $services->isNotEmpty())
                @include('layouts.service-list', ['services' => $services])
            @else
                <p>Không có dịch vụ để hiển thị.</p>
            @endif

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
    @if ($sec02Banner)
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
                @if (isset($certificates) && $certificates->isNotEmpty())
                    @include('layouts.certificate', ['certificates' => $certificates])
                @else
                    <p>Không có chứng chỉ để hiển thị.</p>
                @endif
            </div>
        </div>

        <!-- Section 4 -->
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

        <!-- Section 5 -->
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
                                    @foreach ($tabs as $index => $tab)
                                        <div class="col-12 col-sm-3 cl-tab-head-item {{ $index === 0 ? 'active' : '' }}"
                                            onclick="onChangeTab(this, 'tab{{ $index + 1 }}')">
                                            <a href="javascript:void(0)">{{ $tab->name }}</a>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <div class="cl-tab-bodys">
                                <!-- Tab 1 -->
                                <div class="cl-content-news active" id="tab1">
                                    <div class="btn-left">
                                        <a href="javascript:void(0)"><img src="images/icon/icon_left.png" /></a>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <section class="nl-sx-slider slider">
                                                @forelse ($newsByCategory['chuyen-mon'] ?? [] as $item)
                                                    <div class="slide nl-sx-item-slide">
                                                        <div class="item-news">
                                                            <img src="{{ asset('storage/' . $item->images[0]) }}"
                                                                alt="{{ $item->title }}">
                                                            <p class="cl-date">{{ $item->published_at->format('d.m.Y') }}
                                                            </p>
                                                            <h2>{{ $item->title }}</h2>
                                                            <div class="dv-button">
                                                                <a class="cl-btn-full-2"
                                                                    href="{{ route('news.detail', $item->slug) }}"
                                                                    style="width:90%;">
                                                                    <span>Xem thêm</span>
                                                                    <i class="fa fa-angle-right"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <i>Chuyên môn đang cập nhật dữ liệu...</i>
                                                @endforelse
                                            </section>
                                        </div>
                                    </div>

                                    <div class="btn-right">
                                        <a href="javascript:void(0)"><img src="images/icon/icon_right.png" /></a>
                                    </div>
                                </div>

                                <!-- Tab 2 -->
                                <div class="cl-content-news" id="tab2">
                                    <div class="btn-left">
                                        <a href="javascript:void(0)"><img src="images/icon/icon_left.png" /></a>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <section class="nl-sx-slider slider">
                                                @forelse ($newsByCategory['dao-tao'] ?? [] as $item)
                                                    <div class="slide nl-sx-item-slide">
                                                        <div class="item-news">
                                                            <img src="{{ asset('storage/' . $item->images[0]) }}"
                                                                alt="{{ $item->title }}">
                                                            <p class="cl-date">{{ $item->published_at->format('d.m.Y') }}
                                                            </p>
                                                            <h2>{{ $item->title }}</h2>
                                                            <div class="dv-button">
                                                                <a class="cl-btn-full-2"
                                                                    href="{{ route('news.detail', $item->slug) }}"
                                                                    style="width:90%;">
                                                                    <span>Xem thêm</span>
                                                                    <i class="fa fa-angle-right"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <i>Chuyên môn đang cập nhật dữ liệu...</i>
                                                @endforelse
                                            </section>
                                        </div>
                                    </div>

                                    <div class="btn-right">
                                        <a href="javascript:void(0)"><img src="images/icon/icon_right.png" /></a>
                                    </div>
                                </div>

                                <!-- Tab 3 -->
                                <div class="cl-content-news" id="tab3">
                                    <div class="btn-left">
                                        <a href="javascript:void(0)"><img src="images/icon/icon_left.png" /></a>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <section class="nl-sx-slider slider">
                                                @forelse ($newsByCategory['tu-thien'] ?? [] as $item)
                                                    <div class="slide nl-sx-item-slide">
                                                        <div class="item-news">
                                                            <img src="{{ asset('storage/' . $item->images[0]) }}"
                                                                alt="{{ $item->title }}">
                                                            <p class="cl-date">{{ $item->published_at->format('d.m.Y') }}
                                                            </p>
                                                            <h2>{{ $item->title }}</h2>
                                                            <div class="dv-button">
                                                                <a class="cl-btn-full-2"
                                                                    href="{{ route('news.detail', $item->slug) }}"
                                                                    style="width:90%;">
                                                                    <span>Xem thêm</span>
                                                                    <i class="fa fa-angle-right"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <i>Từ thiện đang cập nhật dữ liệu...</i>
                                                @endforelse
                                            </section>
                                        </div>
                                    </div>
                                    <div class="btn-right">
                                        <a href="javascript:void(0)"><img src="images/icon/icon_right.png" /></a>
                                    </div>
                                </div>

                                <!-- Tab 4 -->
                                <div class="cl-content-news" id="tab4">
                                    <div class="btn-left">
                                        <a href="javascript:void(0)"><img src="images/icon/icon_left.png" /></a>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <section class="nl-sx-slider slider">
                                                @forelse ($newsByCategory['bao-chi-truyen-thong'] ?? [] as $item)
                                                    <div class="slide nl-sx-item-slide">
                                                        <div class="item-news">
                                                            <img src="{{ asset('storage/' . $item->images[0]) }}"
                                                                alt="{{ $item->title }}">
                                                            <p class="cl-date">{{ $item->published_at->format('d.m.Y') }}
                                                            </p>
                                                            <h2>{{ $item->title }}</h2>
                                                            <div class="dv-button">
                                                                <a class="cl-btn-full-2"
                                                                    href="{{ route('news.detail', $item->slug) }}"
                                                                    style="width:90%;">
                                                                    <span>Xem thêm</span>
                                                                    <i class="fa fa-angle-right"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @empty
                                                    <i>Báo chí, Truyền thông đang cập nhật dữ liệu...</i>
                                                @endforelse
                                            </section>
                                        </div>
                                    </div>
                                    <div class="btn-right">
                                        <a href="javascript:void(0)"><img src="images/icon/icon_right.png" /></a>
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

@section('scripts')
    <script>
        $(document).ready(function() {
            // Khởi tạo slick cho tất cả slider
            $('.slider').slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                arrows: false,
                dots: false,
                infinite: false
            });

            // Hàm đổi tab
            window.onChangeTab = function(element, tabId) {
                // Remove active cũ
                $('.cl-tab-head-item').removeClass('active');
                $('.cl-content-news').removeClass('active');

                // Add active mới
                $(element).addClass('active');
                $('#' + tabId).addClass('active');

                // Refresh slick
                $('#' + tabId + ' .slider').slick('setPosition');
            };
        });
    </script>
@endsection
