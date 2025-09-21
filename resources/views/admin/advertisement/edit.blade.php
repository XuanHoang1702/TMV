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
            <input type="text" name="page" class="form-control" value="{{ $advertisement->page }}" required placeholder="e.g., home, services, about">
        </div>

        <div class="mb-3">
            <label>Tiêu đề</label>
            <input type="text" name="title" class="form-control" value="{{ $advertisement->title ?? '' }}" placeholder="Tên quảng cáo">
        </div>


        <div class="mb-3">
            <label>Ảnh chính</label><br>
            <div class="mb-2">
                <img src="{{ asset('storage/' . $advertisement->main_image) }}"
                     alt="Current Main Image"
                     class="img-thumbnail"
                     style="width: 200px; height: 150px; object-fit: cover; cursor: pointer;"
                     onclick="showFullImage('{{ asset('storage/' . $advertisement->main_image) }}', 'Current Main Image')">
            </div>
            <input type="file" name="main_image" class="form-control" accept="image/*">
            <div class="form-text">Để trống nếu không muốn thay đổi ảnh. Định dạng: JPEG, PNG, JPG, GIF. Kích thước tối đa: 2MB</div>
        </div>

        <div class="mb-3">
            <label>Ảnh phụ và thông tin (4 ảnh)</label>
            @for ($i = 0; $i < 4; $i++)
                <div class="border p-3 mb-3">
                    <h5>Ảnh {{ $i + 1 }}</h5>
                    <div class="mb-2">
                        <label>Ảnh hiện tại</label><br>
                        @if(isset($advertisement->sub_images[$i]) && $advertisement->sub_images[$i])
                            <img src="{{ asset('storage/' . $advertisement->sub_images[$i]) }}"
                                 alt="Current Sub Image {{ $i + 1 }}"
                                 class="img-thumbnail mb-2"
                                 style="width: 120px; height: 90px; object-fit: cover; cursor: pointer;"
                                 onclick="showFullImage('{{ asset('storage/' . $advertisement->sub_images[$i]) }}', 'Sub Image {{ $i + 1 }}')">
                        @endif
                        <input type="file" name="sub_images[]" class="form-control" accept="image/*">
                        <div class="form-text">Để trống nếu không muốn thay đổi ảnh</div>
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

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1" aria-labelledby="imageModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="imageModalLabel">Full Image View</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Full Image" class="img-fluid" style="max-width: 100%; max-height: 70vh;">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
function showFullImage(imageSrc, imageTitle) {
    document.getElementById('modalImage').src = imageSrc;
    document.getElementById('imageModalLabel').textContent = imageTitle;
    var modal = new bootstrap.Modal(document.getElementById('imageModal'));
    modal.show();
}
</script>

<style>
.image-container {
    position: relative;
    display: inline-block;
}

.image-container:hover::after {
    content: '🔍';
    position: absolute;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    background: rgba(0,0,0,0.7);
    color: white;
    padding: 5px 10px;
    border-radius: 50%;
    font-size: 16px;
    pointer-events: none;
}
</style>
@endsection
