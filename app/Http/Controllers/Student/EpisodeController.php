<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\Episode_rate_question;
use App\Models\Episode_section;
use App\Models\Episode_student;
use App\Models\Notification;
use App\Models\Plan\Plan_new;
use App\Models\Plan\Plan_revision;
use App\Models\Plan\Plan_tracomy;
use App\Models\Plan_episode_day;
use App\Models\Plan_section_degree;
use App\Models\Student;
use App\Models\Student_attendance;
use App\Models\Student_episode_rate;
use App\Models\Student_section_evaluation;
use App\Models\Student_teacher_rate;
use App\Models\Subject;
use App\Models\Subject_evaluation;
use App\Models\Subject_level;
use App\Models\Teacher;
use App\Models\Teacher_rate;
use App\Rate;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Http\Request;
use App\Models\Episode;
use Carbon\Carbon;
use App\Models\Student_Questions_episode;

class EpisodeController extends Controller
{
    public function validationErrorsToString($errArray)
    {
        $valArr = array();
        foreach ($errArray->toArray() as $key => $value) {
            $errStr = $value[0];
            array_push($valArr, $errStr);
        }
        return $valArr;
    }

    public function makeValidate($inputs, $rules)
    {
        $validator = Validator::make($inputs, $rules);
        if ($validator->fails()) {
            return $this->validationErrorsToString($validator->messages());
        } else {
            return true;
        }
    }

    public function create()
    {

    }

    public function Store_Student_Question_episode(Request $request)
    {
        $student_id = Auth::guard('student')->id();
        $mytime = Carbon::now();
        $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
        $section_data = Episode_section::where('epo_date', $today)->where('episode_id', $request->episode_id)->first();

        if ($section_data == null) {
            Alert::warning(trans('s_admin.warning'), trans('s_admin.day_ended'));
            return redirect(route('student.my_episodes'));
        }

        if ($request->from_surah_id > $request->to_surah_id) {
            Alert::warning(trans('s_admin.warning'), trans('s_admin.dont_added_becase_of_sorting_sura'));
            return redirect(route('student.my_episodes'));
        }
        if ($request->from_surah_id == $request->to_surah_id) {
            if ($request->from_num > $request->to_num) {
                Alert::warning(trans('s_admin.warning'), trans('s_admin.dont_added_becase_of_sorting_aya_sura'));
                return redirect(route('student.my_episodes'));
            }
        }

        $question_data['episode_id'] = $request->episode_id;
        $question_data['episode_course_id'] = $request->course_date_id;
        $question_data['from_surah_id'] = $request->from_surah_id;
        $question_data['from_num'] = $request->from_num;
        $question_data['to_surah_id'] = $request->to_surah_id;
        $question_data['to_num'] = $request->to_num;
        $question_data['student_id'] = $student_id;
        $created = Student_Questions_episode::create($question_data);
        if ($created) {
            //send firebase notification to teacher to know that student come
            $student_data = Student::findOrFail($student_id);
            send( $student_data->fcm_token ,'انضمام الحلقة' ,'تم انضمام الطالب '.$student_data->user_name.' للحلقة'  ,'student_join_episode'  , $request->episode_id);
           //end send
            $exist_attendance = Student_attendance::where('student_id', $student_id)->where('section_id', $section_data->id)->first();
            if ($exist_attendance == null) {

                //to create student attendance
//                    $data_attendance['student_id'] =$student_id;
//                    $data_attendance['episode_id'] =$request->episode_id;
//                    $data_attendance['section_id'] =$section_data->id;
//                    Student_attendance::create($data_attendance);


                //generate attendance persentage
                $student = Student::with('Attendance')->with('Absence')->whereId($student_id)->first();
                $attendance = count($student->Attendance);
                $absence = count($student->Absence);
                $total_days = $attendance + $absence;
                if ($total_days == 0) {
                    $persentage = 0;
                } else {
                    $persentage = ($attendance / $total_days) * 100;
                }
                $floatVal = floatval($persentage);
                // If the parsing succeeded and the value is not equivalent to an int
                if ($floatVal && intval($floatVal) != $floatVal) {
                    $persentage = number_format((float)$persentage, 1, '.', '');
                }
                $student->attendance_rate = $persentage;
                $student->save();

                //generate epo attendance
                $episode_student = Episode_student::where('student_id', $student_id)->where('episode_id', $request->episode_id)->first();

                $epo_attendance = Student_attendance::where('episode_id', $request->episode_id)->where('student_id', $student_id)->get()->count();

                $episode_id = $request->episode_id;
                $section_ids = Episode_section::where('episode_id', $episode_id)->get()->pluck('id')->toArray();
                $epo_absence = Plan_section_degree::where('student_id', $student_id)->whereIn('section_id', $section_ids)->where('type', 'absence')->get()->count();

                $total_days = $epo_attendance + $epo_absence;
                if ($total_days == 0) {
                    $persentage = 0;
                } else {
                    $persentage = ($epo_attendance / $total_days) * 100;
                }
                $floatVal = floatval($persentage);
                // If the parsing succeeded and the value is not equivalent to an int
                if ($floatVal && intval($floatVal) != $floatVal) {
                    $persentage = number_format((float)$persentage, 1, '.', '');
                }

                $episode_student->attendance_rate = $persentage;
                $episode_student->save();

                //to create student place in fifo
                $last_student = Episode_student::where('episode_id', $request->episode_id)->orderBy('order_num', 'desc')->first();
                $stud_epo = Episode_student::where('student_id', $student_id)->where('episode_id',$request->episode_id)->first();
                $stud_epo->order_num = $last_student->order_num + 1 ;
                $stud_epo->save();
            }
        }
        return redirect('student/my_episodes/' . $request->episode_id);
    }

