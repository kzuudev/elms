<?php

use App\Http\Controllers\ProfileController;
use App\Http\Middleware\HandleUserRequests;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {

    /** @var \App\Models\User $user */
    $user = Auth::user();

    if(!Auth::check()) {
        return redirect('/login');
    }

    if($user->role === 'manager') {
        return redirect()->route('manager.dashboard');
    }

    return redirect()->route('employee.dashboard');

});

Route::get('/emergency-logout', function () {
    Auth::logout();
    request()->session()->invalidate();
    request()->session()->regenerateToken();return redirect('/login');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['auth', 'verified', HandleUserRequests::class])->group(function () {
    Route::get('manager/dashboard', function () {
        return Inertia::render('Manager/Dashboard');
    })->name('manager.dashboard');
});

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('employee/dashboard', function () {
        return Inertia::render('Employee/Dashboard');
    })->name('employee.dashboard');
});



require __DIR__.'/auth.php';
