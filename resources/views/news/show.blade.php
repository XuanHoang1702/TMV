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
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-8" data-aos="fade-right" data-aos-duration="3000">
                        <div class="cl-news-detail">
                            <div class="cl-news-header">
                                <h1 class="cl-news-title">Tiến Bộ Công Nghệ Thẩm Mỹ Hiện Đại</h1>
                                <div class="cl-news-meta">
                                    <span class="cl-news-date">
                                        <i class="fa fa-calendar"></i> 15/12/2024
                                    </span>
                                    <span class="cl-news-author">
                                        <i class="fa fa-user"></i> Dr. Hà Quốc Đạt
                                    </span>
                                    <span class="cl-news-category">
                                        <i class="fa fa-tag"></i> Chuyên môn
                                    </span>
                                </div>
                            </div>

                            <div class="cl-news-image">
                                <img src="{{ asset('images/news/news_detail.jpg') }}" alt="Tiến Bộ Công Nghệ Thẩm Mỹ Hiện Đại" />
                                <p class="cl-image-caption">Hình ảnh minh họa công nghệ thẩm mỹ tiên tiến tại phòng khám Dr. Đạt</p>
                            </div>

                            <div class="cl-news-content">
                                <p>
                                    Trong những năm gần đây, ngành thẩm mỹ Việt Nam đã có những bước tiến vượt bậc với việc ứng dụng
                                    các công nghệ làm đẹp tiên tiến từ các nước phát triển. Tại Thẩm Mỹ Tận Tâm Dr. Đạt, chúng tôi
                                    luôn cập nhật và áp dụng những công nghệ mới nhất để mang lại kết quả tốt nhất cho khách hàng.
                                </p>

                                <h3>Công Nghệ Laser Hiện Đại</h3>
                                <p>
                                    Công nghệ laser thế hệ mới cho phép thực hiện các thủ thuật thẩm mỹ với độ chính xác cao,
                                    thời gian thực hiện ngắn và thời gian phục hồi nhanh chóng. Các thiết bị laser hiện đại giúp:
                                </p>

                                <ul>
                                    <li>Loại bỏ nám, tàn nhang hiệu quả</li>
                                    <li>Điều trị sẹo rỗ, sẹo lồi</li>
                                    <li>Tái tạo da, làm sáng da</li>
                                    <li>Loại bỏ lông vĩnh viễn</li>
                                </ul>

                                <h3>Kỹ Thuật Cấy Chỉ Collagen</h3>
                                <p>
                                    Đây là phương pháp làm đẹp không xâm lấn, giúp căng da, giảm nếp nhăn và cải thiện độ đàn hồi của da.
                                    Kỹ thuật này được thực hiện bởi các bác sĩ có chuyên môn cao, đảm bảo an toàn và hiệu quả lâu dài.
                                </p>

                                <div class="cl-news-quote">
                                    <blockquote>
                                        "Việc ứng dụng công nghệ tiên tiến không chỉ giúp nâng cao chất lượng dịch vụ mà còn
                                        đảm bảo an toàn tuyệt đối cho khách hàng. Đó là cam kết của chúng tôi tại Thẩm Mỹ Tận Tâm Dr. Đạt."
                                        <cite>- Dr. Hà Quốc Đạt</cite>
                                    </blockquote>
                                </div>

                                <h3>Quy Trình Chuẩn Y Khoa</h3>
                                <p>
                                    Mọi thủ thuật thẩm mỹ tại phòng khám đều tuân thủ nghiêm ngặt quy trình chuẩn y khoa,
                                    từ khâu tư vấn, thăm khám đến thực hiện và chăm sóc hậu thẩm mỹ. Chúng tôi cam kết:
                                </p>

                                <ol>
                                    <li>Tư vấn chuyên nghiệp, trung thực</li>
                                    <li>Thăm khám kỹ lưỡng trước khi thực hiện</li>
                                    <li>Sử dụng thiết bị và vật liệu chuẩn</li>
                                    <li>Theo dõi và chăm sóc hậu thẩm mỹ</li>
                                </ol>

                                <p>
                                    Với đội ngũ bác sĩ giàu kinh nghiệm và công nghệ hiện đại, Thẩm Mỹ Tận Tâm Dr. Đạt
                                    tự tin mang đến cho khách hàng những trải nghiệm làm đẹp an toàn, hiệu quả và đáng tin cậy.
                                </p>
                            </div>

                            <!--Share-->
                            <div class="cl-news-share">
                                <h4>Chia sẻ bài viết:</h4>
                                <div class="cl-share-buttons">
                                    <a href="#" class="cl-share-btn facebook">
                                        <i class="fa fa-facebook"></i> Facebook
                                    </a>
                                    <a href="#" class="cl-share-btn twitter">
                                        <i class="fa fa-twitter"></i> Twitter
                                    </a>
                                    <a href="#" class="cl-share-btn linkedin">
                                        <i class="fa fa-linkedin"></i> LinkedIn
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4" data-aos="fade-left" data-aos-duration="3000">
                        <!--Sidebar-->
                        <div class="cl-sidebar">
                            <!--Related News-->
                            <div class="cl-sidebar-widget">
                                <h4 class="cl-widget-title">Tin tức liên quan</h4>
                                <div class="cl-related-news">
                                    <div class="cl-related-item">
                                        <div class="cl-related-image">
                                            <img src="{{ asset('images/news/related1.jpg') }}" alt="Related News 1" />
                                        </div>
                                        <div class="cl-related-content">
                                            <h5><a href="#">Ứng dụng công nghệ AI trong thẩm mỹ</a></h5>
                                            <span class="cl-related-date">10/12/2024</span>
                                        </div>
                                    </div>

                                    <div class="cl-related-item">
                                        <div class="cl-related-image">
                                            <img src="{{ asset('images/news/related2.jpg') }}" alt="Related News 2" />
                                        </div>
                                        <div class="cl-related-content">
                                            <h5><a href="#">Bí quyết chăm sóc da mùa đông</a></h5>
                                            <span class="cl-related-date">08/12/2024</span>
                                        </div>
                                    </div>

                                    <div class="cl-related-item">
                                        <div class="cl-related-image">
                                            <img src="{{ asset('images/news/related3.jpg') }}" alt="Related News 3" />
                                        </div>
                                        <div class="cl-related-content">
                                            <h5><a href="#">Phẫu thuật thẩm mỹ an toàn</a></h5>
                                            <span class="cl-related-date">05/12/2024</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Categories-->
                            <div class="cl-sidebar-widget">
                                <h4 class="cl-widget-title">Danh mục tin tức</h4>
                                <ul class="cl-category-list">
                                    <li><a href="{{ route('news.category', 'chuyen-mon') }}">Chuyên môn <span>(15)</span></a></li>
                                    <li><a href="{{ route('news.category', 'dao-tao') }}">Đào tạo <span>(8)</span></a></li>
                                    <li><a href="{{ route('news.category', 'tu-thien') }}">Từ thiện <span>(12)</span></a></li>
                                    <li><a href="{{ route('news.category', 'bao-chi-truyen-thong') }}">Báo chí, truyền thông <span>(20)</span></a></li>
                                </ul>
                            </div>

                            <!--Contact Info-->
                            <div class="cl-sidebar-widget">
                                <h4 class="cl-widget-title">Liên hệ tư vấn</h4>
                                <div class="cl-contact-widget">
                                    <p><i class="fa fa-phone"></i> <strong>0705 242 999</strong></p>
                                    <p><i class="fa fa-map-marker"></i> 130 Lê Văn Thịnh, P. Bình Trưng Tây</p>
                                    <p><i class="fa fa-clock-o"></i> 8:00 - 18:00 (Thứ 2 - Thứ 7)</p>
                                    <a href="javascript:void(0)" onclick="onOpen_Popup()" class="cl-btn-sidebar">
                                        <span>Đặt lịch ngay</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Comments Section-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <div class="cl-comments-section">
                            <h4>Bình luận (3)</h4>

                            <div class="cl-comment-list">
                                <div class="cl-comment-item">
                                    <div class="cl-comment-avatar">
                                        <img src="{{ asset('images/avatar/user1.jpg') }}" alt="User Avatar" />
                                    </div>
                                    <div class="cl-comment-content">
                                        <div class="cl-comment-header">
                                            <h5>Nguyễn Thị Mai</h5>
                                            <span class="cl-comment-date">12/12/2024</span>
                                        </div>
                                        <p>Bài viết rất hữu ích! Cảm ơn Dr. Đạt đã chia sẻ những thông tin bổ ích về công nghệ thẩm mỹ hiện đại.</p>
                                        <a href="#" class="cl-reply-link">Trả lời</a>
                                    </div>
                                </div>

                                <div class="cl-comment-item cl-comment-reply">
                                    <div class="cl-comment-avatar">
                                        <img src="{{ asset('images/avatar/doctor.jpg') }}" alt="Doctor Avatar" />
                                    </div>
                                    <div class="cl-comment-content">
                                        <div class="cl-comment-header">
                                            <h5>Dr. Hà Quốc Đạt</h5>
                                            <span class="cl-comment-date">12/12/2024</span>
                                        </div>
                                        <p>Cảm ơn bạn đã quan tâm! Nếu có thêm câu hỏi nào, hãy liên hệ với chúng tôi để được tư vấn cụ thể hơn.</p>
                                    </div>
                                </div>

                                <div class="cl-comment-item">
                                    <div class="cl-comment-avatar">
                                        <img src="{{ asset('images/avatar/user2.jpg') }}" alt="User Avatar" />
                                    </div>
                                    <div class="cl-comment-content">
                                        <div class="cl-comment-header">
                                            <h5>Trần Văn Minh</h5>
                                            <span class="cl-comment-date">10/12/2024</span>
                                        </div>
                                        <p>Thông tin rất chi tiết và dễ hiểu. Phòng khám có áp dụng công nghệ này không ạ?</p>
                                        <a href="#" class="cl-reply-link">Trả lời</a>
                                    </div>
                                </div>
                            </div>

                            <!--Comment Form-->
                            <div class="cl-comment-form">
                                <h4>Để lại bình luận</h4>
                                <form>
                                    <div class="row">
                                        <div class="col-12 col-sm-6">
                                            <input type="text" class="form-control" placeholder="Họ tên" required />
                                        </div>
                                        <div class="col-12 col-sm-6">
                                            <input type="email" class="form-control" placeholder="Email" required />
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-12 col-sm-12">
                                            <textarea class="form-control" rows="4" placeholder="Nội dung bình luận" required></textarea>
                                        </div>
                                    </div>
                                    <button type="submit" class="cl-btn-comment">
                                        <span>Gửi bình luận</span>
                                        <i class="fa fa-send"></i>
                                    </button>
                                </form>
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
                    <h4>CẦN TƯ VẤN THÊM?</h4>
                    <p>Hãy liên hệ với chúng tôi để được Dr. Đạt tư vấn trực tiếp về các dịch vụ thẩm mỹ.</p>
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
                        <a class="cl-btn-full" href="javascript:void(0)" onclick="onOpen_Popup2()">
                            <span>Gửi thông tin</span>
                            <i class="fa fa-angle-right"></i>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
