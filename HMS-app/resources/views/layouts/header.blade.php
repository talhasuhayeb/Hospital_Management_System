<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>{{ request()->routeIs('myBookings') ? 'My Bookings' : (request()->routeIs('showAppointments', 'appointmentSchedule') ? 'Book an Appointment' : 'eAppointment Care') }}</title>
    
    <!-- Favicons for all devices -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/logo.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/logo.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/logo.png') }}">
    <link rel="shortcut icon" href="{{ asset('assets/logo.png') }}">
    </head>

    <body>
        <style>
            .site-navbar {
                background: #102a43;
                box-shadow: 0 4px 18px rgba(16, 42, 67, 0.18);
            }

            .site-navbar .navbar-brand {
                color: #ffffff;
                font-size: 1.2rem;
                font-weight: 700;
                letter-spacing: 0.02em;
            }

            .site-navbar .brand-mark {
                display: inline-grid;
                width: 2.25rem;
                height: 2.25rem;
                margin-right: 0.65rem;
                place-items: center;
                border-radius: 12px;
                background: #2cb1bc;
                color: #102a43;
                font-size: 1.15rem;
                font-weight: 800;
            }

            .site-navbar .brand-logo {
                display: block;
                width: 3.9rem;
                height: 3.9rem;
                margin-right: 0.15rem;
                object-fit: contain;
            }

            .site-navbar .nav-link {
                margin: 0.2rem 0.2rem;
                padding: 0.55rem 0.9rem !important;
                border-radius: 999px;
                color: #d9e2ec;
                font-weight: 600;
            }

            .site-navbar .nav-link:hover,
            .site-navbar .nav-link.active {
                background: rgba(255, 255, 255, 0.12);
                color: #ffffff;
            }

            .site-navbar .logout-button {
                border: 0;
                background: transparent;
                cursor: pointer;
                font: inherit;
            }

            .site-navbar .user-info {
                margin: 0.2rem 0.2rem;
                padding: 0.55rem 0.9rem;
                color: #9fb3c8;
                font-size: 0.9rem;
                font-weight: 600;
                white-space: nowrap;
            }

            .site-navbar .navbar-toggler {
                border-color: rgba(255, 255, 255, 0.35);
            }

            .site-navbar .navbar-toggler-icon {
                filter: brightness(0) invert(1);
            }

            .site-navbar .navbar-toggler:focus {
                box-shadow: 0 0 0 0.2rem rgba(44, 177, 188, 0.35);
            }
        </style>

        <nav class="navbar navbar-expand-lg site-navbar" aria-label="Main navigation">
            <div class="container-lg py-2">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <img class="brand-logo" src="{{ asset('assets/logo.png') }}" alt="eAppointment Care logo">
                    eAppointment Care
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-lg-center">
                        @auth
                            <li class="nav-item">
                                <span class="user-info">{{ Auth::user()->name }} (ID: {{ Auth::user()->id }})</span>
                            </li>
                        @endauth
                        <li class="nav-item">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" @if(request()->is('/')) aria-current="page" @endif href="{{ url('/') }}">Home</a>
                        </li>
                        @auth
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('myBookings') ? 'active' : '' }}" @if(request()->routeIs('myBookings')) aria-current="page" @endif href="{{ route('myBookings') }}">My Bookings</a>
                            </li>
                            <li class="nav-item">
                                <form method="POST" action="{{ route('logout') }}">
                                    @csrf
                                    <button type="submit" class="nav-link logout-button">Logout</button>
                                </form>
                            </li>
                        @else
                            <li class="nav-item">
                                <a class="nav-link {{ request()->routeIs('login') ? 'active' : '' }}" @if(request()->routeIs('login')) aria-current="page" @endif href="{{ route('login') }}">Log in</a>
                            </li>
                        @endauth
                    </ul>
                </div>
            </div>
        </nav>
