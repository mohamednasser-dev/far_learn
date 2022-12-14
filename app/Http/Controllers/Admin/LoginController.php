<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin_notification;
use App\Models\Episode;
use App\Models\Episode_student;
use App\Models\Parent_student;
use App\Models\Phone_check;
use App\Models\Student_level_history;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use App\Models\Teacher_job_name_history;
use RealRashid\SweetAlert\Facades\Alert;
use App\Notifications\VerfiyRegister;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\Student_parent;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Inbox;
use App\Models\User;

class   LoginController extends Controller
{
    public function __construct()
    {
        if (\Auth::guard('web')->check()) {
            return redirect('/home');
        } else if (\Auth::guard('teacher')->check()) {
            return redirect('teacher/home');
        } else if (\Auth::guard('student')->check()) {
            return redirect('student/home');
        }
    }

    public function login(Request $request)
    {
        $remeber = Request('Remember') == 1 ? true : false;

        if (auth::guard('web')->attempt(['email' => Request('email'), 'password' => Request('password')], $remeber)) {
            //Check if active user or not
            if (Auth::user()->status != 'active') {
                Auth::logout();
                session()->flash('danger', trans('admin.not_auth'));
                return redirect('login');
            } else {
                return redirect('/home');
            }
        } else {
            session()->flash('danger', trans('admin.invaldemailorpassword'));
            return redirect('login');
        }
    }

    public function login_both(Request $request)
    {
        $user_phone = $request->country_code . $request->phone;

        $remeber = Request('Remember') == 1 ? true : false;
        if (auth::guard('teacher')->attempt(['user_phone' => $user_phone, 'password' => Request('password')], $remeber)) {
            if (auth()->guard('teacher')->user()->is_verified == '0') {
                $email = auth()->guard('teacher')->user()->email;
                Auth::guard('teacher')->logout();
                Alert::warning(trans('s_admin.warning'), trans('s_admin.you_should_active'));
                $person_type = 'teacher';
                return view('front.login.verify_email', compact('email', 'person_type'));
            }
            if (auth()->guard('teacher')->user()->is_new == 'y') {
                Auth::guard('teacher')->logout();
                Alert::warning(trans('s_admin.confirmation_acc'), trans('s_admin.you_not_accepted_yet'));
                return back();
            }
            if (auth()->guard('teacher')->user()->is_new == 'rejected') {
                Auth::guard('teacher')->logout();
                Alert::warning(trans('s_admin.confirmation_acc'), trans('s_admin.you_rejected'));
                return back();
            }
            //Check if active user or not
            if (auth()->guard('teacher')->user()->status != 'active') {
                Auth::guard('teacher')->logout();
                Alert::warning(trans('s_admin.activation'), trans('s_admin.you_not_active'));
                return back();
            } else {
                Alert::success(trans('admin.login_done'), trans('admin.hello'));
                return redirect('teacher/home');
            }
        } else if (auth::guard('student')->attempt(['user_phone' => $user_phone, 'password' => Request('password')], $remeber)) {
            if (auth()->guard('student')->user()->parent_data == 'not_complete') {
                $student_id = auth()->guard('student')->user()->id;
                Auth::guard('student')->logout();
                Alert::warning(trans('s_admin.warning'), trans('admin.you_should_complete_parent_data'));
                return redirect(url('/' . $student_id . '/student_parent'));
            }
            if (auth()->guard('student')->user()->is_verified == '0') {
                $email = auth()->guard('student')->user()->email;
                Auth::guard('student')->logout();
                Alert::warning(trans('s_admin.warning'), trans('s_admin.you_should_active'));
                $person_type = 'student';
                return view('front.login.verify_email', compact('email', 'person_type'));
            }
            if (auth()->guard('student')->user()->complete_data == 1) {
                if (auth()->guard('student')->user()->is_new == 'y') {
                    Auth::guard('student')->logout();
                    Alert::warning(trans('s_admin.confirmation_acc'), trans('s_admin.you_not_accepted_yet'));
                    return back();
                }
            }
            if (auth()->guard('student')->user()->is_new == 'rejected') {
                Auth::guard('student')->logout();
                Alert::warning(trans('s_admin.confirmation_acc'), trans('s_admin.you_rejected'));
                return back();
            }
            //Check if active user or not
            if (auth()->guard('student')->user()->status != 'active') {
                Auth::guard('student')->logout();
                Alert::warning(trans('s_admin.activation'), trans('s_admin.you_not_active'));
                return back();
            } else {
                Alert::success(trans('admin.login_done'), trans('admin.hello'));
                return redirect('student/home');
            }
        } else if (auth::guard('web')->attempt(['user_phone' => $user_phone, 'password' => Request('password')], $remeber)) {
            //Check if active user or not
            if (auth()->guard('web')->user()->is_new == 'y') {
                Auth::guard('web')->logout();
                Alert::warning(trans('s_admin.confirmation_acc'), trans('s_admin.you_not_accepted_yet'));
                return back();
            }
            if (auth()->guard('web')->user()->is_new == 'rejected') {
                Auth::guard('web')->logout();
                Alert::warning(trans('s_admin.confirmation_acc'), trans('s_admin.you_rejected'));
                return back();
            }
            if (auth()->guard('web')->user()->status != 'active') {
                Auth::logout();
                Alert::error(trans('admin.login'), trans('s_admin.pass_email_wrong_title'));
                return back();
            } else {
                Alert::success(trans('admin.login_done'), trans('admin.hello'));
                return redirect('/home');
            }
        } else {
            Alert::error(trans('s_admin.invalid_informations'), trans('admin.invaldemailorpassword'));
            return back();
        }
    }

