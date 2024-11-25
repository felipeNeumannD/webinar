@extends('Layout.coursesContent')
@section('content')

<link rel="stylesheet" href="{{ asset('CSS/RegisterClassStyle.css') }}">

<div class="container mt-4">
    <section>
        <div class="form-section mb-4">
            <form id="courseForm">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Nome do Curso</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Escreva o nome do curso aqui...">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Descrição do Curso</label>
                    <textarea id="description" name="description" rows="4" class="form-control"
                              placeholder="Escreva a descrição do curso aqui..."></textarea>
                </div>
            </form>
        </div>

        <div class="d-flex justify-content-between align-items-center mb-4">
            <h2 class="section-header">Vídeos</h2>
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#videoModal">Adicionar Vídeo</button>
        </div>

        <div id="videosList" class="row"></div>

        <div class="mt-5">
            <button type="button" class="btn btn-success" id="submitData">Registrar</button>
        </div>
    </section>
</div>

<!-- Modal para Adicionar Vídeo -->
<div class="modal fade" id="videoModal" tabindex="-1" aria-labelledby="videoModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <form id="addVideoForm" enctype="multipart/form-data">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Adicionar Vídeo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="videoName" class="form-label">Nome do Vídeo</label>
                        <input type="text" id="videoName" class="form-control" placeholder="Digite o nome do vídeo">
                    </div>
                    <div class="mb-3">
                        <label for="videoDescription" class="form-label">Descrição do Vídeo</label>
                        <textarea id="videoDescription" rows="4" class="form-control" placeholder="Digite a descrição"></textarea>
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

<script>
    let videos = [];

    // Adicionar Vídeo
    document.getElementById('addVideoForm').addEventListener('submit', (event) => {
        event.preventDefault();
        const videoName = document.getElementById('videoName').value;
        const videoDescription = document.getElementById('videoDescription').value;
        const videoFile = document.getElementById('videoFile').files[0];

        if (videoName && videoDescription && videoFile) {
            videos.push({ name: videoName, description: videoDescription, file: videoFile });
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
                            <h5 class="card-title">${video.name}</h5>
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

    // Submeter Dados
    document.getElementById('submitData').addEventListener('click', () => {
        const courseName = document.getElementById('name').value;
        const courseDescription = document.getElementById('description').value;

        if (!courseName || !courseDescription) {
            alert('Preencha o nome e a descrição do curso!');
            return;
        }

        const payload = new FormData();
        payload.append('courseName', courseName);
        payload.append('courseDescription', courseDescription);

        videos.forEach((video, index) => {
            payload.append(`videos[${index}][name]`, video.name);
            payload.append(`videos[${index}][description]`, video.description);
            payload.append(`videos[${index}][file]`, video.file);
        });

        fetch('{{ route('class.store', [$idCourse]) }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: payload
        })
            .then(response => response.json())
            .then(data => {
                alert('Dados registrados com sucesso!');
                console.log(data);
                videos = [];
                renderVideos();
                document.getElementById('name').value = '';
                document.getElementById('description').value = '';
            })
            .catch(error => {
                console.error('Erro ao registrar os dados:', error);
                alert('Ocorreu um erro ao registrar os dados.');
            });
    });
</script>

@endsection
