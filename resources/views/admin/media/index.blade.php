@extends('layouts.admin')

@section('title', 'Quản lý Media')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Thư viện Media</h1>
        <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#uploadModal">
            <i class="fas fa-upload"></i> Tải lên
        </button>
    </div>



    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        @forelse($media as $item)
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card h-100">
                    <div class="card-body text-center">
                        @if (in_array($item->mime_type, ['image/jpeg', 'image/png', 'image/gif', 'image/webp']))
                            <img src="{{ asset('storage/' . $item->path) }}" class="img-fluid mb-3"
                                style="max-height: 150px;" alt="{{ $item->name }}">
                        @elseif(in_array($item->mime_type, ['video/mp4', 'video/avi', 'video/mov']))
                            <video class="w-100 mb-3" style="max-height: 150px;" controls>
                                <source src="{{ asset('storage/' . $item->path) }}" type="{{ $item->mime_type }}">
                            </video>
                        @else
                            <i class="fas fa-file fa-3x text-secondary mb-3"></i>
                        @endif

                        <h6 class="card-title text-truncate" title="{{ $item->name }}">{{ $item->name }}</h6>
                        <p class="card-text small text-muted">{{ $item->size }} bytes</p>
                        <p class="card-text small text-muted">{{ $item->created_at->format('d/m/Y H:i') }}</p>

                        <div class="btn-group w-100">
                            <a href="{{ asset('storage/' . $item->path) }}" target="_blank" class="btn btn-sm btn-info">
                                <i class="fas fa-eye"></i> Xem
                            </a>
                            <button class="btn btn-sm btn-danger"
                                onclick="deleteMedia({{ $item->id }}, '{{ $item->name }}')">
                                <i class="fas fa-trash"></i> Xóa
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12">
                <div class="text-center py-5">
                    <i class="fas fa-images fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">Chưa có file media nào</h5>
                    <p class="text-muted">Hãy tải lên file đầu tiên của bạn</p>
                </div>
            </div>
        @endforelse
    </div>

    {{ $media->links() }}

    <!-- Upload Modal -->
    <div class="modal fade" id="uploadModal" tabindex="-1" aria-labelledby="uploadModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="uploadModalLabel">Tải lên Media</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.media.upload') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="files" class="form-label">Chọn file</label>
                            <input type="file" class="form-control" id="files" name="files[]" multiple required>
                            <div class="form-text">Bạn có thể chọn nhiều file cùng lúc</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Tải lên</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function deleteMedia(id, name) {
            if (confirm('Bạn có chắc muốn xóa file "' + name + '"?')) {
                const form = document.createElement('form');
                form.method = 'POST';
                form.action = '{{ route('admin.media.destroy', ':id') }}'.replace(':id', id);

                const csrf = document.createElement('input');
                csrf.type = 'hidden';
                csrf.name = '_token';
                csrf.value = '{{ csrf_token() }}';

                const method = document.createElement('input');
                method.type = 'hidden';
                method.name = '_method';
                method.value = 'DELETE';

                form.appendChild(csrf);
                form.appendChild(method);
                document.body.appendChild(form);
                form.submit();
            }
        }
    </script>
@endsection
