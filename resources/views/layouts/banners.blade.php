<div class="cl-banner"
     style="background: url('{{ asset('storage/' . $banners->first()->image_path) }}') center center no-repeat; background-size: cover; min-height: 100vh;">
    <div class="container" data-aos="zoom-in" data-aos-duration="3000">
        <div class="row">
            {{-- <div class="col-md-12 ct-banner">
                @if($banners->first()->title)
                    <h2 class="banner-title">{{ $banners->first()->title }}</h2>
                @endif
                @if($banners->first()->link)
                    <a href="{{ $banners->first()->link }}" class="banner-link">Xem thêm</a>
                @endif
            </div> --}}
        </div>
    </div>
</div>
