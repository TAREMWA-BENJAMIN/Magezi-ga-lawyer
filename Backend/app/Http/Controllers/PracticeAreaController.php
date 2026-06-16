<?php

namespace App\Http\Controllers;

use App\Models\PracticeArea;
use Illuminate\Http\Request;

class PracticeAreaController extends Controller
{
    public function index()
    {
        return response()->json(PracticeArea::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:practice_areas,slug',
            'short_description' => 'required|string|max:500',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'emoji_icon' => 'nullable|string|max:255',
            'features' => 'nullable|array',
        ]);

        $practiceArea = PracticeArea::create($validated);

        return response()->json($practiceArea, 201);
    }

    public function update(Request $request, $id)
    {
        $practiceArea = PracticeArea::findOrFail($id);

        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:practice_areas,slug,' . $practiceArea->id,
            'short_description' => 'required|string|max:500',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:255',
            'emoji_icon' => 'nullable|string|max:255',
            'features' => 'nullable|array',
        ]);

        $practiceArea->update($validated);

        return response()->json($practiceArea);
    }

    public function destroy($id)
    {
        $practiceArea = PracticeArea::findOrFail($id);
        $practiceArea->delete();

        return response()->json(['message' => 'Practice Area deleted successfully']);
    }
}
