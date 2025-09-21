@extends('layouts.app')

@section('title', isset($service) ? $service->meta_title ?? $service->name : (isset($category) ? $category->meta_title ?? $category->name : 'Dịch vụ - Thẩm mỹ Dr.DAT'))

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

@section('content')
<div class="cl-body-bg">
    <div class="container">

        <!--banner-->
        @if ($serviceBanner)
            <div class="cl-jCenter">
                <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                    <div class="col-12 col-sm-12">
                        <h4 class="cl-title">{{ $serviceBanner->title ?? 'DỊCH VỤ CỦA CHÚNG TÔI' }}</h4>
                    </div>
                    <div class="col-12 col-sm-12 cl-desc">
                        <p>{!! nl2br(e($serviceBanner->content ?? 'Chúng tôi cung cấp các dịch vụ thẩm mỹ tiên tiến, an toàn và hiệu quả, được thực hiện bởi ekip bác sĩ giàu kinh nghiệm, tận tâm và luôn đặt sức khỏe của bạn lên hàng đầu. Tại Dr. Đạt, mỗi khách hàng đều là một câu chuyện riêng biệt, và chúng tôi luôn cam kết mang lại kết quả tuyệt vời, tự nhiên, và lâu dài.')) !!}</p>
                    </div>
                </div>
            </div>
        @else
            <div class="cl-jCenter">
                <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                    <div class="col-12 col-sm-12">
                        <h4 class="cl-title">DỊCH VỤ CỦA CHÚNG TÔI</h4>
                    </div>
                    <div class="col-12 col-sm-12 cl-desc">
                        <p>
                            Chúng tôi cung cấp các dịch vụ thẩm mỹ tiên tiến, an toàn và hiệu quả, được thực hiện bởi ekip bác sĩ giàu kinh nghiệm, tận tâm và luôn đặt sức khỏe của bạn lên hàng đầu.
                            Tại Dr. Đạt, mỗi khách hàng đều là một câu chuyện riêng biệt, và chúng tôi luôn cam kết mang lại kết quả tuyệt vời, tự nhiên, và lâu dài.
                        </p>
                    </div>
                </div>
            </div>
        @endif

        <!--contents-->
        @if (isset($service))
            {{-- Hiển thị cho SERVICE --}}
            <div class="cl-panel-list">
                <div class="cl-panel-body">
                    <div class="row">
                        <div class="col-12 col-sm-12 cl-ct-info" data-aos="fade-left" data-aos-duration="3000">
                            <div class="cl-info">
                                <h4>{{ $service->name }}</h4>
                                <p>{!! nl2br(e($service->description)) !!}</p>
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

            {{-- Dịch vụ bao gồm --}}
            @if($service->children && $service->children->count() > 0)
            <div class="cl-panel-list">
                <div class="cl-panel-body">
                    <div class="row">
                        <div class="col-12 col-sm-5 cl-info" data-aos="fade-right" data-aos-duration="3000">
                            <h4>
                                {{ $service->name }} <br />
                                BAO GỒM
                            </h4>
                            <div class="cl-dv-btn">
                                <a href="{{ route('services.detail', $service->slug) }}">
                                    <img src="{{ asset('images/icon/icon_arowOnly_right.png') }}" />
                                </a>
                            </div>
                            @if ($service->image)
                                <div>
                                    <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="img-fluid" style="max-width: 100%;">
                                </div>
                            @else
                                <div>
                                    <img src="{{ asset('images/dichvu/dv_01.png') }}" alt="{{ $service->name }}" class="img-fluid" style="max-width: 100%;">
                                </div>
                            @endif
                        </div>
                        <div class="col-12 col-sm-7 cl-detail">
                            @foreach($service->children as $index => $child)
                                <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                                    <div class="row">
                                        <div class="col-12 col-sm-2 cl-img">
                                            @if($child->icon_page_service)
                                                <img src="{{ Storage::url($child->icon_page_service) }}" alt="{{ $child->name }}" class="img-fluid">
                                            @else
                                                <img src="{{ asset('images/dichvu/icon_dv' . ($index + 1) . '.png') }}" alt="{{ $child->name }}" class="img-fluid">
                                            @endif
                                        </div>
                                        <div class="col-12 col-sm-10 cl-ct-info">
                                            <h2>{{ $child->name }}</h2>
                                            <p>{!! nl2br(e($child->content)) !!}</p>
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
            {{-- Hiển thị cho CATEGORY --}}
            @foreach ($category->services as $service)
                @if ($service->children->count() > 0)
                    <div class="cl-panel-list">
                        <div class="cl-panel-body">
                            <div class="row">
                                <div class="col-12 col-sm-12 cl-ct-info" data-aos="fade-left" data-aos-duration="3000">
                                    <div class="cl-info">
                                        <h4>{{ $service->name }}</h4>
                                        <p>{!! nl2br(e($service->description)) !!}</p>
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

                    {{-- Dịch vụ bao gồm --}}
                    <div class="cl-panel-list">
                        <div class="cl-panel-body">
                            <div class="row">
                                <div class="col-12 col-sm-5 cl-info" data-aos="fade-right" data-aos-duration="3000">
                                    <h4>
                                        {{ $service->name }} <br />
                                        BAO GỒM
                                    </h4>
                                    <div class="cl-dv-btn">
                                        <a href="{{ route('services.detail', $service->slug) }}">
                                            <img src="{{ asset('images/icon/icon_arowOnly_right.png') }}" />
                                        </a>
                                    </div>
                                    @if ($service->image)
                                        <div>
                                            <img src="{{ Storage::url($service->image) }}" alt="{{ $service->name }}" class="img-fluid" style="max-width: 100%;">
                                        </div>
                                    @else
                                        <div>
                                            <img src="{{ asset('images/dichvu/dv_01.png') }}" alt="{{ $service->name }}" class="img-fluid" style="max-width: 100%;">
                                        </div>
                                    @endif
                                </div>
                                <div class="col-12 col-sm-7 cl-detail">
                                    @foreach($service->children as $index => $child)
                                        <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                                            <div class="row">
                                                <div class="col-12 col-sm-2 cl-img">
                                                    @if($child->icon_page_service)
                                                        <img src="{{ Storage::url($child->icon_page_service) }}" alt="{{ $child->name }}" class="img-fluid">
                                                    @else
                                                        <img src="{{ asset('images/dichvu/icon_dv' . ($index + 1) . '.png') }}" alt="{{ $child->name }}" class="img-fluid">
                                                    @endif
                                                </div>
                                                <div class="col-12 col-sm-10 cl-ct-info">
                                                    <h2>{{ $child->name }}</h2>
                                                    <p>{!! nl2br(e($child->content)) !!}</p>
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

    {{-- Phần processesLiDo --}}
    @if (isset($processesLiDo) && $processesLiDo->count() > 0)
        <div class="cl-dv-lydo" data-aos="zoom-in" data-aos-duration="3000">
            <div class="container">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-info">
                        @php
                            $firstProcess = $processesLiDo->where('order', 0)->first();
                            $sectionTitle = $firstProcess
                                ? $firstProcess->title
                                : 'LÝ DO NÊN CHỌN ' . strtoupper($pageTitle) . ' TẠI DR. ĐẠT';
                        @endphp
                        <h4>{{ $sectionTitle }}</h4>
                    </div>
                </div>

                @foreach ($processesLiDo as $process)
                    <div class="row" style="padding:35px 0;">
                        @php
                            $liDoIndex = 1;
                            $renderedItems = 0;
                        @endphp
                        @foreach ($process->processImages as $image)
                            @if ($image->image && $image->title)
                                <div class="col-12 col-sm-3">
                                    <div class="col-item">
                                        <div class="cl-img">
                                            <img src="{{ Storage::url($image->image) }}"
                                                alt="{{ $image->title ?? $process->title }}"
                                                class="img-fluid" />
                                        </div>
                                        <h3>{{ $image->title ?? $process->title }}</h3>
                                        <p>{!! $image->description ?? ($process->description ?? 'Nội dung sẽ được cập nhật.') !!}</p>
                                    </div>
                                </div>
                                @php
                                    $liDoIndex++;
                                    $renderedItems++;
                                @endphp
                            @endif
                        @endforeach
                        @php
                            $missingCols = 4 - ($renderedItems % 4);
                            if ($missingCols > 0 && $missingCols < 4) {
                                for ($i = 0; $i < $missingCols; $i++) {
                                    echo '<div class="col-12 col-sm-3" style="visibility: hidden; height: 0;"></div>';
                                }
                            }
                        @endphp
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Banner Section 1 --}}
    <div class="cl-sec02" data-aos="zoom-in" data-aos-duration="3000">
        @if ($bannersSection1->count() > 0)
            @foreach ($bannersSection1 as $banner)
                <img src="{{ asset('storage/' . $banner->image_path) }}" alt="{{ $banner->title }}" class="img-fluid" />
            @endforeach
        @else
            <img src="{{ asset('images/dichvu/bap_tay_het_mo.png') }}" class="img-fluid">
        @endif
    </div>

    {{-- Quy trình --}}
    @if (isset($processesQuyTrinh) && $processesQuyTrinh->count() > 0)
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

                @foreach ($processesQuyTrinh as $process)
                    <div class="row" style="padding:35px 0;">
                        @php $quyTrinhIndex = 1; @endphp
                        @foreach ($process->processImages as $image)
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
                                    <h3>{{ $image->title ?? $process->title }}</h3>
                                    <p>{!! $image->description ?? $process->description ?? 'Chi tiết sẽ được cập nhật.' !!}</p>
                                    <div class="cl-img">
                                        <img src="{{ Storage::url($image->image) }}"
                                            alt="{{ $image->title ?? $process->title }}"
                                            class="img-fluid" />
                                    </div>
                                </div>
                            </div>
                            @php $quyTrinhIndex++; @endphp
                        @endforeach
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    {{-- Cảm nhận --}}
    @if (isset($advertisements) && $advertisements->count() > 0)
        <div class="cl-dv-camnhan">
            <div class="container">
                <div class="cl-bg-camnhan">
                    <div class="row">
                        @foreach ($advertisements as $advertisement)
                            @php
                                $subImages = is_string($advertisement->sub_images)
                                    ? json_decode($advertisement->sub_images, true)
                                    : $advertisement->sub_images ?? [];

                                $titles = is_string($advertisement->titles)
                                    ? json_decode($advertisement->titles, true)
                                    : $advertisement->titles ?? [];

                                $contents = is_string($advertisement->contents)
                                    ? json_decode($advertisement->contents, true)
                                    : $advertisement->contents ?? [];
                            @endphp
                            <div class="col-12 col-sm-4 cl-img-vertical" data-aos="zoom-in" data-aos-duration="1000">
                                <img src="{{ Storage::url($advertisement->main_image) }}" class="img-fluid" />
                            </div>
                            <div class="col-12 col-sm-8">
                                <div class="row">
                                    @for ($i = 0; $i < count($subImages); $i++)
                                        <div class="col-12 col-sm-6" data-aos="fade-left"
                                            data-aos-duration="{{ ($i + 1) * 1000 }}">
                                            <div class="col-item">
                                                <div class="cl-img">
                                                    <img src="{{ Storage::url($subImages[$i]) }}" class="img-fluid" />
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
    @endif
</div>

<!--Sec 4 - dat lich kham ngay-->
@include('layouts.booking.booking_Popup_DatLichKham')
@endsection
