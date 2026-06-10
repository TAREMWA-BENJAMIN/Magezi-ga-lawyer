<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Legacy dashboard routes
Route::get('/dashboard/stats',         [DashboardController::class, 'getStats']);
Route::get('/dashboard/activities',    [DashboardController::class, 'getActivities']);
Route::get('/dashboard/recent-cases',  [DashboardController::class, 'getRecentCases']);

// Admin Dashboard API
Route::prefix('admin')->group(function () {
    Route::get('/stats',       [AdminController::class, 'stats']);
    Route::get('/cases',       [AdminController::class, 'cases']);
    Route::get('/users',       [AdminController::class, 'users']);
    Route::get('/activities',  [AdminController::class, 'activities']);
    Route::get('/tickets',     [AdminController::class, 'tickets']);
    Route::get('/contact-submissions', [AdminController::class, 'contactSubmissions']);
});

// Public API for React frontend
Route::prefix('public')->group(function () {
    Route::get('/team', [PublicController::class, 'team']);
    Route::get('/practice-areas', [PublicController::class, 'practiceAreas']);
    Route::get('/stats', [PublicController::class, 'stats']);
    Route::get('/faq', [PublicController::class, 'faq']);
    Route::post('/contact', [PublicController::class, 'contactSubmit']);
    Route::get('/library', [PublicController::class, 'library']);
});
