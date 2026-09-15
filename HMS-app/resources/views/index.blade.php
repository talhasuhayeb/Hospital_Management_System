@extends('layouts.main')

@section('content')



<style>
    .home-page {
        min-height: calc(100vh - 80px);
        padding-bottom: 4rem;
        background: #f5f8fb;
        font-family: 'Inter', sans-serif;
    }

    .home-hero {
        position: relative;
        display: flex;
        min-height: 360px;
        align-items: flex-end;
        margin-bottom: 3.5rem;
        padding: clamp(2rem, 6vw, 5rem) 0;
        overflow: hidden;
        background: linear-gradient(90deg, rgba(16, 42, 67, .94) 0%, rgba(16, 42, 67, .72) 45%, rgba(16, 42, 67, .22) 100%), url('https://images.unsplash.com/photo-1576091160550-2173dba999ef?auto=format&fit=crop&w=1800&q=85') center/cover;
    }

    .home-hero-content {
        max-width: 760px;
        color: #fff;
    }

    .home-eyebrow {
        margin-bottom: .75rem;
        color: #8de3df;
        font-size: .78rem;
        font-weight: 800;
        letter-spacing: .14em;
    }

    .home-hero h1 {
        max-width: 680px;
        margin: 0;
        font-size: clamp(2.25rem, 5vw, 4rem);
        font-weight: 800;
        line-height: 1.05;
    }

    .home-hero p {
        max-width: 590px;
        margin: 1rem 0 0;
        color: #e6fffa;
        font-size: 1.08rem;
        line-height: 1.65;
    }

    .home-content {
        padding: 0 1rem;
    }

    .departments-heading {
        margin: 0;
        color: #102a43;
        font-size: clamp(1.8rem, 4vw, 2.5rem);
        font-weight: 800;
    }

    .departments-copy {
        max-width: 620px;
        margin: .65rem 0 2rem;
        color: #627d98;
        font-size: 1.05rem;
    }

    .department-card {
        overflow: hidden;
        height: 100%;
        border: 1px solid #e1e8ed;
        border-radius: 18px;
        background: #fff;
        box-shadow: 0 18px 40px rgba(16, 42, 67, .08);
        transition: transform 180ms ease, box-shadow 180ms ease;
    }

    .department-card:hover {
        transform: translateY(-6px);
        box-shadow: 0 22px 44px rgba(16, 42, 67, .14);
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
        height: 210px;
        margin: 0 auto;
        overflow: hidden;
    }

    .department-card .card-body {
        display: flex;
        min-height: 205px;
        flex-direction: column;
        padding: 1.5rem;
    }

    .department-card .card-title {
        margin-bottom: 0.6rem;
        color: #102a43;
        font-size: 1.35rem;
        font-weight: 700;
    }

    .department-card .card-text {
        color: #627d98;
        line-height: 1.6;
    }

    .department-card .btn {
        border: 0;
        border-radius: 12px;
        padding: 0.65rem 1.2rem;
        background: #102a43;
        font-weight: 800;
    }

    .department-card .btn:hover,
    .department-card .btn:focus {
        background: #2cb1bc;
        color: #102a43;
    }

    .department-card form {
        margin-top: auto !important;
    }
</style>

<main class="home-page">
    <section class="home-hero">
        <div class="container-lg">
            <div class="home-hero-content">
                <h1>Healthcare that works around you.</h1>
                <p>Find the right department, choose a convenient time, and take the next step in your care with confidence.</p>
            </div>
        </div>
    </section>

    <section id="departments" class="container-lg home-content">
        <div class="home-eyebrow">Explore your care options</div>
        <h2 class="departments-heading">Choose a department</h2>
        <p class="departments-copy">Browse our specialist departments and find an appointment that fits your schedule.</p>
        <div class="row g-4">

        @foreach($departments as $department)

        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="card department-card">
                <div class="department-card-image-wrap">
                    <img src="{{ $department->image }}" alt="{{ $department->name }}" class="department-card-image" loading="lazy" />
                </div>
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
    </section>
</main>



@endsection