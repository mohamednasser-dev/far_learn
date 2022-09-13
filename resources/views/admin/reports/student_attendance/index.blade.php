@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_students_reviews_reports')}}</h5>
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
                       href="#kt_builder_themes">{{trans('s_admin.search_by_stud_epo')}}</a>
                </li>
                <li class="nav-item @if($type == 'step_two') active @endif ">
                    <a class="nav-link @if($type == 'step_two') active @endif" data-toggle="tab"
                       href="#kt_builder_page3">{{trans('s_admin.search_by_studs_epo')}}</a>
                </li>
                <li class="nav-item @if($type == 'step_three') active @endif ">
                    <a class="nav-link @if($type == 'step_three') active @endif" data-toggle="tab"
                       href="#kt_builder_page_details">{{trans('s_admin.search_by_studs_epo_details')}}</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content pt-3">
                <div class="tab-pane @if($type == 'step_one') active @endif " id="kt_builder_themes">
                    <h4>{{trans('s_admin.search_by_stud_epo')}}</h4>
                    <div class="card card-custom example example-compact">
                        <form class="form" method="get"
                              action="{{route('reports.attendance.search.step_one')}}">
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
                <div class="tab-pane @if($type == 'step_two') active @endif " id="kt_builder_page3">
                    <h4>{{trans('s_admin.search_by_studs_epo')}}</h4>
                    <div class="card card-custom example example-compact">
                        <form class="form" method="get" action="{{route('reports.attendance.search.step_two')}}">
                            <input type="hidden" name="type" value="step_two">
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{trans('s_admin.episode_name')}}</label>
                                    <div id="episodes_cont">
                                        <select required name="episode_id" class="form-control select2"
                                                id="kt_select2_4" style="width: 100%">
                                            <option>{{trans('s_admin.choose_episode')}}</option>
                                            <option value="0">{{trans('s_admin.all_episodes')}}</option>
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
                <div class="tab-pane @if($type == 'step_three') active @endif " id="kt_builder_page_details">
                    <h4>{{trans('s_admin.search_by_studs_epo_details')}}</h4>
                    <div class="card card-custom example example-compact">
                        <form class="form" method="get" action="{{route('reports.attendance.search.step_three')}}">
                            <input type="hidden" name="type" value="step_three">
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
                @if($type == 'step_one' || $type == 'step_three' )
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                        <thead>
                        <tr>
                            <th title="Field #5" class="text-center" style="width: 10%">{{trans('s_admin.day')}}</th>
                            <th title="Field #5" class="text-center" style="width: 10%">{{trans('s_admin.date')}}</th>
                            @if($type == 'step_three' )
                                <th title="Field #5" class="text-center"
                                    style="width: 10%">{{trans('s_admin.student_name')}}</th>
                            @endif
                            <th title="Field #5" class="text-center"
                                style="width: 10%">{{trans('s_admin.attendance_status_repo')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td class="text-center" style="width: 10%">
                                    {{$row->created_at->translatedFormat('l')}}
                                </td>
                                <td class="text-center" style="width: 10%">{{$row->created_at->format('Y-m-d')}}</td>
                                @if($type == 'step_three' )
                                    <td class="text-center" style="width: 10%">{{$row->Student->user_name}}</td>
                                @endif
                                <td class="text-center" style="width: 10%">
                                    @if(class_basename($row) == "Plan_section_degree")
                                        {{trans('s_admin.abse')}}
                                    @else
                                        {{trans('s_admin.attend')}}
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    @if($type == 'step_one' )
                        <label>
                            {{trans('s_admin.attendance_ratio')}} : {{$persentage}} %
                        </label
                    @endif
                @else
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                        <thead>
                        <tr>
                            <th title="Field #5" class="text-center"
                                style="width: 10%">{{trans('s_admin.student_name')}}</th>
                            <th title="Field #5" class="text-center"
                                style="width: 10%">{{trans('s_admin.episode_name')}}</th>
                            <th title="Field #5" class="text-center"
                                style="width: 10%">{{trans('s_admin.count_attend_days')}}</th>
                            <th title="Field #5" class="text-center"
                                style="width: 10%">{{trans('s_admin.count_absens_days')}}</th>
                            <th title="Field #5" class="text-center"
                                style="width: 10%">{{trans('s_admin.attendance_ratio')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $row)
                            <tr>
                                <td class="text-center" style="width: 10%">{{$row->Student->user_name}}</td>
                                <td class="text-center"
                                    style="width: 10%">@if($row->Episode) {{(app()->getLocale() == 'ar')?$row->Episode->name_ar:$row->Episode->name_en}} @endif </td>
                                <td class="text-center" style="width: 10%">{{$row->attendance_count}}</td>
                                <td class="text-center" style="width: 10%">{{$row->absence_count}}</td>
                                <td class="text-center" style="width: 10%">{{$row->persentage}} %</td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <label style="font-weight: 700;">
                        {{trans('s_admin.average_attendance_ratio')}} : {{$persentage}} %
                    </label
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
                    customize: function (win) {
                        $(win.document.body)
                            .css('direction', 'rtl').prepend(
                            ' <table> ' +
                            '                        <tbody> ' +
                            '                                <tr>' +
                            '                                    <td style="text-align: center"><p>المملكة العربية السعودية</p> <p>وزارة الموارد البشرية والتنمية الاجتماعية</p> <p>الجمعية الخيرية لتحفيظ القرآن الكريم بمحافظه عنيزة</p></td>' +
                            '                                    <td style="text-align: right"> <img src="{{ App\Models\Web_setting::first()->logo_ar  }}" width="150px" height="150px" /> </td>' +
                            '                                    <td style="text-align: right"><p>عنوان التقرير : {{ trans("s_admin.nav_teachers_reports")  }}</p>' +
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
                    }
                },
            ],
            columnDefs: [],
        });
    </script>
@endsection
