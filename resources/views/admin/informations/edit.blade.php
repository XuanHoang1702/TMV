@extends('layouts.admin')

@section('title', 'Chỉnh sửa Liên hệ')

@push('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>

<style>
    #map {
        height: 450px;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    .leaflet-container {
        border-radius: 0.375rem;
    }

    .location-info {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 0.75rem;
        margin-top: 0.5rem;
    }

    .saved-location {
        background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
        border: 1px solid #2196f3;
        border-radius: 0.375rem;
        padding: 1rem;
        margin-bottom: 1rem;
    }

    .search-box {
        position: absolute;
        top: 10px;
        left: 50%;
        transform: translateX(-50%);
        z-index: 1000;
        width: 300px;
        max-width: 90%;
    }

    .search-input {
        background: white;
        border: 2px solid #007bff;
        border-radius: 25px;
        padding: 8px 15px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }

    .controls {
        position: absolute;
        top: 10px;
        right: 10px;
        z-index: 1000;
        background: white;
        padding: 10px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        display: flex;
        gap: 5px;
    }

    .control-btn {
        padding: 8px 12px;
        border: 1px solid #dee2e6;
        background: white;
        border-radius: 3px;
        cursor: pointer;
        font-size: 12px;
    }

    .control-btn.active {
        background: #007bff;
        color: white;
        border-color: #007bff;
    }

    .image-preview-container {
        display: flex;
        gap: 0.5rem;
        flex-wrap: wrap;
        margin-bottom: 1rem;
    }

    .image-item {
        position: relative;
        display: inline-block;
    }

    .image-preview {
        width: 80px;
        height: 80px;
        object-fit: cover;
        border-radius: 0.375rem;
        border: 2px solid #dee2e6;
        cursor: pointer;
        transition: all 0.2s ease;
    }

    .image-preview:hover {
        border-color: #007bff;
        transform: scale(1.05);
    }

    .remove-image-btn {
        position: absolute;
        top: -5px;
        right: -5px;
        background: #dc3545;
        color: white;
        border: none;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 10px;
        cursor: pointer;
        opacity: 0;
        transition: opacity 0.2s ease;
        z-index: 10;
    }

    .image-item:hover .remove-image-btn {
        opacity: 1;
    }

    .time-input-group .input-group-text {
        background-color: #f8f9fa;
        border-color: #dee2e6;
        color: #6c757d;
        font-weight: 500;
    }

    .working-hours-grid {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
        gap: 1rem;
    }

    .hour-item {
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 1rem;
    }

    .hour-title {
        font-weight: 600;
        margin-bottom: 0.5rem;
        color: #495057;
    }

    .saved-indicator {
        background: #d4edda;
        color: #155724;
        padding: 0.25rem 0.5rem;
        border-radius: 0.25rem;
        font-size: 0.75rem;
        border: 1px solid #c3e6cb;
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">✏️ Chỉnh sửa Thông tin liên hệ</h3>
                <div>
                    <span class="badge bg-primary me-2">{{ $information->name }}</span>
                    <a href="{{ route('admin.informations.index') }}" class="btn btn-outline-secondary btn-sm">
                        <i class="fas fa-arrow-left me-1"></i>Danh sách
                    </a>
                </div>
            </div>

            <div class="card-body">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('admin.informations.update', $information->id) }}" method="POST" enctype="multipart/form-data" id="contactForm">
                    @csrf
                    @method('PUT')

                    <!-- Basic Info -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">🏢 Tên <span class="text-danger">*</span></label>
                            <input type="text"
                                   name="name"
                                   id="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $information->name) }}"
                                   placeholder="Tên công ty/đơn vị"
                                   required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">📧 Email <span class="text-danger">*</span></label>
                            <input type="email"
                                   name="email"
                                   id="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $information->email) }}"
                                   placeholder="example@company.com"
                                   required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Saved Location Info -->
                    @if($information->latitude && $information->longitude)
                        <div class="saved-location mb-4">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <div class="d-flex align-items-center gap-2">
                                    <i class="fas fa-map-marker-alt text-primary fs-4"></i>
                                    <div>
                                        <h6 class="mb-0 fw-bold text-primary">{{ $information->address ?: 'Vị trí đã lưu' }}</h6>
                                        <small class="text-muted">
                                            📐 Tọa độ: {{ number_format($information->latitude, 6) }}, {{ number_format($information->longitude, 6) }}
                                        </small>
                                    </div>
                                </div>
                                <span class="saved-indicator">
                                    <i class="fas fa-check me-1"></i>Lưu lần trước
                                </span>
                            </div>
                            <small class="text-muted">
                                Bạn có thể thay đổi vị trí bằng cách click hoặc kéo marker trên bản đồ bên dưới
                            </small>
                        </div>
                    @endif

                    <!-- Address & Map Section -->
                    <div class="mb-4">
                        <label class="form-label">📍 Vị trí & Địa chỉ <span class="text-danger">*</span></label>

                        <!-- Address Input -->
                        <div class="mb-3">
                            <input type="text"
                                   name="address"
                                   id="addressInput"
                                   class="form-control @error('address') is-invalid @enderror"
                                   value="{{ old('address', $information->address) }}"
                                   placeholder="Nhập địa chỉ để tìm hoặc click vào bản đồ"
                                   required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Hidden coordinates -->
                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude', $information->latitude) }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude', $information->longitude) }}">

                        <!-- Location Info -->
                        <div id="locationInfo" class="location-info {{ $information->latitude && $information->longitude ? '' : 'd-none' }}">
                            <i class="fas fa-map-marker-alt text-success me-2"></i>
                            <div>
                                <strong id="selectedAddress">{{ $information->address ?: 'Vị trí hiện tại' }}</strong>
                                <br><small id="selectedCoords" class="text-muted">
                                    ({{ number_format($information->latitude ?? 0, 4) }}, {{ number_format($information->longitude ?? 0, 4) }})
                                </small>
                            </div>
                        </div>

                        <!-- Map Container -->
                        <div class="position-relative mb-3">
                            <div id="map" class="w-100"></div>

                            <!-- Search Box -->
                            <div class="search-box">
                                <input type="text" id="searchInput" class="search-input form-control"
                                       placeholder="Tìm địa chỉ mới... (VD: 435/67 Huỳnh Tấn Phát, Quận 7)"
                                       value="{{ old('address', $information->address) }}">
                            </div>

                            <!-- Controls -->
                            <div class="controls">
                                <button type="button" class="control-btn active" onclick="setMapMode('click')" title="Click để chọn">
                                    <i class="fas fa-mouse-pointer"></i> Click
                                </button>
                                <button type="button" class="control-btn" onclick="setMapMode('search')" title="Tìm kiếm">
                                    <i class="fas fa-search"></i> Tìm
                                </button>
                                <button type="button" class="control-btn" onclick="resetToSavedLocation()" title="Vị trí cũ">
                                    <i class="fas fa-history"></i> Lưu cũ
                                </button>
                                <button type="button" class="control-btn" onclick="fitVietnamBounds()" title="Toàn Việt Nam">
                                    <i class="fas fa-expand"></i> VN
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Working Hours -->
                    <div class="mb-4">
                        <h5 class="mb-3"><i class="fas fa-clock me-2 text-primary"></i>⏰ Thời gian làm việc</h5>
                        <div class="working-hours-grid">
                            <div class="hour-item">
                                <div class="hour-title">📅 Thứ 2 - Thứ 6</div>
                                <div class="input-group">
                                    <input type="time" name="working_time[monday_friday][open]" class="form-control"
                                           value="{{ old('working_time.monday_friday.open', $information->working_time['monday_friday']['open'] ?? '08:00') }}">
                                    <span class="input-group-text">-</span>
                                    <input type="time" name="working_time[monday_friday][close]" class="form-control"
                                           value="{{ old('working_time.monday_friday.close', $information->working_time['monday_friday']['close'] ?? '18:00') }}">
                                </div>
                            </div>
                            <div class="hour-item">
                                <div class="hour-title">🗓️ Thứ 7</div>
                                <div class="input-group">
                                    <input type="time" name="working_time[saturday][open]" class="form-control"
                                           value="{{ old('working_time.saturday.open', $information->working_time['saturday']['open'] ?? '08:00') }}">
                                    <span class="input-group-text">-</span>
                                    <input type="time" name="working_time[saturday][close]" class="form-control"
                                           value="{{ old('working_time.saturday.close', $information->working_time['saturday']['close'] ?? '12:00') }}">
                                </div>
                            </div>
                            <div class="hour-item">
                                <div class="hour-title">📆 Chủ nhật</div>
                                <input type="text" name="working_time[sunday]" class="form-control"
                                       value="{{ old('working_time.sunday', $information->working_time['sunday'] ?? 'Nghỉ') }}"
                                       placeholder="Nghỉ hoặc giờ làm việc">
                            </div>
                        </div>
                    </div>

                    <!-- Contact Info -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="hotline" class="form-label">📞 Hotline</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-phone"></i></span>
                                <input type="text" name="hotline" id="hotline" class="form-control @error('hotline') is-invalid @enderror"
                                       value="{{ old('hotline', $information->hotline) }}" placeholder="0123 456 789">
                            </div>
                            @error('hotline')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="website" class="form-label">🌐 Website</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-globe"></i></span>
                                <input type="url" name="website" id="website" class="form-control @error('website') is-invalid @enderror"
                                       value="{{ old('website', $information->website) }}" placeholder="https://example.com">
                            </div>
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Images Section -->
                    <div class="mb-4">
                        <label class="form-label">🖼️ Hình ảnh minh họa</label>

                        <!-- Current Images -->
                        @if(!empty($information->images_address))
                            <div class="mb-3">
                                <label class="form-label small text-muted mb-2">Hình ảnh hiện tại ({{ count($information->images_address) }}):</label>
                                <div class="image-preview-container">
                                    @foreach($information->images_address as $index => $imagePath)
                                        <div class="image-item">
                                            <img src="{{ Storage::url($imagePath) }}"
                                                 alt="Hình ảnh {{ $index + 1 }}"
                                                 class="image-preview"
                                                 onclick="window.open('{{ Storage::url($imagePath) }}', '_blank')">
                                            <button type="button"
                                                    class="remove-image-btn"
                                                    onclick="removeImage({{ $index }}, this)"
                                                    title="Xóa hình ảnh">
                                                <i class="fas fa-times"></i>
                                            </button>
                                            <input type="hidden" name="existing_images[]" value="{{ $imagePath }}">
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        @endif


                    </div>

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.informations.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Hủy
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>💾 Cập nhật thông tin
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js"
        integrity="sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=" crossorigin=""></script>

