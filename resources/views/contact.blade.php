@extends('layouts.app')

@section('title', 'Liên hệ - Thẩm mỹ Dr.DAT')

@section('meta')
    <meta name="description"
        content="Liên hệ với Thẩm mỹ Dr.DAT để được tư vấn và hỗ trợ tốt nhất. Địa chỉ, số điện thoại và email liên hệ.">
    <meta name="keywords" content="liên hệ, thẩm mỹ, Dr.DAT, tư vấn, hỗ trợ, địa chỉ, hotline, email">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="Liên hệ - Thẩm mỹ Dr.DAT" />
    <meta property="og:description" content="Liên hệ với Thẩm mỹ Dr.DAT để được tư vấn và hỗ trợ tốt nhất." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('images/logo_Dr_Dat.png') }}" />
    <meta name="twitter:card" content="summary_large_image" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lienhe.css') }}">
    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

@endsection

@section('content')
    <div class="cl-body-bg">
        <div class="container">
            <!-- Banner -->
            @if ($contactBanner)
                <div class="cl-jCenter">
                    <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="col-12 col-sm-12">
                            <h4 class="cl-title">{{ $contactBanner->title }}</h4>
                        </div>
                        <div class="col-12 col-sm-12 cl-desc">
                            <p class="ab-banner-desc">{!! nl2br(e($contactBanner->content)) !!}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Contact Map & Info - GIỮ NGUYÊN GIAO DIỆN -->
            <div class="cl-panel-list">
                <div class="cl-panel-body">
                    <div class="row">
                        {{-- THAY THẾ IMAGE BẰNG INTERACTIVE MAP --}}
                        <div class="col-12 col-sm-6 position-relative" data-aos="fade-right" data-aos-duration="3000">
                            <div class="contact-map-container">
                                {{-- Interactive Map --}}
                                <div id="contactMap"></div>

                                {{-- Loading Overlay --}}
                                <div id="mapLoading" class="map-loading-overlay">
                                    <div class="map-loading-spinner"></div>
                                    <div class="text-muted small">Đang tải bản đồ vị trí...</div>
                                </div>

                                {{-- Fallback Image --}}
                                @if(!$information || !$information->latitude || !$information->longitude)
                                    <img src="{{ asset('images/lienhe/lien_he_map.png') }}"
                                         alt="Bản đồ liên hệ Thẩm mỹ Dr.DAT"
                                         class="fallback-contact-image"
                                         id="fallbackContactImage">
                                @endif
                            </div>
                        </div>

                        {{-- GIỮ NGUYÊN PHẦN INFO --}}
                        <div class="col-12 col-sm-6 cl-ct-info" data-aos="fade-left" data-aos-duration="3000">
                            <div class="cl-info">
                                @if ($information)
                                    <h4>{{ $information->name }}</h4>

                                    @if ($information->hotline)
                                        <p><i class="fa fa-phone"></i> Hotline: <b>{{ $information->hotline }}</b></p>
                                    @endif

                                    @if ($information->address)
                                        <p><i class="fa fa-map-marker"></i> Địa chỉ: <b>{{ $information->address }}</b></p>
                                    @endif

                                    @if ($information->working_time)
                                        @php $workingTime = json_decode($information->working_time, true); @endphp
                                        <p><i class="fa fa-clock-o"></i> Thời gian làm việc:</p>
                                        <ul class="ul-info">
                                            @if (isset($workingTime['monday_friday']))
                                                <li>
                                                    <span>Thứ Hai - Thứ Sáu:</span>
                                                    <b>{{ $workingTime['monday_friday']['open'] ?? '' }} -
                                                        {{ $workingTime['monday_friday']['close'] ?? '' }}</b>
                                                </li>
                                            @endif
                                            @if (isset($workingTime['saturday']))
                                                <li>
                                                    <span>Thứ Bảy:</span>
                                                    <b>{{ $workingTime['saturday']['open'] ?? '' }} -
                                                        {{ $workingTime['saturday']['close'] ?? '' }}</b>
                                                </li>
                                            @endif
                                            <li>
                                                <span>Chủ Nhật:</span>
                                                <b>
                                                    {{ $workingTime['sunday'] ?? 'Nghỉ' }}
                                                </b>
                                            </li>
                                        </ul>
                                    @endif

                                    @if ($information->email)
                                        <p><i class="fa fa-envelope-o"></i> Email: {{ $information->email }}</p>
                                    @endif

                                    @if ($information->website)
                                        <p><i class="fa fa-globe"></i> Website: {{ $information->website }}</p>
                                    @endif
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Thông tin liên hệ</h5>
                                        <p class="text-muted">Sẽ được cập nhật sớm</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hospital Images - GIỮ NGUYÊN -->
            @if(isset($hospitalImages) && $hospitalImages->count() > 0)
                <div class="cl-panel-list">
                    <div class="cl-panel-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 cl-info">
                                <h4>{{ $hospitalImages->first()->title ?? 'Hình ảnh cơ sở' }}</h4>
                            </div>
                        </div>

                        <div class="row">
                            @foreach ($hospitalImages->take(2) as $image)
                                <div class="col-12 col-sm-6" data-aos="zoom-in">
                                    <img src="{{ asset('storage/' . $image->image) }}" />
                                </div>
                            @endforeach
                        </div>
                        <div class="row" style="margin-top:25px;">
                            @foreach ($hospitalImages->skip(2)->take(3) as $image)
                                <div class="col-12 col-sm-4" data-aos="zoom-in">
                                    <img src="{{ asset('storage/' . $image->image) }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
            <!-- Booking Popup - GIỮ NGUYÊN -->
            @include('layouts.booking.booking_Popup_DatLichKham')
        </div>
    </div>
