@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
            <li class="breadcrumb-item">
                @if($type == 'mqraa')
                    {{trans('s_admin.episode_mqraa')}}
                @elseif($type == 'mogmaa')
                    {{trans('s_admin.nav_mogmaa_epo')}}
                @elseif($type == 'dorr')
                    {{trans('s_admin.nav_dorr_epo')}}
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
                    <th>{{trans('s_admin.episode_name')}}</th>
                    <th>{{trans('s_admin.epo_gender')}}</th>
                    <th>{{trans('s_admin.episode_teachers')}}</th>
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
                                <td>
                                    @if($row->gender == 'male')
                                        {{trans('s_admin.males')}}
                                    @elseif($row->gender == 'female')
                                        {{trans('s_admin.females')}}
                                    @else
                                        {{trans('admin.children')}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('episode.teachers',['id'=>$row->id ,'type'=>$type])}}"
                                       class="btn btn-icon btn-success btn-circle btn-sm mr-2">
                                        <i class="icon-nm fas fa-eye" aria-hidden='true'></i>
                                    </a>
                                </td>
                            </tr>

                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
