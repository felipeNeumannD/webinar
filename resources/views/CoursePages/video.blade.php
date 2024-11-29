@extends('layout.coursesContent')

@section('content')
<div class="container">
    <h1>{{ $chapter->description }}</h1>

    @if ($videos->isNotEmpty())
        <!-- Navegação de Vídeos -->
        <div id="video-navigation" class="text-center">
            <button id="prevVideo" class="btn btn-primary" disabled>Anterior</button>
            <button id="nextVideo" class="btn btn-primary">Próximo</button>
        </div>

        <!-- Seção de Vídeo -->
        <div id="videoSection" class="mt-4">
            <video id="mainVideo" controls width="100%">
                <source id="videoSource" src="{{ asset('storage/' . $videos[0]->video) }}" type="video/mp4">
                Seu navegador não suporta o vídeo.
            </video>
            <p id="videoDescription" class="mt-2">{{ $videos[0]->description }}</p>
        </div>
    @else
        <p class="text-danger">Nenhum vídeo disponível para este capítulo.</p>
    @endif

    <!-- Seção de Atividades -->
    <div id="questionsSection" class="mt-4" style="display: none;">
        <h2>Atividades</h2>
        @if ($activities->isNotEmpty())
            <form id="activitiesForm">
                @foreach ($activities as $activity)
                    <div class="card mb-3">
                        <div class="card-header">
                            <strong>{{ $activity->activity_description }}</strong>
                        </div>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">
                                @foreach ($activity->options as $option)
                                    <li class="list-group-item">
                                        <div class="form-check">
                                            <input class="form-check-input" type="radio" name="activity[{{ $activity->id }}]"
                                                value="{{ $option->id }}" id="option-{{ $option->id }}">
                                            <label class="form-check-label" for="option-{{ $option->id }}">
                                                {{ $option->description }}
                                            </label>
                                        </div>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                @endforeach
                <button type="button" id="checkAnswers" class="btn btn-success mt-3">Verificar Respostas</button>
            </form>
        @else
            <p class="text-danger">Nenhuma atividade disponível para este capítulo.</p>
        @endif
    </div>
</div>

<script>
    const videos = @json($videos);
    let currentVideoIndex = 0;

    const mainVideo = document.getElementById('mainVideo');
    const videoDescription = document.getElementById('videoDescription');
    const videoSource = document.getElementById('videoSource');
    const prevButton = document.getElementById('prevVideo');
    const nextButton = document.getElementById('nextVideo');
    const questionsSection = document.getElementById('questionsSection');

    function updateVideo() {
        videoSource.src = `/storage/${videos[currentVideoIndex].video}`;
        videoDescription.textContent = videos[currentVideoIndex].description;

        mainVideo.load();

        prevButton.disabled = currentVideoIndex === 0;
        nextButton.disabled = currentVideoIndex === videos.length - 1;

        questionsSection.style.display = currentVideoIndex === videos.length - 1 ? 'block' : 'none';
    }

    prevButton.addEventListener('click', () => {
        if (currentVideoIndex > 0) {
            currentVideoIndex--;
            updateVideo();
        }
    });

    nextButton.addEventListener('click', () => {
        if (currentVideoIndex < videos.length - 1) {
            currentVideoIndex++;
            updateVideo();
        }
    });

    updateVideo();

    // Verificação de todas as respostas
    document.getElementById('checkAnswers').addEventListener('click', () => {
        const form = document.getElementById('activitiesForm');
        const formData = new FormData(form);

        // Convertendo os dados para um objeto JSON
        const data = {
            _token: '{{ csrf_token() }}',
            activities: {}
        };

        formData.forEach((value, key) => {
            const match = key.match(/^activity\[(\d+)\]$/);
            if (match) {
                const activityId = match[1];
                data.activities[activityId] = value;
            }
        });

        fetch('{{ route("check-answers") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify(data)
        })
        .then(response => response.json())
        .then(result => {
            if (result.correct) {
                alert('Parabéns! Você acertou todas as respostas.');
            } else {
                alert('Algumas respostas estão incorretas. Tente novamente!');
            }
        })
        .catch(error => console.error('Erro ao verificar as respostas:', error));
    });
</script>
@endsection
