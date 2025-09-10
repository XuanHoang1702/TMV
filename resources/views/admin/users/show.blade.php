@extends('layouts.admin')

@section('title', 'Chi tiết người dùng')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 offset-md-2">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Chi tiết người dùng: {{ $user->name }}</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning btn-sm">
                            <i class="fas fa-edit"></i> Chỉnh sửa
                        </a>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-secondary btn-sm">
                            <i class="fas fa-arrow-left"></i> Quay lại
                        </a>
                    </div>
                </div>

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="user-avatar">
                                    <i class="fas fa-user-circle fa-5x text-secondary"></i>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-9">
                            <table class="table table-borderless">
                                <tr>
                                    <th width="150">ID:</th>
                                    <td>{{ $user->id }}</td>
                                </tr>
                                <tr>
                                    <th>Tên:</th>
                                    <td>{{ $user->name }}</td>
                                </tr>
                                <tr>
                                    <th>Email:</th>
                                    <td>{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <th>Vai trò:</th>
                                    <td>
                                        @if($user->role === 'admin')
                                            <span class="badge bg-danger">Admin - Quản trị viên</span>
                                        @elseif($user->role === 'doctor')
                                            <span class="badge bg-info">Bác sĩ - Chuyên gia</span>
                                        @else
                                            <span class="badge bg-secondary">Nhân viên - Hỗ trợ</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Email xác nhận:</th>
                                    <td>
                                        @if($user->email_verified_at)
                                            <span class="badge bg-success">Đã xác nhận</span>
                                            <br><small class="text-muted">{{ $user->email_verified_at->format('d/m/Y H:i') }}</small>
                                        @else
                                            <span class="badge bg-warning">Chưa xác nhận</span>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <th>Ngày tạo:</th>
                                    <td>{{ $user->created_at->format('d/m/Y H:i') }}</td>
                                </tr>
                                <tr>
                                    <th>Cập nhật lần cuối:</th>
                                    <td>{{ $user->updated_at->format('d/m/Y H:i') }}</td>
                                </tr>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="card-footer">
                    <div class="row">
                        <div class="col-md-6">
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                                <i class="fas fa-edit"></i> Chỉnh sửa
                            </a>
                        </div>
                        <div class="col-md-6 text-right">
                            @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" style="display: inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa người dùng này?')">
                                        <i class="fas fa-trash"></i> Xóa người dùng
                                    </button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
