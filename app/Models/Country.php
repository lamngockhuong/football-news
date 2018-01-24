<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function players()
    {
        return $this->hasMany(Player::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class);
    }
}
