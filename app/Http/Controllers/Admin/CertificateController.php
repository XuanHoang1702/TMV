<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Certificate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

class CertificateController extends Controller
{
    private const MAX_CERTIFICATES = 4;

    public function index()
    {
        $certificates = Certificate::orderBy('order')->paginate(15);
        return view('admin.certificates.index', compact('certificates'));
    }

    public function create()
    {
        // Kiểm tra nếu đã đạt giới hạn tối đa thì không cho tạo mới
        $currentCount = Certificate::count();
        if ($currentCount >= self::MAX_CERTIFICATES) {
            return redirect()->route('admin.certificates.index')
                ->with('error', 'Chỉ được tạo tối đa ' . self::MAX_CERTIFICATES . ' chứng chỉ. Vui lòng xóa một chứng chỉ cũ trước khi tạo mới.');
        }

        return view('admin.certificates.create');
    }

    public function store(Request $request)
    {
        // Kiểm tra giới hạn trước khi validate
        $currentCount = Certificate::count();
        if ($currentCount >= self::MAX_CERTIFICATES) {
            return redirect()->route('admin.certificates.index')
                ->with('error', 'Chỉ được tạo tối đa ' . self::MAX_CERTIFICATES . ' chứng chỉ. Vui lòng xóa một chứng chỉ cũ trước khi tạo mới.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('certificates', 'public');
        }

        Certificate::create([
            'title' => $validated['title'],
            'image_path' => $imagePath,
            'description' => $validated['description'],
            'order' => $validated['order'] ?? 0,
        ]);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Chứng chỉ đã được tạo thành công');
    }

    public function show(Certificate $certificate)
    {
        return view('admin.certificates.show', compact('certificate'));
    }

    public function edit(Certificate $certificate)
    {
        return view('admin.certificates.edit', compact('certificate'));
    }

    public function update(Request $request, Certificate $certificate)
    {
        // Kiểm tra giới hạn khi update (trường hợp có thêm image mới, nhưng thực tế update không tăng số lượng)
        // Giữ lại để đảm bảo an toàn
        $currentCount = Certificate::count();
        if ($currentCount >= self::MAX_CERTIFICATES) {
            return redirect()->route('admin.certificates.index')
                ->with('error', 'Chỉ được tạo tối đa ' . self::MAX_CERTIFICATES . ' chứng chỉ. Vui lòng xóa một chứng chỉ cũ trước khi cập nhật.');
        }

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
            'order' => 'nullable|integer|min:0',
        ]);

        $imagePath = $certificate->image_path;
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($imagePath && \Storage::disk('public')->exists($imagePath)) {
                \Storage::disk('public')->delete($imagePath);
            }
            $imagePath = $request->file('image')->store('certificates', 'public');
        }

        $certificate->update([
            'title' => $validated['title'],
            'image_path' => $imagePath,
            'description' => $validated['description'],
            'order' => $validated['order'] ?? $certificate->order,
        ]);

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Chứng chỉ đã được cập nhật thành công');
    }

    public function destroy(Certificate $certificate)
    {
        // Xóa ảnh nếu có trước khi xóa record
        if ($certificate->image_path && \Storage::disk('public')->exists($certificate->image_path)) {
            \Storage::disk('public')->delete($certificate->image_path);
        }

        $certificate->delete();

        return redirect()->route('admin.certificates.index')
            ->with('success', 'Chứng chỉ đã được xóa thành công');
    }

    /**
     * Kiểm tra xem có thể tạo thêm certificate không
     */
    public static function canCreateMore()
    {
        return Certificate::count() < self::MAX_CERTIFICATES;
    }

    /**
     * Lấy số lượng certificate hiện tại
     */
    public static function getCurrentCount()
    {
        return Certificate::count();
    }
}
