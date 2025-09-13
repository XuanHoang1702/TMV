
@extends('layouts.admin')

@section('title', 'Chỉnh sửa Dịch vụ')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Chỉnh sửa Dịch vụ</h1>
    <a href="{{ route('admin.services.index') }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left"></i> Quay lại
    </a>
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
        <h5 class="mb-0">Thông tin Dịch vụ</h5>
    </div>
    <div class="card-body">
        <form id="serviceForm" action="{{ route('admin.services.update', $service) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="row">
                <div class="col-md-8">
                    <div class="mb-3">
                        <label for="name" class="form-label">Tên dịch vụ <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $service->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Nếu chọn "Cho phép xuống dòng", một cửa sổ sẽ hiện ra để chọn vị trí thêm dấu | cho xuống dòng.</div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="allow_line_breaks" name="allow_line_breaks" value="1" {{ old('allow_line_breaks', $service->allow_line_breaks ?? false) ? 'checked' : '' }}>
                            <label class="form-check-label" for="allow_line_breaks">
                                Cho phép xuống dòng trong tên dịch vụ
                            </label>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('slug') is-invalid @enderror" id="slug" name="slug" value="{{ old('slug', $service->slug) }}" required>
                        @error('slug')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                        <div class="form-text">Slug sẽ được sử dụng trong URL</div>
                    </div>

                    <div class="mb-3">
                        <label for="category_id" class="form-label">Danh mục <span class="text-danger">*</span></label>
                        <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id" required>
                            <option value="">Chọn danh mục</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ old('category_id', $service->category_id) == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Mô tả ngắn</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description" rows="3">{{ old('description', $service->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="content" class="form-label">Nội dung chi tiết <span class="text-danger">*</span></label>
                        <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="8">{{ old('content', $service->content) }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="price_range" class="form-label">Khoảng giá</label>
                                <input type="text" class="form-control @error('price_range') is-invalid @enderror" id="price_range" name="price_range" value="{{ old('price_range', $service->price_range) }}" placeholder="Ví dụ: 500.000 - 1.000.000 VNĐ">
                                @error('price_range')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="duration" class="form-label">Thời gian</label>
                                <input type="text" class="form-control @error('duration') is-invalid @enderror" id="duration" name="duration" value="{{ old('duration', $service->duration) }}" placeholder="Ví dụ: 60 phút">
                                @error('duration')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="sort_order" class="form-label">Thứ tự sắp xếp</label>
                                <input type="number" class="form-control @error('sort_order') is-invalid @enderror" id="sort_order" name="sort_order" value="{{ old('sort_order', $service->sort_order) }}" min="0">
                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active" value="1" {{ old('is_active', $service->is_active) ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Kích hoạt dịch vụ
                                    </label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="meta_title" class="form-label">Meta Title</label>
                        <input type="text" class="form-control @error('meta_title') is-invalid @enderror" id="meta_title" name="meta_title" value="{{ old('meta_title', $service->meta_title) }}">
                        @error('meta_title')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="meta_description" class="form-label">Meta Description</label>
                        <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description" name="meta_description" rows="2">{{ old('meta_description', $service->meta_description) }}</textarea>
                        @error('meta_description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h6 class="mb-0">Hình ảnh</h6>
                        </div>
                        <div class="card-body">
                            @if($service->image)
                                <div class="mb-3">
                                    <label class="form-label">Ảnh hiện tại:</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $service->image) }}" class="img-fluid mb-2" style="max-height: 150px;" alt="Current image">
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="image" class="form-label">Ảnh đại diện mới</label>
                                <input type="file" class="form-control @error('image') is-invalid @enderror" id="image" name="image" accept="image/*">
                                @error('image')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Định dạng: JPG, PNG. Kích thước tối đa: 2MB</div>
                            </div>

                            @if($service->icon)
                                <div class="mb-3">
                                    <label class="form-label">Icon hiện tại:</label>
                                    <div>
                                        <img src="{{ asset('storage/' . $service->icon) }}" class="img-fluid mb-2" style="max-height: 50px;" alt="Current icon">
                                    </div>
                                </div>
                            @endif

                            <div class="mb-3">
                                <label for="icon" class="form-label">Icon mới</label>
                                <input type="file" class="form-control @error('icon') is-invalid @enderror" id="icon" name="icon" accept="image/png">
                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                                <div class="form-text">Định dạng: PNG. Kích thước tối đa: 1MB</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="d-flex justify-content-end">
                <a href="{{ route('admin.services.index') }}" class="btn btn-secondary me-2">Hủy</a>
                <button type="button" class="btn btn-info me-2" data-bs-toggle="modal" data-bs-target="#previewModal">Xem trước</button>
                <button type="submit" class="btn btn-primary">
                    <i class="fas fa-save"></i> Cập nhật dịch vụ
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Line Break Modal -->
<div class="modal fade" id="lineBreakModal" tabindex="-1" aria-labelledby="lineBreakModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lineBreakModalLabel">Chọn vị trí xuống dòng</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>Nhấp vào dấu | để chọn vị trí xuống dòng:</p>
                <div id="nameSegments" class="d-flex flex-wrap gap-2"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                <button type="button" class="btn btn-primary" id="confirmLineBreak">OK</button>
            </div>
        </div>
    </div>
