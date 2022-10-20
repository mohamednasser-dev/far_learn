@extends('front.layouts.app')

@section('content')
    <!-- .wpo-breadcumb-area start -->
    <div class="wpo-breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>{{trans('s_admin.recover_pass')}}</h2>
                        <ul>
                            <li><a href="{{route('main_page')}}">{{trans('admin.home')}}</a></li>
                            <li><span>{{trans('s_admin.recover_pass')}}</span></li>
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
                        <h2>{{trans('s_admin.please_enter_email')}}</h2>
                        <div class="row">
                            <form method="POST" action="{{ route('reset_password_with_token') }}" id="verify-form">
                                @csrf

                                <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-group">
                                    <input id="email" type="email"
                                           class="form-control @error('email') is-invalid @enderror"
                                           name="email" placeholder="{{ trans('admin.email')}}" required
                                           autocomplete="email" autofocus>
                                </div>
                                <div class="col-lg-12 col-12 form-group">
                                    <button
                                        onclick="event.preventDefault(); document.getElementById('verify-form').submit();"
                                        class="theme-btn" type="submit">{{trans('admin.send')}}</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