    public function show($id)
    {
        $data = Episode::where('active', 'y')->where('deleted', '0')->where('id', $id)->first();
        $rated_questions = Episode_rate_question::where('status', 'show')->where('deleted', '0')->orderBy('created_at', 'desc')->get();
        $mytime = Carbon::now();
        $stud_id = auth()->guard('student')->user()->id;
        $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
        $section_data = Episode_section::where('epo_date', $today)->where('episode_id', $id)->first();

        if ($section_data == null) {
            Alert::warning(trans('s_admin.warning'), trans('s_admin.day_ended'));
            return redirect(route('student.my_episodes'));
        }

        $exist_attendance = Student_attendance::where('student_id', $stud_id)->where('section_id', $section_data->id)->first();
        if ($exist_attendance == null) {
            //Begain generate attendance persentage
            $student = Student::with('Attendance')->with('Absence')->whereId($stud_id)->first();
            $attendance = count($student->Attendance);
            $absence = count($student->Absence);
            $total_days = $attendance + $absence;
            if ($total_days == 0) {
                $persentage = 0;
            } else {
                $persentage = ($attendance / $total_days) * 100;
            }
            $floatVal = floatval($persentage);
            // If the parsing succeeded and the value is not equivalent to an int
            if ($floatVal && intval($floatVal) != $floatVal) {
                $persentage = number_format((float)$persentage, 1, '.', '');
            }
            $student->attendance_rate = $persentage;
            $student->save();
            //End generate attendance ...

            $episode_student = Episode_student::where('student_id', $stud_id)->where('episode_id', $id)->first();
            $epo_attendance = Student_attendance::where('episode_id', $id)->where('student_id', $stud_id)->get()->count();
            $section_ids = Episode_section::where('episode_id', $id)->get()->pluck('id')->toArray();
            $epo_absence = Plan_section_degree::where('student_id', $stud_id)->whereIn('section_id', $section_ids)->where('type', 'absence')->get()->count();

            $total_days = $epo_attendance + $epo_absence;
            if ($total_days == 0) {
                $persentage = 0;
            } else {
                $persentage = ($epo_attendance / $total_days) * 100;
            }
            $floatVal = floatval($persentage);
            // If the parsing succeeded and the value is not equivalent to an int
            if ($floatVal && intval($floatVal) != $floatVal) {
                $persentage = number_format((float)$persentage, 1, '.', '');
            }

            $episode_student->attendance_rate = $persentage;
            $episode_student->save();
            //to create student place in fifo
            $last_student = Episode_student::where('episode_id', $id)->orderBy('order_num', 'desc')->first();
            $stud_epo = Episode_student::where('student_id', $stud_id)->where('episode_id', $id)->first();
            if ($stud_epo->order_num == 0) {
                $stud_epo->order_num = $last_student->order_num + 1;
                $stud_epo->save();
            }
        }
        if ($section_data->status == 'ended') {
            Alert::warning(trans('s_admin.warning'), trans('s_admin.epo_ended'));
            return redirect(route('student.my_episodes'));
        }
        $exist_degree = Plan_section_degree::where('rate_teacher', 2)->where('section_id', $section_data->id)->where('student_id', auth()->guard('student')->user()->id)->first();
        return view('student.episodes.start_episode', compact('data', 'section_data', 'exist_degree', 'rated_questions'));
    }

