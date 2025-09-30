<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DailySummary extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'title', 'summary', 'summary_date'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
