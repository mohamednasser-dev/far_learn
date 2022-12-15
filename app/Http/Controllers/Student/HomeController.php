<?php

namespace App\Http\Controllers\Student;

use App\Models\City;
use App\Models\District;
use App\Models\Plan_section_degree;
use App\Models\Student_level_history;
use App\Models\Student_Questions_episode;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Password;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Alkoumi\LaravelHijriDate\Hijri;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use App\Models\Student;

class HomeController extends Controller
{

    public function sendEmail()
    {
        $credentials = ['email' => 'asd09505@gmail.com'];
        $response = Password::sendResetLink($credentials, function (Message $message) {
            $message->subject($this->getEmailSubject());
        });

        switch ($response) {
            case Password::RESET_LINK_SENT:
                return redirect()->back()->with('status', trans($response));
            case Password::INVALID_USER:
                return redirect()->back()->withErrors(['email' => trans($response)]);
        }
    }

    public function change_colors(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'main_color' => 'required',
                'second_color' => 'required',
                'button_color' => 'required',
                'icon_color' => 'required'
            ]);
        Student::where('id', auth('student')->user()->id)->update($data);
        Alert::success(trans('s_admin.colors'), trans('s_admin.color_changed_s'));
        return back();
    }

    public function change_colors_reset()
    {
        $data['main_color'] = null;
        $data['second_color'] = null;
        $data['button_color'] = 'btn-success';
        $data['icon_color'] = 'svg-icon-success';
        Student::where('id', auth('student')->user()->id)->update($data);
        Alert::success(trans('s_admin.colors'), trans('s_admin.color_changed_s'));
        return back();
    }

    public function index()
    {
        $lang = auth::guard('student')->user()->main_lang;
        if (session()->has('lang')) {
            session()->forget('lang');
        }
        session()->put('lang', $lang);
        \App::setLocale($lang);
        if (auth::guard('student')->user()->complete_data == 0) {
            $data = Student::where('id', auth::guard('student')->user()->id)->first();
            return view('student.profile.index', compact('data'));
        } else {
            $last_save = Student_Questions_episode::where('student_id', auth::guard('student')->user()->id)->orderBy('created_at', 'desc')->first();
            $degree_count = Plan_section_degree::whereDate('created_at', Carbon::now())->where('student_id', auth::guard('student')->user()->id)->where('type', '!=', 'absence')->get()->count();
            return view('student.home', compact('degree_count', 'last_save'));
        }

    }

    public function ChangePasswordStudent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed',
            'curr_pass' => 'required',
        ]);

        $pass = Student::find(Auth::guard('student')->id())->password;
        if (\Hash::check($request->curr_pass, $pass)) {
            $data = Student::find(Auth::guard('student')->id());
            $data->password = \Hash::make($request->password);
            $data->save();
            Alert::success(trans('s_admin.success'), trans('s_admin.pass_changed'));
            return back()->with('message', trans('s_admin.pass_changed'));
        } else {
            Alert::error(trans('s_admin.error'), trans('s_admin.current_pass_incorrect'));
            return back()->with('message', trans('s_admin.current_pass_incorrect'));
        }
    }

    public function profile()
    {
        $data = Student::where('id', auth::guard('student')->user()->id)->first();
        return view('student.profile.index', compact('data'));
    }

    public function change_pass()
    {
        $data = Student::where('id', auth::guard('student')->user()->id)->first();
        return view('student.profile.index', compact('data'));
    }

    public function update_profile(Request $request)
    {
        if (auth()->guard('student')->user()->complete_data == '1') {
            $input = $this->validate(\request(),
                [
                    'qualification' => 'required',
                    'first_name_ar' => 'required',
                    'last_name_ar' => 'required',
                    'country_code' => 'required',
                    'nationality' => 'required',
                    'mid_name_ar' => 'required',
                    'ident_num' => 'required',
                    'level_id' => '',
                    'country' => 'required',
                    'main_lang' => 'required',
//                    'phone' => 'required',
                    'image' => '',
                    'subject_id' => '',
                    'date_of_birth' => '',
                    'save_quran_num' => '',
                    'save_quran_limit' => '',
                    'gender' => 'required',
                    'subject_level_id' => '',
                ]);
        } else {
            if ($request->level_id != null) {
                $input = $this->validate(\request(),
                    [
                        'level_id' => 'required',
                    ]);
            }
            $input = $this->validate(\request(),
                [
                    'qualification' => 'required',
                    'first_name_ar' => 'required',
                    'last_name_ar' => 'required',
                    'country_code' => 'required',
                    'nationality' => 'required',
                    'mid_name_ar' => 'required',
                    'ident_num' => 'required',
                    'level_id' => '',
                    'main_lang' => 'required',
//                    'phone' => 'required',
                    'country' => 'required',
                    'image' => '',
                    'subject_id' => '',
                    'date_of_birth' => '',
                    'save_quran_num' => '',
                    'save_quran_limit' => '',
                    'gender' => 'required',
                    'subject_level_id' => '',
                ]);
        }
        $student = Student::where('id', auth::guard('student')->user()->id)->first();
        if ($student->epo_type != 'far_learn') {
            $input = $this->validate(\request(),
                [
                    'district_id' => 'required',
                ]);
        }
        $input['first_name_en'] = $request->first_name_ar;
        $input['mid_name_en'] = $request->mid_name_ar;
        $input['last_name_en'] = $request->last_name_ar;
        $input['user_name'] = $request->first_name_ar . " " . $request->mid_name_ar . " " . $request->last_name_ar;

        $selected_date = $request->date_of_birth;
        if (session()->has('lang')) {
            session()->forget('lang');
        }
        session()->put('lang', $request->main_lang);
        \App::setLocale($request->main_lang);

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
            $file->move(public_path('uploads/students'), $fileNewName);
            $input['image'] = $fileNewName;
        }

        if ($student->epo_type != 'far_learn') {
            if ($student->interview == 'y') {
//                unset($input['save_quran_num']);
//                unset($input['save_quran_limit']);
                unset($input['level_id']);
                unset($input['subject_id']);
                unset($input['subject_level_id']);
            } else {
                if ($request->level_id != null) {
                    $history_data['student_id'] = auth::guard('student')->user()->id;
                    $history_data['level_id'] = $request->level_id;
                    $history_data['subject_id'] = $request->subject_id;
                    $history_data['subject_level_id'] = $request->subject_level_id;
                    $history_data['notes_ar'] = 'أول  منهج  للطالب بعد تسجيل الحساب';
                    $history_data['notes_en'] = 'The first course of the student after registering the account';
                    Student_level_history::create($history_data);
                }
            }
        } else {
            if ($request->level_id != null) {
                $history_data['student_id'] = auth::guard('student')->user()->id;
                $history_data['level_id'] = $request->level_id;
//                $history_data['subject_id'] = $request->subject_id ;
//                $history_data['subject_level_id'] = $request->subject_level_id ;
                $history_data['notes_ar'] = 'أول  منهج  للطالب بعد تسجيل الحساب';
                $history_data['notes_en'] = 'The first course of the student after registering the account';
                Student_level_history::create($history_data);
            }
        }

        $data = Student::where('id', auth::guard('student')->user()->id)->update($input);
        if ($data > 0) {
            $student->complete_data = '1';
            $student->save();
            if ($student->epo_type != 'far_learn') {
                if ($student->interview == 'y') {
                    Alert::success(trans('s_admin.update'), trans('s_admin.updated_s'));
                    return back();
                } else {
                    Alert::warning(trans('s_admin.warning'), trans('s_admin.will_contact_with_u'));
                    return redirect(url('/student/home'));
                }
            }
            Alert::success(trans('s_admin.personal_info'), trans('s_admin.proileupdated_s'));
            return back();
        }
        return view('student.profile.index', compact('data'));
    }

    public function logout()
    {
        $user = Auth::guard('student')->user();
        Auth::guard('student')->logout();
        return redirect('/');
    }

    public function get_zones(Request $request, $id)
    {
        $data = Zone::where('country_id', $id)->get();
        return view('admin.reports.data.parts.zones', compact('data'));
    }

    public function get_cities(Request $request, $id)
    {
        $data = City::where('zone_id', $id)->get();
        return view('admin.reports.data.parts.cities', compact('data'));
    }

    public function get_districts(Request $request, $id)
    {
        $data = District::where('city_id', $id)->get();
        return view('admin.reports.data.parts.districts', compact('data'));
    }
}
