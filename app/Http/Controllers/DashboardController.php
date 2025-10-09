<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Attendance;
use Carbon\Carbon;

class DashboardController extends Controller
{

    
   public function index()
{
    $user = Auth::user();

    if ($user->hasRole('Employee')) {
        return view('employeedashboard', compact('user'));
    }

    if ($user->hasRole('Manager')) {
        return view('employeedashboard');
    }

if ($user->hasRole('Admin')) {
    $users = User::role(['Employee', 'Manager'])
        ->select('id', 'name', 'email', 'designation', 'department', 'employee_code', 'status', 'profile_image', 'created_at')
        ->orderBy('name')
        ->get()
        ->map(function ($u) {
            $today = Carbon::today();

            // Fetch the latest attendance for today
            $attendance = Attendance::where('user_id', $u->id)
                ->whereDate('created_at', $today)
                ->latest()
                ->first();

            if (!$attendance) {
                $u->live_status = 'Not Clocked In';
            } else {
                if ($attendance->clock_out_time) {
                    $u->live_status = 'Clocked Out';
                } elseif ($attendance->afk_status === 1) {
                    $u->live_status = 'AFK';
                } else {
                    $u->live_status = 'Clocked In';
                }
            }

            return $u;
        });

    return view('dashboard', compact('user', 'users'));
}

    abort(403, 'Unauthorized.');
}

}
