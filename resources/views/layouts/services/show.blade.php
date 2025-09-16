@extends('layouts.app')

@section('title', isset($service) ? $service->name : (isset($category) ? $category->name : 'Dịch vụ - Thẩm mỹ Dr.DAT'))

@section('meta')
    <meta name="description"
        content="{{ isset($service) ? $service->meta_description ?? ($service->description ?? 'Khám phá các dịch vụ thẩm mỹ tại Dr.DAT.') : (isset($category) ? $category->meta_description ?? ($category->description ?? 'Khám phá các dịch vụ thẩm mỹ tại Dr.DAT.') : 'Khám phá các dịch vụ thẩm mỹ tại Dr.DAT.') }}">
    <meta name="keywords"
        content="{{ isset($service) ? $service->meta_keywords ?? 'dịch vụ thẩm mỹ, Dr.DAT, ' . $service->name : (isset($category) ? $category->meta_keywords ?? 'dịch vụ thẩm mỹ, Dr.DAT, ' . $category->name : 'dịch vụ thẩm mỹ, Dr.DAT') }}">
    <meta property="og:title"
        content="{{ isset($service) ? $service->name . ' tại Dr.DAT' : (isset($category) ? $category->name . ' tại Dr.DAT' : 'Dịch vụ thẩm mỹ tại Dr.DAT') }}" />
    <meta property="og:description"
        content="{{ isset($service) ? $service->meta_description ?? ($service->description ?? 'Khám phá các dịch vụ thẩm mỹ tại Dr.DAT.') : (isset($category) ? $category->meta_description ?? ($category->description ?? 'Khám phá các dịch vụ thẩm mỹ tại Dr.DAT.') : 'Khám phá các dịch vụ thẩm mỹ tại Dr.DAT.') }}" />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image"
        content="{{ isset($service) && $service->image ? Storage::url($service->image) : (isset($category) && $category->image ? Storage::url($category->image) : asset('images/logo_Dr_Dat.png')) }}" />
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
            @if ($serviceBanner)
                <div class="cl-jCenter">
                    <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="col-12 col-sm-12">
                            <h4 class="cl-title">{{ $serviceBanner->title }}</h4>
                        </div>
                        <div class="col-12 col-sm-12 cl-desc">
                            <p>{!! nl2br(e($serviceBanner->content)) !!}</p>
                        </div>
                    </div>
                </div>
            @endif


            <!--contents-->
            @if (isset($service))
                <div class="cl-panel-list">
                    <div class="cl-panel-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 cl-ct-info" data-aos="fade-left" data-aos-duration="3000">
                                <div class="cl-info">
                                    <h4>{{ $service->name }}</h4>
                                    <p>{{ $service->description ?: 'Không có mô tả.' }}</p>
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
                                <div class="col-12 col-sm-5 cl-info" data-aos="fade-right" data-aos-duration="3000">
                                    <h4>
                                        <b><br />{{ $service->name }}<br />BAO GỒM</b>
                                    </h4>
                                    <div class="cl-dv-btn">
                                        <a href="{{ route('services.detail', $service->slug) }}">
                                            <img src="{{ asset('images/icon/icon_arowOnly_right.png') }}" />
                                        </a>
                                    </div>
                                    @if ($service->image)
                                        <div>
                                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}"
                                                class="img-fluid" style="max-width: 100%;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 col-sm-7 cl-detail">
                                    @foreach ($service->children as $child)
                                        <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                                            <div class="row">
                                                <div class="col-12 col-sm-2 cl-img">
                                                    @if ($child->icon_page_service)
                                                        <img src="{{ Storage::url($child->icon_page_service) }}"
                                                            alt="{{ $child->name }}" class="img-fluid">
                                                    @else
                                                        <img src="{{ asset('images/dichvu/default-icon.png') }}"
                                                            alt="Default Icon" class="img-fluid">
                                                    @endif
                                                </div>
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
            @elseif (isset($category))
                @foreach ($category->services as $service)
                    <!-- Dịch vụ phụ thuộc -->
                    @if ($service->children->count() > 0)
                        <div class="cl-panel-list">
                            <div class="cl-panel-body">
                                <div class="row">
                                    <div class="col-12 col-sm-5 cl-info" data-aos="fade-right" data-aos-duration="3000">
                                        <h4>
                                            <b><br />{{ $service->name }}<br />BAO GỒM</b>
                                        </h4>
                                        <div class="cl-dv-btn">
                                            <a href="{{ route('services.detail', $service->slug) }}">
                                                <img src="{{ asset('images/icon/icon_arowOnly_right.png') }}" />
                                            </a>
                                        </div>
                                        @if ($service->image)
                                            <div>
                                                <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}"
                                                    class="img-fluid" style="max-width: 100%;">
                                            </div>
                                        @endif
                                    </div>
                                    <div class="col-12 col-sm-7 cl-detail">
                                        @foreach ($service->children as $child)
                                            <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                                                <div class="row">
                                                    <div class="col-12 col-sm-2 cl-img">
                                                        @if ($child->icon_page_service)
                                                            <img src="{{ Storage::url($child->icon_page_service) }}"
                                                                alt="{{ $child->name }}" class="img-fluid">
                                                        @else
                                                            <img src="{{ asset('images/dichvu/default-icon.png') }}"
                                                                alt="Default Icon" class="img-fluid">
                                                        @endif
                                                    </div>
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
            @else
                <div class="cl-jCenter">
                    <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="col-12 col-sm-12">
                            <h4 class="cl-title">Dịch vụ không tìm thấy</h4>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        <div class="cl-sec02" data-aos="zoom-in" data-aos-duration="3000">
            <img src="{{ asset('images/dichvu/bap_tay_het_mo.png') }}">
        </div>

        <!--Quy trinh-->
        <div class="cl-dv-lydo">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-info ">
                        <h4>QUY TRÌNH PHẪU THUẬT THẨM MỸ</h4>
                    </div>
                </div>

                <div class="row" style="padding:35px 0;">
                    <div class="col-12 col-sm-3 cl-colItem" data-aos="zoom-in">
                        <div class="col-item item-bg-org">
                            <div class="row" style="margin-bottom:15px;">
                                <div class="col-12 col-sm-9 dv-number">
                                    <h1>01</h1>
                                </div>
                                <div class="col-12 col-sm-3 cl-img-right">
                                    <img src="{{ asset('images/icon/icon_arow_right_blue.png') }}" />
                                </div>
                            </div>
                            <h3>Tư vấn và khám sức khỏe</h3>
                            <p>Bác sĩ sẽ tư vấn phương pháp phù hợp với nhu cầu của bạn, kiểm tra tình trạng sức khỏe để đảm
                                bảo an toàn trước khi phẫu thuật.</p>
                            <div class="cl-img">
                                <img src="{{ asset('images/dichvu/img_qt1.png') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 cl-colItem" data-aos="zoom-in" data-aos-duration="1000">
                        <div class="col-item item-bg-org">
                            <div class="row" style="margin-bottom:15px;">
                                <div class="col-12 col-sm-9 dv-number">
                                    <h1>02</h1>
                                </div>
                                <div class="col-12 col-sm-3 cl-img-right">
                                    <img src="{{ asset('images/icon/icon_arow_right_blue.png') }}" />
                                </div>
                            </div>
                            <h3>Lập kế hoạch phẫu thuật</h3>
                            <p>Sau khi xác định phương pháp, bác sĩ sẽ lên kế hoạch chi tiết cho ca hút mỡ, cấy mỡ.</p>
                            <div class="cl-img">
                                <img src="{{ asset('images/dichvu/img_qt2.png') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 cl-colItem" data-aos="zoom-in" data-aos-duration="2000">
                        <div class="col-item item-bg-org">
                            <div class="row" style="margin-bottom:15px;">
                                <div class="col-12 col-sm-9 dv-number">
                                    <h1>03</h1>
                                </div>
                                <div class="col-12 col-sm-3 cl-img-right">
                                    <img src="{{ asset('images/icon/icon_arow_right_blue.png') }}" />
                                </div>
                            </div>
                            <h3>Tiến hành phẫu thuật</h3>
                            <p>Phẫu thuật hút mỡ và cấy mỡ được thực hiện dưới gây tê hoặc gây mê nhẹ, bạn sẽ không cảm thấy
                                đau đớn trong quá trình thực hiện.</p>
                            <div class="cl-img">
                                <img src="{{ asset('images/dichvu/img_qt3.png') }}" />
                            </div>
                        </div>
                    </div>
                    <div class="col-12 col-sm-3 cl-colItem" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="col-item item-bg-org">
                            <div class="row" style="margin-bottom:15px;">
                                <div class="col-12 col-sm-9 dv-number">
                                    <h1>04</h1>
                                </div>
                                <div class="col-12 col-sm-3 cl-img-right">
                                    <img src="{{ asset('images/icon/icon_arow_right_blue.png') }}" />
                                </div>
                            </div>
                            <h3>Chăm sóc sau phẫu thuật</h3>
                            <p>Bác sĩ sẽ hướng dẫn chăm sóc vết mổ, giảm sưng, đau và phục hồi nhanh chóng.</p>
                            <div class="cl-img">
                                <img src="{{ asset('images/dichvu/img_qt4.png') }}" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="cl-dv-camnhan">
            <div class="container">
                <div class="cl-bg-camnhan">
                    <div class="row">
                        <div class="col-12 col-sm-4 cl-img-vertical" data-aos="zoom-in" data-aos-duration="1000">
                            <img src="{{ asset('images/dichvu/camnhan_1.png') }}" />
                        </div>
                        <div class="col-12 col-sm-8">
                            <div class="row">
                                <div class="col-12 col-sm-6" data-aos="fade-left">
                                    <div class="col-item">
                                        <div class="cl-img">
                                            <img src="{{ asset('images/dichvu/camnhan_2.png') }}" />
                                        </div>
                                        <h3>Vóc dáng thon gọn</h3>
                                        <p>Sau khi hút mỡ, các vùng mỡ thừa sẽ được loại bỏ, giúp bạn sở hữu vóc dáng thon
                                            gọn và săn chắc hơn.</p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6" data-aos="fade-left" data-aos-duration="1000">
                                    <div class="col-item">
                                        <div class="cl-img">
                                            <img src="{{ asset('images/dichvu/camnhan_3.png') }}" />
                                        </div>
                                        <h3>Cải thiện diện mạo</h3>
                                        <p>Cấy mỡ vào các vùng mặt hoặc cơ thể giúp tạo hình hài hòa, tự nhiên và trẻ trung
                                            hơn.</p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6" data-aos="fade-left" data-aos-duration="2000">
                                    <div class="col-item">
                                        <div class="cl-img">
                                            <img src="{{ asset('images/dichvu/camnhan_4.png') }}" />
                                        </div>
                                        <h3>Hiệu quả lâu dài</h3>
                                        <p>Các kết quả sau phẫu thuật duy trì lâu dài, bạn sẽ không phải lo lắng về mỡ thừa
                                            hay sự biến đổi bất ngờ.</p>
                                    </div>
                                </div>
                                <div class="col-12 col-sm-6" data-aos="fade-left" data-aos-duration="3000">
                                    <div class="col-item">
                                        <div class="cl-img">
                                            <img src="{{ asset('images/dichvu/camnhan_5.png') }}" />
                                        </div>
                                        <h3>Phục hồi nhanh chóng</h3>
                                        <p>Với các phương pháp hiện đại, thời gian phục hồi nhanh chóng, giúp bạn quay lại
                                            với công việc và các hoạt động bình thường.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Sec 4 - dat lich kham ngay-->
    @include('layouts.booking.booking_Popup_DatLichKham')
@endsection
