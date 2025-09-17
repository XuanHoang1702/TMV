<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Process;
use Illuminate\Support\Facades\Validator;

class ProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $process = Process::all();
        return view('admin.process.index', compact('process'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $process = Process::all();
        return view('admin.process.create', compact('process'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'order' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string',
            'content' => 'required|string',
            'page' => 'required|string',
            'section' => 'required|integer|in:1,2'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('process', 'public');
        }

        $validated = $validator->validated();

        Process::create([
            'order' => $request->order,
            'image' => $imagePath,
            'title' => $request->title,
            'content' => $request->content,
            'page' => $request->page,
            'section' => $request->section
        ]);

        return redirect()->route('admin.process.index')->with('success', 'Tạo quy trình thành công');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $process = Process::findOrFail($id);
        return view('admin.process.show', compact('process'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $process = Process::findOrFail($id);
        return view('admin.process.edit', compact('process'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $validator = Validator::make($request->all(),[
            'order' => 'required|integer',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'title' => 'required|string',
            'content' => 'required|string',
            'page' => 'required|string',
            'section' => 'required|integer|in:1,2'
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $imagePath = null;
        if($request->hasFile('image')){
            $imagePath = $request->file('image')->store('process', 'public');
        }

        $validated = $validator->validated();

        $process = Process::findOrFail($id);

        $process->update([
            'order' => $request->order,
            'image' => $imagePath ?? $process->image,
            'title' => $request->title,
            'content' => $request->content,
            'page' => $request->page,
            'section' => $request->section
        ]);

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
}
