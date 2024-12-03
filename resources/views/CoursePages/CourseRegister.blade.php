@extends('Layout.internPattern')
@section('content')
<link href="CSS/userSuggestions.css" rel="stylesheet">

<div class="main1 d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4"
        style="width: 400px; background-color: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <form action="{{route('course.store', ['id' => $id])}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Nome</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome">
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4"
                    placeholder="Descrição da linha"></textarea>
            </div>
            <div class="mb-3">
                <label for="searchUser" class="form-label">Buscar Usuário</label>
                <div class="position-relative">
                    <input type="text" class="form-control" id="searchUser" name="searchUser"
                        placeholder="Digite o nome do usuário">
                    <div id="userSuggestions" class="list-group position-absolute w-100" style="z-index: 1000;"></div>
                </div>
                <input type="hidden" id="selectedUserMail" name="selectedUserMail">
            </div>
            <div class="mb-3">
                <label for="videopercent">Porcentagem mínima para os vídeos:</label>
                <input class="form-control" type="text" id="videopercent" name="videopercent">
            </div>
            <div class="mb-3">
                <input type="checkbox" id="mostrar_opcoes" name="mostrar_opcoes" value="valor">
                <label for="nome_do_checkbox">O curso terá questões?</label>
            </div>
            <div style="display: none;" class="mb-3" id="opcoes-extras">
                <label for="campo-extra">Porcentagem mínima para as atividades:</label>
                <input class="form-control" type="text" id="campo-extra" name="campo_extra">
            </div>

            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
</div>

<script>
    const searchUserUrl = "{{ route('old-search-users') }}";
</script>

<script>
    const checkbox = document.getElementById('mostrar_opcoes');
    checkbox.set
    
    const opcoesExtras = document.getElementById('opcoes-extras');

    checkbox.addEventListener('change', function () 
    {
        if ( this.checked ) 
        {
            opcoesExtras.style.display = 'block';
        } else {
            opcoesExtras.style.display = 'none';
        }
    });

</script>


<script src="{{ asset('JS/search.js') }}"></script>

@endsection