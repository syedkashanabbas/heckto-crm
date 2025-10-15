<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Project;
use Illuminate\Http\Request;

class TaskController extends Controller
{

    public function index(Project $project)
    {
        $tasks = $project->tasks()
            ->with('assignedUser')
            ->orderBy('order')
            ->get()
            ->groupBy('status');

        // Normalize keys to match frontend expectations
        $normalized = [
            'pending' => $tasks->get('pending', collect())->values(),
            'in_progress' => $tasks->get('in_progress', collect())->values(),
            'in_review' => $tasks->get('in_review', collect())->values(),
            'success' => $tasks->get('success', collect())->values(),
        ];

        return response()->json([
            'success' => true,
            'tasks' => $normalized,
        ]);
    }

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
        public function reorder(Request $request, Project $project)
        {
            $tasks = $request->input('tasks'); // array of {id, order}
            foreach ($tasks as $item) {
                $project->tasks()->where('id', $item['id'])->update(['order' => $item['order']]);
            }
            return response()->json(['success' => true]);
        }

        public function updateStatus(Request $request, Project $project, Task $task)
        {
            $validated = $request->validate(['status' => 'required|string']);
            $task->update(['status' => $validated['status']]);
            return response()->json(['success' => true, 'task' => $task]);
        }

}
