<?php

namespace App\Http\Controllers\Admin;

use DB;
use Storage;
use Exception;
use Input;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Match;
use App\Http\Requests\MatchRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Repositories\Contracts\RankRepositoryInterface;
use App\Repositories\Contracts\TeamRepositoryInterface;
use App\Repositories\Contracts\LeagueRepositoryInterface;

class MatchController extends Controller
{
    protected $matchRepository;
    protected $teamRepository;
    protected $rankRepository;
    protected $leagueRepository;

    public function __construct(
        MatchRepositoryInterface $matchRepository,
        TeamRepositoryInterface $teamRepository,
        RankRepositoryInterface $rankRepository,
        LeagueRepositoryInterface $leagueRepository
    ) {
        $this->matchRepository = $matchRepository;
        $this->teamRepository = $teamRepository;
        $this->rankRepository = $rankRepository;
        $this->leagueRepository = $leagueRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('access', Match::class);
        // q: query parameter
        $keyword = $request->q;

        $teams = $this->teamRepository->teams(config('repository.pagination.all'), [['name', 'asc']]);
        $leagues = $this->leagueRepository->leagues(config('repository.pagination.all'), [['name', 'asc']]);
        if (isset($keyword)) {
            $matches = $this->matchRepository->search($keyword, config('repository.pagination.limit'));
            $matches->appends($request->only('q'));
        } else {
            $matches = $this->matchRepository->matchesForTable(config('repository.pagination.limit'));
        }

        return view('admin.match.index', compact('matches', 'teams', 'leagues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\MatchRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MatchRequest $request)
    {
        $this->authorize('access', Match::class);
        try {
            $leagueId = $request->league_id;
            $team1Id = $request->team1_id;
            $team1Goal = 0;
            $team2Id = $request->team2_id;
            $team2Goal = 0;

            if ($this->matchRepository->matchExists($team1Id, $team2Id, $leagueId)) {
                $message = trans('admin.match.index.add.message.match_exists');
                $notification = [
                    'message' => $message,
                    'type' => 'danger',
                ];

                return redirect()->back()->withInput()->with('notification', $notification);
            }

            DB::beginTransaction();
            $this->matchRepository->create($request->all());
            $this->updateOrCreateRank($team1Id, $team1Goal, $team2Id, $team2Goal, $leagueId, true);
            DB::commit();
            $message = trans('admin.match.index.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (Exception $e) {
            DB::rollback();
            $message = trans('admin.match.index.add.message.add_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return redirect()->back()->with('notification', $notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('access', Match::class);
        try {
            $match = $this->matchRepository->find($id); // throw RepositoryException when can not found
            $matches = $this->matchRepository->matchesForTable(config('repository.pagination.limit'));
            $teams = $this->teamRepository->teams(config('repository.pagination.all'), [['name', 'asc']]);
            $leagues = $this->leagueRepository->leagues(config('repository.pagination.all'), [['name', 'asc']]);

            return view('admin.match.index', compact('match', 'matches', 'teams', 'leagues'));
        } catch (RepositoryException $e) {
            $message = trans('admin.match.index.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return redirect()->back()->with('notification', $notification);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\MatchRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MatchRequest $request, $id)
    {
        $this->authorize('access', Match::class);
        try {
            $match = $this->matchRepository->find($id); // throw RepositoryException when can not found
            $leagueId = $request->league_id;
            $team1Id = $request->team1_id;
            $team1Goal = $request->team1_goal;
            $team2Id = $request->team2_id;
            $team2Goal = $request->team2_goal;

            // check if change goal of two team: times second
            if ($request->team1_goal != null
                && $request->team2_goal != null
                && ($match->created_at != $match->updated_at)
                && ($team1Goal != $match->team1_goal || $team2Goal != $match->team2_goal)
            ) {
                $message = trans('admin.match.index.edit.message.can_not_change_goal_times_second');
                $notification = [
                    'message' => $message,
                    'type' => 'danger',
                ];

                return redirect()->back()->withInput()->with('notification', $notification);
            }

            DB::beginTransaction();
            
            if ($match->created_at == $match->updated_at) {
                $this->updateOrCreateRank($team1Id, $team1Goal, $team2Id, $team2Goal, $leagueId);
            }
            $this->matchRepository->update($request->all(), $match);

            DB::commit();
            $message = trans('admin.match.index.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('matches.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            DB::rollback();
            $message = trans('admin.match.index.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return redirect()->back()->withInput()->with('notification', $notification);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('access', Match::class);
        try {
            $this->matchRepository->find($id); // throw RepositoryException when can not found
            $this->matchRepository->delete($id);

            $message = trans('admin.match.index.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.match.index.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.match.index.delete.message.delete_error' . $e->errorInfo[1]);
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        if (str_contains(url()->previous(), route('matches.edit', ['id' => $id]))) {
            return redirect()->route('matches.index')->with('notification', $notification);
        }

        return redirect()->back()->with('notification', $notification);
    }

    public function updateOrCreateRank($team1Id, $team1Goal, $team2Id, $team2Goal, $leagueId, $create = false)
    {
        $team1Rank = [
            'won' => ($team1Goal > $team2Goal) ? DB::raw('won + 1') : DB::raw('won'),
            'lost' => ($team1Goal < $team2Goal) ? DB::raw('lost + 1') : DB::raw('lost'),
            'drawn' => (($team1Goal == $team2Goal) && !$create) ? DB::raw('drawn + 1') : DB::raw('drawn'),
            'goals_for' => DB::raw('goals_for + ' . $team1Goal),
            'goals_against' => DB::raw('goals_against + ' . $team2Goal),
        ];
        $team2Rank = [
            'won' => ($team1Goal < $team2Goal) ? DB::raw('won + 1') : DB::raw('won'),
            'lost' => ($team1Goal > $team2Goal) ? DB::raw('lost + 1') : DB::raw('lost'),
            'drawn' => (($team1Goal == $team2Goal) && !$create) ? DB::raw('drawn + 1') : DB::raw('drawn'),
            'goals_for' => DB::raw('goals_for + ' . $team2Goal),
            'goals_against' => DB::raw('goals_against + ' . $team1Goal),
        ];
        
        $this->rankRepository->updateOrCreateRank($team1Id, $leagueId, $team1Rank);
        $this->rankRepository->updateOrCreateRank($team2Id, $leagueId, $team2Rank);
    }
}
