@extends('layouts.app')

@section('title', 'Liên hệ - Thẩm mỹ Dr.DAT')

@section('meta')
    <meta name="description"
        content="Liên hệ với Thẩm mỹ Dr.DAT để được tư vấn và hỗ trợ tốt nhất. Địa chỉ, số điện thoại và email liên hệ.">
    <meta name="keywords" content="liên hệ, thẩm mỹ, Dr.DAT, tư vấn, hỗ trợ, địa chỉ, hotline, email">
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
          integrity="sha256-p4NxAoJBhIIN+hmNHrzRCf9tD/miZyoHS5obTRR9BMY=" crossorigin=""/>
    <style>
        /* Contact Map Styles - Giữ nguyên layout */
        .contact-map-container {
            position: relative;
            height: 450px; /* Giữ nguyên height như image cũ */
            border-radius: 0.375rem;
            overflow: hidden;
            box-shadow: 0 2px 8px rgba(0,0,0,0.1);
        }

        #contactMap {
            width: 100%;
            height: 100%;
            border-radius: 0.375rem;
        }

        .leaflet-container {
            border-radius: 0.375rem;
        }

        /* Map marker styles */
        .drdat-marker {
            z-index: 1000;
        }

        .drdat-marker i {
            text-shadow: 0 1px 3px rgba(0,0,0,0.4);
            filter: drop-shadow(0 1px 2px rgba(255,0,0,0.3));
        }

        /* Loading overlay */
        .map-loading-overlay {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(255,255,255,0.95);
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            z-index: 1001;
            border-radius: 0.375rem;
        }

        .map-loading-spinner {
            width: 40px;
            height: 40px;
            border: 3px solid #f3f3f3;
            border-top: 3px solid #007bff;
            border-radius: 50%;
            animation: spin 1s linear infinite;
            margin-bottom: 10px;
        }

        @keyframes spin {
            0% { transform: rotate(0deg); }
            100% { transform: rotate(360deg); }
        }

        /* Fallback image styles */
        .fallback-contact-image {
            width: 100%;
            height: 450px;
            object-fit: cover;
            border-radius: 0.375rem;
            transition: opacity 0.3s ease;
        }

        /* Hover effects for contact info */
        .cl-ct-info .cl-info p:hover i {
            color: #007bff !important;
            transform: scale(1.1);
            transition: all 0.2s ease;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .contact-map-container {
                height: 350px;
            }

            .fallback-contact-image {
                height: 350px;
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
                        {{-- THAY THẾ IMAGE BẰNG INTERACTIVE MAP --}}
                        <div class="col-12 col-sm-6 position-relative" data-aos="fade-right" data-aos-duration="3000">
                            <div class="contact-map-container">
                                {{-- Interactive Map --}}
                                <div id="contactMap"></div>

                                {{-- Loading Overlay --}}
                                <div id="mapLoading" class="map-loading-overlay">
                                    <div class="map-loading-spinner"></div>
                                    <div class="text-muted small">Đang tải bản đồ vị trí...</div>
                                </div>

                                {{-- Fallback Image --}}
                                @if(!$information || !$information->latitude || !$information->longitude)
                                    <img src="{{ asset('images/lienhe/lien_he_map.png') }}"
                                         alt="Bản đồ liên hệ Thẩm mỹ Dr.DAT"
                                         class="fallback-contact-image"
                                         id="fallbackContactImage">
                                @endif
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
            @if(isset($hospitalImages) && $hospitalImages->count() > 0)
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

@push('scripts')
{{-- Leaflet JS --}}
<script src="https://unpkg.com/leaflet@1.9.4/dist/leaflet.js" crossorigin=""></script>

<script>
(function() {
    'use strict';

    let contactMapInstance = null; // Global map instance to prevent duplicates

    function initializeContactMap() {
        console.log('🔄 Initializing contact map...');

        const mapElement = document.getElementById('contactMap');
        if (!mapElement) {
            console.error('❌ Contact map element not found');
            return false;
        }

        // Clear any existing map
        if (contactMapInstance && contactMapInstance.remove) {
            console.log('🧹 Removing existing map instance');
            contactMapInstance.remove();
            contactMapInstance = null;
        }

        // Clear container content
        mapElement.innerHTML = '';

        // Check Leaflet
        if (typeof L === 'undefined') {
            console.error('❌ Leaflet library not loaded');
            showMapError('Không thể tải thư viện bản đồ');
            return false;
        }

        const information = @json($information ?? null);
        console.log('📊 Contact data:', information);

        // Hide loading
        const loadingEl = document.getElementById('mapLoading');
        if (loadingEl) {
            console.log('🛑 Hiding loading overlay');
            loadingEl.style.display = 'none';
        }

        // Show fallback if no coordinates
        const fallbackImage = document.getElementById('fallbackContactImage');
        if (fallbackImage) {
            fallbackImage.style.display = information && information.latitude && information.longitude ? 'none' : 'block';
        }

        // No coordinates? Stop here
        if (!information || !information.latitude || !information.longitude) {
            console.log('ℹ️ No coordinates - using fallback image');
            return true;
        }

        try {
            const lat = parseFloat(information.latitude);
            const lng = parseFloat(information.longitude);
            const address = information.address || 'Vị trí Thẩm mỹ Dr.DAT';
            const name = information.name || 'Thẩm mỹ Dr.DAT';
            const hotline = information.hotline || '';
            const email = information.email || '';
            const website = information.website || '';

            console.log('🗺️ Creating new map at:', { lat, lng, address });

            // Ensure container is clean
            mapElement.innerHTML = '';
            mapElement.style.height = '450px';
            mapElement.style.width = '100%';
            mapElement.style.borderRadius = '0.375rem';

            // Initialize fresh map instance
            contactMapInstance = L.map('contactMap', {
                center: [lat, lng],
                zoom: 16,
                minZoom: 12,
                maxZoom: 19,
                scrollWheelZoom: false, // Prevent accidental zoom
                zoomControl: true,
                attributionControl: false,
                preferCanvas: true,
                zoomAnimation: true,
                fadeAnimation: true,
                markerZoomAnimation: true
            });

            console.log('✅ New map instance created');

            // Add tiles with error handling
            try {
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    attribution: '© <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a>',
                    maxZoom: 19,
                    tileSize: 256,
                    zoomOffset: 0,
                    detectRetina: true
                }).addTo(contactMapInstance);
                console.log('✅ Tiles layer added successfully');
            } catch (tileError) {
                console.error('❌ Tiles error:', tileError);
                showMapError('Lỗi tải tiles bản đồ');
                return false;
            }

            // Custom marker - same as edit form
            const defaultIcon = L.divIcon({
                className: 'custom-marker',
                html: '<i class="fas fa-map-marker-alt text-danger" style="font-size: 24px; text-shadow: 0 1px 2px rgba(0,0,0,0.5);"></i>',
                iconSize: [30, 30],
                iconAnchor: [15, 30],
                popupAnchor: [0, -30]
            });

            // Create marker
            const contactMarker = L.marker([lat, lng], {
                icon: defaultIcon,
                riseOnHover: true,
                zIndexOffset: 1000
            }).addTo(contactMapInstance);

            console.log('✅ Contact marker added');

            // Simple popup with address - same structure as edit
            const popupContent = `
                <div class="p-3 text-center contact-popup" style="min-width: 280px; font-size: 14px;">
                    <i class="fas fa-map-marker-alt fa-2x text-primary mb-3 d-block"></i>
                    <div class="fw-bold text-primary mb-2 fs-5">${name}</div>
                    <div class="text-success fw-semibold mb-3 fs-6">${address}</div>
                    <small class="text-muted mb-3 d-block">
                        📍 Tọa độ: <code style="background: #f8f9fa; padding: 2px 4px; border-radius: 3px; font-size: 11px;">${lat.toFixed(6)}, ${lng.toFixed(6)}</code>
                    </small>
                    <div class="d-flex gap-2 justify-content-center flex-wrap">
                        <a href="https://www.google.com/maps/dir/?api=1&destination=${lat},${lng}"
                           target="_blank" rel="noopener"
                           class="btn btn-sm btn-outline-primary">
                            <i class="fas fa-directions me-1"></i>Đường đi
                        </a>
                        <a href="https://www.google.com/maps?q=${lat},${lng}&ll=${lat},${lng}&z=17"
                           target="_blank" rel="noopener"
                           class="btn btn-sm btn-outline-success">
                            <i class="fas fa-eye me-1"></i>Xem vị trí
                        </a>
                    </div>
                </div>
            `;

            contactMarker.bindPopup(popupContent, {
                maxWidth: 320,
                className: 'contact-popup-wrapper',
                autoPan: true,
                keepInView: true,
                closeButton: true
            });

            console.log('✅ Popup configured');

            // Auto-open popup
            contactMarker.openPopup();

            // Fit bounds with padding - same as edit form
            try {
                const group = new L.featureGroup([contactMarker]);
                contactMapInstance.fitBounds(group.getBounds(), {
                    padding: [15, 15],
                    paddingTopLeft: [0, 20],
                    duration: 0.8
                });
                console.log('✅ Bounds fitted with padding');
            } catch (boundsError) {
                console.warn('⚠️ Bounds fitting warning:', boundsError);
                // Fallback to setView
                contactMapInstance.setView([lat, lng], 16);
            }

            // Toggle popup on map click (outside marker)
            contactMapInstance.on('click', function(e) {
                // Check if click is on marker or popup
                const target = e.originalEvent.target;
                if (!target.closest('.leaflet-marker-icon') && !target.closest('.leaflet-popup')) {
                    if (contactMarker.getPopup().isOpen()) {
                        contactMarker.closePopup();
                    } else {
                        contactMarker.openPopup();
                    }
                }
            });

            // Success logging
            console.log('🎉 Contact map fully loaded and interactive');
            return true;

        } catch (error) {
            console.error('❌ Contact map error:', error);
            showMapError(`Lỗi khởi tạo bản đồ: ${error.message}`);
            return false;
        }
    }

    // Error display
    function showMapError(message) {
        const mapElement = document.getElementById('contactMap');
        if (!mapElement) return;

        mapElement.innerHTML = `
            <div class="d-flex flex-column align-items-center justify-content-center h-100 text-center p-4 bg-light rounded border">
                <i class="fas fa-exclamation-triangle text-danger fa-3x mb-3"></i>
                <div class="fw-bold text-danger mb-2">${message}</div>
                <small class="text-muted mb-3">Bản đồ sẽ được cập nhật sớm</small>
                <img src="{{ asset('images/lienhe/lien_he_map.png') }}"
                     alt="Bản đồ liên hệ"
                     class="img-fluid rounded"
                     style="max-height: 300px; opacity: 0.8;">
            </div>
        `;

        const loadingEl = document.getElementById('mapLoading');
        if (loadingEl) loadingEl.style.display = 'none';
    }

    // Initialize strategy
    function initStrategy() {
        const mapElement = document.getElementById('contactMap');
        if (!mapElement) {
            console.log('⏳ Waiting for map element...');
            setTimeout(initStrategy, 500);
            return;
        }

        // Check if already initialized
        if (mapElement._leaflet_id) {
            console.log('ℹ️ Map already initialized, skipping');
            const loadingEl = document.getElementById('mapLoading');
            if (loadingEl) loadingEl.style.display = 'none';
            return;
        }

        // Initialize
        const success = initializeContactMap();
        if (!success) {
            console.log('⚠️ Initialization failed, retrying in 2s...');
            setTimeout(initStrategy, 2000);
        }
    }

    // Start initialization
    if (document.readyState === 'loading') {
        document.addEventListener('DOMContentLoaded', initStrategy);
    } else {
        initStrategy();
    }

    console.log('🚀 Contact map initialization started');
})();
</script>
@endpush
@endsection

