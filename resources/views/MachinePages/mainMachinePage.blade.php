@extends('Layout.internPattern')
@section('content')

<div class="main1 d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4"
        style="width: 600px; background-color: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <h2 class="text-center">Lista de máquinas</h2>
        <div class="mt-3">
            <h5>Máquinas Presentes:</h5>
            <table class="table">
                <ul>
                    @foreach ($machines as $machine)
                        <li>
                            {{ $machine->name }}
                            <a href="{{ route('machine.description', $machine->id) }}" class="btn btn-sm btn-info">Ver</a>
                            <a href="{{ route('machines.edit', $machine->id) }}" class="btn btn-sm btn-primary">Editar</a>
                            <form action="{{ route('machines.destroy', $machine->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja deletar esta máquina?');">Deletar</button>
                            </form>
                        </li>
                    @endforeach
                </ul>
            </table>
        </div>
        <div class="text-end mt-4">
            <a href="{{ route('machine.create') }}" class="btn btn-secondary btn-sm">
                Cadastrar Novo
            </a>
        </div>
    </div>
</div>

@endsection