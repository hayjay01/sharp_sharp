<?php

namespace App\Http\Controllers;

use SocialAuth;

use Illuminate\Http\Request;

class SocialAuthController extends Controller
{
    public function auth($provider)
    {
        return SocialAuth::authorize($provider);
    }

    public function auth_callback($provider)
    {
        SocialAuth::login($provider, function($user, $details) {

            //dd($details);

            // $user->avater = $details->avatar;

            $user->email = $details->email;

            $user->name = $details->full_name; 

            $user->save();

        });

        return redirect('/user/dashboard');
    }

}
