@extends('layouts.app')

@section('title', 'Kết quả tìm kiếm - Thẩm mỹ Dr.DAT')

@section('content')
<div class="cl-search-results">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="search-header">
                    <h1>Kết quả tìm kiếm</h1>
                    @if($keyword)
                        <p>Tìm kiếm cho từ khóa: <strong>"{{ $keyword }}"</strong></p>
                    @else
                        <p>Hiển thị tất cả tin tức, dịch vụ và báo giá mới nhất</p>
                    @endif
                </div>

                @if($results->isEmpty())
                    <div class="no-results">
                        <div class="no-results-icon">
                            <i class="fa fa-search"></i>
                        </div>
                        <h3>Không tìm thấy kết quả</h3>
                        <p>Không có tin tức, dịch vụ hoặc báo giá nào phù hợp với từ khóa tìm kiếm của bạn.</p>
                        <a href="{{ route('search.index') }}" class="btn btn-primary">
                            <i class="fa fa-search"></i> Thử tìm kiếm khác
                        </a>
                    </div>
                @else
                    <div class="results-info">
                        <p>Tìm thấy <strong>{{ $results->count() }}</strong> kết quả</p>
                    </div>

                    <div class="row search-layout">
                        <!-- TIN TỨC - 60% bên trái -->
                        <div class="col-lg-8 col-md-12 news-section">
                            <div class="section-header">
                                <h3 class="section-title">
                                    <i class="fa fa-newspaper-o"></i> Tin tức
                                    <span class="section-count">({{ $results->where('type', 'news')->count() }})</span>
                                </h3>
                            </div>

                            <div class="news-results">
                                @foreach($results->where('type', 'news')->take(6) as $result)
                                    <div class="news-item">
                                        @if($result['image'])
                                            <div class="news-image">
                                                <img src="{{ asset('storage/' . $result['image']) }}"
                                                     alt="{{ $result['title'] }}"
                                                     loading="lazy"
                                                     onerror="this.src='{{ asset('images/no-image.jpg') }}'">
                                            </div>
                                        @endif

                                        <div class="news-content">
                                            <div class="news-meta">
                                                <span class="news-date">
                                                    <i class="fa fa-clock-o"></i>
                                                    {{ $result['date']->format('d/m/Y H:i') }}
                                                </span>
                                                @if(array_key_exists('author', $result) && $result['author'])
                                                    <span class="news-author">
                                                        <i class="fa fa-user"></i>
                                                        {{ $result['author'] }}
                                                    </span>
                                                @endif
                                            </div>

                                            <h4 class="news-title">
                                                <a href="{{ $result['url'] }}">{{ $result['title'] }}</a>
                                            </h4>

                                            <p class="news-excerpt">{!! Str::limit($result['content'], 300) !!}</p>

                                            <a href="{{ $result['url'] }}" class="news-readmore">
                                                Đọc thêm <i class="fa fa-arrow-right"></i>
                                            </a>
                                        </div>
                                    </div>
                                @endforeach

                                @if($results->where('type', 'news')->isEmpty())
                                    <div class="no-news">
                                        <i class="fa fa-newspaper-o"></i>
                                        <p>Không có tin tức nào phù hợp</p>
                                    </div>
                                @endif
                            </div>

                            <!-- Pagination -->
                            @if($results->where('type', 'news')->count() > 6)
                                <div class="pagination">
                                    {{ $results->where('type', 'news')->links() }}
                                </div>
                            @endif
                        </div>

                        <!-- DỊCH VỤ & BÁO GIÁ - 40% bên phải -->
                        <div class="col-lg-4 col-md-12 sidebar-section">
                            <!-- Dịch vụ -->
                            <div class="sidebar-widget service-widget">
                                <div class="widget-header">
                                    <h3 class="widget-title">
                                        <i class="fa fa-stethoscope"></i> Dịch vụ
                                        <span class="section-count">({{ $results->where('type', 'service')->count() }})</span>
                                    </h3>
                                </div>

                                <div class="service-list">
                                    @foreach($results->where('type', 'service')->take(6) as $result)
                                        <div class="service-item">
                                            @if($result['image'])
                                                <div class="service-image">
                                                    <img src="{{ asset('storage/' . $result['image']) }}"
                                                         alt="{{ $result['title'] }}"
                                                         loading="lazy"
                                                         onerror="this.src='{{ asset('images/no-service.jpg') }}'">
                                                </div>
                                            @endif

                                            <div class="service-info">
                                                <h5 class="service-title">
                                                    <a href="{{ $result['url'] }}">{{ $result['title'] }}</a>
                                                </h5>
                                                <p class="service-price">{{ $result['content'] }}</p>
                                                <a href="{{ $result['url'] }}" class="service-readmore">
                                                    <i class="fa fa-eye"></i> Xem chi tiết
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if($results->where('type', 'service')->isEmpty())
                                        <div class="no-services">
                                            <i class="fa fa-stethoscope"></i>
                                            <p>Không có dịch vụ nào phù hợp</p>
                                        </div>
                                    @endif
                                </div>
                            </div>

                            <!-- Báo giá -->
                            <div class="sidebar-widget pricing-widget">
                                <div class="widget-header">
                                    <h3 class="widget-title">
                                        <i class="fa fa-tag"></i> Báo giá
                                        <span class="section-count">({{ $results->where('type', 'pricing')->count() }})</span>
                                    </h3>
                                </div>

                                <div class="pricing-list">
                                    @foreach($results->where('type', 'pricing')->take(6) as $result)
                                        <div class="pricing-item">
                                            @if($result['image'])
                                                <div class="pricing-icon">
                                                    <img src="{{ asset('storage/' . $result['image']) }}"
                                                         alt="{{ $result['title'] }}"
                                                         loading="lazy"
                                                         onerror="this.src='{{ asset('images/no-pricing.jpg') }}'">
                                                </div>
                                            @endif

                                            <div class="pricing-info">
                                                <h5 class="pricing-title">
                                                    <a href="{{ $result['url'] }}">{{ $result['title'] }}</a>
                                                </h5>
                                                <p class="pricing-desc">{{ $result['content'] }}</p>
                                                <a href="{{ $result['url'] }}" class="pricing-readmore">
                                                    <i class="fa fa-file-text-o"></i> Xem chi tiết
                                                </a>
                                            </div>
                                        </div>
                                    @endforeach

                                    @if($results->where('type', 'pricing')->isEmpty())
                                        <div class="no-pricing">
                                            <i class="fa fa-tag"></i>
                                            <p>Không có báo giá nào phù hợp</p>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<style>
