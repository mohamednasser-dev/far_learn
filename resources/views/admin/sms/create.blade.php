@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_send_sms')}}</h5>
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
                       href="#kt_builder_themes">{{trans('s_admin.sms_info')}}</a>
                </li>
            </ul>
        </div>
        {!! Form::model(null, ['route' => ['sms.settings.store'] , 'method'=>'post' ]) !!}
        <div class="card-body">
            <div class="tab-content pt-3">
                <!--begin::Tab Pane-->
                <div class="tab-pane active" id="kt_builder_themes">
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.msg')}}</label>
                        <div class="col-lg-9 col-xl-9">
                            <div class="input-group">
{{--                                <input type="text" required name="message" class="form-control form-control-solid">--}}
                                <textarea type="text" minlength="1"  maxlength="70" required rows="5" name="message" class="form-control"></textarea>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row">
                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.receiver')}}</label>
                        <div class="col-lg-9 col-xl-9">
                            <div class="input-group ">
                                <select required name="type" id="cmb_type" class="form-control form-control-lg">
                                    <option disabled selected>{{trans('s_admin.choose_receiver')}}</option>
                                    <option value="student">{{trans('s_admin.student')}}</option>
                                    <option value="teacher">{{trans('s_admin.teacher_2')}}</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="student_cont" style="display: none;">
                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.student')}}</label>
                        <div class="col-lg-9 col-xl-9">
                            <div class="input-group">
                                <select required name="student_receiver_id"class="form-control select2" style="width: 100%;"
                                        id="kt_select2_1">
                                    <option disabled >{{trans('s_admin.choose_student')}}</option>
                                    @foreach($students as $row)
                                        <option value="{{$row->id}}">{{$row->user_name}} &nbsp; &nbsp; &nbsp; &nbsp; {{$row->country_code}}{{$row->phone}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                    <div class="form-group row" id="teacher_cont" style="display: none;">
                        <label class="col-lg-3 col-form-label text-lg-right">{{trans('s_admin.teacher_2')}}</label>
                        <div class="col-lg-9 col-xl-9">
                            <div class="input-group">
                                <select required name="teacher_receiver_id" id="kt_select2_2" class="form-control form-control-lg select2"  style="width: 100%;">
                                    <option disabled >{{trans('s_admin.choose_teacher')}}</option>
                                    @foreach($teachers as $row)
                                        <option value="{{$row->id}}">{{$row->user_name}} &nbsp; &nbsp; &nbsp; &nbsp; {{$row->country_code}}{{$row->phone}}</option>
                                    @endforeach
                                </select>

                            </div>
                        </div>
                    </div>
                </div>
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
                            class="btn btn-primary font-weight-bold mr-2">{{trans('s_admin.send')}}</button>
                </div>
            </div>
        </div>
        <!--end::Footer-->
    {{ Form::close() }}
    <!--end::Form-->
    </div>
@endsection
@section('scripts')
{{--    cmb_type--}}
    <script>
        $(document).ready(function () {
            $('#cmb_type').change(function(){
                if($(this).val() == "student"){
                    $('#student_cont').show();
                    $('#teacher_cont').hide();
                }else{
                    $('#student_cont').hide();
                    $('#teacher_cont').show();
                }
            });
        });
    </script>
@endsection
