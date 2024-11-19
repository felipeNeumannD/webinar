<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        body {
            background: #a0d3a3;
            height: 100%;
            margin: 0;
        }

        .navbar {
            background-color: #ffffff;
            padding: 10px;
        }

        .navbar .navbar-brand {
            font-size: 1.5rem;
            font-weight: bold;
            color: #333;
        }

        .navbar-nav .nav-item .nav-link {
            color: #333;
            background-color: #f0f0f0;
            padding: 10px 15px;
            margin: 0 5px;
            border-radius: 8px;
            transition: background-color 0.3s;
        }

        .navbar-nav .nav-item .nav-link:hover {
            background-color: #d9d9d9;
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <title>Fruki Bebidas - @yield('title')</title>
</head>

<body>
<<<<<<< HEAD
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
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
=======
    <div class="container mt-4">
        <nav class="navbar navbar-expand-lg">
            <div class="container-fluid">
                <a class="navbar-brand" href="{{ route('mainView')}}">Fruki Bebidas</a>
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
>>>>>>> af291813463511ff9b7001ea7a1161318a9cf81c
            </div>
        </div>
    </nav>

    <div>
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>

</html>