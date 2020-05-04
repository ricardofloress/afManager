<?php

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;

$user_id = Session::get('user_id');
$shipping_id = Session::get('shipping_id');

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Aida Flores Cabeleireiro</title>
    <link href="{{asset('frontend/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/font-awesome.min.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/prettyPhoto.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/price-range.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/main.css')}}" rel="stylesheet">
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">
    <link rel="shortcut icon" href="{{URL::to('/favicon.ico')}}">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="{{URL::to('frontend/images/ico/apple-touch-icon-144-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="{{URL::to('frontend/images/ico/apple-touch-icon-114-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="{{URL::to('frontend/images/ico/apple-touch-icon-72-precomposed.png')}}">
    <link rel="apple-touch-icon-precomposed" href="{{URL::to('frontend/images/ico/apple-touch-icon-57-precomposed.png')}}">
    <script src="https://js.stripe.com/v3/"></script>


</head>
<!--/head-->

<body>
    <header id="header">
        <!--header-->
        <div class="header_top">
            <!--header_top-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="contactinfo">
                            <ul class="nav nav-pills">
                                <li><a href="#"><i class="fa fa-phone"></i> +351 223 283 455</a></li>
                                <li><a href="#"><i class="fa fa-envelope"></i> geral@aidaflorescabeleireiro.pt</a></li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="social-icons pull-right">
                            <ul class="nav navbar-nav">
                                <li><a href="https://www.facebook.com/aidaflorescabeleireiro/"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="https://www.instagram.com/aidaflores.cabeleireiro/"><i class="fa fa-instagram"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/header_top-->

        <div class="header-middle">
            <!--header-middle-->
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="logo pull-left">
                            <a href="{{URL::to('/')}}"><img style="width: 35%" src="{{asset('images/logo/AidaFloresCabeleireiroLogoLettersBluePng.png')}}" alt="" /></a>
                        </div>
                        <div class="btn-group pull-right">


                        </div>
                    </div>
                    <div class="col-sm-8 headermenulinks">
                        <div class="shop-menu pull-right">
                            <ul class="nav navbar-nav">
                                <?php if ($user_id != NULL && $shipping_id != NULL) { ?>
                                    <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <?php } else if ($user_id != NULL && $shipping_id == NULL) { ?>
                                    <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <?php } else { ?>
                                    <li><a href="{{URL::to('/login')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                <?php } ?>
                                <li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>
                                <?php if ($user_id != NULL) { ?>
                                    <li><a href="{{URL::to('/logout')}}"><i class="fa fa-lock"></i> Logout</a></li>
                                <?php } else { ?>
                                    <li><a href="{{URL::to('/login')}}"><i class="fa fa-lock"></i> Login</a></li>
                                <?php } ?>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!- <div class="header-middle">


            <div class="header-bottom">
                <!--header-bottom-->
                <div class="container">
                    <div class="row">
                        <div class="col-sm-9">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
                            <div class="mainmenu pull-left">
                                <ul class="nav navbar-nav collapse navbar-collapse">
                                    <li style="padding-left: 15px;"><a href="{{URL::to('/')}}">Home</a></li>

                                    <?php if ($user_id != null && $shipping_id != null) { ?>
                                        <li><a href="{{URL::to('/payment')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                    <?php } else if ($user_id != null && $shipping_id == null && Cart::total() == 0) { ?>
                                        <li><a href="{{URL::to('/')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                    <?php } else if ($user_id != null && $shipping_id == null && Cart::total() > 0) { ?>
                                        <li><a href="{{URL::to('/checkout')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                    <?php } else { ?>
                                        <li><a href="{{URL::to('/login')}}"><i class="fa fa-crosshairs"></i> Checkout</a></li>
                                    <?php } ?>

                                    <li><a href="{{URL::to('/show-cart')}}"><i class="fa fa-shopping-cart"></i> Cart</a></li>

                                    <?php if ($user_id != NULL) { ?>
                                        <li><a href="{{URL::to('/logout')}}"><i class="fa fa-lock"></i> Logout</a></li>
                                    <?php } else { ?>
                                        <li><a href="{{URL::to('/login')}}"><i class="fa fa-lock"></i> Login</a></li>
                                    <?php } ?>
                                </ul>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--/header-bottom-->
    </header>
    <!--/header-->

    @if(Route::current()->getName() == '')

    <section id="slider">
        <!--slider-->
        <div class="container afslider">
            <div class="row">
                <div id="slider-carousel" class="carousel slide" data-ride="carousel">
                    <?php
                    $all_published_slider = DB::table('tbl_slider')
                        ->where('publication_status', 1)
                        ->get();
                    ?>
                    <ol class="carousel-indicators">
                        <?php
                        $i = 1;
                        foreach ($all_published_slider as $v_slider) {
                        ?>
                            <li data-target="#slider-carousel" data-slide-to="<?php echo $i ?>" class="<?php echo $i == 1 ? 'active' : '' ?>"></li>
                        <?php
                            $i++;
                        }
                        ?>
                    </ol>
                    <div class="carousel-inner">
                        <?php
                        $check = 1;
                        foreach ($all_published_slider as $v_slider) {
                            if ($check == 1) {
                                $check++;
                        ?>
                                <div class="item active">
                                    <img src="{{URL::to($v_slider->slider_image)}}" class="girl img-responsive" alt="" />
                                </div>
                            <?php } else {
                                $check++;
                            ?>
                                <div class="item">
                                    <img src="{{URL::to($v_slider->slider_image)}}" class=" img-responsive" alt="" />
                                </div>
                        <?php }
                        }
                        ?>
                    </div>
                    <a href="#slider-carousel" class="left control-carousel hidden-xs" data-slide="prev">
                        <i class="fa fa-angle-left"></i>
                    </a>
                    <a href="#slider-carousel" class="right control-carousel hidden-xs" data-slide="next">
                        <i class="fa fa-angle-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>
    <!--/slider-->
    @endif

    <section>
        <div class="container">
            <div class="row">
                <div class="col-sm-3">
                    <div class="left-sidebar">
                        <h2>Category</h2>
                        <div class="panel-group category-products" id="accordian">
                            <!--category-productsr-->
                            <?php
                            $all_published_categories = DB::table('tbl_category')
                                ->where('publication_status', 1)
                                ->get();
                            foreach ($all_published_categories as $v_category) {
                            ?>
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h4 class="panel-title"><a href="{{URL::to('product-by-category/'.$v_category->category_id)}}">{{$v_category->category_name}}</a></h4>
                                    </div>
                                </div>
                            <?php }
                            ?>
                        </div>
                        <!--/category-products-->

                        <div class="brands_products">
                            <!--brands_products-->
                            <h2>Brands</h2>
                            <div class="brands-name">
                                <ul class="nav nav-pills nav-stacked">
                                    <?php
                                    $all_published_manufacture = DB::table('tbl_manufacture')
                                        ->where('publication_status', 1)
                                        ->get();
                                    foreach ($all_published_manufacture as $v_manufacture) {
                                    ?>
                                        <li><a href="{{URL::to('product-by-manufacturer/'.$v_manufacture->manufacture_id)}}">{{$v_manufacture->manufacture_name}}</a></li>
                                    <?php }
                                    ?>
                                </ul>
                            </div>
                        </div>
                        <!--/brands_products-->
                    </div>
                </div>

                <div class="col-sm-9 ">
                    <div class="features_items">
                        <!--features_items-->
                        @yield('content')
                    </div>
                </div>
            </div>
        </div>
    </section>

    <footer id="footer">
        <!--Footer-->
        <div class="footer-top">
            <div class="container">
                <div class="row">
                    <div class="col-sm-4">
                        <div class="companyinfo">
                            <div class="logo pull-left">
                                <a href="{{URL::to('/')}}"><img style="width: 35%" src="{{asset('images/logo/AidaFloresCabeleireiroLogoLettersBluePng.png')}}" alt="" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-3">
                        <div class="address">
                            <img src="{{asset('frontend/images/home/map.png')}}" alt="" />
                            <p>Rua Alves Redol 431, 4050-043 Porto, Portugal</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!--/Footer-->


    <script src="{{asset('frontend/js/jquery.js')}}"></script>
    <script src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.scrollUp.min.js')}}"></script>
    <script src="{{asset('frontend/js/price-range.js')}}"></script>
    <script src="{{asset('frontend/js/jquery.prettyPhoto.js')}}"></script>
    <script src="{{asset('frontend/js/main.js')}}"></script>
</body>

</html>