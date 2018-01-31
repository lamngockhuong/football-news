<?php

namespace App\Http\Controllers\Outside;

use Illuminate\Http\Request;
use App\Repositories\Contracts\LeagueRepositoryInterface;
use App\Repositories\Contracts\TeamRepositoryInterface;
use App\Http\Controllers\Controller;

class SearchController extends Controller
{
    protected $teamRepository;
    protected $leagueRepository;

    public function __construct(
        TeamRepositoryInterface $teamRepository,
        LeagueRepositoryInterface $leagueRepository
    ) {
        $this->teamRepository = $teamRepository;
        $this->leagueRepository = $leagueRepository;
    }

    public function search(Request $request)
    {
        // q: query parameter
        $keyword = $request->q;

        $teams = $this->teamRepository->search($keyword);
        $leagues = $this->leagueRepository->search($keyword);

        $teams->appends(request()->only(['q']));
        $leagues->appends(request()->only(['q']));

        return view('public.search', compact('keyword', 'teams', 'leagues'));
    }
}
