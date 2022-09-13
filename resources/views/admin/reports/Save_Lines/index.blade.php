@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_student_save_lines_report')}}</h5>
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
        <form class="form" method="get" action="{{route('reports.student_save_lines.search')}}">
            @csrf
            <div class="card-body">
                <div class="form-group row mt-3">
                    <div class="col-lg-3">
                        <label>{{trans('s_admin.student_name')}}</label>
                        <input type="hidden"   name="type" value="student" class="form-control">
                        <input type="text" placeholder="{{trans('s_admin.student_name')}}"  name="student_name" class="form-control">
                    </div>


                    <div class="col-lg-3">
                        <label>{{trans('s_admin.phone')}}</label>
                        <input type="tel" name="phone" class="form-control">
                    </div>

                    <div class="col-lg-3">
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

            <div class="table-responsive">
                @if($type == 'student')
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                        <thead>
                        <tr>
                            <th title="Field #1">#</th>
{{--                            <th title="Field #1" style="width: 5%">{{trans('s_admin.image')}}</th>--}}
                            <th title="Field #2">{{trans('admin.name')}}</th>
                            <th title="Field #3">{{trans('s_admin.email')}}</th>
                            <th title="Field #3">{{trans('s_admin.phone')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_saved_lines')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($data as $row)
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-center">
                                    {{$row->first_name_ar}} &nbsp;  {{$row->mid_name_ar}} &nbsp; {{$row->last_name_ar}}
                                </td>
                                <td class="text-center">{{$row->email}}</td>
                                <td class="text-center">{{$row->phone}}</td>
                                @php
                                    $is_verif = \App\Models\Plan_section_degree::where('student_id',$row->id)->where('type','!=','absence')->get()->sum('saved_lines');
                                @endphp
                                <td class="text-center">{{ $is_verif }}</td>

                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                @elseif($type == 'episodes')
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                        <thead>
                        <tr>
                            <th title="Field #1" class="text-center">#</th>
                            <th title="Field #2" class="text-center" style="width: 5%">{{trans('s_admin.episode_name')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_active_faces_new')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_remain_faces_new')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_active_faces_revision')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_remain_faces_revision')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_active_faces')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($data as $row)
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-center">
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
                                        $plan_new = \App\Models\Plan\Plan_new::where('sub_level_id',$stud_row->subject_level_id)->get()->count();
                                        $plan_revision = \App\Models\Plan\Plan_revision::where('sub_level_id',$stud_row->subject_level_id)->get()->count();

                                        $faces_required_new = $plan_new * $stud_row->Subject->amount_num ;
                                        $faces_required_revision = $plan_revision * $stud_row->Subject->amount_num ;

                                        $faces_required_new = $faces_required_new / 15 ;
                                        $faces_required_revision = $faces_required_revision / 15 ;
                                        $remain_new = $remain_new + $faces_required_new ;
                                        $remain_revision = $remain_revision + $faces_required_revision ;
                                    }

                                        $new_remain_new = $remain_new - $is_verif_new ;
                                        $new_remain_revision = $remain_revision - $is_verif_revision ;
                                @endphp
                                <td class="text-center"> {{ $is_verif_new}} </td>
                                <td class="text-center"> {{ $new_remain_new}} </td>
                                <td class="text-center"> {{ $is_verif_revision}} </td>
                                <td class="text-center"> {{ $new_remain_revision}} </td>
                                <td class="text-center"> {{ $is_verif}} </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                @elseif($type == 'teacher')
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                        <thead>
                        <tr>
                            <th title="Field #1">#</th>
                            <th title="Field #1" style="width: 5%">{{trans('s_admin.image')}}</th>
                            <th title="Field #2">{{trans('admin.name')}}</th>
                            <th title="Field #3">{{trans('s_admin.email')}}</th>
                            <th title="Field #3">{{trans('s_admin.phone')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_active_faces_new')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_remain_faces_new')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_active_faces_revision')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_remain_faces_revision')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_active_faces')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_remain_faces')}}</th>
                            <th title="Field #3">{{trans('s_admin.episodes')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($data as $row)
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                @if($row->image != null)
                                    <td class="text-center">
                                    <span style="width: 250px;">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                                <img class="" src="{{$row->image}}"
                                                    alt="photo">
                                            </div>
                                        </div>
                                    </span>
                                    </td>
                                @else
                                    <td class="text-center" style="width: 5%">
                                    <span style="width: 250px;">
                                        <div class="d-flex align-items-center">
                                            <div class="symbol symbol-40 symbol-light-danger flex-shrink-0">
                                                <span class="symbol-label font-size-h4 font-weight-bold">
                                                    @if(app()->getLocale() == 'ar')
                                                        {{$row->first_name_en[0]}}
                                                    @else
                                                        {{$row->first_name_en[0]}}
                                                    @endif
                                                </span>
                                            </div>
                                        </div>
                                    </span>
                                    </td>
                                @endif
                                <td class="text-center">
                                    {{$row->first_name_ar}} &nbsp;  {{$row->mid_name_ar}} &nbsp; {{$row->last_name_ar}}
                                </td>
                                <td class="text-center">{{$row->email}}</td>
                                <td class="text-center">{{$row->phone}}</td>
                                @php
                                    $mogmaa_ids = [];
                                    foreach ($row->Episodes as $key => $row){
                                        $mogmaa_ids[$key] = $row->id;
                                    }

                                    $is_verif = \App\Models\Plan_section_degree::whereIn('episode_id',$mogmaa_ids)->where('type','degree')->get()->sum('saved_lines');
                                    $is_verif_new = \App\Models\Plan_section_degree::whereIn('episode_id',$mogmaa_ids)->where('plan_type','new')->where('type','degree')->get()->sum('saved_lines');
                                    $is_verif_revision = \App\Models\Plan_section_degree::whereIn('episode_id',$mogmaa_ids)->where('plan_type','revision')->where('type','degree')->get()->sum('saved_lines');
                                    $is_verif = $is_verif / 15 ;
                                    $is_verif_new = $is_verif_new / 15 ;
                                    $is_verif_revision = $is_verif_revision / 15 ;

                                    // for remain
                                    $remain_new = 0;
                                    $remain_revision = 0;
                                    $stud_epos = \App\Models\Episode_student::whereIn('episode_id',$mogmaa_ids)->get();
                                    foreach ($stud_epos as $stud_row){
                                        if($stud_row->Subject){
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
                                    $total_remain = $new_remain_new + $new_remain_revision ;
                                @endphp
                                <td class="text-center"> {{ $is_verif_new}} </td>
                                <td class="text-center"> {{ $new_remain_new}} </td>
                                <td class="text-center"> {{ $is_verif_revision}} </td>
                                <td class="text-center"> {{ $new_remain_revision}} </td>
                                <td class="text-center"> {{ $is_verif}} </td>
                                <td class="text-center"> {{ $total_remain}} </td>
                                <td class="text-center">
                                    @if($row->teacher_id != null)
                                        <a href="{{route('teacher.productive.episodes', $row->teacher_id)}}"
                                        class="btn btn-icon btn-primary btn-circle btn-sm mr-2">
                                            <i class="icon-nm fas fa-hourglass-half" aria-hidden='true'></i>
                                        </a>
                                    @elseif($row->id != null)
                                        <a href="{{route('teacher.productive.episodes', $row->id)}}"
                                        class="btn btn-icon btn-primary btn-circle btn-sm mr-2">
                                            <i class="icon-nm fas fa-hourglass-half" aria-hidden='true'></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                @elseif($type == 'mogmaa')
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable_button2">
                        <thead>
                        <tr>
                            <th title="Field #1">#</th>
                            <th title="Field #1" style="width: 5%">{{trans('s_admin.name')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_active_faces_new')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_remain_faces_new')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_active_faces_revision')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_remain_faces_revision')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_active_faces')}}</th>
                            <th title="Field #3">{{trans('s_admin.total_remain_faces')}}</th>
                            <th title="Field #3">{{trans('s_admin.episodes')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $i = 1; ?>
                        @foreach($data as $row)
                            <tr>
                                <td class="text-center"><?php echo $i; ?></td>
                                <td class="text-center">
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->name_ar}}
                                    @else
                                        {{$row->name_en}}
                                    @endif
                                </td>
                                @php
                                    $mogmaa_ids = [];
                                    foreach ($row->Mogmaat as $key => $row){
                                        $mogmaa_ids[$key] = $row->id;
                                    }

                                    $is_verif = \App\Models\Plan_section_degree::whereIn('episode_id',$mogmaa_ids)->where('type','degree')->get()->sum('saved_lines');
                                    $is_verif_new = \App\Models\Plan_section_degree::whereIn('episode_id',$mogmaa_ids)->where('plan_type','new')->where('type','degree')->get()->sum('saved_lines');
                                    $is_verif_revision = \App\Models\Plan_section_degree::whereIn('episode_id',$mogmaa_ids)->where('plan_type','revision')->where('type','degree')->get()->sum('saved_lines');
                                    $is_verif = $is_verif / 15 ;
                                    $is_verif_new = $is_verif_new / 15 ;
                                    $is_verif_revision = $is_verif_revision / 15 ;

                                    // for remain
                                    $remain_new = 0;
                                    $remain_revision = 0;
                                    $stud_epos = \App\Models\Episode_student::whereIn('episode_id',$mogmaa_ids)->get();
                                    foreach ($stud_epos as $stud_row){
                                        $plan_new = \App\Models\Plan\Plan_new::where('sub_level_id',$stud_row->subject_level_id)->get()->count();
                                        $plan_revision = \App\Models\Plan\Plan_revision::where('sub_level_id',$stud_row->subject_level_id)->get()->count();

                                        $faces_required_new = $plan_new * $stud_row->Subject->amount_num ;
                                        $faces_required_revision = $plan_revision * $stud_row->Subject->amount_num ;

                                        $faces_required_new = $faces_required_new / 15 ;
                                    $faces_required_revision = $faces_required_revision / 15 ;
                                    $remain_new = $remain_new + $faces_required_new ;
                                    $remain_revision = $remain_revision + $faces_required_revision ;
                                    }

                                    $new_remain_new = $remain_new - $is_verif_new ;
                                    $new_remain_revision = $remain_revision - $is_verif_revision ;
                                    $total_remain = $new_remain_new + $new_remain_revision ;
                                @endphp
                                <td class="text-center"> {{ $is_verif_new}} </td>
                                <td class="text-center"> {{ $new_remain_new}} </td>
                                <td class="text-center"> {{ $is_verif_revision}} </td>
                                <td class="text-center"> {{ $new_remain_revision}} </td>
                                <td class="text-center"> {{ $is_verif}} </td>
                                <td class="text-center"> {{ $total_remain}} </td>
                                <td class="text-center">
                                    <a href="{{route('mogmaa.productive.episodes', $row->college_id)}}"
                                    class="btn btn-icon btn-primary btn-circle btn-sm mr-2">
                                        <i class="icon-nm fas fa-hourglass-half" aria-hidden='true'></i>
                                    </a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        @endforeach
                        </tbody>
                    </table>
                @endif
            </div>
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
