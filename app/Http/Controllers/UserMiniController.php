<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;


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
    public function toggleStatus(Request $request, User $user)
    {

        $request->validate([
            'status' => 'required|string',
        ]);

        $user->update([
            'status' => $request->status === 'Active' ? 'Active' : 'In-Active',
        ]);

        return response()->json(['success' => true]);
    }


}
