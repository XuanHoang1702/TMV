<!-- Booking Popup Component -->
<div id="booking_Popup" class="modal fade cl-bgPop" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog modal-lg" style="max-width: 35%; ">
        <div class="modal-content">
            <div class="modal-header" style="flex-direction:unset;">
                <h5 id="myModalLabel" class="modal-title" style="font-weight:bold">
                    ĐẶT LỊCH HẸN TƯ VẤN THẨM MỸ
                </h5>
                <p>Hãy để chúng tôi giúp bạn trở nên tự tin và rạng rỡ hơn</p>
                <button type="button" class="btn btn-pop" data-bs-dismiss="modal" aria-label="Close"
                    onclick="onClose_Popup()"><i class="fa fa-times"></i></button>
            </div>
            <form action="{{ route('appointments.store') }}" method="POST" class="smart-form">
                @csrf
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <input type="text" name="customer_name" placeholder="Họ & tên" class="ctr-h-input"
                            value="{{ old('customer_name') }}" required />
                        @error('customer_name')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-12">
                        <input type="text" name="customer_phone" placeholder="Số điện thoại" class="ctr-h-input"
                            value="{{ old('customer_phone') }}" required />
                        @error('customer_phone')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-14">
                        <select name="service_id" class="ctr-h-input @error('service_id') is-invalid @enderror"
                            id="service_id">
                            <option value="">Chọn dịch vụ</option>
                            @foreach ($services as $service)
                                <option value="{{ $service->id }}"
                                    {{ old('service_id') == $service->id ? 'selected' : '' }}>
                                    {{ $service->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('service_id')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                </div>
                <div class="row">
                    <div class="col-12 col-sm-6">
                        <input type="time" name="appointment_time" placeholder="Chọn giờ hẹn" class="ctr-h-input"
                            value="{{ old('appointment_time') }}" required />
                        @error('appointment_time')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-12 col-sm-6">
                        <input type="date" name="appointment_date" placeholder="Chọn ngày hẹn" class="ctr-h-input"
                            value="{{ old('appointment_date') }}" required />
                        @error('appointment_date')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <textarea name="notes" rows="3" placeholder="Ghi chú" class="ctr-h-input">{{ old('notes') }}</textarea>
                        @error('notes')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="row">
                    <div class="col-12 col-sm-12">
                        <button type="submit" class="cl-btn-full">
                            <span>Đặt lịch ngay</span>
                            <i class="fa fa-angle-right"></i>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
