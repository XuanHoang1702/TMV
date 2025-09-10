@extends('layouts.app')

@section('title', 'Tin tức - Thẩm mỹ Dr.DAT')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/tin-tuc.css') }}">
@endsection

@section('content')
<div class="cl-body-bg">
    <div class="container">
        <!--banner-->
        <div class="cl-jCenter">
            <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                <div class="col-12 col-sm-12">
                    <h4 class="cl-title">TIN TỨC & BÀI VIẾT</h4>
                </div>
                <div class="col-12 col-sm-12 cl-desc">
                    <p>
                        Cập nhật những tin tức mới nhất về thẩm mỹ, các phương pháp làm đẹp tiên tiến,
                        kinh nghiệm chăm sóc da và sức khỏe từ đội ngũ bác sĩ chuyên khoa của chúng tôi.
                    </p>
                </div>
            </div>
        </div>

        <!--contents-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <!-- Featured News -->
                    <div class="col-12 col-sm-12" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="cl-featured-news">
                            <div class="row">
                                <div class="col-12 col-sm-6">
                                    <img src="{{ asset('images/tin-tuc/featured-news.jpg') }}" />
                                </div>
                                <div class="col-12 col-sm-6">
                                    <div class="cl-featured-content">
                                        <span class="cl-category">Tin tức nổi bật</span>
                                        <h3>Ứng dụng công nghệ tiên tiến trong phẫu thuật thẩm mỹ hiện đại</h3>
                                        <p>
                                            Với sự phát triển của khoa học công nghệ, ngành thẩm mỹ đã có những bước tiến vượt trội.
                                            Các phương pháp phẫu thuật hiện đại giúp mang lại kết quả tự nhiên và an toàn hơn bao giờ hết.
                                        </p>
                                        <div class="cl-meta">
                                            <span><i class="fa fa-calendar"></i> 15/12/2024</span>
                                            <span><i class="fa fa-user"></i> Dr. Hà Quốc Đạt</span>
                                        </div>
                                        <a href="#" class="cl-read-more">Đọc tiếp <i class="fa fa-arrow-right"></i></a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- News Grid -->
                <div class="row" style="margin-top:50px;">
                    <div class="col-12 col-sm-4" data-aos="fade-up" data-aos-duration="1000">
                        <div class="cl-news-item">
                            <div class="cl-news-image">
                                <img src="{{ asset('images/tin-tuc/news-1.jpg') }}" />
                                <span class="cl-category-tag">Thẩm mỹ</span>
                            </div>
                            <div class="cl-news-content">
                                <h4>Những lưu ý quan trọng trước khi phẫu thuật thẩm mỹ</h4>
                                <p>
                                    Trước khi quyết định phẫu thuật thẩm mỹ, việc chuẩn bị kỹ lưỡng là yếu tố quan trọng
                                    quyết định đến kết quả và sự an toàn của ca phẫu thuật.
                                </p>
                                <div class="cl-news-meta">
                                    <span><i class="fa fa-calendar"></i> 10/12/2024</span>
                                    <a href="#" class="cl-read-more-small">Đọc tiếp</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4" data-aos="fade-up" data-aos-duration="2000">
                        <div class="cl-news-item">
                            <div class="cl-news-image">
                                <img src="{{ asset('images/tin-tuc/news-2.jpg') }}" />
                                <span class="cl-category-tag">Chăm sóc da</span>
                            </div>
                            <div class="cl-news-content">
                                <h4>Bí quyết chăm sóc da sau phẫu thuật thẩm mỹ</h4>
                                <p>
                                    Quá trình chăm sóc da sau phẫu thuật đóng vai trò quan trọng trong việc phục hồi
                                    và duy trì kết quả thẩm mỹ lâu dài.
                                </p>
                                <div class="cl-news-meta">
                                    <span><i class="fa fa-calendar"></i> 08/12/2024</span>
                                    <a href="#" class="cl-read-more-small">Đọc tiếp</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4" data-aos="fade-up" data-aos-duration="3000">
                        <div class="cl-news-item">
                            <div class="cl-news-image">
                                <img src="{{ asset('images/tin-tuc/news-3.jpg') }}" />
                                <span class="cl-category-tag">Sức khỏe</span>
                            </div>
                            <div class="cl-news-content">
                                <h4>Tầm quan trọng của việc kiểm tra sức khỏe định kỳ</h4>
                                <p>
                                    Việc kiểm tra sức khỏe định kỳ không chỉ giúp phát hiện sớm các bệnh tật
                                    mà còn đảm bảo an toàn cho các ca phẫu thuật thẩm mỹ.
                                </p>
                                <div class="cl-news-meta">
                                    <span><i class="fa fa-calendar"></i> 05/12/2024</span>
                                    <a href="#" class="cl-read-more-small">Đọc tiếp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- More News -->
                <div class="row" style="margin-top:30px;">
                    <div class="col-12 col-sm-4" data-aos="fade-up" data-aos-duration="1000">
                        <div class="cl-news-item">
                            <div class="cl-news-image">
                                <img src="{{ asset('images/tin-tuc/news-4.jpg') }}" />
                                <span class="cl-category-tag">Công nghệ</span>
                            </div>
                            <div class="cl-news-content">
                                <h4>Công nghệ laser trong điều trị da hiện đại</h4>
                                <p>
                                    Công nghệ laser đã mang lại cuộc cách mạng trong lĩnh vực điều trị da,
                                    giúp giải quyết nhiều vấn đề về da một cách hiệu quả và an toàn.
                                </p>
                                <div class="cl-news-meta">
                                    <span><i class="fa fa-calendar"></i> 03/12/2024</span>
                                    <a href="#" class="cl-read-more-small">Đọc tiếp</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4" data-aos="fade-up" data-aos-duration="2000">
                        <div class="cl-news-item">
                            <div class="cl-news-image">
                                <img src="{{ asset('images/tin-tuc/news-5.jpg') }}" />
                                <span class="cl-category-tag">Thẩm mỹ</span>
                            </div>
                            <div class="cl-news-content">
                                <h4>Xu hướng thẩm mỹ Hàn Quốc năm 2024</h4>
                                <p>
                                    Năm 2024 chứng kiến sự bùng nổ của các xu hướng thẩm mỹ đến từ Hàn Quốc,
                                    mang đến những lựa chọn làm đẹp đa dạng và hiện đại.
                                </p>
                                <div class="cl-news-meta">
                                    <span><i class="fa fa-calendar"></i> 01/12/2024</span>
                                    <a href="#" class="cl-read-more-small">Đọc tiếp</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4" data-aos="fade-up" data-aos-duration="3000">
                        <div class="cl-news-item">
                            <div class="cl-news-image">
                                <img src="{{ asset('images/tin-tuc/news-6.jpg') }}" />
                                <span class="cl-category-tag">Lời khuyên</span>
                            </div>
                            <div class="cl-news-content">
                                <h4>Lựa chọn bác sĩ thẩm mỹ uy tín</h4>
                                <p>
                                    Việc lựa chọn bác sĩ thẩm mỹ uy tín là yếu tố quan trọng nhất quyết định
                                    đến sự thành công và an toàn của ca phẫu thuật.
                                </p>
                                <div class="cl-news-meta">
                                    <span><i class="fa fa-calendar"></i> 28/11/2024</span>
                                    <a href="#" class="cl-read-more-small">Đọc tiếp</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->
                <div class="row" style="margin-top:50px;">
                    <div class="col-12 col-sm-12">
                        <div class="cl-pagination">
                            <a href="#" class="cl-page-link active">1</a>
                            <a href="#" class="cl-page-link">2</a>
                            <a href="#" class="cl-page-link">3</a>
                            <a href="#" class="cl-page-link">Tiếp theo <i class="fa fa-arrow-right"></i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--Sec 4 - dat lich kham ngay-->
<div class="cl-sec04">
    <div class="container">
        <div class="row">
            <div class="col-12 col-sm-6">
                <div class="h-sec4-info">
                    <h4>ĐẶT LỊCH KHÁM NGAY!</h4>
                    <p>Để được tư vấn trực tiếp bởi Dr. Đạt, hãy để lại thông tin của bạn ngay tại đây nhé!</p>
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
                        <a class="cl-btn-full" href="#">
                            <span>Gọi lại cho tôi</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
