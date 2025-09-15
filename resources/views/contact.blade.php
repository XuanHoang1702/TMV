@extends('layouts.app')

@section('title', 'Liên hệ - Thẩm mỹ Dr.DAT')

@section('meta')
    <meta name="description" content="Liên hệ với Thẩm mỹ Dr.DAT để được tư vấn và hỗ trợ tốt nhất. Địa chỉ, số điện thoại và email liên hệ.">
    <meta name="keywords" content="liên hệ, thẩm mỹ, Dr.DAT, tư vấn, hỗ trợ, địa chỉ, hotline, email">
    <meta property="og:title" content="Liên hệ - Thẩm mỹ Dr.DAT" />
    <meta property="og:description" content="Liên hệ với Thẩm mỹ Dr.DAT để được tư vấn và hỗ trợ tốt nhất." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('images/logo_Dr_Dat.png') }}" />
    <meta name="twitter:card" content="summary_large_image" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lienhe.css') }}">
@endsection

@section('content')
    <div class="cl-body-bg">
        <div class="container">
            <!--banner-->
            <div class="cl-jCenter">
                <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                    <div class="col-12 col-sm-12">
                        <h4 class="cl-title">Liên Hệ Với Chúng Tôi</h4>
                    </div>
                    <div class="col-12 col-sm-12 cl-desc ">
                        <p class="ab-banner-desc">
                            Chúng tôi luôn sẵn sàng lắng nghe và hỗ trợ bạn trong hành trình chăm sóc sắc đẹp. Mọi thắc mắc,
                            yêu cầu tư vấn hay đặt lịch hẹn,
                            đừng ngần ngại liên hệ với chúng tôi qua các phương thức dưới đây:
                        </p>
                    </div>
                </div>
            </div>

            <!--contents-->
            <div class="cl-panel-list">
                <div class="cl-panel-body">
                    <div class="row">
                        <div class="col-12 col-sm-6" data-aos="fade-right" data-aos-duration="3000">
                            <img
                                src="{{ $information && $information->images_address ? asset('storage/' . $information->images_address) : asset('images/lienhe/lien_he_map.png') }}" />
                        </div>
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
                                                    <b>{{ $workingTime['monday_friday']['start'] ?? '' }} -
                                                        {{ $workingTime['monday_friday']['end'] ?? '' }}</b>
                                                </li>
                                            @endif
                                            @if (isset($workingTime['saturday']))
                                                <li>
                                                    <span>Thứ Bảy:</span>
                                                    <b>{{ $workingTime['saturday']['start'] ?? '' }} -
                                                        {{ $workingTime['saturday']['end'] ?? '' }}</b>
                                                </li>
                                            @endif
                                            <li>
                                                <span>Chủ Nhật:</span>
                                                <b>
                                                    {{ isset($workingTime['sunday_closed']) && $workingTime['sunday_closed'] == '1'
                                                        ? 'Nghỉ'
                                                        : ($workingTime['sunday']['start'] ?? '') . ' - ' . ($workingTime['sunday']['end'] ?? '') }}
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
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!--Hinh anhr-->
            <div class="cl-panel-list">
                <div class="cl-panel-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 cl-info">
                            <h4>{{ $hospitalImages->first()->title ?? 'Hình ảnh bệnh viện' }}</h4>
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
        </div>
    </div>

    <!--Sec 4 - dat lich kham ngay-->
     @include('layouts.booking.booking_Popup_DatLichKham')
@endsection
