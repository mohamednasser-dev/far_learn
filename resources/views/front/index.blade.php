
@extends('front.layouts.app')

@section('content')
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

@endsection
@section('footer_follow')
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
@endsection
