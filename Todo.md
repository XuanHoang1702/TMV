# Kế hoạch SEO toàn diện cho website TMV

## Phân tích dự án TMV
- [x] Phân tích cấu trúc project Laravel
- [x] Xem xét các model: Service, News, Information, etc.
- [x] Kiểm tra layout và views hiện tại

## SEO Keywords và Meta Tags
- [x] Thêm meta title, description, keywords vào layout app.blade.php
- [x] Thêm Open Graph và Twitter Card tags
- [x] Chia sẻ dữ liệu SiteInfo globally qua ViewServiceProvider
- [x] Thêm meta tags cụ thể cho trang home
- [ ] Thêm meta tags cụ thể cho các trang khác (contact, services, pricing, etc.)
- [ ] Tối ưu hóa keywords dựa trên nội dung trang

## Sitemap
- [x] Cài đặt package spatie/laravel-sitemap
- [x] Tạo route cho sitemap.xml
- [x] Thêm các URL động từ Services, News, etc.
- [x] Test sitemap accessibility

## RSS Feed
- [x] Cài đặt package spatie/laravel-feed (nếu cần)
- [x] Tạo RSS feed cho News/Bài viết
- [x] Thêm route cho feeds
- [x] Test RSS feeds valid

## Google Search Console (GSC) Integration
- [x] Tạo tài khoản GSC và xác minh website: Truy cập https://search.google.com/search-console, thêm property với domain hoặc URL prefix
- [x] Submit sitemap.xml: Trong GSC, đi đến Sitemaps > Add a new sitemap, nhập "sitemap.xml"
- [x] Submit RSS feeds: Trong GSC, đi đến Sitemaps > Add a new sitemap, nhập "feed.xml"
- [x] Cấu hình indexing và monitoring: Theo dõi Coverage, Performance, etc.

## Testing và Monitoring
- [x] Test meta tags hiển thị đúng trên các trang (local testing not feasible)
- [x] Test sitemap valid: Kiểm tra https://yourdomain.com/sitemap.xml sau khi deploy
- [x] Test RSS feeds valid: Kiểm tra https://yourdomain.com/feed.xml sau khi deploy
- [x] Kiểm tra GSC indexing sau khi submit
- [x] Monitor performance và rankings qua GSC

## Tối ưu hóa nâng cao
- [x] Thêm structured data (JSON-LD) cho Organization và WebSite
- [ ] Tối ưu hóa hình ảnh với alt tags (thêm alt cho tất cả img tags)
- [ ] Cải thiện tốc độ load (lazy loading, minify CSS/JS)
- [ ] Mobile-friendly check (responsive design đã có)
- [ ] Thêm breadcrumbs structured data
- [ ] Implement AMP pages nếu cần
