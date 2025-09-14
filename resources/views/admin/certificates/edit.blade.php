@extends('layouts.admin')

@section('title', 'Chỉnh sửa Chứng chỉ')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chỉnh sửa Chứng chỉ</h3>
                </div>
                <form action="{{ route('admin.certificates.update', $certificate) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="card-body">
                        <div class="form-group">
                            <label for="title">Tiêu đề</label>
                            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $certificate->title) }}" required>
                            @error('title')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="image">Hình ảnh</label>
                            <input type="file" class="form-control" id="image" name="image" accept="image/*">
                            @if($certificate->image_path)
                                <div class="mt-2">
                                    <img src="{{ asset('storage/' . $certificate->image_path) }}" alt="{{ $certificate->title }}" width="100">
                                </div>
                            @endif
                            @error('image')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="description">Mô tả</label>
                            <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $certificate->description) }}</textarea>
                            @error('description')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="order">Thứ tự</label>
                            <input type="number" class="form-control" id="order" name="order" value="{{ old('order', $certificate->order) }}">
                            @error('order')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-primary">Cập nhật</button>
                        <a href="{{ route('admin.certificates.index') }}" class="btn btn-secondary">Hủy</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
