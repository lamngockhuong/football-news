<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class League extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'year',
    ];

    public $timestamps = false;

    public function matchs()
    {
        return $this->hasMany(Match::class);
    }

    public function ranks()
    {
        return $this->hasMany(Rank::class);
    }

    public function getSlugAttribute()
    {
        return str_slug($this->name);
    }

    public function getUpcomingUrlAttribute()
    {
        return route('match.upcoming_league', [
            'slug' => $this->slug,
            'id' => $this->id,
        ]);
    }

    public function getResultUrlAttribute()
    {
        return route('match.result', [
            'slug' => $this->slug,
            'id' => $this->id,
        ]);
    }

    public function getRankUrlAttribute()
    {
        return route('rank.show', [
            'slug' => $this->slug,
            'id' => $this->id,
        ]);
    }
}
