<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/',[ProjectController::class,'getAllDepartments']);

Route::post('/showAppointments', [ProjectController::class,'showAppointments'])->name('showAppointments')->middleware('auth');

Route::get('/appointments/{department}', [ProjectController::class, 'showAppointments'])
	->name('appointmentSchedule')
	->middleware('auth');

Route::post('/bookAppointments', [ProjectController::class,'bookAppointment'])->name('bookAppointments')->middleware('auth');

Route::get('/my-bookings', [ProjectController::class, 'myBookings'])->name('myBookings')->middleware('auth');
Route::post('/cancel-booking', [ProjectController::class, 'cancelBooking'])->name('cancelBooking')->middleware('auth');