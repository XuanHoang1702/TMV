<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ZaloSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ZaloController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Hiển thị form update Zalo contact
     */
    public function index()
    {
        $zalo = ZaloSetting::getCurrent();
        return view('admin.zalo.index', compact('zalo'));
    }

    /**
     * Update Zalo contact
     */
    public function update(Request $request)
    {
        $request->validate([
            'zalo_contact' => 'required|string|max:20',
            'zalo_type' => 'required|in:oa,phone',
            'zalo_icon' => 'required|string|max:50',
            'messenger_contact' => 'nullable|string|max:100',
            'messenger_type' => 'required|in:facebook',
            'messenger_icon' => 'required|string|max:50',
            'call_contact' => 'nullable|string|max:20',
            'call_type' => 'required|in:phone',
            'call_icon' => 'required|string|max:50',
        ]);

        $zalo = ZaloSetting::getCurrent();
        $zalo->update([
            'zalo_contact' => $request->zalo_contact,
            'zalo_type' => $request->zalo_type,
            'zalo_icon' => $request->zalo_icon,
            'messenger_contact' => $request->messenger_contact,
            'messenger_type' => $request->messenger_type,
            'messenger_icon' => $request->messenger_icon,
            'call_contact' => $request->call_contact,
            'call_type' => $request->call_type,
            'call_icon' => $request->call_icon,
        ]);

        Session::flash('success', 'Cập nhật thông tin liên hệ thành công!');
        return redirect()->route('admin.zalo.index');
    }

    /**
     * Handle POST request for updating Zalo contact
     */
    public function store(Request $request)
    {
        return $this->update($request);
    }
}
