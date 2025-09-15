@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Thêm Site Info</h1>
        <a href="{{ route('admin.siteInfo.index') }}" class="btn btn-secondary">Quay lại</a>
    </div>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Thông tin mới</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.siteInfo.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="header_logo" class="form-label">Logo đầu trang</label>
                            <input type="file" name="header_logo" id="header_logo" class="form-control" accept="image/*">
                            <div class="form-text">Chọn file ảnh cho logo đầu trang (JPEG, PNG, JPG, GIF, SVG, tối đa 2MB)</div>
                            @error('header_logo') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="footer_logo" class="form-label">Logo cuối trang</label>
                            <input type="file" name="footer_logo" id="footer_logo" class="form-control" accept="image/*">
                            <div class="form-text">Chọn file ảnh cho logo cuối trang(JPEG, PNG, JPG, GIF, SVG, tối đa 2MB)</div>
                            @error('footer_logo') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="mb-3">
                            <label for="slogan" class="form-label">Khẩu hiệu <span class="text-danger">*</span></label>
                            <input type="text" name="slogan" id="slogan" class="form-control" value="{{ old('slogan') }}" placeholder="Nhập khẩu hiệu cho website">
                            @error('slogan') <small class="text-danger">{{ $message }}</small> @enderror
                        </div>

                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-success">Thêm mới</button>
                            <a href="{{ route('admin.siteInfo.index') }}" class="btn btn-secondary">Hủy</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
