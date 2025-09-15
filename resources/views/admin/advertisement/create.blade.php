@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Thêm quảng cáo mới</h2>

    <form action="{{ route('admin.advertisement.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Page</label>
            <input type="text" name="page" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ảnh chính</label>
            <input type="file" name="main_image" class="form-control" required>
        </div>

        <div class="mb-3">
            <label>Ảnh phụ (tối đa 4)</label>
            <input type="file" name="sub_images[]" class="form-control" multiple>
        </div>

        <div class="mb-3">
            <label>Tiêu đề (4 cái)</label>
            @for ($i = 0; $i < 4; $i++)
                <input type="text" name="titles[]" class="form-control mb-2">
            @endfor
        </div>

        <div class="mb-3">
            <label>Nội dung (4 cái)</label>
            @for ($i = 0; $i < 4; $i++)
                <textarea name="contents[]" class="form-control mb-2"></textarea>
            @endfor
        </div>

        <button class="btn btn-success">Lưu</button>
    </form>
</div>
@endsection
