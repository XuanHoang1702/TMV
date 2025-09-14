@extends('layouts.admin')

@section('title', 'Chi tiết Chứng chỉ')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết Chứng chỉ</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.certificates.edit', $certificate) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Chỉnh sửa
                        </a>
                        <a href="{{ route('admin.certificates.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-list"></i> Danh sách
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <strong>ID:</strong> {{ $certificate->id }}
                        </div>
                        <div class="col-md-6">
                            <strong>Tiêu đề:</strong> {{ $certificate->title }}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <strong>Thứ tự:</strong> {{ $certificate->order }}
                        </div>
                        <div class="col-md-6">
                            <strong>Ngày tạo:</strong> {{ $certificate->created_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    <div class="row mt-3">
                        <div class="col-md-6">
                            <strong>Ngày cập nhật:</strong> {{ $certificate->updated_at->format('d/m/Y H:i') }}
                        </div>
                    </div>
                    @if($certificate->image_path)
                    <div class="row mt-3">
                        <div class="col-12">
                            <strong>Hình ảnh:</strong><br>
                            <img src="{{ asset('storage/' . $certificate->image_path) }}" alt="{{ $certificate->title }}" class="img-fluid mt-2" style="max-width: 300px;">
                        </div>
                    </div>
                    @endif
                    @if($certificate->description)
                    <div class="row mt-3">
                        <div class="col-12">
                            <strong>Mô tả:</strong><br>
                            <p class="mt-2">{{ $certificate->description }}</p>
                        </div>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
