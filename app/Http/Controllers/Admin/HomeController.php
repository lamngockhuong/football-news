<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\TeamRepositoryInterface;
use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Repositories\Contracts\BetRepositoryInterface;

class HomeController extends Controller
{

    protected $userRepository;
    protected $teamRepository;

    public function __construct(
        UserRepositoryInterface $userRepository,
        TeamRepositoryInterface $teamRepository,
        MatchRepositoryInterface $matchRepository,
        BetRepositoryInterface $betRepository
    ) {
        $this->userRepository = $userRepository;
        $this->teamRepository = $teamRepository;
        $this->matchRepository = $matchRepository;
        $this->betRepository = $betRepository;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userNumber = $this->userRepository->count();
        $teamNumber = $this->teamRepository->count();
        $matchNumber = $this->matchRepository->count();
        $betNumber = $this->betRepository->count();
        return view('home', compact('userNumber', 'teamNumber', 'matchNumber', 'betNumber'));
    }
}
