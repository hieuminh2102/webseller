<style type="text/css">
	ul li{
		list-style-type: none;
	}
	i, label{
		color:white;
		font-size: 20px;
		line-height: 35px;
		padding: 10px 20px;
	}
	.item{
		width: 150px;
		height: auto;
		border-radius: 2px;
		float: left;
		margin-left: 52px;
	}
	.view-item,
	.buy-item{
		margin-top: 3px;
		width: 49%;
	}
	.item:hover{
		cursor: pointer;
		opacity: 0.8;
		box-shadow: 0 3px 14px 2px rgba(0,0,0,.25);
	}
</style>
<link href="/css/toastr.min.css" rel="stylesheet">
<div style="width: 100%;">
	<div style="background: gray;">
		<label>{{$title}}</label>
		<a data-toggle="collapse" href="#item-{{$type}}">
			<i class="fa fa-minus-square-o" aria-hidden="true" style="float:right; line-height: 38px;"></i>
		</a>
	</div>
	<div id="item-{{$type}}" class="collapse in col-md-12" style="background: white; padding: 10px 0px">
		<ul>
			@foreach($items as $item)
			<li>
				<div class="item">
					<img src="{{env('APP_URL')}}/uploads/{{$item->image_src}}" height="150" width="150"/>
					<div style="text-align: center;">
						<div style="background: orange; width: 100%">
							<b style="color: white;">{{$item->name}}</b>
						</div>
						<div style="background: orange; width: 100%">
							<b style="color: white;">{{$item->cost}} VND</b>
						</div>
						<input id="{{$item->id}}" type="button" class="btn btn-success view-item" value="Xem"/>
						@if(\App\Cart::checkItemInCart($item->id))
						<input id="{{$item->id}}" type="button" class="btn btn-warning buy-item" disabled="disabled" value="Đã mua"/>
						@else
						<input id="{{$item->id}}" type="button" class="btn btn-info buy-item" value="Mua"/>
						@endif
					</div>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script type="text/javascript" src="/js/toastr.min.js"></script>
<script>
	$('.buy-item').click(function(event){
		var _this = $(this);
		event.stopImmediatePropagation();
		$.ajax({
			url: '/cart-setting/add-cart/' + $(this).attr('id'),
			type: "GET",
			success : function(result){
				_this.addClass('btn-warning');
				_this.removeClass('btn-info');
				_this.attr('disabled', 'disabled');
				_this.attr('value', 'Đã mua');
				toastr.success('Sản phẩm của bạn đã được thêm vào giỏ hàng!', '');
			},
			error : function(){
				toastr.error('Bạn cần đăng nhập để mua hàng!', '');
			}
		});
		
	})
</script>