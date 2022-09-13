@extends('teacher.teacher_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.reports_today_listen')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-body">
            <form action="{{route('teacher.reports.reciting_today.search')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">{{trans('s_admin.date')}}</label>
                            <div class="col-9">
                                <div class="input-group date">
                                    <input type="date" required name="selected_date"
                                           value="{{$today_date}}" class="form-control"
                                           id="kt_datepicker_3_modal"/>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <button class="btn btn-success">{{trans('s_admin.search')}}</button>
                    </div>
                </div>
            </form>
            <!--begin: Datatable-->
            <div class="table-responsive">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable1">
                    <thead>
                    <tr>
                        <th title="Field #1">{{trans('s_admin.day')}}</th>
                        <th title="Field #1">{{trans('s_admin.degree')}}</th>
                        <th title="Field #1">{{trans('s_admin.lisen_type')}}</th>
                        <th title="Field #1">{{trans('s_admin.surah')}}</th>
                        <th title="Field #1">{{trans('s_admin.from')}}</th>
                        <th title="Field #1">{{trans('s_admin.surah')}}</th>
                        <th title="Field #1">{{trans('s_admin.to')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key => $row)

                        <tr>
                            <td>{{date('Y-m-d', strtotime($row->created_at))}}</td>
                            <td>
                                @if($row->degree == 'absence')
                                    {{trans('s_admin.abs')}}
                                @elseif($row->degree == 'good')
                                    {{trans('s_admin.good')}}
                                @elseif($row->degree == 'very_good')
                                    {{trans('s_admin.very_good')}}
                                @elseif($row->degree == 'excellent')
                                    {{trans('s_admin.excellent')}}
                                @elseif($row->degree == 'not_pathing')
                                    {{trans('s_admin.not_pathing')}}
                                @endif
                                @if($row->type == 'ask')
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Ask_degree->name_ar}}
                                    @else
                                        {{$row->Ask_degree->name_en}}
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($row->type == 'ask')
                                    {{trans('s_admin.ask')}}
                                @else
                                    @if($row->type != 'absence')
                                        @if($row->plan_type == 'new')
                                            {{trans('s_admin.the_new')}}
                                        @elseif($row->plan_type == 'tracomy')
                                            {{trans('s_admin.the_tracomy')}}
                                        @elseif($row->plan_type == 'revision')
                                            {{trans('s_admin.revision')}}
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($row->type == 'ask')
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Ask->From_Surah->name_ar}}
                                    @else
                                        {{$row->Ask->From_Surah->name_en}}
                                    @endif
                                @else
                                    @if($row->plan_type == 'new')
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->Plan_new->From_Surah->name_ar}}
                                        @else
                                            {{$row->Plan_new->From_Surah->name_en}}
                                        @endif
                                    @elseif($row->plan_type == 'tracomy')
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->Plan_tracomy->From_Surah->name_ar}}
                                        @else
                                            {{$row->Plan_tracomy->From_Surah->name_en}}
                                        @endif
                                    @elseif($row->plan_type == 'revision')
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->Plan_revision->From_Surah->name_ar}}
                                        @else
                                            {{$row->Plan_revision->From_Surah->name_en}}
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($row->type == 'ask')
                                    {{$row->Ask->from_num}}
                                @else
                                    @if($row->plan_type == 'new')
                                        {{$row->Plan_new->from_num}}
                                    @elseif($row->plan_type == 'tracomy')
                                        {{$row->Plan_tracomy->from_num}}
                                    @elseif($row->plan_type == 'revision')
                                        {{$row->Plan_revision->from_num}}
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($row->type == 'ask')
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Ask->To_Surah->name_ar}}
                                    @else
                                        {{$row->Ask->To_Surah->name_en}}
                                    @endif
                                @else
                                    @if($row->plan_type == 'new')
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->Plan_new->To_Surah->name_ar}}
                                        @else
                                            {{$row->Plan_new->To_Surah->name_en}}
                                        @endif
                                    @elseif($row->plan_type == 'tracomy')
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->Plan_tracomy->To_Surah->name_ar}}
                                        @else
                                            {{$row->Plan_tracomy->To_Surah->name_en}}
                                        @endif
                                    @elseif($row->plan_type == 'revision')
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->Plan_revision->To_Surah->name_ar}}
                                        @else
                                            {{$row->Plan_revision->To_Surah->name_en}}
                                        @endif
                                    @endif
                                @endif
                            </td>
                            <td>
                                @if($row->type == 'ask')
                                    {{$row->Ask->to_num}}
                                @else
                                    @if($row->plan_type == 'new')
                                        {{$row->Plan_new->to_num}}
                                    @elseif($row->plan_type == 'tracomy')
                                        {{$row->Plan_tracomy->to_num}}
                                    @elseif($row->plan_type == 'revision')
                                        {{$row->Plan_revision->to_num}}
                                    @endif
                                @endif
                            </td>
                        </tr>
                        @php $key += 1 ; @endphp
                    @endforeach
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
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.ok')}}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="restart_again_modal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalSizeSm"
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
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.ok')}}</button>
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
        });
    </script>
@endsection
