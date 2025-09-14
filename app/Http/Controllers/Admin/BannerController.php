<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use Illuminate\Http\Request;

class BannerController extends Controller
{
    public function index()
    {
        $banners = Banner::orderBy('order')->get();
        return view('admin.banners.index', compact('banners'));
    }

    public function create()
    {
        return view('admin.banners.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|string|max:255',
            'page' => 'string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'section' => 'nullable|string|in:1,2',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('banners', 'public');
        }

        Banner::create([
            'title' => $request->title,
            'image_path' => $imagePath,
            'link' => $request->link,
            'page' => $request->page,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active') ? $request->is_active : true,
            'section' => $request->section ?? '1',
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner created successfully.');
    }

    public function show(Banner $banner)
    {
        return view('admin.banners.show', compact('banner'));
    }

    public function edit(Banner $banner)
    {
        return view('admin.banners.edit', compact('banner'));
    }

    public function update(Request $request, Banner $banner)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'link' => 'nullable|string|max:255',
            'page' => 'string|max:255',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
            'section' => 'nullable|string|in:1,2',
        ]);

        $imagePath = $banner->image_path;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($imagePath && \Storage::disk('public')->exists($imagePath)) {
                \Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('banners', 'public');
        }

        $banner->update([
            'title' => $request->title,
            'image_path' => $imagePath,
            'link' => $request->link,
            'page' => $request->page,
            'order' => $request->order ?? 0,
            'is_active' => $request->has('is_active') ? $request->is_active : true,
            'section' => $request->section ?? '1',
        ]);

        return redirect()->route('admin.banners.index')->with('success', 'Banner updated successfully.');
    }

    public function destroy(Banner $banner)
    {
        $banner->delete();
        return redirect()->route('admin.banners.index')->with('success', 'Banner deleted successfully.');
    }
}
