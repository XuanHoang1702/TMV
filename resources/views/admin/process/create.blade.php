@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Thêm mới Quy trình</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.process.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label>Ảnh</label>
            <input type="file" name="image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
        </div>

        <div class="mb-3">
            <label>Nội dung</label>
            <textarea name="content" class="form-control">{{ old('content') }}</textarea>
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('admin.process.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
