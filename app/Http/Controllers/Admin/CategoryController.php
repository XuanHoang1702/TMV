<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $type = $request->get('type', 'all');

        $query = Category::with('children');

        if ($type !== 'all') {
            $query->ofType($type);
        }

        if ($request->search) {
            $searchTerm = '%' . $request->search . '%';
            $query->where(function ($q) use ($searchTerm) {
                $q->where('name', 'LIKE', $searchTerm)
                  ->orWhere('slug', 'LIKE', $searchTerm)
                  ->orWhere('description', 'LIKE', $searchTerm);
            });
        }

        $categories = $query->roots()->orderBy('order')->paginate(15);

        return view('admin.categories.index', compact('categories', 'type'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $type = $request->get('type', 'general');
        $parentCategories = Category::ofType($type)->roots()->active()->get();

        return view('admin.categories.create', compact('parentCategories', 'type'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'slug' => 'nullable|string|max:255|unique:categories',
        'description' => 'nullable|string',

        'parent_id' => 'nullable|exists:categories,id',
        'order' => 'nullable|integer|min:0',
        'is_active' => 'boolean',
        'type' => 'required|string|in:general,services,news'
    ]);

    if (empty($validated['slug'])) {
        $validated['slug'] = Str::slug($validated['name']);
    }


    $originalSlug = $validated['slug'];
    $count = 1;
    while (Category::where('slug', $validated['slug'])->exists()) {
        $validated['slug'] = $originalSlug . '-' . $count;
        $count++;
    }



    Category::create($validated);

    return redirect()->route('admin.categories.index', ['type' => $validated['type']])
        ->with('success', 'Category create successfully');
}

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        $category->load(['parent', 'children']);

        return view('admin.categories.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $parentCategories = Category::ofType($category->type)
            ->where('id', '!=', $category->id)
            ->roots()
            ->active()
            ->get();

        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, Category $category)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'slug' => ['nullable', 'string', 'max:255', Rule::unique('categories')->ignore($category->id)],
        'description' => 'nullable|string',

        'parent_id' => ['nullable', 'exists:categories,id', Rule::notIn([$category->id])],
        'order' => 'nullable|integer|min:0',
        'is_active' => 'boolean',
        'type' => 'required|string|in:general,services,news'
    ]);

    if (empty($validated['slug'])) {
        $validated['slug'] = Str::slug($validated['name']);
    }

    // Ensure unique slug
    $originalSlug = $validated['slug'];
    $count = 1;
    while (Category::where('slug', $validated['slug'])->where('id', '!=', $category->id)->exists()) {
        $validated['slug'] = $originalSlug . '-' . $count;
        $count++;
    }




    $category->update($validated);

    return redirect()->route('admin.categories.index', ['type' => $validated['type']])
        ->with('success', 'Category update successfully');
}

    /**
     * Remove the specified resource from storage.
     */
   public function destroy(Category $category)
{
    // Nếu category có children, xóa luôn children
    if ($category->children()->count() > 0) {
        foreach ($category->children as $child) {
            $child->delete(); // xóa con
        }
    }

    $category->delete(); // xóa chính nó

    return redirect()->route('admin.categories.index', ['type' => $category->type])
        ->with('success', 'Category and child-category deleted');
}


    /**
     * Toggle category status
     */
    public function toggleStatus(Category $category)
    {
        $category->update(['is_active' => !$category->is_active]);

        $status = $category->is_active ? 'kích hoạt' : 'vô hiệu hóa';

        return response()->json([
            'success' => true,
            'message' => "Danh mục đã được {$status}",
            'is_active' => $category->is_active
        ]);
    }

    /**
     * Update category order
     */
    public function updateOrder(Request $request)
    {
        $validated = $request->validate([
            'categories' => 'required|array',
            'categories.*.id' => 'required|integer|exists:categories,id',
            'categories.*.order' => 'required|integer|min:0'
        ]);

        foreach ($validated['categories'] as $categoryData) {
            Category::where('id', $categoryData['id'])->update(['order' => $categoryData['order']]);
        }

        return response()->json(['success' => true, 'message' => 'Order updated']);
    }
}
