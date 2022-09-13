@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
            @if(request()->segment(2) == 'far_learn')
                {{trans('s_admin.far_learn_students')}}
            @elseif(request()->segment(2) == 'mogmaa')
                {{trans('s_admin.mogmaa_students')}}
            @elseif(request()->segment(2) == 'dorr')
                {{trans('s_admin.dorr_students')}}
            @else
                {{trans('s_admin.nav_student_shoan_settings')}}
            @endif
        </h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.manage_students')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-body">
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
                    <th title="Field #2" style="width: 5%">{{trans('s_admin.image')}}</th>
                    <th title="Field #2">{{trans('s_admin.name')}}</th>
                    <th title="Field #3">{{trans('s_admin.email')}}</th>
                    <th title="Field #3">{{trans('s_admin.Attendance_num')}}</th>
                    <th title="Field #8">{{trans('s_admin.absence_num')}}</th>
                </tr>
                </thead>
                <tbody>
                <?php $i = 1; ?>
                @foreach($data as $key => $row)
                    <tr>
                        <td>{{$key + 1}}</td>
                        @if($row->image != null)
                            <td class="text-center" style="width: 5%">
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
                            <td class="text-center">
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
                            @if(app()->getLocale() == 'ar')
                                {{$row->first_name_ar}} {{$row->mid_name_ar}}
                            @else
                                {{$row->first_name_en}} {{$row->mid_name_en}}
                            @endif
                        </td>
                        <td class="text-center">{{$row->email}}</td>
                        <td class="text-center">
                            {{count($row->Attendance)}}
                        </td>
                        <td class="text-center">
                            {{count($row->Absence)}}
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

