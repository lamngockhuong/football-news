<?php

namespace App\Http\Controllers\Outside;

use App\Repositories\Contracts\MatchRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatchController extends Controller
{
    protected $matchRepository;

    public function __construct(MatchRepositoryInterface $matchRepository)
    {
        $this->matchRepository = $matchRepository;
    }

    public function upcoming()
    {
        $upcomingMatch = $this->matchRepository->nextMatches(config('setting.upcoming_match_banner'))->first();
        $upcomingMatches = $this->matchRepository->nextMatchesPagination(config('setting.upcoming_pagination'));

        return view('public.match.upcoming', compact('upcomingMatch', 'upcomingMatches'));
    }
}
