<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
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
        'category_id',
        'user_id',
    ];

    protected $dates = ['deleted_at'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function getPublishDateAttribute()
    {
        return $this->created_at->format('H:i d/m/Y');
    }

    public function getSlugAttribute()
    {
        return str_slug($this->title);
    }

    public function getUrlAttribute()
    {
        return route('post.show', [
            'slug' => str_slug($this->title),
            'id' => $this->id,
        ]);
    }

    public function getShareUrlAttribute()
    {
        return urlencode($this->url);
    }
}
