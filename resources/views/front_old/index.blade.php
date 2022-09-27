@extends('front.layouts.temp')
@section('content')
    <section>
        <div class="w-100">
            @include('admin.layouts.errors')
            @include('admin.layouts.messages')
        </div>
    </section>
    @if(session('lang') == 'ar')
        <section dir="rtl">
            @else
                <section>
                    @endif
                    <div class="w-100 position-relative">
                        <div class="feat-wrap v1 text-center position-relative w-100">
                            <div class="feat-caro">
                                @foreach($sliders as $slider)
                                    <div class="feat-item">
                                        <div class="feat-img position-absolute"
                                             style="background-image: url({{$slider->image}});"></div>
                                        <div class="feat-cap-wrap position-absolute d-inline-block">
                                            <div class="feat-cap d-inline-block">
                                                @if(session('lang')=='ar')
                                                    <h2 class="mb-0">{{$slider->title_ar}}</h2>
                                                    <p>{{$slider->desc_ar}}</p>
                                                @else
                                                    <h2 class="mb-0">{{$slider->title_en}}</h2>
                                                    <p>{{$slider->desc_en}}</p>
                                                @endif
                                                {{--                                                <p id="demo" style="font-weight: bold;"></p>--}}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div><!-- Featured Area Wrap -->
                    </div>
                </section>
                @php $app = \App\Models\Web_setting::where('id',1)->first(); @endphp
                <section>
                    <div class="w-100  opc7 position-relative">
                        <div class="fixed-bg patern-bg back-blend-multiply thm-bg"
                             style="background-color: #c9b288; height: 125px;"></div>
                        <div class="container">
                            <div class="plyr-cont-wrap w-100">
                                <div class="row">
                                    <div class="col-md-6 col-sm-6 col-lg-4">
                                        <div class="plyr-wrp overlap155 w-100">
                                            <h3 class="mb-0 text-center pat-bg opc7 back-blend-multiply thm-bg"
                                                style="background-color: #c9b288 !important;font-size: 27px; ">
                                                {{trans('admin.lisgn')}}</h3>
                                            <div class="plyr-inner w-100">
                                                <div class="plyr w-100">
                                                    <ul class="playlist mb-0 list-unstyled">
                                                        <li data-cover="{{url('/')}}/quran/assets/images/audio-cover.jpg"
                                                            data-artist="({{trans('admin.soret_elbkra')}})">
                                                            <a href="{{url('/')}}/quran/assets/audio/Eh_bakara.mp3"
                                                               title="">{{trans('admin.maher')}}</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-sm-6 col-lg-8">
                                        <div class="cont-info w-100">
                                            <ul class="cont-info-list d-flex flex-wrap mb-0 list-unstyled w-100">
                                                <li><span class="thm-bg" style="background-color: #934915;"><i
                                                            class="fas fa-phone-alt"></i></span>{{$app->phone}}</li>
                                                <li><span class="thm-bg" style="background-color: #934915;"><i
                                                            class="far fa-envelope"></i></span><a
                                                        href="javascript:void(0);" title="">{{$app->email}}</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="w-100 pt-110 pb-80 position-relative">
                        <img class="img-fluid sec-top-mckp position-absolute"
                             src="{{url('/')}}/quran/assets/images/sec-top-mckp.png" alt="Sec Top Mockup">
                        <div class="container">
                            <div class="about-wrap text-center position-relative w-100">
                                <div class="about-inner d-inline-block">
                                    <img class="img-fluid" src="{{url('/')}}/quran/assets/images/bism-img1.png"
                                         alt="Bismillah Image">
                                    <h2 class="mb-0">{{trans('admin.who_are_us')}}</h2>
                                    <h3 class="mb-0">
                                        @if(app()->getLocale() == 'ar')
                                            {{$app->about_ar}}
                                        @else
                                            {{$app->about_en}}
                                        @endif
                                    </h3>

                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                @if($settings_share->show_mogmaa_dorr == '1')
                    <section>
                        <div class="w-100 pt-110 pb-80 black-layer opc65 position-relative">
                            <div class="fixed-bg"
                                 style="background-image: url(/quran/assets/images/course-bg.jpg);"></div>
                            <div class="container">
                                <div class="page-title-wrap text-center w-100">
                                    <div class="page-title-inner d-inline-block">
                                        <h1 class="mb-0">{{trans('admin.dorr_mogmaa_times')}}</h1>
                                        <br><br>
                                        <ol class="breadcrumb mb-0">
                                            <a href="{{route('times.show','dorr')}}" class="thm-btn thm-bg"
                                               style="background-color: darksalmon;">
                                                {{trans('s_admin.dorr_name')}}
                                                <span></span><span></span><span></span><span></span> </a>
                                            &nbsp;
                                            &nbsp;
                                            <a href="{{route('times.show','mogmaa')}}" class="thm-btn thm-bg"
                                               style="background-color: #c9b288;" href="" title="">
                                                {{trans('s_admin.colleges')}}
                                                <span></span><span></span><span></span><span></span></a>
                                        </ol>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                @endif
                <section>
                    <div class="w-100 pt-25 pb-80 position-relative">
                    </div>
                </section>
                <section>
                    <div class="w-100 pt-80 black-layer pb-70 opc65 position-relative">
                        <div class="fixed-bg"
                             style="background-image: url(/quran/assets/images/times_title-bg.jpg);"></div>
                        <div class="container">
                            <div class="sponsors-wrap text-center w-100">
                                <div class="sponsor-inner w-100">
                                    <div class="page-title-inner text-center w-100">
                                        <h1 class="mb-0">{{trans('admin.mqraa_times')}}</h1>
                                    </div>
                                    <br>
                                    <ul class="sponsor-list d-flex flex-wrap align-items-center justify-content-center mb-0 list-unstyled">
                                        {{--                                        <li><a href="{{route('times.show','children')}}" class="thm-btn thm-bg"--}}
                                        {{--                                               style="background-color: blueviolet;" href=""--}}
                                        {{--                                               title="">{{trans('admin.children')}}--}}
                                        {{--                                                <span></span><span></span><span></span><span></span></a></li>--}}
                                        <li><a href="{{route('times.show','female')}}" class="thm-btn thm-bg"
                                               style="background-color: darkcyan;">{{trans('admin.women')}}<span></span><span></span><span></span><span></span></a>
                                        </li>
                                        <li><a href="{{route('times.show','male')}}" class="thm-btn thm-bg"
                                               style="background-color: #c9b288;" href=""
                                               title="">{{trans('admin.men')}}
                                                <span></span><span></span><span></span><span></span></a></li>
                                    </ul>

                                </div>
                            </div>


                        </div>
                    </div>
                </section>

                @foreach($blogs as $blog)
                    <section>
                        <div class="w-100 pt-120 pb-100 position-relative">
                            <div class="container">
                                <div class="about-wrap4 w-100">
                                    <div class="row align-items-center">
                                        <div class="col-md-12 col-sm-12 col-lg-4 order-lg-1">
                                            <div class="about-video position-relative w-100">
                                                <img class="img-fluid w-100" src="{{ url($blog->image) }}"
                                                     alt="{{$blog->title_ar}}">
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-8">
                                            @if(session('lang')=='ar')
                                                <div class="about-inner4 w-100">
                                                    <h2 class="mb-0">{{$blog->title_ar}}</h2>
                                                    <p class="mb-0">{{$blog->desc_ar}}</p>
                                                </div>
                                            @else
                                                <div class="about-inner4 w-100">
                                                    <h2 class="mb-0">{{$blog->title_en}}</h2>
                                                    <p class="mb-0">{{$blog->desc_en}}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                </div><!-- About Wrap 4 -->
                            </div>
                        </div>
                    </section>
                @endforeach
                {{--               <section>--}}
                {{--                <div class="w-100 pb-80 position-relative">--}}
                {{--                    <div class="container">--}}
                {{--                        <div class="sec-title text-center w-100">--}}
                {{--                            <div class="sec-title-inner d-inline-block">--}}
                {{--                                <i class="thm-clr flaticon-rub-el-hizb"></i>--}}
                {{--                                <h2 class="mb-0">{{trans('admin.our_news')}}</h2>--}}
                {{--                            </div>--}}
                {{--                        </div><!-- Sec Title -->--}}
                {{--                        <div class="serv-wrap wide-sec">--}}
                {{--                            <div class="row mrg10 serv-caro">--}}
                {{--                                <div class="col-md-4 col-sm-6 col-lg-3">--}}
                {{--                                    <div class="serv-box text-center pat-bg gray-layer opc85 position-relative back-blend-multiply gray-bg w-100" style="background-image: url(quran/assets/images/pattern-bg.jpg);">--}}
                {{--                                        <i class="flaticon-mat thm-clr"></i>--}}
                {{--                                        <h3 class="mb-0">{{trans('admin.start_class_study')}}</h3>--}}
                {{--                                        <p class="mb-0">{{trans('admin.start_class_study_first')}}</p>--}}
                {{--                                        <a href="javascript:void(0);" title="">{{trans('admin.read_more')}}</a>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}

                {{--                                <div class="col-md-4 col-sm-6 col-lg-3">--}}
                {{--                                    <div class="serv-box text-center pat-bg gray-layer opc85 position-relative back-blend-multiply gray-bg w-100" style="background-image: url(quran/ssets/images/pattern-bg.jpg);">--}}
                {{--                                        <i class="flaticon-quran thm-clr"></i>--}}
                {{--                                        <h3 class="mb-0">{{trans('admin.tadshin')}}</h3>--}}
                {{--                                        <p class="mb-0">{{trans('admin.tadshin_done')}}</p>--}}
                {{--                                        <a href="javascript:void(0);" title="">{{trans('admin.read_more')}}</a>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                                <div class="col-md-4 col-sm-6 col-lg-3">--}}
                {{--                                    <div class="serv-box text-center pat-bg gray-layer opc85 position-relative back-blend-multiply gray-bg w-100" style="background-image: url(quran/assets/images/pattern-bg.jpg);">--}}
                {{--                                        <i class="flaticon-arabic thm-clr"></i>--}}
                {{--                                        <h3 class="mb-0">{{trans('admin.start_class_study')}}</h3>--}}
                {{--                                        <p class="mb-0">{{trans('admin.start_class_study_first')}}</p>--}}
                {{--                                        <a href="javascript:void(0);" title="">{{trans('admin.read_more')}}</a>--}}
                {{--                                    </div>--}}
                {{--                                </div>--}}
                {{--                            </div>--}}
                {{--                        </div><!-- Services Wrap -->--}}
                {{--                    </div>--}}
                {{--                </div>--}}
                {{--        </section>--}}
                <section>
                    <div class="w-100 pt-90 gray-layer pb-110 opc85 position-relative">
                        <div class="fixed-bg patern-bg back-blend-multiply gray-bg"
                             style="background-image: url(quran/assets/images/pattern-bg.jpg);"></div>
                        <div class="container">
                            <div class="sec-title text-center w-100">
                                <div class="sec-title-inner d-inline-block">
                                    <i class="thm-clr flaticon-rub-el-hizb"></i>
                                    <h2 class="mb-0">{{trans('admin.teacher_members')}}</h2>
                                    <p class="mb-0">{{trans('admin.help_you')}}</p>
                                </div>
                            </div><!-- Sec Title -->
                            <div class="team-wrap res-row " style="text-align: center">
                                <div class="row">
                                    @foreach($teachers as $row)
                                        <div class="col-md-4 col-sm-6 col-lg-3">
                                            <div class="team-box text-center w-100">
                                                <div class="team-img overflow-hidden position-relative w-100">
                                                    @if($row->image != null)
                                                        <img class="img-fluid w-100" src="{{$row->image}}"
                                                             alt="Team Image 1">
                                                    @else
                                                        <img class="img-fluid w-100"
                                                             src="{{ asset('uploads/teachers/default_avatar.jpg') }}"
                                                             alt="Team Image 1">
                                                    @endif
                                                    <div
                                                        class="social-links2 text-center d-inline-flex position-absolute">

                                                    </div>
                                                </div>
                                                <div class="team-info">
                                                    <h3 class="mb-0"><a href="scholar-detail.html"
                                                                        title="">{{$row->user_name}}</a></h3>

                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div><!-- Team Wrap -->
                            {{--                            <div class="view-more mt-05 d-inline-block text-center w-100">--}}
                            {{--                                <a class="thm-btn thm-bg" href="scholar-style1.html" title="">More Scholars<span></span><span></span><span></span><span></span></a>--}}
                            {{--                            </div><!-- View More -->--}}
                        </div>
                    </div>
                </section>
                <section>
                    <div class="w-100 pt-90 gray-layer pb-90 opc85 position-relative">
                        <div class="fixed-bg patern-bg back-blend-multiply gray-bg"></div>
                        <div class="container">
                            <div class="sec-title text-center w-100">
                                <div class="sec-title-inner d-inline-block">
                                    <h2 class="mb-0">{{trans('admin.contact_us')}}</h2>
                                </div>
                            </div><!-- Sec Title -->
                            <div class="camp-wrap w-100">
                                <div class="camp-box w-100">
                                    <div class="row mrg align-items-center">
                                        <div class="col-md-12 col-sm-12 col-lg-7 order-lg-1">
                                            <div class="camp-img position-relative w-100">
                                                <iframe
                                                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14333.438226553168!2d43.99006703588188!3d26.087179119728543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1581ec231eaa6f91%3A0x70ed2cd8e83d1c2!2z2LnZhtmK2LLYqSDYp9mE2LPYudmI2K_Zitip!5e0!3m2!1sar!2seg!4v1611331221543!5m2!1sar!2seg"
                                                    width="100%" height="560" frameborder="0" style="border:0;"
                                                    allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-5">
                                            <div
                                                class="camp-info pat-bg thm-layer opc8 position-relative back-blend-multiply thm-bg">
                                                {{ Form::open( ['route' => ['contact_us.store_new'],'method'=>'post' , 'class' => 'cont-form w-100'] ) }}
                                                <input type="text" name="name" required
                                                       placeholder="{{trans('admin.name')}}">
                                                <input type="email" name="email" required
                                                       placeholder="{{trans('admin.email')}}">
                                                <input type="tel" name="phone" required
                                                       placeholder="{{trans('admin.phone')}}">
                                                <textarea placeholder="{{trans('admin.message')}}" name="message"
                                                          required></textarea>
                                                {!! NoCaptcha::renderJs(app()->getLocale(), false, 'recaptchaCallback') !!}
                                                {!! NoCaptcha::display() !!}
                                                <button class="thm-btn bg-black" type="submit"><i
                                                        class="fa fa-envelope"></i>&nbsp;{{trans('admin.send')}}
                                                    <span></span><span></span><span></span><span></span></button>
                                                {{ Form::close() }}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            @endsection
        @section('scripts')
            <script>
                var onloadCallback = function() {
                    alert("grecaptcha is ready!");
                };
            </script>
            <!-- Display the countdown timer in an element -->
                <script>
                    // Set the date we're counting down to
                    var countDownDate = new Date("Apr 30, 2022 15:37:25").getTime();
                    // Update the count down every 1 second
                    var x = setInterval(function () {
                        // Get today's date and time
                        var now = new Date().getTime();
                        // Find the distance between now and the count down date
                        var distance = countDownDate - now;
                        // Time calculations for days, hours, minutes and seconds
                        var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                        var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                        var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                        var seconds = Math.floor((distance % (1000 * 60)) / 1000);
                        // Display the result in the element with id="demo"
                        document.getElementById("demo").innerHTML = days + "d " + hours + "h "
                            + minutes + "m " + seconds + "s ";
                        // If the count down is finished, write some text
                        if (distance < 0) {
                            clearInterval(x);
                            document.getElementById("demo").innerHTML = "inprogress";
                        }
                    }, 1000);
                </script>

@endsection
