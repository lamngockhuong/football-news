<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function firstTeam()
    {
        return $this->belongsTo(Team::class, 'team1_id');
    }

    public function secondTeam()
    {
        return $this->belongsTo(Team::class, 'team2_id');
    }

    public function getLeftTimeAttribute()
    {
        return Carbon::parse($this->start_time)->format('H:i d/m/Y');
    }

    public function getEndTimeCustomAttribute()
    {
        return Carbon::parse($this->attributes['end_time'])->format('H:i d/m/Y');
    }

    public function getCountDownDateAttribute()
    {
        return Carbon::parse($this->start_time)->format('m/d/Y H:i:s');
    }
}
