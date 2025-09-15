<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
{
    $services = Service::with(['details', 'children', 'parent'])
        ->whereNull('parent_id')
        ->orderBy('sort_order')
        ->paginate(15);

    return view('admin.services.index', compact('services'));

}
public function indexFrontend()
    {
        // Fetch active parent services with their children and category
        $services = Service::where('is_active', true)
            ->whereNull('parent_id')
            ->with(['children', 'category'])
            ->orderBy('sort_order')
            ->get();

        // Pass data to the view
        return view('services.index', compact('services'));
    }
public function show(Service $service)
    {
        // Load related data (e.g., category, parent, children) if needed
        $service->load(['category', 'parent', 'children', 'details']);

        // Return the admin view for the service
        return view('admin.services.show', compact('service'));
    }

  public function create()
{
    $categories = Category::orderBy('name')->get();
    $parentServices = Service::whereNull('parent_id')->orderBy('name')->get();
    return view('admin.services.create', compact('categories', 'parentServices'));
}

public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|unique:services',
        'description' => 'required|string',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'icon_page_home' => 'nullable|image|mimes:png|max:1024',
        'icon_page_service' => 'nullable|image|mimes:png|max:1024',
        'price_range' => 'nullable|string|max:100',
        'duration' => 'nullable|string|max:50',
        'category_id' => 'required|exists:categories,id',
        'parent_id' => 'nullable|exists:services,id',
        'is_active' => 'boolean',
        'sort_order' => 'integer',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500'
    ]);

    if ($request->hasFile('image')) {
        $validated['image'] = $request->file('image')->store('services', 'public');
    }

    if ($validated['parent_id']) {
        // Child service: only icon_page_service
        $validated['icon_page_home'] = null;
        if ($request->hasFile('icon_page_service')) {
            $validated['icon_page_service'] = $request->file('icon_page_service')->store('service-icons/service', 'public');
        }
    } else {
        // Parent service: only icon_page_home
        $validated['icon_page_service'] = null;
        if ($request->hasFile('icon_page_home')) {
            $validated['icon_page_home'] = $request->file('icon_page_home')->store('service-icons/home', 'public');
        }
    }

    Service::create($validated);

    return redirect()->route('admin.services.index')
        ->with('success', 'Dịch vụ đã được tạo thành công');
}

   public function edit(Service $service)
{
    $categories = Category::orderBy('name')->get();
    $parentServices = Service::whereNull('parent_id')->whereNot('id', $service->id)->orderBy('name')->get();
    return view('admin.services.edit', compact('service', 'categories', 'parentServices'));
}
   public function update(Request $request, Service $service)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'required|string|unique:services,slug,' . $service->id,
        'description' => 'required|string',
        'content' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        'icon_page_home' => 'nullable|image|mimes:png|max:1024',
        'icon_page_service' => 'nullable|image|mimes:png|max:1024',
        'price_range' => 'nullable|string|max:100',
        'duration' => 'nullable|string|max:50',
        'category_id' => 'required|exists:categories,id',
        'parent_id' => 'nullable|exists:services,id',
        'is_active' => 'boolean',
        'allow_line_breaks' => 'boolean',
        'sort_order' => 'integer',
        'meta_title' => 'nullable|string|max:255',
        'meta_description' => 'nullable|string|max:500'
    ]);

    if ($request->hasFile('image')) {
        if ($service->image) {
            Storage::disk('public')->delete($service->image);
        }
        $validated['image'] = $request->file('image')->store('services', 'public');
    }

    if ($validated['parent_id']) {
        // Child service: only icon_page_service
        if ($service->icon_page_home) {
            Storage::disk('public')->delete($service->icon_page_home);
        }
        $validated['icon_page_home'] = null;
        if ($request->hasFile('icon_page_service')) {
            if ($service->icon_page_service) {
                Storage::disk('public')->delete($service->icon_page_service);
            }
            $validated['icon_page_service'] = $request->file('icon_page_service')->store('service-icons/service', 'public');
        }
    } else {
        // Parent service: only icon_page_home
        if ($service->icon_page_service) {
            Storage::disk('public')->delete($service->icon_page_service);
        }
        $validated['icon_page_service'] = null;
        if ($request->hasFile('icon_page_home')) {
            if ($service->icon_page_home) {
                Storage::disk('public')->delete($service->icon_page_home);
            }
            $validated['icon_page_home'] = $request->file('icon_page_home')->store('service-icons/home', 'public');
        }
    }

    $service->update($validated);

    return redirect()->route('admin.services.index')
        ->with('success', 'Dịch vụ đã được cập nhật thành công');
}

    public function destroy(Service $service)
{
    if ($service->image) {
        Storage::disk('public')->delete($service->image);
    }
    if ($service->icon_page_home) {
        Storage::disk('public')->delete($service->icon_page_home);
    }
    if ($service->icon_page_service) {
        Storage::disk('public')->delete($service->icon_page_service);
    }

    $service->delete();

    return redirect()->route('admin.services.index')
        ->with('success', 'Dịch vụ đã được xóa thành công');
}


    public function toggleStatus(Service $service)
    {
        $service->update(['is_active' => !$service->is_active]);

        return response()->json([
            'success' => true,
            'is_active' => $service->is_active
        ]);
    }
}
