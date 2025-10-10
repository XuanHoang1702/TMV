@extends('layouts.admin')

@section('content')
<div class="container">
    <h1>Thêm mới nội dung trang liên hệ</h1>

    <form action="{{ route('admin.about-us.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror" value="{{ old('title') }}" required>
            @error('title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror" rows="4" required>{{ old('description') }}</textarea>
            @error('description')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Icons</label>
            <div id="icons-container">
                <div class="icon-item mb-3 border p-3">
                    <h6>Icon 1</h6>
                    <div class="mb-2">
                        <label class="form-label">Icon Image</label>
                        <input type="file" class="form-control @error('icons.0.icon') is-invalid @enderror" name="icons[0][icon]" accept="image/*" required>
                        @error('icons.0.icon')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2 icon-title-wrapper">
                        <label class="form-label">Icon Title</label>
                        <input type="text" class="form-control @error('icons.0.icon_title') is-invalid @enderror" name="icons[0][icon_title]" value="{{ old('icons.0.icon_title') }}" required>
                        @error('icons.0.icon_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-2">
                        <label class="form-label">Icon Content</label>
                        <textarea class="form-control @error('icons.0.icon_content') is-invalid @enderror" name="icons[0][icon_content]" rows="3" required>{{ old('icons.0.icon_content') }}</textarea>
                        @error('icons.0.icon_content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="button" class="btn btn-danger btn-sm remove-icon mt-2">Remove</button>
                </div>
            </div>
            <button type="button" class="btn btn-secondary btn-sm" id="add-icon">Add Icon</button>
            <small class="form-text text-muted">Upload icons from your device.</small>
        </div>

        <div class="mb-3" id="sub_title_container" style="display: none;">
            <label for="sub_title" class="form-label">Sub Title</label>
            <input type="text" name="sub_title" id="sub_title" class="form-control @error('sub_title') is-invalid @enderror" value="{{ old('sub_title') }}">
            @error('sub_title')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="section" class="form-label">Section</label>
            <select name="section" id="section" class="form-select @error('section') is-invalid @enderror" required>
                <option value="">-- Chọn Section --</option>
                <option value="Phần 1" {{ old('section') == 'Phần 1' ? 'selected' : '' }}>Phần 1</option>
                <option value="Phần 2" {{ old('section') == 'Phần 2' ? 'selected' : '' }}>Phần 2</option>
            </select>
            @error('section')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">Lưu</button>
    </form>
</div>

<script>
    let iconIndex = 1;

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
        toggleIconTitles(); // ẩn/hiện icon_title theo section
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

    // Ẩn/hiện icon_title khi chọn Section
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

    // Event change
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
    if (document.getElementById('section').value === 'Phần 2') {
        document.getElementById('sub_title_container').style.display = 'block';
        document.getElementById('sub_title').setAttribute('required', 'required');
    }
</script>
@endsection
