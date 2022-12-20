<body>
<!-- start page-wrapper -->
<div class="page-wrapper">
    <!-- start preloader -->
    <div class="preloader">
        <div class="sk-folding-cube">
            <div class="sk-cube1 sk-cube"></div>
            <div class="sk-cube2 sk-cube"></div>
            <div class="sk-cube4 sk-cube"></div>
            <div class="sk-cube3 sk-cube"></div>
        </div>
    </div>
    <!-- end preloader -->
    <header id="header" class="wpo-site-header wpo-header-style-2">
        <div class="topbar">
            <div class="container">
                <div class="row">
                    <div class="col col-md-6 col-sm-7 col-12">
                        <div class="contact-intro">
                            <ul>
                                <li><i class="fi ti-location-pin"></i>{{$settings_share->address}}</li>
                                <li><i class="fi flaticon-envelope"></i> {{$settings_share->email}}</li>
                            </ul>
                        </div>
                    </div>
                    <div class="col col-md-6 col-sm-5 col-12">
                        <div class="contact-info">
                            <ul>
                                @if($settings_share->twiter != null)
                                    <li><a href="{{$settings_share->twiter}}"><i class="ti-twitter-alt"></i></a></li>
                                @endif
                                @if( $settings_share->facebook != null)
                                    <li><a href="{{$settings_share->facebook}}"><i class="ti-facebook"></i></a></li>
                                @endif
                                @if($settings_share->youtube  != null)
                                    <li><a href="{{$settings_share->youtube}}"><i class="ti-youtube"></i></a></li>
                                @endif
                                @if($settings_share->linked_in  != null)
                                    <li><a href="{{$settings_share->linked_in}}"><i class="ti-linkedin"></i></a></li>
                                @endif
                                @if($settings_share->insta  != null)
                                    <li><a href="{{$settings_share->insta}}"><i class="ti-instagram"></i></a></li>
                                @endif
                                <li>
                                    @if(app()->getLocale() == 'en')
                                        <a title="{{trans('admin.change_lang')}}" class="theme-btn-s2 lang-btn" href="{{url('lang/ar')}}"> العربية </a>
                                    @else
                                        <a title="{{trans('admin.change_lang')}}" class="theme-btn-s2 lang-btn" href="{{url('lang/en')}}"> الانجليزية </a>
                                    @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end topbar -->
        <div class="site-header header-style-1">
            <nav class="navigation navbar navbar-default original">
                <div class="container">
                    <div class="cart-search-contact-new">
                        @if( auth()->guard('web')->check())
                        <a href="{{route('home')}}" class="theme-btn">{{trans('s_admin.control_panel')}}</a>
                        <a href="{{ route('admin.logout') }}" id="login_btn" class="theme-btn"><i class="fi flaticon2-user"></i> {{trans('admin.logout')}}</a>
                        @elseif( auth()->guard('teacher')->check() )
                            <a href="{{route('teacher.home')}}" class="theme-btn">{{trans('s_admin.control_panel')}}</a>
                            <a href="{{ route('teacher_logout') }}" id="login_btn" class="theme-btn"><i class="fi flaticon2-user"></i> {{trans('admin.logout')}}</a>
                        @elseif( auth()->guard('student')->check() )
                            <a href="{{route('student_home')}}" class="theme-btn">{{trans('s_admin.control_panel')}}</a>
                            <a href="{{ route('student_logout') }}" id="login_btn" class="theme-btn"><i class="fi flaticon2-user"></i> {{trans('admin.logout')}}</a>
                        @else
                        <a data-dismiss="modal" data-toggle="modal" id="sign_up_btn"
                        data-target="#sign-modal" href="" title="" class="theme-btn">{{trans('admin.sign_up')}}</a>
                        <a href="javascript:void($this);" data-toggle="modal" data-dismiss="modal" data-target="#login-modal" id="login_btn" class="theme-btn"><i class="fi flaticon2-user"></i> {{trans('admin.login')}}</a>
                        @endif
                    </div>
                    <div class="navbar-header">
                        {{-- <button type="button" class="open-btn" style="display: none">
                            <span class="sr-only">Toggle navigation</span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                            <span class="icon-bar"></span>
                        </button> --}}
                        <a class="navbar-brand" href="{{route('main_page')}}"><img src="{{$settings_share->logo}}" alt=""></a>
                    </div>
                    {{-- <div id="navbar" class="navbar-collapse collapse navigation-holder">
                        <button class="close-navbar"><i class="ti-close"></i></button>
                        <ul class="nav navbar-nav">
                        </ul>
                    </div> --}}
                    <!-- end of nav-collapse -->
                    {{-- <div class="cart-search-contact cart-search-contact-new">
                        @if( auth()->guard('web')->check())
                            <div class="header-search-form-wrapper">
                                <div class="btns">
                                    <a href="{{route('home')}}" class="theme-btn">{{trans('s_admin.control_panel')}}</a>
                                </div>
                            </div>
                            <div class="mini-cart">
                                <div class="btns">
                                    <a href="{{ route('admin.logout') }}" id="login_btn" class="theme-btn"><i class="fi flaticon2-user"></i> {{trans('admin.logout')}}</a>
                                </div>
                            </div>
                        @elseif( auth()->guard('teacher')->check() )
                            <div class="header-search-form-wrapper">
                                <div class="btns">
                                    <a href="{{route('teacher.home')}}" class="theme-btn">{{trans('s_admin.control_panel')}}</a>
                                </div>
                            </div>
                            <div class="mini-cart">
                                <div class="btns">
                                    <a href="{{ route('teacher_logout') }}" id="login_btn" class="theme-btn"><i class="fi flaticon2-user"></i> {{trans('admin.logout')}}</a>
                                </div>
                            </div>
                        @elseif( auth()->guard('student')->check() )
                            <div class="header-search-form-wrapper">
                                <div class="btns">
                                    <a href="{{route('student_home')}}" class="theme-btn">{{trans('s_admin.control_panel')}}</a>
                                </div>
                            </div>
                            <div class="mini-cart">
                                <div class="btns">
                                    <a href="{{ route('student_logout') }}" id="login_btn" class="theme-btn"><i class="fi flaticon2-user"></i> {{trans('admin.logout')}}</a>
                                </div>
                            </div>
                        @else
                            <div class="header-search-form-wrapper">
                                <div class="btns">
                                    <a data-dismiss="modal" data-toggle="modal" id="sign_up_btn"
                                       data-target="#sign-modal" href="" title="" class="theme-btn">{{trans('admin.sign_up')}}</a>
                                </div>
                            </div>
                            <div class="mini-cart">
                                <div class="btns">
                                    <a href="javascript:void($this);" data-toggle="modal" data-dismiss="modal" data-target="#login-modal" id="login_btn" class="theme-btn"><i class="fi flaticon2-user"></i> {{trans('admin.login')}}</a>
                                </div>
                            </div>
                        @endif
                    </div> --}}

                </div>
                <!-- end of container -->
            </nav>
        </div>
    </header>
    <!-- start of hero -->


