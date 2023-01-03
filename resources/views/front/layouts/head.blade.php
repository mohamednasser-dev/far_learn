<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="author" content="wpoceans">
    @if(app()->getLocale() == 'ar')
        <title>{{$settings_share->title_ar}}</title>
        <link href="{{url('/')}}/ummah-rtl/assets/css/themify-icons.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/flaticon.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/animate.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/owl.carousel.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/owl.theme.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/slick.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/slick-theme.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/swiper.min.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/owl.transitions.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/jquery.fancybox.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/odometer-theme-default.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/nice-select.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah-rtl/assets/css/style.css" rel="stylesheet">
    @else
        <title>{{$settings_share->title_en}}</title>
        <link href="{{url('/')}}/ummah_ltr/assets/css/themify-icons.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/font-awesome.min.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/flaticon.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/animate.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/owl.carousel.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/owl.theme.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/slick.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/slick-theme.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/swiper.min.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/owl.transitions.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/jquery.fancybox.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/odometer-theme-default.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/nice-select.css" rel="stylesheet">
        <link href="{{url('/')}}/ummah_ltr/assets/css/style.css" rel="stylesheet">
    @endif
        <link href="{{url('/')}}/ummah-rtl/assets/css/new_styles.css" rel="stylesheet">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css"/>
    @yield('styles')
    <style>
        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }
        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }
        /* four country code input */
        input[id=txt_main_login_countrycode_code] {
            z-index: -1;
        }
    </style>
</head>
