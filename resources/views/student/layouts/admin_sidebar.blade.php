<ul class="menu-nav">
    <li class="menu-item @if(request()->segment(1) == 'student' && request()->segment(2) == 'home' ) menu-item-active  @endif "
        aria-haspopup="true">
        <a href="{{url('/student/home')}}" class="menu-link">
            <span class="svg-icon menu-icon">
                <span class="svg-icon {{auth('student')->user()->icon_color}} svg-icon-2x">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <polygon points="0 0 24 0 24 24 0 24"/>
                        <path
                            d="M12.9336061,16.072447 L19.36,10.9564761 L19.5181585,10.8312381 C20.1676248,10.3169571 20.2772143,9.3735535 19.7629333,8.72408713 C19.6917232,8.63415859 19.6104327,8.55269514 19.5206557,8.48129411 L12.9336854,3.24257445 C12.3871201,2.80788259 11.6128799,2.80788259 11.0663146,3.24257445 L4.47482784,8.48488609 C3.82645598,9.00054628 3.71887192,9.94418071 4.23453211,10.5925526 C4.30500305,10.6811601 4.38527899,10.7615046 4.47382636,10.8320511 L4.63,10.9564761 L11.0659024,16.0730648 C11.6126744,16.5077525 12.3871218,16.5074963 12.9336061,16.072447 Z"
                            fill="#000000" fill-rule="nonzero"/>
                        <path
                            d="M11.0563554,18.6706981 L5.33593024,14.122919 C4.94553994,13.8125559 4.37746707,13.8774308 4.06710397,14.2678211 C4.06471678,14.2708238 4.06234874,14.2738418 4.06,14.2768747 L4.06,14.2768747 C3.75257288,14.6738539 3.82516916,15.244888 4.22214834,15.5523151 C4.22358765,15.5534297 4.2250303,15.55454 4.22647627,15.555646 L11.0872776,20.8031356 C11.6250734,21.2144692 12.371757,21.2145375 12.909628,20.8033023 L19.7677785,15.559828 C20.1693192,15.2528257 20.2459576,14.6784381 19.9389553,14.2768974 C19.9376429,14.2751809 19.9363245,14.2734691 19.935,14.2717619 L19.935,14.2717619 C19.6266937,13.8743807 19.0546209,13.8021712 18.6572397,14.1104775 C18.654352,14.112718 18.6514778,14.1149757 18.6486172,14.1172508 L12.9235044,18.6705218 C12.377022,19.1051477 11.6029199,19.1052208 11.0563554,18.6706981 Z"
                            fill="#000000" opacity="0.3"/>
                    </g>
                </svg>
                    <!--end::Svg Icon-->
            </span>
            </span>
            <span class="menu-text">{{trans('s_admin.nav_home')}}</span>
        </a>
    </li>
    <li class="menu-item menu-item-submenu @if(request()->segment(2) == 'mail') menu-item-open @endif "
        aria-haspopup="true" data-menu-toggle="hover">
        <a href="{{route('student.inbox.in')}}" class="menu-link">
            <span class="svg-icon menu-icon">
                <span class="svg-icon {{auth('student')->user()->icon_color}} svg-icon-2x">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
               <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                    height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path
                                d="M5,9 L19,9 C20.1045695,9 21,9.8954305 21,11 L21,20 C21,21.1045695 20.1045695,22 19,22 L5,22 C3.8954305,22 3,21.1045695 3,20 L3,11 C3,9.8954305 3.8954305,9 5,9 Z M18.1444251,10.8396467 L12,14.1481833 L5.85557487,10.8396467 C5.4908718,10.6432681 5.03602525,10.7797221 4.83964668,11.1444251 C4.6432681,11.5091282 4.77972206,11.9639747 5.14442513,12.1603533 L11.6444251,15.6603533 C11.8664074,15.7798822 12.1335926,15.7798822 12.3555749,15.6603533 L18.8555749,12.1603533 C19.2202779,11.9639747 19.3567319,11.5091282 19.1603533,11.1444251 C18.9639747,10.7797221 18.5091282,10.6432681 18.1444251,10.8396467 Z"
                                fill="#000000"/>
                            <path
                                d="M11.1288761,0.733697713 L11.1288761,2.69017121 L9.12120481,2.69017121 C8.84506244,2.69017121 8.62120481,2.91402884 8.62120481,3.19017121 L8.62120481,4.21346991 C8.62120481,4.48961229 8.84506244,4.71346991 9.12120481,4.71346991 L11.1288761,4.71346991 L11.1288761,6.66994341 C11.1288761,6.94608579 11.3527337,7.16994341 11.6288761,7.16994341 C11.7471877,7.16994341 11.8616664,7.12798964 11.951961,7.05154023 L15.4576222,4.08341738 C15.6683723,3.90498251 15.6945689,3.58948575 15.5161341,3.37873564 C15.4982803,3.35764848 15.4787093,3.33807751 15.4576222,3.32022374 L11.951961,0.352100892 C11.7412109,0.173666017 11.4257142,0.199862688 11.2472793,0.410612793 C11.1708299,0.500907473 11.1288761,0.615386087 11.1288761,0.733697713 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                transform="translate(11.959697, 3.661508) rotate(-270.000000) translate(-11.959697, -3.661508) "/>
                        </g>
                    </svg><!--end::Svg Icon-->
            </span>
            </span>
            <span class="menu-text">{{trans('s_admin.nav_mail')}}

            </span>
        </a>
    </li>


    <li class="menu-item @if(request()->segment(2) == 'my_episodes') menu-item-active  @endif" aria-haspopup="true">
        <a href="{{route('student.my_episodes')}}" class="menu-link">
            <span class="svg-icon menu-icon">
                <span class="svg-icon {{auth('student')->user()->icon_color}} svg-icon-2x">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1">
                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                        <rect x="0" y="0" width="24" height="24"/>
                        <path
                            d="M13.6855025,18.7082217 C15.9113859,17.8189707 18.682885,17.2495635 22,17 C22,16.9325178 22,13.1012863 22,5.50630526 L21.9999762,5.50630526 C21.9999762,5.23017604 21.7761292,5.00632908 21.5,5.00632908 C21.4957817,5.00632908 21.4915635,5.00638247 21.4873465,5.00648922 C18.658231,5.07811173 15.8291155,5.74261533 13,7 C13,7.04449645 13,10.79246 13,18.2438906 L12.9999854,18.2438906 C12.9999854,18.520041 13.2238496,18.7439052 13.5,18.7439052 C13.5635398,18.7439052 13.6264972,18.7317946 13.6855025,18.7082217 Z"
                            fill="#000000"/>
                        <path
                            d="M10.3144829,18.7082217 C8.08859955,17.8189707 5.31710038,17.2495635 1.99998542,17 C1.99998542,16.9325178 1.99998542,13.1012863 1.99998542,5.50630526 L2.00000925,5.50630526 C2.00000925,5.23017604 2.22385621,5.00632908 2.49998542,5.00632908 C2.50420375,5.00632908 2.5084219,5.00638247 2.51263888,5.00648922 C5.34175439,5.07811173 8.17086991,5.74261533 10.9999854,7 C10.9999854,7.04449645 10.9999854,10.79246 10.9999854,18.2438906 L11,18.2438906 C11,18.520041 10.7761358,18.7439052 10.4999854,18.7439052 C10.4364457,18.7439052 10.3734882,18.7317946 10.3144829,18.7082217 Z"
                            fill="#000000" opacity="0.3"/>
                    </g>
                </svg><!--end::Svg Icon-->
            </span>
            </span>
            <span class="menu-text">{{trans('s_admin.my_episodes')}}

            </span>
        </a>
    </li>
    <li class="menu-item @if(request()->segment(2) == 'my_certificates') menu-item-active  @endif" aria-haspopup="true">
        <a href="{{route('student.my_certificates')}}" class="menu-link">
                <span class="svg-icon menu-icon">
                <span class="svg-icon {{auth('student')->user()->icon_color}} svg-icon-2x">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Design/Layers.svg-->
                 <svg
                     xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                     height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon points="0 0 24 0 24 24 0 24"/>
                            <path
                                d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z"
                                fill="#000000"/>
                        </g>
                    </svg>
            </span>
            </span>
            <span class="menu-text">{{trans('s_admin.my_certificates')}}</span>
        </a>
    </li>
    <li class="menu-item menu-item-submenu @if(request()->segment(2) == 'reports') menu-item-open @endif"
        aria-haspopup="true" data-menu-toggle="hover">
        <a href="javascript:void(0);" class="menu-link menu-toggle">
            <span class="svg-icon menu-icon">
                <span class="svg-icon {{auth('student')->user()->icon_color}} svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-bar1.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <rect fill="#000000" opacity="0.3" x="12" y="4" width="3" height="13" rx="1.5"/>
                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="3" height="8" rx="1.5"/>
                    <path
                        d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                        fill="#000000" fill-rule="nonzero"/>
                    <rect fill="#000000" opacity="0.3" x="17" y="11" width="3" height="6" rx="1.5"/>
                </g>
                </svg><!--end::Svg Icon-->
                </span>
            </span>
            <span class="menu-text">{{trans('s_admin.reports')}}</span>
            <i class="menu-arrow"></i>
        </a>
        <div class="menu-submenu">
            <i class="menu-arrow"></i>
            <ul class="menu-subnav">
                <li class="menu-item menu-item-parent" aria-haspopup="true">
                    <span class="menu-link">
                        <span class="menu-text">{{trans('s_admin.reports')}}</span>
                    </span>
                </li>
                <li class="menu-item @if(request()->segment(2) == 'reports' && request()->segment(3) == 'reciting_today') menu-item-open @endif"
                    aria-haspopup="true">
                    <a href="{{route('student.reports.reciting_today')}}" class="menu-link">
                        <i class="menu-bullet menu-bullet-dot">
                            <span></span>
                        </i>
                        <span class="svg-icon menu-icon">
                            <span class="svg-icon {{auth('student')->user()->icon_color}} svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                                        <path
                                            d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                            fill="#000000"/>
                                    </g>
                                </svg><!--end::Svg Icon-->
                            </span>
                        </span>
                        <span class="menu-text">{{trans('s_admin.reports_today_listen')}}</span>
                    </a>
                </li>
            </ul>
        </div>
    </li>
    {{--    <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">--}}
    {{--        <a href="javascript:;" class="menu-link menu-toggle">--}}
    {{--           <span class="svg-icon {{auth('student')->user()->icon_color}} svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Design\Magic.svg--><svg--}}
    {{--                   xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"--}}
    {{--                   height="24px" viewBox="0 0 24 24" version="1.1">--}}
    {{--                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
    {{--                            <rect x="0" y="0" width="24" height="24"/>--}}
    {{--                            <path--}}
    {{--                                d="M1,12 L1,14 L6,14 L6,12 L1,12 Z M0,10 L20,10 C20.5522847,10 21,10.4477153 21,11 L21,15 C21,15.5522847 20.5522847,16 20,16 L0,16 C-0.55228475,16 -1,15.5522847 -1,15 L-1,11 C-1,10.4477153 -0.55228475,10 0,10 Z"--}}
    {{--                                fill="#000000" fill-rule="nonzero"--}}
    {{--                                transform="translate(10.000000, 13.000000) rotate(-225.000000) translate(-10.000000, -13.000000) "/>--}}
    {{--                            <path--}}
    {{--                                d="M17.5,12 L18.5,12 C18.7761424,12 19,12.2238576 19,12.5 L19,13.5 C19,13.7761424 18.7761424,14 18.5,14 L17.5,14 C17.2238576,14 17,13.7761424 17,13.5 L17,12.5 C17,12.2238576 17.2238576,12 17.5,12 Z M20.5,9 L21.5,9 C21.7761424,9 22,9.22385763 22,9.5 L22,10.5 C22,10.7761424 21.7761424,11 21.5,11 L20.5,11 C20.2238576,11 20,10.7761424 20,10.5 L20,9.5 C20,9.22385763 20.2238576,9 20.5,9 Z M21.5,13 L22.5,13 C22.7761424,13 23,13.2238576 23,13.5 L23,14.5 C23,14.7761424 22.7761424,15 22.5,15 L21.5,15 C21.2238576,15 21,14.7761424 21,14.5 L21,13.5 C21,13.2238576 21.2238576,13 21.5,13 Z"--}}
    {{--                                fill="#000000" opacity="0.3"/>--}}
    {{--                        </g>--}}
    {{--                    </svg><!--end::Svg Icon-->--}}
    {{--           </span>--}}
    {{--            <span class="menu-text">{{trans('s_admin.nav_my_orders')}}</span>--}}
    {{--            <i class="menu-arrow"></i>--}}
    {{--        </a>--}}
    {{--        <div class="menu-submenu">--}}
    {{--            <i class="menu-arrow"></i>--}}
    {{--            <ul class="menu-subnav">--}}
    {{--                <li class="menu-item menu-item-parent" aria-haspopup="true">--}}
    {{--                    <span class="menu-link">--}}
    {{--                        <span class="menu-text">{{trans('s_admin.nav_my_orders')}}</span>--}}
    {{--                    </span>--}}
    {{--                </li>--}}
    {{--                <li class="menu-item" aria-haspopup="true">--}}
    {{--                    <a href="javascript:void(0);" class="menu-link">--}}
    {{--                        <i class="menu-bullet menu-bullet-dot">--}}
    {{--                            <span></span>--}}
    {{--                        </i>--}}
    {{--                        <span class="menu-text">{{trans('s_admin.my_requests')}}</span>--}}
    {{--                    </a>--}}
    {{--                </li>--}}
    {{--                <li class="menu-item" aria-haspopup="true">--}}
    {{--                    <a href="javascript:void(0);" class="menu-link">--}}
    {{--                        <i class="menu-bullet menu-bullet-dot">--}}
    {{--                            <span></span>--}}
    {{--                        </i>--}}
    {{--                        <span class="menu-text">{{trans('s_admin.nav_vac_order')}}</span>--}}
    {{--                    </a>--}}
    {{--                </li>--}}
    {{--                <li class="menu-item" aria-haspopup="true">--}}
    {{--                    <a href="javascript:void(0);" class="menu-link">--}}
    {{--                        <i class="menu-bullet menu-bullet-dot">--}}
    {{--                            <span></span>--}}
    {{--                        </i>--}}
    {{--                        <span class="menu-text">{{trans('s_admin.nav_order_permission')}}</span>--}}
    {{--                    </a>--}}
    {{--                </li>--}}
    {{--                <li class="menu-item" aria-haspopup="true">--}}
    {{--                    <a href="javascript:void(0);" class="menu-link">--}}
    {{--                        <i class="menu-bullet menu-bullet-dot">--}}
    {{--                            <span></span>--}}
    {{--                        </i>--}}
    {{--                        <span class="menu-text">{{trans('s_admin.show_come_out')}}</span>--}}
    {{--                    </a>--}}
    {{--                </li>--}}
    {{--                <li class="menu-item" aria-haspopup="true">--}}
    {{--                    <a href="javascript:void(0);" class="menu-link">--}}
    {{--                        <i class="menu-bullet menu-bullet-dot">--}}
    {{--                            <span></span>--}}
    {{--                        </i>--}}
    {{--                        <span class="menu-text"> رفع شكوى وطلب</span>--}}
    {{--                    </a>--}}
    {{--                </li>--}}
    {{--                <li class="menu-item" aria-haspopup="true">--}}
    {{--                    <a href="javascript:void(0);" class="menu-link">--}}
    {{--                        <i class="menu-bullet menu-bullet-dot">--}}
    {{--                            <span></span>--}}
    {{--                        </i>--}}
    {{--                        <span class="menu-text">طلب تغير حلقة / معلم</span>--}}
    {{--                    </a>--}}
    {{--                </li>--}}
    {{--                <li class="menu-item" aria-haspopup="true">--}}
    {{--                    <a href="javascript:void(0);" class="menu-link">--}}
    {{--                        <i class="menu-bullet menu-bullet-dot">--}}
    {{--                            <span></span>--}}
    {{--                        </i>--}}
    {{--                        <span class="menu-text">تغير المعلم</span>--}}
    {{--                    </a>--}}
    {{--                </li>--}}
    {{--                <li class="menu-item" aria-haspopup="true">--}}
    {{--                    <a href="javascript:void(0);" class="menu-link">--}}
    {{--                        <i class="menu-bullet menu-bullet-dot">--}}
    {{--                            <span></span>--}}
    {{--                        </i>--}}
    {{--                        <span class="menu-text">تقييم المقرأه الإلكترونية</span>--}}
    {{--                    </a>--}}
    {{--                </li>--}}
    {{--            </ul>--}}
    {{--        </div>--}}
    {{--    </li>--}}
</ul>
