<?php

namespace App\Http\Controllers\Outside;

use App\Exception\RepositoryException;
use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Repositories\Contracts\LeagueRepositoryInterface;
use App\Repositories\Contracts\RankRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RankController extends Controller
{
    protected $matchRepository;
    protected $leagueRepository;
    protected $rankRepository;

    public function __construct(
        MatchRepositoryInterface $matchRepository,
        LeagueRepositoryInterface $leagueRepository,
        RankRepositoryInterface $rankRepository
    ) {
        $this->matchRepository = $matchRepository;
        $this->leagueRepository = $leagueRepository;
        $this->rankRepository = $rankRepository;
    }

    public function show(Request $request)
    {
        try {
            $league = $this->leagueRepository->find($request->id);

            if ($league->slug !== $request->slug) {
                throw new RepositoryException();
            }

            $upcomingMatch = $this->matchRepository->nextMatches(config('setting.upcoming_match_banner'))->first();
            $ranks = $this->rankRepository->ranking($league->id);

            return view('public.rank.show', compact('ranks', 'upcomingMatch', 'league'));
        } catch (RepositoryException $e) {
            return view('errors.404');
        }
    }
}
