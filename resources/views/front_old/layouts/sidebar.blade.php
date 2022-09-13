<header class="stick style2 w-100">
    <div class="topbar bg-color1 d-flex flex-wrap justify-content-between w-100 dirar">
        <div class="topbar-left">
            <ul class="topbar-info-list mb-0 list-unstyled d-inline-flex">
                <li><i class="thm-clr far fa-envelope"></i>
                    <a href="javascript:void(0);" title="">{{$settings_share->email}}</a></li>
                <li><i class="thm-clr fas fa-phone-alt"></i><a href="javascript:void(0);"
                                                               title="">{{$settings_share->phone}}</a></li>
            </ul>
        </div>
        <div class="topbar-left">
            <ul class="topbar-info-list mb-0 list-unstyled d-inline-flex">
                <li><i class="thm-clr far"></i><a href="{{url('lang/en')}}"
                                                  @if(app()->getLocale() == 'en')style="color: #c9b288;"
                                                  @endif title="">English</a>
                </li>
                <li><i class="thm-clr fas"></i><a href="{{url('lang/ar')}}"
                                                  @if(app()->getLocale() == 'ar')style="color: #c9b288;"
                                                  @endif title="">العربية</a>
                </li>
            </ul>
        </div>
        <div class="topbar-right d-inline-flex">
            <ul class="topbar-info-list mb-0 list-unstyled d-inline-flex">
                <li><i class="thm-clr flaticon-sun"></i>{{trans('s_admin.date')}} &nbsp;<span
                        class="thm-clr">{{ \Carbon\Carbon::now()->format('Y-m-d') }}</span></li>
                <li><i class="thm-clr flaticon-moon"></i>{{trans('s_admin.time')}}&nbsp; <span
                        class="thm-clr">{{ \Carbon\Carbon::now()->format('H:i a') }}</span></li>
            </ul>
            <div class="social-links d-inline-flex">
                @if($settings_share->twiter != null)
                    <a href="{{$settings_share->twiter}}" title="Twtiiter" target="_blank"><i class="fab fa-twitter"></i></a>
                @endif
                @if( $settings_share->facebook != null)
                    <a href="{{$settings_share->facebook}}" title="Facebook" target="_blank"><i
                            class="fab fa-facebook-f"></i></a>
                @endif
                @if($settings_share->youtube  != null)
                    <a href="{{$settings_share->youtube}}" title="Youtube" target="_blank"><i
                            class="fab fa-youtube"></i></a>
                @endif
                @if($settings_share->linked_in  != null)
                    <a href="{{$settings_share->linked_in}}" title="Linkedin" target="_blank"><i
                            class="fab fa-linkedin-in"></i></a>
                @endif
                @if($settings_share->insta  != null)
                    <a href="{{$settings_share->insta}}" title="Instagram" target="_blank"><i
                            class="fab fa-instagram"></i></a>
                @endif
            </div>
        </div>
    </div><!-- Topbar -->
    <div
        class="logo-menu-wrap v2 d-flex flex-wrap align-items-center justify-content-between w-100 pat-bg  opc65 back-blend-multiply thm-bg dirar"
        style="background-color: #eff5ef;">
        <div class="logo"><h1 class="mb-0">
                @if(app()->getLocale() == 'ar')
                    <a href="{{route('main_page')}}" title="Home">
                        <img style="height: 75px;" class="img-fluid"
                             src="{{$settings_share->logo_ar}}" alt="Logo"
                             srcset="{{$settings_share->logo_ar}}">
                    </a>
                @else
                    <a href="{{route('main_page')}}" title="Home">
                        <img style="height: 62px;" class="img-fluid"
                             src="{{$settings_share->logo_en}}" alt="Logo"
                             srcset="{{$settings_share->logo_en}}">
                    </a>
                @endif
            </h1></div>
        <nav class="d-flex flex-wrap align-items-center justify-content-between">
            <div class="header-left">
                <ul class="mb-0 list-unstyled d-inline-flex">
                    @include('front.layouts.nav_bar')
                </ul>
            </div>
            <div class="row">
                @if( auth()->guard('web')->check())
                    <div>
                        <ol class="breadcrumb mb-0">
                            <a class="thm-btn thm-bg" href="{{route('home')}}"
                               style="font-size: 0.9rem; background-color: gray;">
                                <i class="fa fa-user"></i>&nbsp;{{trans('s_admin.control_panel')}}
                                <span></span><span></span><span></span><span></span>
                            </a>
                        </ol>
                    </div>
                    <div>
                        <ol class="breadcrumb mb-0">
                            <a class="thm-btn thm-bg" href="{{ route('logout') }}"
                               style="font-size: 0.9rem; background-color: #c9b288;">
                                <i class="fas fa-sign-out-alt"></i>&nbsp; {{trans('admin.logout')}}
                                <span></span><span></span><span></span><span></span></a>
                        </ol>
                    </div>&nbsp;&nbsp;
                @elseif( auth()->guard('teacher')->check() )
                    <div>
                        <ol class="breadcrumb mb-0">
                            <a class="thm-btn thm-bg" href="{{route('teacher.home')}}"
                               style="font-size: 0.9rem; background-color: gray;">
                                <i class="fa fa-user"></i>&nbsp;{{trans('s_admin.control_panel')}}
                                <span></span><span></span><span></span><span></span>
                            </a>
                        </ol>
                    </div>
                    <div>
                        <ol class="breadcrumb mb-0">
                            <a class="thm-btn thm-bg" href="{{ route('teacher_logout') }}"
                               style="font-size: 0.9rem; background-color: #c9b288;"><i
                                    class="fas fa-sign-out-alt"></i>&nbsp; {{trans('admin.logout')}}
                                <span></span><span></span><span></span><span></span></a>
                        </ol>
                    </div>
                @elseif( auth()->guard('student')->check() )
                    <div>
                        <ol class="breadcrumb mb-0">
                            <a class="thm-btn thm-bg" href="{{route('student_home')}}"
                               style="font-size: 0.9rem; background-color: gray;">
                                <i class="fa fa-user"></i>&nbsp;{{trans('s_admin.control_panel')}}
                                <span></span><span></span><span></span><span></span>
                            </a>
                        </ol>
                    </div>
                    <div>
                        <ol class="breadcrumb mb-0">
                            <a class="thm-btn thm-bg" href="{{ route('student_logout') }}"
                               style="font-size: 0.9rem; background-color: #c9b288;"><i
                                    class="fas fa-sign-out-alt"></i>&nbsp; {{trans('admin.logout')}}
                                <span></span><span></span><span></span><span></span></a>
                        </ol>
                    </div>
                @else
                    <div>
                        <ol class="breadcrumb mb-0">
                            <a class="thm-btn thm-bg" data-dismiss="modal" data-toggle="modal" id="sign_up_btn"
                               data-target="#sign-modal" href="" title=""
                               style="font-size: 0.9rem; background-color: #c9b288;"><i
                                    class="fa fa-plus"></i>&nbsp; {{trans('admin.sign_up')}}
                                <span></span><span></span><span></span><span></span>
                            </a>
                        </ol>
                    </div>&nbsp;&nbsp;
                    <div>
                        <ol class="breadcrumb mb-0">
                            <a data-toggle="modal" data-dismiss="modal" data-target="#login-modal" id="login_btn"
                               class="thm-btn thm-bg" href=""
                               style="font-size: 0.9rem; background-color: gray;">
                                <i class="fa fa-user"></i>&nbsp;{{trans('admin.login')}}
                                <span></span><span></span><span></span><span></span>
                            </a>
                        </ol>
                    </div>
                @endif

            </div>
        </nav>
    </div><!-- Logo Menu Wrap -->

