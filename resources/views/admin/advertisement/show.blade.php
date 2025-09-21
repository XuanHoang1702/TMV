@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Chi tiết quảng cáo</h2>

    <p><strong>Page:</strong> {{ $advertisement->page }}</p>

    <p><strong>Ảnh chính:</strong></p>
    <img src="{{ asset('storage/' . $advertisement->main_image) }}" width="200">

    <p class="mt-3"><strong>Ảnh phụ:</strong></p>
    @foreach($advertisement->sub_images ?? [] as $sub)
        <img src="{{ asset('storage/' . $sub) }}" width="100" class="me-2 mb-2">
    @endforeach

    
    <p><strong>Nội dung:</strong></p>
    <ul>
        @foreach($advertisement->contents ?? [] as $content)
            <li>{{ $content }}</li>
        @endforeach
    </ul>

    <a href="{{ route('admin.advertisement.index') }}" class="btn btn-secondary">Quay lại</a>
</div>
@endsection
