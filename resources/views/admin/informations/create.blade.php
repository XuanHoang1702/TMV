@extends('layouts.admin')

@section('title', 'Thêm mới Liên hệ')

@push('styles')
<!-- Leaflet CSS -->
<link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
      integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

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

    .address-input {
        background: #fff3cd;
        border: 1px solid #ffeaa7;
        border-radius: 0.375rem;
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

    /* Flatpickr custom styles */
    .flatpickr-input {
        background: #fff;
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 0.375rem 0.75rem;
        font-size: 1rem;
        width: 100%;
    }

    .flatpickr-input:focus {
        border-color: #007bff;
        box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
    }

    .flatpickr-calendar {
        border-radius: 0.375rem;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.15);
    }

    .flatpickr-time input {
        color: #495057;
    }

    .flatpickr-time .numInputWrapper:hover {
        background: #e9ecef;
    }

    .flatpickr-time .arrowUp, .flatpickr-time .arrowDown {
        color: #007bff;
    }
</style>
@endpush

@section('content')
<div class="row justify-content-center">
    <div class="col-lg-10">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h3 class="card-title mb-0">📞 Thêm mới Thông tin liên hệ</h3>
                <a href="{{ route('admin.informations.index') }}" class="btn btn-outline-secondary btn-sm">
                    <i class="fas fa-arrow-left me-1"></i>Quay lại
                </a>
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

                <form action="{{ route('admin.informations.store') }}" method="POST" enctype="multipart/form-data" id="contactForm">
                    @csrf

                    <!-- Basic Info -->
                    <div class="row mb-4">
                        <div class="col-md-6 mb-3">
                            <label for="name" class="form-label">🏢 Tên <span class="text-danger">*</span></label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}" placeholder="Tên công ty/đơn vị" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="col-md-6 mb-3">
                            <label for="email" class="form-label">📧 Email <span class="text-danger">*</span></label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email') }}" placeholder="example@company.com" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Address Section -->
                    <div class="mb-4">
                        <label class="form-label">📍 Vị trí & Địa chỉ <span class="text-danger">*</span></label>

                        <!-- Address Input -->
                        <div class="mb-3">
                            <input type="text"
                                   name="address"
                                   id="addressInput"
                                   class="form-control address-input @error('address') is-invalid @enderror"
                                   value="{{ old('address') }}"
                                   placeholder="Nhập địa chỉ để tìm hoặc click vào bản đồ"
                                   required>
                            @error('address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Hidden coordinates -->
                        <input type="hidden" name="latitude" id="latitude" value="{{ old('latitude') }}">
                        <input type="hidden" name="longitude" id="longitude" value="{{ old('longitude') }}">

                        <!-- Location Info -->
                        <div id="locationInfo" class="location-info d-none">
                            <i class="fas fa-map-marker-alt text-success me-2"></i>
                            <div>
                                <strong id="selectedAddress"></strong>
                                <br><small id="selectedCoords" class="text-muted"></small>
                            </div>
                        </div>

                        <!-- Map Container -->
                        <div class="position-relative mb-3">
                            <div id="map" class="w-100"></div>

                            <!-- Search Box -->
                            <div class="search-box">
                                <input type="text" id="searchInput" class="search-input form-control"
                                       placeholder="Tìm địa chỉ... (VD: 435/67 Huỳnh Tấn Phát, Quận 7)">
                            </div>

                            <!-- Controls -->
                            <div class="controls">
                                <button type="button" class="control-btn active" onclick="setMapMode('click')" title="Click để chọn">
                                    <i class="fas fa-mouse-pointer"></i> Click
                                </button>
                                <button type="button" class="control-btn" onclick="searchAddress(document.getElementById('searchInput').value.trim())" title="Tìm kiếm">
                                    <i class="fas fa-search"></i> Tìm
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
                                    <input type="text" name="working_time[monday_friday][open]" class="form-control flatpickr-time"
                                           value="{{ old('working_time.monday_friday.open', '08:00') }}">
                                    <span class="input-group-text">-</span>
                                    <input type="text" name="working_time[monday_friday][close]" class="form-control flatpickr-time"
                                           value="{{ old('working_time.monday_friday.close', '18:00') }}">
                                </div>
                            </div>
                            <div class="hour-item">
                                <div class="hour-title">🗓️ Thứ 7</div>
                                <div class="input-group">
                                    <input type="text" name="working_time[saturday][open]" class="form-control flatpickr-time"
                                           value="{{ old('working_time.saturday.open', '08:00') }}">
                                    <span class="input-group-text">-</span>
                                    <input type="text" name="working_time[saturday][close]" class="form-control flatpickr-time"
                                           value="{{ old('working_time.saturday.close', '12:00') }}">
                                </div>
                            </div>
                            <div class="hour-item">
                                <div class="hour-title">📆 Chủ nhật</div>
                                <input type="text" name="working_time[sunday]" class="form-control"
                                       value="{{ old('working_time.sunday', 'Nghỉ') }}"
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
                                       value="{{ old('hotline') }}" placeholder="0123 456 789">
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
                                       value="{{ old('website') }}" placeholder="https://example.com">
                            </div>
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                  

                    <!-- Form Actions -->
                    <div class="d-flex justify-content-end gap-2">
                        <a href="{{ route('admin.informations.index') }}" class="btn btn-outline-secondary">
                            <i class="fas fa-times me-1"></i>Hủy
                        </a>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-1"></i>💾 Lưu thông tin
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
<!-- Flatpickr JS -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
<script src="https://cdn.jsdelivr.net/npm/flatpickr/dist/l10n/vi.js"></script>

<script>
// Global map object
let map, marker, currentMode = 'click';

// Initialize map
function initMap() {
    // Default to Hanoi if no saved location
    const defaultLat = {{ old('latitude', 21.0285) }};
    const defaultLng = {{ old('longitude', 105.8542) }};
    const savedAddress = "{{ old('address', '') }}";

    // Initialize map
    map = L.map('map', {
        center: [defaultLat, defaultLng],
        zoom: savedAddress ? 16 : 10,
        minZoom: 3,
        maxZoom: 19,
        zoomControl: true
    });

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    // Custom marker icon
    const customIcon = L.divIcon({
        className: 'custom-marker',
        html: '<i class="fas fa-map-marker-alt text-danger" style="font-size: 24px;"></i>',
        iconSize: [30, 30],
        iconAnchor: [15, 30]
    });

    // Add marker
    marker = L.marker([defaultLat, defaultLng], {
        draggable: true,
        icon: customIcon
    }).addTo(map);

    // Set initial values
    document.getElementById('latitude').value = defaultLat.toFixed(6);
    document.getElementById('longitude').value = defaultLng.toFixed(6);
    updateLocationInfo(defaultLat, defaultLng, savedAddress || 'Hồ Chí Minh, Việt Nam');

    // Event listeners
    setupEventListeners();

    // Search functionality
    setupSearch();

    console.log('✅ Leaflet map initialized');
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

    console.log('📍 Location updated:', { lat, lng, address });
}

// Setup event listeners
function setupEventListeners() {
    // Marker drag
    marker.on('dragend', function(e) {
        const lat = e.target.getLatLng().lat;
        const lng = e.target.getLatLng().lng;

        reverseGeocode(lat, lng);
        updateLocationInfo(lat, lng, `Vị trí tùy chỉnh (${lat.toFixed(4)}, ${lng.toFixed(4)})`);
    });

    // Map click
    if (currentMode === 'click') {
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 16);

            reverseGeocode(lat, lng);
            updateLocationInfo(lat, lng, `Vị trí tùy chỉnh (${lat.toFixed(4)}, ${lng.toFixed(4)})`);
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
            updateLocationInfo(lat, lng, address);
            console.log('✅ Reverse geocoded:', address);
        } else {
            console.warn('❌ Reverse geocoding failed');
        }
    })
    .catch(error => {
        console.error('Reverse geocoding error:', error);
    });
}

