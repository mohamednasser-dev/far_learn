@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.teacher_absence_request')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_teacher_shoan_settings')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('styles')
    <style type="text/css">.asd {
            background: rgba(0, 0, 0, 0);
            border: none;
        }

        input[type=number]::-webkit-inner-spin-button,
        input[type=number]::-webkit-outer-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        .qty {
            width: 20%;
            border: none;
            text-align: center;
        }

        .qty-style {
            padding: 0px 8%;
            margin: 0px 7%;
            border-right: 2px solid #1bc5c9;
            border-left: 2px solid #1bc5c9;
        }

        input[type=number] {
            -moz-appearance: textfield;
        }
    </style>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <div class="form-group mb-7">
                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                            <thead>
                            <tr>
                                <th title="Field #1">#</th>
                                <th title="Field #1">{{trans('s_admin.teacher_name')}}</th>
                                <th title="Field #1">{{trans('s_admin.excuse')}}</th>
                                <th title="Field #2">{{trans('s_admin.request_status')}}</th>
                                <th title="Field #2">{{trans('s_admin.absence_date')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $row)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->Teacher->first_name_ar}} {{$row->Teacher->mid_name_ar}} {{$row->Teacher->last_name_ar}}
                                        @else
                                            {{$row->Teacher->first_name_en}} {{$row->Teacher->mid_name_en}} {{$row->Teacher->last_name_en}}
                                        @endif
                                    </td>
                                    <td> {{ $row->note }} </td>
                                    <td>
                                        <div class="btn-group">
                                            @if($row->status == 'default')
                                                <button type="button" class="btn btn-warning dropdown-toggle" data-toggle="dropdown"
                                                        aria-haspopup="true" aria-expanded="false">
                                                    {{trans('s_admin.new_request')}}
                                                </button>
                                                <div class="dropdown-menu">
                                                    <a class="dropdown-item"
                                                       href="{{route('teacher.absence.requests.change_status',['id'=>$row->id ,'status'=>'accepted'])}}">{{trans('s_admin.accept')}}</a>
                                                    <a class="dropdown-item"
                                                       href="{{route('teacher.absence.requests.change_status',['id'=>$row->id ,'status'=>'rejected'])}}">{{trans('s_admin.reject')}}</a>
                                                </div>
                                            @elseif($row->status == 'accepted')
                                                <span style="font-weight: bold;"
                                                      class="label label-outline-success label-pill label-inline mr-2"> {{trans('s_admin.accepted')}}</span>
                                            @elseif($row->status == 'rejected')
                                                <span style="font-weight: bold;"
                                                      class="label label-outline-danger label-pill label-inline mr-2"> {{trans('s_admin.rejected')}}</span>
                                            @endif
                                        </div>
                                    </td>
                                    <td> {{ $row->request_date }} </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
