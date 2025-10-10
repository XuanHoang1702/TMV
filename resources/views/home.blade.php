@extends('layouts.app')

@section('title', 'Trang chủ - Thẩm mỹ Dr.DAT')

@section('meta_description',
    'Thẩm mỹ Dr.DAT - Trung tâm thẩm mỹ hàng đầu với dịch vụ phẫu thuật thẩm mỹ chuyên nghiệp,
    đội ngũ bác sĩ giàu kinh nghiệm. Tư vấn miễn phí 24/7.')

@section('meta_keywords',
    'thẩm mỹ dr dat, phẫu thuật thẩm mỹ, làm đẹp an toàn, spa thẩm mỹ, cắt mí, nâng mũi, hút mỡ,
    trẻ hóa da, dịch vụ thẩm mỹ chuyên nghiệp, bác sĩ giàu kinh nghiệm, tư vấn miễn phí 24/7')

@section('og_title', 'Trang chủ - Thẩm mỹ Dr.DAT')

@section('og_description',
    'Thẩm mỹ Dr.DAT - Trung tâm thẩm mỹ hàng đầu với dịch vụ phẫu thuật thẩm mỹ chuyên nghiệp,
    đội ngũ bác sĩ giàu kinh nghiệm. Tư vấn miễn phí 24/7.')

@section('og_image', asset('images/logo_Dr_Dat.png'))

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/home.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/aos@next/dist/aos.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
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
        @include('layouts.booking.booking_Popup_DatLichKham')
        <!-- Section 5 (News) -->
        <div class="cl-sec5">
            <div class="container" data-aos="zoom-in" data-aos-duration="2000">
                <div class="row">
                    <div class="col-12">
                        <h4 class="cl-title-sec">{{ mb_strtoupper($newsMenuLabel, 'UTF-8') }}</h4>

                    </div>
                </div>

                <div class="cl-tab">
                    <!-- Tab Headers -->
                    <div class="cl-tab-head">
                        <div class="row">
                            @foreach ($tabs as $index => $category)
                                <div class="col-12 col-sm-3 cl-tab-head-item {{ $index === 0 ? 'active' : '' }}"
                                    onclick="onChangeTab(this,'tab{{ $category->id }}')"
                                    data-tab-id="tab{{ $category->id }}">
                                    <a href="javascript:void(0)">{{ $category->name }}</a>
                                </div>
                            @endforeach
                        </div>
                    </div>

                    <!-- Tab Contents -->
                    <div class="cl-tab-bodys">
                        @foreach ($tabs as $index => $category)
                            <div class="cl-content-news {{ $index === 0 ? 'active' : '' }}" id="tab{{ $category->id }}">
                                <!-- Left Navigation -->
                                <div class="btn-left">
                                    <a href="javascript:void(0)"><img src="{{ asset('images/icon/icon_left.png') }}"
                                            alt="Previous" /></a>
                                </div>

                                <!-- Slider Content -->
                                <div class="row">
                                    <div class="col-12">
                                        <section class="nl-sx-slider slider">
                                            @forelse ($newsByCategory[$category->slug] ?? [] as $news)
                                                <div class="slide nl-sx-item-slide">
                                                    <div class="item-news" data-aos="fade-up"
                                                        data-aos-delay="{{ $loop->index * 100 }}">
                                                        {{-- Image --}}
                                                        @if (!empty($news->images) && isset($news->images[0]))
                                                            <img src="{{ Storage::url($news->images[0]) }}"
                                                                alt="{{ $news->title }}" loading="lazy" />
                                                        @else
                                                            <img src="{{ asset('images/home/default.png') }}"
                                                                alt="Default Image" loading="lazy" />
                                                        @endif

                                                        {{-- Date Badge --}}
                                                        <p class="cl-date">
                                                            {{ \Carbon\Carbon::parse($news->published_at)->format('d.m.Y') }}
                                                        </p>

                                                        {{-- Title --}}
                                                        <h2>{{ Str::limit($news->title, 60) }}</h2>

                                                        {{-- Read More Button --}}
                                                        <div class="dv-button">
                                                            <a class="cl-btn-full-2" style="width:90%"
                                                                href="{{ route('news.detail', [$news->category->slug, $news->slug]) }}">
                                                                <span>Xem thêm</span>
                                                                <i class="fa fa-angle-right"></i>
                                                            </a>
                                                        </div>

                                                    </div>
                                                </div>
                                            @empty
                                                <div class="empty-slide">
                                                    <div class="empty-content">
                                                        <i class="fa fa-clock-o"></i>
                                                        <h4>{{ $category->name }} đang cập nhật</h4>
                                                        <p>Vui lòng quay lại sau để xem tin tức mới nhất</p>
                                                    </div>
                                                </div>
                                            @endforelse
                                        </section>
                                    </div>
                                </div>

                                <!-- Dots (Slick sẽ tự render vào đây) -->
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="list-button"></div>
                                    </div>
                                </div>

                                <!-- Right Navigation -->
                                <div class="btn-right">
                                    <a href="javascript:void(0)"><img src="{{ asset('images/icon/icon_right.png') }}"
                                            alt="Next" /></a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="https://unpkg.com/aos@next/dist/aos.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>
    <script>
        $(document).ready(function() {
            // Initialize AOS
            AOS.init();

            // Initialize Slick Slider for each tab
            $('.nl-sx-slider').each(function() {
                $(this).slick({
                    slidesToShow: 3,
                    slidesToScroll: 1,
                    prevArrow: $(this).closest('.cl-content-news').find('.btn-left a'),
                    nextArrow: $(this).closest('.cl-content-news').find('.btn-right a'),
                    dots: true,
                    appendDots: $(this).closest('.cl-content-news').find('.list-button'),
                    infinite: true,
                    responsive: [{
                        breakpoint: 768,
                        settings: {
                            slidesToShow: 1
                        }
                    }]
                });
            });

            // Handle tab switching
            window.onChangeTab = function(element, tabId) {
                $('.cl-tab-head-item').removeClass('active');
                $('.cl-content-news').removeClass('active');
                $(element).addClass('active');
                $('#' + tabId).addClass('active');
                $('#' + tabId + ' .nl-sx-slider').slick('setPosition');
            };
        });
    </script>
@endsection
