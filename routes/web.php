<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommonProfileController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
   
  Route::get('/common-profile', [CommonProfileController::class, 'index'])->name('common_profile.index');
    Route::post('/common-profile', [CommonProfileController::class, 'update'])->name('common_profile.update');

    // Route::get('/profiledashboard', function () {
    //     return view('');
    // })->name('profiledashboard');
});

require __DIR__.'/auth.php';
