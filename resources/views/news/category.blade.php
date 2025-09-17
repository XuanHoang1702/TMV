@extends('layouts.app')

@section('title', 'Chi tiết tin tức - Thẩm mỹ Dr.DAT')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/tintuc.css') }}">
@endsection

@section('content')
    <div class="cl-body-bg">
        <div class="container">
            <!--banner-->
            <div class="cl-jCenter">
                <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                    <div class="col-12 col-sm-12">
                        <h4 class="cl-title">CHI TIẾT TIN TỨC</h4>
                    </div>
                    <div class="col-12 col-sm-12 cl-desc">
                        <p>
                            Cập nhật những thông tin mới nhất về ngành thẩm mỹ, công nghệ làm đẹp tiên tiến,
                            và những chia sẻ hữu ích từ Dr. Đạt và đội ngũ bác sĩ chuyên khoa.
                        </p>
                    </div>
                </div>
            </div>

            <!--News Detail-->
            <div class="cl-news">
                <div class="row">
                    <!--Left-->
                    <div class="col-12 col-sm-3">
                        <!--div button-->
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <a class="cl-btn-full" href="{{ route('news.index') }}">
                                    <span>Tất cả</span>
                                </a>
                            </div>
                            @foreach ($newsCategories as $category)
                                <div class="col-12 col-sm-12">
                                    <a class="cl-btn-full-2" href="{{ route('news.category', $category->slug) }}">
                                        <span>{{ $category->name }}</span>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                        <!--imge-->
                        <div class="row cl-img-left">
                            <div class="col-12 col-sm-12">
                                <img src="../images/tintuc/tin-tuc-banner_1.png" />
                            </div>
                        </div>
                        <!--Form-->
                        @include('layouts.booking.tuvan_no_popup')

                    </div>
                    <!--Right-->
                    
                </div>

            </div>

            <!--Datlich-->
            @include('layouts.booking.booking_Popup_DatLichKham')
        @endsection
