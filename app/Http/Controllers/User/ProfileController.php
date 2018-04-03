<?php

namespace App\Http\Controllers\User;

use Storage;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Http\Requests\UserProfileRequest;
use App\Http\Requests\ChangePasswordRequest;
use App\Exception\RepositoryException;
use App\Http\Controllers\Controller;
use App\Repositories\Contracts\UserRepositoryInterface;

class ProfileController extends Controller
{
    protected $userRepository;

    public function __construct(UserRepositoryInterface $userRepository) {
        $this->userRepository = $userRepository;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        try {
            $loginUser = auth()->user();
            if (!$loginUser->is_admin && $loginUser->id != $id) {
                throw new Exception();
            }

            $user = $this->userRepository->find($id); // throw RepositoryException when can not found

            return view('user.profile.show', compact('user'));
        } catch (Exception $e) {
            return redirect()->route('admin.home');
        }
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
            $loginUser = auth()->user();
            if (!$loginUser->is_admin && $loginUser->id != $id) {
                throw new Exception();
            }

            $user = $this->userRepository->find($id); // throw RepositoryException when can not found

            return view('user.profile.edit', compact('user'));
        } catch (Exception $e) {
            return redirect()->route('admin.home');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  App\Http\Requests\UserProfileRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserProfileRequest $request, $id)
    {
        try {
            $user = $this->userRepository->find($id); // throw RepositoryException when can not found
            $path = $this->upload($request, config('setting.public_user_avatar'));
            $inputs = $request->all();
            if ($path) {
                Storage::delete($user->avatar);
                $inputs['avatar'] = $path;
            }

            $this->userRepository->update($inputs, $user);
            $message = trans('admin.profile.edit.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('user.profiles.show', ['id' => $user->id])->with('notification', $notification);
        } catch (RepositoryException $e) {
            Storage::delete($path);
            $message = trans('admin.profile.edit.message.not_found');
            $notification = [
                'message' => $message,
                'type' => 'danger',
            ];

            return back()->withInput()->with('notification', $notification);
        }
    }

    public function showChangePassword()
    {
        $user = auth()->user();

        if ($user->provider) {
            return redirect()->route('user.profiles.show', ['id' => $user->id]);
        } else {
            return view('user.profile.change-password');
        }
    }

    public function changePassword(ChangePasswordRequest $request)
    {
        $user = auth()->user();
        if (!$user->provider) {
            if (!Hash::check($request->current_password, $user->password)) {
                $message = trans('admin.profile.change-password.message.password_incorrect');
                $notification = [
                    'message' => $message,
                    'type' => 'danger',
                ];

                return back()->with('notification', $notification);
            }
            $this->userRepository->update(['password' => $request->password], $user);
            $message = trans('admin.profile.change-password.message.edit_success');
            $notification = [
                'message' => $message,
                'type' => 'success',
            ];

            return redirect()->route('user.profiles.show', ['id' => $user->id])->with('notification', $notification);
        }

        return redirect()->route('user.profiles.show', ['id' => $user->id]);
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
