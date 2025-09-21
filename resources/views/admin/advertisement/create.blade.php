@extends('layouts.admin')

@section('content')
<div class="container">
    <h2>Thêm quảng cáo mới</h2>

    <form action="{{ route('admin.advertisement.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label>Dịch vụ</label>
            <select name="service_id" class="form-control">
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
            @error('service_id')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Page</label>
            <input type="text" name="page" class="form-control" required placeholder="e.g., home, services, about">
            @error('page')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

       

        <div class="mb-3">
            <label>Ảnh chính <span class="text-danger">*</span></label>
            <input type="file" name="main_image" class="form-control" accept="image/*" required>
            <div class="form-text">Định dạng: JPEG, PNG, JPG, GIF. Kích thước tối đa: 2MB</div>
            @error('main_image')
                <div class="text-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label>Ảnh phụ và thông tin <span class="text-danger">(Tối đa 4 ảnh)</span></label>
            <div class="form-text text-danger mb-2">Chỉ được phép tải lên tối đa 4 ảnh phụ. Định dạng: JPEG, PNG, JPG, GIF. Kích thước tối đa: 2MB mỗi ảnh.</div>
            @for ($i = 0; $i < 4; $i++)
                <div class="border p-3 mb-3">
                    <h5>Ảnh {{ $i + 1 }}</h5>
                    <div class="mb-2">
                        <label>Ảnh</label>
                        <input type="file" name="sub_images[]" class="form-control sub-image-input" accept="image/*">
                        @error("sub_images.$i")
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label>Tiêu đề</label>
                        <input type="text" name="titles[]" class="form-control">
                        @error("titles.$i")
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label>Nội dung</label>
                        <textarea name="contents[]" class="form-control"></textarea>
                        @error("contents.$i")
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
            @endfor
        </div>

        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const subImageInputs = document.querySelectorAll('.sub-image-input');
        subImageInputs.forEach(input => {
            input.addEventListener('change', function() {
                const totalFiles = Array.from(subImageInputs).reduce((count, input) => {
                    return count + (input.files.length || 0);
                }, 0);
                if (totalFiles > 4) {
                    alert('Bạn chỉ được phép tải lên tối đa 4 ảnh phụ.');
                    input.value = ''; // Reset input
                }
            });
        });
    });
</script>
@endsection
