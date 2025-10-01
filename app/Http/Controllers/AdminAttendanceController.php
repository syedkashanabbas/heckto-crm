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
        // Karachi timezone
        $now = Carbon::now('Asia/Karachi');

        // Night shift logic (start yesterday 20:00, end today 05:00)
        $shiftStart = $now->copy()->subDay()->setTime(20, 0, 0);
        $shiftEnd = $now->copy()->setTime(5, 0, 0);

        // agar abhi subha 5 bajay se pehle hai toh still previous shift
        if ($now->hour < 5) {
            $shiftStart = $now->copy()->subDay()->setTime(20, 0, 0);
            $shiftEnd = $now->copy()->setTime(5, 0, 0);
        } else {
            $shiftStart = $now->copy()->setTime(20, 0, 0);
            $shiftEnd = $now->copy()->addDay()->setTime(5, 0, 0);
        }

        // Get attendance records within that shift
        $records = Attendance::with('user')
            ->whereBetween('clock_in_time', [$shiftStart, $shiftEnd])
            ->orWhereBetween('clock_out_time', [$shiftStart, $shiftEnd])
            ->get();

        $data = $records->map(function ($rec) {
            return [
                'user' => $rec->user->name,
                'clock_in' => $rec->clock_in_time ? Carbon::parse($rec->clock_in_time)->timezone('Asia/Karachi')->format('d M Y h:i A') : '-',
                'clock_out' => $rec->clock_out_time ? Carbon::parse($rec->clock_out_time)->timezone('Asia/Karachi')->format('d M Y h:i A') : '-',
                'status' => $rec->status,
                'worked' => gmdate("H:i", $rec->total_work_minutes * 60),
            ];
        });

        return response()->json($data);
    }
}
