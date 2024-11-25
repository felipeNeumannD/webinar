<!DOCTYPE html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>

    <title>@yield('title')</title>
    <style>
        html {
            height: 100%
        }

        body {
            background-color: #212529;
            color: white;
            height: 100%
        }

        .navbar-brand,
        .nav-link {
            color: white !important;
        }

        .hero {
            background-image: url("path/to/your/banner.jpg");
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

    <main class="container mt-1" style="heigh:500px">
        @yield('content')
    </main>

</body>