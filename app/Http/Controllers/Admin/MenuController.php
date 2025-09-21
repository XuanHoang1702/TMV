<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class MenuController extends Controller
{
   public function index(Request $request)
{
    $menus = Menu::with('children')->paginate(10);
    if ($request->ajax()) {
        return view('admin.menus._table', compact('menus'));
    }
    return view('admin.menus.index', compact('menus'));
}

    public function create()
    {
        $parentMenus = Menu::where('type', 'admin')
            ->whereNull('parent_id')
            ->orderBy('order')
            ->get();

        return view('admin.menus.create', compact('parentMenus'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'label' => 'required|string|max:255',

            'route' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer',
            'type' => 'required|in:admin,frontend',
            'is_active' => 'boolean',
        ]);

        Menu::create($request->all());

        return redirect()->route('admin.menus.index')->with('success', 'Menu created successfully.');
    }

    public function edit(Menu $menu)
    {
        $parentMenus = Menu::where('type', 'admin')
            ->whereNull('parent_id')
            ->where('id', '!=', $menu->id)
            ->orderBy('order')
            ->get();

        return view('admin.menus.edit', compact('menu', 'parentMenus'));
    }

    public function update(Request $request, Menu $menu)
    {
        $request->validate([
            'label' => 'required|string|max:255',
            'icon' => 'nullable|string|max:255',
            // 'route' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:menus,id',
            'order' => 'nullable|integer',
            'type' => 'required|in:admin,frontend',
            'is_active' => 'boolean',
        ]);

        $menu->update($request->all());

        return redirect()->route('admin.menus.index')->with('success', 'Menu updated successfully.');
    }

    public function destroy(Menu $menu)
    {
        $menu->delete();

        return redirect()->route('admin.menus.index')->with('success', 'Menu deleted successfully.');
    }

    public function toggleStatus(Menu $menu)
    {
        $menu->update(['is_active' => !$menu->is_active]);

        return redirect()->route('admin.menus.index')->with('success', 'Menu status updated.');
    }

    public function show($route)
    {
        $menu = Menu::where('route', $route)->first();
        if (!$menu) {
            abort(404);
        }
        return view('menu.show', compact('menu'));
    }
}
