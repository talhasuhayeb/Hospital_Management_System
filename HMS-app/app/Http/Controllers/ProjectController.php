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
        $appointments = Appointment::where('department_id', $departmentId)
            ->orderBy('appointment_date')
            ->get();

        return view('appointments', ['appointments' => $appointments]);


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
            $booking->appointment_date = $appointment->appointment_date;
            $booking->username = Auth::user()->name;
            $booking->user_id = Auth::id();
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

        return redirect()->route('appointmentSchedule', ['department' => $appointment->department_id])->with([
            'message' => 'Your appointment has been confirmed.',
            'alert-class' => 'alert-success',
        ]);
    }
}