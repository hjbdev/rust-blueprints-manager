<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Blueprint extends Model
{
    use HasFactory;

    protected $appends = ['teammates', 'user_knows'];

    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('team_id');
    }

    public function getTeammatesAttribute()
    {
        return $this->users()->whereIn('id', auth()->user()->currentTeam->allUsers()->pluck('id'))->get();
    }

    public function getUserKnowsAttribute()
    {
        return (bool) $this->users()->where('id', auth()->user()->id)->count();
    }
}
