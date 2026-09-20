@extends('layouts.main')

@section('content')

@php
    $doctors = $department->doctors->map(function ($doctor) {
        return [
            'id' => $doctor->id,
            'name' => $doctor->name,
            'qualification' => $doctor->qualification,
            'appointments' => $doctor->appointments->where('taken', false)->values()
        ];
    });
@endphp

<style>
    .booking-page { min-height: calc(100vh - 80px); padding: 3rem 0 5rem; background: #f5f8fb; font-family: 'Inter', sans-serif; }
    .booking-shell { max-width: 820px; margin: 0 auto; padding: clamp(1.5rem, 4vw, 3rem); border: 1px solid #e1e8ed; border-radius: 24px; background: #fff; box-shadow: 0 18px 45px rgba(16, 42, 67, .1); }
    .booking-eyebrow { margin-bottom: .5rem; color: #2cb1bc; font-size: .78rem; font-weight: 800; letter-spacing: .12em; text-transform: uppercase; }
    .booking-title { margin: 0; color: #102a43; font-size: clamp(2rem, 5vw, 3rem); font-weight: 800; }
    .booking-copy { max-width: 38rem; margin: .75rem 0 2rem; color: #627d98; font-size: 1.05rem; }
    .booking-alert { border: 0; border-radius: 14px; }
    .booking-form { display: grid; gap: 1.25rem; }
    .booking-label { display: block; margin-bottom: .5rem; color: #243b53; font-size: .9rem; font-weight: 800; }
    .booking-select { min-height: 3.4rem; border: 1px solid #bcccdc; border-radius: 12px; color: #102a43; font-weight: 600; }
    .booking-select:focus { border-color: #2cb1bc; box-shadow: 0 0 0 .2rem rgba(44, 177, 188, .18); }
    .booking-summary { display: none; padding: 1rem 1.1rem; border-radius: 14px; background: #e6fffa; color: #135e5e; }
    .booking-summary.is-visible { display: block; }
    .booking-summary strong { display: block; margin-bottom: .25rem; font-size: 1.05rem; }
    .booking-submit { min-height: 3.25rem; border: 0; border-radius: 12px; background: #102a43; font-weight: 800; }
    .booking-submit:hover, .booking-submit:focus { background: #2cb1bc; }
    .booking-submit:disabled { background: #bcccdc; cursor: not-allowed; }
    .booking-empty { padding: 1.25rem; border-radius: 14px; background: #f0f4f8; color: #627d98; }
    .doc-qualification { font-size: 0.85rem; color: #627d98; font-weight: normal; }
</style>

<main class="booking-page">
    <div class="container-lg">
        <section class="booking-shell">
            <div class="booking-eyebrow">{{ $department->name }}</div>
            <h1 class="booking-title">Book an appointment</h1>
            <p class="booking-copy">Select a specialist, choose a convenient date, and pick an available 30-minute slot.</p>

            @if (session('message'))
                <div class="alert {{ session('alert-class', 'alert-info') }} booking-alert" role="alert">{{ session('message') }}</div>
            @endif

            @if ($doctors->isEmpty())
                <div class="booking-empty">There are no doctors currently available in this department.</div>
            @else
                <form method="post" action="{{ route('bookAppointments') }}" class="booking-form" id="booking-form">
                    @csrf
                    <div>
                        <label class="booking-label" for="doctor-id">1. Choose a specialist</label>
                        <select class="form-select booking-select" id="doctor-id" aria-label="Choose a specialist">
                            <option value="">Select a doctor</option>
                            @foreach($doctors as $doctor)
                                <option value="{{ $doctor['id'] }}">{{ $doctor['name'] }}</option>
                            @endforeach
                        </select>
                        <div id="doctor-qualification" style="display: none; margin-top: 8px; padding: 10px; background: #eaf1f8; border-radius: 8px; color: #102a43; font-size: 0.95rem;">
                            <strong>Qualification:</strong> <span id="qualification-text"></span>
                        </div>
                    </div>

                    <div>
                        <label class="booking-label" for="appointment-date">2. Choose a date</label>
                        <select class="form-select booking-select" id="appointment-date" aria-label="Choose appointment date" disabled>
                            <option value="">Select a doctor first</option>
                        </select>
                    </div>

                    <div>
                        <label class="booking-label" for="appointment-id">3. Choose a time</label>
                        <select class="form-select booking-select" id="appointment-id" name="appointment_id" disabled required>
                            <option value="">Select a date first</option>
                        </select>
                    </div>

                    <div class="booking-summary" id="booking-summary">
                        <strong>Ready to confirm</strong>
                        <span id="booking-summary-text"></span>
                    </div>

                    <button type="submit" class="btn btn-primary booking-submit" id="booking-submit" disabled>Confirm appointment</button>
                </form>
            @endif
        </section>
    </div>
</main>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const doctorSelect = document.getElementById('doctor-id');
        const dateSelect = document.getElementById('appointment-date');
        const timeSelect = document.getElementById('appointment-id');
        const submitButton = document.getElementById('booking-submit');
        const summary = document.getElementById('booking-summary');
        const summaryText = document.getElementById('booking-summary-text');
        
        const doctorsData = @json($doctors);
        let selectedDoctorAppointments = [];

        if (!doctorSelect) return;

        doctorSelect.addEventListener('change', function () {
            const doctorId = this.value;
            dateSelect.innerHTML = '<option value="">Select a date</option>';
            timeSelect.innerHTML = '<option value="">Select a date first</option>';
            
            dateSelect.disabled = !doctorId;
            timeSelect.disabled = true;
            submitButton.disabled = true;
            summary.classList.remove('is-visible');
            
            const qualDiv = document.getElementById('doctor-qualification');
            const qualText = document.getElementById('qualification-text');

            if (!doctorId) {
                if (qualDiv) qualDiv.style.display = 'none';
                return;
            }

            const selectedDoctor = doctorsData.find(d => d.id == doctorId);
            
            if (qualDiv && selectedDoctor) {
                qualText.textContent = selectedDoctor.qualification;
                qualDiv.style.display = 'block';
            }

            selectedDoctorAppointments = selectedDoctor ? selectedDoctor.appointments : [];
            
            // Group appointments by date
            const dates = {};
            selectedDoctorAppointments.forEach(app => {
                const dateStr = app.appointment_date.slice(0, 10);
                dates[dateStr] = (dates[dateStr] || 0) + 1;
            });

            if (Object.keys(dates).length === 0) {
                dateSelect.innerHTML = '<option value="">No dates available</option>';
                dateSelect.disabled = true;
                return;
            }

            Object.keys(dates).sort().forEach(date => {
                const dateObj = new Date(date);
                const dateFormatted = dateObj.toLocaleDateString(undefined, { weekday: 'long', month: 'long', day: 'numeric', year: 'numeric' });
                const option = document.createElement('option');
                option.value = date;
                option.textContent = `${dateFormatted} (${dates[date]} available)`;
                dateSelect.appendChild(option);
            });
        });

        dateSelect.addEventListener('change', function () {
            const selectedDate = this.value;
            timeSelect.innerHTML = '<option value="">Select an available time</option>';
            
            timeSelect.disabled = !selectedDate;
            submitButton.disabled = true;
            summary.classList.remove('is-visible');

            if (!selectedDate) return;

            const availableTimes = selectedDoctorAppointments.filter(function (appointment) {
                return appointment.appointment_date.slice(0, 10) === selectedDate;
            });

            availableTimes.forEach(function (appointment) {
                const time = new Date(appointment.appointment_date.replace(' ', 'T'));
                const option = document.createElement('option');
                option.value = appointment.id;
                option.textContent = time.toLocaleTimeString([], { hour: 'numeric', minute: '2-digit' });
                timeSelect.appendChild(option);
            });
        });

        timeSelect.addEventListener('change', function () {
            const selectedId = this.value;
            const selected = selectedDoctorAppointments.find(function (appointment) {
                return String(appointment.id) === selectedId;
            });

            if (!selected) {
                submitButton.disabled = true;
                summary.classList.remove('is-visible');
                return;
            }

            const doctorName = doctorSelect.options[doctorSelect.selectedIndex].text;
            const time = new Date(selected.appointment_date.replace(' ', 'T'));
            summaryText.textContent = time.toLocaleString([], {
                weekday: 'long', month: 'long', day: 'numeric', hour: 'numeric', minute: '2-digit'
            }) + ' with ' + doctorName;
            
            summary.classList.add('is-visible');
            submitButton.disabled = false;
        });
    });
</script>

@endsection