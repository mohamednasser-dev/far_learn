@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_save_and_lisen_reports')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_reports_and_stat')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header card-header-tabs-line">
            <ul class="nav nav-dark nav-bold nav-tabs nav-tabs-line" data-remember-tab="tab_id" role="tablist">
                <li class="nav-item @if($type == 'step_one') active @endif">
                    <a class="nav-link @if($type == 'step_one') active @endif " data-toggle="tab"
                       href="#kt_builder_themes">{{trans('s_admin.search_by_stud_with_episode_productivity')}}</a>
                </li>
                <li class="nav-item @if($type == 'step_two') active @endif">
                    <a class="nav-link @if($type == 'step_two') active @endif " data-toggle="tab"
                       href="#panel_step_two">{{trans('s_admin.search_by_stud_productivity')}}</a>
                </li>
                <li class="nav-item @if($type == 'step_three') active @endif ">
                    <a class="nav-link @if($type == 'step_three') active @endif" data-toggle="tab"
                       href="#kt_builder_page3">{{trans('s_admin.search_by_epo_productivity')}}</a>
                </li>
                <li class="nav-item @if($type == 'step_four') active @endif ">
                    <a class="nav-link @if($type == 'step_four') active @endif" data-toggle="tab"
                       href="#kt_builder_page_details">{{trans('s_admin.search_by_epo_productivity_details')}}</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content pt-3">
                <div class="tab-pane @if($type == 'step_one') active @endif " id="kt_builder_themes">
                    <h4>{{trans('s_admin.search_by_stud_with_episode_productivity')}}</h4>
                    <div class="card card-custom example example-compact">
                        <form class="form" method="get"
                              action="{{route('reports.productivity.search_step_one')}}">
                            <input type="hidden" name="type" value="step_one">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{trans('s_admin.episode_name')}}</label>
                                    <div id="episodes_cont">
                                        <select required name="episode_id" class="form-control select2"
                                                id="kt_select2_1" style="width: 100%">
                                            <option>{{trans('s_admin.choose_episode')}}</option>
                                            @foreach($episodes as $row)
                                                @if(app()->getLocale() == 'ar')
                                                    <option @if(old('episode_id') == $row->id) selected
                                                            @endif value="{{$row->id}}">
                                                        &nbsp;{{$row->name_ar}}</option>
                                                @else
                                                    <option @if(old('episode_id') == $row->id) selected
                                                            @endif value="{{$row->id}}">
                                                        &nbsp;{{$row->name_en}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group" style="display: none;" id="student_cont">
                                    <label>{{trans('s_admin.student_name')}}</label>
                                    <div id="episodes_cont">
                                        <select required name="student_id" class="form-control select2"
                                                id="kt_select2_2" style="width: 100%">
                                            <option>{{trans('s_admin.choose_student')}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <label
                                        class="col-lg-2 col-form-label text-lg-right">{{trans('s_admin.attendance_period')}}</label>
                                    <label
                                        class="col-lg-1 col-form-label text-lg-right">{{trans('s_admin.from')}}</label>
                                    <div class="col-lg-3">
                                        <input class="form-control" type="date" value="{{old('from')}}"
                                               name="from" id="example-date-input">
                                    </div>
                                    <label class="col-lg-1 col-form-label text-lg-right">{{trans('s_admin.to')}}</label>
                                    <div class="col-lg-3">
                                        <input class="form-control" type="date" value="{{old('from')}}"
                                               name="to" id="example-date-input">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-5"></div>
                                    <div class="col-lg-7">
                                        <button type="submit"
                                                class="btn btn-primary mr-2">{{trans('s_admin.search')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane @if($type == 'step_two') active @endif " id="panel_step_two">
                    <h4>{{trans('s_admin.search_by_stud_productivity')}}</h4>
                    <div class="card card-custom example example-compact">
                        <form class="form" method="get"
                              action="{{route('reports.productivity.search_step_two')}}">
                            <input type="hidden" name="type" value="step_two">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{trans('s_admin.student_name')}}</label>
                                    <div id="episodes_cont">
                                        <select required name="student_id" class="form-control select2"
                                                id="kt_select2_4" style="width: 100%">
                                            <option>{{trans('s_admin.choose_student')}}</option>
                                            @foreach($students as $row)
                                                @if(app()->getLocale() == 'ar')
                                                    <option @if(old('student_id') == $row->id) selected
                                                            @endif value="{{$row->id}}">
                                                        &nbsp;{{$row->user_name}}</option>
                                                @else
                                                    <option @if(old('student_id') == $row->id) selected
                                                            @endif value="{{$row->id}}">
                                                        &nbsp;{{$row->user_name}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <label
                                        class="col-lg-2 col-form-label text-lg-right">{{trans('s_admin.attendance_period')}}</label>
                                    <label
                                        class="col-lg-1 col-form-label text-lg-right">{{trans('s_admin.from')}}</label>
                                    <div class="col-lg-3">
                                        <input class="form-control" type="date" value="{{old('from')}}"
                                               name="from" id="example-date-input">
                                    </div>
                                    <label class="col-lg-1 col-form-label text-lg-right">{{trans('s_admin.to')}}</label>
                                    <div class="col-lg-3">
                                        <input class="form-control" type="date" value="{{old('from')}}"
                                               name="to" id="example-date-input">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-5"></div>
                                    <div class="col-lg-7">
                                        <button type="submit"
                                                class="btn btn-primary mr-2">{{trans('s_admin.search')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane @if($type == 'step_three') active @endif " id="kt_builder_page3">
                    <h4>{{trans('s_admin.search_by_epo_productivity')}}</h4>
                    <div class="card card-custom example example-compact">
                        <form class="form" method="get" action="{{route('reports.productivity.search_step_three')}}">
                            <input type="hidden" name="type" value="step_three">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{trans('s_admin.episode_name')}}</label>
                                    <div id="episodes_cont">
                                        <select required name="episode_id" class="form-control select2"
                                                id="kt_select2_66" style="width: 100%">
                                            <option>{{trans('s_admin.choose_episode')}}</option>
                                            @foreach($episodes as $row)
                                                @if(app()->getLocale() == 'ar')
                                                    <option value="{{$row->id}}">
                                                        &nbsp;{{$row->name_ar}}</option>
                                                @else
                                                    <option value="{{$row->id}}">
                                                        &nbsp;{{$row->name_en}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <label
                                        class="col-lg-2 col-form-label text-lg-right">{{trans('s_admin.attendance_period')}}</label>
                                    <label
                                        class="col-lg-1 col-form-label text-lg-right">{{trans('s_admin.from')}}</label>
                                    <div class="col-lg-3">
                                        <input class="form-control" type="date" name="from" id="example-date-input">
                                    </div>
                                    <label class="col-lg-1 col-form-label text-lg-right">{{trans('s_admin.to')}}</label>
                                    <div class="col-lg-3">
                                        <input class="form-control" type="date" name="to" id="example-date-input">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-5"></div>
                                    <div class="col-lg-7">
                                        <button type="submit"
                                                class="btn btn-primary mr-2">{{trans('s_admin.search')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="tab-pane @if($type == 'step_four') active @endif " id="kt_builder_page_details">
                    <h4>{{trans('s_admin.search_by_epo_productivity_details')}}</h4>
                    <div class="card card-custom example example-compact">
                        <form class="form" method="get" action="{{route('reports.productivity.search_step_four')}}">
                            <input type="hidden" name="type" value="step_four">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{trans('s_admin.episode_name')}}</label>
                                    <div id="episodes_cont">
                                        <select required name="episode_id" class="form-control select2"
                                                id="kt_select2_3" style="width: 100%">
                                            <option>{{trans('s_admin.choose_episode')}}</option>
                                            @foreach($episodes as $row)
                                                @if(app()->getLocale() == 'ar')
                                                    <option value="{{$row->id}}">
                                                        &nbsp;{{$row->name_ar}}</option>
                                                @else
                                                    <option value="{{$row->id}}">
                                                        &nbsp;{{$row->name_en}}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row mt-3">
                                    <label
                                        class="col-lg-2 col-form-label text-lg-right">{{trans('s_admin.attendance_period')}}</label>
                                    <label
                                        class="col-lg-1 col-form-label text-lg-right">{{trans('s_admin.from')}}</label>
                                    <div class="col-lg-3">
                                        <input class="form-control" type="date" name="from" id="example-date-input">
                                    </div>
                                    <label class="col-lg-1 col-form-label text-lg-right">{{trans('s_admin.to')}}</label>
                                    <div class="col-lg-3">
                                        <input class="form-control" type="date" name="to" id="example-date-input">
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-lg-5"></div>
                                    <div class="col-lg-7">
                                        <button type="submit"
                                                class="btn btn-primary mr-2">{{trans('s_admin.search')}}</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="card card-custom">
            <div class="card-body">

                @if($type == 'step_one' || $type == 'step_two'|| $type == 'step_four' )
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                        <thead>
                        <tr>
                            <th>{{trans('s_admin.day')}}</th>
                            <th>{{trans('s_admin.date')}}</th>
                            @if($type == 'step_four')
                                <th class="text-center"
                                    style="width: 5%">{{trans('s_admin.student_name')}}</th>
                            @endif
                            <th>{{trans('s_admin.episode_name')}}</th>
                            <th>{{trans('s_admin.degree')}}</th>
                            <th>{{trans('s_admin.lisen_type')}}</th>
                            <th>{{trans('s_admin.surah')}}</th>
                            <th>{{trans('s_admin.from')}}</th>
                            <th>{{trans('s_admin.surah')}}</th>
                            <th>{{trans('s_admin.to')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td class="text-center" style="width: 10%">
                                    {{$row->created_at->translatedFormat('l')}}
                                </td>
                                <td>{{date('Y-m-d', strtotime($row->created_at))}}</td>
                                @if($type == 'step_four')
                                    <td>{{$row->Student->user_name}}</td>
                                @endif
                                <td> @if(app()->getLocale() == 'ar') {{$row->Episode->name_ar}} @else {{$row->Episode->name_e}} @endif </td>
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
                        @endforeach
                        </tbody>
                    </table>
                @elseif($type == 'step_three' )
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                        <thead>
                        <tr>
                            <th title="Field #1" class="text-center">#</th>
                            <th title="Field #2" class="text-center"
                                style="width: 5%">{{trans('s_admin.episode_name')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_active_faces_new')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_remain_faces_new')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_active_faces_revision')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_remain_faces_revision')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_active_faces')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($data as $row)
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-center">
                                    @if(app()->getLocale() == 'ar') {{$row->name_ar}} @else {{$row->name_en}} @endif
                                </td>
                                @php
                                    $is_verif = \App\Models\Plan_section_degree::where('episode_id',$row->id)->whereBetween('created_at', [$from, $to])->where('type','degree')->get()->sum('saved_lines');
                                    $is_verif_new = \App\Models\Plan_section_degree::where('episode_id',$row->id)->whereBetween('created_at', [$from, $to])->where('plan_type','new')->where('type','degree')->get()->sum('saved_lines');
                                    $is_verif_revision = \App\Models\Plan_section_degree::where('episode_id',$row->id)->whereBetween('created_at', [$from, $to])->where('plan_type','revision')->where('type','degree')->get()->sum('saved_lines');
                                    $is_verif = $is_verif / 15 ;
                                    $is_verif_new = $is_verif_new / 15 ;
                                    $is_verif_revision = $is_verif_revision / 15 ;

                                    // for remain
                                    $remain_new = 0;
                                    $remain_revision = 0;
                                    $stud_epos = \App\Models\Episode_student::where('episode_id',$row->id)->get();
                                    foreach ($stud_epos as $stud_row){
                                        $plan_new = \App\Models\Plan\Plan_new::where('sub_level_id',$stud_row->subject_level_id)->get()->count();
                                        $plan_revision = \App\Models\Plan\Plan_revision::where('sub_level_id',$stud_row->subject_level_id)->get()->count();
                                        if($stud_row->Subject){
                                        $faces_required_new = $plan_new * $stud_row->Subject->amount_num ;
                                        $faces_required_revision = $plan_revision * $stud_row->Subject->amount_num ;
                                        }else{
                                            $faces_required_new = 0 ;
                                            $faces_required_revision = 0 ;
                                        }


                                        $faces_required_new = $faces_required_new / 15 ;
                                        $faces_required_revision = $faces_required_revision / 15 ;
                                        $remain_new = $remain_new + $faces_required_new ;
                                        $remain_revision = $remain_revision + $faces_required_revision ;
                                    }

                                        $new_remain_new = $remain_new - $is_verif_new ;
                                        $new_remain_revision = $remain_revision - $is_verif_revision ;
                                @endphp
                                <td class="text-center"> {{ $is_verif_new}} </td>
                                <td class="text-center"> {{ $new_remain_new}} </td>
                                <td class="text-center"> {{ $is_verif_revision}} </td>
                                <td class="text-center"> {{ $new_remain_revision}} </td>
                                <td class="text-center"> {{ $is_verif}} </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
        </div>
    </div>
    <!--begin::Card-->
@endsection

@section('scripts')
    <script src="{{ asset('js/basic_report_ajax.js') }}"></script>
    <script src="{{ asset('js/create_episode_ajax.js') }}"></script>
    <script>
        var table4 = $('#kt_datatable_button2');
        // begin first table
        table4.DataTable({
            bLengthChange: false,
            scrollX: true,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'print',
                    text: '{{trans("s_admin.print")}}',
                    className: 'btn btn-warning mr-2',
                    title: '',
                    customize: function (win) {
                        $(win.document.body)
                            .css('direction', 'rtl').prepend(
                            ' <table> ' +
                            '                        <tbody> ' +
                            '                                <tr>' +
                            '                                    <td style="text-align: center"><p>المملكة العربية السعودية</p> <p>وزارة الموارد البشرية والتنمية الاجتماعية</p> <p>الجمعية الخيرية لتحفيظ القرآن الكريم بمحافظه عنيزة</p></td>' +
                            '                                    <td style="text-align: right"> <img src="{{ App\Models\Web_setting::first()->logo_ar  }}" width="150px" height="150px" /> </td>' +
                            '                                    <td style="text-align: right"><p>عنوان التقرير : {{ trans("s_admin.nav_save_and_lisen_reports")  }}</p>' +
                            '                                                                  <p>تاريخ التقرير : {{ Carbon\Carbon::now()->translatedFormat('l Y/m/d') }}</p>' +
                            '                                                                  <p>وقت التقرير : {{ Carbon\Carbon::now()->translatedFormat('h:i a') }}</p></td>' +
                            '                                </tr> ' +
                            '                        </tbody>' +
                            '                    </table>'
                        );
                    },
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                },
                {
                    extend: 'excel',
                    text: '{{trans("s_admin.excel")}}',
                    className: 'btn btn-dark mr-2',
                    customize: function (win) {
                        $(win.document)
                            .css('direction', 'rtl');
                    },
                    exportOptions: {
                        columns: [0, ':visible']
                    }
                }, {
                    extend: 'colvis',
                    text: '{{trans("s_admin.Columns_appear")}}',
                    className: 'btn btn-primary mr-2',
                    customize: function (win) {
                        $(win.document)
                            .css('direction', 'rtl');
                    }
                }

            ],
            columnDefs: [],
        });
    </script>
@endsection
