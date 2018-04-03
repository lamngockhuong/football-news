<?php

namespace App\Http\Controllers\Outside;

use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PlayerRepositoryInterface;
use App\Repositories\Contracts\TeamRepositoryInterface;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    protected $teamRepository;
    protected $playerRepository;

    public function __construct(
        TeamRepositoryInterface $teamRepository,
        PlayerRepositoryInterface $playerRepository
    ) {
        $this->teamRepository = $teamRepository;
        $this->playerRepository = $playerRepository;
    }

    public function show(Request $request)
    {
        try {
            $team = $this->teamRepository->find($request->id);
            $players = $this->playerRepository->players($team->id);

            if ($team->slug !== $request->slug) {
                throw new RepositoryException();
            }

            return view('public.team.show', compact('team', 'players'));
        } catch (RepositoryException $e) {
            return view('errors.404');
        }
    }
}
