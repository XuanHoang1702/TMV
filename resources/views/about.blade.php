@extends('layouts.app')

@section('title', 'Về Dr. Đạt - Thẩm mỹ Dr.DAT')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/ve-dr-dat.css') }}">
@endsection

@section('content')
<div class="cl-body-bg">
    <div class="container">
        <!--banner-->
        <div class="cl-jCenter">
            <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                <div class="col-12 col-sm-12">
                    <h4 class="cl-title">VỀ DR. ĐẠT</h4>
                </div>
                <div class="col-12 col-sm-12 cl-desc">
                    <p>
                        Thẩm Mỹ Tận Tâm Dr. Đạt tự hào là đội ngũ bác sĩ phẫu thuật tạo hình thẩm mỹ chính thống,
                        dẫn dắt bởi Dr. Hà Quốc Đạt, Trưởng khoa Tạo hình Thẩm mỹ, Bệnh viện Lê Văn Thịnh.
                        Với hơn 25 năm kinh nghiệm trong ngành Y, Dr. Đạt là một trong những bác sĩ chuyên khoa uy tín trong lĩnh vực phẫu thuật Tạo Hình Thẩm Mỹ tại TP. HCM.
                    </p>
                </div>
            </div>
        </div>

        <!--contents-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-6" data-aos="fade-right" data-aos-duration="3000">
                        <img src="{{ asset('images/ve-dr-dat/dr_dat.png') }}" />
                    </div>
                    <div class="col-12 col-sm-6 cl-ct-info" data-aos="fade-left" data-aos-duration="3000">
                        <div class="cl-info">
                            <h4>DR. HÀ QUỐC ĐẠT</h4>
                            <p><strong>Trưởng khoa Tạo hình Thẩm mỹ</strong></p>
                            <p><strong>Bệnh viện Lê Văn Thịnh</strong></p>
                            <p>
                                Với hơn 25 năm kinh nghiệm trong ngành Y, Dr. Đạt là một trong những bác sĩ chuyên khoa uy tín
                                trong lĩnh vực phẫu thuật Tạo Hình Thẩm Mỹ tại TP. HCM. Bên cạnh công tác tại Bệnh viện Lê Văn Thịnh,
                                Dr. Đạt còn hợp tác với nhiều bệnh viện quốc tế danh tiếng, cùng đội ngũ bác sĩ chuyên khoa giàu kinh nghiệm.
                            </p>
                            <p>
                                Qua từng ca phẫu thuật thành công, Dr. Đạt đã mang lại sự tự tin và vẻ đẹp hoàn mỹ cho hàng trăm khách hàng
                                trong và ngoài nước. Với triết lý "Tận tâm – Chính thống – An toàn," Dr. Đạt luôn cam kết mang đến cho khách hàng
                                những giải pháp làm đẹp chất lượng cao, hài hòa với nét đẹp tự nhiên và bền vững theo thời gian.
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Qua trinh dao tao-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-info">
                        <h4>QUÁ TRÌNH ĐÀO TẠO VÀ PHÁT TRIỂN</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-6" data-aos="fade-right" data-aos-duration="3000">
                        <div class="cl-info">
                            <h5>TRÌNH ĐỘ HỌC VẤN</h5>
                            <ul class="ul-info">
                                <li><strong>1998:</strong> Tốt nghiệp Đại học Y Dược TP.HCM</li>
                                <li><strong>2005:</strong> Hoàn thành chương trình đào tạo chuyên khoa I Tạo hình Thẩm mỹ</li>
                                <li><strong>2010:</strong> Hoàn thành chương trình đào tạo chuyên khoa II Tạo hình Thẩm mỹ</li>
                                <li><strong>2015:</strong> Tham gia khóa đào tạo nâng cao tại Hàn Quốc</li>
                                <li><strong>2020:</strong> Tham gia khóa đào tạo nâng cao tại Singapore</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-12 col-sm-6" data-aos="fade-left" data-aos-duration="3000">
                        <div class="cl-info">
                            <h5>KINH NGHIỆM LÀM VIỆC</h5>
                            <ul class="ul-info">
                                <li><strong>1998-2005:</strong> Bác sĩ tại Bệnh viện Chợ Rẫy</li>
                                <li><strong>2005-2010:</strong> Bác sĩ tại Bệnh viện Việt Đức</li>
                                <li><strong>2010-Nay:</strong> Trưởng khoa Tạo hình Thẩm mỹ, Bệnh viện Lê Văn Thịnh</li>
                                <li><strong>2015-Nay:</strong> Giám đốc chuyên môn Thẩm Mỹ Tận Tâm Dr. Đạt</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Chung chi hanh nghe-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-info">
                        <h4>CHỨNG CHỈ HÀNH NGHỀ</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-4" data-aos="zoom-in" data-aos-duration="1000">
                        <div class="cl-certificate-item">
                            <img src="{{ asset('images/ve-dr-dat/chung-chi-1.png') }}" />
                            <h5>Chứng chỉ hành nghề</h5>
                            <p>Chứng chỉ hành nghề bác sĩ chuyên khoa II Tạo hình Thẩm mỹ</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4" data-aos="zoom-in" data-aos-duration="2000">
                        <div class="cl-certificate-item">
                            <img src="{{ asset('images/ve-dr-dat/chung-chi-2.png') }}" />
                            <h5>Chứng chỉ đào tạo</h5>
                            <p>Chứng chỉ hoàn thành khóa đào tạo nâng cao tại Hàn Quốc</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="cl-certificate-item">
                            <img src="{{ asset('images/ve-dr-dat/chung-chi-3.png') }}" />
                            <h5>Giấy khen</h5>
                            <p>Giấy khen của Sở Y tế TP.HCM về thành tích xuất sắc</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Triet ly lam viec-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-12 cl-info">
                        <h4>TRIẾT LÝ LÀM VIỆC</h4>
                    </div>
                </div>

                <div class="row">
                    <div class="col-12 col-sm-4" data-aos="zoom-in" data-aos-duration="1000">
                        <div class="cl-philosophy-item">
                            <img src="{{ asset('images/ve-dr-dat/tan-tam.png') }}" />
                            <h5>TẬN TÂM</h5>
                            <p>Luôn đặt sự hài lòng và an toàn của khách hàng lên hàng đầu</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4" data-aos="zoom-in" data-aos-duration="2000">
                        <div class="cl-philosophy-item">
                            <img src="{{ asset('images/ve-dr-dat/chinh-thong.png') }}" />
                            <h5>CHÍNH THỐNG</h5>
                            <p>Áp dụng các phương pháp và công nghệ tiên tiến, chuẩn y khoa</p>
                        </div>
                    </div>
                    <div class="col-12 col-sm-4" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="cl-philosophy-item">
                            <img src="{{ asset('images/ve-dr-dat/an-toan.png') }}" />
                            <h5>AN TOÀN</h5>
                            <p>Đảm bảo an toàn tuyệt đối trong mọi quy trình phẫu thuật</p>
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
