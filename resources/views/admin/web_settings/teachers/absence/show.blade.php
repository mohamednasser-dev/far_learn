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
                    <form action="{{route('absence.search.teacher')}}" method="get">

                        <div class="row">
                            <div class="col-lg-3"></div>
                            <div class="col-lg-4">
                                <div class="form-group row">
                                    <label class="col-3 col-form-label">{{trans('s_admin.absence_date')}}</label>
                                    <div class="col-9">
                                        <div class="input-group date">
                                            <input type="text" required name="absence_date" value="{{$selected_date}}"
                                                   class="form-control"
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
                                <button class="btn btn-success">{{trans('s_admin.search')}}</button>
                            </div>
                        </div>
                    </form>
                    <div class="form-group mb-7">
                        <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                            <thead>
                            <tr>
                                <th title="Field #1">{{trans('s_admin.name')}}</th>
                                {{--                                    <th title="Field #1">{{trans('s_admin.episode_name')}}</th>--}}
                                <th title="Field #2">{{trans('admin.job_name')}}</th>
                                <th title="Field #2">{{trans('s_admin.episode')}}</th>
                                <th title="Field #2">{{trans('s_admin.absence_or_attendance')}}</th>
                                <th title="Field #2">{{trans('s_admin.attendance_reason')}}</th>
                                <th title="Field #2">{{trans('s_admin.delete')}}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($data as $key => $row)
                                <tr>
                                    <td>
                                        @if(app()->getLocale() == 'ar')
                                            {{$row->Teacher->first_name_ar}} {{$row->Teacher->mid_name_ar}} {{$row->Teacher->last_name_ar}}
                                        @else
                                            {{$row->Teacher->first_name_en}} {{$row->Teacher->mid_name_en}} {{$row->Teacher->last_name_en}}
                                        @endif
                                    </td>
                                    <td>@if($row->Teacher->Job ) {{$row->Teacher->Job->name}} @else -- @endif</td>
                                    <td>
                                        @if($row->Episode)
                                            @if(app()->getLocale() == 'ar')
                                                {{ $row->Episode->name_ar }} @if($row->Episode->Mogmaa) ( {{$row->Episode->Mogmaa->name_ar}} )@endif
                                            @else
                                                {{ $row->Episode->name_en }} @if($row->Episode->Mogmaa) ( {{$row->Episode->Mogmaa->name_en}} )@endif

                                            @endif
                                        @endif
                                    </td>
                                    <td>
                                        @if($row->type == 'attendance')
                                            <a href="{{route('absence.update.teacher',$row->id)}}"
                                               class="btn btn-success font-weight-bold btn-pill mr-2">{{trans('s_admin.come')}}</a>
                                        @else
                                            <a href="{{route('absence.update.teacher',$row->id)}}"
                                               class="btn btn-danger font-weight-bold btn-pill mr-2">{{trans('s_admin.not_come')}}</a>
                                        @endif
                                    </td>
                                    <td>{{$row->reason}}</td>
                                    <td>
                                        <form method="get" id='delete-form-{{ $row->id }}'
                                              action="{{route('absence.destroy.teacher',$row->id)}}"
                                              style='display: none;'>
                                        {{csrf_field()}}
                                        <!-- {{method_field('delete')}} -->
                                        </form>
                                        <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                            {
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{ $row->id }}').submit();
                                            }else {
                                            event.preventDefault();
                                            }"
                                                class='btn btn-icon btn-danger btn-circle btn-sm mr-2' href=" "><i
                                                class="icon-nm fas fa-trash" aria-hidden='true'>
                                            </i>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach

                            @foreach($data_emp as $key => $row)
                                <tr>
                                    <td>{{$row->User->name}}</td>
                                    <td>@if($row->User->Role ) {{$row->User->Role->name}} @else -- @endif</td>
                                    <td></td>
                                    <td>
                                        @if($row->type == 'attendance')
                                            <a href="{{route('absence.update.user',$row->id)}}"
                                               class="btn btn-success font-weight-bold btn-pill mr-2">{{trans('s_admin.come')}}</a>
                                        @else
                                            <a href="{{route('absence.update.user',$row->id)}}"
                                               class="btn btn-danger font-weight-bold btn-pill mr-2">{{trans('s_admin.not_come')}}</a>
                                        @endif
                                    </td>
                                    <td>{{$row->reason}}</td>
                                    <td>
                                        <form method="get" id='delete-form-{{ $row->id }}'
                                              action="{{route('absence.destroy.user',$row->id)}}"
                                              style='display: none;'>
                                        {{csrf_field()}}
                                        <!-- {{method_field('delete')}} -->
                                        </form>
                                        <button onclick="if(confirm('{{trans('admin.deleteConfirmation')}}'))
                                            {
                                            event.preventDefault();
                                            document.getElementById('delete-form-{{ $row->id }}').submit();
                                            }else {
                                            event.preventDefault();
                                            }"
                                                class='btn btn-icon btn-danger btn-circle btn-sm mr-2' href=" "><i
                                                class="icon-nm fas fa-trash" aria-hidden='true'>
                                            </i>
                                        </button>
                                    </td>
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
