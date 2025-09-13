<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeSection;
use Illuminate\Http\Request;

class HomeSectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $homeSections = HomeSection::orderBy('order')->get();
        return view('admin.home_sections.index', compact('homeSections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.home_sections.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'list_icons' => 'nullable|array|max:3',
            'list_icons.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'list_titles' => 'nullable|array|max:3',
            'list_titles.*' => 'nullable|string|max:255',
            'list_descriptions' => 'nullable|array|max:3',
            'list_descriptions.*' => 'nullable|string',
            'position' => 'required|in:1,2|unique:home_sections',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('home_sections', 'public');
            }
        }

        $listItems = [];
        $icons = $request->file('list_icons', []);
        $titles = $request->list_titles ?? [];
        $descriptions = $request->list_descriptions ?? [];

        foreach ($titles as $index => $title) {
            $iconPath = null;
            if (isset($icons[$index]) && $icons[$index]) {
                $iconPath = $icons[$index]->store('home_sections/icons', 'public');
            }
            $listItems[] = [
                'icon' => $iconPath,
                'title' => $title,
                'description' => $descriptions[$index] ?? '',
            ];
        }

        HomeSection::create([
            'title' => $request->title,
            'content' => $request->content,
            'images' => $images,
            'list_items' => $listItems,
            'position' => $request->position,
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.home_sections.index')->with('success', 'Home section created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(HomeSection $homeSection)
    {
        return view('admin.home_sections.show', compact('homeSection'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(HomeSection $homeSection)
    {
        return view('admin.home_sections.edit', compact('homeSection'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, HomeSection $homeSection)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'nullable|string',
            'images' => 'nullable|array|max:3',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'list_icons' => 'nullable|array|max:3',
            'list_icons.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'list_titles' => 'nullable|array|max:3',
            'list_titles.*' => 'nullable|string|max:255',
            'list_descriptions' => 'nullable|array|max:3',
            'list_descriptions.*' => 'nullable|string',
            'position' => 'required|string|max:255|unique:home_sections,position,' . $homeSection->id,
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $images = $homeSection->images ?? [];
        if ($request->hasFile('images')) {
            // Delete old images if exists
            if ($images) {
                foreach ($images as $image) {
                    if (\Storage::disk('public')->exists($image)) {
                        \Storage::disk('public')->delete($image);
                    }
                }
            }
            $images = [];
            foreach ($request->file('images') as $image) {
                $images[] = $image->store('home_sections', 'public');
            }
        }

        $listItems = [];
        $icons = $request->file('list_icons', []);
        $titles = $request->list_titles ?? [];
        $descriptions = $request->list_descriptions ?? [];
        $currentItems = $homeSection->list_items ?? [];

        foreach ($titles as $index => $title) {
            $iconPath = $currentItems[$index]['icon'] ?? null;
            if (isset($icons[$index]) && $icons[$index]) {
                // Delete old icon if exists
                if ($iconPath && \Storage::disk('public')->exists($iconPath)) {
                    \Storage::disk('public')->delete($iconPath);
                }
                $iconPath = $icons[$index]->store('home_sections/icons', 'public');
            }
            $listItems[] = [
                'icon' => $iconPath,
                'title' => $title,
                'description' => $descriptions[$index] ?? '',
            ];
        }

        $homeSection->update([
            'title' => $request->title,
            'content' => $request->content,
            'images' => $images,
            'list_items' => $listItems,
            'position' => $request->position,
            'order' => $request->order ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return redirect()->route('admin.home_sections.index')->with('success', 'Home section updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(HomeSection $homeSection)
    {
        // Delete images
        if ($homeSection->images) {
            foreach ($homeSection->images as $image) {
                if (\Storage::disk('public')->exists($image)) {
                    \Storage::disk('public')->delete($image);
                }
            }
        }

        // Delete list item icons
        if ($homeSection->list_items) {
            foreach ($homeSection->list_items as $item) {
                if (isset($item['icon']) && $item['icon'] && \Storage::disk('public')->exists($item['icon'])) {
                    \Storage::disk('public')->delete($item['icon']);
                }
            }
        }

        $homeSection->delete();
        return redirect()->route('admin.home_sections.index')->with('success', 'Home section deleted successfully.');
    }
}
