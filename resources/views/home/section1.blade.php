@php
    use App\Models\HomeSection;
    $homeSection = HomeSection::where('position', '1')->where('is_active', true)->first();
@endphp

@if($homeSection)
<div class="cl-sec01-desc">
    <div class="row">
        {{-- Cột hình ảnh --}}
        <div class="col-12 col-sm-5 cl-sec01-desc-img" data-aos="zoom-in" data-aos-duration="3000">
            @if($homeSection->images && is_array($homeSection->images))
                <div class="row">
                    @foreach($homeSection->images as $index => $img)
                        @if($index < 2)
                        <div class="col-12 col-sm-6 mb-2">
                            <img src="{{ asset('storage/' . $img) }}" class="img-fluid" alt="Image {{ $index+1 }}">
                        </div>
                        @endif
                    @endforeach
                </div>
                @if(count($homeSection->images) > 2)
                <div class="row mt-2">
                    <div class="col-12">
                        <img src="{{ asset('storage/' . $homeSection->images[2]) }}" class="img-fluid" alt="Image 3">
                    </div>
                </div>
                @endif
            @endif
        </div>

        {{-- Cột nội dung --}}
        <div class="col-12 col-sm-7" data-aos="zoom-in" data-aos-duration="3000">
            <div class="cl-desc">
                <h3 class="cl-desc-title">{{ $homeSection->title }}</h3>
                <div>{!! $homeSection->content !!}</div>

                @if($homeSection->list_items && is_array($homeSection->list_items))
                <hr class="h-hr" />
                <ul class="cl-ul-desc">
                    @foreach($homeSection->list_items as $item)
                    <li>
                        <div class="dv-li-item">
                            @if(isset($item['icon']) && $item['icon'])
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

                @include('layouts.booking.booking-button')
            </div>
        </div>
    </div>
</div>
@endif
