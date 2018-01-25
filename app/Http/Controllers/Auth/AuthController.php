<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Auth;
use Socialite;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function redirectToProvider($provider)
    {
        try {
            return Socialite::driver($provider)->redirect();
        } catch (\Exception $e) {
            return view('public.404');
        }
    }

    public function handleProviderCallback($provider)
    {
        try {
            $user = Socialite::driver($provider)->user();
            $authUser = $this->findOrCreateUser($user, $provider);
            Auth::login($authUser, true);
        } catch (\Exception $e) {
            return redirect()->route('home');
        }

        return redirect()->route('admin.home');
    }

    public function findOrCreateUser($user, $provider)
    {
        $authUser = User::where('provider_id', $user->id)->first();

        if ($authUser) {
            return $authUser;
        }

        return User::create([
            'name' => $user->name,
            'provider' => $provider,
            'provider_id' => $user->id,
        ]);
    }
}
