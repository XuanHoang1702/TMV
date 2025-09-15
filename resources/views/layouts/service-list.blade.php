<div class="cl-h-sec01">
    <div class="container">
        <div class="cl-sec01-cate" data-aos="zoom-in" data-aos-duration="3000">
            <div class="row">
                @foreach ($services as $service)
                    <div class="col-12 col-sm-3">
                        <div class="col-item">
                            <a href="{{ route('services.detail', $service->slug) }}" class="a-cate-item">
                                @if ($service->icon_page_home)
                                    <img src="{{ asset('storage/' . $service->icon_page_home) }}" alt="{{ $service->name }}">
                                @else
                                    <img src="{{ asset('images/home/default_icon.png') }}" alt="{{ $service->name }}">
                                @endif
                                <label>
                                    @if ($service->allow_line_breaks)
                                        {!! str_replace('|', '<br>', $service->name) !!}
                                    @else
                                        {{ $service->name }}
                                    @endif

                                </label>
                            </a>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
