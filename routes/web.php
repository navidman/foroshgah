<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Auth::routes(['verify' => true]);
Route::get('/auth/google','Auth\GoogleAuthController@redirect')->name('auth.google');
Route::get('/auth/google/callback','Auth\GoogleAuthController@callback');
Route::get('/auth/token','Auth\AuthTokenController@getToken')->name('two.factor.auth.token');
Route::post('/auth/token','Auth\AuthTokenController@postToken');



Route::get('/home', 'HomeController@index')->name('home');
Route::get('/secret', function() {
	return "secret";
})->middleware(['auth','password.confirm']);



Route::middleware('auth')->group(function(){

	Route::get('profile', 'ProfileController@index')->name('profile');
	Route::get('profile/two-factor-auth', 'ProfileController@manageTwoFactor')->name('two.factor.auth');
	Route::post('profile/two-factor-auth', 'ProfileController@postManageTwoFactor')->name('post.two.factor.auth');

	Route::get('profile/two-factor/phone', 'ProfileController@getPhoneVerify')->name('two.factor.phone');
	Route::post('profile/two-factor/phone', 'ProfileController@postPhoneVerify');
});