<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\ActiveCode;
use Illuminate\Http\Request;
use App\Notifications\LoginToWebsiteNotification;
use App\Notifications\ActiveCodeNotification;




trait TwoFactorAuthenticate
{	
	public function loggendin(Request $request , $user) 
	{
		if ($user->userHasTwoFactorAuthenticatedEnabled()) 
		{
            
            return $this->logoutAndRedirectToTokenEntry($request , $user);

        }
        $user->notify(new LoginToWebsiteNotification());
        return false;
    }

    public function logoutAndRedirectToTokenEntry (Request $request , $user) {

        auth()->logout();
        $request->session()->flash('auth' , [
            'user_id' => $user->id,
            'user_sms' => false,
            'remember' => $request->has('remember'),
        ]);
        if ($user->hasSmsTwoFactorAuthenticatedEnabled()) {

            $code = ActiveCode::generateCode($user);
            //send sms
            $user->notify(new ActiveCodeNotification($code , $user->phone_number));
            $request->session()->push('auth.using_sms' , true);
        }
        return redirect(route('two.factor.auth.token'));
    }
}
