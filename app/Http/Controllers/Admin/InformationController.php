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
            'name' => 'sometimes|required|string|max:255',
            'address' => 'sometimes|required|string|max:500',
            'latitude' => 'sometimes|required|numeric|between:-90,90',
            'longitude' => 'sometimes|required|numeric|between:-180,180',
            'email' => 'sometimes|required|email|max:255',
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
            $data = $request->only([
                'name', 'address', 'latitude', 'longitude',
                'email', 'hotline', 'website', 'working_time'
            ]);

            // Handle working_time
            $data['working_time'] = json_encode($request->working_time);

            // Handle images
            if ($request->hasFile('images_address')) {
                // Delete old images
                if ($information->images_address) {
                    $oldImages = json_decode($information->images_address, true) ?? [];
                    foreach ($oldImages as $oldImage) {
                        Storage::disk('public')->delete($oldImage);
                    }
                }

                $imagePaths = [];
                $files = $request->file('images_address');

                if (!is_array($files)) {
                    $files = [$files];
                }

                foreach ($files as $image) {
                    if ($image && $image->isValid()) {
                        $path = $image->store('information_images', 'public');
                        $imagePaths[] = $path;
                    }
                }

                if (!empty($imagePaths)) {
                    $data['images_address'] = json_encode($imagePaths);
                }
            }

            $information->update($data);

            // Clear cache for this location
            $cacheKey = "real_address_{$data['latitude']}_{$data['longitude']}";
            cache()->forget($cacheKey);

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
        return response()->json($information);
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

    /**
     * Get REAL address from coordinates using multiple APIs
     */
  /**
 * Get REAL address from coordinates with DEBUG logging
 */
private function getRealAddressFromCoordinates($lat, $lng)
{
    // Cache key
    $cacheKey = "real_address_{$lat}_{$lng}";
    $cachedAddress = cache()->get($cacheKey);

    if ($cachedAddress && $cachedAddress !== "Vị trí ({$lat}, {$lng})") {
        return $cachedAddress;
    }

    // Log for debugging
    \Log::info("🔍 Starting reverse geocoding for coordinates: {$lat}, {$lng}");

    // Try Google Maps first
    $googleAddress = $this->getGoogleAddress($lat, $lng);
    \Log::info("Google API result: " . ($googleAddress ?: 'NULL'));

    if ($googleAddress && $this->isValidAddress($googleAddress)) {
        \Log::info("✅ Using Google address: {$googleAddress}");
        cache()->put($cacheKey, $googleAddress, 24 * 60 * 60);
        return $googleAddress;
    }

    // Fallback to OpenStreetMap Nominatim
    $nominatimAddress = $this->getNominatimAddress($lat, $lng);
    \Log::info("Nominatim result: " . ($nominatimAddress ?: 'NULL'));

    if ($nominatimAddress && $this->isValidAddress($nominatimAddress)) {
        \Log::info("✅ Using Nominatim address: {$nominatimAddress}");
        cache()->put($cacheKey, $nominatimAddress, 24 * 60 * 60);
        return $nominatimAddress;
    }

    // Enhanced fallback - Try to construct better address
    $fallback = $this->getEnhancedFallbackAddress($lat, $lng);
    \Log::info("❌ Using fallback address: {$fallback}");
    cache()->put($cacheKey, $fallback, 24 * 60 * 60);
    return $fallback;
}

/**
 * Enhanced Google Maps API call with better parameters
 */


/**
 * Improved Nominatim call with better Vietnamese address construction
 */
private function getNominatimAddress($lat, $lng)
{
    try {
        $url = "https://nominatim.openstreetmap.org/reverse";
        $params = [
            'format' => 'jsonv2',
            'lat' => $lat,
            'lon' => $lng,
            'addressdetails' => 1,
            'accept-language' => 'vi-VN,en-US',
            'zoom' => 18,
            'addressdetails' => 1
        ];

      

        $response = Http::timeout(15)
            ->withHeaders(['User-Agent' => 'LaravelApp/1.0 (contact@example.com)'])
            ->get($url, $params);

        \Log::info("Nominatim HTTP Status: " . $response->status());

        if ($response->successful()) {
            $data = $response->json();

            \Log::info("Nominatim response keys: " . implode(', ', array_keys($data)));

            if (isset($data['lat']) && isset($data['lon']) && !empty($data['display_name'])) {
                $address = $this->constructVietnameseAddress($data, $data['display_name']);
                \Log::info("✅ Nominatim address: {$address}");
                return $address;
            } else {
                \Log::warning("❌ Nominatim returned no address data");
            }
        } else {
            \Log::warning("❌ Nominatim HTTP error: " . $response->status());
        }

        return false;

    } catch (\Exception $e) {
        \Log::error('Nominatim exception: ' . $e->getMessage());
        return false;
    }
}

