@extends('Layout.internPattern')
@section('content')

<link rel="stylesheet" href="{{ asset('CSS/gridDisplayer.css') }}">

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>{{ $line->name }}</h2>
        </div>
        <div class="card-body">
            <p><strong>Descrição:</strong> {{ $line->description }}</p>
        </div>
    </div>

    <div class="mt-4">
        <h4>Máquinas Associadas</h4>
        <div class="generic-grid">
            @forelse ($line->machines as $machine)
                <div class="select-item" data-id="{{ $machine->id }}" onclick="toggleSelection(this)">
                    <h5>{{ $machine->name }}</h5>
                </div>
            @empty
                <p class="text-center">Nenhuma máquina associada a esta linha</p>
            @endforelse
        </div>
    </div>
</div>
<script src="{{ asset('JS/gridSelector.js') }}"></script>

@endsection