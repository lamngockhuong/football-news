<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Player extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'avatar',
        'birthday',
        'team_id',
        'country_id',
        'position_id',
    ];

    public $timestamps = false;

    public function position()
    {
        return $this->belongsTo(Position::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function playerAwards()
    {
        return $this->hasMany(PlayerAward::class);
    }

    public function getSlugAttribute()
    {
        return str_slug($this->name);
    }

    public function getUrlAttribute()
    {
        return route('player.show', [
            'slug' => $this->slug,
            'id' => $this->id,
        ]);
    }

    public function getShareUrlAttribute()
    {
        return urlencode($this->url);
    }
}
