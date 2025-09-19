<!-- HTML MENU -->
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
                        @if ($menuItem['route'] !== 'services.index' && $menuItem['route'] !== 'news.index')
                            <li class="{{ request()->routeIs($menuItem['route']) ? 'active' : '' }}">
                                <a href="{{ route($menuItem['route']) }}"><span>{{ $menuItem['label'] }}</span></a>
                            </li>
                        @endif
                    @endforeach

                    {{-- Dịch vụ --}}
                    @php $serviceMenu = $frontendMenu->firstWhere('route', 'services.index'); @endphp
                    @if ($serviceMenu)
                        <li class="li-group {{ request()->routeIs('services.*') ? 'active' : '' }}">
                            <a href="{{ route('services.index') }}"><span>{{ $serviceMenu['label'] }}</span><i class="fa fa-angle-down"></i></a>
                            <ul class="m-ul-sub">
                                @if (isset($categories))
                                    @foreach ($categories->where('type', 'services')->where('parent_id', null) as $parentCategory)
                                        <li>
                                            <a href="{{ route('services.detail', $parentCategory->slug ?? '#') }}"><span>{{ $parentCategory->name }}</span></a>
                                            @php $childCategories = $categories->where('parent_id', $parentCategory->id); @endphp
                                            @if ($childCategories->count() > 0)
                                                <ul class="m-ul-sub-child">
                                                    @foreach ($childCategories as $childCategory)
                                                        <li>
                                                            <a href="{{ route('services.detail', $childCategory->slug ?? '#') }}"><span>{{ $childCategory->name }}</span></a>
                                                        </li>
                                                    @endforeach
                                                </ul>
                                            @endif
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- Tin tức --}}
                    @php $newsMenu = $frontendMenu->firstWhere('route', 'news.index'); @endphp
                    @if ($newsMenu)
                        <li class="li-group {{ request()->routeIs('news.*') ? 'active' : '' }}">
                            <a href="{{ route('news.index') }}"><span>{{ $newsMenu['label'] }}</span><i class="fa fa-angle-down"></i></a>
                            <ul class="m-ul-sub">
                                @if (isset($categories))
                                    @foreach ($categories->where('type', 'news')->where('parent_id', null) as $category)
                                        <li>
                                            <a href="{{ route('news.category', $category->slug ?? '#') }}"><span>{{ $category->name }}</span></a>
                                        </li>
                                    @endforeach
                                @endif
                            </ul>
                        </li>
                    @endif

                    {{-- Liên hệ --}}
                    @php $contactMenu = $frontendMenu->firstWhere('route', 'contact'); @endphp
                    @if($contactMenu)
                        <li class="{{ request()->routeIs('contact') ? 'active' : '' }}">
                            <a href="{{ route('contact') }}"><span>{{ $contactMenu['label'] }}</span></a>
                        </li>
                    @endif
                </ul>
            </div>
            <div class="col-md-3 col-center-item menu-icon">
                <a class="calendar-check" href="javascript:void(0)" onclick="onOpen_Popup()">
                    <i class="icon-cal"><img src="{{ asset('images/icon/calender_icon.png') }}" /></i>
                    <label>Đặt lịch hẹn</label>
                </a>
                <div class="input-icon">
                    <div class="head-input-g">
                        <input type="text" placeholder="Nhập từ khoá tìm kiếm" class="cl-input-seach" />
                        <i onclick="onShowHide_search(this)" class="fa fa-search" aria-hidden="true"></i>
                    </div>
                </div>
                <ul class="ul-lang ul-icon">
                    <li class="li-group">
                        <a onclick="onChange_Lang(this)">
                            <img class="icon-flag" src="{{ asset('images/icon/Flage_vn.png') }}" />
                            <i class="fa fa-angle-down"></i>
                        </a>
                        <ul class="m-ul-sub" style="width:180px; top:45px; right:0; z-index:10;">
                            <li class="active">
                                <a href="#">
                                    <img class="icon-flag" src="{{ asset('images/icon/icon_flag_vn.png') }}" />
                                    <span>Tiếng Việt</span>
                                    <img class="icon-check" src="{{ asset('images/icon/icon_lang_check.png') }}" />
                                </a>
                            </li>
                            <li>
                                <a href="#">
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

<!-- CSS CHO CLICK TOGGLE -->
<style>
.m-menu .main-menu .m-ul-sub,
.m-menu .main-menu .m-ul-sub-child {
    max-height: 0;
    overflow: hidden;
    transition: max-height 0.5s ease-in-out;
}
.m-menu .main-menu li.open > .m-ul-sub,
.m-menu .main-menu li.open > .m-ul-sub-child {
    max-height: 1000px;
}
.m-menu .main-menu li > a i.fa-angle-down {
    transition: transform 0.3s;
}
.m-menu .main-menu li.open > a i.fa-angle-down {
    transform: rotate(180deg);
}

</style>

<!-- JS CHO CLICK TOGGLE -->
<script>
document.addEventListener('DOMContentLoaded', function() {
    document.querySelectorAll('.main-menu li.li-group > a').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            const parentLi = this.parentElement;
            if(parentLi.classList.contains('open')){
                parentLi.classList.remove('open');
            } else {
                document.querySelectorAll('.main-menu li.li-group').forEach(li => li.classList.remove('open'));
                parentLi.classList.add('open');
            }
        });
    });

    document.querySelectorAll('.m-ul-sub li:has(.m-ul-sub-child) > a').forEach(item => {
        item.addEventListener('click', function(e) {
            e.preventDefault();
            this.parentElement.classList.toggle('open');
        });
    });
});
</script>
