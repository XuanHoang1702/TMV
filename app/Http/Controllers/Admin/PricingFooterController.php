<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PricingFooter;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PricingFooterController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pricingFooters = PricingFooter::ordered()->get();
        return view('admin.pricing_footer.index', compact('pricingFooters'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pricing_footer.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();

        if ($request->hasFile('icon')) {
            $data['icon'] = $request->file('icon')->store('pricing_footer', 'public');
        }

        PricingFooter::create($data);

        return redirect()->route('admin.pricing_footer.index')
            ->with('success', 'Pricing footer item created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(PricingFooter $pricingFooter)
    {
        return view('admin.pricing_footer.show', compact('pricingFooter'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(PricingFooter $pricingFooter)
    {
        return view('admin.pricing_footer.edit', compact('pricingFooter'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, PricingFooter $pricingFooter)
    {
        $request->validate([
            'title' => 'nullable|string|max:255',
            'content' => 'required|string',
            'icon' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'is_active' => 'boolean',
            'sort_order' => 'integer|min:0'
        ]);

        $data = $request->all();

        if ($request->hasFile('icon')) {
            // Delete old icon if exists
            if ($pricingFooter->icon) {
                Storage::disk('public')->delete($pricingFooter->icon);
            }
            $data['icon'] = $request->file('icon')->store('pricing_footer', 'public');
        }

        $pricingFooter->update($data);

        return redirect()->route('admin.pricing_footer.index')
            ->with('success', 'Pricing footer item updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(PricingFooter $pricingFooter)
    {
        // Delete icon file if exists
        if ($pricingFooter->icon) {
            Storage::disk('public')->delete($pricingFooter->icon);
        }

        $pricingFooter->delete();

        return redirect()->route('admin.pricing_footer.index')
            ->with('success', 'Pricing footer item deleted successfully.');
    }

    /**
     * Toggle the status of the specified resource.
     */
    public function toggleStatus(PricingFooter $pricingFooter)
    {
        $pricingFooter->update([
            'is_active' => !$pricingFooter->is_active
        ]);

        return redirect()->back()
            ->with('success', 'Status updated successfully.');
    }
}
