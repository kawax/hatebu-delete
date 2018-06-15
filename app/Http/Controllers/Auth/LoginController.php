<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Socialite;

use App\Model\User;

class LoginController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('guest')->except('login', 'logout');
    }

    public function login()
    {
        return Socialite::driver('hatena')->redirect();
    }

    public function callback(Request $request)
    {
        if (!$request->has('oauth_verifier')) {
            return redirect('/');
        }

        /**
         * @var \Laravel\Socialite\One\User $user
         */
        $user = Socialite::driver('hatena')->user();

        /**
         * @var \App\Model\User $loginUser
         */
        $loginUser = User::updateOrCreate(
            [
                'name' => $user->id,
            ],
            [
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
