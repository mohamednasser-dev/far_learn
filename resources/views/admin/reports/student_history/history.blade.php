@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.history_level')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_students_reviews_reports')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_reports_and_stat')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <!--begin::Card-->

    <div class="card card-custom">
        <div class="card-body">
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                <thead>
                <tr>
                    <th title="Field #1" class="text-center" style="width: 5%">#</th>
                    <th title="Field #2" class="text-center" style="width: 5%">{{trans('s_admin.level')}}</th>
                    <th title="Field #3" class="text-center" style="width: 10%">{{trans('s_admin.subject')}}</th>
                    <th title="Field #4" class="text-center" style="width: 10%">{{trans('s_admin.subject_level')}}</th>
                    <th title="Field #5" class="text-center" style="width: 10%">{{trans('s_admin.notes')}}</th>
                    <th title="Field #5" class="text-center" style="width: 10%">{{trans('s_admin.created_at')}}</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($data as $row)
                    <tr>
                        <td class="text-center" style="width: 10%"><?php echo $i; ?></td>
                        <td class="text-center" style="width: 10%">
                            @if($row->Level)
                           @if(app()->getLocale() == 'ar') {{$row->Level->name_ar}} @else {{$row->Level->name_en}} @endif
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">
                            @if($row->Subject)
                            @if(app()->getLocale() == 'ar') {{$row->Subject->name_ar}} @else {{$row->Subject->name_en}} @endif
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">
                            @if($row->Subject_level)
                            @if(app()->getLocale() == 'ar') {{$row->Subject_level->name_ar}} @else {{$row->Subject_level->name_en}} @endif
                            @endif
                        </td>
                        <td class="text-center" style="width: 10%">{{$row->notes}}</td>
                        <td class="text-center" style="width: 10%">{{$row->created_at->format('Y-m-d')}}</td>
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
                            '                                    <td style="text-align: right"><p>عنوان التقرير : {{trans('s_admin.history_level')}}</p>' +
                            '                                                                  <p>تاريخ التقرير : {{ Carbon\Carbon::now()->translatedFormat('Y/m/d  l') }}</p>' +
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
