<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Document</title>
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

            .site-navbar .navbar-toggler {
                border-color: rgba(255, 255, 255, 0.35);
            }

            .site-navbar .navbar-toggler:focus {
                box-shadow: 0 0 0 0.2rem rgba(44, 177, 188, 0.35);
            }
        </style>

        <nav class="navbar navbar-expand-lg site-navbar" aria-label="Main navigation">
            <div class="container-lg py-2">
                <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                    <span class="brand-mark" aria-hidden="true">+</span>
                    eAppointment Care
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                    aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav ms-auto align-items-lg-center">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="{{ url('/') }}">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#departments">Departments</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>