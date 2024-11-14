@extends('Layout.internPattern')
@section('content')

<link rel="stylesheet" href="{{ asset('css/view.css') }}">

<div class="main1 d-flex justify-content-center align-items-center vh-100">
    <div class="card-list-container">
        <h2 class="text-center">Lista de Linhas</h2>
        <div class="mt-3">
            <h5>Linhas Presentes:</h5>
            @foreach ($userLines as $line)
                <div class="selectable-line" data-id="{{ $line->id }}">
                    {{ $line->name }}
                </div>
                <div class="button-container">
                    <button class="btn btn-sm btn-info">Ver</button>
                    <button class="btn btn-sm btn-primary">Editar</button>
                    <form method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-sm btn-danger">
                            Deletar
                        </button>
                    </form>
                </div>
            @endforeach
        </div>
        <div class="text-end mt-4">
            <a href="{{ route('line.cadastro') }}" class="btn btn-secondary btn-sm">
                Cadastrar Novo
            </a>
        </div>
    </div>
</div>

<script src="{{ asset('JS/selector.js') }}"></script>

@endsection