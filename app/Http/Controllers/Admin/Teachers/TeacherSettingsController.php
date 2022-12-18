<?php

namespace App\Http\Controllers\Admin\Teachers;

use App\Models\Admin_notification;
use App\Models\User;
use App\Models\User_absence;
use App\Models\Web_setting;
use App\Traits\ZoomJWT;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Teacher_job_name_history;
use App\Http\Controllers\Controller;
use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\Episode_teacher;
use App\Models\Teacher_absence;
use App\Models\Student_parent;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Episode;
use Carbon\Carbon;
use Exception;

class TeacherSettingsController extends Controller
{

    use ZoomJWT;

    const MEETING_TYPE_INSTANT = 1;
    const MEETING_TYPE_SCHEDULE = 2;
    const MEETING_TYPE_RECURRING = 3;
    const MEETING_TYPE_FIXED_RECURRING_FIXED = 8;

    public function index($epo_type)
    {
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {
            $episode_ids = Episode::where('college_id', $user->college_id)->where('active', 'y')->where('type', 'mogmaa')->pluck('id')->toArray();
            $episode_teacher_ids = Episode::where('college_id', $user->college_id)->where('active', 'y')->where('type', 'mogmaa')->pluck('teacher_id')->toArray();
            $teacher_ids = Episode_teacher::whereIn('episode_id', $episode_ids)->pluck('teacher_id')->toArray();
            $data = Teacher::whereIn('id', $episode_teacher_ids)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
        } elseif ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) {
            $episode_ids = Episode::where('college_id', $user->college_id)->where('active', 'y')->where('type', 'dorr')->pluck('id')->toArray();
            $episode_teacher_ids = Episode::where('college_id', $user->college_id)->where('active', 'y')->where('type', 'dorr')->pluck('teacher_id')->toArray();
            $teacher_ids = Episode_teacher::whereIn('episode_id', $episode_ids)->whereIn('id', $episode_teacher_ids)->pluck('teacher_id')->toArray();;
            $data = Teacher::whereIn('id', $episode_teacher_ids)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
        } elseif ($user->role_id == 8) {
            $data = Teacher::where('epo_type', $epo_type)->where('gender', $user->gender)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
        } else {
            $data = Teacher::where('epo_type', $epo_type)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
        }
        return view('admin.web_settings.teachers.teachers_settings', compact('data'));
    }

    public function new_join()
    {
        $user = \auth()->user();
        $input['admin_view'] = 1;
        if ($user->role_id == 6) {
            $data = Teacher::where('epo_type', 'mogmaa')->where('is_new', 'y')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
            Admin_notification::whereHas('Teacher', function ($q) {
                $q->where('epo_type', 'mogmaa');
            })->where('readed', '0')->where('message_type', 'new_teacher')->update(['readed' => '1']);
        } elseif ($user->role_id == 7) {
            $data = Teacher::where('epo_type', 'dorr')->where('is_new', 'y')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
            Admin_notification::whereHas('Teacher', function ($q) {
                $q->where('epo_type', 'dorr');
            })->where('readed', '0')->where('message_type', 'new_teacher')->update(['readed' => '1']);
        } elseif ($user->role_id == 8) {
            $data = Teacher::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('is_new', 'y')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
            Admin_notification::whereHas('Teacher', function ($q) {
                $q->where('epo_type', 'far_learn');
            })->where('readed', '0')->where('message_type', 'new_teacher')->update(['readed' => '1']);
        } else {
            $data = Teacher::where('is_new', 'y')->orderBy('created_at', 'desc')->get();
            Admin_notification::where('readed', '0')->where('message_type', 'new_teacher')->update(['readed' => '1']);
        }
        return view('admin.web_settings.teachers.teachers_settings', compact('data'));
    }

    public function teacher_info($teacher_id)
    {
        $data = Teacher::find($teacher_id);
        return view('admin.web_settings.teachers.details', compact('data'));
    }

    public function change_status($id)
    {
        $teacher = Teacher::find($id);
        if ($teacher->status == 'unactive') {
            $teacher->status = 'active';
            $teacher->save();
            Alert::success(trans('s_admin.activation'), trans('s_admin.actived_s'));
            return redirect()->back();
        } else {
            $teacher->status = 'unactive';
            $teacher->save();
            Alert::success(trans('s_admin.activation'), trans('s_admin.un_actived_s'));
            return redirect()->back();
        }
    }

    public function reject($id)
    {
        $teacher = Teacher::find($id);
        $teacher->is_new = 'rejected';
        if ($teacher->save()) {
            $email = $teacher->email;
            $phone = $teacher->country_code . $teacher->phone;
            $settings = Web_setting::where('id', 1)->first();
            if ($teacher->main_lang == 'ar') {
                $title = $settings->title_ar;
                $real_message = 'تم رفضك من قبل الادارة - بموقع  ' . $title . '  رابط الموقع هنا :  ' . env('APP_URL');
            } else {
                $title = $settings->title_en;
                $real_message = 'You have been rejected by the administration - Site  ' . $title . '  Website link here :  ' . env('APP_URL');
            }
            //send mail message
            Mail::raw($real_message, function ($message) use ($email, $title) {
                $message->subject($title);
                $message->from(env('MAIL_USERNAME'), 'online learning');
                $message->to($email);
            });
            //send sms message
            $this->SendSMS($phone, $real_message);
            Alert::success(trans('s_admin.join_orders'), trans('s_admin.rejected_s'));
            return redirect()->back();
        }

    }

    public function accept($id)
    {
        $teacher = Teacher::find($id);
        $teacher->is_new = 'accepted';
        if ($teacher->save()) {
            $email = $teacher->email;
            $settings = Web_setting::where('id', 1)->first();
            $phone = $teacher->country_code . $teacher->phone;
            if ($teacher->main_lang == 'ar') {
                $title = $settings->title_ar;
                $real_message = 'تم قبولك بموقع  ' . $title . '  رابط الموقع هنا :  ' . env('APP_URL');
            } else {
                $title = $settings->title_en;
                $real_message = 'You have been accepted into the site  ' . $title . '  Website link here :  ' . env('APP_URL');
            }
            //send mail message
            Mail::raw($real_message, function ($message) use ($email, $title) {
                $message->subject($title);
                $message->from(env('MAIL_USERNAME'), 'online learning');
                $message->to($email);
            });
            //send sms message
            $this->SendSMS($phone, $real_message);
            Alert::success(trans('s_admin.join_orders'), trans('s_admin.accepted_s'));
            return redirect()->back();
        }
    }

    public function store(Request $request)
    {
        $data = $this->validate(\request(),
            [
//                'unique_name' => 'required|unique:teachers,unique_name|unique:students,unique_name|unique:users,unique_name',
                'password' => 'required|min:8|confirmed',
                'password_confirmation' => 'required|min:8',
                'first_name_ar' => 'required',
                'mid_name_ar' => 'required',
                'last_name_ar' => 'required',
                'gender' => 'required',
                'main_lang' => 'required',
                'email' => 'required|unique:teachers,email',
                'phone' => 'required|unique:teachers,phone',
                'ident_num' => 'required',
                'country_code' => 'required',
                'cv' => '',
                'qualification' => 'required',
                'nationality' => 'required',
                'job_name' => 'required',
                'country' => 'required',
                'date_of_birth' => 'required',
            ]);
        $data['unique_name'] = time() . '_' . rand(1000, 9999);
        $data['user_phone'] = $request->country_code . $request->phone;
        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data['password'] = bcrypt(request('password'));
            $data['first_name_en'] = $request->first_name_ar;
            $data['mid_name_en'] = $request->mid_name_ar;
            $data['last_name_en'] = $request->last_name_ar;
            $data['user_name'] = $request->first_name_ar . " " . $request->mid_name_ar . " " . $request->last_name_ar;
            if ($request->epo_type == 'far_learn') {
                $data['epo_type'] = 'far_learn';
            } else if ($request->epo_type == 'mogmaa_dorr') {
                if ($request->gender == 'male') {
                    $data['epo_type'] = 'mogmaa';
                } else if ($request->gender == 'female') {
                    $data['epo_type'] = 'dorr';
                }
            }
            $data['is_new'] = 'accepted';
            $data['is_verified'] = '1';

            //save cv fiile
            if ($request->cv != null) {
                $file = $request->file('cv');
                $ext = $file->getClientOriginalExtension();
                // Move Image To Folder ..
                $fileNewName = 'cv_' . time() . '.' . $ext;
                $file->move(public_path('uploads/teachers/cvs'), $fileNewName);
                $data['cv'] = $fileNewName;
            }
            //generate date of birh
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
            Teacher::create($data);
            Alert::success(trans('admin.add'), trans('s_admin.added_s'));
            return back();
        }
    }

    public function edit($id)
    {
        $data = Teacher::findOrFail($id);
        return view('admin.web_settings.teachers.edit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $input = $this->validate(\request(),
            [
                'first_name_ar' => 'required',
                'qualification' => 'required',
                'last_name_ar' => 'required',
                'mid_name_ar' => 'required',
                'nationality' => 'required',
                'ident_num' => 'required',
                'phone' => 'required|unique:teachers,phone,' . $id,
                'email' => 'required|unique:teachers,email,' . $id,
                'country_code' => 'required',
                'main_lang' => 'required',
                'job_name' => 'required',
                'gender' => 'required',
                'date_of_birth' => '',
                'save_quran_num' => '',
                'i_pan' => '',
                'bio_ar' => '',
                'bio_en' => '',
                'image' => '',
            ]);

        $input['first_name_en'] = $request->first_name_ar;
        $input['mid_name_en'] = $request->mid_name_ar;
        $input['last_name_en'] = $request->last_name_ar;
        $input['user_name'] = $request->first_name_ar . " " . $request->mid_name_ar . " " . $request->last_name_ar;
        $input['user_phone'] = $request->country_code . $request->phone;
        $selected_date = $request->date_of_birth;
        $year = \Carbon\Carbon::parse($selected_date)->format('Y');
        if ($year < 1900) {
            $year = \Carbon\Carbon::parse($selected_date)->format('Y');
            $month = \Carbon\Carbon::parse($selected_date)->format('m');
            $day = \Carbon\Carbon::parse($selected_date)->format('d');
            $date = Hijri::DateToGregorianFromDMY($day, $month, $year);
            $input['date_of_birth'] = $date;
        } else {
            $to_date = \Carbon\Carbon::parse($selected_date)->format('Y-m-d');
            $input['date_of_birth'] = $to_date;
        }
        if ($request->image != null) {
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/teachers'), $fileNewName);
            $input['image'] = $fileNewName;
        }
        $job_name = Teacher::find($id)->job_name;
        if ($request->job_name != $job_name) {
            $job_data['teacher_id'] = $id;
            $job_data['job_name_id'] = $request->job_name;
            Teacher_job_name_history::create($job_data);
        }
        if ($request->password != null && $request->password_confirmation != null) {
            if ($request->password == $request->password_confirmation) {
                $input['password'] = \Hash::make($request->password);
                Alert::success(trans('s_admin.success'), "تم تغيير كلمة المرور بنجاح ");
            } else {
                Alert::error(trans('s_admin.error'), "لا يوجد تطابق بين كلمه المرور وتأكيد كلمه المرور");
                return back();
            }
        }
        Teacher::where('id', $id)->update($input);
        Alert::success(trans('s_admin.edit'), trans('s_admin.updated_s'));
        $data = Teacher::where('is_new', '!=', 'rejected')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
//        return view('admin.web_settings.teachers.teachers_settings', compact('data'));
        return back();
    }

    public function details($id)
    {
        $data = Student::findOrFail($id);
        $parent_data = Student_parent::where('student_id', $id)->first();
        return view('teacher.episode.student_details', compact('data', 'parent_data'));
    }


    public function study_teachers()
    {
        $data = Teacher::where('member', 1)->get();
        return view('admin.web_settings.teachers.teachers_settings', compact('data'));
    }

    public function absence()
    {
        $data = Teacher::where('status', 'active')->where('is_new', 'accepted')->orderBy('id', 'desc')->get();
        $today = Carbon::now();
        return view('admin.web_settings.teachers.absence.epo_type', compact('data'));
    }


    public function absence_episode_multi($type)
    {
        $user = \auth()->user();
        if ($user->role_id == 6) {
            $data = Student::where('epo_type', 'mogmaa')->where('is_new', 'y')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
        } elseif ($user->role_id == 7) {
            $data = Student::where('epo_type', 'dorr')->where('is_new', 'y')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
        } elseif ($user->role_id == 8) {
            $episode_ids = Episode::where('deleted', '0')->where('gender', $user->gender)->where('type', $type)->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $teacher_ids = Episode::where('deleted', '0')->where('teacher_id', '!=', null)->where('gender', $user->gender)->where('type', $type)->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('teacher_id')->toArray();
            $basic_teacher = Teacher::whereIn('id', $teacher_ids)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
            $additional_teachers = Episode_teacher::whereIn('episode_id', $episode_ids)->get();
            $employees = User::where('role_id', 8)->where('status', 'active')->where('gender', $user->gender)->orderBy('created_at', 'desc')->get();
            return view('admin.web_settings.teachers.absence.episode_teachers', compact('basic_teacher', 'additional_teachers', 'type', 'employees'));
        } else if ($user->role_id == 2) {
            if ($type == 'mqraa') {
                $basic_teacher = Teacher::where('epo_type', 'far_learn')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
                $additional_teachers = [];
                $employees = User::where('role_id', 8)->where('status', 'active')->orderBy('created_at', 'desc')->get();
                return view('admin.web_settings.teachers.absence.episode_teachers', compact('basic_teacher', 'additional_teachers', 'type', 'employees'));
            }
        }
        return view('admin.web_settings.teachers.absence.episodes', compact('data', 'type'));
    }

    public function absence_episode_college($type, $college_id)
    {
        $data = Episode::where('deleted', '0')->where('college_id', $college_id)->where('active', 'y')->orderBy('created_at', 'desc')->get();
        return view('admin.web_settings.teachers.absence.episodes', compact('data', 'type'));
    }

    public function episode_teachers($id, $type)
    {
        $data = Episode::find($id);
        $basic_teacher = $data->Teacher;
        $additional_teachers = Episode_teacher::where('episode_id', $id)->get();

        return view('admin.web_settings.teachers.absence.episode_teachers', compact('basic_teacher', 'additional_teachers', 'type', 'id'));
    }

    public function show_absence()
    {
        $today = Carbon::now();

        $user = auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {

            $episode_ids = Episode::where('deleted', '0')->where('college_id', $user->college_id)->where('type', 'mogmaa')->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $teacher_ids = Episode::where('deleted', '0')->where('teacher_id', '!=', null)->where('college_id', $user->college_id)->where('type', 'mogmaa')->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('teacher_id')->toArray();
            $basic_teacher = Teacher::whereIn('id', $teacher_ids)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();


            $additional_teachers = Episode_teacher::whereIn('episode_id', $episode_ids)->get()->pluck('teacher_id')->toArray();
            $role_ids = [3, 9, 10, 11];
            $employees = User::whereIn('role_id', $role_ids)->where('status', 'active')->where('gender', $user->gender)->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $mergedArray = array_merge($basic_teacher, $additional_teachers);
            $data = Teacher_absence::whereHas('Teacher')->whereIn('teacher_id', $mergedArray)->where('absence_date', $today->format('Y-m-d'))->get();
            $data_emp = User_absence::whereHas('User')->whereIn('user_id', $employees)->where('absence_date', $today->format('Y-m-d'))->get();


        } else if ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) {
            $episode_ids = Episode::where('deleted', '0')->where('college_id', $user->college_id)->where('type', 'dorr')->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $teacher_ids = Episode::where('deleted', '0')->where('teacher_id', '!=', null)->where('college_id', $user->college_id)->where('type', 'dorr')->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('teacher_id')->toArray();
            $basic_teacher = Teacher::whereIn('id', $teacher_ids)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $additional_teachers = Episode_teacher::whereIn('episode_id', $episode_ids)->get()->pluck('teacher_id')->toArray();
            $role_ids = [5, 12, 13, 14];
            $employees = User::whereIn('role_id', $role_ids)->where('status', 'active')->where('gender', $user->gender)->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();

            $mergedArray = array_merge($basic_teacher, $additional_teachers);
            $data = Teacher_absence::whereHas('Teacher')->whereIn('teacher_id', $mergedArray)->where('absence_date', $today->format('Y-m-d'))->get();
            $data_emp = User_absence::whereHas('User')->whereIn('user_id', $employees)->where('absence_date', $today->format('Y-m-d'))->get();
        } else if ($user->role_id == 6) {
            $basic_teacher = Teacher::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $additional_teachers = [];
            $role_ids = [3, 9, 10, 11, 6];
            $employees = User::whereIn('role_id', $role_ids)->where('status', 'active')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $mergedArray = array_merge($basic_teacher, $additional_teachers);
            $data = Teacher_absence::whereHas('Teacher')->whereIn('teacher_id', $mergedArray)->where('absence_date', $today->format('Y-m-d'))->get();
            $data_emp = User_absence::whereHas('User')->whereIn('user_id', $employees)->where('absence_date', $today->format('Y-m-d'))->get();
        } else if ($user->role_id == 7) {
            $basic_teacher = Teacher::where('epo_type', 'dorr')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $additional_teachers = [];
            $role_ids = [5, 12, 13, 14, 7];
            $employees = User::whereIn('role_id', $role_ids)->where('status', 'active')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $mergedArray = array_merge($basic_teacher, $additional_teachers);
            $data = Teacher_absence::whereHas('Teacher')->whereIn('teacher_id', $mergedArray)->where('absence_date', $today->format('Y-m-d'))->get();
            $data_emp = User_absence::whereHas('User')->whereIn('user_id', $employees)->where('absence_date', $today->format('Y-m-d'))->get();
        } else if ($user->role_id == 8) {
            $episode_ids = Episode::where('deleted', '0')->where('gender', $user->gender)->where('type', 'mqraa')->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $teacher_ids = Episode::where('deleted', '0')->where('teacher_id', '!=', null)->where('gender', $user->gender)->where('type', 'mqraa')->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('teacher_id')->toArray();
            $basic_teacher = Teacher::whereIn('id', $teacher_ids)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $additional_teachers = Episode_teacher::whereIn('episode_id', $episode_ids)->get()->pluck('teacher_id')->toArray();
            $employees = User::where('role_id', 8)->where('status', 'active')->where('gender', $user->gender)->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();

            $mergedArray = array_merge($basic_teacher, $additional_teachers);
            $data = Teacher_absence::whereHas('Teacher')->whereIn('teacher_id', $mergedArray)->where('absence_date', $today->format('Y-m-d'))->get();
            $data_emp = User_absence::whereHas('User')->whereIn('user_id', $employees)->where('absence_date', $today->format('Y-m-d'))->get();
        } else {
            $data = Teacher_absence::whereHas('Teacher')->where('absence_date', $today->format('Y-m-d'))->get();
            $data_emp = User_absence::whereHas('User')->where('absence_date', $today->format('Y-m-d'))->get();
        }
        $selected_date = $today->format('m/d/Y');
        return view('admin.web_settings.teachers.absence.show', compact('data', 'selected_date', 'data_emp'));
    }


    public function absence_colleges($type, $college_type)
    {
        $user = auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {
            $episode_ids = Episode::where('deleted', '0')->where('college_id', $user->college_id)->where('type', $type)->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $teacher_ids = Episode::where('deleted', '0')->where('teacher_id', '!=', null)->where('college_id', $user->college_id)->where('type', $type)->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('teacher_id')->toArray();
            $basic_teacher = Teacher::whereIn('id', $teacher_ids)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();

            $additional_teachers = Episode_teacher::whereIn('episode_id', $episode_ids)->get();
            $role_ids = [3, 9, 10, 11];
            $employees = User::whereIn('role_id', $role_ids)->where('college_id', $user->college_id)->where('status', 'active')->where('gender', $user->gender)->orderBy('created_at', 'desc')->get();
            return view('admin.web_settings.teachers.absence.episode_teachers', compact('basic_teacher', 'additional_teachers', 'type', 'employees'));
        } else if ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) {
            $episode_ids = Episode::where('deleted', '0')->where('college_id', $user->college_id)->where('type', $type)->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $teacher_ids = Episode::where('deleted', '0')->where('teacher_id', '!=', null)->where('college_id', $user->college_id)->where('type', $type)->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('teacher_id')->toArray();
            $basic_teacher = Teacher::whereIn('id', $teacher_ids)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
            $additional_teachers = Episode_teacher::whereIn('episode_id', $episode_ids)->get();
            $role_ids = [5, 12, 13, 14];
            $employees = User::whereIn('role_id', $role_ids)->where('college_id', $user->college_id)->where('status', 'active')->where('gender', $user->gender)->orderBy('created_at', 'desc')->get();

            return view('admin.web_settings.teachers.absence.episode_teachers', compact('basic_teacher', 'additional_teachers', 'type', 'employees'));
        } else if ($user->role_id == 6) {
            $basic_teacher = Teacher::where('epo_type', $type)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
            $additional_teachers = [];
            $role_ids = [3, 9, 10, 11, 6];
            $employees = User::whereIn('role_id', $role_ids)->where('status', 'active')->orderBy('created_at', 'desc')->get();

            return view('admin.web_settings.teachers.absence.episode_teachers', compact('basic_teacher', 'additional_teachers', 'type', 'employees'));
        } else if ($user->role_id == 7) {
            $basic_teacher = Teacher::where('epo_type', $type)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
            $additional_teachers = [];
            $role_ids = [5, 12, 13, 14, 7];
            $employees = User::whereIn('role_id', $role_ids)->where('status', 'active')->orderBy('created_at', 'desc')->get();

            return view('admin.web_settings.teachers.absence.episode_teachers', compact('basic_teacher', 'additional_teachers', 'type', 'employees'));
        } else {
            $basic_teacher = Teacher::where('epo_type', $type)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
            $additional_teachers = [];
            if ($type == 'mogmaa') {
                $role_ids = [3, 9, 10, 11, 6];
            } else {
                $role_ids = [5, 12, 13, 14, 7];
            }
            $employees = User::whereIn('role_id', $role_ids)->where('status', 'active')->orderBy('created_at', 'desc')->get();

            return view('admin.web_settings.teachers.absence.episode_teachers', compact('basic_teacher', 'additional_teachers', 'type', 'employees'));
        }
        return view('admin.web_settings.teachers.absence.exists_dorr', compact('data', 'type'));
    }


    public function search_show_absence(Request $request)
    {
        $today = Carbon::now();
        $input = $this->validate(\request(),
            [
                'absence_date' => 'required'
            ]);
        $search_Time = strtotime($request->absence_date);


        $user = auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {
            $episode_ids = Episode::where('deleted', '0')->where('college_id', $user->college_id)->where('type', 'mogmaa')->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $teacher_ids = Episode::where('deleted', '0')->where('teacher_id', '!=', null)->where('college_id', $user->college_id)->where('type', 'mogmaa')->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('teacher_id')->toArray();
            $basic_teacher = Teacher::whereIn('id', $teacher_ids)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $additional_teachers = Episode_teacher::whereIn('episode_id', $episode_ids)->get()->pluck('teacher_id')->toArray();
            $role_ids = [3, 9, 10, 11];
            $employees = User::whereIn('role_id', $role_ids)->where('status', 'active')->where('gender', $user->gender)->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();

            $mergedArray = array_merge($basic_teacher, $additional_teachers);
            $data = Teacher_absence::whereIn('teacher_id', $mergedArray)->where('absence_date', date("Y-m-d", $search_Time))->get();
            $data_emp = User_absence::whereIn('user_id', $employees)->where('absence_date', date("Y-m-d", $search_Time))->get();


        } else if ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) {
            $episode_ids = Episode::where('deleted', '0')->where('college_id', $user->college_id)->where('type', 'dorr')->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $teacher_ids = Episode::where('deleted', '0')->where('teacher_id', '!=', null)->where('college_id', $user->college_id)->where('type', 'dorr')->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('teacher_id')->toArray();
            $basic_teacher = Teacher::whereIn('id', $teacher_ids)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $additional_teachers = Episode_teacher::whereIn('episode_id', $episode_ids)->get()->pluck('teacher_id')->toArray();
            $role_ids = [5, 12, 13, 14];
            $employees = User::whereIn('role_id', $role_ids)->where('status', 'active')->where('gender', $user->gender)->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $mergedArray = array_merge($basic_teacher, $additional_teachers);
            $data = Teacher_absence::whereIn('teacher_id', $mergedArray)->where('absence_date', date("Y-m-d", $search_Time))->get();
            $data_emp = User_absence::whereIn('user_id', $employees)->where('absence_date', date("Y-m-d", $search_Time))->get();
        } else if ($user->role_id == 6) {
            $basic_teacher = Teacher::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $additional_teachers = [];
            $role_ids = [3, 9, 10, 11, 6];
            $employees = User::whereIn('role_id', $role_ids)->where('status', 'active')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $mergedArray = array_merge($basic_teacher, $additional_teachers);
            $data = Teacher_absence::whereIn('teacher_id', $mergedArray)->where('absence_date', date("Y-m-d", $search_Time))->get();
            $data_emp = User_absence::whereIn('user_id', $employees)->where('absence_date', date("Y-m-d", $search_Time))->get();
        } else if ($user->role_id == 7) {
            $basic_teacher = Teacher::where('epo_type', 'dorr')->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $additional_teachers = [];
            $role_ids = [5, 12, 13, 14, 7];
            $employees = User::whereIn('role_id', $role_ids)->where('status', 'active')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $mergedArray = array_merge($basic_teacher, $additional_teachers);
            $data = Teacher_absence::whereIn('teacher_id', $mergedArray)->where('absence_date', date("Y-m-d", $search_Time))->get();
            $data_emp = User_absence::whereIn('user_id', $employees)->where('absence_date', date("Y-m-d", $search_Time))->get();
        } else if ($user->role_id == 8) {
            $episode_ids = Episode::where('deleted', '0')->where('gender', $user->gender)->where('type', 'mqraa')->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $teacher_ids = Episode::where('deleted', '0')->where('teacher_id', '!=', null)->where('gender', $user->gender)->where('type', 'mqraa')->where('active', 'y')->orderBy('created_at', 'desc')->get()->pluck('teacher_id')->toArray();
            $basic_teacher = Teacher::whereIn('id', $teacher_ids)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $additional_teachers = Episode_teacher::whereIn('episode_id', $episode_ids)->get()->pluck('teacher_id')->toArray();
            $employees = User::where('role_id', 8)->where('status', 'active')->where('gender', $user->gender)->orderBy('created_at', 'desc')->get()->pluck('id')->toArray();
            $mergedArray = array_merge($basic_teacher, $additional_teachers);
            $data = Teacher_absence::whereIn('teacher_id', $mergedArray)->where('absence_date', date("Y-m-d", $search_Time))->get();
            $data_emp = User_absence::whereIn('user_id', $employees)->where('absence_date', date("Y-m-d", $search_Time))->get();
        } else {
            $data = Teacher_absence::where('absence_date', date("Y-m-d", $search_Time))->get();
            $data_emp = User_absence::where('absence_date', date("Y-m-d", $search_Time))->get();
        }


        $selected_date = date("m/d/Y", $search_Time);
        return view('admin.web_settings.teachers.absence.show', compact('data', 'data_emp', 'selected_date'));
    }

    public function absence_update($id)
    {
        $data = Teacher_absence::find($id);
        if ($data->type == 'absence') {
            $data->type = 'attendance';
        } else {
            $data->type = 'absence';
        }
        $data->save();
        Alert::success(trans('s_admin.teacher_absence'), trans('s_admin.updted_s'));
        return back();
    }

    public function absence_update_user($id)
    {
        $data = User_absence::find($id);
        if ($data->type == 'absence') {
            $data->type = 'attendance';
        } else {
            $data->type = 'absence';
        }
        $data->save();
        Alert::success(trans('s_admin.teacher_absence'), trans('s_admin.updted_s'));
        return back();
    }

    public function store_absence(Request $request)
    {

        $today = Carbon::now();
        $input = $this->validate(\request(),
            [
                'absence_date' => 'required|before:' . $today,
                'target_id' => 'required',
                'type' => 'required',
                'reason' => '',
                'episode_id' => 'nullable|array',
                'employee_type' => 'required',
            ]);
        $startTime = strtotime($request->absence_date);
        $input['absence_date'] = date("Y-m-d", $startTime);
        $user_absences = User_absence::where('absence_date', $input['absence_date'])->get();
        $teacher_absences = Teacher_absence::where('absence_date', $input['absence_date'])->get();
        foreach ($request->target_id as $key => $row) {
            if ($request->employee_type[$key] == 'user') {

                try {
                    $input['user_id'] = $row;
                    $input['type'] = $request->type[$key];
                    $input['reason'] = $request->reason[$key];
                    $user_absence = $user_absences->where('user_id', $input['user_id'])->first();
                    if ($user_absence == null) {
                        User_absence::create($input);

                    }
                } catch (Exception $exception) {

                }
            } else if ($request->employee_type[$key] == 'teacher') {
                try {
                    $input['teacher_id'] = $row;
                    if ($request->episode_id[$key] == 0) {
                        $input['episode_id'] = null;
                    } else {
                        $input['episode_id'] = $request->episode_id[$key];
                    }
                    $input['type'] = $request->type[$key];
                    $input['reason'] = $request->reason[$key];
                    $teacher_absence = $teacher_absences->where('teacher_id', $input['teacher_id'])
                        ->where('episode_id', $input['episode_id'])
                        ->first();
                    if ($teacher_absence == null) {
                        Teacher_absence::create($input);
                    }
                } catch (Exception $exception) {

                }
            }
        }
        Alert::success(trans('s_admin.teacher_absence'), trans('s_admin.saved_s'));
        return back();
    }

    public function store_absence_copy(Request $request)
    {
        $today = Carbon::now();
        $input = $this->validate(\request(),
            [
                'absence_date' => 'required|before:' . $today
            ]);
        $startTime = strtotime($request->absence_date);
        $data['absence_date'] = date("Y-m-d", $startTime);
        if ($request->teacher_ids_absence != null) {
            foreach ($request->teacher_ids_absence as $row) {
                try {
                    $data['teacher_id'] = $row;
                    $data['type'] = 'absence';
                    Teacher_absence::create($data);
                } catch (Exception $exception) {

                }
            }
        }
        if ($request->teacher_ids_attendance != null) {
            foreach ($request->teacher_ids_attendance as $row) {
                try {
                    $data['teacher_id'] = $row;
                    $data['type'] = 'attendance';
                    Teacher_absence::create($data);
                } catch (Exception $exception) {

                }
            }
        }


        Alert::success(trans('s_admin.teacher_absence'), trans('s_admin.teacher_absence_done'));
        return back();
    }


    public function make_member($id)
    {
        $data = Teacher::findOrFail($id);
        if ($data->member == 0) {
            Alert::success(trans('s_admin.success'), trans('s_admin.make_member_s'));
            $data->member = 1;
        } else {
            Alert::success(trans('s_admin.success'), trans('s_admin.not_make_member_s'));
            $data->member = 0;
        }
        $data->save();
        return back();
    }

    public function update_Actived(Request $request)
    {
        $data['status'] = $request->status;
        $user = Teacher::where('id', $request->id)->update($data);
        return 1;
    }

    public function destroy_absence($id)
    {
        $user = Teacher_absence::where('id', $id)->delete();
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }

    public function destroy_absence_user($id)
    {
        $user = User_absence::where('id', $id)->delete();
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return back();
    }

    public function destroy(Request $request, $id)
    {
        $teacher = Teacher::find($id);
        $teacher->deleted_id = auth()->guard('web')->user()->id;
        $teacher->save();
        $teacher->delete();

        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return redirect()->back();
    }
}