</div>

<!-- Preview Modal -->
<div class="modal fade" id="previewModal" tabindex="-1" aria-labelledby="previewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="previewModalLabel">Xem trước Dịch vụ</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="text-center">
                    <h5 id="previewName" class="mb-3"></h5>
                    <img id="previewIcon" src="{{ $service->icon ? asset('storage/' . $service->icon) : asset('images/home/default_icon.png') }}" class="img-fluid mb-3" style="max-height: 50px;" alt="Service Icon">
                    <img id="previewImage" src="{{ $service->image ? asset('storage/' . $service->image) : '' }}" class="img-fluid mb-3" style="max-height: 150px;" alt="Service Image">
                    <p><strong>Danh mục:</strong> <span id="previewCategory"></span></p>
                    <p><strong>Mô tả ngắn:</strong> <span id="previewDescription"></span></p>
                    <p><strong>Khoảng giá:</strong> <span id="previewPriceRange"></span></p>
                    <p><strong>Thời gian:</strong> <span id="previewDuration"></span></p>
                    <p><strong>Trạng thái:</strong> <span id="previewStatus"></span></p>
                    <p><strong>Nội dung chi tiết:</strong></p>
                    <div id="previewContent" class="text-start"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                <button type="button" class="btn btn-primary" onclick="document.getElementById('serviceForm').submit()">Cập nhật</button>
            </div>
        </div>
    </div>
</div>

<script>
// Khởi tạo biến để theo dõi vị trí và dấu phân cách được chọn
let selectedPosition = null;
let selectedSeparator = null;
let currentName = ''; // Lưu trữ giá trị name hiện tại khi mở modal

// Tạo slug tự động từ tên
document.getElementById('name').addEventListener('input', function() {
    const name = this.value;
    let slug = name.toLowerCase()
        .replace(/[|;]/g, ' ') // Thay | hoặc ; bằng khoảng trắng
        .replace(/[^a-z0-9\s-]/g, '')
        .replace(/\s+/g, '-')
        .replace(/-+/g, '-')
        .trim('-');
    document.getElementById('slug').value = slug;
});

// Hiển thị modal xuống dòng khi chọn allow_line_breaks
document.getElementById('allow_line_breaks').addEventListener('change', function() {
    const nameInput = document.getElementById('name');
    currentName = nameInput.value.trim(); // Lưu giá trị name hiện tại

    if (this.checked && currentName) {
        // Hiển thị modal
        const lineBreakModal = new bootstrap.Modal(document.getElementById('lineBreakModal'));
        const nameSegmentsDiv = document.getElementById('nameSegments');
        nameSegmentsDiv.innerHTML = ''; // Xóa nội dung cũ
        selectedPosition = null; // Reset vị trí chọn
        selectedSeparator = null; // Reset dấu phân cách chọn

        // Tách tên theo khoảng trắng, giữ nguyên | hoặc ; làm dấu phân cách
        const parts = currentName.split(/([|;])/).filter(part => part);
        let currentIndex = 0;

        parts.forEach((part, index) => {
            // Thêm phần tử (từ hoặc dấu phân cách)
            const partSpan = document.createElement('span');
            partSpan.textContent = part;
            partSpan.className = 'me-1';
            nameSegmentsDiv.appendChild(partSpan);

            // Thêm dấu phân cách có thể nhấp (trừ sau phần tử cuối)
            if (index < parts.length - 1 && part !== '|' && part !== ';') {
                const separator = document.createElement('span');
                separator.textContent = '|';
                separator.className = 'text-primary cursor-pointer me-1';
                separator.style.textDecoration = 'underline';
                separator.dataset.index = currentIndex + part.length; // Lưu vị trí chèn
                separator.addEventListener('click', () => {
                    // Bỏ highlight dấu phân cách trước đó
                    if (selectedSeparator) {
                        selectedSeparator.className = 'text-primary cursor-pointer me-1';
                        selectedSeparator.style.textDecoration = 'underline';
                    }
                    // Highlight dấu phân cách được chọn
                    separator.className = 'text-success cursor-pointer me-1';
                    separator.style.textDecoration = 'none';
                    selectedSeparator = separator;
                    selectedPosition = parseInt(separator.dataset.index); // Lưu vị trí từ dataset
                });
                nameSegmentsDiv.appendChild(separator);
            }
            currentIndex += part.length;
        });

        lineBreakModal.show();
    } else if (!this.checked) {
        // Xóa | hoặc ; và chuẩn hóa khoảng trắng khi bỏ chọn
        nameInput.value = currentName.replace(/[|;]\s*/g, ' ').trim();
        nameInput.dispatchEvent(new Event('input')); // Cập nhật slug
        selectedPosition = null; // Reset vị trí chọn
        selectedSeparator = null; // Reset dấu phân cách chọn
    }
});

