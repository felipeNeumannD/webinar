@extends('Layout.main')
<link href="CSS/login.css" rel="stylesheet">
@section('content')

<div class="d-flex vh-100 justify-content-center align-items-center">
    <div class="col-md-4">
        <div id="login" name="loginInterface" class="login_formatter p-5 rounded shadow-lg bg-light">
            <h1 class="text-center mb-4">Seja Bem Vindo</h1>
            <form action="/login" method="GET">
                <div id="emailInsert" name="insertEmail" class="form-group">
                    <label for="Email" class="font-weight-bold">Email:</label>
                    <input type="email" class="form-control" name="Email" id="Email" placeholder="Digite seu email">
                </div>
                <br>
                <div id="passwordInsert" name="insertPassword" class="form-group">
                    <label for="Password" class="font-weight-bold">Senha:</label>
                    <input type="password" class="form-control" name="Password" id="Password" placeholder="Digite sua senha">
                </div>
                <br>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
                <br>
                <div class="text-center">
                    <a href="{{ route('cadastro.index') }}">Crie seu usuário</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
