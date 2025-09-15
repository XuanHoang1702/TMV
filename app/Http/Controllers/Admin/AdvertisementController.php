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
        $advertisement = Advertisement::all();
        return view('admin.advertisement.index', compact('advertisement'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $advertisement = Advertisement::orderBy('page')->get();
        return view('admin.advertisement.create', compact('advertisement'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page' => 'required|string|max:255',
            'main_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sub_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // nhiều ảnh phụ
            'titles' => 'required|array',
            'titles.*' => 'string|max:255',
            'contents' => 'required|array',
            'contents.*' => 'string',
        ]);

        $mainImagePath = $request->file('main_image')->store('advertisements', 'public');

        $subImagePaths = [];
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $image) {
                $subImagePaths[] = $image->store('advertisements', 'public');
            }
        }

        $advertisement = Advertisement::create([
            'page' => $validated['page'],
            'main_image' => $mainImagePath,
            'sub_images' => $subImagePaths,
            'titles' => $validated['titles'],
            'contents' => $validated['contents'],
        ]);

        return response()->json([
            'message' => 'Advertisement created successfully!',
            'data' => $advertisement
        ]);
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
    public function edit(string $id)
    {
        $advertisement = Advertisement::findOrFail($id);
        return view('admin.advertisement.edit', compact('advertisement'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validated = $request->validate([
            'page' => 'required|string|max:255',
            'main_image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
            'sub_images.*' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // nhiều ảnh phụ
            'titles' => 'required|array',
            'titles.*' => 'string|max:255',
            'contents' => 'required|array',
            'contents.*' => 'string',
        ]);

        $mainImagePath = $request->file('main_image')->store('advertisements', 'public');

        $subImagePaths = [];
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $image) {
                $subImagePaths[] = $image->store('advertisements', 'public');
            }
        }

        $advertisement = Advertisement::findOrFail($id);

        $advertisement->update([
            'page' => $validated['page'],
            'main_image' => $mainImagePath,
            'sub_images' => $subImagePaths,
            'titles' => $validated['titles'],
            'contents' => $validated['contents'],
        ]);

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->delete();
        return redirect()->route('admin.advertisement.index')->with('success', 'Quảng cáo đã được xóa');
    }
}
