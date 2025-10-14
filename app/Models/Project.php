<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'color',
        'thumbnail',
        'created_by',
        'status',
        'start_date',
        'end_date',
        'progress',
        'meta',
    ];

    protected $casts = [
        'meta' => 'array',
    ];

    // Relations
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

   public function users()
{
    return $this->belongsToMany(User::class, 'project_users')
                ->withPivot(['role', 'is_active'])
                ->withTimestamps();
}


    public function activeUsers()
    {
        return $this->users()->wherePivot('is_active', true);
    }
}
