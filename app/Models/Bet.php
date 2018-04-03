<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Bet extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'user_id',
        'match_id',
        'team1_goal',
        'team2_goal',
        'coin',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function match()
    {
        return $this->belongsTo(Match::class);
    }

    public function getBettingDateAttribute()
    {
        return Carbon::parse($this->attributes['created_at'])->format('H:i d/m/Y');
    }
}
