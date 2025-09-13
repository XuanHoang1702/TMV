@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Edit Page Content</h1>

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <form action="{{ route('page_contents.update', $page->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="page" class="form-label">Page</label>
            <input type="text" class="form-control" id="page" name="page" value="{{ old('page', $page->page) }}" required>
        </div>
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ old('title', $page->title) }}" required>
        </div>
        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea class="form-control" id="content" name="content" rows="5" required>{{ old('content', $page->content) }}</textarea>
        </div>
        <button type="submit" class="btn btn-primary">Update</button>
        <a href="{{ route('page_contents.index') }}" class="btn btn-secondary">Back</a>
    </form>
</div>
@endsection
