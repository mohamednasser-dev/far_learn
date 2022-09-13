@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.episode')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('t_episodes.index')}}" class="text-muted">{{trans('s_admin.nav_table_hlka')}}</a>
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
                    <form action="{{route('teacher.store.absence')}}" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{trans('s_admin.absence_date')}}</label>
                                    <div class="col-9">
                                        <div class="input-group date">
                                            <input type="text" required name="absence_date" value="{{\Carbon\Carbon::now()->format('m/d/Y')}}" class="form-control"
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
                                <button class="btn btn-success">{{trans('s_admin.save_today_absence')}}</button>
                            </div>
                        </div>

                        <div class="form-group mb-7">
                            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                                <thead>
                                <tr>
                                    <th title="Field #1">#</th>
                                    <th title="Field #1">{{trans('s_admin.teacher_name')}}</th>
                                    <th title="Field #2">{{trans('admin.job_name')}}</th>
                                    <th title="Field #2">{{trans('s_admin.absence')}}</th>
                                    <th title="Field #2">{{trans('s_admin.attendance')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $row)
                                    <tr>
                                        <td>{{$key + 1}}</td>
                                        <td>
                                            @if(app()->getLocale() == 'ar')
                                                {{$row->first_name_ar}} {{$row->mid_name_ar}} {{$row->last_name_ar}}
                                            @else
                                                {{$row->first_name_en}} {{$row->mid_name_en}} {{$row->last_name_en}}
                                            @endif
                                        </td>
                                        <td> @if($row->Job ) {{$row->Job->name}} @else -- @endif </td>
                                        <td>
                                            <div class="checkbox-inline">
                                                <label class="checkbox checkbox-outline checkbox-danger">
                                                    {{--                                                        <input type="checkbox" value="{{$row->id}}" @if($exist_absence != null) checked  @endif id="cmb_student" name="student_absence">--}}
                                                    <input type="checkbox" value="{{$row->id}}" name="teacher_ids_absence[]">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="checkbox-inline">
                                                <label class="checkbox checkbox-outline checkbox-success">
                                                    {{--                                                        <input type="checkbox" value="{{$row->id}}" @if($exist_absence != null) checked  @endif id="cmb_student" name="student_absence">--}}
                                                    <input type="checkbox" value="{{$row->id}}" name="teacher_ids_attendance[]">
                                                    <span></span>
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
