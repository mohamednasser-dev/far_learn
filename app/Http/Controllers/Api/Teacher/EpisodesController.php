<?php

namespace App\Http\Controllers\Api\Teacher;

use App\Http\Resources\EpisodeInfoResource;
use App\Http\Resources\EpisodeStudentsResource;
use App\Http\Resources\EpisodeZoomResource;
use App\Http\Resources\FarLearnDegreeResource;
use App\Http\Resources\StudentDegreesResource;
use App\Models\Admin_notification;
use App\Models\Episode_restart_request;
use App\Models\Far_learn_degree;
use App\Models\Notification;
use App\Http\Controllers\Controller;
use App\Models\Plan_section_degree;
use App\Models\Episode_course_days;
use App\Models\Student_attendance;
use App\Models\Episode_section;
use App\Models\Episode_student;
use App\Traits\ZoomJWT;
use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Student;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;

class EpisodesController extends Controller
{
    use ZoomJWT;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function episode_info(Request $request, $id)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {
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
                $zoom_zac_data = json_decode($this->zoom_zac_data());
                $zoom_zac_token = json_decode($this->zoom_zac_token());
                $data['zoom_data'] = (new EpisodeZoomResource($exists_epo));
                $data['zoom_zac_data']['zac_id'] = $zoom_zac_data->id;
                $data['zoom_zac_data']['zac_token'] = $zoom_zac_token->token;
                $data['episode_info'] = (new EpisodeInfoResource($exists_epo));
                $mytime = Carbon::now();
                $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
                $section_data = Episode_section::select('id', 'epo_date', 'start_time', 'end_time', 'status', 'order_num', 'link_all')->where('epo_date', $today)->where('episode_id', $id)->first();
                if ($section_data == null) {
                    $data['section_data'] = (object)[];
                } else {
                    $data['section_data'] = $section_data;
                }
                $episode_students = Episode_student::where('episode_id', $id)->orderBy('order_num', 'desc')->get();
                $data['episode_students'] = EpisodeStudentsResource::customCollection($episode_students, $section_data);
                return msgdata($request, success(), trans('s_admin.shown_s'), $data);
            } else {
                return msgdata($request, failed(), trans('s_admin.should_choose_valid_episode'), (object)[]);
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function zoom_zac_data()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.zoom.us/v2/users/uramit75@gmail.com",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IkRZZFdJNm80VDNtZzNOTVhDWkFtTFEiLCJleHAiOjE2ODczNTMxODAsImlhdCI6MTY1NTgxMjQ0Nn0.pNuZAN6F4jV7p5b-de1n-nF2p6gEZ0NkfpdhJGGhrBY",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }

