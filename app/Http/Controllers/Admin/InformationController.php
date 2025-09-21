<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Http;

class InformationController extends Controller
{
    public function index()
    {
        $informations = Information::all()->map(function ($info) {
            // Ưu tiên địa chỉ đã lưu, sau đó mới reverse geocode
            if ($info->address) {
                $info->display_address = $info->address;
            } elseif ($info->latitude && $info->longitude) {
                $info->display_address = $this->getRealAddressFromCoordinates($info->latitude, $info->longitude);
            } else {
                $info->display_address = 'Chưa có địa chỉ';
            }
            return $info;
        });

        return view('admin.informations.index', compact('informations'));
    }

    public function create()
    {
        if (Information::count() >= 1) {
            return redirect()
                ->route('admin.informations.index')
                ->with('error', 'Bạn chỉ được phép thêm 1 thông tin. Vui lòng chỉnh sửa nội dung đã có.');
        }
        return view('admin.informations.create');
    }

    public function edit($id)
{
    $information = Information::findOrFail($id);

    // Parse JSON data for display
    $information->working_time = $information->working_time ? json_decode($information->working_time, true) : [
        'monday_friday' => ['open' => '08:00', 'close' => '18:00'],
        'saturday' => ['open' => '08:00', 'close' => '12:00'],
        'sunday' => 'Nghỉ'
    ];

    $information->images_address = $information->images_address ? json_decode($information->images_address, true) : [];

    // Prepare map data
    $information->map_data = [
        'lat' => $information->latitude ?? 21.0285,
        'lng' => $information->longitude ?? 105.8542,
        'address' => $information->address ?? '',
        'zoom' => $information->latitude ? 16 : 10
    ];

    return view('admin.informations.edit', compact('information'));
}

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'address' => 'required|string|max:500',
            'latitude' => 'required|numeric|between:-90,90',
            'longitude' => 'required|numeric|between:-180,180',
            'email' => 'required|email|max:255',
            'hotline' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'images_address' => 'nullable|array|max:10',
            'images_address.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'working_time' => 'required|array',
        ]);

        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            $information = new Information();
            $information->name = $request->name;
            $information->address = $request->address; // Lưu địa chỉ thực tế
            $information->latitude = $request->latitude;
            $information->longitude = $request->longitude;
            $information->email = $request->email;
            $information->hotline = $request->hotline;
            $information->website = $request->website;
            $information->working_time = json_encode($request->working_time);

            // Handle images
            if ($request->hasFile('images_address')) {
                $imagePaths = [];
                foreach ($request->file('images_address') as $image) {
                    if ($image->isValid()) {
                        $path = $image->store('information_images', 'public');
                        $imagePaths[] = $path;
                    }
                }
                $information->images_address = json_encode($imagePaths);
            }

            $information->save();

            return redirect()->route('admin.informations.index')
                ->with('success', 'Thêm thông tin liên hệ thành công!');

        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())
                ->withInput();
        }
    }

  public function update(Request $request, $id)
{
    $information = Information::findOrFail($id);

    $validator = Validator::make($request->all(), [
        'name' => 'required|string|max:255',
        'address' => 'required|string|max:500',
        'latitude' => 'nullable|numeric|between:-90,90',
        'longitude' => 'nullable|numeric|between:-180,180',
        'email' => 'required|email|max:255',
        'hotline' => 'nullable|string|max:20',
        'website' => 'nullable|url|max:255',
        'working_time' => 'required|array',
    ]);

    if ($validator->fails()) {
        return redirect()->back()->withErrors($validator)->withInput();
    }

    try {
        $data = $request->only([
            'name', 'address', 'latitude', 'longitude',
            'email', 'hotline', 'website', 'working_time'
        ]);
        $data['working_time'] = json_encode($request->working_time);

        // Set latitude and longitude to null if not provided
        $data['latitude'] = $request->latitude ?? null;
        $data['longitude'] = $request->longitude ?? null;

        // Preserve existing images_address (no image handling in form)
        $data['images_address'] = $information->images_address;

        $information->update($data);

        // Clear cache only if latitude and longitude exist
        if (!empty($data['latitude']) && !empty($data['longitude'])) {
            $cacheKey = "real_address_{$data['latitude']}_{$data['longitude']}";
            cache()->forget($cacheKey);
        }

        return redirect()->route('admin.informations.index')
            ->with('success', 'Cập nhật thông tin thành công!');
    } catch (\Exception $e) {
        return redirect()->back()
            ->with('error', 'Có lỗi xảy ra: ' . $e->getMessage())
            ->withInput();
    }
}
    public function show($id)
    {
        $information = Information::findOrFail($id);
      return view('admin.informations.show', compact('information'));

    }

    public function destroy($id)
    {
        $information = Information::findOrFail($id);

        // Delete images
        if ($information->images_address) {
            $images = json_decode($information->images_address, true) ?? [];
            foreach ($images as $image) {
                Storage::disk('public')->delete($image);
            }
        }

        // Clear cache
        if ($information->latitude && $information->longitude) {
            $cacheKey = "real_address_{$information->latitude}_{$information->longitude}";
            cache()->forget($cacheKey);
        }

        $information->delete();

        return redirect()->route('admin.informations.index')
            ->with('success', 'Xóa thông tin thành công!');
    }


}
