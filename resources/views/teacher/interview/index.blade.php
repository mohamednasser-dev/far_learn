@extends('teacher.teacher_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.interviews')}}</h5>
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
                                    <th title="Field #2">{{trans('s_admin.interview_date')}}</th>
                                    <th title="Field #2">{{trans('s_admin.interview_time')}}</th>
                                    <th title="Field #2">{{trans('s_admin.meeting_url')}}</th>
                                    <th title="Field #2">{{trans('s_admin.show_zoom_room')}}</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($data as $key => $row)
                                    <tr>
                                        <td> {{ $row->interview_date }} </td>
                                        <td> {{date('g:i a', strtotime($row->interview_time))}} </td>
                                        <td> {{ $row->join_url }} </td>
                                        <td>  <a href="{{route('teachers.zoom_room.interviews',$row->id)}}"
                                                 class="btn btn-icon btn-primary btn-sm mr-2">
                                                <i class="icon-nm fas fa-eye" aria-hidden='true'></i>
                                            </a>
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
