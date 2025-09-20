@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
<div class="row">
    <!-- Statistics Cards -->
    <div class="col-md-3">
        <a href="{{ route('admin.services.index') }}" class="text-decoration-none text-dark">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="fas fa-concierge-bell text-primary"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $stats['total_services'] }}</h3>
                        <p>Tổng dịch vụ</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{ route('admin.news.index') }}" class="text-decoration-none text-dark">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="fas fa-newspaper text-success"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $stats['total_news'] }}</h3>
                        <p>Tổng tin tức</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{ route('admin.appointments.index') }}" class="text-decoration-none text-dark">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="fas fa-calendar-check text-warning"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $stats['pending_appointments'] }}</h3>
                        <p>Lịch hẹn chờ</p>
                    </div>
                </div>
            </div>
        </a>
    </div>

    <div class="col-md-3">
        <a href="{{ route('admin.informations.index') }}" class="text-decoration-none text-dark">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="stat-icon">
                        <i class="fas fa-envelope text-danger"></i>
                    </div>
                    <div class="stat-content">
                        <h3>{{ $stats['total_contacts'] }}</h3>
                        <p>Liên hệ mới</p>
                    </div>
                </div>
            </div>
        </a>
    </div>
</div>

<div class="row mt-4">
    <!-- Recent Appointments -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Lịch hẹn gần đây</h5>
            </div>
            <div class="card-body">
                @forelse($recentAppointments as $appointment)
                    <a href="{{ route('admin.appointments.edit', $appointment->id) }}" class="d-block text-decoration-none text-dark">
                        <div class="appointment-item">
                            <div class="appointment-info">
                                <strong>{{ $appointment->customer_name }}</strong>
                                <br>
                                <small class="text-muted">
                                    {{ $appointment->appointment_date->format('d/m/Y') }} -
                                    {{ $appointment->appointment_time }}
                                </small>
                            </div>
                            <span class="badge bg-{{ $appointment->status === 'pending' ? 'warning' : 'success' }}">
                                {{ $appointment->status }}
                            </span>
                        </div>
                    </a>
                @empty
                    <p class="text-muted">Không có lịch hẹn nào</p>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent Contacts -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Liên hệ gần đây</h5>
            </div>
            <div class="card-body">
                @forelse($recentContacts as $contact)
                    <a href="{{ route('admin.informations.edit', $contact->id) }}" class="d-block text-decoration-none text-dark">
                        <div class="contact-item">
                            <div class="contact-info">
                                <strong>{{ $contact->name }}</strong>
                                <br>
                                <small class="text-muted">{{ $contact->email }}</small>
                            </div>
                            <span class="badge bg-info">Mới</span>
                        </div>
                    </a>
                @empty
                    <p class="text-muted">Không có liên hệ nào</p>
                @endforelse
            </div>
        </div>
    </div>
</div>
@endsection
