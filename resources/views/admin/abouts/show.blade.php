@extends('layouts.admin')

@section('title', 'Chi tiết Nội dung Giới thiệu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết Nội dung Giới thiệu: {{ $about->title }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.abouts.edit', $about->id) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Sửa
                        </a>
                        <a href="{{ route('admin.abouts.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-3">
                                <strong>Tiêu đề:</strong>
                                <p>{{ $about->title }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Nội dung:</strong>
                                <div>{!! $about->content !!}</div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <strong>Hình ảnh:</strong>
                                @if($about->image)
                                    <img src="{{ asset('storage/' . $about->image) }}" alt="{{ $about->title }}" class="img-fluid">
                                @else
                                    <p>Không có hình ảnh</p>
                                @endif
                            </div>
                            <div class="mb-3">
                                <strong>Ngày tạo:</strong>
                                <p>{{ $about->created_at->format('d/m/Y H:i') }}</p>
                            </div>
                            <div class="mb-3">
                                <strong>Ngày cập nhật:</strong>
                                <p>{{ $about->updated_at->format('d/m/Y H:i') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
