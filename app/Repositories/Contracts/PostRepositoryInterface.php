<?php

namespace App\Repositories\Contracts;

interface PostRepositoryInterface extends RepositoryInterface
{
    public function latestPosts();

    public function nextPost($id);

    public function prevPost($id);

    public function posts();

    public function postsOnlyTrash();

    public function postsByCategory($categoryId);

    public function postsByCategoryOnlyTrash($categoryId);
    
    public function postsByUser($userId);

    public function postsByUserOnlyTrash($userId);

    public function search($keyword);

    public function searchOnlyTrash($keyword);
}
