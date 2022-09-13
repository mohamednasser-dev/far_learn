@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_join_orders')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <div class="card card-custom">
        <!--begin::Header-->
        <div class="card-header card-header-tabs-line">
            <ul class="nav nav-dark nav-bold nav-tabs nav-tabs-line" data-remember-tab="tab_id" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active" data-toggle="tab"
                       href="#kt_builder_themes">{{trans('s_admin.current_requests')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" data-toggle="tab" href="#kt_builder_page">{{trans('s_admin.rejected_requests')}}</a>
                </li>
            </ul>
        </div>
        <div class="card-body">
            <div class="tab-content pt-3">
                <!--begin::Tab Pane-->
                <div class="tab-pane active" id="kt_builder_themes">
                    <!--begin: Datatable-->
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th title="Field #1">#</th>
                            <th title="Field #1">{{trans('s_admin.episode_name')}}</th>
                            <th title="Field #1">{{trans('s_admin.student_name')}}</th>
                            <th title="Field #1">{{trans('s_admin.request_date')}}</th>
                            <th title="Field #1">{{trans('s_admin.request_status')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($data as $key => $row)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Episode->name_ar}}
                                    @else
                                        {{$row->Episode->name_en}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('student.details',['type' => 'far_learn' , 'id' => $row->student_id])}}" >
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->Student->first_name_ar}} {{$row->Student->mid_name_ar}} {{$row->Student->last_name_ar}}
                                        @else
                                            {{$row->Student->first_name_en}} {{$row->Student->mid_name_en}} {{$row->Student->last_name_en}}
                                        @endif
                                    </a>
                                </td>
                                <td>{{$row->created_at->format('Y-m-d')}}</td>
                                <td>
                                    <div class="btn-group">
                                        @if($row->status == 'new')
                                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{trans('s_admin.new')}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('far_learn.change_status',['type'=>'accepted','id'=>$row->id])}}">{{trans('s_admin.accept')}}</a>
                                                <a class="dropdown-item" href="{{route('far_learn.change_status',['type'=>'rejected','id'=>$row->id])}}">{{trans('s_admin.reject')}}</a>
                                            </div>
                                        @elseif($row->status == 'accepted')
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{trans('s_admin.accepted')}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('far_learn.change_status',['type'=>'rejected','id'=>$row->id])}}">{{trans('s_admin.reject')}}</a>
                                            </div>
                                        @elseif($row->status == 'rejected')
                                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{trans('s_admin.rejected')}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('far_learn.change_status',['type'=>'accepted','id'=>$row->id])}}">{{trans('s_admin.accept')}}</a>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <!--end: Datatable-->
                </div>
                <!--end::Tab Pane-->
                <!--begin::Tab Pane-->
                <div class="tab-pane" id="kt_builder_page">
                    <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                        <thead>
                        <tr>
                            <th title="Field #1">#</th>
                            <th title="Field #1">{{trans('s_admin.episode_name')}}</th>
                            <th title="Field #1">{{trans('s_admin.student_name')}}</th>
                            <th title="Field #1">{{trans('s_admin.request_date')}}</th>
                            <th title="Field #1">{{trans('s_admin.request_status')}}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($reject_data as $key => $row)
                            <tr>
                                <td>{{$key + 1}}</td>
                                <td>
                                    @if(app()->getLocale() == 'ar')
                                        {{$row->Episode->name_ar}}
                                    @else
                                        {{$row->Episode->name_en}}
                                    @endif
                                </td>
                                <td>
                                    <a href="{{route('student.details',['type' => 'far_learn' , 'id' => $row->student_id])}}" >
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->Student->first_name_ar}} {{$row->Student->mid_name_ar}} {{$row->Student->last_name_ar}}
                                        @else
                                            {{$row->Student->first_name_en}} {{$row->Student->mid_name_en}} {{$row->Student->last_name_en}}
                                        @endif
                                    </a>
                                </td>
                                <td>{{$row->created_at->format('Y-m-d')}}</td>
                                <td>
                                    <div class="btn-group">
                                        @if($row->status == 'new')
                                            <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{trans('s_admin.new')}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('far_learn.change_status',['type'=>'accepted','id'=>$row->id])}}">{{trans('s_admin.accept')}}</a>
                                                <a class="dropdown-item" href="{{route('far_learn.change_status',['type'=>'rejected','id'=>$row->id])}}">{{trans('s_admin.reject')}}</a>
                                            </div>
                                        @elseif($row->status == 'accepted')
                                            <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{trans('s_admin.accepted')}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('far_learn.change_status',['type'=>'rejected','id'=>$row->id])}}">{{trans('s_admin.reject')}}</a>
                                            </div>
                                        @elseif($row->status == 'rejected')
                                            <button type="button" class="btn btn-danger dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                {{trans('s_admin.rejected')}}
                                            </button>
                                            <div class="dropdown-menu">
                                                <a class="dropdown-item" href="{{route('far_learn.change_status',['type'=>'accepted','id'=>$row->id])}}">{{trans('s_admin.accept')}}</a>
                                            </div>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>





@endsection
