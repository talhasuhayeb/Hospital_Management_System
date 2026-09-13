@extends('layouts.main')

@section('content')



<<<<<<< HEAD
<style>
    .department-card {
        overflow: hidden;
        border: 0;
        border-radius: 18px;
        box-shadow: 0 10px 28px rgba(31, 41, 55, 0.12);
        transition: transform 180ms ease, box-shadow 180ms ease;
    }

    .department-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 16px 34px rgba(31, 41, 55, 0.18);
    }

    .department-card-image {
        display: block;
        width: 100%;
        height: 100%;
        max-width: 100%;
        margin: 0 auto;
        object-fit: cover;
    }

    .department-card-image-wrap {
        width: 100%;
        max-width: 500px;
        aspect-ratio: 1 / 1;
        margin: 0 auto;
        overflow: hidden;
    }

    .department-card .card-body {
        padding: 1.5rem;
    }

    .department-card .card-title {
        margin-bottom: 0.6rem;
        color: #172033;
        font-size: 1.35rem;
        font-weight: 700;
    }

    .department-card .card-text {
        min-height: 3rem;
        color: #64748b;
        line-height: 1.6;
    }

    .department-card .btn {
        border: 0;
        border-radius: 999px;
        padding: 0.65rem 1.2rem;
        font-weight: 600;
    }

    .appointment-heading {
        margin: 3rem 0 0.5rem;
        color: #102a43;
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: 800;
        text-align: center;
    }
</style>

<div id="departments" class="container-lg" style="margin: 0 auto;">
    <h1 class="appointment-heading">Make an Appoinment</h1>
    <div class="row mt-5">

        @foreach($departments as $department)

        <div class="col-lg-4 col-md-6 col-sm-12 text-center mb-4">
            <div class="card department-card" style="margin-top: 50px;">
                <div class="department-card-image-wrap">
                    <img src="{{$department->image}}" alt="{{ $department->name }}" class="department-card-image" />
                </div>
=======
<div class="container-lg" style="margin: 0 auto;">
    
@if(Session::has('message'))
<p class="alert {{Session::get('alert-class','alert-info')}}">{{Session::get('message')}}</p>
@endif


<div class="row mt-5">

        @foreach($departments as $department)

        <div class="col-lg-4 col-md-4 col-sm-12 text-center md-3 ">
            <div class="card" style="width: 18 rem ; margin-top:  50px;">
                <img src="{{$department->image}}" alt="" style="width:100% ; margin:0 auto" />
>>>>>>> 02a6385bd315955646f0b015c2609bb1bf03d720
                <div class="card-body">
                    <div class="card-title">{{ $department->name}}</div>
                    <div class="card-text">{{ $department->description}}</div>

                    <form method="post" action="{{ route('showAppointments') }}" class="mt-3">
                        @csrf
                        <input type="text" name="department_id" value="{{$department->id}}" style="display:none" />
                        <input type="submit" value="Show Appointments" class="btn btn-primary" />
                    </form>


                </div>
            </div>
        </div>

        @endforeach


    </div>
</div>



@endsection