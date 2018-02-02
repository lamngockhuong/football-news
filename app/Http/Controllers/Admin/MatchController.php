<?php

namespace App\Http\Controllers\Admin;

use DB;
use Storage;
use Exception;
use Input;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests\MatchRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Repositories\Contracts\TeamRepositoryInterface;
use App\Repositories\Contracts\LeagueRepositoryInterface;

class MatchController extends Controller
{
    protected $matchRepository;
    protected $teamRepository;
    protected $leagueRepository;

    public function __construct(
        MatchRepositoryInterface $matchRepository,
        TeamRepositoryInterface $teamRepository,
        LeagueRepositoryInterface $leagueRepository
    ) {
        $this->matchRepository = $matchRepository;
        $this->teamRepository = $teamRepository;
        $this->leagueRepository = $leagueRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
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
        try {
            $this->matchRepository->create($request->all());

            $message = trans('admin.match.index.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (Exception $e) {
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
     * @param  App\Http\Requests\matchRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(matchRequest $request, $id)
    {
        try {
            $match = $this->matchRepository->find($id); // throw RepositoryException when can not found
            $this->matchRepository->update($request->all(), $match);
            $message = trans('admin.match.index.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('matches.index')->with('notification', $notification);
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
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
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
}
