
<!DOCTYPE html>


        @php $app = \App\Models\Web_setting::where('id',1)->first(); @endphp
        @if(session('lang')=='en')
            <html lang="en">
            <!--begin::Head-->
            <head><base href="">
            <meta charset="utf-8" />
            <title>{{$app->title_en}}</title>
            <meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <link rel="canonical" href="https://keenthemes.com/metronic" />
            <!--begin::Fonts-->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
            <!--end::Fonts-->
            <!--begin::Page Vendors Styles(used by this page)-->
            <link href="{{ asset('metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet" type="text/css" />
            <!--end::Page Vendors Styles-->
            <!--begin::Global Theme Styles(used by all pages)-->
            <link href="{{ asset('metronic/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/plugins/custom/prismjs/prismjs.bundle.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
            <!--end::Global Theme Styles-->
            <!--begin::Layout Themes(used by all pages)-->
            <link href="{{ asset('metronic/assets/css/themes/layout/header/base/light.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/themes/layout/header/menu/light.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/themes/layout/brand/dark.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/themes/layout/aside/dark.css') }}" rel="stylesheet" type="text/css" />
            <!--end::Layout Themes-->
            <link rel="shortcut icon" href="{{ asset('metronic/assets/media/logos/favicon.ico') }}" />
            <link rel="stylesheet"
            href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
            <style>
                body {
                    font-family: 'Droid Arabic Kufi', serif !important;
                    font-size: 48px;
                }
            </style>
                @yield('styles')
        @else
            <html direction="rtl" dir="rtl" style="direction: rtl" >
            <!--begin::Head-->
            <head><base href="">
            <meta charset="utf-8" />
            <title>{{$app->title_ar}}</title>
            <meta name="description" content="Metronic admin dashboard live demo. Check out all the features of the admin panel. A large number of settings, additional services and widgets." />
            <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
            <link rel="canonical" href="https://keenthemes.com/metronic" />
            <!--begin::Fonts-->
            <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
            <!--end::Fonts-->
            <!--begin::Page Vendors Styles(used by this page)-->
            <link href="{{ asset('metronic/assets/plugins/custom/fullcalendar/fullcalendar.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/plugins/custom/datatables/datatables.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
            <!--end::Page Vendors Styles-->
            <!--begin::Global Theme Styles(used by all pages)-->
            <link href="{{ asset('metronic/assets/plugins/global/plugins.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/plugins/custom/prismjs/prismjs.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/style.bundle.rtl.css') }}" rel="stylesheet" type="text/css" />
            <!--end::Global Theme Styles-->
            <!--begin::Layout Themes(used by all pages)-->
            <link href="{{ asset('metronic/assets/css/themes/layout/header/base/light.rtl.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/themes/layout/header/menu/light.rtl.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/themes/layout/brand/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
            <link href="{{ asset('metronic/assets/css/themes/layout/aside/dark.rtl.css') }}" rel="stylesheet" type="text/css" />
            <!--end::Layout Themes-->
            <link rel="shortcut icon" href="{{ asset('metronic/assets/media/logos/favicon.ico') }}" />
            <link rel="stylesheet"
            href="https://fonts.googleapis.com/earlyaccess/droidarabickufi.css">
            <style>
                body {
                    font-family: 'Droid Arabic Kufi', serif !important;
                    font-size: 48px;
                }
            </style>
            @yield('styles')
        @endif
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/16.0.8/css/intlTelInput.css" />
        <link href="{{url('/')}}/hijri/css/bootstrap-datetimepicker.css" rel="stylesheet" />
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
        </style>
    </head>
    <!--end::Head-->
    <!--begin::Body-->
    <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
        <!--begin::Main-->
        <!--begin::Header Mobile-->
