@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Sửa nội dung trang liên hệ</h1>

    <form action="{{ route('admin.about-us.update', $aboutUs) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title', $aboutUs->title) }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description', $aboutUs->description) }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Icons</label>
            <div id="icons-container">
                @foreach($aboutUs->icons as $index => $icon)
                <div class="icon-item mb-3 border p-3">
                    <h6>Icon {{ $index + 1 }}</h6>
                    <div class="mb-2">
                        <label class="form-label">Icon Image</label>
                        <input type="file" class="form-control @error('icons.' . $index . '.icon') is-invalid @enderror" name="icons[{{ $index }}][icon]" accept="image/*">
                        <input type="hidden" name="icons[{{ $index }}][existing_icon]" value="{{ $icon->icon }}">
                        @error('icons.' . $index . '.icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="mt-2">
                            <small class="text-muted">Current icon:</small><br>
                            <img src="{{ asset('storage/' . $icon->icon) }}" alt="Icon" style="width: 60px; height: 60px; border: 1px solid #ddd;">
                        </div>
                    </div>
                    <div class="mb-2 icon-title-wrapper">
                        <label class="form-label">Icon Title</label>
                        <input type="text" class="form-control @error('icons.' . $index . '.icon_title') is-invalid @enderror" name="icons[{{ $index }}][icon_title]" value="{{ old('icons.' . $index . '.icon_title', $icon->icon_title) }}" required>
                        @error('icons.' . $index . '.icon_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Icon Content</label>
                        <textarea class="form-control @error('icons.' . $index . '.icon_content') is-invalid @enderror" name="icons[{{ $index }}][icon_content]" rows="3" required>{{ old('icons.' . $index . '.icon_content', $icon->icon_content) }}</textarea>
                        @error('icons.' . $index . '.icon_content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-icon mt-2">Remove</button>
                </div>
                @endforeach
            </div>
            <button type="button" class="btn btn-secondary btn-sm" id="add-icon">Add Icon</button>
            <small class="form-text text-muted">Upload icons from your device. Leave empty to keep current icon.</small>
        </div>

        <div class="mb-3" id="sub_title_container" style="display: {{ old('section', $aboutUs->section) === 'Phần 2' ? 'block' : 'none' }};">
            <label for="sub_title" class="form-label">Sub Title</label>
            <input type="text" name="sub_title" id="sub_title" class="form-control @error('sub_title') is-invalid @enderror" value="{{ old('sub_title', $aboutUs->sub_title) }}" {{ old('section', $aboutUs->section) === 'Phần 2' ? 'required' : '' }}>
            @error('sub_title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="section" class="form-label">Section</label>
            <select name="section" id="section" class="form-select @error('section') is-invalid @enderror" required>
                <option value="">-- Chọn Section --</option>
                <option value="Phần 1" {{ old('section', $aboutUs->section) == 'Phần 1' ? 'selected' : '' }}>Phần 1</option>
                <option value="Phần 2" {{ old('section', $aboutUs->section) == 'Phần 2' ? 'selected' : '' }}>Phần 2</option>
            </select>
            @error('section')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>

<script>
    let iconIndex = {{ $aboutUs->icons->count() }};

    document.getElementById('add-icon').addEventListener('click', function() {
        const container = document.getElementById('icons-container');
        const newItem = document.createElement('div');
        newItem.className = 'icon-item mb-3 border p-3';
        newItem.innerHTML = `
            <h6>Icon ${iconIndex + 1}</h6>
            <div class="mb-2">
                <label class="form-label">Icon Image</label>
                <input type="file" class="form-control" name="icons[${iconIndex}][icon]" accept="image/*" required>
            </div>
            <div class="mb-2 icon-title-wrapper">
                <label class="form-label">Icon Title</label>
                <input type="text" class="form-control" name="icons[${iconIndex}][icon_title]" required>
            </div>
            <div class="mb-2">
                <label class="form-label">Icon Content</label>
                <textarea class="form-control" name="icons[${iconIndex}][icon_content]" rows="3" required></textarea>
            </div>
            <button type="button" class="btn btn-danger btn-sm remove-icon mt-2">Remove</button>
        `;
        container.appendChild(newItem);
        iconIndex++;
        updateRemoveButtons();
        toggleIconTitles(); // gọi để ẩn/hiện Icon Title theo section
    });

    function updateRemoveButtons() {
        const items = document.querySelectorAll('.icon-item');
        items.forEach((item) => {
            const removeBtn = item.querySelector('.remove-icon');
            if (items.length === 1) {
                removeBtn.style.display = 'none';
            } else {
                removeBtn.style.display = 'inline-block';
            }
        });
    }

    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-icon')) {
            e.target.closest('.icon-item').remove();
            updateRemoveButtons();
            updateIconIndices();
            toggleIconTitles();
        }
    });

    function updateIconIndices() {
        const items = document.querySelectorAll('.icon-item');
        items.forEach((item, index) => {
            item.querySelector('h6').textContent = `Icon ${index + 1}`;
            const inputs = item.querySelectorAll('input, textarea');
            inputs.forEach(input => {
                const name = input.name.replace(/icons\[\d+\]/, `icons[${index}]`);
                input.name = name;
            });
        });
        iconIndex = items.length;
    }

    // Ẩn/hiện Icon Title theo Section
    function toggleIconTitles() {
        const section = document.getElementById('section').value;
        const iconTitles = document.querySelectorAll('.icon-title-wrapper');

        iconTitles.forEach(wrapper => {
            const input = wrapper.querySelector('input');
            if (section === 'Phần 2') {
                wrapper.style.display = 'none';
                input.removeAttribute('required');
                input.value = '';
            } else {
                wrapper.style.display = 'block';
                input.setAttribute('required', 'required');
            }
        });
    }

    // Handle section change
    document.getElementById('section').addEventListener('change', function() {
        toggleIconTitles();

        const subTitleContainer = document.getElementById('sub_title_container');
        const subTitleInput = document.getElementById('sub_title');

        if (this.value === 'Phần 2') {
            subTitleContainer.style.display = 'block';
            subTitleInput.setAttribute('required', 'required');
        } else {
            subTitleContainer.style.display = 'none';
            subTitleInput.removeAttribute('required');
            subTitleInput.value = '';
        }
    });

    // Check initial state
    toggleIconTitles();
    const sectionSelect = document.getElementById('section');
    const subTitleContainer = document.getElementById('sub_title_container');
    const subTitleInput = document.getElementById('sub_title');

    if (sectionSelect.value === 'Phần 2') {
        subTitleContainer.style.display = 'block';
        subTitleInput.setAttribute('required', 'required');
    } else {
        subTitleContainer.style.display = 'none';
        subTitleInput.removeAttribute('required');
    }
</script>
@endsection
