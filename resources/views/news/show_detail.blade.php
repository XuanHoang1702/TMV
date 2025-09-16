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
                        <div class="col-12 col-sm-9">
                            <!--Details-->
                            <div class="cl-ct-new-Details">
                                <div class="dv-info">
                                    <h4>Nam Giới Và Phẫu Thuật Thẩm Mỹ: Khi Phái Mạnh Cũng Áp Lực Ngoại Hình</h4>
                                    <p class="cl-info-date"><label>Đào tạo</label><i>18:00, 30/3/2025 </i></p>
                                </div>
                                <div class="dv-desc">
                                    <p>"Làm đàn ông phải mạnh mẽ, không quan trọng ngoại hình!"Nhưng sự thật ngày nay là: nam giới cũng đang chịu những áp lực khủng khiếp về vẻ ngoài, thậm chí không kém gì phụ nữ.</p>
                                    <p>
                                        Xu hướng thẩm mỹ ở nam giới đang tăng mạnh
                                        Không còn là câu chuyện hiếm gặp, nam giới hiện đại ngày càng chủ động tìm đến các hình thức làm đẹp như:
                                    </p>
                                    <ul>
                                        <li>Cắt mí, nâng mũi</li>
                                        <li>Gọt hàm, hút mỡ mặt</li>
                                        <li>Làm răng sứ, cấy tóc</li>
                                        <li> Chăm sóc da chuyên sâu</li>
                                    </ul>
                                    <p>
                                        Theo nhiều thống kê, số lượng nam giới thẩm mỹ đã tăng 30 – 40% trong vài năm trở lại đây, đặc biệt ở độ tuổi từ 20 đến 35.
                                    </p>
                                    <center>
                                        <img src="../images/tintuc/news_details_01.png" />
                                    </center>
                                    <p>Áp lực đến từ đâu?</p>
                                    <ul class="ul-lst-num">
                                        <li>
                                            Công việc yêu cầu ngoại hình </br>
                                            Ngành nghề như nghệ thuật, kinh doanh, dịch vụ... đều ngày càng xem trọng ngoại hình. Một gương mặt sáng, dễ nhìn đôi khi mang đến cơ hội rõ rệt hơn.
                                        </li>
                                        <li>
                                            Truyền thông và mạng xã hội </br>
                                            Hình ảnh "soái ca", "nam thần", "body 6 múi" tràn ngập các nền tảng, khiến đàn ông cũng rơi vào cuộc đua làm đẹp không tên.
                                        </li>
                                        <li>
                                            So sánh và sự kỳ vọng </br>
                                            Khi phụ nữ ngày càng đẹp, chỉn chu, không ít nam giới cảm thấy áp lực phải “xứng tầm”. Ngoại hình giờ đây trở thành yếu tố để cạnh tranh, không chỉ là chuyện cá nhân.

                                        </li>
                                    </ul>
                                    <center>
                                        <img src="../images/tintuc/news_details_02.png" />
                                    </center>

                                    <p>
                                        Làm đẹp là quyền, không phân biệt giới tính
                                    </p>
                                    <p> Việc nam giới làm đẹp không có gì sai. Ngược lại, đó là dấu hiệu của sự quan tâm đến bản thân, của sự tiến bộ.</p>
                                    <p>Tuy nhiên, điều quan trọng là: </p>
                                    <ul>
                                        <li>Đừng vì chạy theo xu hướng mà đánh mất chính mình.</li>
                                        <li> Đừng vì lời chê bai mà tự phủ nhận giá trị vốn có.</li>
                                        <li>
                                            Và nếu bạn muốn chỉnh sửa điều gì – hãy chắc rằng đó là mong muốn xuất phát từ bên trong, không phải từ nỗi sợ bị so sánh.
                                        </li>
                                    </ul>

                                    <center>
                                        <img src="../images/tintuc/news_details_02.png" />
                                    </center>
                                    <p>Áp lực đến từ đâu?</p>
                                    <ul class="ul-lst-num">
                                        <li>
                                            Công việc yêu cầu ngoại hình<br />
                                            Ngành nghề như nghệ thuật, kinh doanh, dịch vụ... đều ngày càng xem trọng ngoại hình. Một gương mặt sáng, dễ nhìn đôi khi mang đến cơ hội rõ rệt hơn.
                                        </li>
                                        <li>
                                            Truyền thông và mạng xã hội<br />
                                            Hình ảnh "soái ca", "nam thần", "body 6 múi" tràn ngập các nền tảng, khiến đàn ông cũng rơi vào cuộc đua làm đẹp không tên.
                                        </li>
                                        <li>
                                            So sánh và sự kỳ vọng<br />
                                            Khi phụ nữ ngày càng đẹp, chỉn chu, không ít nam giới cảm thấy áp lực phải “xứng tầm”. Ngoại hình giờ đây trở thành yếu tố để cạnh tranh, không chỉ là chuyện cá nhân.
                                        </li>
                                    </ul>






                                </div>

                            </div>
                            <!--end Details-->
                        </div>
                        <!--Right-->
                        <div class="col-12 col-sm-3">
                            <!--div button-->
                            <div class="row">
                                <div class="col-12 col-sm-12">
                                    <h3 cl-title>Bài viết liên quan</h3>
                                </div>
                            </div>
                            <!--Form-->
                            <div class="cl-ct-news-left">
                                <div class="row">
                                    <div class="col-12 col-sm-12">
                                        <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                            <div class="dv-img">
                                                <img src="../images/tintuc/tin-tuc_img_1_1.png" />
                                            </div>
                                            <div class="dv-info">
                                                <h2>Ám Ảnh Vẻ Ngoài: Khi Thẩm Mỹ Trở Thành Nỗi Áp Lực...</h2>
                                                <p class="cl-info-date"><label>Đào tạo</label><i>18:00, 30/3/2025 </i></p>
                                                <p class="cl-desc">
                                                    Đằng sau gương mặt hoàn hảo là những nỗi lo, sự tự ti và cả những chứng rối loạn tâm lý do...
                                                </p>
                                                <a href="#" class="btn-more">xem thêm</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--item 2-->
                                    <div class="col-12 col-sm-12">
                                        <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                            <div class="dv-img">
                                                <img src="../images/tintuc/tin-tuc_img_1_2.png" />
                                            </div>
                                            <div class="dv-info">
                                                <h2>“Dao Kéo” Có Gây Nghiện Không? Sự Thật Cần Được...</h2>
                                                <p class="cl-info-date"><label>Chuyên môn</label><i>18:00, 30/3/2025 </i></p>
                                                <p class="cl-desc">
                                                    Nhiều người không dừng lại sau một ca phẫu thuật, điều gì khiến họ tiếp tục chỉnh sửa mãi khôn...
                                                </p>
                                                <a href="#" class="btn-more">xem thêm</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--item 3-->
                                    <div class="col-12 col-sm-12">
                                        <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                            <div class="dv-img">
                                                <img src="../images/tintuc/tin-tuc_img_1_3.png" />
                                            </div>
                                            <div class="dv-info">
                                                <h2>“Dao Kéo” Có Gây Nghiện Không? Sự Thật Cần Được...</h2>
                                                <p class="cl-info-date"><label>Chuyên môn</label><i>18:00, 30/3/2025 </i></p>
                                                <p class="cl-desc">
                                                    Nhiều người không dừng lại sau một ca phẫu thuật, điều gì khiến họ tiếp tục chỉnh sửa mãi khôn...
                                                </p>
                                                <a href="#" class="btn-more">xem thêm</a>
                                            </div>
                                        </div>
                                    </div>
                                    <!--item 4-->
                                    <div class="col-12 col-sm-12">
                                        <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                            <div class="dv-img">
                                                <img src="../images/tintuc/tin-tuc_img_1_4.png" />
                                            </div>
                                            <div class="dv-info">
                                                <h2>Hậu Quả Của Những Ca Phẫu Thuật Thẩm Mỹ Hỏng: Nỗi Đa...</h2>
                                                <p class="cl-info-date"><label>Từ thiện</label><i>18:00, 30/3/2025 </i></p>
                                                <p class="cl-desc">
                                                    Nhiều người chọn cách im lặng sau khi thẩm mỹ thất bại. Bài viết sẽ phơi bày sự thật đau lòng...
                                                </p>
                                                <a href="#" class="btn-more">xem thêm</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
<!--Datlich-->
 @include('layouts.booking.booking_Popup_DatLichKham')
@endsection
