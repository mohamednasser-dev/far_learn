@extends('front.layouts.temp')
@section('styles')
    <style>
        .ifr {
            overflow: scroll;
            overflow-x: hidden;
        }

        .ifr::-webkit-scrollbar {
            display: none;
        }

        .new_style h2 {
            color: #61300e;
            padding: 15px;
            text-align: center;
            border-bottom: 3px solid #61300e;
            background: #f3e4ca;
        }

        .new_style .payment-method {
            padding: 1.125rem;
        }

        .new_style .payment-method ul {
            padding: 0px;
        }

        .new_style [type="radio"]:not(:checked) + label::before, [type="radio"]:checked + label::before {
            border: 2px solid #61300e;
        }

        .new_style [type="radio"]:not(:checked) + label:after, [type="radio"]:checked + label:after {
            top: 5px;
            right: -5px;
            font-size: 1.525rem;
        }

        .new_style .thm-btn {
            padding: .5375rem 2.75rem;
            margin: 15px;
        }

        .author-box-wrap.new_auther {
            margin-top: 0px;
        }

        .new_auther .heed {
            color: #61300e;
            padding: 12px;
            text-align: center;
            border-bottom: 3px solid #61300e;
            background: #c9b288;
        }

        .new_auther .thm-clr {
            color: #04a511;
        }

        .new_auther .thm-btn {
            padding: .5375rem;
            font-size: 14px;
            width: 90px;
            border-radius: 10px;
            background: #04a511;
        }

        .new_auther .author-box {
            padding: 1rem;
        }

        .new_auther .author-img + .author-info {
            padding: 0px 1.125rem;
        }

        .new_auther table {
            border-collapse: collapse;
            border-spacing: 0;
            width: 100%;
        }

        .new_auther th, td {
            padding: 8px;
            font-size: 12px;
        }

        .new_auther .fst {
            background: #c9b288;
        }

        tr:nth-child(even) {
            background-color: #f2f2f2
        }

        .new_auther .sermons-btns2 a {
            color: #04a511;
        }

        .new_auther .sermons-btns2 a span {
            color: #252525;
        }

        .new_auther .rate i {
            border: none;
            width: 12px;
            margin: inherit;
            font-size: 10px;
            color: #ffbd01;
        }

        .new_auther .sermons-btns2:hover a i {
            color: #04a511;
            background: none;
        }

        .modal {
            display: none; /* Hidden by default */
            position: fixed; /* Stay in place */
            z-index: 9999999; /* Sit on top */
            padding-top: 100px; /* Location of the box */
            left: 0;
            top: 0;
            width: 100%; /* Full width */
            height: 100%; /* Full height */
            overflow: auto; /* Enable scroll if needed */
            background-color: rgb(0, 0, 0); /* Fallback color */
            background-color: rgba(0, 0, 0, 0.4); /* Black w/ opacity */
        }

        /* Modal Content */
        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
        }

        /* The Close Button */
        .close {
            color: #aaaaaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: #000;
            text-decoration: none;
            cursor: pointer;
        }

    </style>
