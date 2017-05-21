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
    	$item_in_cart = \App\Cart::getCart();
    	return view('user.cart', compact('item_in_cart'));
    }

    public function anyAddCart($item_id){
        $in_cart_item = \App\Cart::where('user_id', \Auth::id())
                                    ->where('item_id', $item_id)->first();
        if(!$in_cart_item){
            $cart = new \App\Cart();
            $cart->user_id = \Auth::id();
            $cart->item_id = $item_id;
            $cart->quatity = 1;
            $cart->save();
            return "Success";
        }
    	return "Exist";
    }

    public function getRemoveItem($id_item){
        $item = \App\Cart::where('user_id', \Auth::id())
                            ->where('item_id', $id_item)->first();
        if($item){
            $item->delete();
            return "Success";
        }
        return "Fail";
    }

    public function anyOrder(){
        $id_with_number_item = \Request::input('id_number');
        $item_in_carts = array_filter(explode('|', $id_with_number_item));
        foreach($item_in_carts as $item){
            $item_info = explode(',', $item);
            $item = \App\Item::find($item_info[0]);
            if($item->quatity < $item_info[1]){
                $item_info_name = "Sản phẩm ". \App\Item::getNameItemByID($item_info[0]) . " không đủ số lượng, chỉ còn "
                                . $item->quatity . " sản phẩm";
                return $item_info_name;
            }
        }

        $invoice = new \App\Invoice();
        $invoice->id_customer = \Auth::id();
        $invoice->id_status = 1;
        $invoice->id_shipper = 9;
        $invoice->save();

        $newest_invoice = \App\Invoice::orderBy('created_at', 'desc')->first();

        
        foreach($item_in_carts as $item){
            $item_info = explode(',', $item);
            $new_row_item_invoice = new \App\ItemInvoice();
            $new_row_item_invoice->id_invoice = $newest_invoice->id;
            $new_row_item_invoice->id_item = $item_info[0];
            $new_row_item_invoice->quatity = $item_info[1];
            $this->updateQuatityItem($item_info[0], $item_info[1]);
            $new_row_item_invoice->save();
        }

        $this->deleteCart();
        return "Success";
    }

    public function deleteCart(){
        $item_in_cart = \App\Cart::where('user_id', \Auth::id())->get();
        foreach($item_in_cart as $item){
            $item->delete();
        }
    }

    public function updateQuatityItem($id_item, $buy_quatity){
        $item = \App\Item::find($id_item);
        if(!$item){
            return "Item Not Found";
        }
        $item->quatity = $item->quatity - $buy_quatity;
        $item->save();
        return "Update Quatity Done";
    }
}
