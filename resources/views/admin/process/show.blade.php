@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Chi tiết Quy trình</h1>

    <div class="card">
        <div class="card-body">
            @if($process->image)
                <img src="{{ asset('storage/' . $process->image) }}" width="200" class="mb-3">
            @endif

            <h3>{{ $process->title }}</h3>
            <p>{{ $process->content }}</p>
        </div>
    </div>

    <a href="{{ route('admin.process.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection
