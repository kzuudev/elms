<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\HandleUserRequests;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});


Route::redirect('/', '/login');

Route::get('/emergency-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();
    return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// 3. Manager Dashboard
Route::get('manager/dashboard', function () {
    return Inertia::render('Manager/Dashboard');
})->middleware(['auth', 'verified', HandleUserRequests::class])->name('manager.dashboard');

// 4. Employee Dashboard
Route::get('employee/dashboard', function () {
    return Inertia::render('Employee/Dashboard');
})->middleware(['auth', 'verified', HandleUserRequests::class])->name('employee.dashboard');
require __DIR__.'/auth.php';
