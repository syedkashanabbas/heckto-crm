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
    // Parse the requested date in New York timezone
    $date = Carbon::parse($request->date, timezone: 'America/Los_Angeles');

    // Define full-day range for that date
    $start = $date->copy()->startOfDay();
    $end   = $date->copy()->endOfDay();

    // Fetch all attendance records within that day
    $attendance = Attendance::with('user')
        ->whereBetween('clock_in_time', [$start, $end])
        ->orWhereBetween('clock_out_time', [$start, $end])
        ->get()
        ->map(function ($item) {
            return [
                'name' => $item->user->name,
                'clock_in' => $item->clock_in_time
                    ? Carbon::parse($item->clock_in_time)->timezone('America/Los_Angeles')->format('h:i A')
                    : '-',
                'clock_out' => $item->clock_out_time
                    ? Carbon::parse($item->clock_out_time)->timezone('America/Los_Angeles')->format('h:i A')
                    : '-',
                'status' => $item->status,
                'afk_minutes' => $item->total_afk_minutes,
                'worked_hours' => $item->total_work_minutes
                    ? floor($item->total_work_minutes / 60) . 'h ' . ($item->total_work_minutes % 60) . 'm'
                    : '0h 00m',
            ];
        });

    return response()->json($attendance);
}

}
