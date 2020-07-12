<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ActiveCode;

class ProfileController extends Controller
{
    public function index() {

    	return view('profile.index');
    }


    public function manageTwoFactor() {

    	return view('profile.two-factor-auth');
    }


    public function postManageTwoFactor(Request $request) {

    	$data = $request->validate([
    		'type' => 'required|in:sms,off',
    		'phone' => 'required_unless:type,off'
    	]);
    	if($data['type'] === 'sms') {
    		if ($request->user()->phone_number !== $data['phone']) {
    			//create a new code
    			$code = ActiveCode::generateCode($request->user());
    			$request->session()->flash('phone',$data['phone']);
    			
    			//send the code to user phone number

    			//send sms

    			return redirect(route('two.factor.phone'));

    		} else {
    			$request->user()->update([
    				'two_factor_type' => 'sms'
    			]);
    		}
    	}


    	if($data['type'] === 'off') {
    		$request->user()->update([
    			'two_factor_type' => 'off'
    		]);
    	}

    	return back();
    }


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
    		alert()->error('ریییدی','دفه بعدی ماشالا');
    	}

    	return redirect(route('two.factor.auth')); 

    }
}
