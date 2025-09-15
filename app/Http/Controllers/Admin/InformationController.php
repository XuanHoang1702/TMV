<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Information;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InformationController extends Controller
{
    public function index()
    {
        $informations = Information::all();
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
        return view('admin.informations.edit', compact('information'));
    }

    public function store(Request $request)
{
    // Kiểm tra đã có bản ghi chưa
    if (Information::count() >= 1) {
        return redirect()
            ->route('admin.informations.index')
            ->with('error', 'Bạn chỉ được phép thêm 1 thông tin liên hệ. Vui lòng chỉnh sửa nội dung đã có.');
    }

    $validated = $request->validate([
        'name'           => 'required|string|max:255',
        'address'        => 'required|string|max:255',
        'email'          => 'required|email|max:255',
        'working_time'   => 'nullable|array',
        'images_address' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'hotline'        => 'nullable|string|max:255',
        'website'        => 'nullable|url|max:255',
    ]);

    $data = $validated;

    // Xử lý working_time -> JSON
    if (isset($data['working_time']) && is_array($data['working_time'])) {
        $data['working_time'] = json_encode($data['working_time'], JSON_UNESCAPED_UNICODE);
    }

    // Upload ảnh
    if ($request->hasFile('images_address')) {
        $data['images_address'] = $request->file('images_address')->store('images_address', 'public');
    }

    Information::create($data);

    return redirect()->route('admin.informations.index')->with('success', 'Thêm thông tin thành công');
}

    public function show($id)
    {
        $information = Information::findOrFail($id);
        return response()->json($information);
    }

    public function update(Request $request, $id)
    {
        $information = Information::findOrFail($id);

        $validated = $request->validate([
            'name'           => 'sometimes|string|max:255',
            'address'        => 'sometimes|string|max:255',
            'email'          => 'sometimes|email|max:255',
            'working_time'   => 'nullable|array',
            'images_address' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'hotline'        => 'nullable|string|max:255',
            'website'        => 'nullable|url|max:255',
        ]);

        $data = $validated;

        // Xử lý working_time -> JSON
        if (isset($data['working_time']) && is_array($data['working_time'])) {
            $data['working_time'] = json_encode($data['working_time'], JSON_UNESCAPED_UNICODE);
        }

        // Upload ảnh mới (xóa ảnh cũ)
        if ($request->hasFile('images_address')) {
            if ($information->images_address) {
                Storage::disk('public')->delete($information->images_address);
            }
            $data['images_address'] = $request->file('images_address')->store('images_address', 'public');
        }

        $information->update($data);

        return redirect()->route('admin.informations.index')->with('success', 'Cập nhật thông tin thành công');
    }

    public function destroy($id)
    {
        $information = Information::findOrFail($id);

        if ($information->images_address) {
            Storage::disk('public')->delete($information->images_address);
        }

        $information->delete();

        return redirect()->route('admin.informations.index')->with('success', 'Xóa thông tin thành công');
    }
}
