<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'avatar',
        'coin',
        'provider',
        'provider_id',
        'is_actived',
        'is_admin',
    ];

    /**
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function bets()
    {
        return $this->hasMany(Bet::class);
    }

    public function matchEvents()
    {
        return $this->hasMany(MatchEvent::class);
    }

    public function userActivation()
    {
        return $this->hasOne(UserActivation::class);
    }

    public function setPasswordAttribute($value)
    {
        $this->attributes['password'] = bcrypt($value);
    }

    public function getAvatarUrlAttribute()
    {
        return asset(config('filesystems.disks.public.url') . '/' . $this->attributes['avatar']);
    }

    public function getRegisterDateAttribute()
    {
        return $this->created_at->format('H:i d/m/Y');
    }

    public function getLastUpdateDateAttribute()
    {
        return $this->created_at->format('H:i d/m/Y');
    }
}
