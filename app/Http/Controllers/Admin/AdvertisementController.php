<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Advertisement;

class AdvertisementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $advertisements = Advertisement::with('service')->orderBy('order')->get();
        return view('admin.advertisement.index', compact('advertisements'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = \App\Models\Service::where('parent_id', null)->get();
        return view('admin.advertisement.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'page' => 'required|string',
            'main_image' => 'required|image|max:2048',
            'sub_images' => 'nullable|array|max:4', // Giới hạn tối đa 4 ảnh
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'titles' => 'nullable|array|max:4', // Giới hạn titles tương ứng
            'titles.*' => 'nullable|string',
            'contents' => 'nullable|array|max:4', // Giới hạn contents tương ứng
            'contents.*' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        $mainImagePath = $request->file('main_image')->store('advertisements', 'public');

        $subImagePaths = [];
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $subImage) {
                $subImagePaths[] = $subImage->store('advertisements', 'public');
            }
        }

        Advertisement::create([
            'service_id' => $request->service_id,
            'page' => $request->page,
            'main_image' => $mainImagePath,
            'sub_images' => $subImagePaths,
            'titles' => $request->titles,
            'contents' => $request->contents,
            'order' => $request->order ?? 0,
            'is_active' => $request->is_active ?? true,
        ]);

        return redirect()->route('admin.advertisement.index')->with('success', 'Advertisement created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $advertisement = Advertisement::findOrFail($id);
        return view('admin.advertisement.show', compact('advertisement'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $services = \App\Models\Service::where('parent_id', null)->get();
        return view('admin.advertisement.edit', compact('advertisement', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $advertisement = Advertisement::findOrFail($id);

        $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'page' => 'required|string',
            'main_image' => 'nullable|image|max:2048',
            'sub_images' => 'nullable|array|max:4', // Giới hạn tối đa 4 ảnh
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'titles' => 'nullable|array|max:4', // Giới hạn titles tương ứng
            'titles.*' => 'nullable|string',
            'contents' => 'nullable|array|max:4', // Giới hạn contents tương ứng
            'contents.*' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        // Xóa main_image cũ nếu có main_image mới
        if ($request->hasFile('main_image')) {
            if ($advertisement->main_image && Storage::disk('public')->exists($advertisement->main_image)) {
                Storage::disk('public')->delete($advertisement->main_image);
            }
            $mainImagePath = $request->file('main_image')->store('advertisements', 'public');
            $advertisement->main_image = $mainImagePath;
        }

        // Xóa sub_images cũ và cập nhật sub_images mới
        if ($request->hasFile('sub_images')) {
            if (!empty($advertisement->sub_images)) {
                foreach ($advertisement->sub_images as $subImage) {
                    if (Storage::disk('public')->exists($subImage)) {
                        Storage::disk('public')->delete($subImage);
                    }
                }
            }
            $subImagePaths = [];
            foreach ($request->file('sub_images') as $subImage) {
                $subImagePaths[] = $subImage->store('advertisements', 'public');
            }
            $advertisement->sub_images = $subImagePaths;
        }

        // Cập nhật các trường khác
        $advertisement->service_id = $request->service_id;
        $advertisement->page = $request->page;
        $advertisement->titles = $request->titles;
        $advertisement->contents = $request->contents;
        $advertisement->order = $request->order ?? 0;
        $advertisement->is_active = $request->is_active ?? true;

        $advertisement->save();

        return redirect()->route('admin.advertisement.index')->with('success', 'Advertisement updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $advertisement = Advertisement::findOrFail($id);

        // Xóa main_image từ storage
        if ($advertisement->main_image && Storage::disk('public')->exists($advertisement->main_image)) {
            Storage::disk('public')->delete($advertisement->main_image);
        }

        // Xóa tất cả sub_images từ storage
        if (!empty($advertisement->sub_images)) {
            foreach ($advertisement->sub_images as $subImage) {
                if (Storage::disk('public')->exists($subImage)) {
                    Storage::disk('public')->delete($subImage);
                }
            }
        }

        // Xóa bản ghi Advertisement
        $advertisement->delete();

        return redirect()->route('admin.advertisement.index')->with('success', 'Advertisement deleted successfully.');
    }
}
