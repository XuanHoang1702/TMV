@extends('layouts.app')

@section('title', $service->meta_title ?? $service->name . ' - Thẩm mỹ Dr.DAT')

@section('meta_description', $service->meta_description ?? $service->description)

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dichvu.css') }}">
<link rel="stylesheet" href="{{ asset('css/site.css') }}">
<link rel="stylesheet" href="{{ asset('css/lib/aos.css') }}" />
<link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
@endsection

@section('content')
<div class="body-content">
    @include('partials.header')

    <div class="cl-body-bg">
        <div class="container">
            <!-- Service Banner -->
            <div class="cl-jCenter">
                <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                    <div class="col-12 col-sm-12">
                        <h4 class="cl-title">{{ $service->name }}</h4>
                    </div>
                    <div class="col-12 col-sm-12 cl-desc">
                        <p>
                            {!! $service->description !!}
                        </p>
                    </div>
                </div>
            </div>

            <!-- Service Image and Intro -->
            <div class="row cl-sec02" data-aos="fade-up" data-aos-duration="2000">
                <div class="col-md-6">
                    @if($service->image)
                        <img src="{{ asset('storage/' . $service->image) }}" alt="{{ $service->name }}" class="img-fluid">
                    @else
                        <img src="{{ asset('images/services/default-service.jpg') }}" alt="{{ $service->name }}" class="img-fluid">
                    @endif
                </div>
                <div class="col-md-6">
                    <h5>Giới thiệu</h5>
                    <div>
                        {!! $service->content !!}
                    </div>
                </div>
            </div>

            <!-- Service Details -->
            @if($service->details && $service->details->count() > 0)
                <div class="row cl-sec03 mt-5" data-aos="fade-up" data-aos-duration="2000">
                    <div class="col-12">
                        <h5>Chi tiết dịch vụ</h5>
                        @foreach($service->details as $detail)
                            <div class="service-detail-item mb-4">
                                <h6>{{ $detail->title }}</h6>
                                <div>{!! $detail->content !!}</div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            <!-- Service Info -->
            <div class="row cl-sec04 mt-5" data-aos="fade-up" data-aos-duration="2000">
                <div class="col-12">
                    <h5>Thông tin dịch vụ</h5>
                    <div class="service-info">
                        @if($service->price_range)
                            <p><strong>Khoảng giá:</strong> {{ $service->price_range }}</p>
                        @endif
                        @if($service->duration)
                            <p><strong>Thời gian thực hiện:</strong> {{ $service->duration }}</p>
                        @endif
                        @if($service->category)
                            <p><strong>Danh mục:</strong> {{ $service->category->name }}</p>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Related Services -->
            @if($relatedServices && $relatedServices->count() > 0)
                <div class="row cl-sec05 mt-5" data-aos="fade-up" data-aos-duration="2000">
                    <div class="col-12">
                        <h5>Dịch vụ liên quan</h5>
                        <div class="row">
                            @foreach($relatedServices as $relatedService)
                                <div class="col-md-4 mb-4">
                                    <div class="related-service-card">
                                        @if($relatedService->image)
                                            <img src="{{ asset('storage/' . $relatedService->image) }}" alt="{{ $relatedService->name }}" class="img-fluid">
                                        @else
                                            <img src="{{ asset('images/services/default-service.jpg') }}" alt="{{ $relatedService->name }}" class="img-fluid">
                                        @endif
                                        <h6><a href="{{ route('services.detail', $relatedService->slug) }}">{{ $relatedService->name }}</a></h6>
                                        <p>{!! Str::limit($relatedService->description, 100) !!}</p>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
    </div>

    <!-- CTA Section -->
    <div class="cl-sec04">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-6">
                    <div class="h-sec4-info">
                        <h4>ĐẶT LỊCH TƯ VẤN NGAY!</h4>
                        <p>Để được Dr. Đạt tư vấn trực tiếp và nhận báo giá chi tiết, hãy liên hệ với chúng tôi ngay hôm nay.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-6 h-sec4-form">
                    <form action="{{ route('appointment.store') }}" method="POST">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <input type="text" name="name" placeholder="Họ & tên" class="ctr-h-input" required />
                            </div>
                            <div class="col-12 col-sm-4">
                                <input type="email" name="email" placeholder="Email" class="ctr-h-input" />
                            </div>
                            <div class="col-12 col-sm-4">
                                <input type="text" name="phone" placeholder="Số điện thoại" class="ctr-h-input" required />
                            </div>
                        </div>
                        <input type="hidden" name="service" value="{{ $service->name }}" />
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <button type="submit" class="cl-btn-full">
                                    <span>Đặt lịch ngay</span>
                                    <i class="fa fa-angle-right"></i>
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script src="{{ asset('js/_jquery.js') }}"></script>
<script src="{{ asset('js/lib/aos.js') }}"></script>
<script>
    AOS.init();
</script>
@endsection
