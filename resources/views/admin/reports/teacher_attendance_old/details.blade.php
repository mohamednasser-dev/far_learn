@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.attendance_details')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_missions_done_reports')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_reports_and_stat')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="card-title"> <h4> {{trans('s_admin.teacher_info')}} </h4> </div>
                    <div class="form-group row mt-3">
                        <div class="col-lg-2">
                        <h4>{{trans('s_admin.teacher_name')}}</h4>
                        </div>
                        <div class="col-lg-2">
                            <h4>{{$teacher->first_name_ar}} &nbsp; {{$teacher->mid_name_ar}}  &nbsp; {{$teacher->last_name_ar}}</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="card-title"> <h4> {{trans('s_admin.search_with_period')}} </h4> </div>
                    <form action="{{route('reports.teacher.attendance.search.period',$teacher->id)}}" method="get">
                        @csrf
                        <div class="form-group row mt-3">
                            <label class="col-lg-1 col-form-label text-lg-right">{{trans('s_admin.from')}}</label>
                            <div class="col-lg-2">
                                <input class="form-control" type="date" value="{{$from_date}}" name="from" id="example-date-input">
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right">{{trans('s_admin.to')}}</label>
                            <div class="col-lg-2">
                                <input class="form-control" type="date" value="{{$to_date}}" name="to" id="example-date-input">
                            </div>
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-success">{{trans('s_admin.search')}}</button>
                            </div>
                            <label class="col-lg-1 col-form-label text-lg-right">{{trans('s_admin.come_persentage')}}</label>
                            <label class="col-lg-1 col-form-label text-lg-right">{{$persentage}}%</label>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-lg-6">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="card-title">
                        <h4>{{trans('s_admin.attendance_days')}}</h4> ( {{count($attendance_data)}} )
                    </div>
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                        <thead>
                        <tr>
                            <th title="Field #1" class="text-center" style="width: 5%">#</th>
                            <th title="Field #5" class="text-center" style="width: 10%">{{trans('s_admin.date')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($attendance_data as $row)
                            <tr>
                                <td class="text-center" style="width: 10%"><?php echo $i; ?></td>
                                <td class="text-center" style="width: 10%">{{$row->created_at->format('Y-m-d')}}</td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="card card-custom">
                <div class="card-body">
                    <div class="card-title">
                        <h4>{{trans('s_admin.absence_days')}}</h4>  ( {{count($absence_data)}} )
                    </div>

                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button3">
                        <thead>
                        <tr>
                            <th title="Field #1" class="text-center" style="width: 5%">#</th>
                            <th title="Field #5" class="text-center" style="width: 10%">{{trans('s_admin.date')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($absence_data as $row)
                            <tr>
                                <td class="text-center" style="width: 10%"><?php echo $i; ?></td>
                                <td class="text-center" style="width: 10%">{{$row->created_at->format('Y-m-d')}}</td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
            </div>
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
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'direction', 'rtl' );
                    }
                },
                {
                    extend: 'excel',
                    text: '{{trans("s_admin.excel")}}',
                    className: 'btn btn-dark mr-2',
                    customize: function ( win ) {
                        $(win.document)
                            .css( 'direction', 'rtl' );
                    }
                },
            ],
            columnDefs: [

            ],
        });
    </script>
    <script>
        var table4 = $('#kt_datatable_button3');
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
                    customize: function ( win ) {
                        $(win.document.body)
                            .css( 'direction', 'rtl' );
                    }
                },
                {
                    extend: 'excel',
                    text: '{{trans("s_admin.excel")}}',
                    className: 'btn btn-dark mr-2',
                    customize: function ( win ) {
                        $(win.document)
                            .css( 'direction', 'rtl' );
                    }
                },
            ],
            columnDefs: [

            ],
        });
    </script>
@endsection
