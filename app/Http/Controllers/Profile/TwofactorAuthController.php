<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\ActiveCode;
use App\Notifications\ActiveCodeNotification;
use Illuminate\Validation\Rule;

class TwofactorAuthController extends Controller
{
    public function manageTwoFactor() {

		return view('profile.two-factor-auth');
    }


    public function postManageTwoFactor(Request $request) {

    	$data = $this->validateRequestData($request);
    	if($this->isRequestTypeSms($data)) {
    		if ($request->user()->phone_number !== $data['phone']) {
    			

    		} else {
    			$request->user()->update([
    				'two_factor_type' => 'sms'
    			]);
    		}
    	}


    	if($this->isRequestTypeOff($data)) {
    		$request->user()->update([
    			'two_factor_type' => 'off'
    		]);
    	}

    	return back();
    }

    public function validateRequestData(Request $request) {
    	$data = $request->validate([
    		'type' => 'required|in:sms,off',
    		'phone' => ['required_unless:type,off',Rule::unique('users' , 'phone_number')->ignore($request->user()->id)]
    	]);
    	return $data;
    }

    public function isRequestTypeSms($data): bool {
    	return $data['type'] === 'sms';
    }

    public function isRequestTypeOff($data):bool {
    	return $data['type'] === 'off';
    }

    public function createCodeAndSms(Request $request , $data) {
		$request->session()->flash('phone',$data['phone']);

    	//create a new code
		$code = ActiveCode::generateCode($request->user());

		//send sms
        $request->user()->notify(new ActiveCodeNotification($code,$data['phone']));

		return redirect(route('two.factor.phone'));
    }

}
