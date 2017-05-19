<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    public static function checkItemInCart($item_id){
    	$user_item_in_cart = \App\Cart::where('user_id', \Auth::id())
    									->lists('item_id')->toArray();
    	if(in_array($item_id, $user_item_in_cart)){
    		return true;
    	}
    	return false;
    }

    public static function getCart(){
    	$item_in_cart = \App\Cart::where('carts.user_id', \Auth::id())
    					->join('items', 'items.id', '=', 'carts.item_id')
    					->get(['carts.quatity as buy_quatity', 'carts.id as cart_id',
    							'items.name', 'items.cost', 'items.id_category',
    							'items.id_size', 'items.image_src', 'items.id']);
    	return $item_in_cart;
    }
}
