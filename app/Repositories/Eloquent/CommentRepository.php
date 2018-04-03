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

    public function comments()
    {
        return $this->with(['post', 'user'])
            ->orderBy('id', 'desc')
            ->paginate(config('repository.pagination.limit'));
    }

    public function commentsByPost($postId)
    {
        return $this->with(['post', 'user'])
            ->where('post_id', '=', $postId)
            ->orderBy('id', 'desc')
            ->paginate(config('repository.pagination.limit'));
    }

    public function commentsByUser($userId)
    {
        return $this->with(['post', 'user'])
            ->where('user_id', '=', $userId)
            ->orderBy('id', 'desc')
            ->paginate(config('repository.pagination.limit'));
    }
}
