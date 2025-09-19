<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AboutUs;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AboutUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $aboutUs = AboutUs::all();
        return view('admin.about-us.index', compact('aboutUs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.about-us.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate chung
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icons' => 'required|array|min:1',
            'icons.*.icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sub_title' => 'nullable|string|max:255',
            'section' => 'required|in:Phần 1,Phần 2',
        ]);

        // Validate riêng theo section
        $validator->after(function ($validator) use ($request) {
            if ($request->input('section') === 'Phần 2') {
                if (empty($request->input('sub_title'))) {
                    $validator->errors()->add('sub_title', 'Sub Title is required when Section is Phần 2.');
                }

                foreach ($request->input('icons', []) as $index => $icon) {
                    if (empty($icon['icon_content'])) {
                        $validator->errors()->add("icons.$index.icon_content", "Content is required for icon " . ($index + 1));
                    }
                }
            } else {
                foreach ($request->input('icons', []) as $index => $icon) {
                    if (empty($icon['icon_title'])) {
                        $validator->errors()->add("icons.$index.icon_title", "Title is required for icon " . ($index + 1));
                    }
                    if (empty($icon['icon_content'])) {
                        $validator->errors()->add("icons.$index.icon_content", "Content is required for icon " . ($index + 1));
                    }
                }
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Lưu AboutUs
        $data = $request->only(['title', 'description', 'sub_title', 'section']);
        $aboutUs = AboutUs::create($data);

        // Lưu icons
        if ($request->has('icons')) {
            foreach ($request->icons as $index => $iconInput) {
                $iconPath = null;

                if (isset($iconInput['icon']) && $iconInput['icon'] instanceof \Illuminate\Http\UploadedFile) {
                    $iconPath = $iconInput['icon']->store('about_us_icons', 'public');
                }

                $aboutUs->icons()->create([
                    'icon' => $iconPath,
                    'icon_title' => $request->section === 'Phần 1' ? $iconInput['icon_title'] : null,
                    'icon_content' => $iconInput['icon_content'],
                ]);
            }
        }

        return redirect()->route('admin.about-us.index')->with('success', 'About Us content created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return view('admin.about-us.show', compact('aboutUs'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        return view('admin.about-us.edit', compact('aboutUs'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $aboutUs = AboutUs::findOrFail($id);

        // Validate chung
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'icons' => 'required|array|min:1',
            'icons.*.icon' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'sub_title' => 'nullable|string|max:255',
            'section' => 'required|in:Phần 1,Phần 2',
        ]);

        // Validate riêng theo section
        $validator->after(function ($validator) use ($request) {
            if ($request->input('section') === 'Phần 2') {
                if (empty($request->input('sub_title'))) {
                    $validator->errors()->add('sub_title', 'Sub Title is required when Section is Phần 2.');
                }

                foreach ($request->input('icons', []) as $index => $icon) {
                    if (empty($icon['icon_content'])) {
                        $validator->errors()->add("icons.$index.icon_content", "Content is required for icon " . ($index + 1));
                    }
                }
            } else {
                foreach ($request->input('icons', []) as $index => $icon) {
                    if (empty($icon['icon_title'])) {
                        $validator->errors()->add("icons.$index.icon_title", "Title is required for icon " . ($index + 1));
                    }
                    if (empty($icon['icon_content'])) {
                        $validator->errors()->add("icons.$index.icon_content", "Content is required for icon " . ($index + 1));
                    }
                }
            }
        });

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        // Cập nhật AboutUs
        $data = $request->only(['title', 'description', 'sub_title', 'section']);
        $aboutUs->update($data);

        // Xóa icon cũ
        $aboutUs->icons()->delete();

        // Lưu icons mới
        if ($request->has('icons')) {
            foreach ($request->icons as $index => $iconInput) {
                $iconPath = null;

                if (isset($iconInput['icon']) && $iconInput['icon'] instanceof \Illuminate\Http\UploadedFile) {
                    $iconPath = $iconInput['icon']->store('about_us_icons', 'public');
                } else {
                    $iconPath = $iconInput['existing_icon'] ?? null;
                }

                $aboutUs->icons()->create([
                    'icon' => $iconPath,
                    'icon_title' => $request->section === 'Phần 1' ? $iconInput['icon_title'] : null,
                    'icon_content' => $iconInput['icon_content'],
                ]);
            }
        }

        return redirect()->route('admin.about-us.index')->with('success', 'About Us content updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $aboutUs = AboutUs::findOrFail($id);
        $aboutUs->delete();

        return redirect()->route('admin.about-us.index')->with('success', 'About Us content deleted successfully.');
    }
}
