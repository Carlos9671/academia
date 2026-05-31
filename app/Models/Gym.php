<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gym extends Model
{
    protected $fillable = [
        'name',
        'owner_name',
        'phone',
        'token',
        'active',
    ];

    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function checkins()
    {
        return $this->hasMany(CheckIn::class);
    }

    public function getTelefoneMascaradoAttribute()
    {
        return substr($this->phone, 0, 5) . '****' . substr($this->phone, -3);
    }
}
