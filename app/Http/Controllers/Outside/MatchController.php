<?php

namespace App\Http\Controllers\Outside;

use App\Exception\RepositoryException;
use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Repositories\Contracts\LeagueRepositoryInterface;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MatchController extends Controller
{
    protected $matchRepository;
    protected $leagueRepository;

    public function __construct(
        MatchRepositoryInterface $matchRepository,
        LeagueRepositoryInterface $leagueRepository
    ) {
        $this->matchRepository = $matchRepository;
        $this->leagueRepository = $leagueRepository;
    }

    public function upcoming()
    {
        $upcomingMatch = $this->matchRepository->nextMatches(config('setting.upcoming_match_banner'))->first();
        $upcomingMatches = $this->matchRepository->nextMatchesPagination(config('setting.upcoming_pagination'));

        return view('public.match.upcoming', compact('upcomingMatch', 'upcomingMatches'));
    }

    public function upcomingByLeague(Request $request)
    {
        try {
            $league = $this->leagueRepository->find($request->id);

            if ($league->slug !== $request->slug) {
                throw new RepositoryException();
            }

            $upcomingMatch = $this->matchRepository->nextLeagueMatches($league->id, config('setting.upcoming_match_banner'))->first();
            $upcomingMatches = $this->matchRepository->nextLeagueMatchesPagination($league->id, config('setting.upcoming_pagination'));

            if (!count($upcomingMatches)) {
                throw new RepositoryException();
            }

            return view('public.match.upcoming-league', compact('upcomingMatch', 'upcomingMatches', 'league'));
        } catch (RepositoryException $e) {
            return view('errors.404');
        }
    }

    public function result(Request $request)
    {
        try {
            $league = $this->leagueRepository->find($request->id);

            if ($league->slug !== $request->slug) {
                throw new RepositoryException();
            }

            $upcomingMatch = $this->matchRepository->nextMatches(config('setting.upcoming_match_banner'))->first();
            $results = $this->matchRepository->results($league->id, config('setting.result_pagination'));

            if (!count($results)) {
                throw new RepositoryException();
            }

            return view('public.match.result', compact('results', 'upcomingMatch', 'league'));
        } catch (RepositoryException $e) {
            return view('errors.404');
        }
    }
}
