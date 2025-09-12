<div class="cl-sec01-cate" data-aos="zoom-in" data-aos-duration="3000">
    <div class="row">
        @foreach($categories as $category)
            <div class="col-12 col-sm-3">
                <div class="col-item">
                    <a href="{{ route('services.detail', $category->slug) }}" class="a-cate-item">
                        @if($category->icon)
                            <img src="{{ asset('storage/' . $category->icon) }}" alt="{{ $category->name }}">
                        @else
                            <img src="{{ asset('images/home/default_icon.png') }}" alt="{{ $category->name }}">
                        @endif
                        <label>{{ $category->name }}</label>
                    </a>
                </div>
            </div>
        @endforeach
    </div>
</div>
