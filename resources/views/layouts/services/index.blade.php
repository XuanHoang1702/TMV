@extends('layouts.app')

@section('title', 'Dịch vụ - Thẩm mỹ Dr.DAT')

@section('meta')
    <meta name="description"
        content="Khám phá các dịch vụ thẩm mỹ tại Dr.DAT: phẫu thuật thẩm mỹ cô bé, hút mỡ, cấy mỡ, nâng cơ vùng kín và nhiều dịch vụ khác. An toàn, hiệu quả, thực hiện bởi đội ngũ bác sĩ giàu kinh nghiệm.">
    <meta name="keywords"
        content="dịch vụ thẩm mỹ, Dr.DAT, phẫu thuật cô bé, hút mỡ, cấy mỡ, nâng cơ, làm hồng vùng kín, tư vấn thẩm mỹ, bác sĩ thẩm mỹ, dịch vụ thẩm mỹ Dr.DAT, phẫu thuật thẩm mỹ an toàn, nâng mũi, cắt mí, trẻ hóa da, làm đẹp chuyên nghiệp">
    <meta property="og:title" content="Dịch vụ thẩm mỹ tại Dr.DAT" />
    <meta property="og:description"
        content="Khám phá các dịch vụ thẩm mỹ tiên tiến tại Dr.DAT: phẫu thuật cô bé, hút mỡ, cấy mỡ, nâng cơ vùng kín và nhiều dịch vụ khác. Đảm bảo an toàn và hiệu quả." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('images/logo_Dr_Dat.png') }}" />
    <meta name="twitter:card" content="summary_large_image" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/dichvu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/lib/aos.css') }}" />
    <link rel="stylesheet" href="{{ asset('css/site.css') }}">
@endsection

