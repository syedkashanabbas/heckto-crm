<?php 

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
// use OwenIt\Auditing\Contracts\Auditable;

// implements Auditable

class Attendance extends Model 
{
    use HasFactory ;
    // , \OwenIt\Auditing\Auditable;

    protected $casts = [
    'clock_in_time' => 'datetime',
    'clock_out_time' => 'datetime',
    'afk_start_time' => 'datetime',
    'afk_end_time' => 'datetime',
];

    protected $fillable = [
        'user_id',
        'status',
        'clock_in_time',
        'clock_out_time',
        'afk_start_time',
        'afk_end_time',
        'total_afk_minutes',
        'total_work_minutes',
        'remarks',
    ];

    // Relation with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
