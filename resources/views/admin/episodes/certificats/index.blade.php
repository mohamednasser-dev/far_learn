@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_certifcates')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            {{--            <div class="card-toolbar">--}}
            {{--                <a href="{{route('episode.create.certificates')}}" class="btn btn-success px-6 font-weight-bold">--}}
            {{--                    <i class="flaticon2-plus"></i> {{trans('s_admin.add')}}--}}
            {{--                </a>--}}
            {{--            </div>--}}
        </div>
        <div class="card-body">

            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
                    <th title="Field #1">{{trans('s_admin.certificate')}}</th>
                    <th title="Field #2">{{trans('s_admin.episode_name')}}</th>
                    <th title="Field #2">{{trans('s_admin.student_name')}}</th>
                    <th title="Field #2">{{trans('s_admin.creation_date')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $row)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td><img style="width: 100px;" src="{{$row->image}}">
                            <a title="{{trans('s_admin.download_image')}}" target="_blank"
                               href="{{route('certificate.download',$row->id)}}"
                               class="btn btn-icon btn-light-twitter mr-2">
                                <i class="flaticon2-arrow-down"></i>
                            </a>
                            <a title="{{trans('s_admin.download_image_cert')}}" download="{{$row->image}}"
                               href="{{$row->image}}" class="btn btn-icon btn-light-twitter mr-2">
                                <i class="flaticon2-photograph"></i>
                            </a>
                        </td>
                        <td> @if(app()->getLocale() == 'ar' ){{$row->Episode->name_ar}} @else {{$row->Episode->name_en}} @endif </td>
                        <td>{{$row->Student->user_name}}</td>
                        <td>{{$row->created_at->format('Y-m-d')}}</td>

                    </tr>
                @endforeach
                </tbody>
            </table>
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
                            '                                    <td style="text-align: right"><p>عنوان التقرير : {{ trans("s_admin.nav_certifcates")  }}</p>' +
                            '                                                                  <p>تاريخ التقرير : {{ Carbon\Carbon::now()->translatedFormat('l Y/m/d') }}</p>' +
                            '                                                                  <p>وقت التقرير : {{ Carbon\Carbon::now()->translatedFormat('h:i a') }}</p></td>' +
                            '                                </tr> ' +
                            '                        </tbody>' +
                            '                    </table>'
                        );
                    },
                    exportOptions: {
                        columns: [0, ':visible'],
                        stripHtml: false,
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
                        columns: [0, ':visible'],

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
