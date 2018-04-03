<?php

namespace App\Http\Controllers\Admin;

use DB;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Position;
use App\Http\Requests\PositionRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\PositionRepositoryInterface;

class PositionController extends Controller
{
    protected $positionRepository;

    public function __construct(PositionRepositoryInterface $positionRepository)
    {
        $this->positionRepository = $positionRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('access', Position::class);
        // q: query parameter
        $keyword = $request->q;

        if (isset($keyword)) {
            $positions = $this->positionRepository->search($keyword, config('repository.pagination.limit'));
            $positions->appends($request->only('q'));
        } else {
            $positions = $this->positionRepository->positions(config('repository.pagination.limit'), [['id', 'desc']]);
        }

        return view('admin.position.index', compact('positions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\PositionRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PositionRequest $request)
    {
        $this->authorize('access', Position::class);
        try {
            $this->positionRepository->create($request->all());

            $message = trans('admin.position.index.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (Exception $e) {
            $message = trans('admin.position.index.add.message.add_error');
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
        $this->authorize('access', Position::class);
        try {
            $position = $this->positionRepository->find($id); // throw RepositoryException when can not found
            $positions = $this->positionRepository->positions(config('repository.pagination.limit'), [['id', 'desc']]);

            return view('admin.position.index', compact('position', 'positions'));
        } catch (RepositoryException $e) {
            $message = trans('admin.position.index.edit.message.not_found');
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
     * @param  App\Http\Requests\PositionRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PositionRequest $request, $id)
    {
        $this->authorize('access', Position::class);
        try {
            $position = $this->positionRepository->find($id); // throw RepositoryException when can not found
            $this->positionRepository->update($request->all(), $position);
            $message = trans('admin.position.index.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('positions.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            $message = trans('admin.position.index.edit.message.not_found');
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
        $this->authorize('access', Position::class);
        try {
            $this->positionRepository->find($id); // throw RepositoryException when can not found
            $this->positionRepository->delete($id);

            $message = trans('admin.position.index.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.position.index.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.position.index.delete.message.delete_error' . $e->errorInfo[1]);
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        if (str_contains(url()->previous(), route('positions.edit', ['id' => $id]))) {
            return redirect()->route('positions.index')->with('notification', $notification);
        }

        return redirect()->back()->with('notification', $notification);
    }
}
