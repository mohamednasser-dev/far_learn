@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.details')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            @if($data->type == 'mqraa')
                <li class="breadcrumb-item">
                    <a  href="{{route('episode.show.type','mqraa')}}" class="text-muted">{{trans('s_admin.nav_far_epo')}}</a>
                </li>
            @elseif($data->type =='mogmaa')
                <li class="breadcrumb-item">
                    <a  href="{{route('colleges.show',$data->college_id)}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
                </li>
                <li class="breadcrumb-item">
                    <a  href="{{route('colleges.index')}}" class="text-muted">{{trans('s_admin.colleges')}}</a>
                </li>
            @elseif($data->type =='dorr')
                <li class="breadcrumb-item">
                    <a  href="{{route('colleges.show',$data->college_id)}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
                </li>
                <li class="breadcrumb-item">
                    <a  href="{{route('dorr.index')}}" class="text-muted">{{trans('s_admin.dorrs')}}</a>
                </li>

            @else
                <li class="breadcrumb-item">
                    <a  href="{{route('episode.show.type','mqraa')}}" class="text-muted">{{trans('s_admin.nav_electronic_chanel')}}</a>
                </li>
            @endif
        </ul>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Education-->
            <div class="d-flex flex-row">
                <!--begin::Aside-->
                <div class="flex-row-auto offcanvas-mobile w-300px w-xl-325px" id="kt_profile_aside">
                    <!--begin::Nav Panel Widget 2-->
                    <div class="card card-custom gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Wrapper-->
                            <div class="d-flex justify-content-between flex-column h-100">
                                <!--begin::Container-->
                                <div class="pb-5">
                                    <!--begin::Header-->
                                    <div class="d-flex flex-column flex-center">
                                        <div class="symbol symbol-120 symbol-circle symbol-xl-90">
                                            @if($data->Teacher == null)
                                                <div class="symbol-label"
                                                     style="background-image:url('/uploads/teachers/default_avatar.jpg')"></div>
                                            @else
                                                @if($data->Teacher->image == null)
                                                    <div class="symbol-label"
                                                         style="background-image:url('/uploads/teachers/default_avatar.jpg')"></div>
                                                @else
                                                    <div class="symbol-label"
                                                         style="background-image:url('/uploads/teachers/{{$data->Teacher->image}}')"></div>
                                                @endif
                                            @endif
                                            <i class="symbol-badge symbol-badge-bottom bg-success"></i>
                                        </div>
                                        <a href="javascript:void(0);"
                                           class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">
                                            @if($data->Teacher != null)
                                                @if( app()->getLocale() == 'ar' )
                                                    {{$data->Teacher->first_name_ar}}  {{$data->Teacher->mid_name_ar}}
                                                @else
                                                    {{$data->Teacher->first_name_en}} {{$data->Teacher->mid_name_en}}
                                                @endif
                                            @endif
                                        </a>
                                    </div>
                                    <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="pt-1">
                                        <!--begin::Text-->
                                        @if($data->Teacher != null)
                                            <p class="text-dark-75 font-weight-nirmal font-size-lg m-0">
                                                @if( app()->getLocale() == 'ar' )
                                                    {{ str_limit($data->Teacher->bio_ar, $limit = 100) }}
                                                @else
                                                    {{ str_limit($data->Teacher->bio_en, $limit = 100) }}
                                                @endif
                                            </p>
                                        @endif
                                    <!--end::Text-->
                                        @if($data->Teacher != null)
                                        <!--begin::Item-->
                                            <div class="d-flex align-items-center pb-7">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-45 symbol-light mr-4">
                                                <span class="symbol-label">
                                                    <span
                                                        class="svg-icon svg-icon-2x svg-icon-success">
                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
                                                        <svg xmlns="http://www.w3.org/2000/svg"
                                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                                             width="24px" height="24px"
                                                             viewBox="0 0 24 24" version="1.1">
                                                            <g stroke="none" stroke-width="1"
                                                               fill="none" fill-rule="evenodd">
                                                                <rect x="0" y="0" width="24"
                                                                      height="24"/>
                                                                <rect fill="#000000"
                                                                      opacity="0.3"
                                                                      x="13" y="4" width="3"
                                                                      height="16" rx="1.5"/>
                                                                <rect fill="#000000" x="8" y="9"
                                                                      width="3" height="11"
                                                                      rx="1.5"/>
                                                                <rect fill="#000000" x="18"
                                                                      y="11"
                                                                      width="3" height="9"
                                                                      rx="1.5"/>
                                                                <rect fill="#000000" x="3"
                                                                      y="13"
                                                                      width="3" height="7"
                                                                      rx="1.5"/>
                                                            </g>
                                                        </svg>
                                                        <!--end::Svg Icon-->
                                                    </span>
                                                </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <a
                                                        class="text-dark-75  mb-1 font-size-lg font-weight-bolder"> @if($data->Teacher->gender == 'male') {{trans('s_admin.his_episodes_number')}} @else {{trans('s_admin.her_episodes_number')}} @endif </a>
                                                    <span
                                                        class="text-muted font-weight-bold"></span>
                                                </div>
                                                <!--end::Text-->
                                                <!--begin::label-->
                                                <span
                                                    class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px">{{count($data->Teacher->Episodes)}}</span>
                                                <!--end::label-->
                                            </div>
                                            <!--end::Item-->
                                            <!--begin::Item-->
                                            <div class="d-flex align-items-center">
                                                <!--begin::Symbol-->
                                                <div class="symbol symbol-45 symbol-light mr-4">
                                                    <span class="symbol-label">
                                                        <span
                                                            class="svg-icon svg-icon-2x svg-icon-warning">
                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Star.svg--><svg
                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                    width="24px" height="24px" viewBox="0 0 24 24"
                                                                    version="1.1">
                                                                    <g stroke="none" stroke-width="1" fill="none"
                                                                       fill-rule="evenodd">
                                                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                                                        <path
                                                                            d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z"
                                                                            fill="#000000"/>
                                                                    </g>
                                                                </svg><!--end::Svg Icon-->
                                                            </span>
                                                        </span>
                                                    </span>
                                                </div>
                                                <!--end::Symbol-->
                                                <!--begin::Text-->
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <a
                                                        class="text-dark-75 mb-1 font-size-lg font-weight-bolder">{{trans('s_admin.rating')}} </a>

                                                </div>
                                                <!--end::Text-->
                                                <!--begin::label-->
                                                <span
                                                    class="font-weight-bolder label label-xl label-light-danger label-inline px-3 py-5 min-w-45px">{{$data->Teacher->rate}}</span>
                                                <!--end::label-->
                                            </div>
                                        @else
                                            <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_1"
                                                 data-toggle="tooltip" title="" data-placement="right">
                                                <a id="make_interview" alt="default" data-toggle="modal"
                                                   data-target="#place_teacher_model"
                                                   class="btn btn-light-success btn-sm mr-3">
                                                    <i class="flaticon-users-1"></i> @if($data->gender == 'female') {{trans('s_admin.add_teacher_her')}} @else {{trans('s_admin.add_teacher')}} @endif
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--eng::Container-->
                                <!--begin::Footer-->
                                <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_1"
                                     data-toggle="tooltip" title="" data-placement="right">

                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card card-custom gutter-b">
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Wrapper-->
                            <div class="d-flex justify-content-between flex-column pt-4 h-100">
                                <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_1"
                                     data-toggle="tooltip" title="" data-placement="right">
                                    <a href="{{route('episode.days',$data->id)}}"
                                       class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">
                                        {{trans('s_admin.episode_dayes')}}</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if($data->type == 'mqraa')
                        @php $data->type = 'far_learn' ; @endphp
                    @endif

                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span
                                    class="card-label font-weight-bolder text-dark">{{trans('s_admin.days')}}</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-2 pb-0 mt-n3">
                            <div class="tab-content mt-5" id="myTabTables10">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_tab_pane_10_1" role="tabpanel"
                                     aria-labelledby="kt_tab_pane_10_1">
                                    <!--begin::Table-->
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-vertical-center">
                                            <!--begin::Thead-->
                                            <thead>
                                            <tr>
                                                <th class="p-0 w-50px"></th>
                                                <th class="p-0 w-100 min-w-100px"></th>
                                                <th class="p-0"></th>
                                                <th class="p-0 min-w-130px w-100"></th>
                                            </tr>
                                            </thead>
                                            <!--end::Thead-->
                                            <!--begin::Tbody-->
                                            <tbody>
                                            @foreach($data->Days as $day)
                                                <tr>
                                                    <td class="pl-0 py-5">

                                                    </td>
                                                    <td class="pl-0">
                                                        <a href="javascript:void(0);"
                                                           class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                            @if( app()->getLocale() == 'ar' )
                                                                {{$day->name_ar}}
                                                            @else
                                                                {{$day->name_en}}
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td></td>
                                                    <td class="text-left">

                                                    </td>
                                                    <td class="text-right pr-0">

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <!--end::Tbody-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade show active" id="kt_tab_pane_10_2"
                                     role="tabpanel"
                                     aria-labelledby="kt_tab_pane_10_2">
                                    <!--begin::Table-->
                                    <table class="table table-borderless table-vertical-center">
                                        <!--begin::Thead-->
                                        <thead>
                                        <tr>
                                            <th class="p-0 w-50px"></th>
                                            <th class="p-0 w-100 min-w-100px"></th>
                                            <th class="p-0"></th>
                                            <th class="p-0 min-w-130px w-100"></th>
                                        </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody>
                                        @foreach($data->Days as $day)
                                            <tr>
                                                <td class="pl-0 pt-0 py-5">
                                                </td>
                                                <td class="pl-0">
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                        {{$day->name_ar}}
                                                    </a>

                                                </td>
                                                <td></td>
                                                <td class="text-left">
                                                </td>
                                                <td class="text-right pr-0">

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>

                    @if($data->type == 'mqraa')
                        @php $data->type = 'far_learn' ; @endphp
                    @endif

                    <div class="card card-custom gutter-b">
                        <!--begin::Header-->
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span
                                    class="card-label font-weight-bolder text-dark">{{trans('s_admin.reading_types')}}</span>
                            </h3>

                        </div>
                        <!--end::Header-->
                        <!--begin::Body-->
                        <div class="card-body pt-2 pb-0 mt-n3">
                            <div class="tab-content mt-5" id="myTabTables10">
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade" id="kt_tab_pane_10_1" role="tabpanel"
                                     aria-labelledby="kt_tab_pane_10_1">
                                    <!--begin::Table-->
                                    <div class="table-responsive">
                                        <table class="table table-borderless table-vertical-center">
                                            <!--begin::Thead-->
                                            <thead>
                                            <tr>
                                                <th class="p-0 w-50px"></th>
                                                <th class="p-0 w-100 min-w-100px"></th>
                                                <th class="p-0"></th>
                                                <th class="p-0 min-w-130px w-100"></th>
                                            </tr>
                                            </thead>
                                            <!--end::Thead-->
                                            <!--begin::Tbody-->
                                            <tbody>
                                            @foreach($data->Readings as $read)
                                                <tr>
                                                    <td class="pl-0 py-5">
                                                    </td>
                                                    <td class="pl-0">
                                                        <a href="javascript:void(0);"
                                                           class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                            @if( app()->getLocale() == 'ar' )
                                                                {{$read->name_ar}}
                                                            @else
                                                                {{$read->name_en}}
                                                            @endif
                                                        </a>
                                                    </td>
                                                    <td></td>
                                                    <td class="text-left">

                                                    </td>
                                                    <td class="text-right pr-0">

                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                            <!--end::Tbody-->
                                        </table>
                                    </div>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                                <!--begin::Tap pane-->
                                <div class="tab-pane fade show active" id="kt_tab_pane_10_2"
                                     role="tabpanel"
                                     aria-labelledby="kt_tab_pane_10_2">
                                    <!--begin::Table-->
                                    <table class="table table-borderless table-vertical-center">
                                        <!--begin::Thead-->
                                        <thead>
                                        <tr>
                                            <th class="p-0 w-50px"></th>
                                            <th class="p-0 w-100 min-w-100px"></th>
                                            <th class="p-0"></th>
                                            <th class="p-0 min-w-130px w-100"></th>
                                        </tr>
                                        </thead>
                                        <!--end::Thead-->
                                        <!--begin::Tbody-->
                                        <tbody>
                                        @foreach($data->Readings as $read)
                                            <tr>
                                                <td class="pl-0 pt-0 py-5">
                                                </td>
                                                <td class="pl-0">
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                        @if( app()->getLocale() == 'ar' )
                                                            {{$read->name_ar}}
                                                        @else
                                                            {{$read->name_en}}
                                                        @endif
                                                    </a>

                                                </td>
                                                <td></td>
                                                <td class="text-left">
                                                </td>
                                                <td class="text-right pr-0">

                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <!--end::Tbody-->
                                    </table>
                                    <!--end::Table-->
                                </div>
                                <!--end::Tap pane-->
                            </div>
                        </div>
                        <!--end::Body-->
                    </div>

                    @if ($data->Teacher != null)
                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <h3 class="card-title">{{trans('s_admin.zoom_settings')}}</h3>
                            </div>
                            <form action="{{route('create.web.meeting',$data->id)}}" method="post">
                                @csrf
                                <div class="card-body">
                                    <div class="form-group">
                                        <label>{{trans('s_admin.topic')}}</label>
                                        <input required type="text" value="{{$data->name}}" name="topic"
                                               class="form-control form-control-lg">
                                    </div>
                                    <div class="form-group">
                                        <label>{{trans('s_admin.teacher_name')}}</label>
                                        <input required type="text" name="agenda" value="{{$data->Teacher->user_name}}"
                                               class="form-control form-control-lg">
                                    </div>
                                    <input required type="hidden" value="{{\Carbon\Carbon::now()}}" name="start_time"
                                           class="form-control form-control-lg">
                                </div>
                                <div class="card-footer">
                                    @if($data->join_url != null)
                                        <button type="submit"
                                                class="btn btn-warning mr-2">{{trans('s_admin.edit_zoom')}}</button>
                                    @else
                                        <button type="submit"
                                                class="btn btn-primary mr-2">{{trans('s_admin.create_zoom')}}</button>
                                    @endif
                                </div>
                            </form>
                        </div>

                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <h3 class="card-title">{{trans('s_admin.details')}}</h3>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label>{{trans('s_admin.zoom_link')}}</label>
                                    <br>
                                    <span style="color: blue;">{{$data->join_url}}</span>
                                </div>
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>{{trans('s_admin.passcode')}}</label>--}}
                                {{--                                <span class="label label-info label-inline mr-2">{{$data->passcode}}</span>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>{{trans('s_admin.meeting_id')}}</label>--}}
                                {{--                                <span class="label label-info label-inline mr-2">{{$data->meeting_id}}</span>--}}
                                {{--                            </div>--}}
                                {{--                            <div class="form-group">--}}
                                {{--                                <label>{{trans('s_admin.start_time')}}</label>--}}
                                {{--                                <span class="label label-info label-inline mr-2">{{$data->start_time}}</span>--}}
                                {{--                            </div>--}}
                            </div>
                        </div>
                    @else
                        <div class="card card-custom gutter-b example example-compact">
                            <div class="card-header">
                                <h3 class="card-title">{{trans('s_admin.zoom_settings')}}</h3>
                            </div>
                            <div class="card-body">
                                <h3>{{trans('s_admin.should_choose_teacher_first')}}</h3>
                            </div>
                        </div>
                    @endif

                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid ml-lg-8">
                    <div class="row">
                        <div class="col-xxl-12">
                            <!--begin::Base Table Widget 9-->
                            <div class="card card-custom gutter-b">
                                <!--begin::Header-->
                                <div class="card-header border-0 pt-5">
                                    <h3 class="card-title align-items-start flex-column">
                                        <span
                                            class="card-label font-weight-bolder text-dark">{{trans('s_admin.episode_data')}}</span>
                                    </h3>
                                    <div class="card-toolbar">
                                        <a href="{{route('episode.edit',$data->id)}}"
                                           class="btn btn-info font-weight-bolder font-size-sm py-3 px-14">
                                            {{trans('s_admin.edit')}}</a>
                                    </div>
                                </div>

                                <!--end::Header-->
                                <!--begin::Body-->
                                <div class="card-body pt-2 pb-0 mt-n3">
                                    <div class="tab-content mt-5" id="myTabTables9">
                                        <!--begin::Tap pane-->
                                        <div class="tab-pane fade show active" id="kt_tab_pane_9_2" role="tabpanel"
                                             aria-labelledby="kt_tab_pane_9_2">
                                            <!--begin::Table-->
                                            <div class="table-responsive">
                                                <table class="table table-borderless table-vertical-center">
                                                    <tbody>
                                                    <tr>
                                                        <td class="pl-0 py-5">
                                                            <div class="symbol symbol-45 symbol-light-warning mr-2">
																						<span class="symbol-label">
																							<span
                                                                                                class="svg-icon svg-icon-2x svg-icon-warning">
																								<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
																								<svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                                    width="24px"
                                                                                                    height="24px"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    version="1.1">
																									<g stroke="none"
                                                                                                       stroke-width="1"
                                                                                                       fill="none"
                                                                                                       fill-rule="evenodd">
																										<rect x="0"
                                                                                                              y="0"
                                                                                                              width="24"
                                                                                                              height="24"/>
																										<path
                                                                                                            d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"
                                                                                                            fill="#000000"/>
																										<rect
                                                                                                            fill="#000000"
                                                                                                            opacity="0.3"
                                                                                                            transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)"
                                                                                                            x="16.3255682"
                                                                                                            y="2.94551858"
                                                                                                            width="3"
                                                                                                            height="18"
                                                                                                            rx="1"/>
																									</g>
																								</svg>
                                                                                                <!--end::Svg Icon-->
																							</span>
																						</span>
                                                            </div>
                                                        </td>
                                                        <td class="pl-0">
                                                            <span
                                                                class="text-muted font-weight-bold d-block">{{trans('s_admin.episode_name')}}</span>
                                                            <a href="javascript:void(0);"
                                                               class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                                @if( app()->getLocale() == 'ar' )
                                                                    {{$data->name_ar}}
                                                                @else
                                                                    {{$data->name_en}}
                                                                @endif
                                                            </a>
                                                        </td>
                                                        <td class="pl-0 py-5">
                                                            <div class="symbol symbol-45 symbol-light-primary mr-2">
																						<span class="symbol-label">
																							<span
                                                                                                class="svg-icon svg-icon-2x {{auth()->user()->icon_color}}">
																								<!--begin::Svg Icon | path:assets/media/svg/icons/Home/Globe.svg-->
																								<svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                                    width="24px"
                                                                                                    height="24px"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    version="1.1">
																									<g stroke="none"
                                                                                                       stroke-width="1"
                                                                                                       fill="none"
                                                                                                       fill-rule="evenodd">
																										<rect x="0"
                                                                                                              y="0"
                                                                                                              width="24"
                                                                                                              height="24"/>
																										<path
                                                                                                            d="M13,18.9450712 L13,20 L14,20 C15.1045695,20 16,20.8954305 16,22 L8,22 C8,20.8954305 8.8954305,20 10,20 L11,20 L11,18.9448245 C9.02872877,18.7261967 7.20827378,17.866394 5.79372555,16.5182701 L4.73856106,17.6741866 C4.36621808,18.0820826 3.73370941,18.110904 3.32581341,17.7385611 C2.9179174,17.3662181 2.88909597,16.7337094 3.26143894,16.3258134 L5.04940685,14.367122 C5.46150313,13.9156769 6.17860937,13.9363085 6.56406875,14.4106998 C7.88623094,16.037907 9.86320756,17 12,17 C15.8659932,17 19,13.8659932 19,10 C19,7.73468744 17.9175842,5.65198725 16.1214335,4.34123851 C15.6753081,4.01567657 15.5775721,3.39010038 15.903134,2.94397499 C16.228696,2.49784959 16.8542722,2.4001136 17.3003976,2.72567554 C19.6071362,4.40902808 21,7.08906798 21,10 C21,14.6325537 17.4999505,18.4476269 13,18.9450712 Z"
                                                                                                            fill="#000000"
                                                                                                            fill-rule="nonzero"/>
																										<circle
                                                                                                            fill="#000000"
                                                                                                            opacity="0.3"
                                                                                                            cx="12"
                                                                                                            cy="10"
                                                                                                            r="6"/>
																									</g>
																								</svg>
                                                                                                <!--end::Svg Icon-->
																							</span>
																						</span>
                                                            </div>
                                                        </td>
                                                        <td class="pl-0">
                                                            <span
                                                                class="text-muted font-weight-bold d-block">{{trans('s_admin.episode_time')}}</span>
                                                            <a href="javascript:void(0);"
                                                               class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                                {{trans('s_admin.from')}} {{date('g:i a', strtotime($data->time_from))}}  {{trans('s_admin.to')}} {{date('g:i a', strtotime($data->time_to))}} {{trans('s_admin.ksa')}}
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0 py-5">
                                                            <div class="symbol symbol-45 symbol-light-danger mr-2">
                                                                <span class="symbol-label">
                                                                    <span
                                                                        class="svg-icon svg-icon-2x svg-icon-danger">
                                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                                                        <svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="24px"
                                                                            height="24px"
                                                                            viewBox="0 0 24 24"
                                                                            version="1.1">
                                                                            <g stroke="none"
                                                                               stroke-width="1"
                                                                               fill="none"
                                                                               fill-rule="evenodd">
                                                                                <rect x="0"
                                                                                      y="0"
                                                                                      width="24"
                                                                                      height="24"/>
                                                                                <rect
                                                                                    fill="#000000"
                                                                                    x="4" y="4"
                                                                                    width="7"
                                                                                    height="7"
                                                                                    rx="1.5"/>
                                                                                <path
                                                                                    d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                                                    fill="#000000"
                                                                                    opacity="0.3"/>
                                                                            </g>
                                                                        </svg>
                                                                        <!--end::Svg Icon-->
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="pl-0">
                                                            <span
                                                                class="text-muted font-weight-bold d-block">{{trans('s_admin.contain_energy')}}</span>
                                                            <a href="javascript:void(0);"
                                                               class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                                {{$data->student_number}}
                                                            </a>
                                                        </td>
                                                        <td class="pl-0 py-5">
                                                            <div class="symbol symbol-45 symbol-light-info mr-2">
																						<span class="symbol-label">
																							<span
                                                                                                class="svg-icon svg-icon-2x svg-icon-info">
																								<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Color-profile.svg-->
																								<svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                                    width="24px"
                                                                                                    height="24px"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    version="1.1">
																									<g stroke="none"
                                                                                                       stroke-width="1"
                                                                                                       fill="none"
                                                                                                       fill-rule="evenodd">
																										<rect x="0"
                                                                                                              y="0"
                                                                                                              width="24"
                                                                                                              height="24"/>
																										<path
                                                                                                            d="M12,10.9996338 C12.8356605,10.3719448 13.8743941,10 15,10 C17.7614237,10 20,12.2385763 20,15 C20,17.7614237 17.7614237,20 15,20 C13.8743941,20 12.8356605,19.6280552 12,19.0003662 C11.1643395,19.6280552 10.1256059,20 9,20 C6.23857625,20 4,17.7614237 4,15 C4,12.2385763 6.23857625,10 9,10 C10.1256059,10 11.1643395,10.3719448 12,10.9996338 Z M13.3336047,12.504354 C13.757474,13.2388026 14,14.0910788 14,15 C14,15.9088933 13.7574889,16.761145 13.3336438,17.4955783 C13.8188886,17.8206693 14.3938466,18 15,18 C16.6568542,18 18,16.6568542 18,15 C18,13.3431458 16.6568542,12 15,12 C14.3930587,12 13.8175971,12.18044 13.3336047,12.504354 Z"
                                                                                                            fill="#000000"
                                                                                                            fill-rule="nonzero"
                                                                                                            opacity="0.3"/>
																										<circle
                                                                                                            fill="#000000"
                                                                                                            cx="12"
                                                                                                            cy="9"
                                                                                                            r="5"/>
																									</g>
																								</svg>
                                                                                                <!--end::Svg Icon-->
																							</span>
																						</span>
                                                            </div>
                                                        </td>
                                                        <td class="pl-0">
                                                            <span
                                                                class="text-muted font-weight-bold d-block">{{trans('s_admin.gender')}}</span>
                                                            <a href="javascript:void(0);"
                                                               class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                                @if($data->gender == 'male')
                                                                    {{trans('s_admin.male_only')}}
                                                                @else
                                                                    {{trans('s_admin.female_only')}}
                                                                @endif
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0 py-5">
                                                            <div class="symbol symbol-45 symbol-light-danger mr-2">
                                                                <span class="symbol-label">
                                                                    <span
                                                                        class="svg-icon svg-icon-2x svg-icon-danger">
                                                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-4-blocks.svg-->
                                                                        <svg
                                                                            xmlns="http://www.w3.org/2000/svg"
                                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                            width="24px"
                                                                            height="24px"
                                                                            viewBox="0 0 24 24"
                                                                            version="1.1">
                                                                            <g stroke="none"
                                                                               stroke-width="1"
                                                                               fill="none"
                                                                               fill-rule="evenodd">
                                                                                <rect x="0"
                                                                                      y="0"
                                                                                      width="24"
                                                                                      height="24"/>
                                                                                <rect
                                                                                    fill="#000000"
                                                                                    x="4" y="4"
                                                                                    width="7"
                                                                                    height="7"
                                                                                    rx="1.5"/>
                                                                                <path
                                                                                    d="M5.5,13 L9.5,13 C10.3284271,13 11,13.6715729 11,14.5 L11,18.5 C11,19.3284271 10.3284271,20 9.5,20 L5.5,20 C4.67157288,20 4,19.3284271 4,18.5 L4,14.5 C4,13.6715729 4.67157288,13 5.5,13 Z M14.5,4 L18.5,4 C19.3284271,4 20,4.67157288 20,5.5 L20,9.5 C20,10.3284271 19.3284271,11 18.5,11 L14.5,11 C13.6715729,11 13,10.3284271 13,9.5 L13,5.5 C13,4.67157288 13.6715729,4 14.5,4 Z M14.5,13 L18.5,13 C19.3284271,13 20,13.6715729 20,14.5 L20,18.5 C20,19.3284271 19.3284271,20 18.5,20 L14.5,20 C13.6715729,20 13,19.3284271 13,18.5 L13,14.5 C13,13.6715729 13.6715729,13 14.5,13 Z"
                                                                                    fill="#000000"
                                                                                    opacity="0.3"/>
                                                                            </g>
                                                                        </svg>
                                                                        <!--end::Svg Icon-->
                                                                    </span>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="pl-0">
                                                            <span
                                                                class="text-muted font-weight-bold d-block">{{trans('s_admin.student_number')}}</span>
                                                            <a href="javascript:void(0);"
                                                               class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                                {{count($data->Students)}}
                                                            </a>
                                                        </td>
                                                        <td class="pl-0 py-5">
                                                            <div class="symbol symbol-45 symbol-light-info mr-2">
																						<span class="symbol-label">
																							<span
                                                                                                class="svg-icon svg-icon-2x svg-icon-info">
																								<!--begin::Svg Icon | path:assets/media/svg/icons/Design/Color-profile.svg-->
																								<svg
                                                                                                    xmlns="http://www.w3.org/2000/svg"
                                                                                                    xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                                    width="24px"
                                                                                                    height="24px"
                                                                                                    viewBox="0 0 24 24"
                                                                                                    version="1.1">
																									<g stroke="none"
                                                                                                       stroke-width="1"
                                                                                                       fill="none"
                                                                                                       fill-rule="evenodd">
																										<rect x="0"
                                                                                                              y="0"
                                                                                                              width="24"
                                                                                                              height="24"/>
																										<path
                                                                                                            d="M12,10.9996338 C12.8356605,10.3719448 13.8743941,10 15,10 C17.7614237,10 20,12.2385763 20,15 C20,17.7614237 17.7614237,20 15,20 C13.8743941,20 12.8356605,19.6280552 12,19.0003662 C11.1643395,19.6280552 10.1256059,20 9,20 C6.23857625,20 4,17.7614237 4,15 C4,12.2385763 6.23857625,10 9,10 C10.1256059,10 11.1643395,10.3719448 12,10.9996338 Z M13.3336047,12.504354 C13.757474,13.2388026 14,14.0910788 14,15 C14,15.9088933 13.7574889,16.761145 13.3336438,17.4955783 C13.8188886,17.8206693 14.3938466,18 15,18 C16.6568542,18 18,16.6568542 18,15 C18,13.3431458 16.6568542,12 15,12 C14.3930587,12 13.8175971,12.18044 13.3336047,12.504354 Z"
                                                                                                            fill="#000000"
                                                                                                            fill-rule="nonzero"
                                                                                                            opacity="0.3"/>
																										<circle
                                                                                                            fill="#000000"
                                                                                                            cx="12"
                                                                                                            cy="9"
                                                                                                            r="5"/>
																									</g>
																								</svg>
                                                                                                <!--end::Svg Icon-->
																							</span>
																						</span>
                                                            </div>
                                                        </td>
                                                        <td class="pl-0">
                                                            <span
                                                                class="text-muted font-weight-bold d-block">{{trans('s_admin.monthly_cost')}}</span>
                                                            <a href="javascript:void(0);"
                                                               class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                                @if($data->cost == 'free')
                                                                    {{trans('s_admin.free')}}
                                                                @else
                                                                    {{$data->cost}}  {{trans('s_admin.rial')}}
                                                                @endif
                                                            </a>
                                                        </td>
                                                    </tr>
                                                    </tbody>
                                                    <!--end::Tbody-->
                                                </table>
                                            </div>
                                            <!--end::Table-->
                                        </div>
                                        <!--end::Tap pane-->
                                    </div>
                                </div>
                                <!--end::Body-->
                            </div>
                            <!--end::Base Table Widget 9-->
                        </div>
                        <div class="col-xxl-12">
                            <form action="{{route('episode.place.teachers')}}" method="post">
                                @csrf
                                <div class="card card-custom card-stretch gutter-b example example-compact">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">{{trans('s_admin.aditional_teachers')}}</h3>
                                        </div>
                                        <div class="card-toolbar">
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="{{$data->id}}">
                                        <select required name="teachers[]" id="kt_dual_listbox_1" class="dual-listbox"
                                                multiple="multiple">
                                            {{--where('epo_type',$data->type)->--}}
                                            @php $additiona_teachers = App\Models\Teacher::where('epo_type',$data->type)->where('gender',$data->gender)->where('status','active')->where('is_new','accepted')->where('is_verified','1')->get(); @endphp
                                            @foreach($additiona_teachers as $row)
                                                @php $exists_teacher = \App\Models\Episode_teacher::where('teacher_id',$row->id)->where('episode_id',$data->id)->first(); @endphp
                                                @if($row->id != $data->teacher_id)
                                                    @if($exists_teacher != null)
                                                        <option value="{{$row->id}}" selected>
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$row->first_name_ar}} {{$row->mid_name_ar}} {{$row->last_name_ar}}
                                                            @else
                                                                {{$row->first_name_en}} {{$row->mid_name_en}} {{$row->last_name_en}}
                                                            @endif
                                                        </option>
                                                    @else
                                                        <option value="{{$row->id}}">
                                                            @if(app()->getLocale() == 'ar')
                                                                {{$row->first_name_ar}} {{$row->mid_name_ar}} {{$row->last_name_ar}}
                                                            @else
                                                                {{$row->first_name_en}} {{$row->mid_name_en}} {{$row->last_name_en}}
                                                            @endif
                                                        </option>
                                                    @endif
                                                @endif
                                            @endforeach
                                        </select>
                                        <!--begin::Code example-->
                                        <div class="example-code mt-10">
                                            <ul class="example-nav nav nav-tabs nav-bold nav-tabs-line nav-tabs-line-2x">
                                                <li class="nav-item">
                                                    <a class="nav-link active" data-toggle="tab"
                                                       href="#example_code_html">HTML</a>
                                                </li>
                                                <li class="nav-item">
                                                    <a class="nav-link" data-toggle="tab"
                                                       href="#example_code_js">JS</a>
                                                </li>
                                            </ul>
                                            <div class="tab-content">
                                                <div class="tab-pane active" id="example_code_html" role="tabpanel">
                                                    <div class="example-highlight">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        @if($data->teacher_id == null)
                                            <span
                                                style="color: red;"> {{trans('s_admin.should_choose_teacher')}} </span>
                                            <button class="btn btn-primary" disabled
                                                    type="submit">{{trans('s_admin.save')}}</button>
                                        @else
                                            <button class="btn btn-primary"
                                                    type="submit">{{trans('s_admin.save')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-xxl-12">
                            <form action="{{route('episode.place.students')}}" method="post">
                                @csrf
                                <div class="card card-custom card-stretch gutter-b example example-compact">
                                    <div class="card-header">
                                        <div class="card-title">
                                            <h3 class="card-label">{{trans('s_admin.episode_students')}}</h3>
                                        </div>
                                        <div class="card-toolbar">
                                            <a href="{{route('episode.details.certificates',$data->id)}}"
                                               class="btn btn-danger">{{trans('s_admin.nav_certifcates')}}</a>
                                        </div>
                                    </div>
                                    <div class="card-body">
                                        <input type="hidden" name="id" value="{{$data->id}}">
                                        <select required id="kt_dual_listbox_2" name="students[]" class="dual-listbox"
                                                multiple="multiple"
                                                data-available-title="{{trans('s_admin.all_students')}}"
                                                data-selected-title="{{trans('s_admin.in_epo')}}"
                                                data-add="&lt;i class='flaticon2-back'&gt;&lt;/i&gt;"
                                                data-remove="&lt;i class='flaticon2-next'&gt;&lt;/i&gt;"
                                                data-add-all="&lt;i class='flaticon2-fast-back'&gt;&lt;/i&gt;"
                                                data-remove-all="&lt;i class='flaticon2-fast-next'&gt;&lt;/i&gt;">
                                            {{--where('epo_type',$data->type)->--}}
                                            @php $students = \App\Models\Student::where('gender',$data->gender)->where('status','active')->where('is_new','accepted')->where('is_verified','1')->where('interview','y')->where('complete_data','1')->get(); @endphp

                                            @foreach($students as $row)
                                                @php $exists_stud = \App\Models\Episode_student::where('deleted','0')->where('student_id',$row->id)->where('episode_id',$data->id)->first(); @endphp
                                                @if($exists_stud != null)
                                                    <option value="{{$row->id}}" selected>
                                                        @if(app()->getLocale() == 'ar')
                                                            {{$row->first_name_ar}} {{$row->mid_name_ar}} {{$row->last_name_ar}}
                                                        @else
                                                            {{$row->first_name_en}} {{$row->mid_name_en}} {{$row->last_name_en}}
                                                        @endif
                                                    </option>
                                                @else
                                                    <option value="{{$row->id}}">
                                                        @if(app()->getLocale() == 'ar')
                                                            {{$row->first_name_ar}} {{$row->mid_name_ar}} {{$row->last_name_ar}}
                                                        @else
                                                            {{$row->first_name_en}} {{$row->mid_name_en}} {{$row->last_name_en}}
                                                        @endif
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="card-footer">
                                        @if($data->type == 'far_learn')
                                            <span
                                                style="color: red;"> {{trans('s_admin.far_learn_added_to_epo')}} </span>
                                            <button class="btn btn-primary"
                                                    type="submit">{{trans('s_admin.save')}}</button>
                                        @else
                                            <button class="btn btn-primary"
                                                    type="submit">{{trans('s_admin.save')}}</button>
                                        @endif
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!--end::Content-->
            </div>

            <!--end::Education-->
        </div>
        <!--end::Container-->
    </div>
    <div class="modal fade" id="place_teacher_model" data-backdrop="static" tabindex="-1" role="dialog"
         aria-labelledby="staticBackdrop" aria-hidden="t*ue">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{trans('s_admin.place_teacher')}}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <i aria-hidden="true" class="ki ki-close"></i>
                    </button>
                </div>
                <div class="modal-body">
                    {{ Form::open( ['route' =>'episode.place.teacher','method'=>'post', 'files'=>'true'] ) }}
                    <input type="hidden" required class="form-control" id="txt_student_id" value="{{$data->id}}"
                           name="id">
                    <div class="card-body">
                        <div class="form-group">
                            <label> @if($data->gender == 'female') {{trans('s_admin.teacher_name_her')}} @else {{trans('s_admin.teacher_name')}} @endif </label>
                            @php $teachers = App\Models\Teacher::where('epo_type',$data->type)->where('gender',$data->gender)
                                            ->where('status','active')->where('is_new','accepted')->where('is_verified','1')->get(); @endphp
                            <select required name="teacher_id" class="form-control select2" id="kt_select2_4">
                                @foreach($teachers as $row)
                                    @if($data->teacher_id == $row->id)
                                        @if(app()->getLocale() == 'ar')
                                            <option value="{{$row->id}}" selected>{{$row->first_name_ar}}
                                                &nbsp;{{$row->mid_name_ar}}&nbsp;{{$row->last_name_ar}}</option>
                                        @else
                                            <option value="{{$row->id}}" selected>{{$row->first_name_en}}
                                                &nbsp;{{$row->mid_name_en}}&nbsp;{{$row->last_name_en}}</option>
                                        @endif
                                    @else
                                        @if(app()->getLocale() == 'ar')
                                            <option value="{{$row->id}}">{{$row->first_name_ar}}
                                                &nbsp;{{$row->mid_name_ar}}&nbsp;{{$row->last_name_ar}}</option>
                                        @else
                                            <option value="{{$row->id}}">{{$row->first_name_en}}
                                                &nbsp;{{$row->mid_name_en}}&nbsp;{{$row->last_name_en}}</option>
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
