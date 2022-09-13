<div id="kt_header_mobile" class="header-mobile align-items-center header-mobile-fixed">
    <!--begin::Logo-->
{{--    <a href="{{url('/teacher/home')}}">--}}
{{--        @if(session('lang')=='en')--}}
{{--            <img alt="Logo" src="{{ asset('metronic/assets/media/logos/logo_en.png') }}"/>--}}
{{--        @else--}}
{{--            <img alt="Logo" src="{{ asset('metronic/assets/media/logos/logo_ar.png') }}"/>--}}
{{--        @endif--}}
{{--    </a>--}}
<!--end::Logo-->
    <!--begin::Toolbar-->
    <div class="d-flex align-items-center">
        <!--begin::Aside Mobile Toggle-->
        <button class="btn p-0 burger-icon burger-icon-left" id="kt_aside_mobile_toggle">
            <span></span>
        </button>
        <!--end::Aside Mobile Toggle-->
        <!--begin::Header Menu Mobile Toggle-->
        <button class="btn p-0 burger-icon ml-4" id="kt_header_mobile_toggle">
            <span></span>
        </button>
        <!--end::Header Menu Mobile Toggle-->
        <!--begin::Topbar Mobile Toggle-->
        <button class="btn btn-hover-text-primary p-0 ml-2" id="kt_header_mobile_topbar_toggle">
                    <span class="svg-icon svg-icon-xl">
                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <polygon points="0 0 24 0 24 24 0 24"/>
                                <path
                                    d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path
                                    d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                    fill="#000000" fill-rule="nonzero"/>
                            </g>
                        </svg>
                        <!--end::Svg Icon-->
                    </span>
        </button>
        <!--end::Topbar Mobile Toggle-->
    </div>
    <!--end::Toolbar-->
</div>
<!--end::Header Mobile-->
<div class="d-flex flex-column flex-root">
    <!--begin::Page-->
    <div class="d-flex flex-row flex-column-fluid page">
        <!--begin::Aside-->
        <div class="aside aside-left aside-fixed d-flex flex-column flex-row-auto" id="kt_aside">
            <!--begin::Brand-->
            <div class="brand flex-column-auto" id="kt_brand">
                <!--begin::Logo-->
                <a href="{{url('/teacher/home')}}" class="brand-logo">
                    {{--                    @if(session('lang')=='en')--}}
                    {{--                        <img alt="Logo" style="width: 170px;"--}}
                    {{--                             src="{{ asset('metronic/assets/media/logos/logo_en.png') }}"/>--}}
                    {{--                    @else--}}
                    {{--                        <img alt="Logo" style="width: 170px;"--}}
                    {{--                             src="{{ asset('metronic/assets/media/logos/logo_ar.png') }}"/>--}}
                    {{--                    @endif--}}
                </a>
                <!--end::Logo-->
                <!--begin::Toggle-->
                <button class="brand-toggle btn btn-sm px-0" id="kt_aside_toggle">
                            <span class="svg-icon svg-icon svg-icon-xl">
                                <!--begin::Svg Icon | path:assets/media/svg/icons/Navigation/Angle-double-left.svg-->
                                <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                     width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <polygon points="0 0 24 0 24 24 0 24"/>
                                        <path
                                            d="M5.29288961,6.70710318 C4.90236532,6.31657888 4.90236532,5.68341391 5.29288961,5.29288961 C5.68341391,4.90236532 6.31657888,4.90236532 6.70710318,5.29288961 L12.7071032,11.2928896 C13.0856821,11.6714686 13.0989277,12.281055 12.7371505,12.675721 L7.23715054,18.675721 C6.86395813,19.08284 6.23139076,19.1103429 5.82427177,18.7371505 C5.41715278,18.3639581 5.38964985,17.7313908 5.76284226,17.3242718 L10.6158586,12.0300721 L5.29288961,6.70710318 Z"
                                            fill="#000000" fill-rule="nonzero"
                                            transform="translate(8.999997, 11.999999) scale(-1, 1) translate(-8.999997, -11.999999)"/>
                                        <path
                                            d="M10.7071009,15.7071068 C10.3165766,16.0976311 9.68341162,16.0976311 9.29288733,15.7071068 C8.90236304,15.3165825 8.90236304,14.6834175 9.29288733,14.2928932 L15.2928873,8.29289322 C15.6714663,7.91431428 16.2810527,7.90106866 16.6757187,8.26284586 L22.6757187,13.7628459 C23.0828377,14.1360383 23.1103407,14.7686056 22.7371482,15.1757246 C22.3639558,15.5828436 21.7313885,15.6103465 21.3242695,15.2371541 L16.0300699,10.3841378 L10.7071009,15.7071068 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"
                                            transform="translate(15.999997, 11.999999) scale(-1, 1) rotate(-270.000000) translate(-15.999997, -11.999999)"/>
                                    </g>
                                </svg>
                                <!--end::Svg Icon-->
                            </span>
                </button>
                <!--end::Toolbar-->
            </div>
            <!--end::Brand-->
            <!--begin::Aside Menu-->
            <div class="aside-menu-wrapper flex-column-fluid" id="kt_aside_menu_wrapper">
                <!--begin::Menu Container-->
                <div id="kt_aside_menu" class="aside-menu my-4" data-menu-vertical="1" data-menu-scroll="1"
                     data-menu-dropdown-timeout="500">
                    <!--begin::Menu Nav-->

                @include('teacher.layouts.admin_sidebar')
                <!--end::Menu Nav-->
                </div>
                <!--end::Menu Container-->
            </div>
            <!--end::Aside Menu-->
        </div>
        <!--end::Aside-->
        <!--begin::Wrapper-->
        <div class="d-flex flex-column flex-row-fluid wrapper" id="kt_wrapper">
            <!--begin::Header-->
            <div id="kt_header" class="header header-fixed" style="background-color: #1e1e2d;">
                <!--begin::Container-->
                <div class="container-fluid d-flex align-items-stretch justify-content-between">
                    <!--begin::Header Menu Wrapper-->
                    <div class="header-menu-wrapper header-menu-wrapper-left" id="kt_header_menu_wrapper">
                        <!--begin::Header Menu-->
                        <div id="kt_header_menu" class="header-menu header-menu-mobile header-menu-layout-default">
                            <ul class="menu-nav">
                                <li class="menu-item menu-item-submenu menu-item-rel menu-item-active"
                                    data-menu-toggle="click" aria-haspopup="true">
                                    <a href="{{url('/')}}" target="_blank" class="menu-link"
                                       style="background-color: beige;">
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                             height="24px" viewBox="0 0 24 24" version="1.1">

                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="9"/>
                                                <path
                                                    d="M11.7357634,20.9961946 C6.88740052,20.8563914 3,16.8821712 3,12 C3,11.9168367 3.00112797,11.8339369 3.00336944,11.751315 C3.66233009,11.8143341 4.85636818,11.9573854 4.91262842,12.4204038 C4.9904938,13.0609191 4.91262842,13.8615942 5.45804656,14.101772 C6.00346469,14.3419498 6.15931561,13.1409372 6.6267482,13.4612567 C7.09418079,13.7815761 8.34086797,14.0899175 8.34086797,14.6562185 C8.34086797,15.222396 8.10715168,16.1034596 8.34086797,16.2636193 C8.57458427,16.423779 9.5089688,17.54465 9.50920913,17.7048097 C9.50956962,17.8649694 9.83857487,18.6793513 9.74040201,18.9906563 C9.65905192,19.2487394 9.24857641,20.0501554 8.85059781,20.4145589 C9.75315358,20.7620621 10.7235846,20.9657742 11.7357634,20.9960544 L11.7357634,20.9961946 Z M8.28272988,3.80112099 C9.4158415,3.28656421 10.6744554,3 12,3 C15.5114513,3 18.5532143,5.01097452 20.0364482,7.94408274 C20.069657,8.72412177 20.0638332,9.39135321 20.2361262,9.6327358 C21.1131932,10.8600506 18.0995147,11.7043158 18.5573343,13.5605384 C18.7589671,14.3794892 16.5527814,14.1196773 16.0139722,14.886394 C15.4748026,15.6527403 14.1574598,15.137809 13.8520064,14.9904917 C13.546553,14.8431744 12.3766497,15.3341497 12.4789081,14.4995164 C12.5805657,13.664636 13.2922889,13.6156126 14.0555619,13.2719546 C14.8184743,12.928667 15.9189236,11.7871741 15.3781918,11.6380045 C12.8323064,10.9362407 11.963771,8.47852395 11.963771,8.47852395 C11.8110443,8.44901109 11.8493762,6.74109366 11.1883616,6.69207022 C10.5267462,6.64279981 10.170464,6.88841096 9.20435656,6.69207022 C8.23764828,6.49572949 8.44144409,5.85743687 8.2887174,4.48255778 C8.25453994,4.17415686 8.25619136,3.95717082 8.28272988,3.80112099 Z M20.9991771,11.8770357 C20.9997251,11.9179585 21,11.9589471 21,12 C21,16.9406923 17.0188468,20.9515364 12.0895088,20.9995641 C16.970233,20.9503326 20.9337111,16.888438 20.9991771,11.8770357 Z"
                                                    fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg>
                                        <span class="menu-text">{{trans('s_admin.web')}}</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                        <!--end::Header Menu-->
                    </div>
                    <!--end::Header Menu Wrapper-->
                    <!--begin::Topbar-->
                    <div class="topbar">-
                        <!--begin::Notifications-->
                        <div class="dropdown">
                            <!--begin::Toggle-->
                            @php
                                $notification_data = \App\Models\Notification::where('teacher_id',auth()->guard('teacher')->user()->id)->where('type','teacher')->where('message_type',"!=",'inbox')->where('readed','0')->orderBy('id','desc')->get();
                                $inboxes = \App\Models\Notification::where('teacher_id',auth()->guard('teacher')->user()->id)->where('readed','0')->where('message_type','inbox')->get();
                                $un_view_epos = \App\Models\Episode::where('teacher_id',auth()->guard('teacher')->user()->id)->where('teacher_view',0)->where('deleted', '0')->get()->count();
                                $total_new = $un_view_epos + count($notification_data) + $inboxes->count();
                            @endphp
                            <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                @if($total_new > 0)

                                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1 pulse pulse-danger">
                                        <span
                                            style="color: red;font-weight: bold;font-size: 18px;">{{$total_new}}</span>
                                        <span class="svg-icon svg-icon-xl svg-icon-danger">

                                        @else
                                                <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
											<span class="svg-icon svg-icon-xl svg-icon-primary">
                                        @endif
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/Code/Compiling.svg-->
												<svg xmlns="http://www.w3.org/2000/svg"
                                                     xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                                     height="24px" viewBox="0 0 24 24" version="1.1">
													<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
														<rect x="0" y="0" width="24" height="24"/>
														<path
                                                            d="M2.56066017,10.6819805 L4.68198052,8.56066017 C5.26776695,7.97487373 6.21751442,7.97487373 6.80330086,8.56066017 L8.9246212,10.6819805 C9.51040764,11.267767 9.51040764,12.2175144 8.9246212,12.8033009 L6.80330086,14.9246212 C6.21751442,15.5104076 5.26776695,15.5104076 4.68198052,14.9246212 L2.56066017,12.8033009 C1.97487373,12.2175144 1.97487373,11.267767 2.56066017,10.6819805 Z M14.5606602,10.6819805 L16.6819805,8.56066017 C17.267767,7.97487373 18.2175144,7.97487373 18.8033009,8.56066017 L20.9246212,10.6819805 C21.5104076,11.267767 21.5104076,12.2175144 20.9246212,12.8033009 L18.8033009,14.9246212 C18.2175144,15.5104076 17.267767,15.5104076 16.6819805,14.9246212 L14.5606602,12.8033009 C13.9748737,12.2175144 13.9748737,11.267767 14.5606602,10.6819805 Z"
                                                            fill="#000000" opacity="0.3"/>
														<path
                                                            d="M8.56066017,16.6819805 L10.6819805,14.5606602 C11.267767,13.9748737 12.2175144,13.9748737 12.8033009,14.5606602 L14.9246212,16.6819805 C15.5104076,17.267767 15.5104076,18.2175144 14.9246212,18.8033009 L12.8033009,20.9246212 C12.2175144,21.5104076 11.267767,21.5104076 10.6819805,20.9246212 L8.56066017,18.8033009 C7.97487373,18.2175144 7.97487373,17.267767 8.56066017,16.6819805 Z M8.56066017,4.68198052 L10.6819805,2.56066017 C11.267767,1.97487373 12.2175144,1.97487373 12.8033009,2.56066017 L14.9246212,4.68198052 C15.5104076,5.26776695 15.5104076,6.21751442 14.9246212,6.80330086 L12.8033009,8.9246212 C12.2175144,9.51040764 11.267767,9.51040764 10.6819805,8.9246212 L8.56066017,6.80330086 C7.97487373,6.21751442 7.97487373,5.26776695 8.56066017,4.68198052 Z"
                                                            fill="#000000"/>
													</g>
												</svg>
                                            <!--end::Svg Icon-->
											</span>
                                    <span class="pulse-ring"></span>
                                </div>
                                    </div>
                                    <!--end::Toggle-->
                                    <!--begin::Dropdown-->
                                    <div
                                        class="dropdown-menu p-0 m-0 dropdown-menu-right dropdown-menu-anim-up dropdown-menu-lg">
                                        <form>
                                            <!--begin::Header-->
                                            <div
                                                class="d-flex flex-column pt-12 bgi-size-cover bgi-no-repeat rounded-top"
                                                style="background-image: url(/metronic/assets/media/misc/bg-1.jpg)">
                                                <!--begin::Title-->
                                                <h4 class="d-flex flex-center rounded-top">
                                                    <span
                                                        class="text-white">{{trans('s_admin.pop_notifications')}}</span>

                                                    <span
                                                        class="btn btn-text btn-success btn-sm font-weight-bold btn-font-md ml-2">{{$total_new}} {{trans('s_admin.new')}}</span>
                                                </h4>
                                                <!--end::Title-->
                                                <!--begin::Tabs-->
                                                <ul class="nav nav-bold nav-tabs nav-tabs-line nav-tabs-line-3x nav-tabs-line-transparent-white nav-tabs-line-active-border-success mt-3 px-8"
                                                    role="tablist">
                                                    <li class="nav-item">
                                                        <a class="nav-link active show" data-toggle="tab"
                                                           href="#topbar_notifications_notifications">{{trans('s_admin.alerts')}}</a>
                                                    </li>


                                                </ul>
                                                <!--end::Tabs-->
                                            </div>
                                            <!--end::Header-->
                                            <!--begin::Content-->
                                            <div class="tab-content">
                                                <!--begin::Tabpane-->
                                                <div class="tab-pane active show p-8"
                                                     id="topbar_notifications_notifications" role="tabpanel">
                                                    <!--begin::Scroll-->
                                                    <div class="scroll pr-7 mr-n7" data-scroll="true" data-height="300"
                                                         data-mobile-height="200">
                                                        <!--begin::Item-->
                                                        @if($inboxes->count() > 0)
                                                            @foreach($inboxes as $row)
                                                                <div class="d-flex align-items-center mb-6">
                                                                    <!--begin::Symbol-->
                                                                    <div class="symbol symbol-40 symbol-light-primary mr-5">
                                                                   <span class="svg-icon menu-icon">
                <!--begin::Svg Icon | path:assets/media/svg/icons/Layout/Layout-arrange.svg-->
                                                                    <span class="svg-icon svg-icon-success svg-icon-2x">
                                                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Incoming-mail.svg-->
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
                                                                    </div>
                                                                    <!--end::Symbol-->
                                                                    <!--begin::Text-->
                                                                    <div class="d-flex flex-column font-weight-bold">
                                                                        <a href="{{route("teacher.inbox.reply",[$row->inbox_id])}}"
                                                                           class="text-dark text-hover-primary mb-1 font-size-lg">{{trans('s_admin.new_inbox')}}</a>
                                                                        <span
                                                                            class="text-muted">{{$row->title}}</span>
                                                                    </div>
                                                                    <!--end::Text-->
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                        @if($un_view_epos > 0)
                                                            <div class="d-flex align-items-center mb-6">
                                                                <!--begin::Symbol-->
                                                                <div class="symbol symbol-40 symbol-light-primary mr-5">
                                                                    <span class="symbol-label">
                                                                        <span
                                                                            class="svg-icon svg-icon-lg svg-icon-primary">
                                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                 width="24px" height="24px"
                                                                                 viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1"
                                                                                   fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24"
                                                                                          height="24"/>
                                                                                    <path
                                                                                        d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"
                                                                                        fill="#000000"/>
                                                                                    <rect fill="#000000" opacity="0.3"
                                                                                          transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)"
                                                                                          x="16.3255682" y="2.94551858"
                                                                                          width="3" height="18" rx="1"/>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                    </span>
                                                                </div>
                                                                <!--end::Symbol-->
                                                                <!--begin::Text-->
                                                                <div class="d-flex flex-column font-weight-bold">
                                                                    <a href="{{route('teacher.new_epo')}}"
                                                                       class="text-dark text-hover-primary mb-1 font-size-lg">{{trans('s_admin.new_episod_Created')}}</a>
                                                                    <span
                                                                        class="text-muted">{{$un_view_epos}} {{trans('s_admin.new')}}</span>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if(count($notification_data) > 0)
                                                            @foreach($notification_data as $row)
                                                                <div class="d-flex align-items-center mb-6">
                                                                    <!--begin::Symbol-->
                                                                    <div
                                                                        class="symbol symbol-40 symbol-light-primary mr-5">
                                                                    <span class="symbol-label">
                                                                        <span
                                                                            class="svg-icon svg-icon-lg svg-icon-primary">
                                                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Home/Library.svg-->
                                                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                                                 width="24px" height="24px"
                                                                                 viewBox="0 0 24 24" version="1.1">
                                                                                <g stroke="none" stroke-width="1"
                                                                                   fill="none" fill-rule="evenodd">
                                                                                    <rect x="0" y="0" width="24"
                                                                                          height="24"/>
                                                                                    <path
                                                                                        d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"
                                                                                        fill="#000000"/>
                                                                                    <rect fill="#000000" opacity="0.3"
                                                                                          transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519)"
                                                                                          x="16.3255682" y="2.94551858"
                                                                                          width="3" height="18" rx="1"/>
                                                                                </g>
                                                                            </svg>
                                                                            <!--end::Svg Icon-->
                                                                        </span>
                                                                    </span>
                                                                    </div>
                                                                    <!--end::Symbol-->
                                                                    <!--begin::Text-->
                                                                    <div class="d-flex flex-column font-weight-bold">
                                                                        @if($row->message_type == 'teacher_request_absence')
                                                                            @if(app()->getLocale() == 'ar')
                                                                                <a href="{{route('teacher.request.absence')}}"
                                                                                   class="text-dark text-hover-primary mb-1 font-size-lg">
                                                                                    {{$row->title_ar}}
                                                                                </a>
                                                                                <span
                                                                                    class="text-muted"> {{$row->message_ar}}</span>
                                                                            @else
                                                                                <a href="{{route('teacher.request.absence')}}"
                                                                                   class="text-dark text-hover-primary mb-1 font-size-lg">
                                                                                    {{$row->title_en}}
                                                                                </a>
                                                                                <span
                                                                                    class="text-muted">  {{$row->message_en}} </span>
                                                                            @endif
                                                                        @elseif($row->message_type == 'teacher_zoom')
                                                                            @if(app()->getLocale() == 'ar')
                                                                                <a href="{{route('teacher.my_meetings')}}"
                                                                                   class="text-dark text-hover-primary mb-1 font-size-lg">
                                                                                    {{$row->title_ar}}
                                                                                </a>
                                                                                <span
                                                                                    class="text-muted"> {{$row->message_ar}}</span>
                                                                            @else
                                                                                <a href="{{route('teacher.my_meetings')}}"
                                                                                   class="text-dark text-hover-primary mb-1 font-size-lg">
                                                                                    {{$row->title_en}}
                                                                                </a>
                                                                                <span
                                                                                    class="text-muted">  {{$row->message_en}} </span>
                                                                            @endif
                                                                        @elseif($row->message_type != 'teacher_zoom' && $row->message_type != 'teacher_request_absence')
                                                                            @if(app()->getLocale() == 'ar')
                                                                                <a href="{{route('t_episodes.index')}}"
                                                                                   class="text-dark text-hover-primary mb-1 font-size-lg">
                                                                                    {{$row->title_ar}}
                                                                                </a>
                                                                                <span
                                                                                    class="text-muted"> {{$row->message_ar}}</span>
                                                                            @else
                                                                                <a href="{{route('t_episodes.index')}}"
                                                                                   class="text-dark text-hover-primary mb-1 font-size-lg">
                                                                                    {{$row->title_en}}
                                                                                </a>
                                                                                <span
                                                                                    class="text-muted">  {{$row->message_en}} </span>
                                                                            @endif
                                                                        @elseif($row->message_type == 'restart_episode')
                                                                            @if(app()->getLocale() == 'ar')
                                                                                <a href="{{route('t_episodes.index')}}"
                                                                                   class="text-dark text-hover-primary mb-1 font-size-lg">
                                                                                    {{$row->title_ar}}
                                                                                </a>
                                                                                <span
                                                                                    class="text-muted"> {{$row->message_ar}}</span>
                                                                            @else
                                                                                <a href="{{route('t_episodes.index')}}"
                                                                                   class="text-dark text-hover-primary mb-1 font-size-lg">
                                                                                    {{$row->title_en}}
                                                                                </a>
                                                                                <span
                                                                                    class="text-muted">  {{$row->message_en}} </span>
                                                                            @endif
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif

                                                    </div>
                                                </div>
                                                <!--end::Tabpane-->
                                                <!--begin::Tabpane-->
                                                <div class="tab-pane" id="topbar_notifications_events" role="tabpanel">
                                                    <!--begin::Nav-->
                                                    <div class="navi navi-hover scroll my-4" data-scroll="true"
                                                         data-height="300" data-mobile-height="200">
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon2-line-chart text-success"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold">New report has been
                                                                        received
                                                                    </div>
                                                                    <div class="text-muted">23 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon2-paper-plane text-danger"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold">Finance report has
                                                                        been generated
                                                                    </div>
                                                                    <div class="text-muted">25 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon2-user flaticon2-line- text-success"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold">New order has been
                                                                        received
                                                                    </div>
                                                                    <div class="text-muted">2 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon2-pin text-primary"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold">New customer is
                                                                        registered
                                                                    </div>
                                                                    <div class="text-muted">3 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon2-sms text-danger"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold">Application has been
                                                                        approved
                                                                    </div>
                                                                    <div class="text-muted">3 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon2-pie-chart-3 text-warning"></i>
                                                                </div>
                                                                <div class="navinavinavi-text">
                                                                    <div class="font-weight-bold">New file has been
                                                                        uploaded
                                                                    </div>
                                                                    <div class="text-muted">5 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon-pie-chart-1 text-info"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold">New user feedback
                                                                        received
                                                                    </div>
                                                                    <div class="text-muted">8 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon2-settings text-success"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold">System reboot has been
                                                                        successfully completed
                                                                    </div>
                                                                    <div class="text-muted">12 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon-safe-shield-protection text-primary"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold">New order has been
                                                                        placed
                                                                    </div>
                                                                    <div class="text-muted">15 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon2-notification text-primary"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold">Company meeting
                                                                        canceled
                                                                    </div>
                                                                    <div class="text-muted">19 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon2-fax text-success"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold">New report has been
                                                                        received
                                                                    </div>
                                                                    <div class="text-muted">23 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon-download-1 text-danger"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold">Finance report has
                                                                        been generated
                                                                    </div>
                                                                    <div class="text-muted">25 hrs ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon-security text-warning"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold">New customer comment
                                                                        recieved
                                                                    </div>
                                                                    <div class="text-muted">2 days ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                        <!--begin::Item-->
                                                        <a href="javascript:void(0);" class="navi-item">
                                                            <div class="navi-link">
                                                                <div class="navi-icon mr-2">
                                                                    <i class="flaticon2-analytics-1 text-success"></i>
                                                                </div>
                                                                <div class="navi-text">
                                                                    <div class="font-weight-bold">New customer is
                                                                        registered
                                                                    </div>
                                                                    <div class="text-muted">3 days ago</div>
                                                                </div>
                                                            </div>
                                                        </a>
                                                        <!--end::Item-->
                                                    </div>
                                                    <!--end::Nav-->
                                                </div>
                                                <!--end::Tabpane-->
                                                <!--begin::Tabpane-->
                                                <div class="tab-pane" id="topbar_notifications_logs" role="tabpanel">
                                                    <!--begin::Nav-->
                                                    <div class="d-flex flex-center text-center text-muted min-h-200px">
                                                        All caught up!
                                                        <br/>No new notifications.
                                                    </div>
                                                    <!--end::Nav-->
                                                </div>
                                                <!--end::Tabpane-->
                                            </div>
                                            <!--end::Content-->
                                        </form>
                                    </div>
                                    <!--end::Dropdown-->
                            </div>
                            <!--begin::Languages-->
                            <div class="dropdown">
                                <!--begin::Toggle-->
                                <div class="topbar-item" data-toggle="dropdown" data-offset="10px,0px">
                                    <div class="btn btn-icon btn-clean btn-dropdown btn-lg mr-1">
                                    @if(session('lang')=='en')
                                        <!-- <i class="flag-icon flag-icon-gb"></i><span class="selected-language">English</span></a> -->
                                            <img class="h-20px w-20px rounded-sm"
                                                 src="{{ asset('metronic/assets/media/svg/flags/226-united-states.svg') }}"
                                                 alt=""/>
                                    @else
                                        <!-- <i class="flag-icon flag-icon-kw"></i><span class="selected-language">العربيه</span></a> -->
                                            <img class="h-20px w-20px rounded-sm"
                                                 src="{{ asset('metronic/assets/media/svg/flags/133-saudi-arabia.svg') }}"
                                                 alt=""/>
                                        @endif
                                    </div>
                                </div>
                                <!--end::Toggle-->
                                <!--begin::Dropdown-->
                                <div
                                    class="dropdown-menu p-0 m-0 dropdown-menu-anim-up dropdown-menu-sm dropdown-menu-right">
                                    <!--begin::Nav-->
                                    <ul class="navi navi-hover py-4">
                                        <!--begin::Item-->
                                        <li class="navi-item">
                                            <a href="{{url('lang/en')}}" class="navi-link">
                                                    <span class="symbol symbol-20 mr-3">
                                                        <img
                                                            src="{{ asset('metronic/assets/media/svg/flags/226-united-states.svg') }}"
                                                            alt=""/>
                                                    </span>
                                                <span class="navi-text">English</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->
                                        <!--begin::Item-->
                                        <li class="navi-item active">
                                            <a href="{{url('lang/ar')}}" class="navi-link">
                                                    <span class="symbol symbol-20 mr-3">
                                                        <img
                                                            src="{{ asset('metronic/assets/media/svg/flags/133-saudi-arabia.svg') }}"
                                                            alt=""/>
                                                    </span>
                                                <span class="navi-text">العربية</span>
                                            </a>
                                        </li>
                                        <!--end::Item-->
                                    </ul>
                                    <!--end::Nav-->
                                </div>
                                <!--end::Dropdown-->
                            </div>
                            <!--end::Languages-->
                            <!--begin::User-->
                            <div class="topbar-item">
                                <div
                                    class="btn btn-icon btn-icon-mobile w-auto btn-clean d-flex align-items-center btn-lg px-2"
                                    id="kt_quick_user_toggle">
                                    <span class="text-muted font-weight-bold font-size-base d-none d-md-inline mr-1">{{trans('s_admin.hi')}},</span>
                                    <span
                                        class="text-dark-50 font-weight-bolder font-size-base d-none d-md-inline mr-3">
                                    @if(app()->getLocale() == 'ar')
                                            {{auth::guard('teacher')->user()->first_name_ar}}
                                        @else
                                            {{auth::guard('teacher')->user()->first_name_en}}
                                        @endif
                                </span>
                                    <span class="symbol symbol-lg-35 symbol-25 symbol-light-success">
                                            <span class="symbol-label font-size-h5 font-weight-bold">S</span>
                                        </span>
                                </div>
                            </div>
                            <!--end::User-->
                        </div>
                        <!--end::Topbar-->
                    </div>
                    <!--end::Container-->
                </div>
                <!--end::Header-->
                <!--begin::Content-->
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <!--begin::Subheader-->
                    <div class="subheader py-2 py-lg-4 subheader-solid" id="kt_subheader">
                        <div
                            class="container-fluid d-flex align-items-center justify-content-between flex-wrap flex-sm-nowrap">
                            <!--begin::Info-->
                        @yield('title')
                        <!--end::Info-->
                        </div>
                    </div>
                    <!--end::Subheader-->
                    <!--begin::Entry-->
                    <div class="d-flex flex-column-fluid">
                        <div class="container">
@include('admin.layouts.messages')
@include('admin.layouts.errors')

