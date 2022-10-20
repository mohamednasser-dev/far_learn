<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin_notification;
use App\Models\Episode;
use App\Models\Episode_student;
use App\Models\Episode_teacher;
use App\Models\Notification;
use App\Models\SmsSetting;
use App\Models\Student;
use App\Models\Teacher;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Model_has_role;
use Illuminate\Database\QueryException;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;
use App\Models\User;
use Exception;

class HomeController extends Controller
{

    public function index()
    {
        $user = \auth()->user();
        $student_month_count = [];
        $months = [];
        $years = [];
        $students_by_month = [];
        $teachers_by_month = [];
        $teachers_month_count = [];
        $year = Carbon::now()->year;
        // For admin users Total paper Chart11
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {
            //to get teachers
            $episode_teacher_ids = Episode::where('college_id', $user->college_id)->where('type', 'mogmaa')->pluck('teacher_id')->toArray();
            $teachers = Teacher::whereIn('id', $episode_teacher_ids)->where('is_new', 'accepted')->orderBy('created_at', 'desc')->get();
            //to get students
            $episode_ids = Episode::where('college_id', $user->college_id)->where('active', 'y')->where('type', 'mogmaa')->pluck('id')->toArray();
            $episode_students_ids = Episode_student::whereIn('episode_id', $episode_ids)->where('deleted', '0')->pluck('student_id')->toArray();
            $students = Student::whereIn('id', $episode_students_ids)->where('is_new', 'accepted')->orderBy('created_at', 'desc')->get();
            //to get episodes
            $episodes = Episode::where('college_id', $user->college_id)->where('type', 'mogmaa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            //for chart num 2
            $accepted_students = Student::whereIn('id', $episode_students_ids)->where('is_new', 'accepted')->count();
            $rejected_students = Student::whereIn('id', $episode_students_ids)->where('is_new', 'rejected')->get()->count();

            //for last chart
            $students_by_month = Student::whereIn('id', $episode_students_ids)->where('is_new', 'accepted')->where('interview', 'y')->where('is_verified', '1')
                ->where('complete_data', '1')->whereYear('created_at', $year)
                ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get();
            $teachers_by_month = Teacher::whereIn('id', $episode_students_ids)->where('is_new', 'accepted')->where('is_verified', '1')->whereYear('created_at', $year)
                ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get();
        } elseif ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) {
            //to get teachers
            $episode_teacher_ids = Episode::where('college_id', $user->college_id)->where('type', 'dorr')->pluck('teacher_id')->toArray();
            $teachers = Teacher::whereIn('id', $episode_teacher_ids)->where('is_new', 'accepted')->orderBy('created_at', 'desc')->get();
            //to get students
            $episode_ids = Episode::where('college_id', $user->college_id)->where('active', 'y')->where('type', 'dorr')->pluck('id')->toArray();
            $episode_students_ids = Episode_student::whereIn('episode_id', $episode_ids)->where('deleted', '0')->pluck('student_id')->toArray();
            $students = Student::whereIn('id', $episode_students_ids)->where('is_new', 'accepted')->orderBy('created_at', 'desc')->get();
            //to get episodes
            $episodes = Episode::where('college_id', $user->college_id)->where('type', 'dorr')->where('deleted', '0')->orderBy('id', 'desc')->get();
            //for chart num 2
            $accepted_students = Student::whereIn('id', $episode_students_ids)->where('is_new', 'accepted')->get()->count();
            $rejected_students = Student::whereIn('id', $episode_students_ids)->where('is_new', 'rejected')->get()->count();

            //for last chart
            $students_by_month = Student::whereIn('id', $episode_students_ids)->where('is_new', 'accepted')->where('interview', 'y')->where('is_verified', '1')
                ->where('complete_data', '1')->whereYear('created_at', $year)
                ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get();
            $teachers_by_month = Teacher::whereIn('id', $episode_students_ids)->where('is_new', 'accepted')->where('is_verified', '1')->whereYear('created_at', $year)
                ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get();
        } elseif ($user->role_id == 8) {
            $students = Student::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('is_new', 'accepted')->orderBy('created_at', 'desc')->get();
            $teachers = Teacher::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('is_new', 'accepted')->orderBy('created_at', 'desc')->get();
            $episodes = Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            //for chart num 2
            $accepted_students = Student::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('is_new', 'accepted')->get()->count();
            $rejected_students = Student::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('is_new', 'rejected')->get()->count();

            //for last chart
            $students_by_month = Student::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('is_new', 'accepted')->where('interview', 'y')->where('is_verified', '1')
                ->where('complete_data', '1')->whereYear('created_at', $year)
                ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get();
            $teachers_by_month = Teacher::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('is_new', 'accepted')->where('is_verified', '1')->whereYear('created_at', $year)
                ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get();
        } elseif ($user->role_id == 6) {
            $students = Student::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->orderBy('created_at', 'desc')->get();
            $teachers = Teacher::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->orderBy('created_at', 'desc')->get();
            $episodes = Episode::where('type', 'mogmaa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            //for chart num 2
            $accepted_students = Student::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->get()->count();
            $rejected_students = Student::where('epo_type', 'mogmaa')->where('is_new', 'rejected')->get()->count();

            //for last chart
            $students_by_month = Student::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->where('interview', 'y')->where('is_verified', '1')
                ->where('complete_data', '1')->whereYear('created_at', $year)
                ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get();
            $teachers_by_month = Teacher::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->where('is_verified', '1')->whereYear('created_at', $year)
                ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get();
        } elseif ($user->role_id == 7) {
            $students = Student::where('epo_type', 'dorr')->where('is_new', 'accepted')->orderBy('created_at', 'desc')->get();
            $teachers = Teacher::where('epo_type', 'dorr')->where('is_new', 'accepted')->orderBy('created_at', 'desc')->get();
            $episodes = Episode::where('type', 'dorr')->where('deleted', '0')->orderBy('id', 'desc')->get();
            //for chart num 2
            $accepted_students = Student::where('epo_type', 'dorr')->where('is_new', 'accepted')->get()->count();
            $rejected_students = Student::where('epo_type', 'dorr')->where('is_new', 'rejected')->get()->count();

            //for last chart
            $students_by_month = Student::where('epo_type', 'dorr')->where('is_new', 'accepted')->where('interview', 'y')->where('is_verified', '1')
                ->where('complete_data', '1')->whereYear('created_at', $year)
                ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get();
            $teachers_by_month = Teacher::where('epo_type', 'dorr')->where('is_new', 'accepted')->where('is_verified', '1')->whereYear('created_at', $year)
                ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                ->groupby('year', 'month')
                ->get();
        } else {
            $students = Student::where('is_new', 'accepted')->get();
            $teachers = Teacher::where('is_new', 'accepted')->get();
            $episodes = Episode::where('deleted', '0')->get();
            $accepted_students = Student::where('is_new', 'accepted')->get()->count();
            $rejected_students = Student::where('is_new', 'rejected')->get()->count();
            //for last chart
            $exists_students = Student::where('is_new', 'accepted')->where('interview', 'y')->where('is_verified', '1')
                ->where('complete_data', '1')->whereYear('created_at', $year)
                ->get();

                $students_by_month = Student::where('is_new', 'accepted')->where('interview', 'y')->where('is_verified', '1')
                    ->where('complete_data', '1')->whereYear('created_at', $year)
                    ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                    ->groupby('year', 'month')
                    ->get();

            $exists_teachers = Teacher::where('is_new', 'accepted')->where('is_verified', '1')->whereYear('created_at', $year)
                ->get();

                $teachers_by_month = Teacher::where('is_new', 'accepted')->where('is_verified', '1')->whereYear('created_at', $year)
                    ->select(DB::raw('count(id) as `data`'), DB::raw("DATE_FORMAT(created_at, '%m-%Y') new_date"), DB::raw('YEAR(created_at) year, MONTH(created_at) month'))
                    ->groupby('year', 'month')
                    ->get();

        }

        $students_numbers = json_encode($accepted_students);
        $teachers_numbers = json_encode($teachers);

        $acc_students_numbers = json_encode($accepted_students);
        $rej_students_numbers = json_encode($rejected_students);

        $episode_names[0] = trans('s_admin.student_number');
        $episode_names[1] = trans('s_admin.teachers_number');
        $people_names = json_encode($episode_names);

        $episode_names_rejected[0] = trans('s_admin.accepteds');
        $episode_names_rejected[1] = trans('s_admin.rejecteds');
        $episode_names_rejected = json_encode($episode_names_rejected);


        // For admin users Total paper Chart12 -------------------------------------------------------------------------------------
        $mqraa_epo = Episode::where('deleted', '0')->where('type', 'mqraa')->get()->count();
        $mogmaa_epo = Episode::where('deleted', '0')->where('type', 'mogmaa')->get()->count();
        $dorr_epo = Episode::where('deleted', '0')->where('type', 'dorr')->get()->count();

        $mqraa_epo = json_encode($mqraa_epo);
        $mogmaa_epo = json_encode($mogmaa_epo);
        $dorr_epo = json_encode($dorr_epo);

        $episode_names[0] = trans('s_admin.episode_mqraa');
        $episode_names[1] = trans('s_admin.mogmaa_epos');
        $episode_names[2] = trans('s_admin.nav_dorr_epo');
        $episode_mqraa_name = json_encode($episode_names);

        //for admin chart5
        //students

        $student_arr[0] = "";
        $student_arr[1] = "";
        $student_arr[2] = "";
        $student_arr[3] = "";
        $student_arr[4] = "";
        $student_arr[5] = "";
        $student_arr[6] = "";
        $student_arr[7] = "";
        $student_arr[8] = "";
        $student_arr[9] = "";
        $student_arr[10] = "";
        $student_arr[11] = "";
        $student_arr[12] = "";

        foreach ($students_by_month as $key => $row) {
            $student_month_count[$key] = $row->data;
//                    $months[$key] = date('F', strtotime($row->month)) ;
            $months[$key] = $row->month;
            $years[$key] = $row->year;
            $new_month = $row->month - 1;
            $student_arr[$new_month] = $row->data;
        }

        $teacher_arr[0] = "";
        $teacher_arr[1] = "";
        $teacher_arr[2] = "";
        $teacher_arr[3] = "";
        $teacher_arr[4] = "";
        $teacher_arr[5] = "";
        $teacher_arr[6] = "";
        $teacher_arr[7] = "";
        $teacher_arr[8] = "";
        $teacher_arr[9] = "";
        $teacher_arr[10] = "";
        $teacher_arr[11] = "";
        $teacher_arr[12] = "";
        //teachers

        foreach ($teachers_by_month as $key => $row) {
            $teachers_month_count[$key] = $row->data;
//                    $student_row = $student_month_count[$key] ;
            $new_month = $row->month - 1;
            $teacher_arr[$new_month] = $row->data;
        }
        $student_month_count = json_encode($student_month_count);
        $teachers_month_count = json_encode($teachers_month_count);
        $months = json_encode($months);
        $years = json_encode($years);
        $student_arr = json_encode($student_arr);
        $teacher_arr = json_encode($teacher_arr);


        return view('admin.home', compact('year', 'rej_students_numbers', 'acc_students_numbers', 'episode_names_rejected',
            'student_arr', 'teacher_arr', 'teachers_month_count', 'years', 'months', 'student_month_count', 'people_names',
            'students_numbers', 'teachers_numbers', 'mqraa_epo', 'mogmaa_epo', 'dorr_epo', 'episode_mqraa_name', 'teachers', 'episodes', 'students'));
    }

    public function certificate()
    {
        return view('admin.certificate');
    }

    public function export_certificate(Request $request)
    {
        // dd($request->all());
        $Arabic = new \I18N_Arabic('Glyphs');
        $name = $Arabic->utf8Glyphs($request->name);
        $degree = $Arabic->utf8Glyphs($request->degree);
        $num = $Arabic->int2indic($request->num);
        $from_d = $Arabic->int2indic($request->from_d);
        $from_m = $Arabic->int2indic($request->from_m);
        $from_y = $Arabic->int2indic($request->from_y);
        $to_d = $Arabic->int2indic($request->to_d);
        $to_m = $Arabic->int2indic($request->to_m);
        $to_y = $Arabic->int2indic($request->to_y);

        $img = Image::make(public_path('uploads/certificate/man.jpg'))->resize(800, 566);

        $img->text($name, 375, 248, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($degree, 180, 323, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($num, 130, 250, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($from_d, 583, 324, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($from_m, 548, 324, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($from_y, 497, 324, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($to_d, 395, 324, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($to_m, 360, 324, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->text($to_y, 310, 324, function ($font) {
            $font->file(public_path('uploads/certificate/DejaVuSans.ttf'));
            $font->size(16);
            $font->color('#000000');
        });

        $img->save(public_path('uploads/certificate/1.jpg'));

        dd(public_path('uploads/certificate/1.jpg'));

        return view('admin.certificate');
    }

    public function profile()
    {
        $data = User::where('id', auth()->user()->id)->first();
        return view('admin.profile.index', compact('data'));
    }

    public function notifications()
    {
        $data = Admin_notification::orderBy('created_at', 'desc')->get();
        return view('admin.notifications', compact('data'));
    }

    public function notification_change_readed($id)
    {
        $data = Admin_notification::find($id);
        if ($data->readed == '1') {
            $data->readed = '0';
        } else {
            $data->readed = '1';
        }
        $data->save();
        Alert::success(trans('s_admin.pop_notifications'), trans('s_admin.status_changes_s'));
        return redirect()->back();
    }


    public function store_profile(Request $request)
    {

        $data = $this->validate(\request(),
            [
                'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,bmp',
                'name' => 'required',
                'phone' => ''
            ]);
        if ($request['image'] != null) {
            // This is Image Information ...
            $file = $request->file('image');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('/uploads/users_images'), $fileNewName);
            $data['image'] = $fileNewName;
        } else {
            $data['image'] = 'default_cert.png';
        }
        $data['phone'] = $request->phone;
        User::where('id', auth()->user()->id)->update($data);
        Alert::success(trans('s_admin.personal_info'), trans('s_admin.proileupdated_s'));
        return back();
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
        User::where('id', auth()->user()->id)->update($data);
        Alert::success(trans('s_admin.colors'), trans('s_admin.color_changed_s'));
        return back();
    }

    public function update_pass(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'password' => 'required|confirmed|min:8',
            'curr_pass' => 'required',
        ]);
        $pass = User::find(auth()->user()->id)->password;
        if (\Hash::check($request->curr_pass, $pass)) {
            $data = User::find(auth()->user()->id);
            $data->password = \Hash::make($request->password);
            $data->save();
            Alert::success(trans('s_admin.success'), "تم تغيير كلمة المرور بنجاح ");
            return back()->with('message', trans('s_admin.pass_changed'));
        } else {
            Alert::error(trans('s_admin.error'), "كلمة المرور الحالية غير صحيحة ");
            return back()->with('message', 'كلمة المرور الحالية غير صحيحة   ');
        }
    }
}
