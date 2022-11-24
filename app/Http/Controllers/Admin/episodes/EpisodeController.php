<?php

namespace App\Http\Controllers\Admin\episodes;

use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Episode_restart_request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Models\Episode_course_days;
use App\Models\Plan\Plan_revision;
use App\Models\Plan\Plan_tracomy;
use App\Models\Academic_semester;
use App\Models\Plan_episode_day;
use App\Models\Episode_reading;
use App\Models\Episode_request;
use App\Models\Episode_section;
use App\Models\Episode_student;
use App\Models\Episode_teacher;
use App\Models\Plan\Plan_week;
use App\Models\Subject_level;
use App\Models\Plan\Plan_new;
use App\Models\Notification;
use Illuminate\Http\Request;
use App\Models\Episode_day;
use Carbon\CarbonPeriod;
use App\Models\Episode;
use App\Models\Student;
use App\Models\Subject;
use App\Traits\ZoomJWT;
use App\Models\day;
use Carbon\Carbon;
use Exception;

class EpisodeController extends Controller
{
    use ZoomJWT;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function index($type)
    {
        $user = \auth()->user();
        if ($user->role_id == 6) {
            $data = [object()];
        } elseif ($user->role_id == 7) {
            $data = [object()];
        } elseif ($user->role_id == 8) {
            $data = Episode::where('gender', $user->gender)->where('type', $type)->where('deleted', '0')->orderBy('id', 'desc')->get();
        } else {
            $data = Episode::where('type', $type)->where('deleted', '0')->orderBy('id', 'desc')->get();
        }
        return view('admin.episodes.index', compact('data'));
    }

