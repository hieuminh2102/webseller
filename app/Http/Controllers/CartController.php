<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class CartController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth');
    }

    public function anyViewCart(){
    	$item_in_cart = \App\Cart::where('carts.user_id', \Auth::id())
    					->join('items', 'items.id', '=', 'carts.item_id')
    					->get(['carts.quatity as buy_quatity', 'carts.id as cart_id',
    							'items.name', 'items.cost', 'items.id_category',
    							'items.id_size', 'items.image_src']);
    	return view('user.cart', compact('item_in_cart'));
    }

    public function anyAddCart($item_id){
    	$cart = new \App\Cart();
    	$cart->user_id = \Auth::id();
    	$cart->item_id = $item_id;
    	$cart->quatity = 1;
    	$cart->save();
    	return "Success";
    }
}
