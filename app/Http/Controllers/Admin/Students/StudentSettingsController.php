<?php

namespace App\Http\Controllers\Admin\Students;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Models\Admin_notification;
use App\Models\College;
use App\Models\Episode;
use App\Models\Sms_message;
use App\Models\Student_level_history;
use App\Models\Web_setting;
use App\Notifications\VerfiyRegister;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use App\Http\Controllers\Controller;
use App\Models\Student_parent;
use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Episode_student;

class StudentSettingsController extends Controller
{
    public function index()
    {
        $data = Student::where('is_new', '!=', 'rejected')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
        return view('admin.web_settings.students.students_settings', compact('data'));
    }

    public function follow_absence()
    {
        $data = Student::where('is_new', 'accepted')->orderBy('created_at', 'desc')->get();
        return view('admin.web_settings.students.follow_absence', compact('data'));
    }

    public function place_episode_multi($type, $student_id)
    {
        $student = Student::find($student_id);
        if ($type == 'mqraa') {
            $data = Episode::where('gender', $student->gender)->where('deleted', '0')->where('type', $type)->where('active', 'y')->orderBy('created_at', 'desc')->get();
        } else {
            $data = Episode::where('deleted', '0')->where('college_id', $type)->where('active', 'y')->orderBy('created_at', 'desc')->get();
        }
        return view('admin.web_settings.students.episodes.far_learn_episodes', compact('data', 'student'));
    }

    public function student_exists_dorr($student_id, $type)
    {
        $student = Student::find($student_id);
        $data = College::where('type', $type)->where('deleted', '0')->get();
        return view('admin.web_settings.students.episodes.exists_dorr', compact('data', 'student', 'type'));
    }

    public function place_selected_student($episode_id, $student_id)
    {
        $student = Student::find($student_id);
        $data['student_id'] = $student_id;
        $data['episode_id'] = $episode_id;
        $data['level_id'] = $student->level_id;
        $data['subject_id'] = $student->subject_id;
        $data['subject_level_id'] = $student->subject_level_id;
        Episode_student::create($data);
        $student = Student::findOrFail($student_id);
        $email = $student->email;
        if ($student->main_lang == 'ar') {
            Mail::raw('تم أضافتك لحلقة جديدة ....... تستطيع تسجيل الدخول للوحة التحكم الان .... ' . '  رابط الموقع هنا :  ' . env('APP_URL') . 'student/home', function ($message) use ($email) {
                $message->subject(trans('s_admin.title'));
                $message->from(env('MAIL_USERNAME'), 'online learning');
                $message->to($email);
            });
        } else {
            Mail::raw('You have been added to a new episode.... You can log in to the control panel now....' . '  Website link here:  ' . env('APP_URL') . 'student/home', function ($message) use ($email) {
                $message->subject(trans('s_admin.title'));
                $message->from(env('MAIL_USERNAME'), 'online learning');
                $message->to($email);
            });
        }

        Alert::success(trans('s_admin.episode'), trans('s_admin.episode_placed'));
        return redirect()->back();
    }

