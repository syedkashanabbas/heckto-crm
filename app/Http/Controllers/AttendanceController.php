<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Attendances;

class AttendanceController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $today = Attendances::where('user_id', $user->id)
                    ->whereDate('created_at', today())
                    ->first();

        return view('attendance.index', compact('user','today'));
    }

    public function login()
    {
        $user = Auth::user();

        Attendances::create([
            'user_id' => $user->id,
            'login_time' => now(),
        ]);

        return back()->with('success','Login marked!');
    }

    public function logout()
    {
        $user = Auth::user();

        $today = Attendances::where('user_id',$user->id)
                    ->whereDate('created_at',today())
                    ->first();

        if($today && !$today->logout_time){
            $today->update([
                'logout_time' => now(),
            ]);
        }

        return back()->with('success','Logout marked!');
    }
}
