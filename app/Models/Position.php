<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Position extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
    ];

    public $timestamps = false;

    public function players()
    {
        return $this->hasMany(Player::class);
    }
}
