@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
            <li class="breadcrumb-item">
            {{trans('s_admin.episode_teachers')}}
        </h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">
                    @if($type == 'mqraa')
                        {{trans('s_admin.episode_mqraa')}}
                    @elseif($type == 'mogmaa')
                        {{trans('s_admin.nav_mogmaa_epo')}}
                    @elseif($type == 'dorr')
                        {{trans('s_admin.nav_dorr_epo')}}
                    @endif
                </a>
            </li>
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
        </div>
        <form action="{{route('teacher.store.absence')}}" method="post">
            @csrf
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-3"></div>
                    <div class="col-lg-4">
                        <div class="form-group row">
                            <label class="col-3 col-form-label">{{trans('s_admin.absence_date')}}</label>
                            <div class="col-9">
                                <div class="input-group date">
                                    <input type="text" required name="absence_date"
                                           value="{{\Carbon\Carbon::now()->format('m/d/Y')}}" class="form-control"
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
                        <button class="btn btn-success">{{trans('s_admin.save')}}</button>
                    </div>
                </div>
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                    <thead>
                    <tr>
                        <th>{{trans('s_admin.employee_name')}}</th>
                        <th>{{trans('s_admin.nav_job_name')}}</th>
                        <th>{{trans('s_admin.episode')}}</th>
                        <th>{{trans('s_admin.name_mogmaa_dorr')}}</th>
                        <th>{{trans('s_admin.work_place')}}</th>
                        <th>{{trans('s_admin.attendance_status')}}</th>
                        <th>{{trans('s_admin.attendance_reason')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($basic_teacher as $key => $row)
                        <tr>
                            <td>
                                @if(app()->getLocale() == 'ar')
                                    {{$row->first_name_ar}} &nbsp;  {{$row->mid_name_ar}}
                                    &nbsp;  {{$row->last_name_ar}}
                                @else
                                    {{$row->first_name_en}} &nbsp;  {{$row->Teacher->mid_name_en}}
                                    &nbsp;  {{$row->last_name_en}}
                                @endif
                            </td>
                            <td>{{trans('s_admin.basic_teacher')}}</td>
                            <td>
                                <select name="episode_id[]" class="form-control form-control-lg" id="exampleSelectl">
                                    @inject('episodes', 'App\Models\Episode')
                                    @if(auth()->user()->role_id == 2 ||auth()->user()->role_id == 6 ||auth()->user()->role_id == 7 ||auth()->user()->role_id == 8)
                                        @php $episodes = $episodes->where('deleted','0')->where('type',$type)->where('teacher_id',$row->id)->get(); @endphp
                                    @else
                                        @php $episodes = $episodes->where('deleted','0')->where('type',$type)->where('college_id',auth()->user()->college_id)->where('teacher_id',$row->id)->get(); @endphp
                                    @endif
                                    @if($episodes->count() != 0)
                                        @foreach($episodes as $row_episode)
                                            @if(app()->getLocale() == 'ar')
                                                <option value="{{$row_episode->id}}">{{$row_episode->name_ar}} @if($row_episode->Mogmaa)( {{$row_episode->Mogmaa->name_ar}} ) @endif </option>
                                            @else
                                                <option value="{{$row_episode->id}}">{{$row_episode->name_en}} @if($row_episode->Mogmaa)( {{$row_episode->Mogmaa->name_en}} ) @endif </option>
                                            @endif
                                        @endforeach
                                    @else
                                        <option value="0">{{trans('s_admin.no_episodes')}}</option>
                                    @endif
                                </select>
                            </td>
                            <td></td>
                            <td></td>
                            <input type="hidden" name="target_id[]" value="{{$row->id}}">
                            <input type="hidden" name="employee_type[]" value="teacher">

                            <td>
                                <select name="type[]" class="form-control form-control-lg" id="exampleSelectl">
                                    <option value="attendance">{{trans('s_admin.come')}}</option>
                                    <option value="absence">{{trans('s_admin.not_come')}}</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="reason[]" class="form-control form-control-lg">
                            </td>
                        </tr>
                    @endforeach
                    @foreach($additional_teachers as $key => $row)
                        <tr>
                            <td>
                                @if(app()->getLocale() == 'ar')
                                    {{$row->Teacher->first_name_ar}} &nbsp;  {{$row->Teacher->mid_name_ar}}
                                    &nbsp;  {{$row->Teacher->last_name_ar}}
                                @else
                                    {{$row->Teacher->first_name_en}} &nbsp;  {{$row->Teacher->mid_name_en}}
                                    &nbsp;  {{$row->Teacher->last_name_en}}
                                @endif
                            </td>
                            <td>{{trans('s_admin.additional_teacher')}}</td>
                            <td>
                                <select name="episode_id[]" class="form-control form-control-lg" id="exampleSelectl">
                                    @inject('episodes_teacher', 'App\Models\Episode_teacher')
                                    @php
                                        $teacher_episodes_ids = $episodes_teacher->where('teacher_id',$row->teacher_id)->get()->pluck('episode_id')->toArray();
                                        if(auth()->user()->role_id == 2 ||auth()->user()->role_id == 6 ||auth()->user()->role_id == 7 ||auth()->user()->role_id == 8){
                                            $episodes = \App\Models\Episode::where('deleted','0')->where('type',$type)->whereIn('id',$teacher_episodes_ids)->get();
                                        }else{
                                            $episodes = \App\Models\Episode::where('deleted','0')->where('type',$type)->whereIn('id',$teacher_episodes_ids)->where('college_id',auth()->user()->college_id)->get();
                                        }

                                    @endphp
                                    @if($episodes->count() != 0)
                                        @foreach($episodes as $row_episode)
                                            @if(app()->getLocale() == 'ar')
                                            <option value="{{$row_episode->id}}">{{$row_episode->name_ar}}  ( {{$row_episode->Mogmaa->name_ar}} )</option>
                                            @else
                                                <option value="{{$row_episode->id}}">{{$row_episode->name_en}}  ( {{$row_episode->Mogmaa->name_en}} )</option>

                                            @endif
                                        @endforeach
                                    @else
                                        <option value="0">{{trans('s_admin.no_episodes')}}</option>
                                    @endif
                                </select>
                            </td>
                            <td></td>
                            <td></td>
                            <input type="hidden" name="target_id[]" value="{{$row->teacher_id}}">
                            <input type="hidden" name="employee_type[]" value="teacher">
                            <td>
                                <select required name="type[]" class="form-control form-control-lg"
                                        id="exampleSelectl">
                                    <option value="attendance">{{trans('s_admin.come')}}</option>
                                    <option value="absence">{{trans('s_admin.not_come')}}</option>
                                </select>
                            </td>
                            <td>
                                <input type="text" name="reason[]" class="form-control form-control-lg">
                            </td>
                        </tr>
                    @endforeach
                    @if($employees != null)
                        @foreach($employees as $key => $row)
                            <tr>
                                <td> {{$row->name}}</td>
                                <td>{{$row->Role->name}}</td>
                                <td>
                                    <input type="hidden" name="episode_id[]" value="0">
                                </td>
                                <td>
                                    @if($row->College)
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->College->name_ar}}
                                        @else
                                            {{$row->College->name_en}}
                                        @endif
                                    @endif
                                </td>
                                <td>{{$row->work_place}}</td>
                                <input type="hidden" name="target_id[]" value="{{$row->id}}">
                                <input type="hidden" name="employee_type[]" value="user">
                                <td>
                                    <select name="type[]" class="form-control form-control-lg" id="exampleSelectl">
                                        <option value="attendance">{{trans('s_admin.come')}}</option>
                                        <option value="absence">{{trans('s_admin.not_come')}}</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="reason[]" class="form-control form-control-lg">
                                </td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
            </div>
        </form>
    </div>
@endsection
