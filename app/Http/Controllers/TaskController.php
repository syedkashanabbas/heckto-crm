<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $validated['order'] = $project->tasks()->max('order') + 1;

        $task = $project->tasks()->create($validated);

        return response()->json([
            'success' => true,
            'task' => $task->load('assignedUser')
        ]);
    }

    public function update(Request $request, Task $task)
    {
        $task->update($request->only(['title', 'description', 'status', 'assigned_to']));
        return response()->json(['success' => true]);
    }

    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['success' => true]);
    }

    public function reorder(Request $request)
    {
        foreach ($request->tasks as $data) {
            Task::where('id', $data['id'])
                ->update(['order' => $data['order'], 'status' => $data['status']]);
        }

        return response()->json(['success' => true]);
    }
}
