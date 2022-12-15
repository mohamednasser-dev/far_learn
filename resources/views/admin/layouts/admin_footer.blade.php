</div>
</div>
<!--end::Entry-->
</div>
<!--end::Content-->
<!--begin::Footer-->
<div class="footer bg-white py-4 d-flex flex-lg-column" id="kt_footer">
    <!--begin::Container-->
    <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
        <!--begin::Copyright-->
        <div class="text-dark order-2 order-md-1">
            <span class="text-muted font-weight-bold mr-2">2020©</span>
            <a href="https://exas2030.com/" target="_blank" class="text-dark-75 text-hover-primary">Exas2030</a>
        </div>
        <!--end::Copyright-->
    </div>
    <!--end::Container-->
</div>
<!--end::Footer-->
</div>
<!--end::Wrapper-->
</div>
<!--end::Page-->
</div>
<!--end::Main-->
<!-- begin::User Panel-->
<div id="kt_quick_user" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-5">
        <h3 class="font-weight-bold m-0">
            <a href="javascript:void(0);" class="btn btn-xs btn-icon btn-light btn-hover-primary"
               id="kt_quick_user_close">
                <i class="ki ki-close icon-xs text-muted"></i>
            </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content pr-5 mr-n5">
        <!--begin::Header-->
        <div class="d-flex align-items-center mt-5">
            <div class="symbol symbol-100 mr-5">
                <div class="symbol-label" style="background-image:url({{auth()->user()->image}})"></div>
                <i class="symbol-badge bg-success"></i>
            </div>
            <div class="d-flex flex-column">
                <a href="javascript:void(0);"
                   class="font-weight-bold font-size-h5 text-dark-75 text-hover-primary">{{auth()->user()->name}}</a>
                <div class="text-muted mt-1">{{auth()->user()->Role->name}}</div>
                <div class="navi mt-2">
                    <a href="javascript:void(0);" class="navi-item">
                        <span class="navi-link p-0 pb-2">
                            <span class="navi-icon mr-1">
                                <span class="svg-icon svg-icon-lg {{auth()->user()->icon_color}} ">
                                    <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Mails-notification.svg-->
                                    <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                                         width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                        <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                            <rect x="0" y="0" width="24" height="24"/>
                                            <path
                                                d="M21,12.0829584 C20.6747915,12.0283988 20.3407122,12 20,12 C16.6862915,12 14,14.6862915 14,18 C14,18.3407122 14.0283988,18.6747915 14.0829584,19 L5,19 C3.8954305,19 3,18.1045695 3,17 L3,8 C3,6.8954305 3.8954305,6 5,6 L19,6 C20.1045695,6 21,6.8954305 21,8 L21,12.0829584 Z M18.1444251,7.83964668 L12,11.1481833 L5.85557487,7.83964668 C5.4908718,7.6432681 5.03602525,7.77972206 4.83964668,8.14442513 C4.6432681,8.5091282 4.77972206,8.96397475 5.14442513,9.16035332 L11.6444251,12.6603533 C11.8664074,12.7798822 12.1335926,12.7798822 12.3555749,12.6603533 L18.8555749,9.16035332 C19.2202779,8.96397475 19.3567319,8.5091282 19.1603533,8.14442513 C18.9639747,7.77972206 18.5091282,7.6432681 18.1444251,7.83964668 Z"
                                                fill="#000000"/>
                                            <circle fill="#000000" opacity="0.3" cx="19.5" cy="17.5" r="2.5"/>
                                        </g>
                                    </svg>
                                    <!--end::Svg Icon-->
                                </span>
                            </span>
                            <span class="navi-text text-muted text-hover-primary">{{auth()->user()->email}}</span>
                        </span>
                    </a>
                    <a href="{{ route('admin.logout') }}"
                       class="btn btn-sm {{auth()->user()->button_color}} font-weight-bolder py-2 px-5">{{trans('admin.logout')}}</a>
                </div>
            </div>
        </div>
        <!--end::Header-->
        <!--begin::Separator-->
        <div class="separator separator-dashed mt-8 mb-5"></div>
        <!--end::Separator-->
        <!--begin::Nav-->
        <div class="navi navi-spacer-x-0 p-0">
            <!--begin::Item-->
            <a href="{{url('/profile')}}" class="navi-item">
                <div class="navi-link">
                    <div class="symbol symbol-40 bg-light mr-3">
                        <div class="symbol-label">
                                    <span class="svg-icon svg-icon-md {{auth()->user()->icon_color}}">
                                        <!--begin::Svg Icon | path:assets/media/svg/icons/General/Notification2.svg-->
                                        <svg xmlns="http://www.w3.org/2000/svg"
                                             xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px"
                                             viewBox="0 0 24 24" version="1.1">
                                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                <rect x="0" y="0" width="24" height="24"/>
                                                <path
                                                    d="M13.2070325,4 C13.0721672,4.47683179 13,4.97998812 13,5.5 C13,8.53756612 15.4624339,11 18.5,11 C19.0200119,11 19.5231682,10.9278328 20,10.7929675 L20,17 C20,18.6568542 18.6568542,20 17,20 L7,20 C5.34314575,20 4,18.6568542 4,17 L4,7 C4,5.34314575 5.34314575,4 7,4 L13.2070325,4 Z"
                                                    fill="#000000"/>
                                                <circle fill="#000000" opacity="0.3" cx="18.5" cy="5.5" r="2.5"/>
                                            </g>
                                        </svg>
                                        <!--end::Svg Icon-->
                                    </span>
                        </div>
                    </div>
                    <div class="navi-text">
                        <div class="font-weight-bold">{{trans('s_admin.profile')}}</div>
                    </div>
                </div>
            </a>
            <!--end:Item-->
        </div>
        <!--end::Nav-->
        <!--begin::Separator-->
        <div class="separator separator-dashed my-7"></div>
        <!--end::Separator-->
        <!--end::Separator-->
    </div>
    <!--end::Content-->
