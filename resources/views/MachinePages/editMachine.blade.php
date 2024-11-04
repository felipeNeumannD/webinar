@extends('Layout.main')

@section('content')
<div class="container">
    <h2>Edit Machine</h2>
    <form action="{{ route('machines.update', $machine->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" class="form-control" value="{{ $machine->name }}" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea name="description" class="form-control" required>{{ $machine->description }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update Machine</button>
    </form>
</div>
@endsection