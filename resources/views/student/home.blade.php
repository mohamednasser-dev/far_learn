@extends('student.student_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_home')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    <div class="row">
        <div class="col-md-8">
            <div class="row">
                @if(auth::guard('student')->user()->epo_type == 'far_learn')
                    @if( auth::guard('student')->user()->is_new == 'accepted' && auth::guard('student')->user()->interview == 'y' )
                        <div class="col-md-6">
                            <div class="card card-custom gutter-b" style="height: 150px">
                                <a href="{{route('search.index')}}">
                                    <div class="card-body">
                                        <span class="svg-icon svg-icon-3x {{auth('student')->user()->icon_color}}">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Search.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path
                                                        d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    <path
                                                        d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                        fill="#000000" fill-rule="nonzero"/>
                                                </g>
                                            </svg><!--end::Svg Icon--></span>
                                        </span>
                                        <div
                                            class="text-dark font-weight-bolder font-size-h2 mt-3">{{trans('s_admin.search_cont_chanel')}}</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @else
                        <div class="col-md-6">
                            <div class="card card-custom gutter-b" style="height: 150px">
                                <a href="javascript:void(0);">
                                    <div class="card-body">
                                        <span class="svg-icon svg-icon-3x {{auth('student')->user()->icon_color}}">
                                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Search.svg--><svg
                                                    xmlns="http://www.w3.org/2000/svg"
                                                    xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                    height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path
                                                        d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    <path
                                                        d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z"
                                                        fill="#000000" fill-rule="nonzero"/>
                                                </g>
                                            </svg><!--end::Svg Icon--></span>
                                        </span>
                                        <div
                                            class="text-danger font-weight-bolder font-size-h5 mt-3">{{trans('s_admin.should_accepted_to_search')}}</div>
                                    </div>
                                </a>
                            </div>
                        </div>
                    @endif
                @endif
                <div class="col-md-6">
                    <div class="card card-custom gutter-b" style="height: 150px">
                        <a href="{{route('student.my_episodes')}}">
                            <div class="card-body">
                                <span class="svg-icon svg-icon-3x {{auth('student')->user()->icon_color}}">
                                     <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Devices\Display2.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <polygon fill="#000000" opacity="0.3" points="6 7 6 15 18 15 18 7"/>
                                                <path
                                                    d="M11,19 L11,16 C11,15.4477153 11.4477153,15 12,15 C12.5522847,15 13,15.4477153 13,16 L13,19 L14.5,19 C14.7761424,19 15,19.2238576 15,19.5 C15,19.7761424 14.7761424,20 14.5,20 L9.5,20 C9.22385763,20 9,19.7761424 9,19.5 C9,19.2238576 9.22385763,19 9.5,19 L11,19 Z"
                                                    fill="#000000" opacity="0.3"/>
                                                <path
                                                    d="M6,7 L6,15 L18,15 L18,7 L6,7 Z M6,5 L18,5 C19.1045695,5 20,5.8954305 20,7 L20,15 C20,16.1045695 19.1045695,17 18,17 L6,17 C4.8954305,17 4,16.1045695 4,15 L4,7 C4,5.8954305 4.8954305,5 6,5 Z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    <!--end::Svg Icon-->
                                </span>
                                <div
                                    class="text-dark font-weight-bolder font-size-h2 mt-3">{{trans('s_admin.current_chanels')}}</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row">
                    <div class="col-lg-12">
                        <div class="card-header">{{trans('s_admin.last_save')}}</div>
                        <div class="card card-custom gutter-b">
                            <div class="card-body">
                                <table class="table table-bordered table-hover">
                                    <thead>
                                    <tr>
                                        <th title="Field #1">{{trans('s_admin.episode_name')}}</th>
                                        <th title="Field #1">{{trans('s_admin.from_surah')}}</th>
                                        <th title="Field #7">{{trans('s_admin.aya_number')}}</th>
                                        {{--                    <th title="Field #7">{{trans('s_admin.ended_in')}}</th>--}}
                                        <th title="Field #6">{{trans('s_admin.to_surah')}}</th>
                                        <th title="Field #7"
                                            style="text-align: center">{{trans('s_admin.aya_number')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if($last_save)
                                        <tr>
                                            <td>
                                                @if(app()->getLocale() == 'ar')
                                                    {{$last_save->Episode->name_ar}}
                                                @else
                                                    {{$last_save->Episode->name_en}}
                                                @endif
                                            </td>
                                            <td>
                                                @if(app()->getLocale() == 'ar')
                                                    {{$last_save->From_Surah->name_ar}}
                                                @else
                                                    {{$last_save->From_Surah->name_en}}
                                                @endif
                                            </td>
                                            <td>
                                                {{$last_save->from_num}}
                                            </td>
                                            <td>
                                                @if(app()->getLocale() == 'ar')
                                                    {{$last_save->To_Surah->name_ar}}
                                                @else
                                                    {{$last_save->To_Surah->name_en}}
                                                @endif
                                            </td>
                                            <td>
                                                {{$last_save->to_num}}
                                            </td>
                                        </tr>
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
            </div>
            <div class="row">
                <a href="{{route('student.reports.reciting_today')}}">
                    <div class="col-md-3">
                        <div class="card card-custom gutter-b" style="height: 150px">
                            <div class="card-body">
                        <span class="svg-icon svg-icon-3x {{auth('student')->user()->icon_color}}">
                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                 width="24px"
                                 height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"></polygon>
                                    <path
                                        d="M18,14 C16.3431458,14 15,12.6568542 15,11 C15,9.34314575 16.3431458,8 18,8 C19.6568542,8 21,9.34314575 21,11 C21,12.6568542 19.6568542,14 18,14 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"></path>
                                    <path
                                        d="M17.6011961,15.0006174 C21.0077043,15.0378534 23.7891749,16.7601418 23.9984937,20.4 C24.0069246,20.5466056 23.9984937,21 23.4559499,21 L19.6,21 C19.6,18.7490654 18.8562935,16.6718327 17.6011961,15.0006174 Z M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"
                                        fill="#000000" fill-rule="nonzero"></path>
                                </g>
                            </svg>
                            <!--end::Svg Icon-->
                        </span>
                                <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{$degree_count}}</div>
                                <a class="text-muted  font-weight-bold font-size-lg mt-1">{{trans('s_admin.today_student_listen')}}</a>
                            </div>
                        </div>
                    </div>
                </a>
            </div>
            {{--            <div class="row">--}}
            {{--                <div class="col-md-4">--}}
            {{--                    <div class="card card-custom gutter-b bg-light-primary" style="height: 150px">--}}
            {{--                        <div class="card-body">--}}
            {{--                            <div class="row">--}}
            {{--                                <div class="col-md-12">--}}
            {{--                                <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">--}}
            {{--                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Urgent-mail.svg-->--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"--}}
            {{--                             height="24px" viewBox="0 0 24 24" version="1.1">--}}
            {{--                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
            {{--                        <rect x="0" y="0" width="24" height="24"></rect>--}}
            {{--                        <path--}}
            {{--                            d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z"--}}
            {{--                            fill="#000000" opacity="0.3"></path>--}}
            {{--                        <path--}}
            {{--                            d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z"--}}
            {{--                            fill="#000000"></path>--}}
            {{--                        </g>--}}
            {{--                        </svg>--}}
            {{--                    </span>--}}
            {{--                                    <div class="text-dark font-weight-bolder font-size-h2 mt-3">--}}
            {{--                                        <span style="font-size:1.2em;"--}}
            {{--                                              class="text-primary font-weight-bold mt-2">0</span>--}}
            {{--                                    </div>--}}
            {{--                                    <a href="#"--}}
            {{--                                       class="text-primary font-weight-bold font-size-h6 mt-2">{{trans('s_admin.current_home_works')}}</a>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-md-4">--}}
            {{--                    <div class="card card-custom gutter-b bg-light-success" style="height: 150px">--}}
            {{--                        <div class="card-body">--}}
            {{--                            <div class="row">--}}
            {{--                                <div class="col-md-12">--}}
            {{--                                <span class="svg-icon svg-icon-3x {{auth('student')->user()->icon_color}} d-block my-2">--}}
            {{--                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Urgent-mail.svg-->--}}
            {{--                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"--}}
            {{--                             height="24px" viewBox="0 0 24 24" version="1.1">--}}
            {{--                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
            {{--                        <rect x="0" y="0" width="24" height="24"></rect>--}}
            {{--                        <path--}}
            {{--                            d="M12.7037037,14 L15.6666667,10 L13.4444444,10 L13.4444444,6 L9,12 L11.2222222,12 L11.2222222,14 L6,14 C5.44771525,14 5,13.5522847 5,13 L5,3 C5,2.44771525 5.44771525,2 6,2 L18,2 C18.5522847,2 19,2.44771525 19,3 L19,13 C19,13.5522847 18.5522847,14 18,14 L12.7037037,14 Z"--}}
            {{--                            fill="#000000" opacity="0.3"></path>--}}
            {{--                        <path--}}
            {{--                            d="M9.80428954,10.9142091 L9,12 L11.2222222,12 L11.2222222,16 L15.6666667,10 L15.4615385,10 L20.2072547,6.57253826 C20.4311176,6.4108595 20.7436609,6.46126971 20.9053396,6.68513259 C20.9668779,6.77033951 21,6.87277228 21,6.97787787 L21,17 C21,18.1045695 20.1045695,19 19,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,6.97787787 C3,6.70173549 3.22385763,6.47787787 3.5,6.47787787 C3.60510559,6.47787787 3.70753836,6.51099993 3.79274528,6.57253826 L9.80428954,10.9142091 Z"--}}
            {{--                            fill="#000000"></path>--}}
            {{--                        </g>--}}
            {{--                        </svg>--}}
            {{--                    </span>--}}
            {{--                                    <div class="text-dark font-weight-bolder font-size-h2 mt-3">--}}
            {{--                                        <span style="font-size:1.2em;"--}}
            {{--                                              class="text-success font-weight-bold mt-2">0</span>--}}
            {{--                                    </div>--}}
            {{--                                    <a href="#"--}}
            {{--                                       class="text-success font-weight-bold font-size-h6 mt-2">{{trans('s_admin.done_home_works')}}</a>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="col-md-4">--}}
            {{--                    <div class="card card-custom gutter-b bg-light-danger" style="height: 150px">--}}
            {{--                        <div class="card-body">--}}
            {{--                            <div class="row">--}}
            {{--                                <div class="col-md-12">--}}
            {{--                                <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">--}}
            {{--            <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Design/Layers.svg-->--}}
            {{--            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"--}}
            {{--                 height="24px" viewBox="0 0 24 24" version="1.1">--}}
            {{--            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
            {{--            <polygon points="0 0 24 0 24 24 0 24"></polygon>--}}
            {{--            <path--}}
            {{--                d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"--}}
            {{--                fill="#000000" fill-rule="nonzero"></path>--}}
            {{--            <path--}}
            {{--                d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"--}}
            {{--                fill="#000000" opacity="0.3"></path>--}}
            {{--            </g>--}}
            {{--            </svg>--}}
            {{--                                    <!--end::Svg Icon-->--}}
            {{--            </span>--}}
            {{--                                    <div class="text-dark font-weight-bolder font-size-h2 mt-3">--}}
            {{--                                        <span style="font-size:1.2em;"--}}
            {{--                                              class="text-danger font-weight-bold mt-2">0</span>--}}
            {{--                                    </div>--}}
            {{--                                    <a href="#"--}}
            {{--                                       class="text-danger font-weight-bold font-size-h6 mt-2">{{trans('s_admin.late_home_works')}}</a>--}}
            {{--                                </div>--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <div class="row">--}}
            {{--                <div class="col-md-4"></div>--}}
            {{--                <div class="col-md-8">--}}
            {{--                    <div class="card card-custom gutter-b">--}}
            {{--                        <!--begin::Header-->--}}
            {{--                        <div class="card-header border-0 pt-5">--}}
            {{--                            <h3 class="card-title align-items-start flex-column">--}}
            {{--                                <span--}}
            {{--                                    class="card-label font-weight-bolder text-dark">{{trans('s_admin.home_work_details')}}</span>--}}
            {{--                            </h3>--}}
            {{--                        </div>--}}
            {{--                        <!--end::Header-->--}}
            {{--                        <!--begin::Body-->--}}
            {{--                        <div class="card-body pt-2 pb-0 mt-n3">--}}
            {{--                            <div class="tab-content mt-5" id="myTabTables1">--}}
            {{--                                <div class="tab-pane fade show active" id="kt_tab_pane_1_3" role="tabpanel"--}}
            {{--                                     aria-labelledby="kt_tab_pane_1_3">--}}
            {{--                                    <!--begin::Table-->--}}
            {{--                                    <div class="table-responsive">--}}
            {{--                                        <table class="table table-borderless table-vertical-center">--}}
            {{--                                            <thead>--}}
            {{--                                            <tr>--}}
            {{--                                                <th class="p-0 min-w-100px"></th>--}}
            {{--                                                <th class="p-0 min-w-100px"></th>--}}
            {{--                                            </tr>--}}
            {{--                                            </thead>--}}
            {{--                                            <tbody>--}}
            {{--                                            <tr>--}}
            {{--                                                <td class="pl-0">--}}
            {{--                                                    <a href="#"--}}
            {{--                                                       class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-md">{{trans('s_admin.home_work_details_1')}}</a>--}}
            {{--                                                </td>--}}
            {{--                                                <td>--}}
            {{--                                                    <div class="d-flex flex-column w-100 mr-2">--}}
            {{--                                                        <div--}}
            {{--                                                            class="d-flex align-items-center justify-content-between mb-2">--}}
            {{--                                                            <span class="text-muted mr-2 font-size-sm font-weight-bold">65%</span>--}}

            {{--                                                        </div>--}}
            {{--                                                        <div class="progress progress-xs w-100">--}}
            {{--                                                            <div class="progress-bar bg-danger" role="progressbar"--}}
            {{--                                                                 style="width: 65%;" aria-valuenow="50"--}}
            {{--                                                                 aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--                                                        </div>--}}
            {{--                                                    </div>--}}
            {{--                                                </td>--}}
            {{--                                            </tr>--}}
            {{--                                            <tr>--}}
            {{--                                                <td class="pl-0">--}}
            {{--                                                    <a href="#"--}}
            {{--                                                       class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-md">{{trans('s_admin.home_work_details_2')}}</a>--}}
            {{--                                                </td>--}}
            {{--                                                <td>--}}
            {{--                                                    <div class="d-flex flex-column w-100 mr-2">--}}
            {{--                                                        <div--}}
            {{--                                                            class="d-flex align-items-center justify-content-between mb-2">--}}
            {{--                                                            <span class="text-muted mr-2 font-size-sm font-weight-bold">83%</span>--}}

            {{--                                                        </div>--}}
            {{--                                                        <div class="progress progress-xs w-100">--}}
            {{--                                                            <div class="progress-bar bg-success" role="progressbar"--}}
            {{--                                                                 style="width: 83%;" aria-valuenow="50"--}}
            {{--                                                                 aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--                                                        </div>--}}
            {{--                                                    </div>--}}
            {{--                                                </td>--}}
            {{--                                            </tr>--}}
            {{--                                            <tr>--}}
            {{--                                                <td class="py-6 pl-0">--}}
            {{--                                                    <a href="#"--}}
            {{--                                                       class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-md">{{trans('s_admin.home_work_details_3')}}</a>--}}
            {{--                                                </td>--}}
            {{--                                                <td>--}}
            {{--                                                    <div class="d-flex flex-column w-100 mr-2">--}}
            {{--                                                        <div--}}
            {{--                                                            class="d-flex align-items-center justify-content-between mb-2">--}}
            {{--                                                            <span class="text-muted mr-2 font-size-sm font-weight-bold">71%</span>--}}

            {{--                                                        </div>--}}
            {{--                                                        <div class="progress progress-xs w-100">--}}
            {{--                                                            <div class="progress-bar bg-danger" role="progressbar"--}}
            {{--                                                                 style="width: 71%;" aria-valuenow="50"--}}
            {{--                                                                 aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--                                                        </div>--}}
            {{--                                                    </div>--}}
            {{--                                                </td>--}}
            {{--                                            </tr>--}}
            {{--                                            <tr>--}}
            {{--                                                <td class="pl-0">--}}
            {{--                                                    <a href="#"--}}
            {{--                                                       class="text-dark font-weight-bolder text-hover-primary mb-1 font-size-md">{{trans('s_admin.home_work_details_4')}}</a>--}}
            {{--                                                </td>--}}
            {{--                                                <td>--}}
            {{--                                                    <div class="d-flex flex-column w-100 mr-2">--}}
            {{--                                                        <div--}}
            {{--                                                            class="d-flex align-items-center justify-content-between mb-2">--}}
            {{--                                                            <span class="text-muted mr-2 font-size-sm font-weight-bold">50%</span>--}}

            {{--                                                        </div>--}}
            {{--                                                        <div class="progress progress-xs w-100">--}}
            {{--                                                            <div class="progress-bar bg-info" role="progressbar"--}}
            {{--                                                                 style="width: 50%;" aria-valuenow="50"--}}
            {{--                                                                 aria-valuemin="0" aria-valuemax="100"></div>--}}
            {{--                                                        </div>--}}
            {{--                                                    </div>--}}
            {{--                                                </td>--}}
            {{--                                            </tr>--}}
            {{--                                            </tbody>--}}
            {{--                                        </table>--}}
            {{--                                    </div>--}}
            {{--                                    <!--end::Table-->--}}
            {{--                                </div>--}}
            {{--                                <!--end::Tap pane-->--}}
            {{--                            </div>--}}
            {{--                        </div>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--            </div>--}}
        </div>
        <div class="col-md-4">
            <div class="card card-custom" style="height: 1000px;">
                <div class="card-header">
                    <div class="card-title">
                        <span class="svg-icon svg-icon-3x {{auth('student')->user()->icon_color}}">
                           <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Alarm-clock.svg--><svg
                                   xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                   width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path
                                        d="M7.14319965,19.3575259 C7.67122143,19.7615175 8.25104409,20.1012165 8.87097532,20.3649307 L7.89205065,22.0604779 C7.61590828,22.5387706 7.00431787,22.7026457 6.52602525,22.4265033 C6.04773263,22.150361 5.88385747,21.5387706 6.15999985,21.0604779 L7.14319965,19.3575259 Z M15.1367085,20.3616573 C15.756345,20.0972995 16.3358198,19.7569961 16.8634386,19.3524415 L17.8320512,21.0301278 C18.1081936,21.5084204 17.9443184,22.1200108 17.4660258,22.3961532 C16.9877332,22.6722956 16.3761428,22.5084204 16.1000004,22.0301278 L15.1367085,20.3616573 Z"
                                        fill="#000000"/>
                                    <path
                                        d="M12,21 C7.581722,21 4,17.418278 4,13 C4,8.581722 7.581722,5 12,5 C16.418278,5 20,8.581722 20,13 C20,17.418278 16.418278,21 12,21 Z M19.068812,3.25407593 L20.8181344,5.00339833 C21.4039208,5.58918477 21.4039208,6.53893224 20.8181344,7.12471868 C20.2323479,7.71050512 19.2826005,7.71050512 18.696814,7.12471868 L16.9474916,5.37539627 C16.3617052,4.78960984 16.3617052,3.83986237 16.9474916,3.25407593 C17.5332781,2.66828949 18.4830255,2.66828949 19.068812,3.25407593 Z M5.29862906,2.88207799 C5.8844155,2.29629155 6.83416297,2.29629155 7.41994941,2.88207799 C8.00573585,3.46786443 8.00573585,4.4176119 7.41994941,5.00339833 L5.29862906,7.12471868 C4.71284263,7.71050512 3.76309516,7.71050512 3.17730872,7.12471868 C2.59152228,6.53893224 2.59152228,5.58918477 3.17730872,5.00339833 L5.29862906,2.88207799 Z"
                                        fill="#000000" opacity="0.3"/>
                                    <path
                                        d="M11.9630156,7.5 L12.0475062,7.5 C12.3043819,7.5 12.5194647,7.69464724 12.5450248,7.95024814 L13,12.5 L16.2480695,14.3560397 C16.403857,14.4450611 16.5,14.6107328 16.5,14.7901613 L16.5,15 C16.5,15.2109164 16.3290185,15.3818979 16.1181021,15.3818979 C16.0841582,15.3818979 16.0503659,15.3773725 16.0176181,15.3684413 L11.3986612,14.1087258 C11.1672824,14.0456225 11.0132986,13.8271186 11.0316926,13.5879956 L11.4644883,7.96165175 C11.4845267,7.70115317 11.7017474,7.5 11.9630156,7.5 Z"
                                        fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon-->
                           </span>
                        </span>
                        <h3 class="card-label">{{trans('s_admin.pop_notifications')}}</h3>
                    </div>
                </div>
                @php
                    $notification_data = \App\Models\Notification::where('student_id',auth()->guard('student')->user()->id)->where('type','student')->orderBy('id','desc')->get();
                    $new_episodes = \App\Models\Episode_student::where('student_id',auth()->guard('student')->user()->id)->get();
                    $total_new = count($notification_data) + count($new_episodes);
                @endphp
                <div class="card-body">
                    <div data-scroll="true" data-height="800" style="height: 800px; overflow: hidden;"
                         class="scroll ps ps--active-y">
                        <div class="table-responsive">
                            <table class="table table-borderless table-vertical-center">
                                <!--begin::Thead-->
                                <thead>
                                <tr>
                                    <th class="p-0 w-100 min-w-100px"></th>
                                    <th class="p-0 min-w-130px w-100"></th>
                                </tr>
                                </thead>
                                <!--end::Thead-->
                                <!--begin::Tbody-->
                                <tbody>
                                @foreach($notification_data as $row)
                                    <tr @if($row->readed != '1') style="background-color: lavenderblush;" @endif >
                                        <td class="pl-0">
                                            <a href="javascript:void(0);"
                                               class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{$row->title}}</a>
                                            <span class="text-muted font-weight-bold d-block">{{$row->message}}</span>
                                        </td>
                                        <td class="text-right pr-0">
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg">{{$row->created_at->format('Y-m-d')}}  <span
                                                    class="fa fa-genderless text-danger icon-md mr-2"></span></span>
                                        </td>
                                    </tr>
                                @endforeach
                                @foreach($new_episodes as $row)
                                    @if($row->Episode)
                                        <tr @if($row->student_view != '1') style="background-color: lavenderblush;" @endif >
                                            <td class="pl-0">
                                                <a href="{{route('student.my_episodes')}}"
                                                   class="text-dark-75 font-weight-bolder text-hover-primary mb-1 font-size-lg">{{trans('s_admin.aditional_new_epo')}}</a>

                                                <span class="text-muted font-weight-bold d-block">
                                                @if(app()->getLocale() == 'ar') {{$row->Episode->name_ar}} @else {{$row->Episode->name_en}} @endif </span>
                                            </td>
                                            <td class="text-right pr-0">
                                            <span class="text-dark-75 font-weight-bolder d-block font-size-lg"> {{$row->created_at->format('Y-m-d')}} <span
                                                    class="fa fa-genderless text-danger icon-md mr-2"></span></span>
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                                </tbody>
                                <!--end::Tbody-->
                            </table>
                        </div>

                        <div class="ps__rail-x" style="left: 0px; bottom: -165px;">
                            <div class="ps__thumb-x" tabindex="0" style="left: 0px; width: 0px;"></div>
                        </div>
                        <div class="ps__rail-y" style="top: 165px; height: 200px; right: 0px;">
                            <div class="ps__thumb-y" tabindex="0" style="top: 85px; height: 102px;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
