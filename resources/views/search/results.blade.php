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
                            <i class="fa fa-search"></i>
                            Thử tìm kiếm khác
                        </a>
                    </div>
                @else
                    <div class="results-info">
                        <p>Tìm thấy <strong>{{ $results->count() }}</strong> kết quả</p>
                    </div>

                    <!-- NEW LAYOUT: 60% News - 40% Services + Pricing -->
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
                                @foreach($results->where('type', 'news') as $result)
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
                                                    {{ $result['date']->format('d/m/Y') }}
                                                </span>
                                            </div>

                                            <h4 class="news-title">
                                                <a href="{{ $result['url'] }}">{{ $result['title'] }}</a>
                                            </h4>

                                            <p class="news-excerpt">{{ $result['content'] }}</p>

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
                                                <!-- THÊM XEM CHI TIẾT CHO DỊCH VỤ -->
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
                                                <!-- THÊM XEM CHI TIẾT CHO BÁO GIÁ -->
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

                <div class="search-actions">
                    <a href="{{ route('search.index') }}" class="btn btn-secondary">
                        <i class="fa fa-search"></i>
                        Tìm kiếm mới
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.cl-search-results {
    padding: 50px 0;
    background-color: #f8f9fa;
    min-height: 60vh;
}

.search-header {
    text-align: center;
    margin-bottom: 40px;
}

.search-header h1 {
    color: #333;
    font-size: 2.5rem;
    margin-bottom: 10px;
    font-weight: 600;
}

.search-header p {
    color: #666;
    font-size: 1.1rem;
}

.results-info {
    background: white;
    padding: 15px 20px;
    border-radius: 8px;
    margin-bottom: 30px;
    text-align: center;
    box-shadow: 0 2px 10px rgba(0,0,0,0.1);
}

/* NEW LAYOUT STYLES */
.search-layout {
    margin-bottom: 40px;
}

/* SECTION HEADERS */
.section-header,
.widget-header {
    margin-bottom: 25px;
    padding-bottom: 10px;
    border-bottom: 2px solid #eee;
}

.section-title,
.widget-title {
    color: #333;
    font-size: 1.4rem;
    font-weight: 600;
    margin: 0;
    display: flex;
    align-items: center;
    gap: 10px;
}

.section-title i,
.widget-title i {
    color: #667eea;
    font-size: 1.2rem;
}

.section-count {
    background: #667eea;
    color: white;
    padding: 2px 8px;
    border-radius: 12px;
    font-size: 0.8rem;
    font-weight: 500;
}

/* NEWS SECTION - 60% LEFT */
.news-section {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
    margin-bottom: 30px;
}

.news-results {
    display: flex;
    flex-direction: column;
    gap: 25px;
}

.news-item {
    display: flex;
    gap: 20px;
    padding: 20px;
    border: 1px solid #eee;
    border-radius: 10px;
    transition: all 0.3s ease;
    background: #fafafa;
}

.news-item:hover {
    background: white;
    box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    transform: translateY(-2px);
}

.news-image {
    flex-shrink: 0;
    width: 120px;
    height: 80px;
    border-radius: 8px;
    overflow: hidden;
    background: #f0f0f0;
}

.news-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.news-content {
    flex: 1;
}

.news-meta {
    margin-bottom: 8px;
}

.news-date {
    color: #666;
    font-size: 0.9rem;
}

.news-date i {
    margin-right: 5px;
    color: #999;
}

.news-title {
    margin: 0 0 10px 0;
}

.news-title a {
    color: #333;
    text-decoration: none;
    font-size: 1.1rem;
    font-weight: 600;
    line-height: 1.4;
    display: block;
}

.news-title a:hover {
    color: #667eea;
}

.news-excerpt {
    color: #666;
    font-size: 0.95rem;
    line-height: 1.6;
    margin: 0 0 12px 0;
}

.news-readmore {
    color: #667eea;
    text-decoration: none;
    font-weight: 500;
    font-size: 0.9rem;
    display: inline-flex;
    align-items: center;
    gap: 5px;
    transition: color 0.2s ease;
}

.news-readmore:hover {
    color: #5a6fd8;
}

.no-news {
    text-align: center;
    padding: 40px 20px;
    color: #999;
    font-style: italic;
}

.no-news i {
    font-size: 3rem;
    margin-bottom: 15px;
    opacity: 0.5;
}

/* SIDEBAR SECTION - 40% RIGHT */
.sidebar-section {
    display: flex;
    flex-direction: column;
    gap: 30px;
}

.sidebar-widget {
    background: white;
    border-radius: 12px;
    padding: 25px;
    box-shadow: 0 2px 15px rgba(0,0,0,0.08);
}

/* SERVICE WIDGET */
.service-widget .service-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.service-item {
    display: flex;
    gap: 12px;
    padding: 15px;
    border: 1px solid #f0f0f0;
    border-radius: 8px;
    transition: all 0.2s ease;
    background: #fafafa;
    position: relative;
}

