@extends('admin_temp')
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
            <form action="{{route('reports.reports.reciting_today.search')}}" method="post">
                @csrf
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">{{trans('s_admin.date')}}</label>
                            <div class="col-9">
                                <div class="input-group date">
                                    <input type="text" required name="selected_date" value="{{$today_date}}"
                                           class="form-control"
                                           id="kt_datepicker_3_modal"/>
                                    <div class="input-group-append">
                                                <span class="input-group-text">
                                                    <i class="la la-calendar"></i>
                                                </span>
                                    </div>
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
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                    <thead>
                    <tr>
                        <th title="Field #1">#</th>
                        <th title="Field #1">{{trans('s_admin.teacher')}}</th>
                        <th title="Field #1">{{trans('s_admin.student')}}</th>
                        <th title="Field #2">{{trans('s_admin.degree')}}</th>
                        <th title="Field #2">{{trans('s_admin.episode')}}</th>
                        <th title="Field #2">{{trans('s_admin.date')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($data as $key => $row)

                        <tr>
                            <td>{{$key + 1}}</td>
                            <td>{{$row->Teacher->user_name}}</td>
                            <td>{{$row->Student->user_name}}</td>
                            <td>
                                @if($row->type == 'ask')
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->AskDegree->name_ar }}
                                    @else
                                        {{$row->AskDegree->name_en }}
                                    @endif
                                @else
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

                                @endif
                            </td>
                            <td>
                                @if(app()->getLocale() == 'ar')
                                    {{$row->Episode->name_ar}}
                                @else
                                    {{$row->Episode->name_en}}
                                @endif
                            </td>
                            <td> {{$row->created_at->format('Y-m-d') }}</td>
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
                            '                                    <td style="text-align: right"><p>عنوان التقرير : {{ trans("s_admin.reports_today_listen")  }}</p>' +
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
