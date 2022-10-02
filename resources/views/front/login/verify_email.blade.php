@extends('front.layouts.app')

@section('content')
    <!-- .wpo-breadcumb-area start -->
    <div class="wpo-breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>{{trans('admin.page_forgot_Pass')}}</h2>
                        <ul>
                            <li><a href="{{route('main_page')}}">{{trans('admin.home')}}</a></li>
                            <li><span>{{trans('admin.page_forgot_Pass')}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .wpo-breadcumb-area end -->
    <div class="payment-section section-padding">
        <div class="container">
            <div class="row">
                @if (session('status'))
                    <div class="col-md-12" style="text-align-last: center;">
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    </div>
                @endif
                <div class="col-md-12" style="text-align-last: center;">
                    @include('front.layouts.errors')
                    @include('front.layouts.messages')
                </div>
                <div class="col-md-12" style="text-align-last: center;">
                    <div class="wpo-donations-form">
                        <h3 style="text-align: center;">{{trans('admin.you_are_about_end')}}</h3>
                        <h3 style="text-align: center; color: brown;">{{trans('admin.code_send_to_yo')}}</h3>
                        <h3 style="text-align: center; color: brown;">{{trans('admin.must_confirm_email')}}</h3>
                        <div class="row">
                            <form action="{{route('verify_account')}}" method="post" id="verify-form">
                                @csrf
                                <input type="hidden" required name="email" value="{{$email}}">
                                <input type="hidden" required name="type" value="{{$person_type}}">

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-group">
                                    <input id="txt_f_name" type="text" required name="code" class="form-control"
                                           placeholder="{{trans('admin.write_code_here')}}">

                                </div>
                                <div class="col-lg-6 col-6 form-group">
                                    <a href="javascript:void(0);"
                                       onclick="event.preventDefault(); document.getElementById('verify-form').submit();"
                                       style="width: 122px;font-size: smaller;" class="theme-btn">
                                        {{trans('admin.verify')}}
                                    </a>
                                </div>
                                <div class="col-lg-6 col-6 form-group">
                                    <a href="javascript:void(0);"
                                       onclick="event.preventDefault(); document.getElementById('resend-form').submit();"
                                       class="theme-btn"
                                       style="width: 150px; background-color: brown;font-size: smaller;">
                                        {{trans('s_admin.resend')}}
                                    </a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
