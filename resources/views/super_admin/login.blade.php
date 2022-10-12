@extends('front.layouts.app')

@section('content')
    <!-- .wpo-breadcumb-area start -->
    <div class="wpo-breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>{{trans('admin.login')}}</h2>
                        <ul>
                            <li><a href="{{route('main_page')}}">{{trans('admin.home')}}</a></li>
                            <li><span>{{trans('admin.login')}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .wpo-breadcumb-area end -->

    <!-- start wpo-contact-form-map -->
    <section class="wpo-contact-form-map section-padding">
        <div class="container">
            <div class="row">
                <div class="col-5">
                    <div class="row" style="text-align: center;">
                        <div class="contact-form">
                            <h2>{{trans('admin.login')}}</h2>
                            {{ Form::open( ['route'  => ['login_both'],'method'=>'post' ] ) }}
                            <div>
                                <input type="number" style="background-color: aliceblue;"
                                       onkeyup="this.value=login_phone(this.value);"
                                       required name="phone" value="{{old('phone')}}"
                                       placeholder="{{trans('s_admin.phone')}}"
                                       class="form-control" id="recipient-name1">
                            </div>
                            <div>
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
                            <div class="clearfix">
                                <input type="password" required name="password"
                                       placeholder="{{trans('admin.password')}}"
                                       class="form-control" id="recipient-name1">
                            </div>
                            <div>
                                <button type="submit" class="theme-btn">{{trans('admin.login')}}</button>
                            </div>
                            {{ Form::close() }}
                        </div>

                    </div>
                </div>
            </div>
        </div> <!-- end container -->
    </section>
@endsection
