<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function Callback(Request $request,$provider)
    {


        $request->session()->regenerate();

        $userSocial =   Socialite::driver($provider)->stateless()->user();
        $users       =   User::where(['email' => $userSocial->getEmail()])->first();
        if($users){
            Auth::login($users);

            return redirect()->route('home');
        }else{
            $user = User::create([
                'full_name'          => $userSocial->getName(),
                'email'         => $userSocial->getEmail(),
                'photo'         => $userSocial->getAvatar(),
                'image_path'         => $userSocial->getAvatar(),
                'provider_id'   => $userSocial->getId(),
                'provider'      => $provider,
            ]);
            Auth::login($user);
            return redirect()->route('user.dashboard');
        }
    }
}
