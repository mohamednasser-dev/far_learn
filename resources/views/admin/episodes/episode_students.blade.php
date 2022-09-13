@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.episode_students')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                @if($episode->type == 'mqraa')
                <a href="{{route('episode.show.type','mqraa')}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
                @elseif($episode->type == 'mogmaa')
                    <a href="{{route('colleges.show',$episode->college_id)}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
                @elseif($episode->type == 'mogmaa')
                    <a href="{{route('dorr.show',$episode->college_id)}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
                @endif
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
                    <th title="Field #1">{{trans('s_admin.student_name')}}</th>
                    <th title="Field #2">{{trans('s_admin.degrees')}}</th>
                    <th title="Field #2">{{trans('s_admin.certificate')}}</th>
                    <th title="Field #2">{{trans('s_admin.delete')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $row)
                    <tr>
                        <td>
                            @if(app()->getLocale() == 'ar')
                                {{$row->Student->first_name_ar}} {{$row->Student->mid_name_ar}} {{$row->Student->last_name_ar}}
                            @else
                                {{$row->Student->first_name_en}} {{$row->Student->mid_name_en}} {{$row->Student->last_name_en}}
                            @endif
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('student.degrees',['stud_id'=>$row->student_id,'epo_id'=>$row->episode_id])}}" class="btn btn-primary btn-circle">
                                {{trans('s_admin.show')}}
                            </a>
                        </td>
                        <td style="text-align: center">
                            <a href="{{route('certificates.create',['student_id'=>$row->student_id,'episode_id'=>$row->episode_id])}}" class="btn btn-primary btn-circle">
                                {{trans('s_admin.create_certificate')}}
                            </a>
                        </td>
                        <td style="text-align: center">
                            <a onclick="return confirm('{{trans('s_admin.are_y_sure_delete')}}')"
                               href="{{route('episode_students.delete',$row->id)}}"
                               class="btn btn-icon btn-danger btn-circle btn-sm mr-2">
                                <i class="icon-nm fas fa-trash" aria-hidden='true'></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
