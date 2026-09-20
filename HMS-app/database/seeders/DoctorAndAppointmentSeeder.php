<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Department;
use App\Models\Doctor;
use App\Models\Appointment;
use Carbon\Carbon;
use Faker\Factory as Faker;

class DoctorAndAppointmentSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();
        $departments = Department::all();

        // Optional qualifications to randomly assign
        $qualifications = ['MBBS, MD', 'MBBS, FCPS', 'MBBS, MS', 'DO, Board Certified', 'MBBS, MRCP'];

        foreach ($departments as $department) {
            // Create 3 doctors for each department
            for ($i = 0; $i < 3; $i++) {
                $doctor = Doctor::create([
                    'name' => 'Dr. ' . $faker->lastName,
                    'qualification' => $faker->randomElement($qualifications),
                    'department_id' => $department->id,
                ]);

                // Generate appointments for the next 7 days
                for ($day = 0; $day < 7; $day++) {
                    $date = Carbon::now()->addDays($day)->startOfDay();

                    // Generate slots from 17:00 (5:00 PM) to 22:30 (10:30 PM)
                    $times = [
                        '17:00', '17:30', '18:00', '18:30', '19:00', '19:30',
                        '20:00', '20:30', '21:00', '21:30', '22:00', '22:30'
                    ];

                    foreach ($times as $time) {
                        $appointmentTime = $date->copy()->setTimeFromTimeString($time);

                        Appointment::create([
                            'department_id' => $department->id,
                            'department_name' => $department->name,
                            'doctor_id' => $doctor->id,
                            'appointment_date' => $appointmentTime,
                            'taken' => false,
                        ]);
                    }
                }
            }
        }
    }
}
