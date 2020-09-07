<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Str;
use App\Payment;

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


    		
    		$token = config('services.payping.token');
    		$res_number = Str::random();
			$args = [
			    "amount" => 1000,
			    "payerName" => auth()->user()->name,
			    "returnUrl" => route('payment.callback'),
			    "clientRefId" => $res_number
			];

			$payment = new \PayPing\Payment($token);

			try {
			    $payment->pay($args);
			} catch (\Exception $e) {
			    throw $e;
			}
			//echo $payment->getPayUrl();

			$order->payments()->create([
				'resnumber' => $res_number,
				'price' => $price
			]);
			Cart::flush();

			return redirect($payment->getPayUrl());
    	}
    	return back();
    }

    public function callback(Request $request) 
    {
    	$payment = Payment::where('resnumber', $request->clientrefid)->firstOrFail();
    	$token = config('services.payping.token');

		$payping = new \PayPing\Payment($token);

		try {
		    if($payping->verify($request->refid, 1000)){
		    	$payment->update([
		    		'status' => 1
		    	]);
		    	$payment->order->update([
		    		'status' => 'paid'
		    	]);
		    	alert()->success('پرداخت شما موفق بود.');
		    	return redirect('/product');
		    }else{
		        alert()->error('پرداخت شما تایید نشد.');
		        return redirect('/product');
		    }
		} catch (\Exception $e) {
			$errors = collect(json_decode($e->getMessage(), true));
			alert()->error($errors->first());
		    return redirect('/product');
		}
    }
}
