@extends('Layout.internPattern')

@section('title', 'Bem-vindo ao Webinar')

@section('content')
<style>
    .welcome-container {
        text-align: center;
        margin-top: 50px;
        background-color: #f8f9fa;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .welcome-container h1 {
        font-size: 2.5rem;
        margin-bottom: 20px;
    }

    .welcome-container p {
        font-size: 1.2rem;
    }
</style>

<div class="welcome-container">
    <h1>Bem-vindo ao Webinar</h1>
    <p>Explore nossas funcionalidades clicando nos menus acima.</p>
</div>
@endsection