@endsection
@section('content')
    <section>
        <div class="w-100">
            @include('admin.layouts.errors')
            @include('admin.layouts.messages')
        </div>
    </section>

    <section>
        {{-- <iframe class="ifr" src="{{url('/')}}/show_mix/{{$type}}" style="height: 100vh;"></iframe> --}}
    </section>

    <section>
        <div class="w-100 pt-120 pb-260 position-relative">
            <div class="container">
                @include('admin.layouts.errors')
                @include('admin.layouts.messages')
                <div class="post-detail-wrap w-100">
                    <div class="row">
                        <div class="col-md-6 col-sm-6 col-lg-3">
                            <aside class="sidebar w-100">
                                <div class="widget2 w-100">
                                    {{ Form::open( ['route'  => ['times.search.episodes',['type'=>$type]],'method' =>'get','class' => 'checkout-form w-100 new_style' ] ) }}
                                    <input type="hidden" name="page_type" value="{{$page_type}}">
                                    <h2>{{trans('s_admin.search_methods')}}</h2>
                                    <div class="row mrg10">
                                        <button type="submit" class="thm-btn thm-bg"
                                                title="">{{trans('s_admin.search')}}
                                            <span></span><span></span><span></span><span></span></button>
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <h5 class="mb-0">{{trans('s_admin.teacher_name')}}</h5>
                                            <input type="text" name="teacher_name"
                                                   placeholder="{{trans('s_admin.teacher_name')}}"
                                                   value="{{Request::get('teacher_name')}}">
                                        </div>
                                        @if( $page_type == 'all')
                                            @if( $type == null || $type == 'all')
                                                <div class="col-md-12 col-sm-12 col-lg-12">
                                                    <div class="payment-method">
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
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="payment-method">
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
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="payment-method">
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
                                            </div>
                                        </div>
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="payment-method">
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
                                            </div>
                                        </div>
                                        {{--                                        <div class="col-md-12 col-sm-12 col-lg-12">--}}
                                        {{--                                            <div class="payment-method">--}}
                                        {{--                                                <h4 class="mb-0">{{trans('s_admin.tall_line')}}</h4>--}}
                                        {{--                                                <ul class="method-list mb-0 list-unstyled w-100">--}}
                                        {{--                                                    <li>--}}
                                        {{--                                                        <input type="radio"--}}
                                        {{--                                                               @if(Request::get('place') == "ar" ) checked="checked"--}}
                                        {{--                                                               @endif--}}
                                        {{--                                                               value="ar" checked name="place"--}}
                                        {{--                                                               id="radio11"> <label--}}
                                        {{--                                                            for="radio11">{{trans('s_admin.not_want_place')}}</label>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                    <li>--}}
                                        {{--                                                        <input type="radio"--}}
                                        {{--                                                               @if(Request::get('place') == "en" ) checked="checked"--}}
                                        {{--                                                               @endif--}}
                                        {{--                                                               value="en" name="place" id="radio15"> <label--}}
                                        {{--                                                            for="radio15">{{trans('s_admin.want_to_determind')}}</label>--}}
                                        {{--                                                    </li>--}}
                                        {{--                                                </ul>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                        <div class="col-md-12 col-sm-12 col-lg-12">
                                            <div class="payment-method">
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
                                            </div>
                                        </div>
                                        <button type="submit" class="thm-btn thm-bg"
                                                title="">{{trans('s_admin.search')}}
                                            <span></span><span></span><span></span><span></span></button>
                                    </div>
                                    {{ Form::close() }}
                                </div>
                            </aside><!-- Sidebar -->
                        </div>
                        <div class="col-md-12 col-sm-12 col-lg-9">
                            <div class="post-detail-inner w-100">

                                <div class="author-box-wrap w-100 new_auther">
                                    <h3 class="mb-0 heed">{{trans('s_admin.search_result')}}</h3>
                                    @foreach($data as $row)
                                        <div
                                            class="author-box d-flex flex-wrap pat-bg gray-layer opc8 position-relative back-blend-multiply gray-bg w-100"
                                            style="background-image: url({{asset('quran/assets/images/pattern-bg.jpg')}});">
                                            <div class="author-img">
                                                {{--                                                onmouseover="openmodal({{$row->Teacher->id}})"--}}
                                                <a href="javascript:;">
                                                    @if($row->Teacher)
                                                        @if($row->Teacher->image == null)
                                                            <img class="img-fluid w-100"
                                                                 src="{{ asset('uploads/teachers/default_avatar.jpg') }}"
                                                                 alt="Author Image">
                                                        @else
                                                            <img class="img-fluid w-100"
                                                                 src="{{url($row->Teacher->image)}}"
                                                                 alt="Author Image">
                                                        @endif

                                                    @else
                                                        <img class="img-fluid w-100"
                                                             src="{{ asset('uploads/teachers/default_avatar.jpg') }}"
                                                             alt="Author Image">
                                                    @endif
                                                </a>
                                            </div>
                                            <div class="author-info">
                                                {{--                                                onmouseover="openmodal({{$row->Teacher->id}})"--}}
                                                @if($row->Teacher)
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
                                                        </h5> <small
                                                            title="@if( app()->getLocale() == 'ar' ){{$row->Teacher->bio_ar}}@else{{$row->Teacher->bio_en}}@endif"
                                                            class="thm-clr">
                                                            @if( app()->getLocale() == 'ar' )
                                                                {{ str_limit($row->Teacher->bio_ar, $limit = 70) }}
                                                            @else
                                                                {{ str_limit($row->Teacher->bio_en, $limit = 70) }}
                                                            @endif
                                                        </small>
                                                    </a>
                                                @endif
                                                <br><br>
                                                <div style="overflow-x:auto;">
                                                    <table>
                                                        <tr class="fst">
                                                            <th>{{trans('s_admin.episode_name')}}</th>
                                                            @if($row->type == 'mogmaa')
                                                                <th>{{trans('s_admin.mogmaa_name')}}</th>
                                                            @elseif($row->type == 'dorr')
                                                                <th>{{trans('s_admin.dorrs_name')}}</th>
                                                            @endif
                                                            <th>{{trans('s_admin.gender')}}</th>

                                                            <th>{{trans('s_admin.days')}}</th>
                                                            <th>{{trans('s_admin.reading_types')}}</th>

                                                            <th>{{trans('s_admin.monthly_cost')}}</th>
                                                            <th>{{trans('s_admin.details')}}</th>
                                                        </tr>
                                                        <tr>
                                                            <th>
                                                                @if( app()->getLocale() == 'ar' )
                                                                    {{$row->name_ar}}
                                                                @else
                                                                    {{$row->name_en}}
                                                                @endif
                                                            </th>
                                                            @if($row->type == 'mogmaa' || $row->type == 'dorr')
                                                                @if($row->college_id != null)
                                                                    <td>
                                                                        @if( app()->getLocale() == 'ar' )
                                                                            {{$row->Mogmaa->name_ar}}
                                                                        @else
                                                                            {{$row->Mogmaa->name_en}}
                                                                        @endif
                                                                    </td>
                                                                @endif
                                                            @endif
                                                            <td>
                                                                @if( $row->gender == 'female' )
                                                                    {{trans('s_admin.female_only')}}
                                                                @elseif($row->gender == 'male')
                                                                    {{trans('s_admin.male_only')}}
                                                                @else
                                                                    {{trans('admin.children_only')}}
                                                                @endif
                                                            </td>

                                                            <td>
                                                                @foreach($row->Days as $day)
                                                                    @if( app()->getLocale() == 'ar' )
                                                                        {{$day->name_ar}} -
                                                                    @else
                                                                        {{$day->name_en}} -
                                                                    @endif
                                                                @endforeach
                                                            </td>
                                                            <td>
                                                                @foreach($row->Readings as $read)
                                                                    @if( app()->getLocale() == 'ar' )
                                                                        {{$read->name_ar}} -
                                                                    @else
                                                                        {{$read->name_en}} -
                                                                    @endif
                                                                @endforeach
                                                            </td>

                                                            <td>
                                                                @if($row->cost == 'free')
                                                                    {{trans('s_admin.free')}}
                                                                @else
                                                                    {{$row->cost}}
                                                                @endif
                                                            </td>
                                                            <td>
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
                                                                    {{--                                                                    @if($page_type == 'far_learn' || $page_type == 'mogmaa_dorr')--}}
                                                                    {{--                                                                        <form action="{{route('custom_sign_up')}}" method="get">--}}
                                                                    {{--                                                                            @csrf--}}
                                                                    {{--                                                                            <input type="hidden" name="type" value="{{$page_type}}">--}}
                                                                    {{--                                                                            <input type="hidden" name="episode_id" id="txt_episode_id">--}}
                                                                    {{--                                                                            <button class="thm-btn thm-bg" style="background-color: blueviolet;width: 100%;padding: 1rem;"--}}
                                                                    {{--                                                                                    type="submit">{{trans('admin.sign_up')}}--}}
                                                                    {{--                                                                                <span></span><span></span><span></span><span></span></button>--}}
                                                                    {{--                                                                            <a data-toggle="modal" id="btn_join" data-episodeid="{{$row->id}}"--}}
                                                                    {{--                                                                               data-target="#check_login_modal"--}}
                                                                    {{--                                                                               class="thm-btn thm-bg"--}}
                                                                    {{--                                                                               href="javascript:void(0);"--}}
                                                                    {{--                                                                               title="">{{trans('s_admin.join_now')}}--}}
                                                                    {{--                                                                                <span></span><span></span><span></span><span></span></a>--}}
                                                                    {{--                                                                        </form>--}}
                                                                    {{--                                                                    @else--}}
                                                                    {{--                                                                        <a data-toggle="modal" data-target="#sign-modal" data-dismiss="modal"--}}
                                                                    {{--                                                                           class="thm-btn thm-bg"--}}
                                                                    {{--                                                                           style="background-color: blueviolet;width: 100%;padding: 1rem;" href="" title="">--}}
                                                                    {{--                                                                            {{trans('admin.sign_up')}}--}}
                                                                    {{--                                                                            <span></span><span></span><span></span><span></span></a>--}}
                                                                    {{--                                                                    @endif--}}
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
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                                <hr>
                                                <div style="overflow: hidden; overflow-x:auto;">
                                                    <div class="sermons-btns2 d-inline-flex">
                                                        <a href="" title="">{{trans('admin.gender')}} <br>
                                                            @if( $row->Teacher)
                                                                <span>
                                                                    @if( $row->Teacher->gender == 'male' )
                                                                        {{trans('admin.male')}}
                                                                    @else
                                                                        {{trans('admin.female')}}
                                                                    @endif
                                                                </span>
                                                            @endif
                                                        </a>
{{--                                                        <a style="width:90px;">{{trans('s_admin.rating')}}--}}
{{--                                                            <br>--}}
{{--                                                            @if( $row->Teacher)--}}
{{--                                                                <span>--}}
{{--                                                                    <span class="rate thm-clr">--}}
{{--                                                                        <i class=" @if( $row->Teacher->rate == 5 || $row->Teacher->rate == 4 || $row->Teacher->rate == 3 || $row->Teacher->rate == 2 || $row->Teacher->rate == 1 ) fas @else far @endif fa-star"></i>--}}
{{--                                                                        <i class=" @if( $row->Teacher->rate == 5 || $row->Teacher->rate == 4 || $row->Teacher->rate == 3 || $row->Teacher->rate == 2) fas @else far @endif fa-star"></i>--}}
{{--                                                                        <i class=" @if( $row->Teacher->rate == 5 || $row->Teacher->rate == 4 || $row->Teacher->rate == 3) fas @else far @endif fa-star"></i>--}}
{{--                                                                        <i class=" @if( $row->Teacher->rate == 5 || $row->Teacher->rate == 4) fas @else far @endif fa-star"></i>--}}
{{--                                                                        <i class=" @if( $row->Teacher->rate == 5) fas @else far @endif fa-star"></i>--}}
{{--                                                                    </span>--}}
{{--                                                                </span>--}}
{{--                                                            @endif--}}
{{--                                                        </a>--}}
                                                        {{--                                                        <a href="" title="">{{trans('s_admin.his_episodes_number')}}--}}
                                                        {{--                                                            <br>--}}
                                                        {{--                                                            <span>{{ count($row->Teacher->Episodes) + count($row->Teacher->Episode) }}  {{trans('s_admin.epo')}}</span></a>--}}
                                                        @if($row->level_id)
                                                            <a href="" title="">{{trans('s_admin.subject_type')}}<br>
                                                                <span>
                                                                    @if(app()->getLocale() == 'ar')
                                                                        {{$row->Level->name_ar}}
                                                                    @else
                                                                        {{$row->Level->name_ar}}
                                                                    @endif
                                                                </span>
                                                            </a>
                                                        @else
                                                            <a href="" title="">{{trans('s_admin.hight_line')}}<br>
                                                                <span>N/A</span>
                                                            </a>
                                                        @endif
                                                        <a href="" title="">{{trans('s_admin.episode_time')}}
                                                            <br>
                                                            <span> </span></a>
                                                        <a href="" title="">{{trans('s_admin.from')}}
                                                            <br>
                                                            <span>{{trans('s_admin.to')}}  </span></a>
                                                        <a href=""
                                                           title=""> {{date('g:i a', strtotime($row->time_from))}} {{trans('s_admin.ksa')}}
                                                            <br>
                                                            <span> {{date('g:i a', strtotime($row->time_to))}} {{trans('s_admin.ksa')}} </span></a>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div><!-- Author Box Wrap -->
                                <div
                                    class="pagination-wrap mt-30 d-flex flex-wrap justify-content-center text-center w-100">
                                    {{ $data->appends(request()->input())->links()}}
                                </div><!-- Pagination Wrap -->
                            </div>
                        </div>
                    </div>
                </div><!-- Post Detail Wrap -->
            </div>
        </div>
    </section>
    {{--    begin models--}}
    <div id="check_login_modal" class="modal model_style fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="text-align: center; background-color: darkgoldenrod;">
                <div class="modal-header">
                    <div class="col-md-12">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{trans('s_admin.Login_Register')}}</h5>
                    </div>
                </div>
                <div class="modal-body">
                    <div class="row">فق
                        <div class="col-md-6">
                            <a data-toggle="modal" href="" data-target="#login-modal" data-dismiss="modal"
                               class="thm-btn thm-bg"
                               style="background-color: yellowgreen;width: 100%;padding: 1rem;">
                                {{trans('admin.login')}}
                                <span></span><span></span><span></span><span></span> </a>
                        </div>
                        <div class="vertical d-none d-sm-block d-md-block" style="height: 65px;"></div>
                        <div class="col-md-6">
                            {{--                            @if($page_type == 'far_learn' || $page_type == 'mogmaa_dorr')--}}
                            {{--                                <form action="{{route('custom_sign_up')}}" method="get">--}}
                            {{--                                    @csrf--}}
                            {{--                                    <input type="hidden" name="type" value="{{$page_type}}">--}}
                            {{--                                    <input type="hidden" name="episode_id" id="txt_episode_id">--}}
                            {{--                                    <button class="thm-btn thm-bg" style="background-color: blueviolet;width: 100%;padding: 1rem;"--}}
                            {{--                                       type="submit">{{trans('admin.sign_up')}}--}}
                            {{--                                        <span></span><span></span><span></span><span></span></button>--}}
                            {{--                                </form>--}}
                            {{--                            @else--}}
                            {{--                                <a data-toggle="modal" data-target="#sign-modal" data-dismiss="modal"--}}
                            {{--                                   class="thm-btn thm-bg"--}}
                            {{--                                   style="background-color: blueviolet;width: 100%;padding: 1rem;" href="" title="">--}}
                            {{--                                    {{trans('admin.sign_up')}}--}}
                            {{--                                    <span></span><span></span><span></span><span></span></a>--}}
                            {{--                            @endif--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="teacherDetails" class="modal">

        <!-- Modal content -->
        <div class="modal-content">
            <span id="close" class="close">&times;</span>
            <p id="text"></p>
        </div>

    </div>
@endsection

@section('scripts')
    <script>
        var id;
        $(document).on('click', '#btn_join', function () {
            id = $(this).data('episodeid');
            $('#txt_episode_id').val(id);
        });
    </script>
    <script>
        function openmodal(id) {
// Get the modal
            var modal = document.getElementById("teacherDetails");
            var text = document.getElementById("text");

// Get the button that opens the modal
            var btn = document.getElementsByClassName("myBtn");
            text.innerHTML = id;
            modal.style.display = "block";

        }

        // Get the modal
        var modal = document.getElementById("teacherDetails");

        // Get the <span> element that closes the modal
        var span = document.getElementById("close");

        // When the user clicks on <span> (x), close the modal
        span.onclick = function () {
            modal.style.display = "none";
        }

        // When the user clicks anywhere outside of the modal, close it
        window.onclick = function (event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }
    </script>
@endsection


