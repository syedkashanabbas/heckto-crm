<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectUser extends Model
{
    use HasFactory;

    protected $table = 'project_users';

    protected $fillable = [
        'project_id',
        'user_id',
        'role',
        'is_active',
        'permissions',
        'assigned_at',
        'removed_at',
    ];

    protected $casts = [
        'permissions' => 'array',
        'assigned_at' => 'datetime',
        'removed_at'  => 'datetime',
    ];

    // Relations
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
