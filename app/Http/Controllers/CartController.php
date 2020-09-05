<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function cart() 
    {
        return view('home.cart');
    }

    public function addToCart(Product $product) 
    {
    	if (! Cart::has($product)) {
    		Cart::put(
    			[
	    			'quantity' => 1,
	    			'price' => $product->price
    			],
    			$product
    		);
    	}
        return 'ok';
    }
   


}
