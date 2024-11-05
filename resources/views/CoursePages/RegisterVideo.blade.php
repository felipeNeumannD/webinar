@extends('Layout.internPattern')
@section('content')

<div class="main1 d-flex justify-content-center align-items-center vh-100">
    <div class="card p-4"
        style="width: 600px; background-color: white; box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); border-radius: 10px;">
        <div class="mt-3">
            <h5>Cadastrar Video</h5>
        </div>
        <div class="text-end mt-4">
            <form action="{{ route('upload.video') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="file" name="video" accept="video/*">
                <button type="submit">Upload Video</button>
            </form>
        </div>
    </div>
</div>

@endsection