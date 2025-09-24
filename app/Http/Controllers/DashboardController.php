<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        if ($user->hasRole('Admin')) {
            return view('dashboard');
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
