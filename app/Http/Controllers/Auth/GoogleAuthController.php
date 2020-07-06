<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\User;


class GoogleAuthController extends Controller
{
    public function redirect() {

    	return socialite::driver('google')->redirect();
    }
    public function callback() {
    	try {
	    	$googleUser = Socialite::driver('google')->user();
			$user  = User::where('email',$googleUser->email)->first();

			if ($user) {
			 	auth()->LoginUsingId($user->id) ;			
			}else {
				$newUser = User::create([
					'name' => $googleUser->name,
					'email' => $googleUser->email,
					'password' => bcrypt(\Str::random(16)),
			    ]);
				auth()->LoginUsingId($newUser->id) ;
			}
			return redirect('/'); 

    	} catch (\Exception $e) {
    		alert()->error('ورود با گوگل موفق نبود!','Message')->persistent('بسیار خب!');
    		return redirect('/login');
    	}

    }
}
