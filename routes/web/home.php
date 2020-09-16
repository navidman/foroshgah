<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Gate;
use App\User;
use App\Product;


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
	Auth::loginUsingId('1');
	// $comment = \App\Comment::find(1);
	// return Product::withCount('comments')->get();
	return view('welcome');
	// $product = \App\Product::find(2);
	// // $product->comments()->create([
	// // 	'comment' => 'this is my second commnet',
	// // 	'user_id' => auth()->user()->id,
		
	// // ]);
	// return $product->comments()->get();
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



Route::prefix('profile')->namespace('Profile')->middleware('auth')->group(function(){

	Route::get('/', 'IndexController@index')->name('profile');
	Route::get('two-factor-auth', 'TwoFactorAuthController@manageTwoFactor')->name('two.factor.auth');
	Route::post('two-factor-auth', 'TwoFactorAuthController@postManageTwoFactor')->name('post.two.factor.auth');

	Route::get('two-factor/phone', 'TokenAuthController@getPhoneVerify')->name('two.factor.phone');
	Route::post('two-factor/phone', 'TokenAuthController@postPhoneVerify');
	Route::get('orders', 'OrderController@index')->name('profile.orders');
	Route::get('orders/{order}', 'OrderController@showDetails')->name('profile.orders.details');
	Route::get('orders/{order}/payment', 'OrderController@payment')->name('profile.orders.payment');
});

Route::middleware('auth')->group(function(){
	Route::prefix('profile')->namespace('Profile')->group(function(){

		Route::get('/', 'IndexController@index')->name('profile');
		Route::get('two-factor-auth', 'TwoFactorAuthController@manageTwoFactor')->name('two.factor.auth');
		Route::post('two-factor-auth', 'TwoFactorAuthController@postManageTwoFactor')->name('post.two.factor.auth');
		Route::get('two-factor/phone', 'TokenAuthController@getPhoneVerify')->name('two.factor.phone');
		Route::post('two-factor/phone', 'TokenAuthController@postPhoneVerify');
	});
	Route::post('comments', 'HomeController@comment')->name('send.comment');
	Route::post('payment', 'paymentController@payment')->name('cart.payment');
	Route::get('payment/callback', 'paymentController@callback')->name('payment.callback');
	
});




Route::get('product', 'ProductController@index');
Route::get('product/{product}', 'ProductController@single');
Route::post('cart/add/{product}', 'CartController@addToCart')->name('cart.add');

Route::get('cart', 'CartController@cart')->name('cart');
Route::patch('cart/quantity/change', 'CartController@quantityChange');
Route::delete('cart/delete/{cart}', 'CartController@deleteFromCart')->name('cart.destroy');
