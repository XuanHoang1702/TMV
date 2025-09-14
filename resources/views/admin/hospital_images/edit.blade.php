@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Hospital Image</h1>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('admin.hospital_images.update', $image->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <img src="{{ asset('storage/' . $image->image) }}" alt="Hospital Image" width="200" class="mb-3">
        </div>

        <div class="form-group mb-3">
            <label for="title">Tiêu đề</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $image->title) }}" placeholder="Nhập tiêu đề ảnh">
        </div>

        <div class="form-group mb-3">
            <label for="image">Chọn ảnh mới (nếu muốn thay)</label>
            <input type="file" class="form-control" id="image" name="image">
        </div>

        <button type="submit" class="btn btn-primary">Cập nhật</button>
        <a href="{{ route('admin.hospital_images.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
