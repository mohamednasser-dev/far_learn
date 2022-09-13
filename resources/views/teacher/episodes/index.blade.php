@extends('teacher.teacher_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_table_hlka')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-body">
            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable1">
                    <thead>
                    <tr>
                        <th title="Field #1">{{trans('s_admin.episode_name')}}</th>
                        <th title="Field #2">{{trans('s_admin.type')}}</th>
                        <th title="Field #5">{{trans('s_admin.want_num')}}</th>
                        <th title="Field #6">{{trans('s_admin.student_number')}}</th>
                        <th title="Field #7">{{trans('s_admin.from')}}</th>
                        <th title="Field #7">{{trans('s_admin.to')}}</th>
                        <th title="Field #9" style="text-align: center">{{trans('s_admin.epo_view')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @php $time_now =  \Carbon\Carbon::now()->format('H:i') @endphp
                    @foreach($data as $key => $row)
                        <tr>
                            <td>{{$row->name}}</td>
                            <td>
                                @if($row->type == 'mqraa')
                                    {{trans('s_admin.mqraa')}}
                                @elseif($row->type == 'mogmaa')
                                    {{trans('s_admin.mogmaa')}}
                                @elseif($row->type == 'dorr')
                                    {{trans('s_admin.dorr')}}
                                @endif
                            </td>
                            <td style="text-align: center;">{{$row->student_number}}</td>
                            <td style="text-align: center;">
                                <a href="{{route('teacher.epo.students',$row->id)}}">
                                    <code style="font-size: larger;">{{count($row->Students)}}</code>
                                </a>
                            </td>
                            <td> {{date('g:i a', strtotime($row->time_from))}} {{trans('s_admin.ksa')}}</td>
                            <td> {{date('g:i a', strtotime($row->time_to))}} {{trans('s_admin.ksa')}}</td>
                            <td style="text-align: center">
                                @php
                                    $mytime = \Carbon\Carbon::now();
                                    $today = \Carbon\Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
                                    $exist_epo = \App\Models\Episode::where('id',$row->id)->where('start_date','<',$today)->first();
                                    $course_data = \App\Models\Episode_course_days::where('episode_id', $row->id)->where('date', $today)->first();
                                @endphp
                                @if($course_data != null)
                                    @php  $section_today = \App\Models\Episode_section::where('episode_id',$row->id)->where('epo_date',$today)->first();@endphp
                                    @if($section_today != null)
                                        @if($section_today->status == 'started')
                                            @if( \Carbon\Carbon::parse($row->time_from)->format('H:i') < $time_now && \Carbon\Carbon::parse($row->time_to)->format('H:i')  > $time_now)
                                                <a href="{{route('t_episodes.show',$row->id)}}"
                                                   class="btn btn-success btn-circle">
                                                    {{trans('s_admin.started')}}
                                                </a>
                                            @else
                                                @php $exists_request = \App\Models\Episode_restart_request::where('teacher_id',auth('teacher')->user()->id)->where('section_id',$section_today->id)->where('status','accepted')->first(); @endphp
                                                @if($exists_request)
                                                    <a id="enter_class_btn" data-section="{{$section_today->id}}" data-toggle="modal"
                                                       data-target="#enter_episode_modal"
                                                       class="btn btn-info btn-circle">{{trans('s_admin.enter_episode')}} </a>
                                                @else
                                                    {{trans('s_admin.today_but_not_now')}}
                                                @endif
                                            @endif
                                        @elseif($section_today->status == 'ended')
                                            @if( \Carbon\Carbon::parse($row->time_from)->format('H:i') < $time_now && \Carbon\Carbon::parse($row->time_to)->format('H:i')  > $time_now)
                                                <a id="end_again_btn" data-section="{{$section_today->id}}" data-toggle="modal"
                                                   data-target="#restart_again_modal"
                                                   class="btn btn-danger btn-circle">{{trans('s_admin.restart_epo')}}</a>
                                            @else
                                                <a id="end_btn" data-section="{{$section_today->id}}" data-toggle="modal"
                                                   data-target="#restart_modal"
                                                   class="btn btn-danger btn-circle">{{trans('s_admin.restart_epo')}}</a>
                                            @endif
                                        @endif
                                    @else
                                        @if( \Carbon\Carbon::parse($row->time_from)->format('H:i') < $time_now && \Carbon\Carbon::parse($row->time_to)->format('H:i')  > $time_now)
                                            <a href="{{route('t_episodes.show',$row->id)}}" class="btn btn-primary btn-circle">
                                                {{trans('s_admin.show')}}
                                            </a>
                                        @else
                                            {{trans('s_admin.today_but_not_now')}}
                                        @endif
                                    @endif
                                @else
                                    {{trans('s_admin.not_section_today')}}
                                @endif
                            </td>
                        </tr>
                        @php $key += 1 ; @endphp
                    @endforeach
                    @if($additional_episodes != null)
                        @foreach($additional_episodes as $key => $row)
                            <tr>
                                <td>{{$row->Episode->name}}</td>
                                <td>
                                    @if($row->Episode->type == 'mqraa')
                                        {{trans('s_admin.mqraa')}}
                                    @elseif($row->Episode->type == 'mogmaa')
                                        {{trans('s_admin.mogmaa')}}
                                    @elseif($row->Episode->type == 'dorr')
                                        {{trans('s_admin.dorr')}}
                                    @endif
                                </td>
                                <td style="text-align: center;">{{$row->Episode->student_number}}</td>
                                <td style="text-align: center;">
                                    <a href="{{route('teacher.epo.students',$row->Episode->id)}}">
                                        <code style="font-size: larger;">{{count($row->Episode->Students)}}</code>
                                    </a>
                                </td>
                                <td> {{date('g:i a', strtotime($row->Episode->time_from))}} {{trans('s_admin.ksa')}}</td>
                                <td> {{date('g:i a', strtotime($row->Episode->time_to))}} {{trans('s_admin.ksa')}}</td>
                                {{--                                                    @if($row->episode_id == 33)--}}
                                {{--                                                    @dd( \Carbon\Carbon::parse($row->Episode->time_from)->format('H:i'), \Carbon\Carbon::parse($row->Episode->time_to)->format('H:i') ,$time_now )--}}
                                {{--                                                    @endif--}}
                                <td style="text-align: center">
                                    @php
                                        $mytime = \Carbon\Carbon::now();
                                        $today = \Carbon\Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
                                        $exist_epo = \App\Models\Episode::where('id', $row->Episode->id )->where('start_date','<',$today)->first();
                                        $course_data = \App\Models\Episode_course_days::where('episode_id', $row->Episode->id)->where('date', $today)->first();
                                    @endphp
                                    @if($course_data != null)
                                        @php  $section_today = \App\Models\Episode_section::where('episode_id',$row->Episode->id)->where('epo_date',$today)->first();@endphp
                                        @if($section_today != null)
                                            @if($section_today->status == 'started')
                                                <a href="{{route('t_episodes.show',$row->Episode->id)}}"
                                                   class="btn btn-success btn-circle">
                                                    {{trans('s_admin.started')}}
                                                </a>
                                            @elseif($section_today->status == 'ended')
                                                @if( \Carbon\Carbon::parse($row->Episode->time_from)->format('H:i') < $time_now && \Carbon\Carbon::parse($row->Episode->time_to)->format('H:i')  > $time_now)
                                                    <a id="end_again_btn" data-section="{{$section_today->id}}" data-toggle="modal"
                                                       data-target="#restart_again_modal"
                                                       class="btn btn-danger btn-circle">{{trans('s_admin.restart_epo')}}</a>
                                                @else
                                                    <a id="end_btn" data-section="{{$section_today->id}}" data-toggle="modal"
                                                       data-target="#restart_modal"
                                                       class="btn btn-danger btn-circle">{{trans('s_admin.restart_epo')}}</a>
                                                @endif
                                            @endif
                                        @else
                                            @if( \Carbon\Carbon::parse($row->Episode->time_from)->format('H:i') < $time_now && \Carbon\Carbon::parse($row->Episode->time_to)->format('H:i')  > $time_now)
                                                <a href="{{route('t_episodes.show',$row->Episode->id)}}" class="btn btn-primary btn-circle">
                                                    {{trans('s_admin.show')}}
                                                </a>
                                            @else
                                                {{trans('s_admin.today_but_not_now')}}
                                            @endif
                                        @endif
                                    @else
                                        {{trans('s_admin.not_section_today')}}
                                    @endif
                                </td>
                            </tr>
                            @php $key += 1 ; @endphp
                        @endforeach
                    @endif

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{--    restart epo model--}}
    <div class="modal fade" id="restart_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.restart_epo')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">{{trans('s_admin.restart_epo_ask')}}</div>
                <div class="modal-footer">
                    <form action="{{route('t_episode.epo.restart')}}" method="post">
                        @csrf
                        <input type="hidden" name="section_id" id="txt_section_id">
                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">{{trans('s_admin.cancel')}}</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">{{trans('s_admin.ok')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="restart_again_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.restart_epo')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">{{trans('s_admin.restart_epo_ask_again')}}</div>
                <div class="modal-footer">
                    <form action="{{route('t_episode.epo.restart_again')}}" method="post">
                        @csrf
                        <input type="hidden" name="section_id" id="txt_section_again_id">
                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">{{trans('s_admin.cancel')}}</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">{{trans('s_admin.ok')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="enter_episode_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.enter_episode')}} ?</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-footer">
                    <form action="{{route('t_episode.epo.restart_again')}}" method="post">
                        @csrf
                        <input type="hidden" name="section_id" id="txt_section_enter_again_id">
                        <button type="button" class="btn btn-light-primary font-weight-bold"
                                data-dismiss="modal">{{trans('s_admin.cancel')}}</button>
                        <button type="submit" class="btn btn-primary font-weight-bold">{{trans('s_admin.ok')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('metronic/assets/js/pages/crud/datatables/basic/scrollable.js') }}"></script>
    <script>
        $(document).ready(function () {
            var section;
            $(document).on('click', '#end_btn', function () {
                section = $(this).data('section');
                $("#txt_section_id").val(section);
            });
            $(document).on('click', '#end_again_btn', function () {
                section = $(this).data('section');
                $("#txt_section_again_id").val(section);
            });
            $(document).on('click', '#enter_class_btn', function () {
                section = $(this).data('section');
                $("#txt_section_enter_again_id").val(section);
            });
        });
    </script>
@endsection
