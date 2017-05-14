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
						<input type="button" class="btn btn-success view-item" value="Xem"/>
						<input type="button" class="btn btn-info buy-item" value="Mua"/>
					</div>
				</div>
			</li>
			@endforeach
		</ul>
	</div>
</div>