<script>
// Map configuration from server
const savedLat = {{ $information->latitude ?? 21.0285 }};
const savedLng = {{ $information->longitude ?? 105.8542 }};
const savedAddress = "{{ $information->address ?? '' }}";

// Global map object
let map, marker, currentMode = 'click';


// Reset to saved location
function resetToSavedLocation() {
    if (savedLat && savedLng) {
        map.setView([savedLat, savedLng], 16);
        marker.setLatLng([savedLat, savedLng]);
        updateLocationInfo(savedLat, savedLng, savedAddress || 'Vị trí đã lưu');
        console.log('🔄 Reset to saved location');
    } else {
        alert('Không có vị trí đã lưu!');
    }
}

// Initialize map
function initMap() {
    // Use saved location if available
    const initLat = savedLat && savedLat !== 21.0285 ? savedLat : 21.0285;
    const initLng = savedLng && savedLng !== 105.8542 ? savedLng : 105.8542;
    const initZoom = savedLat ? 16 : 10;

    // Initialize map
    map = L.map('map', {
        center: [initLat, initLng],
        zoom: initZoom,
        minZoom: 3,
        maxZoom: 19,
        zoomControl: true
    });

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    // Custom marker icons
    const savedIcon = L.divIcon({
        className: 'custom-marker saved',
        html: '<i class="fas fa-map-marker-alt text-primary" style="font-size: 24px; opacity: 0.8;" title="Vị trí đã lưu"></i>',
        iconSize: [30, 30],
        iconAnchor: [15, 30]
    });

    const activeIcon = L.divIcon({
        className: 'custom-marker active',
        html: '<i class="fas fa-map-marker-alt text-danger" style="font-size: 24px;"></i>',
        iconSize: [30, 30],
        iconAnchor: [15, 30]
    });

    // Create marker
    marker = L.marker([initLat, initLng], {
        draggable: true,
        icon: savedLat ? savedIcon : activeIcon
    }).addTo(map);

    // Bind popup with saved info
    if (savedAddress) {
        marker.bindPopup(`
            <div class="p-2">
                <strong>${savedAddress}</strong><br>
                <small class="text-muted">Tọa độ: ${savedLat.toFixed(4)}, ${savedLng.toFixed(4)}</small>
            </div>
        `);
    }

    // Set initial values
    document.getElementById('latitude').value = initLat.toFixed(6);
    document.getElementById('longitude').value = initLng.toFixed(6);
    updateLocationInfo(initLat, initLng, savedAddress || 'Vị trí hiện tại');

    // Event listeners
    setupEventListeners();

    // Search functionality
    setupSearch();

    console.log('✅ Edit map initialized at saved location:', { lat: initLat, lng: initLng });
}

