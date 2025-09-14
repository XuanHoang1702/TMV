@if(isset($certificates) && $certificates->isNotEmpty())
    <section class="cl-sec03-certificate" data-aos="zoom-in" data-aos-duration="3000">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-4">
                    <div class="row m-hover">
                        @foreach($certificates as $index => $certificate)
                            <div class="col-12 col-sm-12 {{ $index == 0 ? 'active' : '' }} it-hover" data-img="{{ $certificate->image_path ? asset('storage/' . $certificate->image_path) : asset('images/home/h_image_sec3_4.png') }}" data-description="{{ $certificate->description ?? '' }}">
                                <a class="cl-btn-full-2" href="#">
                                    <span>{{ $certificate->title ?? 'Chưa có tiêu đề' }}</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
                <div class="col-12 col-sm-8 cl-item-center">
                    <div class="cl-sec03-item">
                        <div class="row">
                            <div class="col-12 col-sm-4 cl-item-center">
                                <img id="cc_viewImg" src="{{ $certificates->first() ? asset('storage/' . $certificates->first()->image_path) : asset('images/home/h_image_sec3_4.png') }}" alt="Certificate Image" />
                            </div>
                            <div class="col-12 col-sm-8 cl-item-center" style="text-align:justify;">
                                <p id="cc_description">
                                    {{ $certificates->first()->description ?? 'Thẩm Mỹ Tận Tâm Dr. Đạt là đội ngũ bác sĩ PTTHTM có chuyên môn vững vàng với chứng chỉ hành nghề chuyên khoa được cấp phép bởi Sở Y Tế TP. HCM.' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const buttons = document.querySelectorAll('.it-hover');
        const viewImg = document.getElementById('cc_viewImg');
        const description = document.getElementById('cc_description');

        if (buttons.length > 0) {
            buttons.forEach(button => {
                button.addEventListener('mouseover', function() {
                    const imgSrc = this.getAttribute('data-img');
                    const desc = this.getAttribute('data-description');
                    if (imgSrc) viewImg.src = imgSrc;
                    if (desc) description.textContent = desc;
                });

                button.addEventListener('click', function() {
                    buttons.forEach(btn => btn.classList.remove('active'));
                    this.classList.add('active');

                    const imgSrc = this.getAttribute('data-img');
                    const desc = this.getAttribute('data-description');
                    if (imgSrc) viewImg.src = imgSrc;
                    if (desc) description.textContent = desc;
                });

                button.addEventListener('mouseout', function() {
                    const activeButton = document.querySelector('.it-hover.active');
                    if (activeButton && activeButton !== this) {
                        const activeImgSrc = activeButton.getAttribute('data-img');
                        const activeDesc = activeButton.getAttribute('data-description');
                        if (activeImgSrc) viewImg.src = activeImgSrc;
                        if (activeDesc) description.textContent = activeDesc;
                    }
                });
            });
        }
    });
    </script>
@else
    <p>Không có chứng chỉ để hiển thị.</p>
@endif