@section('content')
    <div class="cl-body-bg">
        <div class="container">
            <!--banner-->
            <div class="cl-jCenter">
                <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                    <div class="col-12 col-sm-12">
                        <h4 class="cl-title">DỊCH VỤ CỦA CHÚNG TÔI</h4>
                    </div>
                    <div class="col-12 col-sm-12 cl-desc">
                        <p>
                            Chúng tôi cung cấp các dịch vụ thẩm mỹ tiên tiến, an toàn và hiệu quả, được thực hiện bởi ekip
                            bác sĩ giàu kinh nghiệm, tận tâm và luôn đặt sức khỏe của bạn lên hàng đầu.
                            Tại Dr. Đạt, mỗi khách hàng đều là một câu chuyện riêng biệt, và chúng tôi luôn cam kết mang lại
                            kết quả tuyệt vời, tự nhiên, và lâu dài.
                        </p>
                    </div>
                </div>
            </div>



            <!--contents-->
            @foreach ($services as $service)
                <div class="cl-panel-list">
                    <div class="cl-panel-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 cl-ct-info" data-aos="fade-left" data-aos-duration="3000">
                                <div class="cl-info">
                                    <h4>{{ $service->name }}</h4>
                                    <p>
                                        {{ $service->description ?: 'Không có mô tả.' }}
                                    </p>
                                </div>
                                <div class="cl-btn-more">
                                    <a href="{{ route('services.detail', $service->slug) }}">
                                        <img src="{{ asset('images/icon/icon_arrow_down.png') }}" />
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Dịch vụ phụ thuộc -->
                @if ($service->children->count() > 0)
                    <div class="cl-panel-list">
                        <div class="cl-panel-body">
                            <div class="row">
                                <!-- Cột trái -->
                                <div class="col-12 col-sm-5 cl-info" data-aos="fade-right" data-aos-duration="3000">
                                    <h4>
                                        <b><br />{{ $service->name }} <br />BAO GỒM</b>
                                    </h4>
                                    <div class="cl-dv-btn">
                                        <a href="{{ route('services.detail', $service->slug) }}">
                                            <img src="{{ asset('images/icon/icon_arowOnly_right.png') }}" alt="arrow" />
                                        </a>
                                    </div>
                                    @if ($service->image)
                                        <div>
                                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}"
                                                class="img-fluid" style="max-width: 100%;">
                                        </div>
                                    @endif
                                </div>

                                <!-- Cột phải -->
                                <div class="col-12 col-sm-7 cl-detail">
                                    @foreach ($service->children as $child)
                                        <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                                            <div class="row align-items-start">
                                                <!-- Icon -->
                                                <div class="col-12 col-sm-2 cl-img">
                                                    @if ($child->icon_page_service)
                                                        <img src="{{ Storage::url($child->icon_page_service) }}"
                                                            alt="{{ $child->name }}" class="img-fluid" />
                                                    @else
                                                        <img src="{{ asset('images/dichvu/default-icon.png') }}"
                                                            alt="Default Icon" class="img-fluid" />
                                                    @endif
                                                </div>
                                                <!-- Nội dung -->
                                                <div class="col-12 col-sm-10 cl-ct-info">
                                                    <h2>{{ $child->name }}</h2>
                                                    <p>{{ $child->description ?: 'Không có mô tả.' }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>

                    </div>
                @endif
            @endforeach

            <!--Ly do-->
            {{-- <div class="cl-dv-lydo" data-aos="zoom-in" data-aos-duration="3000">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-info ">
                        <h4>LÝ DO NÊN CHỌN PHẪU THUẬT THẨM MỸ TẠI DR. ĐẠT</h4>
                    </div>
                </div>

                <div class="row" style="padding:35px 0;">
                    @foreach($processesLiDo as $process)
                        @foreach($process->processImages as $image)
                            <div class="col-12 col-sm-3">
                                <div class="col-item">
                                    <div class="cl-img">
                                        <img src="{{ asset('storage/' . $image->image) }}" />
                                    </div>
                                    <h3>{{ $image->title }}</h3>
                                    <p>{{ $image->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
                </div>
            </div> --}}
        </div>

        <div class="cl-sec02" data-aos="zoom-in" data-aos-duration="3000">
            @if($bannersSection1->count() > 0)
                @foreach($bannersSection1 as $banner)
                    <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" />
                @endforeach
            @else
                <img src="{{ asset('images/dichvu/bap_tay_het_mo.png') }}">
            @endif
        </div>

        <!--Quy trinh-->
        <div class="cl-dv-lydo">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-info ">
                        <h4>QUY TRÌNH PHẪU THUẬT THẨM MỸ</h4>
                    </div>
                </div>

                {{-- <div class="row" style="padding:35px 0;">
                    @foreach($processesQuyTrinh as $process)
                        @foreach($process->processImages as $index => $image)
                            <div class="col-12 col-sm-3 cl-colItem" data-aos="zoom-in" data-aos-duration="{{ ($index + 1) * 1000 }}">
                                <div class="col-item item-bg-org">
                                    <div class="row" style="margin-bottom:15px;">
                                        <div class="col-12 col-sm-9 dv-number">
                                            <h1>{{ str_pad($index + 1, 2, '0', STR_PAD_LEFT) }}</h1>
                                        </div>
                                        <div class="col-12 col-sm-3 cl-img-right">
                                            <img src="{{ asset('images/icon/icon_arow_right_blue.png') }}" />
                                        </div>
                                    </div>
                                    <h3>{{ $image->title }}</h3>
                                    <p>{{ $image->description }}</p>
                                    <div class="cl-img">
                                        <img src="{{ asset('storage/' . $image->image) }}" />
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endforeach
            </div> --}}
        </div>

         <div class="cl-dv-camnhan">
            <div class="container">
                <div class="cl-bg-camnhan">
                    <div class="row">
                        @foreach ($advertisements as $advertisement)
                            @php
                                $subImages = json_decode($advertisement->sub_images, true) ?? [];
                                $titles = json_decode($advertisement->titles, true) ?? [];
                                $contents = json_decode($advertisement->contents, true) ?? [];
                            @endphp
                            <div class="col-12 col-sm-4 cl-img-vertical" data-aos="zoom-in" data-aos-duration="1000">
                                <img src="{{ Storage::url($advertisement->main_image) }}" />
                            </div>
                            <div class="col-12 col-sm-8">
                                <div class="row">
                                    @for ($i = 0; $i < count($subImages); $i++)
                                        <div class="col-12 col-sm-6" data-aos="fade-left"
                                            data-aos-duration="{{ ($i + 1) * 1000 }}">
                                            <div class="col-item">
                                                <div class="cl-img">
                                                    <img src="{{ Storage::url($subImages[$i]) }}" />
                                                </div>
                                                <h3>{{ $titles[$i] ?? '' }}</h3>
                                                <p>{{ $contents[$i] ?? '' }}</p>
                                            </div>
                                        </div>
                                    @endfor
                                </div>
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
