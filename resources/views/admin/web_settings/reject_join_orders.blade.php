@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        @if(request()->segment(2) == 'teachers_rejected')
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.rejected_teacher')}}</h5>
        @elseif(request()->segment(2) == 'students_rejected')
            <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.rejected_students')}}</h5>
        @endif
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">
                    @if(request()->segment(2) == 'teachers_rejected')
                        {{trans('s_admin.nav_teacher_shoan_settings')}}
                    @else
                        {{trans('s_admin.manage_students')}}
                    @endif
                </a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    @if(request()->segment(2) == 'teachers_rejected')
        <!--begin::Card-->
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h4>{{trans('s_admin.rejected_teacher')}}</h4>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable">
                    <thead>
                    <tr>
                        <th title="Field #1">#</th>
                        <th title="Field #2">{{trans('s_admin.image')}}</th>
                        <th title="Field #2" style="width: 10%">{{trans('s_admin.name')}}</th>
                        <th title="Field #2" style="width: 10%">{{trans('s_admin.email')}}</th>
                        <th title="Field #6">{{trans('s_admin.phone')}}</th>
                        <th title="Field #6">{{trans('s_admin.my_requests')}}</th>
                        <th title="Field #7">{{trans('s_admin.details')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($teacher_data as $keyfrt => $row)
                        <tr>
                            <td>{{$keyfrt + 1}}</td>
                            @if($row->image != null)
                                <td class="text-center">
                            <span style="width: 250px;">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                        <img class="" src="{{$row->image}}" alt="photo">
                                    </div>
                                </div>
                            </span>
                                </td>
                            @else
                                <td class="text-center">
                                <span style="width: 250px;">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-light-danger flex-shrink-0">
                                            <span
                                                class="symbol-label font-size-h4 font-weight-bold">{{$row->first_name_en[0]}}</span>
                                        </div>
                                    </div>
                                </span>
                                </td>
                            @endif
                            <td class="text-center">
                                @if(app()->getLocale() == 'ar')
                                    {{$row->first_name_ar}} {{$row->mid_name_ar}}
                                @else
                                    {{$row->first_name_en}} {{$row->mid_name_en}}
                                @endif
                            </td>
                            <td class="text-center">{{$row->email}}</td>
                            <td class="text-center">{{$row->phone}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    @if($row->is_new == 'y')
                                        <button type="button" class="btn btn-warning dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{trans('s_admin.new')}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                               href="{{route('teacher.accept',$row->id)}}">{{trans('s_admin.accept')}}</a>
                                            <a class="dropdown-item"
                                               href="{{route('teacher.reject',$row->id)}}">{{trans('s_admin.reject')}}</a>
                                        </div>
                                    @elseif($row->is_new == 'accepted')
                                        <button type="button" class="btn {{auth()->user()->button_color}} dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{trans('s_admin.accepted')}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                               href="{{route('teacher.reject',$row->id)}}">{{trans('s_admin.reject')}}</a>
                                        </div>
                                    @elseif($row->is_new == 'rejected')
                                        <button type="button" class="btn btn-danger dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{trans('s_admin.rejected')}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                               href="{{route('teacher.accept',$row->id)}}">{{trans('s_admin.accept')}}</a>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{route('teacher_info', $row->id)}}"
                                   class="btn btn-icon btn-warning btn-circle btn-sm mr-2">
                                    <i class="icon-md fas fa-eye" aria-hidden='true'></i>
                                </a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                    </tbody>
                </table>
            {{$teacher_data->links()}}
            <!--end: Datatable-->
            </div>
        </div>
    @elseif(request()->segment(2) == 'students_rejected')
        <div class="card card-custom">
            <div class="card-header flex-wrap border-0 pt-6 pb-0">
                <div class="card-title">
                    <h4>{{trans('s_admin.rejected_students')}}</h4>
                </div>
            </div>
            <div class="card-body">
                <table class="table table-bordered table-hover table-checkable" id="kt_datatable2">
                    <thead>
                    <tr>
                        <th title="Field #1">#</th>
                        <th title="Field #2">{{trans('s_admin.image')}}</th>
                        <th title="Field #2" style="width: 10%">{{trans('s_admin.name')}}</th>
                        <th title="Field #2" style="width: 10%">{{trans('s_admin.email')}}</th>
                        <th title="Field #6">{{trans('s_admin.phone')}}</th>
                        <th title="Field #6">{{trans('s_admin.my_requests')}}</th>
                        <th title="Field #7">{{trans('s_admin.details')}}</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach($student_data as $key => $row)
                        <tr>
                            <td>{{$key + 1}}</td>
                            @if($row->image != null)
                                <td class="text-center">
                            <span style="width: 250px;">
                                <div class="d-flex align-items-center">
                                    <div class="symbol symbol-40 symbol-sm flex-shrink-0">
                                        <img class="" src="{{url('/')}}/uploads/students/{{$row->image}}" alt="photo">
                                    </div>
                                </div>
                            </span>
                                </td>
                            @else
                                <td class="text-center">
                                <span style="width: 250px;">
                                    <div class="d-flex align-items-center">
                                        <div class="symbol symbol-40 symbol-light-danger flex-shrink-0">
                                            <span
                                                class="symbol-label font-size-h4 font-weight-bold">{{$row->first_name_en[0]}}</span>
                                        </div>
                                    </div>
                                </span>
                                </td>
                            @endif
                            <td class="text-center">
                                @if(app()->getLocale() == 'ar')
                                    {{$row->first_name_ar}} {{$row->mid_name_ar}}
                                @else
                                    {{$row->first_name_en}} {{$row->mid_name_en}}
                                @endif
                            </td>
                            <td class="text-center">{{$row->email}}</td>
                            <td class="text-center">{{$row->phone}}</td>
                            <td class="text-center">
                                <div class="btn-group">
                                    @if($row->is_new == 'y')
                                        <button type="button" class="btn btn-warning dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{trans('s_admin.new')}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                               href="{{route('student.accept',$row->id)}}">{{trans('s_admin.accept')}}</a>
                                            <a class="dropdown-item"
                                               href="{{route('student.reject',$row->id)}}">{{trans('s_admin.reject')}}</a>
                                        </div>
                                    @elseif($row->is_new == 'accepted')
                                        <button type="button" class="btn {{auth()->user()->button_color}} dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{trans('s_admin.accepted')}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                               href="{{route('student.reject',$row->id)}}">{{trans('s_admin.reject')}}</a>
                                        </div>
                                    @elseif($row->is_new == 'rejected')
                                        <button type="button" class="btn btn-danger dropdown-toggle"
                                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            {{trans('s_admin.rejected')}}
                                        </button>
                                        <div class="dropdown-menu">
                                            <a class="dropdown-item"
                                               href="{{route('student.accept',$row->id)}}">{{trans('s_admin.accept')}}</a>
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                                <a href="{{route('student.details',['type' => request()->segment(2) , 'id' => $row->id])}}"
                                   class="btn btn-icon btn-warning btn-circle btn-sm mr-2">
                                    <i class="icon-md fas fa-eye" aria-hidden='true'></i>
                                </a>
                            </td>
                        </tr>
                        <?php $i++; ?>
                    @endforeach
                    </tbody>
                </table>
            {{$student_data->links()}}
            <!--end: Datatable-->
            </div>
        </div>
    @endif
@endsection

@section('scripts')
    <script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
    <!--begin::Global Config(global config for global JS scripts)-->
    <script>var KTAppSettings = {
            "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400},
            "colors": {
                "theme": {
                    "base": {
                        "white": "#ffffff",
                        "primary": "#3699FF",
                        "secondary": "#E5EAEE",
                        "success": "#1BC5BD",
                        "info": "#8950FC",
                        "warning": "#FFA800",
                        "danger": "#F64E60",
                        "light": "#E4E6EF",
                        "dark": "#181C32"
                    },
                    "light": {
                        "white": "#ffffff",
                        "primary": "#E1F0FF",
                        "secondary": "#EBEDF3",
                        "success": "#C9F7F5",
                        "info": "#EEE5FF",
                        "warning": "#FFF4DE",
                        "danger": "#FFE2E5",
                        "light": "#F3F6F9",
                        "dark": "#D6D6E0"
                    },
                    "inverse": {
                        "white": "#ffffff",
                        "primary": "#ffffff",
                        "secondary": "#3F4254",
                        "success": "#ffffff",
                        "info": "#ffffff",
                        "warning": "#ffffff",
                        "danger": "#ffffff",
                        "light": "#464E5F",
                        "dark": "#ffffff"
                    }
                },
                "gray": {
                    "gray-100": "#F3F6F9",
                    "gray-200": "#EBEDF3",
                    "gray-300": "#E4E6EF",
                    "gray-400": "#D1D3E0",
                    "gray-500": "#B5B5C3",
                    "gray-600": "#7E8299",
                    "gray-700": "#5E6278",
                    "gray-800": "#3F4254",
                    "gray-900": "#181C32"
                }
            },
            "font-family": "Poppins"
        };</script>
    <!--end::Global Config-->

@endsection
