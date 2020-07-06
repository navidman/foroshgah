<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
    	return $data;
    }
}