</header>

<div class="rspn-hdr">
    <div class="rspn-mdbr">
        <div class="rspn-scil">
            <a href="https://twitter.com/" title="Twtiiter" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.facebook.com/" title="Facebook" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.youtube.com/" title="Youtube" target="_blank"><i class="fab fa-youtube"></i></a>
            <a href="https://www.linkedin.com/" title="Linkedin" target="_blank"><i class="fab fa-linkedin-in"></i></a>
            <div class="">
                <ul class="mb-0 list-unstyled d-inline-flex">
                    <li>
                        <a href="{{url('lang/en')}}"
                           @if(app()->getLocale() == 'en')style="color: #c9b288;margin: 0px 7px;"
                           @else style="color: #ffffff;margin: 0px 7px;" @endif title="">English</a>
                    </li>
                    <li>
                        <a href="{{url('lang/ar')}}"
                           @if(app()->getLocale() == 'ar')style="color: #c9b288;margin: 0px 7px;"
                           @else style="color: #ffffff;margin: 0px 7px;" @endif title="">العربية</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="lg-mn">
        @if(app()->getLocale() == 'ar')
            <div class="logo"><a href="{{url('/')}}" title="Home"><img style="height: 80px;"
                                                                       src="{{$settings_share->logo_ar}}"
                                                                       alt="Logo"></a></div>
        @else
            <div class="logo"><a href="{{url('/')}}" title="Home"><img style="height: 80px;"
                                                                       src="{{$settings_share->logo_en}}"
                                                                       alt="Logo"></a></div>
        @endif

        <div class="rspn-cnt">
            <span><i class="thm-clr far fa-envelope"></i><a
                    href="{{$settings_share->email}}">{{$settings_share->email}}</a></span>
            <span><i class="thm-clr fas fa-phone-alt"></i><a
                    href="{{$settings_share->phone}}">{{$settings_share->phone}}</a></span>
        </div>
        <span class="rspn-mnu-btn"><i class="fa fa-list-ul"></i></span>
    </div>
    <div class="rsnp-mnu">
        <span class="rspn-mnu-cls"><i class="fa fa-times"></i></span>
        <ul class="mb-0 list-unstyled w-100">
            @if( auth()->guard('web')->check())
                <li class="menu-item">
                    <a href="{{route('home')}}"
                       title="">{{trans('s_admin.control_panel')}}</a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('logout') }}"
                       title="">{{trans('admin.logout')}}</a>
                </li>
            @elseif( auth()->guard('teacher')->check() )
                <li class="menu-item">
                    <a href="{{route('teacher.home')}}"
                       title="">{{trans('s_admin.control_panel')}}</a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('teacher_logout') }}"
                       title="">{{trans('admin.logout')}}</a>
                </li>
            @elseif( auth()->guard('student')->check() )
                <li class="menu-item">
                    <a href="{{route('student_home')}}"
                       title="">{{trans('s_admin.control_panel')}}</a>
                </li>
                <li class="menu-item">
                    <a href="{{ route('student_logout') }}"
                       title="">{{trans('admin.logout')}}</a>
                </li>
            @else
            <li class="menu-item-has-children"><a href="javascript:void(0);" title="">{{trans('admin.login')}}</a>
                <ul class="mb-0 list-unstyled">
                    {{ Form::open( ['route'  => ['login_both'],'method'=>'post'] ) }}
                        <li>
                            <label for="recipient-name" class="control-label"></label>
                            <div class="row">
                                <div class="col-lg-8">
                                    <div class="form-group" style="padding-bottom: 5px">
                                        <input type="number"
                                               onkeyup="this.value=login_phone(this.value);"
                                               required name="phone" value="{{old('phone')}}"
                                               placeholder="{{trans('s_admin.phone')}}"
                                               class="form-control" id="recipient-name1">
                                    </div>
                                </div>
                                <div class="col-lg-4">
                                    <div class="form-group">
                                        <input id="txt_login_countrycode_code"
                                               style="max-width: 30px;"
                                               @if(old('country_code'))
                                               value="{{old('country_code')}}"
                                               @else
                                               value="+966"
                                               @endif
                                               type="text"
                                               name="country_code"
                                               class="form-control form-control-danger">
                                    </div>
                                </div>
                            </div>
                        </li>
                        <br>
                        <li>
                            <input type="password" required name="password" class="form-control"
                                   placeholder="{{trans('admin.password')}}" id="recipient-name1">
                        </li>
                        <li>
                            <a href="{{route('Forget-password')}}">
                                @if(app()->getLocale() == 'ar')
                                    نسيت كلمة المرور
                                @else
                                    forget Password
                                @endif
                            </a>
                        </li>
                        <br>
                        <li>
                            <button type="submit" class="btn"
                                    style="background-color: burlywood;">{{trans('admin.login')}}</button>
                        </li>
                        {{ Form::close() }}

                </ul>
            </li>
            @endif
            <li class="menu-item-has-children"><a href="javascript:void(0);" title="">{{trans('admin.sign_up')}}</a>
                <ul class="mb-0 list-unstyled">
                    @if($settings_share->show_mogmaa_dorr == '1')
                        <li class="menu-item-has-children">
                            <a href="javascript:void(0);" title="">{{trans('admin.teacher_h')}}</a>
                            <ul class="mb-0 list-unstyled">
                                <li><a href="{{route('sign_up',['type'=> 'teacher_far_learn'])}}"
                                       title="">{{trans('admin.far_learn')}}</a></li>

                                <li><a href="{{route('sign_up',['type'=> 'teacher_mogmaa_dorr'])}}"
                                       title="">{{trans('s_admin.mogmaa_dorr')}}</a></li>

                            </ul>
                        </li>
                    @else
                        <li class="menu-item">
                            <a href="{{route('sign_up',['type'=> 'teacher_far_learn'])}}"
                               title="">{{trans('admin.teacher_h')}}</a>
                        </li>
                    @endif
                    @if($settings_share->show_mogmaa_dorr == '1')
                        <li class="menu-item-has-children"><a href="javascript:void(0);"
                                                              title="">{{trans('admin.student_h')}}</a>
                            <ul class="mb-0 list-unstyled">
                                <li class="menu-item-has-children"><a href="javascript:void(0);"
                                                                      title="">{{trans('admin.far_learn')}}</a>
                                    <ul class="mb-0 list-unstyled">
                                        <li><a href="{{route('sign_up',['type'=> 'far_learn'])}}"
                                               title="">{{trans('s_admin.free_far_learn')}}</a></li>

                                        <li><a href="javascript:void(0);"
                                               title="">{{trans('s_admin.fixed_far_learn')}}</a>
                                        </li>

                                    </ul>
                                </li>
                                @if($settings_share->show_mogmaa_dorr == '1')
                                    <li><a href="{{route('sign_up',['type'=> 'mogmaa_dorr'])}}"
                                           title="">{{trans('s_admin.mogmaa_dorr')}}</a></li>
                                @endif
                            </ul>
                        </li>
                    @else
                        <li class="menu-item">
                            <a href="{{route('sign_up',['type'=> 'far_learn'])}}"
                               title="">{{trans('admin.student_h')}}</a>
                        </li>
                    @endif
                </ul>
            </li>
            <li><a href="{{url('/')}}" title=""><i class="fa fa-home"></i></a></li>
            {{--            <li class="menu-item-has-children"><a href="javascript:void(0);" title=""><i--}}
            {{--                        class="fa fa-align-justify"></i></a>--}}
            {{--                <ul class="mb-0 list-unstyled">--}}
            {{--                    <li><a href="javascript:void(0);" title="">{{trans('admin.nav_one')}}</a></li>--}}
            {{--                    <li><a href="javascript:void(0);" title="">{{trans('admin.nav_five')}}</a></li>--}}
            {{--                    <li><a href="javascript:void(0);" title="">{{trans('admin.nav_four')}}</a></li>--}}
            {{--                    <li><a href="javascript:void(0);" title="">{{trans('admin.nav_three')}}</a></li>--}}
            {{--                    <li><a href="javascript:void(0);" title="">{{trans('admin.nav_two')}}</a></li>--}}
            {{--                    <li><a href="javascript:void(0);" title="">{{trans('admin.nav_six')}}</a></li>--}}
            {{--                </ul>--}}
            {{--            </li>--}}
            @if($settings_share->show_search_teacher == '1')
                <li><a href="{{route('times.show','all')}}" title="">{{trans('admin.search_teacher')}}</a></li>
            @endif
        </ul>
    </div><!-- Responsive Menu -->
