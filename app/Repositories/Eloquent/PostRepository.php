<?php

namespace App\Repositories\Eloquent;

use App\Models\Post;
use App\Repositories\Contracts\PostRepositoryInterface;

class PostRepository extends BaseRepository implements PostRepositoryInterface
{
    public function getModel()
    {
        return Post::class;
    }

    public function nextPost($id)
    {
        return $this->findWhere([['id', '>', $id]])->get()->first();
    }

    public function prevPost($id)
    {
        return $this->findWhere([['id', '<', $id]])->get()->last();
    }
}
