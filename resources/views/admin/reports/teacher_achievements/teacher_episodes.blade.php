@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.episodes')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_come_out_reports')}}</a>
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
            <div class="mb-7">
                <div class="row align-items-center">
                    <div class="col-lg-9 col-xl-8">
                        <div class="row align-items-center">
                            <div class="col-md-4 my-2 my-md-0">
                                <div class="input-icon">
                                    <input type="text" class="form-control" placeholder="{{trans('s_admin.searcht')}}"
                                           id="kt_datatable_search_query"/>
                                    <span><i class="flaticon2-search-1 text-muted"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-xl-4 mt-5 mt-lg-0">
                    </div>
                </div>
            </div>
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                <thead>
                <tr>
                    <th title="Field #1" class="text-center" style="width: 5%">#</th>
                    <th title="Field #2" class="text-center" style="width: 5%">{{trans('s_admin.episode_name')}}</th>
                    <th title="Field #3" style="width: 10%">{{trans('s_admin.total_active_faces_new')}}</th>
                    <th title="Field #3" style="width: 10%">{{trans('s_admin.total_remain_faces_new')}}</th>
                    <th title="Field #3" style="width: 10%">{{trans('s_admin.total_active_faces_revision')}}</th>
                    <th title="Field #3" style="width: 10%">{{trans('s_admin.total_remain_faces_revision')}}</th>
                    <th title="Field #3" style="width: 10%">{{trans('s_admin.total_active_faces')}}</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($data as $row)
                    <tr>
                        <td class="text-center" style="width: 10%"><?php echo $i; ?></td>
                        <td class="text-center" style="width: 10%">
                           @if(app()->getLocale() == 'ar') {{$row->name_ar}} @else {{$row->name_en}} @endif
                        </td>
                        @php
                            $is_verif = \App\Models\Plan_section_degree::where('episode_id',$row->id)->where('type','degree')->get()->sum('saved_lines');
                            $is_verif_new = \App\Models\Plan_section_degree::where('episode_id',$row->id)->where('plan_type','new')->where('type','degree')->get()->sum('saved_lines');
                            $is_verif_revision = \App\Models\Plan_section_degree::where('episode_id',$row->id)->where('plan_type','revision')->where('type','degree')->get()->sum('saved_lines');
                            $is_verif = $is_verif / 15 ;
                            $is_verif_new = $is_verif_new / 15 ;
                            $is_verif_revision = $is_verif_revision / 15 ;

                            // for remain
                            $remain_new = 0;
                            $remain_revision = 0;
                            $stud_epos = \App\Models\Episode_student::where('episode_id',$row->id)->get();
                            foreach ($stud_epos as $stud_row){
                                if( $stud_row->subject_id != null && $stud_row->subject_level_id != null){
                                    $plan_new = \App\Models\Plan\Plan_new::where('sub_level_id',$stud_row->subject_level_id)->get()->count();
                                    $plan_revision = \App\Models\Plan\Plan_revision::where('sub_level_id',$stud_row->subject_level_id)->get()->count();

                                    $faces_required_new = $plan_new * $stud_row->Subject->amount_num ;
                                    $faces_required_revision = $plan_revision * $stud_row->Subject->amount_num ;

                                    $faces_required_new = $faces_required_new / 15 ;
                                    $faces_required_revision = $faces_required_revision / 15 ;
                                    $remain_new = $remain_new + $faces_required_new ;
                                    $remain_revision = $remain_revision + $faces_required_revision ;
                                }
                            }

                                $new_remain_new = $remain_new - $is_verif_new ;
                                $new_remain_revision = $remain_revision - $is_verif_revision ;
                        @endphp
                        <td class="text-center" style="width: 10%"> {{ $is_verif_new}} </td>
                        <td class="text-center" style="width: 10%"> {{ $new_remain_new}} </td>
                        <td class="text-center" style="width: 10%"> {{ $is_verif_revision}} </td>
                        <td class="text-center" style="width: 10%"> {{ $new_remain_revision}} </td>
                        <td class="text-center" style="width: 10%"> {{ $is_verif}} </td>
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
                            '                                    <td style="text-align: right"><p>عنوان التقرير : {{trans('s_admin.episodes')}} - {{trans('s_admin.nav_come_out_reports')}}</p>' +
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
