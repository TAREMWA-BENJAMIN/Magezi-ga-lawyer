<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Root redirects to admin dashboard
Route::get('/', function () {
    return redirect('/admin');
});

// Admin dashboard — served by Laravel as a standalone Blade page
Route::get('/admin', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::get('/admin/{any}', [AdminController::class, 'dashboard'])->where('any', '.*')->name('admin.catch');
