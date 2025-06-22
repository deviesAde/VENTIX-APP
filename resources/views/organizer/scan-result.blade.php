@extends('layouts.organizer')

@section('title', 'Ticket Details')

@section('content')
<div class="container-fluid px-4 py-5">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <!-- Main Card -->
            <div class="card ticket-card shadow-xl border-0 overflow-hidden">
                <!-- Card Header with Enhanced Gradient -->
                <div class="card-header bg-gradient-primary text-white py-4 position-relative">
                    <div class="gradient-overlay"></div>
                    <div class="d-flex justify-content-between align-items-center position-relative">
                        <div>
                            <h4 class="card-title mb-1 text-shadow">Ticket Details</h4>
                            <p class="card-subtitle mb-0 opacity-75">Event Registration</p>
                        </div>
                        <div class="ticket-badge bg-white text-primary px-3 py-2 rounded-pill shadow-sm">
                            <span class="fw-bold">{{ $registration->ticket_number }}</span>
                        </div>
                    </div>
                    <div class="floating-circles">
                        <div class="circle circle-1"></div>
                        <div class="circle circle-2"></div>
                        <div class="circle circle-3"></div>
                    </div>
                </div>

                <div class="card-body p-0">
                    <div class="row g-0">
                        <!-- QR Code Section -->
                        <div class="col-md-5 border-end">
                            <div class="qr-section p-4 h-100 d-flex flex-column">
                                <div class="text-center mb-4">
                                    <div class="qr-container bg-white p-3 rounded-3 d-inline-block shadow-lg position-relative">
                                        <div class="qr-glow"></div>
                                        {!! $registration->generateQrCode() !!}
                                    </div>
                                    <p class="text-muted mt-3 mb-4 small">
                                        <i class="fas fa-mobile-alt me-1"></i>
                                        Scan QR code to verify
                                    </p>
                                </div>

                                <div class="mt-auto">
                                    @if(!$is_checked_in)
                                        <form action="{{ route('organizer.scan.check-in') }}" method="POST" class="check-in-form">
                                            @csrf
                                            <input type="hidden" name="registration_id" value="{{ $registration->id }}">
                                            <button type="submit" class="btn btn-success btn-lg w-100 py-3 btn-animated">
                                                <i class="fas fa-check-circle me-2"></i>
                                                <span>Check In Attendee</span>
                                                <div class="btn-ripple"></div>
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-outline-success btn-lg w-100 py-3 btn-checked" disabled>
                                            <i class="fas fa-check-circle me-2"></i>
                                            <span>Already Checked In</span>
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Event & Attendee Info -->
                        <div class="col-md-7">
                            <div class="p-4 info-section">
                                <!-- Event Information -->
                                <div class="mb-4 info-card">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-circle bg-primary-light text-primary me-3 icon-hover">
                                            <i class="fas fa-calendar-alt"></i>
                                        </div>
                                        <h5 class="mb-0 text-gradient">{{ $registration->event->title }}</h5>
                                    </div>

                                    <div class="ps-5">
                                        <div class="d-flex align-items-center mb-2 info-item">
                                            <i class="fas fa-calendar-day text-primary me-2" style="width: 20px;"></i>
                                            <span>{{ \Carbon\Carbon::parse($registration->event->start_time)->format('l, F j, Y') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-2 info-item">
                                            <i class="fas fa-clock text-primary me-2" style="width: 20px;"></i>
                                            <span>{{ \Carbon\Carbon::parse($registration->event->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($registration->event->end_time)->format('g:i A') }}</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-3 info-item">
                                            <i class="fas fa-map-marker-alt text-primary me-2" style="width: 20px;"></i>
                                            <span>{{ $registration->event->location }}</span>
                                        </div>
                                    </div>
                                </div>

                                <hr class="gradient-hr my-4">

                                <!-- Attendee Information -->
                                <div class="mb-4 info-card">
                                    <div class="d-flex align-items-center mb-3">
                                        <div class="icon-circle bg-primary-light text-primary me-3 icon-hover">
                                            <i class="fas fa-user"></i>
                                        </div>
                                        <h5 class="mb-0 text-gradient">Attendee Information</h5>
                                    </div>

                                    <div class="ps-5">
                                        <div class="d-flex align-items-center mb-2 info-item">
                                            <i class="fas fa-user-circle text-primary me-2" style="width: 20px;"></i>
                                            <span class="fw-bold">{{ $registration->user->name }}</span>
                                        </div>
                                        <div class="d-flex align-items-center mb-3 info-item">
                                            <i class="fas fa-envelope text-primary me-2" style="width: 20px;"></i>
                                            <span>{{ $registration->user->email }}</span>
                                        </div>
                                    </div>
                                </div>

                                <!-- Enhanced Status Card -->
                                <div class="status-card status-{{ $is_checked_in ? 'success' : 'warning' }} rounded-3 p-3 position-relative">
                                    <div class="status-glow"></div>
                                    <div class="d-flex align-items-center position-relative">
                                        <div class="status-icon me-3">
                                            <i class="fas fa-{{ $is_checked_in ? 'check-circle' : 'clock' }}"></i>
                                        </div>
                                        <div>
                                            @if($is_checked_in)
                                                <h6 class="mb-1 fw-bold">Successfully Checked In</h6>
                                                <p class="mb-0 small opacity-75">
                                                    @if($registration->checked_in_at)
                                                        <i class="fas fa-calendar-check me-1"></i>
                                                        {{ \Carbon\Carbon::parse($registration->checked_in_at)->format('M j, Y \a\t g:i A') }}
                                                    @else
                                                        Check-in time not recorded
                                                    @endif
                                                </p>
                                            @else
                                                <h6 class="mb-1 fw-bold">Awaiting Check-in</h6>
                                                <p class="mb-0 small opacity-75">
                                                    <i class="fas fa-qrcode me-1"></i>
                                                    Scan QR code or use manual entry
                                                </p>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Enhanced Card Footer -->
                <div class="card-footer bg-light-gradient border-0">
                    <div class="d-flex justify-content-between align-items-center">
                        @if($from_manual ?? false)
                            <a href="{{ route('organizer.scan.manual') }}" class="btn btn-outline-primary btn-hover-lift">
                                <i class="fas fa-arrow-left me-2"></i> Back to Manual Entry
                            </a>
                        @else
                            <a href="{{ route('organizer.scan') }}" class="btn btn-outline-primary btn-hover-lift">
                                <i class="fas fa-arrow-left me-2"></i> Back to Scanner
                            </a>
                        @endif

                        <div class="text-muted small d-flex align-items-center">
                            <div class="view-indicator me-2"></div>
                            <i class="fas fa-eye me-1"></i>
                            Viewed on {{ now()->format('M j, Y g:i A') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    :root {
        --primary-color: #3b82f6;
        --primary-dark: #1d4ed8;
        --success-color: #22c55e;
        --warning-color: #eab308;
        --shadow-light: rgba(0, 0, 0, 0.1);
        --shadow-medium: rgba(0, 0, 0, 0.15);
        --shadow-heavy: rgba(0, 0, 0, 0.25);
    }

    .ticket-card {
        border-radius: 1.5rem;
        overflow: hidden;
        background-color: #fff;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
    }

    .ticket-card:hover {
        transform: translateY(-5px);
    }

    .shadow-xl {
        box-shadow: 0 25px 50px -12px var(--shadow-heavy);
    }

    .bg-gradient-primary {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 50%, #1e40af 100%);
        position: relative;
        overflow: hidden;
    }

    .gradient-overlay {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background: linear-gradient(45deg, rgba(255,255,255,0.1) 0%, transparent 50%, rgba(255,255,255,0.1) 100%);
        pointer-events: none;
    }

    .floating-circles {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        overflow: hidden;
        pointer-events: none;
    }

    .circle {
        position: absolute;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.1);
        animation: float 6s ease-in-out infinite;
    }

    .circle-1 {
        width: 60px;
        height: 60px;
        top: -30px;
        right: 20%;
        animation-delay: 0s;
    }

    .circle-2 {
        width: 40px;
        height: 40px;
        top: 50%;
        right: -20px;
        animation-delay: 2s;
    }

    .circle-3 {
        width: 80px;
        height: 80px;
        bottom: -40px;
        left: 10%;
        animation-delay: 4s;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0px) rotate(0deg); }
        50% { transform: translateY(-20px) rotate(180deg); }
    }

    .card-header {
        border-bottom: none;
    }

    .card-title {
        font-weight: 700;
        font-size: 1.5rem;
        letter-spacing: -0.025em;
    }

    .text-shadow {
        text-shadow: 0 2px 4px rgba(0, 0, 0, 0.3);
    }

    .card-subtitle {
        font-size: 0.875rem;
        font-weight: 500;
    }

    .ticket-badge {
        font-size: 0.9rem;
        font-weight: 700;
        letter-spacing: 0.5px;
        border: 2px solid rgba(59, 130, 246, 0.2);
        transition: all 0.3s ease;
    }

    .ticket-badge:hover {
        transform: scale(1.05);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
    }

    .qr-section {
        background: linear-gradient(145deg, #f8fafc 0%, #f1f5f9 100%);
    }

    .qr-container {
        border: 2px solid rgba(59, 130, 246, 0.1);
        max-width: 200px;
        margin: 0 auto;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .qr-container:hover {
        transform: scale(1.02);
        border-color: var(--primary-color);
    }

    .qr-glow {
        position: absolute;
        top: -50%;
        left: -50%;
        right: -50%;
        bottom: -50%;
        background: radial-gradient(circle, rgba(59, 130, 246, 0.1) 0%, transparent 70%);
        animation: pulse-glow 2s ease-in-out infinite;
    }

    @keyframes pulse-glow {
        0%, 100% { opacity: 0.5; transform: scale(1); }
        50% { opacity: 1; transform: scale(1.1); }
    }

    .info-section {
        background: linear-gradient(145deg, #ffffff 0%, #f9fafb 100%);
    }

    .info-card {
        transition: all 0.3s ease;
        padding: 0.5rem 0;
        border-radius: 0.75rem;
    }

    .info-card:hover {
        background: rgba(59, 130, 246, 0.02);
        transform: translateX(5px);
    }

    .info-item {
        transition: all 0.2s ease;
        padding: 0.25rem 0;
        border-radius: 0.5rem;
    }

    .info-item:hover {
        background: rgba(59, 130, 246, 0.05);
        padding-left: 0.5rem;
        margin-left: -0.5rem;
    }

    .icon-circle {
        width: 45px;
        height: 45px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1rem;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }

    .icon-hover:hover {
        transform: scale(1.1) rotate(5deg);
        border-color: var(--primary-color);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
    }

    .bg-primary-light {
        background: linear-gradient(135deg, rgba(59, 130, 246, 0.15) 0%, rgba(59, 130, 246, 0.05) 100%);
    }

    .text-gradient {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 600;
    }

    .gradient-hr {
        border: none;
        height: 2px;
        background: linear-gradient(90deg, transparent 0%, var(--primary-color) 50%, transparent 100%);
        opacity: 0.3;
        margin: 1.5rem 0;
    }

    .status-card {
        border-left: 4px solid;
        transition: all 0.3s ease;
        backdrop-filter: blur(10px);
        border-radius: 1rem !important;
        overflow: hidden;
    }

    .status-card:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
    }

    .status-glow {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        opacity: 0.5;
        border-radius: inherit;
    }

    .status-success {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.15) 0%, rgba(34, 197, 94, 0.05) 100%);
        border-left-color: var(--success-color);
        color: #166534;
    }

    .status-success .status-glow {
        background: radial-gradient(circle at center, rgba(34, 197, 94, 0.2) 0%, transparent 70%);
    }

    .status-warning {
        background: linear-gradient(135deg, rgba(234, 179, 8, 0.15) 0%, rgba(234, 179, 8, 0.05) 100%);
        border-left-color: var(--warning-color);
        color: #854d0e;
    }

    .status-warning .status-glow {
        background: radial-gradient(circle at center, rgba(234, 179, 8, 0.2) 0%, transparent 70%);
    }

    .status-icon {
        font-size: 1.75rem;
        animation: bounce 2s infinite;
    }

    @keyframes bounce {
        0%, 20%, 50%, 80%, 100% { transform: translateY(0); }
        40% { transform: translateY(-5px); }
        60% { transform: translateY(-3px); }
    }

    .btn-animated {
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
        font-weight: 600;
        letter-spacing: 0.5px;
        border: none;
        background: linear-gradient(135deg, var(--success-color) 0%, #16a34a 100%);
    }

    .btn-animated:hover {
        transform: translateY(-2px);
        box-shadow: 0 10px 25px rgba(34, 197, 94, 0.4);
        background: linear-gradient(135deg, #16a34a 0%, #15803d 100%);
    }

    .btn-ripple {
        position: absolute;
        top: 50%;
        left: 50%;
        width: 0;
        height: 0;
        border-radius: 50%;
        background: rgba(255, 255, 255, 0.3);
        transform: translate(-50%, -50%);
        transition: width 0.6s, height 0.6s;
    }

    .btn-animated:active .btn-ripple {
        width: 300px;
        height: 300px;
    }

    .btn-checked {
        background: linear-gradient(135deg, rgba(34, 197, 94, 0.1) 0%, rgba(22, 163, 74, 0.1) 100%);
        border: 2px solid var(--success-color);
        color: var(--success-color);
        font-weight: 600;
    }

    .btn-hover-lift {
        transition: all 0.3s ease;
        font-weight: 500;
        border-width: 2px;
    }

    .btn-hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(59, 130, 246, 0.3);
    }

    .bg-light-gradient {
        background: linear-gradient(145deg, #f8fafc 0%, #e2e8f0 100%);
    }

    .view-indicator {
        width: 8px;
        height: 8px;
        border-radius: 50%;
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--primary-dark) 100%);
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { opacity: 1; transform: scale(1); }
        50% { opacity: 0.5; transform: scale(1.2); }
    }

    @media (max-width: 768px) {
        .border-end {
            border-right: none !important;
            border-bottom: 2px solid #e2e8f0;
        }

        .card-title {
            font-size: 1.25rem;
        }

        .qr-section {
            background: linear-gradient(180deg, #f8fafc 0%, #f1f5f9 100%);
        }

        .floating-circles {
            display: none;
        }

        .ticket-card:hover {
            transform: none;
        }
    }

    /* Smooth scrolling for better UX */
    html {
        scroll-behavior: smooth;
    }

    /* Custom focus styles for accessibility */
    .btn:focus,
    .btn-check:focus + .btn {
        box-shadow: 0 0 0 0.25rem rgba(59, 130, 246, 0.25);
    }

    /* Loading animation for form submission */
    .check-in-form.loading .btn-animated {
        pointer-events: none;
    }

    .check-in-form.loading .btn-animated::after {
        content: '';
        position: absolute;
        top: 50%;
        left: 50%;
        width: 20px;
        height: 20px;
        margin: -10px 0 0 -10px;
        border: 2px solid transparent;
        border-top-color: #ffffff;
        border-radius: 50%;
        animation: spin 1s linear infinite;
    }

    @keyframes spin {
        0% { transform: rotate(0deg); }
        100% { transform: rotate(360deg); }
    }
</style>
@endpush
