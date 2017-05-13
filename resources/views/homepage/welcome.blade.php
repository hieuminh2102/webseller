@extends('layouts.app')
<link rel="stylesheet" href="css/homepage.css">
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <!--Ads-->
            <div class="panel panel-default">
                <div id="ads">
                    <div id="adsleft">
                        <section class="slider">
                            <div class="flexslider">
                                <ul class="slides">
                                    <li>
                                        <img src="images/abc.jpg" />
                                    </li>
                                    <li>
                                        <img src="images/def.jpg" />
                                    </li>
                                    <li>
                                        <img src="images/abc.jpg" />
                                    </li>
                                    <li>
                                        <img src="images/def.jpg" />
                                    </li>
                                </ul>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <!--End Ads-->

            <!--Menu-->
            <div class="main-menu">
                <ul>
                    <li><a href="#" style="padding:0px 15px">Cây Bán Chạy</a>
                    </li>
                    <li><a href="#">Cây Mới Về</a>
                    </li>
                    <li><a href="#">Cây Giảm giá</a>
                    </li>
                </ul>
            </div>
            <!--End menu-->
            <div class="content" style="margin-top:20px; background: gray">
                @include('homepage.item-homepage', ["title" => "Bán chạy", "type"=>"hot"])
                @include('homepage.item-homepage', ["title" => "Mới về", "type"=>"new"])
                @include('homepage.item-homepage', ["title" => "Sales", "type"=>"sale"])
            </div>
        </div>
    </div>
</div>
<link rel="stylesheet" href="flexslider.css" type="text/css" media="screen" />
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1/jquery.min.js"></script>
<script defer src="jquery.flexslider.js"></script>

<script type="text/javascript">
    $(window).load(function(){
      $('.flexslider').flexslider({
        animation: "slide",
        start: function(slider){
          $('body').removeClass('loading');
      }
  });
  });
</script>
@endsection
