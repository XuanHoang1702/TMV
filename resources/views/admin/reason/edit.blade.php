@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Cập nhật Lý do</h1>

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.reason.update', $reason->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Dịch vụ</label>
            <select name="service_id" class="form-control">
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ old('service_id', $reason->service_id) == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label>Thứ tự</label>
            <input type="number" name="order" class="form-control" value="{{ old('order', $reason->order) }}">
        </div>

        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ old('title', $reason->title) }}">
        </div>

        <div class="mb-3">
            <label>Trang</label>
            <input type="text" name="page" class="form-control" value="{{ old('page', $reason->page) }}">
        </div>

        <input type="hidden" name="section" value="lí_do">

        <div class="mb-3">
            <label>Ảnh và thông tin</label>
            @for($i = 0; $i < 4; $i++)
                <div class="image-item mb-3 border p-3">
                    <div class="mb-2">
                        <label>Ảnh hiện tại {{ $i + 1 }}</label><br>
                        @if(isset($reason->processImages[$i]))
                            <img src="{{ asset('storage/' . $reason->processImages[$i]->image) }}" width="120">
                        @endif
                    </div>
                    <div class="mb-2">
                        <label>Ảnh mới {{ $i + 1 }} (nếu muốn thay)</label>
                        <input type="file" name="images[]" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Tiêu đề ảnh</label>
                        <input type="text" name="image_titles[]" class="form-control" value="{{ old('image_titles.' . $i, isset($reason->processImages[$i]) ? $reason->processImages[$i]->title : '') }}">
                    </div>
                    <div class="mb-2">
                        <label>Mô tả</label>
                        <textarea name="image_descriptions[]" class="form-control">{{ old('image_descriptions.' . $i, isset($reason->processImages[$i]) ? $reason->processImages[$i]->description : '') }}</textarea>
                    </div>
                </div>
            @endfor
        </div>

        <button type="submit" class="btn btn-success">Cập nhật</button>
        <a href="{{ route('admin.reason.index') }}" class="btn btn-secondary">Hủy</a>
    </form>
</div>
@endsection
