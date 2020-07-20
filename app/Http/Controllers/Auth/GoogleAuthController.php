<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Socialite;
use App\User;


class GoogleAuthController extends Controller
{

	use TwoFactorAuthenticate;

    public function redirect() {

    	return socialite::driver('google')->redirect();
    }
    public function callback(Request $request) {
    	try {
	    	$googleUser = Socialite::driver('google')->user();
			$user  = User::where('email',$googleUser->email)->first();

			if (! $user) {
				$user = User::create([
					'name' => $googleUser->name,
					'email' => $googleUser->email,
					'password' => bcrypt(\Str::random(16)),
					'two_factor_type' => 'off',
			    ]);
			}
			if (! $user->hasVerifiedEmail()) {
				
				$user->markEmailAsVerified();
			}



			auth()->LoginUsingId($user->id) ;	

			
			return $this->loggendin($request , $user) ?: redirect('/') ; 

    	} catch (\Exception $e) {
    		//TODO log gereftane error
    		alert()->error('ورود با گوگل موفق نبود!','Message')->persistent('بسیار خب!');
    		return redirect('/login');
    	}

    }
}
