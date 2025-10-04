<?php

namespace App\Http\Controllers;

use App\Models\Leave;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LeaveController extends Controller
{
    // CREATE Leave Request
    public function store(Request $request)
    {
        $request->validate([
            'from_date' => 'required|date',
            'to_date' => 'required|date|after_or_equal:from_date',
            'reason' => 'nullable|string',
        ]);

        $leave = Leave::create([
            'user_id' => Auth::id(),
            'from_date' => $request->from_date,
            'to_date' => $request->to_date,
            'reason' => $request->reason,
            'status' => 'pending',
        ]);

        return response()->json(['message' => 'Leave request submitted', 'leave' => $leave]);
    }

    // READ (User’s Leaves)
    public function index()
    {
        $leaves = Leave::with('user')->where('user_id', Auth::id())->latest()->get();
        return response()->json($leaves);
    }

    // READ (Admin view all)
    public function all()
    {
        $leaves = Leave::with('user')->latest()->get();
        return response()->json($leaves);
    }

    // UPDATE (Admin Approve/Reject)
    public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,approved,rejected',
        ]);

        $leave = Leave::findOrFail($id);
        $leave->status = $request->status;
        $leave->save();

        return response()->json(['message' => 'Leave status updated', 'leave' => $leave]);
    }

    // DELETE (Cancel leave)
    public function destroy($id)
    {
        $leave = Leave::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
        $leave->delete();

        return response()->json(['message' => 'Leave request deleted']);
    }
}
