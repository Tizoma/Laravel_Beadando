<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Place;

class Contest extends Model
{
    use HasFactory;

    protected $fillable = [
        'win',
        'history'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }

    public function characters()
    {
        return $this->belongsToMany(Character::class)->withPivot('hero_hp', 'enemy_hp')->withTimestamps();
    }
}
