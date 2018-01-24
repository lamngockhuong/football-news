<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Match extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'team1_id',
        'team2_id',
        'start_time',
        'end_time',
        'team1_goal',
        'team2_goal',
        'league_id',
    ];

    public $timestamps = false;

    public function matchEvents()
    {
        return $this->hasMany(MatchEvent::class);
    }

    public function bets()
    {
        return $this->hasMany(Bet::class);
    }

    public function league()
    {
        return $this->belongsTo(League::class);
    }

    public function playerAwards()
    {
        return $this->hasMany(PlayerAward::class);
    }

    public function teamAchievements()
    {
        return $this->hasMany(TeamAchievement::class);
    }

    public function firstTeams()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function secondTeams()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }
}
