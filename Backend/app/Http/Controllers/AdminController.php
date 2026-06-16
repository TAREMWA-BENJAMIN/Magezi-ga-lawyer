<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\HeroSlide;
use App\Models\SiteSetting;
use App\Models\Act;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Dashboard Overview
     */
    public function dashboard()
    {
        $stats = [
            'totalCases'             => 1250,
            'activeUsers'            => 842,
            'completedCases'         => 756,
            'pendingCases'           => 318,
            'successRate'            => 92.5,
            'averageResolutionDays'  => 45,
            'totalSupportTickets'    => 1543,
            'newUsersThisWeek'       => 125,
            'documentsInLibrary'     => 340,
            'emergencyCalls'         => 28,
            'monthlyGrowth'          => [
                ['month' => 'Jan', 'cases' => 85,  'resolved' => 72],
                ['month' => 'Feb', 'cases' => 92,  'resolved' => 80],
                ['month' => 'Mar', 'cases' => 110, 'resolved' => 95],
                ['month' => 'Apr', 'cases' => 98,  'resolved' => 88],
                ['month' => 'May', 'cases' => 130, 'resolved' => 115],
                ['month' => 'Jun', 'cases' => 145, 'resolved' => 128],
            ],
            'casesByCategory' => [
                ['label' => 'Property Law',    'value' => 32, 'color' => '#0f4d85'],
                ['label' => 'Family Law',      'value' => 24, 'color' => '#0c6f57'],
                ['label' => 'Criminal Law',    'value' => 18, 'color' => '#b8232f'],
                ['label' => 'Employment Law',  'value' => 14, 'color' => '#8b5cf6'],
                ['label' => 'Commercial Law',  'value' => 12, 'color' => '#f59e0b'],
            ],
        ];

        $activities = [
            ['id' => 1, 'type' => 'case_created',    'title' => 'New case filed',          'description' => 'Land dispute case filed in Central Region',              'timestamp' => now()->subHours(2)->toISOString(),  'status' => 'pending'],
            ['id' => 2, 'type' => 'case_resolved',   'title' => 'Case resolved',           'description' => 'Property inheritance case successfully resolved',         'timestamp' => now()->subHours(5)->toISOString(),  'status' => 'completed'],
            ['id' => 3, 'type' => 'user_registered', 'title' => 'New users joined',        'description' => '125 new users registered this week',                     'timestamp' => now()->subDay()->toISOString(),     'status' => 'info'],
            ['id' => 4, 'type' => 'support_ticket',  'title' => 'Emergency support',       'description' => 'Emergency legal support request received from Kampala',   'timestamp' => now()->subDay()->toISOString(),     'status' => 'urgent'],
            ['id' => 5, 'type' => 'document_updated','title' => 'Library updated',         'description' => 'Legal library updated with 15 new documents',            'timestamp' => now()->subDays(2)->toISOString(),   'status' => 'info'],
            ['id' => 6, 'type' => 'case_created',    'title' => 'Family Law case filed',   'description' => 'Domestic violence protection order requested',            'timestamp' => now()->subDays(2)->toISOString(),   'status' => 'urgent'],
        ];

        return view('admin.overview', compact('stats', 'activities'));
    }

    /**
     * Registered Users Management
     */
    public function registeredUsers()
    {
        try {
            $users = \App\Models\User::orderBy('created_at', 'desc')->get();
        } catch (\Exception $e) {
            $users = collect();
        }
        
        return view('admin.users', compact('users'));
    }

    /**
     * Cases Management
     */
    public function cases()
    {
        $cases = [
            ['id' => 'CASE-001', 'title' => 'Land Dispute - Central Region',       'category' => 'Property Law',    'status' => 'pending',     'priority' => 'high',   'createdDate' => now()->subDays(3)->format('Y-m-d'),  'assignedTo' => 'John Mukasa',    'progress' => 45,  'client' => 'Alice Nambi'],
            ['id' => 'CASE-002', 'title' => 'Contract Breach - Commercial Deal',   'category' => 'Commercial Law',  'status' => 'in_progress', 'priority' => 'medium', 'createdDate' => now()->subDays(5)->format('Y-m-d'),  'assignedTo' => 'Sarah Nakambi',  'progress' => 75,  'client' => 'Robert Ssemakula'],
            ['id' => 'CASE-003', 'title' => 'Family Law - Inheritance Dispute',    'category' => 'Family Law',      'status' => 'completed',   'priority' => 'low',    'createdDate' => now()->subDays(10)->format('Y-m-d'), 'assignedTo' => 'Grace Okonkwo',  'progress' => 100, 'client' => 'Mary Tendo'],
            ['id' => 'CASE-004', 'title' => 'Employment Dispute - Unfair Dismissal','category' => 'Employment Law', 'status' => 'in_progress', 'priority' => 'high',   'createdDate' => now()->subDays(7)->format('Y-m-d'),  'assignedTo' => 'David Osei',     'progress' => 60,  'client' => 'Peter Wamala'],
            ['id' => 'CASE-005', 'title' => 'Criminal Defense - Theft Charges',    'category' => 'Criminal Law',    'status' => 'pending',     'priority' => 'urgent', 'createdDate' => now()->subDays(1)->format('Y-m-d'),  'assignedTo' => 'Peter Banda',    'progress' => 20,  'client' => 'James Kiiza'],
            ['id' => 'CASE-006', 'title' => 'Property Lease Agreement Review',     'category' => 'Property Law',    'status' => 'completed',   'priority' => 'low',    'createdDate' => now()->subDays(14)->format('Y-m-d'), 'assignedTo' => 'John Mukasa',    'progress' => 100, 'client' => 'Susan Byamugisha'],
            ['id' => 'CASE-007', 'title' => 'Domestic Violence - Protection Order','category' => 'Family Law',      'status' => 'in_progress', 'priority' => 'urgent', 'createdDate' => now()->subDays(2)->format('Y-m-d'),  'assignedTo' => 'Grace Okonkwo',  'progress' => 55,  'client' => 'Anonymous'],
            ['id' => 'CASE-008', 'title' => 'Business Partnership Dissolution',    'category' => 'Commercial Law',  'status' => 'pending',     'priority' => 'medium', 'createdDate' => now()->subDays(4)->format('Y-m-d'),  'assignedTo' => 'Sarah Nakambi',  'progress' => 15,  'client' => 'Kato Enterprises Ltd'],
        ];
        return view('admin.cases', compact('cases'));
    }

    /**
     * Team Management
     */
    public function team()
    {
        $users = [
            ['id' => 1, 'name' => 'John Mukasa',   'role' => 'Senior Lawyer',    'email' => 'john@magezi.ug',   'cases' => 32, 'status' => 'active',   'joinDate' => '2023-02-15', 'avatar' => 'JM'],
            ['id' => 2, 'name' => 'Sarah Nakambi',  'role' => 'Advocate',         'email' => 'sarah@magezi.ug',  'cases' => 28, 'status' => 'active',   'joinDate' => '2023-05-20', 'avatar' => 'SN'],
            ['id' => 3, 'name' => 'Grace Okonkwo',  'role' => 'Legal Aid Officer','email' => 'grace@magezi.ug',  'cases' => 21, 'status' => 'active',   'joinDate' => '2023-08-10', 'avatar' => 'GO'],
            ['id' => 4, 'name' => 'David Osei',     'role' => 'Paralegal',        'email' => 'david@magezi.ug',  'cases' => 15, 'status' => 'active',   'joinDate' => '2024-01-05', 'avatar' => 'DO'],
            ['id' => 5, 'name' => 'Peter Banda',    'role' => 'Advocate',         'email' => 'peter@magezi.ug',  'cases' => 19, 'status' => 'on_leave', 'joinDate' => '2023-11-12', 'avatar' => 'PB'],
            ['id' => 6, 'name' => 'Amina Otieno',   'role' => 'Legal Aid Officer','email' => 'amina@magezi.ug',  'cases' => 12, 'status' => 'active',   'joinDate' => '2024-03-22', 'avatar' => 'AO'],
        ];
        return view('admin.team', compact('users'));
    }

    /**
     * Tickets Management
     */
    public function tickets()
    {
        $tickets = [
            ['id' => 'TKT-001', 'subject' => 'Need help filing land case',   'from' => 'Alice Nambi',     'status' => 'open',     'priority' => 'high',   'created' => now()->subHours(3)->toISOString()],
            ['id' => 'TKT-002', 'subject' => 'Emergency - domestic violence','from' => 'Anonymous',       'status' => 'urgent',   'priority' => 'urgent', 'created' => now()->subHours(1)->toISOString()],
            ['id' => 'TKT-003', 'subject' => 'Document translation needed',  'from' => 'Ssemakula R.',   'status' => 'pending',  'priority' => 'low',    'created' => now()->subDay()->toISOString()],
            ['id' => 'TKT-004', 'subject' => 'Case status inquiry',          'from' => 'Mary Tendo',     'status' => 'resolved', 'priority' => 'medium', 'created' => now()->subDays(2)->toISOString()],
        ];
        return view('admin.tickets', compact('tickets'));
    }

    /**
     * Practice Areas Management
     */
    public function practiceAreas()
    {
        // Try getting from API/DB if setup, or fallback to empty array
        try {
            $practiceAreas = \App\Models\PracticeArea::all();
        } catch (\Exception $e) {
            $practiceAreas = [];
        }
        return view('admin.practice-areas', compact('practiceAreas'));
    }

    /**
     * Site Settings Management
     */
    public function siteSettings()
    {
        $defaults = [
            'home_hero_eyebrow' => 'Law made simple',
            'home_hero_title' => 'Accessible Legal Guidance for Every Ugandan',
            'home_hero_subtitle' => 'Magezi ga Lawyer helps you find trusted legal information, build easy document templates, and connect with experienced lawyers — all in a calm, readable interface designed for clarity.',
            'home_practice_eyebrow' => 'Practice Areas',
            'home_practice_title' => 'Comprehensive Legal Expertise',
            'home_practice_text' => 'Our team covers the areas of law most important to everyday Ugandans — from property and family matters to criminal defence and business law.',
            'about_header_title' => 'About Magezi ga Lawyer',
            'about_header_text' => 'Founded in 2005, Magezi ga Lawyer is one of Uganda\'s most trusted law firms — dedicated to making justice accessible, affordable, and effective for every Ugandan.',
            'about_mission_text' => 'To provide expert, compassionate legal services that empower ordinary Ugandans to navigate the law with confidence — whether in court, in business, or in everyday life.',
            'about_vision_text' => 'A Uganda where no one is denied justice because of the complexity of the law or the cost of legal services. We envision a society where legal knowledge is a right, not a privilege.',
            'footer_tagline' => 'Bridging the gap between Ugandan citizens and the legal system since 2009. We believe that understanding your rights should never be complicated.',
            'footer_phone' => '+256 791 862 269',
            'footer_email' => 'info@magezi.ug',
            'footer_address' => 'Plot 15, Kampala Road, Kampala, Uganda',
            'footer_facebook' => 'https://facebook.com',
            'footer_twitter' => 'https://twitter.com',
            'footer_linkedin' => 'https://linkedin.com',
            'footer_bottom_text' => 'Empowering Ugandans with accessible legal knowledge.',
        ];

        try {
            $dbSettings = SiteSetting::pluck('value', 'key')->toArray();
            $siteSettings = array_merge($defaults, $dbSettings);
        } catch (\Exception $e) {
            $siteSettings = $defaults;
        }
        
        return view('admin.site-settings', compact('siteSettings'));
    }

    /**
     * Hero Slides Management
     */
    public function heroSlides()
    {
        try {
            $heroSlides = HeroSlide::orderBy('sort_order')->get()->map(function($s) {
                return [
                    'id' => $s->id,
                    'title' => $s->title,
                    'alt_text' => $s->alt_text,
                    'sort_order' => $s->sort_order,
                    'is_active' => $s->is_active,
                    'image_url' => $s->image_url,
                ];
            });
        } catch (\Exception $e) {
            $heroSlides = [];
        }
        
        return view('admin.hero-slides', compact('heroSlides'));
    }

    /**
     * Legal Acts Management
     */
    public function acts()
    {
        try {
            $acts = Act::orderBy('created_at', 'desc')->get();
        } catch (\Exception $e) {
            $acts = collect();
        }
        
        return view('admin.acts', compact('acts'));
    }

    public function storeAct(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'year' => 'nullable|string|max:4',
            'pdf_document' => 'required|file|mimes:pdf|max:20480',
        ]);

        $file = $request->file('pdf_document');
        $path = $file->store('acts', 'public');
        
        $bytes = $file->getSize();
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        $fileSize = round($bytes, 1) . ' ' . $units[$pow];

        Act::create([
            'title' => $request->title,
            'description' => $request->description,
            'year' => $request->year,
            'file_path' => $path,
            'file_size' => $fileSize,
        ]);

        return redirect()->route('admin.acts')->with('success', 'Legal Act uploaded successfully.');
    }

    public function destroyAct($id)
    {
        $act = Act::findOrFail($id);
        
        if (Storage::disk('public')->exists($act->file_path)) {
            Storage::disk('public')->delete($act->file_path);
        }
        
        $act->delete();
        
        return redirect()->route('admin.acts')->with('success', 'Legal Act deleted successfully.');
    }

    // --- Legacy API methods for mobile/React if needed ---
    
    public function stats() { return response()->json([]); }
    public function casesApi() { return response()->json([]); }
    public function users() { return response()->json([]); }
    public function activities() { return response()->json([]); }
    public function ticketsApi() { return response()->json([]); }
    public function getSiteSettings() { return response()->json(SiteSetting::pluck('value', 'key')); }
    
    public function updateSiteSettings(Request $request)
    {
        $data = $request->validate([
            'home_hero_eyebrow'      => 'required|string',
            'home_hero_title'        => 'required|string',
            'home_hero_subtitle'     => 'required|string',
            'home_practice_eyebrow'  => 'required|string',
            'home_practice_title'    => 'required|string',
            'home_practice_text'     => 'required|string',
            'about_header_title'     => 'required|string',
            'about_header_text'      => 'required|string',
            'about_mission_text'     => 'required|string',
            'about_vision_text'      => 'required|string',
            'footer_tagline'         => 'required|string',
            'footer_phone'           => 'required|string',
            'footer_email'           => 'required|string',
            'footer_address'         => 'required|string',
            'footer_facebook'        => 'nullable|string',
            'footer_twitter'         => 'nullable|string',
            'footer_linkedin'        => 'nullable|string',
            'footer_bottom_text'     => 'required|string',
        ]);

        foreach ($data as $key => $value) {
            SiteSetting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return response()->json(['success' => true]);
    }
}
