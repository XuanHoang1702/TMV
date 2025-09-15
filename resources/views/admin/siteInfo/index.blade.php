@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Quản lý Logo và Khẩu hiệu</h1>
        @if($siteInfo->count() == 0)
            <a href="{{ route('admin.siteInfo.create') }}" class="btn btn-primary">Thêm mới</a>
        @else
            <a href="{{ route('admin.siteInfo.edit', $siteInfo->first()->id) }}" class="btn btn-warning">Chỉnh sửa</a>
        @endif
    </div>


    @if($siteInfo->count() > 0)
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Thông tin hiện tại</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Logo đầu trang</h6>
                                @if($siteInfo->first()->header_logo)
                                    <img src="{{ asset('storage/' . $siteInfo->first()->header_logo) }}" class="img-fluid mb-3" style="max-width: 200px;">
                                @else
                                    <p class="text-muted">Chưa có logo đầu trang</p>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <h6>Logo cuối trang</h6>
                                @if($siteInfo->first()->footer_logo)
                                    <img src="{{ asset('storage/' . $siteInfo->first()->footer_logo) }}" class="img-fluid mb-3" style="max-width: 200px;">
                                @else
                                    <p class="text-muted">Chưa có logo cuối trang</p>
                                @endif
                            </div>
                            <div class="col-md-4">
                                <h6>Khẩu hiệu</h6>
                                @if($siteInfo->first()->slogan)
                                    <p class="lead">{{ $siteInfo->first()->slogan }}</p>
                                @else
                                    <p class="text-muted">Chưa có khẩu hiệu</p>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <h6>Các tùy chọn xóa</h6>
                <div class="d-flex gap-2">
                    @if($siteInfo->first()->header_logo)
                        <form action="{{ route('admin.siteInfo.deleteHeaderLogo', $siteInfo->first()->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa logo đầu trang?')">Xóa logo đầu trang</button>
                        </form>
                    @endif
                    @if($siteInfo->first()->footer_logo)
                        <form action="{{ route('admin.siteInfo.deleteFooterLogo', $siteInfo->first()->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa logo cuối trang?')">Xóa logo cuối trang</button>
                        </form>
                    @endif
                    @if($siteInfo->first()->slogan)
                        <form action="{{ route('admin.siteInfo.deleteSlogan', $siteInfo->first()->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa khẩu hiệu?')">Xóa khẩu hiệu</button>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    @else
        <div class="text-center mt-5">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Chưa có thông tin</h5>
                        <p class="card-text">Bạn cần thêm logo đầu trang, logo cuối trang và khẩu hiệu cho website.</p>
                        <a href="{{ route('admin.siteInfo.create') }}" class="btn btn-primary">Thêm ngay</a>
                    </div>
                </div>
        </div>
    @endif
</div>
@endsection
