<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
    <meta content="en-us" http-equiv="Content-Language">
    <meta content="text/html; charset=utf-8" http-equiv="Content-Type">
    <title>Maqrah</title>
    <style type="text/css">
        body {
            margin: 0;
            padding: 0;
            background-color: #cccccc;
            background: #cccccc;
            direction: rtl;
        }
    </style>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

</head>

<body bgcolor="#cccccc" link="#0f75c3" vlink="#0f75c3">
<!-- Start of main container -->
<table align="center" bgcolor="#cccccc" cellpadding="0" cellspacing="0"
       style="width: 100%; background:#cccccc; background-color:#cccccc; margin:0; padding:0 20px;">
    <tr>
        <td>
            <table align="center" cellpadding="0" cellspacing="0"
                   style="width: 620px; border-collapse:collapse; text-align:right; font-family:Tahoma; font-weight:normal; font-size:12px; line-height:15pt; color:#444444; margin:0 auto;">
                <!-- Start of logo and top links -->
                <tr>
                    <td valign="top" style="height:5px;margin:0;padding:20px 0 0 0;;line-height:0;">
                    </td>
                </tr>
                <tr>
                    <td style=" width:620px;" valign="top">
                        <table cellpadding="0" cellspacing="0"
                               style="width:100%; border-collapse:collapse;font-family:Tahoma; font-weight:normal; font-size:12px; line-height:15pt; color:#444444;">

                            <tr>
                                <td bgcolor="#FFFFFF"
                                    style="width: 320px; padding:20px 0 15px 20px; background:#ffffff; background-color:#ffffff;"
                                    valign="middle">
                                    <p style="padding:0; margin:0; line-height:160%; font-size:18px;     text-align: center;">
                                        {{settings()->title_ar}}
                                    </p>
                                </td>
                                <td bgcolor="#FFFFFF"
                                    style="width: 300px; padding:20px 20px 15px 20px; background:#ffffff; background-color:#ffffff; text-align:center;"
                                    valign="middle">
                                    <a style="color:#053b64; text-decoration:underline;"
                                       href="{{url('/')}}">{{url('/')}}</a>
                                    | <a style="color:#053b64; text-decoration:underline;"
                                         href="#">{{settings()->email}}</a><br>
                                    Support: {{settings()->phone}}
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" style="height:5px;margin:0;padding:0;line-height:0;">
                    </td>
                </tr>
                <!-- End of logo and top links -->
                <!-- Start of Letter Content -->
                <tr>
                    <td valign="top" style="height:5px;margin:0;padding:20px 0 0 0;line-height:0;">
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF"
                        style="padding:10px 20px; background:#ffffff;background-color:#ffffff; text-align:center;"
                        valign="top">
                        <p style="padding:0; margin:0 0 11pt 0;line-height:160%; font-size:18px;">
                            @if($data['lang'] == "ar")
                                مرحبآ بك
                            @else
                                Welcome..
                            @endif
                        </p>
                        <p style="padding:0; margin:11pt 0;line-height:160%; font-size:15px; font-style:italic;">
                        <p style="padding:0; margin:0 0 11pt 0;line-height:160%; font-size:18px;">
                            @if($data['lang'] == "ar")
                                تم أنشاء اجتماع للمقابلة الشخصية على منصة زوم لاستكمال تفعيل الحساب الشخصي خاصتكم
                            @else
                                A personal interview meeting has been created on the Zoom platform to complete the
                                activation of your personal account
                            @endif
                        </p>
                        <p style="padding:0; margin:0 0 11pt 0;line-height:160%; font-size:18px;">
                            @if($data['lang'] == "ar")
                                رابط الاجتماع {{$data['interview']->join_url}}
                            @else
                                interview link {{$data['interview']->join_url}}
                            @endif
                        </p>
                        <p style="padding:0; margin:0 0 11pt 0;line-height:160%; font-size:18px;">
                            @if($data['lang'] == "ar")
                                يوم : {{ $data['interview']->interview_date }}
                            @else
                                interview date : {{ $data['interview']->interview_date }}
                            @endif
                        </p>
                        <p style="padding:0; margin:0 0 11pt 0;line-height:160%; font-size:18px;">
                            @if($data['lang'] == "ar")
                                الساعة : {{date('g:i a', strtotime($data['interview']->interview_time))}}
                            @else
                                at time :  {{date('g:i a', strtotime($data['interview']->interview_time))}}
                            @endif
                        </p>
                        <p style="padding:0; margin:11pt 0;line-height:160%; font-size:15px; font-style:italic;">
                        </p>
                        <a class="btn btn-primary" href="{{route('main_page')}}" target="_blank">
                            @if($data['lang'] == "ar") الصفحة الرئيسية للموقع  @else website main page @endif
                        </a>
                    </td>
                </tr>
                <tr>
                    <td bgcolor="#FFFFFF" style="padding:20px; background:#ffffff;background-color:#ffffff;"
                        valign="top">
                        <table cellpadding="0" cellspacing="0"
                               style="width: 100%; border-collapse:collapse; text-align:right; font-family:Tahoma; font-weight:normal; font-size:12px; line-height:15pt; color:#444444;">
                            <tr>

                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td valign="top" style="height:5px;margin:0;padding:0;line-height:0;">
                    </td>
                </tr>
                <!-- End of Letter Content -->

            </table>
        </td>
    </tr>
</table>
<!-- End of main container -->
</body>
</html>
