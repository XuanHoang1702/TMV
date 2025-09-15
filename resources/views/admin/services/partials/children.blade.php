@foreach ($services as $service)
    <tr>
        <td>{{ $service->id }}</td>
        <td>
            <div style="padding-left: {{ ($depth ?? 0) * 20 }}px;">
                @if ($service->children->count() > 0)
                    <i class="fas fa-folder text-warning"></i>
                @else
                    <i class="fas fa-file text-muted"></i>
                @endif
                {{ $service->name }}
                @if ($service->parent_id)
                @endif
            </div>
        </td>
        <td>{{ $service->category ? $service->category->name : 'N/A' }}</td>
        <td>
            @if ($service->parent_id)
                @if ($service->icon_page_service)
                    <img src="{{ Storage::url($service->icon_page_service) }}" alt="Icon Service" style="max-height: 30px;">
                @else
                    <span class="text-muted">N/A</span>
                @endif
            @else
                @if ($service->icon_page_home)
                    <img src="{{ Storage::url($service->icon_page_home) }}" alt="Icon Home" style="max-height: 30px;">
                @else
                    <span class="text-muted">N/A</span>
                @endif
            @endif
        </td>
        <td>
            <span class="badge {{ $service->is_active ? 'bg-success' : 'bg-danger' }}">
                {{ $service->is_active ? 'Hoạt động' : 'Tạm dừng' }}
            </span>
        </td>

        <td>
            <div class="btn-group">
                <a href="{{ route('admin.services.show', $service) }}" class="btn btn-sm btn-info">
                    <i class="fas fa-eye"></i>
                </a>
                <a href="{{ route('admin.services.edit', $service) }}" class="btn btn-sm btn-warning">
                    <i class="fas fa-edit"></i>
                </a>
                <button type="button" class="btn btn-sm btn-danger"
                    onclick="confirmDelete({{ $service->id }}, '{{ $service->name }}')">
                    <i class="fas fa-trash"></i>
                </button>
                <form id="delete-form-{{ $service->id }}" action="{{ route('admin.services.destroy', $service) }}"
                    method="POST" style="display: none;">
                    @csrf
                    @method('DELETE')
                </form>
            </div>
        </td>
    </tr>

    @if ($service->children->count() > 0)
        @include('admin.services.partials.children', [
            'services' => $service->children,
            'depth' => ($depth ?? 0) + 1,
        ])
    @endif
@endforeach
