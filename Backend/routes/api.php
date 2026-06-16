<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\HeroSlideController;
use App\Http\Controllers\PracticeAreaController;
use App\Http\Controllers\ActController;

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
    Route::get('/users',       [AdminController::class, 'users']);
    Route::get('/activities',  [AdminController::class, 'activities']);
    Route::get('/tickets',     [AdminController::class, 'tickets']);
    Route::get('/contact-submissions', [AdminController::class, 'contactSubmissions']);

    // Hero Slides admin CRUD
    Route::get('/hero-slides',           [HeroSlideController::class, 'adminIndex']);
    Route::post('/hero-slides',          [HeroSlideController::class, 'store']);
    Route::post('/hero-slides/{id}',     [HeroSlideController::class, 'update']);   // POST used for multipart/form-data
    Route::delete('/hero-slides/{id}',   [HeroSlideController::class, 'destroy']);
    Route::patch('/hero-slides/reorder', [HeroSlideController::class, 'reorder']);

    // Practice Areas admin CRUD
    Route::get('/practice-areas',        [PracticeAreaController::class, 'index']);
    Route::post('/practice-areas',       [PracticeAreaController::class, 'store']);
    Route::post('/practice-areas/{id}',  [PracticeAreaController::class, 'update']);
    Route::delete('/practice-areas/{id}',[PracticeAreaController::class, 'destroy']);

    // Site Settings Admin
    Route::get('/site-settings',         [AdminController::class, 'getSiteSettings']);
    Route::post('/site-settings',        [AdminController::class, 'updateSiteSettings']);
    
    // Acts
    Route::post('/acts',                 [ActController::class, 'store']);
    Route::delete('/acts/{id}',          [ActController::class, 'destroy']);
});

// Public API for React frontend
Route::prefix('public')->group(function () {
    Route::get('/team',            [PublicController::class, 'team']);
    Route::get('/practice-areas',  [PublicController::class, 'practiceAreas']);
    Route::get('/stats',           [PublicController::class, 'stats']);
    Route::get('/faq',             [PublicController::class, 'faq']);
    Route::post('/contact',        [PublicController::class, 'contactSubmit']);
    Route::post('/register',       [PublicController::class, 'register']);
    Route::get('/library',         [PublicController::class, 'library']);
    Route::get('/milestones',      [PublicController::class, 'milestones']);
    Route::get('/core-values',     [PublicController::class, 'coreValues']);
    Route::get('/testimonials',    [PublicController::class, 'testimonials']);
    Route::get('/site-settings',   [PublicController::class, 'siteSettings']);

    // Hero Slides — public read
    Route::get('/hero-slides',     [HeroSlideController::class, 'index']);
    
    // Acts - public read
    Route::get('/acts',            [ActController::class, 'index']);
});

