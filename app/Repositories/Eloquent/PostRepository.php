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

    public function latestPosts()
    {
        return $this->findWhere([['is_actived', '=', config('setting.posts.active')]])
            ->orderBy('id', 'desc')
            ->paginate(config('repository.pagination.limit'));
    }

    public function nextPost($id)
    {
        return $this->findWhere([['id', '>', $id], ['is_actived', '=', config('setting.posts.active')]])
            ->get()->first();
    }

    public function prevPost($id)
    {
        return $this->findWhere([['id', '<', $id], ['is_actived', '=', config('setting.posts.active')]])
            ->get()->last();
    }

    public function posts()
    {
        return $this->with(['category', 'user'])
            ->orderBy('id', 'desc')
            ->paginate(config('repository.pagination.limit'));
    }

    public function postsOnlyTrash()
    {
        return $this->with(['category', 'user'])
            ->onlyTrashed()
            ->orderBy('id', 'desc')
            ->paginate(config('repository.pagination.limit'));
    }

    public function postsByCategory($categoryId)
    {
        return $this->with(['category', 'user'])
            ->where('category_id', '=', $categoryId)
            ->orderBy('id', 'desc')
            ->paginate(config('repository.pagination.limit'));
    }

    public function postsByCategoryOnlyTrash($categoryId)
    {
        return $this->with(['category', 'user'])
            ->onlyTrashed()
            ->where('category_id', '=', $categoryId)
            ->orderBy('id', 'desc')
            ->paginate(config('repository.pagination.limit'));
    }

    public function postsByUser($userId)
    {
        return $this->with(['category', 'user'])
            ->where('user_id', '=', $userId)
            ->orderBy('id', 'desc')
            ->paginate(config('repository.pagination.limit'));
    }

    public function postsByUserOnlyTrash($userId)
    {
        return $this->with(['category', 'user'])
            ->onlyTrashed()
            ->where('user_id', '=', $userId)
            ->orderBy('id', 'desc')
            ->paginate(config('repository.pagination.limit'));
    }

    public function search($keyword)
    {
        return $this->with(['category', 'user'])
            ->where('title', 'like', "%$keyword%")
            ->orWhere('description', 'like', "%$keyword%")
            ->orWhere('content', 'like', "%$keyword%")
            ->orWhereHas(
                'category',
                function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                }
            )->orWhereHas(
                'user',
                function ($query) use ($keyword) {
                    $query->where('name', 'like', "%$keyword%");
                }
            )->paginate(config('repository.pagination.limit'));
    }

    public function searchOnlyTrash($keyword)
    {
        return $this->with(['category', 'user'])
            ->onlyTrashed()
            ->where(
                function ($query) use ($keyword) {
                    $query->where('title', 'like', "%$keyword%")
                        ->orWhere('description', 'like', "%$keyword%")
                        ->orWhere('content', 'like', "%$keyword%")
                        ->orWhereHas(
                            'category',
                            function ($query) use ($keyword) {
                                $query->where('name', 'like', "%$keyword%");
                            }
                        )->orWhereHas(
                            'user',
                            function ($query) use ($keyword) {
                                $query->where('name', 'like', "%$keyword%");
                            }
                        );
                }
            )
            ->paginate(config('repository.pagination.limit'));
    }
}
