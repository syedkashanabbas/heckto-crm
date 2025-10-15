<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CommonProfileController;
use App\Http\Controllers\KanbanController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\DailySummaryController;
use App\Http\Controllers\AdminAttendanceController;
use App\Http\Controllers\AttendanceTrackingController;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\UserMiniController;

Route::get('/', function () {
    return redirect('/login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {

    // Common profile
    Route::get('/common-profile', [CommonProfileController::class, 'index'])->name('common_profile.index');
    Route::post('/common-profile', [CommonProfileController::class, 'update'])->name('common_profile.update');

    // Kanban main route
    Route::get('/kanban', [KanbanController::class, 'index'])->name('kanban.index');

    // Attendance
    Route::post('/attendance/clock-in', [AttendanceController::class, 'clockIn'])->name('attendance.clockIn');
    Route::post('/attendance/afk', [AttendanceController::class, 'afk'])->name('attendance.afk');
    Route::post('/attendance/clock-out', [AttendanceController::class, 'clockOut'])->name('attendance.clockOut');
    Route::get('/attendance/status', [AttendanceController::class, 'currentStatus'])->name('attendance.status');
    Route::get('/attendance/total-hours', [AttendanceController::class, 'getTotalWorkedHours'])->name('attendance.total.hours');

    // Daily summary
    Route::get('/daily-summary', [DailySummaryController::class, 'index']);
    Route::post('/daily-summary', [DailySummaryController::class, 'storeOrUpdate']);

    // Mini user list
    Route::get('/users/mini', [UserMiniController::class, 'index']);

     // Task routes
    Route::prefix('projects/{project}/tasks')->group(function () {
        Route::post('/', [TaskController::class, 'store'])->name('tasks.store');
    });

    Route::put('/tasks/{task}', [TaskController::class, 'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
    Route::post('/tasks/reorder', [TaskController::class, 'reorder'])->name('tasks.reorder');

    // Project routes
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index'])->name('projects.index'); // List all projects
        Route::post('/', [ProjectController::class, 'store'])->name('projects.store'); // Create project
        Route::get('/{project}', [ProjectController::class, 'show'])->name('projects.show'); // View single project
        Route::put('/{project}', [ProjectController::class, 'update'])->name('projects.update'); // Update project
        Route::delete('/{project}', [ProjectController::class, 'destroy'])->name('projects.destroy'); // Delete project
        Route::get('/{project}/board', [ProjectController::class, 'board'])->name('projects.board'); // Kanban board
    });
});

// Admin-only routes
Route::middleware(['auth', 'role:Admin'])->group(function () {

    // Leaves
    Route::get('/admin/leaves', [LeaveController::class, 'all']);
    Route::post('/admin/leaves/{id}/status', [LeaveController::class, 'updateStatus']);

    // Attendance management
    Route::get('/admin/attendance', [AdminAttendanceController::class, 'index'])->name('admin.attendance');
    Route::get('/admin/attendance/data', [AdminAttendanceController::class, 'getData']);

    // Tracking and reports
    Route::get('/tracking-attendance', [AttendanceTrackingController::class, 'index'])->name('tracking.index');
    Route::post('/tracking-attendance/fetch', [AttendanceTrackingController::class, 'fetch'])->name('tracking.fetch');
    Route::get('/attendance/report/index', [AttendanceTrackingController::class, 'reportIndex'])->name('attendance.report.index');
    Route::get('/attendance/report', [AttendanceTrackingController::class, 'report'])->name('attendance.report');
});

require __DIR__ . '/auth.php';
