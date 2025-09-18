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
            'sub_images' => 'nullable|array',
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'titles' => 'nullable|array',
            'titles.*' => 'nullable|string',
            'contents' => 'nullable|array',
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
            'sub_images' => json_encode($subImagePaths),
            'titles' => json_encode($request->titles),
            'contents' => json_encode($request->contents),
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

    public function update(Request $request, $id)
    {
        $advertisement = Advertisement::findOrFail($id);

        $request->validate([
            'service_id' => 'nullable|exists:services,id',
            'page' => 'required|string',
            'main_image' => 'nullable|image|max:2048',
            'sub_images' => 'nullable|array',
            'sub_images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'titles' => 'nullable|array',
            'titles.*' => 'nullable|string',
            'contents' => 'nullable|array',
            'contents.*' => 'nullable|string',
            'order' => 'nullable|integer',
            'is_active' => 'nullable|boolean',
        ]);

        if ($request->hasFile('main_image')) {
            $mainImagePath = $request->file('main_image')->store('advertisements', 'public');
            $advertisement->main_image = $mainImagePath;
        }

        $subImagePaths = json_decode($advertisement->sub_images, true) ?? [];
        if ($request->hasFile('sub_images')) {
            foreach ($request->file('sub_images') as $subImage) {
                $subImagePaths[] = $subImage->store('advertisements', 'public');
            }
        }

        $advertisement->service_id = $request->service_id;
        $advertisement->page = $request->page;
        $advertisement->sub_images = json_encode($subImagePaths);
        $advertisement->titles = json_encode($request->titles);
        $advertisement->contents = json_encode($request->contents);
        $advertisement->order = $request->order ?? 0;
        $advertisement->is_active = $request->is_active ?? true;

        $advertisement->save();

        return redirect()->route('admin.advertisement.index')->with('success', 'Advertisement updated successfully.');
    }

    public function destroy($id)
    {
        $advertisement = Advertisement::findOrFail($id);
        $advertisement->delete();

        return redirect()->route('admin.advertisement.index')->with('success', 'Advertisement deleted successfully.');
    }
}
