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
    <div id="questionsSection" class="mt-4">
        <h2>Atividades</h2>
        @if ($activities->isNotEmpty())
            <form id="activitiesForm">
                @foreach ($activities as $activity)
                    <div class="card mb-3">
                        <div class="card-header">
                            <strong>{{ $activity->activity_description }}</strong>
                        </div>
                        <div class="card-body">
                            <input type="hidden" name="correct_option[{{ $activity->id }}]"
                                value="{{ $activity->correct_option_id }}">
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


    <script>
    const videos = @json($videos);
    let currentVideoIndex = 0;

    const mainVideo = document.getElementById('mainVideo');
    const videoDescription = document.getElementById('videoDescription');
    const videoSource = document.getElementById('videoSource');
    const prevButton = document.getElementById('prevVideo');
    const nextButton = document.getElementById('nextVideo');
    const questionsSection = document.getElementById('questionsSection');
    let percentageWatched = 0;

    function updateVideo() {
        videoSource.src = `/storage/${videos[currentVideoIndex].video}`;
        videoDescription.textContent = videos[currentVideoIndex].description;

        mainVideo.load();
        mainVideo.play();

        prevButton.disabled = currentVideoIndex === 0;
        nextButton.disabled = currentVideoIndex === videos.length - 1;

        questionsSection.style.display = currentVideoIndex === videos.length - 1 ? 'block' : 'none';
    }

    function saveVideoProgress(percentage) {
        fetch('{{ route("video.progress") }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify({
                videoId: videos[currentVideoIndex].id,
                percentage: percentage,
            }),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(data => console.log('Progresso salvo:', data))
            .catch(error => console.error('Erro ao salvar progresso:', error));
    }

    // Atualiza a porcentagem assistida do vídeo
    mainVideo.addEventListener('timeupdate', () => {
        const currentTime = mainVideo.currentTime;
        const duration = mainVideo.duration;

        if (duration > 0) {
            percentageWatched = Math.round((currentTime / duration) * 100);
        }
    });

    // Salva o progresso quando o vídeo é pausado
    mainVideo.addEventListener('pause', () => saveVideoProgress(percentageWatched));

    // Salva o progresso e avança para o próximo vídeo ao final
    mainVideo.addEventListener('ended', () => {
        saveVideoProgress(100);

        if (currentVideoIndex < videos.length - 1) {
            currentVideoIndex++;
            updateVideo();
        } else {
            alert('Você concluiu todos os vídeos deste capítulo!');
        }
    });

    // Navegação de vídeos
    prevButton.addEventListener('click', () => {
        if (currentVideoIndex > 0) {
            saveVideoProgress(percentageWatched); // Salva o progresso antes de mudar
            currentVideoIndex--;
            updateVideo();
        }
    });

    nextButton.addEventListener('click', () => {
        if (currentVideoIndex < videos.length - 1) {
            saveVideoProgress(percentageWatched); // Salva o progresso antes de mudar
            currentVideoIndex++;
            updateVideo();
        }
    });

    updateVideo();

    // Verificação de respostas
    document.getElementById('checkAnswers').addEventListener('click', () => {
        const form = document.getElementById('activitiesForm');
        const formData = new FormData(form);

        const data = {
            activities: {}, // Respostas do usuário
            correct_options: {}, // IDs corretos
        };

        formData.forEach((value, key) => {
            const matchActivity = key.match(/^activity\[(\d+)\]$/);
            const matchCorrectOption = key.match(/^correct_option\[(\d+)\]$/);

            if (matchActivity) {
                const activityId = matchActivity[1];
                data.activities[activityId] = value; // ID da resposta do usuário
            }

            if (matchCorrectOption) {
                const activityId = matchCorrectOption[1];
                data.correct_options[activityId] = value; // ID da opção correta
            }
        });

        fetch('{{ route("check-answers", ["id" => $chapter->id]) }}', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: JSON.stringify(data),
        })
            .then(response => {
                if (!response.ok) {
                    throw new Error(`HTTP error! status: ${response.status}`);
                }
                return response.json();
            })
            .then(result => {
                if (result.success) {
                    alert(`Você acertou ${result.correctAnswers} de ${result.totalActivities} atividades.`);
                } else {
                    alert('Algumas respostas estão incorretas. Tente novamente.');
                }
            })
            .catch(error => console.error('Erro ao verificar as respostas:', error));
    });
</script>

@endsection