@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Chi tiết</h1>

    <div class="card">
        <div class="card-body">
            <h3>{{ $process->title }}</h3>
            <p><strong>Dịch vụ:</strong> {{ $process->service ? $process->service->name : '' }}</p>
            <p><strong>Thứ tự:</strong> {{ $process->order }}</p>
            <p><strong>Trang:</strong> {{ $process->page }}</p>
            <p><strong>Phần:</strong> {{ $process->section == 'quy_trình' ? 'Quy trình' : 'Lí do' }}</p>

            <h4>Ảnh và thông tin</h4>
            @foreach($process->processImages as $image)
                <div class="mb-3">
                    <img src="{{ asset('storage/' . $image->image) }}" width="200" class="mb-2">
                    <h5>{{ $image->title }}</h5>
                    <p>{{ $image->description }}</p>
                </div>
            @endforeach
        </div>
    </div>

    <a href="{{ route('admin.process.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
