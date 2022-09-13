<?php

namespace App\Http\Controllers;

use App\Models\Episode;
use App\Models\Episode_teacher;
use App\Models\SmsSetting;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    //    Uram sms
    public function Uram($Phone = null, $Message = null)
    {
        $sms_settings = SmsSetting::first();
        $ch = curl_init();
        $url = "http://basic.unifonic.com/rest/SMS/messages";
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, "AppSid=su7G9tOZc6U0kPVnoeiJGHUDMKe8tp&Body=" . $Message . "&SenderID=uramIT SA&Recipient=" . $Phone . "&encoding=UTF8&responseType=json"); // define what you want to post
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $output = curl_exec($ch);
        curl_close($ch);
        return $output ;
    }
//    yamamah sms
    public function SendSMS($Phone = null, $Message = null)
    {
        $sms_settings = SmsSetting::first();
        $data1 = [
            'Username' => $sms_settings->user_id,
            'Password' => $sms_settings->password,
            'Tagname' => $sms_settings->encoding,
            'RecepientNumber' => $Phone,
            'SendDateTime' => '0',
            'EnableDR' => false,
            'Message' => $Message,
        ];

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => "http://api.yamamah.com/SendSMSV3",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "POST",
            CURLOPT_POSTFIELDS => json_encode($data1),
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response ;
    }


    public function teacherEpisodes_id($teacher_id)
    {
        $student_episodes = Episode::where('teacher_id', $teacher_id)->where('deleted','0')->where('active', 'y')->pluck('id')->toArray();
        $additional = Episode_teacher::where('teacher_id', $teacher_id)->get();
        if ($additional->count() > 0) {
            foreach ($additional as $episode) {
                array_push($student_episodes, $episode->episode_id);
            }
        }
        return $student_episodes;
    }
}
