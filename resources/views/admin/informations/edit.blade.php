@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Chỉnh sửa Thông tin Liên hệ</h1>



    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <form action="{{ route('admin.informations.update', $information->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="form-group mb-3">
            <label for="name">Tên</label>
            <input type="text" name="name" id="name" class="form-control" value="{{ old('name', $information->name) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="address">Địa chỉ</label>
            <input type="text" name="address" id="address" class="form-control" value="{{ old('address', $information->address) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $information->email) }}" required>
        </div>

        <div class="form-group mb-3">
            <label for="hotline">Hotline</label>
            <input type="text" name="hotline" id="hotline" class="form-control" value="{{ old('hotline', $information->hotline) }}">
        </div>

        <div class="form-group mb-3">
            <label for="website">Website</label>
            <input type="url" name="website" id="website" class="form-control" value="{{ old('website', $information->website) }}">
        </div>

        <div class="form-group mb-3">
            <label for="images_address">Ảnh đại diện</label>
            @if($information->images_address)
                <div class="mb-2">
                    <img src="{{ asset('storage/' . $information->images_address) }}" alt="Image" width="150">
                </div>
            @endif
            <input type="file" name="images_address" id="images_address" class="form-control">
        </div>

        @php
            $workingTime = json_decode(old('working_time', $information->working_time), true) ?? [];
        @endphp
        <div class="form-group mb-3">
            <label>Thời gian làm việc</label>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label>Thứ Hai - Thứ Sáu</label>
                    <div class="d-flex gap-2">
                        <input type="time" name="working_time[monday_friday][start]"
                               value="{{ $workingTime['monday_friday']['start'] ?? '' }}"
                               class="form-control">
                        <span class="align-self-center">-</span>
                        <input type="time" name="working_time[monday_friday][end]"
                               value="{{ $workingTime['monday_friday']['end'] ?? '' }}"
                               class="form-control">
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Thứ Bảy</label>
                    <div class="d-flex gap-2">
                        <input type="time" name="working_time[saturday][start]"
                               value="{{ $workingTime['saturday']['start'] ?? '' }}"
                               class="form-control">
                        <span class="align-self-center">-</span>
                        <input type="time" name="working_time[saturday][end]"
                               value="{{ $workingTime['saturday']['end'] ?? '' }}"
                               class="form-control">
                    </div>
                </div>

                <div class="col-md-4 mb-3">
                    <label>Chủ Nhật</label>
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="working_time[sunday_closed]" id="sunday_closed" value="1" {{ (isset($workingTime['sunday']) && $workingTime['sunday'] === 'closed') ? 'checked' : '' }}>
                        <label class="form-check-label" for="sunday_closed">
                            Nghỉ
                        </label>
                    </div>
                    <div class="d-flex gap-2 mt-2" id="sunday_times" style="{{ (isset($workingTime['sunday']) && $workingTime['sunday'] === 'closed') ? 'display:none;' : '' }}">
                        <input type="time" name="working_time[sunday][start]"
                               value="{{ (isset($workingTime['sunday']) && is_array($workingTime['sunday'])) ? $workingTime['sunday']['start'] ?? '' : '' }}"
                               class="form-control">
                        <span class="align-self-center">-</span>
                        <input type="time" name="working_time[sunday][end]"
                               value="{{ (isset($workingTime['sunday']) && is_array($workingTime['sunday'])) ? $workingTime['sunday']['end'] ?? '' : '' }}"
                               class="form-control">
                    </div>
                </div>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>
@endsection