// Update location info display
function updateLocationInfo(lat, lng, address) {
    const latField = document.getElementById('latitude');
    const lngField = document.getElementById('longitude');
    const addressField = document.getElementById('addressInput');
    const locationInfo = document.getElementById('locationInfo');
    const selectedAddress = document.getElementById('selectedAddress');
    const selectedCoords = document.getElementById('selectedCoords');

    // Update form fields
    if (latField) latField.value = lat.toFixed(6);
    if (lngField) lngField.value = lng.toFixed(6);
    if (addressField) addressField.value = address;

    // Update display
    if (locationInfo) locationInfo.classList.remove('d-none');
    if (selectedAddress) selectedAddress.textContent = address;
    if (selectedCoords) selectedCoords.textContent = `(${lat.toFixed(4)}, ${lng.toFixed(4)})`;

    // Update marker icon
    const isSavedLocation = Math.abs(lat - savedLat) < 0.0001 && Math.abs(lng - savedLng) < 0.0001;
    marker.setIcon(isSavedLocation ? savedIcon : activeIcon);

    console.log('📍 Location updated:', { lat, lng, address, isSaved: isSavedLocation });
}

// Setup event listeners
function setupEventListeners() {
    // Marker drag
    marker.on('dragend', function(e) {
        const lat = e.target.getLatLng().lat;
        const lng = e.target.getLatLng().lng;

        reverseGeocode(lat, lng);
        updateLocationInfo(lat, lng, `Vị trí mới (${lat.toFixed(4)}, ${lng.toFixed(4)})`);
    });

    // Map click
    if (currentMode === 'click') {
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 16);

            reverseGeocode(lat, lng);
            updateLocationInfo(lat, lng, `Vị trí mới (${lat.toFixed(4)}, ${lng.toFixed(4)})`);
        });
    }
}

