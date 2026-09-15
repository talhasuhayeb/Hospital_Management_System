<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;

    protected $primaryKey = 'booking_id';

    protected $fillable = [
        'username',
        'user_id',
        'appointment_id',
        'department_name',
        'appointment_date',
        'status',
        'taken',
    ];

    protected $casts = [
        'taken' => 'boolean',
    ];
}
