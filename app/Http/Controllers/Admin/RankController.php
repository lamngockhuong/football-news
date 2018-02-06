<?php

namespace App\Http\Controllers\Admin;

use DB;
use Storage;
use Exception;
use Input;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Rank;
use App\Http\Requests\RankRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\RankRepositoryInterface;
use App\Repositories\Contracts\MatchRepositoryInterface;

class RankController extends Controller
{
    protected $rankRepository;
    protected $matchRepository;

    public function __construct(
        RankRepositoryInterface $rankRepository,
        MatchRepositoryInterface $matchRepository
    ) {
        $this->rankRepository = $rankRepository;
        $this->matchRepository = $matchRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('access', Rank::class);
        // q: query parameter
        $keyword = $request->q;
        $league = $request->league;
        
        $leagues = $this->rankRepository->leaguesInRanking();
        if (isset($keyword)) {
            $ranks = $this->rankRepository->search($keyword, $league);
            if (is_numeric($league) && $league > 0) {
                $ranks->appends($request->only('league'));
            }
            $ranks->appends($request->only('q'));
        } else {
            if (is_numeric($league) && $league > 0) {
                $ranks = $this->rankRepository->ranks(
                    config('repository.pagination.limit'),
                    [['league_id', 'asc'], ['score', 'desc']], ['team', 'league'],
                    [['league_id', '=', $league]]
                );
            } else {
                $ranks = $this->rankRepository->ranks(config('repository.pagination.limit'), [['league_id', 'asc'], ['score', 'desc']], ['team', 'league']);
            }
        }

        return view('admin.rank.index', compact('ranks', 'leagues'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\RankRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RankRequest $request, $id)
    {
        $this->authorize('access', Rank::class);
        try {
            $rank = $this->rankRepository->find($id); // throw RepositoryException when can not found
            $this->rankRepository->update(['score' => $request->point], $rank);
            $message = trans('admin.rank.index.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.rank.index.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return response()->json($notification);
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
        $this->authorize('access', Rank::class);
        try {
            $rank = $this->rankRepository->find($id); // throw RepositoryException when can not found
            if (count($this->matchRepository->checkTeamHasRank($rank->team_id, $rank->league_id))) {
                throw new Exception(trans('admin.rank.index.delete.message.delete_error_team_has_rank'));
            }
            $this->rankRepository->delete($id);

            $message = trans('admin.rank.index.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.rank.index.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.rank.index.delete.message.delete_error' . $e->errorInfo[1]);
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (Exception $e) {
            $message = $e->getMessage();
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return redirect()->back()->with('notification', $notification);
    }
}
