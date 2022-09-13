@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.make_interview')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                @if($data->is_new == 'y')
                    <a href="{{route('teacher.new_join')}}" class="text-muted">{{trans('s_admin.new_teachers')}}</a>
                @elseif($data->epo_type == 'far_learn')
                    <a href="{{url('/teacher_settings/far_learn')}}" class="text-muted">{{trans('s_admin.nav_teachers_far_learn')}}</a>
                @elseif($data->epo_type == 'mogmaa')
                    <a href="{{url('/teacher_settings/mogmaa')}}" class="text-muted">{{trans('s_admin.nav_teachers_mogmaa')}}</a>
                @elseif($data->epo_type == 'dorr')
                    <a href="{{url('/teacher_settings/dorr')}}" class="text-muted">{{trans('s_admin.nav_teachers_dorr')}}</a>
                @else
                    <a href="{{route('teacher.new_join')}}" class="text-muted">{{trans('s_admin.new_teachers')}}</a>
                @endif
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.nav_teacher_shoan_settings')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('styles')
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-4">
        </div>
        <div class="col-md-4">
        </div>
    </div>
    <div class="card card-custom gutter-b">
        <div class="card-body">
            <div class="d-flex mb-9">
                <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                    <div class="symbol symbol-50 symbol-lg-120">
                        @if($data->image == null)
                            <img src="{{url('/')}}/uploads/teachers/default.png" alt="image"/>
                        @else
                            <img src="{{$data->image}}" alt="image"/>
                        @endif
                    </div>
                    <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                        <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                    </div>
                </div>
                <div class="flex-grow-1">
                    <div class="d-flex justify-content-between flex-wrap mt-1">
                        <div class="d-flex mr-3">
                            <a href="#"
                               class="text-dark-75 text-hover-primary font-size-h5 font-weight-bold mr-3">
                                @if(app()->getLocale() == 'ar')
                                    {{$data->first_name_ar}} {{$data->mid_name_ar}} {{$data->last_name_ar}}
                                @else
                                    {{$data->first_name_en}} {{$data->mid_name_en}} {{$data->last_name_en}}
                                @endif
                            </a>
                            <a href="#">
                                <i class="flaticon2-correct text-success font-size-h5"></i>
                            </a>
                        </div>
                        <div class="my-lg-0 my-3">
                        </div>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between mt-1">
                        <div class="d-flex flex-column flex-grow-1 pr-8">
                            <div class="d-flex flex-wrap mb-4">
                                <a href="#"
                                   class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <i class="flaticon2-new-email mr-2 font-size-lg"></i>
                                    &nbsp;
                                    {{$data->email}}
                                </a>
                                <a href="#"
                                   class="text-dark-50 text-hover-primary font-weight-bold mr-lg-8 mr-5 mb-lg-0 mb-2">
                                    <i class="flaticon2-phone mr-2 font-size-lg"></i>
                                    &nbsp;
                                    {{$data->phone}}
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-7">
            <div class="card card-custom card-stretch gutter-b">
                <div class="card-header">
                    <h3 class="card-title">{{trans('s_admin.teacher_data')}}</h3>
                </div>
                <div class="card-body pt-2 pb-0 mt-n3">
                    <div class="table-responsive">
                        <table class="table table-borderless table-vertical-center">
                            <thead>
                            <tr>
                                <th class="p-0 w-120px"></th>
                                <th class="p-0 w-120px"></th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="pl-0 py-4">
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.name')}}</span>
                                </td>
                                <td class="pl-0">
                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->first_name_ar}} {{$data->mid_name_ar}} {{$data->last_name_ar}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0 py-4">
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.qualification')}}</span>
                                </td>
                                <td class="pl-0">
                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">  @if($data->Qualification) {{$data->Qualification->name_ar}}  @endif </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0 py-4">
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.nationality')}}</span>
                                </td>
                                <td class="pl-0">
                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg"> @if($data->Nationality) {{$data->Nationality->name_ar}} @endif </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0 py-4">
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.phone')}}</span>
                                </td>
                                <td class="pl-0">
                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->phone}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0 py-4">
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.email')}}</span>
                                </td>
                                <td class="pl-0">
                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->email}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0 py-4">
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.phone')}}</span>
                                </td>
                                <td class="pl-0">
                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg"> {{$data->phone}}
                                        ({{$data->country_code}})</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0 py-4">
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.gender')}}</span>
                                </td>
                                <td class="pl-0">
                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                        @if($data->gender == 'male' )
                                            {{trans('admin.male')}}
                                        @elseif($data->gender == 'female' )
                                            {{trans('admin.female')}}
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0 py-4">
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('admin.date_of_birth')}}</span>
                                </td>
                                <td class="pl-0">
                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->date_of_birth}}</a>
                                </td>
                            </tr>
                            @if($data->country != null)
                                <tr>
                                    <td class="pl-0 py-4">
                                    <span
                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('admin.country')}}</span>
                                    </td>
                                    <td class="pl-0">
                                        <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->Country->name_ar}}</a>
                                    </td>
                                </tr>
                            @endif
                            <tr>
                                <td class="pl-0 py-4">
                                            <span
                                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.ident_num')}}</span>
                                </td>
                                <td class="pl-0">
                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->ident_num}}</a>
                                </td>
                            </tr>
                            <tr>
                                <td class="pl-0 py-4">
                                            <span
                                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.epo_type')}}</span>
                                </td>
                                <td class="pl-0">
                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                        @if($data->epo_type == 'far_learn' )
                                            {{trans('s_admin.nav_far_epo')}}
                                        @elseif($data->epo_type == 'dorr' )
                                            {{trans('s_admin.nav_dorr_epo')}}
                                        @else
                                            {{trans('s_admin.mogmaa_epos')}}
                                        @endif
                                    </a>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-5">
            <div class="card card-custom gutter-b example example-compact">
                <div class="card-header">
                    <h3 class="card-title">{{trans('s_admin.interview_info')}}</h3>
                </div>
                @if($teacher_interview == null)
                    <form class="form" method="post" action="{{route('teacher.store.interviews')}}">
                        @csrf
                        <input type="hidden" required class="form-control" value="{{$data->id}}" name="teacher_id">
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="exampleSelectl">{{trans('s_admin.interview_date')}}</label>
                                <input type="date" required class="form-control" name="interview_date">
                            </div>
                            <div class="form-group row" id="subject_cont">
                                <label for="exampleSelectl">{{trans('s_admin.interview_time')}}</label>
                                <input required name="interview_time" class="form-control" id="kt_timepicker_1"
                                       readonly="readonly" placeholder="Select time" type="text">
                            </div>
                        </div>
                        <div class="card-footer" style=" text-align: center;">
                            <button type="submit" class="btn btn-primary mr-2">{{trans('s_admin.create')}}</button>
                        </div>
                    </form>
                @else
                    <form class="form" method="post"
                          action="{{route('teacher.edit.interviews',$teacher_interview->id)}}">
                        @csrf
                        <div class="card-body">
                            <div class="form-group row">
                                <label for="exampleSelectl">{{trans('s_admin.interview_date')}}</label>
                                <input type="date" required value="{{$teacher_interview->interview_date}}"
                                       class="form-control" name="interview_date">
                            </div>
                            <div class="form-group row" id="subject_cont">
                                <label for="exampleSelectl">{{trans('s_admin.interview_time')}}</label>
                                <input required name="interview_time" class="form-control" id="kt_timepicker_1"
                                       readonly="readonly" value="{{$teacher_interview->interview_time}}"
                                       placeholder="Select time" type="text">
                            </div>
                            <div class="form-group">
                                <label>{{trans('s_admin.zoom_link')}}</label>
                                <br>
                                <span style="color: blue;" id="p1">{{$teacher_interview->join_url}}</span>
                                <span onclick="copyToClipboard('#p1')" class="example-copy" data-toggle="tooltip" title=""
                                      data-original-title="{{trans('s_admin.copy_link')}}"></span>
                            </div>
                        </div>
                        <div class="card-footer" style=" text-align: center;">
                            <button type="submit" class="btn btn-warning mr-2">{{trans('s_admin.edit')}}</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
    @if($data->cv != null)
        <div class="row">
            <div class="col-lg-7">
                <div class="card card-custom gutter-b example example-compact">
                    <div class="card-header">
                        <h3 class="card-title">{{trans('s_admin.cv')}}</h3>
                    </div>
                    <div class="card-body">
                        <iframe src="{{asset('/uploads\teachers\cvs').'/'.$data->cv}}"
                                style="width:600px; height:500px;"></iframe>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endsection
@section('scripts')
    <script src="{{ asset('js/create_episode_ajax.js') }}"></script>
    <script>
        function copyToClipboard(element) {
            var $temp = $("<input>");
            $("body").append($temp);
            $temp.val($(element).text()).select();
            document.execCommand("copy");
            $temp.remove();
        }
    </script>
@endsection
