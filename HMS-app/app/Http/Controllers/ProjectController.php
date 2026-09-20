<?php

namespace App\Http\Controllers;
use App\Models\Appointment;
use App\Models\Department;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{
    //

    public function getData(Request $request){
        $data = "This is my data";
        return view('index', ['data'=>$data]);     
    }



    public function getAllDepartments(Request $request){
        $departments = Department::all();
        return view('index',['departments'=>$departments]);    
    }

    
    public function showAppointments(Request $request){
        $departmentId = $request->input('department_id', $request->route('department'));
        $department = Department::with(['doctors.appointments' => function ($query) {
            $query->where('appointment_date', '>=', now())
                  ->orderBy('appointment_date');
        }])->findOrFail($departmentId);

        return view('appointments', ['department' => $department]);
    }

    public function bookAppointment(Request $request){
        $validated = $request->validate([
            'appointment_id' => ['required', 'integer', 'exists:appointments,id'],
        ]);

        $appointment = DB::transaction(function () use ($validated) {
            $appointment = Appointment::whereKey($validated['appointment_id'])
                ->lockForUpdate()
                ->firstOrFail();

            if ($appointment->taken || Booking::where('appointment_id', $appointment->id)->exists()) {
                return null;
            }

            $booking = new Booking;
            $booking->appointment_id = $appointment->id;
            $booking->department_name = $appointment->department_name;
            if ($appointment->doctor) {
                $booking->doctor_id = $appointment->doctor_id;
                $booking->doctor_name = $appointment->doctor->name;
            }
            $booking->appointment_date = $appointment->appointment_date;
            $booking->username = Auth::user()->name;
            $booking->user_id = Auth::id();
            $booking->status = 'pending';
            $booking->taken = false;
            $booking->save();

            $appointment->update(['taken' => true]);

            return $appointment;
        });

        if (!$appointment) {
            $departmentId = Appointment::whereKey($validated['appointment_id'])->value('department_id');

            return redirect()->route('appointmentSchedule', ['department' => $departmentId])->with([
                'message' => 'That appointment was just booked. Please choose another time.',
                'alert-class' => 'alert-warning',
            ]);
        }

        return redirect()->route('myBookings')->with([
            'message' => 'Your appointment request has been submitted. Please wait for admin approval.',
            'alert-class' => 'alert-success',
        ]);
    }

    public function myBookings()
    {
        $bookings = Booking::where('user_id', Auth::id())
            ->orderByDesc('created_at')
            ->get();

        foreach ($bookings as $booking) {
            $booking->status_label = $booking->taken ? 'Approved' : 'Pending approval';
            $booking->status_class = $booking->taken ? 'success' : 'warning';
        }

        return view('myBookings', ['bookings' => $bookings]);
    }

    public function cancelBooking(Request $request)
    {
        $validated = $request->validate([
            'booking_id' => ['required', 'integer', 'exists:bookings,booking_id'],
        ]);

        $booking = Booking::where('booking_id', $validated['booking_id'])
            ->where('user_id', Auth::id())
            ->firstOrFail();

        if ($booking->taken) {
            return redirect()->route('myBookings')->with([
                'message' => 'Approved appointments cannot be cancelled.',
                'alert-class' => 'alert-warning',
            ]);
        }

        $booking->delete();

        return redirect()->route('myBookings')->with([
            'message' => 'Your appointment has been cancelled.',
            'alert-class' => 'alert-success',
        ]);
    }
}