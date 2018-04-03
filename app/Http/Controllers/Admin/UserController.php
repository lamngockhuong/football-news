<?php

namespace App\Http\Controllers\Admin;

use DB;
use Storage;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('access', User::class);
        // q: query parameter
        $keyword = $request->q;
        $status = $request->status;
        $level = $request->level;

        if (isset($keyword)) {
            $users = $this->userRepository->search($keyword, config('repository.pagination.limit'));
            $users->appends($request->only('q'));
        } else {
            if (isset($status)) {
                $users = $this->userRepository->usersByStatus(config('repository.pagination.limit'), [['id', 'desc']], $status);
            } else if (isset($level)) {
                $users = $this->userRepository->usersByLevel(config('repository.pagination.limit'), [['id', 'desc']], $level);
            } else {
                $users = $this->userRepository->users(config('repository.pagination.limit'), [['id', 'desc']]);
            }
        }

        return view('admin.user.index', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  App\Http\Requests\UserRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        $this->authorize('access', User::class);
        try {
            $path = $this->upload($request, config('setting.public_user_avatar'));
            $inputs = $request->all();
            $inputs['avatar'] = $path;
            $this->userRepository->create($inputs);

            $message = trans('admin.user.index.add.message.add_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (Exception $e) {
            Storage::delete($path);
            $message = trans('admin.user.index.add.message.add_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        return back()->with('notification', $notification);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('access', User::class);
        try {
            $user = $this->userRepository->find($id); // throw RepositoryException when can not found
            $users = $this->userRepository->users(config('repository.pagination.limit'), [['id', 'desc']]);

            return view('admin.user.index', compact('user', 'users'));
        } catch (RepositoryException $e) {
            $message = trans('admin.user.index.edit.message.not_found');
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
     * @param  App\Http\Requests\UserRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $this->authorize('access', User::class);
        try {
            $user = $this->userRepository->find($id); // throw RepositoryException when can not found
            $path = $this->upload($request, config('setting.public_user_avatar'));
            $inputs = $request->all();
            if ($path) {
                Storage::delete($user->avatar);
                $inputs['avatar'] = $path;
            }

            $this->userRepository->update($inputs, $user);
            $message = trans('admin.user.index.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('users.index')->with('notification', $notification);
        } catch (RepositoryException $e) {
            Storage::delete($path);
            $message = trans('admin.user.index.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return back()->with('notification', $notification);
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
        $this->authorize('access', User::class);
        try {
            $user = $this->userRepository->find($id); // throw RepositoryException when can not found
            if ($user->id == auth()->user()->id) {
                throw new Exception();
            }
            Storage::delete($user->avatar);
            $user->delete();

            $message = trans('admin.user.index.delete.message.delete_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];
        } catch (RepositoryException $e) {
            $message = trans('admin.user.index.delete.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (QueryException $e) {
            $message = trans('admin.user.index.delete.message.delete_error' . $e->errorInfo[1]);
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        } catch (Exception $e) {
            $message = trans('admin.user.index.delete.message.delete_error');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];
        }

        if (str_contains(url()->previous(), route('users.edit', ['id' => $id]))) {
            return redirect()->route('users.index')->with('notification', $notification);
        }

        return redirect()->back()->with('notification', $notification);
    }

    private function upload(Request $request, $directory, $directoryWithDate = true)
    {
        if ($request->hasFile('image')) {
            if ($directoryWithDate) {
                $directory .= date('/Y/m/d');
            }

            $fileName = str_slug($request->name) . '-' . time() . '.' . $request->image->extension();

            return $request->image->storeAs($directory, $fileName);
        }

        return null;
    }
}
