@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Quản lý Quảng cáo</h1>

    <a href="{{ route('admin.advertisement.create') }}" class="btn btn-primary mb-3">Thêm Quảng cáo</a>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Dịch vụ</th>
                <th>Tiêu đề</th>
                <th>Ảnh</th>
                <th>ảnh phụ</th>
                <th>Thứ tự</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            @foreach($advertisements as $advertisement)
            <tr>
                <td>{{ $advertisement->id }}</td>
                <td>{{ $advertisement->service ? $advertisement->service->name : 'Tất cả' }}</td>
                <td>{{ $advertisement->title ?? 'N/A' }}</td>
                <td>
                    @if($advertisement->main_image)
                        <div class="image-container">
                            <img src="{{ asset('storage/' . $advertisement->main_image) }}"
                                 alt="Main Image"
                                 class="img-thumbnail"
                                 style="width: 150px; height: 100px; object-fit: cover; cursor: pointer;"
                                 onclick="showFullImage('{{ asset('storage/' . $advertisement->main_image) }}', 'Main Image')">
                        </div>
                    @else
                        <span class="text-muted">No image</span>
                    @endif
                </td>
                <td>
                    @if($advertisement->sub_images && is_array($advertisement->sub_images))
                        <div class="d-flex flex-wrap gap-2">
                            @foreach($advertisement->sub_images as $index => $subImage)
                                <div class="image-container">
                                    <img src="{{ asset('storage/' . $subImage) }}"
                                         alt="Sub Image {{ $index + 1 }}"
                                         class="img-thumbnail"
                                         style="width: 100px; height: 75px; object-fit: cover; cursor: pointer;"
                                         onclick="showFullImage('{{ asset('storage/' . $subImage) }}', 'Sub Image {{ $index + 1 }}')">
                                </div>
                            @endforeach
                        </div>
                    @else
                        <span class="text-muted">No sub images</span>
                    @endif
                </td>

                <td>{{ $advertisement->order }}</td>
                <td>{{ $advertisement->is_active ? 'Hoạt động' : 'Không hoạt động' }}</td>
                <td>
                    <a href="{{ route('admin.advertisement.edit', $advertisement->id) }}" class="btn btn-warning btn-sm">Sửa</a>
                    <form action="{{ route('admin.advertisement.destroy', $advertisement->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">Xóa</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
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
