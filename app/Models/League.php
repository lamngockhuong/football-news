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
}
