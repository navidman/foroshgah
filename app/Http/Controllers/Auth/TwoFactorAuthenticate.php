<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\ActiveCode;
use Illuminate\Http\Request;


trait TwoFactorAuthenticate
{	
	public function loggendin(Request $request , $user) 
	{
		if ($user->userHasTwoFactorAuthenticatedEnabled()) 
		{
            
            auth()->logout();
            $request->session()->flash('auth' , [
                'user_id' => $user->id,
                'user_sms' => false,
                'remember' => $request->has('remember'),
            ]);
            if ($user->two_factor_type == 'sms') {

                $code = ActiveCode::generateCode($user);
                $request->session()->push('auth.using_sms' , true);
            }
            return redirect(route('two.factor.auth.token'));

        }
        return false;
    }
}