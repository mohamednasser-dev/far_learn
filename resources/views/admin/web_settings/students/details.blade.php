@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
            {{trans('s_admin.details')}}
        </h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                @if(request()->segment(2) == 'far_learn')
                    <a href="{{url('/student_settings/far_learn')}}" class="text-muted">
                        {{trans('s_admin.far_learn_students')}}
                    </a>
                @elseif(request()->segment(2) == 'mogmaa')
                    <a href="{{url('/student_settings/mogmaa')}}" class="text-muted">
                        {{trans('s_admin.mogmaa_students')}}
                    </a>
                @elseif(request()->segment(2) == 'dorr')
                    <a href="{{url('/student_settings/dorr')}}" class="text-muted">
                        {{trans('s_admin.dorr_students')}}
                    </a>
                @else
                    <a href="{{route('students.new')}}" class="text-muted">
                        {{trans('s_admin.new_students')}}
                    </a>
                @endif
            </li>
            <li class="breadcrumb-item">
                <a href="javascript:void(0);" class="text-muted">{{trans('s_admin.manage_students')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Card-->
            <div class="card card-custom gutter-b">
                <div class="card-body">
                    <!--begin::Details-->
                    <div class="d-flex mb-9">
                        <!--begin: Pic-->
                        <div class="flex-shrink-0 mr-7 mt-lg-0 mt-3">
                            <div class="symbol symbol-50 symbol-lg-120">
                                <img src="{{$data->image}}" alt="image"/>
                            </div>
                            <div class="symbol symbol-50 symbol-lg-120 symbol-primary d-none">
                                <span class="font-size-h3 symbol-label font-weight-boldest">JM</span>
                            </div>
                        </div>
                        <!--end::Pic-->
                        <!--begin::Info-->
                        <div class="flex-grow-1">
                            <!--begin::Title-->
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
                            <!--end::Title-->
                            <!--begin::Content-->
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
                            <!--end::Content-->
                        </div>
                        <!--end::Info-->
                    </div>
                </div>
            </div>
            <!--end::Card-->
            <!--begin::Row-->
            <div class="row">
                <div class="col-lg-7">
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span
                                    class="card-label font-weight-bolder text-dark">{{trans('s_admin.student_data')}}</span>
                            </h3>
                            <div class="card-toolbar">
                            </div>
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
                                            <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->Qualification->name_ar}}</a>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td class="pl-0 py-4">
                                            <span
                                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.nationality')}}</span>
                                        </td>
                                        <td class="pl-0">
                                            <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->Nationality->name_ar}}</a>
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
                                    <tr>
                                        <td class="pl-0 py-4">
                                            <span
                                                class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('admin.country')}}</span>
                                        </td>
                                        <td class="pl-0">
                                            <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->Country->name_ar}}</a>
                                        </td>
                                    </tr>
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
                                            <a href="{{route('student_epo_type.change',$data->id)}}"
                                               data-toggle="tooltip" data-theme="dark" title=""
                                               data-original-title="{{trans('s_admin.change_epos_type')}}"
                                               class="btn btn-light-info font-weight-bold mr-2">
                                                <i class="icon-md fas fa-random" aria-hidden='true'></i>
                                            </a>

                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @if($parent_data != null)
                    <div class="col-lg-5">
                        <div class="card card-custom card-stretch gutter-b">
                            <!--begin::Header-->
                            <div class="card-header border-0 pt-5">
                                <h3 class="card-title font-weight-bolder">{{trans('s_admin.parent_data')}}</h3>
                            </div>
                            <div class="card-body d-flex flex-column">
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
                                                <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$parent_data->user_name}}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pl-0 py-4">
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('admin.phone')}}</span>
                                            </td>
                                            <td class="pl-0">
                                                <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$parent_data->phone}}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pl-0 py-4">
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.address')}}</span>
                                            </td>
                                            <td class="pl-0">
                                                <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$parent_data->address}}</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td class="pl-0 py-4">
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('admin.relation')}}</span>
                                            </td>
                                            <td class="pl-0">
                                                <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                    {{ $parent_data->Relation->name }}
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span
                                    class="card-label font-weight-bolder text-dark">{{trans('s_admin.subject')}}</span>
                            </h3>
                            <div class="card-toolbar">
                                @if($data->complete_data == 1)
                                    {{--                                    @if(request()->segment(2) != 'far_learn')--}}
                                    @if($data->interview == 'n')
                                        <a data-student-id="{{$data->id}}" id="make_interview" alt="default"
                                           data-toggle="modal" data-target="#make_interview_model"
                                           class="btn btn-light-info font-weight-bold mr-2">{{trans('s_admin.make_interview')}}</a>
                                    @elseif($data->interview == 'y')
                                        <a href="{{route('student.place.subject.edit',['type' => request()->segment(2) , 'id' => $data->id])}}"
                                           class="btn btn-light-warning font-weight-bold mr-2">{{trans('s_admin.edit_subject')}}</a>
                                    @endif
                                    {{--                                    @endif--}}
                                @endif
                            </div>
                        </div>
                        <div class="card-body pt-2 pb-0 mt-n3">
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                    <tr>
                                        <th class="p-0 w-120px"></th>
                                        <th class="p-0 w-120px"></th>
                                        <th class="p-0 w-40px"></th>
                                        <th class="p-0 w-40px"></th>
                                        <th class="p-0 w-40px"></th>
                                        <th class="p-0 w-40px"></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($data->complete_data == 1)
                                        @if($data->save_quran_num != null)
                                            <tr>
                                                <td class="pl-0 py-4">
                                                        <span
                                                            class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.save_quran_num')}}</span>
                                                </td>
                                                <td class="pl-0">
                                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->save_quran_num}} </a>
                                                    (<label>{{trans('s_admin.gzaa')}}</label>)
                                                    <a data-toggle="modal" data-target="#edit_save_quran_num_model"
                                                       data-toggle="tooltip" data-theme="dark"
                                                       title="{{trans('s_admin.edit')}}"
                                                       class="btn btn-text-dark-50 btn-icon-primary btn-hover-icon-success font-weight-bold btn-hover-bg-light mr-3">
                                                        <i class="flaticon-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                        @if($data->save_quran_limit != null)
                                            <tr>
                                                <td class="pl-0 py-4">
                                                        <span
                                                            class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.what_his_limit_save')}}</span>
                                                </td>
                                                <td class="pl-0">
                                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->Save_limit->name}} </a>
                                                    (<label>{{trans('s_admin.face')}}</label>)
                                                    <a data-toggle="modal" data-target="#edit_Save_limit_model"
                                                       data-toggle="tooltip" data-theme="dark"
                                                       title="{{trans('s_admin.edit')}}"
                                                       class="btn btn-text-dark-50 btn-icon-primary btn-hover-icon-success font-weight-bold btn-hover-bg-light mr-3">
                                                        <i class="flaticon-edit"></i></a>
                                                </td>
                                            </tr>
                                        @endif
                                        @if($data->level_id != null)
                                            <tr>
                                                <td class="pl-0 py-4">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.level')}}</span>
                                                </td>
                                                <td class="pl-0">
                                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->Level->name_ar}} </a>
                                                </td>
                                            </tr>
                                        @endif
                                        @if($data->subject_id != null)
                                            <tr>
                                                <td class="pl-0 py-4">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.subject')}}</span>
                                                </td>
                                                <td class="pl-0">
                                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                        @if(app()->getLocale() == 'ar')
                                                            {{$data->Subject->name_ar}}
                                                        @else
                                                            {{$data->Subject->name_en}}
                                                        @endif
                                                        ( {{trans('s_admin.save')}}  {{$data->Subject->amount_num}}  {{trans('s_admin.lines_daily')}} )
                                                    </a>
                                                </td>
                                            </tr>
                                        @endif
                                        @if($data->subject_level_id != null)
                                            <tr>
                                                <td class="pl-0 py-4">
                                                    <span
                                                        class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.subject_level')}}</span>
                                                </td>
                                                <td class="pl-0">
                                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->Subject_level->name_ar}}
                                                        ({{$data->Subject_level->desc_ar}}) </a>
                                                </td>
                                            </tr>
                                        @endif
                                    @else
                                        <tr>
                                            <td class="pl-0 py-4">
                                                <span
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.data_not_complet_yet')}}</span>
                                            </td>
                                            <td class="pl-0">
                                            </td>
                                        </tr>
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="card card-custom card-stretch gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span
                                    class="card-label font-weight-bolder text-dark">{{trans('s_admin.student_epo')}}</span>
                            </h3>
                            @php $episodes = \App\Models\Episode_student::where('student_id',$data->id)->where('deleted','0')->get(); @endphp
                            <div class="card-toolbar">
                                {{--                                <a id="make_interview" alt="default"--}}
                                {{--                                   data-toggle="modal" data-target="#place_episode"--}}
                                {{--                                   class="btn btn-light-info font-weight-bold mr-2">{{trans('s_admin.add_episode')}}</a>--}}
                                <button type="button" class="btn btn-light-info font-weight-bold mr-2"
                                        data-toggle="modal"
                                        data-target="#exampleModalSizeSm">{{trans('s_admin.add_episode')}}</button>
                            </div>
                        </div>
                        <div class="card-body pt-2 pb-0 mt-n3">
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                    <tr>
                                        <th class="p-0 w-120px">{{trans('s_admin.episode_name')}}</th>
                                        <th class="p-0 w-120px"> {{trans('s_admin.teacher_name')}}</th>
                                        <th class="p-0 w-120px"> {{trans('s_admin.transfer')}}</th>
                                        <th class="p-0 w-120px"> {{trans('s_admin.delete_epo')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($episodes as $row)
                                        <tr>
                                            <td class="pl-0 py-4">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">
                                                        @if(app()->getLocale() == 'ar')
                                                            {{$row->Episode->name_ar}}
                                                        @else
                                                            {{$row->Episode->name_en}}
                                                        @endif
                                                    </span>
                                            </td>
                                            <td class="pl-0">
                                                <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                    @if($row->Episode->Teacher)
                                                        @if(app()->getLocale() == 'ar')
                                                            {{$row->Episode->Teacher->first_name_ar}} {{$row->Episode->Teacher->mid_name_ar}} {{$row->Episode->Teacher->last_name_ar}}
                                                        @else
                                                            {{$row->Episode->Teacher->first_name_en}} {{$row->Episode->Teacher->mid_name_en}} {{$row->Episode->Teacher->last_name_en}}
                                                        @endif
                                                    @endif
                                                </a>
                                            </td>
                                            <td class="pl-0">
                                                <a data-toggle="modal" data-target="#replace_episode" id="change_epo"
                                                   data-epo-id="{{$row->id}}"
                                                   class="btn btn-light-info font-weight-bold mr-2">
                                                    <i class="icon-md fas fa-random" aria-hidden='true'></i>
                                                </a>
                                            </td>
                                            <td class="pl-0">
                                                <a onclick="return confirm('{{trans('s_admin.are_y_sure_delete')}}')"
                                                   href="{{route('student_episode.delete',$row->id)}}"
                                                   class="btn btn-light-danger font-weight-bold mr-2">
                                                    <i class="icon-md fas fa-trash" aria-hidden='true'></i>
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
        </div>
    </div>
    <div class="modal fade" id="make_interview_model" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.place_student_to_subject')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'student.place.subject','method'=>'post', 'files'=>'true'] ) }}
                    {{ csrf_field() }}
                    <input type="hidden" required class="form-control" id="txt_student_id" value="{{$data->id}}"
                           name="id">
                    <div class="card-body">
                        <div class="form-group row">
                            @if($data->epo_type == 'far_learn')
                                @php $type = 'far_learn'; @endphp
                            @else
                                @php $type = 'mogmaa_dorr'; @endphp
                            @endif
                            <label for="exampleSelectl">{{trans('s_admin.level')}}</label>
                            {{ Form::select('level_id',App\Models\Level::where('type',$type)->where('deleted','0')->pluck('name_ar','id'),$data->level_id
                                    ,["class"=>"form-control form-control-lg","placeholder"=>trans('s_admin.choose_level'), "required" ,"id"=>"cmb_levels" ]) }}
                        </div>
                        <div class="form-group row" id="subject_cont">
                            <label for="exampleSelectl">{{trans('s_admin.subject')}}</label>
                            @php $subjects = App\Models\Subject::where('deleted','0')->get(); @endphp
                            <select required name="subject_id" class="form-control form-control-lg" id="cmb_subjects">
                                <option value="" selected>{{trans('s_admin.choose_subject')}}</option>
                                @foreach($subjects as $row)
                                    @if($data->subject_id == $row->id)
                                        @if(app()->getLocale() == 'ar')
                                            <option selected value="{{$row->id}}">{{$row->name_ar}}
                                                &nbsp;&nbsp;&nbsp;{{$row->desc_ar}}</option>
                                        @else
                                            <option selected value="{{$row->id}}">{{$row->name_en}}
                                                &nbsp;&nbsp;&nbsp;{{$row->desc_en}}</option>
                                        @endif
                                    @else
                                        @if(app()->getLocale() == 'ar')
                                            <option value="{{$row->id}}">{{$row->name_ar}}
                                                &nbsp;&nbsp;&nbsp;{{$row->desc_ar}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->name_en}}
                                                &nbsp;&nbsp;&nbsp;{{$row->desc_en}}</option>
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group row" id="subject_level_cont">
                            <label for="exampleSelectl">{{trans('s_admin.subject_level')}}</label>
                            {{ Form::select('subject_level_id',App\Models\Subject_level::where('deleted','0')->pluck('name_ar','id'),$data->subject_level_id
                                                            ,["class"=>"form-control form-control-lg", "required" ,"id"=>"cmb_subject_levels" ]) }}
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.save')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_save_quran_num_model" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.edit_save_limit')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'student.edit.save_quran_num','method'=>'post'] ) }}
                    {{ csrf_field() }}
                    <input type="hidden" required class="form-control" value="{{$data->id}}" name="student_id">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="exampleSelectl">{{trans('s_admin.save_quran_num')}}</label>
                            <input type="number" step="any" required min="0" max="30" value="{{$data->save_quran_num}}"
                                   class="form-control form-control-lg form-control form-control-lg"
                                   name="save_quran_num"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.edit')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="edit_Save_limit_model" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.edit_what_his_limit_save')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'student.edit.save_limit','method'=>'post'] ) }}
                    {{ csrf_field() }}
                    <input type="hidden" required class="form-control" value="{{$data->id}}" name="student_id">
                    <div class="card-body">
                        <div class="form-group row">
                            <label for="exampleSelectl">{{trans('s_admin.what_his_limit_save')}}</label>
                            @php $save_limits = App\Models\Save_limit::where('deleted','0')->get(); @endphp
                            <select required name="save_quran_limit" class="form-control form-control-lg">
                                <option value="" selected>{{trans('s_admin.choose_limit')}}</option>
                                @foreach($save_limits as $row)
                                    @if($data->save_quran_limit == $row->id)
                                        <option value="{{$row->id}}" selected>{{$row->name}}</option>
                                    @else
                                        <option value="{{$row->id}}">{{$row->name}}</option>
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.edit')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="exampleModalSizeSm" tabindex="-1" role="dialog" aria-labelledby="exampleModalSizeSm"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-sm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.choose_epo_type')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-6">
                            <a class="btn {{auth()->user()->button_color}}"
                               href="{{route('student.get.episode',['type'=>'mqraa','student_id'=>$data->id])}}">{{trans('s_admin.far_learn')}}</a>
                        </div>
                        @if(settings()->show_mogmaa_dorr == '1')
                            <div class="col-lg-6">
                                @if($data->gender == 'male')
                                    <a class="btn btn-primary"
                                       href="{{route('student.exists.dorr',['student_id'=>$data->id ,'type'=>'college'])}}">{{trans('s_admin.colleges')}}</a>
                                @else
                                    <a style="width: 100px;"
                                       href="{{route('student.exists.dorr',['student_id'=>$data->id ,'type'=>'dorr'])}}"
                                       class="btn btn-danger">{{trans('s_admin.dorr')}}</a>
                                @endif
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="place_episode_copy" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.place_student_to_episode')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'student.place.episode','method'=>'post', 'files'=>'true'] ) }}
                    {{ csrf_field() }}
                    <input type="hidden" required class="form-control" id="txt_student_id" value="{{$data->id}}"
                           name="id">
                    <div class="card-body">
                        @if($data->epo_type == 'far_learn')
                            @php $type_epo = 'mqraa'; @endphp
                        @elseif($data->epo_type == 'dorr')
                            @php $type_epo = 'dorr'; @endphp
                        @elseif($data->epo_type == 'mogmaa')
                            @php $type_epo = 'mogmaa'; @endphp
                        @endif
                        {{--                            where('type',$type_epo)->--}}
                        @php $active_episodes =  \App\Models\Episode::where('gender',$data->gender)->where('deleted','0')->where('active','y')->get(); @endphp
                        <div class="form-group row" id="subject_cont">
                            <label for="exampleSelectl">{{trans('s_admin.episode')}}</label>
                            <select required name="episode_id" class="form-control form-control-lg" id="cmb_subjects">
                                <option value="" selected>{{trans('s_admin.choose_episode')}}</option>
                                @foreach($active_episodes as $row)
                                    @if($row->student_num > count($row->Students))
                                    @else
                                        @php $exist_epo = \App\Models\Episode_student::where('student_id',$data->id)->where('episode_id',$row->id)->first(); @endphp
                                        @if($exist_epo == null)
                                            @if(app()->getLocale() == 'ar')
                                                <option value="{{$row->id}}">{{$row->name_ar}}

                                                    @if($row->Teacher)
                                                        &nbsp;  ({{$row->Teacher->first_name_ar}}
                                                        &nbsp;  {{$row->Teacher->mid_name_ar}}) @endif

                                                    @if($row->listen_type == 'single')
                                                        ( {{trans('s_admin.single')}} )
                                                    @else
                                                        ( {{trans('s_admin.group')}} )
                                                    @endif
                                                </option>
                                            @else
                                                <option value="{{$row->id}}">{{$row->name_en}}
                                                    @if($row->Teacher)
                                                        &nbsp;&nbsp;&nbsp;({{$row->Teacher->first_name_en}}
                                                        &nbsp;{{$row->Teacher->mid_name_en}}) @endif
                                                    @if($row->listen_type == 'single')
                                                        ( {{trans('s_admin.single')}} )
                                                    @else
                                                        ( {{trans('s_admin.group')}} )
                                                    @endif
                                                </option>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.save')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" id="replace_episode" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.transfer')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'student_episode.change','method'=>'post'] ) }}
                    {{ csrf_field() }}
                    <input type="hidden" required class="form-control" id="txt_student_epo_id" name="stud_epo_id">
                    <div class="card-body">
                        @if($data->epo_type == 'far_learn')
                            @php $type_epo = 'mqraa'; @endphp
                        @elseif($data->epo_type == 'dorr')
                            @php $type_epo = 'dorr'; @endphp
                        @elseif($data->epo_type == 'mogmaa')
                            @php $type_epo = 'mogmaa'; @endphp
                        @endif
                        {{--                            where('type',$type_epo)->--}}
                        @php $active_episodes =  \App\Models\Episode::where('gender',$data->gender)->where('deleted','0')->where('active','y')->get(); @endphp
                        <div class="form-group row" id="subject_cont">
                            <label for="exampleSelectl">{{trans('s_admin.episode')}}</label>
                            <select required name="episode_id" class="form-control form-control-lg" id="cmb_subjects">
                                <option value="" selected>{{trans('s_admin.choose_episode')}}</option>
                                @foreach($active_episodes as $row)
                                    @if($row->student_num > count($row->Students))
                                    @else
                                        @php $exist_epo = \App\Models\Episode_student::where('student_id',$data->id)->where('episode_id',$row->id)->first(); @endphp
                                        @if($exist_epo == null)
                                            @if(app()->getLocale() == 'ar')
                                                <option value="{{$row->id}}">{{$row->name_ar}}
                                                    @if($row->Teacher)
                                                        &nbsp;&nbsp;&nbsp;({{$row->Teacher->first_name_ar}}
                                                        &nbsp;{{$row->Teacher->mid_name_ar}}) @endif
                                                    @if($row->listen_type == 'single')
                                                        ( {{trans('s_admin.single')}} )
                                                    @else
                                                        ( {{trans('s_admin.group')}} )
                                                    @endif
                                                </option>
                                            @else
                                                <option value="{{$row->id}}">{{$row->name_en}}
                                                    @if($row->Teacher)
                                                        &nbsp;&nbsp;&nbsp;({{$row->Teacher->first_name_en}}
                                                        &nbsp;{{$row->Teacher->mid_name_en}})
                                                    @endif
                                                    @if($row->listen_type == 'single')
                                                        ( {{trans('s_admin.single')}} )
                                                    @else
                                                        ( {{trans('s_admin.group')}} )
                                                    @endif
                                                </option>
                                            @endif
                                        @endif
                                    @endif
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="submit"
                                class="btn btn-primary font-weight-bold">{{trans('s_admin.save')}}</button>
                    </div>
                    {{ Form::close() }}
                </div>

            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('js/create_episode_ajax.js') }}"></script>
    <script>
        var epo_id;
        $(document).on('click', '#change_epo', function () {
            epo_id = $(this).data('epo-id');
            $("#txt_student_epo_id").val(epo_id);
        });
    </script>

@endsection
