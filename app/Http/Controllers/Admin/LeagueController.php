<?php

namespace App\Http\Controllers\Admin;

use DB;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests\LeagueRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\LeagueRepositoryInterface;

class LeagueController extends Controller
{
    protected $leagueRepository;

    public function __construct(LeagueRepositoryInterface $leagueRepository)
    {
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

        if (isset($keyword)) {
            $leagues = $this->leagueRepository->search($keyword, config('repository.limit'));
            $leagues->appends($request->only('q'));
        } else {
            $leagues = $this->leagueRepository->leagues(config('repository.limit'));
        }

        return view('admin.league.index', compact('leagues'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\LeagueRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LeagueRequest $request)
    {
        try {
            $this->leagueRepository->create($request->all());

            $message = trans('admin.league.index.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (Exception $e) {
            $message = trans('admin.league.index.add.message.add_error');
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
            $league = $this->leagueRepository->find($id); // throw RepositoryException when can not found
            $leagues = $this->leagueRepository->leagues(config('repository.limit'));

            return view('admin.league.index', compact('league', 'leagues'));
        } catch (RepositoryException $e) {
            $message = trans('admin.league.index.edit.message.not_found');
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
     * @param  App\Http\Requests\LeagueRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(LeagueRequest $request, $id)
    {
        try {
            $league = $this->leagueRepository->find($id); // throw RepositoryException when can not found
            $this->leagueRepository->update($request->all(), $league);
            $message = trans('admin.league.index.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('leagues.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            $message = trans('admin.league.index.edit.message.not_found');
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
            $this->leagueRepository->find($id); // throw RepositoryException when can not found
            $this->leagueRepository->delete($id);

            $message = trans('admin.league.index.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.league.index.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.league.index.delete.message.delete_error' . $e->errorInfo[1]);
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return redirect()->back()->with('notification', $notification);
    }
}
