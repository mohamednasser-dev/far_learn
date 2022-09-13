@extends('front.layouts.temp')
@section('content')

        <div class="w-100 pb-250 position-relative">
            <div class="container">
                <div class="sec-title mt-50 text-center w-100">
                    <div class="sec-title-inner d-inline-block">
                        <i class="thm-clr flaticon-rub-el-hizb"></i>
                        <h2 class="mb-0">Login Page</h2>
                    </div>
                </div>

                <div class="contact-wrap mt-50 w-100">
                    <div class="row">
                        <div class="col-md-3 col-sm-12 col-lg-3">
                        </div>
                        <div class="col-md-6 col-sm-12 col-lg-6">
                            {{ Form::open( ['route'  => ['login_both'],'method'=>'post' , 'class'=>'form'] ) }}
                                <input type="text" placeholder="Username">
                                <input type="password" placeholder="Password">
                                <button class="thm-btn thm-bg" type="submit">
                                    Login<span></span><span></span><span></span><span></span></button>
                           {{ Form::close() }}
                        </div>
                        <div class="col-md-3 col-sm-12 col-lg-3">
                        </div>
                    </div>
                </div><!-- Contact Wrap -->
            </div>
        </div>

@endsection
@section('scrips')
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/js/popper.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/wow.min.js"></script>
    <script src="assets/js/counterup.min.js"></script>
    <script src="assets/js/jquery.fancybox.min.js"></script>
    <script src="assets/js/jquery.bootstrap-touchspin.min.js"></script>
    <script src="assets/js/perfect-scrollbar.min.js"></script>
    <script src="assets/js/slick.min.js"></script>
    <!-- <script src="assets/js/particles.min.js"></script>
    <script src="assets/js/particle-int.js"></script> -->
    <script src="assets/js/musicplayer-min.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCYc537bQom7ajFpWE5sQaVyz1SQa9_tuY&callback=initMap"></script>
    <script src="assets/js/google-map-int.js"></script>
    <script src="assets/js/custom-scripts.js"></script>


@endsection
