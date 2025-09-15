<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\SiteInfo;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

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



    public function deleteHeaderLogo($id)
    {
        $siteInfo = SiteInfo::findOrFail($id);
        if ($siteInfo->header_logo) {
            Storage::disk('public')->delete($siteInfo->header_logo);
        }
        $siteInfo->header_logo = null;
        $siteInfo->save();

        return redirect()->route('admin.siteInfo.index')->with('success', 'Header logo đã được xóa thành công');
    }

    public function deleteFooterLogo($id)
    {
        $siteInfo = SiteInfo::findOrFail($id);
        if ($siteInfo->footer_logo) {
            Storage::disk('public')->delete($siteInfo->footer_logo);
        }
        $siteInfo->footer_logo = null;
        $siteInfo->save();

        return redirect()->route('admin.siteInfo.index')->with('success', 'Footer logo đã được xóa thành công');
    }

    public function deleteSlogan($id)
    {
        $siteInfo = SiteInfo::findOrFail($id);
        $siteInfo->slogan = null;
        $siteInfo->save();

        return redirect()->route('admin.siteInfo.index')->with('success', 'Slogan đã được xóa thành công');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $count = SiteInfo::count();
        if ($count > 0) {
            return redirect()->route('admin.siteInfo.index')->with('error', 'Chỉ được thêm 1 site info duy nhất.');
        }
        return view('admin.siteInfo.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slogan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = ['slogan' => $request->slogan];

        if ($request->hasFile('header_logo')) {
            $data['header_logo'] = $request->file('header_logo')->store('logo', 'public');
        }
        if ($request->hasFile('footer_logo')) {
            $data['footer_logo'] = $request->file('footer_logo')->store('logo', 'public');
        }

        SiteInfo::create($data);

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
            'header_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'footer_logo' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'slogan' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $siteInfo = SiteInfo::findOrFail($id);

        $data = ['slogan' => $request->slogan];

        if ($request->hasFile('header_logo')) {
            if ($siteInfo->header_logo) {
                Storage::disk('public')->delete($siteInfo->header_logo);
            }
            $data['header_logo'] = $request->file('header_logo')->store('logo', 'public');
        }
        if ($request->hasFile('footer_logo')) {
            if ($siteInfo->footer_logo) {
                Storage::disk('public')->delete($siteInfo->footer_logo);
            }
            $data['footer_logo'] = $request->file('footer_logo')->store('logo', 'public');
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
        if ($siteInfo->header_logo) {
            Storage::disk('public')->delete($siteInfo->header_logo);
        }
        if ($siteInfo->footer_logo) {
            Storage::disk('public')->delete($siteInfo->footer_logo);
        }
        $siteInfo->delete();
        return redirect()->route('admin.siteInfo.index')->with('success', 'Xóa SiteInfo thành công!');
    }
}
