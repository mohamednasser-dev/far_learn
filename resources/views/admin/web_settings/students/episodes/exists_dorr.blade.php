@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">

            @if($type == 'mogmaa' || $type == 'college')
                {{trans('s_admin.colleges')}}
            @else
                {{trans('s_admin.dorrs')}}
            @endif
        </h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

            <li class="breadcrumb-item">
                <a href="{{route('student.details',['type' => $student->epo_type , 'id' => $student->id])}}" class="text-muted">{{trans('s_admin.details')}}</a>
            </li>
            <li class="breadcrumb-item">
                @if($student->epo_type == 'far_learn')
                    <a href="{{url('/student_settings/far_learn')}}" class="text-muted">
                        {{trans('s_admin.far_learn_students')}}
                    </a>
                @elseif($student->epo_type == 'mogmaa')
                    <a href="{{url('/student_settings/mogmaa')}}" class="text-muted">
                        {{trans('s_admin.mogmaa_students')}}
                    </a>
                @elseif($student->epo_type == 'dorr')
                    <a href="{{url('/student_settings/dorr')}}" class="text-muted">
                        {{trans('s_admin.dorr_students')}}
                    </a>
                @else
                    <a href="{{url('/student_settings')}}" class="text-muted">
                        {{trans('s_admin.nav_student_shoan_settings')}}
                    </a>
                @endif
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.manage_students')}}</a>
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
                            <a href="{{route('student.get.episode',['type'=>$row->id,'student_id'=>$student->id])}}"
                               class="btn btn-dark mr-2">{{trans('s_admin.episodes')}}</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
