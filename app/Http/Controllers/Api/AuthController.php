<?php

namespace App\Http\Controllers\Api;

use App\Models\Episode_teacher;
use App\Models\Plan_section_degree;
use App\Models\Student_episode_rate;
use App\Models\Student_section_evaluation;
use App\Models\Student_teacher_rate;
use App\Models\Teacher_job_name_history;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Student_level_history;
use App\Notifications\VerfiyRegister;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\Admin_notification;
use App\Models\Episode_student;
use App\Models\Student_parent;
use Illuminate\Http\Request;
use App\Models\Phone_check;
use App\Models\Episode;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Inbox;
use App\Models\User;
use Carbon\Carbon;
use Validator;
use DB;

class AuthController extends Controller
{
    public $objectName;

    public function __construct(User $model)
    {
        $this->objectName = $model;
    }

    public function login(Request $request)
    {
        $rules = [
            'country_code' => 'required',
            'unique_name' => 'required',
            'password' => 'required',
            'fcm_token' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {
            if ($request->country_code) {
                $user_phone = $request->country_code . $request->unique_name;
            }
            if (auth::guard('teacher')->attempt(['user_phone' => $user_phone, 'password' => Request('password')])) {
                if (auth()->guard('teacher')->user()->is_verified == '0') {
                    $id = auth()->guard('teacher')->user()->id;
                    Auth::guard('teacher')->logout();
                    $user_data = Teacher::whereId($id)
                        ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar',
                            'first_name_en', 'mid_name_en', 'last_name_en', 'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender',
                            'main_lang', 'api_token', 'image', 'is_new')->first();
                    $user_data->fcm_token = $request->fcm_token;
                    $user_data->save();
                    $user_data->type = 'teacher';
                    return response()->json(msgdata($request, not_acceptable(), trans('s_admin.you_should_verify_email_first'), $user_data));
                }
                if (auth()->guard('teacher')->user()->is_new == 'y') {
                    Auth::guard('teacher')->logout();
                    return response()->json(msg($request, failed(), trans('s_admin.you_not_accepted_yet')));
                }
                if (auth()->guard('teacher')->user()->is_new == 'rejected') {
                    Auth::guard('teacher')->logout();
                    return response()->json(msg($request, failed(), trans('s_admin.you_rejected')));
                }
                //Check if active user or not
                if (auth()->guard('teacher')->user()->status != 'active') {
                    $user = Auth::guard('teacher')->user();
                    $user->api_token = str_random(60);
                    $user->fcm_token = $request->fcm_token;
                    $user->save();
                    $user_data = Teacher::whereId($user->id)
                        ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar',
                            'first_name_en', 'mid_name_en', 'last_name_en', 'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender',
                            'main_lang', 'api_token', 'image', 'is_new')->first();
                    $user_data->type = 'teacher';
                    return response()->json(msgdata($request, not_active(), trans('s_admin.you_not_active'), $user_data));
                } else {
                    $user = Auth::guard('teacher')->user();
                    $user->fcm_token = $request->fcm_token;
                    $user->api_token = str_random(60);
                    $user->save();
                    $user_data = Teacher::whereId($user->id)
                        ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar',
                            'first_name_en', 'mid_name_en', 'last_name_en', 'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender',
                            'main_lang', 'api_token', 'image', 'is_new')->first();
                    $user_data->type = 'teacher';
                    return msgdata($request, success(), trans('admin.login_done'), $user_data);
                }
            } else if (auth::guard('student')->attempt(['user_phone' => $user_phone, 'password' => Request('password')])) {
                if (auth()->guard('student')->user()->parent_data == 'not_complete') {
                    $student_id = auth()->guard('student')->user()->id;
                    Auth::guard('student')->logout();
                    return response()->json(msg($request, failed(), trans('admin.you_should_complete_parent_data')));
                }
                if (auth()->guard('student')->user()->is_verified == '0') {
                    $id = auth()->guard('student')->user()->id;
                    Auth::guard('student')->logout();
                    $user_data = Student::whereId($id)
                        ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar', 'first_name_en', 'mid_name_en', 'last_name_en',
                            'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender', 'main_lang', 'api_token', 'image', 'is_new')->first()
                        ->makeHidden('Attendance');
                    $user_data->fcm_token = $request->fcm_token;
                    $user_data->save();
                    $user_data->type = 'student';
                    return response()->json(msgdata($request, not_acceptable(), trans('s_admin.you_should_verify_email_first'), $user_data));
                }
                if (auth()->guard('student')->user()->complete_data == 1) {
                    if (auth()->guard('student')->user()->is_new == 'y') {
//                        Auth::guard('student')->logout();
                        $user = Auth::guard('student')->user();
                        $user->api_token = str_random(60);
                        $user->fcm_token = $request->fcm_token;
                        $user->save();
                        $user_data = Student::whereId($user->id)
                            ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar', 'first_name_en', 'mid_name_en', 'last_name_en',
                                'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender', 'main_lang', 'api_token', 'image', 'is_new')->first()
                            ->makeHidden('Attendance');
                        $user_data->type = 'student';
                        return response()->json(msgdata($request, success(), trans('s_admin.you_not_accepted_yet'), $user_data));
                    }
                }
                if (auth()->guard('student')->user()->is_new == 'rejected') {
                    Auth::guard('student')->logout();
                    return response()->json(msg($request, failed(), trans('s_admin.you_rejected')));
                }
                //Check if active user or not
                if (auth()->guard('student')->user()->status != 'active') {
                    $user = Auth::guard('student')->user();
                    $user->fcm_token = $request->fcm_token;
                    $user->api_token = str_random(60);
                    $user->save();

                    $user_data = Student::whereId($user->id)
                        ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar', 'first_name_en', 'mid_name_en', 'last_name_en',
                            'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender', 'main_lang', 'api_token', 'image', 'is_new')->first()
                        ->makeHidden('Attendance');
                    $user_data->type = 'student';
                    return response()->json(msgdata($request, not_active(), trans('s_admin.you_not_active'), $user_data));
                } else {
                    $user = Auth::guard('student')->user();
                    $user->api_token = str_random(60);
                    $user->fcm_token = $request->fcm_token;
                    $user->save();

                    $user_data = Student::whereId($user->id)
                        ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar', 'first_name_en', 'mid_name_en', 'last_name_en',
                            'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender', 'main_lang', 'api_token', 'image', 'is_new')->first()
                        ->makeHidden('Attendance');
                    $user_data->type = 'student';

                    return msgdata($request, success(), trans('admin.login_done'), $user_data);
                }
            } else {
                return response()->json(msg($request, failed(), trans('admin.invaldemailorpassword')));
            }
        }
    }

    public function login_switch_account(Request $request)
    {
        $api_token = $request->header('apitoken');
        $user = check_api_token($api_token);
        if (!$user) {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
        $target = null;
        $rules = [
            'id' => 'required',
            'type' => 'required|in:student,teacher',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {
            if ($request->type == 'teacher') {
                $target = Teacher::where('user_phone', $user->user_phone)->where('id', $request->id)->first();
            } elseif ($request->type == 'student') {
                $target = Student::where('user_phone', $user->user_phone)->where('id', $request->id)->first();
            }
            if (!$target) {
                return response()->json(msg($request, not_authoize(), 'no account for you to login'));
            }

            $user_phone = $target->user_phone;
            if ($request->type == 'teacher') {
                if ($target->is_verified == '0') {
                    $id = $target->id;
                    Auth::guard('teacher')->logout();
                    $user_data = Teacher::whereId($id)
                        ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar',
                            'first_name_en', 'mid_name_en', 'last_name_en', 'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender',
                            'main_lang', 'api_token', 'image', 'is_new')->first();
                    $user_data->fcm_token = $request->fcm_token;
                    $user_data->save();
                    $user_data->type = 'teacher';
                    return response()->json(msgdata($request, not_acceptable(), trans('s_admin.you_should_verify_email_first'), $user_data));
                }
                if ($target->is_new == 'y') {
                    Auth::guard('teacher')->logout();
                    return response()->json(msg($request, failed(), trans('s_admin.you_not_accepted_yet')));
                }
                if ($target->is_new == 'rejected') {
                    Auth::guard('teacher')->logout();
                    return response()->json(msg($request, failed(), trans('s_admin.you_rejected')));
                }
                //Check if active user or not
                if ($target->status != 'active') {

                    $target->api_token = str_random(60);
                    $target->fcm_token = $user->fcm_token;
                    $target->save();
                    $user_data = Teacher::whereId($target->id)
                        ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar',
                            'first_name_en', 'mid_name_en', 'last_name_en', 'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender',
                            'main_lang', 'api_token', 'image', 'is_new')->first();
                    $user_data->type = 'teacher';
                    return response()->json(msgdata($request, not_active(), trans('s_admin.you_not_active'), $user_data));
                } else {

                    $target->fcm_token = $user->fcm_token;
                    $target->api_token = str_random(60);
                    $target->save();
                    $user_data = Teacher::whereId($target->id)
                        ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar',
                            'first_name_en', 'mid_name_en', 'last_name_en', 'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender',
                            'main_lang', 'api_token', 'image', 'is_new')->first();
                    $user_data->type = 'teacher';
                    return msgdata($request, success(), trans('admin.login_done'), $user_data);
                }

            } else {
                if ($target->parent_data == 'not_complete') {
                    return response()->json(msg($request, failed(), trans('admin.you_should_complete_parent_data')));
                }
                if ($target->is_verified == '0') {
                    $id = $target->id;
                    Auth::guard('student')->logout();
                    $user_data = Student::whereId($id)
                        ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar', 'first_name_en', 'mid_name_en', 'last_name_en',
                            'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender', 'main_lang', 'api_token', 'image', 'is_new')->first()
                        ->makeHidden('Attendance');
                    $user_data->fcm_token = $request->fcm_token;
                    $user_data->save();
                    $user_data->type = 'student';
                    return response()->json(msgdata($request, not_acceptable(), trans('s_admin.you_should_verify_email_first'), $user_data));
                }
                if ($target->complete_data == 1) {
                    if ($target->is_new == 'y') {
//                        Auth::guard('student')->logout();
                        $user = Auth::guard('student')->user();
                        $user->api_token = str_random(60);
                        $user->fcm_token = $request->fcm_token;
                        $user->save();
                        $user_data = Student::whereId($user->id)
                            ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar', 'first_name_en', 'mid_name_en', 'last_name_en',
                                'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender', 'main_lang', 'api_token', 'image', 'is_new')->first()
                            ->makeHidden('Attendance');
                        $user_data->type = 'student';
                        return response()->json(msgdata($request, success(), trans('s_admin.you_not_accepted_yet'), $user_data));
                    }
                }
                if ($target->is_new == 'rejected') {
                    Auth::guard('student')->logout();
                    return response()->json(msg($request, failed(), trans('s_admin.you_rejected')));
                }
                //Check if active user or not
                if ($target->status != 'active') {
                    $user = Auth::guard('student')->user();
                    $user->fcm_token = $request->fcm_token;
                    $user->api_token = str_random(60);
                    $user->save();

                    $user_data = Student::whereId($user->id)
                        ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar', 'first_name_en', 'mid_name_en', 'last_name_en',
                            'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender', 'main_lang', 'api_token', 'image', 'is_new')->first()
                        ->makeHidden('Attendance');
                    $user_data->type = 'student';
                    return response()->json(msgdata($request, not_active(), trans('s_admin.you_not_active'), $user_data));
                } else {
                    $target->api_token = str_random(60);
                    $target->fcm_token = $user->fcm_token;
                    $target->save();

                    $user_data = Student::whereId($target->id)
                        ->select('id', 'first_name_ar', 'mid_name_ar', 'last_name_ar', 'first_name_en', 'mid_name_en', 'last_name_en',
                            'email', 'country_code', 'phone', 'epo_type', 'date_of_birth', 'gender', 'main_lang', 'api_token', 'image', 'is_new')->first()
                        ->makeHidden('Attendance');
                    $user_data->type = 'student';

                    return msgdata($request, success(), trans('admin.login_done'), $user_data);
                }
            }

        }
    }

    public function sign_up(Request $request)
    {
        $type = $request->type;
        $data = $request->all();
        $data['unique_name'] = time() . '_' . rand(1000, 9999);
        //to git out children people
        $age = \Carbon\Carbon::parse($data['date_of_birth'])->age;
        if ($type != 'teacher_far_learn') {
            if ($age < 10) {
                $rules = [
                    'type' => 'required|in:teacher_far_learn,teacher_mogmaa_dorr,far_learn,mogmaa_dorr',
                    'first_name_ar' => 'required',
                    'mid_name_ar' => 'required',
                    'last_name_ar' => 'required',
                    'gender' => 'required',
                    'main_lang' => 'required|in:ar,en',
                    'date_of_birth' => 'required',
                    'ident_num' => 'required|numeric',
//                    'unique_name' => 'required|unique:teachers,unique_name|unique:students,unique_name|unique:users,unique_name',
                    'email' => 'required',
                    'country_code' => 'required',
                    'phone' => 'required|unique:students,phone',
                    'password' => 'required|min:8|confirmed',
                    'password_confirmation' => 'required|min:8',
                    'qualification' => 'required|exists:qualifications,id',
                    'country' => 'required|exists:countries,id',
                    'nationality' => 'required|exists:nationalities,id',
                    'save_quran_num' => 'required|numeric|max:30',
                    'save_quran_limit' => 'required|exists:save_limits,id',
                    'level_id' => 'required|exists:levels,id',
                    'episode_id' => 'required|exists:episodes,id',
                    'parent_user_name' => 'required',
                    'parent_country_code' => 'required',
                    'parent_phone' => 'required',
                    'address' => 'required',
                    'relation' => 'required|exists:relations,id',
                ];
            } else {
                $rules = [
                    'type' => 'required|in:teacher_far_learn,teacher_mogmaa_dorr,far_learn,mogmaa_dorr',
                    'first_name_ar' => 'required',
                    'mid_name_ar' => 'required',
                    'last_name_ar' => 'required',
                    'gender' => 'required',
                    'main_lang' => 'required|in:ar,en',
                    'date_of_birth' => 'required',
                    'ident_num' => 'required|numeric',
//                    'unique_name' => 'required|unique:teachers,unique_name|unique:students,unique_name|unique:users,unique_name',
                    'email' => 'required',
                    'country_code' => 'required',
                    'phone' => 'required|unique:students,phone',
                    'password' => 'required|min:8|confirmed',
                    'password_confirmation' => 'required|min:8',
                    'qualification' => 'required|exists:qualifications,id',
                    'country' => 'required|exists:countries,id',
                    'nationality' => 'required|exists:nationalities,id',
                    'save_quran_num' => 'required|numeric|max:30',
                    'save_quran_limit' => 'required|exists:save_limits,id',
                    'level_id' => 'required|exists:levels,id',
                    'episode_id' => 'required|exists:episodes,id',

                ];
            }
        } else {
            $rules = [
                'type' => 'required|in:teacher_far_learn,teacher_mogmaa_dorr,far_learn,mogmaa_dorr',
                'first_name_ar' => 'required',
                'mid_name_ar' => 'required',
                'last_name_ar' => 'required',
                'gender' => 'required',
                'main_lang' => 'required|in:ar,en',
                'date_of_birth' => 'required',
                'ident_num' => 'required|numeric',
//                'unique_name' => 'required|unique:teachers,unique_name|unique:students,unique_name|unique:users,unique_name',
                'email' => 'required',
                'country_code' => 'required',
                'phone' => 'required|unique:teachers,phone',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8',
                'qualification' => 'required|exists:qualifications,id',
                'country' => 'required|exists:countries,id',
                'nationality' => 'required|exists:nationalities,id',
                'cv' => 'nullable',
                'job_name' => 'required|exists:job_names,id',
                'save_quran_num' => 'required|numeric|max:30',
            ];
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {
            if ($request->episode_id) {
                $episode = Episode::find($request->episode_id);
                if (count($episode->Students) >= $episode->student_number) {
                    return response()->json(msgdata($request, not_acceptable(), trans('s_admin.episode_is_completed'), null));
                }
            }
            if ($request['password'] != null && $request['password_confirmation'] != null) {
                $selected_date = $request->date_of_birth;
                $year = \Carbon\Carbon::parse($selected_date)->format('Y');
                if ($year < 1900) {
                    $year = \Carbon\Carbon::parse($selected_date)->format('Y');
                    $month = \Carbon\Carbon::parse($selected_date)->format('m');
                    $day = \Carbon\Carbon::parse($selected_date)->format('d');
                    $date = Hijri::DateToGregorianFromDMY($day, $month, $year);
                    $data['date_of_birth'] = $date;
                } else {
                    $to_date = \Carbon\Carbon::parse($selected_date)->format('Y-m-d');
                    $data['date_of_birth'] = $to_date;
                }
                $data['user_phone'] = $request->country_code . $request->phone;
                $data['password'] = bcrypt(request('password'));

                $data['first_name_ar'] = $request->first_name_ar;
                $data['mid_name_ar'] = $request->mid_name_ar;
                $data['last_name_ar'] = $request->last_name_ar;

                $data['first_name_en'] = $request->first_name_ar;
                $data['mid_name_en'] = $request->mid_name_ar;
                $data['last_name_en'] = $request->last_name_ar;

                $data['user_name'] = $request->first_name_ar . " " . $request->mid_name_ar . " " . $request->last_name_ar;
                $code = rand(1000, 9999);
                if ($type == 'teacher_far_learn' || $type == 'teacher_mogmaa_dorr') {
                    if ($type == 'teacher_far_learn') {
                        $data['epo_type'] = 'far_learn';
                    } else if ($type == 'teacher_mogmaa_dorr') {
                        if ($request->gender == 'male') {
                            $data['epo_type'] = 'mogmaa';
                        } else if ($request->gender == 'female') {
                            $data['epo_type'] = 'dorr';
                        }
                    }
                    if ($request->cv != null) {
                        $file = $request->file('cv');
                        $ext = $file->getClientOriginalExtension();
                        // Move Image To Folder ..
                        $fileNewName = 'cv_' . time() . '.' . $ext;
                        $file->move(public_path('uploads/teachers/cvs'), $fileNewName);
                        $data['cv'] = $fileNewName;
                    }
                    unset($data['save_quran_limit']);
                    unset($data['level_id']);
                    unset($data['zone_id']);
                    unset($data['city_id']);
                    unset($data['district_id']);
                    unset($data['subject_id']);
                    unset($data['subject_level_id']);
                    $data['is_verified'] = '1';
                    $teacher = Teacher::create($data);

                    //save job name to history ...
                    $job_data['teacher_id'] = $teacher->id;
                    $job_data['job_name_id'] = $request->job_name;
                    Teacher_job_name_history::create($job_data);
                    $teacher->code = $code;
                    if ($teacher->save()) {
                        //send notification to admin panel
                        $data_notify['teacher_id'] = $teacher->id;
                        $data_notify['type'] = 'teacher';
                        $data_notify['message_type'] = 'new_teacher';
                        $data_notify['title_ar'] = 'معلم جديد منضم';
                        $data_notify['title_en'] = 'New teacher joined';
                        $data_notify['message_ar'] = 'تم انضمام معلم جديد الى النظام -  ' . $teacher->user_name;
                        $data_notify['message_en'] = 'A new teacher has been added to the system.' . $teacher->user_name;
                        Admin_notification::create($data_notify);

                        //mail_here
//                        $email = $request->email;
//                        $data_verify['email'] = $email;
//                        $data_verify['type'] = "teacher";
//                        $data_verify['code'] = $code;
//                        $data_verify['lang'] = $teacher->main_lang;
//                        $teacher->notify(new VerfiyRegister($data_verify));
                    }
                    return response()->json(msgdata($request, success(), trans('s_admin.request_added'), $teacher));
                } else if ($type == 'far_learn') {
                    $data['epo_type'] = 'far_learn';
                    $data['status'] = 'active';
                    $data['is_new'] = 'y';
                    $data['interview'] = 'y';
                    $data['complete_data'] = '1';

                    unset($data['zone_id']);
                    unset($data['city_id']);
                    unset($data['district_id']);
                    unset($data['district_id']);
                    unset($data['subject_id']);
                    unset($data['subject_level_id']);
                    unset($data['episode_id']);
                    $data['is_verified'] = '1';
                    $student = Student::create($data);

                    if ($student->save()) {
                        // save student history
                        if ($request->level_id != null) {
                            $history_data['student_id'] = $student->id;
                            $history_data['level_id'] = $request->level_id;
                            $history_data['subject_id'] = $request->subject_id;
                            $history_data['subject_level_id'] = $request->subject_level_id;
                            $history_data['notes_ar'] = 'أول  منهج  للطالب بعد تسجيل الحساب';
                            $history_data['notes_en'] = 'The first course of the student after registering the account';
                            Student_level_history::create($history_data);
                        }
                        //save selected_episode ...
                        if ($request->episode_id) {

                            $episode_data['episode_id'] = $request->episode_id;
                            $episode_data['student_id'] = $student->id;
                            Episode_student::create($episode_data);
                        }
                        //send notification to admin panel
                        $data_notify['student_id'] = $student->id;
                        $data_notify['type'] = 'student';
                        $data_notify['message_type'] = 'new_student';
                        $data_notify['title_ar'] = 'طالب جديد منضم';
                        $data_notify['title_en'] = 'New teacher joined';
                        $data_notify['message_ar'] = 'تم انضمام طالب جديد الى النظام -  ' . $student->user_name;
                        $data_notify['message_en'] = 'A new student has been added to the system.' . $student->user_name;
                        Admin_notification::create($data_notify);

                        if ($age < 10) {
                            $parent_data['student_id'] = $student->id;
                            $parent_data['user_name'] = $request->parent_user_name;
                            $parent_data['parent_country_code'] = $request->parent_country_code;
                            $parent_data['phone'] = $request->parent_phone;
                            $parent_data['address'] = $request->address;
                            $parent_data['relation'] = $request->relation;
                            Student_parent::create($parent_data);
                        }
                        $student->parent_data = 'complete';
                        $student->code = $code;

                        if ($student->save()) {
                            //mailHere
//                            $email = $request->email;
//                            $data_verify['code'] = $code;
//                            $data_verify['type'] = "student";
//                            $data_verify['email'] = $email;
//                            $data_verify['lang'] = $student->main_lang;
//                            $student->notify(new VerfiyRegister($data_verify));
                            //send here by sms
                        }
                    }
                    return response()->json(msgdata($request, success(), trans('s_admin.request_added'), $student));
                } else if ($type == 'mogmaa_dorr') {
                    if ($request->gender == 'male') {
                        $data['epo_type'] = 'mogmaa';
                    } else if ($request->gender == 'female') {
                        $data['epo_type'] = 'dorr';
                    }
                    $data['status'] = 'active';
                    $student = Student::create($data);
                    $student->code = $code;
                    if ($student->save()) {
                        $age = \Carbon\Carbon::parse($data['date_of_birth'])->age;
                        if ($age < 18) {
                            $student->parent_data = 'not_complete';
                            $student->save();
                            return response()->json(msg($request, success(), trans('s_admin.compleate_parent_data')));
                        }
                        $email = $request->email;
                        Mail::raw('your activation code is: ' . $code . '  رابط الموقع هنا :  ' . env('APP_URL'), function ($message) use ($email) {
                            $message->subject(trans('s_admin.title'));
                            $message->from('far_learn@maqrah.info', 'online learning');
                            $message->to($email);
                        });
                    }
                }
                if ($type == 'teacher_far_learn' || $type == 'teacher_mogmaa_dorr') {
                    $person_type = 'teacher';
                    return response()->json(msgdata($request, success(), trans('s_admin.request_added'), $person_type));
                } else {
                    $person_type = 'student';
                    return response()->json(msgdata($request, success(), trans('s_admin.see_email_verification'), $person_type));
                }
            }
        }
    }

    public function logout(Request $request)
    {
        $api_token = $request->header('apitoken');
        $user = check_api_token($api_token);
        if (!$user) {
            return response()->json(msg($request, not_authoize(), trans('s_admin.not_authorize')));
        }
        if ($user->type == 'teacher') {
            $target = Teacher::findOrFail($user->id);
        } elseif ($user->type == 'student') {
            $target = Student::findOrFail($user->id);
        }
        $target->fcm_token = null;
        $target->api_token = null;
        if ($target->save()) {
            return response()->json(msg($request, success(), 'logout_success'));
        } else {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
    }

    public function account_delete(Request $request)
    {
        $api_token = $request->header('apitoken');
        $user = check_api_token($api_token);
        if (!$user) {
            return response()->json(msg($request, not_authoize(), trans('s_admin.not_authorize')));
        }
        if ($user->type == 'teacher') {
            $target = Teacher::findOrFail($user->id);
            Episode::where('teacher_id', $target->id)->update(['teacher_id'=> null]);
            Admin_notification::where('teacher_id', $target->id)->delete();
            Episode_teacher::where('teacher_id', $target->id)->delete();

        } elseif ($user->type == 'student') {
            $target = Student::findOrFail($user->id);
            Admin_notification::where('student_id', $target->id)->delete();
            Student_parent::where('student_id', $target->id)->delete();
            Episode_student::where('student_id', $target->id)->delete();
            Plan_section_degree::where('student_id', $target->id)->delete();
            Student_episode_rate::where('student_id', $target->id)->delete();
            Student_teacher_rate::where('student_id', $target->id)->delete();
        }
        $target->forceDelete();
        return response()->json(msg($request, success(), trans('s_admin.deleted_s')));
    }


    public function forget_password_send_code(Request $request)
    {
        $lang = $request->header('lang');
        $rules = [
            'country_code' => 'required',
            'phone' => 'required',
        ];
        if ($request->country_code) {
            $phone = $request->country_code . $request->phone;
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {
            $code = rand(1000, 9999);
            //check exists account ...
            $student = Student::where('user_phone', $phone)->first();
            if ($student) {
                $student->code = $code;
                $student->save();
            }
            $teacher = Teacher::where('user_phone', $phone)->first();
            if ($teacher) {
                $teacher->code = $code;
                $teacher->save();
            }
            if ($student || $teacher) {
                //Create Password Reset Token

                DB::table('password_resets')->insert([
                    'email' => $phone,
                    'token' => $code,
                    'created_at' => Carbon::now()
                ]);
                //send sms
                if ($lang == 'ar') {
                    $message = 'كود التحقق من الجوال لاعادة تعيين كلمة المرور : ' . $code;
                } else {
                    $message = 'Mobile Verification Code to Reset Password : ' . $code;
                }
                $this->SendSMS($phone, $message);
                $data['reset_code'] = $code;
                return response()->json(msgdata($request, success(), trans('s_admin.phone_checked_created'), $data));
            } else {
                return response()->json(msgdata($request, failed(), trans('s_admin.no_account'), (object)[]));
            }
        }
    }

    public function firebase_cases_test(Request $request)
    {
        $lang = $request->header('lang');
        $rules = [
            'title' => 'required',
            'body' => 'required',
            'type' => 'required|in:student_join_episode,student_rated',
            'student_id' => 'nullable|exists:students,id|required_if:type,==,student_rated',
            'teacher_id' => 'nullable|exists:teachers,id|required_if:type,==,student_join_episode',
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {
            if ($request->type == 'student_rated') {
                $receiver = Student::findOrFail($request->student_id);
                if ($receiver->fcm_token == null) {
                    return response()->json(msg($request, failed(), 'you should choose student have fcm_token'));
                }
            } elseif ($request->type == 'student_join_episode') {
                $receiver = Teacher::findOrFail($request->teacher_id);
                if ($receiver->fcm_token == null) {
                    return response()->json(msg($request, failed(), 'you should choose teacher have fcm_token'));
                }
            }
            send($receiver->fcm_token, $request->title, $request->body, $request->type, null);
            return response()->json(msg($request, success(), 'notification sent successfully'));
        }
    }

    public function forget_password_check_code(Request $request)
    {
        $lang = $request->header('lang');
        $rules = [
            'country_code' => 'required',
            'phone' => 'required',
            'code' => 'required',
        ];
        if ($request->country_code) {
            $phone = $request->country_code . $request->phone;
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {
            //check exists account ...
            $student = Student::where('user_phone', $phone)->where('code', $request->code)->first();
            $teacher = Teacher::where('user_phone', $phone)->where('code', $request->code)->first();
            if ($student || $teacher) {
                $data['code_validated'] = true;
                return response()->json(msgdata($request, success(), trans('s_admin.checked'), $data));
            } else {
                $data['code_validated'] = false;
                return response()->json(msgdata($request, failed(), trans('s_admin.no_phone_check_found'), $data));
            }
        }
    }

    public function forget_password_change_password(Request $request)
    {
        $lang = $request->header('lang');
        $rules = [
            'country_code' => 'required',
            'phone' => 'required',
            'password' => 'required|confirmed',
        ];
        if ($request->country_code) {
            $phone = $request->country_code . $request->phone;
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {
            //check exists account ...
            $students = Student::where('user_phone', $phone)->get();
            if (count($students) > 0) {
                foreach ($students as $student) {
                    Student::where('id', $student->id)->update(
                        ['password' => bcrypt(request('password'))]
                    );
                }
            }
            $teachers = Teacher::where('user_phone', $phone)->get();
            if (count($teachers) > 0) {
                foreach ($teachers as $teacher) {
                    Teacher::where('id', $teacher->id)->update(
                        ['password' => bcrypt(request('password'))]
                    );
                }
            }
            $data['password_changed'] = true;
            return response()->json(msgdata($request, success(), trans('s_admin.pass_changes_log_in_now'), $data));
        }
    }

    public function verify_account(Request $request)
    {
        $data = $request->all();
        $rules = [
            'email' => 'required',
            'code' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {
            $student = Student::where('email', $request->email)->where('code', $request->code)->first();
            if ($student != null) {

                //end automatic login
                $student->is_verified = '1';
                $student->code = null;
                $student->save();
                $inbox = Inbox::create([
                    'message' => trans('admin.welcome_msg'),
                    'subject' => trans('admin.welcome_subject'),
                    'sender_id' => User::first()->id,
                    'receiver_id' => $student->id,
                    'sender_type' => "admin",
                    'receiver_type' => "student"
                ]);
                return response()->json(msg($request, success(), trans('s_admin.account_checked_s')));
            } else {
                $teacher = Teacher::where('email', $request->email)->where('code', $request->code)->first();
                if ($teacher != null) {
                    //end automatic login
                    $teacher->is_verified = '1';
                    $teacher->code = null;
                    $teacher->save();
                    $inbox = Inbox::create([
                        'message' => trans('admin.welcome_msg'),
                        'subject' => trans('admin.welcome_subject'),
                        'sender_id' => User::first()->id,
                        'receiver_id' => $teacher->id,
                        'sender_type' => "admin",
                        'receiver_type' => "teacher"
                    ]);
                    return response()->json(msg($request, success(), trans('s_admin.account_checked_s')));
                } else {
                    return response()->json(msg($request, failed(), trans('s_admin.check_data_first')));

                }
            }

        }

    }

    public function resend_verify_email(Request $request)
    {
        $data = $request->all();
        $rules = [
            'email' => 'required',
            'type' => 'required|in:student,teacher'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {
            $type = $request->type;
            $email = $request->email;
            if ($type == 'teacher') {
                $user = Teacher::where('is_verified', '0')->where('email', $email)->first();
            } else if ($type == 'student') {
                $user = Student::where('is_verified', '0')->where('email', $email)->first();
            }
            if ($user != null) {
                if ($user->is_verified == '0') {
                    $code = rand(1000, 9999);
                    $user->code = $code;
                    if ($user->save()) {
//                    mail_here
                        $data_verify['lang'] = $user->main_lang;
                        $data_verify['email'] = $email;
                        $data_verify['type'] = $type;
                        $data_verify['code'] = $code;
                        $user->notify(new VerfiyRegister($data_verify));
                        return response()->json(msg($request, success(), trans('s_admin.resend_done')));
                    } else {
                        Alert::error(trans('s_admin.error'), trans('s_admin.wrong'));
                        $person_type = $type;
                        return view('front.login.verify_email', compact('email', 'person_type'));
                    }
                } else {
                    return response()->json(msg($request, failed(), trans('s_admin.this_email_active')));
                }
            } else {
                return response()->json(msg($request, failed(), trans('s_admin.no_email_found')));
            }
        }
    }

    public function check_second_step(Request $request)
    {

        $rules = [
            'unique_name' => 'required|unique:teachers,unique_name|unique:students,unique_name|unique:users,unique_name',
            'country_code' => 'required',
            'phone' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            $data['correct'] = false;
            return response()->json(msgdata($request, failed(), $validator->messages()->first()), $data);
        } else {
            $user_phone = $request->country_code . $request->phone;
            if ($request->type == 'teacher_far_learn' || $request->type == 'teacher_mogmaa_dorr ') {
                $exists_user = Teacher::where('user_phone', $user_phone)->first();
            } else {
                $exists_user = Student::where('user_phone', $user_phone)->first();
            }
            if ($exists_user) {
                $data['correct'] = false;
            } else {
                $data['correct'] = true;
            }
            return response()->json(msgdata($request, success(), trans('s_admin.account_checked_s'), $data));
        }
    }

    public function send_phone_check_code(Request $request)
    {
        $lang = $request->header('lang');
        $type = $request->type ;
        if ($type == 'far_learn' || $type == 'mogmaa_dorr' ) {
            $rules = [
                'country_code' => 'required',
                'phone' => 'required|unique:students,phone',
                'type' => 'required|in:far_learn,mogmaa_dorr,teacher_far_learn,teacher_mogmaa_dorr'
            ];
        }else{
            $rules = [
                'country_code' => 'required',
                'phone' => 'required|unique:teachers,phone',
                'type' => 'required|in:far_learn,mogmaa_dorr,teacher_far_learn,teacher_mogmaa_dorr'
            ];
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {
            $phone = $request->country_code . $request->phone;
            $exists_phone = Phone_check::where('phone', $phone)->where('checked', 0)->first();
            if ($exists_phone) {
                if ($request->resend == 1) {
                    $code = (string)rand('1000', '9999');
                    $exists_phone->code = $code;
                    $exists_phone->save();
                    if ($lang == 'ar') {
                        $message = 'مقرأة عنيزة الإلكترونية , كود التحقق من الجوال هو : ' . $code;
                    } else {
                        $message = 'miqra\'a Unaizah electronic , OTP code for verify phone number is : ' . $code;
                    }
                    $this->SendSMS($phone, $message);
                    return response()->json(msgdata($request, success(), trans('s_admin.phone_checked_created'), $exists_phone));
                } else {
                    return response()->json(msgdata($request, success(), trans('s_admin.phone_checked_created'), $exists_phone));
                }
            } else {
                $data['checked'] = 0;
                $data['phone'] = $phone;
                $data['code'] = (string)rand('1000', '9999');
                $phone_check = Phone_check::create($data);
                if ($lang == 'ar') {
                    $message = 'مقرأة عنيزة الإلكترونية , كود التحقق من الجوال هو : ' . $phone_check->code;
                } else {
                    $message = 'miqra\'a Unaizah electronic , OTP code for verify phone number is : ' . $phone_check->code;
                }
                $this->SendSMS($phone, $message);
                return response()->json(msgdata($request, success(), trans('s_admin.phone_checked_created'), $phone_check));
            }
        }
    }

    public function check_phone(Request $request)
    {
        $rules = [
            'country_code' => 'required',
            'phone' => 'required',
            'code' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {
            $phone = $request->country_code . $request->phone;
            $exists_phone = Phone_check::where('checked', 0)->where('phone', $phone)->where('code', $request->code)->first();
            if ($exists_phone) {
                $result['checked'] = true;
                $exists_phone->checked = 1;
                $exists_phone->save();
                return response()->json(msgdata($request, success(), trans('s_admin.phone_checked_s'), $result));
            } else {
                $result['checked'] = false;
                return response()->json(msgdata($request, failed(), trans('s_admin.no_phone_check_found'), $result));
            }
        }
    }

//    email check
    public function send_email_check_code(Request $request)
    {
        $lang = $request->header('lang');
        $rules = [
            'email' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {
            $code = (string)rand('1000', '9999');
            $email = $request->email;
            $exists_email = Phone_check::where('phone', $email)->where('checked', 0)->first();
            if (!$exists_email) {
                $data['checked'] = 0;
                $data['phone'] = $email;
                $data['code'] = $code;
                $phone_check = Phone_check::create($data);
                if ($lang == 'ar') {
                    $message = 'مقرأة عنيزة الإلكترونية , كود التحقق من الجوال هو : ' . $phone_check->code;
                } else {
                    $message = 'miqra\'a Unaizah electronic , OTP code for verify phone number is : ' . $phone_check->code;
                }
                if ($lang == 'ar') {
                    Mail::raw('مقرأة عنيزة الإلكترونية , كود التحقق من البريد الإلكتروني هو : ' . $code, function ($message) use ($email) {
                        $message->subject(trans('s_admin.title'));
                        $message->from(env('MAIL_USERNAME'), 'online learning');
                        $message->to($email);
                    });
                } else {
                    Mail::raw('miqra\'a Unaizah electronic , OTP code for verify email is : ' . $code, function ($message) use ($email) {
                        $message->subject(trans('s_admin.title'));
                        $message->from(env('MAIL_USERNAME'), 'online learning');
                        $message->to($email);
                    });
                }
                return response()->json(msgdata($request, success(), trans('s_admin.email_checked_created'), $phone_check));
            } else {
                if ($request->resend == 1) {
                    $code = (string)rand('1000', '9999');
                    $exists_email->code = $code;
                    $exists_email->save();
                    if ($lang == 'ar') {
                        $message = 'مقرأة عنيزة الإلكترونية , كود التحقق من الجوال هو : ' . $exists_email->code;
                    } else {
                        $message = 'miqra\'a Unaizah electronic , OTP code for verify phone number is : ' . $exists_email->code;
                    }
                    if ($lang == 'ar') {
                        Mail::raw('مقرأة عنيزة الإلكترونية , كود التحقق من البريد الإلكتروني هو : ' . $code, function ($message) use ($email) {
                            $message->subject(trans('s_admin.title'));
                            $message->from(env('MAIL_USERNAME'), 'online learning');
                            $message->to($email);
                        });
                    } else {
                        Mail::raw('miqra\'a Unaizah electronic , OTP code for verify email is : ' . $code, function ($message) use ($email) {
                            $message->subject(trans('s_admin.title'));
                            $message->from(env('MAIL_USERNAME'), 'online learning');
                            $message->to($email);
                        });
                    }
                    return response()->json(msgdata($request, success(), trans('s_admin.phone_checked_created'), $exists_email));
                } else {
                    return response()->json(msgdata($request, success(), trans('s_admin.email_checked_created'), $exists_email));
                }
            }
        }
    }

    public function check_email(Request $request)
    {
        $rules = [
            'email' => 'required',
            'code' => 'required'
        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        } else {
            $email = $request->email;
            $exists_phone = Phone_check::where('checked', 0)->where('phone', $email)->where('code', $request->code)->first();
            if ($exists_phone) {
                $result['checked'] = true;
                $exists_phone->checked = 1;
                $exists_phone->save();
                return response()->json(msgdata($request, success(), trans('s_admin.email_checked_s'), $result));
            } else {
                $result['checked'] = false;
                return response()->json(msgdata($request, failed(), trans('s_admin.no_email_check_found'), $result));
            }
        }
    }
}
