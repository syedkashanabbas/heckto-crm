<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;

class UserMiniController extends Controller
{
    public function index()
    {
        $users = User::select('id', 'name','employee_code' ,'email','profile_image')->orderBy('name')->get();
        return response()->json([
            'success' => true,
            'data' => $users,
        ]);
    }
}
