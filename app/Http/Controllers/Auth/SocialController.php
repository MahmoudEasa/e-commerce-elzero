<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($service)
    {
        return Socialite::driver($service)->redirect();
    }

    public function callback($service)
    {
        return Socialite::driver($service)->user();
        // $facebookUser = Socialite::driver($service)->user();

        // $user = User::updateOrCreate([
        //     'facebook_id' => $facebookUser->id,
        // ], [
        //     'name' => $facebookUser->name,
        //     'email' => $facebookUser->email,
        //     'facebook_token' => $facebookUser->token,
        //     'facebook_refresh_token' => $facebookUser->refreshToken,
        // ]);

        // Auth::login($user);

        // return redirect('/dashboard');
    }
}