    public function edit($id)
    {
        //
    }

    public function my_episodes()
    {
        if (auth::guard('student')->user()->complete_data == '0') {
            Alert::warning(trans('s_admin.warning'), trans('s_admin.should_complete_data_first'));
            return redirect()->back();
        }
        $stud_id = auth::guard('student')->user()->id;
        $update_data['readed'] = '1';
        Notification::where('student_id', $stud_id)
            ->where('message_type', 'notify_start_epo')
            ->orWhere('message_type', 'reject_epo_request')
            ->where('readed', '0')
            ->update($update_data);
        $data = Episode_student::where('student_id', $stud_id)
            ->where('deleted', '0')
            ->has('Episode', '>', 0)
            ->get();
        $update_epo_data['student_view'] = '1';
        Episode_student::where('student_id', $stud_id)
            ->where('student_view', '0')
            ->update($update_epo_data);
        return view('student.episodes.my_episodes', compact('data'));
    }

    public function my_episode_degrees($id)
    {
        $sections = Episode_section::where('episode_id', $id)->select('id')->get()->toArray();
        $data = Plan_section_degree::where('student_id', auth::guard('student')->user()->id)
            ->wherein('section_id', $sections)
            ->orderBy('created_at', 'desc')
            ->get();
        return view('student.episodes.epo_degrees', compact('data'));
    }

