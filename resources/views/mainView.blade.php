@extends('Layout.internPattern')

@section('content')

<style>
    .container_geral {
        display: flex;
        flex-direction: column;
        gap: 30px;
    }

    .card-header {
        cursor: pointer;
        background-color: #f8f9fa;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
        margin-bottom: 10px;
    }

    .card-body {
        background-color: #ffffff;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    .card ul {
        padding-left: 20px;
        list-style-type: disc;
    }
</style>

@section('content')

<div class="container_geral">
    <div class="container">
        @include('partials.LateContent', ['delayedCourses' => $lateCourses, 'text' => 'Cursos com Materiais Atrasados'])
    </div>
    <div class="container">
        @include('partials.NotLateContent', ['delayedCourses' => $soonLateCourses, 'text' => 'Cursos com Materiais Prestes a Atrasar'])
    </div>

</div>

@endsection