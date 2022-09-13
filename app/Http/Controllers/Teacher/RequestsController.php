<?php

namespace App\Http\Controllers\Teacher;
use App\Models\Admin_notification;
use App\Models\Notification;
use App\Models\Student;
use App\Models\Teacher_request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Alkoumi\LaravelHijriDate\Hijri;
use Illuminate\Http\Request;
use App\Models\Teacher;

class RequestsController extends Controller
{

    public function index()
    {
        $id =auth::guard('teacher')->user()->id;
        $data = Teacher_request::where('teacher_id',$id)->orderBy('created_at','desc')->get();

        $update_data['readed'] = '1';
        Notification::where('teacher_id',$id)->where('message_type', 'teacher_request_absence')->where('readed', '0')->update($update_data);
        return view('teacher.requests.index',compact('data'));
    }

    public function store(Request $request)
    {
        $input = $this->validate(\request(),
            [
                'note' => 'required',
                'request_date' => 'required|date|after:'.Carbon::now()
            ]);
        $input['teacher_id'] = auth::guard('teacher')->user()->id;
        Teacher_request::create($input);
        //send notification to admin panel
        $data_notify['teacher_id'] =  auth::guard('teacher')->user()->id;
        $data_notify['type'] = 'teacher';
        $data_notify['message_type'] = 'teacher_absence_request';
        $data_notify['title_ar'] = 'طلب غياب بعزر للمعلم';
        $data_notify['title_en'] = 'Request the absence for the teacher with excuse';
        $data_notify['message_ar'] = 'تم اضافة طلب عزر غياب للمعلم  -  ' . auth::guard('teacher')->user()->user_name;
        $data_notify['message_en'] = 'A teacher\'s absence excuse request has been added to -' . auth::guard('teacher')->user()->user_name;
        Admin_notification::create($data_notify);
        Alert::success(trans('s_admin.absense_permission'), trans('s_admin.added_s'));
        return back();
    }

}
