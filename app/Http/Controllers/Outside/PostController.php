<?php

namespace App\Http\Controllers\Outside;

use App\Exception\RepositoryException;
use App\Repositories\Contracts\PostRepositoryInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function show(Request $request)
    {
        try {
            $post = $this->postRepository->find($request->id);

            if ($post->slug !== $request->slug) {
                throw new RepositoryException();
            }

            $nextPost = $this->postRepository->nextPost($post->id);
            $prevPost = $this->postRepository->prevPost($post->id);

            return view('public.post.show', compact('post', 'nextPost', 'prevPost'));
        } catch (RepositoryException $e) {
            return view('errors.404');
        }
    }
}
