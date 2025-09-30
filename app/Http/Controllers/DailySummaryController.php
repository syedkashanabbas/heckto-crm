<?php
namespace App\Http\Controllers;

use App\Models\DailySummary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DailySummaryController extends Controller
{
    public function index(Request $request)
{
    $date = $request->input('date', now()->toDateString());

    $summary = DailySummary::where('user_id', Auth::id())
                ->whereDate('summary_date', $date)
                ->first();

    return response()->json($summary);
}


    public function storeOrUpdate(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'summary' => 'required|string',
            'summary_date' => 'required|date',
        ]);

        // Check 7 days condition
        if (now()->diffInDays($request->summary_date, false) < -7) {
            return response()->json(['error' => 'You can only edit summaries from last 7 days'], 403);
        }

        $summary = DailySummary::updateOrCreate(
            [
                'user_id' => Auth::id(),
                'summary_date' => $request->summary_date,
            ],
            [
                'title' => $request->title,
                'summary' => $request->summary,
            ]
        );

        return response()->json($summary);
    }
}
