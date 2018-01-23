<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PlayerAward extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'player_id',
        'match_id',
    ];

    public $timestamps = false;

    public function player()
    {
        return $this->belongsTo(Player::class);
    }

    public function match()
    {
        return $this->belongsTo(Match::class);
    }
}
