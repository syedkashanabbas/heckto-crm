<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommonProfileController;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\AttendanceController;

Route::get('/', function () {
    return redirect()->route('login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

    Route::middleware('auth')->group(function () {
   
    Route::get('/common-profile', [CommonProfileController::class, 'index'])->name('common_profile.index');
    Route::post('/common-profile', [CommonProfileController::class, 'update'])->name('common_profile.update');
    Route::get('/kanban', [KanbanController::class, 'index'])->name('kabnan.index');
    Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])->name('attendance.clockIn');
    Route::post('/attendance/afk', [AttendanceController::class, 'afk'])->name('attendance.afk');
    Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clockOut');
    Route::get('/attendance/status', [AttendanceController::class, 'currentStatus'])->name('attendance.status');
    Route::get('/attendance/total-hours', [\App\Http\Controllers\AttendanceController::class, 'getTotalWorkedHours'])->name('attendance.total.hours');



    });

require __DIR__.'/auth.php';