    public function restart_episode()
    {
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {
            $episode_ids = Episode::where('college_id', $user->college_id)->where('active', 'y')->where('type', 'mogmaa')->pluck('id')->toArray();
            $section_ids = Episode_section::whereIn('episode_id', $episode_ids)->pluck('id')->toArray();
            $data = Episode_restart_request::whereIn('section_id', $section_ids)->orderBy('created_at', 'desc')->get();
        } elseif ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) {
            $episode_ids = Episode::where('college_id', $user->college_id)->where('active', 'y')->where('type', 'dorr')->pluck('id')->toArray();
            $section_ids = Episode_section::whereIn('episode_id', $episode_ids)->pluck('id')->toArray();
            $data = Episode_restart_request::whereIn('section_id', $section_ids)->orderBy('created_at', 'desc')->get();
        } else {
            $data = Episode_restart_request::orderBy('created_at', 'desc')->get();
        }
        return view('admin.episodes.restart_epo_requests', compact('data'));
    }

    public function change_status(Request $request)
    {
        $data['active'] = $request->status;
        Episode::where('id', $request->id)->update($data);
        return 1;
    }

    public function conect_subject_plan()
    {
        $data = Episode::where('deleted', '0')->orderBy('id', 'desc')->get();
        return view('admin.episodes.conect_to_subject_plan.index', compact('data'));
    }

    public function store_plan_new(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'plan_id' => 'required',
                'plan_type' => 'required',
                'episode_id' => 'required',
                'section_date' => 'required'
            ]);
        $epo = Episode::findOrFail($request->episode_id);
        $s_date = $request->section_date;
        $s_Time = $epo->time_from;
        $start = $s_date . ' ' . $s_Time;
        $final_Start = date("Y-m-d H:i", strtotime($start));
        $final_Start_carbon = Carbon::createFromFormat('Y-m-d H:i', $final_Start);
        $data['started_at'] = $final_Start;
        //add 10 minutes to start date to notify students
        $notify_at = $final_Start_carbon->subMinute(10);
        $startTime = strtotime($request->section_date);
        $start_date = date("Y-m-d", $startTime);
        $data['section_date'] = $start_date;
        $data['notify_at'] = $notify_at;
        Plan_episode_day::create($data);
        Alert::success(trans('s_admin.daily_plan'), trans('admin.addedsuccess'));
        return back();
    }

    public function store_week(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required'
            ]);
        Plan_week::create($data);
        Alert::success(trans('s_admin.add_new_week'), trans('s_admin.added_s'));
        return back();
    }

    public function delete_course_day($id)
    {
        Episode_course_days::where('id', $id)->delete();
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }

    public function store_course_day(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'date' => 'required',
                'episode_id' => 'required',
                'week_id' => 'required',
                'day_id' => 'required'
            ]);
        $epo = Episode::find($request->episode_id);
        //if date selected no
        $startTime = strtotime($request->date);
        $start_date = date("Y-m-d", $startTime);
        $exist_curent_daydate = Episode_course_days::where('episode_id', $request->episode_id)->where('week_id', $request->week_id)->where('day_id', $request->day_id)->first();
        if ($exist_curent_daydate) {
            Alert::error(trans('s_admin.not_added'), trans('s_admin.day_exist_befor'));
            return back();
        }
        $exist_date = Episode_course_days::where('episode_id', $request->episode_id)->where('date', $start_date)->first();
        if ($exist_date == null) {
            $course_data = new Episode_course_days;
            $course_data->date = $start_date;
            $course_data->episode_id = $request->episode_id;
            $course_data->week_id = $request->week_id;
            $course_data->day_id = $request->day_id;
            //to generate starting date ...
            $s_Time = $epo->time_from;
            $start = $start_date . ' ' . $s_Time;
            $final_Start = date("Y-m-d H:i", strtotime($start));
            $final_Start_carbon = Carbon::createFromFormat('Y-m-d H:i', $final_Start);
            $course_data->started_at = $final_Start;
            //add 10 minutes to start date to notify students
            $notify_at = $final_Start_carbon->subMinute(10);
            $course_data->notify_at = $notify_at;
            $course_data->save();
        } else {
            Alert::error(trans('s_admin.not_added'), trans('s_admin.there_day_befor'));
            return back();
        }
        Alert::success(trans('s_admin.add'), trans('s_admin.added_s'));
        return back();
    }

    public function update_plan_new(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'id' => 'required',
                'section_date' => 'required'
            ]);
        $plan_epo_day = Plan_episode_day::findOrFail($request->id);
        $s_date = $request->section_date;
        $s_Time = $plan_epo_day->Episode->time_from;
        $start = $s_date . ' ' . $s_Time;
        $final_Start = date("Y-m-d H:i", strtotime($start));
        $final_Start_carbon = Carbon::createFromFormat('Y-m-d H:i', $final_Start);
        $data['started_at'] = $final_Start;
        //add 10 minutes to start date to notify students
        $notify_at = $final_Start_carbon->subMinute(10);
        $startTime = strtotime($request->section_date);
        $selected_date = date("Y-m-d", $startTime);
        $result['section_date'] = $selected_date;
        $data['notify_at'] = $notify_at;
        Plan_episode_day::findOrFail($request->id)->update($result);
        Alert::success(trans('s_admin.daily_plan'), trans('admin.updatSuccess'));
        return back();
    }

    public function show_plan($id)
    {
        $epo = Episode::find($id);
        $sub_level_id = $epo->subject_level_id;
        $new = Plan_new::where('sub_level_id', $sub_level_id)->orderBy('week_id', 'asc')->orderBy('day_id', 'asc')->paginate(15);
        $tracomy = Plan_tracomy::where('sub_level_id', $sub_level_id)->orderBy('week_id', 'asc')->orderBy('day_id', 'asc')->paginate(15);
        $revision = Plan_revision::where('sub_level_id', $sub_level_id)->orderBy('week_id', 'asc')->orderBy('day_id', 'asc')->paginate(15);
        return view('admin.episodes.conect_to_subject_plan.view_episode_plan', compact('revision', 'tracomy', 'new', 'sub_level_id', 'epo'));
    }

    public function create()
    {

        return view('admin.episodes.index_create');
    }

    public function create_mqraa()
    {
        return view('admin.episodes.college.create');
    }

    public function index_create_mogmaa()
    {
        return view('admin.episodes.index_create_mogmaa');
    }

    public function create_dorr()
    {
        return view('admin.episodes.college.create');
    }

    public function store_dorr(Request $request, $type)
    {
        $data = $this->validate(\request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'level_id' => '',
                'gender' => '',
                'student_number' => 'required',
                'listen_type' => 'required',
                'active' => 'required',
                'time_from' => 'required',
                'time_to' => 'required',
                'academic_semesters_id' => 'required'
            ]);
        $sematric = Academic_semester::where('id', $request->academic_semesters_id)->first();
        $data['start_date'] = $sematric->from;
        $data['end_date'] = $sematric->to;
        $startTime = strtotime($sematric->from);
        $start_date = date("Y-m-d", $startTime);

        $data['start_date'] = $start_date;
