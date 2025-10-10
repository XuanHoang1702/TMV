<div class="m-menu">
    <div class="container">
        <span class="btn-miniMenu" onclick="show_miniMenu()"><i class="fa fa-list"></i></span>
        <div class="row">
            <div class="col-md-1 col-logo">
                <div class="menu-logo">
                    <a href="{{ route('home') }}">
                        @if (!empty($siteInfo?->header_logo))
                            <img src="{{ asset('storage/' . $siteInfo->header_logo) }}" alt="Logo" />
                        @endif
                    </a>
                </div>
            </div>
            <div class="col-md-8 col-center-item">
                <ul class="main-menu">
                    @foreach ($frontendMenu as $menuItem)
                        {{-- Nếu là "Dịch vụ" --}}
                        @if ($menuItem['route'] === 'services.index')
                            <li class="li-group {{ request()->routeIs('services.*') ? 'active' : '' }}">
                                <a href="javascript:void(0)" class="toggle-only">
                                    <span>{{ $menuItem['label'] }}</span><i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="m-ul-sub services-dropdown">
                                    @if (isset($categories))
                                        @foreach ($categories->where('type', 'services')->where('parent_id', null) as $parentCategory)
                                            <li>
                                                <a href="{{ route('services.detail', $parentCategory->slug ?? '#') }}">
                                                    <span>{{ $parentCategory->name }}</span>
                                                </a>
                                                @php $childCategories = $categories->where('parent_id', $parentCategory->id); @endphp
                                                @if ($childCategories->count() > 0)
                                                    <ul class="m-ul-sub-child">
                                                        @foreach ($childCategories as $childCategory)
                                                            <li>
                                                                <a
                                                                    href="{{ route('services.detail', $childCategory->slug ?? '#') }}">
                                                                    <span>{{ $childCategory->name }}</span>
                                                                </a>
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>

                            {{-- Nếu là "Tin tức" --}}
                        @elseif ($menuItem['route'] === 'news.index')
                            <li class="li-group {{ request()->routeIs('news.*') ? 'active' : '' }} news-menu">
                                <a href="{{ route('news.index') }}" class="navigate-link">
                                    <span>{{ $menuItem['label'] }}</span><i class="fa fa-angle-down"></i>
                                </a>
                                <ul class="m-ul-sub news-dropdown">
                                    @if (isset($categories))
                                        @foreach ($categories->where('type', 'news')->where('parent_id', null) as $category)
                                            <li>
                                                <a href="{{ route('news.category', $category->slug ?? '#') }}"
                                                    class="category-link">
                                                    <span>{{ $category->name }}</span>
                                                </a>
                                            </li>
                                        @endforeach
                                    @endif
                                </ul>
                            </li>

                            {{-- Các menu còn lại --}}
                        @else
                            <li class="{{ request()->routeIs($menuItem['route']) ? 'active' : '' }}">
                                <a href="{{ route($menuItem['route']) }}">
                                    <span>{{ $menuItem['label'] }}</span>
                                </a>
                            </li>
                        @endif
                    @endforeach


                </ul>
            </div>
            <div class="col-md-3 col-center-item menu-icon">
                <a class="calendar-check" href="javascript:void(0)" onclick="onOpen_Popup()">
                    <i class="icon-cal"><img src="{{ asset('images/icon/calender_icon.png') }}" /></i>
                    <label>Đặt lịch hẹn</label>
                </a>
                @include('search.menu')
                <ul class="ul-lang ul-icon">
                    <li class="li-group">
                        <a onclick="onChange_Lang(this)">
                            <img class="icon-flag" src="{{ asset('images/icon/Flage_vn.png') }}" />
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="m-ul-sub" style="width:180px; top:45px; right:0; z-index:10;">
                            <li class="active">
                                <a href="javascript:void(0)"
                                    onclick="translateLanguage('vi');changeLanguageUI(this, 'vi')">
                                    <img class="icon-flag" src="{{ asset('images/icon/icon_flag_vn.png') }}" />
                                    <span>Tiếng Việt</span>
                                    <img class="icon-check" src="{{ asset('images/icon/icon_lang_check.png') }}" />
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0)"
                                    onclick="translateLanguage('en'); changeLanguageUI(this, 'en')">
                                    <img class="icon-flag" src="{{ asset('images/icon/icon_flag_en.png') }}" />
                                    <span>Tiếng Anh</span>
                                    <img class="icon-check" src="{{ asset('images/icon/icon_lang_check.png') }}" />
                                </a>
                            </li>
                        </ul>

                    </li>
                </ul>
            </div>
        </div>
    </div>
