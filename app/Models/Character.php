<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;
use App\Models\Contest;

class Character extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'enemy',
        'defence',
        'strength',
        'accuracy',
        'magic'
    ];

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function contests()
    {
        return $this->belongsToMany(Contest::class)->withPivot('hero_hp', 'enemy_hp')->withTimestamps();
    }

}
