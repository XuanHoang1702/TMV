@extends('layouts.admin')

@section('content')
@if($informations->count() < 1)
    <a href="{{ route('admin.informations.create') }}" class="btn btn-primary">Thêm mới</a>
@endif

<div class="container">
    <h1>Liên hệ</h1>
    @if($informations->count() == 1)
        <a href="{{ route('admin.informations.create') }}" class="btn btn-primary mb-3">Thêm mới Liên hệ</a>

    @endif
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Name</th>
                <th>Address</th>
                <th>Email</th>
                <th>Hotline</th>
                <th>Website</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($informations as $information)
            <tr>
                <td>{{ $information->name }}</td>
                <td>{{ $information->address }}</td>
                <td>{{ $information->email }}</td>
                <td>{{ $information->hotline }}</td>
                <td><a href="{{ $information->website }}" target="_blank">{{ $information->website }}</a></td>
                <td>
                    @if($information->images_address)
                    <img src="{{ asset('storage/' . $information->images_address) }}" alt="Image" width="100">
                    @endif
                </td>
                <td>
                    <a href="{{ route('admin.informations.edit', $information->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.informations.destroy', $information->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure to delete this information?')">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
