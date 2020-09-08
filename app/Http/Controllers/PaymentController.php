<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Str;
use App\Payment;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;
use Shetabit\Multipay\Exceptions\InvalidPaymentException;


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


			// Create new invoice.
			// $invoice = (new Invoice)->amount($price);
			$invoice = (new Invoice)->amount(1000);
			// Purchase and pay the given invoice.
			// You should use return statement to redirect user to the bank page.
			return ShetabitPayment::callbackUrl(route('payment.callback'))->purchase($invoice, function($driver, $transactionId) use($order , $cart, $invoice) {
			    // Store transactionId in database as we need it to verify payment in the future.
			    $order->payments()->create([
					'resnumber' => $invoice->getUuid(),
				]);
				Cart::flush();
			})->pay()->render();
		}
    	return back();
    }

    public function callback(Request $request) 
    {
    	$payment = Payment::where('resnumber', $request->clientrefid)->firstOrFail();



    	// amount($payment->order->price)
    	try {
			$receipt = ShetabitPayment::amount(1000)->transactionId($request->clientrefid)->verify();
			$payment->update([
	    		'status' => 1
	    	]);
	    	$payment->order->update([
	    		'status' => 'paid'
	    	]);
	    	alert()->success('پرداخت شما موفق بود.');
	    	return redirect('/product');
		    
		} catch (InvalidPaymentException $exception) {
		    /**
		    	when payment is not verified, it will throw an exception.
		    	We can catch the exception to handle invalid payments.
		    	getMessage method, returns a suitable message that can be used in user interface.
		    **/

		    alert()->error($exception->getMessage());
		    return redirect('/product');
		}

    }
}
