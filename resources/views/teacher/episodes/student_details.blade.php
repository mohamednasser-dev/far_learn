@extends('teacher.teacher_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">
            {{trans('s_admin.details')}}
        </h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">

            <li class="breadcrumb-item">
                <a href="{{route('t_episodes.show',$episode_id)}}" class="text-muted">{{trans('s_admin.episode')}}</a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{route('t_episodes.index')}}" class="text-muted">{{trans('s_admin.nav_table_hlka')}}</a>
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
                                @if($data->image == null)
                                    <img src="{{url('/')}}/uploads/students/default.png" alt="image"/>
                                @else
                                    <img src="{{url('/')}}/uploads/students/{{$data->image}}" alt="image"/>
                                @endif
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
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
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
                                    @if($parent_data != null)
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
                                                    class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('admin.home_phone')}}</span>
                                            </td>
                                            <td class="pl-0">
                                                <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$parent_data->home_phone}}</a>
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
                                                    @if( $parent_data->relation == 'dad')
                                                        {{trans('admin.dad')}}
                                                    @else
                                                        {{trans('admin.mam')}}
                                                    @endif
                                                </a>
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
                                    class="card-label font-weight-bolder text-dark">{{trans('s_admin.subject')}}</span>
                            </h3>

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
                                                </td>
                                            </tr>
                                        @endif
                                        @if($data->save_quran_limit != null)
                                            <tr>
                                                <td class="pl-0 py-4">
                                                    <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{trans('s_admin.what_his_limit_save')}}</span>
                                                </td>
                                                <td class="pl-0">
                                                    <a class="text-primary font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$data->save_quran_limit}} </a>
                                                    (<label>{{trans('s_admin.face')}}</label>)
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
                        </div>
                        <div class="card-body pt-2 pb-0 mt-n3">
                            <div class="table-responsive">
                                <table class="table table-borderless table-vertical-center">
                                    <thead>
                                    <tr>
                                        <th class="p-0 w-120px">{{trans('s_admin.episode_name')}}</th>
                                        <th class="p-0 w-120px"> {{trans('s_admin.teacher_name')}}</th>
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
                                                    @if($row->Episode->teacher_id != null)
                                                        @if(app()->getLocale() == 'ar')
                                                            {{$row->Episode->Teacher->first_name_ar}} {{$row->Episode->Teacher->mid_name_ar}} {{$row->Episode->Teacher->last_name_ar}}
                                                        @else
                                                            {{$row->Episode->Teacher->first_name_en}} {{$row->Episode->Teacher->mid_name_en}} {{$row->Episode->Teacher->last_name_en}}
                                                        @endif
                                                    @endif
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
