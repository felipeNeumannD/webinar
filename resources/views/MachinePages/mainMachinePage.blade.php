@extends('Layout.internPattern')
@section('content')

<div class="main1 d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4"
        style="width: 600px; background-color: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <h2 class="text-center">Lista de máquinas</h2>
        <div class="mt-3">
            <h5>Máquinas Presentes:</h5>
            <table class="table">
                <tbody>
                    @forelse ($userLines as $line)
                        <tr>
                            <td>
                                <form action="{{ route('machine.description') }}" method="GET">
                                    <input type="hidden" name="line_id" value="{{ $line->id }}">
                                    <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ $line->name }}</button>
                                </form>
                            </td>
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