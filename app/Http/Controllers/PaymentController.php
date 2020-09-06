<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;

class PaymentController extends Controller
{
    public function payment()
    {
    	$cart = Cart::all();
    	if ($cart->count()) {
    		$price = $cart->sum(function($cart) {
    			return $cart['product']->price * $cart['quantity'];
    		});
    		 $orderItems = $cart->mapWithKeys(function($cart) {
               return [$cart['product']->id => [ 'quantity' => $cart['quantity']] ];
            });


    		$order = auth()->user()->orders()->create([
    			'status' => 'unpaid',
    			'price' => $price,
    		]);
    		$order->products()->attach($orderItems);
    		return 'ok';
    	}
    	return back();
    }
}
