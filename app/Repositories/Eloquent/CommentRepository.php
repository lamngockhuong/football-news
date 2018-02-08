<?php

namespace App\Repositories\Eloquent;

use App\Models\Comment;
use App\Repositories\Contracts\CommentRepositoryInterface;

class CommentRepository extends BaseRepository implements CommentRepositoryInterface
{
    public function getModel()
    {
        return Comment::class;
    }

    public function commentForPost($postId)
    {
        return $this->with('user')
            ->where('post_id', '=', $postId)
            ->orderBy('id', 'asc')
            ->all();
    }
}
