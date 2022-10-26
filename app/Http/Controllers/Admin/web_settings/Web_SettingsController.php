<?php

namespace App\Http\Controllers\Admin\web_settings;

use App\Models\Episode_rate_question;
use App\Models\Student;
use App\Models\Teacher;
use RealRashid\SweetAlert\Facades\Alert;
use Spatie\Permission\Models\Model_has_role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Web_setting;
use App\Models\Slider;

class Web_SettingsController extends Controller
{

    public function index()
    {
        $data = Web_setting::findOrFail(1);
        return view('admin.web_settings.index', compact('data'));
    }

    public function teacher_settings()
    {
        $data = Teacher::orderBy('status', 'desc')->get();
        return view('admin.web_settings.teachers_settings', compact('data'));
    }

    public function student_settings()
    {
        $data = Student::orderBy('status', 'desc')->get();
        return view('admin.web_settings.students_settings', compact('data'));
    }

    public function join_orders_rejected()
    {
        $user = \auth()->user();
        if ($user->role_id == 6) {
            $teacher_data = Teacher::where('epo_type', 'mogmaa')->where('is_new', 'rejected')->orderBy('id', 'desc')->paginate(15);
            $student_data = Student::where('epo_type', 'mogmaa')->where('is_new', 'rejected')->orderBy('id', 'desc')->paginate(15);
        } elseif ($user->role_id == 7) {
            $teacher_data = Teacher::where('epo_type', 'dorr')->where('is_new', 'rejected')->orderBy('id', 'desc')->paginate(15);
            $student_data = Student::where('epo_type', 'dorr')->where('is_new', 'rejected')->orderBy('id', 'desc')->paginate(15);
        } elseif ($user->role_id == 8) {
            $teacher_data = Teacher::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('is_new', 'rejected')->orderBy('id', 'desc')->paginate(15);
            $student_data = Student::where('epo_type', 'far_learn')->where('gender', $user->gender)->where('is_new', 'rejected')->orderBy('id', 'desc')->paginate(15);
        } else {
            $teacher_data = Teacher::where('is_new', 'rejected')->orderBy('id', 'desc')->paginate(15);
            $student_data = Student::where('is_new', 'rejected')->orderBy('id', 'desc')->paginate(15);
        }
        return view('admin.web_settings.reject_join_orders', compact('teacher_data', 'student_data'));
    }

    public function update(Request $request, $id)
    {

        $data = $this->validate(\request(),
            [
                'title_ar' => 'required',
                'title_en' => 'required',
                'phone' => 'required',
                'email' => 'required',
                'address_ar' => 'required',
                'address_en' => 'required',
                'about_ar' => 'required',
                'about_en' => 'required',
                'facebook' => 'nullable',
                'twiter' => 'nullable',
                'youtube' => 'nullable',
                'insta' => 'nullable',
                'linked_in' => 'nullable',
                'color' => 'required',
                'app_main_color' => 'required',
                'app_second_color' => 'required',
                'app_background_color' => 'required',
                'app_button_color' => 'required',
                'app_font_light_color' => 'required',
                'app_font_dark_color' => 'required',
                'app_icon_color' => 'required',
            ]);
        if ($request->logo_ar != null) {
            $file = $request->file('logo_ar');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/logo'), $fileNewName);
            $data['logo_ar'] = $fileNewName;
        }
        if ($request->logo_en != null) {
            $file = $request->file('logo_en');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/logo'), $fileNewName);
            $data['logo_en'] = $fileNewName;
        }
        if ($request->admin_logo_ar != null) {
            $file = $request->file('admin_logo_ar');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/logo'), $fileNewName);
            $data['admin_logo_ar'] = $fileNewName;
        }
        if ($request->admin_logo_en != null) {
            $file = $request->file('admin_logo_en');
            $name = $file->getClientOriginalName();
            $ext = $file->getClientOriginalExtension();
            // Move Image To Folder ..
            $fileNewName = 'img_' . time() . '.' . $ext;
            $file->move(public_path('uploads/logo'), $fileNewName);
            $data['admin_logo_en'] = $fileNewName;
        }
        if ($request->show_mogmaa_dorr == 'on') {
            $data['show_mogmaa_dorr'] = '1';
        } else {
            $data['show_mogmaa_dorr'] = '0';
        }
        if ($request->show_search_teacher == 'on') {
            $data['show_search_teacher'] = '1';
        } else {
            $data['show_search_teacher'] = '0';
        }
        if ($request->show_free_subject == 'on') {
            $data['show_free_subject'] = '1';
        } else {
            $data['show_free_subject'] = '0';
        }
        if ($request->show_fixed_subject == 'on') {
            $data['show_fixed_subject'] = '1';
        } else {
            $data['show_fixed_subject'] = '0';
        }
        if ($request->rating == 'on') {
            $data['rating'] = '1';
        } else {
            $data['rating'] = '0';
        }
        Web_setting::findOrFail($id)->update($data);
        Alert::success(trans('admin.update'), trans('admin.updatSuccess'));
        return back();
    }


}
