<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\order;
use Shetabit\Multipay\Invoice;
use Shetabit\Payment\Facade\Payment as ShetabitPayment;


class OrderController extends Controller
{
    public function index()
    {
    	$orders = auth()->user()->orders()->latest('created_at')->paginate(10);
    	return view('profile.orders-list', compact('orders'));
    }

    public function showDetails(Order $order)
    {
    	$this->authorize('view', $order);
    	return view('profile.order-details', compact('order'));
    }

    public function payment(Order $order) 
    {
    	$this->authorize('view', $order);

    	// amount($order->price)
    	$invoice = (new Invoice)->amount(1000);
		// Purchase and pay the given invoice.
		// You should use return statement to redirect user to the bank page.
		return ShetabitPayment::callbackUrl(route('payment.callback'))->purchase($invoice, function($driver, $transactionId) use($order, $invoice) {
		    // Store transactionId in database as we need it to verify payment in the future.
		    $order->payments()->create([
				'resnumber' => $invoice->getUuid(),
			]);
		})->pay()->render();
    }
}
