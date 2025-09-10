@extends('layouts.admin')

@section('title', 'Quản lý Menu')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Danh sách Menu</h3>
                    <div class="card-tools">
                        <a href="{{ route('admin.menus.create') }}" class="btn btn-primary btn-sm">
                            <i class="fas fa-plus"></i> Thêm Menu
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordered table-striped">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Label</th>
                                <th>Icon</th>
                                <th>Route</th>
                                <th>Order</th>
                                <th>Type</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($menus as $menu)
                                <tr>
                                    <td>{{ $menu->id }}</td>
                                    <td>{{ $menu->label }}</td>
                                    <td>{{ $menu->icon }}</td>
                                    <td>{{ $menu->route }}</td>
                                    <td>{{ $menu->order }}</td>
                                    <td>{{ $menu->type }}</td>
                                    <td>
                                        <span class="badge {{ $menu->is_active ? 'badge-success' : 'badge-danger' }}">
                                            {{ $menu->is_active ? 'Active' : 'Inactive' }}
                                        </span>
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.menus.edit', $menu) }}" class="btn btn-warning btn-sm">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.menus.toggle-status', $menu) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('POST')
                                            <button type="submit" class="btn btn-info btn-sm">
                                                <i class="fas fa-toggle-on"></i>
                                            </button>
                                        </form>
                                        <form action="{{ route('admin.menus.destroy', $menu) }}" method="POST" style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @if($menu->children->count() > 0)
                                    @foreach($menu->children as $child)
                                        <tr>
                                            <td>{{ $child->id }}</td>
                                            <td>&nbsp;&nbsp;&nbsp;&nbsp;{{ $child->label }}</td>
                                            <td>{{ $child->icon }}</td>
                                            <td>{{ $child->route }}</td>
                                            <td>{{ $child->order }}</td>
                                            <td>{{ $child->type }}</td>
                                            <td>
                                                <span class="badge {{ $child->is_active ? 'badge-success' : 'badge-danger' }}">
                                                    {{ $child->is_active ? 'Active' : 'Inactive' }}
                                                </span>
                                            </td>
                                            <td>
                                                <a href="{{ route('admin.menus.edit', $child) }}" class="btn btn-warning btn-sm">
                                                    <i class="fas fa-edit"></i>
                                                </a>
                                                <form action="{{ route('admin.menus.toggle-status', $child) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('POST')
                                                    <button type="submit" class="btn btn-info btn-sm">
                                                        <i class="fas fa-toggle-on"></i>
                                                    </button>
                                                </form>
                                                <form action="{{ route('admin.menus.destroy', $child) }}" method="POST" style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                                        <i class="fas fa-trash"></i>
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-center">
                        {{ $menus->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
