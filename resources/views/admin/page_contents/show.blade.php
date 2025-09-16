@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>View Page Content</h1>

    <div class="mb-3">
        <strong>Page:</strong> {{ $page->page }}
    </div>
    <div class="mb-3">
        <strong>Title:</strong> {{ $page->title }}
    </div>
    <div class="mb-3">
        <strong>Content:</strong>
        <div class="border p-3">{{ $page->content }}</div>
    </div>

    <a href="{{ route('admin.page_contents.index') }}" class="btn btn-secondary">Back</a>
</div>
@endsection
