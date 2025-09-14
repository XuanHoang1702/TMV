@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Page Contents</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('page_contents.create') }}" class="btn btn-primary mb-3">+ Add Page Content</a>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Page</th>
                <th>Title</th>
                <th>Created At</th>
                <th width="180">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($pages as $page)
                <tr>
                    <td>{{ $page->id }}</td>
                    <td>{{ $page->page }}</td>
                    <td>{{ $page->title }}</td>
                    <td>{{ $page->created_at->format('d/m/Y H:i') }}</td>
                    <td>
                        <a href="{{ route('page_contents.show', $page->id) }}" class="btn btn-info btn-sm">View</a>
                        <a href="{{ route('page_contents.edit', $page->id) }}" class="btn btn-warning btn-sm">Edit</a>
                        <form action="{{ route('page_contents.destroy', $page->id) }}" method="POST" style="display:inline-block">
                            @csrf
                            @method('DELETE')
                            <button onclick="return confirm('Bạn có chắc muốn xóa?')" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
