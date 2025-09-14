@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Chỉnh sửa </h1>
    <form action="{{ route('admin.siteInfo.update', $siteInfo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Khẩu hiệu</label>
            <input type="text" name="slogan" class="form-control" value="{{ old('slogan', $siteInfo->slogan) }}">
            @error('slogan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Logo đầu trang hiện tại</label><br>
            @if($siteInfo->header_logo)
                <img src="{{ asset('storage/' . $siteInfo->header_logo) }}" width="100"><br><br>
            @endif
            <label>Chọn logo đầu trang mới</label>
            <input type="file" name="header_logo" class="form-control">
            @error('header_logo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Logo cuối trang hiện tại</label><br>
            @if($siteInfo->footer_logo)
                <img src="{{ asset('storage/' . $siteInfo->footer_logo) }}" width="100"><br><br>
            @endif
            <label>Chọn logo cuối trang mới</label>
            <input type="file" name="footer_logo" class="form-control">
            @error('footer_logo') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.siteInfo.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
