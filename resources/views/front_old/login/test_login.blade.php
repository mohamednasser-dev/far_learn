@extends('front.layouts.temp')
@section('styles')
    {{--    <link rel="stylesheet" href="{{url('/')}}/build/css/intlTelInput.css">--}}
    {{--    <link rel="stylesheet" href="{{url('/')}}/build/css/demo.css">--}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css"/>
    {{--<link href="{{url('/')}}/hijri/css/bootstrap.css" rel="stylesheet" />--}}
    <link href="{{url('/')}}/hijri/css/bootstrap-datetimepicker.css" rel="stylesheet"/>

    <style>
        .stepwizard-step p {
            margin-top: 0px;
            color: #666;
        }

        .stepwizard-row {
            display: table-row;
        }

        .stepwizard {
            display: table;
            width: 100%;
            position: relative;
        }

        .btn-default {
            color: #fff;
            background-color: #0196ff;
            border-color: #0196ff;
        }

        .stepwizard-step button[disabled] {
            /*opacity: 1 !important;
            filter: alpha(opacity=100) !important;*/
        }

        .stepwizard .btn.disabled, .stepwizard .btn[disabled], .stepwizard fieldset[disabled] .btn {
            opacity: 1 !important;
            color: #bbb;
        }

        .stepwizard-row:before {
            top: 14px;
            bottom: 0;
            position: absolute;
            content: " ";
            width: 100%;
            height: 1px;
            background-color: inherit;
            z-index: 0;
        }

        .stepwizard-step {
            display: table-cell;
            text-align: center;
            position: relative;
        }

        .btn-circle {
            width: 30px;
            height: 30px;
            text-align: center;
            padding: 6px 0;
            font-size: 12px;
            line-height: 1.428571429;
            border-radius: 4px;
        }

        .btn-success {
            color: #fff;
            background-color: #28a745;
            border-color: #28a745;
        }
    </style>
@endsection
@section('content')
    <div class="prod-wrap overlap-150 prod-caro w-100 slick-initialized slick-slider">
        <div class="card">
            <div class="w-100 pb-250 position-relative"
                 style="background-image: url(/quran/assets/images/register.png)">
                <div class="container">
                    <div class="contact-wrap mt-50 w-100">
                        <div class="row">
                            <div class="row p-t-20">
                                @include('admin.layouts.errors')
                                @include('admin.layouts.messages')
                            </div>
                            <div class="col-md-3 col-sm-12 col-lg-3">
                            </div>
                            <div class="col-md-6 col-sm-12 col-lg-6" style="padding-top: 75px">
                                <div class="stepwizard">
                                    <div class="stepwizard-row setup-panel">
                                        <div class="stepwizard-step col-xs-12">
                                            <a href="javascript:;" secc="#step-1" type="button"
                                               class="btn btn-default btn-success btn-bg btn-circle "
                                               style="pointer-events: none;cursor: default;">
                                                1</a>
                                            {{--                                            <p><small></small>{{trans('s_admin.basic_data')}}</p>--}}
                                        </div>
                                        <div class="stepwizard-step col-xs-12">
                                            <a href="javascript:;" secc="#step-2" type="button"
                                               class="btn btn-default btn-circle "
                                               disabled="disabled" style="pointer-events: none;cursor: default;">
                                                2</a>
                                            {{--                                            <p><small></small>{{trans('s_admin.login_data')}}</p>--}}
                                        </div>
                                        {{--                                        <div class="stepwizard-step col-xs-12">--}}
                                        {{--                                            <a href="javascript:;" secc="#step-3" type="button"--}}
                                        {{--                                               class="btn btn-default btn-circle "--}}
                                        {{--                                               disabled="disabled" style="pointer-events: none;cursor: default;">3</a>--}}
                                        {{--                                            <p><small></small>{{trans('s_admin.connect_data')}}</p>--}}
                                        {{--                                        </div>--}}
                                        {{--                                        <div class="stepwizard-step col-xs-12">--}}
                                        {{--                                            <a href="javascript:;" secc="#step-4" type="button"--}}
                                        {{--                                               class=" btn btn-default btn-circle "--}}
                                        {{--                                               disabled="disabled" style="pointer-events: none;cursor: default;">--}}
                                        {{--                                                4--}}
                                        {{--                                            </a>--}}
                                        {{--                                            <p><small></small>{{trans('s_admin.additional_data')}}</p>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                </div>
                                {{ Form::open( ['route'  => ['store.new',$types],'method'=>'post' , 'class'=>'form','files'=>true] ) }}
                                <input type="hidden" name="episode_id" value="{{$episode_id}}">
                                <div class="panel panel-primary setup-content" id="step-1">
                                    <div class="panel-heading">
                                        <h3 class="panel-title"></h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="form-group">
                                            <label class="control-label">{{trans('admin.first_name')}}</label><span
                                                style="color: red;">*</span>
                                            <input id="txt_f_name" type="text" required name="first_name_ar"
                                                   class="form-control" value="{{old('first_name_ar')}}" placeholder="">
                                        </div>
                                        <div class="form-group has-danger">
                                            <label class="control-label">{{trans('admin.mid_name')}}</label><span
                                                style="color: red;">*</span>
                                            <input id="txt_m_name" type="text" required name="mid_name_ar"
                                                   class="form-control form-control-danger"
                                                   value="{{old('mid_name_ar')}}" placeholder="">
                                        </div>
                                        <div class="form-group has-danger">
                                            <label class="control-label">{{trans('admin.last_name')}}</label><span
                                                style="color: red;">*</span>
                                            <input id="txt_l_name" type="text" required name="last_name_ar"
                                                   class="form-control form-control-danger"
                                                   value="{{old('last_name_ar')}}" placeholder="">
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">{{trans('admin.gender')}}</label><span
                                                style="color: red;">*</span>
                                            <select id="txt_gender" name="gender" required
                                                    class="form-control custom-select">
                                                <option value="male"
                                                        @if(old('gender') == 'male' ) selected @endif >{{trans('admin.male')}}</option>
                                                <option value="female"
                                                        @if(old('gender') == 'female' ) selected @endif >{{trans('admin.female')}}</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label class="control-label">{{trans('admin.main_lang')}}</label><span
                                                style="color: red;">*</span>
                                            <select id="txt_lang" class="form-control custom-select" required
                                                    name="main_lang">
                                                <option>{{trans('s_admin.choose_language')}}</option>
                                                <option value="ar" @if(old('main_lang') == 'ar' ) selected @endif >
                                                    العربية
                                                </option>
                                                <option value="en" @if(old('main_lang') == 'en' ) selected @endif >
                                                    English
                                                </option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label
                                                class="control-label">{{trans('admin.date_of_birth')}}</label><span
                                                style="color: red;">*</span>
                                            <input id="txt_date" type="text" required name="date_of_birth"
                                                   value="{{old('date_of_birth')}}"
                                                   class="form-control hijri-date-input">
                                        </div>
                                        @if($types != 'teacher_far_learn' )
                                            @if($types != 'teacher_mogmaa_dorr')
                                                <div id="parent_access" style="display: none; background-color: antiquewhite;">
                                                    <p>{{trans('s_admin.parent_data')}}:</p>
                                                    <div class="form-group has-danger">
                                                        <label class="control-label">{{trans('admin.full_name')}}</label><span
                                                            style="color: red;">*</span>
                                                        <input type="text"  id="user_name" name="parent_user_name" class="form-control form-control-danger" placeholder="">
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-8">
                                                            <div class="form-group">
                                                                <label
                                                                    class="control-label">{{trans('admin.full_name')}}</label><span
                                                                    style="color: red;">*</span>
                                                                <input type="text" id="user_name" name="parent_user_name"
                                                                       class="form-control form-control-danger" placeholder="">
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-md-8">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="control-label">{{trans('admin.phone')}}</label><span
                                                                            style="color: red;">*</span>
                                                                        <input id="phone" type="number"
                                                                               onkeyup="this.value=phonelimit(this.value);"
                                                                               name="parent_phone"
                                                                               class="form-control form-control-danger">
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-4">
                                                                    <div class="form-group">
                                                                        <label
                                                                            class="control-label">{{trans('admin.country_code')}}</label><span
                                                                            style="color: red;">*</span><br>
                                                                        <input id="txt_parent_country_code"
                                                                               style="max-width: 30px;"
                                                                               value="+966"
                                                                               type="text"
                                                                               name="parent_country_code"
                                                                               class="form-control form-control-danger">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group has-danger">
                                                                <label class="control-label">{{trans('admin.relation')}}</label><span
                                                                    style="color: red;">*</span>
                                                                <select name="relation" class="form-control custom-select">
                                                                    @php $relations = \App\Models\Relation::where('deleted','0')->get(); @endphp
                                                                    @foreach($relations as $row)
                                                                        <option
                                                                            value="{{ $row->id }}"> {{ $row->name }} </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            <div class="form-group has-danger">
                                                                <label
                                                                    class="control-label">{{trans('admin.address')}}</label><span
                                                                    style="color: red;">*</span>
                                                                <input type="text" id="address" name="address"
                                                                       class="form-control form-control-danger" placeholder="">
                                                            </div>
                                                        </div>
                                                        @endif
                                                        @endif
                                                    </div>
                                                    <button class="btn btn-primary nextBtn pull-right"
                                                            type="button">{{trans('admin.next')}}</button>
                                                </div>
                                                <div class="panel panel-primary setup-content" id="step-2">
                                                    <div class="panel-heading">
                                                        <h3 class="panel-title"></h3>
                                                    </div>
                                                    <div class="panel-body">
                                                        <div class="row">
                                                            <div class="col-md-8">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="control-label">{{trans('admin.phone')}}</label><span
                                                                        style="color: red;">*</span>
                                                                    <input id="txt_phone" type="number" required
                                                                           onkeyup="this.value=phonelimit(this.value);"
                                                                           name="phone" value="{{old('phone')}}"
                                                                           class="form-control form-control-danger">
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4">
                                                                <div class="form-group">
                                                                    <label
                                                                        class="control-label">{{trans('admin.country_code')}}</label><span
                                                                        style="color: red;">*</span><br>
                                                                    <input id="txt_country_code" style="max-width: 30px;"
                                                                           @if(old('country_code'))
                                                                           value="{{old('country_code')}}"
                                                                           @else
                                                                           value="+966"
                                                                           @endif
                                                                           type="text"
                                                                           required name="country_code"
                                                                           class="form-control form-control-danger">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group has-danger">
                                                            <label class="control-label">{{trans('admin.email')}}</label><span
                                                                style="color: red;">*</span>
                                                            <input id="txt_email" type="email" name="email"
                                                                   value="{{old('email')}}" class="form-control  form-control-danger"
                                                                   required>
                                                        </div>
                                                        <div class="form-group">
                                                            @php $qualifications = \App\Models\Qualification::where('deleted','0')->get(); @endphp
                                                            <label
                                                                class="control-label">{{trans('s_admin.qualification')}}</label><span
                                                                style="color: red;">*</span>
                                                            <select id="txt_qualification" name="qualification" required
                                                                    class="form-control custom-select">
                                                                @foreach($qualifications as $row)
                                                                    <option value="{{$row->id}}"
                                                                            @if(old('qualification') == $row->id ) selected @endif >
                                                                        @if(app()->getLocale() == 'ar')
                                                                            {{$row->name_ar}}
                                                                        @else
                                                                            {{$row->name_en}}
                                                                        @endif
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group has-danger">
                                                            @php $countries = \App\Models\Country::where('deleted','0')->get(); @endphp
                                                            <label class="control-label">{{trans('admin.country')}}</label><span
                                                                style="color: red;">*</span>
                                                            <select id="cmb_country" required class="form-control custom-select"
                                                                    name="country">
                                                                <option value="" selected>{{trans('s_admin.choose_country')}}</option>
                                                                @foreach($countries as $row)
                                                                    <option value="{{$row->id}}"
                                                                            @if(old('country') == $row->id ) selected @endif >
                                                                        @if(app()->getLocale() == 'ar')
                                                                            {{$row->name_ar}}
                                                                        @else
                                                                            {{$row->name_en}}
                                                                        @endif
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        @if($types != 'teacher_far_learn' && $types != 'teacher_mogmaa_dorr')
                                                            @if($types != 'far_learn' )
                                                                <div class="form-group" style="display:none;" id="zones_cont">
                                                                    @php $zones = App\Models\Zone::where('deleted','0')->get(); @endphp
                                                                    <label
                                                                        class="control-label">{{trans('s_admin.zones')}}</label><span
                                                                        style="color: red;">*</span>
                                                                    <select required name="zone_id" id="cmb_zones"
                                                                            class="form-control custom-select">
                                                                        <option value=""
                                                                                disabled>{{trans('s_admin.choose_zone')}}</option>
                                                                        @foreach($zones as $row)
                                                                            <option value="{{$row->id}}"
                                                                                    @if(old('zone_id') == $row->id ) selected @endif >
                                                                                @if(app()->getLocale() == 'ar')
                                                                                    {{$row->name}}
                                                                                @else
                                                                                    {{$row->name}}
                                                                                @endif
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group" style="display:none;" id="city_cont">
                                                                    @php $cities = App\Models\City::where('deleted','0')->get(); @endphp
                                                                    <label
                                                                        class="control-label">{{trans('s_admin.city')}}</label><span
                                                                        style="color: red;">*</span>
                                                                    <select required name="city_id" id="cmb_cities"
                                                                            class="form-control custom-select">
                                                                        <option value=""
                                                                                disabled>{{trans('s_admin.choose_city')}}</option>
                                                                        @foreach($cities as $row)
                                                                            <option value="{{$row->id}}"
                                                                                    @if(old('city_id') == $row->id ) selected @endif >
                                                                                @if(app()->getLocale() == 'ar')
                                                                                    {{$row->name}}
                                                                                @else
                                                                                    {{$row->name}}
                                                                                @endif
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group" style="display:none;" id="districts_cont">
                                                                    @php $district = App\Models\District::where('deleted','0')->get(); @endphp
                                                                    <label
                                                                        class="control-label">{{trans('s_admin.district_S')}}</label><span
                                                                        style="color: red;">*</span>
                                                                    <select required name="district_id" id="cmb_districts"
                                                                            class="form-control custom-select">
                                                                        <option value=""
                                                                                selected>{{trans('s_admin.choose_district')}}</option>
                                                                        @foreach($district as $row)
                                                                            <option value="{{$row->id}}"
                                                                                    @if(old('district_id') == $row->id ) selected @endif >
                                                                                @if(app()->getLocale() == 'ar')
                                                                                    {{$row->name}}
                                                                                @else
                                                                                    {{$row->name}}
                                                                                @endif
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            @endif

                                                            <div class="form-group">
                                                                @php $levels = App\Models\Level::where('type',$types)->where('deleted','0')->get(); @endphp
                                                                <label
                                                                    class="control-label">{{trans('s_admin.level')}}</label><span
                                                                    style="color: red;">*</span>
                                                                <select required name="level_id" id="cmb_levels"
                                                                        class="form-control custom-select">
                                                                    <option value="" selected>{{trans('s_admin.choose_level')}}</option>
                                                                    @foreach($levels as $row)
                                                                        <option value="{{$row->id}}"
                                                                                @if(old('level_id') == $row->id ) selected @endif >
                                                                            @if(app()->getLocale() == 'ar')
                                                                                {{$row->name_ar}}
                                                                            @else
                                                                                {{$row->name_en}}
                                                                            @endif
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            @if($types != 'far_learn' )
                                                                <div class="form-group" id="subject_cont" style="display:none;">
                                                                    @php $subjects = App\Models\Subject::where('deleted','0')->get(); @endphp
                                                                    <label
                                                                        class="control-label">{{trans('s_admin.subject')}}</label><span
                                                                        style="color: red;">*</span>
                                                                    <select required name="subject_id" id="cmb_sign_up_subject"
                                                                            class="form-control custom-select">
                                                                        <option value=""
                                                                                selected>{{trans('s_admin.choose_subject')}}</option>
                                                                        @foreach($subjects as $row)
                                                                            <option value="{{$row->id}}"
                                                                                    @if(old('subject_id') == $row->id ) selected @endif >
                                                                                @if(app()->getLocale() == 'ar')
                                                                                    {{$row->name_ar}}
                                                                                @else
                                                                                    {{$row->name_en}}
                                                                                @endif
                                                                            </option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group" id="subject_level_cont" style="display:none;">
                                                                    <label
                                                                        class="control-label">{{trans('s_admin.subject_level')}}</label><span
                                                                        style="color: red;">*</span>
                                                                    @if(app()->getLocale() == 'ar')
                                                                        {{ Form::select('subject_level_id',App\Models\Subject_level::where('deleted','0')->pluck('name_ar','id'),old('subject_level_id')
                                                                                ,["class"=>"form-control custom-select", "required" ,"id"=>"cmb_subject_levels" ]) }}
                                                                    @else
                                                                        {{ Form::select('subject_level_id',App\Models\Subject_level::where('deleted','0')->pluck('name_en','id'),old('subject_level_id')
                                                                            ,["class"=>"form-control custom-select", "required" ,"id"=>"cmb_subject_levels" ]) }}
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        @endif
                                                        <div class="form-group">
                                                            @php $nationalities = \App\Models\Nationality::where('deleted','0')->get(); @endphp
                                                            <label
                                                                class="control-label">{{trans('s_admin.nationality')}}</label><span
                                                                style="color: red;">*</span>
                                                            <select id="txt_nationality" name="nationality" required
                                                                    class="form-control custom-select">
                                                                @foreach($nationalities as $row)
                                                                    <option value="{{$row->id}}"
                                                                            @if(old('nationality') == $row->id ) selected @endif >
                                                                        @if(app()->getLocale() == 'ar')
                                                                            {{$row->name_ar}}
                                                                        @else
                                                                            {{$row->name_en}}
                                                                        @endif
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label
                                                                class="control-label">{{trans('s_admin.ident_num')}}</label><span
                                                                style="color: red;">*</span>
                                                            <input id="txt_ident_num" type="number" required
                                                                   name="ident_num" value="{{old('ident_num')}}"
                                                                   class="form-control form-control-danger">
                                                        </div>
                                                        @if($types == 'teacher_far_learn' || $types == 'teacher_mogmaa_dorr')
                                                            <div class="form-group">
                                                                @php $job_names = \App\Models\Job_name::where('deleted','0')->get(); @endphp
                                                                <label
                                                                    class="control-label">{{trans('admin.job_name')}}</label><span
                                                                    style="color: red;">*</span>
                                                                <select id="txt_job_names" name="job_name" required
                                                                        class="form-control custom-select">
                                                                    @foreach($job_names as $row)
                                                                        <option value="{{$row->id}}"
                                                                                @if(old('job_name') == $row->id ) selected @endif >
                                                                            @if(app()->getLocale() == 'ar')
                                                                                {{$row->name_ar}}
                                                                            @else
                                                                                {{$row->name_en}}
                                                                            @endif
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            <div class="form-group">
                                                                <label class="control-label">{{trans('s_admin.cv')}}</label>
                                                                <span style="color: red;">({{trans('s_admin.pdf_only')}})</span>
                                                                <input type="file" accept=".pdf" name="cv" value="{{old('cv')}}"
                                                                       class="form-control form-control-danger">
                                                            </div>
                                                        @else
                                                            <div class="form-group">
                                                                <label
                                                                    class="control-label">{{trans('s_admin.save_quran_num')}}</label><span
                                                                    style="color: red;">*</span>
                                                                <input id="txt_save_quran_num" type="number" step="any" required min="0"
                                                                       max="30" value="{{old('save_quran_num')}}"
                                                                       name="save_quran_num"
                                                                       class="form-control form-control-danger">
                                                            </div>
                                                            <div class="form-group">
                                                                <label
                                                                    class="control-label">{{trans('s_admin.what_limit_save')}}</label>
                                                                <span style="color: red;">*</span>
                                                                @php $save_limits = App\Models\Save_limit::where('deleted','0')->get(); @endphp
                                                                <select required name="save_quran_limit"
                                                                        class="form-control custom-select">
                                                                    <option value="" selected>{{trans('s_admin.choose_limit')}}</option>
                                                                    @foreach($save_limits as $row)
                                                                        <option value="{{$row->id}}"
                                                                                @if(old('save_quran_limit') == $row->id ) selected @endif >{{$row->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        @endif
                                                    </div>
                                                    <button class="btn btn-primary backBtn pull-right"
                                                            type="button">{{trans('admin.befor')}}</button>
                                                    <button class="btn btn-success pull-right"
                                                            type="submit">{{trans('admin.sign')}}</button>
                                                </div>
                                                {{--                                <div class="panel panel-primary setup-content" id="step-3">--}}
                                                {{--                                    <div class="panel-heading">--}}
                                                {{--                                        <h3 class="panel-title"></h3>--}}
                                                {{--                                    </div>--}}
                                                {{--                                    <div class="panel-body">--}}
                                                {{--                                    </div>--}}
                                                {{--                                    <button class="btn btn-primary backBtn pull-right"--}}
                                                {{--                                            type="button">{{trans('admin.befor')}}</button>--}}
                                                {{--                                    <button class="btn btn-primary nextBtn pull-right"--}}
                                                {{--                                            type="button">{{trans('admin.next')}}--}}
                                                {{--                                    </button>--}}
                                                {{--                                </div>--}}
                                                {{--                                <div class="panel panel-primary setup-content" id="step-4">--}}
                                                {{--                                    <div class="panel-heading">--}}
                                                {{--                                        <h3 class="panel-title"></h3>--}}
                                                {{--                                    </div>--}}
                                                {{--                                    <div class="panel-body">--}}
                                                {{--                                        <button class="btn btn-primary backBtn pull-right"--}}
                                                {{--                                                type="button">{{trans('admin.befor')}}</button>--}}
                                                {{--                                        <button class="btn btn-success pull-right"--}}
                                                {{--                                                type="submit">{{trans('admin.sign')}}</button>--}}

                                                {{--                                    </div>--}}
                                                {{--                                </div>--}}
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 col-sm-12 col-lg-3">
                        </div>
                    </div>
                </div><!-- Contact Wrap -->
            </div>
            @endsection
            @section('scripts')
                {{--    //for hijri date--}}
                <script src="{{url('/')}}/hijri/js/jquery-3.3.1.js"></script>
                <script src="{{url('/')}}/hijri/js/bootstrap.js"></script>
                <script src="{{url('/')}}/hijri/js/momentjs.js"></script>
                <script src="{{url('/')}}/hijri/js/moment-with-locales.js"></script>
                <script src="{{url('/')}}/hijri/js/moment-hijri.js"></script>
                <script src="{{url('/')}}/hijri/js/bootstrap-hijri-datetimepicker.js"></script>
                <script type="text/javascript">
                    $(function () {
                        initHijrDatePicker();
                        $('.disable-date').hijriDatePicker({

                            minDate: "2020-01-01",
                            maxDate: "2021-01-01",
                            viewMode: "years",
                            hijri: true,
                            debug: true
                        });
                    });

                    function initHijrDatePicker() {
                        $(".hijri-date-input").hijriDatePicker({
                            locale: "ar-sa",
                            format: "DD-MM-YYYY",
                            hijriFormat: "iYYYY-iMM-iDD",
                            dayViewHeaderFormat: "MMMM YYYY",
                            hijriDayViewHeaderFormat: "iMMMM iYYYY",
                            showSwitcher: true,
                            allowInputToggle: true,
                            showTodayButton: false,
                            useCurrent: true,
                            isRTL: false,
                            viewMode: 'months',
                            keepOpen: false,
                            hijri: false,
                            debug: true,
                            showClear: true,
                            showTodayButton: true,
                            showClose: true
                        });
                    }

                    function initHijrDatePickerDefault() {
                        $(".hijri-date-input").hijriDatePicker();
                    }
                </script>
                <script type="text/javascript"
                        src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
                <script type="text/javascript">
                    $(function () {
                        var code = "+966"; // Assigning value from model.
                        $('#txt_country_code').val(code);
                        $('#txt_country_code').intlTelInput({
                            autoHideDialCode: true,
                            autoPlaceholder: "ON",
                            dropdownContainer: document.body,
                            formatOnDisplay: true,
                            hiddenInput: "full_number",
                            initialCountry: "auto",
                            nationalMode: true,
                            placeholderNumberType: "MOBILE",
                            preferredCountries: ['US'],
                            separateDialCode: true
                        });
                        // console.log(code)
                        // $("#txt_unique_name").keyup(function (event) {
                        //     var txt_unique_name = $("#txt_unique_name").val('');
                        //     txt_unique_name.replace(/\s/g, "") ;
                        // });
                    });
                    $(function () {
                        var code = "+966"; // Assigning value from model.
                        $('#txt_parent_country_code').val(code);
                        $('#txt_parent_country_code').intlTelInput({
                            autoHideDialCode: true,
                            autoPlaceholder: "ON",
                            dropdownContainer: document.body,
                            formatOnDisplay: true,
                            hiddenInput: "full_number",
                            initialCountry: "auto",
                            nationalMode: true,
                            placeholderNumberType: "MOBILE",
                            preferredCountries: ['US'],
                            separateDialCode: true
                        });
                        // console.log(code)
                        // $("#txt_unique_name").keyup(function (event) {
                        //     var txt_unique_name = $("#txt_unique_name").val('');
                        //     txt_unique_name.replace(/\s/g, "") ;
                        // });
                    });

                    function removeSpaces(string) {
                        return string.split(' ').join('');
                    }

                    function phonelimit(string) {
                        // alert(string.length);
                        // return string.split(' ').join('');
                        if (string.length < 11) {
                            return string;
                        } else {
                            //عفوا رقم الجوال 10 ارقام فقط
                            alert('{{trans('s_admin.limit_phone_number')}}');
                        }
                    }
                </script>
                <script>
                    $(document).on('click', '#btn_delete', function () {
                        $("#txt_unique_name").val('');
                        $("#txt_name").val('');
                        $("#txt_pass").val('');
                        $("#txt_con_pass").val('');
                        $("#txt_f_name").val('');
                        $("#txt_m_name").val('');
                        $("#txt_l_name").val('');
                        $("#txt_date").val('');
                        $("#txt_email").val('');
                        $("#txt_phone").val('');
                    });
                    <<<<<<< HEAD

                    {{--if({{$types}} != 'teacher_far_learn' || {{$types}} != 'teacher_mogmaa_dorr'){--}}
                    $('#txt_date').on('blur', function () {

                        if ($("#txt_date").val().split("-").reverse().join("-").substring(0, 4).indexOf('-') == -1) {
                            var hi = $("#txt_date").val().split("-").reverse().join("-") ;
                        } else {
                            var hi = moment($("#txt_date").val().split("-").reverse().join("-"), 'iD-iM-iYYYY').format('YYYY-M-D');
                        }

                        var now = new Date();
                        var past = new Date(hi) ;
                        var nowYear = now.getFullYear();
                        var pastYear = past.getFullYear();
                        var age = nowYear - pastYear;

                        if (age <= 10) {
                            document.getElementById('parent_access').style.display = 'block';
                            $('#user_name').attr('required', 'required');
                            $('#phone').attr('required', 'required');
                            $('#home_phone').attr('required', 'required');
                            $('#address').attr('required', 'required');
                        } else {
                            document.getElementById('parent_access').style.display = 'none';
                            $('#user_name').removeAttr('required');
                            $('#phone').removeAttr('required');
                            $('#home_phone').removeAttr('required');
                            $('#address').removeAttr('required');
                        }

                    });
                    // }
                    =======
                        {{--if({{$types}} != 'teacher_far_learn' || {{$types}} != 'teacher_mogmaa_dorr'){--}}
                        $('#txt_date').on('blur', function () {
                            if ($("#txt_date").val().split("-").reverse().join("-").substring(0, 4).indexOf('-') == -1) {
                                var hi = $("#txt_date").val().split("-").reverse().join("-");
                            } else {
                                var hi = moment($("#txt_date").val().split("-").reverse().join("-"), 'iD-iM-iYYYY').format('YYYY-M-D');
                            }
                            var now = new Date();
                            var past = new Date(hi);
                            var nowYear = now.getFullYear();
                            var pastYear = past.getFullYear();
                            var age = nowYear - pastYear;
                            if (age <= 10) {
                                document.getElementById('parent_access').style.display = 'block';
                                $('#user_name').attr('required', 'required');
                                $('#phone').attr('required', 'required');
                                $('#home_phone').attr('required', 'required');
                                $('#address').attr('required', 'required');
                            } else {
                                document.getElementById('parent_access').style.display = 'none';
                                $('#user_name').removeAttr('required');
                                $('#phone').removeAttr('required');
                                $('#home_phone').removeAttr('required');
                                $('#address').removeAttr('required');
                            }
                        });
                    // }
                    >>>>>>> 453dd787523dd009533811c10981ff2a8ec92d58
                    $('#btn_save').on('click', function () {
                        var unique_name = $('#txt_unique_name').val();
                        var password = $('#txt_pass').val();
                        var password_confirmation = $('#txt_con_pass').val();
                        var first_name_ar = $('#txt_f_name').val();
                        var mid_name_ar = $('#txt_m_name').val();
                        var last_name_ar = $('#txt_l_name').val();
                        var gender = $('#txt_gender').val();
                        var email = $('#txt_email').val();
                        var main_lang = $('#txt_lang').val();
                        var date_of_birth = $('#txt_date').val();
                        var country = $('#txt_country').val();
                        var phone = $('#txt_phone').val();
                        var qualification = $('#txt_qualification').val();
                        var nationality = $('#txt_nationality').val();
                        var country_code = $('#txt_country_code').val();
                        var job_name = $('#txt_job_names').val();
                        $.ajax({
                            url: "/{{$types}}/store",
                            type: "POST",
                            data: {
                                _token: $("#csrf2").val(),
                                unique_name: unique_name,
                                password: password,
                                password_confirmation: password_confirmation,
                                first_name_ar: first_name_ar,
                                mid_name_ar: mid_name_ar,
                                last_name_ar: last_name_ar,
                                gender: gender,
                                email: email,
                                main_lang: main_lang,
                                date_of_birth: date_of_birth,
                                country: country,
                                phone: phone,
                                qualification: qualification,
                                nationality: nationality,
                                country_code: country_code,
                                job_name: job_name,
                            },
                            cache: false,
                            success: function (response) {
                                alert(response);
                                // console.log(data_result.msg);
                                // if (data_result.status == true) {
                                //     toastr.success(data_result.msg);
                                //
                                // } else if (data_result.status == false) {
                                //     toastr.error(data_result.msg);
                                // }
                            }
                        });
                    });
                </script>
                <script>
                    $(document).ready(function () {
                        var navListItems = $('div.setup-panel div a'),
                            allWells = $('.setup-content'),
                            allNextBtn = $('.nextBtn');
                        allBackBtn = $('.backBtn');
                        allWells.hide();
                        navListItems.click(function (e) {
                            e.preventDefault();
                            var $target = $($(this).attr('secc')),
                                $item = $(this);
                            if (!$item.hasClass('disabled')) {
                                navListItems.removeClass('btn-success').addClass('btn-default');
                                $item.addClass('btn-success');
                                allWells.hide();
                                $target.show();
                                $target.find('input:eq(0)').focus();
                            }
                        });
                        allNextBtn.click(function () {
                            if ($(this).closest(".setup-content").attr("id") == 'step-2') {
                                var pw1 = $('#txt_pass').val();
                                var pw2 = $('#txt_con_pass').val();
                                if (pw1 != pw2) {
                                    alert("كلمات المرور غير متطابقة");
                                } else {
                                    var curStep = $(this).closest(".setup-content"),
                                        curStepBtn = curStep.attr("id"),
                                        nextStepWizard = $('div.setup-panel div a[secc="#' + curStepBtn + '"]').parent().next().children("a"),
                                        curInputs = curStep.find("input[type='text'],input[type='email'],input[type='password'],input[type='url'],input[type='number'],select"),
                                        isValid = true;

                                    $(".form-group").removeClass("has-error");
                                    for (var i = 0; i < curInputs.length; i++) {
                                        if (!curInputs[i].validity.valid) {
                                            isValid = false;
                                            $(curInputs[i]).closest(".form-group").addClass("has-error");
                                            if (curInputs[i].id == 'txt_f_name') {
                                                // alert('  تحقق من ادخال الاسم الاول');
                                                alert('{{trans('s_admin.first_name_req')}}');
                                            } else if (curInputs[i].id == 'txt_m_name') {
                                                // alert('تحقق من ادخال الاسم الاوسط');
                                                alert('{{trans('s_admin.mide_name_req')}}');

                                            } else if (curInputs[i].id == 'txt_l_name') {
                                                // alert('تحقق من ادخال الاسم الاخير');
                                                alert('{{trans('s_admin.last_name_req')}}');

                                            } else if (curInputs[i].id == 'txt_unique_name') {
                                                // alert('تحقق من ادخال اسم المستخدم ');
                                                alert('{{trans('s_admin.user_name_req')}}');

                                            } else if (curInputs[i].id == 'txt_email') {
                                                // alert('تحقق من ادخال البريد الالكتروني بطريقة صحيحة ');
                                                alert('{{trans('s_admin.email_req')}}');

                                            } else if (curInputs[i].id == 'txt_pass') {
                                                // alert('تحقق من ادخال كلمة المرور على الاقل 8 حروف   ');
                                                alert('{{trans('s_admin.eight_pass_req')}}');

                                            } else if (curInputs[i].id == 'txt_phone') {
                                                // alert('تحقق من ادخال رقم الجوال    ');
                                                alert('{{trans('s_admin.phone_req')}}');

                                            } else if (curInputs[i].id == 'txt_date') {
                                                // alert('تحقق من ادخال تاريخ الميلاد');
                                                alert('{{trans('s_admin.d_o_b_req')}}');

                                            } else if (curInputs[i].id == 'txt_ident_num') {
                                                // alert('تحقق من ادخال رقم الهوية    ');
                                                alert('{{trans('s_admin.ident_req')}}');

                                            } else if (curInputs[i].id == 'user_name') {
                                                // alert('تحقق من ادخال الاسم بالكامل    ');
                                                alert('{{trans('s_admin.full_name_req')}}');

                                            } else if (curInputs[i].id == 'phone') {
                                                // alert('تحقق من ادخال رقم الجوال    ');
                                                alert('{{trans('s_admin.phone2_req')}}');

                                            } else if (curInputs[i].id == 'home_phone') {
                                                // alert('تحقق من ادخال جوال المنزل    ');
                                                alert('{{trans('s_admin.house_phone_req')}}');

                                            } else if (curInputs[i].id == 'address') {
                                                // alert('تحقق من ادخال العنوان    ');
                                                alert('{{trans('s_admin.address_req')}}');
                                            }
                                            break;
                                        }
                                    }
                                    if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
                                }
                            } else {
                                var curStep = $(this).closest(".setup-content"),
                                    curStepBtn = curStep.attr("id"),
                                    nextStepWizard = $('div.setup-panel div a[secc="#' + curStepBtn + '"]').parent().next().children("a"),
                                    curInputs = curStep.find("input[type='text'],input[type='email'],input[type='password'],input[type='url'],input[type='number'],select"),
                                    isValid = true;
                            <<<<<<< HEAD

                                =======
                            >>>>>>> 453dd787523dd009533811c10981ff2a8ec92d58
                                $(".form-group").removeClass("has-error");
                                for (var i = 0; i < curInputs.length; i++) {
                                    if (!curInputs[i].validity.valid) {
                                        isValid = false;
                                        $(curInputs[i]).closest(".form-group").addClass("has-error");
                                        if (curInputs[i].id == 'txt_f_name') {
                                            alert('{{trans('s_admin.first_name_req')}}');

                                        } else if (curInputs[i].id == 'txt_m_name') {
                                            alert('{{trans('s_admin.mide_name_req')}}');
                                        } else if (curInputs[i].id == 'txt_l_name') {
                                            alert('{{trans('s_admin.last_name_req')}}');
                                        } else if (curInputs[i].id == 'txt_unique_name') {
                                            alert('{{trans('s_admin.user_name_req')}}');
                                        } else if (curInputs[i].id == 'txt_email') {
                                            alert('{{trans('s_admin.email_req')}}');
                                        } else if (curInputs[i].id == 'txt_pass') {
                                            alert('{{trans('s_admin.eight_pass_req')}}');
                                        } else if (curInputs[i].id == 'txt_phone') {
                                            alert('{{trans('s_admin.phone_req')}}');
                                        } else if (curInputs[i].id == 'txt_date') {
                                            alert('{{trans('s_admin.d_o_b_req')}}');
                                        } else if (curInputs[i].id == 'txt_ident_num') {
                                            alert('{{trans('s_admin.ident_req')}}');
                                        } else if (curInputs[i].id == 'user_name') {
                                            alert('{{trans('s_admin.full_name_req')}}');
                                        } else if (curInputs[i].id == 'phone') {
                                            alert('{{trans('s_admin.phone2_req')}}');
                                        } else if (curInputs[i].id == 'home_phone') {
                                            alert('{{trans('s_admin.house_phone_req')}}');
                                        } else if (curInputs[i].id == 'address') {
                                            alert('{{trans('s_admin.address_req')}}');
                                        }
                                        break;
                                    }
                                }
                                if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
                            }
                        });
                        allBackBtn.click(function () {
                            var curStep = $(this).closest(".setup-content");
                            var curStepBtn = curStep.attr("id");
                            var currStepWizard = $('div.setup-panel div a[secc="#' + curStepBtn + '"]').parent().children("a");
                            var prevStepWizard = $('div.setup-panel div a[secc="#' + curStepBtn + '"]').parent().prev().children("a");
                            prevStepWizard.trigger('click');
                            currStepWizard.attr("disabled", "disabled");
                        });
                        $('div.setup-panel div a.btn-success').trigger('click');
                    });
                </script>
                <script>
                    $('#cmb_levels').change(function () {
                        var level = $(this).val();
                        $.ajax({
                            url: "/web/get_subjects/" + level,
                            dataType: 'html',
                            type: 'get',
                            success: function (data) {
                                $('#subject_cont').show(data);
                                $('#cmb_sign_up_subject').html(data);
                            }
                        });
                    });
                    $('#cmb_sign_up_subject').change(function () {
                        var subject = $(this).val();
                        $.ajax({
                            url: "/web/get_subject_levels/" + subject,
                            dataType: 'html',
                            type: 'get',
                            success: function (data) {
                                $('#subject_level_cont').show(data);
                                $('#cmb_subject_levels').html(data);
                            }
                        });
                    });
                    $('#cmb_country').change(function () {
                        var subject = $(this).val();
                        $.ajax({
                            url: "/web/get_zones/" + subject,
                            dataType: 'html',
                            type: 'get',
                            success: function (data) {
                                $('#zones_cont').show();
                                $('#cmb_zones').html(data);
                            }
                        });
                    });
                    $('#cmb_zones').change(function () {
                        var subject = $(this).val();
                        $.ajax({
                            url: "/web/get_cities/" + subject,
                            dataType: 'html',
                            type: 'get',
                            success: function (data) {
                                $('#city_cont').show(data);
                                $('#cmb_cities').html(data);
                            }
                        });
                    });
                    $('#cmb_cities').change(function () {
                        var level = $(this).val();
                        $.ajax({
                            url: "/web/get_districts/" + level,
                            dataType: 'html',
                            type: 'get',
                            success: function (data) {
                                $('#districts_cont').show();
                                $('#lbl_zones_cont').show();
                                $('#cmb_districts').html(data);
                            }
                        });
                    });
                </script>
                <script src="{{url('/')}}/assets/plugins/jquery-steps-master/build/jquery.steps.js"></script>
@endsection
