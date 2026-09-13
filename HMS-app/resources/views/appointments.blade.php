@extends('layouts.main')

@section('content')



<div class="container-lg" style="margin: 0 auto">

    <h2 class="text-center mt-2 md-2" style="font-family:Helvetica ,Arial">Appointment Schedule</h2>
    <table class="table table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Department Name</th>
                <th scope="col">Appointment Date</th>
                <th scope="col">Taken</th>
            </tr>
        </thead>
        <tbody>
            @foreach($appointments as $appointment)
            <tr>
                <th scope="row">{{$appointment->id}}</th>
                <td>{{$appointment->department_name}}</td>
                <td>{{$appointment->appointment_date}}</td>
                @if($appointment->taken)
<<<<<<< HEAD
                <td>you can't book this</td>
=======
                <td>Already been taken</td>
>>>>>>> 02a6385bd315955646f0b015c2609bb1bf03d720
                @else
                <td>
                    <form method="post" action="{{ route('bookAppointments') }}">
                        @csrf
<<<<<<< HEAD
                        <input type="hidden" value="{{$appointment->id}}" name="appointment_id" />
                        <input type="hidden" value="{{$appointment->department_name}}" name="department_name" />
                        <input type="hidden" value="{{$appointment->appointment_date}}" name="appointment_date" />
                        <button type="submit" class="btn btn-primary">Book appointment</button>
=======
                        <input type="text" style="display:none;" value="{{$appointment->id}}" name="appointment_id" />
                        <input type="text" style="display:none;" value="{{$appointment->department_name}}"
                            name="department_name" />
                        <input type="text" style="display:none;" value="{{$appointment->appointment_date}}"
                            name="appointment_date" />
                        <input type="submit" value="book" class="btn btn-primary" />
>>>>>>> 02a6385bd315955646f0b015c2609bb1bf03d720
                    </form>
                </td>
                @endif
            </tr>

            @endforeach

        </tbody>
    </table>






</div>



@endsection