/**
 * Enhanced fallback using Vietnamese coordinate ranges
 */
private function getEnhancedFallbackAddress($lat, $lng)
{
    // Vietnamese coordinate ranges
    if ($lat >= 8.0 && $lat <= 23.5 && $lng >= 102.0 && $lng <= 109.5) {
        // North Vietnam (Hanoi area)
        if ($lat >= 20.5 && $lat <= 21.5 && $lng >= 105.5 && $lng <= 106.0) {
            return "Khu vực Hà Nội";
        }
        // South Vietnam (HCMC area)
        elseif ($lat >= 10.7 && $lat <= 10.9 && $lng >= 106.6 && $lng <= 106.8) {
            return "Khu vực TP. Hồ Chí Minh";
        }
        // Central Vietnam
        elseif ($lat >= 15.5 && $lat <= 17.0 && $lng >= 107.5 && $lng <= 108.5) {
            return "Khu vực Đà Nẵng";
        }
        // General Vietnam
        else {
            return "Việt Nam (Tọa độ: {$lat}, {$lng})";
        }
    }

    return "Vị trí ({$lat}, {$lng})";
}

/**
 * Improved address validation
 */
private function isValidAddress($address)
{
    if (!$address || strlen($address) < 8) {
        return false;
    }

    $invalidPatterns = [
        'unnamed road', 'unknown road', 'no address available',
        'vị trí tùy chỉnh', 'coordinates', 'lat/lng',
        'undefined', 'null', 'empty'
    ];

    $lowerAddress = strtolower(trim($address));
    foreach ($invalidPatterns as $pattern) {
        if (strpos($lowerAddress, $pattern) !== false) {
            return false;
        }
    }

    // Must contain some location indicators
    $validIndicators = ['đường', 'phố', 'hẻm', 'ngõ', 'quận', 'huyện', 'phường', 'xã',
                       'hà nội', 'hồ chí minh', 'đà nẵng', 'hải phòng', 'cần thơ'];

    $hasValidIndicator = false;
    foreach ($validIndicators as $indicator) {
        if (strpos($lowerAddress, $indicator) !== false) {
            $hasValidIndicator = true;
            break;
        }
    }

    return $hasValidIndicator || preg_match('/\d+\/[a-zA-Z0-9\s]+/i', $address);
}

/**
 * Improved Vietnamese address construction
 */
private function constructVietnameseAddress($data, $displayName)
{
    if (!isset($data['address'])) {
        return $displayName;
    }

    $address = $data['address'];
    $components = [];

    // House number / Street
    if (isset($address['house_number']) && isset($address['road'])) {
        $components[] = $address['house_number'] . '/' . $address['road'];
    } elseif (isset($address['street'])) {
        $components[] = $address['street'];
    }

    // Ward / District
    if (isset($address['suburb'])) {
        $components[] = $address['suburb'];
    } elseif (isset($address['city_district'])) {
        $components[] = $address['city_district'];
    }

    // District / City
    if (isset($address['city'])) {
        $components[] = $address['city'];
    } elseif (isset($address['state'])) {
        $components[] = $address['state'];
    }

    // Province / Region
    if (isset($address['state_district'])) {
        $components[] = $address['state_district'];
    }

    // Format as Vietnamese address
    $formatted = implode('/ ', array_filter($components));

    if (empty($formatted)) {
        return $displayName;
    }

    // Ensure it looks like a Vietnamese address
    if (strpos($formatted, 'Vietnam') !== false) {
        $formatted = str_replace('Vietnam', 'TP. Hồ Chí Minh', $formatted);
    }

    return $formatted;
}
}
