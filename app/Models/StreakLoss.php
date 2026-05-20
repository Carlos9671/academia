<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StreakLoss extends Model
{
    protected $fillable = [
        'member_id',
        'streak_count',
        'lost_at',
    ];

    protected $casts = [
        'lost_at'=> 'date',
    ];

    public function member()
    {
        return $this->belongsTo(Member::class);
    }
}
