<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

      if ($user->hasRole('Employee')) {
        $today = Attendances::where('user_id',$user->id)
                ->whereDate('created_at',today())->first();
        return view('employeedashboard', compact('user','today'));
    }


        if ($user->hasRole('Manager')) {
            return view('managerdashboard');
        }

        if ($user->hasRole('Employee')) {
            return view('employeedashboard');
        }

        // fallback
        abort(403, 'Unauthorized.');
    }
}
