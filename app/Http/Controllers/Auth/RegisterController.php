<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\UserActivation;
use App\Http\Controllers\Controller;
use App\Http\Requests\RegisterRequest;
use App\Jobs\SendVerificationEmail;
use App\Repositories\Contracts\UserRepositoryInterface;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
    protected $userRepository;

    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/admin';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(UserRepositoryInterface $userRepository)
    {
        $this->middleware('guest');
        $this->userRepository = $userRepository;
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        return DB::transaction(function () use ($data) {
            $user = $this->userRepository->create([
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => $data['password'],
            ]);

            $user->userActivation()->create([
                'token' => str_random(25),
            ]);

            return $user;
        });
    }

    /**
     * Handle a registration request for the application.
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function register(RegisterRequest $request)
    {
        $user = $this->create($request->all());
        event(new Registered($user));
        dispatch(new SendVerificationEmail($user));

        return redirect()->back()->with('register_status', trans('auth.register_successfully'));
    }

    public function resendConfirmLink(Request $request)
    {
        $email = base64_decode($request->basecode);
        $user = $this->userRepository->findByField('email', $email)->get()->first();
        if ($user && !$user->is_actived) {
            $token = str_random(25);
            $userActivation = $user->userActivation ?: new UserActivation;
            $userActivation->token = $token;
            $user->userActivation()->save($userActivation);
            dispatch(new SendVerificationEmail($user));

            return redirect()->back()->with('confirm', trans('auth.confirm_resent'));
        } else {
            return view('errors.404');
        }
    }

    /**
     * Handle a registration request for the application.
     * 
     * @param $token
     * @return \Illuminate\Http\Response
     */
    public function verify($token)
    {
        $userActivation = UserActivation::where('token', $token)->first();
        if (isset($userActivation)) {
            $user = $userActivation->user;
            if (!$user->is_actived) {
                $this->userRepository->update(['is_actived' => config('setting.users.actived')], $user);
                $status = trans('auth.verify_successfully');
            } else {
                $status = trans('auth.already_verified');
            }

            return redirect()->route('login')->with('confirm', $status);
        }

        return view('errors.404');
    }
}
