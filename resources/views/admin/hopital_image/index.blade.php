@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Hospital Images</h1>

    {{-- Thông báo --}}
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">{{ $errors->first() }}</div>
    @endif

    <a href="{{ route('hospital_images.create') }}" class="btn btn-primary mb-3">Upload New Image</a>

    <div class="row">
        @foreach($images as $image)
            <div class="col-md-3 mb-3">
                <div class="card">
                    <img src="{{ asset('storage/' . $image->image_path) }}" class="card-img-top" alt="Hospital Image">
                    <div class="card-body text-center">
                        <form action="{{ route('hospital_images.destroy', $image->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa ảnh này?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Xóa</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection
