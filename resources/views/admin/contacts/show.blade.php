@extends('layouts.admin')

@section('title', 'Chi tiết Liên hệ')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Chi tiết Liên hệ</h1>
        <a href="{{ route('admin.contacts.index') }}" class="btn btn-secondary">
            <i class="fas fa-arrow-left"></i> Quay lại
        </a>
    </div>



    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin Liên hệ</h5>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Tên:</strong></div>
                        <div class="col-sm-9">{{ $contact->name }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Email:</strong></div>
                        <div class="col-sm-9">{{ $contact->email }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Số điện thoại:</strong></div>
                        <div class="col-sm-9">{{ $contact->phone }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Chủ đề:</strong></div>
                        <div class="col-sm-9">{{ $contact->subject }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Nội dung:</strong></div>
                        <div class="col-sm-9">{{ $contact->message }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Ngày tạo:</strong></div>
                        <div class="col-sm-9">{{ $contact->created_at->format('d/m/Y H:i') }}</div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-3"><strong>Trạng thái:</strong></div>
                        <div class="col-sm-9">
                            @if ($contact->is_read)
                                <span class="badge bg-success">Đã đọc</span>
                            @else
                                <span class="badge bg-warning">Chưa đọc</span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Hành động</h5>
                </div>
                <div class="card-body">
                    @if (!$contact->is_read)
                        <form action="{{ route('admin.contacts.markAsRead', $contact) }}" method="POST" class="mb-3">
                            @csrf
                            @method('PATCH')
                            <button class="btn btn-success w-100">
                                <i class="fas fa-check"></i> Đánh dấu đã đọc
                            </button>
                        </form>
                    @endif

                    <button class="btn btn-primary w-100 mb-3" data-bs-toggle="modal" data-bs-target="#replyModal">
                        <i class="fas fa-reply"></i> Trả lời
                    </button>

                    <form action="{{ route('admin.contacts.destroy', $contact) }}" method="POST"
                        onsubmit="return confirm('Bạn có chắc muốn xóa liên hệ này?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger w-100">
                            <i class="fas fa-trash"></i> Xóa
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Reply Modal -->
    <div class="modal fade" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="replyModalLabel">Trả lời Liên hệ</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{ route('admin.contacts.reply', $contact) }}" method="POST">
                    @csrf
                    <div class="modal-body">
                        <div class="mb-3">
                            <label for="subject" class="form-label">Chủ đề</label>
                            <input type="text" class="form-control" id="subject" name="subject"
                                value="Re: {{ $contact->subject }}" required>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Nội dung</label>
                            <textarea class="form-control" id="message" name="message" rows="10" required></textarea>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                        <button type="submit" class="btn btn-primary">Gửi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection
