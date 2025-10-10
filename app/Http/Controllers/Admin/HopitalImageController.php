<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HopitalImage;
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
        $images = HopitalImage::latest()->take(5)->get();
        $total = HopitalImage::count();
        return view('admin.hospital_images.index', compact('images', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $total = HopitalImage::count();

        if ($total >= 5) {
            return redirect()->route('admin.hospital_images.index')->with('warning', 'Số lượng ảnh tối đa là 5. Bạn không thể thêm ảnh mới. Hãy xóa bớt hoặc cập nhật lại ảnh nếu muốn thêm ảnh mới.');
        }

        return view('admin.hospital_images.create', compact('total'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $total = HopitalImage::count();

        if ($total >= 5) {
            return redirect()->back()->withErrors(['error' => 'Can not add image, because max quantity is 5.']);
        }

        $validator = Validator::make($request->all(), [
            'images' => 'required|array|min:1|max:5',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $file) {
                $images[] = $file->store('hospital_images', 'public');
            }
        }

        foreach ($images as $imagePath) {
            HopitalImage::create([
                'image' => $imagePath,
                'title' => $request->title,
            ]);
        }

        return redirect()->route('admin.hospital_images.index')->with('success', 'Image uploaded successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $image = HopitalImage::findOrFail($id);
        return view('admin.hospital_images.show', compact('image'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $image = HopitalImage::findOrFail($id);
        return view('admin.hospital_images.edit', compact('image'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $image = HopitalImage::findOrFail($id);

        $validator = Validator::make($request->all(), [
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'nullable|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        if ($request->hasFile('image')) {
            // Xóa ảnh cũ
            if ($image->image && Storage::disk('public')->exists($image->image)) {
                Storage::disk('public')->delete($image->image);
            }

            $imagePath = $request->file('image')->store('hospital_images', 'public');
            $image->update(['image' => $imagePath]);
        }

        if ($request->filled('title')) {
            HopitalImage::query()->update(['title' => $request->title]);
        }

        return redirect()->route('admin.hospital_images.index')->with('success', 'Image updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $total = HopitalImage::count();

       

        $image = HopitalImage::findOrFail($id);

        if ($image->image && Storage::disk('public')->exists($image->image)) {
            Storage::disk('public')->delete($image->image);
        }

        $image->delete();

        return redirect()->route('admin.hospital_images.index')->with('success', 'Image deleted successfully.');
    }
}
