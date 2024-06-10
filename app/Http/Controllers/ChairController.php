<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chair;

class ChairController extends Controller
{
    public function index()
    {
        $chairs = Chair::all();
        return response()->json(['chairs' => $chairs]);
    }

    public function show($id)
    {
        $chair = Chair::find($id);
        if (!$chair) {
            return response()->json(['error' => 'Chair not found'], 404);
        }
        return response()->json(['chair' => $chair]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity_available' => 'required|integer',
        ]);

        $chair = Chair::create($request->all());

        return response()->json(['chair' => $chair], 201);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'required',
            'price' => 'required|numeric',
            'quantity_available' => 'required|integer',
        ]);

        $chair = Chair::find($id);
        if (!$chair) {
            return response()->json(['error' => 'Chair not found'], 404);
        }
        $chair->update($request->all());

        return response()->json(['message' => 'Chair updated successfully']);
    }

    public function destroy($id)
    {
        $chair = Chair::find($id);
        if (!$chair) {
            return response()->json(['error' => 'Chair not found'], 404);
        }
        $chair->delete();

        return response()->json(['message' => 'Chair deleted successfully']);
    }
}
