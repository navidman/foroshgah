<?php

namespace App\Http\Controllers\Auth;
use App\User;
use App\ActiveCode;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthTokenController extends Controller
{

    public function getToken(Request $request) {

    	if (! $request->session()->has('auth')) {

    		return redirect(route('login'));
    	}

    	$request->session()->reflash();

    	return view('auth.token');
    }


    public function postToken(Request $request) {
    	$request->validate([
    		'token' => 'required'
    	]);

    	if (! $request->session()->has('auth')) {

    		return redirect(route('login'));
    	}

    	$user = User::findOrFail($request->session()->get('auth.user_id'));

    	$status = ActiveCode::verifyCode($request->token , $user);

    	if (! $status) {
    		alert()->error('ریییدی','دفه بعدی ایشالا');
    		return redirect(route('login'));
    	}

    	if (auth()->loginUsingId($user->id,$request->session()->get('auth.remember'))) {
			$user->activeCode()->delete();
			alert()->success('ایشالا که ماشالا','باریکلا');
			return redirect('/');	
    	}


    	return redirect(route('login'));

    }



}
