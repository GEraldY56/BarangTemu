<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Guest Routes (Public)
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/catalog', [HomeController::class, 'catalog'])->name('catalog');

// Test route sederhana untuk debugging
Route::get('/test', function() {
    return 'Laravel Server is Working! ✅';
});

// Test controller directly
Route::get('/test-controller', function() {
    $controller = new \App\Http\Controllers\ReportController();
    return 'Controller exists! Trying to call create method...';
});

// Test view directly
Route::get('/test-view', function() {
    return view('reports.create');
});

// Report Create Route - MUST BE BEFORE {id} route
Route::get('/reports/create', [ReportController::class, 'create'])->name('reports.create');

// Report Detail Route
Route::get('/reports/{id}', [HomeController::class, 'show'])->name('reports.show')->where('id', '[0-9]+');

// Authentication Routes
Route::middleware('guest')->group(function () {
    Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
    Route::post('/login', [LoginController::class, 'login']);
    Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
    Route::post('/register', [RegisterController::class, 'register']);
});

Route::post('/logout', [LoginController::class, 'logout'])->name('logout')->middleware('auth');

// Authenticated User Routes
Route::middleware('auth')->group(function () {
    // Report Management (Create, Edit, Delete own reports)
    // Route create sudah dipindah ke atas untuk debug
    Route::post('/reports', [ReportController::class, 'store'])->name('reports.store');
    Route::get('/reports/{id}/edit', [ReportController::class, 'edit'])->name('reports.edit');
    Route::put('/reports/{id}', [ReportController::class, 'update'])->name('reports.update');
    Route::delete('/reports/{id}', [ReportController::class, 'destroy'])->name('reports.destroy');
});

// Admin Routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::post('/reports/{id}/status', [AdminController::class, 'updateStatus'])->name('reports.updateStatus');
    Route::delete('/reports/{id}', [AdminController::class, 'destroy'])->name('reports.destroy');
    Route::get('/export', [AdminController::class, 'export'])->name('export');
});