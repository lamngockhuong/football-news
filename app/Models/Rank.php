<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'won',
        'drawn',
        'lost',
        'goals_for',
        'goals_against',
        'score',
        'team_id',
        'league_id',
    ];

    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
