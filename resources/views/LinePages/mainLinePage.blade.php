@extends('Layout.internPattern')
@section('content')

<link rel="stylesheet" href="{{ asset('CSS/view.css') }}">

<div class="main1 d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4"
        style="width: 600px; background-color: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <h2 class="text-center">Lista de Linhas</h2>
        <div class="mt-3">
            <h5>Linhas Presentes:</h5>
            <table class="table">
                @foreach ($userLines as $line)
                    <div class="selectable-line" data-id="{{ $line->id }}">
                        {{ $line->name }}
                    </div>
                @endforeach
            </table>
        </div>
        <div class="text-end mt-4">
            <button id="verButton" class="btn btn-sm btn-info">Ver</button>
            <button id="editButton" class="btn btn-sm btn-primary">Editar</button>
            <form id="deleteForm" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="button" id="deleteButton" class="btn btn-sm btn-danger">
                    Deletar
                </button>
            </form>
            <a href="{{ route('line.cadastro') }}" class="btn btn-secondary btn-sm">
                Cadastrar Novo
            </a>
        </div>
    </div>
</div>

<script src="{{ asset('JS/selector.js') }}"></script>

@endsection