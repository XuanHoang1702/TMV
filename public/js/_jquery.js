window.onscroll = function () {
    var scroll = $(window).scrollTop();
    if (scroll >= 60)
        $("div.cl-header").addClass("body-scrolling");
    else
        $("div.cl-header").removeClass("body-scrolling");
};

function detectDevice() {
    let isMobile = (/iphone|ipad|ipod|android|blackberry|mini|windows\sce|palm/i.test(navigator.userAgent.toLowerCase()));
    if (!isMobile) {
        $("body").addClass("d-Destop");
        $("body").removeClass("d-Mobile");
    }
    else {
        $("body").addClass("d-Mobile");
        $("body").removeClass("d-Destop");
    }
}


function changeTab(e, tabName) {
    //var ulParent = $(e.target).parents("ul.nav-tabs");
    var ulParent = $(e).parents("ul.nav-tabs");
    ulParent.find("li.active").removeClass("active");
    //$(e.target).parents("li").addClass("active");
    $(e).parents("li").addClass("active");
    //remove all active class of tab
    $("#tab-content-detail > div").removeClass("active");
    //add active class to selected tab
    $("#" + tabName).addClass("active");
}

function onChangeTab(el, tabName) {
    $("div.cl-tab-head").find(".cl-tab-head-item").removeClass("active");
    $("div.cl-tab-bodys").find(".cl-content-news").removeClass("active");

    $(el).addClass("active");
    $("#" + tabName).addClass("active");

}

function onOpen_Popup() {
    //booking_Popup
    $("#booking_Popup").modal('show');
}

function onClose_Popup() {
    $("#booking_Popup").modal('hide');
}

function onOpen_Popup2() {
    //booking_Popup
    $("#booking_Popup_TuVan").modal('show');
}
function onClose_Popup2() {
    $("#booking_Popup_TuVan").modal('hide');
}

function onChange_Lang(el) {
    $(el).parent().find("ul.m-ul-sub").toggleClass("active");

    if ($(el).parent().find("ul.m-ul-sub").hasClass("active")) {
        $("body").append("<div class='cl-mask' onclick='onClickBody()'></div>");

        $(el).find("i.fa").removeClass("fa-angle-down");
        $(el).find("i.fa").addClass("fa-angle-up");
    }
    else {
        $("body").find("div.cl-mask").remove();
        $(el).find("i.fa").removeClass("fa-angle-up");
        $(el).find("i.fa").addClass("fa-angle-down");
        
    }

}

function onClickBody() {
    $("ul.m-ul-sub").removeClass("active");   
    $("body").find("div.cl-mask").remove();
    $("ul.ul-lang .li-group a").find("i.fa").removeClass("fa-angle-up");
    $("ul.ul-lang .li-group a").find("i.fa").addClass("fa-angle-down");
}

function onHoverChange_img() {
    $(".m-hover div.it-hover").hover(function () {
       // console.log($(this).data('img'));
        //it-hover
        $(this).parent().find(".it-hover").removeClass("active");
        $(this).addClass("active");
        $("#cc_viewImg").attr('src', $(this).data('img'));
    }, function () {
       // console.log('hover out');
    });
}

function show_hide_ribon(el) {
    $(el).parent("li.cl-group").toggleClass("show-ribon");
    if ($("li.cl-group").hasClass("show-ribon")) {
        $("li.cl-group").find("ul.cl-sub-ribon").slideDown("slow");
    }
    else {
        $("li.cl-group").find("ul.cl-sub-ribon").slideUp("fast");
    }
}
function onShowHide_search(el) {
    $(el).parent("div.head-input-g").toggleClass("active");
}

function show_miniMenu() {
    $("ul.main-menu").toggleClass("mini-show");    
}

$(window).resize(function () {
    detectDevice();
});

$(document).ready(function () {
    //check thiết bị
    detectDevice();
    setTimeout(function () {
        AOS.init();
        //Slide
        $('.nl-sx-slider').slick({
            centerMode: false,
            centerPadding: '50%',
            draggable: true, //Cho phép kéo chuột
            infinite: true, //vòng lặp
            //initialSlide: 0, //thứ tự xuất hiện lần đầu
            vertical: false, //slide đứng hay ngang
            rows: 1,
            slidesToShow: 3,
            slidesToScroll: 1,
            autoplay: false,
            autoplaySpeed: 3000,
            arrows: true,
            prevArrow: ".btn-left",
            nextArrow: ".btn-right",
            //prevArrow: "<a class='prev'><</a>",
            //nextArrow: "<a class='next'>></a>",
            adaptiveHeight: false, //cho phép giãn chiều cao
            dots: true,
            pauseOnHover: false,
            responsive: [{
                breakpoint: 768,
                settings: {
                    slidesToShow: 2
                }
            }, {
                breakpoint: 520,
                settings: {
                    slidesToShow: 1
                }
            }]
        });
        onHoverChange_img();
       
    }, 200);
});