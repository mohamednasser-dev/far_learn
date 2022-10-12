@extends('admin_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.nav_home')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('content')
    @php
        $absence_num = \App\Models\Plan_section_degree::where('type','absence')->get();
        $come_num = \App\Models\Episode_section::where('status','ended')->get();
        $total_come = 0;
        foreach($come_num as $row){
            $total_come = $total_come+$row->come_num;
        }
    @endphp
    @if(Request()->getHost() == env('maindomain','127.0.0.1'))

    @else
        <div class="row">
            <div class="col-md-3">
                <div class="card card-custom gutter-b" style="height: 150px">
                    <div class="card-body">
                    <span class="svg-icon svg-icon-3x svg-icon-success">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Address-card.svg--><svg
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path
                                    d="M6,2 L18,2 C19.6568542,2 21,3.34314575 21,5 L21,19 C21,20.6568542 19.6568542,22 18,22 L6,22 C4.34314575,22 3,20.6568542 3,19 L3,5 C3,3.34314575 4.34314575,2 6,2 Z M12,11 C13.1045695,11 14,10.1045695 14,9 C14,7.8954305 13.1045695,7 12,7 C10.8954305,7 10,7.8954305 10,9 C10,10.1045695 10.8954305,11 12,11 Z M7.00036205,16.4995035 C6.98863236,16.6619875 7.26484009,17 7.4041679,17 C11.463736,17 14.5228466,17 16.5815,17 C16.9988413,17 17.0053266,16.6221713 16.9988413,16.5 C16.8360465,13.4332455 14.6506758,12 11.9907452,12 C9.36772908,12 7.21569918,13.5165724 7.00036205,16.4995035 Z"
                                    fill="#000000"/>
                            </g>
                        </svg><!--end::Svg Icon-->
                        <!--end::Svg Icon-->
                    </span>
                        <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{count($teachers)}}</div>
                        <a class="text-muted font-weight-bold font-size-lg mt-1">{{trans('s_admin.teachers_number')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-custom gutter-b" style="height: 150px">
                    <div class="card-body">
                        <span class="svg-icon svg-icon-3x svg-icon-success">
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
                        <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{count($episodes)}}</div>
                        <a class="text-muted font-weight-bold font-size-lg mt-1">{{trans('s_admin.chanel_number')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-custom gutter-b" style="height: 150px">
                    <div class="card-body">
                    <span class="svg-icon svg-icon-3x svg-icon-success">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
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
                        <div class="text-dark font-weight-bolder font-size-h2 mt-3">{{count($students)}}</div>
                        <a class="text-muted  font-weight-bold font-size-lg mt-1">{{trans('s_admin.student_number')}}</a>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card card-custom gutter-b" style="height: 150px">
                    <div class="card-body">
                    <span class="svg-icon svg-icon-3x svg-icon-success">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Group.svg-->
                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Like.svg--><svg
                            xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                            height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path
                                    d="M9,10 L9,19 L10.1525987,19.3841996 C11.3761964,19.7920655 12.6575468,20 13.9473319,20 L17.5405883,20 C18.9706314,20 20.2018758,18.990621 20.4823303,17.5883484 L21.231529,13.8423552 C21.5564648,12.217676 20.5028146,10.6372006 18.8781353,10.3122648 C18.6189212,10.260422 18.353992,10.2430672 18.0902299,10.2606513 L14.5,10.5 L14.8641964,6.49383981 C14.9326895,5.74041495 14.3774427,5.07411874 13.6240179,5.00562558 C13.5827848,5.00187712 13.5414031,5 13.5,5 L13.5,5 C12.5694044,5 11.7070439,5.48826024 11.2282564,6.28623939 L9,10 Z"
                                    fill="#000000"/>
                                <rect fill="#000000" opacity="0.3" x="2" y="9" width="5" height="11" rx="1"/>
                            </g>
                        </svg><!--end::Svg Icon-->
                        <!--end::Svg Icon-->
                    </span>
                        <div class="text-dark font-weight-bolder font-size-h2 mt-3">0</div>
                        <a class="text-muted  font-weight-bold font-size-lg mt-1">{{trans('s_admin.student_number_ended_tournament')}}</a>
                    </div>
                </div>
            </div>
        </div>
        {{--    <div class="row">--}}
        {{--        <div class="col-md-3">--}}
        {{--            <div class="card card-custom gutter-b bg-light-warning" style="height: 150px">--}}
        {{--                <div class="card-body">--}}
        {{--                    <div class="row">--}}
        {{--                        <div class="col-md-6">--}}
        {{--                    <span class="svg-icon svg-icon-3x svg-icon-warning d-block my-2">--}}
        {{--                    <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Media/Equalizer.svg-->--}}
        {{--                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"--}}
        {{--                         height="24px" viewBox="0 0 24 24" version="1.1">--}}
        {{--                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
        {{--                    <rect x="0" y="0" width="24" height="24"></rect>--}}
        {{--                    <rect fill="#000000" opacity="0.3" x="13" y="4" width="3" height="16" rx="1.5"></rect>--}}
        {{--                    <rect fill="#000000" x="8" y="9" width="3" height="11" rx="1.5"></rect>--}}
        {{--                    <rect fill="#000000" x="18" y="11" width="3" height="9" rx="1.5"></rect>--}}
        {{--                    <rect fill="#000000" x="3" y="13" width="3" height="7" rx="1.5"></rect>--}}
        {{--                    </g>--}}
        {{--                    </svg>--}}
        {{--                        <!--end::Svg Icon-->--}}
        {{--                    </span>--}}
        {{--                            <div class="text-dark font-weight-bolder font-size-h2 mt-3">--}}
        {{--                                <span style="font-size:1.2em;"--}}
        {{--                                      class="text-warning font-weight-bold mt-2">{{count($studets_male)}}</span>--}}
        {{--                            </div>--}}
        {{--                            <a  class="text-warning font-weight-bold font-size-h6">{{trans('s_admin.male_num')}}</a>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="col-md-3">--}}
        {{--            <div class="card card-custom gutter-b bg-light-primary" style="height: 150px">--}}
        {{--                <div class="card-body">--}}
        {{--                    <div class="row">--}}
        {{--                        <div class="col-md-6">--}}
        {{--                    <span class="svg-icon svg-icon-3x svg-icon-primary d-block my-2">--}}
        {{--                        <!--begin::Svg Icon | path:/metronic/theme/html/demo1/dist/assets/media/svg/icons/Communication/Add-user.svg-->--}}
        {{--                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"--}}
        {{--                             height="24px" viewBox="0 0 24 24" version="1.1">--}}
        {{--                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
        {{--                                <polygon points="0 0 24 0 24 24 0 24"></polygon>--}}
        {{--                                <path--}}
        {{--                                    d="M18,8 L16,8 C15.4477153,8 15,7.55228475 15,7 C15,6.44771525 15.4477153,6 16,6 L18,6 L18,4 C18,3.44771525 18.4477153,3 19,3 C19.5522847,3 20,3.44771525 20,4 L20,6 L22,6 C22.5522847,6 23,6.44771525 23,7 C23,7.55228475 22.5522847,8 22,8 L20,8 L20,10 C20,10.5522847 19.5522847,11 19,11 C18.4477153,11 18,10.5522847 18,10 L18,8 Z M9,11 C6.790861,11 5,9.209139 5,7 C5,4.790861 6.790861,3 9,3 C11.209139,3 13,4.790861 13,7 C13,9.209139 11.209139,11 9,11 Z"--}}
        {{--                                    fill="#000000" fill-rule="nonzero" opacity="0.3"></path>--}}
        {{--                                <path--}}
        {{--                                    d="M0.00065168429,20.1992055 C0.388258525,15.4265159 4.26191235,13 8.98334134,13 C13.7712164,13 17.7048837,15.2931929 17.9979143,20.2 C18.0095879,20.3954741 17.9979143,21 17.2466999,21 C13.541124,21 8.03472472,21 0.727502227,21 C0.476712155,21 -0.0204617505,20.45918 0.00065168429,20.1992055 Z"--}}
        {{--                                    fill="#000000" fill-rule="nonzero"></path>--}}
        {{--                            </g>--}}
        {{--                        </svg>--}}
        {{--                        <!--end::Svg Icon-->--}}
        {{--                    </span>--}}
        {{--                            <div class="text-dark font-weight-bolder font-size-h2 mt-3">--}}
        {{--                                <span style="font-size:1.2em;"--}}
        {{--                                      class="text-primary font-weight-bold mt-2">{{count($studets_female)}}</span>--}}
        {{--                            </div>--}}
        {{--                            <a class="text-primary font-weight-bold font-size-h6 mt-2">{{trans('s_admin.female_num')}}</a>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="col-md-3">--}}
        {{--            <div class="card card-custom gutter-b bg-light-success" style="height: 150px">--}}
        {{--                <div class="card-body">--}}
        {{--                    <div class="row">--}}
        {{--                        <div class="col-md-12">--}}
        {{--                    <span class="svg-icon svg-icon-3x svg-icon-success d-block my-2">--}}
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
        {{--                        <!--end::Svg Icon-->--}}
        {{--                        </span>--}}
        {{--                            <div class="text-dark font-weight-bolder font-size-h2 mt-3">--}}
        {{--                                <span style="font-size:1.2em;"--}}
        {{--                                      class="text-success font-weight-bold mt-2">{{$total_come}}</span>--}}
        {{--                            </div>--}}
        {{--                            <a class="text-success font-weight-bold font-size-h6 mt-2">{{trans('s_admin.come_number')}}</a>--}}
        {{--                        </div>--}}

        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--        <div class="col-md-3">--}}
        {{--            <div class="card card-custom gutter-b bg-light-danger" style="height: 150px">--}}
        {{--                <div class="card-body">--}}
        {{--                    <div class="row">--}}
        {{--                        <div class="col-md-6">--}}
        {{--            <span class="svg-icon svg-icon-3x svg-icon-danger d-block my-2">--}}
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
        {{--                <!--end::Svg Icon-->--}}
        {{--            </span>--}}
        {{--                            <div class="text-dark font-weight-bolder font-size-h2 mt-3">--}}
        {{--                                <span style="font-size:1.2em;"--}}
        {{--                                      class="text-danger font-weight-bold mt-2">{{count($absence_num)}}</span>--}}
        {{--                            </div>--}}
        {{--                            <a class="text-danger font-weight-bold font-size-h6 mt-2">{{trans('s_admin.leave_number')}}</a>--}}
        {{--                        </div>--}}
        {{--                    </div>--}}
        {{--                </div>--}}
        {{--            </div>--}}
        {{--        </div>--}}
        {{--    </div>--}}
        <div class="row">
            @if(auth()->user()->role_id == 2)
                <div class="col-lg-6">
                    <!--begin::Card-->
                    <div class="card card-custom gutter-b">
                        <div class="card-header">
                            <div class="card-title">
                                <h3 class="card-label"> {{ trans('s_admin.chanel_number') }}</h3>
                            </div>
                        </div>
                        <div class="card-body" style="height: 278px;">
                            <!--begin::Chart-->
                            <div id="chart_12" class="d-flex justify-content-center"></div>
                            <!--end::Chart-->
                        </div>
                    </div>
                    <!--end::Card-->
                </div>
            @endif
            {{--        <div class="col-lg-6">--}}
            {{--            <!--begin::Card-->--}}
            {{--            <div class="card card-custom gutter-b">--}}
            {{--                <div class="card-header">--}}
            {{--                    <div class="card-title">--}}
            {{--                        <h3 class="card-label">{{ trans('s_admin.students') }}</h3>--}}
            {{--                    </div>--}}
            {{--                </div>--}}
            {{--                <div class="card-body" style="height: 278px;">--}}
            {{--                    <!--begin::Chart-->--}}
            {{--                    <div id="chart_11" class="d-flex justify-content-center"></div>--}}
            {{--                    <!--end::Chart-->--}}
            {{--                </div>--}}
            {{--            </div>--}}
            {{--            <!--end::Card-->--}}
            {{--        </div>--}}
            <div class="col-lg-6">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">{{ trans('s_admin.mogmaa_dorr_num') }}</h3>
                        </div>
                    </div>
                    <div class="card-body" style="height: 278px;">
                        <!--begin::Chart-->
                        <div id="chart_111" class="d-flex justify-content-center"></div>
                        <!--end::Chart-->
                    </div>
                </div>
                <!--end::Card-->
            </div>

        </div>
        <div class="row">
            <div class="col-lg-12">
                <!--begin::Card-->
                <div class="card card-custom gutter-b">
                    <div class="card-header">
                        <div class="card-title">
                            <h3 class="card-label">{{trans('s_admin.sign_up_reports')}} {{$year}}</h3>
                        </div>
                    </div>
                    <div class="card-body">
                        <div id="chart_3"></div>
                    </div>
                </div>
            </div>
        </div>
    @endif

@endsection
@section('scripts')
    {{--    <script src="{{ asset('metronic/assets/js/pages/features/charts/apexcharts.js') }}"></script>--}}

    <script>
        "use strict";

        // Shared Colors Definition
        const primary = '#6993FF';
        const success = '#1BC5BD';
        const info = '#8950FC';
        const warning = '#FFA800';
        const danger = '#F64E60';

        // Class definition
        function generateBubbleData(baseval, count, yrange) {
            var i = 0;
            var series = [];
            while (i < count) {
                var x = Math.floor(Math.random() * (750 - 1 + 1)) + 1;
                ;
                var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;
                var z = Math.floor(Math.random() * (75 - 15 + 1)) + 15;

                series.push([x, y, z]);
                baseval += 86400000;
                i++;
            }
            return series;
        }

        function generateData(count, yrange) {
            var i = 0;
            var series = [];
            while (i < count) {
                var x = 'w' + (i + 1).toString();
                var y = Math.floor(Math.random() * (yrange.max - yrange.min + 1)) + yrange.min;

                series.push({
                    x: x,
                    y: y
                });
                i++;
            }
            return series;
        }

        var _demo3 = function () {
            const apexChart = "#chart_3";
            var options = {
                series: [{
                    name: 'الطلاب',
                    data: {!! $student_arr !!}
                }, {
                    name: 'المعلمين',
                    data: {!! $teacher_arr !!}
                }],
                chart: {
                    type: 'bar',
                    height: 350
                },
                plotOptions: {
                    bar: {
                        horizontal: false,
                        columnWidth: '55%',
                        endingShape: 'rounded'
                    },
                },
                dataLabels: {
                    enabled: false
                },
                stroke: {
                    show: true,
                    width: 2,
                    colors: ['عدد التسجيل الجديد']
                },
                xaxis: {
                    categories: ['Jun', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'nov', 'des'],
                },
                yaxis: {
                    title: {
                        text: ''
                    }
                },
                fill: {
                    opacity: 1
                },
                tooltip: {
                    y: {
                        formatter: function (val) {
                            return " " + val + " "
                        }
                    }
                },
                colors: [primary, success, warning]
            };

            var chart = new ApexCharts(document.querySelector(apexChart), options);
            chart.render();
        }

        var KTApexChartsDemo = function () {
            // Private functions

            var _demo5 = function () {
                const apexChart = "#chart_5";
                var options = {
                    series: [{
                        name: 'الطلاب',
                        type: 'column',
                        data:  {!! $student_arr !!}
                    }, {
                        name: 'المعلمين',
                        type: 'column',
                        data: {!! $teacher_arr !!}
                    }],
                    chart: {
                        height: 350,
                        type: 'line',
                        stacked: false
                    },
                    dataLabels: {
                        enabled: false
                    },
                    stroke: {
                        width: [1, 1, 4]
                    },
                    title: {
                        text: 'عدد انشاء الحساب',
                        align: 'left',
                        offsetX: 110
                    },
                    xaxis: {
                        text: 'الشهور',
                        categories: {!! $months !!},
                    },
                    yaxis: [
                        {
                            axisTicks: {
                                show: true,
                            },
                            axisBorder: {
                                show: true,
                                color: primary
                            },
                            labels: {
                                style: {
                                    colors: primary,
                                }
                            },
                            title: {
                                text: "",
                                style: {
                                    color: primary,
                                }
                            },
                            tooltip: {
                                enabled: true
                            }
                        },
                        {
                            seriesName: 'Income',
                            opposite: true,
                            axisTicks: {
                                show: true,
                            },
                            axisBorder: {
                                show: true,
                                color: success
                            },
                            labels: {
                                style: {
                                    colors: success,
                                }
                            },
                            title: {
                                text: "",
                                style: {
                                    color: success,
                                }
                            },
                        },
                        {
                            seriesName: 'Revenue',
                            opposite: true,
                            axisTicks: {
                                show: true,
                            },
                            axisBorder: {
                                show: true,
                                color: warning
                            },
                            labels: {
                                style: {
                                    colors: warning,
                                },
                            },
                            title: {
                                text: "Revenue (thousand crores)",
                                style: {
                                    color: warning,
                                }
                            }
                        },
                    ],
                    tooltip: {
                        fixed: {
                            enabled: true,
                            position: 'topLeft', // topRight, topLeft, bottomRight, bottomLeft
                            offsetY: 30,
                            offsetX: 60
                        },
                    },
                    legend: {
                        horizontalAlign: 'left',
                        offsetX: 40
                    }
                };

                var chart = new ApexCharts(document.querySelector(apexChart), options);
                chart.render();
            }

            var _demo11 = function () {
                const apexChart = "#chart_11";
                var options = {
                    series: [ {!! $students_numbers !!} , {!! $teachers_numbers !!} ],
                    chart: {
                        width: 380,
                        type: 'donut',
                    },
                    labels:  {!! $people_names !!}  ,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                    colors: [warning, info]
                };

                var chart = new ApexCharts(document.querySelector(apexChart), options);
                chart.render();
            }
            var _demo111 = function () {
                const apexChart = "#chart_111";
                var options = {
                    series: [ {!! $acc_students_numbers !!} , {!! $rej_students_numbers !!} ],
                    chart: {
                        width: 380,
                        type: 'donut',
                    },
                    labels:  {!! $episode_names_rejected !!}  ,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                    colors: [success, danger]
                };

                var chart = new ApexCharts(document.querySelector(apexChart), options);
                chart.render();
            }
            var _demo12 = function () {
                const apexChart = "#chart_12";
                var options = {
                    series: [ {!! $mqraa_epo !!}, {!! $mogmaa_epo !!}, {!! $dorr_epo !!} ],
                    chart: {
                        width: 380,
                        type: 'pie',
                    },
                    labels:  {!! $episode_mqraa_name !!}  ,
                    responsive: [{
                        breakpoint: 480,
                        options: {
                            chart: {
                                width: 200
                            },
                            legend: {
                                position: 'bottom'
                            }
                        }
                    }],
                    colors: [primary, success, warning]
                };

                var chart = new ApexCharts(document.querySelector(apexChart), options);
                chart.render();
            }


            return {
                // public functions
                init: function () {
                    _demo3();
                    _demo11();
                    _demo111();
                    _demo12();
                }
            };
        }();

        jQuery(document).ready(function () {
            KTApexChartsDemo.init();
        });

    </script>
    {{--    <script src="//maps.google.com/maps/api/js?key=AIzaSyBTGnKT7dt597vo9QgeQ7BFhvSRP4eiMSM"></script>--}}
    {{--    <script src="{{ asset('metronic/assets/plugins/custom/gmaps/gmaps.js') }}"></script>--}}
@endsection
