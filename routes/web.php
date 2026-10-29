<?php

use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentController;
use Illuminate\Support\Facades\Route;

// Redirect the home page.
Route::get('/', function () {
    return redirect()->route('dashboard');
});

// Dashboard page.
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Routes that require authentication.
Route::middleware('auth')->group(function () {

    // Profile routes required by Laravel Breeze.
    Route::get('/profile', [ProfileController::class, 'edit'])
        ->name('profile.edit');

    Route::patch('/profile', [ProfileController::class, 'update'])
        ->name('profile.update');

    Route::delete('/profile', [ProfileController::class, 'destroy'])
        ->name('profile.destroy');

    // Student and Department management.
    Route::resource('departments', DepartmentController::class);
    Route::resource('students', StudentController::class);
});

// Authentication routes.
require __DIR__.'/auth.php';