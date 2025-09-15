@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Sửa quảng cáo</h2>

    <form action="{{ route('admin.advertisement.update', $advertisement->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Page</label>
            <input type="text" name="page" class="form-control" value="{{ $advertisement->page }}" required>
        </div>

        <div class="mb-3">
            <label>Ảnh chính</label><br>
            <img src="{{ asset('storage/' . $advertisement->main_image) }}" width="120" class="mb-2">
            <input type="file" name="main_image" class="form-control">
        </div>

        <div class="mb-3">
            <label>Ảnh phụ</label><br>
            @foreach($advertisement->sub_images ?? [] as $sub)
                <img src="{{ asset('storage/' . $sub) }}" width="80" class="me-2 mb-2">
            @endforeach
            <input type="file" name="sub_images[]" class="form-control" multiple>
        </div>

        <div class="mb-3">
            <label>Tiêu đề</label>
            @foreach($advertisement->titles ?? [] as $title)
                <input type="text" name="titles[]" class="form-control mb-2" value="{{ $title }}">
            @endforeach
        </div>

        <div class="mb-3">
            <label>Nội dung</label>
            @foreach($advertisement->contents ?? [] as $content)
                <textarea name="contents[]" class="form-control mb-2">{{ $content }}</textarea>
            @endforeach
        </div>

        <button class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