// Reverse geocoding using Nominatim
function reverseGeocode(lat, lng) {
    const url = `https://nominatim.openstreetmap.org/reverse?format=json&lat=${lat}&lon=${lng}&zoom=18&addressdetails=1&accept-language=vi`;

    fetch(url, {
        headers: { 'User-Agent': 'LaravelApp/1.0' }
    })
    .then(response => response.json())
    .then(data => {
        if (data && data.display_name) {
            const address = data.display_name;
            // Only update if it's a better address
            const currentAddress = document.getElementById('addressInput').value.trim();
            if (!currentAddress || currentAddress.includes('Vị trí') || currentAddress.includes('tọa độ')) {
                document.getElementById('addressInput').value = address;
            }
            updateLocationInfo(lat, lng, address);
            console.log('✅ Reverse geocoded:', address);
        } else {
            console.warn('❌ Reverse geocoding failed, keeping manual address');
        }
    })
    .catch(error => {
        console.error('Reverse geocoding error:', error);
    });
}

// Search functionality
function setupSearch() {
    const searchInput = document.getElementById('searchInput');
    let searchTimeout;

    searchInput.addEventListener('input', function(e) {
        clearTimeout(searchTimeout);
        const query = e.target.value.trim();

        if (query.length < 3) return;

        searchTimeout = setTimeout(() => {
            searchAddress(query);
        }, 500);
    });

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            clearTimeout(searchTimeout);
            searchAddress(e.target.value.trim());
        }
    });
}

