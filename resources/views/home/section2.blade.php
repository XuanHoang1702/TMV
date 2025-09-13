@php
    use App\Models\HomeSection;
    $homeSection = HomeSection::where('position', '2')->where('is_active', true)->first();
@endphp

@if ($homeSection)



        <div class="col-12 col-sm-7" data-aos="zoom-in" data-aos-duration="3000">
            <div class="cl-desc">
                <h3 class="cl-desc-title">{{ $homeSection->title }}</h3>
                <div>{!! $homeSection->content !!}</div>

                @if ($homeSection->list_items && is_array($homeSection->list_items))
                <hr class="h-hr" />
                <ul class="cl-ul-desc">
                    @foreach ($homeSection->list_items as $item)
                    <li>
                        <div class="dv-li-item">
                            @if (isset($item['icon']) && $item['icon'])
                                <img src="{{ asset('storage/' . $item['icon']) }}" />
                            @endif
                            <div class="dv-li-desc">
                                <h4>{{ $item['title'] ?? '' }}</h4>
                                <p>{{ $item['description'] ?? '' }}</p>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
                @endif

                @include('layouts.booking-button')
            </div>
        </div>

        {{-- Cột hình ảnh --}}
        <div class="col-12 col-sm-5 cl-sec01-desc-img" data-aos="zoom-in" data-aos-duration="3000">
            <div class="row">
                @if ($homeSection->images && is_array($homeSection->images))
                    @foreach ($homeSection->images as $key => $img)
                        @if ($key < 2)
                        <div class="col-12 col-sm-6 mb-2">
                            <img src="{{ asset('storage/' . $img) }}" class="img-fluid" />
                        </div>
                        @endif
                    @endforeach
            </div>
            <div class="row mt-3">
                @if (isset($homeSection->images[2]))
                <div class="col-12 col-sm-12">
                    <img src="{{ asset('storage/' . $homeSection->images[2]) }}" class="img-fluid" />
                </div>
                @endif
            @endif
        </div>


@endif
