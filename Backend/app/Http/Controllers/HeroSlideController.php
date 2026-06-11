<?php

namespace App\Http\Controllers;

use App\Models\HeroSlide;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;

class HeroSlideController extends Controller
{
    // ─── Public ──────────────────────────────────────────────────────────────

    /**
     * GET /api/public/hero-slides
     * Returns all active slides ordered by sort_order.
     */
    public function index(): JsonResponse
    {
        $slides = HeroSlide::active()->get()->map(fn($s) => [
            'id'         => $s->id,
            'alt'        => $s->alt_text,
            'title'      => $s->title,
            'image_url'  => $s->image_url,
            'sort_order' => $s->sort_order,
        ]);

        return response()->json(['data' => $slides]);
    }

    // ─── Admin CRUD ───────────────────────────────────────────────────────────

    /**
     * GET /api/admin/hero-slides
     */
    public function adminIndex(): JsonResponse
    {
        $slides = HeroSlide::orderBy('sort_order')->get();
        return response()->json(['data' => $slides]);
    }

    /**
     * POST /api/admin/hero-slides
     * Upload a new slide image.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'image'      => 'required|image|mimes:jpeg,jpg,png,webp|max:5120',
            'alt_text'   => 'required|string|max:255',
            'title'      => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        $path = $request->file('image')->store('hero-slides', 'public');

        $slide = HeroSlide::create([
            'alt_text'   => $request->alt_text,
            'title'      => $request->title,
            'image_path' => $path,
            'sort_order' => $request->sort_order ?? HeroSlide::max('sort_order') + 1,
            'is_active'  => $request->boolean('is_active', true),
        ]);

        return response()->json(['data' => $slide, 'message' => 'Slide created.'], 201);
    }

    /**
     * PUT /api/admin/hero-slides/{id}
     * Update metadata (alt, title, order, active). Optionally replace image.
     */
    public function update(Request $request, int $id): JsonResponse
    {
        $slide = HeroSlide::findOrFail($id);

        $request->validate([
            'image'      => 'nullable|image|mimes:jpeg,jpg,png,webp|max:5120',
            'alt_text'   => 'nullable|string|max:255',
            'title'      => 'nullable|string|max:255',
            'sort_order' => 'nullable|integer',
            'is_active'  => 'nullable|boolean',
        ]);

        if ($request->hasFile('image')) {
            // Remove old file
            Storage::disk('public')->delete($slide->image_path);
            $slide->image_path = $request->file('image')->store('hero-slides', 'public');
            $slide->image_url  = null; // reset so accessor recalculates
        }

        $slide->fill($request->only(['alt_text', 'title', 'sort_order']));

        if ($request->has('is_active')) {
            $slide->is_active = $request->boolean('is_active');
        }

        $slide->save();

        return response()->json(['data' => $slide, 'message' => 'Slide updated.']);
    }

    /**
     * DELETE /api/admin/hero-slides/{id}
     */
    public function destroy(int $id): JsonResponse
    {
        $slide = HeroSlide::findOrFail($id);
        Storage::disk('public')->delete($slide->image_path);
        $slide->delete();

        return response()->json(['message' => 'Slide deleted.']);
    }

    /**
     * PATCH /api/admin/hero-slides/reorder
     * Body: { "order": [3,1,2] }  — array of IDs in desired order.
     */
    public function reorder(Request $request): JsonResponse
    {
        $request->validate(['order' => 'required|array', 'order.*' => 'integer']);

        foreach ($request->order as $position => $id) {
            HeroSlide::where('id', $id)->update(['sort_order' => $position]);
        }

        return response()->json(['message' => 'Order saved.']);
    }
}
