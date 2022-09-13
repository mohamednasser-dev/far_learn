@extends('front.layouts.temp')
@section('content')
    <div class="container">
        <div class="sec-title text-center w-100">
            <div class="sec-title-inner d-inline-block">
                <h4 class="mb-0" style="color: green;padding-top: 20px;">{{trans('admin.check')}}</h4>
            </div>
        </div><!-- Sec Title -->
        <div class="prod-wrap overlap-150 prod-caro w-100 slick-initialized slick-slider">
            <div class="card">
                <div class="card-body" style="background-color: beige;">
                    <form action="{{route('verify_account')}}" method="post" id="verify-form">
                        @csrf
                        <input type="hidden" required name="email" value="{{$email}}">
                        <input type="hidden" required name="type" value="{{$person_type}}">
                        <div class="form-body">
                            <div class="row p-t-20">
                                @include('admin.layouts.errors')
                                @include('admin.layouts.messages')
                            </div>
                            <div class="row p-t-20">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <h4 style="text-align: center;">{{trans('admin.you_are_about_end')}}</h4>
                                        <h6 style="text-align: center; color: brown;">{{trans('admin.code_send_to_yo')}}</h6>
                                        <h6 style="text-align: center; color: brown;">{{trans('admin.must_confirm_email')}}</h6>
                                    </div>
                                    <div class="form-group" style="padding-left: 200px;padding-right: 200px;">
                                        <input id="txt_f_name" type="text" required name="code" class="form-control" placeholder="{{trans('admin.write_code_here')}}">
                                    </div>
                                </div>
                                <div class="col-md-12" style="text-align: center;">
                                    <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('verify-form').submit();" style="width: 122px;font-size: smaller;" class="thm-btn mini-btn thm-bg">
                                        {{trans('admin.verify')}}
                                        <span></span><span></span><span></span><span></span>
                                    </a>
                                    <a href="javascript:void(0);" onclick="event.preventDefault(); document.getElementById('resend-form').submit();" class="thm-btn mini-btn thm-bg"
                                            style="width: 150px; background-color: brown;font-size: smaller;">
                                        {{trans('s_admin.resend')}}
                                        <span></span><span></span><span></span><span></span></a>
                                </div>
                            </div>
                        </div>
                    </form>
                    <form action="{{route('resend.verify.email')}}" style="display: none;" method="post" id="resend-form">
                        @csrf
                        <input type="hidden" required name="email" value="{{$email}}">
                        <input type="hidden" required name="type" value="{{$person_type}}">
                    </form>
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