function searchAddress(query) {
    if (!query) return;

    const url = `https://nominatim.openstreetmap.org/search?format=json&q=${encodeURIComponent(query)}&countrycodes=vn&limit=5&addressdetails=1&accept-language=vi`;

    fetch(url, {
        headers: { 'User-Agent': 'LaravelApp/1.0' }
    })
    .then(response => response.json())
    .then(data => {
        if (data && data.length > 0) {
            const result = data[0];
            const lat = parseFloat(result.lat);
            const lng = parseFloat(result.lon);
            const address = result.display_name;

            // Move map to location
            map.setView([lat, lng], 16);
            marker.setLatLng([lat, lng]);

            // Update form
            document.getElementById('addressInput').value = address;
            updateLocationInfo(lat, lng, address);

            // Clear search
            document.getElementById('searchInput').value = '';

            console.log('🔍 Search result:', { lat, lng, address });
        } else {
            alert('Không tìm thấy địa chỉ! Thử tìm kiếm khác.');
        }
    })
    .catch(error => {
        console.error('Search error:', error);
        alert('Lỗi khi tìm kiếm địa chỉ!');
    });
}

// Map mode switching
function setMapMode(mode) {
    currentMode = mode;

    // Update button states
    document.querySelectorAll('.control-btn').forEach(btn => btn.classList.remove('active'));
    event.target.classList.add('active');

    if (mode === 'click') {
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 16);

            reverseGeocode(lat, lng);
            updateLocationInfo(lat, lng, `Vị trí mới (${lat.toFixed(4)}, ${lng.toFixed(4)})`);
        });
        console.log('🖱️ Click mode enabled');
    } else if (mode === 'search') {
        map.off('click');
        document.getElementById('searchInput').focus();
        document.getElementById('searchInput').select();
        console.log('🔍 Search mode enabled');
    }
}

// Fit to Vietnam bounds
function fitVietnamBounds() {
    map.fitBounds([
        [8.15, 102.14],  // Southwest
        [23.39, 109.46]  // Northeast
    ]);
    console.log('🇻🇳 Fitted to Vietnam bounds');
}

// Form validation
document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('contactForm');

    form.addEventListener('submit', function(e) {
        const lat = document.getElementById('latitude').value;
        const lng = document.getElementById('longitude').value;
        const address = document.getElementById('addressInput').value.trim();

        if (!lat || !lng) {
            e.preventDefault();
            alert('Vui lòng chọn vị trí trên bản đồ!');
            return false;
        }

        if (!address) {
            e.preventDefault();
            alert('Vui lòng nhập địa chỉ!');
            return false;
        }

        // Warn if changing from saved location
        if (Math.abs(parseFloat(lat) - savedLat) > 0.001 || Math.abs(parseFloat(lng) - savedLng) > 0.001) {
            if (!confirm('Bạn đang thay đổi vị trí đã lưu. Tiếp tục?')) {
                e.preventDefault();
                return false;
            }
        }

        console.log('✅ Form validation passed');
    });

    // Phone number formatting
    const hotlineInput = document.getElementById('hotline');
    if (hotlineInput) {
        hotlineInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 10) value = value.slice(0, 10);
            e.target.value = value;
        });
    }

    // Website URL formatting
    const websiteInput = document.getElementById('website');
    if (websiteInput) {
        websiteInput.addEventListener('blur', function(e) {
            let value = e.target.value.trim();
            if (value && !value.startsWith('http')) {
                e.target.value = 'https://' + value;
            }
        });
    }

    // File input preview
    const fileInput = document.getElementById('images_address');
    if (fileInput) {
        fileInput.addEventListener('change', function(e) {
            const files = Array.from(e.target.files);
            if (files.length > 0) {
                console.log('📁 New files selected:', files.map(f => f.name));
            }
        });
    }

    // Sync address input with search
    const addressInput = document.getElementById('addressInput');
    if (addressInput) {
        addressInput.addEventListener('input', function(e) {
            document.getElementById('searchInput').value = e.target.value;
        });
    }

    console.log('✅ Edit form enhancements loaded');
});

// Initialize map when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    setTimeout(initMap, 100);
});
</script>
@endpush
