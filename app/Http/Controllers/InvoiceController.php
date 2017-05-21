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
            if(!\Auth::user()){
                return redirect('/');
            }
            else{
                if(\Auth::user()->id_user_type == 3){
                    if($invoice->id_customer != \Auth::id())
                        return redirect('/');
                }

                $item_list_invoice = \App\ItemInvoice::where('id_invoice', $id)->get();
                $customer_info = \App\User::where('id', $invoice->id_customer)->first();
                $shipper_info = \App\User::where('id', $invoice->id_shipper)->first();

                return view('invoice', compact('invoice', 'item_list_invoice', 'customer_info', 'shipper_info'));
            }
    		
    	}
    	return "Đơn hàng không tồn tại";
    }

    public function getListInvoice(){
        if(!\Auth::user()){
            return redirect('/');
        }
        else{
            if(\Auth::user()->id_user_type == 4){
                $invoices = \App\Invoice::where('invoices.id_shipper', \Auth::id());
            }
            else{
                $invoices = \App\Invoice::where('invoices.id_customer', \Auth::id());
            }
        }
        
        $grid = \DataGrid::source($invoices);

        
        $grid->add('{{"Hóa đơn số ". $id}}', 'Số hóa đơn')->link = '{{("/invoice-info/invoice/".$id)}}';
        $grid->add('{{\App\User::getUsernameByID($id_shipper)}}', 'Shipper');
        $grid->add('id_status', 'Trạng thái');
        $grid->add('created_at', 'Ngày tạo');
        $grid->row(function ($row){
            switch ($row->cell('id_status')->value) {
                case '1':
                    if(\Auth::user()->id_user_type == 4){
                        $row->cell('id_status')->value = "<a href='#' id='{$row->data->id}' class='update-status'>Mới đặt</a><span class='message'></span>";
                    }
                    else{
                        $row->cell('id_status')->value = "Mới đặt";
                    }
                    break;
                case '2':
                    if(\Auth::user()->id_user_type == 4){
                        $row->cell('id_status')->value = "<a href='#' id='{$row->data->id}' class='update-status'>Đang vận chuyển</a><span class='message'></span>";
                    }
                    else{
                        $row->cell('id_status')->value = "Đang vận chuyển";
                    }
                    break;
                case '3':
                    $row->cell('id_status')->value = "Hoàn thành";
                    break;
            }
        });
        return view('list_invoice', compact('grid', 'invoices'));
    }

    public function getUpdateInvoice($id_invoice){
        $invoice = \App\Invoice::find($id_invoice);
        if(!$invoice)
            return "Invoice Not Found";
        $return_mess = "";
        switch ($invoice->id_status) {
            case '1':
                $return_mess = "Đang vận chuyển";
                break;
            case '2':
                $return_mess = "Hoàn thành";
                break;
            default:
                break;
        }
        if($invoice->id_status == 3){
            return "Hoàn Thành";
        }
        $invoice->id_status = $invoice->id_status + 1;
        $invoice->save();
        return $return_mess;
    }
}