@extends('layouts.auth')

@section('content')
<div class="text-center mb-4">
    <h2 class="h3 mb-3 fw-bold">Đăng nhập Admin Panel</h2>
    <p class="text-muted">Nhập thông tin đăng nhập của bạn</p>
</div>

<form action="{{ route('admin.login.post') }}" method="POST" class="mb-4">
    @csrf

    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" class="form-control @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="mb-3">
        <label for="password" class="form-label">Mật khẩu</label>
        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" required>
        @error('password')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    @if(session('error'))
        <div class="alert alert-danger" role="alert">
            {{ session('error') }}
        </div>
    @endif

    <div class="d-grid">
        <button type="submit" class="btn btn-primary">
            <i class="fas fa-sign-in-alt me-2"></i>Đăng nhập
        </button>
    </div>
</form>

<div class="text-center">
    <a href="{{ route('home') }}" class="text-decoration-none">
        <i class="fas fa-arrow-left me-1"></i>Quay lại trang chủ
    </a>
</div>
@endsection
