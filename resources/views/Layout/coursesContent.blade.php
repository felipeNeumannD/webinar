<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>@yield('title')</title>
    <style>
        body {
            background-color: #212529;
            /* Dark background color */
            color: white;
            /* White text color */
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
            /* White color for navbar elements */
        }

        .hero {
            background-image: url("path/to/your/banner.jpg");
            /* Replace with your banner image path */
            background-size: cover;
            background-position: center;
            min-height: 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.8);
        }

        .hero h1 {
            font-size: 2.5rem;
            /* Increase main text size */
            margin-bottom: 1rem;
        }

        .card-deck {
            display: flex;
            justify-content: center;
            margin-top: 2rem;
        }

        .card {
            margin: 1rem;
            background-color: #343a40;
            /* Darker card background */
            color: white;
            border: none;
        }

        .card-title {
            font-weight: bold;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">WEBINAR</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{ route('mainView')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Seus Cursos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('changeUser')}}">Configurações</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('lines')}}">Linhas de produção</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('machines')}}">Máquinas disponíveis</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('courses')}}">Cursos Disponíveis</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <section class="hero">
        <h1>Bem-vindo ao Webinar!</h1>
        <p>Aprenda e se desenvolva com a gente.</p>
    </section>

    <div class="container">
        <div class="card-deck">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">