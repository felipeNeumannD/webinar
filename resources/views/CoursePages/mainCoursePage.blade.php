@extends('Layout.coursesContent')
@section('content')
<link rel="stylesheet" href="{{ asset('CSS/CoursesStyle.css') }}">

<div class="main_content">
    <h1>Conteúdo do Curso</h1>

    <div class="generic-grid">
        @forelse ($classes as $class)
            <div class="course_select_item">
                <form action="{{ route('classes.destroy', [$class->id]) }}" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" style="background: none; border: none; cursor: pointer;">
                        <img style="height: 36px; width: 36px" src="{{ asset('images/garbage.png') }}" alt="Excluir">
                    </button>
                </form>
                <button>
                    <img style="height: 36px; width: 36px" src="{{ asset('images/pencil.png') }}">
                </button>
                <div class="name">{{$class->name}}</div>
                <div class="description">{{$class->description}}</div>
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