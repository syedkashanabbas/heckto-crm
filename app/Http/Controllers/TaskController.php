<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Create a new task
    public function store(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|string|in:in_progress,in_review,pending,success',
            'assigned_to' => 'nullable|exists:users,id',
        ]);

        $validated['project_id'] = $project->id;

        $task = Task::create($validated);

        return response()->json(['success' => true, 'task' => $task]);
    }

    // Update task status or order (drag-and-drop)
    public function update(Request $request, Task $task)
    {
        $task->update($request->only(['status', 'order']));
        return response()->json(['success' => true]);
    }

    // Delete a task
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(['success' => true]);
    }
}