</div>
<!-- end::User Panel-->
<!--begin::Sticky Toolbar-->
<ul class="sticky-toolbar nav flex-column pl-2 pr-2 pt-3 pb-3 mt-4">
    <!--begin::Item-->
    <li class="nav-item mb-2" id="kt_demo_panel_toggle" data-toggle="tooltip" title="اعدادات الالوان"
        data-placement="right">
        <a class="btn btn-sm btn-icon btn-bg-light btn-icon-success {{auth()->user()->button_color}}" href="#">
            <i class="flaticon2-gear"></i>
        </a>
    </li>
    <!--end::Item-->
</ul>
<!--end::Sticky Toolbar-->

<div id="kt_demo_panel" class="offcanvas offcanvas-right p-10">
    <!--begin::Header-->
    <div class="offcanvas-header d-flex align-items-center justify-content-between pb-7">
        <h4 class="font-weight-bold m-0">{{trans('s_admin.choose_from_colors')}}</h4>
        <a href="#" class="btn btn-xs btn-icon btn-light btn-hover-primary" id="kt_demo_panel_close">
            <i class="ki ki-close icon-xs text-muted"></i>
        </a>
    </div>
    <!--end::Header-->
    <!--begin::Content-->
    <div class="offcanvas-content">
        <!--begin::Wrapper-->
        <form method="post" action="{{route('admin.change_colors')}}">
            @csrf
            <div class="offcanvas-wrapper mb-5 scroll-pull">
                <div class="form-group">
                    <label class="col-12 col-form-label">{{trans('s_admin.main_color')}}</label>
                    <div class="col-12">
                        {{--                        coloradmin--}}
                        <input class="form-control" type="color" name="main_color"
                               value="{{auth()->user()->main_color}}" id="example-color-input"/>
                    </div>
                </div>
                <hr>
                <div class="form-group">
                    <label class="col-12 col-form-label">{{trans('s_admin.second_color')}}</label>
                    <div class="col-12">

                        <input class="form-control" type="color" name="second_color"
                               value="{{auth()->user()->second_color}}" id="example-color-input"/>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-12 col-form-label">{{trans('s_admin.button_color')}}</label>
                    <div class="col-12 col-form-label">
                        <div class="radio-inline">
                            <label class="radio  radio-danger">
                                <input type="radio" name="button_color"
                                       @if(auth()->user()->button_color == 'btn-danger' ) checked="checked"
                                       @endif value="btn-danger">
                                <span></span>{{trans('s_admin.danger_color')}}</label>
                            <label class="radio radio-success">
                                <input type="radio" name="button_color"
                                       @if(auth()->user()->button_color == 'btn-success' ) checked="checked"
                                       @endif  value="btn-success">
                                <span></span>{{trans('s_admin.success_color')}}</label>
                            <label class="radio radio-primary">
                                <input type="radio" name="button_color"
                                       @if(auth()->user()->button_color == 'btn-primary' ) checked="checked"
                                       @endif  value="btn-primary">
                                <span></span>{{trans('s_admin.primary_color')}}</label>
                            <label class="radio radio-warning">
                                <input type="radio" name="button_color"
                                       @if(auth()->user()->button_color == 'btn-warning' ) checked="checked"
                                       @endif  value="btn-warning">
                                <span></span>{{trans('s_admin.warning_color')}}</label>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="form-group row">
                    <label class="col-12 col-form-label">{{trans('s_admin.icon_color')}}</label>
                    <div class="col-12 col-form-label">
                        <div class="radio-inline">
                            <label class="radio  radio-danger">
                                <input type="radio" name="icon_color" value="svg-icon-danger"
                                       @if(auth()->user()->icon_color == 'svg-icon-danger' ) checked="checked"
                                    @endif >
                                <span></span>{{trans('s_admin.danger_color')}}</label>
                            <label class="radio radio-success">
                                <input type="radio" name="icon_color" value="svg-icon-success"
                                       @if(auth()->user()->icon_color == 'svg-icon-success' ) checked="checked" @endif>
                                <span></span>{{trans('s_admin.success_color')}}</label>
                            <label class="radio radio-primary">
                                <input type="radio" name="icon_color" value="svg-icon-primary"
                                       @if(auth()->user()->icon_color == 'svg-icon-primary' ) checked="checked" @endif>
                                <span></span>{{trans('s_admin.primary_color')}}</label>
                            <label class="radio radio-warning">
                                <input type="radio" name="icon_color" value="svg-icon-warning"
                                       @if(auth()->user()->icon_color == 'svg-icon-warning' ) checked="checked" @endif>
                                <span></span>{{trans('s_admin.warning_color')}}</label>
                        </div>
                    </div>
                </div>
                <hr>
            </div>
            <!--end::Wrapper-->
            <!--begin::Purchase-->
            <div class="offcanvas-footer row">
                <div class="col-md-9">
                    <button type="submit"
                            class="btn btn-block {{auth()->user()->button_color}} btn-shadow font-weight-bolder text-uppercase">{{trans('s_admin.save')}}</button>
                </div>
                <div class="col-md-3">
                    <a class="btn btn-secondary center"
                       href="{{route('admin.change_colors.reset')}}">{{trans('s_admin.reset')}}</a>
                </div>
            </div>
        </form>
        <!--end::Purchase-->
    </div>
    <!--end::Content-->
