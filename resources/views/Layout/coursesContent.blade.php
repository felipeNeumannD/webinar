@extends('Layout.internPattern')

@section('title', 'Cursos Disponíveis')

@section('content')
<style>
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
        flex-wrap: wrap;
    }

    .card {
        margin: 1rem;
        background-color: #343a40;
        color: white;
        border: none;
        width: 18rem;
    }

    .card-title {
        font-weight: bold;
    }
</style>

<div class="hero">
    <h1>Bem-vindo aos Cursos Disponíveis</h1>
    <p>Explore os cursos disponíveis para sua capacitação.</p>
</div>

<div class="card-deck">
    @foreach ($courses as $course)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $course->name }}</h5>
            <p class="card-text">{{ $course->description }}</p>
            <a href="{{ route('course.details', ['id' => $course->id]) }}" class="btn btn-primary">Saiba Mais</a>
        </div>
    </div>
    @endforeach
</div>
@endsection