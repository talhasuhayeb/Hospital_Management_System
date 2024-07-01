@extends('layouts.main')

@section('content')



<div class="container-lg" style="margin: 0 auto">

    <h2 class="text-center mt-2 md-2" style="font-family:Helvetica ,Arial">My Bookings</h2>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">Booking id</th>
                <th scope="col">Appointment id</th>
                <th scope="col">Department name</th>
                <th scope="col">Appointment date</th>
            </tr>
        </thead>
        <tbody>
            @foreach($bookings as $booking)
                <tr>
                <th scope="row">{{$booking->id}}</th>
                <td>{{$booking->appointment_id}}</td>
                <td>{{$booking->department_name}}</td>
                <td>{{$booking->appointment_date}}</td>
                <td>
                    <form method="POST" action="{{ route('cancelBooking') }}">
                        @csrf
                        <input type="text" style="display:none" value="{{$booking->id}}" name="booking_id"/>
                        <input type="text" style="display:none" value="{{$booking->appointment_id}}" name="appointment_id"/>
                        <input type="submit" value="cancel" class="btn btn-danger"/>
                    </form>
                </td>
                
                
            @endforeach

        </tbody>
    </table>






</div>



@endsection