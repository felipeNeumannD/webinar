@extends('Layout.internPattern')
@section('content')

<div class="main1 d-flex justify-content-center align-items-center vh-100">
    <form action="/updateUser" method="POST" class="w-100" style="max-width: 500px;">
        @csrf
        @method('PUT')
        <div class="main p-4 bg-light rounded shadow">
            <h2 class="text-center mb-4">Atualizar Conta</h2>
            <div class="form-group">
                <label for="Name" class="font-weight-bold">Nome:</label>
                <input type="text" class="form-control" name="Name" id="Name" value="{{ $name }}"
                    placeholder="Digite seu nome" required>
            </div>
            <div class="form-group">
                <label for="Email" class="font-weight-bold">Email:</label>
                <input type="email" class="form-control" name="Email" id="Email" value="{{ $mail }}"
                    placeholder="Digite seu email" required>
            </div>
            <div class="form-group">
                <label for="Password" class="font-weight-bold">Senha:</label>
                <input type="password" class="form-control" name="Password" id="Password"
                    placeholder="Digite sua senha" required>
            </div>
            <div class="form-group">
                <label for="Confirm" class="font-weight-bold">Confirme sua senha:</label>
                <input type="password" class="form-control" name="Confirm" id="Confirm"
                    placeholder="Confirme a sua senha" required>
            </div>
            <div class="form-group">
                <label for="Identification" class="font-weight-bold">Identificação:</label>
                <input type="text" class="form-control" name="Identification" id="Identification" value="{{ $companyId }}"
                    placeholder="Digite o seu número" required>
            </div>
            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-primary w-100">Atualizar</button> <!-- Texto do botão modificado -->
            </div>
        </div>
    </form>
</div>

@endsection