@extends('student.student_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.join_episode')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
        <ul class="breadcrumb breadcrumb-transparent breadcrumb-dot font-weight-bold p-0 my-2 font-size-sm">
            <li class="breadcrumb-item">
                <a href="{{route('search.index')}}" class="text-muted">{{trans('s_admin.search_cont_chanel')}}</a>
            </li>
        </ul>
    </div>
@endsection
@section('content')
    <div class="d-flex flex-column-fluid">
        <!--begin::Container-->
        <div class="container">
            <!--begin::Education-->
            <div class="row">
                <!--begin::Aside-->
                <div class="flex-row-fluid col-lg-4" id="kt_profile_aside">
                    <!--begin::Nav Panel Widget 2-->
                    <div class="card card-custom gutter-b">
                        <div class="card-header border-0 pt-5">
                            <h3 class="card-title align-items-start flex-column">
                                <span
                                    class="card-label font-weight-bolder text-dark">{{trans('s_admin.teacher_data')}}
                                </span>
                            </h3>
                        </div>
                        <!--begin::Body-->
                        <div class="card-body">
                            <!--begin::Wrapper-->
                            <div class="d-flex justify-content-between flex-column pt-4 h-100">
                                <!--begin::Container-->
                                <div class="pb-5">
                                    <!--begin::Header-->
                                    @if($data->Teacher)
                                        <div class="d-flex flex-column flex-center">
                                            <div class="symbol symbol-120 symbol-circle symbol-xl-90">
                                                @if($data->Teacher->image == null)
                                                    <div class="symbol-label"
                                                         style="background-image:url('/uploads/teachers/default_avatar.jpg')"></div>
                                                @else
                                                    <div class="symbol-label"
                                                         style="background-image:url('{{$data->Teacher->image}}')"></div>
                                                @endif
                                                <i class="symbol-badge symbol-badge-bottom bg-success"></i>
                                            </div>
                                            <a href="javascript:void(0);"
                                               class="card-title font-weight-bolder text-dark-75 text-hover-primary font-size-h4 m-0 pt-7 pb-1">
                                                @if( app()->getLocale() == 'ar' )
                                                    {{$data->Teacher->first_name_ar}}  {{$data->Teacher->mid_name_ar}}
                                                @else
                                                    {{$data->Teacher->first_name_en}} {{$data->Teacher->mid_name_en}}
                                                @endif
                                            </a>
                                        </div>
                                @endif
                                <!--end::Header-->
                                    <!--begin::Body-->
                                    <div class="pt-1">
                                        <!--begin::Text-->
                                        @if($data->Teacher)
                                            <p class="text-dark-75 font-weight-nirmal font-size-lg m-0 pb-7">
                                                @if( app()->getLocale() == 'ar' )
                                                    {{ $data->Teacher->bio_ar }}
                                                    {{--  {{ str_limit($data->Teacher->bio_ar, $limit = 100) }}--}}
                                                @else
                                                    {{ $data->Teacher->bio_en}}
                                                    {{-- {{ str_limit($data->Teacher->bio_en, $limit = 100) }}--}}
                                                @endif
                                            </p>
                                    @endif
                                        <div class="d-flex align-items-center pb-9">
                                            @if($data->Teacher)
                                            <div class="symbol symbol-45 symbol-light mr-4">
																	<span class="symbol-label">
																		<span
                                                                            class="svg-icon svg-icon-2x svg-icon-dark-50">
																			<!--begin::Svg Icon | path:assets/media/svg/icons/Media/Equalizer.svg-->
																			<svg xmlns="http://www.w3.org/2000/svg"
                                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                 width="24px" height="24px"
                                                                                 viewBox="0 0 24 24" version="1.1">
																				<g stroke="none" stroke-width="1"
                                                                                   fill="none" fill-rule="evenodd">
																					<rect x="0" y="0" width="24"
                                                                                          height="24"/>
																					<rect fill="#000000" opacity="0.3"
                                                                                          x="13" y="4" width="3"
                                                                                          height="16" rx="1.5"/>
																					<rect fill="#000000" x="8" y="9"
                                                                                          width="3" height="11"
                                                                                          rx="1.5"/>
																					<rect fill="#000000" x="18" y="11"
                                                                                          width="3" height="9"
                                                                                          rx="1.5"/>
																					<rect fill="#000000" x="3" y="13"
                                                                                          width="3" height="7"
                                                                                          rx="1.5"/>
																				</g>
																			</svg>
                                                                            <!--end::Svg Icon-->
																		</span>
																	</span>
                                            </div>
                                                <div class="d-flex flex-column flex-grow-1">
                                                    <a href="javascript:void(0);"
                                                       class="text-dark-75 text-hover-primary mb-1 font-size-lg font-weight-bolder">
                                                        @if($data->Teacher->gender == 'male')
                                                            {{trans('s_admin.his_episodes_number')}}
                                                        @else
                                                            {{trans('s_admin.her_episodes_number')}}
                                                        @endif
                                                    </a>
                                                    <span class="text-muted font-weight-bold"></span>
                                                </div>
                                            @endif
                                            @if($data->Teacher)
                                                <span class="font-weight-bolder label label-xl label-light-success label-inline px-3 py-5 min-w-45px">{{count($data->Teacher->Episodes)  + count($data->Teacher->Episode) }}</span>
                                            @endif
                                        </div>
                                    </div>
                                    <!--end::Body-->
                                </div>
                                <!--eng::Container-->
                                <!--begin::Footer-->
                                @if($data->gender == auth::guard('student')->user()->gender)
                                    @php $epo_exists = \App\Models\Episode_student::where('student_id',auth::guard('student')->user()->id)->where('episode_id',$data->id)->first(); @endphp
                                    @if($epo_exists != null)
                                        <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_1"
                                             data-toggle="tooltip" title="" data-placement="right">
                                            <h4>{{trans('s_admin.you_join_episode')}}</h4>
                                        </div>
                                    @endif
                                @endif
                                <div class="d-flex flex-center" id="kt_sticky_toolbar_chat_toggler_1"
                                     data-toggle="tooltip" title="" data-placement="right">
                                    @if($data->gender == auth::guard('student')->user()->gender)
                                        @php $epo_exists = \App\Models\Episode_student::where('student_id',auth::guard('student')->user()->id)->where('episode_id',$data->id)->first(); @endphp
                                        @if($epo_exists == null)
                                            @php $exist_request = \App\Models\Episode_request::where('student_id',auth::guard('student')->user()->id)->where('episode_id',$data->id)->first(); @endphp
                                            @if($exist_request != null)
                                                @if($exist_request->status == 'rejected')
                                                    <div class="row">  <h6 style="color: red;">{{trans('s_admin.request_rejected')}}</h6></div>
                                                    <div class="row"><a href="{{route('episode.join_again',$data->id)}}"
                                                                        class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">{{trans('s_admin.join_again_episode')}}</a>
                                                    </div>


                                                @else
                                                    <h4 style="color: green;">{{trans('s_admin.request_send')}}</h4>
                                                @endif

                                            @else
                                                <a href="{{route('episode.join',$data->id)}}"
                                                   class="btn btn-primary font-weight-bolder font-size-sm py-3 px-14">{{trans('s_admin.join_episod')}}</a>
                                            @endif
                                        @else
                                            {{--  href="{{route('episode.leave',$data->id)}}"--}}
                                            {{--  <a href="javascript:void(0);" class="btn btn-danger font-weight-bolder font-size-sm py-3 px-14">{{trans('s_admin.leave_now')}}</a>--}}
                                        @endif
                                    @else
                                        <h4>{{trans('s_admin.you_not_same_grnder')}}</h4>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Aside-->
                <!--begin::Content-->
                <div class="flex-row-fluid col-lg-8">
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
                                                    <!--begin::Thead-->
                                                    <thead>
                                                    <tr>
                                                        <th class="p-0 w-50px"></th>
                                                        <th class="p-0 min-w-130px min-w-lg-100px w-100"></th>
                                                        <th class="p-0 min-w-200px"></th>
                                                        <th class="p-0 min-w-200px"></th>
                                                    </tr>
                                                    </thead>
                                                    <!--end::Thead-->
                                                    <!--begin::Tbody-->
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
                                                        <td class="text-left">
                                                        </td>
                                                        <td class="text-right pr-0">

                                                        </td>
                                                    </tr>
                                                    <tr>
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
                                                        <td class="text-left">

                                                        </td>
                                                        <td class="text-right pr-0">

                                                        </td>
                                                    </tr>
                                                    @if($data->Level)
                                                        <tr>
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
                                                                class="text-muted font-weight-bold d-block">{{trans('s_admin.subject_type')}}</span>
                                                                <a href="javascript:void(0);"
                                                                   class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">

                                                                    @if(app()->getLocale() == 'ar')
                                                                        {{$data->Level->name_ar}}
                                                                    @else
                                                                        {{$data->Level->name_en}}
                                                                    @endif
                                                                </a>
                                                            </td>
                                                            <td class="text-left">

                                                            </td>
                                                            <td class="text-right pr-0">

                                                            </td>
                                                        </tr>
                                                    @endif
                                                    <tr>
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
                                                        <td class="text-left">

                                                        </td>
                                                        <td class="text-right pr-0">

                                                        </td>
                                                    </tr>
                                                    <tr>
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
                                                                class="text-muted font-weight-bold d-block">{{trans('s_admin.start_date')}}</span>
                                                            <a href="javascript:void(0);"
                                                               class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                                {{ $data->start_date  }}
                                                            </a>
                                                        </td>
                                                        <td class="text-left">

                                                        </td>
                                                        <td class="text-right pr-0">

                                                        </td>
                                                    </tr>
                                                    <tr>
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
                                                                class="text-muted font-weight-bold d-block">{{trans('s_admin.listen_type')}}</span>
                                                            <a href="javascript:void(0);"
                                                               class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">
                                                                @if($data->listen_type == 'single')
                                                                    {{trans('s_admin.single')}}
                                                                @else
                                                                    {{trans('s_admin.group')}}
                                                                @endif

                                                            </a>
                                                        </td>
                                                        <td class="text-left">

                                                        </td>
                                                        <td class="text-right pr-0">

                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="pl-0 py-5">
                                                            <div class="symbol symbol-45 symbol-light-primary mr-2">
																						<span class="symbol-label">
																							<span
                                                                                                class="svg-icon svg-icon-2x svg-icon-primary">
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
                                                            <a href="javascript:void(0);"
                                                               class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{trans('s_admin.episode_time')}}</a>
                                                        </td>
                                                        <td class="pl-0">
                                                            <span style="width: 200px;"
                                                                  class="text-dark-75 font-weight-bolder d-block font-size-lg">{{date('g:i a', strtotime($data->time_from))}} {{trans('s_admin.ksa')}}</span>
                                                        </td>
                                                        <td class="pl-0">
                                                            <span style="width: 200px;"
                                                                  class="text-dark-75 font-weight-bolder d-block font-size-lg">{{date('g:i a', strtotime($data->time_to))}} {{trans('s_admin.ksa')}}</span>
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
                            <div class="row">
                                <div class="col-md-6">
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
                                                    <div class="">
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
                                                    <div class="">
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
                                                    </div>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Tap pane-->
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                </div>
                                <div class="col-md-6">
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
                                                    <div class="">
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
                                                    <div class="">
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
                                                    </div>
                                                    <!--end::Table-->
                                                </div>
                                                <!--end::Tap pane-->
                                            </div>
                                        </div>
                                        <!--end::Body-->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--end::Content-->
            </div>
            <!--end::Education-->
        </div>
        <!--end::Container-->
    </div>

@endsection
