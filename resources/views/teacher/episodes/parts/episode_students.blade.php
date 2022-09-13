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
                   @if($section_data->order_num > 1)
                    <a href="{{route('t_episode.previous_turn',$section_data->id)}}"
                       class="btn btn-icon btn-light-primary btn-circle mr-2" data-toggle="tooltip"
                       data-theme="dark" title="{{trans('s_admin.Previous_turn')}}">
                        <i class="flaticon2-right-arrow"></i>
                    </a>
                    @endif
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
                                            <input type="checkbox" value="{{$row->id}}" class="cmb_student_class"
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
                        <a href="javascript:void(0)" class="btn btn-icon btn-sm btn-light-primary mr-1"
                           data-card-tool="toggle">
                            <i class="ki ki-arrow-down icon-nm"></i>
                        </a>
                    </div>
                    <div class="row">
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
    $(document).ready(function () {
        $('.cmb_student_class').click(function () {
            console.log('here');
            var student_id = $(this).val();
            var section_id = $('#txt_section_id').val();
            console.log(student_id);
            $.ajax({
                url: "/teacher/stud/make_come",
                type: "POST",
                data: {
                    _token: $("#csrf").val(),
                    student_id: student_id,
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
</script>
