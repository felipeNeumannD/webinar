@extends('Layout.internPattern')
@section('content')

<div class="container mt-5">
    <div class="card">
        <div class="card-header">
            <h2>{{ $line->name }}</h2>
        </div>
        <div class="card-body">
            <p>{{ $line->description }}</p>
        </div>
    </div>
</div>

@endsection