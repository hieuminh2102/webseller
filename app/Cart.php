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
}
