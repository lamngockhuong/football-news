<?php

namespace App\Http\Controllers\Admin;

use DB;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests\TeamAchievementRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TeamRepositoryInterface;
use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Repositories\Contracts\TeamAchievementRepositoryInterface;

class TeamAchievementController extends Controller
{
    protected $teamRepository;
    protected $matchRepository;
    protected $teamAchievementRepository;

    public function __construct(
        TeamRepositoryInterface $teamRepository,
        MatchRepositoryInterface $matchRepository,
        TeamAchievementRepositoryInterface $teamAchievementRepository
    ) {
        $this->teamRepository = $teamRepository;
        $this->matchRepository = $matchRepository;
        $this->teamAchievementRepository = $teamAchievementRepository;
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
        $matches = $this->matchRepository->matchesForForm();
        if (isset($keyword)) {
            $achievements = $this->teamAchievementRepository->search($keyword, config('repository.pagination.limit'));
            $achievements->appends($request->only('q'));
        } else {
            $achievements = $this->teamAchievementRepository->achievements(config('repository.pagination.limit'));
        }

        return view('admin.team-achievement.index', compact('achievements', 'teams', 'matches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TeamAchievementRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamAchievementRequest $request)
    {
        try {
            $this->teamAchievementRepository->create($request->all());

            $message = trans('admin.team-achievement.index.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (Exception $e) {
            $message = trans('admin.team-achievement.index.add.message.add_error');
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
            $achievement = $this->teamAchievementRepository->find($id); // throw RepositoryException when can not found
            $achievements = $this->teamAchievementRepository->achievements(config('repository.pagination.limit'));
            $teams = $this->teamRepository->teams(config('repository.pagination.all'), [['name', 'asc']]);
            $matches = $this->matchRepository->matchesForForm();

            return view('admin.team-achievement.index', compact('achievement', 'achievements', 'teams', 'matches'));
        } catch (RepositoryException $e) {
            $message = trans('admin.team-achievement.index.edit.message.not_found');
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
     * @param  App\Http\Requests\TeamAchievementRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamAchievementRequest $request, $id)
    {
        try {
            $achievement = $this->teamAchievementRepository->find($id); // throw RepositoryException when can not found
            $this->teamAchievementRepository->update($request->all(), $achievement);
            $message = trans('admin.team-achievement.index.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('team-achievements.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            $message = trans('admin.team-achievement.index.edit.message.not_found');
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
            $this->teamAchievementRepository->find($id); // throw RepositoryException when can not found
            $this->teamAchievementRepository->delete($id);

            $message = trans('admin.team-achievement.index.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.team-achievement.index.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.team-achievement.index.delete.message.delete_error' . $e->errorInfo[1]);
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        if (str_contains(url()->previous(), route('team-achievements.edit', ['id' => $id]))) {
            return redirect()->route('team-achievements.index')->with('notification', $notification);
        }

        return redirect()->back()->with('notification', $notification);
    }
}
