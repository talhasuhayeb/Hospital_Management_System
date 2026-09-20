<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    protected $fillable = [
        'department_id',
        'department_name',
        'doctor_id',
        'appointment_date',
        'taken',
    ];

    public function doctor()
    {
        return $this->belongsTo(Doctor::class);
    }
}
