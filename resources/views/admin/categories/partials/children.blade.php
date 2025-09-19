@foreach($categories as $category)
    <tr>
        <td>{{ $category->id }}</td>

        <td>
            <div style="padding-left: {{ ($depth ?? 1) * 20 }}px;">
                @if($category->hasChildren())
                    <i class="fas fa-folder text-warning"></i>
                @else
                    <i class="fas fa-file text-muted"></i>
                @endif
                {{ $category->name }}
            </div>
        </td>
        <td>{{ $category->slug }}</td>
        <td>
            <span class="badge {{ $category->is_active ? 'bg-success' : 'bg-danger' }}">
                {{ $category->is_active ? 'Hoạt động' : 'Tạm dừng' }}
            </span>
        </td>
        <td>{{ $category->order }}</td>
        <td>
            <div class="btn-group">
                <a href="{{ route('admin.categories.show', $category) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
                </a>
                <button type="button" class="btn btn-sm btn-danger" onclick="confirmDelete({{ $category->id }}, '{{ $category->name }}')">
                    <i class="fas fa-trash"></i>
                </button>
                <form id="delete-form-{{ $category->id }}" action="{{ route('admin.categories.destroy', $category) }}" method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </td>
    </tr>

    @if($category->hasChildren())
        @include('admin.categories.partials.children', ['categories' => $category->children, 'depth' => ($depth ?? 1) + 1])
    @endif
@endforeach

<!-- JS confirm delete -->
<script>
function confirmDelete(id, name) {
    if (confirm(`Bạn có chắc muốn xóa danh mục "${name}" không?`)) {
        document.getElementById(`delete-form-${id}`).submit();
    }
}
</script>
