<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root redirects to admin dashboard overview
Route::get('/', function () {
    return redirect('/admin');
});

// Admin dashboard routes (separated views)
Route::prefix('admin')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/cases', [AdminController::class, 'cases'])->name('admin.cases');
    Route::get('/users', [AdminController::class, 'registeredUsers'])->name('admin.users');
    Route::get('/team', [AdminController::class, 'team'])->name('admin.team');
    Route::get('/tickets', [AdminController::class, 'tickets'])->name('admin.tickets');
    Route::get('/practice-areas', [AdminController::class, 'practiceAreas'])->name('admin.practiceAreas');
    Route::get('/site-settings', [AdminController::class, 'siteSettings'])->name('admin.siteSettings');
    Route::get('/hero-slides', [AdminController::class, 'heroSlides'])->name('admin.heroSlides');
    Route::get('/acts', [AdminController::class, 'acts'])->name('admin.acts');
    Route::post('/acts', [AdminController::class, 'storeAct'])->name('admin.acts.store');
    Route::delete('/acts/{id}', [AdminController::class, 'destroyAct'])->name('admin.acts.destroy');
});
