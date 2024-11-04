@extends('Layout.main')

@section('content')
<div class="container">
    <h2>Edit Line</h2>
    <form action="{{ route('lines.update', $line->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $line->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ $line->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Line</button>
    </form>
</div>
@endsection