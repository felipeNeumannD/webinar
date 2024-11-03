@extends('Layout.internPattern')
@section('content')

<div class="main1 d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4"
        style="width: 600px; background-color: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <h2 class="text-center">Detalhes da Máquina</h2>

        <div class="mt-3">
            <h5>Descrição da máquina:</h5>
            
        </div>

        <div class="mt-3">
            <h5>Cursos da máquina:</h5>
            <table class="table">
                <tbody>
                    @forelse ($machines as $machine)
                        <tr>
                            <td>{{$machine->name}}</td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="3" class="text-center">Nenhuma linha encontrada</td>
                        </tr>
                    @endforelse
                </tbody>
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