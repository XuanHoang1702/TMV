@extends('layouts.app')

@section('title', 'DỊCH VỤ PHẪU THUẬT THẨM MỸ CÔ BÉ - Thẩm mỹ Dr.DAT')

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
            <div class="cl-jCenter">
                <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                    <div class="col-12 col-sm-12">
                        <h4 class="cl-title">PHẪU THUẬT THẨM MỸ CÔ BÉ</h4>
                    </div>
                    <div class="col-12 col-sm-12 cl-desc">
                        <p>
                            Tại Dr. Đạt, dịch vụ phẫu thuật thẩm mỹ vùng kín giúp chị em lấy lại sự tự tin và thoải mái, thực hiện an toàn, hiệu quả và kín đáo.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row cl-sec02" data-aos="fade-up" data-aos-duration="2000">
                <div class="col-md-6">
                    <img src="{{ asset('images/services/phau-thuat-co-be-01.jpg') }}" alt="Phẫu thuật cô bé" class="img-fluid">
                </div>
                <div class="col-md-6">
                    <h5>Giới thiệu</h5>
                    <p>
                        Phẫu thuật thẩm mỹ cô bé là dịch vụ dành cho phụ nữ sau sinh, muốn cải thiện hình dáng và chức năng vùng kín, mang lại sự tự tin và đời sống hạnh phúc.
                    </p>
                </div>
            </div>
            <div class="row cl-sec03 mt-5" data-aos="fade-up" data-aos-duration="2000">
                <div class="col-12">
                    <h5>Lý do chọn chúng tôi</h5>
                    <ul>
                        <li>Đội ngũ bác sĩ chuyên môn cao</li>
                        <li>Quy trình an toàn, đạt chuẩn y tế</li>
                        <li>Chế độ chăm sóc hậu phẫu tận tâm</li>
                        <li>Bảo mật tuyệt đối thông tin khách hàng</li>
                    </ul>
                </div>
            </div>
            <div class="row cl-sec04 mt-5" data-aos="fade-up" data-aos-duration="2000">
                <div class="col-12">
                    <h5>Quy trình thực hiện</h5>
                    <ol>
                        <li>Thăm khám, tư vấn và lên kế hoạch</li>
                        <li>Chuẩn bị trước phẫu thuật</li>
                        <li>Tiến hành phẫu thuật</li>
                        <li>Theo dõi, chăm sóc hậu phẫu</li>
                    </ol>
                </div>
            </div>
            <div class="row cl-sec05 mt-5" data-aos="fade-up" data-aos-duration="2000">
                <div class="col-12">
                    <h5>Khách hàng cảm nhận</h5>
                    <p>
                        "Cảm ơn Dr. Đạt và ekip đã giúp tôi tự tin trở lại. Dịch vụ rất chuyên nghiệp, an toàn và chu đáo." – Chị H.
                    </p>
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