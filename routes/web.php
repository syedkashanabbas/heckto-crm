<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommonProfileController;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DailySummaryController;
use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\AttendanceTrackingController;
use App\Http\Controllers\LeaveController;


Route::get('/', function () {
    return redirect('/login');
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
    Route::get('/attendance/total-hours', [AttendanceController::class, 'getTotalWorkedHours'])->name('attendance.total.hours');
    Route::get('/daily-summary', [DailySummaryController::class, 'index']);
    Route::post('/daily-summary', [DailySummaryController::class, 'storeOrUpdate']);
     Route::get('/admin/attendance', [AdminAttendanceController::class, 'index'])->name('admin.attendance');
    Route::get('/admin/attendance/data', action: [AdminAttendanceController::class, 'getData']);
    Route::get('/tracking-attendance', [AttendanceTrackingController::class, 'index'])->name('tracking.index');
    Route::post('/tracking-attendance/fetch', [AttendanceTrackingController::class, 'fetch'])->name('tracking.fetch');
    Route::get('/leaves', [LeaveController::class, 'index']); // user leaves
    Route::post('/leaves', [LeaveController::class, 'store']); // create
    Route::delete('/leaves/{id}', [LeaveController::class, 'destroy']); // delete

    // Admin-only
    Route::get('/admin/leaves', [LeaveController::class, 'all']); // view all
    Route::post('/admin/leaves/{id}/status', [LeaveController::class, 'updateStatus']);

    });

  

require __DIR__.'/auth.php';
