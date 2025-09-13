@extends('layouts.admin')

@section('title', 'Quản lý Home Sections')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Danh sách Home Sections</h1>
    <a href="{{ route('admin.home_sections.create') }}" class="btn btn-primary">Thêm Home Section mới</a>
</div>

<table class="table table-bordered table-hover">
    <thead class="table-light">
        <tr>
            <th>ID</th>
            <th>Title</th>
            <th>Position</th>
            <th>Order</th>
            <th>Active</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        @forelse($homeSections as $section)
        <tr>
            <td>{{ $section->id }}</td>
            <td>{{ $section->title }}</td>
            <td>{{ $section->position }}</td>
            <td>{{ $section->order }}</td>
            <td>
                @if($section->is_active)
                    <span class="badge bg-success">Active</span>
                @else
                    <span class="badge bg-secondary">Inactive</span>
                @endif
            </td>
            <td>
                <a href="{{ route('admin.home_sections.edit', $section) }}" class="btn btn-sm btn-warning">Edit</a>
                <form action="{{ route('admin.home_sections.destroy', $section) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this home section?');">
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-sm btn-danger">Delete</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="6" class="text-center">No home sections found.</td>
        </tr>
        @endforelse
    </tbody>
</table>
@endsection
