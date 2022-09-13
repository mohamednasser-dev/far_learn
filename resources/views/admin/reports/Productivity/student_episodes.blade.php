@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.history_level')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

            <li class="breadcrumb-item">
                <a href="{{route('reports.productivity')}}" class="text-muted">{{trans('s_admin.nav_save_and_lisen_reports')}}</a>
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
                    <th title="Field #2" class="text-center" style="width: 5%">{{trans('s_admin.episode_name')}}</th>
                    <th title="Field #2" class="text-center" style="width: 5%">{{trans('s_admin.faces_done_new')}}</th>
                    <th title="Field #2" class="text-center"
                        style="width: 5%">{{trans('s_admin.faces_done_revision')}}</th>
                    <th title="Field #3" class="text-center" style="width: 10%">{{trans('s_admin.is_verification')}}
                        ( {{trans('s_admin.with_face')}} )
                    </th>
                    <th title="Field #4" class="text-center" style="width: 10%">{{trans('s_admin.remained')}}
                        ( {{trans('s_admin.with_face')}} )
                    </th>
                    <th title="Field #4" class="text-center"
                        style="width: 10%">{{trans('s_admin.done_persentage')}}</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($data as $row)
                    @if($row->Episode)
                    <tr>
                        <td class="text-center"><?php echo $i; ?></td>
                        <td class="text-center">

                            @if(app()->getLocale() == 'ar') {{$row->Episode->name_ar}} @else {{$row->Episode->name_en}} @endif

                        </td>
                        @php
                            $is_verif = \App\Models\Plan_section_degree::where('student_id',$student->id)->where('type','degree')->where('episode_id',$row->episode_id)->get()->sum('saved_lines');
                            $is_verif_new = \App\Models\Plan_section_degree::where('student_id',$student->id)->where('plan_type','new')->where('type','degree')->where('episode_id',$row->episode_id)->get()->sum('saved_lines');
                            $is_verif_revison = \App\Models\Plan_section_degree::where('student_id',$student->id)->where('plan_type','revision')->where('type','degree')->where('episode_id',$row->episode_id)->get()->sum('saved_lines');
                            $is_verif = $is_verif / 15 ;

                            $remain = 0 ;
                            $persentage = 0 ;
                            if($row->subject_level_id !=  null && $row->subject_id !=  null ){
                                $plan_new = \App\Models\Plan\Plan_new::where('sub_level_id',$row->subject_level_id)->get()->count();
                                $plan_revision = \App\Models\Plan\Plan_revision::where('sub_level_id',$row->subject_level_id)->get()->count();
                                $all_plans = $plan_new + $plan_revision ;
                                $faces_required = $all_plans * $row->Subject->amount_num ;
                                $faces_required = $faces_required / 15 ;
                                $remain = $faces_required - $is_verif ;
                                if($faces_required == 0){
                                    $persentage = 0 ;
                                }else{
                                    $persentage = ($is_verif/ $faces_required) * 100 ;
                                    $floatVal = floatval($persentage);
                                    // If the parsing succeeded and the value is not equivalent to an int
                                    if($floatVal && intval($floatVal) != $floatVal){
                                        $persentage =  number_format((float)$persentage, 1, '.', '');
                                    }
                                }
                            }
                        @endphp
                        <td class="text-center" style="width: 10%"> {{ $is_verif_new / 15}} </td>
                        <td class="text-center" style="width: 10%"> {{ $is_verif_revison / 15}}  </td>
                        <td class="text-center" style="width: 10%"> {{ $is_verif}} </td>
                        <td class="text-center" style="width: 10%"> {{$remain }} </td>
                        <td class="text-center" style="width: 10%"> {{$persentage}} %</td>
                    </tr>
                    @endif
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
                            '                                    <td style="text-align: right"><p>عنوان التقرير : {{trans('s_admin.history_level')}} -  {{trans('s_admin.nav_save_and_lisen_reports')}}</p>' +
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
