@extends('front.layouts.temp')
@section('content')
    <div class="container">
        <div class="sec-title text-center w-100">
            <div class="sec-title-inner d-inline-block">
                <h4 class="mb-0" style="color: green;padding-top: 20px;">@if(session('lang') == 'ar') استرجاع كلمة
                    المرور  @else Forget Password @endif </h4>
            </div>
        </div><!-- Sec Title -->
        <div class="prod-wrap overlap-150 prod-caro w-100 slick-initialized slick-slider">
            <div class="card">
                <div class="card-body" style="background-color: beige;">
                    <div class="card-body">
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <form method="POST" action="{{ route('reset_password_with_token') }}" id="verify-form">
                            @csrf
                            <div class="form-body">
                                <div class="row p-t-20">
                                    @include('admin.layouts.errors')
                                    @include('admin.layouts.messages')
                                </div>
                                <div class="row p-t-20">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <h6 style="text-align: center; color: brown;">{{trans('s_admin.please_enter_email')}}</h6>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input id="email" type="email"
                                                   class="form-control @error('email') is-invalid @enderror"
                                                   name="email" placeholder="{{ trans('admin.email')}}" required
                                                   autocomplete="email" autofocus>
                                        </div>
                                    </div>
                                    <div class="col-md-12" style="text-align: center;">
                                        <a href="javascript:void(0);"
                                           onclick="event.preventDefault(); document.getElementById('verify-form').submit();"
                                           style="width: 122px;font-size: smaller;" class="thm-btn mini-btn thm-bg">
                                            {{trans('admin.send')}}
                                            <span></span><span></span><span></span><span></span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    resend--}}
    <div id="teacher_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog">
            <div class="modal-content" style="">
                <div class="modal-header row">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{trans('admin.choose_type_epo')}}</h5>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <input name="email" type="email">
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
