<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Process;
use App\Models\ProcessImage;
use App\Models\Service;
use Illuminate\Support\Facades\Validator;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $process = Process::with('processImages', 'service')->where('section', 'quy_trình')->get();
        return view('admin.process.index', compact('process'));
    }

    public function reasonIndex()
    {
        $process = Process::with('processImages', 'service')->where('section', 'lí_do')->get();
        return view('admin.reason.index', compact('process'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $services = Service::where('parent_id', null)->get();
        return view('admin.process.create', compact('services'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'service_id' => 'required|exists:services,id',
            'order' => 'required|integer',
            'title' => 'required|string',
            'page' => 'required|string',
            'section' => 'required|string|in:quy_trình,lí_do',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_titles' => 'required|array|min:1',
            'image_titles.*' => 'nullable|string',
            'image_descriptions' => 'nullable|array',
            'image_descriptions.*' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $process = Process::create([
            'service_id' => $request->service_id,
            'order' => $request->order,
            'title' => $request->title,
            'page' => $request->page,
            'section' => $request->section
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $imageFile) {
                $imagePath = $imageFile->store('process', 'public');
                ProcessImage::create([
                    'process_id' => $process->id,
                    'image' => $imagePath,
                    'title' => $request->image_titles[$index] ?? '',
                    'description' => $request->image_descriptions[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.process.index')->with('success', 'Tạo quy trình thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $process = Process::with('processImages', 'service')->findOrFail($id);
        return view('admin.process.show', compact('process'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $process = Process::with('processImages')->findOrFail($id);
        $services = Service::where('parent_id', null)->get();
        return view('admin.process.edit', compact('process', 'services'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'service_id' => 'required|exists:services,id',
            'order' => 'required|integer',
            'title' => 'required|string',
            'page' => 'required|string',
            'section' => 'required|string|in:quy_trình,lí_do',
            'images' => 'nullable|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_titles' => 'nullable|array|min:1',
            'image_titles.*' => 'nullable|string',
            'image_descriptions' => 'nullable|array',
            'image_descriptions.*' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $process = Process::findOrFail($id);

        $process->update([
            'service_id' => $request->service_id,
            'order' => $request->order,
            'title' => $request->title,
            'page' => $request->page,
            'section' => $request->section
        ]);

        // Delete old images
        $process->processImages()->delete();

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $imageFile) {
                $imagePath = $imageFile->store('process', 'public');
                ProcessImage::create([
                    'process_id' => $process->id,
                    'image' => $imagePath,
                    'title' => $request->image_titles[$index] ?? '',
                    'description' => $request->image_descriptions[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.process.index')->with('success', 'Cập nhật quy trình thành công');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $process = Process::findOrFail($id);
        $process->delete();
        return redirect()->route('admin.process.index')->with('success', 'Quy trình đã được xóa');

    }

    public function reasonCreate()
    {
        $services = Service::where('parent_id', null)->get();
        return view('admin.reason.create', compact('services'));
    }

    public function reasonStore(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'service_id' => 'required|exists:services,id',
            'order' => 'required|integer',
            'title' => 'required|string',
            'page' => 'required|string',
            'images' => 'required|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_titles' => 'required|array|min:1',
            'image_titles.*' => 'nullable|string',
            'image_descriptions' => 'nullable|array',
            'image_descriptions.*' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $process = Process::create([
            'service_id' => $request->service_id,
            'order' => $request->order,
            'title' => $request->title,
            'page' => $request->page,
            'section' => 'lí_do'
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $imageFile) {
                $imagePath = $imageFile->store('process', 'public');
                ProcessImage::create([
                    'process_id' => $process->id,
                    'image' => $imagePath,
                    'title' => $request->image_titles[$index] ?? '',
                    'description' => $request->image_descriptions[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.reason.index')->with('success', 'Tạo lý do thành công');
    }

    public function reasonShow(string $id)
    {
        $reason = Process::with('processImages', 'service')->findOrFail($id);
        return view('admin.reason.show', compact('reason'));
    }

    public function reasonEdit(string $id)
    {
        $reason = Process::with('processImages')->findOrFail($id);
        $services = Service::where('parent_id', null)->get();
        return view('admin.reason.edit', compact('reason', 'services'));
    }

    public function reasonUpdate(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'service_id' => 'required|exists:services,id',
            'order' => 'required|integer',
            'title' => 'required|string',
            'page' => 'required|string',
            'images' => 'nullable|array|min:1',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
            'image_titles' => 'nullable|array|min:1',
            'image_titles.*' => 'nullable|string',
            'image_descriptions' => 'nullable|array',
            'image_descriptions.*' => 'nullable|string'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $process = Process::findOrFail($id);

        $process->update([
            'service_id' => $request->service_id,
            'order' => $request->order,
            'title' => $request->title,
            'page' => $request->page,
            'section' => 'lí_do'
        ]);

        // Delete old images
        $process->processImages()->delete();

        // Add new images
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $imageFile) {
                $imagePath = $imageFile->store('process', 'public');
                ProcessImage::create([
                    'process_id' => $process->id,
                    'image' => $imagePath,
                    'title' => $request->image_titles[$index] ?? '',
                    'description' => $request->image_descriptions[$index] ?? null,
                ]);
            }
        }

        return redirect()->route('admin.reason.index')->with('success', 'Cập nhật lý do thành công');
    }

    public function reasonDestroy(string $id)
    {
        $process = Process::findOrFail($id);
        $process->delete();
        return redirect()->route('admin.reason.index')->with('success', 'Lý do đã được xóa');
    }
}
