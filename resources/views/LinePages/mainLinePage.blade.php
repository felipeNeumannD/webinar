@extends('Layout.internPattern')
@section('content')

<div class="main1 d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4"
        style="width: 600px; background-color: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <h2 class="text-center">Lista de Linhas</h2>
        <div class="mt-3">
            <h5>Linhas Presentes:</h5>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>Descrição</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($userLines as $line)
                        <tr>
                            <td>{{ $line->name }}</td>
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
            <a href="{{ route('line.cadastro') }}" class="btn btn-secondary btn-sm">
                Cadastrar Novo
            </a>
        </div>
    </div>
</div>

@endsection