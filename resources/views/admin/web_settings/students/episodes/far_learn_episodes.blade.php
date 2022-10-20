@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
            {{trans('s_admin.episodes')}}
        </h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

            <li class="breadcrumb-item">
                <a href="{{route('student.details',['type' => $student->epo_type , 'id' => $student->id])}}" class="text-muted">{{trans('s_admin.student_info')}}</a>
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
                    <th>{{trans('s_admin.episode_name')}}</th>
                    @if($student->gender == 'male')
                        <th>{{trans('s_admin.teacher_name')}}</th>
                    @else
                        <th>{{trans('s_admin.teacher_name_her')}}</th>
                    @endif
                    <th>{{trans('s_admin.place_student')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $row)
                    @if($row->student_number <= count($row->Students))
                    @else
                        @php $exist_epo = \App\Models\Episode_student::where('student_id',$student->id)->where('episode_id',$row->id)->first(); @endphp
                            <tr>
                                <td> {{ $key + 1}} </td>
                                <td>
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->name_ar}}
                                    @else
                                        {{$row->name_en}}
                                    @endif
                                </td>
                                <td>
                                    @if($row->Teacher)
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Teacher->first_name_ar}} &nbsp;  {{$row->Teacher->mid_name_ar}} &nbsp;  {{$row->Teacher->last_name_ar}}
                                    @else
                                        {{$row->Teacher->first_name_en}} &nbsp;  {{$row->Teacher->mid_name_en}} &nbsp;  {{$row->Teacher->last_name_en}}
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    @if($exist_epo == null)
                                    <a href="{{route('place.selected.student',[ 'student_id' => $student->id , 'episode_id' => $row->id ])}}"
                                       class="btn btn-icon {{auth()->user()->button_color}} btn-circle btn-sm mr-2">
                                        <i class="icon-nm fas fa-plus" aria-hidden='true'></i>
                                    </a>
                                    @else
                                        {{trans('s_admin.episode_exists_to_student')}}
                                    @endif
                                </td>
                            </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
