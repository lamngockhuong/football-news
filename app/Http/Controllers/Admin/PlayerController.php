<?php

namespace App\Http\Controllers\Admin;

use DB;
use Storage;
use Exception;
use Input;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests\PlayerRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PlayerRepositoryInterface;
use App\Repositories\Contracts\PositionRepositoryInterface;
use App\Repositories\Contracts\TeamRepositoryInterface;
use App\Repositories\Contracts\CountryRepositoryInterface;

class PlayerController extends Controller
{
    protected $playerRepository;
    protected $positionRepository;
    protected $teamRepository;
    protected $countryRepository;

    public function __construct(
        PlayerRepositoryInterface $playerRepository,
        PositionRepositoryInterface $positionRepository,
        TeamRepositoryInterface $teamRepository,
        CountryRepositoryInterface $countryRepository
    ) {
        $this->playerRepository = $playerRepository;
        $this->positionRepository = $positionRepository;
        $this->teamRepository = $teamRepository;
        $this->countryRepository = $countryRepository;
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

        $positions = $this->positionRepository->positions(config('repository.pagination.all'), [['name', 'asc']]);
        $teams = $this->teamRepository->teams(config('repository.pagination.all'), [['name', 'asc']]);
        $countries = $this->countryRepository->countries(config('repository.pagination.all'), [['name', 'asc']]);
        if (isset($keyword)) {
            $players = $this->playerRepository->search($keyword, config('repository.pagination.limit'));
            $players->appends($request->only('q'));
        } else {
            $players = $this->playerRepository->players(config('repository.pagination.limit'), [['id', 'desc']]);
        }

        return view('admin.player.index', compact('positions', 'teams', 'countries', 'players'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PlayerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlayerRequest $request)
    {
        try {
            $path = $this->upload($request, config('setting.public_player_avatar'));
            $request->merge(['avatar' => $path]);
            $this->playerRepository->create($request->all());

            $message = trans('admin.player.index.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (Exception $e) {
            Storage::delete($path);
            $message = trans('admin.player.index.add.message.add_error');
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
            $player = $this->playerRepository->find($id); // throw RepositoryException when can not found
            $players = $this->playerRepository->players(config('repository.pagination.limit'), [['id', 'desc']]);
            $positions = $this->positionRepository->positions(config('repository.pagination.all'), [['name', 'asc']]);
            $teams = $this->teamRepository->teams(config('repository.pagination.all'), [['name', 'asc']]);
            $countries = $this->countryRepository->countries(config('repository.pagination.all'), [['name', 'asc']]);

            return view('admin.player.index', compact('player', 'players', 'positions', 'teams', 'countries'));
        } catch (RepositoryException $e) {
            $message = trans('admin.player.index.edit.message.not_found');
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
     * @param  App\Http\Requests\PlayerRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlayerRequest $request, $id)
    {
        try {
            $player = $this->playerRepository->find($id); // throw RepositoryException when can not found
            $path = $this->upload($request, config('setting.public_player_avatar'));
            if ($path) {
                Storage::delete($player->avatar);
                $request->merge(['avatar' => $path]);
            }

            $this->playerRepository->update($request->all(), $player);
            $message = trans('admin.player.index.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('players.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            Storage::delete($path);
            $message = trans('admin.player.index.edit.message.not_found');
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
            $player = $this->playerRepository->find($id); // throw RepositoryException when can not found
            Storage::delete($player->avatar);
            $this->playerRepository->delete($id);

            $message = trans('admin.player.index.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.player.index.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.player.index.delete.message.delete_error' . $e->errorInfo[1]);
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return redirect()->route('players.index')->with('notification', $notification);
    }

    private function upload(Request $request, $directory, $directoryWithDate = true)
    {
        if ($request->hasFile('image')) {
            if ($directoryWithDate) {
                $directory .= date('/Y/m/d');
            }

            $fileName = str_slug($request->name) . '.' . $request->image->extension();

            return $request->image->storeAs($directory, $fileName);
        }

        return null;
    }
}
