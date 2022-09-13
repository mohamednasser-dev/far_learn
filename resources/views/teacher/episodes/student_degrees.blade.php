@extends('teacher.teacher_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.epo_degrees')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{ URL::previous() }}" class="text-muted">{{trans('s_admin.want_num')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('t_episodes.index')}}" class="text-muted">{{trans('s_admin.nav_table_hlka')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-header flex-wrap border-0 pt-6 pb-0">
            <div class="card-title">
            </div>
        </div>
        <div class="card-body">
            <!--begin: Search Form-->
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
            <!--end::Search Form-->
            <!--end: Search Form-->
            <!--begin: Datatable-->
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">{{trans('s_admin.day')}}</th>
                    <th title="Field #1">{{trans('s_admin.degree')}}</th>
                    <th title="Field #1">{{trans('s_admin.lisen_type')}}</th>
                    <th title="Field #1">{{trans('s_admin.surah')}}</th>
                    <th title="Field #1">{{trans('s_admin.from')}}</th>
                    <th title="Field #1">{{trans('s_admin.surah')}}</th>
                    <th title="Field #1">{{trans('s_admin.to')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>{{date('Y-m-d', strtotime($row->created_at))}}</td>
                        <td>
                            @if($row->degree == 'absence')
                                {{trans('s_admin.abs')}}
                            @elseif($row->degree == 'good')
                                {{trans('s_admin.good')}}
                            @elseif($row->degree == 'very_good')
                                {{trans('s_admin.very_good')}}
                            @elseif($row->degree == 'excellent')
                                {{trans('s_admin.excellent')}}
                            @elseif($row->degree == 'not_pathing')
                                {{trans('s_admin.not_pathing')}}
                            @endif
                            @if($row->type == 'ask')
                                @if(app()->getLocale() == 'ar')
                                    {{$row->Ask_degree->name_ar}}
                                @else
                                    {{$row->Ask_degree->name_en}}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($row->type == 'ask')
                                {{trans('s_admin.ask')}}
                            @else
                                @if($row->type != 'absence')
                                    @if($row->plan_type == 'new')
                                        {{trans('s_admin.the_new')}}
                                    @elseif($row->plan_type == 'tracomy')
                                        {{trans('s_admin.the_tracomy')}}
                                    @elseif($row->plan_type == 'revision')
                                        {{trans('s_admin.revision')}}
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($row->type == 'ask')
                                @if(app()->getLocale() == 'ar')
                                    {{$row->Ask->From_Surah->name_ar}}
                                @else
                                    {{$row->Ask->From_Surah->name_en}}
                                @endif
                            @else
                                @if($row->plan_type == 'new')
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Plan_new->From_Surah->name_ar}}
                                    @else
                                        {{$row->Plan_new->From_Surah->name_en}}
                                    @endif
                                @elseif($row->plan_type == 'tracomy')
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Plan_tracomy->From_Surah->name_ar}}
                                    @else
                                        {{$row->Plan_tracomy->From_Surah->name_en}}
                                    @endif
                                @elseif($row->plan_type == 'revision')
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Plan_revision->From_Surah->name_ar}}
                                    @else
                                        {{$row->Plan_revision->From_Surah->name_en}}
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($row->type == 'ask')
                                {{$row->Ask->from_num}}
                            @else
                                @if($row->plan_type == 'new')
                                    {{$row->Plan_new->from_num}}
                                @elseif($row->plan_type == 'tracomy')
                                    {{$row->Plan_tracomy->from_num}}
                                @elseif($row->plan_type == 'revision')
                                    {{$row->Plan_revision->from_num}}
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($row->type == 'ask')
                                @if(app()->getLocale() == 'ar')
                                    {{$row->Ask->To_Surah->name_ar}}
                                @else
                                    {{$row->Ask->To_Surah->name_en}}
                                @endif
                            @else
                                @if($row->plan_type == 'new')
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Plan_new->To_Surah->name_ar}}
                                    @else
                                        {{$row->Plan_new->To_Surah->name_en}}
                                    @endif
                                @elseif($row->plan_type == 'tracomy')
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Plan_tracomy->To_Surah->name_ar}}
                                    @else
                                        {{$row->Plan_tracomy->To_Surah->name_en}}
                                    @endif
                                @elseif($row->plan_type == 'revision')
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Plan_revision->To_Surah->name_ar}}
                                    @else
                                        {{$row->Plan_revision->To_Surah->name_en}}
                                    @endif
                                @endif
                            @endif
                        </td>
                        <td>
                            @if($row->type == 'ask')
                                {{$row->Ask->to_num}}
                            @else
                                @if($row->plan_type == 'new')
                                    {{$row->Plan_new->to_num}}
                                @elseif($row->plan_type == 'tracomy')
                                    {{$row->Plan_tracomy->to_num}}
                                @elseif($row->plan_type == 'revision')
                                    {{$row->Plan_revision->to_num}}
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
