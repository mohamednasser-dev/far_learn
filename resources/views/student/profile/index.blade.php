@extends('student.student_temp')
@section('title')
    <div class="d-flex align-items-center flex-wrap mr-2">
        <h5 class="text-dark font-weight-bold mt-2 mb-2 mr-5">{{trans('s_admin.profile')}}</h5>
        <div class="subheader-separator subheader-separator-ver mt-2 mb-2 mr-4 bg-gray-200"></div>
    </div>
@endsection
@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
    <link href="{{url('/')}}/hijri/css/bootstrap-datetimepicker.css" rel="stylesheet" />
    <style>
        .iti--container {
            direction: ltr !important;
        }

    </style>
@endsection
@section('content')
    <div class="container">
        <div class="d-flex flex-row">
            <div class="flex-row-auto offcanvas-mobile w-250px w-xxl-350px" id="kt_profile_aside">
                <div class="card card-custom card-stretch">
                    <div class="card-body pt-4">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-60 symbol-xxl-100 mr-5 align-self-start align-self-xxl-center">
                                @if($data->image == null)
                                    <div class="symbol-label" style="background-image:url('{{$data->image}}')"></div>
                                @else
                                    <div class="symbol-label" style="background-image:url('{{$data->image}}')"></div>
                                @endif
                                <i class="symbol-badge bg-success"></i>
                            </div>
                            <div>
                                <a href="#" class="font-weight-bolder font-size-h5 text-dark-75 text-hover-primary">
                                    @if(app()->getLocale() == 'ar')
                                        {{$data->first_name_ar}} {{$data->mid_name_ar}} {{$data->last_name_ar}}
                                    @else
                                        {{$data->first_name_en}} {{$data->mid_name_en}} {{$data->last_name_en}}
                                    @endif
                                </a>
                                <div class="text-muted">@if($data->gender == 'male') {{trans('admin.student')}} @elseif($data->gender == 'female') {{trans('admin.student_female')}} @endif </div>
                                <div class="mt-2">
                                </div>
                            </div>
                        </div>
                        <!--end::User-->
                        <!--begin::Contact-->
                        <div class="py-9">
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">{{trans('admin.email')}}</span>
                                <a href="#" class="text-muted text-hover-primary">{{$data->email}}</a>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">{{trans('admin.phone')}}</span>
                                <span class="text-muted">({{$data->country_code}}) {{$data->phone}} </span>
                            </div>
                            <div class="d-flex align-items-center justify-content-between mb-2">
                                <span class="font-weight-bold mr-2">{{trans('admin.epo_type')}}</span>
                                <span class="text-muted">
                                    @if($data->epo_type == 'far_learn' )
                                        {{trans('s_admin.nav_far_epo')}}
                                    @elseif($data->epo_type == 'dorr' )
                                        {{trans('s_admin.nav_dorr_epo')}}
                                    @else
                                        {{trans('s_admin.mogmaa_epos')}}
                                    @endif
                                </span>
                            </div>
                        </div>
                        <!--end::Contact-->
                        <!--begin::Nav-->
                        <div class="navi navi-bold navi-hover navi-active navi-link-rounded">
                            <div class="navi-item mb-2">
                                <a href="{{route('student.profile')}}" class="navi-link py-4 @if(Route::current()->getName() == 'student.profile' || Route::current()->getName() == 'student_home' ) active @endif">
															<span class="navi-icon mr-2">
																<span class="svg-icon">
																	<!--begin::Svg Icon | path:assets/media/svg/icons/General/User.svg-->
																	<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
																		<g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
																			<polygon points="0 0 24 0 24 24 0 24" />
																			<path d="M12,11 C9.790861,11 8,9.209139 8,7 C8,4.790861 9.790861,3 12,3 C14.209139,3 16,4.790861 16,7 C16,9.209139 14.209139,11 12,11 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
																			<path d="M3.00065168,20.1992055 C3.38825852,15.4265159 7.26191235,13 11.9833413,13 C16.7712164,13 20.7048837,15.2931929 20.9979143,20.2 C21.0095879,20.3954741 20.9979143,21 20.2466999,21 C16.541124,21 11.0347247,21 3.72750223,21 C3.47671215,21 2.97953825,20.45918 3.00065168,20.1992055 Z" fill="#000000" fill-rule="nonzero" />
																		</g>
																	</svg>
                                                                    <!--end::Svg Icon-->
																</span>
															</span>
                                    <span class="navi-text font-size-lg">{{trans('s_admin.personal_info')}}</span>
                                </a>
                            </div>
                            <div class="navi-item mb-2">
                                <a href="{{route('student.change_pass')}}" class="navi-link py-4  @if(Route::current()->getName() == 'student.change_pass' ) active @endif ">
                                    <span class="navi-icon mr-2">
                                        <span class="svg-icon">
                                            <!--begin::Svg Icon | path:assets/media/svg/icons/Communication/Shield-user.svg-->
                                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                                                <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                                    <rect x="0" y="0" width="24" height="24" />
                                                    <path d="M4,4 L11.6314229,2.5691082 C11.8750185,2.52343403 12.1249815,2.52343403 12.3685771,2.5691082 L20,4 L20,13.2830094 C20,16.2173861 18.4883464,18.9447835 16,20.5 L12.5299989,22.6687507 C12.2057287,22.8714196 11.7942713,22.8714196 11.4700011,22.6687507 L8,20.5 C5.51165358,18.9447835 4,16.2173861 4,13.2830094 L4,4 Z" fill="#000000" opacity="0.3" />
                                                    <path d="M12,11 C10.8954305,11 10,10.1045695 10,9 C10,7.8954305 10.8954305,7 12,7 C13.1045695,7 14,7.8954305 14,9 C14,10.1045695 13.1045695,11 12,11 Z" fill="#000000" opacity="0.3" />
                                                    <path d="M7.00036205,16.4995035 C7.21569918,13.5165724 9.36772908,12 11.9907452,12 C14.6506758,12 16.8360465,13.4332455 16.9988413,16.5 C17.0053266,16.6221713 16.9988413,17 16.5815,17 C14.5228466,17 11.463736,17 7.4041679,17 C7.26484009,17 6.98863236,16.6619875 7.00036205,16.4995035 Z" fill="#000000" opacity="0.3" />
                                                </g>
                                            </svg>
                                            <!--end::Svg Icon-->
                                        </span>
                                    </span>
                                    <span class="navi-text font-size-lg">{{trans('s_admin.change_pass')}}</span>
                                </a>
                            </div>
                        </div>
                        <!--end::Nav-->
                    </div>
                    <!--end::Body-->
                </div>
                <!--end::Profile Card-->
            </div>
            <!--end::Aside-->

            @if(Route::current()->getName() == 'student.profile')
                @include('student.profile.personal_info')
            @elseif(Route::current()->getName() == 'student_home')
                @include('student.profile.personal_info')
            @else
                @include('student.profile.change_pass')
            @endif
        </div>
        <!--end::Profile Personal Information-->
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('metronic/assets/js/pages/widgets.js') }}"></script>
    <script src="{{ asset('metronic/assets/js/pages/custom/profile/profile.js') }}"></script>

    <script src="{{url('/')}}/hijri/js/jquery-3.3.1.js"></script>
    <script src="{{url('/')}}/hijri/js/momentjs.js"></script>
    <script src="{{url('/')}}/hijri/js/moment-with-locales.js"></script>
    <script src="{{url('/')}}/hijri/js/moment-hijri.js"></script>
    <script src="{{url('/')}}/hijri/js/bootstrap-hijri-datetimepicker.js"></script>
    <script type="text/javascript">
        $(function () {
            initHijrDatePicker();
            $('.disable-date').hijriDatePicker({

                minDate:"2020-01-01",
                maxDate:"2021-01-01",
                viewMode:"years",
                hijri:true,
                debug:true
            });
        });
        function initHijrDatePicker() {
            $(".hijri-date-input").hijriDatePicker({
                locale: "ar-sa",
                format: "DD-MM-YYYY",
                hijriFormat:"iYYYY-iMM-iDD",
                dayViewHeaderFormat: "MMMM YYYY",
                hijriDayViewHeaderFormat: "iMMMM iYYYY",
                showSwitcher: true,
                allowInputToggle: true,
                showTodayButton: false,
                useCurrent: true,
                isRTL: false,
                viewMode:'months',
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
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>

    <script type="text/javascript">
        $(function() {
            var code = "{{$data->country_code}}"; // Assigning value from model.
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
            console.log(code)
        });
    </script>

    <script>
        $('#cmb_levels').change(function(){
            var level = $(this).val();
            $.ajax({
                url: "/student/profile/get_subjects/" + level ,
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    $('#subject_cont').show(data);
                    $('#cmb_sign_up_subject').html(data);
                }
            });
        });
        $('#cmb_sign_up_subject').change(function(){
            var subject = $(this).val();
            $.ajax({
                url: "/student/profile/get_subject_levels/" + subject ,
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    $('#subject_level_cont').show(data);
                    $('#cmb_subject_levels').html(data);
                }
            });
        });

        $('#cmb_country').change(function(){
            var subject = $(this).val();
            $.ajax({
                url: "/student/get_zones/" + subject ,
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    $('#zones_cont').show();
                    $('#cmb_zones').html(data);
                }
            });
        });

        $('#cmb_zones').change(function(){
            var subject = $(this).val();
            $.ajax({
                url: "/student/get_cities/" + subject ,
                dataType: 'html',
                type: 'get',
                success: function (data) {
                    $('#city_cont').show(data);
                    $('#cmb_cities').html(data);
                }
            });
        });
        $('#cmb_cities').change(function(){
            var level = $(this).val();
            $.ajax({
                url: "/student/get_districts/" + level ,
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
@endsection

