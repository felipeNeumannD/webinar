@extends('Layout.internPattern')
@section('content')

<link rel="stylesheet" href="{{ asset('CSS/gridDisplayer.css') }}">



<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>{{ $machine->name  }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Descrição:</strong> {{ $machine->description }}</p>
        </div>
    </div>

    <div class="mt-4">
        <h4>Cursos Associados</h4>
        <div class="machine-grid">
            @forelse ($machine->courses as $course)
                <div class="select-item" data-id="{{ $course->id }}" onclick="toggleSelection(this)">
                    <h5>{{ $course->name }}</h5>
                </div>
            @empty
                <p class="text-center">Nenhuma máquina associada a esta linha</p>
            @endforelse
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
