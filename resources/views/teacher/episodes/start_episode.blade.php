@extends('teacher.teacher_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.episode')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('t_episodes.index')}}" class="text-muted">{{trans('s_admin.nav_table_hlka')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('styles')

    <style type="text/css">.asd {
            background: rgba(0, 0, 0, 0);
            border: none;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .qty {
            width: 20%;
            border: none;
            text-align: center;
        }

        .qty-style {
            padding: 0px 8%;
            margin: 0px 7%;
            border-right: 2px solid #1bc5c9;
            border-left: 2px solid #1bc5c9;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }

        /*-------------------------------------- fo rate ---------------------------------------*/

        /*-------------------------------------------------- second stars --------------------------------------------------------*/
        * {
            font-family: "Lato";
        }

        .product-review-stars {
            /*background: #2C3E50;*/
            /* padding: 20px 50px 20px 20px; */
        }

        .product-review-stars label {
            text-shadow: 0px 0px 10px black;
        }

        /*end decoration*/

        .visuallyhidden {
            position: absolute !important;
            clip: rect(1px 1px 1px 1px);
            clip: rect(1px, 1px, 1px, 1px);
        }

        .product-review-stars label:after {
            content: "★";
            color: inherit;
            -webkit-transform: scale(4);
            position: absolute;
            z-index: 4;
            left: 0px;
            transition: all .4s;
            opacity: 0;
            color: inherit;
            visibility: hidden;

        }

        .product-review-stars input:checked + label:after {
            visibility: visible;
            -webkit-transform: scale(1);
            opacity: 1;
        }

        .product-review-stars {
            unicode-bidi: bidi-override;
            direction: rtl;
            width: 200px;
        }

        .product-review-stars label {
            font-family: "icomoon";
            font-size: 2em;
            position: relative;
            cursor: pointer;
            color: #DFE3E4;
        }

        .product-review-stars input:checked ~ label:before {
            opacity: 1;
        }

        .product-review-stars:hover input ~ label:before {
            opacity: 0;
        }

        .product-review-stars input + label:before {
            content: "\2605";
            position: absolute;
            right: 0;
            opacity: 0;
            transition: opacity .3s ease-in-out, color .3s ease-in-out;
            backface-visibility: hidden;
            -webkit-backface-visibility: hidden; /* Chrome and Safari */
            -moz-backface-visibility: hidden; /* Firefox */
            -ms-backface-visibility: hidden; /* Internet Explorer */
        }

        .product-review-stars input + label:hover:before,
        .product-review-stars input + label:hover ~ label:before {
            opacity: 1;
        }

        .product-review-stars input + label:nth-of-type(1):after,
        .product-review-stars input + label:nth-of-type(1):before,
        .product-review-stars input + label:nth-of-type(1):hover:before,
        .product-review-stars input + label:nth-of-type(1):hover ~ label:before,
        .product-review-stars input:nth-of-type(1):checked ~ label:before {
            color: #2ecc71;
        }

        .product-review-stars input + label:nth-of-type(2):after,
        .product-review-stars input + label:nth-of-type(2):before,
        .product-review-stars input + label:nth-of-type(2):hover:before,
        .product-review-stars input + label:nth-of-type(2):hover ~ label:before,
        .product-review-stars input:nth-of-type(2):checked ~ label:before {
            color: #f1c40f;
        }

        .product-review-stars input + label:nth-of-type(3):after,
        .product-review-stars input + label:nth-of-type(3):before,
        .product-review-stars input + label:nth-of-type(3):hover:before,
        .product-review-stars input + label:nth-of-type(3):hover ~ label:before,
        .product-review-stars input:nth-of-type(3):checked ~ label:before {
            color: #F39C12;
        }

        .product-review-stars input + label:nth-of-type(4):after,
        .product-review-stars input + label:nth-of-type(4):before,
        .product-review-stars input + label:nth-of-type(4):hover:before,
        .product-review-stars input + label:nth-of-type(4):hover ~ label:before,
        .product-review-stars input:nth-of-type(4):checked ~ label:before {
            color: #e74c3c;
        }

        .product-review-stars input + label:nth-of-type(5):after,
        .product-review-stars input + label:nth-of-type(5):before,
        .product-review-stars label:nth-of-type(5):hover:before,
        .product-review-stars input:nth-of-type(5):checked ~ label:before {
            color: #d35400;
        }

        .product-review-stars label:nth-of-type(5):hover:before {
            color: #d35400 !important;
        }

    </style>
    <style>
        /* Style the button that is used to open and close the collapsible content */
        .collapsible {
            cursor: pointer;
            text-align: left;
            outline: none;
        }

        /* Style the collapsible content. Note: hidden by default */
        .content {
            display: none;
            overflow: hidden;
        }
    </style>
@endsection
@section('content')
    @php
        $mytime = \Carbon\Carbon::now();
        $today = \Carbon\Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
        $course_data = \App\Models\Episode_course_days::where('episode_id', $data->id)->where('date', $today)->first();
    @endphp
    <div class="row">
        <div class="col-md-4" id="student_content">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <form>

                        <div class="form-group mb-7">
                            <label
                                class="font-size-h3 font-weight-bolder text-dark mb-7">{{trans('s_admin.students')}}</label>
                            <label class="font-size-h4 font-weight-bolder text-dark mb-6">{{count($data->Students)}}
                                /</label>
                            <label
                                class="font-size-h2 font-weight-bolder text-dark mb-6">{{$data->student_number}}</label>
                            @if($section_data != null)
                                <br>
                                <label class="font-size-h5 text-dark mb-7">{{trans('s_admin.curr_turn')}}</label>
                                <label class="font-size-h5r text-dark mb-6"> /</label>
                                <code>{{$section_data->order_num}}</code>
                                <a href="{{route('t_episode.previous_turn',$section_data->id)}}"
                                   class="btn btn-icon btn-light-primary btn-circle mr-2" data-toggle="tooltip"
                                   data-theme="dark" title="{{trans('s_admin.Previous_turn')}}">
                                    <i class="flaticon2-right-arrow"></i>
                                </a>
                                <a href="{{route('t_episode.next_turn',$section_data->id)}}"
                                   class="btn btn-icon btn-light-primary btn-circle mr-2" data-toggle="tooltip"
                                   data-theme="dark" title="{{trans('s_admin.next_turn')}}">
                                    <i class="flaticon2-left-arrow"></i>
                                </a>
                            @endif
                            <div class="row">
                                <div
                                    class="col-md-3"> @if($section_data != null) {{trans('s_admin.enter_order')}} @endif </div>
                                <div class="col-md-4"> {{trans('s_admin.student_name')}}</div>
                                <div class="col-md-3"></div>
                                <div
                                    class="col-md-2"> @if($section_data != null){{trans('s_admin.absence')}} @endif</div>
                            </div>
                            <br>
                            <div class="radio-list">
                                @foreach($data->Students as $row)
                                    @php
                                        $Student_Questions_episode = \App\Models\Student_Questions_episode::where('episode_id', $data->id)->where('student_id', $row->id)->where('episode_course_id', $course_data->id)->first();
                                    @endphp
                                    <label class="radio radio-lg mb-7">
                                        @php $student_epo = \App\Models\Episode_student::where('student_id',$row->id)->where('episode_id',$data->id)->first(); @endphp
                                        @if($section_data != null)
                                            @if($student_epo->order_num == 0)
                                                {{trans('s_admin.out_epo')}}
                                            @else
                                                {{$student_epo->order_num}}
                                            @endif
                                        @endif
                                        &nbsp; &nbsp; &nbsp; &nbsp;
                                        <input id="rb_student_id" name="student_id" data-student="{{$row->id}}"
                                               data-sub-level-id="{{$row->subject_level_id}}"
                                               data-image="{{$row->image}}"
                                               @if(app()->getLocale() == 'ar')
                                               data-name="{{$row->first_name_ar}} {{$row->mid_name_ar}} {{$row->last_name_ar}}"
                                               @else
                                               data-name="{{$row->first_name_en}} {{$row->mid_name_en}} {{$row->last_name_en}}"
                                               @endif
                                               data-email="{{$row->email}}"
                                               @if($Student_Questions_episode != null)
                                               data-qustionid=" {{$Student_Questions_episode->id}}"
                                               @else
                                               data-qustionid="0"
                                               @endif
                                               type="radio">
                                        <span></span>
                                        <div class="font-size-lg text-dark-75 font-weight-bold">
                                            @if(app()->getLocale() == 'ar')
                                                {{$row->first_name_ar}} {{$row->mid_name_ar}} {{$row->last_name_ar}}
                                            @else
                                                {{$row->first_name_en}} {{$row->mid_name_en}} {{$row->last_name_en}}
                                            @endif
                                        </div>
                                        @if($section_data != null)
                                            @php $exist_absence = \App\Models\Plan_section_degree::where('student_id',$row->id)->where('section_id',$section_data->id)->where('type','absence')->first(); @endphp
                                            <div class="ml-auto text-muted font-weight-bold">
                                                <div class="checkbox-inline">
                                                    <label class="checkbox checkbox-outline checkbox-danger">
                                                        <input type="checkbox" value="{{$row->id}}"
                                                               @if($exist_absence != null) checked
                                                               @endif id="cmb_student" name="student_absence">
                                                        <span></span>
                                                    </label>
                                                </div>
                                            </div>
                                        @endif
                                    </label>
                                @endforeach
                            </div>
                        </div>

                    </form>
                </div>
            </div>
            @if($section_data != null)
                @foreach($data->Students as $students_row)

                    @php
                        $plan_new_stud = \App\Models\Plan\Plan_new::where( 'week_id' , $course_data->week_id)->where( 'day_id' , $course_data->day_id)->where('sub_level_id',$students_row->subject_level_id)->first();
                        $plan_tracomy_stud = \App\Models\Plan\Plan_tracomy::where( 'week_id' , $course_data->week_id)->where( 'day_id' , $course_data->day_id)->where('sub_level_id',$students_row->subject_level_id)->first();
                        $plan_revision_stud = \App\Models\Plan\Plan_revision::where( 'week_id' , $course_data->week_id)->where( 'day_id' , $course_data->day_id)->where('sub_level_id',$students_row->subject_level_id)->first();
                        $exist_abs = \App\Models\Plan_section_degree::where('student_id',$students_row->id)->where('section_id',$section_data->id)->where('type','absence')->first();
                    @endphp
                    @if($exist_abs == null)
                        <div class="card card-custom" data-card="true">
                            <div class="collapsible card-header align-items-center border-0 mt-4">
                                <div class="card-toolbar">
                                    <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-light-primary mr-1">
                                        <i class="ki ki-arrow-down icon-nm"></i>
                                    </a>
                                </div>
                                <div class="row ">
                                    <div class="col-md-12">
                                        <h3 class="card-title align-items-start flex-column">
                                            <span
                                                class="font-weight-bolder text-dark"><code>{{trans('s_admin.name')}} :</code>
                                                @if(app()->getLocale() == 'ar')
                                                    {{$students_row->first_name_ar}} {{$students_row->mid_name_ar}}
                                                @else
                                                    {{$students_row->first_name_en}} {{$students_row->mid_name_en}}
                                                @endif
                                                <a target="_blank"
                                                   href="{{route('t_episode.student_info',['id'=>$students_row->id,'episode_id'=>$data->id])}}"
                                                   data-toggle="tooltip" data-theme="dark"
                                                   title="{{trans('s_admin.student_details')}}"
                                                   class="btn btn-text-dark-50 btn-icon-primary btn-hover-icon-success font-weight-bold btn-hover-bg-light mr-3">
                                                            <i class="flaticon-questions-circular-button"></i></a>
                                            </span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body content pt-4">
                                @if($data->type == 'mqraa')
                                    @php
                                        $Student_Questions_episode = \App\Models\Student_Questions_episode::where('episode_id', $data->id)->where('student_id', $students_row->id)->where('episode_course_id', $course_data->id)->first();
                                    @endphp
                                    @if($Student_Questions_episode != null)
                                        <div class="example-preview">
                                            <div class="table-responsive">
                                                <br>
                                                <table class="table">
                                                    <p>
                                                        <code>{{trans('s_admin.level')}}
                                                            : </code>{{$students_row->Level->name_ar}}</p>

                                                    <h4 style="color: cadetblue;"> {{trans('s_admin.what_stud_want')}}</h4>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">{{trans('s_admin.from')}}</th>
                                                        <td>
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$Student_Questions_episode->From_Surah->name_ar}}
                                                            @else
                                                                {{$Student_Questions_episode->From_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td style="font-weight: 600 !important;">{{trans('s_admin.aya_number')}}</td>
                                                        <td>{{$Student_Questions_episode->from_num}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">{{trans('s_admin.to')}}</th>
                                                        <td>
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$Student_Questions_episode->To_Surah->name_ar}}
                                                            @else
                                                                {{$Student_Questions_episode->To_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td style="font-weight: 600 !important;">{{trans('s_admin.aya_number')}}</td>
                                                        <td>{{$Student_Questions_episode->to_num}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <br>
                                    @endif
                                @else
                                    @if($plan_new_stud != null)
                                        <div class="example-preview">
                                            <div class="table-responsive">
                                                <br>
                                                <table class="table">
                                                    <h4 style="color: cadetblue;"> {{trans('s_admin.new_plan')}}</h4>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">{{trans('s_admin.from')}}</th>
                                                        <td>
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$plan_new_stud->From_Surah->name_ar}}
                                                            @else
                                                                {{$plan_new_stud->From_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td style="font-weight: 600 !important;">{{trans('s_admin.aya_number')}}</td>
                                                        <td>{{$plan_new_stud->from_num}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">{{trans('s_admin.to')}}</th>
                                                        <td>
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$plan_new_stud->To_Surah->name_ar}}
                                                            @else
                                                                {{$plan_new_stud->To_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td style="font-weight: 600 !important;">{{trans('s_admin.aya_number')}}</td>
                                                        <td>{{$plan_new_stud->to_num}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    @if($plan_tracomy_stud != null)
                                        <div class="example-preview">
                                            <div class="table-responsive">
                                                <br>
                                                <table class="table">
                                                    <h4 style="color: cadetblue;"> {{trans('s_admin.tracomy_plan')}}</h4>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">{{trans('s_admin.from')}}</th>
                                                        <td>
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$plan_tracomy_stud->From_Surah->name_ar}}
                                                            @else
                                                                {{$plan_tracomy_stud->From_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td style="font-weight: 600 !important;">{{trans('s_admin.aya_number')}}</td>
                                                        <td>{{$plan_tracomy_stud->from_num}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">{{trans('s_admin.to')}}</th>
                                                        <td>
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$plan_tracomy_stud->To_Surah->name_ar}}
                                                            @else
                                                                {{$plan_tracomy_stud->To_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td style="font-weight: 600 !important;">{{trans('s_admin.aya_number')}}</td>
                                                        <td>{{$plan_tracomy_stud->to_num}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                    @if($plan_revision_stud != null)
                                        <div class="example-preview">
                                            <div class="table-responsive">
                                                <br>
                                                <table class="table">
                                                    <h4 style="color: cadetblue;"> {{trans('s_admin.revision_plan')}}</h4>
                                                    <tbody>
                                                    <tr>
                                                        <th scope="row">{{trans('s_admin.from')}}</th>
                                                        <td>
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$plan_revision_stud->From_Surah->name_ar}}
                                                            @else
                                                                {{$plan_revision_stud->From_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td style="font-weight: 600 !important;">{{trans('s_admin.aya_number')}}</td>
                                                        <td>{{$plan_revision_stud->from_num}}</td>
                                                    </tr>
                                                    <tr>
                                                        <th scope="row">{{trans('s_admin.to')}}</th>
                                                        <td>
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$plan_revision_stud->To_Surah->name_ar}}
                                                            @else
                                                                {{$plan_revision_stud->To_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td style="font-weight: 600 !important;">{{trans('s_admin.aya_number')}}</td>
                                                        <td>{{$plan_revision_stud->to_num}}</td>
                                                    </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                <hr>
                                @if($section_data != null)
                                    @php $student_degree_ask = \App\Models\Plan_section_degree::where('student_id',$students_row->id)->where('section_id',$section_data->id)->where('type','ask')->first(); @endphp
                                    @if($student_degree_ask != null)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="card-title align-items-start flex-column">
                                                        <span class="font-weight-bolder text-dark">
                                                            <code>{{trans('s_admin.result')}} :</code>
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$student_degree_ask->Ask_degree->name_ar }}
                                                            @else
                                                                {{$student_degree_ask->Ask_degree->name_en }}
                                                            @endif

                                                        </span>
                                                </h3>
                                            </div>
                                        </div>
                                    @endif
                                    @php $student_degree_data = \App\Models\Plan_section_degree::where('student_id',$students_row->id)->where('section_id',$section_data->id)->where('plan_type','new')->where('type','degree')->first(); @endphp
                                    @if($student_degree_data != null)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="card-title align-items-start flex-column">
                                                        <span class="font-weight-bolder text-dark">
                                                            <code>{{trans('s_admin.new_result')}} :</code>
                                                            @if($student_degree_data->degree == 'good')
                                                                {{trans('s_admin.good')}}
                                                            @elseif($student_degree_data->degree == 'very_good')
                                                                {{trans('s_admin.very_good')}}
                                                            @elseif($student_degree_data->degree == 'excellent')
                                                                {{trans('s_admin.excellent')}}
                                                            @elseif($student_degree_data->degree == 'not_pathing')
                                                                {{trans('s_admin.not_pathing')}}
                                                            @endif
                                                        </span>
                                                </h3>
                                            </div>
                                        </div>
                                    @endif
                                    @php $student_degree_data = \App\Models\Plan_section_degree::where('student_id',$students_row->id)->where('section_id',$section_data->id)->where('plan_type','tracomy')->where('type','degree')->first(); @endphp
                                    @if($student_degree_data != null)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="card-title align-items-start flex-column">
                                                        <span class="font-weight-bolder text-dark">
                                                            <code>{{trans('s_admin.tracomy_result')}} :</code>
                                                            @if($student_degree_data->degree == 'good')
                                                                {{trans('s_admin.good')}}
                                                            @elseif($student_degree_data->degree == 'very_good')
                                                                {{trans('s_admin.very_good')}}
                                                            @elseif($student_degree_data->degree == 'excellent')
                                                                {{trans('s_admin.excellent')}}
                                                            @elseif($student_degree_data->degree == 'not_pathing')
                                                                {{trans('s_admin.not_pathing')}}
                                                            @endif
                                                        </span>
                                                </h3>
                                            </div>
                                        </div>
                                    @endif
                                    @php $student_degree_data = \App\Models\Plan_section_degree::where('student_id',$students_row->id)->where('section_id',$section_data->id)->where('plan_type','revision')->where('type','degree')->first(); @endphp
                                    @if($student_degree_data != null)
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h3 class="card-title align-items-start flex-column">
                                                        <span class="font-weight-bolder text-dark">
                                                            <code>{{trans('s_admin.revision_result')}} :</code>
                                                            @if($student_degree_data->degree == 'good')
                                                                {{trans('s_admin.good')}}
                                                            @elseif($student_degree_data->degree == 'very_good')
                                                                {{trans('s_admin.very_good')}}
                                                            @elseif($student_degree_data->degree == 'excellent')
                                                                {{trans('s_admin.excellent')}}
                                                            @elseif($student_degree_data->degree == 'not_pathing')
                                                                {{trans('s_admin.not_pathing')}}
                                                            @endif
                                                        </span>
                                                </h3>
                                            </div>
                                        </div>
                                    @endif
                                @endif
                                @if($section_data != null)
                                    @php $student_evaluations = \App\Models\Student_section_evaluation::where('section_id',$section_data->id)->where('student_id',$students_row->id)->where('status','new')->get(); @endphp
                                    @inject('ErrorType','App\ErrorType')

                                    @php $total_errors = \App\Models\Student_section_evaluation::where('section_id',$section_data->id)->where('student_id',$students_row->id)->where('status','new')->sum('errors'); @endphp
                                    @if($total_errors != 0)

                                        {{trans('s_admin.total_errors')}}
                                        <div class="btn-group">
                                            <button class="btn btn-warning font-weight-bold btn-lg dropdown-toggle"
                                                    type="button" data-toggle="dropdown" aria-haspopup="true"
                                                    aria-expanded="false">
                                                {{$total_errors}} {{trans('s_admin.one_error')}}
                                            </button>
                                            <div class="dropdown-menu dropdown-menu-lg" style="padding-right: 10px;">
                                                @foreach($student_evaluations as $row)
                                                    <div class="timeline timeline-6 mt-3">
                                                        <div class="timeline-item align-items-start">
                                                            <div
                                                                class="timeline-label font-weight-bolder text-dark-75 font-size-lg">{{$row->created_at->format('g:i a')}}</div>
                                                            <div class="timeline-badge" style="margin-right: 0px;">
                                                                <i class="fa fa-genderless text-warning icon-xl"></i>
                                                            </div>
                                                            <div
                                                                class="font-weight-mormal font-size-lg timeline-content pl-3"
                                                                style="width: 300px;">
                                                                @if($row->errors == 1)
                                                                    {{trans('s_admin.one_error')}}
                                                                @elseif($row->errors == 2)
                                                                    {{trans('s_admin.two_errors')}}
                                                                @elseif($row->errors == 3)
                                                                    {{trans('s_admin.three_errors')}}
                                                                @elseif($row->errors == 4)
                                                                    {{trans('s_admin.four_errors')}}
                                                                @else
                                                                    {{$row->errors}} {{trans('s_admin.one_error')}}
                                                                @endif
                                                                @if(app()->getLocale() == 'ar')
                                                                    @if($ErrorType->find($row->errortype_id))
                                                                        / {{$ErrorType->find($row->errortype_id)->name_ar}}
                                                                    @endif
                                                                @else
                                                                    @if($ErrorType->find($row->errortype_id))
                                                                        / {{$ErrorType->find($row->errortype_id)->name_en}}
                                                                    @endif
                                                                @endif
                                                            </div>
                                                            <div
                                                                class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
                                                                <a href="{{route('t_episodes.delete_evaluate',$row->id)}}"
                                                                   data-toggle="tooltip" data-theme="dark"
                                                                   data-placement="right"
                                                                   title="{{trans('s_admin.delete')}}"
                                                                   class="btn btn-icon btn-circle btn-xs btn-danger mr-2">
                                                                    <i class="flaticon2-cancel-music"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        <br>
                                        <br>
                                    @endif

                                    @php
                                        $new_get_degree = \App\Models\Plan_section_degree::where('section_id',$section_data->id)->where('student_id',$students_row->id)->where('plan_type','new')->first();
                                        $tracomy_get_degree = \App\Models\Plan_section_degree::where('section_id',$section_data->id)->where('student_id',$students_row->id)->where('plan_type','tracomy')->first();
                                        $revision_get_degree = \App\Models\Plan_section_degree::where('section_id',$section_data->id)->where('student_id',$students_row->id)->where('plan_type','revision')->first();
                                        $ask_get_degree = \App\Models\Plan_section_degree::where('section_id',$section_data->id)->where('student_id',$students_row->id)->where('type','ask')->first();
                                    @endphp
                                    @if($data->type != 'mqraa')
                                        <hr>

                                        <div class="btn-group dropleft">
                                            <button type="button" class="btn btn-primary dropdown-toggle"
                                                    data-toggle="dropdown"
                                                    aria-haspopup="true"
                                                    aria-expanded="false">{{trans('s_admin.end_evaluation')}}</button>
                                            <div class="dropdown-menu" style="">
                                                @if($plan_new_stud != null)
                                                    @if($new_get_degree == null)
                                                        <a class="dropdown-item"
                                                           href="{{route('t_episodes.plan.degree',['type'=>'new','student_id'=>$students_row->id,'plan_id'=>$plan_new_stud->id,'section_id'=>$section_data->id,'total'=>$total_errors,'subject_id'=> $students_row->subject_id])}}">
                                                            {{trans('s_admin.the_new')}}
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                    @endif
                                                @endif
                                                @if($plan_tracomy_stud != null)
                                                    @if($tracomy_get_degree == null)
                                                        <a class="dropdown-item"
                                                           href="{{route('t_episodes.plan.degree',['type'=>'tracomy','student_id'=>$students_row->id,'plan_id'=>$plan_tracomy_stud->id,'section_id'=>$section_data->id,'total'=>$total_errors,'subject_id'=> $students_row->subject_id])}}">
                                                            {{trans('s_admin.the_tracomy')}}
                                                        </a>
                                                        <div class="dropdown-divider"></div>
                                                    @endif
                                                @endif
                                                @if($plan_revision_stud != null)
                                                    @if($revision_get_degree == null)
                                                        <a class="dropdown-item"
                                                           href="{{route('t_episodes.plan.degree',['type'=>'revision','student_id'=>$students_row->id,'plan_id'=>$plan_revision_stud->id,'section_id'=>$section_data->id,'total'=>$total_errors,'subject_id'=> $students_row->subject_id])}}">
                                                            {{trans('s_admin.revision')}}
                                                        </a>
                                                    @endif
                                                @endif
                                                @if($Student_Questions_episode != null)
                                                    @if($ask_get_degree == null)
                                                        {{--                                                href="{{route('t_episodes.plan.degree',['type'=>'ask','student_id'=>$students_row->id,'plan_id'=>$Student_Questions_episode->id,'section_id'=>$section_data->id,'total'=>$total_errors,'subject_id'=> $students_row->subject_id])}}"--}}
                                                        <a class="dropdown-item" href="javascript:void(0);">
                                                            {{trans('s_admin.daily_lesign')}}
                                                        </a>
                                                    @endif
                                                @endif
                                                @if($plan_new_stud == null && $plan_tracomy_stud == null && $plan_revision_stud == null && $Student_Questions_episode == null)
                                                    <a class="dropdown-item"
                                                       href="javascript:void(0);">{{trans('s_admin.admin_should_make_plan')}}</a>
                                                @endif
                                            </div>
                                        </div>
                                    @endif
                                @endif
                            </div>
                        </div>
                        <br>
                    @endif
                @endforeach
            @endif
        </div>
        <div class="col-md-8">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <!--begin::Engage Widget 15-->
                    <div class="card card-custom">
                        <div class="card-body rounded p-0 d-flex" style="background-color:#DAF0FD;">
                            <div class="row">
                                <div class="col-md-7">
                                    <div
                                        class="d-flex flex-column flex-lg-row-auto w-auto w-lg-350px w-xl-450px w-xxl-500px p-10 p-md-20">
                                        <h1 class="font-weight-bolder text-dark">
                                            {{trans('s_admin.episode_name')}}/
                                            <a href="javascript:void(0);" style="font-size: 15px;" class="text-primary">
                                                @if(app()->getLocale() == 'ar')
                                                    {{$data->name_ar}}
                                                @else
                                                    {{$data->name_en}}
                                                @endif
                                            </a>
                                        </h1>
                                        <!--begin::Form-->
                                        <form action="{{url('/teacher/t_episodes')}}" method="post">
                                            @csrf
                                            <div class="d-flex flex-center py-2 px-6 bg-white rounded">
                                                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Thumbtack.svg--><svg
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                        height="24px" viewBox="0 0 24 24" version="1.1">
                                                        <g stroke="none" stroke-width="1" fill="none"
                                                           fill-rule="evenodd">
                                                            <rect x="0" y="0" width="24" height="24"/>
                                                            <path
                                                                d="M11.6734943,8.3307728 L14.9993074,6.09979492 L14.1213255,5.22181303 C13.7308012,4.83128874 13.7308012,4.19812376 14.1213255,3.80759947 L15.535539,2.39338591 C15.9260633,2.00286161 16.5592283,2.00286161 16.9497526,2.39338591 L22.6066068,8.05024016 C22.9971311,8.44076445 22.9971311,9.07392943 22.6066068,9.46445372 L21.1923933,10.8786673 C20.801869,11.2691916 20.168704,11.2691916 19.7781797,10.8786673 L18.9002333,10.0007208 L16.6692373,13.3265608 C16.9264145,14.2523264 16.9984943,15.2320236 16.8664372,16.2092466 L16.4344698,19.4058049 C16.360509,19.9531149 15.8568695,20.3368403 15.3095595,20.2628795 C15.0925691,20.2335564 14.8912006,20.1338238 14.7363706,19.9789938 L5.02099894,10.2636221 C4.63047465,9.87309784 4.63047465,9.23993286 5.02099894,8.84940857 C5.17582897,8.69457854 5.37719743,8.59484594 5.59418783,8.56552292 L8.79074617,8.13355557 C9.76799113,8.00149544 10.7477104,8.0735815 11.6734943,8.3307728 Z"
                                                                fill="#000000"/>
                                                            <polygon fill="#000000" opacity="0.3"
                                                                     transform="translate(7.050253, 17.949747) rotate(-315.000000) translate(-7.050253, -17.949747) "
                                                                     points="5.55025253 13.9497475 5.55025253 19.6640332 7.05025253 21.9497475 8.55025253 19.6640332 8.55025253 13.9497475"/>
                                                        </g>
                                                    </svg><!--end::Svg Icon-->
                                                </span>
                                                <input type="hidden" required name="_token" id="csrf"
                                                       value="{{Session::token()}}">
                                                <input type="hidden" name="episode_id" id="txt_episode_id"
                                                       value="{{$data->id}}">
                                                <input type="text" readonly id="txt_epo_link" name="epo_link"
                                                       value="{{ $data->join_url }}"
                                                       class="form-control border-0 font-weight-bold pl-2"
                                                       placeholder="{{trans('s_admin.episode_link')}}">
                                                {{--                                                @if($data->teacher_link != null && $section_data == null) value="{{ $data->join_url }}"--}}
                                                {{--                                                @endif--}}
                                                {{--                                                @if($section_data != null) value="{{$section_data->epo_link}}"--}}
                                                {{--                                                @endif--}}
                                            </div>
                                            <!--end::Form-->
                                            <h1 class="font-weight-bolder text-dark"> &nbsp;</h1>
                                            <!--begin::Form-->
                                            <div class="d-flex flex-center rounded">
                                                @if($section_data != null)
                                                    {{--<a href="{{route('t_episodes.update_link',$section_data->id)}}">{{trans('s_admin.edit')}}</a>--}}
                                                    <a type="button"
                                                       href="{{route('teacher.epo.end',$section_data->id)}}"
                                                       class="btn btn-danger font-weight-bolder mr-2 px-8" id="end_btn"
                                                       style="width: 200px;">
                                                        {{trans('s_admin.end_episode')}}
                                                    </a>
                                                    <br>
                                                    <span>{{trans('s_admin.confirm_absence_first')}}</span>
                                                @else
                                                    <button type="submit"
                                                            class="btn btn-primary font-weight-bolder mr-2 px-8"
                                                            {{--                                                            id="start_btn"--}}
                                                            style="width: 200px;">{{trans('s_admin.start_episode')}}</button>
                                                @endif
                                            </div>
                                        </form>

                                    </div>
                                </div>
                                <div class="col-md-5">
                                    <div
                                        class="d-flex flex-column flex-lg-row-auto w-auto w-lg-350px w-xl-450px w-xxl-500px p-10 p-md-20">
                                        <h1 class="font-weight-bolder text-dark">
                                            &nbsp;
                                        </h1>
                                        <h1 class="font-weight-bolder text-dark">
                                            &nbsp;
                                        </h1>
                                        <!--begin::Form-->
                                        @if($section_data != null)
                                            <div class="example-preview">
                                                {{--                                                <p>--}}
                                                {{--                                                    <a class="btn btn-warning btn-sm mr-3" data-toggle="modal"--}}
                                                {{--                                                       data-target="#update_new_modal">--}}
                                                {{--                                                        <i class="flaticon2-pen mr-5"></i>{{trans('s_admin.edit_epo_link')}}--}}
                                                {{--                                                    </a>--}}
                                                {{--                                                </p>--}}
                                                <p>
                                                    <a class="btn btn-primary btn-sm mr-3" data-toggle="modal"
                                                       data-target="#update_episode_time_modal">
                                                        <i class="flaticon2-hourglass-1 mr-5"></i>{{trans('s_admin.long_this_episode')}}
                                                    </a>
                                                <form action="{{route('teacher.create.web.meeting',$data->id)}}" method="post">
                                                    @csrf
                                                    <input required type="hidden" value="{{$data->name}}" name="topic"
                                                           class="form-control form-control-lg">
                                                    <input required type="hidden" name="agenda"
                                                           value="{{$data->Teacher->user_name}}"
                                                           class="form-control form-control-lg">

                                                    <input required type="hidden" value="{{\Carbon\Carbon::now()}}"
                                                           name="start_time"
                                                           class="form-control form-control-lg">

                                                    <button type="submit"
                                                            class="btn btn-warning btn-sm mr-3">{{trans('s_admin.edit_zoom')}}</button>

                                                </form>
                                                </p>
                                                <p>
                                                   <span class="switch switch-icon">
                                                        <label>
                                                            <input type="checkbox"
                                                                   @if($section_data->link_all == 1) checked
                                                                   @endif name="cmb_link_all" id="cmb_link_all"
                                                                   value="{{$section_data->id}}">
                                                            <span></span>
                                                            {{trans('s_admin.active_link_student')}}
                                                        </label>
                                                    </span>
                                                </p>
                                            </div>
                                        @endif
                                        <h1 class="font-weight-bolder text-dark"> &nbsp;</h1>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @if($section_data != null)
                @if($data->type == 'mqraa')
                    <div class="card card-custom p-12">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                            <span
                                class="card-label font-weight-bolder text-dark">{{trans('s_admin.lisgn_degre')}}</span>
                            </h3>
                            <div class="card-toolbar">

                            </div>
                        </div>
                        <form action="{{route('t_episodes.make_far_learn_evaluate')}}" method="post">
                            @csrf
                            <div class="card-body py-0">
                                <div class="align-items-center">
                                    <div class="row">
                                        <div class="col-md-3">
                                            <div class="flex-grow-1">
                                                <input readonly type="text" id="txt_student_name"
                                                       class="asd text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">
                                                <input readonly type="text" id="txt_student_email"
                                                       class="asd text-muted font-weight-bold">
                                            </div>
                                            <br>
                                        </div>
                                        <div class="col-md-4" style="padding-right: 50px;">
                                            <input type="hidden" required name="plan_id" id="txt_qustion_id" value="">
                                            <input type="hidden" required name="student_id" id="txt_student_id"
                                                   value="">
                                            <input type="hidden" required name="section_id" id="txt_section_id"
                                                   @if($section_data != null) value="{{$section_data->id}}" @endif>
                                            <div class="d-flex  flex-grow-1">
                                                <div class="form-group">
                                                    <label
                                                        style="font-weight: 600;">{{trans('s_admin.ErrorType')}}</label>
                                                    <div class="radio-list">
                                                        @php $far_degees = \App\Models\Far_learn_degree::where('deleted','0')->orderBy('id','desc')->get(); @endphp
                                                        <div class="product-review-stars"
                                                             @if(app()->getLocale() == 'ar') style="direction: initial;" @endif>
                                                            @foreach($far_degees as $value)
                                                                <input type="radio" id="star{{$value->id}}"
                                                                       name="degree"
                                                                       value="{{$value->id}}" class="visuallyhidden"/>
                                                                <label for="star{{$value->id}}"
                                                                       @if(app()->getLocale() == 'ar')
                                                                       title="{{$value->name_ar}}"
                                                                       @else
                                                                       title="{{$value->name_en}}"
                                                                    @endif
                                                                >★</label>
                                                            @endforeach
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="d-flex  flex-grow-1">
                                                <div class="form-group">
                                                    <label
                                                        style="font-weight: 600;">{{trans('s_admin.saved_lines')}}</label>
                                                    <input type="number" value="0" min="0" name="saved_lines"
                                                           id="txt_saved_lines"
                                                           class="form-control form-control-lg">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title=""
                                                 data-placement="left">
                                                <button type="submit" id="btn_save_eva"
                                                        class="btn btn-info font-weight-bolder font-size-sm"
                                                        style="display: none;">
                                                    {{trans('s_admin.make_it')}}
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @else
                    <div class="card card-custom p-12">
                        <!--begin::Header-->
                        <div class="card-header border-0 py-5">
                            <h3 class="card-title align-items-start flex-column">
                            <span
                                class="card-label font-weight-bolder text-dark">{{trans('s_admin.lisgn_degre')}}</span>
                            </h3>
                            <div class="card-toolbar">
                            </div>
                        </div>
                        <form action="{{route('t_episodes.make_evaluate')}}" method="post">
                            @csrf
                            <div class="card-body py-0">
                                <div class="align-items-center">
                                    <div class="row">
                                        {{--                                    <div class="col-md-4">--}}
                                        {{--                                        <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center"--}}
                                        {{--                                             id="image_cont">--}}
                                        {{--                                            <div class="symbol-label" id="student_image"--}}
                                        {{--                                                 style="background-image:url('/metronic/assets/media/users/blank2.png')"></div>--}}
                                        {{--                                        </div>--}}
                                        {{--                                    </div>--}}
                                        <div class="col-md-3">
                                            <div class="flex-grow-1">
                                                <input readonly type="text" id="txt_student_name"
                                                       class="asd text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">
                                                <input readonly type="text" id="txt_student_email"
                                                       class="asd text-muted font-weight-bold">
                                            </div>
                                            <br>
                                        </div>
                                        <div class="col-md-4">
                                            <input type="hidden" required name="student_id" id="txt_student_id"
                                                   value="">
                                            <input type="hidden" required name="section_id" id="txt_section_id"
                                                   @if($section_data != null) value="{{$section_data->id}}" @endif>
                                            <br>
                                        </div>
                                        <div class="col-md-3">
                                        </div>
                                        {{--                                        <div class="col-md-2">--}}
                                        {{--                                            <div class="dropdown dropdown-inline ml-2" data-toggle="tooltip" title=""--}}
                                        {{--                                                 data-placement="left">--}}
                                        {{--                                                <button type="submit" id="btn_save_eva" class="btn btn-info font-weight-bolder font-size-sm" style="display: none;">{{trans('s_admin.make_it')}}</button>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </div>--}}
                                    </div>
                                    <div class="row">
                                        @foreach($ErrorType->where('deleted',0)->get() as $value)
                                            <div class="col-lg-6 col-xl-3 mb-5">
                                                <div class="card card-custom bg-light-info">
                                                    <div class="">
                                                        <div class="text-dark text-center font-size-h5 mt-5 pb-5"
                                                             style="border-bottom: 2px solid #1bc5bd;">
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$value->name_ar}}
                                                            @else
                                                                {{$value->name_en}}
                                                            @endif
                                                        </div>
                                                        <div class="text-dark-75 text-center pt-5 mb-5">
                                                            <a href="javascript:;"
                                                               onclick="decreaseValue1({{$value->id}})"
                                                               class="btn btn-xs btn-light-success btn-icon ">
                                                                <i class="ki ki-minus icon-xs"></i>
                                                            </a>
                                                            <input type="hidden" name="error_types[]"
                                                                   value="{{$value->id}}">
                                                            <span class=" font-weight-bolder qty-style">
                                                                <input style="background-color: #eee5ff;" readonly
                                                                       type="number" name="quantitys[]"
                                                                       id="number{{$value->id}}"
                                                                       class="qty" value="0"/>
                                                            </span>
                                                            <a href="javascript:;"
                                                               onclick="increaseValue1({{$value->id}})"
                                                               class="btn btn-xs btn-light-success btn-icon">
                                                                <i class="ki ki-plus icon-xs"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                    <button type="submit" id="btn_save_eva" style="display: none;"
                                            class="btn btn-primary btn-lg btn-block">{{trans('s_admin.save_evaluate')}}</button>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            @endif
            @if($section_data != null)
                <br>
                <div class="card card-custom p-12">
                    <!--begin::Header-->
                    <div class="card-header border-0 py-5">
                        <h3 class="card-title align-items-start flex-column">
                            <span class="card-label font-weight-bolder text-dark">zoom</span>
                        </h3>
                        <div class="card-toolbar">

                        </div>
                    </div>
                    <div class="card-body py-0">
                        <iframe style="width: 100%;height: 870px;border: none;"
                                src="{{route('t_episode.zoom',$data->id)}}"></iframe>
                    </div>
                </div>
            @endif
            <br>
            <div class="row">
                <div class=" col-lg-12 col-xxl-12">
                    <!--begin::List Widget 19-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span
                                    class="card-label font-weight-bolder text-dark">{{trans('s_admin.episode_data')}}</span>
                            </h3>
                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-2 pb-0 mt-n3">
                            <div class="tab-content mt-5" id="myTabTables9">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade show active" id="kt_tab_pane_9_2" role="tabpanel"
                                     aria-labelledby="kt_tab_pane_9_2">
                                    <!--begin::Table-->
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-vertical-center">
                                            <tbody>
                                            <tr>
                                                <td class="pl-0 py-5">
                                                    <div class="symbol symbol-45 symbol-light-warning mr-2">
                                                        <span class="symbol-label">
                                                            <span
                                                                class="svg-icon svg-icon-2x svg-icon-warning">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="24px"
                                                                    height="24px"
                                                                    viewBox="0 0 24 24"
                                                                    version="1.1">
                                                                    <g stroke="none"
                                                                       stroke-width="1"
                                                                       fill="none"
                                                                       fill-rule="evenodd">
                                                                        <rect x="0"
                                                                              y="0"
                                                                              width="24"
                                                                              height="24"></rect>
                                                                        <path
                                                                            d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"
                                                                            fill="#000000"></path>
                                                                        <rect
                                                                            fill="#000000"
                                                                            opacity="0.3"
                                                                            transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)"
                                                                            x="16.3255682"
                                                                            y="2.94551858"
                                                                            width="3"
                                                                            height="18"
                                                                            rx="1"></rect>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <span
                                                        class="text-muted font-weight-bold d-block">{{trans('s_admin.episode_name')}}</span>
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                        @if(app()->getLocale() == 'ar')
                                                            {{$data->name_ar}}
                                                        @else
                                                            {{$data->name_en}}
                                                        @endif
                                                    </a>
                                                </td>
                                                <td class="pl-0 py-5">
                                                    <div class="symbol symbol-45 symbol-light-info mr-2">
                                                        <span class="symbol-label">
                                                            <span
                                                                class="svg-icon svg-icon-2x svg-icon-info">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Color-profile.svg-->
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="24px"
                                                                    height="24px"
                                                                    viewBox="0 0 24 24"
                                                                    version="1.1">
                                                                    <g stroke="none"
                                                                       stroke-width="1"
                                                                       fill="none"
                                                                       fill-rule="evenodd">
                                                                        <rect x="0"
                                                                              y="0"
                                                                              width="24"
                                                                              height="24"></rect>
                                                                        <path
                                                                            d="M12,10.9996338 C12.8356605,10.3719448 13.8743941,10 15,10 C17.7614237,10 20,12.2385763 20,15 C20,17.7614237 17.7614237,20 15,20 C13.8743941,20 12.8356605,19.6280552 12,19.0003662 C11.1643395,19.6280552 10.1256059,20 9,20 C6.23857625,20 4,17.7614237 4,15 C4,12.2385763 6.23857625,10 9,10 C10.1256059,10 11.1643395,10.3719448 12,10.9996338 Z M13.3336047,12.504354 C13.757474,13.2388026 14,14.0910788 14,15 C14,15.9088933 13.7574889,16.761145 13.3336438,17.4955783 C13.8188886,17.8206693 14.3938466,18 15,18 C16.6568542,18 18,16.6568542 18,15 C18,13.3431458 16.6568542,12 15,12 C14.3930587,12 13.8175971,12.18044 13.3336047,12.504354 Z"
                                                                            fill="#000000"
                                                                            fill-rule="nonzero"
                                                                            opacity="0.3"></path>
                                                                        <circle
                                                                            fill="#000000"
                                                                            cx="12"
                                                                            cy="9"
                                                                            r="5"></circle>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <span
                                                        class="text-muted font-weight-bold d-block">{{trans('s_admin.this_epo_type')}}</span>
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                        @if( $data->type == 'mqraa' )
                                                            {{trans('s_admin.far_learn')}}
                                                        @elseif($data->type == 'mogmaa')
                                                            {{trans('s_admin.colleges')}}
                                                        @elseif($data->type == 'dorr')
                                                            {{trans('admin.dorrs')}}
                                                        @endif
                                                    </a>
                                                </td>

                                            </tr>

                                            <tr>
                                                <td class="pl-0 py-5">
                                                    <div class="symbol symbol-45 symbol-light-info mr-2">
                                                        <span class="symbol-label">
                                                            <span
                                                                class="svg-icon svg-icon-2x svg-icon-info">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Color-profile.svg-->
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="24px"
                                                                    height="24px"
                                                                    viewBox="0 0 24 24"
                                                                    version="1.1">
                                                                    <g stroke="none"
                                                                       stroke-width="1"
                                                                       fill="none"
                                                                       fill-rule="evenodd">
                                                                        <rect x="0"
                                                                              y="0"
                                                                              width="24"
                                                                              height="24"></rect>
                                                                        <path
                                                                            d="M12,10.9996338 C12.8356605,10.3719448 13.8743941,10 15,10 C17.7614237,10 20,12.2385763 20,15 C20,17.7614237 17.7614237,20 15,20 C13.8743941,20 12.8356605,19.6280552 12,19.0003662 C11.1643395,19.6280552 10.1256059,20 9,20 C6.23857625,20 4,17.7614237 4,15 C4,12.2385763 6.23857625,10 9,10 C10.1256059,10 11.1643395,10.3719448 12,10.9996338 Z M13.3336047,12.504354 C13.757474,13.2388026 14,14.0910788 14,15 C14,15.9088933 13.7574889,16.761145 13.3336438,17.4955783 C13.8188886,17.8206693 14.3938466,18 15,18 C16.6568542,18 18,16.6568542 18,15 C18,13.3431458 16.6568542,12 15,12 C14.3930587,12 13.8175971,12.18044 13.3336047,12.504354 Z"
                                                                            fill="#000000"
                                                                            fill-rule="nonzero"
                                                                            opacity="0.3"></path>
                                                                        <circle
                                                                            fill="#000000"
                                                                            cx="12"
                                                                            cy="9"
                                                                            r="5"></circle>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <span
                                                        class="text-muted font-weight-bold d-block">{{trans('s_admin.monthly_cost')}}</span>
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                        @if($data->cost == 'free')
                                                            {{trans('s_admin.free')}}
                                                        @else
                                                            {{$data->cost}}
                                                        @endif
                                                    </a>
                                                </td>
                                                <td class="pl-0 py-5">
                                                    <div class="symbol symbol-45 symbol-light-info mr-2">
                                                        <span class="symbol-label">
                                                            <span
                                                                class="svg-icon svg-icon-2x svg-icon-info">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Color-profile.svg-->
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="24px"
                                                                    height="24px"
                                                                    viewBox="0 0 24 24"
                                                                    version="1.1">
                                                                    <g stroke="none"
                                                                       stroke-width="1"
                                                                       fill="none"
                                                                       fill-rule="evenodd">
                                                                        <rect x="0"
                                                                              y="0"
                                                                              width="24"
                                                                              height="24"></rect>
                                                                        <path
                                                                            d="M12,10.9996338 C12.8356605,10.3719448 13.8743941,10 15,10 C17.7614237,10 20,12.2385763 20,15 C20,17.7614237 17.7614237,20 15,20 C13.8743941,20 12.8356605,19.6280552 12,19.0003662 C11.1643395,19.6280552 10.1256059,20 9,20 C6.23857625,20 4,17.7614237 4,15 C4,12.2385763 6.23857625,10 9,10 C10.1256059,10 11.1643395,10.3719448 12,10.9996338 Z M13.3336047,12.504354 C13.757474,13.2388026 14,14.0910788 14,15 C14,15.9088933 13.7574889,16.761145 13.3336438,17.4955783 C13.8188886,17.8206693 14.3938466,18 15,18 C16.6568542,18 18,16.6568542 18,15 C18,13.3431458 16.6568542,12 15,12 C14.3930587,12 13.8175971,12.18044 13.3336047,12.504354 Z"
                                                                            fill="#000000"
                                                                            fill-rule="nonzero"
                                                                            opacity="0.3"></path>
                                                                        <circle
                                                                            fill="#000000"
                                                                            cx="12"
                                                                            cy="9"
                                                                            r="5"></circle>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <span
                                                        class="text-muted font-weight-bold d-block">{{trans('s_admin.gender')}}</span>
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                        @if( $data->gender == 'female' )
                                                            {{trans('s_admin.female_only')}}
                                                        @elseif($data->gender == 'male')
                                                            {{trans('s_admin.male_only')}}
                                                        @else
                                                            {{trans('admin.children_only')}}
                                                        @endif
                                                    </a>
                                                </td>

                                            </tr>
                                            <tr>
                                                <td class="pl-0 py-5">
                                                    <div class="symbol symbol-45 symbol-light-info mr-2">
                                                        <span class="symbol-label">
                                                            <span
                                                                class="svg-icon svg-icon-2x svg-icon-info">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Color-profile.svg-->
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="24px"
                                                                    height="24px"
                                                                    viewBox="0 0 24 24"
                                                                    version="1.1">
                                                                    <g stroke="none"
                                                                       stroke-width="1"
                                                                       fill="none"
                                                                       fill-rule="evenodd">
                                                                        <rect x="0"
                                                                              y="0"
                                                                              width="24"
                                                                              height="24"></rect>
                                                                        <path
                                                                            d="M12,10.9996338 C12.8356605,10.3719448 13.8743941,10 15,10 C17.7614237,10 20,12.2385763 20,15 C20,17.7614237 17.7614237,20 15,20 C13.8743941,20 12.8356605,19.6280552 12,19.0003662 C11.1643395,19.6280552 10.1256059,20 9,20 C6.23857625,20 4,17.7614237 4,15 C4,12.2385763 6.23857625,10 9,10 C10.1256059,10 11.1643395,10.3719448 12,10.9996338 Z M13.3336047,12.504354 C13.757474,13.2388026 14,14.0910788 14,15 C14,15.9088933 13.7574889,16.761145 13.3336438,17.4955783 C13.8188886,17.8206693 14.3938466,18 15,18 C16.6568542,18 18,16.6568542 18,15 C18,13.3431458 16.6568542,12 15,12 C14.3930587,12 13.8175971,12.18044 13.3336047,12.504354 Z"
                                                                            fill="#000000"
                                                                            fill-rule="nonzero"
                                                                            opacity="0.3"></path>
                                                                        <circle
                                                                            fill="#000000"
                                                                            cx="12"
                                                                            cy="9"
                                                                            r="5"></circle>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <span
                                                        class="text-muted font-weight-bold d-block">{{trans('s_admin.timing')}}</span>
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">

                                                        {{trans('s_admin.week_num')}} ( {{$course_data->week_id}} )

                                                        {{trans('s_admin.day')}}

                                                        @if($course_data->day_id == 1)
                                                            ({{trans('s_admin.first')}})
                                                        @elseif($course_data->day_id == 2)
                                                            ({{trans('s_admin.second')}})
                                                        @elseif($course_data->day_id == 3)
                                                            ({{trans('s_admin.third')}})
                                                        @elseif($course_data->day_id == 4)
                                                            ({{trans('s_admin.fourth')}})
                                                        @elseif($course_data->day_id == 5)
                                                            ({{trans('s_admin.fifth')}})
                                                        @elseif($course_data->day_id == 6)
                                                            ({{trans('s_admin.sixth')}})
                                                        @elseif($course_data->day_id == 7)
                                                            ({{trans('s_admin.seventh')}})
                                                        @endif


                                                    </a>
                                                </td>
                                                <td class="pl-0 py-5">
                                                    <div class="symbol symbol-45 symbol-light-primary mr-2">
                                                        <span class="symbol-label">
                                                            <span
                                                                class="svg-icon svg-icon-2x svg-icon-primary">
                                                                <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                                                <svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="24px"
                                                                    height="24px"
                                                                    viewBox="0 0 24 24"
                                                                    version="1.1">
                                                                    <g stroke="none"
                                                                       stroke-width="1"
                                                                       fill="none"
                                                                       fill-rule="evenodd">
                                                                        <rect x="0"
                                                                              y="0"
                                                                              width="24"
                                                                              height="24"></rect>
                                                                        <path
                                                                            d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z"
                                                                            fill="#000000"
                                                                            fill-rule="nonzero"></path>
                                                                        <circle
                                                                            fill="#000000"
                                                                            opacity="0.3"
                                                                            cx="12"
                                                                            cy="10"
                                                                            r="6"></circle>
                                                                    </g>
                                                                </svg>
                                                                <!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <span
                                                        class="text-muted font-weight-bold d-block">{{trans('s_admin.episode_time')}}</span>
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                        {{trans('s_admin.from')}} {{date('g:i a', strtotime($data->time_from))}}

                                                        {{trans('s_admin.to')}} {{date('g:i a', strtotime($data->time_to))}} {{trans('s_admin.ksa')}}
                                                    </a>
                                                </td>
                                            </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--    edit epo link modal --}}



    <div class="modal fade" id="update_new_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.update_epo_link')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <form class="form" action="{{route('t_episode.edit_link')}}" method="post">
                    @csrf
                    <div class="modal-body">
                        <input type="hidden" name="id" id="txt_day_id">
                        <div class="form-group row">
                            <label
                                class="col-form-label text-right col-lg-3 col-sm-12">{{trans('s_admin.episode_link')}}</label>
                            <div class="col-lg-9 col-md-9 col-sm-12">
                                <div class="input-group date">
                                    <input class="form-control" required name="section_id" type="hidden"
                                           @if($section_data != null) value="{{$section_data->id}}" @endif >
                                    <input class="form-control" required name="epo_link" type="text"
                                           @if($section_data != null) value="{{$section_data->epo_link}}" @endif >
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary mr-2">{{trans('s_admin.save')}}</button>
                        <button type="button" class="btn btn-secondary"
                                data-dismiss="modal">{{trans('s_admin.cancel')}}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @if($section_data != null)
        <div class="modal fade" id="update_episode_time_modal" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.long_this_episode')}}</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <i aria-hidden="true" class="ki ki-close"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <a class="btn btn-success"
                                   href="{{route('t_episodes.epo_time',['section_id'=>$section_data->id ,'type'=>'15'])}}">{{trans('s_admin.fifty_minutes')}}</a>
                            </div>
                            <div class="col-lg-6">
                                <a href="{{route('t_episodes.epo_time',['section_id'=>$section_data->id ,'type'=>'30'])}}"
                                   class="btn btn-danger">{{trans('s_admin.half_hour')}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    <script>
        jQuery(document).ready(function () {
            var storeTimeInterval = setInterval(function () {
                // $.ajax({
                //     type: "get",
                //     url: "{{route('teacher.check.students',$data->id)}}",
                //     datatype: "json",
                //     success: function (data) {
                //         //load students html .
                //         $('#student_content').html(data);
                //     }
                // });

                $.ajax({
                    url: "{{route('teacher.check.students',$data->id)}}",
                    type: 'GET',
                    cache: true,
                    async: true,
                }).done(function (data) {
                    $("#student_content").html(data);
                });

            }, 5000);//time in milliseconds
        });

        $(".tog").click(function () {
            $(".card-collapsed").toggle("slow", function () {
                // Animation complete.
            });
        })
    </script>
    <script src="{{ asset('js/episode_section.js') }}"></script>
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": true,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-bottom-full-width",
            "preventDuplicates": false,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };
    </script>
    <script>
        $(document).ready(function () {
            $('#start_btn').on('click', function () {
                var epo_link = $('#txt_epo_link').val();
                var episode_id = $('#txt_episode_id').val();
                $.ajax({
                    url: "/teacher/t_episodes",
                    type: "POST",
                    data: {
                        _token: $("#csrf").val(),
                        epo_link: epo_link,
                        episode_id: episode_id
                    },
                    cache: false,
                    success: function (data_result) {
                        if (data_result.status == true) {
                            console.log('here');
                            location.reload();
                        } else if (data_result.status == false) {
                            console.log('error');
                            toastr.error(data_result.msg);
                        }
                    }
                });
            });

            $('input[id="cmb_link_all"]').click(function () {
                var section_id = $(this).val();
                $.ajax({
                    url: "/teacher/t_episodes/make_link_all",
                    type: "POST",
                    data: {
                        _token: $("#csrf").val(),
                        section_id: section_id
                    },
                    cache: false,
                    success: function (data_result) {
                        if (data_result.status == true) {
                            // location.reload();
                            toastr.success(data_result.msg);
                        } else if (data_result.status == false) {
                            toastr.error(data_result.msg);
                        }
                    }
                });
            });
        });

        function increaseValue1(j) {
            var value = parseInt(document.getElementById("number" + j).value, 10);
            value = isNaN(value) ? 0 : value;
            value++;
            document.getElementById("number" + j).value = value;
        }

        function decreaseValue1(k) {
            var value = parseInt(document.getElementById("number" + k).value, 10);
            value = isNaN(value) ? 0 : value;
            value < 1 ? value = 1 : '';
            value--;
            document.getElementById("number" + k).value = value;
        }
    </script>
    <script>
        var coll = document.getElementsByClassName("collapsible");
        var i;

        for (i = 0; i < coll.length; i++) {
            coll[i].addEventListener("click", function () {
                this.classList.toggle("active");
                var content = this.nextElementSibling;
                if (content.style.display === "block") {
                    content.style.display = "none";
                } else {
                    content.style.display = "block";
                }
            });
        }
    </script>

@endsection


