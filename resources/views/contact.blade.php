@extends('layouts.app')

@section('title', 'Liên hệ - Thẩm mỹ Dr.DAT')

@section('meta')
    <meta name="description"
        content="Liên hệ với Thẩm mỹ Dr.DAT để được tư vấn và hỗ trợ tốt nhất. Địa chỉ, số điện thoại và email liên hệ.">
    <meta name="keywords" content="liên hệ, thẩm mỹ, Dr.DAT, tư vấn, hỗ trợ, địa chỉ, hotline, email, liên hệ thẩm mỹ Dr.DAT, đặt lịch tư vấn, địa chỉ phòng khám thẩm mỹ, hotline bác sĩ Đạt, email hỗ trợ thẩm mỹ">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta property="og:title" content="Liên hệ - Thẩm mỹ Dr.DAT" />
    <meta property="og:description" content="Liên hệ với Thẩm mỹ Dr.DAT để được tư vấn và hỗ trợ tốt nhất." />
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:image" content="{{ asset('images/logo_Dr_Dat.png') }}" />
    <meta name="twitter:card" content="summary_large_image" />
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ asset('css/lienhe.css') }}">
    {{-- Leaflet CSS --}}
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css"
        integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin="" />
    <link rel="preload" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css" as="style"
        onload="this.onload=null;this.rel='stylesheet'">
    <noscript>
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.9.4/dist/leaflet.css">
    </noscript>

    {{-- Leaflet CSS Override for site.css conflicts --}}
    <style>
    /* Override global img styles for Leaflet map tiles */
    .leaflet-container img {
        max-width: none !important;
        max-height: none !important;
    }

    .leaflet-container img.leaflet-tile {
        max-width: 256px !important;
        max-height: 256px !important;
    }

    /* Ensure map container has proper dimensions */
    .contact-map-container {
        position: relative;
        width: 100%;
        height: 400px;
        border-radius: 0.375rem;
        overflow: hidden;
        box-shadow: 0 2px 8px rgba(0,0,0,0.1);
    }

    #map {
        width: 100%;
        height: 100%;
        z-index: 1;
    }

    /* Loading overlay */
    .map-loading-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: rgba(255, 255, 255, 0.9);
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        z-index: 1000;
    }

    .map-loading-spinner {
        width: 40px;
        height: 40px;
        border: 4px solid #f3f3f3;
        border-top: 4px solid #007bff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
        margin-bottom: 10px;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }

    /* Fallback image */
    .fallback-contact-image {
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        object-fit: cover;
        z-index: 0;
        display: none;
    }

    /* Responsive adjustments */
    @media (max-width: 768px) {
        .contact-map-container {
            height: 300px;
        }

        .map-loading-spinner {
            width: 30px;
            height: 30px;
        }
    }
    </style>

@endsection

