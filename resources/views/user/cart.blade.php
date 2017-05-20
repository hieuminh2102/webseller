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
		width: 220px;
		font-size: 16px;
		margin: 0px 10px;
		float: left;
		border-right: 1px solid rgba(43, 20, 20, 0.15);
	}
	img.item-img{
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
	.calculate, .sum-val{
		color: red;
		font-weight: bold;
	}
	.sum-val{
		font-size: 18px;
	}
	.buy-more{
		zoom: 2.0;
	}
	.buy-less{
		margin-top: -3px;
	}
</style>
<link rel="stylesheet" type="text/css" href="/css/sweetalert.css">
@section('content')
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script src="/js/sweetalert.min.js"></script>

<div class="container">
	<div class="col-md-12" style="background: white;">
		<div class="panel" style="border-bottom: 3px solid rgba(0, 0, 0, 0.21); margin-bottom: 20px;">
			<h3>Giỏ hàng</h3>
		</div>
		@foreach($item_in_cart as $key=>$value)
		<div class="cart-item">
			<div class="item-info">
				<p class="priority">{{$key+1}}. </p>
				<div>
					<img class="item-img" src="{{env('APP_URL')}}/uploads/{{$value->image_src}}" height="150" width="150">
					<p class="item-data">Tên: {{$value->name}}
						<br>
						Giá sản phẩm: {{$value->cost}} VND
						<br>
						Loại: {{\App\Category::getCateNameByID($value->id_category)}}
						<br>
						Kích cỡ: {{\App\Size::getSizeNameByID($value->id_size)}}
					</p>
				</div>
				<p style="float:left; margin-top: 60px"><span style="font-size: 16px;">Số lượng: </span><input id="{{$value->id}}" type="text" value="{{$value->buy_quatity}}" class="number-item quatity-{{$key}}"/>
					<img class="buy-more" id="more-{{$key}}" src="/images/addcontent.png" height="16" width="16">
					<img class="buy-less" id="less-{{$key}}" src="/images/removecontent.png" height="16" width="16">
				</p>
				<p class="sum-price">Thành tiền: <span class="calculate calculate-{{$key}}"></span></p>
				<input id="cost_{{$key}}" class="hidden" value="{{$value->cost}}"/>
				<input id="quatity-{{$key}}" class="hidden" value="{{$value->buy_quatity}}"/>
			</div>
		</div>
		<script>
			var item_cost_{{$key}} = parseInt($('#cost_{{$key}}').val());
			var first_quatity_{{$key}} = parseInt($('#quatity-{{$key}}').val());
			var first_cost_{{$key}} = item_cost_{{$key}}*first_quatity_{{$key}};

			$('.calculate-{{$key}}').text(first_cost_{{$key}} + " VND");

			$('.buy-more#more-{{$key}}').click(function(){
				$(this).prev().val(parseInt($(this).prev().val()) + 1);
				updateCost{{$key}}({{$key}}, $(this));
				sumVal();
			});

			$('.buy-less#less-{{$key}}').click(function(){
				if($(this).prev().prev().val() >0){
					$(this).prev().prev().val(parseInt($(this).prev().prev().val()) - 1);
				}
				updateCost{{$key}}({{$key}}, $(this));
				sumVal();
			});

			function updateCost{{$key}}(key, selected){
				var item_number = parseInt($('.quatity-' + key).val());
				console.log({item_cost_{{$key}}});
				selected.parent().next().children().text(item_cost_{{$key}}*item_number + " VND");
			}
		</script>
		@endforeach
		<div class="col-md-12 btn-request">
			<div class="col-md-offset-10">
				<p >Tổng: <span class="sum-val"></span></p>
				<a href="#" class="btn btn-info order-item" style="float:right;">Đặt hàng</a>
			</div>
			
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		sumVal();
	});

	function sumVal(){
		var sum_val = 0;
		$.map($('.calculate'), function(e){
			sum_val += parseInt($(e).text().replace(' VND', ''));
		});
		$('.sum-val').text(sum_val + ' VND');
	}

	$('.order-item').click(function(){
		postInvoiceData();
		swal({
			title: "Đặt hàng thành công",
			text: "Click OK để đi tới đơn vừa đặt",
			type: "success",
		},
		function(isConfirm){
			if (isConfirm) {
				console.log('click OK');
			}
		});
	});

	function postInvoiceData(){
		var id_with_number = "";
		$.map($('.number-item'), function(e){
			id_with_number += $(e).attr('id') + ',';
			id_with_number += $(e).val() + '|';
		});
		console.log(id_with_number);
		$.ajax({
			url: '/cart-setting/order',
			type: "POST",
			data: { id_number: id_with_number},
			success: function(){
			}
		});
	}
</script>
@endsection
