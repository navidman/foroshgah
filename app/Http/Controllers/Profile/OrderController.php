<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\order;
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
}
