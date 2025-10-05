<?php
namespace App\Http\Controllers;

use App\Models\Attendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AttendanceController extends Controller
{
    
    // Clock In
    public function clockIn()
    {
        $user = Auth::user();

        // check if already clocked in
        $existing = Attendance::where('user_id', $user->id)
                              ->whereNull('clock_out_time')
                              ->first();

        if ($existing) {
            return response()->json(['message' => 'Already clocked in'], 400);
        }

        $attendance = Attendance::create([
            'user_id' => $user->id,
            'status' => 'LOGIN',
            'clock_in_time' => Carbon::now(),
        ]);

        return response()->json(['message' => 'Clocked in', 'attendance' => $attendance]);
    }

    // AFK
    public function afk()
    {
        $user = Auth::user();
        $attendance = Attendance::where('user_id', $user->id)
                                ->whereNull('clock_out_time')
                                ->first();

        if (!$attendance) {
            return response()->json(['message' => 'No active session'], 400);
        }

        // Toggle AFK
        if ($attendance->status === 'AFK') {
            // back to login
            $afkMinutes = Carbon::parse($attendance->afk_start_time)->diffInMinutes(Carbon::now());
            $attendance->update([
                'status' => 'LOGIN',
                'afk_end_time' => Carbon::now(),
                'total_afk_minutes' => $attendance->total_afk_minutes + $afkMinutes,
                'afk_start_time' => null,
            ]);
            return response()->json(['message' => 'Back from AFK', 'attendance' => $attendance]);
        } else {
            // going AFK
            $attendance->update([
                'status' => 'AFK',
                'afk_start_time' => Carbon::now(),
            ]);
            return response()->json(['message' => 'Went AFK', 'attendance' => $attendance]);
        }
    }

    // Clock Out
    public function clockOut()
    {
        $user = Auth::user();
        $attendance = Attendance::where('user_id', $user->id)
                                ->whereNull('clock_out_time')
                                ->first();

        if (!$attendance) {
            return response()->json(['message' => 'Not clocked in'], 400);
        }

        $workMinutes = Carbon::parse($attendance->clock_in_time)->diffInMinutes(Carbon::now());
        $attendance->update([
            'status' => 'LOGOUT',
            'clock_out_time' => Carbon::now(),
            'total_work_minutes' => $workMinutes - $attendance->total_afk_minutes,
        ]);

        return response()->json(['message' => 'Clocked out', 'attendance' => $attendance]);
    }
    //Current Status
    public function currentStatus()
{
    $user = Auth::user();

    $attendance = Attendance::where('user_id', $user->id)
                            ->latest()
                            ->first();

    if (!$attendance) {
        return response()->json(['status' => 'NONE']);
    }

    return response()->json([
        'status' => $attendance->status,
        'clock_in_time' => $attendance->clock_in_time,
        'clock_out_time' => $attendance->clock_out_time,
        'total_afk_minutes' => $attendance->total_afk_minutes,
    ]);
    }
        // Get total worked hours for current user
    public function getTotalWorkedHours()
    {
        $user = Auth::user();

        // Sum of total_work_minutes from all attendance records
        $totalMinutes = Attendance::where('user_id', $user->id)->sum('total_work_minutes');

        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;

        return response()->json([
            'total_minutes' => $totalMinutes,
            'formatted' => $hours . 'h ' . str_pad($minutes, 2, '0', STR_PAD_LEFT) . 'm'
        ]);
    }

}