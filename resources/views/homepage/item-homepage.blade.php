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
		width: 48%;
	}
	.view-item{
		float: left;
	}
	.buy-item{
		float: right;
	}
	.item:hover{
		cursor: pointer;
		opacity: 0.8;
		box-shadow: 0 3px 14px 2px rgba(0,0,0,.25);
	}
	.modal-dialog{
		width: 800px;
	}
	.modal-body{
		height: 350px;
	}
	.item-data{
		font-size: 18px;
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
				<div class="item" data-toggle="modal" data-target="#myModal{{$item->id}}">
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
						<input id="{{$item->id}}" type="button" class="btn btn-warning buy-item" disabled="disabled" value="Đã thêm"/>
						@else
						<input id="{{$item->id}}" type="button" class="btn btn-info buy-item" value="Thêm"/>
						@endif
					</div>
				</div>

				<!-- Modal -->
				<div class="modal fade" id="myModal{{$item->id}}" role="dialog">
					<div class="modal-dialog">

						<!-- Modal content-->
						<div class="modal-content">
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">&times;</button>
								<h3 class="modal-title"><b>{{$item->name}}</b></h3>
							</div>
							<div class="modal-body">
								<div class="col-md-5">
								<img src="{{env('APP_URL')}}/uploads/{{$item->image_src}}" height="300" width="300"/>
								</div>
								<div class="col-md-7 item-data">
									<p>Giá sản phẩm: {{$item->cost}} VND</p>
									<p>Loại: {{\App\Category::getCateNameByID($item->id_category)}}</p>
									<p>Kích cỡ: {{\App\Size::getSizeNameByID($item->id_size)}}</p>
								</div>
								
							</div>
							<div class="modal-footer">
								<input id="{{$item->id}}" type="button" class="btn btn-success view-item" data-toggle="modal" data-target="#myModal{{$item->id}}" value="Close"/>
								@if(\App\Cart::checkItemInCart($item->id))
								<input id="{{$item->id}}" type="button" class="btn btn-warning buy-item" disabled="disabled" value="Đã thêm vào giỏ"/>
								@else
								<input id="{{$item->id}}" type="button" class="btn btn-info buy-item" value="Thêm vào giỏ"/>
								@endif
							</div>
						</div>

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
				if(result == "Success"){
					_this.addClass('btn-warning');
					_this.removeClass('btn-info');
					_this.attr('disabled', 'disabled');
					_this.attr('value', 'Đã thêm');
					toastr.success('Sản phẩm của bạn đã được thêm vào giỏ hàng!', 'Item added to cart');
				}
				else{
					toastr.warning('Sản phẩm của bạn đã có trong giỏ hàng!', 'Item Existed');
				}
			},
			error : function(){
				toastr.error('Bạn cần đăng nhập để mua hàng!', 'Login Require');
			}
		});
		
	})
</script>