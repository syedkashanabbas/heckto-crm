<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\User;
use Carbon\Carbon;

class AttendanceTrackingController extends Controller
{
    public function index()
    {
        return view('admin.attendance.tracking');
    }

   public function fetch(Request $request)
    {
        $date = Carbon::parse($request->date, 'Asia/Karachi');

        // Night shift logic (8 PM previous → 7:59 AM next)
        $start = $date->copy()->subDay()->setTime(20, 0, 0);
        $end   = $date->copy()->setTime(7, 59, 59);

        // Har user ka latest attendance record jo is range me ho
        $attendance = Attendance::with('user')
            ->whereBetween('clock_in_time', [$start, $end])
            ->get()
            ->map(function ($item) {
                return [
                    'name' => $item->user->name,
                    'clock_in' => $item->clock_in_time ? $item->clock_in_time->format('H:i:s') : '-',
                    'clock_out' => $item->clock_out_time ? $item->clock_out_time->format('H:i:s') : '-',
                    'status' => $item->status,
                    'afk_minutes' => $item->total_afk_minutes,
                    'worked_hours' => $item->total_work_minutes 
                        ? floor($item->total_work_minutes / 60) . 'h ' . ($item->total_work_minutes % 60) . 'm'
                        : '0h 00m'
                ];
            });

        return response()->json($attendance);
    }
}
