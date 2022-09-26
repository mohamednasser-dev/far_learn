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
                                <img src="{{$settings_share->logo}}" alt="blog">
                            </div>
                            <p></p>
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
                                    <li><a href="{{$settings_share->linked_in}}"><i class="ti-linkedin-in"></i></a></li>
                                @endif
                                @if($settings_share->insta  != null)
                                    <li><a href="{{$settings_share->insta}}"><i class="ti-instagram"></i></a></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                    <div class="col col-lg-4 col-md-3 col-sm-6">
                        <div class="widget link-widget">
                            <div class="widget-title">
                                <h3>{{trans('admin.useful_links')}}</h3>
                            </div>
                            <ul>
                                <li><a href="{{route('terms')}}">{{trans('admin.terms')}}</a></li>

                            </ul>
                        </div>
                    </div>
                    <div class="col col-lg-3 col-lg-offset-1 col-md-3 col-sm-6">
                        <div class="widget market-widget wpo-service-link-widget">
                            <div class="widget-title">
                                <h3>{{trans('admin.web_data')}} </h3>
                            </div>
                            <p></p>
                            <div class="contact-ft">
                                <ul>
                                    <li><i class="fi ti-location-pin"></i>{{$settings_share->address}}</li>
                                    <li><i class="fi flaticon-call"></i>{{$settings_share->phone}}</li>
                                    <li><i class="fi flaticon-envelope"></i>{{$settings_share->email}}</li>
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
                        <p class="copyright">&copy; URAM. {{trans('admin.all_reserve')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <!-- end wpo-site-footer -->
</div>
</div>
<!-- end of page-wrapper -->
<!-- All JavaScript files
================================================== -->
<script src="{{url('/')}}/ummah-rtl/assets/js/jquery.min.js"></script>
<script src="{{url('/')}}/ummah-rtl/assets/js/bootstrap.min.js"></script>
<script src="{{url('/')}}/ummah-rtl/assets/js/circle-progress.min.js"></script>
<!-- Plugins for this template -->
<script src="{{url('/')}}/ummah-rtl/assets/js/jquery-plugin-collection.js"></script>
<!-- Custom script for this template -->
<script src="{{url('/')}}/ummah-rtl/assets/js/script.js"></script>
<script src="{{url('/')}}/metronic/assets/js/pages/features/miscellaneous/sweetalert2.js"></script>
<script src="{{ asset('metronic/assets/js/pages/features/miscellaneous/toastr.js')}}"></script>
<script>
    $('#sign_up_btn').click(function () {
        $('#login-modal').modal('hide');
        $('#stud_model').modal('hide');
        $('#far_learn_model').modal('hide');
        $('#teacher_model').modal('hide');
    });
    $('#login_btn').click(function () {
        $('#sign-modal').modal('hide');
        $('#stud_model').modal('hide');
        $('#far_learn_model').modal('hide');
        $('#teacher_model').modal('hide');
    });
</script>
<script type="text/javascript"
        src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/js/intlTelInput-jquery.min.js"></script>
<script type="text/javascript">
    $(function () {
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
    $(function () {
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
        if(int_string == '0'){
            $("#phone").val('');
            return false;
        }else{
            return string;
        }
    }
</script>
@include('sweetalert::alert')
@yield('scripts')
</body>

</html>
