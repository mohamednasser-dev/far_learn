@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
            @if($type == 'mogmaa')
                {{trans('s_admin.colleges')}}
            @else
                {{trans('s_admin.dorrs')}}
            @endif
        </h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.add_absence_attendance')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_teacher_shoan_settings')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-toolbar">
            </div>
        </div>
        <div class="card-body">
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th>#</th>
                    <th>{{trans('s_admin.dorr_name')}}</th>
                    <th>{{trans('s_admin.episodes_number')}}</th>
                    <th>{{trans('s_admin.episodes')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $row)
                    <tr>
                        <td> {{ $key + 1}} </td>
                        <td>
                            @if(app()->getLocale() == 'ar')
                                {{$row->name_ar}}
                            @else
                                {{$row->name_en}}
                            @endif
                        </td>
                        <td>{{count($row->Mogmaat)}}</td>
                        <td>
                            <a href="{{route('absence.college.teacher',['type'=>$type,'college_id'=>$row->id])}}"
                               class="btn btn-dark mr-2">{{trans('s_admin.episodes')}}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
