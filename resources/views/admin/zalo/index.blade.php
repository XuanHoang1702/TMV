@extends('layouts.admin')

@section('title', 'Quản lý Liên hệ - Thẩm mỹ Dr.DAT')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <h3 class="card-title">
                            <i class="fas fa-address-book me-2"></i>
                            Quản lý Thông tin Liên hệ
                        </h3>
                    </div>
                    <div class="card-body">
                       

                        <form action="{{ route('admin.zalo.store') }}" method="POST">
                            @csrf

                            <div class="row">
                                <!-- Zalo Section -->
                                <div class="col-md-4">
                                    <div class="card border-primary h-100">
                                        <div class="card-header bg-primary text-white">
                                            <h5 class="mb-0">
                                                <i class="{{ $zalo->zalo_icon }} me-2"></i>
                                                Zalo
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="zalo_type" class="form-label">Loại tài khoản <span class="text-danger">*</span></label>
                                                <select name="zalo_type" id="zalo_type" class="form-select" required>
                                                    <option value="phone" {{ $zalo->zalo_type == 'phone' ? 'selected' : '' }}>
                                                        📱 Số điện thoại
                                                    </option>
                                                    <option value="oa" {{ $zalo->zalo_type == 'oa' ? 'selected' : '' }}>
                                                        🏢 Zalo OA ID
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="zalo_contact" class="form-label">Tài khoản Zalo <span class="text-danger">*</span></label>
                                                <input type="text"
                                                       name="zalo_contact"
                                                       id="zalo_contact"
                                                       class="form-control @error('zalo_contact') is-invalid @enderror"
                                                       value="{{ old('zalo_contact', $zalo->zalo_contact) }}"
                                                       placeholder="Ví dụ: 0367881230 hoặc thammydrhaile"
                                                       required>
                                                @error('zalo_contact')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="zalo_icon" class="form-label">Icon <span class="text-danger">*</span></label>
                                                <input type="text"
                                                       name="zalo_icon"
                                                       id="zalo_icon"
                                                       class="form-control @error('zalo_icon') is-invalid @enderror"
                                                       value="{{ old('zalo_icon', $zalo->zalo_icon) }}"
                                                       placeholder="Ví dụ: fas fa-comment"
                                                       required>
                                                @error('zalo_icon')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">FontAwesome icon class</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">URL hiện tại:</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">https://zalo.me/</span>
                                                    <input type="text" class="form-control bg-light"
                                                           value="{{ $zalo->zalo_contact }}" readonly>
                                                    <button class="btn btn-outline-primary" type="button"
                                                            onclick="testZaloUrl('{{ $zalo->zalo_contact }}')">
                                                        🧪 Test
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Messenger Section -->
                                <div class="col-md-4">
                                    <div class="card border-info h-100">
                                        <div class="card-header bg-info text-white">
                                            <h5 class="mb-0">
                                                <i class="{{ $zalo->messenger_icon }} me-2"></i>
                                                Messenger
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="messenger_type" class="form-label">Loại tài khoản <span class="text-danger">*</span></label>
                                                <select name="messenger_type" id="messenger_type" class="form-select" required>
                                                    <option value="facebook" {{ $zalo->messenger_type == 'facebook' ? 'selected' : '' }}>
                                                        📘 Facebook Messenger
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="messenger_contact" class="form-label">Tài khoản Messenger</label>
                                                <input type="text"
                                                       name="messenger_contact"
                                                       id="messenger_contact"
                                                       class="form-control @error('messenger_contact') is-invalid @enderror"
                                                       value="{{ old('messenger_contact', $zalo->messenger_contact) }}"
                                                       placeholder="Ví dụ: drdatclinic">
                                                @error('messenger_contact')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="messenger_icon" class="form-label">Icon <span class="text-danger">*</span></label>
                                                <input type="text"
                                                       name="messenger_icon"
                                                       id="messenger_icon"
                                                       class="form-control @error('messenger_icon') is-invalid @enderror"
                                                       value="{{ old('messenger_icon', $zalo->messenger_icon) }}"
                                                       placeholder="Ví dụ: fab fa-facebook-messenger"
                                                       required>
                                                @error('messenger_icon')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">FontAwesome icon class</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">URL hiện tại:</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">https://m.me/</span>
                                                    <input type="text" class="form-control bg-light"
                                                           value="{{ $zalo->messenger_contact }}" readonly>
                                                    <button class="btn btn-outline-info" type="button"
                                                            onclick="testMessengerUrl('{{ $zalo->messenger_contact }}')">
                                                        🧪 Test
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Call Section -->
                                <div class="col-md-4">
                                    <div class="card border-success h-100">
                                        <div class="card-header bg-success text-white">
                                            <h5 class="mb-0">
                                                <i class="{{ $zalo->call_icon }} me-2"></i>
                                                Gọi điện
                                            </h5>
                                        </div>
                                        <div class="card-body">
                                            <div class="mb-3">
                                                <label for="call_type" class="form-label">Loại liên hệ <span class="text-danger">*</span></label>
                                                <select name="call_type" id="call_type" class="form-select" required>
                                                    <option value="phone" {{ $zalo->call_type == 'phone' ? 'selected' : '' }}>
                                                        📞 Số điện thoại
                                                    </option>
                                                </select>
                                            </div>

                                            <div class="mb-3">
                                                <label for="call_contact" class="form-label">Số điện thoại</label>
                                                <input type="text"
                                                       name="call_contact"
                                                       id="call_contact"
                                                       class="form-control @error('call_contact') is-invalid @enderror"
                                                       value="{{ old('call_contact', $zalo->call_contact) }}"
                                                       placeholder="Ví dụ: 0367881230">
                                                @error('call_contact')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>

                                            <div class="mb-3">
                                                <label for="call_icon" class="form-label">Icon <span class="text-danger">*</span></label>
                                                <input type="text"
                                                       name="call_icon"
                                                       id="call_icon"
                                                       class="form-control @error('call_icon') is-invalid @enderror"
                                                       value="{{ old('call_icon', $zalo->call_icon) }}"
                                                       placeholder="Ví dụ: fas fa-phone"
                                                       required>
                                                @error('call_icon')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                                <div class="form-text">FontAwesome icon class</div>
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Liên kết hiện tại:</label>
                                                <div class="input-group">
                                                    <span class="input-group-text">tel:</span>
                                                    <input type="text" class="form-control bg-light"
                                                           value="{{ $zalo->call_contact }}" readonly>
                                                    <button class="btn btn-outline-success" type="button"
                                                            onclick="testCallUrl('{{ $zalo->call_contact }}')">
                                                        🧪 Test
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end mt-4">
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-save me-1"></i>
                                    Cập nhật tất cả
                                </button>
                                <a href="{{ route('admin.dashboard') }}" class="btn btn-secondary ms-2">
                                    <i class="fas fa-arrow-left me-1"></i>
                                    Quay lại
                                </a>
                            </div>
                        </form>
                    </div>
                </div>

                <!-- Preview Section -->
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h5 class="mb-0">👁️ Xem trước</h5>
                    </div>
                    <div class="card-body">
                        <div class="row text-center">
                            <div class="col-md-4">
                                <a href="{{ $zalo->zalo_url }}" target="_blank" class="btn btn-outline-primary btn-lg">
                                    <i class="{{ $zalo->zalo_icon }} fa-2x mb-2"></i><br>
                                    <strong>Zalo</strong><br>
                                    <small class="text-muted">{{ $zalo->zalo_contact }}</small>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ $zalo->messenger_url }}" target="_blank" class="btn btn-outline-info btn-lg">
                                    <i class="{{ $zalo->messenger_icon }} fa-2x mb-2"></i><br>
                                    <strong>Messenger</strong><br>
                                    <small class="text-muted">{{ $zalo->messenger_contact ?: 'Chưa thiết lập' }}</small>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ $zalo->call_url }}" class="btn btn-outline-success btn-lg">
                                    <i class="{{ $zalo->call_icon }} fa-2x mb-2"></i><br>
                                    <strong>Gọi điện</strong><br>
                                    <small class="text-muted">{{ $zalo->call_contact ?: 'Chưa thiết lập' }}</small>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Help Section -->
                <div class="card mt-4">
                    <div class="card-header bg-light">
                        <h6 class="mb-0">💡 Hướng dẫn</h6>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <h6>Zalo:</h6>
                                <ul class="small">
                                    <li>Số điện thoại: 0xxxxxxxxx (10 số)</li>
                                    <li>OA ID: chữ và số, không dấu</li>
                                    <li>Mở trực tiếp chat Zalo</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h6>Messenger:</h6>
                                <ul class="small">
                                    <li>Facebook Page username</li>
                                    <li>Ví dụ: drdatclinic</li>
                                    <li>Mở Facebook Messenger</li>
                                </ul>
                            </div>
                            <div class="col-md-4">
                                <h6>Gọi điện:</h6>
                                <ul class="small">
                                    <li>Số điện thoại di động</li>
                                    <li>Định dạng: 0xxxxxxxxx</li>
                                    <li>Gọi trực tiếp từ thiết bị</li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function testZaloUrl(contact) {
            if (!contact) {
                alert('Vui lòng nhập tài khoản Zalo trước');
                return;
            }
            const url = 'https://zalo.me/' + contact;
            window.open(url, '_blank');
        }

        function testMessengerUrl(contact) {
            if (!contact) {
                alert('Vui lòng nhập tài khoản Messenger trước');
                return;
            }
            const url = 'https://m.me/' + contact;
            window.open(url, '_blank');
        }

        function testCallUrl(contact) {
            if (!contact) {
                alert('Vui lòng nhập số điện thoại trước');
                return;
            }
            const url = 'tel:' + contact;
            window.location.href = url;
        }

        // Auto update placeholders
        document.getElementById('zalo_type').addEventListener('change', function() {
            const placeholder = this.value === 'phone' ?
                'Ví dụ: 0367881230' :
                'Ví dụ: thammydrhaile';
            document.getElementById('zalo_contact').placeholder = placeholder;
        });
    </script>
    @endpush
@endsection
