<?php

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

if (!function_exists('settings')) {
    function settings()
    {
        return App\Models\Web_setting::orderBy('id', 'desc')->first();
    }
}


if (!function_exists('sendResponse')) {
    function sendResponse($code = null, $msg = null, $data = null)
    {
        return response(
            [
                'code' => $code,
                'msg' => $msg,
                'data' => $data
            ]
        );
    }
}
if (!function_exists('validationErrorsToString')) {
    function validationErrorsToString($errArray)
    {
        $valArr = array();
        foreach ($errArray->toArray() as $key => $value) {
            $errStr = $value[0];
            array_push($valArr, $errStr);
        }
        return $valArr;
    }
}
if (!function_exists('makeValidate')) {
    function makeValidate($inputs, $rules)
    {
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            return validationErrorsToString($validator->messages());
        } else {
            return true;
        }
    }
}

if (!function_exists('checkLang')) {
    function checkLang()
    {
        if (!isset(getallheaders()['lang'])) {
            return response()->json(['status' => 401, 'msg' => 'The language is Required']);
        }
    }
}

if (!function_exists('check_api_token')) {
    function check_api_token($api_token)
    {
        if ($api_token == null) {
            return null;
        }
        $student = \App\Models\Student::where("api_token", $api_token)->first();
        if ($student) {
            $student->type = 'student';
            return $student;
        } else {
            $teacher = \App\Models\Teacher::where("api_token", $api_token)->first();
            if ($teacher) {
                $teacher->type = 'teacher';
                return $teacher;
            } else {
                return null;
            }
        }
    }
}

if (!function_exists('msgdata')) {

    function msgdata($request, $status, $key, $data)
    {
        $output['status'] = $status;
        $output['msg'] = $key;
        $output['data'] = $data;

        return $output;
    }
}

if (!function_exists('msg')) {

    function msg($request, $status, $key)
    {
        $msg['status'] = $status;
        $msg['msg'] = $key;

        return $msg;
    }
}


//nasser code

if (!function_exists('sms')) {
    function sms($mobile_num, $message)
    {
        $sms_setting = App\Models\SmsSetting::first();
        $ch = curl_init();
        $url = $sms_setting->url;
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $sms_setting->user_id . "=" . $sms_setting->user_id_value . "&" . $sms_setting->msg . "=" . $message . "&" . $sms_setting->sender . "=" . $sms_setting->sender_value . "&" . to . "=" . $mobile_num . "&" . $sms_setting->encoding . "=" . $sms_setting->encoding_value . "&responseType=json"); // define what you want to post
        //  curl_setopt($ch, CURLOPT_POSTFIELDS, "userid=fetoh@koof-ksa.com&password=fetoh000000&msg=".$Message."&sender=ALKHALIL-GR&to=".$user->phone."&encoding=UTF8"); // define what you want to post
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
    }
}

if (!function_exists('send_notification')) {
    function send_notification($title, $body, $type, $image = null, $token)
    {
        $path_to_fcm = 'https://fcm.googleapis.com/fcm/send';
        $server_key = "AAAARyigH8w:APA91bGds9X9PvFu48vdjQCylg4_anNwett2E8N_r34tn6a2dK0VqcErw5jQLyY5PoBWN-i2cxhk6FEFPT8J00hg8LAI4_SiVUhI-bdhGq5tdR7P1H6ABJhsZNUlu4kjMUgpFFluppdV";
        $headers = array(
            'Authorization:key=' . $server_key,
            'Content-Type:application/json'
        );
        $fields = array('registration_ids' => $token,
            'notification' => array('title' => $title, 'body' => $body, 'image' => $image));
        $payload = json_encode($fields);
        $curl_session = curl_init();
        curl_setopt($curl_session, CURLOPT_URL, $path_to_fcm);
        curl_setopt($curl_session, CURLOPT_POST, true);
        curl_setopt($curl_session, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl_session, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($curl_session, CURLOPT_IPRESOLVE, CURLOPT_IPRESOLVE);
        curl_setopt($curl_session, CURLOPT_POSTFIELDS, $payload);
        $result = curl_exec($curl_session);
        curl_close($curl_session);
        dd($result);
        return $result;
    }
}
if (!function_exists('send')) {

    function send($tokens, $title = "رسالة جديدة", $msg = "رسالة جديدة فى البريد", $type = 'mail', $id = null)
    {
        $key = "AAAARyigH8w:APA91bGds9X9PvFu48vdjQCylg4_anNwett2E8N_r34tn6a2dK0VqcErw5jQLyY5PoBWN-i2cxhk6FEFPT8J00hg8LAI4_SiVUhI-bdhGq5tdR7P1H6ABJhsZNUlu4kjMUgpFFluppdV";
        $fields = array
        (
            "registration_ids" => (array)$tokens,  //array of user token whom notification sent to
            "priority" => 10,
            'data' => [
                'title' => $title,
                'body' => strip_tags($msg),
                'id' => $id,
                'type' => $type,
                'icon' => 'myIcon',
                'sound' => 'mySound',
            ],
            'notification' => [
                'title' => $title,
                'body' => strip_tags($msg),
                'id' => $id,
                'type' => $type,
                'icon' => 'myIcon',
                'sound' => 'mySound',
            ],
            'vibrate' => 1,
            'sound' => 1
        );

        $headers = array
        (
            'accept: application/json',
            'Content-Type: application/json',
            'Authorization: key=' . $key
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send');
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
        $result = curl_exec($ch);


        if ($result === FALSE) {
            die('Curl failed: ' . curl_error($ch));
        }

        curl_close($ch);
        return $result;
    }
}


//End nasser code
if (!function_exists('success')) {
    function success()
    {
        return 200;
    }
}
if (!function_exists('failed')) {
    function failed()
    {
        return 401;
    }
}
if (!function_exists('not_authoize')) {
    function not_authoize()
    {
        return 403;
    }
}
if (!function_exists('not_acceptable')) {
    function not_acceptable()
    {
        return 406;
    }
}
if (!function_exists('not_found')) {
    function not_found()
    {
        return 404;
    }
}
if (!function_exists('not_active')) {
    function not_active()
    {
        return 405;
    }
}


