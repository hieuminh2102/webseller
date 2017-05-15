@extends('layouts.app')
<style type="text/css">
	.cart-item{
		margin: 0px 20px 10px 20px;
		height: 175px;
		border: 1px solid rgba(76, 175, 80, 0.38);
		border-radius: 10px;
	}
	.cart-item:hover{
		cursor: pointer;
		opacity: 0.8;
		box-shadow: 0 3px 14px 2px rgba(0,0,0,.25);
	}
	p.priority{
		line-height: 150px;
		float: left;
		margin: 0px 0px;
		font-weight: bold;
		font-size: 20px;
		border-right: 1px solid rgba(43, 20, 20, 0.15);
	}
	p.item-data{
		height: 150px;
		font-size: 16px;
		margin: 0px 10px;
		float: left;
		border-right: 1px solid rgba(43, 20, 20, 0.15);
	}
	img{
		border: 2px double rgba(158, 158, 158, 0.57)!important;
		margin-left: 20px;
		float: left;
	}
	.item-info{
		padding: 10px;
	}
	.quatity{
		margin-top: 60px;
		font-size: 16px;
		margin-right: 10px;
	}
	.sum-price{
		margin: 0px 20px 0px 20px;
		padding-left: 20px;
		font-size: 16px;
		float: left;	
		line-height: 150px;
		border-left: 1px solid rgba(43, 20, 20, 0.15);
	}
	.btn-request{
		margin-top: 10px;
		margin-bottom: 20px;
	}
</style>
@section('content')
<div class="container">
	<div class="col-md-12" style="background: white;">
		<div class="panel" style="border-bottom: 3px solid black; margin-bottom: 20px;">
			<h3>Giỏ hàng</h3>
		</div>
		@foreach($item_in_cart as $key=>$value)
		<div class="cart-item">
			<div class="item-info">
				<p class="priority">{{$key+1}}. </p>
				<div>
					<img src="{{env('APP_URL')}}/uploads/{{$value->image_src}}" height="150" width="150">
					<p class="item-data">Tên: {{$value->name}}
						<br>
						Giá sản phẩm: {{$value->cost}} VND
						<br>
						Loại: {{\App\Category::getCateNameByID($value->id_category)}}
						<br>
						Kích cỡ: {{\App\Size::getSizeNameByID($value->id_size)}}
					</p>
				</div>
				<p style="float:left"><span style="font-size: 16px;">Số lượng: </span><input type="text" value="{{$value->buy_quatity}}" class="quatity"/></p>
				
				<p class="sum-price">Thành tiền: <span class="calculate">100</span></p>
			</div>
		</div>
		@endforeach
		<div class="col-md-12 btn-request">
			<a href="#" class="btn btn-info col-md-offset-11">Đặt hàng</a>
		</div>
	</div>
	
	
</div>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

@endsection
