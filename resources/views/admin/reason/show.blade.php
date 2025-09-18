@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Chi tiết Lý do</h1>

    <div class="card">
        <div class="card-body">
            <h3>{{ $reason->title }}</h3>
            <p>{{ $reason->content }}</p>
            <p><strong>Thứ tự:</strong> {{ $reason->order }}</p>
            <p><strong>Trang:</strong> {{ $reason->page }}</p>
            <p><strong>Dịch vụ:</strong> {{ $reason->service ? $reason->service->name : '' }}</p>
            <p><strong>Nơi hiển thị:</strong> {{ $reason->section == 'quy_trình' ? 'Quy trình' : 'Lí do' }}</p>

            @if($reason->processImages->count() > 0)
                <h4>Ảnh:</h4>
                <div class="row">
                    @foreach($reason->processImages as $image)
                        <div class="col-md-3 mb-3">
                            <img src="{{ asset('storage/' . $image->image) }}" width="100%" class="img-thumbnail">
                            <p><strong>Tiêu đề:</strong> {{ $image->title }}</p>
                            <p><strong>Mô tả:</strong> {{ $image->description }}</p>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>

    <a href="{{ route('admin.reason.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
