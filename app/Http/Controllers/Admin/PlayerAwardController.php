<?php

namespace App\Http\Controllers\Admin;

use DB;
use Storage;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests\PlayerAwardRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PlayerRepositoryInterface;
use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Repositories\Contracts\PlayerAwardRepositoryInterface;

class PlayerAwardController extends Controller
{
    protected $playerRepository;
    protected $matchRepository;
    protected $playerAwardRepository;

    public function __construct(
        PlayerRepositoryInterface $playerRepository,
        MatchRepositoryInterface $matchRepository,
        PlayerAwardRepositoryInterface $playerAwardRepository
    ) {
        $this->playerRepository = $playerRepository;
        $this->matchRepository = $matchRepository;
        $this->playerAwardRepository = $playerAwardRepository;
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

        $players = $this->playerRepository->playersForForm();
        $matches = $this->matchRepository->matchesForForm();
        if (isset($keyword)) {
            $awards = $this->playerAwardRepository->search($keyword, config('repository.pagination.limit'));
            $awards->appends($request->only('q'));
        } else {
            $awards = $this->playerAwardRepository->awards(config('repository.pagination.limit'));
        }

        return view('admin.player-award.index', compact('awards', 'players', 'matches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PlayerAwardRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlayerAwardRequest $request)
    {
        try {
            $this->playerAwardRepository->create($request->all());

            $message = trans('admin.player-award.index.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (Exception $e) {
            $message = trans('admin.player-award.index.add.message.add_error');
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
            $award = $this->playerAwardRepository->find($id); // throw RepositoryException when can not found
            $awards = $this->playerAwardRepository->awards(config('repository.pagination.limit'));
            $players = $this->playerRepository->playersForForm();
            $matches = $this->matchRepository->matchesForForm();

            return view('admin.player-award.index', compact('award', 'awards', 'players', 'matches'));
        } catch (RepositoryException $e) {
            $message = trans('admin.player-award.index.edit.message.not_found');
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
     * @param  App\Http\Requests\PlayerAwardRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlayerAwardRequest $request, $id)
    {
        try {
            $award = $this->playerAwardRepository->find($id); // throw RepositoryException when can not found
            $this->playerAwardRepository->update($request->all(), $award);
            $message = trans('admin.player-award.index.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('player-awards.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            $message = trans('admin.player-award.index.edit.message.not_found');
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
            $this->playerAwardRepository->find($id); // throw RepositoryException when can not found
            $this->playerAwardRepository->delete($id);

            $message = trans('admin.player-award.index.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.player-award.index.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.player-award.index.delete.message.delete_error' . $e->errorInfo[1]);
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        if (str_contains(url()->previous(), route('player-awards.edit', ['id' => $id]))) {
            return redirect()->route('player-awards.index')->with('notification', $notification);
        }

        return redirect()->back()->with('notification', $notification);
    }
}
