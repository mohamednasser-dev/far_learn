<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Resources\AbsenceRequestsResource;
use App\Http\Controllers\Controller;
use App\Models\Admin_notification;
use App\Models\Episode_section;
use App\Models\Episode_student;
use App\Models\Plan_section_degree;
use App\Models\Student;
use App\Models\Student_attendance;
use App\Models\Student_Questions_episode;
use App\Models\Teacher_request;
use App\Models\Notification;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;

class AbsenceRequestsController extends Controller
{
    public function index(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {
            $id = $user->id;
            $data = Teacher_request::where('teacher_id', $id)->orderBy('created_at','desc')->paginate(10);
            $data = AbsenceRequestsResource::collection($data)->response()->getData(true);

            $update_data['readed'] = '1';
            Notification::where('teacher_id', $id)->where('message_type', 'teacher_request_absence')->where('readed', '0')->update($update_data);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function store(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {
            $data = $request->all();
            $rules = [
                'note' => 'required',
                'request_date' => 'required|date|after:'.Carbon::now()
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(msg($request, not_found(), $validator->messages()->first()));
            }
            $data['teacher_id'] = $user->id;
            Teacher_request::create($data);
            //send notification to admin panel
            $data_notify['teacher_id'] =  $user->id;
            $data_notify['type'] = 'teacher';
            $data_notify['message_type'] = 'teacher_absence_request';
            $data_notify['title_ar'] = 'طلب غياب بعزر للمعلم';
            $data_notify['title_en'] = 'Request the absence for the teacher with excuse';
            $data_notify['message_ar'] = 'تم اضافة طلب عزر غياب للمعلم  -  ' . $user->user_name;
            $data_notify['message_en'] = 'A teacher\'s absence excuse request has been added to -' . $user->user_name;
            Admin_notification::create($data_notify);
            return msgdata($request, success(), trans('s_admin.added_s'),  (object)[]);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }
}