    public function zoom_zac_token()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => "https://api.zoom.us/v2/users/uramit75@gmail.com/token?type=zak",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => "",
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30000,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
            CURLOPT_HTTPHEADER => array(
                // Set here requred headers
                "accept: */*",
                "accept-language: en-US,en;q=0.8",
                "content-type: application/json",
                "Authorization: Bearer eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOm51bGwsImlzcyI6IkRZZFdJNm80VDNtZzNOTVhDWkFtTFEiLCJleHAiOjE2ODczNTMxODAsImlhdCI6MTY1NTgxMjQ0Nn0.pNuZAN6F4jV7p5b-de1n-nF2p6gEZ0NkfpdhJGGhrBY",
            ),
        ));

        $response = curl_exec($curl);
        $err = curl_error($curl);

        curl_close($curl);

        return $response;
    }

    public function start(Request $request)
    {
        $rules = [
            'episode_id' => 'required|exists:episodes,id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        }
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {
            $exists_epo = Episode::where('id', $request->episode_id)->where('deleted', '0')->first();
            $data['episode_id'] = $request->episode_id;
            $data['epo_link'] = $exists_epo->join_url;
            $mytime = Carbon::now();
            $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
            $data['epo_date'] = $today;
            $data['status'] = 'started';
            $data['start_time'] = $mytime;
            $new_section = Episode_section::create($data);
            if ($new_section != null) {
                $data_start['order_num'] = 0;
                $data_start['finish'] = 0;
                Episode_student::where('episode_id', $request->episode_id)->update($data_start);
                //send notification to students of starting class
                $epo_students = Episode_student::with('Episode')->where('episode_id', $request->episode_id)->get();
                if ($epo_students) {
                    foreach ($epo_students as $student) {
                        $input_student['student_id'] = $student->student_id;
                        $input_student['type'] = 'student';
                        $input_student['message_type'] = 'episode_started';
                        $input_student['title_ar'] = 'تم بدأ الحلقة';
                        $input_student['title_en'] = 'class started now';
                        $input_student['message_ar'] = 'تم بدأ الحلقة - ' . $student->Episode->name_ar;
                        $input_student['message_en'] = 'class - ' . $student->Episode->name_en . '- started now';
                        Notification::create($input_student);
                        if ($student->Student->fcm_token) {
                            $fcm_tokens[0] = $student->Student->fcm_token;
//                            send_notification('تم بدأ الحلقة - ' . $student->Episode->name_ar, 'episodes', null, $fcm_tokens);
                        }
                    }
                }
                return msgdata($request, success(), trans('s_admin.new_epo_started'), (object)[]);
            } else {
                return msgdata($request, failed(), trans('s_admin.not_started'), (object)[]);
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function student_degree(Request $request)
    {
        $rules = [
            'episode_id' => 'required|exists:episodes,id',
            'student_id' => 'required|exists:students,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        }
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {
            $exist_degrees = Plan_section_degree::where('episode_id', $request->episode_id)->where('student_id', $request->student_id)->paginate(10);
            $data = StudentDegreesResource::Collection($exist_degrees)->response()->getData(true);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function make_absence(Request $request)
    {
        $rules = [
            'student_id' => 'required|exists:students,id',
            'section_id' => 'required|exists:episode_sections,id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        }
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {
            $section = Episode_section::findOrFail($request->section_id);
            $degree_exists = Plan_section_degree::where('student_id', $request->student_id)->where('type', 'absence')->where('section_id', $request->section_id)->first();
            $exist_attendance = Student_attendance::where('student_id', $request->student_id)->where('section_id', $request->section_id)->first();
            if ($exist_attendance != null) {
                return msgdata($request, failed(), trans('s_admin.wrong_student_in_episode'), (object)[]);
            } else {
                if ($degree_exists == null) {
                    //check if student rated in this section to avoid make absence to rated student
                    $exists_rating = Plan_section_degree::where('student_id', $request->student_id)->where('type', '!=', 'absence')->where('section_id', $request->section_id)->first();
                    if ($exists_rating) {
                        return msgdata($request, failed(), trans('s_admin.not_allow_to_give_absence'), (object)[]);

                    }
                    //end check
                    $input['student_id'] = $request->student_id;
                    $input['section_id'] = $request->section_id;
                    $input['episode_id'] = $section->episode_id;
                    $input['type'] = 'absence';
                    $input['degree'] = 'absence';
                    $input['teacher_id'] = $user->id;
                    $degree_created = Plan_section_degree::create($input);

                    //generate attendance persentage
                    $student = Student::with('Attendance')->with('Absence')->whereId($request->student_id)->first();
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

                    if ($degree_created != null) {
                        return msgdata($request, success(), trans('s_admin.absence_done'), (object)[]);
                    } else {
                        return msgdata($request, success(), trans('s_admin.absence_not'), (object)[]);
                    }
                } else {
                    $degree_exists->delete();
                    return msgdata($request, success(), trans('s_admin.absence_removed'), (object)[]);
                }
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function restart_again(Request $request)
    {
        $rules = [
            'section_id' => 'required|exists:episode_sections,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        }
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {
            $section = Episode_section::whereId($request->section_id)->first();
            $section->status = 'started';
            if ($section->save()) {
                $data = Episode::where('deleted', '0')->where('id', $section->episode_id)->first();
                $mytime = Carbon::now();
                $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
                $section_data = Episode_section::where('epo_date', $today)->where('episode_id', $section->episode_id)->first();
                $course_data = Episode_course_days::where('episode_id', $data->id)->where('date', $today)->first();
                if ($course_data == null) {
                    return msgdata($request, failed(), trans('s_admin.day_ended'), (object)[]);
                }
                if ($section_data != null) {
                    if ($section_data->status == 'ended') {
                        return msgdata($request, failed(), trans('s_admin.epo_ended'), (object)[]);
                    }
                }
                return msgdata($request, success(), trans('s_admin.restart_epo_done'), (object)[]);
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function restart_again_after_time(Request $request)
    {
        $rules = [
            'section_id' => 'required|exists:episode_sections,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        }
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {
            $exist = Episode_restart_request::where('status', 'new')->where('section_id', $request->section_id)->where('teacher_id', $user->id)->first();
            if ($exist == null) {
                $data['teacher_id'] = $user->id;
                $data['section_id'] = $request->section_id;
                Episode_restart_request::create($data);
                return msgdata($request, success(), trans('s_admin.wait_admin_to_approve'), (object)[]);
            } else {
                return msgdata($request, failed(), trans('s_admin.request_exist'), (object)[]);
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function next_turn(Request $request, $type)
    {
        $rules = [
            'section_id' => 'required|exists:episode_sections,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        }
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {
            if ($type == 'next') {
                $epo_sec = Episode_section::find($request->section_id);
                $max_order_num = Episode_student::where('episode_id', $epo_sec->episode_id)->get()->max('order_num');
                if ($epo_sec->order_num == $max_order_num) {
                    return msgdata($request, failed(), trans('s_admin.this_is_last_turn'), (object)[]);
                }
                $epo_sec->order_num = $epo_sec->order_num + 1;
                $epo_sec->save();
                return msgdata($request, success(), trans('s_admin.next_turn_s'), (object)[]);
            } elseif ($type == 'previous') {
                $epo_sec = Episode_section::find($request->section_id);
                if ($epo_sec->order_num > 1) {
                    $epo_sec->order_num = $epo_sec->order_num - 1;
                    $epo_sec->save();
                } else {
                    return msgdata($request, failed(), trans('s_admin.this_is_first_turn'), (object)[]);
                }
                return msgdata($request, success(), trans('s_admin.previous_turn_s'), (object)[]);
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function end_episode(Request $request)
    {
        $rules = [
            'section_id' => 'required|exists:episode_sections,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        }
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {
            $mytime = Carbon::now();
            $epo_section = Episode_section::findOrFail($request->section_id);
            $epo_section->end_time = $mytime;
            $epo_section->status = 'ended';
            if ($epo_section->save()) {
                //Begin make come students
                $selected_epo = Episode::where('id', $epo_section->episode_id)->first();
                foreach ($selected_epo->Students as $row) {
                    $absence_exists = Plan_section_degree::where('student_id', $row->id)->where('type', 'absence')->where('section_id', $request->section_id)->first();
                    if ($absence_exists == null) {
                        //to create student attendance
                        $data_attendance['student_id'] = $row->id;
                        $data_attendance['episode_id'] = $epo_section->episode_id;
                        $data_attendance['section_id'] = $request->section_id;
                        Student_attendance::create($data_attendance);
                    }
                    //Begain generate attendance persentage
                    $student = Student::with('Attendance')->with('Absence')->whereId($row->id)->first();
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
                }
                //End make come students
                $s_date = date('Y-m-d', strtotime($epo_section->start_time));
                $s_Time = $epo_section->Episode->time_to;
                $epo_basic_end = $s_date . ' ' . $s_Time;
                $final_epo_basic_end = date("Y-m-d H:i", strtotime($epo_basic_end));
                Carbon::createFromFormat('Y-m-d H:i', $final_epo_basic_end);
                //reset student sorting
                $data_start['order_num'] = 0;
                $data_start['finish'] = 0;
                Episode_student::where('episode_id', $epo_section->episode_id)->update($data_start);
                $abs_Count = Plan_section_degree::where('section_id', $request->section_id)->where('type', 'absence')->get()->count();
                $attens_count = count($epo_section->Episode->Students) - $abs_Count;
                $input['come_num'] = $attens_count;
                Episode_section::where('id', $request->section_id)->update($input);
                return msgdata($request, success(), trans('s_admin.new_epo_ended'), (object)[]);
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function update_zoom_link(Request $request)
    {
        $rules = [
            'episode_id' => 'required|exists:episodes,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        }
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {
            $episode = Episode::findOrFail($request->episode_id);
            $path = 'users/me/meetings';
            $response = $this->zoomPost($path, [
                'topic' => $episode->name,
                'type' => self::MEETING_TYPE_SCHEDULE,
                'start_time' => $this->toZoomTimeFormat(Carbon::now()),
                'duration' => 30,
                'agenda' => $user->user_name,
                'settings' => [
                    'host_video' => false,
                    'participant_video' => false,
                    'waiting_room' => true,
                ]
            ]);
            $new_v = (object)$response->body();
            $new_data['meeting_id'] = $response['id'];
            $new_data['passcode'] = $response['password'];
            $new_data['join_url'] = $response['join_url'];
            $new_data['teacher_link'] = $response['join_url'];
            $new_data['topic'] = $episode->name;
            $new_data['start_time'] = Carbon::now();
            $new_data['agenda'] = $user->user_name;
            Episode::whereId($request->episode_id)->update($new_data);

            //notify students with this update
            foreach ($episode->Students as $student) {
                $input_student['student_id'] = $student->id;
                $input_student['type'] = 'student';
                $input_student['message_type'] = 'restart_episode';
                $input_student['title_ar'] = 'تحديث رابط الحلقة';
                $input_student['title_en'] = 'update Class link';
                $input_student['message_ar'] = 'تم تحديث رابط زوم الحلقة - ' . $episode->name_ar;
                $input_student['message_en'] = 'zoom link updated for class - ' . $episode->name_en;
                Notification::create($input_student);
            }
            $exists_epo = Episode::where('id', $request->episode_id)->first();
            if ($exists_epo) {
                $zoom_zac_data = json_decode($this->zoom_zac_data());
                $zoom_zac_token = json_decode($this->zoom_zac_token());
                $data['zoom_data'] = (new EpisodeZoomResource($exists_epo));
                $data['zoom_zac_data']['zac_id'] = $zoom_zac_data->id;
                $data['zoom_zac_data']['zac_token'] = $zoom_zac_token->token;
            }
            return msgdata($request, success(), trans('s_admin.link_zoom_updated'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function epo_time(Request $request)
    {
        $rules = [
            'section_id' => 'required|exists:episode_sections,id',
            'type' => 'required|in:15,30',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        }
        if ($request->type == 30) {
            $epo_section = Episode_section::findOrFail($request->section_id);
            if ($epo_section->long_time_thirty == 1) {
                return msgdata($request, failed(), trans('s_admin.request_send_befor'), (object)[]);

            } else {
                $user = check_api_token($request->header('apitoken'));
                $data['teacher_id'] = $user->id;
                $data['episode_id'] = $epo_section->episode_id;
                $data['section_id'] = $request->section_id;
                $data['type'] = 'teacher';
                $data['message_type'] = 'long_episode';
                $data['title_ar'] = 'أمتدت الحلقة';
                $data['title_en'] = 'episode Stretched';
                $data['message_ar'] = 'طلب تمديد 30 دقيقة من وقت الحلقة ' . $epo_section->Episode->name_ar;
                $data['message_en'] = 'Request to extend 30 minutes of episode time ' . $epo_section->Episode->name_en;
                Admin_notification::create($data);

                $epo_section->long_time_thirty = 1;
                $epo_section->save();

                return msgdata($request, success(), trans('s_admin.wait_admin_to_approve'), (object)[]);

            }
        } else {

            return msgdata($request, success(), trans('s_admin.epo_longed_s'), (object)[]);

        }
    }

    public function far_learn_degrees(Request $request)
    {
        $far_degees = Far_learn_degree::where('deleted', '0')->orderBy('id', 'desc')->get();
        $data = FarLearnDegreeResource::Collection($far_degees);
        return msgdata($request, success(), trans('s_admin.wait_admin_to_approve'), $data);
    }

    public function make_far_learn_evaluate(Request $request)
    {
        $rules = [
            'student_id' => 'required|exists:students,id',
            'section_id' => 'required|exists:episode_sections,id',
            'saved_lines' => 'required|numeric|min:0',
            'plan_id' => 'required|exists:student__questions_episodes,id',
            'degree' => 'required|exists:far_learn_degrees,id'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        }
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'teacher') {
            $section = Episode_section::find($request->section_id);
            $exist_degree = Plan_section_degree::where('student_id', $request->student_id)->where('section_id', $request->section_id)->where('type', 'ask')->first();
            if ($exist_degree == null) {
                if ($request->plan_id == 0) {
                    return msgdata($request, failed(), trans('s_admin.this_stud_no_question'), (object)[]);
                }
                $data['saved_lines'] = $request->saved_lines;
                $data['student_id'] = $request->student_id;
                $data['section_id'] = $request->section_id;
                $data['plan_id'] = $request->plan_id;
                $data['degree'] = $request->degree;
                $data['teacher_id'] = $user->id;
                $data['episode_id'] = $section->episode_id;
                $data['errors_num'] = 0;
                $data['type'] = 'ask';
                $result = Plan_section_degree::create($data);
                if ($result != null) {
                    $input_student['student_id'] = $request->student_id;
                    $input_student['type'] = 'student';
                    $input_student['message_type'] = 'student_rated';
                    $input_student['title_ar'] = 'تم تقييمك في الحلقة';
                    $input_student['title_en'] = 'You were rated in the class';
                    $input_student['message_ar'] = 'تم تقييمك في حلقة -' . ' ' . $result->Episode->name_ar;
                    $input_student['message_en'] = 'You were rated in class - ' . $result->Episode->name_en;
                    Notification::create($input_student);
                    return msgdata($request, success(), trans('s_admin.added_s'), (object)[]);
                }
            } else {
                //this to update rated student degree
//                return msgdata($request, failed(), trans('s_admin.this_student_evaluate_before'), (object)[]);
                $exist_degree->saved_lines = $request->saved_lines;
                $exist_degree->degree = $request->degree;
                $exist_degree->save();
                return msgdata($request, success(), trans('s_admin.updated_s'), (object)[]);
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function active_link_student(Request $request)
    {
        $rules = [
            'section_id' => 'required|exists:episode_sections,id',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        }
        $section = Episode_section::findOrFail($request->section_id);
        if ($section != null) {
            if ($section->link_all == 1) {
                $section->link_all = 0;
            } else {
                $section->link_all = 1;
            }
            if ($section->save()) {
                return msgdata($request, success(), trans('s_admin.status_changes_s'), (object)[]);
            }
        }
    }
}
