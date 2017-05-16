@extends('layouts.app')
<style>
    .side-bar{
        background: white;
        width: 30%;
        float: left;
        border-radius: 4px;
        border: 1px solid rgba(128, 128, 128, 0.30);
    }
    .item-content{
        background: white;
        width: 68%;
        float: right;
        border-radius: 4px;
    }

    .cart-item{
        margin: 10px 10px;
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
        height: auto;
        width: 70%;
        font-size: 16px;
        margin: 0px 10px;
        float: left;
    }
    img.item-img{
        border: 2px double rgba(158, 158, 158, 0.57)!important;
        margin-left: 20px;
        float: left;
    }
    .item-info{
        padding: 10px;
    }
    .modal-dialog{
        width: 800px!important;
    }
    .modal-body{
        height: 350px;
    }
    .item-data{
        font-size: 18px;
    }
    .item-btn{
        margin-top:25px;
        float: left;
        width: 70%;
        text-align: right;
    }
    .sidebar-category{
        background: gray;
        width: 100%;
        border-top-right-radius: 4px;
        border-top-left-radius: 4px;
        color: white;
        font-size: 16px;
        height: 30px;
        line-height: 30px;
    }
    .sidebar-category b, .sidebar-size{
        padding-left: 5px;
    }
    .category-content a, .size-content a{
        font-size: 16px;
    }
    .category-content li, .size-content li{
        list-style-type: circle;
    }
    .sidebar-size{
        background: gray;
        width: 100%;
        color: white;
        font-size: 16px;
        height: 30px;
        line-height: 30px;
    }
    .no-item{
        height: 300px;
    }
    .no-item p{
        padding: 10px 10px;
    }
</style>
<link href="/css/toastr.min.css" rel="stylesheet">
@section('content')
<div class="container">
    <div class="side-bar">
        <div class="sidebar-category"><b>Sản phẩm theo Category</b></div>
        <div class="category-content">
            <ul>
                <li><a href="/manage-item/item-search?category=dat">Chậu đất ({{$count_type['dat']}})</a></li>
                <li><a href="/manage-item/item-search?category=gom">Chậu gốm ({{$count_type['gom']}})</a></li>
                <li><a href="/manage-item/item-search?category=su">Chậu Sứ ({{$count_type['su']}})</a></li>
            </ul>
        </div>
        <div class="sidebar-size"><b>Sản phẩm theo size</b></div>
        <div class="size-content">
            <ul>
                <li><a href="/manage-item/item-search?size=large">Lớn ({{$count_type['large']}})</a></li>
                <li><a href="/manage-item/item-search?size=medium">Trung bình ({{$count_type['medium']}})</a></li>
                <li><a href="/manage-item/item-search?size=small">Nhỏ ({{$count_type['small']}})</a></li>
            </ul>
        </div>
    </div>
    <div class="item-content">
        @if(count($items) == 0)
            <div class="no-item">
                <p>Không có sản phẩm nào</p>
            </div>
        @else
        <div class="item">
            @foreach($items as $key=>$value)
            <div class="cart-item" data-toggle="modal" data-target="#myModal{{$value->id}}">
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
                        <div class="item-btn">
                            <p>
                              <input id="{{$value->id}}" type="button" class="btn btn-success view-item" style="width: 25%;" value="Xem"/>
                              @if(\App\Cart::checkItemInCart($value->id))
                              <input id="{{$value->id}}" type="button" class="btn btn-warning buy-item" disabled="disabled" style="width: 25%;" value="Đã thêm vào giỏ"/>
                              @else
                              <input id="{{$value->id}}" type="button" class="btn btn-info buy-item" style="width: 25%;" value="Thêm vào giỏ"/>
                              @endif  
                          </p>
                      </div>
                  </div>
              </div>
          </div>

          <!-- Modal -->
          <div class="modal fade" id="myModal{{$value->id}}" role="dialog">
            <div class="modal-dialog">

                <!-- Modal content-->
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h3 class="modal-title"><b>{{$value->name}}</b></h3>
                    </div>
                    <div class="modal-body">
                        <div class="col-md-5">
                            <img src="{{env('APP_URL')}}/uploads/{{$value->image_src}}" height="300" width="300"/>
                        </div>
                        <div class="col-md-7 item-data">
                            <p>Giá sản phẩm: {{$value->cost}} VND</p>
                            <p>Loại: {{\App\Category::getCateNameByID($value->id_category)}}</p>
                            <p>Kích cỡ: {{\App\Size::getSizeNameByID($value->id_size)}}</p>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <input id="{{$value->id}}" type="button" class="btn btn-success view-item" style="margin-top: 3px; width: 49%;" data-toggle="modal" data-target="#myModal{{$value->id}}" value="Close"/>
                        @if(\App\Cart::checkItemInCart($value->id))
                        <input id="{{$value->id}}" type="button" class="btn btn-warning buy-item" style="margin-top: 3px; width: 49%;" disabled="disabled" value="Đã thêm vào giỏ"/>
                        @else
                        <input id="{{$value->id}}" type="button" class="btn btn-info buy-item" style="margin-top: 3px; width: 49%;" value="Thêm vào giỏ"/>
                        @endif
                    </div>
                </div>

            </div>
        </div>
        @endforeach
    </div>
    <div class="paginate-link">
        {!! $links !!}
    </div>
    @endif
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
@endsection