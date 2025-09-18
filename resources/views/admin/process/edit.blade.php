@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Cập nhật</h1>

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
            <label>Dịch vụ</label>
            <select name="service_id" class="form-control">
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id', $process->service_id) == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Thứ tự</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', $process->order) }}">
        </div>

        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $process->title) }}">
        </div>

        <div class="mb-3">
            <label>Trang</label>
            <input type="text" name="page" class="form-control" value="{{ old('page', $process->page) }}">
        </div>

        <div class="mb-3">
            <label>Phần</label>
            <select name="section" class="form-control">
                <option value="quy_trình" {{ old('section', $process->section) == 'quy_trình' ? 'selected' : '' }}>Quy trình</option>
                <option value="lí_do" {{ old('section', $process->section) == 'lí_do' ? 'selected' : '' }}>Lí do</option>
            </select>
        </div>

        <div class="mb-3">
            <label>Ảnh và thông tin</label>
            @for($i = 0; $i < 4; $i++)
                <div class="image-item mb-3 border p-3">
                    <div class="mb-2">
                        <label>Ảnh {{ $i + 1 }}</label>
                        <input type="file" name="images[]" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Tiêu đề ảnh</label>
                        <input type="text" name="image_titles[]" class="form-control" value="{{ old('image_titles.' . $i, $process->processImages[$i]->title ?? '') }}">
                    </div>
                    <div class="mb-2">
                        <label>Mô tả</label>
                        <textarea name="image_descriptions[]" class="form-control">{{ old('image_descriptions.' . $i, $process->processImages[$i]->description ?? '') }}</textarea>
                    </div>
                </div>
            @endfor
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.process.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
