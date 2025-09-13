<?php

namespace App\Http\Controllers;

use App\Models\HospitalImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HopitalImageController extends Controller
{
    /**
     * Display a listing of the resource.
     * Lấy 5 ảnh mới nhất
     */
    public function index()
    {
        $images = HospitalImage::latest()->take(5)->get();
        return view('admin.hospital_images.index', compact('images'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.hospital_images.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('hospital_images', 'public');
        }

        HospitalImage::create([
            'image_path' => $imagePath,
        ]);

        return redirect()->route('hospital_images.index')->with('success', 'Image uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $image = HospitalImage::findOrFail($id);
        return view('admin.hospital_images.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $image = HospitalImage::findOrFail($id);
        return view('admin.hospital_images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $image = HospitalImage::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }

            $imagePath = $request->file('image')->store('hospital_images', 'public');
            $image->update(['image_path' => $imagePath]);
        }

        return redirect()->route('hospital_images.index')->with('success', 'Image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $total = HospitalImage::count();

        if ($total <= 5) {
            return redirect()->back()->withErrors(['error' => 'Không thể xóa vì số lượng ảnh tối thiểu là 5.']);
        }

        $image = HospitalImage::findOrFail($id);

        if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
            Storage::disk('public')->delete($image->image_path);
        }

        $image->delete();

        return redirect()->route('hospital_images.index')->with('success', 'Image deleted successfully.');
    }
}
