@extends('layouts.admin')

@section('title', 'Cài đặt Hệ thống')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h1>Cài đặt Hệ thống</h1>
    </div>



    @if (session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Cài đặt Chung</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.update') }}" method="POST">
                        @csrf
                        @method('PATCH')

                        <div class="mb-3">
                            <label for="site_name" class="form-label">Tên Website</label>
                            <input type="text" class="form-control" id="site_name" name="site_name"
                                value="{{ $settings['site_name'] ?? '' }}" required>
                        </div>

                        <div class="mb-3">
                            <label for="site_description" class="form-label">Mô tả Website</label>
                            <textarea class="form-control" id="site_description" name="site_description" rows="3">{{ $settings['site_description'] ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="contact_email" class="form-label">Email Liên hệ</label>
                            <input type="email" class="form-control" id="contact_email" name="contact_email"
                                value="{{ $settings['contact_email'] ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label for="contact_phone" class="form-label">Số điện thoại</label>
                            <input type="text" class="form-control" id="contact_phone" name="contact_phone"
                                value="{{ $settings['contact_phone'] ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label for="address" class="form-label">Địa chỉ</label>
                            <textarea class="form-control" id="address" name="address" rows="3">{{ $settings['address'] ?? '' }}</textarea>
                        </div>

                        <div class="mb-3">
                            <label for="working_hours" class="form-label">Giờ làm việc</label>
                            <input type="text" class="form-control" id="working_hours" name="working_hours"
                                value="{{ $settings['working_hours'] ?? '' }}" placeholder="Ví dụ: 8:00 - 17:00">
                        </div>

                        <div class="mb-3">
                            <label for="facebook_url" class="form-label">Facebook URL</label>
                            <input type="url" class="form-control" id="facebook_url" name="facebook_url"
                                value="{{ $settings['facebook_url'] ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label for="instagram_url" class="form-label">Instagram URL</label>
                            <input type="url" class="form-control" id="instagram_url" name="instagram_url"
                                value="{{ $settings['instagram_url'] ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label for="youtube_url" class="form-label">YouTube URL</label>
                            <input type="url" class="form-control" id="youtube_url" name="youtube_url"
                                value="{{ $settings['youtube_url'] ?? '' }}">
                        </div>

                        <div class="mb-3">
                            <label for="maintenance_mode" class="form-label">Chế độ Bảo trì</label>
                            <select class="form-select" id="maintenance_mode" name="maintenance_mode">
                                <option value="0" {{ ($settings['maintenance_mode'] ?? 0) == 0 ? 'selected' : '' }}>
                                    Tắt</option>
                                <option value="1" {{ ($settings['maintenance_mode'] ?? 0) == 1 ? 'selected' : '' }}>
                                    Bật</option>
                            </select>
                        </div>

                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save"></i> Lưu cài đặt
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Thông tin Hệ thống</h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <strong>Phiên bản Laravel:</strong><br>
                        {{ app()->version() }}
                    </div>
                    <div class="mb-3">
                        <strong>Phiên bản PHP:</strong><br>
                        {{ PHP_VERSION }}
                    </div>
                    <div class="mb-3">
                        <strong>Database:</strong><br>
                        {{ config('database.default') }}
                    </div>
                    <div class="mb-3">
                        <strong>Timezone:</strong><br>
                        {{ config('app.timezone') }}
                    </div>
                    <div class="mb-3">
                        <strong>Locale:</strong><br>
                        {{ config('app.locale') }}
                    </div>
                </div>
            </div>

            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="mb-0">Cache & Optimization</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.settings.clearCache') }}" method="POST" class="mb-3">
                        @csrf
                        <button type="submit" class="btn btn-warning w-100">
                            <i class="fas fa-broom"></i> Xóa Cache
                        </button>
                    </form>

                    <form action="{{ route('admin.settings.optimize') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn btn-success w-100">
                            <i class="fas fa-rocket"></i> Tối ưu hóa
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
