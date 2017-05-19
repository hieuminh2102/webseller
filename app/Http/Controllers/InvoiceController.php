<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InvoiceController extends Controller
{
    public function getInvoice($id){
    	$invoice = \App\Invoice::where('invoices.id', $id)
    							->join('statuses', 'statuses.id', '=', 'invoices.id_status')
    							->first();
    	if($invoice){
    		$item_list_invoice = \App\ItemInvoice::where('id_invoice', $id)->get();
    		$customer_info = \App\User::where('id', $invoice->id_customer)->first();
    		$shipper_info = \App\User::where('id', $invoice->id_shipper)->first();

    		return view('invoice', compact('invoice', 'item_list_invoice', 'customer_info', 'shipper_info'));
    	}
    	return "Đơn hàng không tồn tại";
    }
}