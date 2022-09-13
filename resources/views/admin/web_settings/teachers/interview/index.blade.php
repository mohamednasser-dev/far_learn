@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.new_teachers_interviews')}}</h5>
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
                                    <th title="Field #1">{{trans('s_admin.teacher_name')}}</th>
                                    <th title="Field #2">{{trans('s_admin.interview_date')}}</th>
                                    <th title="Field #2">{{trans('s_admin.interview_time')}}</th>
                                    <th title="Field #2">{{trans('s_admin.meeting_url')}}</th>
                                    <th title="Field #2">{{trans('s_admin.show_zoom_room')}}</th>
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
                                        <td> {{ $row->interview_date }} </td>
                                        <td> {{date('g:i a', strtotime($row->interview_time))}} </td>
                                        <td> {{ $row->join_url }} </td>
                                        <td>
                                            <a href="{{ route( 'interviews',$row->id ) }}"
                                                 class="btn btn-icon btn-primary btn-sm mr-2">
                                                <i class="icon-nm fas fa-eye" aria-hidden='true'></i>
                                            </a>
                                        </td>
                                        <td><form method="get" id='delete-form-{{ $row->id }}' action="{{route('teacher.destroy.interviews',$row->id)}}" style='display: none;'>
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
