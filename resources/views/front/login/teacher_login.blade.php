@extends('front.layouts.app')

@section('content')
    <!-- .wpo-breadcumb-area start -->
    <div class="wpo-breadcumb-area">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="wpo-breadcumb-wrap">
                        <h2>{{trans('admin.sign_up')}}</h2>
                        <ul>
                            <li><a href="{{route('main_page')}}">{{trans('admin.home')}}</a></li>
                            <li><span>{{trans('admin.sign_up')}}</span></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- .wpo-breadcumb-area end -->
    <!-- payment-section start-->
    <div class="payment-section section-padding">
        <div class="container">
            <div class="row" style="text-align-last: center;">
                <div class="col-md-3"></div>
                <div class="col-md-6">
                    <div class="wpo-donations-form">
                        <div class="row">
                            <input type="hidden" required name="type" id="txt_type" value="{{$types}}">
                            <input type="hidden" required name="_token" id="csrf"
                                   value="{{Session::token()}}">
                            {{ Form::open( ['route'  => ['store.new',$types],'method'=>'post' ,'files'=>true] ) }}
                            <input type="hidden" name="episode_id" value="{{$episode_id}}">
                            <input type="hidden" name="e_c" id="txt_e_c" value="false">
                            <input type="hidden" name="p_c" id="txt_p_c" value="false">
                            <input type="hidden" name="pa_c" id="txt_pa_c" value="true">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-group">
                                <label>{{trans('admin.full_name')}}</label>
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12 form-group">
                                <input type="email" class="form-control" name="last_name_ar" id="email" value="{{old('last_name_ar')}}"
                                       placeholder="{{trans('admin.last_name')}}">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12 form-group">
                                <input type="text" class="form-control" name="mid_name_ar" id="fname" value="{{old('mid_name_ar')}}"
                                       placeholder="{{trans('admin.mid_name')}}">
                            </div>
                            <div class="col-lg-4 col-md-4 col-sm-4 col-12 form-group">
                                <input type="text" class="form-control" name="first_name_ar" id="fname" value="{{old('first_name_ar')}}"
                                       placeholder="{{trans('admin.first_name')}}">
                            </div>

                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-group">
                                <label>{{trans('admin.gender')}} <span style="color: red;">*</span> </label>
                                @if($types == 'teacher_far_learn' || $types == 'teacher_mogmaa_dorr')
                                    <select id="txt_gender" name="gender" required
                                            class="form-control">
                                        <option value="male"
                                                @if(old('gender') == 'male') selected @endif >{{trans('admin.male')}}</option>
                                        <option value="female"
                                                @if(old('gender') == 'female' ) selected @endif >{{trans('admin.female')}}</option>
                                    </select>
                                @else
                                    <input type="hidden" name="gender" value="{{$episode->gender}}">
                                    <select id="txt_gender" disabled name="gender" required
                                            class="form-control custom-select">
                                        <option value="male"
                                                @if(old('gender') == 'male' || $episode->gender == 'male' || $episode->gender == 'children') selected @endif >{{trans('admin.male')}}</option>
                                        <option value="female"
                                                @if(old('gender') == 'female' || $episode->gender == 'female' ) selected @endif >{{trans('admin.female')}}</option>
                                    </select>
                                @endif
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-12 form-group">
                                <label class="control-label">{{trans('admin.main_lang')}} <span style="color: red;">*</span> </label>

                                <select id="txt_lang" class="form-control custom-select" required
                                        name="main_lang">
                                    <option value="ar" @if(old('main_lang') == 'ar' ) selected @endif >
                                        العربية
                                    </option>
                                    <option value="en" @if(old('main_lang') == 'en' ) selected @endif >
                                        English
                                    </option>
                                </select>
                            </div>
                            <div class="col-lg-9 col-md-9 col-sm-9 col-9 form-group">
                                <label class="control-label">{{trans('admin.email')}} <span style="color: red;">*</span> </label>
                                <input id="txt_email" type="email" name="email"
                                       value="{{old('email')}}" class="form-control" placeholder="{{trans('admin.email')}}">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3 form-group">
                                <label class="control-label">  </label>
                                <br>
                                <br>
                                <a href="javascript:void(this);" id="btn_send_email_code_check"
                                   class="btn btn-info">{{trans('s_admin.check')}}</a>
                                <a href="javascript:void(this);" style="display: none;"
                                   id="checked_email_label_s"
                                   class="btn btn-secondary">{{trans('s_admin.check')}}
                                    <i class="fa fa-check"></i>
                                </a>
                            </div>

                            <div class="col-lg-9 col-md-9 col-sm-9 col-9 form-group">
                                <label class="control-label">{{trans('admin.email')}} <span style="color: red;">*</span> </label>
                                <input id="txt_email" type="email" name="email"
                                       value="{{old('email')}}" class="form-control" placeholder="{{trans('admin.email')}}">
                            </div>
                            <div class="col-lg-3 col-md-3 col-sm-3 col-3 form-group">
                                <label class="control-label">  </label>
                                <br>
                                <br>
                                <a href="javascript:void(this);" id="btn_send_email_code_check"
                                   class="btn btn-info">{{trans('s_admin.check')}}</a>
                                <a href="javascript:void(this);" style="display: none;"
                                   id="checked_email_label_s"
                                   class="btn btn-secondary">{{trans('s_admin.check')}}
                                    <i class="fa fa-check"></i>
                                </a>
                            </div>

                            <div class="col-lg-12 col-12 form-group">
                                <button class="theme-btn" type="submit">تبرع الآن</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-3"></div>
            </div>
        </div>
    </div>
    <!-- payment-section end-->

    <div id="check_model" class="modal model_style fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 5%!important;">
                <div class="modal-header" style="align-self: center;">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{trans('s_admin.check_phone')}}</h5>
                </div>
                <div class="modal-body">
                    <h6>{{trans('s_admin.sms_message_reached_you')}}</h6>
                    <div class="form-group">
                        <input id="txt_checked_code" type="number" required style="text-align: center;"
                               placeholder="{{trans('s_admin.write_y_code')}}"
                               name="checked_code" value="{{old('checked_code')}}"
                               class="form-control form-control-danger">
                    </div>
                    <span style="color: black;">{{trans('s_admin.if_code_not_send')}}</span>
                    <a style="color: blue;" href="javascript:void(this);"
                       id="btn_resend">{{trans('s_admin.resend_code')}}</a>
                    <a id="checked_label" style="display: none;"><i style="font-size:20px; color: green;"
                                                                    class="fa fa-check"></i></a>

                </div>
                <div class="modal-footer" style="align-self: center;">
                    <a class="btn btn-success" href="javascript:void(this);"
                       id="btn_check">{{trans('s_admin.check')}}</a>
                    <a id="phone_wrong_label" style="display: none;" href="javascript:void(this);"
                    ><i  style="font-size:30px; color: red;" class="fa fa-times"></i></a>
                </div>
            </div>
        </div>
    </div>
    <div id="check_parent_model" class="modal model_style fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 5%!important;">
                <div class="modal-header" style="align-self: center;">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{trans('s_admin.check_phone')}}</h5>
                </div>
                <div class="modal-body">
                    <h6>{{trans('s_admin.sms_message_reached_you')}}</h6>
                    <div class="form-group">
                        <input id="txt_checked_parent_code" type="number" required style="text-align: center;"
                               placeholder="{{trans('s_admin.write_y_code')}}"
                               name="checked_parent_code" value="{{old('checked_parent_code')}}"
                               class="form-control form-control-danger">
                    </div>
                    <span style="color: black;">{{trans('s_admin.if_code_not_send')}}</span>
                    <a style="color: blue;" href="javascript:void(this);"
                       id="btn_parent_resend">{{trans('s_admin.resend_code')}}</a>
                    <a id="checked_parent_label" style="display: none;"><i style="font-size:20px; color: green;"
                                                                           class="fa fa-check"></i></a>

                </div>
                <div class="modal-footer" style="align-self: center;">
                    <a class="btn btn-success" href="javascript:void(this);"
                       id="btn_parent_check">{{trans('s_admin.check')}}</a>
                    <a id="parent_wrong_label" style="display: none;" href="javascript:void(this);"
                    ><i  style="font-size:30px; color: red;" class="fa fa-times"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div id="check_email_model" class="modal model_style fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 5%!important;">
                <div class="modal-header" style="align-self: center;">
                    <h5 class="modal-title" id="exampleModalLongTitle">{{trans('s_admin.check_email')}}</h5>
                </div>
                <div class="modal-body">
                    <h6>{{trans('s_admin.email_message_reached_you')}}</h6>
                    <div class="form-group">
                        <input id="txt_checked_email_code" type="number" required style="text-align: center;"
                               placeholder="{{trans('s_admin.write_y_code')}}"
                               name="checked_email_code" value="{{old('checked_email_code')}}"
                               class="form-control form-control-danger">
                    </div>
                    <span style="color: black;">{{trans('s_admin.if_code_not_send')}}</span>
                    <a style="color: blue;" href="javascript:void(this);"
                       id="btn_email_resend">{{trans('s_admin.resend_code')}}</a>
                    <a id="checked_email_label" style="display: none;"><i style="font-size:20px; color: green;"
                                                                          class="fa fa-check"></i></a>

                </div>
                <div class="modal-footer" style="align-self: center;">
                    <a class="btn btn-success" href="javascript:void(this);"
                       id="btn_email_check">{{trans('s_admin.check')}}</a>
                    <a id="email_wrong_label" style="display: none;" href="javascript:void(this);"
                    ><i  style="font-size:30px; color: red;" class="fa fa-times"></i></a>
                </div>
            </div>
        </div>
    </div>

    <div id="check_correct_model" class="modal model_style fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 5%!important;">
                <div style="text-align: center;">
                    <a><i style="font-size:48px; color: green;"
                          class="fa fa-check"></i></a>
                </div>
                <div class="modal-body" style="align-self: center;">
                    <h6>{{trans('s_admin.phone_checked_s')}}</h6>
                </div>
                <div class="modal-footer" style="align-self: center;">
                    <a class="btn btn-info" data-dismiss="modal"
                       href="javascript:void(this);">{{trans('s_admin.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>
    <div id="check_email_correct_model" class="modal model_style fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 5%!important;">
                <div style="text-align: center;">
                    <a><i style="font-size:48px; color: green;"
                          class="fa fa-check"></i></a>
                </div>
                <div class="modal-body" style="align-self: center;">
                    <h6>{{trans('s_admin.email_checked_s')}}</h6>
                </div>
                <div class="modal-footer" style="align-self: center;">
                    <a class="btn btn-info" data-dismiss="modal"
                       href="javascript:void(this);">{{trans('s_admin.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>

    <div id="exists_email_model" class="modal model_style fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 5%!important;">
                <div class="modal-body" style="align-self: center;">
                    <div style="text-align: center;">
                        <a><i style="font-size:48px; color: red;"
                              class="fa fa-times"></i></a>
                    </div>

                    <br>
                    <h6>{{trans('s_admin.email_exists_before')}}</h6>
                </div>
                <div class="modal-footer" style="align-self: center;">
                    <a class="btn btn-info" data-dismiss="modal"
                       href="javascript:void(this);">{{trans('s_admin.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>
    <div id="exists_phone_model" class="modal model_style fade" tabindex="-1" role="dialog"
         aria-labelledby="myModalLabel"
         aria-hidden="true" style="display: none;">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content" style="border-radius: 5%!important;">
                <div class="modal-body" style="align-self: center;">
                    <div style="text-align: center;">
                        <a><i style="font-size:48px; color: red;"
                              class="fa fa-times"></i></a>
                    </div>

                    <br>
                    <h6>{{trans('s_admin.phone_exists_before')}}</h6>
                </div>
                <div class="modal-footer" style="align-self: center;">
                    <a class="btn btn-info" data-dismiss="modal"
                       href="javascript:void(this);">{{trans('s_admin.cancel')}}</a>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    {{--    //for hijri date--}}
    <script src="{{url('/')}}/hijri/js/jquery-3.3.1.js"></script>
    <script src="{{url('/')}}/hijri/js/bootstrap.js"></script>
    <script src="{{url('/')}}/hijri/js/momentjs.js"></script>
    <script src="{{url('/')}}/hijri/js/moment-with-locales.js"></script>
    <script src="{{url('/')}}/hijri/js/moment-hijri.js"></script>
    <script src="{{url('/')}}/hijri/js/bootstrap-hijri-datetimepicker.js"></script>
    <script type="text/javascript">
        $(function () {
            initHijrDatePicker();
            $('.disable-date').hijriDatePicker({

                minDate: "2020-01-01",
                maxDate: "2021-01-01",
                viewMode: "years",
                hijri: true,
                debug: true
            });
        });

        function initHijrDatePicker() {
            $(".hijri-date-input").hijriDatePicker({
                locale: "ar-sa",
                format: "DD-MM-YYYY",
                hijriFormat: "iYYYY-iMM-iDD",
                dayViewHeaderFormat: "MMMM YYYY",
                hijriDayViewHeaderFormat: "iMMMM iYYYY",
                showSwitcher: true,
                allowInputToggle: true,
                showTodayButton: false,
                useCurrent: true,
                isRTL: false,
                viewMode: 'months',
                keepOpen: false,
                hijri: false,
                debug: true,
                showClear: true,
                showTodayButton: true,
                showClose: true
            });
        }

        function initHijrDatePickerDefault() {
            $(".hijri-date-input").hijriDatePicker();
        }
    </script>
    <script type="text/javascript"
            src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            var code = "+966"; // Assigning value from model.
            $('#txt_country_code').val(code);
            $('#txt_country_code').intlTelInput({
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
        $(function () {
            var code = "+966"; // Assigning value from model.
            $('#txt_parent_country_code').val(code);
            $('#txt_parent_country_code').intlTelInput({
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

        function removeSpaces(string) {
            return string.split(' ').join('');
        }

        function phonelimit_txt_phone(string) {
            var first_string = string.substring(0);
            var int_string = parseInt(first_string);
            if (int_string == 0) {
                $("#txt_phone").val('');
                return false;
            }
            if (string.length < 11) {
                return string;
            } else {
                //عفوا رقم الجوال 10 ارقام فقط
                alert('{{trans('s_admin.limit_phone_number')}}');
            }
        }

        function phonelimit_phone(string) {
            var first_string = string.substring(0);
            var int_string = parseInt(first_string);
            if (int_string == 0) {
                $("#phone").val('');
                return false;
            }
            if (string.length < 11) {
                return string;
            } else {
                //عفوا رقم الجوال 10 ارقام فقط
                alert('{{trans('s_admin.limit_phone_number')}}');
            }
        }
    </script>
    <script>
        $(document).on('click', '#btn_delete', function () {
            $("#txt_unique_name").val('');
            $("#txt_name").val('');
            $("#txt_pass").val('');
            $("#txt_con_pass").val('');
            $("#txt_f_name").val('');
            $("#txt_m_name").val('');
            $("#txt_l_name").val('');
            $("#txt_date").val('');
            $("#txt_email").val('');
            $("#txt_phone").val('');
        });
        {{--if({{$types}} != 'teacher_far_learn' || {{$types}} != 'teacher_mogmaa_dorr'){--}}
        $('#txt_date').on('blur', function () {
            if ($("#txt_date").val().split("-").reverse().join("-").substring(0, 4).indexOf('-') == -1) {
                var hi = $("#txt_date").val().split("-").reverse().join("-");
            } else {
                var hi = moment($("#txt_date").val().split("-").reverse().join("-"), 'iD-iM-iYYYY').format('YYYY-M-D');
            }
            var now = new Date();
            var past = new Date(hi);
            var nowYear = now.getFullYear();
            var pastYear = past.getFullYear();
            var age = nowYear - pastYear;
            if (age <= 10) {
                document.getElementById('parent_access').style.display = 'block';
                $('#user_name').attr('required', 'required');
                $('#phone').attr('required', 'required');
                $('#home_phone').attr('required', 'required');
                $('#address').attr('required', 'required');
                $('#txt_pa_c').val('false');
                document.getElementById('checked_parent_label_s').style.display = 'none';
                $('#btn_send_parent_code_check').show();
                document.getElementById('phone').removeAttribute('readonly');
                document.getElementById('txt_parent_country_code').removeAttribute('readonly');
            } else {
                document.getElementById('parent_access').style.display = 'none';
                $('#user_name').removeAttr('required');
                $('#phone').removeAttr('required');
                $('#home_phone').removeAttr('required');
                $('#address').removeAttr('required');
                $('#txt_pa_c').val('true');
            }
        });
        // }
        $('#btn_save').on('click', function () {
            // var unique_name = $('#txt_unique_name').val();
            var password = $('#txt_pass').val();
            var password_confirmation = $('#txt_con_pass').val();
            var first_name_ar = $('#txt_f_name').val();
            var mid_name_ar = $('#txt_m_name').val();
            var last_name_ar = $('#txt_l_name').val();
            var gender = $('#txt_gender').val();
            var email = $('#txt_email').val();
            var main_lang = $('#txt_lang').val();
            var date_of_birth = $('#txt_date').val();
            var country = $('#txt_country').val();
            var phone = $('#txt_phone').val();
            var qualification = $('#txt_qualification').val();
            var nationality = $('#txt_nationality').val();
            var country_code = $('#txt_country_code').val();
            var job_name = $('#txt_job_names').val();
            $.ajax({
                url: "/{{$types}}/store",
                type: "POST",
                data: {
                    _token: $("#csrf2").val(),
                    // unique_name: unique_name,
                    password: password,
                    password_confirmation: password_confirmation,
                    first_name_ar: first_name_ar,
                    mid_name_ar: mid_name_ar,
                    last_name_ar: last_name_ar,
                    gender: gender,
                    email: email,
                    main_lang: main_lang,
                    date_of_birth: date_of_birth,
                    country: country,
                    phone: phone,
                    qualification: qualification,
                    nationality: nationality,
                    country_code: country_code,
                    job_name: job_name,
                },
                cache: false,
                success: function (response) {
                    alert(response);
                    // console.log(data_result.msg);
                    // if (data_result.status == true) {
                    //     toastr.success(data_result.msg);
                    //
                    // } else if (data_result.status == false) {
                    //     toastr.error(data_result.msg);
                    // }
                }
            });
        });
    </script>
    <script>
        $(document).ready(function () {
            var navListItems = $('div.setup-panel div a'),
                allWells = $('.setup-content'),
                allNextBtn = $('.nextBtn');
            allBackBtn = $('.backBtn');
            allWells.hide();
            navListItems.click(function (e) {
                e.preventDefault();
                var $target = $($(this).attr('secc')),
                    $item = $(this);
                if (!$item.hasClass('disabled')) {
                    navListItems.removeClass('btn-success').addClass('btn-default');
                    $item.addClass('btn-success');
                    allWells.hide();
                    $target.show();
                    $target.find('input:eq(0)').focus();
                }
            });
            allNextBtn.click(function () {
                if ($(this).closest(".setup-content").attr("id") == 'step-1') {
                    var pw1 = $('#txt_pass').val();
                    var pw2 = $('#txt_con_pass').val();
                    var ec = $('#txt_e_c').val();
                    var pc = $('#txt_p_c').val();
                    var pac = $('#txt_pa_c').val();
                    var parent_phone = $('#phone').val();
                    console.log(parent_phone);
                    if (ec != 'true') {
                        alert("يجب التحقق من البريد الإلكتروني اولا !");
                    } else if (pc != 'true') {
                        alert("يجب التحقق من رقم الجوال أولا !");
                    }else if(pac != 'true'){
                        alert("يجب التحقق من رقم جوال ولي الامر أولا !");

                    } else if (pw1 != pw2) {
                        alert("كلمات المرور غير متطابقة");
                    } else {
                        var curStep = $(this).closest(".setup-content"),
                            curStepBtn = curStep.attr("id"),
                            nextStepWizard = $('div.setup-panel div a[secc="#' + curStepBtn + '"]').parent().next().children("a"),
                            curInputs = curStep.find("input[type='text'],input[type='email'],input[type='password'],input[type='url'],input[type='number'],select"),
                            isValid = true;

                        $(".form-group").removeClass("has-error");
                        for (var i = 0; i < curInputs.length; i++) {
                            if (!curInputs[i].validity.valid) {
                                isValid = false;
                                $(curInputs[i]).closest(".form-group").addClass("has-error");
                                if (curInputs[i].id == 'txt_f_name') {
                                    // alert('  تحقق من ادخال الاسم الاول');
                                    alert('{{trans('s_admin.first_name_req')}}');
                                } else if (curInputs[i].id == 'txt_m_name') {
                                    // alert('تحقق من ادخال الاسم الاوسط');
                                    alert('{{trans('s_admin.mide_name_req')}}');

                                } else if (curInputs[i].id == 'txt_l_name') {
                                    // alert('تحقق من ادخال الاسم الاخير');
                                    alert('{{trans('s_admin.last_name_req')}}');

                                } else if (curInputs[i].id == 'txt_unique_name') {
                                    // alert('تحقق من ادخال اسم المستخدم ');
                                    alert('{{trans('s_admin.user_name_req')}}');

                                } else if (curInputs[i].id == 'txt_email') {
                                    // alert('تحقق من ادخال البريد الالكتروني بطريقة صحيحة ');
                                    alert('{{trans('s_admin.email_req')}}');

                                } else if (curInputs[i].id == 'txt_pass') {
                                    // alert('تحقق من ادخال كلمة المرور على الاقل 8 حروف   ');
                                    alert('{{trans('s_admin.eight_pass_req')}}');

                                } else if (curInputs[i].id == 'txt_phone') {
                                    // alert('تحقق من ادخال رقم الجوال    ');
                                    alert('{{trans('s_admin.phone_req')}}');

                                } else if (curInputs[i].id == 'txt_date') {
                                    // alert('تحقق من ادخال تاريخ الميلاد');
                                    alert('{{trans('s_admin.d_o_b_req')}}');

                                } else if (curInputs[i].id == 'txt_ident_num') {
                                    // alert('تحقق من ادخال رقم الهوية    ');
                                    alert('{{trans('s_admin.ident_req')}}');

                                } else if (curInputs[i].id == 'user_name') {
                                    // alert('تحقق من ادخال الاسم بالكامل    ');
                                    alert('{{trans('s_admin.full_name_req')}}');

                                } else if (curInputs[i].id == 'phone') {
                                    // alert('تحقق من ادخال رقم الجوال    ');
                                    alert('{{trans('s_admin.phone2_req')}}');

                                } else if (curInputs[i].id == 'home_phone') {
                                    // alert('تحقق من ادخال جوال المنزل    ');
                                    alert('{{trans('s_admin.house_phone_req')}}');

                                } else if (curInputs[i].id == 'address') {
                                    // alert('تحقق من ادخال العنوان    ');
                                    alert('{{trans('s_admin.address_req')}}');
                                }

                                break;
                            }
                        }
                        if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
                    }
                } else {
                    var curStep = $(this).closest(".setup-content"),
                        curStepBtn = curStep.attr("id"),
                        nextStepWizard = $('div.setup-panel div a[secc="#' + curStepBtn + '"]').parent().next().children("a"),
                        curInputs = curStep.find("input[type='text'],input[type='email'],input[type='password'],input[type='url'],input[type='number'],select"),
                        isValid = true;
                    $(".form-group").removeClass("has-error");
                    for (var i = 0; i < curInputs.length; i++) {
                        if (!curInputs[i].validity.valid) {
                            isValid = false;
                            $(curInputs[i]).closest(".form-group").addClass("has-error");
                            if (curInputs[i].id == 'txt_f_name') {
                                alert('{{trans('s_admin.first_name_req')}}');

                            } else if (curInputs[i].id == 'txt_m_name') {
                                alert('{{trans('s_admin.mide_name_req')}}');
                            } else if (curInputs[i].id == 'txt_l_name') {
                                alert('{{trans('s_admin.last_name_req')}}');
                            } else if (curInputs[i].id == 'txt_unique_name') {
                                alert('{{trans('s_admin.user_name_req')}}');
                            } else if (curInputs[i].id == 'txt_email') {
                                alert('{{trans('s_admin.email_req')}}');
                            } else if (curInputs[i].id == 'txt_pass') {
                                alert('{{trans('s_admin.eight_pass_req')}}');
                            } else if (curInputs[i].id == 'txt_phone') {
                                alert('{{trans('s_admin.phone_req')}}');
                            } else if (curInputs[i].id == 'txt_date') {
                                alert('{{trans('s_admin.d_o_b_req')}}');
                            } else if (curInputs[i].id == 'txt_ident_num') {
                                alert('{{trans('s_admin.ident_req')}}');
                            } else if (curInputs[i].id == 'user_name') {
                                alert('{{trans('s_admin.full_name_req')}}');
                            } else if (curInputs[i].id == 'phone') {
                                alert('{{trans('s_admin.phone2_req')}}');
                            } else if (curInputs[i].id == 'address') {
                                alert('{{trans('s_admin.address_req')}}');
                            }
                            break;
                        }
                    }
                    if (isValid) nextStepWizard.removeAttr('disabled').trigger('click');
                }
            });
            allBackBtn.click(function () {
                var curStep = $(this).closest(".setup-content");
                var curStepBtn = curStep.attr("id");
                var currStepWizard = $('div.setup-panel div a[secc="#' + curStepBtn + '"]').parent().children("a");
                var prevStepWizard = $('div.setup-panel div a[secc="#' + curStepBtn + '"]').parent().prev().children("a");
                prevStepWizard.trigger('click');
                currStepWizard.attr("disabled", "disabled");
            });
            $('div.setup-panel div a.btn-success').trigger('click');
        });
    </script>
    <script>
        $('#cmb_levels').change(function () {
            var level = $(this).val();
            $.ajax({
                url: "/web/get_subjects/" + level,
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    $('#subject_cont').show(data);
                    $('#cmb_sign_up_subject').html(data);
                }
            });
        });
        $('#cmb_sign_up_subject').change(function () {
            var subject = $(this).val();
            $.ajax({
                url: "/web/get_subject_levels/" + subject,
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    $('#subject_level_cont').show(data);
                    $('#cmb_subject_levels').html(data);
                }
            });
        });
        $('#cmb_country').change(function () {
            var subject = $(this).val();
            $.ajax({
                url: "/web/get_zones/" + subject,
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    $('#zones_cont').show();
                    $('#cmb_zones').html(data);
                }
            });
        });
        $('#cmb_zones').change(function () {
            var subject = $(this).val();
            $.ajax({
                url: "/web/get_cities/" + subject,
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    $('#city_cont').show(data);
                    $('#cmb_cities').html(data);
                }
            });
        });
        $('#cmb_cities').change(function () {
            var level = $(this).val();
            $.ajax({
                url: "/web/get_districts/" + level,
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    $('#districts_cont').show();
                    $('#lbl_zones_cont').show();
                    $('#cmb_districts').html(data);
                }
            });
        });
    </script>
    <script>
        // Begin phone check javascript
        $(document).on('click', '#btn_send_code_check', function () {
            var phone = $('#txt_phone').val();
            var country_code = $('#txt_country_code').val();
            var type = $('#txt_type').val();
            $.ajax({
                type: "post",
                url: "{{route('phone.send.check_code')}}",
                data: {
                    _token: $("#csrf").val(),
                    country_code: country_code,
                    phone: phone,
                    type: type
                },
                datatype: "json",
                success: function (data) {
                    if (data.status == true) {
                        $('#check_model').modal('toggle');

                    } else {
                        if(data.type == 'exists'){
                            $('#exists_phone_model').modal('toggle');
                        }
                    }
                }
            });
        });
        $(document).on('click', '#btn_resend', function () {
            var phone = $('#txt_phone').val();
            var country_code = $('#txt_country_code').val();
            $.ajax({
                type: "post",
                url: "{{route('phone.resned.check_code')}}",
                data: {
                    _token: $("#csrf").val(),
                    country_code: country_code,
                    phone: phone
                },
                datatype: "json",
                success: function (data) {
                    if (data.status == true) {
                        $('#checked_label').show();
                        // $('#check_model').modal('toggle');
                    } else {
                        // $('#check_model').modal('toggle');
                    }
                }
            });
        });
        $(document).on('click', '#btn_check', function () {
            var phone = $('#txt_phone').val();
            var country_code = $('#txt_country_code').val();
            var code = $('#txt_checked_code').val();
            $.ajax({
                type: "post",
                url: "{{route('phone.check')}}",
                data: {
                    _token: $("#csrf").val(),
                    country_code: country_code,
                    phone: phone,
                    code: code,
                },
                datatype: "json",
                success: function (data) {
                    if (data.status == true) {
                        $('#check_model').modal('hide');
                        $('#check_correct_model').modal('toggle');
                        document.getElementById('btn_send_code_check').style.display = 'none';
                        $('#checked_label_s').show();
                        document.getElementById('txt_phone').setAttribute('readonly', true);
                        document.getElementById('txt_country_code').setAttribute('readonly', true);
                        $('#txt_p_c').val("true");
                    } else {
                        if(data.type == 'wrong_code'){
                            $('#phone_wrong_label').show();
                        }
                        // $('#check_model').modal('toggle');
                    }
                }
            });
        });
        // End phone check javascript
        // Begin Email check javascript
        $(document).on('click', '#btn_send_email_code_check', function () {
            var email = $('#txt_email').val();
            var type = $('#txt_type').val();
            $.ajax({
                type: "post",
                url: "{{route('email.send.check_code')}}",
                data: {
                    _token: $("#csrf").val(),
                    email: email,
                    type: type
                },
                datatype: "json",
                success: function (data) {
                    if (data.status == true) {
                        $('#check_email_model').modal('toggle');
                    } else {
                        if(data.type == 'exists'){
                            $('#exists_email_model').modal('toggle');
                        }

                    }
                }
            });
        });
        $(document).on('click', '#btn_email_resend', function () {
            var email = $('#txt_email').val();
            $.ajax({
                type: "post",
                url: "{{route('email.resned.check_code')}}",
                data: {
                    _token: $("#csrf").val(),
                    email: email
                },
                datatype: "json",
                success: function (data) {
                    if (data.status == true) {
                        $('#checked_email_label').show();
                        // $('#check_model').modal('toggle');
                    } else {
                        // $('#check_model').modal('toggle');
                    }
                }
            });
        });
        $(document).on('click', '#btn_email_check', function () {
            var email = $('#txt_email').val();
            var code = $('#txt_checked_email_code').val();
            $.ajax({
                type: "post",
                url: "{{route('email.check')}}",
                data: {
                    _token: $("#csrf").val(),
                    email: email,
                    code: code,
                },
                datatype: "json",
                success: function (data) {
                    if (data.status == true) {
                        $('#check_email_model').modal('hide');
                        $('#check_email_correct_model').modal('toggle');
                        document.getElementById('btn_send_email_code_check').style.display = 'none';
                        $('#checked_email_label_s').show();
                        document.getElementById('txt_email').setAttribute('readonly', true);
                        $('#txt_e_c').val("true");

                    } else {
                        if(data.type == 'wrong_code'){
                            $('#email_wrong_label').show();
                        }
                    }
                }
            });
        });
        // End email check javascript
        // Begain parent phone check javascript
        $(document).on('click', '#btn_send_parent_code_check', function () {
            var phone = $('#phone').val();
            var country_code = $('#txt_parent_country_code').val();
            $.ajax({
                type: "post",
                url: "{{route('parent.send.check_code')}}",
                data: {
                    _token: $("#csrf").val(),
                    country_code: country_code,
                    phone: phone
                },
                datatype: "json",
                success: function (data) {
                    if (data.status == true) {
                        $('#check_parent_model').modal('toggle');

                    } else {
                        // $('#check_model').modal('toggle');
                    }
                }
            });
        });
        $(document).on('click', '#btn_parent_resend', function () {
            var phone = $('#phone').val();
            var country_code = $('#txt_parent_country_code').val();
            $.ajax({
                type: "post",
                url: "{{route('parent.resned.check_code')}}",
                data: {
                    _token: $("#csrf").val(),
                    country_code: country_code,
                    phone: phone
                },
                datatype: "json",
                success: function (data) {
                    if (data.status == true) {
                        $('#checked_parent_label').show();
                        // $('#check_model').modal('toggle');
                    } else {
                        // $('#check_model').modal('toggle');
                    }
                }
            });
        });
        $(document).on('click', '#btn_parent_check', function () {
            var phone = $('#phone').val();
            var country_code = $('#txt_parent_country_code').val();
            var code = $('#txt_checked_parent_code').val();
            $.ajax({
                type: "post",
                url: "{{route('parent.check')}}",
                data: {
                    _token: $("#csrf").val(),
                    country_code: country_code,
                    phone: phone,
                    code: code
                },
                datatype: "json",
                success: function (data) {
                    if (data.status == true) {
                        $('#check_parent_model').modal('hide');
                        $('#check_correct_model').modal('toggle');
                        document.getElementById('btn_send_parent_code_check').style.display = 'none';
                        $('#checked_parent_label_s').show();
                        document.getElementById('phone').setAttribute('readonly', true);
                        document.getElementById('txt_parent_country_code').setAttribute('readonly', true);
                        $('#txt_pa_c').val("true");
                    } else {

                        $('#parent_wrong_label').show();

                    }
                }
            });
        });
        // End phone check javascript
    </script>
    <script src="{{url('/')}}/assets/plugins/jquery-steps-master/build/jquery.steps.js"></script>
@endsection
