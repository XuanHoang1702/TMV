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
                    <div class="col-12 col-sm-9">
                        <div class="row">
                            <div class="col-12 col-sm-4">
                                <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="dv-img">
                                        <img src="../images/tintuc/tin-tuc_img_1_1.png" />
                                    </div>
                                    <div class="dv-info">
                                        <h2>Ám Ảnh Vẻ Ngoài: Khi Thẩm Mỹ Trở Thành Nỗi Áp Lực...</h2>
                                        <p class="cl-info-date"><label>Đào tạo</label><i>18:00, 30/3/2025 </i></p>
                                        <p class="cl-desc">
                                            Đằng sau gương mặt hoàn hảo là những nỗi lo, sự tự ti và cả những chứng rối loạn
                                            tâm lý do...
                                        </p>
                                        <a href="tin-tuc-chit-tiet.html" class="btn-more">xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <!--item 2-->
                            <div class="col-12 col-sm-4">
                                <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="dv-img">
                                        <img src="../images/tintuc/tin-tuc_img_1_2.png" />
                                    </div>
                                    <div class="dv-info">
                                        <h2>“Dao Kéo” Có Gây Nghiện Không? Sự Thật Cần Được...</h2>
                                        <p class="cl-info-date"><label>Chuyên môn</label><i>18:00, 30/3/2025 </i></p>
                                        <p class="cl-desc">
                                            Nhiều người không dừng lại sau một ca phẫu thuật, điều gì khiến họ tiếp tục
                                            chỉnh sửa mãi khôn...
                                        </p>
                                        <a href="tin-tuc-chit-tiet.html" class="btn-more">xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <!--item 3-->
                            <div class="col-12 col-sm-4">
                                <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="dv-img">
                                        <img src="../images/tintuc/tin-tuc_img_1_3.png" />
                                    </div>
                                    <div class="dv-info">
                                        <h2>“Dao Kéo” Có Gây Nghiện Không? Sự Thật Cần Được...</h2>
                                        <p class="cl-info-date"><label>Chuyên môn</label><i>18:00, 30/3/2025 </i></p>
                                        <p class="cl-desc">
                                            Nhiều người không dừng lại sau một ca phẫu thuật, điều gì khiến họ tiếp tục
                                            chỉnh sửa mãi khôn...
                                        </p>
                                        <a href="tin-tuc-chit-tiet.html" class="btn-more">xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <!--item 4-->
                            <div class="col-12 col-sm-4">
                                <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="dv-img">
                                        <img src="../images/tintuc/tin-tuc_img_1_4.png" />
                                    </div>
                                    <div class="dv-info">
                                        <h2>Hậu Quả Của Những Ca Phẫu Thuật Thẩm Mỹ Hỏng: Nỗi Đa...</h2>
                                        <p class="cl-info-date"><label>Từ thiện</label><i>18:00, 30/3/2025 </i></p>
                                        <p class="cl-desc">
                                            Nhiều người chọn cách im lặng sau khi thẩm mỹ thất bại. Bài viết sẽ phơi bày sự
                                            thật đau lòng...
                                        </p>
                                        <a href="tin-tuc-chit-tiet.html" class="btn-more">xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <!--item 5-->
                            <div class="col-12 col-sm-4">
                                <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="dv-img">
                                        <img src="../images/tintuc/tin-tuc_img_1_5.png" />
                                    </div>
                                    <div class="dv-info">
                                        <h2>Phẫu Thuật Thẩm Mỹ Và Ranh Giới Mong Manh Giữa Tự...</h2>
                                        <p class="cl-info-date"><label>Đào tạo</label><i>18:00, 30/3/2025 </i></p>
                                        <p class="cl-desc">
                                            Liệu chỉnh sửa khuôn mặt có giúp bạn yêu bản thân hơn, hay lại khiến bạn ngày
                                            càng soi mói...
                                        </p>
                                        <a href="tin-tuc-chit-tiet.html" class="btn-more">xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <!--item 6-->
                            <div class="col-12 col-sm-4">
                                <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="dv-img">
                                        <img src="../images/tintuc/tin-tuc_img_1_6.png" />
                                    </div>
                                    <div class="dv-info">
                                        <h2>Vẻ Đẹp Chuẩn Hàn: Khi Cả Xã Hội Bị Ám Ảnh Bởi Một Khuô...</h2>
                                        <p class="cl-info-date"><label>Báo chí...</label><i>18:00, 30/3/2025 </i></p>
                                        <p class="cl-desc">
                                            Góc nhìn về sự bùng nổ của phẫu thuật thẩm mỹ phong cách Hàn Quốc và tác động
                                            văn...xem thêm
                                        </p>
                                        <a href="tin-tuc-chit-tiet.html" class="btn-more">xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <!--item 7-->
                            <div class="col-12 col-sm-4">
                                <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="dv-img">
                                        <img src="../images/tintuc/tin-tuc_img_1_7.png" />
                                    </div>
                                    <div class="dv-info">
                                        <h2>Chi Phí Cho Một Gương Mặt Mới: Đẹp Nhưng Có Đáng...</h2>
                                        <p class="cl-info-date"><label>Báo chí...</label><i>18:00, 30/3/2025 </i></p>
                                        <p class="cl-desc">
                                            Phẫu thuật thẩm mỹ không hề rẻ. Bài viết sẽ phân tích chi phí thực tế và những
                                            điều cần...
                                        </p>
                                        <a href="tin-tuc-chit-tiet.html" class="btn-more">xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <!--item 8-->
                            <div class="col-12 col-sm-4">
                                <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="dv-img">
                                        <img src="../images/tintuc/tin-tuc_img_1_8.png" />
                                    </div>
                                    <div class="dv-info">
                                        <h2>Tuổi Trẻ Và Quyết Định “Dao Kéo” Sớm – Lợi Hay Hại?</h2>
                                        <p class="cl-info-date"><label>Báo chí...</label><i>18:00, 30/3/2025 </i></p>
                                        <p class="cl-desc">
                                            Ngày càng nhiều bạn trẻ lựa chọn thẩm mỹ từ tuổi teen. Điều này liệu có hợp
                                            lý?...xem thêm
                                        </p>
                                        <a href="tin-tuc-chit-tiet.html" class="btn-more">xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <!--item 9-->
                            <div class="col-12 col-sm-4">
                                <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="dv-img">
                                        <img src="../images/tintuc/tin-tuc_img_1_9.png" />
                                    </div>
                                    <div class="dv-info">
                                        <h2>Người Nổi Tiếng Và Ảnh Hưởng Đến Trào Lưu Thẩm Mỹ...</h2>
                                        <p class="cl-info-date"><label>Từ thiện</label><i>18:00, 30/3/2025 </i></p>
                                        <p class="cl-desc">
                                            Khi idol chỉnh mũi, cắt mí, hàng triệu người cũng làm theo. Trách nhiệm thuộc về
                                            ai?...s
                                        </p>
                                        <a href="tin-tuc-chit-tiet.html" class="btn-more">xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <!--item 10-->
                            <div class="col-12 col-sm-4">
                                <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="dv-img">
                                        <img src="../images/tintuc/tin-tuc_img_1_10.png" />
                                    </div>
                                    <div class="dv-info">
                                        <h2>“Dao Kéo” Có Thể Cứu Một Mối Quan Hệ Tình Cảm?</h2>
                                        <p class="cl-info-date"><label>Chuyên môn</label><i>18:00, 30/3/2025 </i></p>
                                        <p class="cl-desc">
                                            Nhiều người tin rằng đẹp hơn sẽ giữ được tình yêu – nhưng sự thật có như thế
                                            không?...
                                        </p>
                                        <a href="tin-tuc-chit-tiet.html" class="btn-more">xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <!--item 11-->
                            <div class="col-12 col-sm-4">
                                <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="dv-img">
                                        <img src="../images/tintuc/tin-tuc_img_1_11.png" />
                                    </div>
                                    <div class="dv-info">
                                        <h2>Phẫu Thuật Thẩm Mỹ Và Tiêu Chuẩn Đẹp Phi Thực Tế</h2>
                                        <p class="cl-info-date"><label>Từ thiện</label><i>18:00, 30/3/2025 </i></p>
                                        <p class="cl-desc">
                                            Instagram, TikTok tạo nên những tiêu chuẩn không thật. Người thật có thể theo
                                            kịp không?...xem thêm
                                        </p>
                                        <a href="tin-tuc-chit-tiet.html" class="btn-more">xem thêm</a>
                                    </div>
                                </div>
                            </div>
                            <!--item 12-->
                            <div class="col-12 col-sm-4">
                                <div class="cl-item-new" data-aos="zoom-in" data-aos-duration="1000">
                                    <div class="dv-img">
                                        <img src="../images/tintuc/tin-tuc_img_1_12.png" />
                                    </div>
                                    <div class="dv-info">
                                        <h2>Bác Sĩ Thẩm Mỹ: Thiên Thần Hay "Thợ Sửa Mặt"?</h2>
                                        <p class="cl-info-date"><label>Chuyên môn</label><i>18:00, 30/3/2025 </i></p>
                                        <p class="cl-desc">
                                            Sự thật về tay nghề, đạo đức và cả những nguy cơ khi giao nhan sắc cho người
                                            khác....xem thêm
                                        </p>
                                        <a href="tin-tuc-chit-tiet.html" class="btn-more">xem thêm</a>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-12 col-sm-12">
                                <ul class="cl-pagging">
                                    <li class="p-first">
                                        <a href="#"> <img src="../images/icon/icon_btn_left.png" /></a>
                                    </li>
                                    <li class="active">
                                        <a href="#"> <span>1</span></a>
                                    </li>
                                    <li>
                                        <a href="#"> <span>2</span></a>
                                    </li>
                                    <li>
                                        <a href="#"> <span>3</span></a>
                                    </li>
                                    <li>
                                        <a href="#"> <span>4</span></a>
                                    </li>
                                    <li>
                                        <a href="#"> <span>5</span></a>
                                    </li>
                                    <li class="p-last">
                                        <a href="#"> <img src="../images/icon/icon_btn_right.png" /></a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <!--Datlich-->
            @include('layouts.booking.booking_Popup_DatLichKham')
        @endsection
