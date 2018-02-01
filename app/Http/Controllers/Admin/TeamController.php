<?php

namespace App\Http\Controllers\Admin;

use DB;
use Storage;
use Exception;
use Input;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests\TeamRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\TeamRepositoryInterface;
use App\Repositories\Contracts\CountryRepositoryInterface;

class TeamController extends Controller
{
    protected $teamRepository;
    protected $countryRepository;

    public function __construct(
        TeamRepositoryInterface $teamRepository,
        CountryRepositoryInterface $countryRepository
    ) {
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

        $countries = $this->countryRepository->countries(config('repository.pagination.all'), [['name', 'asc']]);
        if (isset($keyword)) {
            $teams = $this->teamRepository->search($keyword, config('repository.pagination.limit'));
            $teams->appends($request->only('q'));
        } else {
            $teams = $this->teamRepository->teams(config('repository.pagination.limit'), [['id', 'desc']]);
        }

        return view('admin.team.index', compact('teams', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\TeamRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(TeamRequest $request)
    {
        try {
            $path = $this->upload($request, config('setting.public_team_logo'));
            $request->merge(['logo' => $path]);
            $this->teamRepository->create($request->all());

            $message = trans('admin.team.index.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (Exception $e) {
            Storage::delete($path);
            $message = trans('admin.team.index.add.message.add_error');
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
            $team = $this->teamRepository->find($id); // throw RepositoryException when can not found
            $teams = $this->teamRepository->teams(config('repository.pagination.limit'), [['id', 'desc']]);
            $countries = $this->countryRepository->countries(config('repository.pagination.all'), [['name', 'asc']]);

            return view('admin.team.index', compact('team', 'teams', 'countries'));
        } catch (RepositoryException $e) {
            $message = trans('admin.team.index.edit.message.not_found');
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
     * @param  App\Http\Requests\TeamRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(TeamRequest $request, $id)
    {
        try {
            $team = $this->teamRepository->find($id); // throw RepositoryException when can not found
            $path = $this->upload($request, config('setting.public_team_logo'));
            if ($path) {
                Storage::delete($team->logo);
                $request->merge(['logo' => $path]);
            }

            $this->teamRepository->update($request->all(), $team);
            $message = trans('admin.team.index.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('teams.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            Storage::delete($path);
            $message = trans('admin.team.index.edit.message.not_found');
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
            $team = $this->teamRepository->find($id); // throw RepositoryException when can not found
            Storage::delete($team->logo);
            $this->teamRepository->delete($id);

            $message = trans('admin.team.index.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.team.index.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.team.index.delete.message.delete_error' . $e->errorInfo[1]);
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return redirect()->back()->with('notification', $notification);
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
