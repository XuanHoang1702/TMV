@extends('layouts.admin')

@section('title', 'Quản lý Liên hệ')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Danh sách Liên hệ</h1>
    </div>



    <div class="card">
        <div class="card-header">
            <h5 class="mb-0">Liên hệ</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Tên</th>
                            <th>Email</th>
                            <th>Số điện thoại</th>
                            <th>Chủ đề</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Hành động</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($contacts as $contact)
                            <tr>
                                <td>{{ $contact->id }}</td>
                                <td>{{ $contact->name }}</td>
                                <td>{{ $contact->email }}</td>
                                <td>{{ $contact->phone }}</td>
                                <td>{{ $contact->subject }}</td>
                                <td>
                                    @if ($contact->is_read)
                                        <span class="badge bg-success">Đã đọc</span>
                                    @else
                                        <span class="badge bg-warning">Chưa đọc</span>
                                    @endif
                                </td>
                                <td>{{ $contact->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <a href="{{ route('admin.contacts.show', $contact) }}" class="btn btn-sm btn-info">
                                        <i class="fas fa-eye"></i> Xem
                                    </a>
                                    @if (!$contact->is_read)
                                        <form action="{{ route('admin.contacts.markAsRead', $contact) }}" method="POST"
                                            class="d-inline">
                                            @csrf
                                            @method('PATCH')
                                            <button class="btn btn-sm btn-success">
                                                <i class="fas fa-check"></i> Đánh dấu đã đọc
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" class="text-center">Không có liên hệ nào.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{ $contacts->links() }}
        </div>
    </div>
@endsection
