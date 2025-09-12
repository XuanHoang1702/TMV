<?php

namespace App\Http\Controllers\Admin;

use App\Models\Information;
use Illuminate\Http\Request;

class InformationController extends Controller
{
    public function index()
    {
        $informations = Information::all();
        return response()->json($informations);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'address' => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'working_time'    => 'nullable|json',
        ]);

        $information = Information::create($request->all());

        return response()->json($information, 201);
    }

    public function show($id)
    {
        $information = Information::findOrFail($id);
        return response()->json($information);
    }

    public function update(Request $request, $id)
    {
        $information = Information::findOrFail($id);

        $request->validate([
            'name'    => 'sometimes|string|max:255',
            'address' => 'sometimes|string|max:255',
            'email'   => 'sometimes|email|max:255',
            'working_time'    => 'nullable|json',
        ]);

        $information->update($request->all());

        return response()->json($information);
    }

    public function destroy($id)
    {
        $information = Information::findOrFail($id);
        $information->delete();

        return response()->json(['message' => 'Deleted successfully']);
    }
}
