@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm Site Info</h1>
    <form action="{{ route('site_info.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Slogan</label>
            <input type="text" name="slogan" class="form-control" value="{{ old('slogan') }}">
            @error('slogan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Logo</label>
            <input type="file" name="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
        <a href="{{ route('site_info.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
