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
                                    <h4>{{ $news->title }}</h4>
                                    <p class="cl-info-date"><label>{{ $news->category->name ?? 'Uncategorized' }}</label><i>{{ $news->published_at ? $news->published_at->format('H:i, d/m/Y') : $news->created_at->format('H:i, d/m/Y') }}</i></p>
                                </div>
                                <div class="dv-desc">
                                    {!! nl2br(e($news->content)) !!}
                                    @if($news->images && count($news->images) > 0)
                                        @foreach($news->images as $image)
                                            <center>
                                                <img src="{{ asset('storage/' . $image) }}" alt="{{ $news->title }}" />
                                            </center>
                                        @endforeach
                                    @endif
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
