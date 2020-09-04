<?php

namespace App\Http\Controllers;

use App\Helpers\Cart\Cart;
use App\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Product $product) 
    {
    	Cart::put(
    		[
    			'quantity' => 1,
    			'price' => $product->price
    		]
    	);
    	return 'ok';
    }
}
