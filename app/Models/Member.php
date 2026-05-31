<?php

namespace App\Models;


use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    protected $fillable = [
        'gym_id',
        'name',
        'phone',
        'password',
        'training_days',
        'streak_current',
        'streak_longest',
        'last_checkin_at',
        'active',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'last_checkin_at' => 'datetime',
    ];

    public function gym()
    {
        return $this->belongsTo(Gym::class);
    }

    public function checkIns()
    {
        return $this->hasMany(CheckIn::class);
    }

    public function streakLosses()
    {
        return $this->hasMany(StreakLoss::class);
    }

    public function notifications()
    {
        return $this->hasMany(NotificationLog::class);
    }

    public function getTelefoneMascaradoAttribute()
    {
        return substr($this->phone, 0, 5) . '****' . substr($this->phone, -3);
    }
}