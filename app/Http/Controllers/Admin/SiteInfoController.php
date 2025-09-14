<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteInfo;
use Illuminate\Support\Facades\Validator;


class SiteInfoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $siteInfo = SiteInfo::all();
        return view('admin.siteInfo.index', compact('siteInfo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $count = SiteInfo::count();
        if ($count > 0) {
            return redirect()->route('admin.siteInfo.index')->with('error', 'Chỉ được thêm 1 logo và 1 slogan duy nhất.');
        }
        return view('admin.siteInfo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slogan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePath = $request->file('logo')->store('logo', 'public');

        SiteInfo::create([
            'logo' => $imagePath,
            'slogan' => $request->slogan
        ]);

        return redirect()->route('admin.siteInfo.index')->with('success', 'Thêm site info thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $siteInfo = SiteInfo::findOrFail($id);
        return view('admin.siteInfo.edit',compact('siteInfo'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(), [
            'logo'   => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slogan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $siteInfo = SiteInfo::findOrFail($id);

        $data = ['slogan' => $request->slogan];

        if ($request->hasFile('logo')) {
            $imagePath = $request->file('logo')->store('logo', 'public');
            $data['logo'] = $imagePath;
        }

        $siteInfo->update($data);

        return redirect()->route('admin.siteInfo.index')->with('success', 'Cập nhật site info thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $siteInfo = SiteInfo::findOrFail($id);
        $siteInfo->delete();
        return redirect()->route('admin.siteInfo.index')->with('success', 'Xóa SiteInfo thành công!');
    }
}
