@extends('layouts.app')

@section('title', 'Về Dr. Đạt - Thẩm mỹ Dr.DAT')

@section('meta_description', 'Tìm hiểu về bác sĩ Đạt và đội ngũ chuyên gia tại Thẩm mỹ Dr.DAT. Kinh nghiệm dày dặn trong lĩnh vực thẩm mỹ, cam kết an toàn và hiệu quả cho khách hàng.')

@section('meta_keywords', 'về bác sĩ Đạt, thẩm mỹ Dr.DAT, bác sĩ thẩm mỹ uy tín, kinh nghiệm phẫu thuật thẩm mỹ, đội ngũ chuyên gia hàng đầu, an toàn thẩm mỹ, tư vấn miễn phí, làm đẹp an toàn, dịch vụ thẩm mỹ chuyên nghiệp')

@section('og_title', 'Về Dr. Đạt - Thẩm mỹ Dr.DAT')

@section('og_description', 'Tìm hiểu về bác sĩ Đạt và đội ngũ chuyên gia tại Thẩm mỹ Dr.DAT. Kinh nghiệm dày dặn trong lĩnh vực thẩm mỹ, cam kết an toàn và hiệu quả cho khách hàng.')

@section('og_image', asset('images/logo_Dr_Dat.png'))

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/veDrDat.css') }}">
@endsection

@section('content')
    <div class="cl-body-bg">
        <div class="container">
            <!--banner-->
            @if ($pageContent)
                <div class="cl-jCenter cl-aboutUs-0">
                    <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="col-12 col-sm-12">
                            <h4 class="cl-title">{{ $pageContent->title }}</h4>
                        </div>
                        <div class="col-12 col-sm-12 cl-desc">
                            <p class="ab-banner-desc">{!! nl2br(e($pageContent->content)) !!}</p>
                        </div>
                    </div>
                </div>
            @endif



            <!--contents-->
            <div class="cl-aboutUs-info">
                <div class="row">
                    @foreach ($abouts as $about)
                        <div class="col-12 col-sm-6 info-avartar" data-aos="fade-right" data-aos-duration="2000">
                            @if ($about->image)
                                <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}" />
                            @endif
                        </div>
                        <div class="col-12 col-sm-6 info-desc" data-aos="fade-left" data-aos-duration="2000">
                            <div class="icon_nhay_1">
                                <img src="{{ asset('images/veDrDat/top_n.png') }}" />
                            </div>
                            <h4>{{ $about->title }}</h4>
                            <p>{!! nl2br(e($about->content)) !!}</p>
                            <div class="icon_nhay_2">
                                <img src="{{ asset('images/veDrDat/bottom_n.png') }}" />
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>


            <div class="cl-aboutUs-1">
                @if ($aboutUs1)
                    <div class="row" data-aos="fade-up" data-aos-duration="2000">
                        <div class="col-12 col-sm-12">
                            <h4 class="cl-title">
                                {!! nl2br(e($aboutUs1->title)) !!}
                            </h4>
                        </div>
                        <div class="col-12 col-sm-12 cl-desc">
                            <p>
                                {!! nl2br(e($aboutUs1->description)) !!}
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="cl-aboutUs-2">
                <div class="row">
                    @if ($aboutUs1 && $aboutUs1->icons->count())
                        @foreach ($aboutUs1->icons as $icon)
                            <div class="col-12 col-sm-4">
                                <div class="cl-item" data-aos="flip-right" data-aos-duration="3000">
                                    <div class="cl-icon">
                                        <img src="{{ asset('storage/' . $icon->icon) }}" alt="{{ $icon->icon_title }}">
                                    </div>
                                    <h2>{{ $icon->icon_title }}</h2>
                                    <p>{{ $icon->icon_content }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>


            <div class="cl-aboutUs-3">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-image">
                        @if ($bannersSection1->count() > 0)
                            @foreach ($bannersSection1 as $banner)
                                <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" />
                            @endforeach

                        @endif
                    </div>
                </div>
            </div>

            <div class="cl-aboutUs-1">
                @if ($aboutUs2)
                    <div class="row" data-aos="fade-up" data-aos-duration="2000">
                        <div class="col-12 col-sm-12">
                            <h4 class="cl-title">
                                {!! nl2br(e($aboutUs2->title)) !!}
                            </h4>
                        </div>
                        <div class="col-12 col-sm-12 cl-desc">
                            <p>
                                {!! nl2br(e($aboutUs2->description)) !!}
                            </p>
                        </div>
                    </div>
                @endif
            </div>

            <div class="cl-aboutUs-1" data-aos="zoom-in" data-aos-duration="2000">
                <div class="cl-aboutUs-4">
                    <label class="dv-title">{{ $aboutUs2->sub_title ?? 'Chúng tôi cam kết' }}</label>
                    <div class="cl-content">
                        <ul class="cl-ul-lists">
                            @if ($aboutUs2 && $aboutUs2->icons->count())
                                @foreach ($aboutUs2->icons as $icon)
                                    <li>
                                        <i class="cl-icon">
                                            <img src="{{ asset('storage/' . $icon->icon) }}"
                                                alt="{{ $icon->icon_title }}">
                                        </i>
                                        <label>{{ $icon->icon_content }}</label>
                                    </li>
                                @endforeach
                            @else
                                {{-- fallback nếu chưa có data --}}
                                <li><i class="cl-icon"><img src="{{ asset('images/icon/icon_check.png') }}" /></i><label>Quy trình chuẩn y
                                        khoa…</label></li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>



            <div class="cl-aboutUs-3">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-image" style="padding-bottom: 70px;">
                        @if ($bannersSection2->count() > 0)
                            @foreach ($bannersSection2 as $banner)
                                <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" />
                            @endforeach
                        @else
                            <img src="images/veDrDat/image_aboutUs_end.png" />
                        @endif
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!--Sec 4 - dat lich kham ngay-->
    @include('layouts.booking.booking_Popup_DatLichKham')
@endsection
