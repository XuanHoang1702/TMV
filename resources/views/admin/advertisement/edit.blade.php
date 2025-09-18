@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Sửa quảng cáo</h2>

    <form action="{{ route('admin.advertisement.update', $advertisement->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Dịch vụ</label>
            <select name="service_id" class="form-control">
                @foreach($services as $service)
                    <option value="{{ $service->id }}" {{ $advertisement->service_id == $service->id ? 'selected' : '' }}>{{ $service->name }}</option>
                @endforeach
            </select>
        </div>

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
            <label>Ảnh phụ và thông tin (4 ảnh)</label>
            @for ($i = 0; $i < 4; $i++)
                <div class="border p-3 mb-3">
                    <h5>Ảnh {{ $i + 1 }}</h5>
                    <div class="mb-2">
                        <label>Ảnh hiện tại</label><br>
                        @if(isset($advertisement->sub_images[$i]) && $advertisement->sub_images[$i])
                            <img src="{{ asset('storage/' . $advertisement->sub_images[$i]) }}" width="80" class="mb-2">
                        @endif
                        <input type="file" name="sub_images[]" class="form-control">
                    </div>
                    <div class="mb-2">
                        <label>Tiêu đề</label>
                        <input type="text" name="titles[]" class="form-control" value="{{ $advertisement->titles[$i] ?? '' }}">
                    </div>
                    <div class="mb-2">
                        <label>Nội dung</label>
                        <textarea name="contents[]" class="form-control">{{ $advertisement->contents[$i] ?? '' }}</textarea>
                    </div>
                </div>
            @endfor
        </div>

        <button class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection
