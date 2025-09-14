@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Create Page Content</h1>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('page_contents.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="page" class="form-label">Page</label>
            <input type="text" class="form-control" id="page" name="page" value="{{ old('page') }}" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content') }}</textarea>
        </div>
        <button type="submit" class="btn btn-success">Create</button>
        <a href="{{ route('page_contents.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
