<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Models\Admin_notification;
use App\Models\Notification;
use App\Models\Teacher_request;
use App\Notifications\TeacherInterview;
use App\Notifications\VerfiyRegister;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Models\Teacher_interview;
use Illuminate\Http\Request;
use App\Traits\ZoomJWT;
use App\Models\Teacher;
use Carbon\Carbon;

class RequestsController extends Controller
{

    public function index()
    {
        Admin_notification::where('readed', '0')->where('message_type', 'teacher_absence_request')->update(['readed' => '1']);
        $data = Teacher_request::orderBy('created_at','desc')->get();
        return view('admin.web_settings.teachers.requests.index', compact('data'));
    }

    public function change_status($id,$status)
    {
        $teacher_request = Teacher_request::find($id);
        $data = Teacher_request::whereId($id)->update(['status'=>$status]);

        //send notification to teacher panel
        $input_student['teacher_id'] = $teacher_request->teacher_id;
        $input_student['type'] = 'teacher';
        $input_student['message_type'] = 'teacher_request_absence';
        $input_student['title_ar'] = 'طلب الاستأذان';
        $input_student['title_en'] = 'Ask for permission';
        if($status == 'accepted'){
            $input_student['message_ar'] = 'تم الموافقه على طلب الاستأذان خاصتك';
            $input_student['message_en'] = 'Your permission request has been approved';
        }else{
            $input_student['message_ar'] = 'تم رفض طلب الاستأذان خاصتك';
            $input_student['message_en'] = 'Your permission request has been Rejected';
        }
        $notification = Notification::create($input_student);
        return redirect()->back();
    }

}
