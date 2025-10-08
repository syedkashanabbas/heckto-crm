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
    $date = Carbon::parse($request->date, 'America/Los_Angeles');

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




//Attendance Tracking Report for each user
public function report(Request $request)
{
    $request->validate([
        'user_id' => 'required|integer|exists:users,id',
        'range' => 'required|string|in:day,week,month,custom',
        'start_date' => 'nullable|date',
        'end_date' => 'nullable|date',
    ]);

    $userId = $request->user_id;
    $range = $request->range;

    // Determine date range based on selection
    switch ($range) {
        case 'day':
            $start = now()->startOfDay();
            $end = now()->endOfDay();
            break;

        case 'week':
            $start = now()->startOfWeek();
            $end = now()->endOfWeek();
            break;

        case 'month':
            $start = now()->startOfMonth();
            $end = now()->endOfMonth();
            break;

        case 'custom':
            if (!$request->start_date || !$request->end_date) {
                return response()->json(['error' => 'Custom range requires start_date and end_date'], 422);
            }
            $start = Carbon::parse($request->start_date)->startOfDay();
            $end = Carbon::parse($request->end_date)->endOfDay();
            break;

        default:
            return response()->json(['error' => 'Invalid range type'], 400);
    }

    // Fetch all attendance records for that user within the given date range
    $records = Attendance::where('user_id', $userId)
        ->where(function ($query) use ($start, $end) {
            $query->whereBetween('clock_in_time', [$start, $end])
                  ->orWhereBetween('clock_out_time', [$start, $end]);
        })
        ->orderBy('clock_in_time', 'asc')
        ->get();

    // Prepare summary data
    $summary = [
        'user_id' => $userId,
        'range' => ucfirst($range),
        'date_range' => $start->format('M d, Y') . ' - ' . $end->format('M d, Y'),
        'total_days' => $records->count(),
        'total_work_hours' => $records->sum('total_work_minutes') > 0
            ? floor($records->sum('total_work_minutes') / 60) . 'h ' . ($records->sum('total_work_minutes') % 60) . 'm'
            : '0h 00m',
        'total_afk_minutes' => $records->sum('total_afk_minutes'),
        'records' => $records->map(function ($r) {
            return [
                'clock_in' => $r->clock_in_time ? Carbon::parse($r->clock_in_time)->format('M d, h:i A') : '-',
                'clock_out' => $r->clock_out_time ? Carbon::parse($r->clock_out_time)->format('M d, h:i A') : '-',
                'status' => $r->status ?? '-',
                'worked' => $r->total_work_minutes > 0
                    ? floor($r->total_work_minutes / 60) . 'h ' . ($r->total_work_minutes % 60) . 'm'
                    : '0h 00m',
                'afk' => $r->total_afk_minutes ?? 0,
            ];
        }),
    ];

    return response()->json($summary);
}

}