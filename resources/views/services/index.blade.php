@extends('layouts.app')

@section('title', 'Dịch vụ - Thẩm mỹ Dr.DAT')

@section('styles')
<link rel="stylesheet" href="{{ asset('css/dichvu.css') }}">
@endsection

@section('content')
<div class="cl-body-bg">
    <div class="container">
        <!--banner-->
        <div class="cl-jCenter">
            <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                <div class="col-12 col-sm-12">
                    <h4 class="cl-title">DỊCH VỤ CỦA CHÚNG TÔI</h4>
                </div>
                <div class="col-12 col-sm-12 cl-desc">
                    <p>
                        Chúng tôi cung cấp các dịch vụ thẩm mỹ tiên tiến, an toàn và hiệu quả, được thực hiện bởi ekip bác sĩ giàu kinh nghiệm, tận tâm và luôn đặt sức khỏe của bạn lên hàng đầu.
                        Tại Dr. Đạt, mỗi khách hàng đều là một câu chuyện riêng biệt, và chúng tôi luôn cam kết mang lại kết quả tuyệt vời, tự nhiên, và lâu dài.
                    </p>
                </div>
            </div>
        </div>

        <!--contents-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    @if(isset($categories))
                        @foreach($categories->where('type', 'service')->where('parent_id', null) as $parentCategory)
                            <div class="col-12 col-sm-12 cl-ct-info" data-aos="fade-left" data-aos-duration="3000">
                                <div class="cl-info">
                                    <h4>{{ $parentCategory->name }}</h4>
                                    <p>{{ $parentCategory->description }}</p>
                                </div>
                                <div class="cl-btn-more">
                                    <a href="{{ route('services.detail', $parentCategory->slug) }}">
                                        <img src="{{ asset('images/icon/icon_arrow_down.png') }}" />
                                    </a>
                                </div>
                            </div>
                            @php
                                $childCategories = $categories->where('parent_id', $parentCategory->id);
                            @endphp
                            @foreach($childCategories as $childCategory)
                                <div class="col-12 col-sm-12 cl-ct-info" data-aos="fade-left" data-aos-duration="3000" style="padding-left: 30px;">
                                    <div class="cl-info">
                                        <h5>{{ $childCategory->name }}</h5>
                                        <p>{{ $childCategory->description }}</p>
                                    </div>
                                    <div class="cl-btn-more">
                                        <a href="{{ route('services.detail', $childCategory->slug) }}">
                                            <img src="{{ asset('images/icon/icon_arrow_down.png') }}" />
                                        </a>
                                    </div>
                                </div>
                            @endforeach
                        @endforeach
                    @else
                        <div class="col-12 col-sm-12 cl-ct-info" data-aos="fade-left" data-aos-duration="3000">
                            <div class="cl-info">
                                <h4>DỊCH VỤ PHẪU THUẬT THẨM MỸ CÔ BÉ</h4>
                                <p>
                                    Phẫu thuật thẩm mỹ cô bé là dịch vụ làm đẹp vùng kín giúp khôi phục sự tự tin và cải thiện sức khỏe sinh lý cho phái nữ.
                                    Được thực hiện bởi các bác sĩ chuyên khoa giàu kinh nghiệm, dịch vụ này mang lại kết quả tự nhiên, an toàn và hiệu quả lâu dài.
                                </p>
                            </div>
                            <div class="cl-btn-more">
                                <a href="{{ route('services.detail', 'dich-vu-tham-my-co-be') }}">
                                    <img src="{{ asset('images/icon/icon_arrow_down.png') }}" />
                                </a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!--Dich vu Phau thua-->
        <div class="cl-panel-list">
            <div class="cl-panel-body">
                <div class="row">
                    <div class="col-12 col-sm-5 cl-info" data-aos="fade-right" data-aos-duration="3000">
                        <h4>
                            DỊCH VỤ PHẪU THUẬT <br />
                            THẨM MỸ CÔ BÉ <br />
                            BAO GỒM
                        </h4>
                        <div class="cl-dv-btn">
                            <a href="{{ route('services.detail', 'dich-vu-tham-my-co-be') }}">
                                <img src="{{ asset('images/icon/icon_arowOnly_right.png') }}" />
                            </a>
                        </div>
                        <div>
                            <img src="{{ asset('images/dichvu/dv_01.png') }}" />
                        </div>
                    </div>
                    <div class="col-12 col-sm-7 cl-detail">
                        <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                            <div class="row">
                                <div class="col-12 col-sm-2 cl-img">
                                    <img src="{{ asset('images/dichvu/icon_dv1.png') }}" />
                                </div>
                                <div class="col-12 col-sm-10 cl-ct-info">
                                    <h2>Thu Hẹp Âm Đạo</h2>
                                    <p>
                                        Phẫu thuật thu hẹp âm đạo giúp cải thiện độ săn chắc và co giãn của vùng kín, phục hồi khả năng đàn hồi sau sinh nở hoặc do tuổi tác.
                                        Đây là phương pháp giúp tăng cường khoái cảm tình dục và cải thiện chất lượng đời sống vợ chồng.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                            <div class="row">
                                <div class="col-12 col-sm-2 cl-img">
                                    <img src="{{ asset('images/dichvu/icon_dv2.png') }}" />
                                </div>
                                <div class="col-12 col-sm-10 cl-ct-info">
                                    <h2>Tạo Hình Môi Âm Đạo</h2>
                                    <p>
                                        Dịch vụ này giúp chỉnh sửa kích thước và hình dáng của môi lớn và môi nhỏ, mang lại vẻ đẹp tự nhiên, hài hòa cho vùng kín.
                                        Đặc biệt, phẫu thuật này còn giúp giảm sự khó chịu do môi âm đạo bị thừa hay không đều.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                            <div class="row">
                                <div class="col-12 col-sm-2 cl-img">
                                    <img src="{{ asset('images/dichvu/icon_dv3.png') }}" />
                                </div>
                                <div class="col-12 col-sm-10 cl-ct-info">
                                    <h2>Tạo Hình Màng Trinh</h2>
                                    <p>Phẫu thuật tái tạo màng trinh, giúp phục hồi sự nguyên vẹn cho những chị em mong muốn có lại cảm giác như thuở ban đầu.</p>
                                </div>
                            </div>
                        </div>

                        <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                            <div class="row">
                                <div class="col-12 col-sm-2 cl-img">
                                    <img src="{{ asset('images/dichvu/icon_dv4.png') }}" />
                                </div>
                                <div class="col-12 col-sm-10 cl-ct-info">
                                    <h2>Nâng Cơ Vùng Kín</h2>
                                    <p>
                                        Cải thiện độ săn chắc của cơ vùng âm đạo giúp phụ nữ trẻ trung hơn và tự tin hơn trong đời sống tình dục.
                                        Phương pháp này cũng có thể hỗ trợ trong việc khắc phục hiện tượng tiểu són sau sinh.
                                    </p>
                                </div>
                            </div>
                        </div>

                        <div class="cl-pl-item" data-aos="fade-left" data-aos-duration="3000">
                            <div class="row">
                                <div class="col-12 col-sm-2 cl-img">
                                    <img src="{{ asset('images/dichvu/icon_dv5.png') }}" />
                                </div>
                                <div class="col-12 col-sm-10 cl-ct-info">
                                    <h2>Làm Hồng Vùng Kín</h2>
                                    <p>
                                        Để duy trì sự tươi trẻ và thu hút, dịch vụ làm hồng vùng kín giúp làm sáng và đều màu da vùng kín, mang lại vẻ đẹp tự nhiên và tăng thêm sự tự tin cho phái nữ.
                                        Phương pháp này sử dụng công nghệ hiện đại và an toàn, không gây tổn thương cho da, giúp cải thiện sắc tố da, đem lại làn da mịn màng, hồng hào.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!--Ly do-->
        <div class="cl-dv-lydo" data-aos="zoom-in" data-aos-duration="3000">
            <div class="row">
                <div class="col-12 col-sm-12 cl-info ">
                    <h4>LÝ DO NÊN CHỌN PHẪU THUẬT THẨM MỸ CÔ BÉ TẠI DR. ĐẠT</h4>
                </div>
            </div>

            <div class="row" style="padding:35px 0;">
                <div class="col-12 col-sm-3">
                    <div class="col-item">
                        <div class="cl-img">
                            <img src="{{ asset('images/dichvu/icon_lydo1.png') }}" />
                        </div>
                        <h3>Kinh nghiệm chuyên sâu</h3>
                        <p>Các bác sĩ tại Dr. Đạt có chuyên môn cao trong lĩnh vực phẫu thuật thẩm mỹ cô bé, đảm bảo quy trình thực hiện chính xác, an toàn và hiệu quả.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="col-item">
                        <div class="cl-img">
                            <img src="{{ asset('images/dichvu/icon_lydo2.png') }}" />
                        </div>
                        <h3>Kỹ thuật hiện đại</h3>
                        <p>
                            Dr. Đạt luôn áp dụng các phương pháp phẫu thuật kỹ thuật cao và luôn cập nhật, giúp phẫu thuật tạo hình thẩm mỹ một cách hiệu quả,
                            hạn chế tối đa các biến chứng.
                        </p>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="col-item">
                        <div class="cl-img">
                            <img src="{{ asset('images/dichvu/icon_lydo3.png') }}" />
                        </div>
                        <h3>An toàn tuyệt đối</h3>
                        <p>Quy trình phẫu thuật được thực hiện trong môi trường vô trùng, với sự giám sát của đội ngũ y bác sĩ chuyên khoa, mang lại sự an tâm cho bệnh nhân.</p>
                    </div>
                </div>
                <div class="col-12 col-sm-3">
                    <div class="col-item">
                        <div class="cl-img">
                            <img src="{{ asset('images/dichvu/icon_lydo4.png') }}" />
                        </div>
                        <h3>Phục hồi nhanh chóng</h3>
                        <p>Sau phẫu thuật, bác sĩ sẽ hướng dẫn chăm sóc vết thương và theo dõi quá trình hồi phục để đảm bảo không có biến chứng và bệnh nhân phục hồi nhanh chóng.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cl-sec02" data-aos="zoom-in" data-aos-duration="3000">
        <img src="{{ asset('images/dichvu/bap_tay_het_mo.png') }}">
    </div>

    <!--Quy trinh-->
    <div class="cl-dv-lydo">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-12 cl-info ">
                    <h4>QUY TRÌNH PHẪU THUẬT THẨM MỸ NGỰC</h4>
                </div>
            </div>

            <div class="row" style="padding:35px 0;">
                <div class="col-12 col-sm-3 cl-colItem" data-aos="zoom-in">
                    <div class="col-item item-bg-org">
                        <div class="row" style="margin-bottom:15px;">
                            <div class="col-12 col-sm-9 dv-number">
                                <h1>01</h1>
                            </div>
                            <div class="col-12 col-sm-3 cl-img-right">
                                <img src="{{ asset('images/icon/icon_arow_right_blue.png') }}" />
                            </div>
                        </div>
                        <h3>Tư vấn và khám sức khỏe</h3>
                        <p>Bác sĩ sẽ tư vấn phương pháp phù hợp với nhu cầu của bạn, kiểm tra tình trạng sức khỏe để đảm bảo an toàn trước khi phẫu thuật.</p>
                        <div class="cl-img">
                            <img src="{{ asset('images/dichvu/img_qt1.png') }}" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-3 cl-colItem" data-aos="zoom-in" data-aos-duration="1000">
                    <div class="col-item item-bg-org">
                        <div class="row" style="margin-bottom:15px;">
                            <div class="col-12 col-sm-9 dv-number">
                                <h1>02</h1>
                            </div>
                            <div class="col-12 col-sm-3 cl-img-right">
                                <img src="{{ asset('images/icon/icon_arow_right_blue.png') }}" />
                            </div>
                        </div>
                        <h3>Lập kế hoạch phẫu thuật</h3>
                        <p>Sau khi xác định phương pháp, bác sĩ sẽ lên kế hoạch chi tiết cho ca hút mỡ, cấy mỡ.</p>
                        <div class="cl-img">
                            <img src="{{ asset('images/dichvu/img_qt2.png') }}" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-3 cl-colItem" data-aos="zoom-in" data-aos-duration="2000">
                    <div class="col-item item-bg-org">
                        <div class="row" style="margin-bottom:15px;">
                            <div class="col-12 col-sm-9 dv-number">
                                <h1>03</h1>
                            </div>
                            <div class="col-12 col-sm-3 cl-img-right">
                                <img src="{{ asset('images/icon/icon_arow_right_blue.png') }}" />
                            </div>
                        </div>
                        <h3>Tiến hành phẫu thuật</h3>
                        <p>Phẫu thuật hút mỡ và cấy mỡ được thực hiện dưới gây tê hoặc gây mê nhẹ, bạn sẽ không cảm thấy đau đớn trong quá trình thực hiện.</p>
                        <div class="cl-img">
                            <img src="{{ asset('images/dichvu/img_qt3.png') }}" />
                        </div>
                    </div>
                </div>
                <div class="col-12 col-sm-3 cl-colItem" data-aos="zoom-in" data-aos-duration="3000">
                    <div class="col-item item-bg-org">
                        <div class="row" style="margin-bottom:15px;">
                            <div class="col-12 col-sm-9 dv-number">
                                <h1>04</h1>
                            </div>
                            <div class="col-12 col-sm-3 cl-img-right">
                                <img src="{{ asset('images/icon/icon_arow_right_blue.png') }}" />
                            </div>
                        </div>
                        <h3>Chăm sóc sau phẫu thuật</h3>
                        <p>Bác sĩ sẽ hướng dẫn chăm sóc vết mổ, giảm sưng, đau và phục hồi nhanh chóng.</p>
                        <div class="cl-img">
                            <img src="{{ asset('images/dichvu/img_qt4.png') }}" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="cl-dv-camnhan">
        <div class="container">
            <div class="cl-bg-camnhan">
                <div class="row">
                    <div class="col-12 col-sm-4 cl-img-vertical" data-aos="zoom-in" data-aos-duration="1000">
                        <img src="{{ asset('images/dichvu/camnhan_1.png') }}" />
                    </div>
                    <div class="col-12 col-sm-8">
                        <div class="row">
                            <div class="col-12 col-sm-6" data-aos="fade-left">
                                <div class="col-item">
                                    <div class="cl-img">
                                        <img src="{{ asset('images/dichvu/camnhan_2.png') }}" />
                                    </div>
                                    <h3>Vóc dáng thon gọn</h3>
                                    <p>Sau khi hút mỡ, các vùng mỡ thừa sẽ được loại bỏ, giúp bạn sở hữu vóc dáng thon gọn và săn chắc hơn.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6" data-aos="fade-left" data-aos-duration="1000">
                                <div class="col-item">
                                    <div class="cl-img">
                                        <img src="{{ asset('images/dichvu/camnhan_3.png') }}" />
                                    </div>
                                    <h3>Cải thiện diện mạo</h3>
                                    <p>Cấy mỡ vào các vùng mặt hoặc cơ thể giúp tạo hình hài hòa, tự nhiên và trẻ trung hơn.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6" data-aos="fade-left" data-aos-duration="2000">
                                <div class="col-item">
                                    <div class="cl-img">
                                        <img src="{{ asset('images/dichvu/camnhan_4.png') }}" />
                                    </div>
                                    <h3>Hiệu quả lâu dài</h3>
                                    <p>Các kết quả sau phẫu thuật duy trì lâu dài, bạn sẽ không phải lo lắng về mỡ thừa hay sự biến đổi bất ngờ.</p>
                                </div>
                            </div>
                            <div class="col-12 col-sm-6" data-aos="fade-left" data-aos-duration="3000">
                                <div class="col-item">
                                    <div class="cl-img">
                                        <img src="{{ asset('images/dichvu/camnhan_5.png') }}" />
                                    </div>
                                    <h3>Phục hồi nhanh chóng</h3>
                                    <p>Với các phương pháp hiện đại, thời gian phục hồi nhanh chóng, giúp bạn quay lại với công việc và các hoạt động bình thường.</p>
                                </div>
                            </div>
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
