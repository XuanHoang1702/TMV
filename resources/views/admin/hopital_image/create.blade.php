@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Upload New Hospital Image</h1>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('hospital_images.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="form-group mb-3">
            <label for="image">Chọn ảnh</label>
            <input type="file" class="form-control" id="image" name="image" required>
        </div>

        <button type="submit" class="btn btn-success">Upload</button>
        <a href="{{ route('hospital_images.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
