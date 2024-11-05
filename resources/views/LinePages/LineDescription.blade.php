@extends('Layout.internPattern')
@section('content')

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
        <table class="table">
            <thead>
                <tr>
                    <th>Nome da Máquina</th>
                    <th>Descrição</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($line->machines as $machine)
                    <tr>
                        <td>{{ $machine->name }}</td>
                        <td>{{ $machine->description }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center">Nenhuma máquina associada a esta linha</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection
