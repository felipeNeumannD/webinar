@extends('Layout.coursesContent')
@section('content')

<link rel="stylesheet" href="{{ asset('CSS/RegisterClassStyle.css') }}">

<div class="container mt-4">
    <section>
        <div class="form-section mb-4">
            <form id="chapterForm">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label section-header">Nome da Aula</label>
                    <input type="text" id="name" name="name" class="form-control"
                        placeholder="Escreva o nome da aula aqui...">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label section-header">Descrição da Aula</label>
                    <textarea id="description" name="description" rows="4" class="form-control"
                        placeholder="Escreva a descrição da aula aqui..."></textarea>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Vídeos</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoModal">Adicionar
                Vídeo</button>
        </div>

        <div id="videosList" class="row"></div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2>Atividades</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                data-bs-target="#activityModal">Adicionar
                Atividade</button>
        </div>

        <div id="ActivitiesList" class="row"></div>

        <div class="mt-5">
            <button type="button" class="btn btn-success" id="submitData">Registrar</button>
        </div>
    </section>
</div>


<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addVideoForm" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Adicionar Vídeo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="videoDescription" class="form-label">Descrição do Vídeo</label>
                        <textarea id="videoDescription" rows="4" class="form-control"
                            placeholder="Digite a descrição"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="videoFile" class="form-label">Arquivo do Vídeo</label>
                        <input type="file" id="videoFile" class="form-control" accept="video/*">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Adicionar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<div class="modal fade" id="activityModal" tabindex="-1" aria-labelledby="activityModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addActivityForm">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="activityModalLabel">Adicionar Atividade</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="activityDescription" class="form-label">Descrição da Atividade</label>
                        <textarea id="activityDescription" rows="4" class="form-control"
                            placeholder="Digite a descrição da atividade"></textarea>
                    </div>
                    <div id="optionsContainer">
                        <div class="d-flex align-items-center mb-2">
                            <input type="text" class="form-control option-input me-2" placeholder="Digite a opção">
                            <input type="radio" name="correctOption" class="form-check-input"
                                title="Marcar como correta">
                            <button type="button" class="btn btn-danger btn-sm ms-2 remove-option">Remover</button>
                        </div>
                    </div>
                    <button type="button" id="addOptionButton" class="btn btn-secondary btn-sm mt-2">Adicionar
                        Opção</button>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary">Adicionar Atividade</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    let videos = [];

    document.getElementById('addVideoForm').addEventListener('submit', (event) => {
        event.preventDefault();
        const videoDescription = document.getElementById('videoDescription').value;
        const videoFile = document.getElementById('videoFile').files[0];

        if (videoDescription && videoFile) {
            videos.push({ description: videoDescription, file: videoFile });
            renderVideos();
            document.getElementById('addVideoForm').reset();
            bootstrap.Modal.getInstance(document.getElementById('videoModal')).hide();
        } else {
            alert('Preencha todos os campos e selecione um arquivo.');
        }
    });

    // Renderizar Vídeos
    function renderVideos() {
        const videosList = document.getElementById('videosList');
        videosList.innerHTML = '';
        videos.forEach((video, index) => {
            videosList.innerHTML += `
                <div class="col-md-4">
                    <div class="card video-card">
                        <div class="content p-3">
                            <p class="card-text">${video.description}</p>
                            <button class="btn btn-danger" onclick="deleteVideo(${index})">Remover</button>
                        </div>
                    </div>
                </div>
            `;
        });
    }

    // Remover Vídeo
    function deleteVideo(index) {
        videos.splice(index, 1);
        renderVideos();
    }


    
    //Atividades



    let activities = [];

    document.getElementById('addOptionButton').addEventListener('click', () => {
        const optionsContainer = document.getElementById('optionsContainer');
        const optionHTML = `
        <div class="d-flex align-items-center mb-2">
            <input type="text" class="form-control option-input me-2" placeholder="Digite a opção">
            <input type="radio" name="correctOption" class="form-check-input" title="Marcar como correta">
            <button type="button" class="btn btn-danger btn-sm ms-2 remove-option">Remover</button>
        </div>`;
        optionsContainer.insertAdjacentHTML('beforeend', optionHTML);


        const removeButtons = document.querySelectorAll('.remove-option');
        removeButtons[removeButtons.length - 1].addEventListener('click', (event) => {
            event.target.parentElement.remove();
        });
    });


    function renderActivities() {
        const activitiesList = document.getElementById('ActivitiesList');
        activitiesList.innerHTML = '';
        activities.forEach((activity, index) => {
            const optionsHTML = activity.options
                .map(
                    (option, i) =>
                        `<li>${option} ${i === activity.correctOption ? '(Correta)' : ''}</li>`
                )
                .join('');
            activitiesList.innerHTML += `
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">${activity.description}</h5>
                        <ul>${optionsHTML}</ul>
                        <button class="btn btn-danger btn-sm" onclick="deleteActivity(${index})">Remover</button>
                    </div>
                </div>
            </div>`;
        });
    }

    function deleteActivity(index) {
        activities.splice(index, 1);
        renderActivities();
    }

    document.getElementById('addActivityForm').addEventListener('submit', (event) => {
        event.preventDefault();

        const activityDescription = document.getElementById('activityDescription').value;
        const options = [...document.querySelectorAll('.option-input')].map((input) => input.value);
        const correctOptionIndex = [...document.getElementsByName('correctOption')].findIndex((radio) => radio.checked);

        if (!activityDescription || options.length === 0 || correctOptionIndex === -1) {
            alert('Preencha a descrição, adicione opções e selecione a correta.');
            return;
        }

        const activity = {
            description: activityDescription,
            options: options,
            correctOption: correctOptionIndex,
        };

        activities.push(activity);
        renderActivities();
        document.getElementById('addActivityForm').reset();
        document.getElementById('optionsContainer').innerHTML = '';
        bootstrap.Modal.getInstance(document.getElementById('activityModal')).hide();
    });


    document.getElementById('submitData').addEventListener('click', () => {
        const chapterName = document.getElementById('name').value;
        const chapterDescription = document.getElementById('description').value;

        // Validação de dados
        if (!chapterName || !chapterDescription) {
            alert('Preencha o nome e a descrição da aula!');
            return;
        }

        const payload = new FormData();
        payload.append('chapterName', chapterName);
        payload.append('chapterDescription', chapterDescription);

        // Adicionando os vídeos ao payload
        videos.forEach((video, index) => {
            payload.append(`videos[${index}][description]`, video.description);
            payload.append(`videos[${index}][file]`, video.file);
        });

        // Adicionando as atividades ao payload
        activities.forEach((activity, index) => {
            payload.append(`activities[${index}][description]`, activity.description);
            activity.options.forEach((option, optionIndex) => {
                payload.append(`activities[${index}][options][${optionIndex}]`, option);
            });
            payload.append(`activities[${index}][correct_option]`, activity.correctOption);
        });

        // Realizando o envio com fetch
        fetch('{{ route('class.store', [$idCourse]) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}',
            },
            body: payload,
        })
            .then((response) => response.json())
            .then((data) => {
                alert('Dados registrados com sucesso!');

                // Resetando as variáveis e renderizando as listas novamente
                videos = [];
                activities = [];
                renderVideos();
                renderActivities();

                // Limpando os campos de entrada
                document.getElementById('name').value = '';
                document.getElementById('description').value = '';
            })
            .catch((error) => {
                console.error('Erro ao registrar os dados:', error);
                alert('Ocorreu um erro ao registrar os dados.');
            });
    });

</script>

@endsection