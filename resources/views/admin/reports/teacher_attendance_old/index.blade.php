@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_missions_done_reports')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_reports_and_stat')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom example example-compact">
        <form class="form" method="get" action="{{route('reports.teacher.attendance.search')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row mt-3">
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.teacher_name')}}</label>
                        <input type="text" name="teacher_name" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.phone')}}</label>
                        <input type="tel" name="phone" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.ident_num')}}</label>
                        <input type="text" name="ident_num" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.nationality')}}</label>
                        {{ Form::select('nationality',App\Models\Nationality::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_nationality')  ]) }}

                    </div>
                </div>
                <div class="form-group row">

                    <div class="col-lg-3">
                        <label>{{trans('s_admin.study_section')}}</label>
                        {{ Form::select('qualification',App\Models\Qualification::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_qualification')  ]) }}
                    </div>
                    <div class="col-lg-3">
                        <label>{{trans('admin.country')}}</label>
                        {{ Form::select('country',App\Models\Country::where('deleted','0')->pluck('name_'.app()->getLocale(),'id'),null
                                                ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_country')  ]) }}
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <div class="row">
                    <div class="col-lg-5"></div>
                    <div class="col-lg-7">
                        <button type="submit" class="btn btn-primary mr-2">{{trans('s_admin.search')}}</button>
                    </div>
                </div>
            </div>
        </form>
        <!--end::Form-->
    </div>
    <div class="card card-custom">
        <div class="card-body">
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
{{--                    <th title="Field #1" style="width: 5%">{{trans('s_admin.image')}}</th>--}}
                    <th title="Field #2">{{trans('admin.name')}}</th>
                    <th title="Field #3">{{trans('s_admin.email')}}</th>
                    <th title="Field #3">{{trans('s_admin.phone')}}</th>
                    <th title="Field #3">{{trans('s_admin.Attendance_num')}}</th>
                    <th title="Field #3">{{trans('s_admin.absence_num')}}</th>
                    <th title="Field #3">{{trans('s_admin.come_persentage')}}</th>
                    <th title="Field #3">{{trans('s_admin.attendance_details')}}</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($data as $row)
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
{{--                        @if($row->image != null)--}}
{{--                            <td class="text-center" style="width: 5%">--}}
{{--                                <span style="width: 250px;">--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="symbol symbol-40 symbol-sm flex-shrink-0">--}}
{{--                                            <img class="" src="{{$row->image}}"--}}
{{--                                                 alt="photo">--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </span>--}}
{{--                            </td>--}}
{{--                        @else--}}
{{--                            <td class="text-center" style="width: 5%">--}}
{{--                                <span style="width: 250px;">--}}
{{--                                    <div class="d-flex align-items-center">--}}
{{--                                        <div class="symbol symbol-40 symbol-light-danger flex-shrink-0">--}}
{{--                                            <span class="symbol-label font-size-h4 font-weight-bold">--}}
{{--                                                @if(app()->getLocale() == 'ar')--}}
{{--                                                    {{$row->first_name_en[0]}}--}}
{{--                                                @else--}}
{{--                                                    {{$row->first_name_en[0]}}--}}
{{--                                                @endif--}}
{{--                                            </span>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </span>--}}
{{--                            </td>--}}
{{--                        @endif--}}
                        <td class="text-center">
                            {{$row->first_name_ar}} &nbsp;  {{$row->mid_name_ar}} &nbsp; {{$row->last_name_ar}}
                        </td>
                        <td class="text-center">{{$row->email}}</td>
                        <td class="text-center">{{$row->phone}}</td>
                        <td class="text-center">
                            {{count($row->Attendance)}}
                        </td>
                        <td class="text-center">
                            {{count($row->Absence)}}
                        </td>

                        <td class="text-center">
                            @php
                                $absence_data = \App\Models\Teacher_absence::where('teacher_id',$row->id)->where('type','absence')->get();
                                $attendance_data = \App\Models\Teacher_absence::where('teacher_id',$row->id)->where('type','attendance')->get();
                                    $attendance = count($attendance_data);
                                    $absence = count($absence_data);
                                    $total_days = $attendance + $absence;
                                    if($total_days == 0){
                                        $persentage = 0;
                                    }else{
                                        $persentage = ($attendance/$total_days) *100;
                                    }
                                    $floatVal = floatval($persentage);
                                    // If the parsing succeeded and the value is not equivalent to an int
                                    if($floatVal && intval($floatVal) != $floatVal){
                                        $persentage =  number_format((float)$persentage, 1, '.', '');
                                    }
                                @endphp
                            {{$persentage}}
                        </td>
                        <td class="text-center">
                            <a href="{{route('teacher.attendance.details', $row->id)}}"
                               class="btn btn-icon btn-warning btn-circle btn-sm mr-2">
                                <i class="icon-md fas fa-eye" aria-hidden='true'></i>
                            </a>
                        </td>
                    </tr>
                    <?php $i++; ?>
                @endforeach
                </tbody>
            </table>
            <!--end: Datatable-->
        </div>
    </div>
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
                            '                                    <td style="text-align: right"><p>عنوان التقرير : {{trans('s_admin.nav_missions_done_reports')}}  </p>' +
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