.service-item:hover {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.service-image {
    flex-shrink: 0;
    width: 50px;
    height: 50px;
    border-radius: 8px;
    overflow: hidden;
    background: #f8f9fa;
}

.service-image img {
    width: 100%;
    height: 100%;
    object-fit: cover;
}

.service-info {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.service-title {
    margin: 0 0 5px 0;
    font-size: 0.95rem;
    flex-grow: 1;
}

.service-title a {
    color: #333;
    text-decoration: none;
    font-weight: 600;
    display: block;
}

.service-title a:hover {
    color: #388e3c;
}

.service-price {
    color: #666;
    font-size: 0.85rem;
    margin: 0 0 8px 0;
    line-height: 1.4;
    flex-grow: 1;
}

/* THÊM XEM CHI TIẾT CHO DỊCH VỤ */
.service-readmore {
    color: #388e3c;
    text-decoration: none;
    font-size: 0.8rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.2s ease;
    padding: 4px 8px;
    border-radius: 4px;
    background: rgba(56, 142, 60, 0.1);
    margin-top: auto;
}

.service-readmore:hover {
    color: white;
    background: #388e3c;
    transform: translateX(2px);
}

.service-readmore i {
    font-size: 0.75rem;
    transition: transform 0.2s ease;
}

.service-readmore:hover i {
    transform: translateX(2px);
}

.no-services {
    text-align: center;
    padding: 30px 10px;
    color: #999;
    font-style: italic;
}

.no-services i {
    font-size: 2.5rem;
    margin-bottom: 10px;
    opacity: 0.5;
    color: #388e3c;
}

/* PRICING WIDGET */
.pricing-widget .pricing-list {
    display: flex;
    flex-direction: column;
    gap: 15px;
}

.pricing-item {
    display: flex;
    gap: 12px;
    padding: 15px;
    border: 1px solid #f0f0f0;
    border-radius: 8px;
    transition: all 0.2s ease;
    background: #fafafa;
    position: relative;
}

.pricing-item:hover {
    background: white;
    box-shadow: 0 2px 10px rgba(0,0,0,0.05);
}

.pricing-icon {
    flex-shrink: 0;
    width: 50px;
    height: 50px;
    border-radius: 50%;
    overflow: hidden;
    background: linear-gradient(135deg, #fff3e0 0%, #ffe0b2 100%);
    display: flex;
    align-items: center;
    justify-content: center;
    border: 2px solid #ffe0b2;
}

.pricing-icon img {
    width: 30px;
    height: 30px;
    object-fit: contain;
}

.pricing-info {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.pricing-title {
    margin: 0 0 5px 0;
    font-size: 0.95rem;
    flex-grow: 1;
}

.pricing-title a {
    color: #333;
    text-decoration: none;
    font-weight: 600;
    display: block;
}

.pricing-title a:hover {
    color: #f57c00;
}

.pricing-desc {
    color: #666;
    font-size: 0.85rem;
    margin: 0 0 8px 0;
    line-height: 1.4;
    flex-grow: 1;
}

/* THÊM XEM CHI TIẾT CHO BÁO GIÁ */
.pricing-readmore {
    color: #f57c00;
    text-decoration: none;
    font-size: 0.8rem;
    font-weight: 500;
    display: inline-flex;
    align-items: center;
    gap: 4px;
    transition: all 0.2s ease;
    padding: 4px 8px;
    border-radius: 4px;
    background: rgba(245, 124, 0, 0.1);
    border: 1px solid rgba(245, 124, 0, 0.2);
    margin-top: auto;
    align-self: flex-start;
}

.pricing-readmore:hover {
    color: white;
    background: #f57c00;
    border-color: #f57c00;
    transform: translateX(2px);
}

.pricing-readmore i {
    font-size: 0.75rem;
    transition: transform 0.2s ease;
}

.pricing-readmore:hover i {
    transform: translateX(2px);
}

.no-pricing {
    text-align: center;
    padding: 30px 10px;
    color: #999;
    font-style: italic;
}

.no-pricing i {
    font-size: 2.5rem;
    margin-bottom: 10px;
    opacity: 0.5;
    color: #f57c00;
}

/* EMPTY STATE */
.no-results {
    text-align: center;
    padding: 60px 20px;
    background: white;
    border-radius: 10px;
    box-shadow: 0 2px 20px rgba(0,0,0,0.1);
}

.no-results-icon {
    font-size: 4rem;
    color: #ddd;
    margin-bottom: 20px;
}

.no-results h3 {
    color: #333;
    margin-bottom: 15px;
    font-size: 1.5rem;
}

.no-results p {
    color: #666;
    margin-bottom: 30px;
    font-size: 1.1rem;
}

/* BUTTONS */
.btn-outline-primary {
    color: #667eea;
    border-color: #667eea;
    background-color: transparent;
    padding: 8px 16px;
    border-radius: 6px;
    font-weight: 500;
    transition: all 0.2s ease;
}

.btn-outline-primary:hover {
    color: white;
    background-color: #667eea;
    border-color: #667eea;
}

.search-actions {
    text-align: center;
    margin-top: 40px;
    padding-top: 30px;
    border-top: 1px solid #eee;
}

.search-actions .btn {
    padding: 12px 30px;
    font-size: 1.1rem;
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
        height: 200px;
        max-width: 300px;
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
        margin-top: 8px;
    }
}

@media (max-width: 768px) {
    .search-header h1 {
        font-size: 2rem;
    }

    .section-title,
    .widget-title {
        font-size: 1.2rem;
    }

    .news-item,
    .service-item,
    .pricing-item {
        padding: 15px;
    }

    .service-image,
    .pricing-icon {
        margin: 0 auto 10px auto;
    }

    .service-readmore,
    .pricing-readmore {
        font-size: 0.75rem;
        padding: 3px 6px;
    }
}

/* Animation cho readmore buttons */
@keyframes slideInRight {
    from {
        opacity: 0;
        transform: translateX(-10px);
    }
    to {
        opacity: 1;
        transform: translateX(0);
    }
}

.service-readmore,
.pricing-readmore,
.news-readmore {
    animation: slideInRight 0.3s ease;
}

/* Hover effect cho toàn bộ item */
.service-item:hover .service-readmore,
.pricing-item:hover .pricing-readmore {
    transform: translateX(4px);
}
</style>
@endsection
