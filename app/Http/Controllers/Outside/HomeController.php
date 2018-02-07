<?php

namespace App\Http\Controllers\Outside;

use App\Http\Controllers\Controller;
use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Repositories\Contracts\PostRepositoryInterface;

class HomeController extends Controller
{
    protected $postRepository;
    protected $matchRepository;

    public function __construct(
        PostRepositoryInterface $postRepository,
        MatchRepositoryInterface $matchRepository
    ) {
        $this->postRepository = $postRepository;
        $this->matchRepository = $matchRepository;
    }

    public function index()
    {
        $nextMatches = $this->matchRepository->nextMatches(config('setting.next_match'))->reverse();
        $posts = $this->postRepository->latestPosts();

        return view('public.home', compact('posts', 'nextMatches'));
    }
}
