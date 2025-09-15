@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Thêm mới Liên hệ</h1>
    <form action="{{ route('admin.informations.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="name">Tên</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        {{-- Thời gian làm việc --}}
        <div class="form-group">
            <label>Thời gian làm việc</label>

            <div class="mb-3">
                <label>Thứ 2 - Thứ 6</label>
                <div class="d-flex gap-2">
                    <input type="text" name="working_time[monday_friday][open]"
                           class="form-control timepicker" placeholder="08:00 AM">
                    <span class="align-self-center">-</span>
                    <input type="text" name="working_time[monday_friday][close]"
                           class="form-control timepicker" placeholder="06:00 PM">
                </div>
            </div>

            <div class="mb-3">
                <label>Thứ 7</label>
                <div class="d-flex gap-2">
                    <input type="text" name="working_time[saturday][open]"
                           class="form-control timepicker" placeholder="08:00 AM">
                    <span class="align-self-center">-</span>
                    <input type="text" name="working_time[saturday][close]"
                           class="form-control timepicker" placeholder="12:00 PM">
                </div>
            </div>

            <div class="mb-3">
                <label>Chủ nhật</label>
                <input type="text" name="working_time[sunday]"
                       class="form-control" placeholder="Nghỉ">
            </div>
        </div>

        <div class="form-group">
            <label for="images_address">Hình ảnh</label>
            <input type="file" name="images_address" class="form-control" accept="image/*">
        </div>

        <div class="form-group">
            <label for="hotline">Hotline</label>
            <input type="text" name="hotline" class="form-control">
        </div>

        <div class="form-group">
            <label for="website">Website</label>
            <input type="url" name="website" class="form-control">
        </div>

        <button type="submit" class="btn btn-primary">Thêm mới</button>
        <a href="{{ route('admin.informations.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection

@section('scripts')
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script>
    flatpickr(".timepicker", {
        enableTime: true,
        noCalendar: true,
        dateFormat: "h:i K", // Hiển thị dạng 12h kèm AM/PM
        time_24hr: false,
        minuteIncrement: 5 // bước nhảy phút
    });
</script>
@endsection
