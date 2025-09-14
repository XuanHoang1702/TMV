@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Chỉnh sửa Site Info</h1>
    <form action="{{ route('admin.siteInfo.update', $siteInfo->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Slogan</label>
            <input type="text" name="slogan" class="form-control" value="{{ old('slogan', $siteInfo->slogan) }}">
            @error('slogan') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <div class="mb-3">
            <label>Logo hiện tại</label><br>
            <img src="{{ asset('storage/' . $siteInfo->logo) }}" width="100"><br><br>
            <label>Chọn logo mới</label>
            <input type="file" name="image" class="form-control">
            @error('image') <small class="text-danger">{{ $message }}</small> @enderror
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.siteInfo.index') }}" class="btn btn-secondary">Quay lại</a>
    </form>
</div>
@endsection
