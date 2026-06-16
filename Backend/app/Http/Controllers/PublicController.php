<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PublicController extends Controller
{
    /**
     * Returns JSON array of lawyer profiles for public display
     */
    public function team()
    {
        return response()->json(\App\Models\TeamMember::all());
    }

    public function practiceAreas()
    {
        return response()->json(\App\Models\PracticeArea::all());
    }

    public function stats()
    {
        $statsSetting = \App\Models\SiteSetting::where('key', 'firm_stats')->first();
        $stats = $statsSetting ? json_decode($statsSetting->value, true) : [];
        return response()->json($stats);
    }

    public function faq()
    {
        return response()->json(\App\Models\Faq::all());
    }

    public function library()
    {
        return response()->json(\App\Models\LibraryItem::all());
    }

    public function milestones()
    {
        return response()->json(\App\Models\Milestone::orderBy('year', 'asc')->get());
    }

    public function coreValues()
    {
        return response()->json(\App\Models\CoreValue::all());
    }

    public function testimonials()
    {
        return response()->json(\App\Models\Testimonial::all());
    }

    public function siteSettings()
    {
        return response()->json(\App\Models\SiteSetting::all()->pluck('value', 'key'));
    }

    public function contactSubmit(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|max:255',
            'phone'   => 'nullable|string|max:20',
            'subject' => 'required|string|max:255',
            'message' => 'required|string|max:5000',
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Thank you for contacting Magezi Ga Lawyer. We have received your message and will respond within 24-48 hours.',
            'reference' => 'REF-' . strtoupper(substr(md5(now()->toISOString()), 0, 8)),
        ], 201);
    }
}