</div><!-- Responsive Header -->

<div id="sign-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="background-color: darkgoldenrod;border-radius: 5%!important;">
            <div class="modal-header">
                <div class="col-md-12" style="text-align: center;">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{trans('admin.make_new_account')}}</h5>
                </div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        {{--                            href="{{route('sign_up',['type'=> 'teacher'])}}"--}}
                        @if($settings_share->show_mogmaa_dorr == '1')
                            <a href="javascript:void(0);" class="model_style" data-toggle="modal"
                               data-target="#teacher_model" data-dismiss="modal">
                                <div class="text-center">
                                    <div class="teacher-bg"></div>
                                </div>
                                <h4 style="font-size: 18px;padding-top: 5px;"
                                    class="center">{{trans('admin.teacher_h')}}</h4>
                            </a>
                        @else
                            <a href="{{route('sign_up',['type'=> 'teacher_far_learn'])}}" class="model_style">
                                <div class="text-center">
                                    <div class="teacher-bg"></div>
                                </div>
                                <h4 style="font-size: 18px;padding-top: 5px;"
                                    class="center">{{trans('admin.teacher_h')}}</h4>
                            </a>
                        @endif
                    </div>
                    <div class="vertical d-none d-sm-block d-md-block"></div>
                    <div class="col-md-6">
                        <div class="row>">
                            <div class="col-md-12">
                                @if($settings_share->show_mogmaa_dorr == '0' && $settings_share->show_fixed_subject == '0'
&& $settings_share->show_free_subject == '1' )
                                    <a id="btn_link" href="{{route('sign_up',['type'=> 'far_learn'])}}"
                                       class="model_style">
                                        <div class="text-center">
                                            <div class="student-bg"></div>
                                        </div>
                                        <h4 style="font-size: 18px;padding-top: 5px;"
                                            class="center">{{trans('admin.student_h')}}</h4>
                                    </a>
                                @else
                                    <a id="btn_link" href="javascript:void(0);" class="model_style" data-toggle="modal"
                                       data-target="#stud_model" data-dismiss="modal">
                                        <div class="text-center">
                                            <div class="student-bg"></div>
                                        </div>
                                        <h4 style="font-size: 18px;padding-top: 5px;"
                                            class="center">{{trans('admin.student_h')}}</h4>
                                    </a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="stud_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true"
     style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 5%!important;">
            <div class="modal-header">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{trans('admin.choose_type_epo')}}</h5>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        @if($settings_share->show_fixed_subject == '0')
                            <a href="{{route('sign_up',['type'=> 'far_learn'])}}" class="thm-btn thm-bg"
                               style="background-color: yellowgreen; width: 100%;">
                                {{trans('admin.far_learn')}}
                                <span></span><span></span><span></span><span></span> </a>
                        @else
                            <a href="javascript:void(0);" data-toggle="modal" data-target="#far_learn_model"
                               data-dismiss="modal" class="thm-btn thm-bg"
                               style="background-color: yellowgreen; width: 100%;">
                                {{trans('admin.far_learn')}}
                                <span></span><span></span><span></span><span></span> </a>
                        @endif
                    </div>
                    <div class="vertical" style="height: 50px;"></div>
                    @if($settings_share->show_mogmaa_dorr == '1')
                        <div class="col-md-6">
                            <a href="{{route('sign_up',['type'=> 'mogmaa_dorr'])}}" class="thm-btn thm-bg"
                               style="background-color: blueviolet; width: 100%;" href="" title="">
                                {{trans('s_admin.mogmaa_dorr')}}
                                <span></span><span></span><span></span><span></span></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div id="far_learn_model" class="modal model_style fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 5%!important;">
            <div class="modal-header">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{trans('s_admin.choose_far_learn_type')}}</h5>
                </div>
                <div class="col-md-3"></div>
            </div>
            <div class="modal-body">
                <div class="row">
                    @if($settings_share->show_free_subject == '1')
                        <div class="col-md-6">
                            <a href="{{route('sign_up',['type'=> 'far_learn'])}}" class="thm-btn thm-bg"
                               style="background-color: yellowgreen; width: 100%;">
                                {{trans('s_admin.free_far_learn')}}
                                <span></span><span></span><span></span><span></span> </a>
                        </div>
                        <div class="vertical" style="height: 50px;"></div>
                    @endif
                    @if($settings_share->show_fixed_subject == '1')
                        <div class="col-md-6">
                            <a href="javascript:void(0);" class="thm-btn thm-bg"
                               style="background-color: blueviolet; width: 100%; font-size: 13px;" href="" title="">
                                {{trans('s_admin.fixed_far_learn')}}
                                <span></span><span></span><span></span><span></span></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div id="teacher_model" class="modal model_style fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content" style="border-radius: 5%!important;">
            <div class="modal-header">
                <div class="col-md-4"></div>
                <div class="col-md-4">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{trans('admin.choose_type_epo')}}</h5>
                </div>
                <div class="col-md-4"></div>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <a href="{{route('sign_up',['type'=> 'teacher_far_learn'])}}" class="thm-btn thm-bg"
                           style="background-color: yellowgreen; width: 100%;">
                            {{trans('admin.far_learn')}}
                            <span></span><span></span><span></span><span></span> </a>
                    </div>
                    @if($settings_share->show_mogmaa_dorr == '1')
                        <div class="col-md-6">
                            <a href="{{route('sign_up',['type'=> 'teacher_mogmaa_dorr'])}}" class="thm-btn thm-bg"
                               style="background-color: blueviolet; width: 100%;" href="" title="">
                                {{trans('s_admin.mogmaa_dorr')}}
                                <span></span><span></span><span></span><span></span></a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
     aria-hidden="true" style="display: none;">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content"
             style="border-radius: 5%!important; width: 100%;text-align: center; background-color: darkgoldenrod;">
            <div class="modal-header">
                <div class="col-md-12">
                    <h3 class="modal-title" id="exampleModalLongTitle">{{trans('admin.login')}}</h3>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                </div>
            </div>
            {{ Form::open( ['route'  => ['login_both'],'method'=>'post' , 'class'=>'form'] ) }}
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-8" style="padding-top: 15px">
                        <div class="row">
                            <div class="col-lg-8">
                                <div class="form-group" style="padding-bottom: 5px">
                                    <input type="number"
                                           onkeyup="this.value=login_phone(this.value);"
                                           required name="phone" value="{{old('phone')}}"
                                           placeholder="{{trans('s_admin.phone')}}"
                                           class="form-control" id="recipient-name1">
                                </div>
                            </div>
                            <div class="col-lg-4">
                                <div class="form-group">
                                    <input id="txt_main_login_countrycode_code"
                                           style="max-width: 30px;"
                                           @if(old('country_code'))
                                           value="{{old('country_code')}}"
                                           @else
                                           value="+966"
                                           @endif
                                           type="text"
                                           name="country_code"
                                           class="form-control form-control-danger">
                                </div>
                            </div>
                        </div>
                        <div class="form-group ">
                            <input type="password" required name="password" placeholder="{{trans('admin.password')}}"
                                   class="form-control" id="recipient-name1">
                        </div>
                        <div class="row">
                            <div class="form-group col-6" style="text-align: right">
                                <button type="submit" class="btn btn-sm btn-success"
                                > {{trans('admin.login')}}</button>
                            </div>
                            <div class="form-group col-6" style="text-align: left;">
                                <a href="{{route('Forget-password')}}">
                                    @if(app()->getLocale() == 'ar')
                                        نسيت كلمة المرور؟
                                    @else
                                        forget Password?
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4" style="">
                        <img src="{{url('quran/assets/images/login_image.jpg')}}"
                             style="height: 120px;width: 350px;border-radius: 25%;opacity: 75%" alt="icon">
                    </div>
                </div>

            </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