    public function store(Request $request)
    {
        if ($request->country_code == 'Egypt') {
            $data['country_code'] = '+966';
        }
        if ($request->epo_type == 'far_learn') {
            $data = $this->validate(\request(),
                [
//                    'unique_name' => 'required|unique:teachers,unique_name|unique:students,unique_name|unique:users,unique_name',
                    'password' => 'required|min:8|confirmed',
                    'password_confirmation' => 'required|min:8',
                    'first_name_ar' => 'required',
                    'mid_name_ar' => 'required',
                    'last_name_ar' => 'required',
                    'gender' => 'required',
                    'level_id' => 'required',
                    'subject_id' => '',
                    'subject_level_id' => '',
                    'nationality' => 'required',
                    'main_lang' => 'required',
                    'qualification' => 'required',
                    'country' => 'required',
                    'ident_num' => 'required',
                    'phone' => 'required|unique:students,phone',
                    'date_of_birth' => 'required',
                    'save_quran_num' => '',
                    'save_quran_limit' => 'required',
                    'email' => 'required|unique:students,email',
                ]);
        } else {
            $data = $this->validate(\request(),
                [
//                    'unique_name' => 'required|unique:teachers,unique_name|unique:students,unique_name|unique:users,unique_name',
                    'password' => 'required|min:8|confirmed',
                    'password_confirmation' => 'required|min:8',
                    'first_name_ar' => 'required',
                    'mid_name_ar' => 'required',
                    'last_name_ar' => 'required',
                    'gender' => 'required',
                    'level_id' => 'required',
                    'subject_id' => '',
                    'subject_level_id' => '',
                    'nationality' => 'required',
                    'main_lang' => 'required',
                    'qualification' => 'required',
                    'country' => 'required',
                    'ident_num' => 'required',
                    'phone' => 'required|unique:students,phone',
                    'district_id' => 'required',
                    'date_of_birth' => 'required',
                    'save_quran_num' => '',
                    'save_quran_limit' => 'required',
                    'email' => 'required|unique:students,email',
                ]);
        }
        $data['unique_name'] = time() . '_' . rand(1000, 9999);

        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $data['user_phone'] = $request->country_code . $request->phone;
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

            $data['is_new'] = 'accepted';
            $data['interview'] = 'y';
            $data['parent_data'] = 'complete';
            $data['admin_view'] = '1';
            $data['complete_data'] = '1';
            $data['is_verified'] = '1';
            $student = Student::create($data);
            Alert::success(trans('admin.add'), trans('s_admin.added_s'));
            return back();
        }
    }

    public function update(Request $request, $id)
    {
        $stud = Student::whereId($id)->first();
        if ($stud->epo_type != 'far_learn') {
            $data = $this->validate(\request(),
                [
//                    'unique_name' => 'required',
                    'first_name_ar' => 'required',
                    'mid_name_ar' => 'required',
                    'last_name_ar' => 'required',
                    'gender' => 'required',
                    'level_id' => 'required',
                    'subject_id' => '',
                    'subject_level_id' => '',
                    'nationality' => 'required',
                    'main_lang' => 'required',
                    'qualification' => 'required',
                    'country' => 'required',
                    'ident_num' => 'required',
                    'phone' => 'required|unique:students,phone,' . $id,
                    'country_code' => 'required',
                    'district_id' => 'required',
                    'date_of_birth' => 'required',
                    'save_quran_num' => '',
                    'save_quran_limit' => 'required',
                    'email' => 'required|unique:students,email,' . $id,
                ]);
        } else {
            $data = $this->validate(\request(),
                [
//                    'unique_name' => 'required',
                    'first_name_ar' => 'required',
                    'mid_name_ar' => 'required',
                    'last_name_ar' => 'required',
                    'gender' => 'required',
                    'level_id' => 'required',
                    'subject_id' => '',
                    'subject_level_id' => '',
                    'nationality' => 'required',
                    'main_lang' => 'required',
                    'qualification' => 'required',
                    'country' => 'required',
                    'ident_num' => 'required',
                    'phone' => 'required|unique:students,phone,' . $id,
                    'country_code' => 'required',
                    'date_of_birth' => 'required',
                    'save_quran_num' => '',
                    'save_quran_limit' => 'required',
                    'email' => 'required'
                ]);
        }
//        |unique:teachers,email|unique:students,email|unique:users,email
        if ($request['password'] != null && $request['password_confirmation'] != null) {
            $this->validate(\request(),
                [
                    'password' => 'min:8|confirmed',
                    'password_confirmation' => 'min:8',
                ]);
            $data['password'] = bcrypt(request('password'));
        }
        $data['user_phone'] = $request->country_code . $request->phone;
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
        $data['first_name_en'] = $request->first_name_ar;
        $data['mid_name_en'] = $request->mid_name_ar;
        $data['last_name_en'] = $request->last_name_ar;
        $data['user_name'] = $request->first_name_ar . " " . $request->mid_name_ar . " " . $request->last_name_ar;
        unset($data['password_confirmation']);
        Student::whereId($id)->update($data);
        Alert::success(trans('s_admin.edit'), trans('s_admin.updated_s'));
        $student = Student::whereId($id)->first();
        $data = Student::where('epo_type', $student->epo_type)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
//            return view('admin.web_settings.students.students_settings', compact('data'));
        return back();

    }

    public function edit_save_quran_num(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'student_id' => 'required',
                'save_quran_num' => 'required',
            ]);
        $input['save_quran_num'] = $request->save_quran_num;
        Student::whereId($request->student_id)->update($input);
        Alert::success(trans('s_admin.edit'), trans('s_admin.updated_s'));
        return back();
    }

    public function edit_save_limit(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'student_id' => 'required',
                'save_quran_limit' => 'required',
            ]);
        $input['save_quran_limit'] = $request->save_quran_limit;
        Student::whereId($request->student_id)->update($input);
        Alert::success(trans('s_admin.edit'), trans('s_admin.updated_s'));
        return back();
    }


    public function change_status($id)
    {
        $student = Student::find($id);
        if ($student->status == 'unactive') {
            $student->status = 'active';
            $student->save();
            Alert::success(trans('s_admin.activation'), trans('s_admin.actived_s'));
            return redirect()->back();
        } else {
            $student->status = 'unactive';
            $student->save();
            Alert::success(trans('s_admin.activation'), trans('s_admin.un_actived_s'));
            return redirect()->back();
        }
    }

    public function reject($id)
    {
        $student = Student::find($id);
        $student->is_new = 'rejected';
        if ($student->save()) {
            $email = $student->email;
            $phone = $student->country_code . $student->phone;
            $settings = Web_setting::where('id', 1)->first();
            if ($student->main_lang == 'ar') {
                $title = $settings->title_ar;
                $real_message = 'تم رفضك من قبل الادارة - بموقع  ' . $title . '  رابط الموقع هنا :  ' . env('APP_URL');
            } else {
                $title = $settings->title_en;
                $real_message = 'You have been rejected by the administration - Site  ' . $title . '  Website link here :  ' . env('APP_URL');
            }
            //send mail message
            if (env('APP_ENV') == 'production') {
                Mail::raw($real_message, function ($message) use ($email, $title) {
                    $message->subject($title);
                    $message->from(env('MAIL_USERNAME'), 'online learning');
                    $message->to($email);
                });
            }
            //send sms message
            $this->SendSMS($phone, $real_message);
            Alert::success(trans('s_admin.join_orders'), trans('s_admin.rejected_s'));
            return redirect()->back();
        }
    }

    public function accept($id)
    {
        $student = Student::find($id);
        if ($student->is_verified == 1) {
            $student->is_new = 'accepted';
            $student->created_at = Carbon::now();
            if ($student->save()) {
                $email = $student->email;
                $settings = Web_setting::where('id', 1)->first();
                $phone = $student->country_code . $student->phone;
                if ($student->main_lang == 'ar') {
                    $title = $settings->title_ar;
                    $real_message = 'تم قبولك بموقع  ' . $title . '  رابط الموقع هنا :  ' . env('APP_URL');
                } else {
                    $title = $settings->title_en;
                    $real_message = 'You have been accepted into the site  ' . $title . '  Website link here :  ' . env('APP_URL');
                }
                //send mail message
                if (env('APP_ENV') == 'production') {
                    Mail::raw($real_message, function ($message) use ($email, $title) {
                        $message->subject($title);
                        $message->from(env('MAIL_USERNAME'), 'online learning');
                        $message->to($email);
                    });
                }
                //send sms message
                $this->SendSMS($phone, $real_message);
                Alert::success(trans('s_admin.join_orders'), trans('s_admin.accepted_s'));
                return redirect()->back();
            }

        } else {
            Alert::warning(trans('s_admin.warning'), trans('s_admin.he_not_verified_yet'));
            return redirect()->back();
        }
    }

    public function show($type)
    {
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {
            $episode_ids = Episode::where('college_id', $user->college_id)->where('active', 'y')->where('type', 'mogmaa')->pluck('id')->toArray();
            $student_ids = Episode_student::whereIn('episode_id', $episode_ids)->where('deleted', '0')->pluck('student_id')->toArray();
            $data = Student::whereIn('id', $student_ids)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
        } elseif ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) {
            $episode_ids = Episode::where('college_id', $user->college_id)->where('active', 'y')->where('type', 'dorr')->pluck('id')->toArray();
            $student_ids = Episode_student::whereIn('episode_id', $episode_ids)->where('deleted', '0')->pluck('student_id')->toArray();
            $data = Student::whereIn('id', $student_ids)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
        } elseif ($user->role_id == 8) {
            $data = Student::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
        } else {
            $data = Student::where('epo_type', $type)->where('is_new', 'accepted')->where('is_verified', '1')->orderBy('created_at', 'desc')->get();
        }
        return view('admin.web_settings.students.students_settings', compact('data'));
    }

    public function new_join()
    {
        $user = \auth()->user();
        $input['admin_view'] = 1;
        if ($user->role_id == 6) {
            $data = Student::where('epo_type', 'mogmaa')->where('admin_view', 0)->orderBy('id', 'asc')->get();
            $data = Student::where('epo_type', 'mogmaa')->where('admin_view', 0)->get();

            Student::where('epo_type', 'mogmaa')->where('admin_view', 0)->update($input);
            Admin_notification::whereHas('Student', function ($q) {
                $q->where('epo_type', 'mogmaa');
            })->where('readed', '0')->where('message_type', 'new_student')->update(['readed' => '1']);
        } elseif ($user->role_id == 7) {
            $data = Student::where('epo_type', 'dorr')->where('admin_view', 0)->orderBy('id', 'asc')->get();
            Student::where('epo_type', 'mogmaa')->where('admin_view', 0)->update($input);
            Admin_notification::whereHas('Student', function ($q) {
                $q->where('epo_type', 'dorr');
            })->where('readed', '0')->where('message_type', 'new_student')->update(['readed' => '1']);
        } elseif ($user->role_id == 8) {
            $data = Student::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('admin_view', 0)->orderBy('id', 'asc')->get();
            Student::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('admin_view', 0)->update($input);
            Admin_notification::whereHas('Student', function ($q) use ($user) {
                $q->where('epo_type', 'far_learn')->where('gender', $user->gender);
            })->where('readed', '0')->where('message_type', 'new_student')->update(['readed' => '1']);
        } else {
            $data = Student::where('admin_view', 0)->orderBy('id', 'asc')->get();
            Admin_notification::where('readed', '0')->where('message_type', 'new_student')->update(['readed' => '1']);
        }
        return view('admin.web_settings.students.students_settings', compact('data'));
    }

    public function new_students()
    {
        $user = \auth()->user();
        $input['admin_view'] = 1;
        if ($user->role_id == 6) {
            $data = Student::where('epo_type', 'mogmaa')->where('is_new', 'y')->orderBy('created_at', 'desc')->get();
            Student::where('epo_type', 'mogmaa')->where('admin_view', 0)->update($input);
            Admin_notification::whereHas('Student', function ($q) {
                $q->where('epo_type', 'mogmaa');
            })->where('readed', '0')->where('message_type', 'new_student')->update(['readed' => '1']);
        } elseif ($user->role_id == 7) {
            $data = Student::where('epo_type', 'dorr')->where('is_new', 'y')->orderBy('created_at', 'desc')->get();
            Student::where('epo_type', 'mogmaa')->where('admin_view', 0)->update($input);
            Admin_notification::whereHas('Student', function ($q) {
                $q->where('epo_type', 'dorr');
            })->where('readed', '0')->where('message_type', 'new_student')->update(['readed' => '1']);
        } elseif ($user->role_id == 8) {
            $data = Student::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('is_new', 'y')->orderBy('created_at', 'desc')->get();
            Student::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('admin_view', 0)->update($input);
            Admin_notification::whereHas('Student', function ($q) use ($user) {
                $q->where('epo_type', 'far_learn')->where('gender', $user->gender);
            })->where('readed', '0')->where('message_type', 'new_student')->update(['readed' => '1']);
        } else {
            $data = Student::where('is_new', 'y')->orderBy('created_at', 'desc')->get();
            Admin_notification::where('readed', '0')->where('message_type', 'new_student')->update(['readed' => '1']);
        }
        return view('admin.web_settings.students.students_settings', compact('data'));
    }

    public function details($type, $id)
    {
        $data = Student::findOrFail($id);
        $parent_data = Student_parent::where('student_id', $id)->first();
        return view('admin.web_settings.students.details', compact('data', 'parent_data'));
    }

    public function edit($id)
    {
        $data = Student::find($id);
        return view('admin.web_settings.students.edit', compact('data'));
    }

    public function edit_student_subject($type, $id)
    {
        $data = Student::find($id);
        return view('admin.web_settings.students.edit_student_subject', compact('data'));
    }

    public function update_subject_data(Request $request)
    {
        $subject_data['level_id'] = $request->level_id;
        $subject_data['subject_id'] = $request->subject_id;
        $subject_data['subject_level_id'] = $request->subject_level_id;
        $subject_data['interview'] = 'y';
        $subject_data['is_new'] = 'accepted';
        Student::where('id', $request->id)->update($subject_data);

        $history_data['student_id'] = $request->id;
        $history_data['level_id'] = $request->level_id;
        $history_data['subject_id'] = $request->subject_id;
        $history_data['subject_level_id'] = $request->subject_level_id;
        $history_data['notes_ar'] = 'تعديل المشرف للمنهج';
        $history_data['notes_en'] = 'Modify admin the subject';
        Student_level_history::create($history_data);

        $epo_stud_data['level_id'] = $request->level_id;
        $epo_stud_data['subject_id'] = $request->subject_id;
        $epo_stud_data['subject_level_id'] = $request->subject_level_id;
        Episode_student::where('student_id', $request->id)->where('status', 'new')->update($epo_stud_data);

        $student = Student::findOrFail($request->id);
        $email = $student->email;
        Mail::raw('تم قبول حسابك من جهه الادارة ....... تستطيع تسجيل الدخول للوحة التحكم الان .... ' . '  رابط الموقع هنا :  ' . env('APP_URL') . 'student/home', function ($message) use ($email) {
            $message->subject(trans('s_admin.title'));
            $message->from(env('MAIL_USERNAME'), 'online learning');
            $message->to($email);
        });
        Alert::success(trans('s_admin.subject'), trans('s_admin.subject_placed'));
        return redirect()->back();
    }

    public function place_episode(Request $request)
    {
        $student = Student::find($request->id);

        $data['student_id'] = $request->id;
        $data['episode_id'] = $request->episode_id;
        $data['level_id'] = $student->level_id;
        $data['subject_id'] = $student->subject_id;
        $data['subject_level_id'] = $student->subject_level_id;

        Episode_student::create($data);
        $student = Student::findOrFail($request->id);
        $email = $student->email;
        Mail::raw('تم أضافتك لحلقة جديدة ....... تستطيع تسجيل الدخول للوحة التحكم الان .... ' . '  رابط الموقع هنا :  ' . env('APP_URL') . 'student/home', function ($message) use ($email) {
            $message->subject(trans('s_admin.title'));
            $message->from(env('MAIL_USERNAME'), 'online learning');
            $message->to($email);
        });
        Alert::success(trans('s_admin.episode'), trans('s_admin.episode_placed'));
        return redirect()->back();
    }

    public function destroy_student_epo($id)
    {
        $epo = Episode_student::find($id);
        $epo->delete();
        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return redirect()->back();
    }

    public function change_student_epo(Request $request)
    {
        $epo = Episode_student::find($request->stud_epo_id);
        $epo->episode_id = $request->episode_id;
        $epo->save();
        Alert::success(trans('s_admin.change_episode'), trans('s_admin.change_episode_s'));
        return redirect()->back();
    }

    public function change_student_epo_type($id)
    {
        $student = Student::find($id);
        if ($student->epo_type == 'far_learn') {
            if ($student->gender == 'male') {
                $student->epo_type = 'mogmaa';
            } else if ($student->gender == 'female') {
                $student->epo_type = 'dorr';
            }
        } else if ($student->epo_type == 'dorr' || $student->epo_type == 'mogmaa') {
            $student->epo_type = 'far_learn';
        }
        $student->save();
        Alert::success(trans('s_admin.change_epos_type'), trans('s_admin.change_epos_type_s'));
        return redirect()->back();
    }

    public function re_verify_mail($id, $type)
    {
        $student = Student::findOrFail($id);
        //mailHere
        if ($type == 'mail') {
            $data_verify['code'] = $student->code;
            $data_verify['type'] = "student";
            $data_verify['email'] = $student->email;
            $data_verify['lang'] = $student->main_lang;
            $student->notify(new VerfiyRegister($data_verify));
        } elseif ($type == 'sms') {
            if ($student->main_lang == 'ar') {
                $message = trans('s_admin.title') . ' - اهلا بك ' . $student->user_name . ' ! '
                    . 'يرجى التوجة للبريد الإلكتروني الخاص بك '
                    . ' و ذلك لتفعيل حسابك في مقرأة عنيزة الإلكترونية';
            } else {
                $message = trans('s_admin.title') . ' - Hey ' . $student->user_name . ' !
                            Please go to your email This is to activate your account in the Unaizah electronic reading';
            }

            $data_verify['code'] = $student->code;
            $data_verify['type'] = "student";
            $data_verify['email'] = $student->email;
            $data_verify['lang'] = $student->main_lang;
            $student->notify(new VerfiyRegister($data_verify));

            /*
               if ($student->main_lang == 'ar') {
                $message = 'اهلا بك ' . $student->user_name . ' ! '
                    . 'كود التحقق :'.$student->code
                    .' اضغط الرابط ' . env('APP_URL') . 'reverify/' . $student->id . '/' . $student->code . '/account'
                    .' و ذلك لتفعيل حسابك في مقرأة عنيزة الإلكترونية';
            } else {
                $message = 'Hey ' . $student->user_name . ' !
                            A code verification has been updated now by admin
                            To Complete your data '
                    . 'click the next link to verify your account '
                    . env('APP_URL') . 'reverify/' . $student->id . '/' . $student->code . '/account';
            }
            */
            $phone = $student->country_code . $student->phone;
            $result = $this->SendSMS($phone, $message);
            $data['message'] = $message;
            $data['receiver_id'] = $student->id;
            $data['receiver_type'] = 'student';
            Sms_message::create($data);
        }


        Alert::success(trans('s_admin.success_operation'), trans('s_admin.resend_mail_s'));
        return redirect()->back();
    }

    public function update_Actived(Request $request)
    {
        $data['status'] = $request->status;
        $user = Student::where('id', $request->id)->update($data);

        return 1;
    }

    public function destroy(Request $request, $id)
    {
        $student = Student::find($id);
        $student->deleted_id = auth()->guard('web')->user()->id;
        $student->save();
        $student->delete();

        Alert::success(trans('s_admin.delete'), trans('s_admin.deleted_s'));
        return redirect()->back();
    }

}
