@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_teacher_rates_reports')}}</h5>
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
        <!--begin::Form-->
        <form class="form" method="get" action="{{route('reports.teacher.rates.search')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row mt-3">
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.teacher_name')}}</label>
                        <input type="text" placeholder="{{trans('s_admin.teacher_name')}}"  name="teacher_name" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.phone')}}</label>
                        <input type="tel" name="teacher_phone" class="form-control">
                    </div>
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.ident_num')}}</label>
                        <input type="text" name="teacher_ident_num" class="form-control">
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
            <div class="table-responsive">
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                        <thead>
                        <tr>
                            <th title="Field #1">#</th>
                            <th title="Field #2">{{trans('s_admin.teacher_name')}}</th>
                            <th title="Field #2">{{trans('s_admin.student_name')}}</th>
                            <th title="Field #3">{{trans('s_admin.episode')}}</th>
                            <th title="Field #3">{{trans('s_admin.rating')}}</th>
                            <th title="Field #3">{{trans('s_admin.notes')}}</th>
                            <th title="Field #3">{{trans('s_admin.date')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($data as $row)
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-center">
                                    {{$row->Teacher->user_name}}
                                </td>
                                <td class="text-center">
                                    {{$row->Student->user_name}}
                                </td>
                                <td class="text-center">{{$row->Episode->name_ar}}</td>
                                <td class="text-center">{{$row->rate}}</td>
                                <td class="text-center">{{$row->notes}}</td>
                                <td class="text-center">{{$row->created_at->format('Y-m-d')}}</td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
            </div>
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
                            '                                    <td style="text-align: right"><p>عنوان التقرير : {{ trans("s_admin.nav_teacher_rates_reports")  }}</p>' +
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
