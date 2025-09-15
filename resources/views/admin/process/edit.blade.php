@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Cập nhật Quy trình</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.process.update', $process->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Ảnh hiện tại</label><br>
            @if($process->image)
                <img src="{{ asset('storage/' . $process->image) }}" width="120">
            @endif
        </div>

        <div class="mb-3">
            <label>Ảnh mới (nếu muốn thay)</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $process->title) }}">
        </div>

        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="content" class="form-control">{{ old('content', $process->content) }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.process.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
