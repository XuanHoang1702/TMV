@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Thêm quảng cáo mới</h2>

    <form action="{{ route('admin.advertisement.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Dịch vụ</label>
            <select name="service_id" class="form-control">
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Page</label>
            <input type="text" name="page" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ảnh chính</label>
            <input type="file" name="main_image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ảnh phụ và thông tin (4 ảnh)</label>
            @for ($i = 0; $i < 4; $i++)
                <div class="border p-3 mb-3">
                    <h5>Ảnh {{ $i + 1 }}</h5>
                    <div class="mb-2">
                        <label>Ảnh</label>
                        <input type="file" name="sub_images[]" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Tiêu đề</label>
                        <input type="text" name="titles[]" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Nội dung</label>
                        <textarea name="contents[]" class="form-control"></textarea>
                    </div>
                </div>
            @endfor
        </div>

        <button class="btn btn-success">Lưu</button>
    </form>
</div>
@endsection
