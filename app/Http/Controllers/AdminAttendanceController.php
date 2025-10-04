<?php

namespace App\Http\Controllers;

use App\Models\Attendance;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminAttendanceController extends Controller
{
    public function index()
    {
        return view('admin_attendance');
    }

public function getData(Request $request)
{
    // New York timezone
    $now = Carbon::now('America/Los_Angeles');

    // Define current day start and end (NYC timezone)
    $shiftStart = $now->copy()->startOfDay();
    $shiftEnd = $now->copy()->endOfDay();

    // Get attendance records for today (NYC time)
    $records = Attendance::with('user')
        ->whereBetween('clock_in_time', [$shiftStart, $shiftEnd])
        ->orWhereBetween('clock_out_time', [$shiftStart, $shiftEnd])
        ->get();

    // Format data for response
    $data = $records->map(function ($rec) {
        return [
            'user' => $rec->user->name,
            'clock_in' => $rec->clock_in_time
                ? Carbon::parse($rec->clock_in_time)->timezone('America/Los_Angeles')->format('d M Y h:i A')
                : '-',
            'clock_out' => $rec->clock_out_time
                ? Carbon::parse($rec->clock_out_time)->timezone('America/Los_Angeles')->format('d M Y h:i A')
                : '-',
            'status' => $rec->status,
            'worked' => gmdate("H:i", $rec->total_work_minutes * 60),
        ];
    });

    return response()->json($data);
}

}
