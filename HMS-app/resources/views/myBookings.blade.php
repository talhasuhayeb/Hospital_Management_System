@extends('layouts.main')

@section('content')

<style>
    .booking-shell {
        max-width: 1100px;
        margin: 40px auto;
        padding: 0 16px 60px;
    }

    .booking-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 30px;
        gap: 20px;
        flex-wrap: wrap;
    }

    .booking-header h2 {
        margin: 0;
        color: #0f172a;
        font-weight: 800;
        letter-spacing: -0.04em;
    }

    .booking-grid {
        display: grid;
        gap: 22px;
    }

    .booking-card {
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid rgba(148, 163, 184, 0.2);
        border-radius: 22px;
        box-shadow: 0 22px 45px rgba(15, 23, 42, 0.08);
        padding: 24px;
    }

    .booking-top {
        display: flex;
        justify-content: space-between;
        gap: 16px;
        align-items: center;
        margin-bottom: 18px;
        flex-wrap: wrap;
    }

    .booking-id {
        color: #475569;
        font-weight: 700;
        letter-spacing: 0.02em;
    }

    .status-badge {
        display: inline-flex;
        align-items: center;
        padding: 8px 12px;
        border-radius: 999px;
        font-size: 0.8rem;
        font-weight: 700;
        letter-spacing: 0.04em;
        text-transform: uppercase;
    }

    .status-approved {
        background: rgba(16, 185, 129, 0.12);
        color: #047857;
    }

    .status-pending {
        background: rgba(245, 158, 11, 0.12);
        color: #b45309;
    }

    .booking-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 18px;
        margin-top: 10px;
    }

    .meta-box {
        background: #fff;
        border: 1px solid #e2e8f0;
        border-radius: 16px;
        padding: 14px 16px;
    }

    .meta-label {
        display: block;
        font-size: 0.76rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #64748b;
        margin-bottom: 6px;
    }

    .meta-value {
        font-size: 1.05rem;
        font-weight: 700;
        color: #0f172a;
    }

    .booking-actions {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
    }

    .cancel-btn {
        border: none;
        border-radius: 12px;
        background: linear-gradient(135deg, #ef4444, #dc2626);
        color: #fff;
        padding: 0.8rem 1.2rem;
        font-weight: 700;
        box-shadow: 0 10px 20px rgba(239, 68, 68, 0.2);
    }

    .cancel-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .empty-state {
        background: linear-gradient(180deg, #ffffff 0%, #f8fafc 100%);
        border: 1px solid rgba(148, 163, 184, 0.2);
        border-radius: 22px;
        box-shadow: 0 22px 45px rgba(15, 23, 42, 0.08);
        padding: 42px 24px;
        text-align: center;
        color: #475569;
    }

    .empty-state a {
        display: inline-block;
        margin-top: 16px;
        background: linear-gradient(135deg, #4f46e5, #6366f1);
        color: white;
        border-radius: 999px;
        padding: 0.75rem 1.2rem;
        text-decoration: none;
        font-weight: 700;
    }
</style>

<div class="booking-shell">
    <div class="booking-header">
        <h2>My Appointment Status</h2>
        <a href="{{ route('appointmentSchedule', ['department' => 1]) }}" class="btn btn-primary">Book another appointment</a>
    </div>

    @if(session('message'))
        <div class="alert {{ session('alert-class', 'alert-info') }} mb-4">
            {{ session('message') }}
        </div>
    @endif

    @if($bookings->isEmpty())
        <div class="empty-state">
            <h4 class="mb-2">No appointment booked yet</h4>
            <p>Book a department appointment to see your status here.</p>
            <a href="{{ url('/') }}">Go to Departments</a>
        </div>
    @else
        <div class="booking-grid">
            @foreach($bookings as $booking)
                <div class="booking-card">
                    <div class="booking-top">
                        <div class="booking-id">Booking #{{ $booking->booking_id }}</div>
                        <span class="status-badge {{ $booking->taken ? 'status-approved' : 'status-pending' }}">
                            {{ $booking->taken ? 'Approved' : 'Pending approval' }}
                        </span>
                    </div>

                    <div class="booking-meta">
                        <div class="meta-box">
                            <span class="meta-label">Department</span>
                            <span class="meta-value">{{ $booking->department_name }}</span>
                        </div>

                        <div class="meta-box">
                            <span class="meta-label">Appointment ID</span>
                            <span class="meta-value">{{ $booking->appointment_id }}</span>
                        </div>

                        <div class="meta-box">
                            <span class="meta-label">Date & Time</span>
                            <span class="meta-value">{{ \Carbon\Carbon::parse($booking->appointment_date)->format('d M Y, h:i A') }}</span>
                        </div>

                        <div class="meta-box">
                            <span class="meta-label">Patient</span>
                            <span class="meta-value">{{ $booking->username }}</span>
                        </div>
                    </div>

                    @if(!$booking->taken)
                        <div class="booking-actions">
                            <form method="POST" action="{{ route('cancelBooking') }}">
                                @csrf
                                <input type="hidden" name="booking_id" value="{{ $booking->booking_id }}">
                                <button type="submit" class="cancel-btn">Cancel booking</button>
                            </form>
                        </div>
                    @endif
                </div>
            @endforeach
        </div>
    @endif
</div>

@endsection