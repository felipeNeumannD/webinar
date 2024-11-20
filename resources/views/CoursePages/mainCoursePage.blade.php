@extends('Layout.coursesContent')
@section('content')
<link rel="stylesheet" href="{{ asset('CSS/CoursesStyle.css') }}">

<div class="main_content">
    <h1>Conteúdo do Curso</h1>

    <div class="generic-grid">
        @forelse ($classes as $class)
            <div class="course_select_item">
                <div class="name">Exemplo de Nome</div>
                <div class="description">Exemplo de Descriçãooooooooooooooooooooooooooooooooooooo</div>
            </div>
        @empty
            <p>Nenhuma aula encontrada encontrada.</p>
        @endforelse

        <div class="course_select_image">
            <img src="{{ asset('images/mais.png') }}">
        </div>
    </div>
</div>

<script src="{{ asset('JS/courseSelector.js') }}"></script>


@endsection