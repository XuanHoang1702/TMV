@extends('layouts.app')

@section('title', 'Danh mục tin tức - Thẩm mỹ Dr.DAT')

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
                    <h4 class="cl-title">DANH MỤC TIN TỨC</h4>
                </div>
                <div class="col-12 col-sm-12 cl-desc">
                    <p>
                        Khám phá các bài viết theo chủ đề bạn quan tâm. Chúng tôi cập nhật thường xuyên
                        những thông tin hữu ích về thẩm mỹ, chăm sóc sức khỏe và làm đẹp.
                    </p>
                </div>
            </div>
        </div>

        <!--Breadcrumb-->
        <div class="cl-breadcrumb">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('news.index') }}">Tin tức</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Chuyên môn</li>
                </ol>
            </nav>
        </div>

        <!--News Grid-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-8" data-aos="fade-right" data-aos-duration="3000">
                        <div class="cl-news-grid">
                            <!--News Item 1-->
                            <div class="cl-news-item">
                                <div class="cl-news-image">
                                    <img src="{{ asset('images/news/news1.jpg') }}" alt="Tiến Bộ Công Nghệ Thẩm Mỹ Hiện Đại" />
                                    <div class="cl-news-overlay">
                                        <a href="{{ route('news.detail', 'tien-bo-cong-nghe-tham-my-hien-dai') }}" class="cl-news-link">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="cl-news-content">
                                    <div class="cl-news-meta">
                                        <span class="cl-news-date">
                                            <i class="fa fa-calendar"></i> 15/12/2024
                                        </span>
                                        <span class="cl-news-category">
                                            <i class="fa fa-tag"></i> Chuyên môn
                                        </span>
                                    </div>
                                    <h3 class="cl-news-title">
                                        <a href="{{ route('news.detail', 'tien-bo-cong-nghe-tham-my-hien-dai') }}">
                                            Tiến Bộ Công Nghệ Thẩm Mỹ Hiện Đại
                                        </a>
                                    </h3>
                                    <p class="cl-news-excerpt">
                                        Trong những năm gần đây, ngành thẩm mỹ Việt Nam đã có những bước tiến vượt bậc
                                        với việc ứng dụng các công nghệ làm đẹp tiên tiến từ các nước phát triển...
                                    </p>
                                    <a href="{{ route('news.detail', 'tien-bo-cong-nghe-tham-my-hien-dai') }}" class="cl-read-more">
                                        Đọc thêm <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!--News Item 2-->
                            <div class="cl-news-item">
                                <div class="cl-news-image">
                                    <img src="{{ asset('images/news/news2.jpg') }}" alt="Ứng dụng công nghệ AI trong thẩm mỹ" />
                                    <div class="cl-news-overlay">
                                        <a href="{{ route('news.detail', 'ung-dung-cong-nghe-ai-trong-tham-my') }}" class="cl-news-link">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="cl-news-content">
                                    <div class="cl-news-meta">
                                        <span class="cl-news-date">
                                            <i class="fa fa-calendar"></i> 12/12/2024
                                        </span>
                                        <span class="cl-news-category">
                                            <i class="fa fa-tag"></i> Chuyên môn
                                        </span>
                                    </div>
                                    <h3 class="cl-news-title">
                                        <a href="{{ route('news.detail', 'ung-dung-cong-nghe-ai-trong-tham-my') }}">
                                            Ứng dụng công nghệ AI trong thẩm mỹ
                                        </a>
                                    </h3>
                                    <p class="cl-news-excerpt">
                                        Công nghệ trí tuệ nhân tạo (AI) đang ngày càng được ứng dụng rộng rãi trong ngành thẩm mỹ,
                                        giúp nâng cao độ chính xác và hiệu quả của các thủ thuật làm đẹp...
                                    </p>
                                    <a href="{{ route('news.detail', 'ung-dung-cong-nghe-ai-trong-tham-my') }}" class="cl-read-more">
                                        Đọc thêm <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!--News Item 3-->
                            <div class="cl-news-item">
                                <div class="cl-news-image">
                                    <img src="{{ asset('images/news/news3.jpg') }}" alt="Bí quyết chăm sóc da mùa đông" />
                                    <div class="cl-news-overlay">
                                        <a href="{{ route('news.detail', 'bi-quyet-cham-soc-da-mua-dong') }}" class="cl-news-link">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="cl-news-content">
                                    <div class="cl-news-meta">
                                        <span class="cl-news-date">
                                            <i class="fa fa-calendar"></i> 10/12/2024
                                        </span>
                                        <span class="cl-news-category">
                                            <i class="fa fa-tag"></i> Chuyên môn
                                        </span>
                                    </div>
                                    <h3 class="cl-news-title">
                                        <a href="{{ route('news.detail', 'bi-quyet-cham-soc-da-mua-dong') }}">
                                            Bí quyết chăm sóc da mùa đông
                                        </a>
                                    </h3>
                                    <p class="cl-news-excerpt">
                                        Mùa đông là thời điểm da dễ bị khô, nứt nẻ và lão hóa nhanh chóng.
                                        Việc chăm sóc da đúng cách sẽ giúp bạn duy trì làn da khỏe mạnh và rạng rỡ...
                                    </p>
                                    <a href="{{ route('news.detail', 'bi-quyet-cham-soc-da-mua-dong') }}" class="cl-read-more">
                                        Đọc thêm <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!--News Item 4-->
                            <div class="cl-news-item">
                                <div class="cl-news-image">
                                    <img src="{{ asset('images/news/news4.jpg') }}" alt="Phẫu thuật thẩm mỹ an toàn" />
                                    <div class="cl-news-overlay">
                                        <a href="{{ route('news.detail', 'phau-thuat-tham-my-an-toan') }}" class="cl-news-link">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="cl-news-content">
                                    <div class="cl-news-meta">
                                        <span class="cl-news-date">
                                            <i class="fa fa-calendar"></i> 08/12/2024
                                        </span>
                                        <span class="cl-news-category">
                                            <i class="fa fa-tag"></i> Chuyên môn
                                        </span>
                                    </div>
                                    <h3 class="cl-news-title">
                                        <a href="{{ route('news.detail', 'phau-thuat-tham-my-an-toan') }}">
                                            Phẫu thuật thẩm mỹ an toàn
                                        </a>
                                    </h3>
                                    <p class="cl-news-excerpt">
                                        An toàn là yếu tố quan trọng nhất trong phẫu thuật thẩm mỹ.
                                        Tại Thẩm Mỹ Tận Tâm Dr. Đạt, chúng tôi luôn đặt sự an toàn của khách hàng lên hàng đầu...
                                    </p>
                                    <a href="{{ route('news.detail', 'phau-thuat-tham-my-an-toan') }}" class="cl-read-more">
                                        Đọc thêm <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!--News Item 5-->
                            <div class="cl-news-item">
                                <div class="cl-news-image">
                                    <img src="{{ asset('images/news/news5.jpg') }}" alt="Công nghệ laser trong thẩm mỹ" />
                                    <div class="cl-news-overlay">
                                        <a href="{{ route('news.detail', 'cong-nghe-laser-trong-tham-my') }}" class="cl-news-link">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="cl-news-content">
                                    <div class="cl-news-meta">
                                        <span class="cl-news-date">
                                            <i class="fa fa-calendar"></i> 05/12/2024
                                        </span>
                                        <span class="cl-news-category">
                                            <i class="fa fa-tag"></i> Chuyên môn
                                        </span>
                                    </div>
                                    <h3 class="cl-news-title">
                                        <a href="{{ route('news.detail', 'cong-nghe-laser-trong-tham-my') }}">
                                            Công nghệ laser trong thẩm mỹ
                                        </a>
                                    </h3>
                                    <p class="cl-news-excerpt">
                                        Công nghệ laser đã trở thành công cụ không thể thiếu trong ngành thẩm mỹ hiện đại.
                                        Với khả năng điều trị hiệu quả nhiều vấn đề da liễu, laser đang ngày càng được ưa chuộng...
                                    </p>
                                    <a href="{{ route('news.detail', 'cong-nghe-laser-trong-tham-my') }}" class="cl-read-more">
                                        Đọc thêm <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>

                            <!--News Item 6-->
                            <div class="cl-news-item">
                                <div class="cl-news-image">
                                    <img src="{{ asset('images/news/news6.jpg') }}" alt="Chăm sóc da sau phẫu thuật" />
                                    <div class="cl-news-overlay">
                                        <a href="{{ route('news.detail', 'cham-soc-da-sau-phau-thuat') }}" class="cl-news-link">
                                            <i class="fa fa-eye"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="cl-news-content">
                                    <div class="cl-news-meta">
                                        <span class="cl-news-date">
                                            <i class="fa fa-calendar"></i> 03/12/2024
                                        </span>
                                        <span class="cl-news-category">
                                            <i class="fa fa-tag"></i> Chuyên môn
                                        </span>
                                    </div>
                                    <h3 class="cl-news-title">
                                        <a href="{{ route('news.detail', 'cham-soc-da-sau-phau-thuat') }}">
                                            Chăm sóc da sau phẫu thuật
                                        </a>
                                    </h3>
                                    <p class="cl-news-excerpt">
                                        Việc chăm sóc da đúng cách sau phẫu thuật thẩm mỹ đóng vai trò quan trọng
                                        trong việc phục hồi và duy trì kết quả thẩm mỹ lâu dài...
                                    </p>
                                    <a href="{{ route('news.detail', 'cham-soc-da-sau-phau-thuat') }}" class="cl-read-more">
                                        Đọc thêm <i class="fa fa-angle-right"></i>
                                    </a>
                                </div>
                            </div>
                        </div>

                        <!--Pagination-->
                        <div class="cl-pagination">
                            <nav aria-label="News pagination">
                                <ul class="pagination justify-content-center">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1">
                                            <i class="fa fa-angle-left"></i>
                                        </a>
                                    </li>
                                    <li class="page-item active">
                                        <a class="page-link" href="#">1</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">3</a>
                                    </li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">
                                            <i class="fa fa-angle-right"></i>
                                        </a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>

                    <div class="col-12 col-sm-4" data-aos="fade-left" data-aos-duration="3000">
                        <!--Sidebar-->
                        <div class="cl-sidebar">
                            <!--Categories-->
                            <div class="cl-sidebar-widget">
                                <h4 class="cl-widget-title">Danh mục tin tức</h4>
                                <ul class="cl-category-list">
                                    <li class="active">
                                        <a href="{{ route('news.category', 'chuyen-mon') }}">Chuyên môn <span>(15)</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('news.category', 'dao-tao') }}">Đào tạo <span>(8)</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('news.category', 'tu-thien') }}">Từ thiện <span>(12)</span></a>
                                    </li>
                                    <li>
                                        <a href="{{ route('news.category', 'bao-chi-truyen-thong') }}">Báo chí, truyền thông <span>(20)</span></a>
                                    </li>
                                </ul>
                            </div>

                            <!--Recent News-->
                            <div class="cl-sidebar-widget">
                                <h4 class="cl-widget-title">Tin tức mới nhất</h4>
                                <div class="cl-recent-news">
                                    <div class="cl-recent-item">
                                        <div class="cl-recent-image">
                                            <img src="{{ asset('images/news/recent1.jpg') }}" alt="Recent News 1" />
                                        </div>
                                        <div class="cl-recent-content">
                                            <h5><a href="#">Tiến Bộ Công Nghệ Thẩm Mỹ Hiện Đại</a></h5>
                                            <span class="cl-recent-date">15/12/2024</span>
                                        </div>
                                    </div>

                                    <div class="cl-recent-item">
                                        <div class="cl-recent-image">
                                            <img src="{{ asset('images/news/recent2.jpg') }}" alt="Recent News 2" />
                                        </div>
                                        <div class="cl-recent-content">
                                            <h5><a href="#">Ứng dụng công nghệ AI trong thẩm mỹ</a></h5>
                                            <span class="cl-recent-date">12/12/2024</span>
                                        </div>
                                    </div>

                                    <div class="cl-recent-item">
                                        <div class="cl-recent-image">
                                            <img src="{{ asset('images/news/recent3.jpg') }}" alt="Recent News 3" />
                                        </div>
                                        <div class="cl-recent-content">
                                            <h5><a href="#">Bí quyết chăm sóc da mùa đông</a></h5>
                                            <span class="cl-recent-date">10/12/2024</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!--Popular Tags-->
                            <div class="cl-sidebar-widget">
                                <h4 class="cl-widget-title">Từ khóa phổ biến</h4>
                                <div class="cl-tags">
                                    <a href="#" class="cl-tag">Thẩm mỹ</a>
                                    <a href="#" class="cl-tag">Công nghệ laser</a>
                                    <a href="#" class="cl-tag">Chăm sóc da</a>
                                    <a href="#" class="cl-tag">Phẫu thuật thẩm mỹ</a>
                                    <a href="#" class="cl-tag">Dr. Đạt</a>
                                    <a href="#" class="cl-tag">Làm đẹp</a>
                                    <a href="#" class="cl-tag">Công nghệ AI</a>
                                    <a href="#" class="cl-tag">Chuyên môn</a>
                                </div>
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
