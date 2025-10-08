<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleAuth extends Controller
{
    public function redirectGoogle(Request $request){
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(){
        $googleUser = Socialite::driver('google')->stateless()->user();
        $username = Str::slug($googleUser->getName());
        $avatar = $googleUser->getAvatar();


        dd($googleUser);

        return redirect()->intended('/');
    }
}
