<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    public function login()
    {
        return Socialite::driver('hatena')->redirect();
    }

    public function callback(Request $request)
    {
        if (! $request->has('oauth_verifier')) {
            return redirect('/');
        }

        /**
         * @var \Laravel\Socialite\One\User $user
         */
        $user = Socialite::driver('hatena')->user();

        /**
         * @var \App\Models\User $loginUser
         */
        $loginUser = User::updateOrCreate([
            'name' => $user->id,
        ], [
            'access_token' => $user->token,
            'token_secret' => $user->tokenSecret,
        ]);

        auth()->login($loginUser, true);

        return redirect('home');
    }

    public function logout()
    {
        auth()->logout();

        return redirect('/');
    }
}
