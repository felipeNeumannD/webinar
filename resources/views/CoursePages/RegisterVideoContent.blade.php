@extends('Layout.coursesContent')
@section('content')

<style>
    .video-card,
    .activity-card {
        border-radius: 8px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        margin-bottom: 20px;
    }

    .video-card:hover,
    .activity-card:hover {
        box-shadow: 0 6px 10px rgba(0, 0, 0, 0.15);
        transition: 0.3s;
    }

    .video-thumbnail {
        height: 200px;
        object-fit: cover;
        border-radius: 8px 8px 0 0;
    }

    .content {
        padding: 20px;
    }
</style>


<div class="container mt-4">
    <section>
        <h2 class="mb-4">Vídeos</h2>
        <div class="row">
            <div class="col-md-4">
                <div class="card video-card">
                    <img src="https://via.placeholder.com/300x200" alt="Thumbnail do Vídeo" class="video-thumbnail">
                    <div class="content">
                        <h5 class="card-title">Título do Vídeo 1</h5>
                        <p class="card-text">Descrição breve do vídeo.</p>
                        <a href="#" class="btn btn-primary">Assistir</a>
                    </div>
                </div>

                <div class="card video-card">
                    <img src="https://via.placeholder.com/300x200" alt="Thumbnail do Vídeo" class="video-thumbnail">
                    <div class="content">
                        @include('CoursePages.RegisterVideo')
                    </div>
                </div>

                @forelse ($videos as $video)
                    <div class="card video-card">
                        <source src="{{ asset('storage/' . $video->video) }}" type="video/mp4">
                        <div class="content">
                            <p class="card-title">{{ $video->description }}</p>
                            <a href="#" class="btn btn-primary">Assistir</a>
                        </div>
                    </div>
                @empty

                @endforelse
            </div>

        </div>
    </section>

    <section class="mt-5">
        <h2 class="mb-4">Atividades</h2>
        <div class="row">
            <div class="col-md-6">
                <div class="card activity-card p-3">
                    <h5 class="card-title">Atividade 1</h5>
                    <p class="card-text">Descrição breve da atividade.</p>
                    <a href="#" class="btn btn-success">Resolver</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card activity-card p-3">
                    <h5 class="card-title">Atividade 2</h5>
                    <p class="card-text">Descrição breve da atividade.</p>
                    <a href="#" class="btn btn-success">Resolver</a>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card activity-card p-3">
                    <h5 class="card-title">Atividade 2</h5>
                    <p class="card-text">Descrição breve da atividade.</p>
                    <a href="#" class="btn btn-success">Resolver</a>
                </div>
            </div>
        </div>
    </section>
</div>

@endsection