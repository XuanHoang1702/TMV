@extends('layouts.admin')

@section('title', 'Chỉnh sửa Menu')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Chỉnh sửa Menu</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ url('admin/menus/' . $menu->id) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div class="form-group">
                                <label for="label">Label</label>
                                <input type="text" class="form-control" id="label" name="label"
                                    value="{{ old('label', $menu->label) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="icon">Icon</label>
                                <input type="text" class="form-control" id="icon" name="icon"
                                    value="{{ old('icon', $menu->icon) }}" placeholder="e.g., fas fa-home">
                            </div>
                            <div class="form-group">
                                <label for="route">Route</label>
                                <input type="text" class="form-control" id="route" name="route"
                                    value="{{ old('route', $menu->route) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="parent_id">Parent Menu</label>
                                <select class="form-control" id="parent_id" name="parent_id">
                                    <option value="">None</option>
                                    @foreach ($parentMenus as $parent)
                                        <option value="{{ $parent->id }}"
                                            {{ $menu->parent_id == $parent->id ? 'selected' : '' }}>{{ $parent->label }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="order">Order</label>
                                <input type="number" class="form-control" id="order" name="order"
                                    value="{{ old('order', $menu->order) }}">
                            </div>
                            <div class="form-group">
                                <label for="type">Type</label>
                                <select class="form-control" id="type" name="type" required>
                                    <option value="admin" {{ $menu->type == 'admin' ? 'selected' : '' }}>Admin</option>
                                    <option value="frontend" {{ $menu->type == 'frontend' ? 'selected' : '' }}>Frontend
                                    </option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="is_active" name="is_active"
                                        value="1" {{ $menu->is_active ? 'checked' : '' }}>
                                    <label class="form-check-label" for="is_active">
                                        Active
                                    </label>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Cập nhật Menu</button>
                            <a href="{{ route('admin.menus.index') }}" class="btn btn-secondary">Hủy</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
