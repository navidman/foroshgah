<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActiveCode;
use App\Notifications\ActiveCodeNotification;
use Illuminate\Validation\Rule;

class TokenAuthController extends Controller
{
    public function getPhoneVerify(Request $request) {
    	
    	if (! $request->session()->has('phone')) {
    		
    		return redirect(route('two.factor.auth'));
    	}
    	$request->session()->reflash();
    	return view('profile.phone-verify');
    }


    public function postPhoneVerify(Request $request) {
    	$request->validate([
    		'token' => 'required'
    	]);
    	if (! $request->session()->has('phone')) {

    		return redirect(route('two.factor.auth'));
    	}


    	

    	$status = ActiveCode::verifyCode($request->token , $request->user());


    	if ($status) {
    		$request->user()->ActiveCode()->delete();
    		$request->user()->update([
    			'phone_number' => $request->session()->get('phone'),
    			'two_factor_type' => 'sms'
    		]);
    		alert()->success('باریکلا','ایشالا که ماشالا');
    	} else {
    		alert()->error('ریییدی','دفه بعدی ایشالا');
    	}

    	return redirect(route('two.factor.auth')); 
}
