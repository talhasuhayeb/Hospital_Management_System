@extends('layouts.main')

@section('content')

<style>
    .booking-page {
        min-height: calc(100vh - 80px);
        padding: 3rem 0 5rem;
        background: #f5f8fb;
    }

    .booking-shell {
        max-width: 980px;
        margin: 0 auto;
        padding: 0 16px;
    }

    .booking-header {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 2rem;
        gap: 20px;
        flex-wrap: wrap;
    }

    .booking-eyebrow {
        margin-bottom: .5rem;
        color: #2cb1bc;
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: .12em;
        text-transform: uppercase;
    }

    .booking-header h2 {
        margin: 0;
        color: #102a43;
        font-size: clamp(2rem, 5vw, 3rem);
        font-weight: 800;
    }

    .booking-header p {
        max-width: 38rem;
        margin: .75rem 0 0;
        color: #627d98;
        font-size: 1.05rem;
    }

    .booking-grid {
        display: grid;
        gap: 22px;
    }

    .booking-card {
        background: #fff;
        border: 1px solid #e1e8ed;
        border-radius: 18px;
        box-shadow: 0 18px 45px rgba(16, 42, 67, .1);
        padding: clamp(1.25rem, 3vw, 1.75rem);
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
        color: #243b53;
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
        background: #e6fffa;
        color: #135e5e;
    }

    .status-pending {
        background: #fff4db;
        color: #8d5b13;
    }

    .booking-meta {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(180px, 1fr));
        gap: 18px;
        margin-top: 10px;
    }

    .meta-box {
        background: #f0f4f8;
        border: 1px solid #e1e8ed;
        border-radius: 14px;
        padding: 14px 16px;
    }

    .meta-label {
        display: block;
        font-size: 0.76rem;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        color: #627d98;
        margin-bottom: 6px;
    }

    .meta-value {
        font-size: 1.05rem;
        font-weight: 700;
        color: #102a43;
    }

    .booking-actions {
        margin-top: 20px;
        display: flex;
        justify-content: flex-end;
    }

    .cancel-btn {
        border: none;
        border-radius: 12px;
        background: #c05640;
        color: #fff;
        padding: 0.8rem 1.2rem;
        font-weight: 700;
        box-shadow: 0 8px 16px rgba(192, 86, 64, .18);
    }

    .cancel-btn:hover,
    .cancel-btn:focus {
        background: #a94432;
    }

    .cancel-btn:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    .empty-state {
        background: #fff;
        border: 1px solid #e1e8ed;
        border-radius: 18px;
        box-shadow: 0 18px 45px rgba(16, 42, 67, .1);
        padding: 3rem 24px;
        text-align: center;
        color: #627d98;
    }

    .empty-state a {
        display: inline-block;
        margin-top: 16px;
        background: #102a43;
        color: white;
        border-radius: 12px;
        padding: 0.75rem 1.2rem;
        text-decoration: none;
        font-weight: 700;
    }

    .empty-state a:hover,
    .empty-state a:focus {
        background: #2cb1bc;
        color: #102a43;
    }

    .booking-header .btn-primary {
        border: 0;
        border-radius: 12px;
        background: #102a43;
        padding: .8rem 1.2rem;
        font-weight: 800;
    }

    .booking-header .btn-primary:hover,
    .booking-header .btn-primary:focus {
        background: #2cb1bc;
        color: #102a43;
    }
</style>

<main class="booking-page">
    <div class="booking-shell">
        <div class="booking-header">
            <div>
                <div class="booking-eyebrow">Patient portal</div>
                <h2>My Appointment Status</h2>
                <p>Review your upcoming appointments and keep track of approval status.</p>
            </div>
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
</main>

@endsection