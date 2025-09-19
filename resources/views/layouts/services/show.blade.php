@extends('layouts.app')

@section('title', isset($service) ? $service->meta_title ?? $service->name : (isset($category) ? $category->meta_title
    ?? $category->name : 'Dịch vụ - Thẩm mỹ Dr.DAT'))

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

        @if ($processesLiDo->count() > 0)
            <div class="cl-dv-lydo" data-aos="zoom-in" data-aos-duration="3000">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 cl-info">
                            {{-- Lấy title từ process order = 0 --}}
                            @php
                                $liDoTitleProcess = $processesLiDo->where('order', 0)->first();
                                $sectionTitle = $liDoTitleProcess
                                    ? $liDoTitleProcess->title
                                    : 'LÝ DO NÊN CHỌN ' . strtoupper($pageTitle) . ' TẠI DR. ĐẠT';

                                // Debug trong blade
                                // dd($processesLiDo->toArray(), $sectionTitle);

                            @endphp
                            <h4>{{ $sectionTitle }}</h4>
                        </div>
                    </div>

                    <div class="row" style="padding:35px 0;">
                        @php $liDoIndex = 1; @endphp
                        {{-- Chỉ hiển thị các process có order > 0 (nội dung), tối đa 4 items --}}
                        @foreach ($processesLiDo->where('order', '>', 0)->take(4) as $process)
                            <div class="col-12 col-sm-3">
                                <div class="col-item">
                                    <div class="cl-img">
                                        @if ($process->processImages->count() > 0)
                                            {{-- Sử dụng image từ database --}}
                                            <img src="{{ Storage::url($process->processImages->first()->image) }}"
                                                alt="{{ $process->processImages->first()->title ?? $process->title }}"
                                                class="img-fluid" />
                                        @else
                                            {{-- Fallback static image theo index --}}
                                            <img src="{{ asset('images/dichvu/icon_lydo' . $liDoIndex . '.png') }}"
                                                alt="{{ $process->title }}" class="img-fluid" />
                                        @endif
                                    </div>
                                    <h3>{{ $process->title }}</h3>
                                    {{-- SỬA: dùng description thay vì content --}}
                                    <p>{{ $process->description ?? 'Nội dung sẽ được cập nhật.' }}</p>
                                </div>
                            </div>
                            @php $liDoIndex++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
        <div class="cl-sec02" data-aos="zoom-in" data-aos-duration="3000">
            @if ($bannersSection1->count() > 0)
                @foreach ($bannersSection1 as $banner)
                    <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" />
                @endforeach
            @else
                <img src="{{ asset('images/dichvu/bap_tay_het_mo.png') }}">
            @endif
        </div>
        <!--Quy trinh-->
        @if ($processesQuyTrinh->count() > 0)
            <div class="cl-dv-lydo">
                <div class="container">
                    <div class="row">
                        <div class="col-12 col-sm-12 cl-info">
                            @php
                                $quyTrinhTitleProcess = $processesQuyTrinh->where('order', 0)->first();
                                $quyTrinhSectionTitle = $quyTrinhTitleProcess
                                    ? $quyTrinhTitleProcess->title
                                    : 'QUY TRÌNH ' . strtoupper($pageTitle);
                            @endphp
                            <h4>{{ $quyTrinhSectionTitle }}</h4>
                        </div>
                    </div>

                    <div class="row" style="padding:35px 0;">
                        @php $quyTrinhIndex = 1; @endphp
                        @foreach ($processesQuyTrinh->where('order', '>', 0) as $process)
                            <div class="col-12 col-sm-3 cl-colItem" data-aos="zoom-in"
                                data-aos-duration="{{ $quyTrinhIndex * 1000 }}">
                                <div class="col-item item-bg-org">
                                    <div class="row" style="margin-bottom:15px;">
                                        <div class="col-12 col-sm-9 dv-number">
                                            <h1>{{ str_pad($quyTrinhIndex, 2, '0', STR_PAD_LEFT) }}</h1>
                                        </div>
                                        <div class="col-12 col-sm-3 cl-img-right">
                                            <img src="{{ asset('images/icon/icon_arow_right_blue.png') }}" />
                                        </div>
                                    </div>
                                    <h3>{{ $process->title }}</h3>
                                    {{-- SỬA: dùng description thay vì content --}}
                                    <p>{{ $process->description ?? 'Chi tiết sẽ được cập nhật.' }}</p>
                                    <div class="cl-img">
                                        @if ($process->processImages->count() > 0)
                                            {{-- SỬA: dùng image_path thay vì image --}}
                                            <img src="{{ Storage::url($process->processImages->first()->image) }}"
                                                alt="{{ $process->processImages->first()->title ?? $process->title }}" />
                                        @else
                                            <img src="{{ asset('images/dichvu/img_qt' . $quyTrinhIndex . '.png') }}" />
                                        @endif
                                    </div>
                                </div>
                            </div>
                            @php $quyTrinhIndex++; @endphp
                        @endforeach
                    </div>
                </div>
            </div>
        @endif

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