//        $data['active'] = 'n';
        if ($type == 'dorr') {
            $data['college_id'] = $request->college_id;
        } else {
            $data['college_id'] = $request->college_id;
        }
        $data['type'] = $type;
        $final_from = date("H:i", strtotime($request->time_from));
        $final_to = date("H:i", strtotime($request->time_to));
        if($final_from > $final_to){
            Alert::success('تحذير', 'يجب اختيار وقت الحلقة الى اكبر من وقت الحلقة من');
            return back();
        }
        $data['time_from'] = $final_from;
        $data['time_to'] = $final_to;
        if ($request->cost == 'free') {
            $data['cost'] = 'free';
        } else if ($request->cost == 'not_free') {
            $data['cost'] = $request->money;
        }
        //Begin create zoom link ....
        $path = 'users/me/meetings';
        $response = $this->zoomPost($path, [
            'topic' => $request->name_ar,
            'type' => self::MEETING_TYPE_SCHEDULE,
            'start_time' => $this->toZoomTimeFormat(Carbon::now()),
            'duration' => 30,
            'agenda' => $final_from,
            'settings' => [
                'host_video' => false,
                'participant_video' => false,
                'waiting_room' => true,
            ]
        ]);
        $data['meeting_id'] = $response['id'];
        $data['passcode'] = $response['password'];
        $data['join_url'] = $response['join_url'];
        $data['topic'] = $request->name_ar;
        $data['start_time'] = Carbon::now();
        $data['agenda'] = $final_from;
        $data['teacher_link'] = $response['join_url'];
        //End create zoom link ....
        $episode = Episode::create($data);
        $days = [];
        if ($request->days != null) {
            foreach ($request->days as $day) {
                $day_data['day_id'] = $day;
                $day_data['episode_id'] = $episode->id;
                Episode_day::create($day_data);
                $days[] = day::find($day)->name_en;
            }
        }
        if ($request->readings != null) {
            foreach ($request->readings as $reading) {
                $day_read['reading_id'] = $reading;
                $day_read['episode_id'] = $episode->id;
                Episode_reading::create($day_read);
            }
        }
        $period = CarbonPeriod::create($sematric->from, $sematric->to);
        // Iterate over the period
        $week = 1;
        $day = 1;
        foreach ($period as $dt) {
            if (in_array($dt->format("l"), $days)) {
                $course_data = new Episode_course_days;
                $course_data->date = $dt->format("Y-m-d");
                $course_data->episode_id = $episode->id;
                $course_data->week_id = $week;
                $course_data->day_id = $day;
                //to generate starting date ...
                $s_date = $dt->format("Y-m-d");
                $s_Time = $episode->time_from;
                $start = $s_date . ' ' . $s_Time;
                $final_Start = date("Y-m-d H:i", strtotime($start));
                $final_Start_carbon = Carbon::createFromFormat('Y-m-d H:i', $final_Start);
                $course_data->started_at = $final_Start;
                //add 10 minutes to start date to notify students
                $notify_at = $final_Start_carbon->subMinute(10);
                $course_data->notify_at = $notify_at;
                $course_data->save();
                if ($day == count($days)) {
                    $day = 1;
                    $week = $week + 1;
                } else {
                    $day = $day + 1;
                }
            }
        }
        Alert::success(trans('admin.add'), trans('s_admin.episode_added'));
        return back();
    }

    public function get_subjects(Request $request, $id)
    {
        $data = Subject::where('level_id', $id)->get();
        return view('admin.episodes.parts.subjectOptions', compact('data'));
    }

    public function get_subject_levels(Request $request, $id)
    {
        $data = Subject_level::where('subject_id', $id)->get();
        return view('admin.episodes.parts.subject_levelsOptions', compact('data'));
    }

    public function show($id)
    {
        $data = Episode::where('deleted', '0')->where('type', $id)->orderBy('id', 'desc')->get();
        return view('admin.episodes.index', compact('data'));
    }

    public function details($id)
    {
        $data = Episode::find($id);
        return view('admin.episodes.details', compact('data'));
    }

    public function zoom_settings($id)
    {
        $data = Episode::find($id);
        if ($data->teacher_id != null) {
            return view('admin.episodes.zoom_settings', compact('data'));
        } else {
            Alert::warning(trans('s_admin.warning'), trans('s_admin.you_should_choose_teacher'));
            return back();
        }
    }

    public function episode_days($id)
    {
        $data = Episode_course_days::where('episode_id', $id)->paginate(15);
        $epo = Episode::find($id);
        return view('admin.episodes.episode_days', compact('data', 'epo'));
    }

    public function update_course_date(Request $request)
    {
        $course = Episode_course_days::where('id', $request->id)->first();
        $startTime = strtotime($request->section_date);
        $start_date = date("Y-m-d", $startTime);
        $data['date'] = $start_date;
        $exist_date = Episode_course_days::where('episode_id', $course->episode_id)->where('date', $start_date)->first();
        if ($exist_date == null) {
            //to generate starting date ...
            $s_date = $start_date;
            $s_Time = $course->Episode->time_from;
            $start = $s_date . ' ' . $s_Time;
            $final_Start = date("Y-m-d H:i", strtotime($start));
            $final_Start_carbon = Carbon::createFromFormat('Y-m-d H:i', $final_Start);
            $data['started_at'] = $final_Start;;
            //add 10 minutes to start date to notify students
            $notify_at = $final_Start_carbon->subMinute(10);
            $data['notify_at'] = $notify_at;
            Episode_course_days::where('id', $request->id)->update($data);
            Alert::success(trans('admin.update'), trans('s_admin.updated_s'));
            return back();
        } else {
            Alert::error(trans('s_admin.not_updated'), trans('s_admin.there_day_befor'));
            return back();
        }
    }

    public function join_request()
    {
        $data = Episode_request::where('status', 'new')->orderBy('created_at','desc')->get();
        $reject_data = Episode_request::where('status', 'rejected')->orderBy('created_at','desc')->get();
        return view('admin.episodes.far_learn.join_request', compact('data', 'reject_data'));
    }

    public function students($id)
    {
        $episode = Episode::find($id);
        $data = Episode_student::whereHas('Student')->where('deleted', '0')->where('episode_id', $id)->orderBy('created_at', 'desc')->get();
        return view('admin.episodes.episode_students', compact('data', 'episode'));
    }

    public function far_learn_change_status($type, $id)
    {
        $data['status'] = $type;
        $result = Episode_request::where('id', $id)->update($data);
        if ($type == 'accepted' && $result == 1) {
            $epo_request = Episode_request::find($id);
            $episode_basic = Episode::where('id', $epo_request->episode_id)->first();
            $student_basic = Student::where('id', $epo_request->student_id)->first();
            if (count($epo_request->Episode->Students) < $epo_request->Episode->student_number) {
                try {
                    $epo_student_data['student_id'] = $epo_request->student_id;
                    $epo_student_data['episode_id'] = $epo_request->episode_id;
                    $epo_student_data['student_view'] = '1';
                    Episode_student::create($epo_student_data);
                    $input_student['student_id'] = $epo_request->student_id;
                    $input_student['type'] = 'student';
                    $input_student['message_type'] = 'reject_epo_request';
                    $input_student['title_ar'] = 'طلب الانضمام لحلقة';
                    $input_student['title_en'] = 'request join episode';
                    $input_student['message_ar'] = 'تم قبولك فالحلقة - ' . $epo_request->Episode->name_ar;
                    $input_student['message_en'] = 'your request to join episode - ' . $epo_request->Episode->name_en . '- accepted';
                    $notification = Notification::create($input_student);
                    if ($notification != null) {
                        $email = $student_basic->email;
                        if ($student_basic->mail_lang == 'ar') {
                            Mail::raw('تم قبولك فى حلقة : ' . $episode_basic->title_ar . '  رابط الموقع هنا :  ' . env('APP_URL') . 'student/home', function ($message) use ($email) {
                                $message->subject(trans('s_admin.title'));
                                $message->from(env('MAIL_USERNAME'), 'online learning');
                                $message->to($email);
                            });

                        } else {
                            Mail::raw('You have been accepted into episode : ' . $episode_basic->title_en . '  Website link here:  ' . env('APP_URL') . 'student/home', function ($message) use ($email) {
                                $message->subject(trans('s_admin.web_title_en'));
                                $message->from(env('MAIL_USERNAME'), 'online learning');
                                $message->to($email);
                            });

                        }
                    }
                    Alert::success(trans('s_admin.episode'), trans('s_admin.student_accepted_s'));
                    return back();
                } catch (Exception $exception) {
                    Alert::success(trans('s_admin.episode'), trans('s_admin.student_accepted_s'));
                    return back();
                }
            } else {
                Alert::erorr(trans('s_admin.episode'), trans('s_admin.no_enght_place'));
                return back();
            }
        } else if ($type == 'rejected' && $result == 1) {
            $epo_request = Episode_request::find($id);
            $episode_basic = Episode::where('id', $epo_request->episode_id)->first();
            $student_basic = Student::where('id', $epo_request->student_id)->first();

            $input_student['student_id'] = $epo_request->student_id;
            $input_student['type'] = 'student';
            $input_student['message_type'] = 'reject_epo_request';
            $input_student['title_ar'] = 'طلب الانضمام لحلقة';
            $input_student['title_en'] = 'request join episode';
            $input_student['message_ar'] = 'لم يتم قبولك فالحلقة - ' . $epo_request->Episode->name_ar;
            $input_student['message_en'] = 'your request to join episode - ' . $epo_request->Episode->name_en . '- rejected';
            $notification = Notification::create($input_student);
            if ($notification != null) {
                $email = $student_basic->email;

                Mail::raw('تم رفضك فى حلقة : ' . $episode_basic->title_ar . '  رابط الموقع هنا :  ' . env('APP_URL') . 'student/home', function ($message) use ($email) {
                    $message->subject(trans('s_admin.title'));
                    $message->from(env('MAIL_USERNAME'), 'online learning');
                    $message->to($email);
                });
                $fcm_tokens[0] = $student_basic->fcm_token;
            }
            Alert::success(trans('s_admin.episode'), trans('s_admin.student_rejected_s'));
            return back();
        }
    }

    public function far_learn_restart_epo_change_status($type, $id)
    {
        $data['status'] = $type;
        $result = Episode_restart_request::where('id', $id)->update($data);
        $episode_restart_request = Episode_restart_request::find($id);

        if ($type == 'accepted' && $result == 1) {

            $epo_sec = Episode_section::find($episode_restart_request->section_id);
            $epo_sec->status = 'started';
            $epo_sec->save();
            $input_student['teacher_id'] = $episode_restart_request->teacher_id;
            $input_student['type'] = 'teacher';
            $input_student['message_type'] = 'restart_episode';
            $input_student['title_ar'] = 'طلب اعادة تشغيل الحلقة';
            $input_student['title_en'] = 'Request to replay the class';
            $input_student['message_ar'] = 'تم قبول طلبك في الحلقة - ' . $episode_restart_request->Section->Episode->name_ar;
            $input_student['message_en'] = 'Your request was accepted in the class - ' . $episode_restart_request->Section->Episode->name_en ;
            Notification::create($input_student);
            Alert::success(trans('s_admin.nav_restart_epo'), trans('s_admin.accepted_ss'));
            return back();
        } else if ($type == 'rejected' && $result == 1) {
            $input_student['teacher_id'] = $episode_restart_request->teacher_id;
            $input_student['type'] = 'teacher';
            $input_student['message_type'] = 'restart_episode';
            $input_student['title_ar'] = 'طلب اعادة تشغيل الحلقة';
            $input_student['title_en'] = 'Request to replay the class';
            $input_student['message_ar'] = 'لم يتم قبول طلبك في الحلقة - ' . $episode_restart_request->Section->Episode->name_ar;
            $input_student['message_en'] = 'Your request was not accepted in the class - ' . $episode_restart_request->Section->Episode->name_en ;
            Notification::create($input_student);
            Alert::success(trans('s_admin.nav_restart_epo'), trans('s_admin.rejected_ss'));
            return back();
        }
    }

    public function edit($id)
    {
        $data = Episode::find($id);
        return view('admin.episodes.edit', compact('data'));
    }

    public function update(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'name_ar' => 'required',
                'name_en' => 'required',
                'teacher_id' => '',
                'student_number' => 'required',
                'listen_type' => 'required',
                'active' => 'required',
                'time_from' => 'required',
                'time_to' => 'required'
            ]);
        $epo = Episode::find($request->id);

        if ($epo->type == 'dorr') {
            $data['college_id'] = $request->college_id;
            $data['gender'] = 'female';
        } else if ($epo->type == 'mqraa') {
            $data['gender'] = $request->gender;
        } else {
            $data['college_id'] = $request->college_id;
            $data['gender'] = 'male';
        }

        $final_from = date("H:i", strtotime($request->time_from));
        $final_to = date("H:i", strtotime($request->time_to));

        if($final_from > $final_to){
            Alert::success('تحذير', 'يجب اختيار وقت الحلقة الى اكبر من وقت الحلقة من');
            return back();
        }
        $data['time_from'] = $final_from;
        $data['time_to'] = $final_to;
        if ($request->cost == 'free') {
            $data['cost'] = 'free';
        } else if ($request->cost == 'not_free') {
            $data['cost'] = $request->money;
        }
        if ($request->teacher_id != null) {
            if ($request->teacher_id != $epo->teacher_id) {
                $data['teacher_view'] = 0;
            }
        }
        Episode::where('id', $request->id)->update($data);
        //Begin update episode course days ...
        $time_from =  date("H:i:s", strtotime($request->time_from));
        if ($time_from != $epo->time_from) {
            foreach ($epo->Dates as $row) {
                //to generate starting date ...
                $course_data = Episode_course_days::find($row->id);
                $s_Time = $epo->time_from;
                $start = $course_data->date . ' ' . $s_Time;
                $final_Start = date("Y-m-d H:i", strtotime($start));
                $final_Start_carbon = Carbon::createFromFormat('Y-m-d H:i', $final_Start);
                $course_data->started_at = $final_Start;
                //add 10 minutes to start date to notify students
                $notify_at = $final_Start_carbon->subMinute(10);
                $course_data->notify_at = $notify_at;
                $course_data->save();
            }
        }
        //End update Course Days
        Episode_day::where('episode_id', $request->id)->delete();
        if ($request->days != null) {
            foreach ($request->days as $day) {
                try {
                    $day_data['day_id'] = $day;
                    $day_data['episode_id'] = $request->id;
                    Episode_day::create($day_data);
                } catch (Exception $exception) {
                }
            }
        }
        Episode_reading::where('episode_id', $request->id)->delete();
        if ($request->readings != null) {
            foreach ($request->readings as $reading) {
                try {
                    $day_read['reading_id'] = $reading;
                    $day_read['episode_id'] = $request->id;
                    Episode_reading::create($day_read);
                } catch (Exception $exception) {
                }
            }
        }
        Alert::success(trans('s_admin.edit'), trans('s_admin.updated_s'));
        return back();
    }

    public function place_teacher(Request $request)
    {
        $epo = Episode::findOrFail($request->id);
        $epo->teacher_id = $request->teacher_id;
        $epo->save();
        Alert::success(trans('s_admin.place_teacher'), trans('s_admin.teacher_placed_s'));
        return back();
    }

    public function place_students(Request $request)
    {
        $epo = Episode::findOrFail($request->id);
        if (count($request->students) <= $epo->student_number) {
            foreach ($request->students as $row) {
                try {
                    $stud = Student::find($row);
                    $data['student_id'] = $row;
                    $data['episode_id'] = $request->id;
                    $data['level_id'] = $stud->level_id;
                    $data['subject_id'] = $stud->subject_id;
                    $data['subject_level_id'] = $stud->subject_level_id;
                    Episode_student::create($data);
                } catch (Exception $exception) {
                }
            }
            Alert::success(trans('s_admin.place_students'), trans('s_admin.student_placed_s'));
            return back();
        } else {
            Alert::success(trans('s_admin.warning'), trans('s_admin.student_num_not_contain'));
            return back();
        }
    }

    public function place_teachers(Request $request)
    {
        foreach ($request->teachers as $row) {
            try {
                $data['teacher_id'] = $row;
                $data['episode_id'] = $request->id;
                Episode_teacher::create($data);
            } catch (Exception $exception) {
            }
        }
        Alert::success(trans('s_admin.place_teachers'), trans('s_admin.place_teachers_s'));
        return back();
    }

    public function destroy($id)
    {
        $data['deleted'] = "1";
        $data['deleted_id'] = auth()->guard('web')->user()->id;
        Episode::where('id', $id)->update($data);
        $epo_students = Episode_student::where('episode_id', $id)->get();
        foreach ($epo_students as $row) {
            $data_epo_stud = Episode_student::find($row->id);
            $data_epo_stud->deleted = '1';
            $data_epo_stud->save();
        }
        Alert::success(trans('s_admin.success'), trans('s_admin.deleted_s'));
        return back();
    }
}
