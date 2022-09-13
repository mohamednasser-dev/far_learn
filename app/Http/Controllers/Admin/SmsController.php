<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin_notification;
use App\Models\Episode;
use App\Models\Notification;
use App\Models\Sms_message;
use App\Models\SmsSetting;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Model_has_role;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class SmsController extends Controller
{


    public function index()
    {
        $sms_settings = SmsSetting::first();
        return view('admin.sms.index', compact('sms_settings'));
    }

    public function create()
    {

        $students = $this->getStudentsData();
        $teachers = $this->getTeachersData();

        return view('admin.sms.create', compact('students','teachers'));
    }

    private function getStudentsData()
    {
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {//مدير المجمع
            $episodes = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
            $episode_ids = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->pluck('id')->toArray();
            return Student::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 6) {//مديرة المجمعات
            $episodes = Episode::where('type', 'mogmaa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            $episodes = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
            $episode_ids = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->pluck('id')->toArray();
            return Student::where('epo_type', 'dorr')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 7) {//مديرة الدور النسائية
            $episodes = Episode::where('type', 'dorr')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('epo_type', 'dorr')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 2) {//مديرة النظام
            $episodes = Episode::where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('is_new', 'accepted')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 8) {//مسئول المقرأة
            $episodes = Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('gender', $user->gender)->where('epo_type', 'far_learn')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('user_name', 'asc')->get();
        } else {
            $episodes = [];
            return [];
        }
    }
    private function getTeachersData()
    {
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {//مدير المجمع
            $episodes = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
            $episode_ids = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->pluck('id')->toArray();
            return Teacher::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 6) {//مديرة المجمعات
            $episodes = Episode::where('type', 'mogmaa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Teacher::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            $episodes = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
            $episode_ids = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->pluck('id')->toArray();
            return Teacher::where('epo_type', 'dorr')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 7) {//مديرة الدور النسائية
            $episodes = Episode::where('type', 'dorr')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Teacher::where('epo_type', 'dorr')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 2) {//مديرة النظام
            $episodes = Episode::where('deleted', '0')->orderBy('id', 'desc')->get();
            return Teacher::where('is_new', 'accepted')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 8) {//مسئول المقرأة
            $episodes = Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Teacher::where('gender', $user->gender)->where('epo_type', 'far_learn')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('user_name', 'asc')->get();
        } else {
            $episodes = [];
            return [];
        }
    }
    public function store(Request $request)
    {
        $data = $request->all();
        $validator = Validator::make($data, [
            'message' => 'required',
//            'receiver_type' => 'required',
            'student_receiver_id' => '',
            'teacher_receiver_id' => '',
        ]);
        //generate phone number
        if($request->type == 'student'){
            $target = Student::find($request->student_receiver_id);
            $receiver_id= $request->student_receiver_id;

        }else{
            $target = Teacher::find($request->teacher_receiver_id);
            $receiver_id = $request->teacher_receiver_id;
        }
        $phone = $target->country_code . $target->phone;
//        $phone = "+201095187616";
        $result = $this->SendSMS($phone, $request->message);
        unset($data['type']);

        $data['message'] = $request->message;
        $data['receiver_id'] = $receiver_id ;
        $data['receiver_type'] = $request->type;
        Sms_message::create($data);

        Alert::success(trans('s_admin.success'), trans('s_admin.sent_s'));
        return redirect()->back();
    }

    public function update(Request $request)
    {
        $validator = Validator::make($request->all(), [

            'url' => 'required',
            'encoding' => 'required',
            'encoding_value' => 'required',
            'user_id' => 'required',
            'user_id_value' => 'required',
            'to' => 'required',
            'password' => 'required',
            'password_value' => 'required',
            'msg' => 'required',
            'sender' => 'required',
            'sender_value' => 'required',

        ]);

        $sms_settings = SmsSetting::first();
        $sms_settings->url = $request->url;
        $sms_settings->encoding = $request->encoding;
        $sms_settings->encoding_value = $request->encoding_value;
        $sms_settings->user_id = $request->user_id;
        $sms_settings->user_id_value = $request->user_id_value;
        $sms_settings->to = $request->to;
        $sms_settings->password = $request->password;
        $sms_settings->password_value = $request->password_value;
        $sms_settings->msg = $request->msg;
        $sms_settings->sender = $request->sender;
        $sms_settings->sender_value = $request->sender_value;

        $sms_settings->save();
        Alert::success(trans('s_admin.success'), "تم التعديل بنجاح! ");

        return redirect()->back();
    }

}
