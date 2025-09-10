@extends('layouts.app')

@section('title', 'Chi tiết dịch vụ - Thẩm mỹ Dr.DAT')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dichvu.css') }}">
@endsection

@section('content')
<div class="cl-body-bg">
    <div class="container">
        <!--banner-->
        <div class="cl-jCenter">
            <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                <div class="col-12 col-sm-12">
                    <h4 class="cl-title">CHI TIẾT DỊCH VỤ</h4>
                </div>
                <div class="col-12 col-sm-12 cl-desc">
                    <p>
                        Thông tin chi tiết về dịch vụ thẩm mỹ bạn quan tâm. Chúng tôi cung cấp đầy đủ thông tin về quy trình,
                        kỹ thuật, ưu điểm và chi phí để bạn có thể đưa ra quyết định tốt nhất cho bản thân.
                    </p>
                </div>
            </div>
        </div>

        <!--Service Detail-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-ct-info" data-aos="fade-left" data-aos-duration="3000">
                        <div class="cl-info">
                            <h4>DỊCH VỤ PHẪU THUẬT THẨM MỸ CÔ BÉ CHI TIẾT</h4>
                            <p>
                                Phẫu thuật thẩm mỹ cô bé là dịch vụ làm đẹp vùng kín giúp khôi phục sự tự tin và cải thiện sức khỏe sinh lý cho phái nữ.
                                Được thực hiện bởi các bác sĩ chuyên khoa giàu kinh nghiệm, dịch vụ này mang lại kết quả tự nhiên, an toàn và hiệu quả lâu dài.
                            </p>
                            <p>
                                Tại Thẩm Mỹ Tận Tâm Dr. Đạt, chúng tôi sử dụng công nghệ tiên tiến nhất và quy trình chuẩn y khoa để đảm bảo
                                an toàn tuyệt đối cho khách hàng. Mỗi ca phẫu thuật đều được tư vấn kỹ lưỡng và theo dõi sát sao trong suốt quá trình.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Service Process-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-5 cl-info" data-aos="fade-right" data-aos-duration="3000">
                        <h4>
                            QUY TRÌNH <br />
                            THỰC HIỆN <br />
                            CHI TIẾT
                        </h4>
                        <div class="cl-dv-btn">
                            <a href="{{ route('contact') }}">
                                <img src="{{ asset('images/icon/icon_arowOnly_right.png') }}" />
                            </a>
                        </div>
                        <div>
                            <img src="{{ asset('images/dichvu/dv_process.png') }}" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-7 cl-detail">
                        <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                            <div class="row">
                                <div class="col-12 col-sm-2 cl-img">
                                    <img src="{{ asset('images/dichvu/icon_process1.png') }}" />
                                </div>
                                <div class="col-12 col-sm-10 cl-ct-info">
                                    <h2>Bước 1: Tư vấn và khám sức khỏe</h2>
                                    <p>
                                        Bác sĩ sẽ trực tiếp thăm khám, tư vấn phương pháp phù hợp nhất với tình trạng của bạn.
                                        Chúng tôi sẽ giải đáp tất cả thắc mắc và đưa ra lời khuyên chuyên môn.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                            <div class="row">
                                <div class="col-12 col-sm-2 cl-img">
                                    <img src="{{ asset('images/dichvu/icon_process2.png') }}" />
                                </div>
                                <div class="col-12 col-sm-10 cl-ct-info">
                                    <h2>Bước 2: Lên kế hoạch phẫu thuật</h2>
                                    <p>
                                        Sau khi xác định phương pháp, bác sĩ sẽ lập kế hoạch chi tiết cho ca phẫu thuật,
                                        bao gồm các bước thực hiện, thời gian và phương pháp gây tê.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                            <div class="row">
                                <div class="col-12 col-sm-2 cl-img">
                                    <img src="{{ asset('images/dichvu/icon_process3.png') }}" />
                                </div>
                                <div class="col-12 col-sm-10 cl-ct-info">
                                    <h2>Bước 3: Tiến hành phẫu thuật</h2>
                                    <p>
                                        Phẫu thuật được thực hiện trong phòng mổ vô trùng với đội ngũ y bác sĩ chuyên khoa.
                                        Quy trình diễn ra nhanh chóng và an toàn dưới sự giám sát chặt chẽ.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                            <div class="row">
                                <div class="col-12 col-sm-2 cl-img">
                                    <img src="{{ asset('images/dichvu/icon_process4.png') }}" />
                                </div>
                                <div class="col-12 col-sm-10 cl-ct-info">
                                    <h2>Bước 4: Chăm sóc hậu phẫu</h2>
                                    <p>
                                        Sau phẫu thuật, bạn sẽ được hướng dẫn chi tiết về cách chăm sóc vết mổ,
                                        lịch tái khám và các lưu ý để phục hồi nhanh nhất.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Benefits-->
        <div class="cl-dv-lydo" data-aos="zoom-in" data-aos-duration="3000">
            <div class="row">
                <div class="col-12 col-sm-12 cl-info ">
                    <h4>LỢI ÍCH KHI CHỌN DỊCH VỤ TẠI DR. ĐẠT</h4>
                </div>
            </div>

            <div class="row" style="padding:35px 0;">
                <div class="col-12 col-sm-4">
                    <div class="col-item">
                        <div class="cl-img">
                            <img src="{{ asset('images/dichvu/icon_benefit1.png') }}" />
                        </div>
                        <h3>Kết quả tự nhiên</h3>
                        <p>Phẫu thuật thẩm mỹ cô bé mang lại kết quả tự nhiên, hài hòa với cơ thể, giúp bạn tự tin hơn trong cuộc sống.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="col-item">
                        <div class="cl-img">
                            <img src="{{ asset('images/dichvu/icon_benefit2.png') }}" />
                        </div>
                        <h3>An toàn tuyệt đối</h3>
                        <p>Quy trình phẫu thuật được thực hiện trong môi trường vô trùng, với công nghệ hiện đại và đội ngũ bác sĩ chuyên khoa.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-4">
                    <div class="col-item">
                        <div class="cl-img">
                            <img src="{{ asset('images/dichvu/icon_benefit3.png') }}" />
                        </div>
                        <h3>Phục hồi nhanh</h3>
                        <p>Với kỹ thuật tiên tiến, thời gian phục hồi sau phẫu thuật rất nhanh, bạn có thể quay lại sinh hoạt bình thường sớm.</p>
                    </div>
                </div>
            </div>
        </div>

        <!--Before After-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-info">
                        <h4>HÌNH ẢNH TRƯỚC VÀ SAU KHI PHẪU THUẬT</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6" data-aos="zoom-in">
                        <div class="cl-before-after">
                            <h5>Trước phẫu thuật</h5>
                            <img src="{{ asset('images/dichvu/before.jpg') }}" alt="Trước phẫu thuật" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-6" data-aos="zoom-in">
                        <div class="cl-before-after">
                            <h5>Sau phẫu thuật</h5>
                            <img src="{{ asset('images/dichvu/after.jpg') }}" alt="Sau phẫu thuật" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--FAQ-->
    <div class="cl-dv-faq">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 cl-info">
                    <h4>CÂU HỎI THƯỜNG GẶP</h4>
                </div>
            </div>

            <div class="row">
                <div class="col-12 col-sm-12">
                    <div class="accordion" id="faqAccordion">
                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#faq1">
                                    Phẫu thuật thẩm mỹ cô bé có đau không?
                                </button>
                            </h2>
                            <div id="faq1" class="accordion-collapse collapse show" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Phẫu thuật được thực hiện dưới gây tê hoặc gây mê nhẹ, nên bạn sẽ không cảm thấy đau đớn trong quá trình thực hiện.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq2">
                                    Thời gian phục hồi sau phẫu thuật là bao lâu?
                                </button>
                            </h2>
                            <div id="faq2" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Thời gian phục hồi thường từ 1-2 tuần. Bạn có thể quay lại sinh hoạt bình thường sau 3-5 ngày nếu chăm sóc tốt.
                                </div>
                            </div>
                        </div>

                        <div class="accordion-item">
                            <h2 class="accordion-header">
                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#faq3">
                                    Chi phí phẫu thuật thẩm mỹ cô bé là bao nhiêu?
                                </button>
                            </h2>
                            <div id="faq3" class="accordion-collapse collapse" data-bs-parent="#faqAccordion">
                                <div class="accordion-body">
                                    Chi phí phụ thuộc vào phương pháp và mức độ phức tạp. Chúng tôi sẽ tư vấn cụ thể sau khi thăm khám.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--CTA-->
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
                    <div class="row">
                        <div class="col-12 col-sm-4">
                            <input type="text" placeholder="Họ & tên" class="ctr-h-input" />
                        </div>
                        <div class="col-12 col-sm-4">
                            <input type="text" placeholder="Email" class="ctr-h-input" />
                        </div>
                        <div class="col-12 col-sm-4">
                            <input type="text" placeholder="Số điện thoại" class="ctr-h-input" />
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 col-sm-12">
                            <a class="cl-btn-full" href="javascript:void(0)" onclick="onOpen_Popup()">
                                <span>Đặt lịch ngay</span>
                                <i class="fa fa-angle-right"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
