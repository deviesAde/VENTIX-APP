@extends('layouts.organizer')

@section('title', 'Ticket Details')

@section('content')
<div class="container-fluid px-4">
    <div class="row justify-content-center">
        <div class="col-xl-8 col-lg-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-primary text-white">
                    <div class="d-flex justify-content-between align-items-center">
                        <h4 class="card-title mb-0 text-white">Ticket Details</h4>
                        <span class="badge bg-white text-primary fs-6">{{ $registration->ticket_number }}</span>
                    </div>
                </div>

                <div class="card-body p-4">
                    <div class="row g-4">
                        <!-- QR Code Section -->
                        <div class="col-md-5">
                            <div class="border rounded p-3 text-center bg-light">
                                <div class="mb-3">
                                    {!! $registration->generateQrCode() !!}
                                </div>
                                <div class="d-grid">
                                    @if(!$is_checked_in)
                                        <form action="{{ route('organizer.scan.check-in') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="registration_id" value="{{ $registration->id }}">
                                            <button type="submit" class="btn btn-success btn-lg">
                                                <i class="fas fa-check-circle me-2"></i> Check In
                                            </button>
                                        </form>
                                    @else
                                        <button class="btn btn-success btn-lg" disabled>
                                            <i class="fas fa-check-circle me-2"></i> Already Checked In
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <!-- Event & Attendee Info -->
                        <div class="col-md-7">
                            <div class="mb-4">
                                <h5 class="text-primary mb-3">{{ $registration->event->title }}</h5>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-calendar-day me-2 text-muted"></i>
                                    <span>{{ \Carbon\Carbon::parse($registration->event->start_time)->format('l, F j, Y') }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-clock me-2 text-muted"></i>
                                    <span>{{ \Carbon\Carbon::parse($registration->event->start_time)->format('g:i A') }} - {{ \Carbon\Carbon::parse($registration->event->end_time)->format('g:i A') }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-map-marker-alt me-2 text-muted"></i>
                                    <span>{{ $registration->event->location }}</span>
                                </div>
                                <hr>

                                <h5 class="text-primary mb-3">Attendee Information</h5>
                                <div class="d-flex align-items-center mb-2">
                                    <i class="fas fa-user me-2 text-muted"></i>
                                    <span class="fw-bold">{{ $registration->user->name }}</span>
                                </div>
                                <div class="d-flex align-items-center mb-3">
                                    <i class="fas fa-envelope me-2 text-muted"></i>
                                    <span>{{ $registration->user->email }}</span>
                                </div>

                                <div class="alert alert-{{ $is_checked_in ? 'info' : 'warning' }} mb-0">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-{{ $is_checked_in ? 'check-circle' : 'exclamation-circle' }} me-2"></i>
                                        <div>
                                            @if($is_checked_in)
                                                <strong>Checked in:</strong>
                                                @if($registration->checked_in_at)
                                                    {{ \Carbon\Carbon::parse($registration->checked_in_at)->format('M j, Y \a\t g:i A') }}
                                                @else
                                                    (No check-in time recorded)
                                                @endif
                                            @else
                                                <strong>Not checked in yet</strong>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card-footer bg-light">
                    <div class="d-flex justify-content-between">
                        @if($from_manual ?? false)
                            <a href="{{ route('organizer.scan.manual') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Back to Manual Entry
                            </a>
                        @else
                            <a href="{{ route('organizer.scan') }}" class="btn btn-outline-secondary">
                                <i class="fas fa-arrow-left me-2"></i> Back to Scanner
                            </a>
                        @endif

                        <div class="text-muted small">
                            <i class="fas fa-qrcode me-1"></i> Scanned on {{ now()->format('M j, Y g:i A') }}
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
    .card {
        border-radius: 0.75rem;
        overflow: hidden;
    }
    .card-header {
        border-bottom: none;
        padding: 1.25rem 1.5rem;
    }
    .badge {
        padding: 0.35em 0.65em;
        font-weight: 500;
        border-radius: 0.5rem;
    }
    hr {
        opacity: 0.15;
        margin: 1.5rem 0;
    }
</style>
@endpush
