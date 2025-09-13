<div class="cl-sec02" data-aos="zoom-in" data-aos-duration="3000">
  @if($sec02Banner)
    <div class="cl-sec02" style="background: url('{{ asset('storage/' . $sec02Banner->image_path) }}') center center no-repeat; background-size: cover;">
        <img src="images/home/h_sec_2.png" />
    </div>
    {{-- @else
        <!-- fallback nếu chưa có dữ liệu -->
        <img src="images/home/h_sec_2.png" alt="Banner mặc định"> --}}
    @endif
</div>


