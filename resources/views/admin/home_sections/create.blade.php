@extends('layouts.admin')

@section('title', 'Thêm Home Section mới')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Thêm mới</h1>
    <a href="{{ route('admin.home_sections.index') }}" class="btn btn-secondary">Quay lại</a>
</div>

@if($errors->any())
    <div class="alert alert-danger">
        <ul class="mb-0">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card">
    <div class="card-header">
        <h5 class="mb-0">Thông tin </h5>
    </div>
    <div class="card-body">
        <form action="{{ route('admin.home_sections.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="4">{{ old('content') }}</textarea>
                @error('content')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label class="form-label">Images</label>
                <div id="images-container">
                    <div class="image-item mb-3 border p-3">
                        <h6>Image 1</h6>
                        <input type="file" class="form-control @error('images.0') is-invalid @enderror" name="images[]" accept="image/*">
                        @error('images.0')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <button type="button" class="btn btn-danger btn-sm remove-image mt-2">Remove</button>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary btn-sm" id="add-image">Add Image</button>
                <small class="form-text text-muted">Upload images from your device.</small>
            </div>
            <script>
                document.getElementById('add-image').addEventListener('click', function() {
                    const container = document.getElementById('images-container');
                    if (container.children.length >= 3) {
                        alert('Maximum 3 images allowed.');
                        return;
                    }
                    const imageCount = container.children.length + 1;
                    const imageHtml = `
                        <div class="image-item mb-3 border p-3">
                            <h6>Image ${imageCount}</h6>
                            <input type="file" class="form-control" name="images[]" accept="image/*">
                            <button type="button" class="btn btn-danger btn-sm remove-image mt-2">Remove</button>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', imageHtml);
                });

                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-image')) {
                        e.target.closest('.image-item').remove();
                    }
                });
            </script>

            <div class="mb-3">
                <label class="form-label">List Items</label>
                <div id="list-items-container">
                    <div class="list-item mb-3 border p-3">
                        <h6>List Item 1</h6>
                        <div class="mb-2">
                            <label class="form-label">Icon</label>
                            <input type="file" class="form-control @error('list_icons.0') is-invalid @enderror" name="list_icons[]" accept="image/*">
                            @error('list_icons.0')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Title</label>
                            <input type="text" class="form-control @error('list_titles.0') is-invalid @enderror" name="list_titles[]" value="{{ old('list_titles.0') }}">
                            @error('list_titles.0')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-2">
                            <label class="form-label">Description</label>
                            <textarea class="form-control @error('list_descriptions.0') is-invalid @enderror" name="list_descriptions[]" rows="3">{{ old('list_descriptions.0') }}</textarea>
                            @error('list_descriptions.0')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="button" class="btn btn-danger btn-sm remove-list-item">Remove</button>
                    </div>
                </div>
                <button type="button" class="btn btn-secondary btn-sm" id="add-list-item">Add List Item</button>
                <small class="form-text text-muted">Upload icons from your device for each list item.</small>
            </div>
            <script>
                document.getElementById('add-list-item').addEventListener('click', function() {
                    const container = document.getElementById('list-items-container');
                    if (container.children.length >= 3) {
                        alert('Maximum 3 list items allowed.');
                        return;
                    }
                    const itemCount = container.children.length + 1;
                    const itemHtml = `
                        <div class="list-item mb-3 border p-3">
                            <h6>List Item ${itemCount}</h6>
                            <div class="mb-2">
                                <label class="form-label">Icon</label>
                                <input type="file" class="form-control" name="list_icons[]" accept="image/*">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Title</label>
                                <input type="text" class="form-control" name="list_titles[]">
                            </div>
                            <div class="mb-2">
                                <label class="form-label">Description</label>
                                <textarea class="form-control" name="list_descriptions[]" rows="3"></textarea>
                            </div>
                            <button type="button" class="btn btn-danger btn-sm remove-list-item">Remove</button>
                        </div>
                    `;
                    container.insertAdjacentHTML('beforeend', itemHtml);
                });

                document.addEventListener('click', function(e) {
                    if (e.target.classList.contains('remove-list-item')) {
                        e.target.closest('.list-item').remove();
                    }
                });
            </script>

            <div class="mb-3">
                <label for="position" class="form-label">Position</label>
                <select class="form-control @error('position') is-invalid @enderror" id="position" name="position" required>
                    <option value="">Select Position</option>
                    <option value="1" {{ old('position') == '1' ? 'selected' : '' }}>Section 1</option>
                    <option value="2" {{ old('position') == '2' ? 'selected' : '' }}>Section 2</option>
                </select>
                @error('position')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="order" class="form-label">Order</label>
                <input type="number" class="form-control @error('order') is-invalid @enderror" id="order" name="order" value="{{ old('order', 0) }}" min="0">
                @error('order')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', 1) ? 'checked' : '' }}>
                <label class="form-check-label" for="is_active">
                    Active
                </label>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.home_sections.index') }}" class="btn btn-secondary me-2">Cancel</a>
                <button type="submit" class="btn btn-primary">Create </button>
            </div>
        </form>
    </div>
</div>
@endsection
