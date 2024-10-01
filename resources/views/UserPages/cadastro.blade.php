@extends('Layout.main')
<link href="CSS/SignUp.css" rel="stylesheet">

@section('content')

<div class="main1 d-flex justify-content-center align-items-center vh-100">
    <form action="/cadastrando" method="POST" class="w-100" style="max-width: 500px;">
        @csrf
        <div class="main p-4 bg-light rounded shadow">
            <h2 class="text-center mb-4">Criar Conta</h2>
            <div id="nameInsert" class="form-group">
                <label for="Name" class="font-weight-bold">Nome:</label>
                <input type="text" class="form-control" name="Name" id="Name" placeholder="Digite seu nome" required>
            </div>

            <div id="emailInsert" class="form-group">
                <label for="Email" class="font-weight-bold">Email:</label>
                <input type="email" class="form-control" name="Email" id="Email" placeholder="Digite seu email" required>
            </div>

            <div id="passwordInsert" class="form-group">
                <label for="Password" class="font-weight-bold">Senha:</label>
                <input type="password" class="form-control" name="Password" id="Password" placeholder="Digite sua senha" required>
            </div>

            <div id="confirmInsert" class="form-group">
                <label for="Confirm" class="font-weight-bold">Confirme sua senha:</label>
                <input type="password" class="form-control" name="Confirm" id="Confirm" placeholder="Confirme a sua senha" required>
            </div>

            <div id="identificationInsert" class="form-group">
                <label for="Identification" class="font-weight-bold">Identificação:</label>
                <input type="text" class="form-control" name="Identification" id="Identification" placeholder="Digite o seu número" required>
            </div>

            <div class="form-group text-center mt-4">
                <button type="submit" class="btn btn-primary w-100">Cadastrar</button>
            </div>
        </div>
    </form>
</div>
@endsection

