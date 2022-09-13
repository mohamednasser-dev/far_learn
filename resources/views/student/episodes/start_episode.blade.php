@extends('student.student_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.episode')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                {{--              data-toggle="modal" data-target="#teacher_rating_modal" --}}
                <a href="{{route('student.my_episodes')}}" class="text-muted">{{trans('s_admin.nav_table_hlka')}}</a>
            </li>

        </ul>
    </div>
@endsection
@section('styles')
    <style>

        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;600;700;900&display=swap');

        * {
            font-family: 'Cairo';
        }

        .rating {
            --dir: right;
            --fill: gold;
            --fillbg: rgba(100, 100, 100, 0.15);
            --heart: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 21.328l-1.453-1.313q-2.484-2.25-3.609-3.328t-2.508-2.672-1.898-2.883-0.516-2.648q0-2.297 1.57-3.891t3.914-1.594q2.719 0 4.5 2.109 1.781-2.109 4.5-2.109 2.344 0 3.914 1.594t1.57 3.891q0 1.828-1.219 3.797t-2.648 3.422-4.664 4.359z"/></svg>');
            --star: url('data:image/svg+xml,<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"><path d="M12 17.25l-6.188 3.75 1.641-7.031-5.438-4.734 7.172-0.609 2.813-6.609 2.813 6.609 7.172 0.609-5.438 4.734 1.641 7.031z"/></svg>');
            --stars: 5;
            --starsize: 3rem;
            --symbol: var(--star);
            --value: 1;
            --w: calc(var(--stars) * var(--starsize));
            --x: calc(100% * (var(--value) / var(--stars)));
            block-size: var(--starsize);
            inline-size: var(--w);
            position: relative;
            touch-action: manipulation;
            -webkit-appearance: none;
        }

        [dir="rtl"] .rating {
            --dir: left;
        }

        .rating::-moz-range-track {
            background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
            block-size: 100%;
            mask: repeat left center/var(--starsize) var(--symbol);
        }

        .rating::-webkit-slider-runnable-track {
            background: linear-gradient(to var(--dir), var(--fill) 0 var(--x), var(--fillbg) 0 var(--x));
            block-size: 100%;
            mask: repeat left center/var(--starsize) var(--symbol);
            -webkit-mask: repeat left center/var(--starsize) var(--symbol);
        }

        .rating::-moz-range-thumb {
            height: var(--starsize);
            opacity: 0;
            width: var(--starsize);
        }

        .rating::-webkit-slider-thumb {
            height: var(--starsize);
            opacity: 0;
            width: var(--starsize);
            -webkit-appearance: none;
        }

        .rating, .rating-label {
            display: block;
            font-family: ui-sans-serif, system-ui, sans-serif;
        }

        .rating-label {
            margin-block-end: 1rem;
        }

        /* NO JS */
        .rating--nojs::-moz-range-track {
            background: var(--fillbg);
        }

        .rating--nojs::-moz-range-progress {
            background: var(--fill);
            block-size: 100%;
            mask: repeat left center/var(--starsize) var(--star);
        }

        .rating--nojs::-webkit-slider-runnable-track {
            background: var(--fillbg);
        }

        .rating--nojs::-webkit-slider-thumb {
            background-color: var(--fill);
            box-shadow: calc(0rem - var(--w)) 0 0 var(--w) var(--fill);
            opacity: 1;
            width: 1px;
        }

        [dir="rtl"] .rating--nojs::-webkit-slider-thumb {
            box-shadow: var(--w) 0 0 var(--w) var(--fill);
        }
    </style>
    <style type="text/css">
        .asd {
            background: rgba(0, 0, 0, 0);
            border: none;
        }

        /*-------------------------------------- fo rate ---------------------------------------*/

        /*-------------------------------------------------- second stars --------------------------------------------------------*/
        * {
            font-family: "Lato";
        }

        .product-review-stars {
            /*background: #2C3E50;*/
            padding: 20px 50px 20px 20px;
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
            width: 1000px;
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
@endsection
@section('content')
    @php
        $mytime = \Carbon\Carbon::now();
        $today = \Carbon\Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
        $course_data = \App\Models\Episode_course_days::where('episode_id', $data->id)->where('date', $today)->first();
        $plan_new = \App\Models\Plan\Plan_new::where( 'week_id' , $course_data->week_id)->where( 'day_id' , $course_data->day_id)->where('sub_level_id', auth()->guard('student')->user()->subject_level_id)->first();
        $plan_tracomy = \App\Models\Plan\Plan_tracomy::where( 'week_id' , $course_data->week_id)->where( 'day_id' , $course_data->day_id)->where('sub_level_id',auth()->guard('student')->user()->subject_level_id)->first();
        $plan_revision = \App\Models\Plan\Plan_revision::where( 'week_id' , $course_data->week_id)->where( 'day_id' , $course_data->day_id)->where('sub_level_id',auth()->guard('student')->user()->subject_level_id)->first();
        $Student_Questions_episode =   \App\Models\Student_Questions_episode::where('episode_id', $data->id)->where('student_id', auth::guard('student')->user()->id)->where('episode_course_id',$course_data->id)->first();
        $student_epo = \App\Models\Episode_student::where('student_id',auth()->guard('student')->user()->id)->where('episode_id',$data->id)->first();
    @endphp

    <div class="row">
        <div class="col-md-4">
            @foreach($data->Students as $students_row)
                @if($students_row->id == auth::guard('student')->user()->id)
                    <div class="card card-custom gutter-b">
                        <div class="card-header align-items-center border-0 mt-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="font-size-h5 text-dark mb-7">{{trans('s_admin.yor_turn')}}</label>
                                    <label class="font-size-h5 text-dark mb-6"> /</label>
                                    <code>{{$student_epo->order_num}}</code>
                                    <br>
                                    <label class="font-size-h5 text-dark mb-7">{{trans('s_admin.curr_turn')}}</label>
                                    <label class="font-size-h5r text-dark mb-6"> /</label>
                                    <code id="current_order_num">{{$section_data->order_num}}</code>
                                    <h3 class="card-title align-items-start flex-column">
                                    <span class="font-weight-bolder text-dark"><code>{{trans('s_admin.name')}} :</code>
                                        @if(app()->getLocale() == 'ar')
                                            {{$students_row->first_name_ar}} {{$students_row->mid_name_ar}}
                                        @else
                                            {{$students_row->first_name_en}} {{$students_row->mid_name_en}}
                                        @endif
                                    </span>
                                    </h3>
                                </div>
                            </div>
                            <br>
                            @if($section_data != null)
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
                        </div>
                        @inject('ErrorType','App\ErrorType')
                        <div class="card-body pt-4">
                            @if($section_data != null)
                                @php $student_evaluations = \App\Models\Student_section_evaluation::where('section_id',$section_data->id)->where('student_id',$students_row->id)->where('status','new')->get(); @endphp
                                @foreach($student_evaluations as $row)
                                    <div class="timeline timeline-6 mt-3">
                                        <div class="timeline-item align-items-start">
                                            <div
                                                class="timeline-label font-weight-bolder text-dark-75 font-size-lg">{{$row->created_at->format('g:i a')}}</div>
                                            <div class="timeline-badge">
                                                <i class="fa fa-genderless text-warning icon-xl"></i>
                                            </div>
                                            <div
                                                class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
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
                                        </div>
                                    </div>
                                @endforeach
                                @php $total_errors = \App\Models\Student_section_evaluation::where('section_id',$section_data->id)->where('student_id',$students_row->id)->where('status','new')->sum('errors'); @endphp
                                @if($total_errors != 0)
                                    <div class="timeline timeline-6 mt-3">
                                        <div class="timeline-item align-items-start">
                                            <div
                                                class="timeline-label font-weight-bolder text-dark-75 font-size-lg">{{trans('s_admin.total_errors')}}</div>
                                            <div class="timeline-badge">
                                                <i class="fa fa-genderless text-info icon-xl"></i>
                                            </div>
                                            <div
                                                class="font-weight-mormal font-size-lg timeline-content text-muted pl-3">
                                                {{$total_errors}} {{trans('s_admin.one_error')}}
                                            </div>
                                        </div>

                                    </div>
                                @endif
                            @endif
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
        <div class="col-md-8">
            <!--begin::Section-->
            <!--begin::Charts Widget 9-->
            <!--begin::Card-->

            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <!--begin::Engage Widget 15-->
                    <div class="card card-custom">
                        <div class="card-body rounded p-0 d-flex" style="background-color:#DAF0FD;">
                            <div class="row">
                                <div
                                    class="d-flex flex-column flex-lg-row-auto w-auto w-lg-350px w-xl-450px w-xxl-500px p-10 p-md-20">
                                    <h1 class="font-weight-bolder text-dark">
                                        {{trans('s_admin.episode_name')}}/
                                        <a href="javascript:void(0);" style="font-size: 20px;" class="text-primary">
                                            @if(app()->getLocale() == 'ar')
                                                {{$data->name_ar}}
                                            @else
                                                {{$data->name_en}}
                                            @endif
                                        </a>
                                    </h1>
                                    <!--begin::Form-->
                                    <div class="d-flex flex-center py-2 px-6 bg-white rounded">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Thumbtack.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
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
                                        <input type="hidden" id="txt_section_id"
                                               value="{{$section_data->id}}">
                                        <input type="text" id="txt_epo_link" name="epo_link" style="display: none;"
                                               @if($section_data != null)
                                               {{--                                               @if($student_epo->order_num == $section_data->order_num || $section_data->link_all == 1)--}}
                                               value="{{$section_data->epo_link}}"
                                               {{--                                               @endif--}}
                                               @endif
                                               class="form-control border-0 font-weight-bold pl-2"
                                               placeholder="{{trans('s_admin.episode_link')}}">
                                    </div>
                                    <!--end::Form-->

                                    <h1 class="font-weight-bolder text-dark"> &nbsp;</h1>
                                    <!--begin::Form-->
                                    <form class="d-flex flex-center rounded">
                                    </form>
                                    <!--end::Form-->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <br>
            {{--            @if($section_data != null)--}}
            {{--                @if($student_epo->order_num == $section_data->order_num || $section_data->link_all == 1)--}}
            <br>
            <div class="card card-custom p-12" id="zoom_id" style="display: none;">
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
            {{--                @endif--}}
            {{--            @endif--}}
            <br>
            <div class="row">
                <div class="col-md-4 col-lg-12 col-xxl-4">
                    <!--begin::Stats Widget 33-->
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Wrapper-->
                            <div class="d-flex justify-content-between flex-column pt-4 h-100">
                                <!--begin::Container-->
                                <div class="pb-5">
                                    <!--begin::Header-->
                                    <div class="d-flex flex-column flex-center">
                                        <!--begin::Symbol-->
                                        <div class="symbol symbol-120 symbol-circle symbol-xl-90">
                                            @if($data->Teacher->image == null)
                                                <div class="symbol-label"
                                                     style="background-image:url('/uploads/teachers/default_avatar.jpg')"></div>
                                            @else
                                                <div class="symbol-label"
                                                     style="background-image:url('/uploads/teachers/{{$data->Teacher->image}}')"></div>
                                            @endif
                                            <i class="symbol-badge symbol-badge-bottom bg-success"></i>
                                        </div>
                                        <!--end::Symbol-->
                                        <!--begin::Username-->
                                        <a href="javascript:void(0);"
                                           class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">
                                            @if(app()->getLocale() == 'ar')
                                                {{$data->Teacher->first_name_ar}} {{$data->Teacher->mid_name_ar}}
                                            @else
                                                {{$data->Teacher->first_name_en}} {{$data->Teacher->mid_name_en}}
                                            @endif
                                        </a>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="pt-1">
                                        <!--begin::Text-->
                                        <p class="text-dark-75 font-weight-nirmal font-size-lg m-0 pb-7">
                                            @if(app()->getLocale() == 'ar')
                                                {{ str_limit($data->Teacher->bio_ar, $limit = 100) }}
                                            @else
                                                {{ str_limit($data->Teacher->bio_en, $limit = 100) }}
                                            @endif
                                        </p>
                                        <!--end::Text-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center pb-9">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-45 symbol-light mr-4">
                                                <span class="symbol-label">
                                                    <span class="svg-icon svg-icon-2x svg-icon-success">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                             height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24" height="24"></rect>
                                                                <rect fill="#000000" opacity="0.3" x="13" y="4"
                                                                      width="3" height="16" rx="1.5"></rect>
                                                                <rect fill="#000000" x="8" y="9" width="3" height="11"
                                                                      rx="1.5"></rect>
                                                                <rect fill="#000000" x="18" y="11" width="3" height="9"
                                                                      rx="1.5"></rect>
                                                                <rect fill="#000000" x="3" y="13" width="3" height="7"
                                                                      rx="1.5"></rect>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                            </div>
                                            <!--end::Symbol-->
                                            <!--begin::Text-->
                                            <div class="d-flex flex-column flex-grow-1">
                                                <a href="javascript:void(0);"
                                                   class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">
                                                    @if($data->Teacher->gender == 'male')
                                                        {{trans('s_admin.his_episodes_number')}}
                                                    @else
                                                        {{trans('s_admin.her_episodes_number')}}
                                                    @endif
                                                </a>
                                                <span class="text-muted font-weight-bold"></span>
                                            </div>
                                            <!--end::Text-->
                                            <!--begin::label-->
                                            <span
                                                class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px">{{count($data->Teacher->Episodes)}}</span>
                                            <!--end::label-->
                                        </div>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <div class="d-flex align-items-center pb-9">
                                            <!--begin::Symbol-->
                                            <div class="symbol symbol-45 symbol-light mr-4">
                                                <span class="symbol-label">
                                                    <span
                                                        class="svg-icon svg-icon-2x svg-icon-warning">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                                        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Star.svg--><svg
                                                                xmlns="http://www.w3.org/2000/svg"
                                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                   fill-rule="evenodd">
                                                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                                                    <path
                                                                        d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z"
                                                                        fill="#000000"/>
                                                                </g>
                                                            </svg><!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                </span>
                                            </div>
                                            <div class="d-flex flex-column flex-grow-1">
                                                <a href="javascript:void(0);"
                                                   class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">{{trans('s_admin.rating')}}</a>

                                            </div>
                                            <span
                                                class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px">{{$data->Teacher->rate}}</span>
                                        </div>
                                        {{---------------------------------------------------make validation----------------------------------------------------}}
                                        {{--                                        @php $exists_rate = \App\Models\Teacher_rate::where('student_id',auth()->guard('student')->user()->id)->where( 'teacher_id' , $data->teacher_id )->first(); @endphp--}}
                                        {{--                                        <form action="{{route('student.make_rate')}}" method="post">--}}
                                        {{--                                            @csrf--}}
                                        {{--                                            <input type="hidden" name="teacher_id" value="{{$data->teacher_id}}">--}}
                                        {{--                                            <div class="d-flex justify-content-between flex-column pt-4 h-100">--}}
                                        {{--                                                <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_1"--}}
                                        {{--                                                     data-toggle="tooltip" title="" data-placement="right">--}}
                                        {{--                                                    <link href='https://fonts.googleapis.com/css?family=Lato:300,400,700,900' rel='stylesheet' type='text/css'>--}}
                                        {{--                                                    <div class="product-review-stars">--}}
                                        {{--                                                        <input @if($exists_rate != null) @if($exists_rate->rate == 5 ) checked @endif @endif type="radio" id="star5" name="rating" value="5" class="visuallyhidden" /><label for="star5" title="5">★</label>--}}
                                        {{--                                                        <input @if($exists_rate != null) @if($exists_rate->rate == 4 ) checked @endif @endif type="radio" id="star4" name="rating" value="4" class="visuallyhidden" /><label for="star4" title="4">★</label>--}}
                                        {{--                                                        <input @if($exists_rate != null) @if($exists_rate->rate == 3 ) checked @endif @endif type="radio" id="star3" name="rating" value="3" class="visuallyhidden" /><label for="star3" title="3">★</label>--}}
                                        {{--                                                        <input @if($exists_rate != null) @if($exists_rate->rate == 2 ) checked @endif @endif type="radio" id="star2" name="rating" value="2" class="visuallyhidden" /><label for="star2" title="2">★</label>--}}
                                        {{--                                                        <input @if($exists_rate != null) @if($exists_rate->rate == 1 ) checked @endif @endif type="radio" id="star1" name="rating" value="1" class="visuallyhidden" /><label for="star1" title="1">★</label>--}}
                                        {{--                                                        @if($exists_rate == null)--}}
                                        {{--                                                            <button type="submit" class="btn btn-warning font-weight-bolder font-size-sm py-3 px-14">{{trans('s_admin.rate_it')}}</button>--}}
                                        {{--                                                        @endif--}}
                                        {{--                                                    </div>--}}
                                        {{--                                                </div>--}}
                                        {{--                                            </div>--}}
                                        {{--                                        </form>--}}
                                    </div>
                                </div>
                                <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_1"
                                     data-toggle="tooltip" title="" data-placement="right" data-original-title="">
                                </div>
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>
                    <!--end::Card-->
                    <!--end::Stats Widget 33-->
                </div>
                <div class="col-md-8 col-lg-12 col-xxl-8">
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
                                <div class="tab-pane fade" id="kt_tab_pane_9_1" role="tabpanel"
                                     aria-labelledby="kt_tab_pane_9_1">
                                    <!--begin::Table-->
                                    <div class="">
                                        <table class="table table-borderless table-vertical-center">
                                            <!--begin::Thead-->
                                            <thead>
                                            <tr>
                                                <th class="p-0 w-50px"></th>
                                                <th class="p-0 min-w-130px min-w-lg-100px w-100"></th>
                                                <th class="p-0 min-w-105px"></th>
                                                <th class="p-0 min-w-50px"></th>
                                            </tr>
                                            </thead>
                                            <!--end::Thead-->
                                            <!--begin::Tbody-->
                                            <tbody>
                                            <tr>
                                                <td class="pl-0 py-5">
                                                    <div class="symbol symbol-45 symbol-light mr-2">
                                                    <span class="symbol-label">
                                                        <span class="svg-icon svg-icon-2x">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                                 height="24px" viewBox="0 0 24 24" version="1.1">
                                                                <g stroke="none" stroke-width="1" fill="none"
                                                                   fill-rule="evenodd">
                                                                    <rect x="0" y="0" width="24" height="24"></rect>
                                                                    <path
                                                                        d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z"
                                                                        fill="#000000" fill-rule="nonzero"></path>
                                                                    <circle fill="#000000" opacity="0.3" cx="12" cy="10"
                                                                            r="6"></circle>
                                                                </g>
                                                            </svg>
                                                            <!--end::Svg Icon-->
                                                        </span>
                                                    </span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Geography</a>
                                                    <span
                                                        class="text-muted font-weight-bold d-block">By Zoey Dylan</span>
                                                </td>
                                                <td class="text-left">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">10:20 - 12:00</span>
                                                    <span
                                                        class="text-muted font-weight-bold d-block font-size-sm">Time</span>
                                                </td>
                                                <td class="text-right pr-0">
                                                    <a href="javascript:void(0);" class="btn btn-icon btn-light btn-sm">
																						<span
                                                                                            class="svg-icon svg-icon-md svg-icon-success">
																							<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
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
																									<polygon
                                                                                                        points="0 0 24 0 24 24 0 24"></polygon>
																									<rect fill="#000000"
                                                                                                          opacity="0.3"
                                                                                                          transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                                                                          x="11" y="5"
                                                                                                          width="2"
                                                                                                          height="14"
                                                                                                          rx="1"></rect>
																									<path
                                                                                                        d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                                                                        fill="#000000"
                                                                                                        fill-rule="nonzero"
                                                                                                        transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
																								</g>
																							</svg>
                                                                                            <!--end::Svg Icon-->
																						</span>
                                                    </a>
                                                </td>
                                            </tr>
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
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">History</a>
                                                    <span
                                                        class="text-muted font-weight-bold d-block">By Luke Owen</span>
                                                </td>
                                                <td class="text-left">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">13:20 - 14:00</span>
                                                    <span
                                                        class="text-muted font-weight-bold d-block font-size-sm">Time</span>
                                                </td>
                                                <td class="text-right pr-0">
                                                    <a href="javascript:void(0);" class="btn btn-icon btn-light btn-sm">
																						<span
                                                                                            class="svg-icon svg-icon-md svg-icon-success">
																							<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
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
																									<polygon
                                                                                                        points="0 0 24 0 24 24 0 24"></polygon>
																									<rect fill="#000000"
                                                                                                          opacity="0.3"
                                                                                                          transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                                                                          x="11" y="5"
                                                                                                          width="2"
                                                                                                          height="14"
                                                                                                          rx="1"></rect>
																									<path
                                                                                                        d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                                                                        fill="#000000"
                                                                                                        fill-rule="nonzero"
                                                                                                        transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
																								</g>
																							</svg>
                                                                                            <!--end::Svg Icon-->
																						</span>
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
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">Drawing</a>
                                                    <span
                                                        class="text-muted font-weight-bold d-block">By Ellie Cole</span>
                                                </td>
                                                <td class="text-left">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">14:20 - 15:00</span>
                                                    <span
                                                        class="text-muted font-weight-bold d-block font-size-sm">Time</span>
                                                </td>
                                                <td class="text-right pr-0">
                                                    <a href="javascript:void(0);" class="btn btn-icon btn-light btn-sm">
																						<span
                                                                                            class="svg-icon svg-icon-md svg-icon-success">
																							<!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
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
																									<polygon
                                                                                                        points="0 0 24 0 24 24 0 24"></polygon>
																									<rect fill="#000000"
                                                                                                          opacity="0.3"
                                                                                                          transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                                                                          x="11" y="5"
                                                                                                          width="2"
                                                                                                          height="14"
                                                                                                          rx="1"></rect>
																									<path
                                                                                                        d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                                                                        fill="#000000"
                                                                                                        fill-rule="nonzero"
                                                                                                        transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
																								</g>
																							</svg>
                                                                                            <!--end::Svg Icon-->
																						</span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0 pt-0 py-5">
                                                    <div class="symbol symbol-45 symbol-light-primary mr-2">
																						<span class="symbol-label">
																							<span
                                                                                                class="svg-icon svg-icon-2x svg-icon-primary">
																								<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Playlist1.svg-->
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
                                                                                                            d="M8.97852058,18.8007059 C8.80029331,20.0396328 7.53473012,21 6,21 C4.34314575,21 3,19.8807119 3,18.5 C3,17.1192881 4.34314575,16 6,16 C6.35063542,16 6.68722107,16.0501285 7,16.1422548 L7,5.93171093 C7,5.41893942 7.31978104,4.96566617 7.78944063,4.81271925 L13.5394406,3.05418311 C14.2638626,2.81827161 15,3.38225531 15,4.1731748 C15,4.95474642 15,5.54092513 15,5.93171093 C15,6.51788965 14.4511634,6.89225606 14,7 C13.3508668,7.15502181 11.6842001,7.48835515 9,8 L9,18.5512168 C9,18.6409956 8.9927193,18.7241187 8.97852058,18.8007059 Z"
                                                                                                            fill="#000000"
                                                                                                            fill-rule="nonzero"></path>
																										<path
                                                                                                            d="M16,9 L20,9 C20.5522847,9 21,9.44771525 21,10 C21,10.5522847 20.5522847,11 20,11 L16,11 C15.4477153,11 15,10.5522847 15,10 C15,9.44771525 15.4477153,9 16,9 Z M14,13 L20,13 C20.5522847,13 21,13.4477153 21,14 C21,14.5522847 20.5522847,15 20,15 L14,15 C13.4477153,15 13,14.5522847 13,14 C13,13.4477153 13.4477153,13 14,13 Z M14,17 L20,17 C20.5522847,17 21,17.4477153 21,18 C21,18.5522847 20.5522847,19 20,19 L14,19 C13.4477153,19 13,18.5522847 13,18 C13,17.4477153 13.4477153,17 14,17 Z"
                                                                                                            fill="#000000"
                                                                                                            opacity="0.3"></path>
																									</g>
																								</svg>
                                                                                                <!--end::Svg Icon-->
																							</span>
																						</span>
                                                    </div>
                                                </td>
                                                <td class="pl-0"><span
                                                        class="text-dark-25 font-weight-bold d-block">{{trans('s_admin.episode_name')}}</span>
                                                    <a href="javascript:void(0);"
                                                       class="text-muted font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                        @if(app()->getLocale() == 'ar')
                                                            {{$data->name_ar}}
                                                        @else
                                                            {{$data->name_en}}
                                                        @endif
                                                    </a>
                                                </td>
                                                <td class="text-left">

                                                </td>
                                                <td class="text-right pr-0">
                                                    <a href="javascript:void(0);" class="btn btn-icon btn-light btn-sm">
                                                    <span class="svg-icon svg-icon-md svg-icon-success">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                             height="24px" viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1" fill="none"
                                                               fill-rule="evenodd">
                                                                <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                                                <rect fill="#000000" opacity="0.3"
                                                                      transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                                      x="11" y="5" width="2" height="14" rx="1"></rect>
                                                                <path
                                                                    d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                                    fill="#000000" fill-rule="nonzero"
                                                                    transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                    </a>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td class="pl-0 py-5">
                                                    <div class="symbol symbol-45 symbol-light-danger mr-2">
																						<span class="symbol-label">
																							<span
                                                                                                class="svg-icon svg-icon-2x svg-icon-danger">
																								<!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
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
																										<rect
                                                                                                            fill="#000000"
                                                                                                            x="4" y="4"
                                                                                                            width="7"
                                                                                                            height="7"
                                                                                                            rx="1.5"></rect>
																										<path
                                                                                                            d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                                                                            fill="#000000"
                                                                                                            opacity="0.3"></path>
																									</g>
																								</svg>
                                                                                                <!--end::Svg Icon-->
																							</span>
																						</span>
                                                    </div>
                                                </td>
                                                <td class="pl-0">
                                                    <span class="text-muted font-weight-bold d-block"></span>
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">

                                                    </a>
                                                </td>
                                                <td class="text-left">

                                                </td>
                                                <td class="text-right pr-0">
                                                    <a href="javascript:void(0);" class="btn btn-icon btn-light btn-sm">
                                                                <span class="svg-icon svg-icon-md svg-icon-success">
                                                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Arrow-right.svg-->
                                                                    <svg xmlns="http://www.w3.org/2000/svg"
                                                                         xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                         width="24px" height="24px" viewBox="0 0 24 24"
                                                                         version="1.1">
                                                                        <g stroke="none" stroke-width="1" fill="none"
                                                                           fill-rule="evenodd">
                                                                            <polygon
                                                                                points="0 0 24 0 24 24 0 24"></polygon>
                                                                            <rect fill="#000000" opacity="0.3"
                                                                                  transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000)"
                                                                                  x="11" y="5" width="2" height="14"
                                                                                  rx="1"></rect>
                                                                            <path
                                                                                d="M9.70710318,15.7071045 C9.31657888,16.0976288 8.68341391,16.0976288 8.29288961,15.7071045 C7.90236532,15.3165802 7.90236532,14.6834152 8.29288961,14.2928909 L14.2928896,8.29289093 C14.6714686,7.914312 15.281055,7.90106637 15.675721,8.26284357 L21.675721,13.7628436 C22.08284,14.136036 22.1103429,14.7686034 21.7371505,15.1757223 C21.3639581,15.5828413 20.7313908,15.6103443 20.3242718,15.2371519 L15.0300721,10.3841355 L9.70710318,15.7071045 Z"
                                                                                fill="#000000" fill-rule="nonzero"
                                                                                transform="translate(14.999999, 11.999997) scale(1, -1) rotate(90.000000) translate(-14.999999, -11.999997)"></path>
                                                                        </g>
                                                                    </svg>
                                                                    <!--end::Svg Icon-->
                                                                </span>
                                                    </a>
                                                </td>
                                            </tr>
                                            </tbody>
                                            <!--end::Tbody-->
                                        </table>
                                    </div>
                                    {{$data->Teacher->first_ar}} {{$data->Teacher->mid_ar}}
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade show active" id="kt_tab_pane_9_2" role="tabpanel"
                                     aria-labelledby="kt_tab_pane_9_2">
                                    <!--begin::Table-->
                                    <div class="">
                                        <table class="table table-borderless table-vertical-center">
                                            <!--begin::Tbody-->
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
                                                <td class="text-left">
                                                </td>
                                                <td class="text-right pr-0">
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
                                                <td class="text-left">
                                                </td>
                                                <td class="text-right pr-0">
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
                                                <td class="text-left">
                                                </td>
                                                <td class="text-right pr-0">
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
                                                <td class="text-left">
                                                </td>
                                                <td class="text-right pr-0">
                                                </td>
                                            </tr>
                                            <tr>
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
                                                <td class="pl-0">

                                                </td>
                                                <td class="pl-0">

                                                </td>
                                            </tr>



                                            @if($Student_Questions_episode != null)
                                                <tr>
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
                                                        <a href="javascript:void(0);"
                                                           class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                            @if(app()->getLocale() == 'ar')
                                                                ماذا اخترت ان تفعل اليوم
                                                            @else
                                                                what you choose to do
                                                            @endif
                                                        </a>
                                                    </td>
                                                    @inject('surah','App\Models\Plan\Plan_surah')

                                                    <td class="pl-0">
                                                        @if(app()->getLocale() == 'ar')
                                                            {{$surah->find($Student_Questions_episode->from_surah_id)->name_ar}}
                                                        @else
                                                            {{$surah->find($Student_Questions_episode->from_surah_id)->name_en}}
                                                        @endif
                                                    </td>
                                                    <td class="pl-0"> {{$Student_Questions_episode->from_num}}
                                                    </td>
                                                    <td class="pl-0">
                                                        @if(app()->getLocale() == 'ar')
                                                            {{$surah->find($Student_Questions_episode->to_surah_id)->name_ar}}
                                                        @else
                                                            {{$surah->find($Student_Questions_episode->to_surah_id)->name_en}}
                                                        @endif
                                                    </td>
                                                    <td class="pl-0">{{$Student_Questions_episode->to_num}}</td>
                                                </tr>
                                            @endif
                                            @if($data->type != 'mqraa')
                                                @if($plan_new != null)
                                                    <tr>
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
                                                            <a href="javascript:void(0);"
                                                               class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{trans('s_admin.the_new')}}</a>
                                                        </td>
                                                        <td class="pl-0">
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$plan_new->From_Surah->name_ar}}
                                                            @else
                                                                {{$plan_new->From_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td class="pl-0">{{$plan_new->from_num}}</td>
                                                        <td class="pl-0">
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$plan_new->To_Surah->name_ar}}
                                                            @else
                                                                {{$plan_new->To_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td class="pl-0">{{$plan_new->to_num}}</td>
                                                    </tr>
                                                @endif
                                                @if($plan_tracomy != null)
                                                    <tr>
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
                                                            <a href="javascript:void(0);"
                                                               class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{trans('s_admin.the_tracomy')}}</a>
                                                        </td>
                                                        <td class="pl-0">
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$plan_tracomy->From_Surah->name_ar}}
                                                            @else
                                                                {{$plan_tracomy->From_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td class="pl-0">{{$plan_tracomy->from_num}}</td>
                                                        <td class="pl-0">
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$plan_tracomy->To_Surah->name_ar}}
                                                            @else
                                                                {{$plan_tracomy->To_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td class="pl-0">{{$plan_tracomy->to_num}}</td>
                                                    </tr>
                                                @endif
                                                @if($plan_revision != null)
                                                    <tr>
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
                                                            <a href="javascript:void(0);"
                                                               class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{trans('s_admin.revision')}}</a>
                                                        </td>
                                                        <td class="pl-0">
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$plan_revision->From_Surah->name_ar}}
                                                            @else
                                                                {{$plan_revision->From_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td class="pl-0">{{$plan_revision->from_num}}</td>
                                                        <td class="pl-0">
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$plan_revision->To_Surah->name_ar}}
                                                            @else
                                                                {{$plan_revision->To_Surah->name_en}}
                                                            @endif
                                                        </td>
                                                        <td class="pl-0">{{$plan_revision->to_num}}</td>
                                                    </tr>
                                                @endif
                                            @endif
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
    {{--    teacher rating modal--}}
    <div class="modal fade" id="teacher_rating_modal" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.nav_episode_rate')}}</h5>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'student.make_teacher_rate','method'=>'post','id'=>'form_ratings'] ) }}
                    <input type="hidden" name="teacher_id" id="txt_rate_teacher_id">
                    <input type="hidden" name="episode_id" id="txt_rate_episode_id">
                    <input type="hidden" name="section_id" id="txt_rate_section_id">
                    <div class="card-body">
                        <div class="form-group row">
                            <label
                                class="col-lg-4 col-form-label text-lg-right">{{trans('s_admin.your_degree')}}</label>
                            <div class="col-lg-8">
                                <input type="text" readonly class="form-control form-control-lg" name="degree"
                                       id="txt_rate_degree">
                            </div>
                        </div>
                        @php $far_degees = \App\Models\Far_learn_degree::where('deleted','0')->orderBy('id','desc')->get(); @endphp
                        @foreach($rated_questions as $key => $row)
                            <div class="form-group row">
                                <input type="hidden" class="form-control form-control-lg" name="question_id[]"
                                       value="{{$row->id}}">
                                <label style="font-weight: bolder;"
                                       class="col-lg-4 col-form-label text-lg-right">
                                    @if(app()->getLocale() =='ar')
                                        {{$row->name_ar}}
                                    @else
                                        {{$row->name_en}}
                                    @endif
                                </label>
                                <div class="col-md-8 text-md-center">
                                    <label class="rating-label" dir="rtl">
                                        <input
                                            class="rating"
                                            max="5"
                                            oninput="this.style.setProperty('--value', `${this.valueAsNumber}`)"
                                            step="1"
                                            style="--stars:5;--value:0"
                                            type="range"
                                            value="0"
                                            name="rates[]">

                                    </label>
                                </div>

                                {{--                                <div class="col-lg-8">--}}
                                {{--                                    <div class="radio-list">--}}
                                {{--                                        <div class="product-review-stars" @if(app()->getLocale() == 'ar') style="direction: initial;" @endif>--}}
                                {{--                                            @foreach($far_degees as $value)--}}
                                {{--                                                <input type="radio" required id="star_{{$key}}_{{$value->id}}" name="rates[]"--}}
                                {{--                                                       value="{{$value->id}}" class="visuallyhidden"/>--}}
                                {{--                                                <label for="star_{{$key}}_{{$value->id}}"--}}
                                {{--                                                       @if(app()->getLocale() == 'ar')--}}
                                {{--                                                       title="{{$value->name_ar}}"--}}
                                {{--                                                       @else--}}
                                {{--                                                       title="{{$value->name_en}}"--}}
                                {{--                                                    @endif--}}
                                {{--                                                >★</label>--}}
                                {{--                                            @endforeach--}}
                                {{--                                        </div>--}}
                                {{--                                    </div>--}}
                                {{--                                </div>--}}
                            </div>
                        @endforeach
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.save')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')

    <script>
        jQuery(document).ready(function () {
            var storeTimeInterval = setInterval(function () {
                $.ajax({
                    type: "get",
                    url: "{{route('student.check.order_num',$section_data->id)}}",
                    datatype: "json",
                    success: function (data) {
                        if (data.status == true) {
                            // clearInterval(storeTimeInterval);
                            // location.reload();
                            document.getElementById('txt_epo_link').style.display = 'block';
                            document.getElementById('zoom_id').style.display = 'block';
                        } else {
                            //append
                            @if($section_data != null)
                                @if( $section_data->link_all == 1)
                                    document.getElementById('txt_epo_link').style.display = 'block';
                                    document.getElementById('zoom_id').style.display = 'block';
                                @else
                                    document.getElementById('txt_epo_link').style.display = 'none';
                                    document.getElementById('zoom_id').style.display = 'none';
                                @endif
                            @endif
                            document.getElementById("current_order_num").innerHTML = data.row;
                        }
                    }
                });
            }, 3000);//time in milliseconds


        });
    </script>
    <script src="https://kit.fontawesome.com/5ea815c1d0.js"></script>
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
        @if(settings()->rating == '1')
        @if($exist_degree == null)
        setInterval(function () {
            var txt_section_id = $('#txt_section_id').val();
            $.ajax({
                type: "post",
                url: "/student/fetch_data_to_rate/page/rate",
                data: {
                    _token: $("#csrf").val(),
                    section_id: txt_section_id
                },
                datatype: "json",
                success: function (data) {
                    if (data.status == true) {
                        $('#txt_rate_teacher_id').val(data.row.teacher_id);
                        $('#txt_rate_episode_id').val(data.row.episode_id);
                        $('#txt_rate_section_id').val(data.row.section_id);
                        if (data.row.degree == 1) {
                            $('#txt_rate_degree').val('مقبول');
                        } else if (data.row.degree == 2) {
                            $('#txt_rate_degree').val('ضعيف');
                        } else if (data.row.degree == 3) {
                            $('#txt_rate_degree').val('جيد');
                        } else if (data.row.degree == 4) {
                            $('#txt_rate_degree').val('جيد جدا');
                        } else if (data.row.degree == 5) {
                            $('#txt_rate_degree').val('ممتاز');
                        } else {
                            $('#txt_rate_degree').val(data.row.degree);
                        }
                        $('#teacher_rating_modal').modal('toggle');
                    }
                }
            });
        }, 1000);
        @endif
        @endif
    </script>
@endsection
