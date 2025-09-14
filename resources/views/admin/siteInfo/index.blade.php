@extends('layouts.admin')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1>Quản lý Site Info</h1>
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
                            <div class="col-md-6">
                                <h6>Logo</h6>
                                @if($siteInfo->first()->logo)
                                    <img src="{{ asset('storage/' . $siteInfo->first()->logo) }}" class="img-fluid mb-3" style="max-width: 200px;">
                                @else
                                    <p class="text-muted">Chưa có logo</p>
                                @endif
                            </div>
                            <div class="col-md-6">
                                <h6>Slogan</h6>
                                <p class="lead">{{ $siteInfo->first()->slogan ?: 'Chưa có slogan' }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="text-center mt-5">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Chưa có thông tin Site</h5>
                    <p class="card-text">Bạn cần thêm logo và slogan cho website.</p>
                    <a href="{{ route('admin.siteInfo.create') }}" class="btn btn-primary">Thêm ngay</a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
