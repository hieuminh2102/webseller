<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Web seller</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">

    <!-- Styles -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}

    <style>
        body {
            font-family:  'Segoe UI';
        }

        .fa-btn {
            margin-right: 6px;
        }
        .navbar-default{
            background: #42b2b8;
        }
        #app-layout{
            background-color: #cce6e8;
        }
        .navbar-default .navbar-nav>.open>a, .navbar-default .navbar-nav>.open>a:focus, .navbar-default .navbar-nav>.open>a:hover,.dropdown-menu{
            background: gray;
        }
        .dropdown-menu li a{
            color: white;
        }
    </style>
</head>
<body id="app-layout">
    <nav class="navbar navbar-default navbar-static-top">
        <div class="container">
            <div class="navbar-header">

                <!-- Collapsed Hamburger -->
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#app-navbar-collapse">
                    <span class="sr-only">Toggle Navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>

                <!-- Branding Image -->
                <a class="navbar-brand" href="{{ url('/') }}" style="color:white;">
                    Chậu Cây Cảnh
                </a>
            </div>

            <div class="collapse navbar-collapse" id="app-navbar-collapse">
                <!-- Left Side Of Navbar -->
                <ul class="nav navbar-nav navbar-left">
                    <!-- Authentication Links -->
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:white;">
                        Loại Chậu Cây <span class="caret"></span>
                        </a>

                        <ul class="dropdown-menu" role="menu">
                            <li><a href="#"><i class="fa fa-btn fa-tree"></i>Chậu Cây Bán Chạy</a></li>
                            <li><a href="#"><i class="fa fa-btn fa-tree"></i>Chậu Cây Mới Về</a></li>
                        </ul>
                    </li>
                    @if (Auth::guest())
                    @else
                        @if(\Auth::user()->id_user_type == 1 || \Auth::user()->id_user_type == 2)
                            <li>
                                <a href="/manage-item/create-item" style="color:white;">
                                    Đăng chậu cây
                                </a>
                            </li>
                        @endif
                    @endif
                </ul>

                <!-- Right Side Of Navbar -->
                <ul class="nav navbar-nav navbar-right">
                    <!-- Authentication Links -->
                    @if (Auth::guest())
                        <li><a href="{{ url('/login') }}" style="color:white;">Login</a></li>
                        <li><a href="{{ url('/register') }}" style="color:white;">Register</a></li>
                    @else
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false" style="color:white;">
                                {{ Auth::user()->name }} <span class="caret"></span>
                            </a>

                            <ul class="dropdown-menu" role="menu">
                                <li><a href="{{ url('/cart-setting/view-cart') }}"><i class="fa fa-btn fa-shopping-cart"></i>Cart</a></li>
                                <li><a href="{{ url('/user-setting/add-information') }}"><i class="fa fa-btn fa-user"></i>Add Information</a></li>
                                <li><a href="{{ url('/logout') }}"><i class="fa fa-btn fa-sign-out"></i>Logout</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')

    <div class="col-md-12" style="clear:both;">
        <!--footer start from here-->
        <link href="/css/footer.css" rel="stylesheet">
        <style >
        .copyright { min-height:40px; background-color:#000000;}
        .copyright p { text-align:left; color:#FFF; padding:10px 0; margin-bottom:0px;}
        .footer {
            margin-top: 30px;
            position: absolute;
            right: 0;
            left: 0;
            background-color: #efefef;
            text-align: center;
        }
        </style>
        <div class="footer">
            <footer style="background-image:url('/images/footersievn.png'); background-repeat:repeat-x;">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 footerleft ">

                            <p><i class="fa fa-map-pin"></i>Address: Room 201, D7 Building, HUST | No.1, Dai Co Viet Street, Hanoi, Vietnam.</p>
                            <p><i class="fa fa-phone"></i>Tel:(+84)04.3868.3407 & 3868.2261 | Fax:(+84)04.3868.3409</p>
                            <p><i class="fa fa-envelope"></i>Email: info@sie.edu.vn | Website: http://sie.hust.edu.vn</p>

                        </div>

                        <div class="col-md-3 col-sm-3 paddingtop-bottom " >
                            <div class="fb-page" data-href="https://www.facebook.com/sie.hust.edu.vn/" data-tabs="timeline" data-height="300" data-small-header="false" style="margin-bottom:15px;" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true">
                                <div class="fb-xfbml-parse-ignore">
                                    <blockquote cite="https://www.facebook.com/sie.hust.edu.vn/"><a href="https://www.facebook.com/sie.hust.edu.vn/">Facebook</a></blockquote>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-3 paddingtop-bottom">
                            <div class="logofooter" > <img src="/images/logonho.png" alt="sie_logo"></div>
                        </div>
                    </div>
                </div>
            </footer>
            <!--footer start from here-->

            <div class="copyright" style="height:50px">
                <div class="container">
                    <div class="col-md-6">
                        <p>Copyright© School of International Education | HUST</p>
                    </div>
                    <div class="col-md-6">
                        <p>Powered by: Students</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <!-- JavaScripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>
    <script>
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}
</body>
</html>
