<!-- footer-area start -->
<div class="wpo-ne-footer">
    <!-- start wpo-news-letter-section -->
    @yield('footer_follow')
    <!-- end wpo-news-letter-section -->
    <!-- start wpo-site-footer -->
    <footer class="wpo-site-footer">
        <div class="wpo-upper-footer">
            <div class="container">
                <div class="row">
                    <div class="col col-lg-3 col-md-3 col-sm-6">
                        <div class="widget about-widget">
                            <div class="logo widget-title">
                                <img src="{{ $settings_share->logo }}" alt="blog">
                            </div>
                            <p></p>
                            <ul>
                                @if ($settings_share->twiter != null)
                                    <li><a href="{{ $settings_share->twiter }}"><i class="ti-twitter-alt"></i></a></li>
                                @endif
                                @if ($settings_share->facebook != null)
                                    <li><a href="{{ $settings_share->facebook }}"><i class="ti-facebook"></i></a></li>
                                @endif
                                @if ($settings_share->youtube != null)
                                    <li><a href="{{ $settings_share->youtube }}"><i class="ti-youtube"></i></a></li>
                                @endif
                                @if ($settings_share->linked_in != null)
                                    <li><a href="{{ $settings_share->linked_in }}"><i class="ti-linkedin-in"></i></a>
                                    </li>
                                @endif
                                @if ($settings_share->insta != null)
                                    <li><a href="{{ $settings_share->insta }}"><i class="ti-instagram"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col col-lg-4 col-md-3 col-sm-6">
                        <div class="widget link-widget">
                            <div class="widget-title">
                                <h3>{{ trans('admin.useful_links') }}</h3>
                            </div>
                            <ul>
                                <li><a href="{{ route('terms') }}">{{ trans('admin.terms') }}</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col col-lg-3 col-lg-offset-1 col-md-3 col-sm-6">
                        <div class="widget market-widget wpo-service-link-widget">
                            <div class="widget-title">
                                <h3>{{ trans('admin.web_data') }} </h3>
                            </div>
                            <p></p>
                            <div class="contact-ft">
                                <ul>
                                    <li><i class="fi ti-location-pin"></i>{{ $settings_share->address }}</li>
                                    <li>{{ $settings_share->phone }}<i class="fi flaticon-call"></i></li>
                                    <li>{{ $settings_share->email }}<i class="fi flaticon-envelope"></i></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div> <!-- end container -->
        </div>
        <div class="wpo-lower-footer">
            <div class="container">
                <div class="row">
                    <div class="col col-xs-12">
                        <p class="copyright">&copy; URAM. {{ trans('admin.all_reserve') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end wpo-site-footer -->
</div>
</div>
<div class="payment-section">
    <div id="sign-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered" >
            <div class="modal-content" style="border-radius: 15px!important; width: 100% ; overflow: hidden">
                <div class="modal-header">
                    <div class="col-md-12" style="text-align: center;">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ trans('admin.make_new_account') }}</h5>
                    </div>
                </div>
                <div class="modal-body w-100">
                    <div class="row d-flex">
                        <div class="col-md-6">
                            {{--                            href="{{route('sign_up',['type'=> 'teacher'])}}" --}}
                            @if ($settings_share->show_mogmaa_dorr == '1')
                                <a href="javascript:void(0);" class="model_style" data-toggle="modal"
                                    data-target="#teacher_model" data-dismiss="modal">
                                    <div class="text-center">
                                        <div>
                                            <img src="{{ url('/') }}/quran/assets/images/teacherPhotoSignUp.png">
                                        </div>
                                    </div>
                                    <h4 style="font-size: 18px;padding-top: 5px;text-align: center;" class="center">
                                        {{ trans('admin.teacher_h') }}</h4>
                                </a>
                            @else
                                <a href="{{ route('sign_up', ['type' => 'teacher_far_learn']) }}" class="model_style">
                                    <div class="text-center">
                                        <div>
                                            <img src="{{ url('/') }}/quran/assets/images/teacherPhotoSignUp.png">
                                        </div>
                                    </div>
                                    <h4 style="font-size: 18px;padding-top: 5px;text-align: center;" class="center">
                                        {{ trans('admin.teacher_h') }}</h4>
                                </a>
                            @endif
                        </div>
                        <div class="col-md-6">
                            <div class="row>">
                                <div class="col-md-12">
                                    @if ($settings_share->show_mogmaa_dorr == '0' &&
                                        $settings_share->show_fixed_subject == '0' &&
                                        $settings_share->show_free_subject == '1')
                                        <a id="btn_link" href="{{ route('sign_up', ['type' => 'far_learn']) }}"
                                            class="model_style">
                                            <div class="text-center">
                                                <img
                                                    src="{{ url('/') }}/quran/assets/images/studentPhotoSignUp.png">
                                            </div>
                                            <h4 style="font-size: 18px;padding-top: 5px;text-align: center;"
                                                class="center">{{ trans('admin.student_h') }}</h4>
                                        </a>
                                    @else
                                        <a id="btn_link" href="javascript:void(0);" class="model_style"
                                            data-toggle="modal" data-target="#stud_model" data-dismiss="modal">
                                            <div class="text-center">
                                                <img
                                                    src="{{ url('/') }}/quran/assets/images/studentPhotoSignUp.png">
                                            </div>
                                            <h4 style="font-size: 18px;padding-top: 5px;text-align: center;"
                                                class="center">{{ trans('admin.student_h') }}</h4>
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
    <div id="stud_model" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 5%!important;">
                <div class="modal-header">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ trans('admin.choose_type_epo') }}</h5>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-md-6">
                            @if ($settings_share->show_fixed_subject == '0')
                                <a href="{{ route('sign_up', ['type' => 'far_learn']) }}" class="theme-btn"
                                    style="background-color: yellowgreen; width: 100%;">
                                    {{ trans('admin.far_learn') }}</a>
                            @else
                                <a href="javascript:void(0);" data-toggle="modal" data-target="#far_learn_model"
                                    data-dismiss="modal" class="theme-btn"
                                    style="background-color: yellowgreen; width: 100%;">
                                    {{ trans('admin.far_learn') }}
                                </a>
                            @endif
                        </div>
                        <div class="vertical" style="height: 50px;"></div>
                        @if ($settings_share->show_mogmaa_dorr == '1')
                            <div class="col-md-6">
                                <a href="{{ route('sign_up', ['type' => 'mogmaa_dorr']) }}" class="theme-btn"
                                    style="background-color: blueviolet; width: 100%;" href="" title="">
                                    {{ trans('s_admin.mogmaa_dorr') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="far_learn_model" class="modal model_style fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 5%!important;">
                <div class="modal-header">
                    <div class="col-md-3"></div>
                    <div class="col-md-6">
                        <h5 class="modal-title" id="exampleModalLongTitle">
                            {{ trans('s_admin.choose_far_learn_type') }}</h5>
                    </div>
                    <div class="col-md-3"></div>
                </div>
                <div class="modal-body">
                    <div class="row">
                        @if ($settings_share->show_free_subject == '1')
                            <div class="col-md-6">
                                <a href="{{ route('sign_up', ['type' => 'far_learn']) }}" class="theme-btn"
                                    style="background-color: yellowgreen; width: 100%;">
                                    {{ trans('s_admin.free_far_learn') }}
                                </a>
                            </div>
                            <div class="vertical" style="height: 50px;"></div>
                        @endif
                        @if ($settings_share->show_fixed_subject == '1')
                            <div class="col-md-6">
                                <a href="javascript:void(0);" class="theme-btn"
                                    style="background-color: blueviolet; width: 100%; font-size: 13px;" href=""
                                    title="">
                                    {{ trans('s_admin.fixed_far_learn') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="teacher_model" class="modal model_style fade" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel" aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 5%!important;">
                <div class="modal-header">
                    <div class="col-md-4"></div>
                    <div class="col-md-4">
                        <h5 class="modal-title" id="exampleModalLongTitle">{{ trans('admin.choose_type_epo') }}</h5>
                    </div>
                    <div class="col-md-4"></div>
                </div>
                <div class="modal-body">
                    <div class="row text-center">
                        <div class="col-md-6">
                            <a href="{{ route('sign_up', ['type' => 'teacher_far_learn']) }}" class="theme-btn"
                                style="background-color: yellowgreen; width: 100%;">
                                {{ trans('admin.far_learn') }}
                            </a>
                        </div>
                        @if ($settings_share->show_mogmaa_dorr == '1')
                            <div class="col-md-6">
                                <a href="{{ route('sign_up', ['type' => 'teacher_mogmaa_dorr']) }}" class="theme-btn"
                                    style="background-color: blueviolet; width: 100%;" href="" title="">
                                    {{ trans('s_admin.mogmaa_dorr') }}
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="login-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
        aria-hidden="true" style="text-align: center ;display: none">
        <div class="modal-dialog modal-dialog-centered"
            >
            <div class="modal-content" style="border-radius: 15px!important; width: 100% ; overflow: hidden">
                <div class="modal-header">
                    <div class="col-md-12">
                        <h3 class="modal-title" id="exampleModalLongTitle">{{ trans('admin.login') }}</h3>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"></button>
                    </div>
                </div>
                {{ Form::open(['route' => ['login_both'], 'method' => 'post', 'class' => 'form']) }}
                <div class="modal-body">
                    <div class="row">
                        <div class="col-lg-12" style="padding-top: 15px">
                            <div class="row" style="width: 100%; display: flex; padding: 0; margin: 0;">
                                <div class="col-3">
                                    <div class="form-group">
                                        <input id="txt_main_login_countrycode_code" style="max-width: 30px;"
                                            @if (old('country_code')) value="{{ old('country_code') }}"
                                           @else
                                           value="+966" @endif
                                            type="text" name="country_code"
                                            class="form-control form-control-danger">
                                    </div>
                                </div>
                                <div class="col-9" style="flex-grow: 1">
                                    <div class="form-group" style="padding-bottom: 5px">
                                        <input type="number" onkeyup="this.value=login_phone(this.value);" required
                                            name="phone" value="{{ old('phone') }}"
                                            placeholder="{{ trans('s_admin.phone') }}" class="form-control "
                                            id="recipient-name1">
                                    </div>
                                </div>

                            </div>
                            <div class="form-group ">
                                <input type="password" required name="password"
                                    placeholder="{{ trans('admin.password') }}" class="form-control"
                                    id="recipient-name1">
                            </div>
                            <div class="row">
                                <a href="{{ route('Forget-password') }}">
                                    {{ trans('admin.forgot_Pass') }}
                                </a>
                                <div class="form-group col-12" style="text-align: right">
                                    <button type="submit" class="btn btn-sm btn-success">
                                        {{ trans('admin.login') }}</button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
</div>
@yield('modals')
<!-- end of page-wrapper -->
<!-- All JavaScript files
================================================== -->
@if (app()->getLocale() == 'ar')
    <script src="{{ url('/') }}/ummah-rtl/assets/js/jquery.min.js"></script>
    <script src="{{ url('/') }}/ummah-rtl/assets/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/ummah-rtl/assets/js/circle-progress.min.js"></script>
    <!-- Plugins for this template -->
    <script src="{{ url('/') }}/ummah-rtl/assets/js/jquery-plugin-collection.js"></script>
    <!-- Custom script for this template -->
    <script src="{{ url('/') }}/ummah-rtl/assets/js/script.js"></script>
@else
    <script src="{{ url('/') }}/ummah_ltr/assets/js/jquery.min.js"></script>
    <script src="{{ url('/') }}/ummah_ltr/assets/js/bootstrap.min.js"></script>
    <script src="{{ url('/') }}/ummah_ltr/assets/js/circle-progress.min.js"></script>
    <!-- Plugins for this template -->
    <script src="{{ url('/') }}/ummah_ltr/assets/js/jquery-plugin-collection.js"></script>
    <!-- Custom script for this template -->
    <script src="{{ url('/') }}/ummah_ltr/assets/js/script.js"></script>
@endif

<script src="{{ url('/') }}/metronic/assets/js/pages/features/miscellaneous/sweetalert2.js"></script>
<script src="{{ asset('metronic/assets/js/pages/features/miscellaneous/toastr.js') }}"></script>
<script>
    $('#sign_up_btn').click(function() {
        $('#login-modal').modal('hide');
        $('#stud_model').modal('hide');
        $('#far_learn_model').modal('hide');
        $('#teacher_model').modal('hide');
    });
    $('#login_btn').click(function() {
        $('#sign-modal').modal('hide');
        $('#stud_model').modal('hide');
        $('#far_learn_model').modal('hide');
        $('#teacher_model').modal('hide');
    });
</script>
<script type="text/javascript"
    src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
<script type="text/javascript">
    $(function() {
        var code = "+966"; // Assigning value from model.
        $('#txt_login_countrycode_code').val(code);
        $('#txt_login_countrycode_code').intlTelInput({
            autoHideDialCode: true,
            autoPlaceholder: "ON",
            dropdownContainer: document.body,
            formatOnDisplay: true,
            hiddenInput: "full_number",
            initialCountry: "auto",
            nationalMode: true,
            placeholderNumberType: "MOBILE",
            preferredCountries: ['US'],
            separateDialCode: false
        });
        // console.log(code)
        // $("#txt_unique_name").keyup(function (event) {
        //     var txt_unique_name = $("#txt_unique_name").val('');
        //     txt_unique_name.replace(/\s/g, "") ;
        // });
    });
    $(function() {
        var code = "+966"; // Assigning value from model.
        $('#txt_main_login_countrycode_code').val(code);
        $('#txt_main_login_countrycode_code').intlTelInput({
            autoHideDialCode: true,
            autoPlaceholder: "ON",
            dropdownContainer: document.body,
            formatOnDisplay: true,
            hiddenInput: "full_number",
            initialCountry: "auto",
            nationalMode: true,
            placeholderNumberType: "MOBILE",
            preferredCountries: ['US'],
            separateDialCode: false
        });
        // console.log(code)
        // $("#txt_unique_name").keyup(function (event) {
        //     var txt_unique_name = $("#txt_unique_name").val('');
        //     txt_unique_name.replace(/\s/g, "") ;
        // });
    });

    function login_phone(string) {
        var first_string = string.substring(0);
        var int_string = parseInt(first_string);
        if (int_string == '0') {
            $("#phone").val('');
            return false;
        } else {
            return string;
        }
    }
</script>
@include('sweetalert::alert')
@yield('scripts')
</body>

</html>
