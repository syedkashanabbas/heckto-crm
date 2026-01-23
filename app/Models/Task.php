<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'project_id',
        'assigned_to',
        'title',
        'description',
        'status',
        'order',
        'created_by',
        'updated_status',
    ];

    protected $casts = [
        'updated_status' => 'array',
    ];

    protected static function booted()
    {
        static::creating(function ($task) {

            if (Auth::check()) {
                $task->created_by = Auth::id();
            }

            // initialize status history
            $task->updated_status = [
                'pending'   => Auth::id(),
                'in_review' => null,
                'review'    => null,
                'success'   => null,
            ];
        });

        static::updating(function ($task) {

            if ($task->isDirty('status') && Auth::check()) {

                $history = $task->updated_status ?? [];

                $history[$task->status] = Auth::id();

                $task->updated_status = $history;
            }
        });
    }

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function assignedUser()
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }
}
