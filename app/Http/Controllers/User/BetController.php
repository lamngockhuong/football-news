<?php

namespace App\Http\Controllers\User;

use DB;
use Storage;
use Exception;
use Input;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Http\Requests\BetRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\MatchRepositoryInterface;
use App\Repositories\Contracts\UserRepositoryInterface;
use App\Repositories\Contracts\BetRepositoryInterface;

class BetController extends Controller
{
    protected $matchRepository;
    protected $betRepository;

    public function __construct(
        MatchRepositoryInterface $matchRepository,
        UserRepositoryInterface $userRepository,
        BetRepositoryInterface $betRepository
    ) {
        $this->matchRepository = $matchRepository;
        $this->userRepository = $userRepository;
        $this->betRepository = $betRepository;
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

        $matches = $this->matchRepository->nextMatches(config('repository.pagination.all'));
        if (isset($keyword)) {
            $bets = $this->betRepository->searchByUser($keyword, config('repository.pagination.limit'), auth()->user()->id);
            $bets->appends($request->only('q'));
        } else {
            $bets = $this->betRepository->betsByUser(config('repository.pagination.limit'), [['id', 'desc']], auth()->user()->id);
        }

        return view('user.bet.index', compact('bets', 'matches'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\BetRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BetRequest $request)
    {
        try {
            // check if the match ends
            if (!$this->matchRepository->isUpcommingMatch($request->match_id)) {
                throw new Exception();
            }

            // check if bets coins less than user coins
            $user = auth()->user();
            if ($request->coin > $user->coin) {
                $message = trans('admin.bet.index.add.message.lack_of_coin');
                $notification = [
                    'message' => $message,
                    'type' => 'danger',
                ];

                return back()->withInput()->with('notification', $notification);
            }

            DB::beginTransaction();
            $inputs = $request->all();
            $inputs['user_id'] = $user->id;
            $this->betRepository->create($inputs);
            $this->userRepository->update(['coin' => $user->coin - $request->coin], $user);
            DB::commit();
            $message = trans('admin.bet.index.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (Exception $e) {
            DB::rollback();
            $message = trans('admin.bet.index.add.message.add_error');
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
            $bet = $this->betRepository->find($id); // throw RepositoryException when can not found
            // check if the match ends, can not edit
            if (!$this->matchRepository->isUpcommingMatch($bet->match_id)) {
                $message = trans('admin.bet.index.edit.message.match_ends_can_not_edit');
                $notification = [
                    'message' => $message,
                    'type' => 'danger',
                ];

                return back()->with('notification', $notification);
            }
            $bets = $this->betRepository->betsByUser(config('repository.pagination.limit'), [['id', 'desc']], auth()->user()->id);

            return view('user.bet.index', compact('bet', 'matches', 'bets'));
        } catch (RepositoryException $e) {
            $message = trans('admin.bet.index.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return back()->with('notification', $notification);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\BetRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BetRequest $request, $id)
    {
        try {
            $bet = $this->betRepository->find($id); // throw RepositoryException when can not found
            DB::beginTransaction();
            // check if bets coins less than user coins
            $user = auth()->user();
            if ($request->coin > ($user->coin + $bet->coin)) {
                $message = trans('admin.bet.index.edit.message.lack_of_coin');
                $notification = [
                    'message' => $message,
                    'type' => 'danger',
                ];

                return back()->withInput()->with('notification', $notification);
            }
            $this->userRepository->update(['coin' => $user->coin - ($request->coin - $bet->coin)], $user);
            $this->betRepository->update($request->only(['team1_goal', 'team2_goal', 'coin']), $bet);
            DB::commit();
            $message = trans('admin.bet.index.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('user.bets.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            DB::rollback();
            $message = trans('admin.bet.index.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return back()->withInput()->with('notification', $notification);
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
            $bet = $this->betRepository->find($id); // throw RepositoryException when can not found
            DB::beginTransaction();
            // check if the match not ends: pay back user coin
            if ($this->matchRepository->isUpcommingMatch($bet->match_id)) {
                $user = auth()->user();
                $this->userRepository->update(['coin' => $user->coin + $bet->coin], $user);
            }
            $this->betRepository->delete($id);
            DB::commit();
            $message = trans('admin.bet.index.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            DB::rollback();
            $message = trans('admin.bet.index.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            DB::rollback();
            $message = trans('admin.bet.index.delete.message.delete_error' . $e->errorInfo[1]);
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        if (str_contains(url()->previous(), route('user.bets.edit', ['id' => $id]))) {
            return redirect()->route('user.bets.index')->with('notification', $notification);
        }

        return back()->with('notification', $notification);
    }
}
