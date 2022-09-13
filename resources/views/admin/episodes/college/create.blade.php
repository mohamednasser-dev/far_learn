@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_open_new_chanel')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <div class="card card-custom gutter-b example example-compact">
        <div class="card-header">
            <h3 class="card-title">{{trans('s_admin.episode_data')}}</h3>
        </div>
        <!--begin::Form-->
        @if(Route::current()->getName() == 'dorr.create')
            <form class="form" action="{{route('episode.store_dorr',["type"=>'dorr'])}}">
        @elseif(Route::current()->getName() == 'episode.create_mqraa')
            <form class="form" action="{{route('episode.store_dorr',["type"=>'mqraa'])}}">
        @else
            <form class="form" action="{{route('episode.store_dorr',["type"=>'mogmaa'])}}">
        @endif
            <div class="card-body">
                <div class="form-group">
                    <label>{{trans('s_admin.episode_name_ar')}}</label>
                    <input required type="text" name="name_ar" class="form-control form-control-lg" >
                </div>
                <div class="form-group">
                    <label>{{trans('s_admin.episode_name_en')}}</label>
                    <input required type="text" name="name_en" class="form-control form-control-lg" >
                </div>
                @if(Route::current()->getName() == 'dorrs.episodes.create_custom')
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleSelectl">{{trans('s_admin.dorr_name')}}</label>--}}
{{--                        {{ Form::select('college_id',App\Models\College::where('deleted','0')->where('type','dorr')->pluck('name_ar','id'),$college_id--}}
{{--                                ,["class"=>"form-control select2", "required" ,"id"=>"kt_select2_5" ]) }}--}}
{{--                    </div>--}}
                    <input type="hidden" name="college_id" value="{{$college_id}}">
                    <input type="hidden" name="gender" value="female" >
                @elseif(Route::current()->getName() == 'colleges.episodes.create_custom')
{{--                    <div class="form-group">--}}
{{--                        <label for="exampleSelectl">{{trans('s_admin.college_name')}}</label>--}}
{{--                        {{ Form::select('college_id',App\Models\College::where('deleted','0')->where('type','college')->pluck('name_ar','id'),$college_id--}}
{{--                                ,["class"=>"form-control select2", "required" ,"id"=>"kt_select2_5" ]) }}--}}
{{--                    </div>--}}
                    <input type="hidden" name="college_id" value="{{$college_id}}">
                    <input type="hidden" name="gender" value="male" >
                @endif
                @if(Route::current()->getName() == 'episode.create_mqraa')
                    <div class="form-group">
                        <label for="exampleSelectl">{{trans('s_admin.gender')}}</label>
                        <select required name="gender" class="form-control form-control-lg" id="exampleSelectl">
                            <option value="male">{{trans('s_admin.men')}}</option>
                            <option value="female">{{trans('s_admin.women')}}</option>
{{--                            <option value="children">{{trans('admin.children')}}</option>--}}
                        </select>
                    </div>
                @endif
                @if(Route::current()->getName() == 'episode.create_mqraa')
                <div class="form-group">
                    <label for="exampleSelectl">{{trans('s_admin.level')}}</label>
                    {{ Form::select('level_id',App\Models\Level::where('type','far_learn')->where('deleted','0')->pluck('name_ar','id'),null
                            ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_level'), "required" ,"id"=>"cmb_levels" ]) }}
                </div>
                @endif
                <div class="form-group">
                    <label>{{trans('s_admin.contain_energy')}}</label>
                    <input required type="number" min="1" name="student_number" class="form-control form-control-lg" >
                </div>
                <div class="form-group">
                    <label for="exampleSelectl">{{trans('s_admin.listen_type')}}</label>
                    <select required name="listen_type" class="form-control form-control-lg" id="exampleSelectl">
                        <option value="single">{{trans('s_admin.single')}}</option>
                        <option value="group">{{trans('s_admin.group')}}</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>{{trans('s_admin.activation')}}</label>
                    <div class="radio-list">
                        <label class="radio">
                            <input type="radio" value="y" checked name="active">
                            <span></span>{{trans('s_admin.active')}}</label>
                        <label class="radio radio">
                            <input type="radio" value="n" name="active">
                            <span></span>{{trans('s_admin.unactive')}}</label>

                    </div>
                </div>
                <div class="form-group">
                    <label>{{trans('s_admin.cost')}}</label>
                    <div class="radio-list">
                        <label class="radio">
                            <input type="radio" value="free" checked name="cost" id="free_rb">
                            <span></span>{{trans('s_admin.free')}}</label>
                        <div class="row">
                            <div class="col-md-2">
                                <label class="radio radio">
                                    <input type="radio" value="not_free" name="cost" id="not_free_rb">
                                    <span></span>{{trans('s_admin.not_free')}}</label>
                            </div>
                            <div class="col-md-2" id="cont_not_free" style="display: none;">
                                <input type="number" step="any" min="0" value="100" name="money" class="form-control form-control-lg" placeholder="{{trans('s_admin.value')}}">
                            </div>
                            <div class="col-md-8"></div>
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-2">
                        <label for="exampleSelectl">{{trans('s_admin.episode_time')}}</label>
                    </div>
                    <div class="col-md-5">
                        <label>{{trans('s_admin.from')}}</label>
                        <div class="col-lg-12 col-md-9 col-sm-12">
                            <input required name="time_from" class="form-control" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text">
                        </div>
                    </div>
                    <div class="col-md-5">
                        <label>{{trans('s_admin.to')}}</label>
                        <div class="col-lg-12 col-md-9 col-sm-12">
                            <input required name="time_to" class="form-control" id="kt_timepicker_1" readonly="readonly" placeholder="Select time" type="text">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <div class="col-md-6">
                        @php $readings = \App\Models\Reading::all(); @endphp
                        <label class="col-3 col-form-label">{{trans('s_admin.reading_types')}}</label>
                        <div class="col-9 col-form-label">
                            <div class="checkbox-list">
                                @foreach($readings as $row)
                                    <label class="checkbox">
                                        <input type="checkbox" name="readings[]" value="{{$row->id}}">
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
                    @if(Route::current()->getName() == 'dorrs.episodes.create_custom' || Route::current()->getName() == 'colleges.episodes.create_custom')
                        @php    $college_data = \App\Models\College::where('id',$college_id)->first();
                                $college_data->study_days = json_decode($college_data->study_days);
                        @endphp
                        <div class="col-md-6">
                            <label class="col-12- col-form-label">{{trans('s_admin.days')}}    <code> {{trans('s_admin.college_hint')}}</code></label>
                            <div class="col-9 col-form-label">
                                <div class="checkbox-list">
                                    <label class="checkbox">
                                        <input type="checkbox"disabled  @if($college_data->study_days) @if(in_array("1" ,$college_data->study_days)) checked="checked" @endif @endif  name="days[]" value="1">
                                        <span></span>{{trans('s_admin.sat')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" disabled @if($college_data->study_days) @if(in_array("2" ,$college_data->study_days)) checked="checked" @endif @endif name="days[]" value="2">
                                        <span></span>{{trans('s_admin.sun')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" disabled @if($college_data->study_days) @if(in_array("3" ,$college_data->study_days)) checked="checked" @endif @endif name="days[]" value="3">
                                        <span></span>{{trans('s_admin.mon')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" disabled @if($college_data->study_days) @if(in_array("4" ,$college_data->study_days)) checked="checked" @endif @endif name="days[]" value="4">
                                        <span></span>{{trans('s_admin.tus')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" disabled @if($college_data->study_days) @if(in_array("5" ,$college_data->study_days)) checked="checked" @endif @endif name="days[]" value="5">
                                        <span></span>{{trans('s_admin.wen')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" disabled @if($college_data->study_days) @if(in_array("6" ,$college_data->study_days)) checked="checked" @endif @endif name="days[]" value="6">
                                        <span></span>{{trans('s_admin.ther')}}</label>
                                    <label class="checkbox">
                                        <input type="checkbox" disabled @if($college_data->study_days) @if(in_array("7" ,$college_data->study_days)) checked="checked" @endif @endif name="days[]" value="7">
                                        <span></span>{{trans('s_admin.fri')}}</label>
                                </div>
                            </div>
                        </div>
                    @else
                    <div class="col-md-6">
                        <label class="col-3 col-form-label">{{trans('s_admin.days')}}</label>
                        <div class="col-9 col-form-label">
                            <div class="checkbox-list">
                                <label class="checkbox">
                                    <input type="checkbox"  checked="checked" name="days[]" value="1">
                                    <span></span>{{trans('s_admin.sat')}}</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="days[]" value="2">
                                    <span></span>{{trans('s_admin.sun')}}</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="days[]" value="3">
                                    <span></span>{{trans('s_admin.mon')}}</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="days[]" value="4">
                                    <span></span>{{trans('s_admin.tus')}}</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="days[]" value="5">
                                    <span></span>{{trans('s_admin.wen')}}</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="days[]" value="6">
                                    <span></span>{{trans('s_admin.ther')}}</label>
                                <label class="checkbox">
                                    <input type="checkbox" name="days[]" value="7">
                                    <span></span>{{trans('s_admin.fri')}}</label>
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                @inject('Academic_year','App\Models\Academic_year')
                <div class="input-group date mb-2 row" >
                    <div class="col-md-12">
                        <label>{{trans('s_admin.academic_year')}}</label>
                        <select required  id="Academic_year" name="" class="form-control">
                            <option selected >{{trans('s_admin.choose_academy_year')}}</option>
                            @foreach($Academic_year->all() as $data)
                                <option value="{{$data->id}}">{{$data->date}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="input-group date mb-2 row" style="display: none;" id="academy_semester">
                    <div class="col-md-12">
                        <label>{{trans('s_admin.Academic_semester')}}</label>
                        <select required  id="Academic_semester" name="academic_semesters_id" class="form-control">

                        </select>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <button type="submit" class="btn btn-success mr-2">{{trans('s_admin.add')}}</button>
            </div>
        </form>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/create_episode_ajax.js') }}"></script>
@endsection

