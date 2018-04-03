<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'logo',
        'country_id',
    ];

    public $timestamps = false;

    public function ranks()
    {
        return $this->hasMany(Rank::class);
    }

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function teamAchievements()
    {
        return $this->hasMany(TeamAchievement::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function matches()
    {
        return $this->hasMany(Match::class, 'team1_id');
    }

    public function otherMatches()
    {
        return $this->hasMany(Match::class, 'team2_id');
    }

    public function getSlugAttribute()
    {
        return str_slug($this->name);
    }

    public function getUrlAttribute()
    {
        return route('team.show', [
            'slug' => $this->slug,
            'id' => $this->id,
        ]);
    }

    public function getLogoUrlAttribute()
    {
        return asset(config('filesystems.disks.public.url') . '/' . $this->attributes['logo']);
    }
}