@section('content')
    <div class="cl-body-bg">
        <div class="container">
            <!-- Banner -->
            @if ($contactBanner)
                <div class="cl-jCenter">
                    <div class="row cl-sec01" data-aos="zoom-in" data-aos-duration="3000">
                        <div class="col-12 col-sm-12">
                            <h4 class="cl-title">{{ $contactBanner->title }}</h4>
                        </div>
                        <div class="col-12 col-sm-12 cl-desc">
                            <p class="ab-banner-desc">{!! nl2br(e($contactBanner->content)) !!}</p>
                        </div>
                    </div>
                </div>
            @endif

            <!-- Contact Map & Info - GIỮ NGUYÊN GIAO DIỆN -->
            <div class="cl-panel-list">
                <div class="cl-panel-body">
                    <div class="row">
                        {{-- THAY ĐỔI ID từ "contactMap" thành "map" --}}
                        <div class="col-12 col-sm-6 position-relative">
                            <div class="contact-map-container">
                                {{-- Interactive Map --}}
                                <div id="map"></div> {{-- ← ĐỔI THÀNH "map" như edit page --}}

                                {{-- Loading Overlay --}}
                                <div id="mapLoading" class="map-loading-overlay">
                                    <div class="map-loading-spinner"></div>
                                    <div class="text-muted small">Đang tải bản đồ vị trí...</div>
                                </div>

                                {{-- Fallback Image --}}
                                <img src="{{ asset('images/lienhe/lien_he_map.png') }}"
                                    alt="Bản đồ liên hệ Thẩm mỹ Dr.DAT" class="fallback-contact-image"
                                    id="fallbackContactImage">
                            </div>
                        </div>

                        {{-- GIỮ NGUYÊN PHẦN INFO --}}
                        <div class="col-12 col-sm-6 cl-ct-info" data-aos="fade-left" data-aos-duration="3000">
                            <div class="cl-info">
                                @if ($information)
                                    <h4>{{ $information->name }}</h4>

                                    @if ($information->hotline)
                                        <p><i class="fa fa-phone"></i> Hotline: <b>{{ $information->hotline }}</b></p>
                                    @endif

                                    @if ($information->address)
                                        <p><i class="fa fa-map-marker"></i> Địa chỉ: <b>{{ $information->address }}</b></p>
                                    @endif

                                    @if ($information->working_time)
                                        @php $workingTime = json_decode($information->working_time, true); @endphp
                                        <p><i class="fa fa-clock-o"></i> Thời gian làm việc:</p>
                                        <ul class="ul-info">
                                            @if (isset($workingTime['monday_friday']))
                                                <li>
                                                    <span>Thứ Hai - Thứ Sáu:</span>
                                                    <b>{{ $workingTime['monday_friday']['open'] ?? '' }} -
                                                        {{ $workingTime['monday_friday']['close'] ?? '' }}</b>
                                                </li>
                                            @endif
                                            @if (isset($workingTime['saturday']))
                                                <li>
                                                    <span>Thứ Bảy:</span>
                                                    <b>{{ $workingTime['saturday']['open'] ?? '' }} -
                                                        {{ $workingTime['saturday']['close'] ?? '' }}</b>
                                                </li>
                                            @endif
                                            <li>
                                                <span>Chủ Nhật:</span>
                                                <b>
                                                    {{ $workingTime['sunday'] ?? 'Nghỉ' }}
                                                </b>
                                            </li>
                                        </ul>
                                    @endif

                                    @if ($information->email)
                                        <p><i class="fa fa-envelope-o"></i> Email: {{ $information->email }}</p>
                                    @endif

                                    @if ($information->website)
                                        <p><i class="fa fa-globe"></i> Website: {{ $information->website }}</p>
                                    @endif
                                @else
                                    <div class="text-center py-4">
                                        <i class="fas fa-info-circle fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Thông tin liên hệ</h5>
                                        <p class="text-muted">Sẽ được cập nhật sớm</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Hospital Images - GIỮ NGUYÊN -->
            @if (isset($hospitalImages) && $hospitalImages->count() > 0)
                <div class="cl-panel-list">
                    <div class="cl-panel-body">
                        <div class="row">
                            <div class="col-12 col-sm-12 cl-info">
                                <h4>{{ $hospitalImages->first()->title ?? 'Hình ảnh cơ sở' }}</h4>
                            </div>
                        </div>

                        <div class="row">
                            @foreach ($hospitalImages->take(2) as $image)
                                <div class="col-12 col-sm-6" data-aos="zoom-in">
                                    <img src="{{ asset('storage/' . $image->image) }}" />
                                </div>
                            @endforeach
                        </div>
                        <div class="row" style="margin-top:25px;">
                            @foreach ($hospitalImages->skip(2)->take(3) as $image)
                                <div class="col-12 col-sm-4" data-aos="zoom-in">
                                    <img src="{{ asset('storage/' . $image->image) }}" />
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endif
        </div>
        <!-- Booking Popup - GIỮ NGUYÊN -->
        @include('layouts.booking.booking_Popup_DatLichKham')
    </div>
    </div>
@endsection

@section('scripts')
<!-- Leaflet JS with error handling -->
<script>
    // Load Leaflet with error handling
    const script = document.createElement('script');
    script.src = 'https://unpkg.com/leaflet@1.9.4/dist/leaflet.js';
    script.integrity = 'sha256-20nQCchB9co0qIjJZRGuk2/Z9VM+kNiyxNV1lvTlZBo=';
    script.crossOrigin = '';

    script.onload = function() {
        console.log('✅ Leaflet loaded successfully');
        initializeMap();
    };

    script.onerror = function() {
        console.error('❌ Failed to load Leaflet library');
        handleMapError();
    };

    document.head.appendChild(script);
</script>

<script>
// Map configuration from server - Fixed null safety
const savedLat = {{ $information && $information->latitude ? $information->latitude : 21.0285 }};
const savedLng = {{ $information && $information->longitude ? $information->longitude : 105.8542 }};
const savedAddress = "{{ $information && $information->address ? $information->address : 'Thẩm mỹ Dr.DAT' }}";

