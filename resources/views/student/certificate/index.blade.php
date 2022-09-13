@extends('student.student_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_certifcates')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <!--begin::Card-->
    <div class="card card-custom">
        <div class="card-body">
            <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                <thead>
                <tr>
                    <th title="Field #1">#</th>
                    <th title="Field #1">{{trans('s_admin.certificate')}}</th>
                    <th title="Field #2">{{trans('s_admin.episode_name')}}</th>
                    <th title="Field #2">{{trans('s_admin.creation_date')}}</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $key => $row)
                    <tr>
                        <td>{{$key + 1}}</td>
                        <td><img style="width: 100px;" src="{{$row->image}}">
                            <a title="{{trans('s_admin.download_image')}}" target="_blank" href="{{route('certificate.download',$row->id)}}" class="btn btn-icon btn-light-twitter mr-2">
                                <i class="flaticon2-arrow-down"></i>
                            </a>
                            <a title="{{trans('s_admin.download_image_cert')}}" download="{{$row->image}}"
                               href="{{$row->image}}" class="btn btn-icon btn-light-twitter mr-2">
                                <i class="flaticon2-photograph"></i>
                            </a>
                        </td>
                        <td> @if(app()->getLocale() == 'ar' ){{$row->Episode->name_ar}} @else {{$row->Episode->name_en}} @endif </td>
                        <td>{{$row->created_at->format('Y-m-d')}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
