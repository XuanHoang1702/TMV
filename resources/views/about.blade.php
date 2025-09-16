@extends('layouts.app')

@section('title', 'Về Dr. Đạt - Thẩm mỹ Dr.DAT')

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/veDrDat.css') }}">
@endsection

@section('content')
    <div class="cl-body-bg">
        <div class="container">
            <!--banner-->
           <div class="cl-jCenter cl-aboutUs-0">
                    <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="col-12 col-sm-12">
                            <h4 class="cl-title">THẨM MỸ TẬN TÂM - KIM CHỈ NAM CHO SỨ MỆNH PHỤNG SỰ</h4>
                        </div>
                        <div class="col-12 col-sm-12 cl-desc">
                            <p class="ab-banner-desc">
                                Dr. Đạt tự hào là đội ngũ bác sĩ phẫu thuật tạo hình thẩm mỹ chính thống,
                                được dẫn dắt bởi bác sĩ Hà Quốc Đạt - Trưởng khoa Tạo hình Thẩm mỹ, Bệnh viện Lê Văn Thịnh - Bệnh viện hạng nhất thành phố Thủ Đức.
                            </p>
                        </div>
                    </div>
                </div>


            <!--contents-->
            <div class="cl-aboutUs-info">
                <div class="row">
                    <div class="col-12 col-sm-6 info-avartar" data-aos="fade-right" data-aos-duration="2000">
                        <img src="images/veDrDat/drDat.png" />
                    </div>
                    <div class="col-12 col-sm-6 info-desc" data-aos="fade-left" data-aos-duration="2000">
                        <div class="icon_nhay_1">
                            <img src="images/veDrDat/top_n.png" />
                        </div>
                        <h4>25 năm Kiến tạo vẻ đẹp chuẩn Y Khoa</h4>
                        <p>
                            Với hơn 25 năm kinh nghiệm, Dr. Đạt là bác sĩ chuyên khoa uy tín trong lĩnh vực phẫu thuật Tạo
                            Hình Thẩm Mỹ tại
                            TP. HCM. Bên cạnh công tác tại Bệnh viện Lê Văn Thịnh, Dr. Đạt còn hợp tác với nhiều bệnh viện
                            quốc tế danh tiếng,
                            cùng đội ngũ bác sĩ chuyên khoa giàu kinh nghiệm.
                            Qua từng ca phẫu thuật thành công, Dr. Đạt đã và đang mang lại sự tự tin cùng vẻ đẹp hoàn mỹ cho
                            hàng trăm khách
                            hàng trong và ngoài nước.
                        </p>
                        <div class="icon_nhay_2">
                            <img src="images/veDrDat/bottom_n.png" />
                        </div>
                    </div>
                </div>
            </div>

            <div class="cl-aboutUs-1">


                <div class="row" data-aos="fade-up" data-aos-duration="2000">
                    <div class="col-12 col-sm-12">
                        <h4 class="cl-title">
                            Đội ngũ nhân sự<br />
                            vững chuyên môn, giàu tâm đức
                        </h4>
                    </div>
                    <div class="col-12 col-sm-12 cl-desc">
                        <p>
                            Đội ngũ bác sĩ tại Dr. Đạt đều có chứng chỉ hành nghề chuyên khoa được cấp phép bởi Bộ Y Tế và
                            luôn lấy “tận tâm”
                            làm kim chỉ nam hoạt động, hướng tới triết lý làm nghề: Chuyên nghiệp - Tận tâm - Thấu hiểu
                        </p>
                    </div>
                </div>
            </div>

            <div class="cl-aboutUs-2">
                <div class="row">
                    <div class="col-12 col-sm-4">
                        <div class="cl-item" data-aos="flip-right" data-aos-duration="3000">
                            <div class="cl-icon">
                                <img src="images/home/icon_sec01_1.png" />
                            </div>
                            <h2>Chuyên nghiệp</h2>
                            <p>
                                Bằng kinh nghiệm chuyên môn vững vàng, công nghệ, máy móc hiện đại và tiêu chí chuẩn y khoa,
                                Dr. Đạt cùng đội ngũ luôn mang đến những dịch vụ chuyên nghiệp và đẳng cấp hàng đầu.
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="cl-item" data-aos="flip-right" data-aos-duration="3000">
                            <div class="cl-icon">
                                <img src="images/home/icon_sec01_2.png" />
                            </div>
                            <h2>Tận tâm</h2>
                            <p>
                                Không chỉ phụ trách khoa phẫu thuật tạo hình thẩm mỹ, Dr. Đạt còn là người trực tiếp tư vấn
                                và đồng hành cùng khách
                                hàng xuyên suốt hành trình tìm lại sự tự tin.
                            </p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4">
                        <div class="cl-item" data-aos="flip-right" data-aos-duration="3000">
                            <div class="cl-icon">
                                <img src="images/home/icon_sec01_3.png" />
                            </div>
                            <h2>Thấu hiểu</h2>
                            <p>
                                Tận tuỵ lắng nghe để thấu hiểu mong muốn của từng khách hàng. Đó chính là phong cách làm
                                việc đặc trưng của
                                “Bác sĩ thẩm mỹ tận tâm” Dr. Đạt.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="cl-aboutUs-3">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-image">
                        <img src="images/veDrDat/image_no.png" />
                    </div>
                </div>
            </div>

            <div class="cl-aboutUs-1">
                <div class="row" data-aos="fade-up" data-aos-duration="2000">
                    <div class="col-12 col-sm-12">
                        <h4 class="cl-title">
                            Dịch vụ chuẩn Y Khoa <br />
                            Chăm sóc chuyên nghiệp, trải nghiệm an tâm
                        </h4>
                    </div>
                    <div class="col-12 col-sm-12 cl-desc">
                        <p>
                            Tại Dr. Đạt, tất cả các quy trình thẩm mỹ đều được các bác sĩ trực tiếp thăm khám và tư vấn, kết
                            hợp với trang thiết bị hiện đại cùng kỹ thuật cao và cập nhật mới nhất,
                            đảm bảo khách hàng sẽ nhận được sự chăm sóc tận tình, chuyên nghiệp và an tâm tuyệt đối.
                        </p>
                    </div>
                </div>
            </div>

            <div class="cl-aboutUs-1" data-aos="zoom-in" data-aos-duration="2000">
                <div class="cl-aboutUs-4">
                    <label class="dv-title">Chúng tôi cam kết</label>
                    <div class="cl-content">
                        <ul class="cl-ul-lists">
                            <li>
                                <i class="cl-icon"><img src="images/icon/icon_check.png" /></i>
                                <label>Quy trình chuẩn y khoa – Bảo đảm tiêu chuẩn chuyên môn cao nhất trong mọi ca phẫu
                                    thuật.</label>
                            </li>
                            <li>
                                <i class="cl-icon"><img src="images/icon/icon_check.png" /></i>
                                <label>Dịch vụ tận tâm – Tư vấn kỹ lưỡng, theo sát từng giai đoạn điều trị, cá nhân hoá
                                    phương pháp theo nhu cầu riêng biệt.</label>
                            </li>
                            <li>
                                <i class="cl-icon"><img src="images/icon/icon_check.png" /></i>
                                <label>Kết quả được bảo chứng – Bằng sự hài lòng thực tế từ hàng trăm khách hàng đã làm đẹp
                                    thành công.</label>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>


            <div class="cl-aboutUs-3">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-image" style="padding-bottom: 70px;">
                        <img src="images/veDrDat/image_aboutUs_end.png" />
                    </div>
                </div>
            </div>

        </div>

    </div>

    <!--Sec 4 - dat lich kham ngay-->
    @include('layouts.booking.booking_Popup_DatLichKham')
@endsection
