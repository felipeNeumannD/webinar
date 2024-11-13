@extends('Layout.internPattern')
@section('content')

<link rel="stylesheet" href="{{ asset('CSS/gridDisplayer.css') }}">

<div class="main1 d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4"
        style="width: 600px; background-color: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <h2 class="text-center">Detalhes da Máquina</h2>

        <div class="container">
            <p><strong>Nome:</strong> {{ $machine->name }}</p>
            <p><strong>Descrição:</strong> {{ $machine->description }}</p>
            <a href="{{ route('machines') }}" class="btn btn-secondary">Voltar para Lista de Máquinas</a>
        </div>

        <div class="mt-3">
            <h5>Cursos da máquina:</h5>
            <table class="table">
                <tbody>
                    @forelse ($machine->courses as $course)
                        <tr>
                            <td>{{ $course->name }}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Nenhum curso encontrado</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <div class="text-end mt-4">
            <a href="{{ route('course.create',["id" => $machine->id]) }}" class="btn btn-secondary btn-sm">
                Cadastrar Novo Curso
            </a>
        </div>
    </div>
</div>

<script src="{{ asset('JS/gridSelector.js') }}"></script>

@endsection
