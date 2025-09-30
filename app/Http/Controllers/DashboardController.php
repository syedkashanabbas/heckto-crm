<?php

namespace App\Http\Controllers;


use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

      if ($user->hasRole('Employee')) {
       
        return view('employeedashboard', compact('user'));
    }


        if ($user->hasRole('Manager')) {
            return view('managerdashboard');
        }

        if ($user->hasRole(roles: 'Admin')) {
            return view('dashboard');
        }

        // fallback
        abort(403, 'Unauthorized.');
    }
}
