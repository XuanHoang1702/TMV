<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    protected $settings = [
        'site_name' => ['type' => 'text', 'label' => 'Tên website'],
        'site_description' => ['type' => 'textarea', 'label' => 'Mô tả website'],
        'site_phone' => ['type' => 'text', 'label' => 'Số điện thoại'],
        'site_email' => ['type' => 'email', 'label' => 'Email'],
        'site_address' => ['type' => 'textarea', 'label' => 'Địa chỉ'],
        'facebook_url' => ['type' => 'url', 'label' => 'Facebook URL'],
        'instagram_url' => ['type' => 'url', 'label' => 'Instagram URL'],
        'zalo_url' => ['type' => 'url', 'label' => 'Zalo URL'],
        'working_hours' => ['type' => 'text', 'label' => 'Giờ làm việc'],
        'google_analytics_id' => ['type' => 'text', 'label' => 'Google Analytics ID'],
        'meta_title_default' => ['type' => 'text', 'label' => 'Meta Title mặc định'],
        'meta_description_default' => ['type' => 'textarea', 'label' => 'Meta Description mặc định']
    ];

    public function index()
    {
        $settings = Setting::pluck('value', 'key_name')->toArray();
        return view('admin.settings.index', compact('settings'));
    }

    public function update(Request $request)
    {
        $validated = $request->validate([
            'site_name' => 'required|string|max:255',
            'site_description' => 'nullable|string|max:500',
            'site_phone' => 'nullable|string|max:20',
            'site_email' => 'nullable|email',
            'site_address' => 'nullable|string|max:500',
            'facebook_url' => 'nullable|url',
            'instagram_url' => 'nullable|url',
            'zalo_url' => 'nullable|url',
            'working_hours' => 'nullable|string|max:100',
            'google_analytics_id' => 'nullable|string|max:50',
            'meta_title_default' => 'nullable|string|max:255',
            'meta_description_default' => 'nullable|string|max:500'
        ]);

        foreach ($validated as $key => $value) {
            Setting::updateOrCreate(
                ['key_name' => $key],
                ['value' => $value, 'type' => 'string']
            );
        }

        return back()->with('success', 'Cài đặt đã được cập nhật thành công');
    }
}
