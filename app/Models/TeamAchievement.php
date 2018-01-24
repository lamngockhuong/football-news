<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamAchievement extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'team_id',
        'match_id',
    ];

    public $timestamps = false;

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function match()
    {
        return $this->belongsTo(Match::class);
    }
}
