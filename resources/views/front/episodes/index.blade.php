@extends('front.layouts.app')

@section('content')
    <!-- .wpo-breadcumb-area start -->
    <div class="wpo-breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>{{trans('admin.search_techer')}}</h2>
                        <ul>
                            <li><a href="{{route('main_page')}}">{{trans('admin.home')}}</a></li>
                            <li><span>{{trans('admin.search_techer')}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .wpo-breadcumb-area end -->
    <!-- start service-single-section -->
    <section class="service-single-section section-padding">
        <div class="container">
            <div class="row">
                <div class="col col-md-8">
                    @foreach($data as $row)
                        <div class="wpo-event-item row">
                            <div class="wpo-event-img">
                                @if($row->Teacher)
                                    <img style="width: 210px;"
                                         src="{{url($row->Teacher->image)}}"
                                         alt="Author Image">
                                    <a href="{{route('front.teacher_details',$row->teacher_id)}}">
                                        <h5 class="mb-2">
                                            @if($row->Teacher->gender == 'male')
                                                {{trans('s_admin.teacher_name')}}/
                                            @else
                                                {{trans('s_admin.teacher_name_her')}}/
                                            @endif
                                            @if( app()->getLocale() == 'ar' )
                                                {{$row->Teacher->first_name_ar}}  {{$row->Teacher->mid_name_ar}}
                                            @else
                                                {{$row->Teacher->first_name_en}} {{$row->Teacher->mid_name_en}}
                                            @endif
                                        </h5>
                                        <small
                                            title="@if( app()->getLocale() == 'ar' ){{$row->Teacher->bio_ar}}@else{{$row->Teacher->bio_en}}@endif"
                                            class="thm-clr">
                                            @if( app()->getLocale() == 'ar' )
                                                {{ str_limit($row->Teacher->bio_ar, $limit = 70) }}
                                            @else
                                                {{ str_limit($row->Teacher->bio_en, $limit = 70) }}
                                            @endif
                                        </small>
                                    </a>
                                @else
                                    <img style="width: 210px;"
                                         src="{{ asset('uploads/teachers/default_avatar.jpg') }}"
                                         alt="Author Image">
                                @endif
{{--                                <div class="thumb-text">--}}
{{--                                    <span>25</span>--}}
{{--                                    <span>نوفمبر</span>--}}
{{--                                </div>--}}
                            </div>
                            <div class="wpo-event-text">
                                <h2>{{$row->name}}</h2>

                                <ul>
                                    <li style="direction: ltr;">{{date('g:i a', strtotime($row->time_from))}}
                                        - {{date('g:i a', strtotime($row->time_to))}}
                                        <i class="fa fa-clock-o" aria-hidden="true"></i>
                                    </li>
                                    <li><i class="fi ti-user"></i>
                                        @if( $row->gender == 'female' )
                                            {{trans('s_admin.female_only')}}
                                        @elseif($row->gender == 'male')
                                            {{trans('s_admin.male_only')}}
                                        @else
                                            {{trans('admin.children_only')}}
                                        @endif
                                    </li>
                                </ul>
                                <ul>
                                    <li style="direction: ltr;">{{trans('s_admin.days')}}
                                        <i class="fa fa-globe" aria-hidden="true"></i>
                                    </li>
                                    <li>:</i>
                                        @foreach($row->Days as $day)
                                            @if( app()->getLocale() == 'ar' )
                                                {{$day->name_ar}} -
                                            @else
                                                {{$day->name_en}} -
                                            @endif
                                        @endforeach
                                    </li>
                                </ul>
                                <ul>
                                    <li style="direction: ltr;">{{trans('s_admin.monthly_cost')}}
                                        <i class="fa fa-money" aria-hidden="true"></i>
                                    </li>
                                    <li>:</i>
                                        @if($row->cost == 'free')
                                            {{trans('s_admin.free')}}
                                        @else
                                            {{$row->cost}}
                                        @endif
                                    </li>
                                </ul>

                                <p>
                                    @if( app()->getLocale() == 'ar' )
                                        {{ str_limit($row->Teacher->bio_ar, $limit = 70) }}
                                    @else
                                        {{ str_limit($row->Teacher->bio_en, $limit = 70) }}
                                    @endif
                                </p>
                                @if( auth()->guard('web')->check())
                                    {{trans('s_admin.you_admin')}}
                                @elseif( auth()->guard('teacher')->check())
                                    {{trans('s_admin.you_teacher')}}
                                @elseif( auth()->guard('student')->check() )
                                    @if(auth()->guard('student')->user()->epo_type == 'far_learn')
                                        <a class="thm-btn thm-bg"
                                           href="{{route('search.show',$row->id)}}"
                                           title="">{{trans('s_admin.join_now')}}
                                            <span></span><span></span><span></span><span></span>
                                        </a>
                                    @elseif(auth()->guard('student')->user()->epo_type == 'far_learn')
                                        {{trans('s_admin.you_student_dorr')}}
                                    @elseif(auth()->guard('student')->user()->epo_type == 'mogmaa')
                                        {{trans('s_admin.you_student_mogmaa')}}
                                    @endif
                                @else
                                    @if(count($row->Students) >= $row->student_number)
                                        <a class=" btn btn-dark"
                                           href="javascript:void(0);"
                                           title="">{{trans('s_admin.episode_complete')}}
                                            <span></span><span></span><span></span><span></span></a>
                                    @else
                                        <a class="thm-btn thm-bg"
                                           href="{{route('custom_sign_up',['episode_id'=>$row->id , 'types'=>$page_type])}}"
                                           title="">{{trans('s_admin.join_now')}}
                                            <span></span><span></span><span></span><span></span></a>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <br>
                    @endforeach
                </div>
                <div class="col col-md-4">
                    <div class="service-sidebar">
                        {{ Form::open( ['route'  => ['times.search.episodes',['type'=>$type]],'method' =>'get','class' => 'checkout-form w-100 new_style' ] ) }}

                        <div class="widget service-list-widget">
                            <h3>{{trans('s_admin.search_methods')}}</h3>
                            <div style="text-align: center;">
                                <button type="submit" class="theme-btn"
                                        tabindex="0">{{trans('s_admin.search')}}</button>
                            </div>
                            <br>
                            <br>
                            <input type="text" name="teacher_name" class="form-control"
                                   placeholder="{{trans('s_admin.teacher_name')}}"
                                   value="{{Request::get('teacher_name')}}">
                            <hr>
                            @if( $page_type == 'all')
                                @if( $type == null || $type == 'all')
                                    <h4 class="mb-0">{{trans('s_admin.epo_type')}}</h4>
                                    <ul class="method-list mb-0 list-unstyled w-100">
                                        <li>
                                            <input type="radio" value="mqraa" name="epo_type"
                                                   id="radio1"
                                                   @if(Request::get('epo_type') =="mqraa" ) checked="checked" @endif>
                                            <label
                                                for="radio1">{{trans('s_admin.episode_mqraa')}}</label>
                                        </li>
                                        <li>
                                            <input type="radio" value="mogmaa" name="epo_type"
                                                   id="radio2"
                                                   @if(Request::get('epo_type') == "mogmaa") checked="checked" @endif>
                                            <label
                                                for="radio2">{{trans('s_admin.mogmaa_epos')}}</label>
                                        </li>
                                        <li>
                                            <input type="radio" value="dorr" name="epo_type"
                                                   id="radio3"
                                                   @if(Request::get('epo_type') == "dorr") checked="checked" @endif>
                                            <label
                                                for="radio3">{{trans('s_admin.dorr_epos')}}</label>
                                        </li>
                                        <li>
                                            <input type="radio" name="epo_type"
                                                   id="radio4"
                                                   @if(Request::get('epo_type') == 'on' || Route::current()->getName() == 'times.show' ) checked="checked" @endif >
                                            <label
                                                for="radio4">{{trans('s_admin.all')}}</label></li>
                                    </ul>
                                    <hr>
                                @endif
                            @endif

                            <h4 class="mb-0">{{trans('s_admin.level')}}</h4>
                            <ul class="method-list mb-0 list-unstyled w-100">
                                @php $levels = \App\Models\Level::where('type','far_learn')->where('deleted','0')->get(); @endphp
                                @foreach($levels as $row)
                                    <li>
                                        <input type="radio" value="{{$row->id}}" name="level_id"
                                               id="level{{$row->id}}"
                                               @if(Request::get('level_id') == $row->id ) checked="checked" @endif
                                        > <label
                                            for="level{{$row->id}}">
                                            @if(app()->getLocale() == 'ar')
                                                {{$row->name_ar}}
                                            @else
                                                {{$row->name_en}}
                                            @endif
                                        </label>
                                    </li>
                                @endforeach
                                <li><input type="radio"
                                           @if(Request::get('level_id') == 'on' || Route::current()->getName() == 'times.show' || !Request::get('level_id')) checked="checked"
                                           @endif
                                           name="level_id"
                                           id="radio5"> <label
                                        for="radio5">{{trans('s_admin.all')}}</label></li>
                            </ul>
                            <hr>


                            <h4 class="mb-0">{{trans('s_admin.gender')}}</h4>
                            <ul class="method-list mb-0 list-unstyled w-100">
                                <li>
                                    <input type="radio"
                                           @if(Request::get('gender') == "male" ) checked="checked"
                                           @endif value="male" name="gender" id="radio6">
                                    <label for="radio6">{{trans('s_admin.male_only')}}</label></li>
                                <li>
                                    <input type="radio"
                                           @if(Request::get('gender') == "female" ) checked="checked"
                                           @endif value="female" name="gender" id="radio7">
                                    <label for="radio7">{{trans('s_admin.female_only')}}</label>
                                </li>
                                {{--                                                    <li>--}}
                                {{--                                                        <input type="radio"--}}
                                {{--                                                               @if(Request::get('gender') == "children" ) checked="checked"--}}
                                {{--                                                               @endif value="children" name="gender" id="radio8">--}}
                                {{--                                                        <label for="radio8">{{trans('s_admin.children_only')}}</label>--}}
                                {{--                                                    </li>--}}
                                <li>
                                    <input type="radio"
                                           @if(Request::get('gender') == 'on' || !Request::get('gender')) checked="checked"
                                           @endif   name="gender" id="radio9">
                                    <label for="radio9">{{trans('s_admin.all')}}</label></li>
                            </ul>
                            <hr>


                            <h4 class="mb-0">{{trans('s_admin.teacher_talk')}}</h4>
                            <ul class="method-list mb-0 list-unstyled w-100">
                                <li>
                                    <input type="radio" value="ar"
                                           @if(Request::get('language') == "ar"  || !Request::get('language') ) checked="checked"
                                           @endif name="language"
                                           id="radio10"> <label
                                        for="radio10">{{trans('s_admin.arabic')}}</label></li>
                                <li>
                                    <input type="radio" value="en"
                                           @if(Request::get('language') == "en" ) checked="checked"
                                           @endif name="language" id="radio16">
                                    <label for="radio16">{{trans('s_admin.english')}}</label></li>
                            </ul>
                            <hr>


                            <h4 class="mb-0">{{trans('s_admin.study_cost')}}</h4>
                            <ul class="method-list mb-0 list-unstyled w-100">
                                <li>
                                    <input type="radio" value="free" name="cost"
                                           @if(Request::get('cost') == "free" ) checked="checked"
                                           @endif
                                           id="radio12"> <label
                                        for="radio12">{{trans('s_admin.free_epo')}}</label></li>
                                <li>
                                    <input type="radio" value="cost" name="cost"
                                           @if(Request::get('cost') == "cost" ) checked="checked"
                                           @endif
                                           id="radio13">
                                    <label for="radio13">{{trans('s_admin.epo_with_cost')}}</label>
                                </li>
                                <li>
                                    <input type="radio" name="cost"
                                           @if(Request::get('cost') == 'on' || Route::current()->getName() == 'times.show' || !Request::get('cost') ) checked="checked"
                                           @endif
                                           id="radio14"> <label
                                        for="radio14">{{trans('s_admin.all')}}</label></li>
                            </ul>
                            <div style="text-align: center;">
                                <button type="submit" class="theme-btn"
                                        tabindex="0">{{trans('s_admin.search')}}</button>
                            </div>
                        </div>
                        {{ Form::close() }}
                    </div>
                </div>
            </div> <!-- end row -->
        </div> <!-- end container -->
    </section>
    <!-- end service-single-section -->
@endsection
