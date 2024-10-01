@extends('Layout.internPattern')
<link href="CSS/login.css" rel="stylesheet">

<div class="d-flex vh-100 justify-content-center align-items-center">
    <div class="col-md-4">
        <div id="login" name="loginInterface" class="login_formatter p-4 rounded shadow-lg bg-light">
            <h1 class="text-center mb-4">Seja Bem Vindo</h1>
            <form action="/changeUser" method="GET">
                <div class="main">
                    <div id="nameInsert" class="form-group">
                        <label for="Name" class="font-weight-bold">Nome:</label>
                        <input type="text" class="form-control" name="Name" id="Name" placeholder="Digite seu nome">
                    </div>

                    <div id="emailInsert" class="form-group">
                        <label for="Email" class="font-weight-bold">Email:</label>
                        <input type="email" class="form-control" name="Email" id="Email" placeholder="Digite seu email">
                    </div>

                    <div id="passwordInsert" class="form-group">
                        <label for="Password" class="font-weight-bold">Senha:</label>
                        <input type="password" class="form-control" name="Password" id="Password"
                            placeholder="Digite sua senha">
                    </div>

                    <div id="confirmInsert" class="form-group">
                        <label for="Confirm" class="font-weight-bold">Confirme sua senha:</label>
                        <input type="password" class="form-control" name="Confirm" id="Confirm"
                            placeholder="Confirme a sua senha">
                    </div>

                    <div id="identificationInsert" class="form-group">
                        <label for="Identification" class="font-weight-bold">Identificação:</label>
                        <input type="text" class="form-control" name="Identification" id="Identification"
                            placeholder="Digite o seu número">
                    </div>

                    <div class="form-group">
                        <button type="submit" class="btn btn-primary btn-block">Cadastrar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection