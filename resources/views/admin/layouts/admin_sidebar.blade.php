<ul class="menu-nav">

    @if(Request()->getHost() == env('maindomain','127.0.0.1'))
        <li class="menu-item @if(request()->segment(1) == 'home') menu-item-active  @endif" aria-haspopup="true">
            <a href="{{url('/home')}}" class="menu-link">
            <span class="svg-icon menu-icon">
                <span class="svg-icon svg-icon-success svg-icon-2x">
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
                </span>
            </span>
                <span class="menu-text">{{trans('s_admin.nav_home')}}</span>
            </a>
        </li>

        <li class="menu-item @if(request()->segment(1) == 'tenants') menu-item-active  @endif" aria-haspopup="true">
            <a href="{{url('/tenants')}}" class="menu-link">
            <span class="svg-icon menu-icon">
                <span class="svg-icon svg-icon-success svg-icon-2x">
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
                </span>
            </span>
                <span class="menu-text">{{trans('s_admin.tenants')}}</span>
            </a>
        </li>
    @else
        <li class="menu-item @if(request()->segment(1) == 'home') menu-item-active  @endif" aria-haspopup="true">
            <a href="{{url('/home')}}" class="menu-link">
            <span class="svg-icon menu-icon">
                <span class="svg-icon svg-icon-success svg-icon-2x">
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
                </span>
            </span>
                <span class="menu-text">{{trans('s_admin.nav_home')}}</span>
            </a>
        </li>
        @php
            $new_users= \App\Models\Admin_notification::where('type','admin')->where('readed','0')->where('message_type','new_user')->get()->count();

            $unread_contact_us = \App\Models\Contact::where('readed','0')->get()->count();
            $user = \auth()->user();

            if($user->role_id == 6){
                $teachers = \App\Models\Admin_notification::with('Teacher')
                                    ->whereHas('Teacher', function ($q) {
                                        $q->where('epo_type','mogmaa');
                                    })->where('readed','0')->where('message_type','new_teacher')->get()->count();
                $new_students = \App\Models\Admin_notification::with('Student')
                                    ->whereHas('Student', function ($q) {
                                        $q->where('epo_type','mogmaa');
                                    })->where('readed','0')->where('message_type','new_student')->get()->count();
                $episode_ids = \App\Models\Episode::where('active','y')->where('type','mogmaa')->pluck('id')->toArray();
                $un_read_long = \App\Models\Admin_notification::whereIn('episode_id',$episode_ids)->where('readed','0')->where('message_type','long_episode')->get();
                $new_episodes_request = \App\Models\Episode_request::whereIn('episode_id',$episode_ids)->where('status','new')->where('admin_view','0')->get();
                $sections_ids = \App\Models\Episode_section::whereIn('episode_id',$episode_ids)->pluck('id')->toArray();
                $new_restar_epo_request = \App\Models\Episode_restart_request::whereIn('section_id',$sections_ids)->where('status','new')->get();

            }elseif($user->role_id == 7){
                $teachers = \App\Models\Admin_notification::with('Teacher')
                                    ->whereHas('Teacher', function ($q) {
                                        $q->where('epo_type','dorr');
                                    })->where('readed','0')->where('message_type','new_teacher')->get()->count();
                $new_students = \App\Models\Admin_notification::with('Student')
                                        ->whereHas('Student', function ($q) {
                                        $q->where('epo_type','dorr');
                                    })->where('readed','0')->where('message_type','new_student')->get()->count();
                $episode_ids = \App\Models\Episode::where('active','y')->where('type','dorr')->pluck('id')->toArray();
                $un_read_long = \App\Models\Admin_notification::whereIn('episode_id',$episode_ids)->where('readed','0')->where('message_type','long_episode')->get();
                $new_episodes_request = \App\Models\Episode_request::whereIn('episode_id',$episode_ids)->where('status','new')->where('admin_view','0')->get();
                $sections_ids = \App\Models\Episode_section::whereIn('episode_id',$episode_ids)->pluck('id')->toArray();
                $new_restar_epo_request = \App\Models\Episode_restart_request::whereIn('section_id',$sections_ids)->where('status','new')->get();

            }elseif($user->role_id == 8){
            $gender = $user->gender;
                $teachers = \App\Models\Admin_notification::with('Teacher')
                                ->whereHas('Teacher', function ($q) use($gender) {
                                    $q->where('epo_type','far_learn')->where('gender',$gender);
                                })->where('readed','0')->where('message_type','new_teacher')->get()->count();
                $new_students = \App\Models\Admin_notification::with('Student')
                                    ->whereHas('Student', function ($q) use($gender) {
                                    $q->where('epo_type','far_learn')->where('gender',$gender);
                                })->where('readed','0')->where('message_type','new_student')->get()->count();
                $episode_ids = \App\Models\Episode::where('gender',$gender)->where('active','y')->where('type','mqraa')->pluck('id')->toArray();
                $un_read_long = \App\Models\Admin_notification::whereIn('episode_id',$episode_ids)->where('readed','0')->where('message_type','long_episode')->get();
                $new_episodes_request = \App\Models\Episode_request::whereIn('episode_id',$episode_ids)->where('status','new')->where('admin_view','0')->get();
                $sections_ids = \App\Models\Episode_section::whereIn('episode_id',$episode_ids)->pluck('id')->toArray();
                $new_restar_epo_request = \App\Models\Episode_restart_request::whereIn('section_id',$sections_ids)->where('status','new')->get();
            }elseif($user->role_id == 2){
                $teachers = \App\Models\Admin_notification::with('Teacher')->where('readed','0')->where('message_type','new_teacher')->get()->count();
                $new_students = \App\Models\Admin_notification::with('Student')->where('readed','0')->where('message_type','new_student')->get()->count();
                $un_read_long = \App\Models\Admin_notification::where('readed','0')->where('message_type','long_episode')->get();
                $new_episodes_request = \App\Models\Episode_request::where('status','new')->where('admin_view','0')->get();
                $new_restar_epo_request = \App\Models\Episode_restart_request::where('status','new')->get();
            }else{
                $teachers = \App\Models\Admin_notification::with('Teacher')->where('readed','0')->where('message_type','new_teacher')->get()->count();
                $new_students = \App\Models\Admin_notification::with('Student')->where('readed','0')->where('message_type','new_student')->get()->count();
                if($user->role_id == 5 || $user->role_id == 12|| $user->role_id == 13|| $user->role_id == 14 ){
                    $episode_ids = \App\Models\Episode::where('college_id',$user->college_id)->where('active','y')->where('type','dorr')->pluck('id')->toArray();
                    $un_read_long = \App\Models\Admin_notification::whereIn('episode_id',$episode_ids)->where('readed','0')->where('status','new')->where('message_type','long_episode')->orderBy('created_at','desc')->get();
                }else if($user->role_id == 3 || $user->role_id == 9|| $user->role_id == 10|| $user->role_id == 11 ){
                    $episode_ids = \App\Models\Episode::where('college_id',$user->college_id)->where('active','y')->where('type','mogmaa')->pluck('id')->toArray();
                    $un_read_long = \App\Models\Admin_notification::whereIn('episode_id',$episode_ids)->where('readed','0')->where('status','new')->where('message_type','long_episode')->orderBy('created_at','desc')->get();
                }else{
                    $un_read_long = \App\Models\Admin_notification::where('readed','0')->where('message_type','long_episode')->get();
                }
                $new_episodes_request = \App\Models\Episode_request::where('status','new')->where('admin_view','0')->get();
                $new_restar_epo_request = \App\Models\Episode_restart_request::where('status','new')->get();
            }
            $teachers_absence_requests_sidbar =
             \App\Models\Admin_notification::where('readed','0')->where('message_type','teacher_absence_request')->get()->count();
            $teachers_count = $teachers_absence_requests_sidbar + $teachers ;
            $totla_new_requests = count($un_read_long) + count($new_episodes_request) + count($new_restar_epo_request);
            $total_join = count($new_episodes_request) + count($new_restar_epo_request) ;
        @endphp
        @can("inside mail")
            <li class="menu-item menu-item-submenu @if(request()->segment(1) == 'inbox') menu-item-open @endif "
                aria-haspopup="true" data-menu-toggle="hover">
                <a href="{{route('inbox.in')}}" class="menu-link menu-toggle">
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
                    <span class="menu-text">{{trans('s_admin.nav_mail')}}
            </span>
                </a>
            </li>
        @endcan
        @can("outside mail")
            <li class="menu-item menu-item-submenu @if(request()->segment(1) == 'contact_us') menu-item-open @endif "
                aria-haspopup="true" data-menu-toggle="hover">
                <a href="{{url('/contact_us')}}" class="menu-link menu-toggle">
            <span class="svg-icon menu-icon">
                        <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Mails-unocked.svg--><svg
                                xmlns="http://www.w3.org/2000/svg"
                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                viewBox="0 0 24 24" version="1.1">
                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path
                                        d="M3,17 L3,16 C3,15.4477153 2.55228475,15 2,15 C1.44771525,15 1,15.4477153 1,16 L0,16 C-1.48029737e-16,14.8954305 0.8954305,14 2,14 C3.1045695,14 4,14.8954305 4,16 L4,17 L8,17 C8.55228475,17 9,17.4477153 9,18 L9,21 C9,21.5522847 8.55228475,22 8,22 L3,22 C2.44771525,22 2,21.5522847 2,21 L2,18 C2,17.4477153 2.44771525,17 3,17 Z"
                                        fill="#000000" opacity="0.3"/>
                                    <path
                                        d="M12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.98630124,11 4.48466491,11.0516454 4,11.1500272 L4,7 C4,5.8954305 4.8954305,5 6,5 L20,5 C21.1045695,5 22,5.8954305 22,7 L22,16 C22,17.1045695 21.1045695,18 20,18 L12.9835977,18 Z M19.1444251,6.83964668 L13,10.1481833 L6.85557487,6.83964668 C6.4908718,6.6432681 6.03602525,6.77972206 5.83964668,7.14442513 C5.6432681,7.5091282 5.77972206,7.96397475 6.14442513,8.16035332 L12.6444251,11.6603533 C12.8664074,11.7798822 13.1335926,11.7798822 13.3555749,11.6603533 L19.8555749,8.16035332 C20.2202779,7.96397475 20.3567319,7.5091282 20.1603533,7.14442513 C19.9639747,6.77972206 19.5091282,6.6432681 19.1444251,6.83964668 Z"
                                        fill="#000000"/>
                                </g>
                            </svg><!--end::Svg Icon-->
                        </span>
                    </span>
                    <span class="menu-text">{{trans('s_admin.nav_contact_us')}}
                        @if($unread_contact_us > 0)
                            &nbsp;
                            &nbsp;
                            <span style="width: 20px;height: 20px;"
                                  href="#" class="btn btn-icon btn-danger btn-circle pulse pulse-danger">
                                    {{$unread_contact_us}}
                                </span>
                        @endif
            </span>
                </a>
            </li>
        @endcan
        @if(Gate::check('New students') || Gate::check('Distance education students')|| Gate::check('Complexes students')|| Gate::check('Dorr students')|| Gate::check('Refused students to register in the system'))
            <li class="menu-item menu-item-submenu @if(request()->segment(2) == 'students_rejected' || request()->segment(1) == 'students' || request()->segment(1) == 'student_settings') menu-item-open @endif "
                aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
            <span class="svg-icon menu-icon">

                <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\User.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <polygon pqq\oints="0 0 24 0 24 24 0 24"/>
                            <path
                                d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z"
                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                            <path
                                d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z"
                                fill="#000000" fill-rule="nonzero"/>
                        </g>
                    </svg><!--end::Svg Icon-->
                </span>
            </span>
                    <span class="menu-text">{{trans('s_admin.manage_students')}}
                        @can("New students")
                            @if($new_students > 0)
                                &nbsp;
                                &nbsp;
                                <span style="width: 20px;height: 20px;"
                                      href="#" class="btn btn-icon btn-danger btn-circle pulse pulse-danger">
                                    {{$new_students}}
                                </span>
                            @endif
                        @endcan
                </span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                    <span class="menu-link">
                        <span class="menu-text">{{trans('s_admin.manage_students')}}</span>
                    </span>
                        </li>
                        @can("New students")
                            <li class="menu-item @if(request()->segment(1) == 'students' && request()->segment(2) == 'new') menu-item-active @endif"
                                aria-haspopup="true">
                                <a href="{{route('students.new')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Sending.svg--><svg
                                    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                    width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path
                                            d="M8,13.1668961 L20.4470385,11.9999863 L8,10.8330764 L8,5.77181995 C8,5.70108058 8.01501031,5.63114635 8.04403925,5.56663761 C8.15735832,5.31481744 8.45336217,5.20254012 8.70518234,5.31585919 L22.545552,11.5440255 C22.6569791,11.5941677 22.7461882,11.6833768 22.7963304,11.794804 C22.9096495,12.0466241 22.7973722,12.342628 22.545552,12.455947 L8.70518234,18.6841134 C8.64067359,18.7131423 8.57073936,18.7281526 8.5,18.7281526 C8.22385763,18.7281526 8,18.504295 8,18.2281526 L8,13.1668961 Z"
                                            fill="#000000"/>
                                        <path
                                            d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M4,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L4,8 C3.44771525,8 3,7.55228475 3,7 C3,6.44771525 3.44771525,6 4,6 Z"
                                            fill="#000000" opacity="0.3"/>
                                    </g>
                                </svg><!--end::Svg Icon-->
                            </span>
                        </span>
                                    <span class="menu-text">
                            {{trans('s_admin.new_students')}}
                                        @if($new_students > 0)
                                            &nbsp;
                                            &nbsp;
                                            <span style="width: 20px;height: 20px;"
                                                  href="#"
                                                  class="btn btn-icon btn-danger btn-circle pulse pulse-danger">
                                    {{$new_students}}
                                </span>
                                        @endif
                        </span>
                                </a>
                            </li>
                        @endcan
                        @can("Distance education students")
                            <li class="menu-item @if(request()->segment(2) == 'far_learn') menu-item-active @endif"
                                aria-haspopup="true">
                                <a href="{{url('/student_settings/far_learn')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg
                                                xmlns="http://www.w3.org/2000/svg"
                                                xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24"/>
                                                    <path
                                                        d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                                        fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                    <path
                                                        d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                                        fill="#000000" opacity="0.3"/>
                                                </g>
                                            </svg><!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="menu-text">{{trans('s_admin.far_learn_students')}}</span>
                                </a>
                            </li>
                        @endcan
                        @if(settings()->show_mogmaa_dorr == '1')
                            @can("Complexes students")
                                <li class="menu-item @if(request()->segment(2) == 'mogmaa') menu-item-active @endif"
                                    aria-haspopup="true">
                                    <a href="{{url('/student_settings/mogmaa')}}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="svg-icon menu-icon">
                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path
                                    d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path
                                    d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                    fill="#000000" opacity="0.3"/>
                            </g>
                        </svg><!--end::Svg Icon-->
                    </span>
                </span>
                                        <span class="menu-text">{{trans('s_admin.mogmaa_students')}}</span>
                                    </a>
                                </li>
                            @endcan
                            @can("Dorr students")
                                <li class="menu-item @if(request()->segment(2) == 'dorr') menu-item-active @endif"
                                    aria-haspopup="true">
                                    <a href="{{url('/student_settings/dorr')}}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="svg-icon menu-icon">
                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg
                            xmlns="http://www.w3.org/2000/svg"
                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                            viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"/>
                                <path
                                    d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                    fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                <path
                                    d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                    fill="#000000" opacity="0.3"/>
                            </g>
                        </svg><!--end::Svg Icon-->
                    </span>
                </span>
                                        <span class="menu-text">{{trans('s_admin.dorr_students')}}</span>
                                    </a>
                                </li>
                            @endcan
                        @endif
                        @can("Refused students to register in the system")
                            <li class="menu-item @if(request()->segment(1) == 'students_rejected' && request()->segment(2) == 'students') menu-item-active @endif "
                                aria-haspopup="true4">
                                <a href="{{route('join_orders_rejected.students')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Clipboard-list.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path
                        d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                        fill="#000000" opacity="0.3"/>
                    <path
                        d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                        fill="#000000"/>
                    <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                    <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                    <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                    <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                    <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                </g>
            </svg><!--end::Svg Icon-->
        </span>
    </span>
                                    <span class="menu-text">{{trans('s_admin.arshef_rejected')}}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endif
        @if(Gate::check('New teacher interviews') ||Gate::check('Teachers permission requests') ||Gate::check('new teachers') || Gate::check('Distance education teachers')|| Gate::check('Complexes teachers')||
        Gate::check('dorr teachers') ||  Gate::check('Refused teachers to register in the system') ||  Gate::check('Add absence and presence')||  Gate::check('see absence'))
            <li class="menu-item menu-item-submenu @if(request()->segment(2) == 'teachers_rejected'||request()->segment(1) == 'absence' || request()->segment(1) == 'teacher_settings' || request()->segment(1) == 'teacher'|| request()->segment(2) == 'teachers') menu-item-open @endif  "
                aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
<span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\User.svg--><svg
        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
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
</svg><!--end::Svg Icon-->
</span>
</span>
                    <span class="menu-text">{{trans('s_admin.nav_teacher_shoan_settings')}}
                        @can("new teachers")
                            @if($teachers_count > 0)
                                &nbsp;
                                &nbsp;
                                <span style="width: 20px;height: 20px;"
                                      href="#" class="btn btn-icon btn-danger btn-circle pulse pulse-danger">
{{$teachers_count}}
</span>
                            @endif
                        @endcan
</span>

                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
<span class="menu-link">
    <span class="menu-text">{{trans('s_admin.manage_students')}}</span>
</span>
                        </li>
                        @can("new teachers")
                            <li class="menu-item @if(request()->segment(2) == 'new_join') menu-item-active @endif"
                                aria-haspopup="true">
                                <a href="{{route('teacher.new_join')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Sending.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path
                        d="M8,13.1668961 L20.4470385,11.9999863 L8,10.8330764 L8,5.77181995 C8,5.70108058 8.01501031,5.63114635 8.04403925,5.56663761 C8.15735832,5.31481744 8.45336217,5.20254012 8.70518234,5.31585919 L22.545552,11.5440255 C22.6569791,11.5941677 22.7461882,11.6833768 22.7963304,11.794804 C22.9096495,12.0466241 22.7973722,12.342628 22.545552,12.455947 L8.70518234,18.6841134 C8.64067359,18.7131423 8.57073936,18.7281526 8.5,18.7281526 C8.22385763,18.7281526 8,18.504295 8,18.2281526 L8,13.1668961 Z"
                        fill="#000000"/>
                    <path
                        d="M4,16 L5,16 C5.55228475,16 6,16.4477153 6,17 C6,17.5522847 5.55228475,18 5,18 L4,18 C3.44771525,18 3,17.5522847 3,17 C3,16.4477153 3.44771525,16 4,16 Z M1,11 L5,11 C5.55228475,11 6,11.4477153 6,12 C6,12.5522847 5.55228475,13 5,13 L1,13 C0.44771525,13 6.76353751e-17,12.5522847 0,12 C-6.76353751e-17,11.4477153 0.44771525,11 1,11 Z M4,6 L5,6 C5.55228475,6 6,6.44771525 6,7 C6,7.55228475 5.55228475,8 5,8 L4,8 C3.44771525,8 3,7.55228475 3,7 C3,6.44771525 3.44771525,6 4,6 Z"
                        fill="#000000" opacity="0.3"/>
                </g>
            </svg><!--end::Svg Icon-->
        </span>
    </span>
                                    <span class="menu-text">
        {{trans('s_admin.new_teachers')}}
                                        @if($teachers > 0)
                                            &nbsp;
                                            &nbsp;
                                            <span style="width: 20px;height: 20px;"
                                                  href="#"
                                                  class="btn btn-icon btn-danger btn-circle pulse pulse-danger">
                {{$teachers}}
            </span>
                                        @endif
    </span>

                                </a>
                            </li>
                        @endcan
                        @can("Distance education teachers")
                            <li class="menu-item @if(request()->segment(1) == 'teacher_settings' && request()->segment(2) == 'far_learn') menu-item-active @endif "
                                aria-haspopup="true">
                                <a href="{{url('/teacher_settings/far_learn')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Contact1.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path
                        d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 L7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                        fill="#000000" opacity="0.3"/>
                </g>
            </svg><!--end::Svg Icon-->
        </span>
        </span>
                                    <span class="menu-text">{{trans('s_admin.nav_teachers_far_learn')}}</span>
                                </a>
                            </li>
                        @endcan
                        @if(settings()->show_mogmaa_dorr == '1')
                            @can("Complexes teachers")
                                <li class="menu-item @if(request()->segment(1) == 'teacher_settings' && request()->segment(2) == 'mogmaa') menu-item-active @endif "
                                    aria-haspopup="true">
                                    <a href="{{url('/teacher_settings/mogmaa')}}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="svg-icon menu-icon">
        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Contact1.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path
                        d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 L7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                        fill="#000000" opacity="0.3"/>
                </g>
            </svg><!--end::Svg Icon-->
        </span>
        </span>
                                        <span class="menu-text">{{trans('s_admin.nav_teachers_mogmaa')}}</span>
                                    </a>
                                </li>
                            @endcan
                            @can("dorr teachers")
                                <li class="menu-item @if(request()->segment(1) == 'teacher_settings' && request()->segment(2) == 'dorr') menu-item-active @endif "
                                    aria-haspopup="true">
                                    <a href="{{url('/teacher_settings/dorr')}}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="svg-icon menu-icon">
        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Contact1.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="10"/>
                    <path
                        d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 L7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z"
                        fill="#000000" opacity="0.3"/>
                </g>
            </svg><!--end::Svg Icon-->
        </span>
        </span>
                                        <span class="menu-text">{{trans('s_admin.nav_teachers_dorr')}}</span>
                                    </a>
                                </li>
                            @endcan
                        @endif
                        @can("Refused teachers to register in the system")
                            <li class="menu-item @if(request()->segment(2) == 'teachers_rejected') menu-item-active @endif "
                                aria-haspopup="true">
                                <a href="{{route('join_orders_rejected.teachers')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
        <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Clipboard-list.svg--><svg
                xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                    <rect x="0" y="0" width="24" height="24"/>
                    <path
                        d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                        fill="#000000" opacity="0.3"/>
                    <path
                        d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                        fill="#000000"/>
                    <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2" rx="1"/>
                    <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                    <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2" rx="1"/>
                    <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2" rx="1"/>
                    <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2" rx="1"/>
                    <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2" rx="1"/>
                </g>
            </svg><!--end::Svg Icon-->
        </span>
    </span>
                                    <span class="menu-text">{{trans('s_admin.arshef_rejected')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("New teacher interviews")
                            <li class="menu-item @if(request()->segment(2) == 'interviews') menu-item-active @endif "
                                aria-haspopup="true">
                                <a href="{{route('teacher.interviews')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
            <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Devices\Display2.svg--><svg
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
            </span>
        </span>
                                    <span class="menu-text">{{trans('s_admin.new_teachers_interviews')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("Teachers permission requests")
                            <li class="menu-item @if(request()->segment(2) == 'teacher_requests') menu-item-active @endif "
                                aria-haspopup="true">
                                <a href="{{route('teacher.absence.requests')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24"></rect>
                                <rect fill="#000000" opacity="0.3" x="2" y="3" width="20"
                                      height="18" rx="2"></rect>
                                <path
                                    d="M9.9486833,13.3162278 C9.81256925,13.7245699 9.43043041,14 9,14 L5,14 C4.44771525,14 4,13.5522847 4,13 C4,12.4477153 4.44771525,12 5,12 L8.27924078,12 L10.0513167,6.68377223 C10.367686,5.73466443 11.7274983,5.78688777 11.9701425,6.75746437 L13.8145063,14.1349195 L14.6055728,12.5527864 C14.7749648,12.2140024 15.1212279,12 15.5,12 L19,12 C19.5522847,12 20,12.4477153 20,13 C20,13.5522847 19.5522847,14 19,14 L16.118034,14 L14.3944272,17.4472136 C13.9792313,18.2776054 12.7550291,18.143222 12.5298575,17.2425356 L10.8627389,10.5740611 L9.9486833,13.3162278 Z"
                                    fill="#000000" fill-rule="nonzero"></path>
                                <circle fill="#000000" opacity="0.3" cx="19" cy="6" r="1"></circle>
                            </g>
                        </svg>
        </span>
                                    <span class="menu-text">{{trans('s_admin.teacher_absence_request')}}

                                        @if($teachers_absence_requests_sidbar > 0)
                                            &nbsp;
                                            &nbsp;
                                            <span style="width: 20px;height: 20px;"
                                                  href="#"
                                                  class="btn btn-icon btn-danger btn-circle pulse pulse-danger">
                {{$teachers_absence_requests_sidbar}}
            </span>
                                        @endif
        </span>
                                </a>
                            </li>
                        @endcan
                        @if(Gate::check('Add absence and presence') || Gate::check('see absence') )
                            <li class="menu-item menu-item-submenu @if(request()->segment(1) == 'absence') menu-item-open @endif"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:void(0);" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="svg-icon menu-icon">
                <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Clipboard-list.svg--><svg
                        xmlns="http://www.w3.org/2000/svg"
                        xmlns:xlink="http://www.w3.org/1999/xlink"
                        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path
                                d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                fill="#000000" opacity="0.3"/>
                            <path
                                d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                fill="#000000"/>
                            <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2"
                                  rx="1"/>
                            <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2"
                                  rx="1"/>
                            <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2"
                                  rx="1"/>
                            <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2"
                                  rx="1"/>
                            <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2"
                                  rx="1"/>
                            <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2"
                                  rx="1"/>
                        </g>
                    </svg><!--end::Svg Icon-->
                </span>
            </span>
                                    <span class="menu-text">{{trans('s_admin.teacher_absence')}}</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        @can("Add absence and presence")
                                            <li class="menu-item @if(request()->segment(1) == 'absence' && request()->segment(2) == 'add') menu-item-active @endif"
                                                aria-haspopup="true">
                                                <a href="{{route('absence.add.teacher')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="svg-icon menu-icon">
                                <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Plus.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                        height="24px"
                                        viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none"
                                       fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <circle fill="#000000" opacity="0.3" cx="12" cy="12"
                                                r="10"/>
                                        <path
                                            d="M11,11 L11,7 C11,6.44771525 11.4477153,6 12,6 C12.5522847,6 13,6.44771525 13,7 L13,11 L17,11 C17.5522847,11 18,11.4477153 18,12 C18,12.5522847 17.5522847,13 17,13 L13,13 L13,17 C13,17.5522847 12.5522847,18 12,18 C11.4477153,18 11,17.5522847 11,17 L11,13 L7,13 C6.44771525,13 6,12.5522847 6,12 C6,11.4477153 6.44771525,11 7,11 L11,11 Z"
                                            fill="#000000"/>
                                    </g>
                                </svg><!--end::Svg Icon--></span>
                            </span>
                                                    <span
                                                        class="menu-text">{{trans('s_admin.add_absence_attendance')}}</span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can("see absence")
                                            <li class="menu-item @if(request()->segment(1) == 'absence' && request()->segment(2) == 'show') menu-item-active @endif"
                                                aria-haspopup="true">
                                                <a href="{{route('absence.show.teacher')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="svg-icon menu-icon">
                                <span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                        height="24px"
                                        viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none"
                                           fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                            <path
                                                d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                                fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                </span>
                            </span>
                                                    <span
                                                        class="menu-text">{{trans('s_admin.show_absence_attendance')}}</span>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </li>
                        @endif
                    </ul>
                </div>
            </li>
        @endif
        @if( Gate::check('Complexes')||  Gate::check('Distance education episodes') ||  Gate::check('Complexes students')||Gate::check("women's dorrs")||
        Gate::check('Requests to join a distance education seminar')|| Gate::check('Episode replay requests') || Gate::check('Loop extension'))
            <li class="menu-item menu-item-submenu @if( request()->segment(1) == 'episode' ||request()->segment(1) == 'dorr' || request()->segment(1) == 'colleges' || request()->segment(1) == 'far_episode' ) menu-item-open @endif"
                aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
<span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Clipboard.svg--><svg
        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
        height="24px" viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path
            d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
            fill="#000000" opacity="0.3"/>
        <path
            d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
            fill="#000000"/>
        <rect fill="#000000" opacity="0.3" x="7" y="10" width="5" height="2" rx="1"/>
        <rect fill="#000000" opacity="0.3" x="7" y="14" width="9" height="2" rx="1"/>
        </g>
        </svg><!--end::Svg Icon-->
    </span>
</span>
                    <span class="menu-text">{{trans('s_admin.nav_manage_electronic_chanel')}}
&nbsp;
&nbsp;
&nbsp;
@if($totla_new_requests > 0)
                            <span style="width: 20px;height: 20px;" href="#"
                                  class="btn btn-icon btn-danger btn-circle pulse pulse-danger">
    {{$totla_new_requests}}
</span>
                        @endif
</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent @if(request()->segment(1) == 'episode') menu-item-open  @endif"
                            aria-haspopup="true">
<span class="menu-link">
<span class="menu-text">{{trans('s_admin.nav_manage_electronic_chanel')}}</span>
</span>
                        </li>


                        @can("Distance education episodes")
                            <li class="menu-item @if(request()->segment(1)=='episode' && request()->segment(2)=='index') menu-item-active  @endif"
                                aria-haspopup="true">
                                <a href="{{route('episode.show.type','mqraa')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Devices\Display2.svg--><svg
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
</span>
</span>
                                    <span class="menu-text">{{trans('s_admin.nav_far_epo')}}</span>
                                </a>
                            </li>
                        @endcan
                        @if(settings()->show_mogmaa_dorr == '1')
                            @can("Complexes")
                                <li class="menu-item @if(request()->segment(1) == 'colleges') menu-item-active  @endif"
                                    aria-haspopup="true">
                                    <a href="{{route('colleges.index')}}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Devices\Display2.svg--><svg
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
</span>
</span>
                                        <span class="menu-text">{{trans('s_admin.colleges')}}</span>
                                    </a>
                                </li>
                            @endcan
                            @can("women's dorrs")
                                <li class="menu-item @if(request()->segment(1) == 'dorr') menu-item-active  @endif"
                                    aria-haspopup="true">
                                    <a href="{{route('dorr.index')}}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="svg-icon menu-icon">
                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Devices\Display2.svg--><svg
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
                    </span>
                    </span>
                                        <span class="menu-text">{{trans('s_admin.dorrs')}}</span>
                                    </a>
                                </li>
                            @endcan
                        @endif
                        @can("Requests to join a distance education seminar")
                            <li class="menu-item @if(request()->segment(1) == 'far_episode' && request()->segment(2)=='join_request') menu-item-active  @endif"
                                aria-haspopup="true">
                                <a href="{{route('far_episode.join_request')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Devices\Display2.svg--><svg
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
</span>
</span>
                                    <span class="menu-text">
{{trans('s_admin.nav_join_orders')}}
                                        @if(count($new_episodes_request) > 0)
                                            &nbsp;
                                            &nbsp;
                                            <span style="width: 20px;height: 20px;"
                                                  href="#"
                                                  class="btn btn-icon btn-danger btn-circle pulse pulse-danger">
{{count($new_episodes_request)}}
</span>
                                        @endif
</span>
                                </a>
                            </li>
                        @endcan

                        @can("Episode replay requests")
                            <li class="menu-item @if(request()->segment(1) == 'far_episode' && request()->segment(2)=='restart') menu-item-active  @endif "
                                aria-haspopup="true">
                                <a href="{{route('far_episode.restart.epo')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-primary svg-icon-2x">
<!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Reply-all.svg--><svg
        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<rect x="0" y="0" width="24" height="24"/>
<path
    d="M8.29606274,4.13760526 L1.15599693,10.6152626 C0.849219196,10.8935795 0.826147139,11.3678924 1.10446404,11.6746702 C1.11907213,11.6907721 1.13437346,11.7062312 1.15032466,11.7210037 L8.29039047,18.333467 C8.59429669,18.6149166 9.06882135,18.596712 9.35027096,18.2928057 C9.47866909,18.1541628 9.55000007,17.9721616 9.55000007,17.7831961 L9.55000007,4.69307548 C9.55000007,4.27886191 9.21421363,3.94307548 8.80000007,3.94307548 C8.61368984,3.94307548 8.43404911,4.01242035 8.29606274,4.13760526 Z"
    fill="#000000" fill-rule="nonzero" opacity="0.3"/>
<path
    d="M23.2951173,17.7910156 C23.2951173,16.9707031 23.4708985,13.7333984 20.9171876,11.1650391 C19.1984376,9.43652344 16.6261719,9.13671875 13.5500001,9 L13.5500001,4.69307548 C13.5500001,4.27886191 13.2142136,3.94307548 12.8000001,3.94307548 C12.6136898,3.94307548 12.4340491,4.01242035 12.2960627,4.13760526 L5.15599693,10.6152626 C4.8492192,10.8935795 4.82614714,11.3678924 5.10446404,11.6746702 C5.11907213,11.6907721 5.13437346,11.7062312 5.15032466,11.7210037 L12.2903905,18.333467 C12.5942967,18.6149166 13.0688214,18.596712 13.350271,18.2928057 C13.4786691,18.1541628 13.5500001,17.9721616 13.5500001,17.7831961 L13.5500001,13.5 C15.5031251,13.5537109 16.8943705,13.6779456 18.1583985,14.0800781 C19.9784273,14.6590944 21.3849749,16.3018455 22.3780412,19.0083314 L22.3780249,19.0083374 C22.4863904,19.3036749 22.7675498,19.5 23.0821406,19.5 L23.3000001,19.5 C23.3000001,19.0068359 23.2951173,18.2255859 23.2951173,17.7910156 Z"
    fill="#000000" fill-rule="nonzero"/>
</g>
</svg><!--end::Svg Icon-->
</span>
</span>
                                    <span class="menu-text">{{trans('s_admin.nav_restart_epo')}}

                                        @if(count($new_restar_epo_request) > 0)
                                            &nbsp;
                                            &nbsp;
                                            <span style="width: 20px;height: 20px;"
                                                  href="#"
                                                  class="btn btn-icon btn-danger btn-circle pulse pulse-danger">
{{count($new_restar_epo_request)}}
</span>
                                        @endif
</span>
                                </a>
                            </li>
                        @endcan
                        @can("Loop extension")
                            <li class="menu-item  @if(request()->segment(2) == 'long_episodes') menu-item-active  @endif"
                                aria-haspopup="true">
                                <a href="{{route('episode.long_episodes')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Time-schedule.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M10.9630156,7.5 L11.0475062,7.5 C11.3043819,7.5 11.5194647,7.69464724 11.5450248,7.95024814 L12,12.5 L15.2480695,14.3560397 C15.403857,14.4450611 15.5,14.6107328 15.5,14.7901613 L15.5,15 C15.5,15.2109164 15.3290185,15.3818979 15.1181021,15.3818979 C15.0841582,15.3818979 15.0503659,15.3773725 15.0176181,15.3684413 L10.3986612,14.1087258 C10.1672824,14.0456225 10.0132986,13.8271186 10.0316926,13.5879956 L10.4644883,7.96165175 C10.4845267,7.70115317 10.7017474,7.5 10.9630156,7.5 Z"
                                                fill="#000000"/>
                                            <path
                                                d="M7.38979581,2.8349582 C8.65216735,2.29743306 10.0413491,2 11.5,2 C17.2989899,2 22,6.70101013 22,12.5 C22,18.2989899 17.2989899,23 11.5,23 C5.70101013,23 1,18.2989899 1,12.5 C1,11.5151324 1.13559454,10.5619345 1.38913364,9.65805651 L3.31481075,10.1982117 C3.10672013,10.940064 3,11.7119264 3,12.5 C3,17.1944204 6.80557963,21 11.5,21 C16.1944204,21 20,17.1944204 20,12.5 C20,7.80557963 16.1944204,4 11.5,4 C10.54876,4 9.62236069,4.15592757 8.74872191,4.45446326 L9.93948308,5.87355717 C10.0088058,5.95617272 10.0495583,6.05898805 10.05566,6.16666224 C10.0712834,6.4423623 9.86044965,6.67852665 9.5847496,6.69415008 L4.71777931,6.96995273 C4.66931162,6.97269931 4.62070229,6.96837279 4.57348157,6.95710938 C4.30487471,6.89303938 4.13906482,6.62335149 4.20313482,6.35474463 L5.33163823,1.62361064 C5.35654118,1.51920756 5.41437908,1.4255891 5.49660017,1.35659741 C5.7081375,1.17909652 6.0235153,1.2066885 6.2010162,1.41822583 L7.38979581,2.8349582 Z"
                                                fill="#000000" opacity="0.3"/>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </span>
                                    <span class="menu-text">{{trans('s_admin.nav_long_episode')}}
                                        @if(count($un_read_long) > 0)
                                            &nbsp;
                                            &nbsp;
                                            <span style="width: 20px;height: 20px;" href="#"
                                                  class="btn btn-icon btn-danger btn-circle pulse pulse-danger">
                                            {{count($un_read_long)}}
                                        </span>
                                        @endif
                                </span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endif

        @if( Gate::check('origin curriculum') || Gate::check('Distance education evaluation settings') || Gate::check('Assessment Statement Settings') )
            <li class="menu-item menu-item-submenu @if(request()->segment(2)=='subjects'|| request()->segment(1) == 'levels' || request()->segment(1) == 'subjects') menu-item-open @endif"
                aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
<span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Files\Selected-file.svg--><svg
        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
        height="24px" viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<polygon points="0 0 24 0 24 24 0 24"/>
<path
    d="M4.85714286,1 L11.7364114,1 C12.0910962,1 12.4343066,1.12568431 12.7051108,1.35473959 L17.4686994,5.3839416 C17.8056532,5.66894833 18,6.08787823 18,6.52920201 L18,19.0833333 C18,20.8738751 17.9795521,21 16.1428571,21 L4.85714286,21 C3.02044787,21 3,20.8738751 3,19.0833333 L3,2.91666667 C3,1.12612489 3.02044787,1 4.85714286,1 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z"
    fill="#000000" fill-rule="nonzero" opacity="0.3"/>
<path
    d="M6.85714286,3 L14.7364114,3 C15.0910962,3 15.4343066,3.12568431 15.7051108,3.35473959 L20.4686994,7.3839416 C20.8056532,7.66894833 21,8.08787823 21,8.52920201 L21,21.0833333 C21,22.8738751 20.9795521,23 19.1428571,23 L6.85714286,23 C5.02044787,23 5,22.8738751 5,21.0833333 L5,4.91666667 C5,3.12612489 5.02044787,3 6.85714286,3 Z M8,12 C7.44771525,12 7,12.4477153 7,13 C7,13.5522847 7.44771525,14 8,14 L15,14 C15.5522847,14 16,13.5522847 16,13 C16,12.4477153 15.5522847,12 15,12 L8,12 Z M8,16 C7.44771525,16 7,16.4477153 7,17 C7,17.5522847 7.44771525,18 8,18 L11,18 C11.5522847,18 12,17.5522847 12,17 C12,16.4477153 11.5522847,16 11,16 L8,16 Z"
    fill="#000000" fill-rule="nonzero"/>
</g>
</svg><!--end::Svg Icon-->
</span>
</span>
                    <span class="menu-text">{{trans('s_admin.nav_method')}}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu ">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent " aria-haspopup="true">
<span class="menu-link">
<span class="menu-text">{{trans('s_admin.nav_method')}}</span>
</span>
                        </li>
                        @can("origin curriculum")
                            <li class="menu-item @if(request()->segment(1) == 'levels' ) menu-item-active  @endif"
                                aria-haspopup="true">
                                <a href="{{route('levels.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Code\Git1.svg--><svg
        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<rect x="0" y="0" width="24" height="24"/>
<rect fill="#000000" opacity="0.3" x="11" y="8" width="2" height="9" rx="1"/>
<path
    d="M12,21 C13.1045695,21 14,20.1045695 14,19 C14,17.8954305 13.1045695,17 12,17 C10.8954305,17 10,17.8954305 10,19 C10,20.1045695 10.8954305,21 12,21 Z M12,23 C9.790861,23 8,21.209139 8,19 C8,16.790861 9.790861,15 12,15 C14.209139,15 16,16.790861 16,19 C16,21.209139 14.209139,23 12,23 Z"
    fill="#000000" fill-rule="nonzero"/>
<path
    d="M12,7 C13.1045695,7 14,6.1045695 14,5 C14,3.8954305 13.1045695,3 12,3 C10.8954305,3 10,3.8954305 10,5 C10,6.1045695 10.8954305,7 12,7 Z M12,9 C9.790861,9 8,7.209139 8,5 C8,2.790861 9.790861,1 12,1 C14.209139,1 16,2.790861 16,5 C16,7.209139 14.209139,9 12,9 Z"
    fill="#000000" fill-rule="nonzero"/>
</g>
</svg><!--end::Svg Icon-->
</span>
</span>
                                    <span class="menu-text">{{trans('s_admin.nav_levels')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("Distance education evaluation settings")
                            <li class="menu-item @if(request()->segment(3) == 'far_episode' && request()->segment(2)=='ErrorType') menu-item-active  @endif "
                                aria-haspopup="true">
                                <a href="{{route('far_episode_ErrorType.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Chat-check.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path
                                        d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path
                                        d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z"
                                        fill="#000000"/>
                                    </g>
                                    </svg><!--end::Svg Icon-->
                                    </span>
                                    </span>
                                    <span class="menu-text">{{trans('s_admin.nav_home_far_ErrorType')}}</span>
                                </a>
                            </li>
                        @endcan
                        @if(settings()->show_mogmaa_dorr == '1')
                            @can("Assessment Statement Settings")
                                <li class="menu-item @if(request()->segment(2)=='ErrorType'&& request()->segment(3)=='mogmaa') menu-item-active  @endif "
                                    aria-haspopup="true">
                                    <a href="{{route('ErrorType.index')}}" class="menu-link">
                                        <i class="menu-bullet menu-bullet-dot">
                                            <span></span>
                                        </i>
                                        <span class="svg-icon menu-icon">
                                        <span class="svg-icon svg-icon-primary svg-icon-2x">
                                        <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Chat-check.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink"
                                                 width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path
                                                    d="M4.875,20.75 C4.63541667,20.75 4.39583333,20.6541667 4.20416667,20.4625 L2.2875,18.5458333 C1.90416667,18.1625 1.90416667,17.5875 2.2875,17.2041667 C2.67083333,16.8208333 3.29375,16.8208333 3.62916667,17.2041667 L4.875,18.45 L8.0375,15.2875 C8.42083333,14.9041667 8.99583333,14.9041667 9.37916667,15.2875 C9.7625,15.6708333 9.7625,16.2458333 9.37916667,16.6291667 L5.54583333,20.4625 C5.35416667,20.6541667 5.11458333,20.75 4.875,20.75 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                                <path
                                                    d="M2,11.8650466 L2,6 C2,4.34314575 3.34314575,3 5,3 L19,3 C20.6568542,3 22,4.34314575 22,6 L22,15 C22,15.0032706 21.9999948,15.0065399 21.9999843,15.009808 L22.0249378,15 L22.0249378,19.5857864 C22.0249378,20.1380712 21.5772226,20.5857864 21.0249378,20.5857864 C20.7597213,20.5857864 20.5053674,20.4804296 20.317831,20.2928932 L18.0249378,18 L12.9835977,18 C12.7263047,14.0909841 9.47412135,11 5.5,11 C4.23590829,11 3.04485894,11.3127315 2,11.8650466 Z M6,7 C5.44771525,7 5,7.44771525 5,8 C5,8.55228475 5.44771525,9 6,9 L15,9 C15.5522847,9 16,8.55228475 16,8 C16,7.44771525 15.5522847,7 15,7 L6,7 Z"
                                                    fill="#000000"/>
                                                </g>
                                            </svg><!--end::Svg Icon-->
                                        </span>
                                    </span>
                                        <span class="menu-text">{{trans('s_admin.nav_home_ErrorType')}}</span>
                                    </a>
                                </li>
                            @endcan
                        @endif
                    </ul>
                </div>
            </li>
        @endif

        {{--    ||Gate::check('Memorization line count report')--}}
        @if( Gate::check('Certificates')|| Gate::check('Episode Rating')|| Gate::check('Daily recitation report') ||Gate::check('teacher evaluation report') ||Gate::check('data report') || Gate::check('Staff roles settings')|| Gate::check('productivity report')||
        Gate::check('Employee data report') || Gate::check('Teacher attendance report')|| Gate::check('teacher achievement report')||
        Gate::check("Student's history"))
            <li class="menu-item menu-item-submenu @if(request()->segment(1) == 'reports') menu-item-open @endif "
                aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-bar1.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
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
                    <span class="menu-text">{{trans('s_admin.nav_reports_and_stat')}}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                        <span class="menu-link">
                        <span class="menu-text">{{trans('s_admin.nav_reports_and_stat')}}</span>
                        </span>
                        </li>
                        @can("data report")
                            <li class="menu-item menu-item-submenu @if(request()->segment(2) == 'data') menu-item-open @endif"
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="{{route('reports.basic')}}" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-line2.svg-->
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                                fill="#000000" fill-rule="nonzero"/>
                                            <path
                                                d="M8.7295372,14.6839411 C8.35180695,15.0868534 7.71897114,15.1072675 7.31605887,14.7295372 C6.9131466,14.3518069 6.89273254,13.7189711 7.2704628,13.3160589 L11.0204628,9.31605887 C11.3857725,8.92639521 11.9928179,8.89260288 12.3991193,9.23931335 L15.358855,11.7649545 L19.2151172,6.88035571 C19.5573373,6.44687693 20.1861655,6.37289714 20.6196443,6.71511723 C21.0531231,7.05733733 21.1271029,7.68616551 20.7848828,8.11964429 L16.2848828,13.8196443 C15.9333973,14.2648593 15.2823707,14.3288915 14.8508807,13.9606866 L11.8268294,11.3801628 L8.7295372,14.6839411 Z"
                                                fill="#000000" fill-rule="nonzero" opacity="0.3"
                                                transform="translate(14.000019, 10.749981) scale(1, -1) translate(-14.000019, -10.749981) "/>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </span>
                                    <span class="menu-text">{{trans('s_admin.nav_students_reports')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("Staff roles settings")
                            <li class="menu-item menu-item-submenu @if(request()->segment(2) == 'attendance') menu-item-open @endif"
                                aria-haspopup="true">
                                <a href="{{route('reports.attendance')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-bar2.svg-->
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <rect fill="#000000" opacity="0.3" x="17" y="4" width="3" height="13"
                                                  rx="1.5"/>
                                            <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8"
                                                  rx="1.5"/>
                                            <path
                                                d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                                fill="#000000" fill-rule="nonzero"/>
                                            <rect fill="#000000" opacity="0.3" x="7" y="11" width="3" height="6"
                                                  rx="1.5"/>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </span>
                                    <span class="menu-text">{{trans('s_admin.nav_teachers_reports')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("productivity report")
                            <li class="menu-item menu-item-submenu @if(request()->segment(2) == 'productivity') menu-item-open @endif"
                                aria-haspopup="true">
                                <a href="{{route('reports.productivity')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-line2.svg-->
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path
                                                    d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                                <path
                                                    d="M8.7295372,14.6839411 C8.35180695,15.0868534 7.71897114,15.1072675 7.31605887,14.7295372 C6.9131466,14.3518069 6.89273254,13.7189711 7.2704628,13.3160589 L11.0204628,9.31605887 C11.3857725,8.92639521 11.9928179,8.89260288 12.3991193,9.23931335 L15.358855,11.7649545 L19.2151172,6.88035571 C19.5573373,6.44687693 20.1861655,6.37289714 20.6196443,6.71511723 C21.0531231,7.05733733 21.1271029,7.68616551 20.7848828,8.11964429 L16.2848828,13.8196443 C15.9333973,14.2648593 15.2823707,14.3288915 14.8508807,13.9606866 L11.8268294,11.3801628 L8.7295372,14.6839411 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3"
                                                    transform="translate(14.000019, 10.749981) scale(1, -1) translate(-14.000019, -10.749981) "/>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </span>
                                    <span class="menu-text">{{trans('s_admin.nav_save_and_lisen_reports')}}</span>
                                </a>
                            </li>
                        @endcan
                        {{--                    @can("Daily recitation report")--}}
                        {{--                        <li class="menu-item menu-item-submenu @if(request()->segment(3) == 'reciting_today') menu-item-open @endif"--}}
                        {{--                            aria-haspopup="true">--}}
                        {{--                            <a href="{{route('reports.reports.reciting_today')}}" class="menu-link">--}}
                        {{--                                <i class="menu-bullet menu-bullet-dot">--}}
                        {{--                                    <span></span>--}}
                        {{--                                </i>--}}
                        {{--                                <span class="svg-icon menu-icon">--}}
                        {{--                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-line2.svg-->--}}
                        {{--                                        <svg--}}
                        {{--                                            xmlns="http://www.w3.org/2000/svg"--}}
                        {{--                                            xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                        {{--                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
                        {{--                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                        {{--                                                <rect x="0" y="0" width="24" height="24"/>--}}
                        {{--                                                <path--}}
                        {{--                                                    d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"--}}
                        {{--                                                    fill="#000000" fill-rule="nonzero"/>--}}
                        {{--                                                <path--}}
                        {{--                                                    d="M8.7295372,14.6839411 C8.35180695,15.0868534 7.71897114,15.1072675 7.31605887,14.7295372 C6.9131466,14.3518069 6.89273254,13.7189711 7.2704628,13.3160589 L11.0204628,9.31605887 C11.3857725,8.92639521 11.9928179,8.89260288 12.3991193,9.23931335 L15.358855,11.7649545 L19.2151172,6.88035571 C19.5573373,6.44687693 20.1861655,6.37289714 20.6196443,6.71511723 C21.0531231,7.05733733 21.1271029,7.68616551 20.7848828,8.11964429 L16.2848828,13.8196443 C15.9333973,14.2648593 15.2823707,14.3288915 14.8508807,13.9606866 L11.8268294,11.3801628 L8.7295372,14.6839411 Z"--}}
                        {{--                                                    fill="#000000" fill-rule="nonzero" opacity="0.3"--}}
                        {{--                                                    transform="translate(14.000019, 10.749981) scale(1, -1) translate(-14.000019, -10.749981) "/>--}}
                        {{--                                            </g>--}}
                        {{--                                        </svg><!--end::Svg Icon-->--}}
                        {{--                                    </span>--}}
                        {{--                                </span>--}}
                        {{--                                <span class="menu-text">{{trans('s_admin.reports_today_listen')}}</span>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                    @endcan--}}
                        @can("Employee data report")
                            <li class="menu-item menu-item-submenu @if(request()->segment(2) == 'teacher' && request()->segment(3) == 'data') menu-item-open @endif"
                                aria-haspopup="true">
                                <a href="{{route('reports.teacher.data')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-bar2.svg-->
                                        <svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <rect fill="#000000" opacity="0.3" x="17" y="4" width="3" height="13"
                                                      rx="1.5"/>
                                                <rect fill="#000000" opacity="0.3" x="12" y="9" width="3" height="8"
                                                      rx="1.5"/>
                                                <path
                                                    d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                                <rect fill="#000000" opacity="0.3" x="7" y="11" width="3" height="6"
                                                      rx="1.5"/>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </span>
                                    <span class="menu-text">{{trans('s_admin.nav_follow_current_chanel')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("Teacher attendance report")
                            <li class="menu-item menu-item-submenu @if(request()->segment(2) == 'teacher' && request()->segment(3) == 'attendance') menu-item-open @endif"
                                aria-haspopup="true">
                                <a href="{{route('reports.teacher.attendance')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Shopping\Chart-line2.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink"
                                             width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path
                                                    d="M5,19 L20,19 C20.5522847,19 21,19.4477153 21,20 C21,20.5522847 20.5522847,21 20,21 L4,21 C3.44771525,21 3,20.5522847 3,20 L3,4 C3,3.44771525 3.44771525,3 4,3 C4.55228475,3 5,3.44771525 5,4 L5,19 Z"
                                                    fill="#000000" fill-rule="nonzero"/>
                                                <path
                                                    d="M8.7295372,14.6839411 C8.35180695,15.0868534 7.71897114,15.1072675 7.31605887,14.7295372 C6.9131466,14.3518069 6.89273254,13.7189711 7.2704628,13.3160589 L11.0204628,9.31605887 C11.3857725,8.92639521 11.9928179,8.89260288 12.3991193,9.23931335 L15.358855,11.7649545 L19.2151172,6.88035571 C19.5573373,6.44687693 20.1861655,6.37289714 20.6196443,6.71511723 C21.0531231,7.05733733 21.1271029,7.68616551 20.7848828,8.11964429 L16.2848828,13.8196443 C15.9333973,14.2648593 15.2823707,14.3288915 14.8508807,13.9606866 L11.8268294,11.3801628 L8.7295372,14.6839411 Z"
                                                    fill="#000000" fill-rule="nonzero" opacity="0.3"
                                                    transform="translate(14.000019, 10.749981) scale(1, -1) translate(-14.000019, -10.749981) "/>
                                            </g>
                                        </svg><!--end::Svg Icon-->
                                    </span>
                                </span>
                                    <span class="menu-text">{{trans('s_admin.nav_missions_done_reports')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("teacher achievement report")
                            <li class="menu-item menu-item-submenu @if(request()->segment(2) == 'teacher' && request()->segment(3) == 'Achievement') menu-item-open @endif"
                                aria-haspopup="true">
                                <a href="{{route('reports.teacher.Achievement')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Arrows-v.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <polygon points="0 0 24 0 24 24 0 24"/>
                                    <rect fill="#000000" opacity="0.3"
                                          transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) "
                                          x="7" y="11" width="10" height="2" rx="1"/>
                                    <path
                                        d="M6.70710678,8.70710678 C6.31658249,9.09763107 5.68341751,9.09763107 5.29289322,8.70710678 C4.90236893,8.31658249 4.90236893,7.68341751 5.29289322,7.29289322 L11.2928932,1.29289322 C11.6714722,0.914314282 12.2810586,0.90106866 12.6757246,1.26284586 L18.6757246,6.76284586 C19.0828436,7.13603827 19.1103465,7.76860564 18.7371541,8.17572463 C18.3639617,8.58284362 17.7313944,8.61034655 17.3242754,8.23715414 L12.0300757,3.38413782 L6.70710678,8.70710678 Z"
                                        fill="#000000" fill-rule="nonzero"/>
                                    <path
                                        d="M6.70710678,22.7071068 C6.31658249,23.0976311 5.68341751,23.0976311 5.29289322,22.7071068 C4.90236893,22.3165825 4.90236893,21.6834175 5.29289322,21.2928932 L11.2928932,15.2928932 C11.6714722,14.9143143 12.2810586,14.9010687 12.6757246,15.2628459 L18.6757246,20.7628459 C19.0828436,21.1360383 19.1103465,21.7686056 18.7371541,22.1757246 C18.3639617,22.5828436 17.7313944,22.6103465 17.3242754,22.2371541 L12.0300757,17.3841378 L6.70710678,22.7071068 Z"
                                        fill="#000000" fill-rule="nonzero"
                                        transform="translate(12.000003, 18.999999) rotate(-180.000000) translate(-12.000003, -18.999999) "/>
                                    </g>
                                    </svg><!--end::Svg Icon-->
                                    </span>
                                    </span>
                                    <span class="menu-text">{{trans('s_admin.nav_come_out_reports')}}</span>
                                </a>
                            </li>
                        @endcan
                        {{--                    @can("teacher evaluation report")--}}
                        {{--                        <li class="menu-item menu-item-submenu @if(request()->segment(2) == 'teacher' && request()->segment(3) == 'rates') menu-item-open @endif"--}}
                        {{--                            aria-haspopup="true">--}}
                        {{--                            <a href="{{route('reports.teacher.rates')}}" class="menu-link">--}}
                        {{--                                <i class="menu-bullet menu-bullet-dot">--}}
                        {{--                                    <span></span>--}}
                        {{--                                </i>--}}
                        {{--                                <span class="svg-icon menu-icon">--}}
                        {{--                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Navigation\Arrows-v.svg--><svg--}}
                        {{--                                            xmlns="http://www.w3.org/2000/svg"--}}
                        {{--                                            xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                        {{--                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
                        {{--                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                        {{--                                    <polygon points="0 0 24 0 24 24 0 24"/>--}}
                        {{--                                    <rect fill="#000000" opacity="0.3"--}}
                        {{--                                          transform="translate(12.000000, 12.000000) rotate(-90.000000) translate(-12.000000, -12.000000) "--}}
                        {{--                                          x="7" y="11" width="10" height="2" rx="1"/>--}}
                        {{--                                    <path--}}
                        {{--                                        d="M6.70710678,8.70710678 C6.31658249,9.09763107 5.68341751,9.09763107 5.29289322,8.70710678 C4.90236893,8.31658249 4.90236893,7.68341751 5.29289322,7.29289322 L11.2928932,1.29289322 C11.6714722,0.914314282 12.2810586,0.90106866 12.6757246,1.26284586 L18.6757246,6.76284586 C19.0828436,7.13603827 19.1103465,7.76860564 18.7371541,8.17572463 C18.3639617,8.58284362 17.7313944,8.61034655 17.3242754,8.23715414 L12.0300757,3.38413782 L6.70710678,8.70710678 Z"--}}
                        {{--                                        fill="#000000" fill-rule="nonzero"/>--}}
                        {{--                                    <path--}}
                        {{--                                        d="M6.70710678,22.7071068 C6.31658249,23.0976311 5.68341751,23.0976311 5.29289322,22.7071068 C4.90236893,22.3165825 4.90236893,21.6834175 5.29289322,21.2928932 L11.2928932,15.2928932 C11.6714722,14.9143143 12.2810586,14.9010687 12.6757246,15.2628459 L18.6757246,20.7628459 C19.0828436,21.1360383 19.1103465,21.7686056 18.7371541,22.1757246 C18.3639617,22.5828436 17.7313944,22.6103465 17.3242754,22.2371541 L12.0300757,17.3841378 L6.70710678,22.7071068 Z"--}}
                        {{--                                        fill="#000000" fill-rule="nonzero"--}}
                        {{--                                        transform="translate(12.000003, 18.999999) rotate(-180.000000) translate(-12.000003, -18.999999) "/>--}}
                        {{--                                    </g>--}}
                        {{--                                    </svg><!--end::Svg Icon-->--}}
                        {{--                                    </span>--}}
                        {{--                                    </span>--}}
                        {{--                                <span class="menu-text">{{trans('s_admin.nav_teacher_rates_reports')}}</span>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                    @endcan--}}
                        @can("Student's history")
                            <li class="menu-item menu-item-submenu @if(request()->segment(2) == 'student_history') menu-item-open @endif"
                                aria-haspopup="true">
                                <a href="{{route('reports.student_history')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Design\Pen-tool-vector.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path
                                        d="M11,3 L11,11 C11,11.0862364 11.0109158,11.1699233 11.0314412,11.2497543 C10.4163437,11.5908673 10,12.2468125 10,13 C10,14.1045695 10.8954305,15 12,15 C13.1045695,15 14,14.1045695 14,13 C14,12.2468125 13.5836563,11.5908673 12.9685588,11.2497543 C12.9890842,11.1699233 13,11.0862364 13,11 L13,3 L17.7925828,12.5851656 C17.9241309,12.8482619 17.9331722,13.1559315 17.8173006,13.4262985 L15.1298744,19.6969596 C15.051085,19.8808016 14.870316,20 14.6703019,20 L9.32969808,20 C9.12968402,20 8.94891496,19.8808016 8.87012556,19.6969596 L6.18269936,13.4262985 C6.06682778,13.1559315 6.07586907,12.8482619 6.2074172,12.5851656 L11,3 Z"
                                        fill="#000000"/>
                                    <path
                                        d="M10,21 L14,21 C14.5522847,21 15,21.4477153 15,22 L15,23 L9,23 L9,22 C9,21.4477153 9.44771525,21 10,21 Z"
                                        fill="#000000" opacity="0.3"/>
                                    </g>
                                    </svg><!--end::Svg Icon-->
                                    </span>
                                    </span>
                                    <span class="menu-text">{{trans('s_admin.nav_students_reviews_reports')}}</span>
                                </a>
                            </li>
                        @endcan
                        {{--                    @can("Memorization line count report")--}}
                        {{--                        <li class="menu-item menu-item-submenu @if(request()->segment(3) == 'student_save_lines') menu-item-open @endif"--}}
                        {{--                            aria-haspopup="true">--}}
                        {{--                            <a href="{{route('reports.student_save_lines')}}" class="menu-link">--}}
                        {{--                                <i class="menu-bullet menu-bullet-dot">--}}
                        {{--                                    <span></span>--}}
                        {{--                                </i>--}}
                        {{--                                <span class="svg-icon menu-icon">--}}
                        {{--                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Design\Pen-tool-vector.svg--><svg--}}
                        {{--                                            xmlns="http://www.w3.org/2000/svg"--}}
                        {{--                                            xmlns:xlink="http://www.w3.org/1999/xlink"--}}
                        {{--                                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">--}}
                        {{--                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
                        {{--                                    <rect x="0" y="0" width="24" height="24"/>--}}
                        {{--                                    <path--}}
                        {{--                                        d="M11,3 L11,11 C11,11.0862364 11.0109158,11.1699233 11.0314412,11.2497543 C10.4163437,11.5908673 10,12.2468125 10,13 C10,14.1045695 10.8954305,15 12,15 C13.1045695,15 14,14.1045695 14,13 C14,12.2468125 13.5836563,11.5908673 12.9685588,11.2497543 C12.9890842,11.1699233 13,11.0862364 13,11 L13,3 L17.7925828,12.5851656 C17.9241309,12.8482619 17.9331722,13.1559315 17.8173006,13.4262985 L15.1298744,19.6969596 C15.051085,19.8808016 14.870316,20 14.6703019,20 L9.32969808,20 C9.12968402,20 8.94891496,19.8808016 8.87012556,19.6969596 L6.18269936,13.4262985 C6.06682778,13.1559315 6.07586907,12.8482619 6.2074172,12.5851656 L11,3 Z"--}}
                        {{--                                        fill="#000000"/>--}}
                        {{--                                    <path--}}
                        {{--                                        d="M10,21 L14,21 C14.5522847,21 15,21.4477153 15,22 L15,23 L9,23 L9,22 C9,21.4477153 9.44771525,21 10,21 Z"--}}
                        {{--                                        fill="#000000" opacity="0.3"/>--}}
                        {{--                                    </g>--}}
                        {{--                                    </svg><!--end::Svg Icon-->--}}
                        {{--                                    </span>--}}
                        {{--                                    </span>--}}
                        {{--                                <span class="menu-text">{{trans('s_admin.nav_student_save_lines_report')}}</span>--}}
                        {{--                            </a>--}}
                        {{--                        </li>--}}
                        {{--                    @endcan--}}
                        @can("Certificates")
                            <li class="menu-item  @if(request()->segment(2) == 'certificates') menu-item-active  @endif"
                                aria-haspopup="true">
                                <a href="{{route('reports.certificates')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                 <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Clipboard-list.svg-->
                                     <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                          width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M8,3 L8,3.5 C8,4.32842712 8.67157288,5 9.5,5 L14.5,5 C15.3284271,5 16,4.32842712 16,3.5 L16,3 L18,3 C19.1045695,3 20,3.8954305 20,5 L20,21 C20,22.1045695 19.1045695,23 18,23 L6,23 C4.8954305,23 4,22.1045695 4,21 L4,5 C4,3.8954305 4.8954305,3 6,3 L8,3 Z"
                                                fill="#000000" opacity="0.3"/>
                                            <path
                                                d="M11,2 C11,1.44771525 11.4477153,1 12,1 C12.5522847,1 13,1.44771525 13,2 L14.5,2 C14.7761424,2 15,2.22385763 15,2.5 L15,3.5 C15,3.77614237 14.7761424,4 14.5,4 L9.5,4 C9.22385763,4 9,3.77614237 9,3.5 L9,2.5 C9,2.22385763 9.22385763,2 9.5,2 L11,2 Z"
                                                fill="#000000"/>
                                            <rect fill="#000000" opacity="0.3" x="10" y="9" width="7" height="2"
                                                  rx="1"/>
                                            <rect fill="#000000" opacity="0.3" x="7" y="9" width="2" height="2" rx="1"/>
                                            <rect fill="#000000" opacity="0.3" x="7" y="13" width="2" height="2"
                                                  rx="1"/>
                                            <rect fill="#000000" opacity="0.3" x="10" y="13" width="7" height="2"
                                                  rx="1"/>
                                            <rect fill="#000000" opacity="0.3" x="7" y="17" width="2" height="2"
                                                  rx="1"/>
                                            <rect fill="#000000" opacity="0.3" x="10" y="17" width="7" height="2"
                                                  rx="1"/>
                                        </g>
                                     </svg>
                                 </span>
                            </span>
                                    <span class="menu-text">{{trans('s_admin.nav_certifcates')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("Episode Rating")
                            <li class="menu-item  @if(request()->segment(2) == 'rates') menu-item-active  @endif"
                                aria-haspopup="true">
                                <a href="{{route('reports.rates.epo_type')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                 <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Star.svg-->
                                     <svg
                                         xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <polygon points="0 0 24 0 24 24 0 24"/>
                                            <path
                                                d="M12,18 L7.91561963,20.1472858 C7.42677504,20.4042866 6.82214789,20.2163401 6.56514708,19.7274955 C6.46280801,19.5328351 6.42749334,19.309867 6.46467018,19.0931094 L7.24471742,14.545085 L3.94038429,11.3241562 C3.54490071,10.938655 3.5368084,10.3055417 3.92230962,9.91005817 C4.07581822,9.75257453 4.27696063,9.65008735 4.49459766,9.61846284 L9.06107374,8.95491503 L11.1032639,4.81698575 C11.3476862,4.32173209 11.9473121,4.11839309 12.4425657,4.36281539 C12.6397783,4.46014562 12.7994058,4.61977315 12.8967361,4.81698575 L14.9389263,8.95491503 L19.5054023,9.61846284 C20.0519472,9.69788046 20.4306287,10.2053233 20.351211,10.7518682 C20.3195865,10.9695052 20.2170993,11.1706476 20.0596157,11.3241562 L16.7552826,14.545085 L17.5353298,19.0931094 C17.6286908,19.6374458 17.263103,20.1544017 16.7187666,20.2477627 C16.5020089,20.2849396 16.2790408,20.2496249 16.0843804,20.1472858 L12,18 Z"
                                                fill="#000000"/>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                 </span>
                            </span>
                                    <span class="menu-text">{{trans('s_admin.nav_episodes_rates')}}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endif
        @if(Gate::check('Message link settings API') || Gate::check('Send a new message'))
            <li class="menu-item menu-item-submenu @if(request()->segment(1) == 'sms_settings') menu-item-open @endif"
                aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                    <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Communication\Group-chat.svg-->
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                             height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                            <rect x="0" y="0" width="24" height="24"/>
                            <path
                                d="M16,15.6315789 L16,12 C16,10.3431458 14.6568542,9 13,9 L6.16183229,9 L6.16183229,5.52631579 C6.16183229,4.13107011 7.29290239,3 8.68814808,3 L20.4776218,3 C21.8728674,3 23.0039375,4.13107011 23.0039375,5.52631579 L23.0039375,13.1052632 L23.0206157,17.786793 C23.0215995,18.0629336 22.7985408,18.2875874 22.5224001,18.2885711 C22.3891754,18.2890457 22.2612702,18.2363324 22.1670655,18.1421277 L19.6565168,15.6315789 L16,15.6315789 Z"
                                fill="#000000"/>
                            <path
                                d="M1.98505595,18 L1.98505595,13 C1.98505595,11.8954305 2.88048645,11 3.98505595,11 L11.9850559,11 C13.0896254,11 13.9850559,11.8954305 13.9850559,13 L13.9850559,18 C13.9850559,19.1045695 13.0896254,20 11.9850559,20 L4.10078614,20 L2.85693427,21.1905292 C2.65744295,21.3814685 2.34093638,21.3745358 2.14999706,21.1750444 C2.06092565,21.0819836 2.01120804,20.958136 2.01120804,20.8293182 L2.01120804,18.32426 C1.99400175,18.2187196 1.98505595,18.1104045 1.98505595,18 Z M6.5,14 C6.22385763,14 6,14.2238576 6,14.5 C6,14.7761424 6.22385763,15 6.5,15 L11.5,15 C11.7761424,15 12,14.7761424 12,14.5 C12,14.2238576 11.7761424,14 11.5,14 L6.5,14 Z M9.5,16 C9.22385763,16 9,16.2238576 9,16.5 C9,16.7761424 9.22385763,17 9.5,17 L11.5,17 C11.7761424,17 12,16.7761424 12,16.5 C12,16.2238576 11.7761424,16 11.5,16 L9.5,16 Z"
                                fill="#000000" opacity="0.3"/>
                            </g>
                        </svg><!--end::Svg Icon-->
                    </span>
                </span>
                    <span class="menu-text">{{trans('s_admin.nav_center_notifications')}}</span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
<span class="menu-link">
<span class="menu-text">{{trans('s_admin.nav_center_notifications')}}</span>
</span>
                        </li>
                        @can("Message link settings API")
                            <li class="menu-item @if(request()->segment(1) == 'sms_settings' && request()->segment(2) == 'show') menu-item-open @endif "
                                aria-haspopup="true">
                                <a href="{{route('sms.settings')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Sign_up#3.svg--><svg
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    <rect x="0" y="0" width="24" height="24"/>
    <rect fill="#000000" opacity="0.3" x="2" y="6" width="21" height="12"
          rx="6"/>
    <circle fill="#000000" cx="17" cy="12" r="4"/>
</g>
</svg><!--end::Svg Icon-->
</span>
</span>
                                    <span class="menu-text">{{trans('s_admin.nav_settings_connect_sms')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("Send a new message")
                            <li class="menu-item @if(request()->segment(1) == 'sms_settings' && request()->segment(2) == 'create') menu-item-open @endif "
                                aria-haspopup="true">
                                <a href="{{route('sms.settings.create')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Sign_up#3.svg--><svg
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink"
        width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
    <rect x="0" y="0" width="24" height="24"/>
    <rect fill="#000000" opacity="0.3" x="2" y="6" width="21" height="12"
          rx="6"/>
    <circle fill="#000000" cx="17" cy="12" r="4"/>
</g>
</svg><!--end::Svg Icon-->
</span>
</span>
                                    <span class="menu-text">{{trans('s_admin.nav_send_sms')}}</span>
                                </a>
                            </li>
                        @endcan
                    </ul>
                </div>
            </li>
        @endif
        {{--   // nav_library_electrony--}}

        {{--        <li class="menu-item menu-item-submenu" aria-haspopup="true" data-menu-toggle="hover">--}}
        {{--            <a href="javascript:void(0);" class="menu-link menu-toggle">--}}
        {{--            <span class="svg-icon menu-icon">--}}
        {{--                <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Library.svg--><svg--}}
        {{--                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"--}}
        {{--                        height="24px" viewBox="0 0 24 24" version="1.1">--}}
        {{--                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">--}}
        {{--                            <rect x="0" y="0" width="24" height="24"/>--}}
        {{--                            <path--}}
        {{--                                d="M5,3 L6,3 C6.55228475,3 7,3.44771525 7,4 L7,20 C7,20.5522847 6.55228475,21 6,21 L5,21 C4.44771525,21 4,20.5522847 4,20 L4,4 C4,3.44771525 4.44771525,3 5,3 Z M10,3 L11,3 C11.5522847,3 12,3.44771525 12,4 L12,20 C12,20.5522847 11.5522847,21 11,21 L10,21 C9.44771525,21 9,20.5522847 9,20 L9,4 C9,3.44771525 9.44771525,3 10,3 Z"--}}
        {{--                                fill="#000000"/>--}}
        {{--                            <rect fill="#000000" opacity="0.3"--}}
        {{--                                  transform="translate(17.825568, 11.945519) rotate(-19.000000) translate(-17.825568, -11.945519) "--}}
        {{--                                  x="16.3255682" y="2.94551858" width="3" height="18" rx="1"/>--}}
        {{--                        </g>--}}
        {{--                    </svg><!--end::Svg Icon-->--}}
        {{--                </span>--}}
        {{--            </span>--}}
        {{--                <span class="menu-text">{{trans('s_admin.nav_library_electrony')}}</span>--}}
        {{--                <i class="menu-arrow"></i>--}}
        {{--            </a>--}}
        {{--            <div class="menu-submenu">--}}
        {{--                <i class="menu-arrow"></i>--}}
        {{--                <ul class="menu-subnav">--}}
        {{--                    <li class="menu-item menu-item-parent" aria-haspopup="true">--}}
        {{--                    <span class="menu-link">--}}
        {{--                        <span class="menu-text">{{trans('s_admin.nav_library_electrony')}}</span>--}}
        {{--                    </span>--}}
        {{--                    </li>--}}
        {{--                </ul>--}}
        {{--            </div>--}}
        {{--        </li>--}}
        @if(Gate::check('General Sign_up') || Gate::check('Qualifications') || Gate::check('Job title')||
        Gate::check('degree of kinship') || Gate::check('Nationalities') || Gate::check('Countries') || Gate::check('Publications')||
        Gate::check('School years') || Gate::check('User settings') || Gate::check('Managing tasks and powers') || Gate::check('Sliders'))
            {{--    menu-item-open menu-item-here--}}
            <li class="menu-item menu-item-submenu @if(request()->segment(1) == 'blogs'||request()->segment(1) == 'episode_rate_questions'||request()->segment(1) == 'study_teachers' ||request()->segment(1) == 'sliders' || request()->segment(1) == 'users' || request()->segment(1) == 'roles' || request()->segment(1) == 'web_settings' || request()->segment(1) == 'settings'|| request()->segment(1) == 'Academic_years') menu-item-open @endif "
                aria-haspopup="true" data-menu-toggle="hover">
                <a href="javascript:void(0);" class="menu-link menu-toggle">
                <span class="svg-icon menu-icon">
                <span class="svg-icon svg-icon-success svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Sign_up-2.svg--><svg
                        xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                        height="24px" viewBox="0 0 24 24" version="1.1">
                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                <rect x="0" y="0" width="24" height="24"/>
                <path
                    d="M5,8.6862915 L5,5 L8.6862915,5 L11.5857864,2.10050506 L14.4852814,5 L19,5 L19,9.51471863 L21.4852814,12 L19,14.4852814 L19,19 L14.4852814,19 L11.5857864,21.8994949 L8.6862915,19 L5,19 L5,15.3137085 L1.6862915,12 L5,8.6862915 Z M12,15 C13.6568542,15 15,13.6568542 15,12 C15,10.3431458 13.6568542,9 12,9 C10.3431458,9 9,10.3431458 9,12 C9,13.6568542 10.3431458,15 12,15 Z"
                    fill="#000000"/>
                </g>
                </svg><!--end::Svg Icon-->
                </span>
                </span>
                    <span class="menu-text">
                    {{trans('s_admin.settings')}}
                        @if($new_users > 0)
                            &nbsp;
                            &nbsp;
                            <span style="width: 20px;height: 20px;"
                                  href="#" class="btn btn-icon btn-danger btn-circle pulse pulse-danger">
{{$new_users}}
</span>
                        @endif
                </span>
                    <i class="menu-arrow"></i>
                </a>
                <div class="menu-submenu">
                    <i class="menu-arrow"></i>
                    <ul class="menu-subnav">
                        <li class="menu-item menu-item-parent" aria-haspopup="true">
                <span class="menu-link">
                <span class="menu-text">{{trans('s_admin.settings')}}</span>
                </span>
                        </li>
                        @can("General Sign_up")
                            <li class="menu-item @if(request()->segment(1) == 'web_settings') menu-item-active @endif"
                                aria-haspopup="true">
                                <a href="{{url('/web_settings')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px"
                                         height="24px" viewBox="0 0 24 24" version="1.1">

                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <circle fill="#000000" opacity="0.3" cx="12" cy="12" r="9"/>
                                    <path
                                        d="M11.7357634,20.9961946 C6.88740052,20.8563914 3,16.8821712 3,12 C3,11.9168367 3.00112797,11.8339369 3.00336944,11.751315 C3.66233009,11.8143341 4.85636818,11.9573854 4.91262842,12.4204038 C4.9904938,13.0609191 4.91262842,13.8615942 5.45804656,14.101772 C6.00346469,14.3419498 6.15931561,13.1409372 6.6267482,13.4612567 C7.09418079,13.7815761 8.34086797,14.0899175 8.34086797,14.6562185 C8.34086797,15.222396 8.10715168,16.1034596 8.34086797,16.2636193 C8.57458427,16.423779 9.5089688,17.54465 9.50920913,17.7048097 C9.50956962,17.8649694 9.83857487,18.6793513 9.74040201,18.9906563 C9.65905192,19.2487394 9.24857641,20.0501554 8.85059781,20.4145589 C9.75315358,20.7620621 10.7235846,20.9657742 11.7357634,20.9960544 L11.7357634,20.9961946 Z M8.28272988,3.80112099 C9.4158415,3.28656421 10.6744554,3 12,3 C15.5114513,3 18.5532143,5.01097452 20.0364482,7.94408274 C20.069657,8.72412177 20.0638332,9.39135321 20.2361262,9.6327358 C21.1131932,10.8600506 18.0995147,11.7043158 18.5573343,13.5605384 C18.7589671,14.3794892 16.5527814,14.1196773 16.0139722,14.886394 C15.4748026,15.6527403 14.1574598,15.137809 13.8520064,14.9904917 C13.546553,14.8431744 12.3766497,15.3341497 12.4789081,14.4995164 C12.5805657,13.664636 13.2922889,13.6156126 14.0555619,13.2719546 C14.8184743,12.928667 15.9189236,11.7871741 15.3781918,11.6380045 C12.8323064,10.9362407 11.963771,8.47852395 11.963771,8.47852395 C11.8110443,8.44901109 11.8493762,6.74109366 11.1883616,6.69207022 C10.5267462,6.64279981 10.170464,6.88841096 9.20435656,6.69207022 C8.23764828,6.49572949 8.44144409,5.85743687 8.2887174,4.48255778 C8.25453994,4.17415686 8.25619136,3.95717082 8.28272988,3.80112099 Z M20.9991771,11.8770357 C20.9997251,11.9179585 21,11.9589471 21,12 C21,16.9406923 17.0188468,20.9515364 12.0895088,20.9995641 C16.970233,20.9503326 20.9337111,16.888438 20.9991771,11.8770357 Z"
                                        fill="#000000" opacity="0.3"/>
                                    </g>
                                    </svg>
                                    </span>
                                    </span>
                                    <span class="menu-text">{{trans('s_admin.nav_public_settings')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("Episode evaluation questions")
                            <li class="menu-item @if(request()->segment(1) == 'episode_rate_questions') menu-item-active @endif"
                                aria-haspopup="true">
                                <a href="{{url('/episode_rate_questions')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>


                                    <span class="svg-icon menu-icon">
                                         <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Text\Toggle-Right.svg--><svg
                                                 xmlns="http://www.w3.org/2000/svg"
                                                 xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                                 viewBox="0 0 24 24" version="1.1">
    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
        <rect x="0" y="0" width="24" height="24"/>
        <path fill-rule="evenodd" clip-rule="evenodd"
              d="M22 11.5C22 12.3284 21.3284 13 20.5 13H3.5C2.6716 13 2 12.3284 2 11.5C2 10.6716 2.6716 10 3.5 10H20.5C21.3284 10 22 10.6716 22 11.5Z"
              fill="black"/>
  <path opacity="0.5" fill-rule="evenodd" clip-rule="evenodd"
        d="M14.5 20C15.3284 20 16 19.3284 16 18.5C16 17.6716 15.3284 17 14.5 17H3.5C2.6716 17 2 17.6716 2 18.5C2 19.3284 2.6716 20 3.5 20H14.5ZM8.5 6C9.3284 6 10 5.32843 10 4.5C10 3.67157 9.3284 3 8.5 3H3.5C2.6716 3 2 3.67157 2 4.5C2 5.32843 2.6716 6 3.5 6H8.5Z"
        fill="black"/>
    </g>
</svg><!--end::Svg Icon--></span>
                                        </span>
                                    <span class="menu-text">{{trans('s_admin.nav_episode_rate_questions')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("Qualifications")
                            <li class="menu-item @if(request()->segment(3) == 'qualification') menu-item-active @endif"
                                aria-haspopup="true">
                                <a href="{{route('qualification.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path
                                        d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path
                                        d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                        fill="#000000" opacity="0.3"/>
                                    </g>
                                    </svg><!--end::Svg Icon-->
                                    </span>
                                    </span>
                                    <span
                                        class="menu-text">{{trans('s_admin.nav_qualifications')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("Job title")
                            <li class="menu-item @if(request()->segment(3) == 'job_name') menu-item-active @endif"
                                aria-haspopup="true">
                                <a href="{{route('job_name.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                            height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none"
                                       fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path
                                            d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path
                                            d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                            fill="#000000" opacity="0.3"/>
                                    </g>
                                    </svg><!--end::Svg Icon-->
                                    </span>
                                    </span>

                                    <span class="menu-text">{{trans('s_admin.nav_job_name')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("degree of kinship")
                            <li class="menu-item @if(request()->segment(3) == 'relations') menu-item-active @endif"
                                aria-haspopup="true">
                                <a href="{{route('relations.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                            height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none"
                                       fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path
                                            d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path
                                            d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                            fill="#000000" opacity="0.3"/>
                                    </g>
                                    </svg><!--end::Svg Icon-->
                                    </span>
                                    </span>
                                    <span
                                        class="menu-text">{{trans('s_admin.nav_relations')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("Nationalities")
                            <li class="menu-item @if(request()->segment(3) == 'nationality') menu-item-active @endif"
                                aria-haspopup="true">
                                <a href="{{route('nationality.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                            height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none"
                                       fill-rule="evenodd">
                                        <rect x="0" y="0" width="24" height="24"/>
                                        <path
                                            d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                            fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                        <path
                                            d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                            fill="#000000" opacity="0.3"/>
                                    </g>
                                    </svg><!--end::Svg Icon-->
                                    </span>
                                    </span>
                                    <span
                                        class="menu-text">{{trans('s_admin.nav_nationalities')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("Countries")
                            <li class="menu-item @if(request()->segment(3) == 'country') menu-item-active @endif"
                                aria-haspopup="true">
                                <a href="{{route('country.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px"
                                            height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none"
                                           fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                                fill="#000000" fill-rule="nonzero"
                                                opacity="0.3"/>
                                            <path
                                                d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                                fill="#000000" opacity="0.3"/>
                                        </g>
                                    </svg><!--end::Svg Icon-->
                                    </span>
                                    </span>
                                    <span
                                        class="menu-text">{{trans('s_admin.nav_home_country')}}</span>
                                </a>
                            </li>
                        @endcan
                        @can("School years")
                            <li class="menu-item @if(request()->segment(1) == 'Academic_years') menu-item-active @endif"
                                aria-haspopup="true">
                                <a href="{{route('Academic_years.index')}}" class="menu-link">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
                                    <span class="svg-icon svg-icon-primary svg-icon-2x">
                                    <!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg
                                            xmlns="http://www.w3.org/2000/svg"
                                            xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                            viewBox="0 0 24 24" version="1.1">
                                    <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                    <rect x="0" y="0" width="24" height="24"/>
                                    <path
                                        d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
                                        fill="#000000" fill-rule="nonzero" opacity="0.3"/>
                                    <path
                                        d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
                                        fill="#000000" opacity="0.3"/>
                                    </g>
                                    </svg><!--end::Svg Icon-->
                                    </span>
                                    </span>
                                    <span class="menu-text">{{trans('s_admin.Academic_years')}}</span>
                                </a>
                            </li>
                        @endcan
                        @if(Gate::check('User settings') || Gate::check('Managing tasks and powers'))
                            <li class="menu-item menu-item-submenu @if( request()->segment(1) == 'users' || request()->segment(1) == 'roles' ) menu-item-open @endif "
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot"><span></span></i>
                                    <span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-primary svg-icon-2x">
<svg
    xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
    width="24px"
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
</span>
</span>
                                    <span class="menu-text">
                                    {{trans('s_admin.nav_employee_permission_srttings')}}
                                        @if($new_users > 0)
                                            &nbsp;
                                            &nbsp;
                                            <span style="width: 20px;height: 20px;"
                                                  href="#"
                                                  class="btn btn-icon btn-danger btn-circle pulse pulse-danger">
                                            {{$new_users}}
                                        </span>
                                        @endif
                                </span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        @can("User settings")
                                            <li class="menu-item @if( request()->segment(1) == 'users' ) menu-item-active @endif "
                                                aria-haspopup="true">
                                                <a href="{{url('/users')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Visible.svg--><svg
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
        viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<rect x="0" y="0" width="24" height="24"/>
<path
    d="M3,12 C3,12 5.45454545,6 12,6 C16.9090909,6 21,12 21,12 C21,12 16.9090909,18 12,18 C5.45454545,18 3,12 3,12 Z"
    fill="#000000" fill-rule="nonzero" opacity="0.3"/>
<path
    d="M12,15 C10.3431458,15 9,13.6568542 9,12 C9,10.3431458 10.3431458,9 12,9 C13.6568542,9 15,10.3431458 15,12 C15,13.6568542 13.6568542,15 12,15 Z"
    fill="#000000" opacity="0.3"/>
</g>
</svg><!--end::Svg Icon-->
</span>
</span>
                                                    <span class="menu-text">
                                                    {{trans('s_admin.view_users')}}
                                                        @if($new_users > 0)
                                                            &nbsp;
                                                            &nbsp;
                                                            <span style="width: 20px;height: 20px;"
                                                                  href="#"
                                                                  class="btn btn-icon btn-danger btn-circle pulse pulse-danger">
                                                            {{$new_users}}
                                                        </span>
                                                        @endif
                                                </span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can("Managing tasks and powers")
                                            <li class="menu-item  @if( request()->segment(1) == 'roles' ) menu-item-active @endif"
                                                aria-haspopup="true">
                                                {{--                                href="{{url('/roles')}}"--}}
                                                <a href="{{url('/roles')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\General\Sign_up-1.svg--><svg
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
        viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<rect x="0" y="0" width="24" height="24"/>
<path
    d="M7,3 L17,3 C19.209139,3 21,4.790861 21,7 C21,9.209139 19.209139,11 17,11 L7,11 C4.790861,11 3,9.209139 3,7 C3,4.790861 4.790861,3 7,3 Z M7,9 C8.1045695,9 9,8.1045695 9,7 C9,5.8954305 8.1045695,5 7,5 C5.8954305,5 5,5.8954305 5,7 C5,8.1045695 5.8954305,9 7,9 Z"
    fill="#000000"/>
<path
    d="M7,13 L17,13 C19.209139,13 21,14.790861 21,17 C21,19.209139 19.209139,21 17,21 L7,21 C4.790861,21 3,19.209139 3,17 C3,14.790861 4.790861,13 7,13 Z M17,19 C18.1045695,19 19,18.1045695 19,17 C19,15.8954305 18.1045695,15 17,15 C15.8954305,15 15,15.8954305 15,17 C15,18.1045695 15.8954305,19 17,19 Z"
    fill="#000000" opacity="0.3"/>
</g>
</svg><!--end::Svg Icon-->
</span>
</span>
                                                    <span class="menu-text">{{trans('s_admin.nav_permissions')}}</span>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </li>
                        @endif
                        @if( Gate::check('Publications') || Gate::check('Sliders'))
                            <li class="menu-item menu-item-submenu @if(request()->segment(1) == 'blogs' || request()->segment(1) == 'sliders' ) menu-item-open @endif "
                                aria-haspopup="true" data-menu-toggle="hover">
                                <a href="javascript:;" class="menu-link menu-toggle">
                                    <i class="menu-bullet menu-bullet-dot">
                                        <span></span>
                                    </i>
                                    <span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-primary svg-icon-2x">
<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
     width="24px"
     height="24px" viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<rect x="0" y="0" width="24" height="24"/>
<circle fill="#000000" opacity="0.3" cx="12" cy="12" r="9"/>
<path
    d="M11.7357634,20.9961946 C6.88740052,20.8563914 3,16.8821712 3,12 C3,11.9168367 3.00112797,11.8339369 3.00336944,11.751315 C3.66233009,11.8143341 4.85636818,11.9573854 4.91262842,12.4204038 C4.9904938,13.0609191 4.91262842,13.8615942 5.45804656,14.101772 C6.00346469,14.3419498 6.15931561,13.1409372 6.6267482,13.4612567 C7.09418079,13.7815761 8.34086797,14.0899175 8.34086797,14.6562185 C8.34086797,15.222396 8.10715168,16.1034596 8.34086797,16.2636193 C8.57458427,16.423779 9.5089688,17.54465 9.50920913,17.7048097 C9.50956962,17.8649694 9.83857487,18.6793513 9.74040201,18.9906563 C9.65905192,19.2487394 9.24857641,20.0501554 8.85059781,20.4145589 C9.75315358,20.7620621 10.7235846,20.9657742 11.7357634,20.9960544 L11.7357634,20.9961946 Z M8.28272988,3.80112099 C9.4158415,3.28656421 10.6744554,3 12,3 C15.5114513,3 18.5532143,5.01097452 20.0364482,7.94408274 C20.069657,8.72412177 20.0638332,9.39135321 20.2361262,9.6327358 C21.1131932,10.8600506 18.0995147,11.7043158 18.5573343,13.5605384 C18.7589671,14.3794892 16.5527814,14.1196773 16.0139722,14.886394 C15.4748026,15.6527403 14.1574598,15.137809 13.8520064,14.9904917 C13.546553,14.8431744 12.3766497,15.3341497 12.4789081,14.4995164 C12.5805657,13.664636 13.2922889,13.6156126 14.0555619,13.2719546 C14.8184743,12.928667 15.9189236,11.7871741 15.3781918,11.6380045 C12.8323064,10.9362407 11.963771,8.47852395 11.963771,8.47852395 C11.8110443,8.44901109 11.8493762,6.74109366 11.1883616,6.69207022 C10.5267462,6.64279981 10.170464,6.88841096 9.20435656,6.69207022 C8.23764828,6.49572949 8.44144409,5.85743687 8.2887174,4.48255778 C8.25453994,4.17415686 8.25619136,3.95717082 8.28272988,3.80112099 Z M20.9991771,11.8770357 C20.9997251,11.9179585 21,11.9589471 21,12 C21,16.9406923 17.0188468,20.9515364 12.0895088,20.9995641 C16.970233,20.9503326 20.9337111,16.888438 20.9991771,11.8770357 Z"
    fill="#000000" opacity="0.3"/>
</g>
</svg>
</span>
</span>
                                    <span class="menu-text">{{trans('s_admin.nav_out_website_settings')}}</span>
                                    <i class="menu-arrow"></i>
                                </a>
                                <div class="menu-submenu">
                                    <i class="menu-arrow"></i>
                                    <ul class="menu-subnav">
                                        @can("Sliders")
                                            <li class="menu-item @if(request()->segment(1) == 'sliders') menu-item-active @endif"
                                                aria-haspopup="true">
                                                <a href="{{url('/sliders')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Flower2.svg--><svg
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
        viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<polygon points="0 0 24 0 24 24 0 24"/>
<circle fill="#000000" opacity="0.3" cx="15" cy="17" r="5"/>
<circle fill="#000000" opacity="0.3" cx="9" cy="17" r="5"/>
<circle fill="#000000" opacity="0.3" cx="7" cy="11" r="5"/>
<circle fill="#000000" opacity="0.3" cx="17" cy="11" r="5"/>
<circle fill="#000000" opacity="0.3" cx="12" cy="7" r="5"/>
</g>
</svg><!--end::Svg Icon-->
</span>
</span>
                                                    <span class="menu-text">{{trans('s_admin.nav_slider')}}</span>
                                                </a>
                                            </li>
                                        @endcan
                                        @can("Publications")
                                            <li class="menu-item @if(request()->segment(1) == 'blogs') menu-item-active @endif"
                                                aria-haspopup="true">
                                                <a href="{{url('/blogs')}}" class="menu-link">
                                                    <i class="menu-bullet menu-bullet-dot">
                                                        <span></span>
                                                    </i>
                                                    <span class="svg-icon menu-icon">
<span class="svg-icon svg-icon-danger svg-icon-2x"><!--begin::Svg Icon | path:C:\wamp64\www\keenthemes\themes\metronic\theme\html\demo1\dist/../src/media/svg/icons\Home\Flower2.svg--><svg
        xmlns="http://www.w3.org/2000/svg"
        xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
        viewBox="0 0 24 24" version="1.1">
<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
<polygon points="0 0 24 0 24 24 0 24"/>
<circle fill="#000000" opacity="0.3" cx="15" cy="17" r="5"/>
<circle fill="#000000" opacity="0.3" cx="9" cy="17" r="5"/>
<circle fill="#000000" opacity="0.3" cx="7" cy="11" r="5"/>
<circle fill="#000000" opacity="0.3" cx="17" cy="11" r="5"/>
<circle fill="#000000" opacity="0.3" cx="12" cy="7" r="5"/>
</g>
</svg><!--end::Svg Icon-->
</span>
</span>
                                                    <span class="menu-text">{{trans('s_admin.nav_blogs')}}</span>
                                                </a>
                                            </li>
                                        @endcan
                                    </ul>
                                </div>
                            </li>
                        @endif


                    </ul>
                </div>
            </li>
        @endif
    @endif
</ul>
