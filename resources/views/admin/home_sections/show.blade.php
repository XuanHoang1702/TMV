@extends('layouts.admin')

@section('title', 'Chi tiết Home Section')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Chi tiết </h1>
    <a href="{{ route('admin.home_sections.index') }}" class="btn btn-secondary">Quay lại</a>
</div>

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Thông tin</h5>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <p><strong>ID:</strong> {{ $homeSection->id }}</p>
                <p><strong>Title:</strong> {{ $homeSection->title }}</p>
                <p><strong>Position:</strong> {{ $homeSection->position }}</p>
                <p><strong>Order:</strong> {{ $homeSection->order }}</p>
                <p><strong>Active:</strong> {{ $homeSection->is_active ? 'Yes' : 'No' }}</p>
            </div>
            <div class="col-md-6">
                <p><strong>Content:</strong></p>
                <p>{{ $homeSection->content }}</p>

                @if($homeSection->list_items)
                    <p><strong>List Items:</strong></p>
                    <ul class="list-unstyled">
                        @foreach($homeSection->list_items as $item)
                            <li class="mb-3">
                                <div class="d-flex align-items-start">
                                    @if(isset($item['icon']) && $item['icon'])
                                        <img src="{{ Storage::url($item['icon']) }}" alt="Icon" style="width: 50px; margin-right: 15px;">
                                    @endif
                                    <div>
                                        <h5>{{ $item['title'] ?? '' }}</h5>
                                        <p class="mb-0">{{ $item['description'] ?? '' }}</p>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    </ul>
                @endif

                @if($homeSection->images)
                    <p><strong>Images:</strong></p>
                    @foreach($homeSection->images as $image)
                        <img src="{{ asset('storage/' . $image) }}" alt="Image" style="width: 100px; margin-right: 10px; margin-bottom: 10px;">
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>
@endsection
