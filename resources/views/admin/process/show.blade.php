@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Chi tiết</h1>

    <div class="card">
        <div class="card-body">
            <h3>{{ $process->title }}</h3>
            <p><strong>Dịch vụ:</strong> {{ $process->service ? $process->service->name : 'Không có dịch vụ' }}</p>
            <p><strong>Thứ tự:</strong> {{ $process->order }}</p>
            <p><strong>Trang:</strong> {{ $process->page }}</p>
            <p><strong>Phần:</strong> {{ $process->section == 'quy_trình' ? 'Quy trình' : 'Lí do' }}</p>

            <h4>Ảnh và thông tin</h4>
            @if($process->processImages->isEmpty())
                <p>Không có ảnh nào.</p>
            @else
                @foreach($process->processImages as $image)
                    <div class="mb-3">
                        @if(file_exists(public_path('storage/' . $image->image)))
                            <img src="{{ asset('storage/' . $image->image) }}" class="img-fluid mb-2" style="max-width: 200px;" loading="lazy" alt="{{ $image->title }}">
                        @else
                            <img src="{{ asset('images/fallback.jpg') }}" class="img-fluid mb-2" style="max-width: 200px;" alt="No image available">
                        @endif
                        <h5>{{ $image->title ?? 'Không có tiêu đề' }}</h5>
                        <p>{{ $image->description ?? 'Không có mô tả' }}</p>
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <a href="{{ route('admin.process.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
