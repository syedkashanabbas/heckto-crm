<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectUser;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class ProjectController extends Controller
{
    /**
     * Display list of projects.
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Store new project and assign users.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'description' => 'nullable|string',
            'color'       => 'nullable|string|max:20',
            'status'      => 'nullable|string|max:50',
            'start_date'  => 'nullable|date',
            'end_date'    => 'nullable|date|after_or_equal:start_date',
            'progress'    => 'nullable|numeric|min:0|max:100',
            'users'       => 'nullable|array',
            'thumbnail'   => 'nullable|image|max:2048',
        ]);

        DB::beginTransaction();
        try {
            // Handle thumbnail upload
            $thumbnailPath = null;
            if ($request->hasFile('thumbnail')) {
                $thumbnailPath = $request->file('thumbnail')->store('thumbnails', 'public');
            }

            // Create project
            $project = Project::create([
                'name'        => $validated['name'],
                'slug'        => Str::slug($validated['name']),
                'description' => $validated['description'] ?? null,
                'color'       => $validated['color'] ?? '#000000',
                'thumbnail'   => $thumbnailPath,
                'created_by'  => auth()->id() ?? 1, // fallback for now
                'status'      => $validated['status'] ?? 'Planned',
                'start_date'  => $validated['start_date'] ?? null,
                'end_date'    => $validated['end_date'] ?? null,
                'progress'    => $validated['progress'] ?? 0,
                'meta'        => [],
            ]);

            // Attach users if provided
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
                'project' => $project,
            ]);

        } catch (\Throwable $e) {
            DB::rollBack();
            return response()->json([
                'success' => false,
                'message' => 'Something went wrong while creating the project.',
                'error'   => $e->getMessage(),
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
    public function destroy(Project $project)
    {
        $project->delete();
        return response()->json(['message' => 'Project deleted']);
    }
}