</div>
<script>
    function changeLanguageUI(el, lang) {
        // Bỏ active tất cả
        $(el).closest("ul").find("li").removeClass("active");

        // Active cái đang chọn
        $(el).parent().addClass("active");

        // Ẩn tất cả dấu tích
        $(el).closest("ul").find(".icon-check").hide();

        // Hiện dấu tích cho cái đang chọn
        $(el).find(".icon-check").show();

        // Đổi cờ trên nút chính
        var selectedFlag = $(el).find(".icon-flag").attr("src");
        var $mainBtn = $(el).closest(".li-group").children("a");
        $mainBtn.find(".icon-flag").attr("src", selectedFlag);

        // Đổi text nút chính (nếu muốn)
        var selectedText = $(el).find("span").text();
        $mainBtn.find("span").text(selectedText);
    }

    window.googleTranslateElementInit = function() {
        new google.translate.TranslateElement({
            pageLanguage: 'vi',
            includedLanguages: 'vi,en',
            autoDisplay: false
        }, 'google_translate_element');
    };

    window.translateLanguage = function(lang) {
        var tries = 0;

        function trySelect() {
            var selectField = document.querySelector(".goog-te-combo");
            if (selectField) {
                selectField.value = lang;
                selectField.dispatchEvent(new Event("change"));
                return;
            }
            tries++;
            if (tries < 25) setTimeout(trySelect, 200);
        }
        trySelect();
    };
</script>

<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
<script>
    // ===== GOOGLE TRANSLATE SETUP =====
    window.googleTranslateElementInit = function() {
        new google.translate.TranslateElement({
            pageLanguage: 'vi',
            includedLanguages: 'vi,en',
            autoDisplay: false
        }, 'google_translate_element');
    };

    // ===== CHỨC NĂNG CHUYỂN NGÔN NGỮ =====
    window.translateLanguage = function(lang) {
        let tries = 0;

        function trySelect() {
            const selectField = document.querySelector(".goog-te-combo");
            if (selectField) {
                selectField.value = lang;
                selectField.dispatchEvent(new Event("change"));
                return;
            }
            tries++;
            if (tries < 25) {
                setTimeout(trySelect, 200);
            } else {
                console.warn("translateLanguage: không tìm thấy .goog-te-combo");
            }
        }

        trySelect();
    };

    // ===== CẬP NHẬT GIAO DIỆN LỰA CHỌN NGÔN NGỮ =====
    function changeLanguageUI(el, lang) {
        // Bỏ active tất cả
        $(el).closest("ul").find("li").removeClass("active");

        // Active cái đang chọn
        $(el).parent().addClass("active");

        // Ẩn tất cả dấu tích
        $(el).closest("ul").find(".icon-check").hide();

        // Hiện dấu tích cho cái đang chọn
        $(el).find(".icon-check").show();

        // Đổi cờ trên nút chính
        const selectedFlag = $(el).find(".icon-flag").attr("src");
        const $mainBtn = $(el).closest(".li-group").children("a");
        $mainBtn.find(".icon-flag").attr("src", selectedFlag);

        // Đổi text nút chính (nếu muốn)
        const selectedText = $(el).find("span").text();
        $mainBtn.find("span").text(selectedText);
    }
</script>

<!-- Google Translate script (bắt buộc async từ Google) -->
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<!-- GOOGLE TRANSLATE HIDDEN SETUP -->
<div id="google_translate_element" style="display:none!important;"></div>

<style>
/* ẨN HOÀN TOÀN GIAO DIỆN GOOGLE DỊCH MẶC ĐỊNH */
body > .skiptranslate,
.goog-logo-link,
.goog-te-gadget span,
.goog-te-banner-frame,
#goog-gt-tt,
.goog-tooltip,
.goog-tooltip:hover,
.goog-text-highlight,
.goog-te-balloon-frame,
div#goog-gt-,
iframe.goog-te-banner-frame {
    display: none !important;
    visibility: hidden !important;
    opacity: 0 !important;
}
.goog-te-gadget {
    color: transparent !important;
    font-size: 0 !important;
}
</style>

<script>
window.googleTranslateElementInit = function () {
    new google.translate.TranslateElement({
        pageLanguage: 'vi', // ngôn ngữ gốc của site
        includedLanguages: 'vi,en', // ngôn ngữ hỗ trợ
        autoDisplay: false
    }, 'google_translate_element');
};

// Hàm đổi ngôn ngữ tự động (chạy khi click flag)
window.translateLanguage = function (lang) {
    let tries = 0;
    function trySelect() {
        const selectField = document.querySelector(".goog-te-combo");
        if (selectField) {
            selectField.value = lang;
            selectField.dispatchEvent(new Event("change"));
            return;
        }
        tries++;
        if (tries < 25) setTimeout(trySelect, 200);
    }
    trySelect();
};
</script>

<!-- Nạp script Google Translate -->
<script src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

