@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_settings_connect_sms')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_center_notifications')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('styles')
    <link href="{{ asset('metronic/assets/css/pages/wizard/wizard-4.css') }}" rel="stylesheet" type="text/css"/>
@endsection
@section('content')
    <div class="card card-custom">
        <div class="card-header card-header-tabs-line">
            <ul class="nav nav-dark nav-bold nav-tabs nav-tabs-line" data-remember-tab="tab_id" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab"
                       href="#kt_builder_themes">{{trans('s_admin.nav_settings_connect_sms')}}</a>
                </li>
            </ul>
        </div>
        {!! Form::model($sms_settings, ['route' => ['sms.update'] , 'method'=>'post' ]) !!}
        <div class="card-body">
            <div class="tab-content pt-3">
                <div class="tab-pane active" id="kt_builder_themes">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.encoding')}}</label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="input-group input-group-solid">
                                <input type="text" required name="encoding"
                                       value="{{$sms_settings->encoding}}" class="form-control form-control-solid"
                                >
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">Api URL</label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="input-group input-group-solid">
                                <input type="text" required name="url"
                                       value="{{$sms_settings->url}}" class="form-control form-control-solid"
                                >
                            </div>
                        </div>
                    </div>
{{--                    <div class="form-group row">--}}
{{--                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.encoding_value')}}</label>--}}
{{--                        <div class="col-lg-9 col-xl-4">--}}
{{--                            <div class="input-group input-group-solid">--}}
{{--                                <input type="text" required name="encoding_value"--}}
{{--                                       value="{{$sms_settings->encoding_value}}"--}}
{{--                                       placeholder="encoding_value" class="form-control form-control-solid"--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group row">

                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.user_id')}}</label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="input-group input-group-solid">
                                <input type="text" required name="user_id"
                                       value="{{$sms_settings->user_id}}"
                                       placeholder="user_id" class="form-control form-control-solid"
                                >
                            </div>
                        </div>
                    </div>

{{--                    <div class="form-group row">--}}

{{--                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.user_id_value')}}</label>--}}
{{--                        <div class="col-lg-9 col-xl-4">--}}
{{--                            <div class="input-group input-group-solid">--}}
{{--                                <input type="text" required name="user_id_value"--}}
{{--                                       value="{{$sms_settings->user_id_value}}"--}}
{{--                                       placeholder="user_id_value" class="form-control form-control-solid"--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                    <div class="form-group row">--}}

{{--                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.to')}}</label>--}}
{{--                        <div class="col-lg-9 col-xl-4">--}}
{{--                            <div class="input-group input-group-solid">--}}
{{--                                <input type="text" required name="to"--}}
{{--                                       value="{{$sms_settings->to}}"--}}
{{--                                       placeholder="to" class="form-control form-control-solid"--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                    <div class="form-group row">

                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.password')}}</label>
                        <div class="col-lg-9 col-xl-4">
                            <div class="input-group input-group-solid">
                                <input type="text" required name="password"
                                       value="{{$sms_settings->password}}"
                                       placeholder="password" class="form-control form-control-solid"
                                >
                            </div>
                        </div>
                    </div>
{{--                    <div class="form-group row">--}}

{{--                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.password_value')}}</label>--}}
{{--                        <div class="col-lg-9 col-xl-4">--}}
{{--                            <div class="input-group input-group-solid">--}}
{{--                                <input type="text" required name="password_value"--}}
{{--                                       value="{{$sms_settings->password_value}}"--}}
{{--                                       placeholder="password_value" class="form-control form-control-solid"--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group row">--}}

{{--                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.msg')}}</label>--}}
{{--                        <div class="col-lg-9 col-xl-4">--}}
{{--                            <div class="input-group input-group-solid">--}}
{{--                                <input type="text" required name="msg"--}}
{{--                                       value="{{$sms_settings->msg}}"--}}
{{--                                       placeholder="msg" class="form-control form-control-solid"--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group row">--}}

{{--                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.sender')}}</label>--}}
{{--                        <div class="col-lg-9 col-xl-4">--}}
{{--                            <div class="input-group input-group-solid">--}}
{{--                                <input type="text" required name="sender"--}}
{{--                                       value="{{$sms_settings->sender}}"--}}
{{--                                       placeholder="sender" class="form-control form-control-solid"--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

{{--                    <div class="form-group row">--}}

{{--                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.sender_value')}}</label>--}}
{{--                        <div class="col-lg-9 col-xl-4">--}}
{{--                            <div class="input-group input-group-solid">--}}
{{--                                <input type="text" required name="sender_value"--}}
{{--                                       value="{{$sms_settings->sender_value}}"--}}
{{--                                       placeholder="sender_value" class="form-control form-control-solid"--}}
{{--                                >--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </div>--}}

                </div>
                <!--end::Tab Pane-->
                <!--begin::Tab Pane-->

            </div>
        </div>
        <!--end::Body-->
        <!--begin::Footer-->
        <div class="card-footer">
            <div class="row">
                <div class="col-lg-3"></div>
                <div class="col-lg-9">
                    <input type="hidden" id="tab_id" name="builder[tab][tab_id]">
                    <input type="hidden" id="tab_extra_id" name="builder[tab][tab_extra_id]">
                    <button type="submit" name="builder_submit" data-demo="demo1"
                            class="btn btn-primary font-weight-bold mr-2">{{trans('s_admin.save')}}</button>
                </div>
            </div>
        </div>
        <!--end::Footer-->
    {{ Form::close() }}
    <!--end::Form-->
    </div>
@endsection
@section('scripts')
@endsection
