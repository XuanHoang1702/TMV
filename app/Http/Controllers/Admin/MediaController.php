<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MediaController extends Controller
{
    public function index(Request $request)
    {
        $files = collect(Storage::disk('public')->allFiles())
            ->filter(function ($file) {
                return !Str::startsWith($file, ['temp/', 'cache/']);
            })
            ->map(function ($file) {
                return [
                    'path' => $file,
                    'name' => basename($file),
                    'size' => Storage::disk('public')->size($file),
                    'last_modified' => Storage::disk('public')->lastModified($file),
                    'url' => Storage::disk('public')->url($file)
                ];
            })
            ->sortByDesc('last_modified')
            ->paginate(20);

        return view('admin.media.index', compact('files'));
    }

    public function upload(Request $request)
    {
        $request->validate([
            'files' => 'required|array',
            'files.*' => 'file|max:5120|mimes:jpeg,png,jpg,gif,svg,webp'
        ]);

        $uploadedFiles = [];

        foreach ($request->file('files') as $file) {
            $path = $file->store('uploads/' . now()->format('Y/m'), 'public');
            $uploadedFiles[] = [
                'path' => $path,
                'url' => Storage::disk('public')->url($path),
                'name' => $file->getClientOriginalName()
            ];
        }

        return response()->json([
            'success' => true,
            'files' => $uploadedFiles
        ]);
    }

    public function delete(Request $request)
    {
        $request->validate([
            'path' => 'required|string'
        ]);

        if (Storage::disk('public')->exists($request->path)) {
            Storage::disk('public')->delete($request->path);
            return response()->json(['success' => true]);
        }

        return response()->json(['success' => false, 'message' => 'File not found']);
    }
}
