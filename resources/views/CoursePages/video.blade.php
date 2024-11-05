@extends('Layout.internPattern')
@section('content')

<div class="main1 d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4"
        style="width: 600px; background-color: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <h1>Lista de Vídeos</h1>
        @foreach ($videos as $video)
                <h2>{{ $video->description }}</h2>
                <p>Curso ID: {{ $video->course_id }}</p>
                <video width="400px" height="300px" controls>
                    <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                    Seu navegador não suporta a tag de vídeo.
                </video>
            <hr>
        @endforeach
    </div>
</div>

@endsection