    public function check_episode_start()
    {
        $student_id =  auth::guard('student')->user()->id ;
        $mytime = Carbon::now();
        $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
        $student_episodes = Episode_student::where('student_id',$student_id)->pluck('episode_id')->toArray();
        $section_today_count = Episode_section::whereIn('episode_id',$student_episodes)->where('status','started')->where('epo_date',$today)->get()->count();
        if($section_today_count > 0){
            return response(['status' => true, 'row' => $section_today_count]);
        }else{
            return response(['status' => false, 'row' => $section_today_count]);
        }
    }
    public function check_order_num($section_id)
    {
        $student_id =  auth::guard('student')->user()->id ;
        $mytime = Carbon::now();
        $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
        $section = Episode_section::where('id',$section_id)->where('status','started')->where('epo_date',$today)->first();
        $student_data_epo = Episode_student::where('episode_id',$section->episode_id)->where('student_id',$student_id)->first();

        $episode_order =  $section->order_num ;   //1
        $student_order = $student_data_epo->order_num;   //2

        if($episode_order == $student_order){
            return response(['status' => true, 'row' => $episode_order]);
        }else{
            return response(['status' => false, 'row' => $episode_order]);
        }
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function get_subjects(Request $request, $id)
    {
        $data = Subject::where('level_id', $id)->get();
        return view('student.profile.parts.subjects', compact('data'));
    }

    public function get_subject_levels(Request $request, $id)
    {
        $data = Subject_level::where('subject_id', $id)->get();
        return view('student.profile.parts.subject_levels', compact('data'));
    }

    public function make_rate(Request $request)
    {

        $student_id = auth()->guard('student')->user()->id;
        $exists_rate = Teacher_rate::where('student_id', $student_id)->where('teacher_id', $request->teacher_id)->first();
        if ($exists_rate == null) {
            if ($request->rating != null) {
                $data['student_id'] = $student_id;
                $data['teacher_id'] = $request->teacher_id;
                $data['rate'] = $request->rating;
                Teacher_rate::create($data);

                $total_rates = Teacher_rate::where('teacher_id', $request->teacher_id)->get();
                $sum_rates = $total_rates->sum('rate');
                $count_rates = count($total_rates);
                if ($count_rates == 0) {
                    $new_rate = 0;
                } else {
                    $new_rate = $sum_rates / $count_rates;
                }

                $floatVal = floatval($new_rate);
                // If the parsing succeeded and the value is not equivalent to an int
                if ($floatVal && intval($floatVal) != $floatVal) {
                    $teacher_data['rate'] = number_format((float)$new_rate, 1, '.', '');
                } else {
                    $teacher_data['rate'] = $new_rate;
                }
                Teacher::where('id', $request->teacher_id)->update($teacher_data);

                Alert::success(trans('s_admin.rating'), trans('s_admin.rate_s'));
                return back();
            } else {
                Alert::error(trans('s_admin.not_rated'), trans('s_admin.should_select_Star'));
                return back();
            }
        } else {
            Alert::error(trans('s_admin.not_rated'), trans('s_admin.rate_exists'));
            return back();
        }
    }

    public function make_teacher_rate(Request $request)
    {
        $student_id = auth()->guard('student')->user()->id;
        $exists_rate = Student_episode_rate::where('section_id', $request->section_id)->where('student_id', $student_id)
            ->where('teacher_id', $request->teacher_id)->first();
        if ($exists_rate == null) {
            if ($request->question_id) {
                foreach ($request->question_id as $key => $row) {

                    if ($request->rates[$key] != "0") {
                        $data['questions_id'] = $row;
                        $data['student_id'] = $student_id;
                        $data['teacher_id'] = $request->teacher_id;
                        $data['episode_id'] = $request->episode_id;
                        $data['section_id'] = $request->section_id;
                        $data['rate'] = $request->rates[$key];
                        Student_episode_rate::create($data);
                    } else {
                    }
                }
            }
            Alert::success(trans('s_admin.rating'), trans('s_admin.rate_s'));
            return back();
        } else {
            Alert::error(trans('s_admin.not_rated'), trans('s_admin.rate_exists'));
            return back();
        }
    }

    public function make_teacher_rate_old(Request $request)
    {


        $student_id = auth()->guard('student')->user()->id;
        $exists_rate = Student_teacher_rate::where('section_id', $request->section_id)->where('student_id', $student_id)
            ->where('teacher_id', $request->teacher_id)->first();
        if ($exists_rate == null) {
            if ($request->rate != null) {
                $data['student_id'] = $student_id;
                $data['teacher_id'] = $request->teacher_id;
                $data['episode_id'] = $request->episode_id;
                $data['section_id'] = $request->section_id;
                $data['rate'] = $request->rate;
                $data['notes'] = $request->notes;
                Student_teacher_rate::create($data);
                Alert::success(trans('s_admin.rating'), trans('s_admin.rate_s'));
                return back();
            } else {
                Alert::error(trans('s_admin.not_rated'), trans('s_admin.should_select_Star'));
                return back();
            }
        } else {
            Alert::error(trans('s_admin.not_rated'), trans('s_admin.rate_exists'));
            return back();
        }
    }


    public function destroy($id)
    {

    }

    public function fetch_data_to_rate(Request $request)
    {
//        where('type','!=','absence')->
        $degree = Plan_section_degree::where('rate_teacher', 0)->where('section_id', $request->section_id)->where('student_id', auth()->guard('student')->user()->id)->first();
        if ($degree) {
            $degree->rate_teacher = 2;
            $degree->save();
            return response(['status' => true, 'row' => $degree]);
        }
    }
}
