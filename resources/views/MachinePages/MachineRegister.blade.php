@extends('Layout.internPattern')
@section('content')
<link href="CSS/userSuggestions.css" rel="stylesheet">

<div class="main1 d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4"
        style="width: 400px; background-color: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <form action="{{route('machine.store')}}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="nome" class="form-label">Nome da máquina</label>
                <input type="text" class="form-control" id="nome" name="nome" placeholder="Digite o nome">
            </div>
            <div class="mb-3">
                <label for="descricao" class="form-label">Descrição da máquina</label>
                <textarea class="form-control" id="descricao" name="descricao" rows="4"
                    placeholder="Descrição da linha"></textarea>
            </div>
            <div class="mb-3">
                <label for="combobox">Escolha ou digite uma opção:</label>
                <input class="form-control" list="opcoes" id="lineList" name="lineList">
                <datalist id="opcoes">
                    @foreach ( $lines as $line )
                        <option value="{{$line->name}}">
                    @endforeach
                </datalist>
            </div>
            <div class="mb-3">
                <label for="searchUser" class="form-label">Escolher Administrador da máquina</label>
                <div class="position-relative">
                    <input type="text" class="form-control" id="searchUser" name="searchUser"
                        placeholder="Digite o nome do usuário">
                    <div id="userSuggestions" class="list-group position-absolute w-100" style="z-index: 1000;"></div>
                </div>
                <input type="hidden" id="selectedUserMail" name="selectedUserMail">
            </div>

            <div class="d-flex justify-content-center mt-3">
                <button type="submit" class="btn btn-success">Salvar</button>
            </div>
        </form>
    </div>
</div>

<script>
    const searchUserUrl = "{{ route('searchUser') }}";
</script>
<script src="{{ asset('JS/search.js') }}"></script>

@endsection