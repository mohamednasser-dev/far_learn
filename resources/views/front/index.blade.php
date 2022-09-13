<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="wpoceans">
    <title>Ummah - Islamic Center HTML5 Template</title>
    <link href="{{url('/')}}/ummah/assets/css/themify-icons.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/flaticon.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/animate.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/owl.carousel.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/owl.theme.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/slick.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/slick-theme.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/swiper.min.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/owl.transitions.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/jquery.fancybox.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/odometer-theme-default.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/nice-select.css" rel="stylesheet">
    <link href="{{url('/')}}/ummah/assets/css/style.css" rel="stylesheet">
    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css"/>
    @yield('styles')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
        /* four country code input */
        input[id=txt_main_login_countrycode_code] {
            z-index: -1;
        }
    </style>
</head>

<body>
<!-- start page-wrapper -->
<div class="page-wrapper">
    <!-- start preloader -->
    <div class="preloader">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
    <!-- end preloader -->
    <header id="header" class="wpo-site-header wpo-header-style-2">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col col-md-6 col-sm-7 col-12">
                        <div class="contact-intro">
                            <ul>
                                <li><i class="fi ti-location-pin"></i>28 Street, New York City, USA</li>
                                <li><i class="fi flaticon-envelope"></i> Ummah@gmail.com</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col col-md-6 col-sm-5 col-12">
                        <div class="contact-info">
                            <ul>
                                <li><a href="#"><i class="ti-facebook"></i></a></li>
                                <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                                <li><a href="#"><i class="ti-instagram"></i></a></li>
                                <li><a href="#"><i class="ti-google"></i></a></li>
                                <li><a class="theme-btn-s2" href="donate.html"> اللغة </a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end topbar -->
        <div class="site-header header-style-1">
            <nav class="navigation navbar navbar-default original">
                <div class="container">
                    <div class="navbar-header">
                        <button type="button" class="open-btn">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button>
                        <a class="navbar-brand" href="index.html"><img src="{{url('/')}}/ummah/assets/images/logo-2.png" alt=""></a>
                    </div>
                    <div id="navbar" class="navbar-collapse collapse navigation-holder">
                        <button class="close-navbar"><i class="ti-close"></i></button>
                        <ul class="nav navbar-nav">
                            <li class="menu-item">
                                <a href="{{route('main_page')}}"><i class="fa fa-home"></i></a>

                            </li>
{{--                            <li><a href="about.html">About</a></li>--}}
{{--                            <li class="menu-item-has-children">--}}
{{--                                <a href="#">Service</a>--}}
{{--                                <ul class="sub-menu">--}}
{{--                                    <li><a href="service.html">Service</a></li>--}}
{{--                                    <li><a href="service-single.html">Service Single</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li><a href="donate.html">Donate</a></li>--}}
{{--                            <li class="menu-item-has-children">--}}
{{--                                <a href="#">Event</a>--}}
{{--                                <ul class="sub-menu">--}}
{{--                                    <li><a href="event.html">Event</a></li>--}}
{{--                                    <li><a href="event-single.html">Event Single</a></li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
{{--                            <li class="menu-item-has-children">--}}
{{--                                <a href="#">Blog</a>--}}
{{--                                <ul class="sub-menu">--}}
{{--                                    <li><a href="blog.html">Blog right sidebar</a></li>--}}
{{--                                    <li><a href="blog-left.html">Blog left sidebar</a></li>--}}
{{--                                    <li><a href="blog-fulwidth.html">Blog fullwidth</a></li>--}}
{{--                                    <li class="menu-item-has-children">--}}
{{--                                        <a href="#">Blog details</a>--}}
{{--                                        <ul class="sub-menu">--}}
{{--                                            <li><a href="blog-single.html">Blog details right sidebar</a></li>--}}
{{--                                            <li><a href="blog-single-left.html">Blog details left sidebar</a></li>--}}
{{--                                            <li><a href="blog-single-fluid.html">Blog details fullwidth</a></li>--}}
{{--                                        </ul>--}}
{{--                                    </li>--}}
{{--                                </ul>--}}
{{--                            </li>--}}
                        </ul>
                    </div><!-- end of nav-collapse -->
                    <div class="cart-search-contact">
                        <div class="header-search-form-wrapper">
                            <div class="btns">
                                <a href="#" class="theme-btn">{{trans('admin.sign_up')}}</a>
                            </div>
                        </div>
                        <div class="mini-cart">
                            <div class="btns">
                                <a href="javascript:void(0);" class="cart-toggle-btn theme-btn"><i class="fi flaticon2-user"></i> {{trans('admin.login')}}</a>
                            </div>
{{--                            <button style="width: 127px;color: white;" class="cart-toggle-btn"> <i class="fi flaticon-shopping-cart"></i>{{trans('admin.login')}} </button>--}}
                            <div class="mini-cart-content">
                                <div class="mini-cart-title">
                                    <p>{{trans('admin.login')}}</p>
                                </div>
                                {{ Form::open( ['route'  => ['login_both'],'method'=>'post' ,'id'=>'login_form'] ) }}
                                <div class="mini-cart-items">
                                    <div class="mini-cart-item clearfix">
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <div class="form-group" style="padding-bottom: 5px">
                                                    <input type="number" style="background-color: aliceblue;"
                                                           onkeyup="this.value=login_phone(this.value);"
                                                           required name="phone" value="{{old('phone')}}"
                                                           placeholder="{{trans('s_admin.phone')}}"
                                                           class="form-control" id="recipient-name1">
                                                </div>
                                            </div>
                                            <div class="col-lg-4">
                                                <div class="form-group">
                                                    <input id="txt_login_countrycode_code" style="background-color: aliceblue;"
                                                           style="max-width: 30px;"
                                                           @if(old('country_code'))
                                                           value="{{old('country_code')}}"
                                                           @else
                                                           value="+966"
                                                           @endif
                                                           type="text"
                                                           name="country_code"
                                                           class="form-control form-control-danger">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="mini-cart-item clearfix">
                                        <input type="password" required name="password" placeholder="{{trans('admin.password')}}"
                                               class="form-control" id="recipient-name1">
                                    </div>
                                </div>
                                <div class="mini-cart-action clearfix">
                                    <a  onclick="document.getElementById('login_form').submit();" class="theme-btn-s4">{{trans('admin.login')}}</a>
                                </div>
                                {{ Form::close() }}
                            </div>
                        </div>
                    </div>
                </div><!-- end of container -->
            </nav>
        </div>
    </header>
    <!-- start of hero -->
    <section class="hero hero-style-1">
        <div class="hero-slider">
            @foreach($sliders as $slider)
            <div class="slide">
                <div class="container">
                    <img src="{{$slider->image}}" alt class="slider-bg">
                    <div class="row">
                        <div class="col col-md-8 col-md-offset-2 slide-caption">
                            <div class="slide-top">
                                <span> @if(session('lang')=='ar') {{$slider->title_ar}} @else {{$slider->title_en}} @endif </span>
                            </div>
                            <div class="slide-title">
                                <h2> @if(session('lang')=='ar') {{$slider->desc_ar}} @else {{$slider->desc_en}} @endif </h2>
                            </div>
                            <div class="btns">
                                <a href="#" class="theme-btn">Discover More</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </section>
    <!-- end of hero slider -->
    <!-- wpo-about-area start -->
    <div class="wpo-about-area-2 section-padding">
        <div class="container">
            <div class="wpo-about-wrap">
                <div class="row">
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="wpo-about-img-3">
                            <img src="{{url('/')}}/ummah/assets/images/about.png" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-12">
                        <div class="wpo-about-text">
                            <div class="wpo-section-title">
                                <span>About Us</span>
                                <h2>Seeking of knowledge is a duty of every Muslim</h2>
                            </div>
                            <p>The rise of Muslims to the zenith of civilization in a period of four decades was based on lslam's emphasis on learning. This is obvious when one takes a look at the Qur'an and the traditions of Prophet Muhammad which are filled with references to learning, education, observation.</p>
                            <div class="btns">
                                <a href="about.html" class="theme-btn" tabindex="0">Discover More</a>
                                <ul>
                                    <li class="video-holder">
                                        <a href="https://www.youtube.com/embed/LTqRm53QjI0" class="video-btn" data-type="iframe" tabindex="0"></a>
                                    </li>
                                    <li class="video-text">
                                        <a href="https://www.youtube.com/embed/LTqRm53QjI0" class="video-btn" data-type="iframe" tabindex="0">
                                            Watch Our Video
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="timer-section">
                <div class="row">
                    <div class="col-md-5">
                        <div class="timer-text">
                            <h2>Prayer Times</h2>
                            <p>Prayer times in United Arab Emirates</p>
                            <span>Mon 15 Jan, 2020</span>
                        </div>
                    </div>
                    <div class="col-md-5 col-md-offset-1">
                        <div class="timer-num">
                            <ul>
                                <li>Fajr<span>05:47</span></li>
                                <li>Sunrize<span>07:05</span></li>
                                <li>Dhuhr<span>12:34</span></li>
                                <li>Asr<span>15:35</span></li>
                                <li>Maghrib<span>17:58</span></li>
                                <li>Isha'a<span>19:15</span></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="timer-shape1">
                    <img src="{{url('/')}}/ummah/assets/images/prayer-shape/2.png" alt="">
                </div>
                <div class="timer-shape2">
                    <img src="{{url('/')}}/ummah/assets/images/prayer-shape/1.png" alt="">
                </div>
                <div class="timer-shape3">
                    <img src="{{url('/')}}/ummah/assets/images/prayer-shape/3.png" alt="">
                </div>
            </div>
        </div>
    </div>
    <!-- wpo-about-area end -->
    <!-- service-area-start -->
    <div class="service-area-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wpo-section-title">
                        <span>What We Offer</span>
                        <h2>Our Populer Services</h2>
                    </div>
                </div>
            </div>
            <div class="service-wrap">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6 custom-grid col-12">
                        <div class="service-single-item">
                            <div class="service-single-img">
                                <img src="{{url('/')}}/ummah/assets/images/service/img-3.png" alt="">
                            </div>
                            <div class="service-text">
                                <h2><a href="service-single.html">Quran Memorization</a></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 custom-grid col-12">
                        <div class="service-single-item">
                            <div class="service-single-img">
                                <img src="{{url('/')}}/ummah/assets/images/service/img-4.png" alt="">
                            </div>
                            <div class="service-text">
                                <h2><a href="service-single.html">Special Child Care</a></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 custom-grid col-12">
                        <div class="service-single-item">
                            <div class="service-single-img">
                                <img src="{{url('/')}}/ummah/assets/images/service/img-5.png" alt="">
                            </div>
                            <div class="service-text">
                                <h2><a href="service-single.html">Mosque Development</a></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 custom-grid col-12">
                        <div class="service-single-item">
                            <div class="service-single-img">
                                <img src="{{url('/')}}/ummah/assets/images/service/img-6.png" alt="">
                            </div>
                            <div class="service-text">
                                <h2><a href="service-single.html">Matrimonial</a></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 custom-grid col-12">
                        <div class="service-single-item">
                            <div class="service-single-img">
                                <img src="{{url('/')}}/ummah/assets/images/service/img-7.png" alt="">
                            </div>
                            <div class="service-text">
                                <h2><a href="service-single.html">Funerals</a></h2>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6 custom-grid col-12">
                        <div class="service-single-item">
                            <div class="service-single-img">
                                <img src="{{url('/')}}/ummah/assets/images/service/img-8.png" alt="">
                            </div>
                            <div class="service-text">
                                <h2><a href="service-single.html">Help Poor</a></h2>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- service-area-end -->
    <!-- payment-section start-->
    <div class="payment-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="payment-text">
                        <span>Donate Now</span>
                        <h2>Donate Some Money & Save The Muslim Ummah.</h2>
                        <p>How can we reject the faith in Allah? seeing that ye were without life, and He gave you life; then will He cause you to die, and will again bring you to life; and again to Him will ye return.</p>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="wpo-donations-form">
                        <h2>Payment Information</h2>
                        <div class="row">
                            <form>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                                    <input type="text" class="form-control" name="name" id="fname" placeholder="First Name">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group clearfix">
                                    <input type="email" class="form-control" name="email" id="email" placeholder="Email">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                                    <input type="text" class="form-control" name="Phone" id="Phone" placeholder="Phone">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group clearfix">
                                    <input type="text" class="form-control" name="Adress" id="Adress" placeholder="Adress">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                                    <input type="text" class="form-control" name="Card" id="Card" placeholder="Card Number">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                                    <input type="text" class="form-control" name="Expire" id="Expire" placeholder="Expire Date">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                                    <input type="text" class="form-control" name="CVC" id="CVC" placeholder="CVC">
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-6 col-12 form-group">
                                    <input type="text" class="form-control" name="Amount" id="Amount" placeholder="Amount">
                                </div>
                                <div class="col-lg-12 col-12 form-group">
                                    <button class="theme-btn" type="submit">Donate Now</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- payment-section end-->
    <!-- wpo-event-area start -->
    <div class="wpo-event-area-2 section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wpo-section-title">
                        <span>Our Events</span>
                        <h2>Our Upcomming event</h2>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 col-sm-12 col-12 custom-grid">
                    <div class="wpo-event-item">
                        <div class="wpo-event-img">
                            <img src="{{url('/')}}/ummah/assets/images/event/img-3.jpg" alt="">
                            <div class="thumb-text">
                                <span>25</span>
                                <span>NOV</span>
                            </div>
                        </div>
                        <div class="wpo-event-text">
                            <h2>Learn About Hajj</h2>
                            <ul>
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i>8.00 - 5.00</li>
                                <li><i class="fi ti-location-pin"></i>Newyork City</li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                            <a href="event-single.html">Learn More...</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12 col-12 custom-grid">
                    <div class="wpo-event-item">
                        <div class="wpo-event-img">
                            <img src="{{url('/')}}/ummah/assets/images/event/img-4.jpg" alt="">
                            <div class="thumb-text-2">
                                <span>25</span>
                                <span>NOV</span>
                            </div>
                        </div>
                        <div class="wpo-event-text">
                            <h2>Islamic Teaching Event</h2>
                            <ul>
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i>8.00 - 5.00</li>
                                <li><i class="fi ti-location-pin"></i>Newyork City</li>
                            </ul>
                            <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit</p>
                            <a href="event-single.html">Learn More...</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- wpo-event-area end -->
    <!-- support-area start -->
    <div class="support-area section-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-5">
                    <div class="support-text">
                        <span>Support Us</span>
                        <h2>We Need Your Help</h2>
                        <p>The Weekend School of the Islamic Center of Allah is committed to providing quality Islamic Education according to the Quran.</p>
                        <div class="btns">
                            <a href="donate.html" class="theme-btn-s3">Donate Now</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7">
                    <div class="progress-area">
                        <div class="row">
                            <div class="col-lg-4 col-sm-4 custom-grid">
                                <div class="progress-wrap">
                                    <div class="progressbar" data-animate="false">
                                        <div class="circle" data-percent="56">
                                            <div></div>
                                        </div>
                                    </div>
                                    <span>Mosque</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 custom-grid">
                                <div class="progress-wrap">
                                    <div class="progressbar2" data-animate="false">
                                        <div class="circle" data-percent="45">
                                            <div></div>
                                        </div>
                                    </div>
                                    <span>Expenses</span>
                                </div>
                            </div>
                            <div class="col-lg-4 col-sm-4 custom-grid">
                                <div class="progress-wrap">
                                    <div class="progressbar3" data-animate="false">
                                        <div class="circle" data-percent="74">
                                            <div></div>
                                        </div>
                                    </div>
                                    <span>Feed Hungry</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- support-area start -->
    <!-- blog-area start -->
    <div class="blog-area section-padding">
        <div class="container">
            <div class="col-l2">
                <div class="wpo-section-title">
                    <span>From Our Blog</span>
                    <h2>Latest News</h2>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-sm-6 col-12 custom-grid">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{url('/')}}/ummah/assets/images/blog/img-4.jpg" alt="">
                        </div>
                        <div class="blog-content">
                            <h3><a href="blog-single.html">The Importance of Marriage in Islam.</a></h3>
                            <ul class="post-meta">
                                <li><img src="{{url('/')}}/ummah/assets/images/blog/admin.jpg" alt=""></li>
                                <li><a href="#">Jenefar Jany</a></li>
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i> 21 Jan 2020</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12 custom-grid">
                    <div class="blog-item">
                        <div class="blog-img">
                            <img src="{{url('/')}}/ummah/assets/images/blog/img-5.jpg" alt="">
                        </div>
                        <div class="blog-content">
                            <h3><a href="blog-single.html">Salat is the best exercise for body fitness</a></h3>
                            <ul class="post-meta">
                                <li><img src="{{url('/')}}/ummah/assets/images/blog/admin.jpg" alt=""></li>
                                <li><a href="#">Jenefar Jany</a></li>
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i> 21 Jan 2020</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-sm-6 col-12 custom-grid">
                    <div class="blog-item b-0">
                        <div class="blog-img">
                            <img src="{{url('/')}}/ummah/assets/images/blog/img-6.jpg" alt="">
                        </div>
                        <div class="blog-content">
                            <h3><a href="blog-single.html">Salat is the best exercise for body fitness</a></h3>
                            <ul class="post-meta">
                                <li><img src="{{url('/')}}/ummah/assets/images/blog/admin.jpg" alt=""></li>
                                <li><a href="#">Jenefar Jany</a></li>
                                <li><i class="fa fa-clock-o" aria-hidden="true"></i> 21 Jan 2020</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- blog-area start -->
    <!-- footer-area start -->
    <div class="wpo-ne-footer">
        <!-- start wpo-news-letter-section -->
        <section class="wpo-news-letter-section">
            <div class="container">
                <div class="wpo-news-letter-wrap">
                    <div class="row">
                        <div class="col col-md-10 col-md-offset-1 col-sm-8 col-sm-offset-2">
                            <div class="wpo-newsletter">
                                <h3>Follow us For ferther information</h3>
                                <p>Quis ipsum suspendisse ultrices gravida. Risus commodo viverra maecenas.</p>
                                <div class="wpo-newsletter-form">
                                    <form>
                                        <div>
                                            <input type="text" placeholder="Enter Your Email" class="form-control">
                                            <button type="submit">Subscribe</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </section>
        <!-- end wpo-news-letter-section -->
        <!-- start wpo-site-footer -->
        <footer class="wpo-site-footer">
            <div class="wpo-upper-footer">
                <div class="container">
                    <div class="row">
                        <div class="col col-lg-3 col-md-3 col-sm-6">
                            <div class="widget about-widget">
                                <div class="logo widget-title">
                                    <img src="{{url('/')}}/ummah/assets/images/logo.png" alt="blog">
                                </div>
                                <p>Build and Earn with your online store with lots of cool and exclusive wpo-features </p>
                                <ul>
                                    <li><a href="#"><i class="ti-facebook"></i></a></li>
                                    <li><a href="#"><i class="ti-twitter-alt"></i></a></li>
                                    <li><a href="#"><i class="ti-instagram"></i></a></li>
                                    <li><a href="#"><i class="ti-google"></i></a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-lg-3 col-md-3 col-sm-6">
                            <div class="widget link-widget">
                                <div class="widget-title">
                                    <h3>Service</h3>
                                </div>
                                <ul>
                                    <li><a href="service-single.html">Islamic School</a></li>
                                    <li><a href="service-single.html">Our Causes</a></li>
                                    <li><a href="#">Our Mission</a></li>
                                    <li><a href="contact.html">Contact Us</a></li>
                                    <li><a href="event.html">Our Event</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-lg-2 col-md-3 col-sm-6">
                            <div class="widget link-widget">
                                <div class="widget-title">
                                    <h3>Useful Links</h3>
                                </div>
                                <ul>
                                    <li><a href="about.html">About Us</a></li>
                                    <li><a href="service-single.html">Services</a></li>
                                    <li><a href="event.html">Semester</a></li>
                                    <li><a href="index-2.html">Prayer Times</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col col-lg-3 col-lg-offset-1 col-md-3 col-sm-6">
                            <div class="widget market-widget wpo-service-link-widget">
                                <div class="widget-title">
                                    <h3>Contact </h3>
                                </div>
                                <p>online store with lots of cool and exclusive wpo-features</p>
                                <div class="contact-ft">
                                    <ul>
                                        <li><i class="fi ti-location-pin"></i>28 Street, New York City, USA</li>
                                        <li><i class="fi flaticon-call"></i>+000123456789</li>
                                        <li><i class="fi flaticon-envelope"></i>ummah@gmail.com</li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div> <!-- end container -->
            </div>
            <div class="wpo-lower-footer">
                <div class="container">
                    <div class="row">
                        <div class="col col-xs-12">
                            <p class="copyright">&copy; 2020 Ummah. All rights reserved</p>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- end wpo-site-footer -->
    </div>
</div>
<!-- end of page-wrapper -->
<!-- All JavaScript files
================================================== -->
<script src="{{url('/')}}/ummah/assets/js/jquery.min.js"></script>
<script src="{{url('/')}}/ummah/assets/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/ummah/assets/js/circle-progress.min.js"></script>
<!-- Plugins for this template -->
<script src="{{url('/')}}/ummah/assets/js/jquery-plugin-collection.js"></script>
<!-- Custom script for this template -->
<script src="{{url('/')}}/ummah/assets/js/script.js"></script>
<script src="{{url('/')}}/metronic/assets/js/pages/features/miscellaneous/sweetalert2.js"></script>
<script src="{{ asset('metronic/assets/js/pages/features/miscellaneous/toastr.js')}}"></script>
<script>
    $('#sign_up_btn').click(function () {
        $('#login-modal').modal('hide');
        $('#stud_model').modal('hide');
        $('#far_learn_model').modal('hide');
        $('#teacher_model').modal('hide');
    });
    $('#login_btn').click(function () {
        $('#sign-modal').modal('hide');
        $('#stud_model').modal('hide');
        $('#far_learn_model').modal('hide');
        $('#teacher_model').modal('hide');
    });
</script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
        var code = "+966"; // Assigning value from model.
        $('#txt_login_countrycode_code').val(code);
        $('#txt_login_countrycode_code').intlTelInput({
            autoHideDialCode: true,
            autoPlaceholder: "ON",
            dropdownContainer: document.body,
            formatOnDisplay: true,
            hiddenInput: "full_number",
            initialCountry: "auto",
            nationalMode: true,
            placeholderNumberType: "MOBILE",
            preferredCountries: ['US'],
            separateDialCode: false
        });
        // console.log(code)
        // $("#txt_unique_name").keyup(function (event) {
        //     var txt_unique_name = $("#txt_unique_name").val('');
        //     txt_unique_name.replace(/\s/g, "") ;
        // });
    });
    $(function () {
        var code = "+966"; // Assigning value from model.
        $('#txt_main_login_countrycode_code').val(code);
        $('#txt_main_login_countrycode_code').intlTelInput({
            autoHideDialCode: true,
            autoPlaceholder: "ON",
            dropdownContainer: document.body,
            formatOnDisplay: true,
            hiddenInput: "full_number",
            initialCountry: "auto",
            nationalMode: true,
            placeholderNumberType: "MOBILE",
            preferredCountries: ['US'],
            separateDialCode: false
        });
        // console.log(code)
        // $("#txt_unique_name").keyup(function (event) {
        //     var txt_unique_name = $("#txt_unique_name").val('');
        //     txt_unique_name.replace(/\s/g, "") ;
        // });
    });
    function login_phone(string) {
        var first_string = string.substring(0);
        var int_string = parseInt(first_string);
        if(int_string == '0'){
            $("#phone").val('');
            return false;
        }else{
            return string;
        }
    }
</script>
@include('sweetalert::alert')
@yield('scripts')
</body>

</html>
