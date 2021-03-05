<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blueprint extends Model
{
    use HasFactory;

    protected $appends = ['teammates'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('team_id');
    }

    public function getTeammatesAttribute()
    {
        return $this->users()->whereIn('id', auth()->user()->currentTeam->allUsers()->pluck('id'))->get();
    }
}