// Search functionality
function setupSearch() {
    const searchInput = document.getElementById('searchInput');

    searchInput.addEventListener('keypress', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            searchAddress(e.target.value.trim());
        }
    });
}

function searchAddress(query) {
    if (!query) {
        alert('Vui lòng nhập địa chỉ để tìm kiếm!');
        return;
    }

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
            updateLocationInfo(lat, lng, address);

            // Clear search input
            document.getElementById('searchInput').value = '';
            console.log('✅ Search successful:', address);
        } else {
            alert('Không tìm thấy địa chỉ phù hợp!');
            console.warn('❌ No search results found');
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
    const activeBtn = document.querySelector(`.control-btn[onclick*="${mode}"]`) || event.target;
    activeBtn.classList.add('active');

    if (mode === 'click') {
        map.on('click', function(e) {
            const lat = e.latlng.lat;
            const lng = e.latlng.lng;

            marker.setLatLng([lat, lng]);
            map.setView([lat, lng], 16);

            reverseGeocode(lat, lng);
            updateLocationInfo(lat, lng, `Vị trí tùy chỉnh (${lat.toFixed(4)}, ${lng.toFixed(4)})`);
        });
        console.log('🖱️ Click mode enabled');
    } else if (mode === 'search') {
        map.off('click');
        document.getElementById('searchInput').focus();
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
    // Initialize Flatpickr for time inputs
    flatpickr('.flatpickr-time', {
        enableTime: true,
        noCalendar: true,
        dateFormat: 'H:i',
        time_24hr: true,
        locale: 'vi',
        minuteIncrement: 5,
        defaultHour: 8,
        defaultMinute: 0
    });

    const form = document.getElementById('contactForm');

    form.addEventListener('submit', function(e) {
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const lat = document.getElementById('latitude').value;
        const lng = document.getElementById('longitude').value;
        const address = document.getElementById('addressInput').value.trim();

        if (!name) {
            e.preventDefault();
            alert('Vui lòng nhập tên!');
            return false;
        }

        if (!email) {
            e.preventDefault();
            alert('Vui lòng nhập email!');
            return false;
        }

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
                console.log('📁 Selected files:', files.map(f => f.name));
            }
        });
    }

    console.log('✅ Form enhancements loaded');
});

// Initialize map when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    // Small delay to ensure DOM is fully ready
    setTimeout(initMap, 100);
});
</script>
@endpush