.cl-search-results {
    padding: 80px 0;
    background: linear-gradient(135deg, #f9f5f6 0%, #e6e6fa 100%);
    min-height: 70vh;
    font-family: 'Playfair Display', serif;
}

.search-header {
    text-align: center;
    margin-bottom: 60px;
}

.search-header h1 {
    color: #2c2c54;
    font-size: 3.2rem;
    font-weight: 700;
    margin-bottom: 20px;
    letter-spacing: 0.8px;
}

.search-header p {
    color: #4a4a7d;
    font-size: 1.4rem;
    font-family: 'Lora', serif;
}

.results-info {
    background: #ffffff;
    padding: 25px;
    border-radius: 15px;
    margin-bottom: 50px;
    text-align: center;
    box-shadow: 0 5px 25px rgba(0,0,0,0.05);
    font-family: 'Lora', serif;
    font-size: 1.3rem;
}

/* NEW LAYOUT STYLES */
.search-layout {
    margin-bottom: 60px;
}

/* SECTION HEADERS */
.section-header,
.widget-header {
    margin-bottom: 35px;
    padding-bottom: 15px;
    border-bottom: 2px solid #e1e1f0;
}

.section-title,
.widget-title {
    color: #2c2c54;
    font-size: 2rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 15px;
    font-family: 'Playfair Display', serif;
}

.section-title i,
.widget-title i {
    color: #9c88ff;
    font-size: 1.6rem;
}

.section-count {
    background: #9c88ff;
    color: #fff;
    padding: 5px 12px;
    border-radius: 18px;
    font-size: 1rem;
    font-weight: 500;
}

/* NEWS SECTION - 60% LEFT */
.news-section {
    background: #fff;
    border-radius: 18px;
    padding: 35px;
    box-shadow: 0 6px 30px rgba(0,0,0,0.06);
    margin-bottom: 50px;
}

.news-results {
    display: flex;
    flex-direction: column;
    gap: 35px;
}

.news-item {
    display: flex;
    gap: 30px;
    padding: 30px;
    border: 1px solid #f1f1f5;
    border-radius: 15px;
    transition: all 0.4s ease;
    background: #fefeff;
}

.news-item:hover {
    background: #fff;
    box-shadow: 0 8px 30px rgba(0,0,0,0.08);
    transform: translateY(-4px);
}

.news-image {
    flex-shrink: 0;
    width: 180px;
    height: 120px;
    border-radius: 12px;
    overflow: hidden;
    background: #f5f5f7;
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.news-item:hover .news-image img {
    transform: scale(1.1);
}

.news-content {
    flex: 1;
}

.news-meta {
    margin-bottom: 15px;
    display: flex;
    gap: 20px;
}

.news-date, .news-author {
    color: #6b6b8a;
    font-size: 1.1rem;
    font-family: 'Lora', serif;
}

.news-date i, .news-author i {
    margin-right: 8px;
    color: #9c88ff;
}

.news-title {
    margin: 0 0 15px 0;
}

.news-title a {
    color: #2c2c54;
    text-decoration: none;
    font-size: 1.5rem;
    font-weight: 700;
    line-height: 1.5;
    display: block;
    font-family: 'Playfair Display', serif;
}

.news-title a:hover {
    color: #9c88ff;
}

.news-excerpt {
    color: #4a4a7d;
    font-size: 1.2rem;
    line-height: 1.8;
    margin: 0 0 20px 0;
    font-family: 'Lora', serif;
}

.news-readmore {
    color: #9c88ff;
    text-decoration: none;
    font-weight: 600;
    font-size: 1.1rem;
    display: inline-flex;
    align-items: center;
    gap: 8px;
    transition: all 0.3s ease;
    padding: 8px 16px;
    border-radius: 8px;
    background: rgba(156, 136, 255, 0.1);
    font-family: 'Lora', serif;
}

.news-readmore:hover {
    color: #fff;
    background: #9c88ff;
}

.no-news {
    text-align: center;
    padding: 60px 25px;
    color: #6b6b8a;
    font-style: italic;
    font-family: 'Lora', serif;
    font-size: 1.3rem;
}

.no-news i {
    font-size: 4rem;
    margin-bottom: 25px;
    opacity: 0.4;
}

/* SIDEBAR SECTION - 40% RIGHT */
.sidebar-section {
    display: flex;
    flex-direction: column;
    gap: 50px;
}

.sidebar-widget {
    background: #fff;
    border-radius: 18px;
    padding: 35px;
    box-shadow: 0 6px 30px rgba(0,0,0,0.06);
}

/* SERVICE WIDGET */
.service-widget .service-list {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.service-item {
    display: flex;
    gap: 20px;
    padding: 25px;
    border: 1px solid #f1f1f5;
    border-radius: 12px;
    transition: all 0.3s ease;
    background: #fefeff;
}

.service-item:hover {
    background: #fff;
    box-shadow: 0 5px 20px rgba(0,0,0,0.07);
    transform: translateY(-3px);
}

.service-image {
    flex-shrink: 0;
    width: 70px;
    height: 70px;
    border-radius: 12px;
    overflow: hidden;
    background: #f5f5f7;
}

.service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
    transition: transform 0.4s ease;
}

.service-item:hover .service-image img {
    transform: scale(1.1);
}

.service-info {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.service-title {
    margin: 0 0 10px 0;
    font-size: 1.2rem;
    flex-grow: 1;
    font-family: 'Playfair Display', serif;
}

.service-title a {
    color: #2c2c54;
    text-decoration: none;
    font-weight: 600;
    display: block;
}

.service-title a:hover {
    color: #2ecc71;
}

.service-price {
    color: #4a4a7d;
    font-size: 1.1rem;
    margin: 0 0 12px 0;
    line-height: 1.6;
    flex-grow: 1;
    font-family: 'Lora', serif;
}

.service-readmore {
    color: #2ecc71;
    text-decoration: none;
    font-size: 1rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
    padding: 8px 14px;
    border-radius: 8px;
    background: rgba(46, 204, 113, 0.1);
    margin-top: auto;
    font-family: 'Lora', serif;
}

.service-readmore:hover {
    color: #fff;
    background: #2ecc71;
    transform: translateX(4px);
}

.service-readmore i {
    font-size: 0.9rem;
    transition: transform 0.3s ease;
}

.service-readmore:hover i {
    transform: translateX(4px);
}

.no-services {
    text-align: center;
    padding: 50px 20px;
    color: #6b6b8a;
    font-style: italic;
    font-family: 'Lora', serif;
    font-size: 1.3rem;
}

.no-services i {
    font-size: 3.5rem;
    margin-bottom: 20px;
    opacity: 0.4;
    color: #2ecc71;
}

/* PRICING WIDGET */
.pricing-widget .pricing-list {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.pricing-item {
    display: flex;
    gap: 20px;
    padding: 25px;
    border: 1px solid #f1f1f5;
    border-radius: 12px;
    transition: all 0.3s ease;
    background: #fefeff;
}

.pricing-item:hover {
    background: #fff;
    box-shadow: 0 5px 20px rgba(0,0,0,0.07);
    transform: translateY(-3px);
}

.pricing-icon {
    flex-shrink: 0;
    width: 70px;
    height: 70px;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, #fff1e6 0%, #ffd8a8 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #ffd8a8;
}

.pricing-icon img {
    width: 40px;
    height: 40px;
    object-fit: contain;
}

.pricing-info {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.pricing-title {
    margin: 0 0 10px 0;
    font-size: 1.2rem;
    flex-grow: 1;
    font-family: 'Playfair Display', serif;
}

.pricing-title a {
    color: #2c2c54;
    text-decoration: none;
    font-weight: 600;
    display: block;
}

.pricing-title a:hover {
    color: #ff9f43;
}

.pricing-desc {
    color: #4a4a7d;
    font-size: 1.1rem;
    margin: 0 0 12px 0;
    line-height: 1.6;
    flex-grow: 1;
    font-family: 'Lora', serif;
}

.pricing-readmore {
    color: #ff9f43;
    text-decoration: none;
    font-size: 1rem;
    font-weight: 600;
    display: inline-flex;
    align-items: center;
    gap: 6px;
    transition: all 0.3s ease;
    padding: 8px 14px;
    border-radius: 8px;
    background: rgba(255, 159, 67, 0.1);
    border: 1px solid rgba(255, 159, 67, 0.2);
    margin-top: auto;
    align-self: flex-start;
    font-family: 'Lora', serif;
}

.pricing-readmore:hover {
    color: #fff;
    background: #ff9f43;
    border-color: #ff9f43;
    transform: translateX(4px);
}

.pricing-readmore i {
    font-size: 0.9rem;
    transition: transform 0.3s ease;
}

.pricing-readmore:hover i {
    transform: translateX(4px);
}

.no-pricing {
    text-align: center;
    padding: 50px 20px;
    color: #6b6b8a;
    font-style: italic;
    font-family: 'Lora', serif;
    font-size: 1.3rem;
}

.no-pricing i {
    font-size: 3.5rem;
    margin-bottom: 20px;
    opacity: 0.4;
    color: #ff9f43;
}

/* EMPTY STATE */
.no-results {
    text-align: center;
    padding: 100px 40px;
    background: #fff;
    border-radius: 18px;
    box-shadow: 0 6px 30px rgba(0,0,0,0.06);
}

.no-results-icon {
    font-size: 5rem;
    color: #e1e1f0;
    margin-bottom: 30px;
}

.no-results h3 {
    color: #2c2c54;
    margin-bottom: 25px;
    font-size: 2rem;
    font-family: 'Playfair Display', serif;
}

.no-results p {
    color: #4a4a7d;
    margin-bottom: 40px;
    font-size: 1.4rem;
    font-family: 'Lora', serif;
}

/* BUTTONS */
.btn-primary {
    background: #9c88ff;
    border: none;
    padding: 14px 35px;
    border-radius: 10px;
    font-weight: 600;
    font-size: 1.2rem;
    transition: all 0.3s ease;
    font-family: 'Lora', serif;
}

.btn-primary:hover {
    background: #7b68ee;
    transform: translateY(-3px);
}

/* PAGINATION */
.pagination {
    margin-top: 40px;
    display: flex;
    justify-content: center;
    gap: 10px;
}

.pagination .page-link {
    color: #9c88ff;
    border: 1px solid #e1e1f0;
    border-radius: 8px;
    padding: 10px 20px;
    font-size: 1.1rem;
    font-family: 'Lora', serif;
    transition: all 0.3s ease;
}

.pagination .page-link:hover {
    background: #9c88ff;
    color: #fff;
    border-color: #9c88ff;
}

.pagination .page-item.active .page-link {
    background: #9c88ff;
    border-color: #9c88ff;
    color: #fff;
}

/* RESPONSIVE */
@media (max-width: 992px) {
    .search-layout {
        flex-direction: column;
    }

    .news-section,
    .sidebar-section {
        width: 100%;
    }

    .news-item {
        flex-direction: column;
        text-align: center;
    }

    .news-image {
        width: 100%;
        height: 250px;
        max-width: 400px;
        margin: 0 auto;
    }

    .service-item,
    .pricing-item {
        flex-direction: column;
        text-align: center;
    }

    .service-readmore,
    .pricing-readmore {
        align-self: center;
        margin-top: 12px;
    }
}

@media (max-width: 768px) {
    .search-header h1 {
        font-size: 2.5rem;
    }

    .section-title,
    .widget-title {
        font-size: 1.6rem;
    }

    .news-item,
    .service-item,
    .pricing-item {
        padding: 25px;
    }

    .news-title a {
        font-size: 1.3rem;
    }

    .news-excerpt {
        font-size: 1.1rem;
    }

    .service-image,
    .pricing-icon {
        margin: 0 auto 15px auto;
    }

    .service-readmore,
    .pricing-readmore {
        font-size: 0.9rem;
        padding: 6px 12px;
    }
}

/* Animations */
@keyframes fadeInUp {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

.news-item,
.service-item,
.pricing-item {
    animation: fadeInUp 0.6s ease;
}
</style>
@endsection
