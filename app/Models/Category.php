<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    /**
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'parent',
    ];

    public $timestamps = false;

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent', 'id');
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }
}
