<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Get dashboard statistics
     */
    public function getStats()
    {
        return response()->json([
            'totalCases' => 1250,
            'activeUsers' => 842,
            'completedCases' => 756,
            'successRate' => 92.5,
            'averageResolutionTime' => '45 days',
            'totalSupportTickets' => 1543,
        ]);
    }

    /**
     * Get recent activities
     */
    public function getActivities()
    {
        return response()->json([
            [
                'id' => 1,
                'type' => 'case_created',
                'title' => 'New case filed',
                'description' => 'Land dispute case filed in Central Region',
                'timestamp' => now()->subHours(2),
                'icon' => 'file-text',
                'status' => 'pending'
            ],
            [
                'id' => 2,
                'type' => 'case_resolved',
                'title' => 'Case resolved',
                'description' => 'Property inheritance case successfully resolved',
                'timestamp' => now()->subHours(5),
                'icon' => 'check-circle',
                'status' => 'completed'
            ],
            [
                'id' => 3,
                'type' => 'user_registered',
                'title' => 'New user joined',
                'description' => '125 new users registered this week',
                'timestamp' => now()->subDays(1),
                'icon' => 'users',
                'status' => 'info'
            ],
            [
                'id' => 4,
                'type' => 'support_ticket',
                'title' => 'Support ticket created',
                'description' => 'Emergency legal support request received',
                'timestamp' => now()->subDays(1),
                'icon' => 'alert-circle',
                'status' => 'urgent'
            ],
            [
                'id' => 5,
                'type' => 'document_updated',
                'title' => 'Documents updated',
                'description' => 'Legal library database updated with 15 new documents',
                'timestamp' => now()->subDays(2),
                'icon' => 'database',
                'status' => 'info'
            ],
        ]);
    }

    /**
     * Get recent cases
     */
    public function getRecentCases()
    {
        return response()->json([
            [
                'id' => 'CASE-001',
                'title' => 'Land Dispute - Central Region',
                'category' => 'Property Law',
                'status' => 'pending',
                'priority' => 'high',
                'createdDate' => now()->subDays(3)->format('Y-m-d'),
                'assignedTo' => 'John Mukasa',
                'progress' => 45
            ],
            [
                'id' => 'CASE-002',
                'title' => 'Contract Breach - Commercial',
                'category' => 'Commercial Law',
                'status' => 'in_progress',
                'priority' => 'medium',
                'createdDate' => now()->subDays(5)->format('Y-m-d'),
                'assignedTo' => 'Sarah Nakambi',
                'progress' => 75
            ],
            [
                'id' => 'CASE-003',
                'title' => 'Family Law - Inheritance',
                'category' => 'Family Law',
                'status' => 'completed',
                'priority' => 'low',
                'createdDate' => now()->subDays(10)->format('Y-m-d'),
                'assignedTo' => 'Grace Okonkwo',
                'progress' => 100
            ],
            [
                'id' => 'CASE-004',
                'title' => 'Employment Dispute - Unfair Dismissal',
                'category' => 'Employment Law',
                'status' => 'in_progress',
                'priority' => 'high',
                'createdDate' => now()->subDays(7)->format('Y-m-d'),
                'assignedTo' => 'David Osei',
                'progress' => 60
            ],
            [
                'id' => 'CASE-005',
                'title' => 'Criminal Defense - Theft Charges',
                'category' => 'Criminal Law',
                'status' => 'pending',
                'priority' => 'urgent',
                'createdDate' => now()->subDays(1)->format('Y-m-d'),
                'assignedTo' => 'Peter Banda',
                'progress' => 20
            ],
        ]);
    }
}
