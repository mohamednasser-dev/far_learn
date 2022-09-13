<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Resources\EpisodeInfoResource;
use App\Http\Resources\EpisodeInfoStudentsResource;
use App\Http\Resources\EpisodeSectionsResource;
use App\Http\Resources\EpisodeStudentsResource;
use App\Http\Resources\EpisodeZoomResource;
use App\Http\Resources\MyEpisodesResource;
use App\Http\Resources\MyEpisodesTeacherResource;
use App\Http\Resources\QuestionResource;
use App\Models\Student_episode_rate;
use App\Models\Student_Questions_episode;
use App\Http\Controllers\Controller;
use App\Models\Plan_section_degree;
use App\Models\Episode_course_days;
use App\Models\Student_attendance;
use App\Models\Episode_section;
use App\Models\Episode_student;
use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Student;
use Carbon\Carbon;
use Validator;

class EpisodesController extends Controller
{
    public function my_episodes(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $user_type = $user->epo_type;
            if ($user_type == 'far_learn') {
                $type = 'mqraa';
            } elseif ($user_type == 'dorr') {
                $type = 'dorr';
            } elseif ($user_type == 'mogmaa') {
                $type = 'mogmaa';
            }
            $data = Episode_student::where('student_id', $user->id)->whereHas('Episode')->where('deleted', '0')->paginate(10);
            $data = MyEpisodesResource::collection($data)->response()->getData(true);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } elseif ($user && $user->type == 'teacher') {
            //this for teachers episodes
            $episodes_ids = $this->teacherEpisodes_id($user->id);
            $data = Episode::whereIn('id', $episodes_ids)->where('deleted', '0')->where('active', 'y')->paginate(10);
            $data = MyEpisodesTeacherResource::collection($data)->response()->getData(true);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function my_turn(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $question_today = Student_Questions_episode::where('student_id', $user->id)
                ->where('episode_course_id', $request->course_date_id)->where('episode_id', $request->episode_id)->first();
            $data['reciting_today'] = (new QuestionResource($question_today));

            //generate section id
            $mytime = Carbon::now();
            $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
            $section_data = Episode_section::where('epo_date', $today)->where('episode_id', $request->episode_id)->first();

            if ($section_data == null) {
                return msgdata($request, failed(), trans('s_admin.day_ended'), (object)[]);
            }
            //make student attendance
            $exist_attendance = Student_attendance::where('student_id', $user->id)->where('section_id', $section_data->id)->first();
            if ($exist_attendance == null) {
                //Begain generate attendance persentage
                $student = Student::with('Attendance')->with('Absence')->whereId($user->id)->first();
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

                $episode_student = Episode_student::where('student_id', $user->id)->where('episode_id', $request->episode_id)->first();
                $epo_attendance = Student_attendance::where('episode_id', $request->episode_id)->where('student_id', $user->id)->get()->count();
                $section_ids = Episode_section::where('episode_id', $request->episode_id)->get()->pluck('id')->toArray();
                $epo_absence = Plan_section_degree::where('student_id', $user->id)->whereIn('section_id', $section_ids)->where('type', 'absence')->get()->count();

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
                $stud_epo = Episode_student::where('student_id', $user->id)->where('episode_id', $request->episode_id)->first();
                if ($stud_epo->order_num == 0) {
                    $stud_epo->order_num = $last_student->order_num + 1;
                    $stud_epo->save();
                }
            }
            if ($section_data->status == 'ended') {
                return msgdata($request, failed(), trans('s_admin.epo_ended'), (object)[]);
            }
            //degree if exists
            $student_degree_ask = Plan_section_degree::where('student_id', $user->id)->where('section_id', $section_data->id)->where('type', 'ask')->first();
            if ($student_degree_ask) {
                $data['degree'] = $student_degree_ask->Ask_degree->name;
            } else {
                $data['degree'] = "";
            }
            $exists_epo = Episode::where('active', 'y')->where('deleted', '0')->where('id', $request->episode_id)->first();
            if ($exists_epo) {
                $data['zoom_data'] = (new EpisodeZoomResource($exists_epo));
                $data['episode_info'] = (new EpisodeInfoResource($exists_epo));
            } else {
                return msgdata($request, failed(), trans('s_admin.should_choose_valid_episode'), (object)[]);
            }
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function far_learn_join(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $student_id = $user->id;
            $rules = [
                'from_surah_id' => 'required|exists:plan_surahs,id',
                'from_num' => 'required',
                'to_surah_id' => 'required|exists:plan_surahs,id',
                'to_num' => 'required',
                'course_date_id' => 'required',
                'episode_id' => 'required',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(msg($request, not_found(), $validator->messages()->first()));
            }
            $mytime = Carbon::now();
            $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
            $section_data = Episode_section::where('epo_date', $today)->where('episode_id', $request->episode_id)->first();

            if ($section_data == null) {
                $ended_section = Episode_section::where('epo_date', $today)->where('status', 'ended')->where('episode_id', $request->episode_id)->first();
                if ($ended_section) {
                    return msgdata($request, not_authoize(), trans('s_admin.day_ended'), (object)[]);
                } else {
                    return msgdata($request, not_authoize(), trans('s_admin.episode_not_started_yet'), (object)[]);
                }
            }
            if ($request->from_surah_id > $request->to_surah_id) {
                return msgdata($request, not_authoize(), trans('s_admin.dont_added_becase_of_sorting_sura'), (object)[]);
            }
            if ($request->from_surah_id == $request->to_surah_id) {
                if ($request->from_num > $request->to_num) {
                    return msgdata($request, not_authoize(), trans('s_admin.dont_added_becase_of_sorting_aya_sura'), (object)[]);
                }
            }
            $exist_joined = Student_Questions_episode::where('student_id', $student_id)->where('episode_course_id', $request->course_date_id)->first();

            if ($exist_joined) {
                return msgdata($request, failed(), trans('s_admin.you_joined_before'), (object)[]);
            }

            $data = new Student_Questions_episode;
            $data->episode_id = $request->episode_id;
            $data->episode_course_id = $request->course_date_id;
            $data->from_surah_id = $request->from_surah_id;
            $data->from_num = $request->from_num;
            $data->to_surah_id = $request->to_surah_id;
            $data->to_num = $request->to_num;
            $data->student_id = $student_id;
            if ($data->save()) {
                //send firebase notification to teacher to know that student come
                $student_data = Student::findOrFail($student_id);
                send($student_data->fcm_token, 'انضمام الحلقة', 'تم انضمام الطالب ' . $student_data->user_name . ' للحلقة', 'student_join_episode', $request->episode_id);
                //end send

                $exist_attendance = Student_attendance::where('student_id', $student_id)->where('section_id', $section_data->id)->first();
                if ($exist_attendance == null) {
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
                    $stud_epo = Episode_student::where('student_id', $student_id)->where('episode_id', $request->episode_id)->first();
                    $your_turn = $last_student->order_num + 1;
                    $stud_epo->order_num = $your_turn;
                    $stud_epo->save();
                }
            }
            $result_data['your_turn'] = $your_turn;
            return msgdata($request, success(), trans('s_admin.join_wait_turn_s'), $result_data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function episode_info(Request $request, $id)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $user_type = $user->epo_type;
            if ($user_type == 'far_learn') {
                $type = 'mqraa';
            } elseif ($user_type == 'dorr') {
                $type = 'dorr';
            } elseif ($user_type == 'mogmaa') {
                $type = 'mogmaa';
            }
            $exists_epo = Episode::where('id', $id)->where('deleted', '0')->first();
            if ($exists_epo) {
                $data['main_data'] = (new EpisodeInfoResource($exists_epo));
                $episode_days = Episode_course_days::where('episode_id', $id)->get();
//                $data['episode_sections'] = EpisodeSectionsResource::collection($episode_days);
                $data['episode_sections'] = EpisodeSectionsResource::customCollection($episode_days, $user->id);
                return msgdata($request, success(), trans('s_admin.shown_s'), $data);
            } else {

                return msgdata($request, failed(), trans('s_admin.should_choose_valid_episode'), (object)[]);
            }

        } elseif ($user && $user->type == 'teacher') {
            $user_type = $user->epo_type;
            if ($user_type == 'far_learn') {
                $type = 'mqraa';
            } elseif ($user_type == 'dorr') {
                $type = 'dorr';
            } elseif ($user_type == 'mogmaa') {
                $type = 'mogmaa';
            }
            $exists_epo = Episode::where('id', $id)->where('deleted', '0')->first();
            if ($exists_epo) {
                $data['main_data'] = (new EpisodeInfoResource($exists_epo));
                $episode_students = Episode_student::where('episode_id', $id)->orderBy('order_num', 'desc')->get();
                $data['episode_students'] = EpisodeInfoStudentsResource::Collection($episode_students);
                return msgdata($request, success(), trans('s_admin.shown_s'), $data);
            } else {

                return msgdata($request, failed(), trans('s_admin.should_choose_valid_episode'), (object)[]);
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function rate_episode(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $student_id = $user->id;
            $rules = [
                'section_id' => 'required|exists:episode_sections,id',
                'question_ids' => 'required|array',
                'rates' => 'required|array',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(msg($request, not_found(), $validator->messages()->first()));
            }
            $degree = Plan_section_degree::where('section_id', $request->section_id)->where('student_id', $student_id)->first();
            if (!$degree) {
                return msgdata($request, failed(), trans('s_admin.teacher_not_rate_student'), (object)[]);
            }
            $episode_section = Episode_section::findOrFail($request->section_id);

            $exists_rate = Student_episode_rate::where('section_id', $request->section_id)->where('student_id', $student_id)
                ->where('teacher_id', $degree->teacher_id)->first();
            if ($exists_rate == null) {
                if ($request->question_ids) {
                    foreach ($request->question_ids as $key => $row) {
                        if ($request->rates[$key] != "0") {
                            $data['questions_id'] = $row;
                            $data['student_id'] = $student_id;
                            $data['teacher_id'] = $degree->teacher_id;
                            $data['episode_id'] = $episode_section->episode_id;
                            $data['section_id'] = $request->section_id;
                            $data['rate'] = $request->rates[$key];
                            Student_episode_rate::create($data);
                        } else {
                        }
                    }
                    $degree->rate_teacher = 2;
                    $degree->is_rated = 1;
                    $degree->save();
                }
                return msgdata($request, success(), trans('s_admin.rate_s'), (object)[]);
            } else {
                return msgdata($request, failed(), trans('s_admin.rate_exists'), (object)[]);
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function check_rating(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $student_id = $user->id;
            $rules = [
                'episode_id' => 'required|exists:episodes,id',
            ];
            $validator = Validator::make($request->all(), $rules);
            if ($validator->fails()) {
                return response()->json(msg($request, not_found(), $validator->messages()->first()));
            }
            $degree = Plan_section_degree::where('is_rated', 0)->where('type', '!=', 'absence')->where('episode_id', $request->episode_id)->where('student_id', $student_id)->orderBy('created_at','desc')->first();
            if ($degree) {
                if ($degree->type == 'ask') {
                    $result['degree'] = $degree->Ask_degree->name;
                    $result['section_id'] = $degree->section_id;
                }
                return msgdata($request, success(), trans('s_admin.rate_found'), $result);
            } else {
                return msgdata($request, failed(), trans('s_admin.rate_not_found'), (object)[]);
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }
}
