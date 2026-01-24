<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use App\Models\User;


class ProjectController extends Controller
{
    /**
     * Display list of projects.
     */
        public function index()
        {
            $user = auth()->user();

            // If Admin — show all projects
            if ($user->hasRole('Admin')) {
                $projects = Project::with('users')->get();
            } 
            // Otherwise — only the ones assigned to this user
            else {
                $projects = Project::whereHas('users', function ($q) use ($user) {
                    $q->where('users.id', $user->id);
                })
                ->with('users')
                ->get();
            }

            return view('admin.projects.index', compact('projects'));
        }

    /**
     * Store new project and assign users.
     */
    public function store(Request $request)
    {
        
        try {
            $validated = $request->validate([
                'name'        => 'required|string|max:255',
                'description' => 'nullable|string',
                'color'       => 'nullable|string|max:20',
                'status'      => 'nullable|string|in:draft,active,on_hold,completed,archived',
                'start_date'  => 'nullable|date',
                'end_date'    => 'nullable|date|after_or_equal:start_date',
                'progress'    => 'nullable|numeric|min:0|max:100',
                'users'       => 'nullable|array',
                'thumbnail'   => 'nullable|image|max:2048',
            ]);

            DB::beginTransaction();

            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            }
        $user = auth()->user();


            $project = Project::create([
                'name'        => $validated['name'],
                'slug'        => Str::slug($validated['name']),
                'description' => $validated['description'] ?? null,
                'color'       => $validated['color'] ?? '#000000',
                'thumbnail'   => $thumbnailPath,
                'created_by' => $user ? $user->id : null,
                'status'      => $validated['status'] ?? 'draft',
                'start_date'  => $validated['start_date'] ?? null,
                'end_date'    => $validated['end_date'] ?? null,
                'progress'    => $validated['progress'] ?? 0,
                'meta'        => [],
            ]);

            if (!empty($validated['users'])) {
                foreach ($validated['users'] as $userId) {
                    ProjectUser::create([
                        'project_id'  => $project->id,
                        'user_id'     => $userId,
                        'role'        => 'member',
                        'is_active'   => true,
                        'permissions' => [],
                        'assigned_at' => now(),
                    ]);
                }
            }

            DB::commit();

            return response()->json([
                'success' => true,
                'message' => 'Project created successfully!',
                'data'    => $project,
            ]);

        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'Validation failed',
                'errors'  => $e->errors(),
            ], 422);

        } catch (\Throwable $e) {
            DB::rollBack();
            Log::error('Project creation failed', [
                    'message' => $e->getMessage(),
                    'file'    => $e->getFile(),
                    'line'    => $e->getLine(),
                    'trace'   => $e->getTraceAsString(),
                    'user_id' => auth()->id(),
                    'payload' => $request->except(['thumbnail']),
                ]);
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating the project.',
            ], 500);
        }
    }


    /**
     * View single project.
     */
    public function show(Project $project)
    {
        $project->load('users', 'creator');
        return response()->json($project);
    }

    /**
     * Update project.
     */
    public function update(Request $request, Project $project)
    {
        // Placeholder for now
    }

    /**
     * Delete project.
     */
   public function destroy($id)
    {
        try {
            $project = Project::findOrFail($id);

            // Delete associated project_users
            $project->users()->detach();

            // Delete thumbnail if exists
            if ($project->thumbnail && Storage::disk('public')->exists($project->thumbnail)) {
                Storage::disk('public')->delete($project->thumbnail);
            }

            // Permanently delete the project
            $project->delete();

            return response()->json([
                'success' => true,
                'message' => 'Project deleted successfully.'
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Failed to delete project.',
                'error' => $e->getMessage()
            ], 500);
        }
    }



public function board(Project $project)
{
    // Load all tasks for this project, grouped by status
    $tasks = $project->tasks()
        ->orderBy('order')
        ->get()
        ->groupBy('status');

    // Load active users already assigned to this project
    $activeUsers = $project->activeUsers()->get();

    // Load all users that can be assigned (for modal select)
    $allUsers = User::select('id', 'name')->get();

    return view(
        'admin.projects.board',
        compact('project', 'tasks', 'activeUsers', 'allUsers')
    );
}

public function assignUsers(Request $request, Project $project)
{
    $validated = $request->validate([
        'users' => 'required|array',
        'users.*' => 'exists:users,id',
    ]);

    foreach ($validated['users'] as $userId) {
        ProjectUser::updateOrCreate(
            [
                'project_id' => $project->id,
                'user_id' => $userId,
            ],
            [
                'role' => 'member',
                'is_active' => true,
                'assigned_at' => now(),
            ]
        );
    }

    return redirect()->back()->with('success', 'Users assigned successfully');
}




}
