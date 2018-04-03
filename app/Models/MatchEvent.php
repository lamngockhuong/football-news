<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MatchEvent extends Model
{
    use SoftDeletes;
    
    /**
     * @var array
     */
    protected $fillable = [
        'title',
        'description',
        'content',
        'image',
        'view_count',
        'is_actived',
        'match_id',
        'user_id',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function match()
    {
        return $this->belongsTo(Match::class);
    }
}