</div>
<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<!--begin::Global Config(global config for global JS scripts)-->
<script>var KTAppSettings = {
        "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };</script>
<!--end::Global Config-->
<!--begin::Global Theme Bundle(used by all pages)-->
<script src="{{ asset('metronic/assets/plugins/global/plugins.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/plugins/custom/prismjs/prismjs.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/js/scripts.bundle.js') }}"></script>
<script src="{{ asset('metronic/assets/js/pages/crud/forms/widgets/bootstrap-timepicker.js') }}"></script>

{{-----------------------------------------------------------------------------------}}
{{-----------------------------------------------------------------------------------}}
<script>var HOST_URL = "https://preview.keenthemes.com/metronic/theme/html/tools/preview";</script>
<script>var KTAppSettings = {
        "breakpoints": {"sm": 576, "md": 768, "lg": 992, "xl": 1200, "xxl": 1400},
        "colors": {
            "theme": {
                "base": {
                    "white": "#ffffff",
                    "primary": "#3699FF",
                    "secondary": "#E5EAEE",
                    "success": "#1BC5BD",
                    "info": "#8950FC",
                    "warning": "#FFA800",
                    "danger": "#F64E60",
                    "light": "#E4E6EF",
                    "dark": "#181C32"
                },
                "light": {
                    "white": "#ffffff",
                    "primary": "#E1F0FF",
                    "secondary": "#EBEDF3",
                    "success": "#C9F7F5",
                    "info": "#EEE5FF",
                    "warning": "#FFF4DE",
                    "danger": "#FFE2E5",
                    "light": "#F3F6F9",
                    "dark": "#D6D6E0"
                },
                "inverse": {
                    "white": "#ffffff",
                    "primary": "#ffffff",
                    "secondary": "#3F4254",
                    "success": "#ffffff",
                    "info": "#ffffff",
                    "warning": "#ffffff",
                    "danger": "#ffffff",
                    "light": "#464E5F",
                    "dark": "#ffffff"
                }
            },
            "gray": {
                "gray-100": "#F3F6F9",
                "gray-200": "#EBEDF3",
                "gray-300": "#E4E6EF",
                "gray-400": "#D1D3E0",
                "gray-500": "#B5B5C3",
                "gray-600": "#7E8299",
                "gray-700": "#5E6278",
                "gray-800": "#3F4254",
                "gray-900": "#181C32"
            }
        },
        "font-family": "Poppins"
    };
</script>
<script src="{{asset('metronic/assets/js/buttons.html5.min.js')}}"></script>
<script src="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
<script src="{{asset('metronic/assets/js/pages/crud/datatables/data-sources/html.js')}}"></script>
<script>
    // basic
    $('#kt_select2_1').select2({});
    $('#kt_select2_2').select2({});
    $('#kt_select2_3').select2({});
    $('#kt_select2_4').select2({});
    $('#kt_select2_5').select2({});
    $('#kt_select2_6').select2({});
    $('#kt_select2_7').select2({});
    $('#kt_select2_8').select2({});
    $('#kt_select2_66').select2({});
</script>
<script src="{{ asset('metronic/assets/js/pages/crud/forms/widgets/select2.js')}}"></script>
<script src="{{ asset('metronic/assets/js/pages/features/miscellaneous/toastr.js')}}"></script>
<script src="{{ asset('metronic/assets/js/pages/crud/forms/widgets/bootstrap-datepicker.js')}}"></script>
<script src="{{ asset('metronic/assets/js/pages/features/miscellaneous/dual-listbox.js')}}"></script>

{{------------------------------------------------ for student edit page ------------------------------------------------}}

{{------------------------------------------------ for student edit page ------------------------------------------------}}
@include('sweetalert::alert')
@yield('scripts')
<!--end::Page Scripts-->
</body>
<!--end::Body-->
</html>
