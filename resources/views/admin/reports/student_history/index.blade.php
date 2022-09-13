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
    <!--begin::Card-->
    <div class="card card-custom example example-compact">
        <form class="form" method="get" action="{{route('reports.student_history.search')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row mt-3">
                    <div class="form-group col-lg-6" id="student_cont">
                        <label>{{trans('s_admin.student_name')}}</label>
                        <div id="episodes_cont">
                            <select name="student_id" class="form-control select2"
                                    id="kt_select2_2" style="width: 100%">
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
                </div>
                <div class="form-group row mt-3">
                    <div class="col-lg-6">
                        <label>{{trans('s_admin.ident_num')}}</label>
                        <input type="text" name="ident_num" class="form-control">
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
                    <th title="Field #1" class="text-center" style="width: 5%">{{trans('s_admin.study_year')}}</th>
                    <th title="Field #2" class="text-center"
                        style="width: 5%">{{trans('s_admin.Academic_semester')}}</th>
                    <th title="Field #3" class="text-center"
                        style="width: 10%">{{trans('s_admin.name_mogmaa_dorr')}}</th>
                    <th title="Field #4" class="text-center" style="width: 10%">{{trans('s_admin.episode_name')}}</th>
                    <th title="Field #5" class="text-center" style="width: 10%">{{trans('s_admin.teacher_name_h')}}</th>
                    <th title="Field #5" class="text-center" style="width: 10%">{{trans('s_admin.subject_type')}}</th>
                    <th title="Field #5" class="text-center" style="width: 10%">{{trans('s_admin.subject')}}</th>
                    <th title="Field #5" class="text-center" style="width: 10%">{{trans('s_admin.subject_level')}}</th>
                    <th title="Field #5" class="text-center" style="width: 10%">{{trans('s_admin.pass_status')}}</th>
                    <th title="Field #5" class="text-center" style="width: 10%">{{trans('s_admin.degree')}}</th>
                    <th title="Field #5" class="text-center" style="width: 10%">{{trans('s_admin.appreciation')}}</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($data as $row)
                    <tr>
                        <td class="text-center" style="width: 10%">
                            @if($row->Episode->Term)
                                {{$row->Episode->Term->Year->date}}
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">
                            @if($row->Episode->Term)
                                {{$row->Episode->Term->name}}
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">
                            @if($row->Episode->Mogmaa)
                                @if(app()->getLocale() == 'ar') {{$row->Episode->Mogmaa->name_ar}} @else {{$row->Episode->Mogmaa->name_en}} @endif
                            @else
                                {{trans('s_admin.far_learn')}}
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">
                            @if($row->Episode)
                                @if(app()->getLocale() == 'ar') {{$row->Episode->name_ar}} @else {{$row->Episode->name_en}} @endif
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">
                            @if($row->Episode->Teacher)
                                {{$row->Episode->Teacher->user_name}}
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">
                            @if($row->Episode->Level)
                                @if(app()->getLocale() == 'ar') {{$row->Episode->Level->name_ar}} @else {{$row->Episode->Level->name_en}} @endif
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">
                            @if($row->Episode->Subject)
                                @if(app()->getLocale() == 'ar') {{$row->Episode->Subject->name_ar}} @else {{$row->Episode->Subject->name_en}} @endif
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">
                            @if($row->Episode->Subject_level)
                                @if(app()->getLocale() == 'ar') {{$row->Episode->Subject_level->name_ar}} @else {{$row->Episode->Subject_level->name_en}} @endif
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">
                            {{trans('s_admin.pased')}}
                        </td>
                        <td class="text-center" style="width: 10%">
                            @php
                             $degree = \App\Models\Far_learn_degree::where('name_ar',$row->degree)->first();
                            @endphp
                            @if($degree)
                                {{$degree->id}}
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">
                            @if(app()->getLocale() == 'ar') {{$row->degree}} @else {{$row->degree}} @endif
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
                            '                                    <td style="text-align: right"><p>عنوان التقرير : {{trans('s_admin.job_name_history')}}</p>' +
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