// Initialize contact map
function initializeMap() {
    console.log('Initializing map with coordinates:', { lat: savedLat, lng: savedLng, address: savedAddress });

    // Use saved location if available
    const initLat = savedLat && savedLat !== 21.0285 ? savedLat : 21.0285;
    const initLng = savedLng && savedLng !== 105.8542 ? savedLng : 105.8542;
    const initZoom = savedLat ? 16 : 10;

    console.log('Final map coordinates:', { lat: initLat, lng: initLng, zoom: initZoom });

    // Initialize map
    const map = L.map('map', {
        center: [initLat, initLng],
        zoom: initZoom,
        minZoom: 3,
        maxZoom: 19,
        zoomControl: true,
        dragging: true,
        scrollWheelZoom: true,
        doubleClickZoom: true,
        boxZoom: true
    });

    console.log('Map object created:', map);

    // Add OpenStreetMap tiles
    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors',
        maxZoom: 19
    }).addTo(map);

    console.log('Tile layer added to map');

    // Custom marker icon
    const customIcon = L.divIcon({
        className: 'custom-marker',
        html: '<i class="fas fa-map-marker-alt text-primary" style="font-size: 32px; color: #007bff;"></i>',
        iconSize: [40, 40],
        iconAnchor: [20, 40]
    });

    // Create marker at saved location
    const marker = L.marker([initLat, initLng], {
        icon: customIcon
    }).addTo(map);

    console.log('Marker added to map');

    // Add popup with location info
    marker.bindPopup(`
        <div class="p-2 text-center">
            <strong class="text-primary">${savedAddress}</strong><br>
            <small class="text-muted">
                <i class="fas fa-map-marker-alt me-1"></i>
                ${initLat.toFixed(4)}, ${initLng.toFixed(4)}
            </small><br>
            <a href="https://www.google.com/maps/dir/?api=1&destination=${initLat},${initLng}"
               target="_blank"
               class="btn btn-sm btn-primary mt-2">
                <i class="fas fa-directions me-1"></i>Chỉ đường
            </a>
        </div>
    `);

    // Hide loading overlay
    const loadingOverlay = document.getElementById('mapLoading');
    if (loadingOverlay) {
        loadingOverlay.style.display = 'none';
    }

    console.log('✅ Contact map initialized at:', { lat: initLat, lng: initLng, address: savedAddress });

    return map;
}

// Handle map loading errors
function handleMapError() {
    console.log('Handling map error - showing fallback');

    const loadingOverlay = document.getElementById('mapLoading');
    const fallbackImage = document.getElementById('fallbackContactImage');

    if (loadingOverlay) {
        loadingOverlay.innerHTML = `
            <div class="text-danger">
                <i class="fas fa-exclamation-triangle fa-2x mb-2"></i><br>
                Không thể tải bản đồ<br>
                <small>Hiển thị hình ảnh bản đồ tĩnh</small>
            </div>
        `;
    }

    if (fallbackImage) {
        fallbackImage.style.display = 'block';
    }

    console.warn('❌ Map loading failed, showing fallback image');
}

// Initialize map when DOM is ready
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM Content Loaded - Starting map initialization');

    // Check if Leaflet is loaded
    if (typeof L === 'undefined') {
        console.log('Leaflet not loaded yet, waiting...');
        // Wait a bit and check again
        setTimeout(() => {
            if (typeof L === 'undefined') {
                console.error('Leaflet library not loaded after waiting!');
                handleMapError();
            } else {
                console.log('Leaflet loaded after waiting, initializing map...');
                initializeMap();
            }
        }, 1000);
        return;
    }

    console.log('Leaflet loaded successfully');

    // Check if map container exists
    const mapContainer = document.getElementById('map');
    if (!mapContainer) {
        console.error('Map container not found!');
        handleMapError();
        return;
    }

    console.log('Map container found, initializing map...');

    // Add delay to ensure CSS is loaded
    setTimeout(() => {
        try {
            const map = initializeMap();
            console.log('Map initialized successfully:', map);

            // Add resize listener for responsive behavior
            window.addEventListener('resize', function() {
                map.invalidateSize();
            });

        } catch (error) {
            console.error('Map initialization error:', error);
            handleMapError();
        }
    }, 500);
});

// Handle window resize for map responsiveness
window.addEventListener('load', function() {
    setTimeout(() => {
        const mapElement = document.getElementById('map');
        if (mapElement && window.map) {
            window.map.invalidateSize();
        }
    }, 100);
});
</script>
@endsection