// Xử lý nút OK
document.getElementById('confirmLineBreak').addEventListener('click', () => {
    const nameInput = document.getElementById('name');
    const lineBreakModal = bootstrap.Modal.getInstance(document.getElementById('lineBreakModal'));

    if (selectedPosition !== null && currentName) {
        // Chèn | vào vị trí đã chọn
        nameInput.value = currentName.slice(0, selectedPosition) + '|' + currentName.slice(selectedPosition);
        currentName = nameInput.value; // Cập nhật currentName
        nameInput.dispatchEvent(new Event('input')); // Cập nhật slug
    }
    lineBreakModal.hide(); // Đóng modal
});

// Reset lựa chọn khi modal đóng
document.getElementById('lineBreakModal').addEventListener('hidden.bs.modal', () => {
    selectedPosition = null;
    selectedSeparator = null;
    const nameSegmentsDiv = document.getElementById('nameSegments');
    nameSegmentsDiv.innerHTML = ''; // Xóa nội dung
});

// Xử lý nội dung modal xem trước
document.getElementById('previewModal').addEventListener('show.bs.modal', function() {
    const name = document.getElementById('name').value || 'Không có tên';
    const allowLineBreaks = document.getElementById('allow_line_breaks').checked;
    const categorySelect = document.getElementById('category_id');
    const category = categorySelect.selectedIndex > 0 ? categorySelect.options[categorySelect.selectedIndex].text : 'Chưa chọn danh mục';
    const description = document.getElementById('description').value;
    const content = document.getElementById('content').value;
    const priceRange = document.getElementById('price_range').value;
    const duration = document.getElementById('duration').value;
    const isActive = document.getElementById('is_active').checked;
    const iconInput = document.getElementById('icon');
    const imageInput = document.getElementById('image');

    // Xử lý xuống dòng trong tên cho xem trước
    let displayName = name;
    if (allowLineBreaks) {
        displayName = name.replace(/[|;]/g, '<br>');
    }
    document.getElementById('previewName').innerHTML = displayName;

    // Xử lý xem trước icon
    if (iconInput.files && iconInput.files[0]) {
        document.getElementById('previewIcon').src = URL.createObjectURL(iconInput.files[0]);
    } else {
        document.getElementById('previewIcon').src = '{{ $service->icon ? asset('storage/' . $service->icon) : asset('images/home/default_icon.png') }}';
    }

    // Xử lý xem trước ảnh
    if (imageInput.files && imageInput.files[0]) {
        document.getElementById('previewImage').src = URL.createObjectURL(imageInput.files[0]);
    } else {
        document.getElementById('previewImage').src = '{{ $service->image ? asset('storage/' . $service->image) : '' }}';
    }

    document.getElementById('previewCategory').textContent = category;
    document.getElementById('previewDescription').textContent = description || 'Không có mô tả';
    document.getElementById('previewPriceRange').textContent = priceRange || 'Không có khoảng giá';
    document.getElementById('previewDuration').textContent = duration || 'Không có thời gian';
    document.getElementById('previewStatus').textContent = isActive ? 'Kích hoạt' : 'Không kích hoạt';
    document.getElementById('previewContent').innerHTML = content || 'Không có nội dung';
});
</script>
@endsection