    public function sign_up($type)
    {
        $types = $type;
        if ($type == 'far_learn') {
            return redirect(route('times.before.register', ['type' => 'all', 'page_type' => $type]));
        } elseif ($type == 'mogmaa_dorr') {
            return redirect(route('times.before.register', ['type' => 'all', 'page_type' => $type]));
        } else {
            $episode_id = 0;
            return view('front.login.teacher_login', compact('types', 'episode_id'));
        }
    }

    public function custom_sign_up($episode_id, $types)
    {
        $episode = Episode::findOrFail($episode_id);
        return view('front.login.teacher_login', compact('types', 'episode_id', 'episode'));
    }

    public function verify_email()
    {
        return view('front.login.verify_email');
    }

    public function teacher_verify_email()
    {
        return view('front.login.verify_email');
    }

    public function show_login()
    {
        return view('front.login');
    }

    public function store(Request $request, $type)
    {
        $user_phone = $request->country_code . $request->phone;
        $data = $request->all();
        unset($data['p_c']);
        unset($data['e_c']);
        unset($data['pa_c']);
        if ($request->country_code == 'Egypt') {
            $data['country_code'] = '+966';
        }
        if ($request->parent_country_code == 'Egypt') {
            $data['parent_country_code'] = '+966';
        }
        $data['unique_name'] = time() . '_' . rand(1000, 9999);
        $age = \Carbon\Carbon::parse($data['date_of_birth'])->age;
        if ($type == 'far_learn' || $type == 'mogmaa_dorr') {
            $exists_student = Student::where('user_phone', $user_phone)->first();
            if ($exists_student) {
                Alert::error(trans('s_admin.error'), trans('s_admin.phone_exists_before'));
                return back()->withInput();
            }
            if ($age < 10) {
                $rules =
                    [
//                        'unique_name' => 'required|unique:teachers,unique_name|unique:students,unique_name|unique:users,unique_name',
                    'password' => 'required|min:8|confirmed',
                    'password_confirmation' => 'required|min:8',
                    'first_name_ar' => 'required',
                    'mid_name_ar' => 'required',
                    'last_name_ar' => 'required',
                    'gender' => 'required',
                    'email' => 'required|email:rfc,dns|unique:students,email',
                    'main_lang' => 'required',
                    'date_of_birth' => 'required',
                    'country' => 'required',
                    'phone' => 'required|unique:students,phone',
                    'qualification' => 'required',
                    'nationality' => 'required',
                    'parent_user_name' => 'required',
                    'parent_phone' => 'required',
                    'relation' => 'required',
                    'parent_country_code' => 'required',
                    'address' => 'required',
                    'country_code' => 'required'
                ];
            } else {
                $rules =
                    [
//                        'unique_name' => 'required|unique:teachers,unique_name|unique:students,unique_name|unique:users,unique_name',
                    'password' => 'required|min:8|confirmed',
                    'password_confirmation' => 'required|min:8',
                    'first_name_ar' => 'required',
                    'mid_name_ar' => 'required',
                    'last_name_ar' => 'required',
                    'gender' => 'required',
                    'email' => 'required|email:rfc,dns|unique:students,email',
                    'main_lang' => 'required',
                    'date_of_birth' => 'required',
                    'country' => 'required',
                    'phone' => 'required|unique:students,phone',
                    'qualification' => 'required',
                    'nationality' => 'required',
                    'country_code' => 'required'
                ];
            }
        } else {
            $exists_teacher = Teacher::where('user_phone', $user_phone)->first();
            if ($exists_teacher) {
                Alert::error(trans('s_admin.error'), trans('s_admin.phone_exists_before'));
                return back()->withInput();
            }
            $rules =
                [
//                    'unique_name' => 'required|unique:teachers,unique_name|unique:students,unique_name|unique:users,unique_name',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8',
                'first_name_ar' => 'required',
                'mid_name_ar' => 'required',
                'last_name_ar' => 'required',
                'gender' => 'required',
                'email' => 'required|email:rfc,dns|unique:teachers,email',
                'main_lang' => 'required',
                'date_of_birth' => 'required',
                'country' => 'required',
                'phone' => 'required|unique:teachers,phone',
                'qualification' => 'required',
                'nationality' => 'required',
                'country_code' => 'required',
                'cv' => ''
            ];
        }
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
//            return response()->json(['status' => 401, 'msg' => $validator->messages()->first()]);

            Alert::error(trans('s_admin.error'), $validator->messages()->first());
            return back()->withInput();
//            return response()->json(['success'=>$validator->messages()]);
//            return response(['status' => false, 'msg' => $validator->messages()->first()]);

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
            //to git out children people
            $age = \Carbon\Carbon::parse($data['date_of_birth'])->age;
//            if($age < 11){
//                Alert::error(trans('s_admin.error'), trans('s_admin.you_are_less_than'));
//                return back();
//            }
            $password = bcrypt(request('password'));
            $data['password'] = $password;
            $data['first_name_en'] = $request->first_name_ar;
            $data['mid_name_en'] = $request->mid_name_ar;
            $data['last_name_en'] = $request->last_name_ar;
            $data['user_name'] = $request->first_name_ar . " " . $request->mid_name_ar . " " . $request->last_name_ar;
            if (env('APP_ENV') == 'production') {
                $code = random_int(1000, 9999);
            }else{
                $code = 1234;
            }
            if ($type == 'teacher_far_learn' || $type == 'teacher_mogmaa_dorr') {
                //check if employee or teacher ...
                if($request->job_name == 7){
                    $emp_data['name'] = $data['user_name'] ;
                    $emp_data['unique_name'] = $data['unique_name'];
                    $emp_data['phone'] = $request->phone;
                    $emp_data['email'] = $request->email;
                    $emp_data['password'] = $data['password'] ;
                    $emp_data['role_id'] = 8;
                    $emp_data['type'] = 'user';
                    $emp_data['main_lang'] = $request->main_lang;
                    $emp_data['gender'] = $request->gender;
                    $emp_data['status'] = 'active';
                    $emp_data['country_code'] = $request->country_code;
                    $emp_data['user_phone'] = $data['user_phone'];
                    $emp_data['is_new'] = 'y';
                    $user = User::create($emp_data);
                    if ($user) {
                        $user->roles()->sync([8]);
                        $user->save();

                        //send notification to admin panel
                        $data_notify['user_id'] = $user->id ;
                        $data_notify['type'] = 'admin';
                        $data_notify['message_type'] = 'new_user';
                        $data_notify['title_ar'] = 'موظف جديد منضم';
                        $data_notify['title_en'] = 'New employee joined';
                        $data_notify['message_ar'] = 'تم انضمام موظف جديد الى النظام -  ' . $user->user_name;
                        $data_notify['message_en'] = 'A new employee has been added to the system.' . $user->user_name;
                        Admin_notification::create($data_notify);
                    }
                }else{
                    if ($type == 'teacher_far_learn') {
                        $data['epo_type'] = 'far_learn';
                    } else if ($type == 'teacher_mogmaa_dorr') {
                        if ($request->gender == 'male') {
                            $data['epo_type'] = 'mogmaa';
                        } else if ($request->gender == 'female') {
                            $data['epo_type'] = 'dorr';
                        }
                    }
                    $data['job_name'] = $request->job_name;
                    $data['ident_num'] = $request->ident_num;

                    //save cv fiile
                    if ($request->cv != null) {
                        $file = $request->file('cv');

                        $ext = $file->getClientOriginalExtension();
                        // Move Image To Folder ..
                        $fileNewName = 'cv_' . time() . '.' . $ext;
                        $file->move(public_path('uploads/teachers/cvs'), $fileNewName);
                        $data['cv'] = $fileNewName;
                    }
                    unset($data['save_quran_num']);
                    unset($data['save_quran_limit']);
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
//                    $email = $request->email;
//                    $data_verify['email'] = $email;
//                    $data_verify['type'] = "teacher";
//                    $data_verify['code'] = $code;
//                    $data_verify['lang'] = $teacher->main_lang;
//                    $teacher->notify(new VerfiyRegister($data_verify));
                    }
                }

            } else if ($type == 'far_learn') {
                //check episode selected is avilabel now
                $selected_epo = Episode::findOrFail($request->episode_id);
                if (count($selected_epo->Students) >= $selected_epo->student_number) {
//                    Alert::success(trans('s_admin.alert'), trans('s_admin.alert_episode_complete'));
                    return redirect()->route('sign_up', ['type' => 'far_learn'])->with('danger', trans('s_admin.alert_episode_complete'));
                }
                $data['epo_type'] = 'far_learn';
                $data['status'] = 'active';
                $data['is_new'] = 'y';
                $data['interview'] = 'y';
                $data['complete_data'] = '1';
                //$data['level_id'] = $request->level_id;
                unset($data['zone_id']);
                unset($data['city_id']);
                unset($data['district_id']);
                unset($data['district_id']);
                unset($data['subject_id']);
                unset($data['subject_level_id']);
                $data['is_verified'] = '1';
                $student = Student::create($data);
                if ($student->save()) {
                    // save student history
                    if ($request->level_id != null && $request->subject_id != null&& $request->subject_level_id != null ) {
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
                        //check if parent exists before ...
                        $parent_phone = $request->parent_country_code . $request->parent_phone;
                        $exists_parent = Student_parent::where('user_phone', $parent_phone)->first();
                        if ($exists_parent) {
                            $parent_student_data['parent_id'] = $exists_parent->id;
                            $parent_student_data['student_id'] = $student->id;
                            Parent_student::create($parent_student_data);
                        } else {
                            $parent_data['student_id'] = $student->id;
                            $parent_data['user_name'] = $request->parent_user_name;
                            $parent_data['parent_country_code'] = $request->parent_country_code;
                            $parent_data['phone'] = $request->parent_phone;
                            $parent_data['user_phone'] = $parent_phone;
                            $parent_data['address'] = $request->address;
                            $parent_data['password'] = $password;
                            $parent_data['relation'] = $request->relation;
                            $parent = Student_parent::create($parent_data);
                            $parent_student_data['parent_id'] = $parent->id;
                            $parent_student_data['student_id'] = $student->id;
                            Parent_student::create($parent_student_data);
                        }
                    }
                    $student->parent_data = 'complete';
                    $student->code = $code;
                    if ($student->save()) {
                        //mailHere
//                        $email = $request->email;
//                        $data_verify['code'] = $code;
//                        $data_verify['type'] = "student";
//                        $data_verify['email'] = $email;
//                        $data_verify['lang'] = $student->main_lang;
//                        $student->notify(new VerfiyRegister($data_verify));

                        //send here by sms
                    }
                }
            } else if ($type == 'mogmaa_dorr') {
                if ($request->gender == 'male') {
                    $data['epo_type'] = 'mogmaa';
                } else if ($request->gender == 'female') {
                    $data['epo_type'] = 'dorr';
                }
                $data['status'] = 'active';
                $data['complete_data'] = '1';
                $data['is_verified'] = '1';
                $student = Student::create($data);
                $student->code = $code;
                if ($student->save()) {
                    if ($request->level_id != null && $request->subject_id != null && $request->subject_level_id != null ) {
                        $history_data['student_id'] = $student->id;
                        $history_data['level_id'] = $request->level_id;
                        $history_data['subject_id'] = $request->subject_id;
                        $history_data['subject_level_id'] = $request->subject_level_id;
                        $history_data['notes_ar'] = 'أول  منهج  للطالب بعد تسجيل الحساب';
                        $history_data['notes_en'] = 'The first course of the student after registering the account';
                        Student_level_history::create($history_data);
                    }
                    //send notification to admin panel
                    $data_notify['student_id'] = $student->id;
                    $data_notify['type'] = 'student';
                    $data_notify['message_type'] = 'new_student';
                    $data_notify['title_ar'] = 'طالب جديد منضم';
                    $data_notify['title_en'] = 'New teacher joined';
                    $data_notify['message_ar'] = 'تم انضمام طالب جديد الى النظام -  ' . $student->user_name;
                    $data_notify['message_en'] = 'A new student has been added to the system -' . $student->user_name;
                    Admin_notification::create($data_notify);
                    if ($age < 10) {
                        //check if parent exists before ...
                        $parent_phone = $request->parent_country_code . $request->parent_phone;
                        $exists_parent = Student_parent::where('user_phone', $parent_phone)->first();
                        if ($exists_parent) {
                            $parent_student_data['parent_id'] = $exists_parent->id;
                            $parent_student_data['student_id'] = $student->id;
                            Parent_student::create($parent_student_data);
                        } else {
                            $parent_data['student_id'] = $student->id;
                            $parent_data['user_name'] = $request->parent_user_name;
                            $parent_data['parent_country_code'] = $request->parent_country_code;
                            $parent_data['phone'] = $request->parent_phone;
                            $parent_data['address'] = $request->address;
                            $parent_data['password'] = $password;
                            $parent_data['relation'] = $request->relation;
                            $parent = Student_parent::create($parent_data);
                            $parent_student_data['parent_id'] = $parent->id;
                            $parent_student_data['student_id'] = $student->id;
                            Parent_student::create($parent_student_data);
                        }
                    }
                    $student->parent_data = 'complete';
                    $student->save();
                    //mail_here
//                    $email = $request->email;
//                    $data_verify['email'] = $email;
//                    $data_verify['type'] = "student";
//                    $data_verify['code'] = $code;
//                    $data_verify['lang'] = $student->main_lang;
//                    $student->notify(new VerfiyRegister($data_verify));
                }
            }
//            if ($type == 'teacher_far_learn' || $type == 'teacher_mogmaa_dorr') {
            Alert::success(trans('admin.addedsuccess'), trans('s_admin.wait_admin_to_approve'));
            return redirect()->route('main_page');
//                $person_type = 'teacher';
//                return view('front.login.verify_email', compact('email', 'person_type'));
//            } else {
//                Alert::success(trans('admin.addedsuccess'), trans('s_admin.see_email_verification'));
//                $person_type = 'student';
//                return view('front.login.verify_email', compact('email', 'person_type'));
//            }
        }
    }

    public function student_parent($student_id)
    {
        $selected_student_id = $student_id;
        return view('front.login.student_parent', compact('selected_student_id'));
    }

    public function store_parent(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'user_name' => 'required',
                'phone' => 'required',
                'home_phone' => 'required',
                'relation' => 'required',
                'address' => 'required',
                'student_id' => 'required'
            ]);
        $parent = Student_parent::create($data);
        $parent->save();
        if ($parent->save()) {
            if (env('APP_ENV') == 'production') {
                $code = random_int(1000, 9999);
            }else{
                $code = 1234;
            }
            $student_data['code'] = $code;
            $student_data['parent_data'] = 'complete';
            Student::where('id', $request->student_id)->update($student_data);
            $stud = Student::find($request->student_id);
            $email = $stud->email;
//            mail_here

            $data_verify['email'] = $email;
            $data_verify['type'] = "student";
            $data_verify['code'] = $code;
            $data_verify['lang'] = $stud->main_lang;
            $stud->notify(new VerfiyRegister($data_verify));
//            Mail::raw('رمز التحقق : ' . $code .'  رابط الموقع هنا :  '.env('APP_URL'), function ($message) use ($email) {
//                $message->subject(trans('s_admin.title'));
//                $message->from('far_learn@maqrah.info', 'online learning');
//                $message->to($email);
//            });
            Alert::success(trans('s_admin.warning'), trans('admin.user_create_success'));
//            return redirect(route('verify_email'));
            $person_type = 'student';
            return view('front.login.verify_email', compact('email', 'person_type'));
        }
    }

    public function verify_account(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'email' => 'required',
                'type' => 'required',
                'code' => 'required'
            ]);
        if ($request->type == 'student') {
            $student = Student::where('email', $request->email)->where('code', $request->code)->first();
            if ($student != null) {
                //make automatic login
//                if (auth::guard('student')->attempt(['code' => Request('code'), 'email' => Request('email')])) {

                //end automatic login
                $student->is_verified = '1';
                $student->code = null;
                $student->save();
                if ($student->epo_type == 'far_learn') {
                    Alert::success(trans('s_admin.warning'), trans('s_admin.activation_done_far_learn'));
                } else {
                    Alert::success(trans('s_admin.warning'), trans('s_admin.login_to_continue'));
                }
                $inbox = Inbox::create([
                    'message' => trans('admin.welcome_msg'),
                    'subject' => trans('admin.welcome_subject'),
                    'sender_id' => User::first()->id,
                    'receiver_id' => $student->id,
                    'sender_type' => "admin",
                    'receiver_type' => "student"
                ]);
//                student/home
                return redirect('/');
//                }
            } else {
//              make new code and send it with msg link sent again
                Alert::error(trans('s_admin.warning'), trans('admin.wrong_code'));
                $email = $request->email;
                $person_type = 'student';
                return view('front.login.verify_email', compact('email', 'person_type'));
            }
        } else if ($request->type == 'teacher') {
            $teacher = Teacher::where('email', $request->email)->where('code', $request->code)->first();
            if ($teacher != null) {
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
                Alert::success(trans('s_admin.warning'), trans('admin.activation_done'));
                return redirect('/');
            } else {
                Alert::error(trans('s_admin.warning'), trans('admin.wrong_code'));
                $email = $request->email;
                $person_type = 'teacher';
                return view('front.login.verify_email', compact('email', 'person_type'));
            }
        }
    }


    public function resend_verify(Request $request)
    {
        $type = $request->type;
        $email = $request->email;
        if ($type == 'teacher') {
            $user = Teacher::where('is_verified', '0')->where('email', $email)->first();
        } else if ($type == 'student') {
            $user = Student::where('is_verified', '0')->where('email', $email)->first();
        }
        if ($user != null) {
            if ($user->is_verified == '0') {
                if (env('APP_ENV') == 'production') {
                    $code = random_int(1000, 9999);
                }else{
                    $code = 1234;
                }
                $user->code = $code;
                if ($user->save()) {
//                    mail_here

                    $data_verify['lang'] = $user->main_lang;
                    $data_verify['email'] = $email;
                    $data_verify['type'] = $type;
                    $data_verify['code'] = $code;

                    $user->notify(new VerfiyRegister($data_verify));
//                    Mail::raw('رمز التحقق : ' . $code .'  التوجه لموقع التعليم عن بعد  وتسجيل الدخول لكتابه رمز التحقق من الرابط : '.env('APP_URL'), function ($message) use ($email) {
//                        $message->subject(trans('s_admin.title'));
//                        $message->from('far_learn@maqrah.info', 'online learning');
//                        $message->to($email);
//                    });
                    Alert::success(trans('s_admin.resend'), trans('s_admin.resend_done'));
                    $person_type = $type;
                    return view('front.login.verify_email', compact('email', 'person_type'));
                } else {
                    Alert::error(trans('s_admin.error'), trans('s_admin.wrong'));
                    $person_type = $type;
                    return view('front.login.verify_email', compact('email', 'person_type'));
                }
            } else {
                Alert::warning(trans('s_admin.warning'), trans('s_admin.this_email_active'));
                $person_type = $type;
                return view('front.login.verify_email', compact('email', 'person_type'));
            }
        } else {
            Alert::error(trans('s_admin.error'), trans('admin.no_email_found'));
            $person_type = $type;
            return view('front.login.verify_email', compact('email', 'person_type'));
        }
    }

    public function logout()
    {
        $user = Auth::user();
        Auth::logout();
        return redirect('/');
    }

    public function send_check_phone(Request $request)
    {
        $user_phone = $request->country_code . $request->phone;

        $type = $request->type;
        if ($type == 'far_learn' || $type == 'mogmaa_dorr') {
            $exists_student = Student::where('user_phone',$user_phone)->first();
        }else{
            $exists_student = Teacher::where('user_phone',$user_phone)->first();
        }
        if($exists_student){
            return response(['status' => false,'type'=>'exists']);
        }

        if ($user_phone) {
            $exists_phone = Phone_check::where('phone', $user_phone)->where('checked', 0)->first();
            if (!$exists_phone) {
                if (env('APP_ENV') == 'production') {
                    $code = rand('1000', '9999');
                }else{
                    $code = '1234';
                }
                //create new row
                $data['phone'] = $user_phone;
                $data['code'] = $code;
                $phone_check = Phone_check::create($data);
                if (app()->getLocale() == 'ar') {
                    $message = 'مقرأة عنيزة الإلكترونية , كود التحقق من الجوال هو : ' . $phone_check->code;
                } else {
                    $message = 'miqra\'a Unaizah electronic , OTP code for verify phone number is : ' . $phone_check->code;
                }
                $this->SendSMS($user_phone, $message);
            }
            return response(['status' => true]);
        } else {
            return response(['status' => false]);
        }
    }

    public function resned_check_phone(Request $request)
    {
        $user_phone = $request->country_code . $request->phone;
        if ($user_phone) {
            $exists_phone = Phone_check::where('phone', $user_phone)->where('checked', 0)->first();
            if (env('APP_ENV') == 'production') {
                $code = rand('1000', '9999');
            }else{
                $code = '1234';
            }
            if ($exists_phone) {
                $exists_phone->code = $code;
                $exists_phone->save();
                //phone is resended before ...
                if (app()->getLocale() == 'ar') {
                    $message = 'مقرأة عنيزة الإلكترونية , كود التحقق من الجوال هو : ' . $code;
                } else {
                    $message = 'miqra\'a Unaizah electronic , OTP code for verify phone number is : ' . $code;
                }
                $this->SendSMS($user_phone, $message);
                return response(['status' => true]);
            } else {
                //create new row
                $data['phone'] = $user_phone;
                $data['code'] = $code;
                $phone_check = Phone_check::create($data);
                if (app()->getLocale() == 'ar') {
                    $message = 'مقرأة عنيزة الإلكترونية , كود التحقق من الجوال هو : ' . $phone_check->code;
                } else {
                    $message = 'miqra\'a Unaizah electronic , OTP code for verify phone number is : ' . $phone_check->code;
                }
                $this->SendSMS($user_phone, $message);
                return response(['status' => true]);
            }
        } else {
            return response(['status' => false]);
        }
    }

    public function check_phone(Request $request)
    {
        $user_phone = $request->country_code . $request->phone;
        if ($user_phone) {
            $exists_phone = Phone_check::where('phone', $user_phone)->where('checked', 0)->where('code', $request->code)->first();
            if ($exists_phone) {
                $exists_phone->checked = 1;
                $exists_phone->save();
                return response(['status' => true]);
            } else {
                return response(['status' => false,'type'=>'wrong_code']);
            }
        } else {
            return response(['status' => false]);
        }
    }
    //parent phone check
    public function send_check_parent_phone(Request $request)
    {
        $user_phone = $request->country_code . $request->phone;
        if ($user_phone) {
            $exists_phone = Phone_check::where('phone', $user_phone)->where('checked', 0)->first();
            if (!$exists_phone) {
                if (env('APP_ENV') == 'production') {
                    $code = rand('1000', '9999');
                }else{
                    $code = '1234';
                }
                //create new row
                $data['phone'] = $user_phone;
                $data['code'] = $code;
                $phone_check = Phone_check::create($data);
                if (app()->getLocale() == 'ar') {
                    $message = 'مقرأة عنيزة الإلكترونية , كود التحقق من الجوال هو : ' . $phone_check->code;
                } else {
                    $message = 'miqra\'a Unaizah electronic , OTP code for verify phone number is : ' . $phone_check->code;
                }
                $this->SendSMS($user_phone, $message);
            }
            return response(['status' => true]);
        } else {
            return response(['status' => false]);
        }
    }

    // Begin email check
    public function send_check_email(Request $request)
    {
        $email = $request->email;
        $type = $request->type;
        if ($type == 'far_learn' || $type == 'mogmaa_dorr') {
            $exists_student = Student::where('email',$email)->first();
        }else{
            $exists_student = Teacher::where('email',$email)->first();
        }
        if($exists_student){
            return response(['status' => false,'type'=>'exists']);
        }
        if ($email) {
            $exists_email = Phone_check::where('phone', $email)->where('checked', 0)->first();
            if (!$exists_email) {
                //create new row
                if (env('APP_ENV') == 'production') {
                    $code = rand('1000', '9999');
                }else{
                    $code = '1234';
                }
                $lang = app()->getLocale();

                $data['phone'] = $email;
                $data['code'] = $code;
                $phone_check = Phone_check::create($data);

//                $data_verify['code'] = $code;
//                $data_verify['type'] = "student";
//                $data_verify['email'] = $email;
//                $data_verify['lang'] = $lang;
//                $phone_check->notify(new VerfiyRegister($data_verify));

//                if ($lang == 'ar') {
//                    Mail::raw('مقرأة عنيزة الإلكترونية , كود التحقق من البريد الإلكتروني هو : ' . $code, function ($message) use ($email) {
//                        $message->subject(trans('s_admin.title'));
//                        $message->from(env('MAIL_USERNAME'), 'online learning');
//                        $message->to($email);
//                    });
//                } else {
//                    Mail::raw('miqra\'a Unaizah electronic , OTP code for verify email is : '. $code, function ($message) use ($email) {
//                        $message->subject(trans('s_admin.title'));
//                        $message->from(env('MAIL_USERNAME'), 'online learning');
//                        $message->to($email);
//                    });
//                }
            }
            return response(['status' => true]);
        } else {
            return response(['status' => false,'type'=>'email_required']);
        }
    }

    public function resned_check_email(Request $request)
    {
        $email = $request->email;
        $lang = app()->getLocale();
        if ($email) {
            $exists_email = Phone_check::where('phone', $email)->where('checked', 0)->first();
            if ($exists_email) {
                if (env('APP_ENV') == 'production') {
                    $code = rand('1000', '9999');
                }else{
                    $code = '1234';
                }
                $exists_email->code = $code;
                $exists_email->save();
                //email is resended before ...
//                $data_verify['code'] = $code;
//                $data_verify['type'] = "student";
//                $data_verify['email'] = $email;
//                $data_verify['lang'] = $lang;
//                $exists_email->notify(new VerfiyRegister($data_verify));
                if ($lang == 'ar') {
                    Mail::raw('مقرأة عنيزة الإلكترونية , كود التحقق من الجوال هو : ' . $code, function ($message) use ($email) {
                        $message->subject(trans('s_admin.title'));
                        $message->from(env('MAIL_USERNAME'), 'online learning');
                        $message->to($email);
                    });
                } else {
                    Mail::raw('miqra\'a Unaizah electronic , OTP code for verify phone number is : '. $code, function ($message) use ($email) {
                        $message->subject(trans('s_admin.title'));
                        $message->from(env('MAIL_USERNAME'), 'online learning');
                        $message->to($email);
                    });
                }

                return response(['status' => true]);
            } else {
                if (env('APP_ENV') == 'production') {
                    $code = rand('1000', '9999');
                }else{
                    $code = '1234';
                }
                //create new row
                $data['phone'] = $email;
                $data['code'] = $code;
                $phone_check = Phone_check::create($data);

//                $data_verify['code'] = $phone_check->code;
//                $data_verify['type'] = "student";
//                $data_verify['email'] = $email;
//                $data_verify['lang'] = $lang;
//                $phone_check->notify(new VerfiyRegister($data_verify));
                if ($lang == 'ar') {
                    Mail::raw('مقرأة عنيزة الإلكترونية , كود التحقق من الجوال هو : ' . $phone_check->code, function ($message) use ($email) {
                        $message->subject(trans('s_admin.title'));
                        $message->from(env('MAIL_USERNAME'), 'online learning');
                        $message->to($email);
                    });
                } else {
                    Mail::raw('miqra\'a Unaizah electronic , OTP code for verify phone number is : '. $phone_check->code, function ($message) use ($email) {
                        $message->subject(trans('s_admin.title'));
                        $message->from(env('MAIL_USERNAME'), 'online learning');
                        $message->to($email);
                    });
                }
                return response(['status' => true]);
            }
        } else {
            return response(['status' => false]);
        }
    }

    public function check_email(Request $request)
    {
        $email = $request->email;

        if ($email) {
            $exists_phone = Phone_check::where('phone', $email)->where('checked', 0)->where('code', $request->code)->first();
            if ($exists_phone) {
                $exists_phone->checked = 1;
                $exists_phone->save();
                return response(['status' => true]);
            } else {
                return response(['status' => false,'type'=>'wrong_code']);
            }
        } else {
            return response(['status' => false]);
        }
    }

}
