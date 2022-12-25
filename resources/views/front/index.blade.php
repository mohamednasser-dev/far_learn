@extends('front.layouts.app')

@section('content')
    @php $app = \App\Models\Web_setting::where('id',1)->first(); @endphp
    <section class="hero hero-style-1" @if(app()->getLocale() == 'ar') dir="rtl" @endif >
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
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </section>
    <!-- end of hero slider -->
    <br>
    <div class="service-area-2">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wpo-section-title">
                        <img src="{{url('/')}}/quran/assets/images/bism-img1.png" alt="">
                        <br>
                        <h2>{{trans('admin.who_are_us')}}</h2>
                    </div>
                </div>
            </div>
            <div class="service-wrap">
                <div class="row" style="text-align: center;">
                    <p>
                        @if(app()->getLocale() == 'ar')
                            {{$app->about_ar}}
                        @else
                            {{$app->about_en}}
                        @endif
                    </p>
                </div>
            </div>
        </div>
    </div>
    <!-- wpo-about-area end -->
    <!-- service-area-start -->
    @if(count($teachers) > 0)
        <div class="service-area-2">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wpo-section-title">
                            <h2>{{trans('admin.teacher_members')}}</h2>
                            <span>{{trans('admin.help_you')}}</span>
                        </div>
                    </div>
                </div>
                <div class="service-wrap">
                    <div class="row" style="text-align: center;">
                        @foreach($teachers as $row)
                            <div class="col-lg-4 col-md-4 col-sm-6 custom-grid col-12">
                                <div class="service-single-item">
                                    <div class="service-single-img">
                                        <img style="width: 290px;height: 290px;" src="{{$row->image}}" alt="Team Image 1">
                                    </div>
                                    <div class="service-text">
                                        <h2>{{$row->user_name}}</h2>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    @endif
    <!-- service-area-end -->
    <!-- payment-section start-->
    <div class="payment-section">
        <div class="container">
            <div class="row" style="margin-bottom: 100px;text-align:center">
                <div class="col-md-6 p-2">
                    <div class="payment-text" style="border-radius: 10px;overflow:hidden">
                        <iframe
                            src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d14333.438226553168!2d43.99006703588188!3d26.087179119728543!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x1581ec231eaa6f91%3A0x70ed2cd8e83d1c2!2z2LnZhtmK2LLYqSDYp9mE2LPYudmI2K_Zitip!5e0!3m2!1sar!2seg!4v1611331221543!5m2!1sar!2seg"
                            width="100%" height="560" frameborder="0" style="border:0;"
                            allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
                    </div>
                </div>
                <div class="col-md-6 p-2">
                    <div class="wpo-donations-form">
                        <h2>{{trans('admin.contact_us')}}</h2>
                        <div class="row">
                            <div class="camp-info pat-bg thm-layer opc8 position-relative back-blend-multiply thm-bg">
                                {{ Form::open( ['route' => ['contact_us.store_new'],'method'=>'post'] ) }}
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-group">
                                    <input type="text" name="name" required class="form-control"
                                           placeholder="{{trans('admin.name')}}" style="background-color: #fff">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-group">
                                    <input type="email" name="email" required class="form-control"
                                           placeholder="{{trans('admin.email')}}" style="background-color: #fff">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-group">
                                    <input type="tel" name="phone" required class="form-control"
                                           placeholder="{{trans('admin.phone')}}" style="background-color: #fff">
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-group">
                                <textarea placeholder="{{trans('admin.message')}}" class="form-control" name="message"
                                          required style="background-color: #fff; border:none;outline: none; resize: none; border-radius:10px" ></textarea>
                                </div>
                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-group">
                                    {!! NoCaptcha::renderJs(app()->getLocale(), false, 'recaptchaCallback') !!}
                                    {!! NoCaptcha::display() !!}
                                    <div class="col-lg-12 col-12 form-group" type="submit">
                                        <button class="theme-btn" type="submit" style="overflow: hidden">{{trans('admin.send')}}</button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- payment-section end-->
@endsection

