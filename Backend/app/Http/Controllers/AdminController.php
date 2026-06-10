<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Serve the admin dashboard HTML page
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Get full dashboard overview stats
     */
    public function stats()
    {
        return response()->json([
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
        ]);
    }

    /**
     * Get paginated list of cases
     */
    public function cases(Request $request)
    {
        $allCases = [
            ['id' => 'CASE-001', 'title' => 'Land Dispute - Central Region',       'category' => 'Property Law',    'status' => 'pending',     'priority' => 'high',   'createdDate' => now()->subDays(3)->format('Y-m-d'),  'assignedTo' => 'John Mukasa',    'progress' => 45,  'client' => 'Alice Nambi'],
            ['id' => 'CASE-002', 'title' => 'Contract Breach - Commercial Deal',   'category' => 'Commercial Law',  'status' => 'in_progress', 'priority' => 'medium', 'createdDate' => now()->subDays(5)->format('Y-m-d'),  'assignedTo' => 'Sarah Nakambi',  'progress' => 75,  'client' => 'Robert Ssemakula'],
            ['id' => 'CASE-003', 'title' => 'Family Law - Inheritance Dispute',    'category' => 'Family Law',      'status' => 'completed',   'priority' => 'low',    'createdDate' => now()->subDays(10)->format('Y-m-d'), 'assignedTo' => 'Grace Okonkwo',  'progress' => 100, 'client' => 'Mary Tendo'],
            ['id' => 'CASE-004', 'title' => 'Employment Dispute - Unfair Dismissal','category' => 'Employment Law', 'status' => 'in_progress', 'priority' => 'high',   'createdDate' => now()->subDays(7)->format('Y-m-d'),  'assignedTo' => 'David Osei',     'progress' => 60,  'client' => 'Peter Wamala'],
            ['id' => 'CASE-005', 'title' => 'Criminal Defense - Theft Charges',    'category' => 'Criminal Law',    'status' => 'pending',     'priority' => 'urgent', 'createdDate' => now()->subDays(1)->format('Y-m-d'),  'assignedTo' => 'Peter Banda',    'progress' => 20,  'client' => 'James Kiiza'],
            ['id' => 'CASE-006', 'title' => 'Property Lease Agreement Review',     'category' => 'Property Law',    'status' => 'completed',   'priority' => 'low',    'createdDate' => now()->subDays(14)->format('Y-m-d'), 'assignedTo' => 'John Mukasa',    'progress' => 100, 'client' => 'Susan Byamugisha'],
            ['id' => 'CASE-007', 'title' => 'Domestic Violence - Protection Order','category' => 'Family Law',      'status' => 'in_progress', 'priority' => 'urgent', 'createdDate' => now()->subDays(2)->format('Y-m-d'),  'assignedTo' => 'Grace Okonkwo',  'progress' => 55,  'client' => 'Anonymous'],
            ['id' => 'CASE-008', 'title' => 'Business Partnership Dissolution',    'category' => 'Commercial Law',  'status' => 'pending',     'priority' => 'medium', 'createdDate' => now()->subDays(4)->format('Y-m-d'),  'assignedTo' => 'Sarah Nakambi',  'progress' => 15,  'client' => 'Kato Enterprises Ltd'],
        ];

        $status   = $request->query('status');
        $category = $request->query('category');
        $filtered = collect($allCases);

        if ($status)   $filtered = $filtered->where('status', $status);
        if ($category) $filtered = $filtered->where('category', $category);

        return response()->json([
            'data'  => $filtered->values(),
            'total' => $filtered->count(),
        ]);
    }

    /**
     * Get system users / lawyers
     */
    public function users()
    {
        return response()->json([
            ['id' => 1, 'name' => 'John Mukasa',   'role' => 'Senior Lawyer',    'email' => 'john@magezi.ug',   'cases' => 32, 'status' => 'active',   'joinDate' => '2023-02-15', 'avatar' => 'JM'],
            ['id' => 2, 'name' => 'Sarah Nakambi',  'role' => 'Advocate',         'email' => 'sarah@magezi.ug',  'cases' => 28, 'status' => 'active',   'joinDate' => '2023-05-20', 'avatar' => 'SN'],
            ['id' => 3, 'name' => 'Grace Okonkwo',  'role' => 'Legal Aid Officer','email' => 'grace@magezi.ug',  'cases' => 21, 'status' => 'active',   'joinDate' => '2023-08-10', 'avatar' => 'GO'],
            ['id' => 4, 'name' => 'David Osei',     'role' => 'Paralegal',        'email' => 'david@magezi.ug',  'cases' => 15, 'status' => 'active',   'joinDate' => '2024-01-05', 'avatar' => 'DO'],
            ['id' => 5, 'name' => 'Peter Banda',    'role' => 'Advocate',         'email' => 'peter@magezi.ug',  'cases' => 19, 'status' => 'on_leave', 'joinDate' => '2023-11-12', 'avatar' => 'PB'],
            ['id' => 6, 'name' => 'Amina Otieno',   'role' => 'Legal Aid Officer','email' => 'amina@magezi.ug',  'cases' => 12, 'status' => 'active',   'joinDate' => '2024-03-22', 'avatar' => 'AO'],
        ]);
    }

    /**
     * Get recent activities
     */
    public function activities()
    {
        return response()->json([
            ['id' => 1, 'type' => 'case_created',    'title' => 'New case filed',          'description' => 'Land dispute case filed in Central Region',              'timestamp' => now()->subHours(2)->toISOString(),  'status' => 'pending'],
            ['id' => 2, 'type' => 'case_resolved',   'title' => 'Case resolved',           'description' => 'Property inheritance case successfully resolved',         'timestamp' => now()->subHours(5)->toISOString(),  'status' => 'completed'],
            ['id' => 3, 'type' => 'user_registered', 'title' => 'New users joined',        'description' => '125 new users registered this week',                     'timestamp' => now()->subDay()->toISOString(),     'status' => 'info'],
            ['id' => 4, 'type' => 'support_ticket',  'title' => 'Emergency support',       'description' => 'Emergency legal support request received from Kampala',   'timestamp' => now()->subDay()->toISOString(),     'status' => 'urgent'],
            ['id' => 5, 'type' => 'document_updated','title' => 'Library updated',         'description' => 'Legal library updated with 15 new documents',            'timestamp' => now()->subDays(2)->toISOString(),   'status' => 'info'],
            ['id' => 6, 'type' => 'case_created',    'title' => 'Family Law case filed',   'description' => 'Domestic violence protection order requested',            'timestamp' => now()->subDays(2)->toISOString(),   'status' => 'urgent'],
        ]);
    }

    /**
     * Get support tickets
     */
    public function tickets()
    {
        return response()->json([
            ['id' => 'TKT-001', 'subject' => 'Need help filing land case',   'from' => 'Alice Nambi',     'status' => 'open',     'priority' => 'high',   'created' => now()->subHours(3)->toISOString()],
            ['id' => 'TKT-002', 'subject' => 'Emergency - domestic violence','from' => 'Anonymous',       'status' => 'urgent',   'priority' => 'urgent', 'created' => now()->subHours(1)->toISOString()],
            ['id' => 'TKT-003', 'subject' => 'Document translation needed',  'from' => 'Ssemakula R.',   'status' => 'pending',  'priority' => 'low',    'created' => now()->subDay()->toISOString()],
            ['id' => 'TKT-004', 'subject' => 'Case status inquiry',          'from' => 'Mary Tendo',     'status' => 'resolved', 'priority' => 'medium', 'created' => now()->subDays(2)->toISOString()],
        ]);
    }
}
