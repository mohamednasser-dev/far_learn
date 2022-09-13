@extends('admin_temp')
@section('title')

    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
            {{trans('s_admin.edit')}}
        </h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            @if($data->type == 'college')
                <li class="breadcrumb-item">
                    <a  href="{{route('colleges.index')}}" class="text-muted">{{trans('s_admin.colleges')}}</a>
                </li>
            @else
                <li class="breadcrumb-item">
                    <a  href="{{route('dorr.index')}}" class="text-muted">{{trans('s_admin.dorrs')}}</a>
                </li>
            @endif
        </ul>
    </div>
@endsection
@section('content')
    <div class="card card-custom gutter-b example example-compact">
    <div class="card-body">
        {{ Form::open( ['route' =>'college.update','method'=>'post', 'files'=>'true'] ) }}
        {{ csrf_field() }}
        <input type="hidden" required class="form-control" value="{{$data->id}}" id="txt_id" name="id">

        <div class="form-group row">
            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name_ar')}}</label>
            <div class="col-lg-8">
                <input type="text" required class="form-control" id="txt_name_ar" name="name_ar" value="{{$data->name_ar}}">
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.name_en')}}</label>
            <div class="col-lg-8">
                <input type="text" required class="form-control" id="txt_name_en" name="name_en" value="{{$data->name_en}}">
            </div>
        </div>

        <div class="form-group row">
            <label class="col-lg-4 col-form-label text-lg-right">
                @if($data->type == 'college')
                {{trans('s_admin.manager_name')}}
                @else
                {{trans('s_admin.manager_name_her')}}
                    @endif
            </label>
            <div class="col-lg-8">
                @if($data->type == 'college')
                    @php
                        $teachers = App\Models\Teacher::where('gender','male')->where('status','active')
                                                      ->where('is_new','accepted')->where('is_verified','1')->get();

                    @endphp
                    <input type="hidden" required value="college" name="type">
                @else
                    @php
                        $teachers = App\Models\Teacher::where('gender','female')->where('status','active')
                                                      ->where('is_new','accepted')->where('is_verified','1')->get();
                    @endphp
                    <input type="hidden" required value="dorr" name="type">
                @endif
                @php  $levels = \App\Models\Level::where('deleted','0')->where('type','mogmaa_dorr')->get(); @endphp

                <select name="teacher_id" class="form-control select2" id="kt_select2_4">

                    @foreach($teachers as $row)
                        @if(app()->getLocale() == 'ar')
                            <option value="{{$row->id}}" @if($data->teacher_id == $row->id) selected @endif>{{$row->first_name_ar}}
                                &nbsp;{{$row->mid_name_ar}}&nbsp;{{$row->last_name_ar}}</option>
                        @else
                            <option value="{{$row->id}}" @if($data->teacher_id == $row->id) selected @endif>{{$row->first_name_en}}
                                &nbsp;{{$row->mid_name_en}}&nbsp;{{$row->last_name_en}}</option>
                        @endif
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.time')}}</label>
            <div class="col-lg-8">
                <select class="form-control select2" id="kt_select2_10" name="mogmaa_time"
                        data-select2-id="kt_select2_10" tabindex="-1" aria-hidden="true">
                    <option value="fajr" @if($data->mogmaa_time == "fajr") selected @endif>{{trans('s_admin.fajr')}}</option>
                    <option value="morning"  @if($data->mogmaa_time == "morning") selected @endif>{{trans('s_admin.morning')}}</option>
                    <option value="dhuhr" @if($data->mogmaa_time == "dhuhr") selected @endif>{{trans('s_admin.dhuhr')}}</option>
                    <option value="asr" @if($data->mogmaa_time == "asr") selected @endif>{{trans('s_admin.asr')}}</option>
                    <option value="maghrib" @if($data->mogmaa_time == "maghrib") selected @endif>{{trans('s_admin.maghrib')}}</option>
                    <option value="ishaa" @if($data->mogmaa_time == "ishaa") selected @endif>{{trans('s_admin.ishaa')}}</option>
                </select>
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.type')}}</label>
            <div class="col-lg-8">
                <div class="col-9 col-form-label">
                    <div class="radio-list">
                        @foreach($levels as $row)
                            <label class="radio">
                                <input type="radio" value="{{$row->id}}" @if($data->mogmaa_type == $row->id) checked="checked"@endif name="mogmaa_type">
                                <span></span>
                                @if(app()->getLocale() =='ar')
                                    {{$row->name_ar}}
                                @else
                                    {{$row->name_en}}
                                @endif
                            </label>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.study_days')}}</label>
            <div class="col-lg-8">
                <div class="col-9 col-form-label">
                    <div class="checkbox-list">
                        <label class="checkbox">
                            <input type="checkbox" @if($data->study_days) @if(in_array("1" ,$data->study_days)) checked="checked" @endif @endif name="study_days[]" value="1">
                            <span></span>{{trans('s_admin.sat')}}</label>
                        <label class="checkbox">
                            <input type="checkbox"@if($data->study_days)  @if(in_array("2" ,$data->study_days)) checked="checked" @endif @endif
                            name="study_days[]" value="2">
                            <span></span>{{trans('s_admin.sun')}}</label>
                        <label class="checkbox">
                            <input type="checkbox"
                                   @if($data->study_days) @if(in_array("3" ,$data->study_days)) checked="checked" @endif @endif
                                   name="study_days[]" value="3">
                            <span></span>{{trans('s_admin.mon')}}</label>
                        <label class="checkbox">
                            <input type="checkbox"
                                  @if($data->study_days)  @if(in_array("4" ,$data->study_days)) checked="checked" @endif @endif
                                   name="study_days[]" value="4">
                            <span></span>{{trans('s_admin.tus')}}</label>
                        <label class="checkbox">
                            <input type="checkbox"
                                 @if($data->study_days)   @if(in_array("5" ,$data->study_days)) checked="checked" @endif @endif
                                   name="study_days[]" value="5">
                            <span></span>{{trans('s_admin.wen')}}</label>
                        <label class="checkbox">
                            <input type="checkbox"
                                  @if($data->study_days)  @if(in_array("6" ,$data->study_days)) checked="checked" @endif @endif
                                   name="study_days[]" value="6">
                            <span></span>{{trans('s_admin.ther')}}</label>
                        <label class="checkbox">
                            <input type="checkbox"
                                 @if($data->study_days)   @if(in_array("7" ,$data->study_days)) checked="checked" @endif @endif
                                   name="study_days[]" value="7">
                            <span></span>{{trans('s_admin.fri')}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row">
            <label
                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.study_period')}}</label>
            <div class="col-lg-8">
                <div class="col-9 col-form-label">
                    <div class="checkbox-list">
                        <label class="checkbox">
                            <input type="checkbox"
                                   @if($data->study_period)   @if(in_array("study_classes" ,$data->study_period)) checked="checked" @endif @endif
                                   name="study_period[]" value="study_classes">
                            <span></span>{{trans('s_admin.within_study_classes')}}</label>
                        <label class="checkbox">
                            <input type="checkbox"
                                  @if($data->study_period)    @if(in_array("along_year" ,$data->study_period)) checked="checked" @endif @endif
                                   name="study_period[]" value="along_year">
                            <span></span>{{trans('s_admin.along_year')}}</label>
                        <label class="checkbox">
                            <input type="checkbox"
                                  @if($data->study_period)    @if(in_array("once" ,$data->study_period)) checked="checked" @endif @endif
                                   name="study_period[]" value="once">
                            <span></span>{{trans('s_admin.once')}}</label>
                        <label class="checkbox">
                            <input type="checkbox"
                                  @if($data->study_period)    @if(in_array("specified_period" ,$data->study_period)) checked="checked" @endif @endif
                                   name="study_period[]" value="specified_period">
                            <span></span>{{trans('s_admin.specified_period')}}</label>
                    </div>
                </div>
            </div>
        </div>
        <div class="form-group row" style="text-align: center">
        <button type="submit"
                class="btn btn-primary font-weight-bold" >{{trans('s_admin.edit')}}</button>
        </div>
        {{ Form::close() }}
    </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/create_episode_ajax.js') }}"></script>
@endsection

