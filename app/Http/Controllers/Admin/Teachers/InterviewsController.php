<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Models\Notification;
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

class InterviewsController extends Controller
{
    use ZoomJWT;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;
    public function index()
    {
        $data = Teacher_interview::all();
        return view('admin.web_settings.teachers.interview.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $today = Carbon::now();
        $input = $this->validate(\request(),
            [
                'interview_date' => 'required',
                'interview_time' => 'required',
            ]);

        $data['teacher_id'] = $request->teacher_id;

        $startTime = strtotime($request->interview_date);
        $start_date = date("Y-m-d", $startTime);
        $data['interview_date'] = $start_date;

        $final_from = date("H:i", strtotime($request->interview_time));
        $data['interview_time'] = $final_from;

        $start = $start_date . ' ' . $final_from;
        $final_Start = date("Y-m-d H:i", strtotime($start));
        $data['selected_date'] = $final_Start;

        //Begin create zoom link ....
        $path = 'users/me/meetings';
        $response = $this->zoomPost($path, [
            'topic' => 'teacher interview',
            'type' => self::MEETING_TYPE_SCHEDULE,
            'start_time' => $this->toZoomTimeFormat($final_Start),
            'duration' => 30,
            'agenda' => $final_from,
            'settings' => [
                'host_video' => false,
                'participant_video' => false,
                'waiting_room' => true,
            ]
        ]);
        $data['meeting_id'] = $response['id'] ;
        $data['passcode'] = $response['password'] ;
        $data['join_url'] = $response['join_url'] ;

//        $data['meeting_id'] = '111153' ;
//        $data['passcode'] = 'fhs2577' ;
//        $data['join_url'] = 'https://us04web.zoom.us/j/74228831150?pwd=RjBJVnlORkdBYysvakxYYVlWZXYwQT09' ;
        $data['topic'] = 'teacher interview' ;
        $data['start_time'] = $final_Start;
        $data['agenda'] = $final_from ;

        $interview = Teacher_interview::create($data);
        $teacher = Teacher::find($request->teacher_id);
        $email  = $teacher->email ;

        //send notification to teacher panel
        $input_student['teacher_id'] = $request->teacher_id;
        $input_student['type'] = 'teacher';
        $input_student['message_type'] = 'teacher_zoom';
        $input_student['title_ar'] = 'مقابلة شخصية';
        $input_student['title_en'] = 'interview';
        $input_student['message_ar'] = 'تم تحديد موعد مقابلة شخصية يوم '.$start_date . ' الساعة '.$final_from;
        $input_student['message_en'] = 'An interview has been scheduled in '.$start_date . ' at '.$final_from;
        $notification = Notification::create($input_student);

        //send mail to teacher email
//        if($teacher->mail_lang == 'ar'){
//            Mail::raw(' تم أنشاء اجتماع للمقابلة الشخصية على منصة زوم لاستكمال تفعيل الحساب الشخصي خاصتكم'.'  رابط الموقع هنا : '. env('APP_URL').'teacher/home' , function ($message) use ($email) {
//                $message->subject(trans('s_admin.title'));
//                $message->from( env('MAIL_USERNAME') , 'online learning');
//                $message->to($email);
//            });
//        }else{
//            Mail::raw('A personal interview meeting has been created on the Zoom platform to complete the activation of your personal account  Website link here:  '. env('APP_URL').'teacher/home' , function ($message) use ($email) {
//                $message->subject(trans('s_admin.web_title_en'));
//                $message->from( env('MAIL_USERNAME') , 'online learning');
//                $message->to($email);
//            });
//        }

        //mailHere
        $email = $request->email;
        $data_verify['interview'] = $interview;
        $data_verify['type'] = "teacher";
        $data_verify['email'] = $email;
        $data_verify['lang'] = $teacher->main_lang;
        $teacher->notify(new TeacherInterview($data_verify));

        Alert::success(trans('s_admin.interview'), trans('s_admin.interview_created'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data = Teacher::find($id);
        $teacher_interview = Teacher_interview::where('teacher_id',$id)->first();
        return view('admin.web_settings.teachers.interview.create', compact('data','teacher_interview'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function zoom_room($id)
    {
        //zoom_room
        $data = Teacher_interview::whereId($id)->first();
        return view('admin.web_settings.teachers.interview.zoom_room',compact('data'));
    }

    public function zoom($id)
    {
        //zoom_room
        $data = Teacher_interview::whereId($id)->first();
        return view('teacher.episodes.zoom',compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $input = $this->validate(\request(),
            [
                'interview_date' => 'required',
                'interview_time' => 'required',
            ]);

        $startTime = strtotime($request->interview_date);
        $start_date = date("Y-m-d", $startTime);
        $data['interview_date'] = $start_date;

        $final_from = date("H:i", strtotime($request->interview_time));
        $data['interview_time'] = $final_from;

        $start = $start_date . ' ' . $final_from;
        $final_Start = date("Y-m-d H:i", strtotime($start));
        $data['selected_date'] = $final_Start;

        //Begin create zoom link ....
        $path = 'users/me/meetings';
        $response = $this->zoomPost($path, [
            'topic' => 'teacher interview',
            'type' => self::MEETING_TYPE_SCHEDULE,
            'start_time' => $this->toZoomTimeFormat($final_Start),
            'duration' => 30,
            'agenda' => $final_from,
            'settings' => [
                'host_video' => false,
                'participant_video' => false,
                'waiting_room' => true,
            ]
        ]);
        $data['meeting_id'] = $response['id'] ;
        $data['passcode'] = $response['password'] ;
        $data['join_url'] = $response['join_url'] ;
        $data['topic'] = 'teacher interview' ;
        $data['start_time'] = $final_Start;
        $data['agenda'] = $final_from ;

        Teacher_interview::where('id',$id)->update($data);

        Alert::success(trans('s_admin.interview'), trans('s_admin.interview_edited'));
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Teacher_interview::where('id',$id)->delete();
        Alert::success(trans('s_admin.success_operation'), trans('s_admin.deleted_s'));
        return back();
    }
}
