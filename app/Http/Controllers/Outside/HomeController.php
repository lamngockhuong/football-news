<?php

namespace App\Http\Controllers\Outside;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PostRepositoryInterface;

class HomeController extends Controller
{
    protected $postRepository;

    public function __construct(PostRepositoryInterface $postRepository)
    {
        $this->postRepository = $postRepository;
    }

    public function index()
    {
        $posts = $this->postRepository->paginate();

        return view('public.home', compact('posts'));
    }
}
