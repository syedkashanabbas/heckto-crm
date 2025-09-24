<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendances extends Model
{
    protected $fillable = [
        'user_id',
        'login_time',
        'logout_time',
    ];

    protected $table = 'attendances';

    // Cast to datetime so you can use ->format()
    protected $casts = [
        'login_time' => 'datetime',
        'logout_time' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
