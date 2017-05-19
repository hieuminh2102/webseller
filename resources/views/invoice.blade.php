@extends('layouts.app')
<style>
    h1{
        text-align: center;
    }
    table{
        line-height: 30px;
    }
    .invoice-item{
        margin-top: 50px;
        border: 1px solid black;
    }
    .invoice-item th{
        text-align: center;
        border: 1px solid black;
    }
    .invoice-item td{
        padding-left: 5px;
        border: 1px solid black;
    }
    .invoice-item td:first-child,
    .invoice-item td:nth-child(3),
    .invoice-item td:nth-child(4){
        text-align: center
    }
    .invoice{
        margin: 30px 0px 30px 0px;
        padding: 50px 10px 50px 10px;
        background: white;
        border-radius: 4px;
    }
    .div-tong-tien{
        margin-top: 20px;
        font-size: 16px;
    }
    .tong-tien{
        color: red;
        font-weight: bold;
    }
</style>
@section('content')
<div class="container">
<div class="invoice col-md-12">
        <div class="col-md-12">
            <h1>Hóa Đơn</h1>
        </div>
        <div class="col-md-12">
            <table class="invoice-info col-md-12">
                <tbody>
                    <tr>
                        <td style="width:70%">
                            Tên khách hàng: {{$customer_info->name}}
                        </td>
                        <td style="width:30%">
                            Số hóa đơn: {{$invoice->id}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Địa chỉ: {{$customer_info->address}}
                        </td>
                        <td>
                            Shipper: {{$shipper_info->name}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Số điện thoại:{{$customer_info->phone}}
                        </td>
                        <td>
                            Số điện thoại: {{$shipper_info->phone}}
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Ngày mua hàng: {{$invoice->created_at}}
                        </td>
                        <td>
                            Tình trạng: {{$invoice->status}}
                        </td>
                    </tr>
                </tbody>
            </table>
            <table class="col-md-12 invoice-item">
                <tbody>
                    <tr>
                        <th style="width: 5%">STT</th>
                        <th style="width: 50%">Tên sản phẩm</th>
                        <th style="width: 20%">Số lượng</th>
                        <th style="width: 25%">Thành tiền</th>
                    </tr>
                    @foreach($item_list_invoice as $key=>$value)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{\App\Item::getNameItemByID($value->id_item)}}</td>
                        <td>{{$value->quatity}}</td>
                        <td><span class="item-sum">{{intval($value->quatity)* intval(\App\Item::getCostItemByID($value->id_item))}}</span> VND</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <div class="col-md-offset-9 col-md-3 div-tong-tien">
                    Tổng tiền: <span class="tong-tien"></span>
            </div>
        </div>
    </div>
    
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
    var sum_val = 0;
    $.map($('.item-sum'), function(e){
        sum_val += parseInt($(e).text().replace(' VND', ''));
    });
    $('.tong-tien').text(sum_val + ' VND');
</script>
@endsection
