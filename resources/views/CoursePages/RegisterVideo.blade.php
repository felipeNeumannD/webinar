<div>
    <form action="{{ route('upload.video') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="file" name="video" accept="video/*">
        <button type="submit">Upload Video</button>
    </form>
</div>