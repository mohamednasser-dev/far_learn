<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\College;
use App\Models\District;
use App\Models\Episode;
use App\Models\Episode_day;
use App\Models\Episode_student;
use App\Models\Episode_teacher;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class BasicController extends Controller
{
    public function index()
    {
        $data = [];

        $user = auth()->user();
        if ($user->role_id == 3) {//مدير المجمع
            $input_data['colleges_mogmaa'] = College::where('id', $user->college_id)->where('deleted', '0')->pluck('name_' . app()->getLocale(), 'id');
        } elseif ($user->role_id == 6) {//مديرة المجمعات
            $input_data['colleges_mogmaa'] = College::where('type', 'college')->where('deleted', '0')->pluck('name_' . app()->getLocale(), 'id');
        } elseif ($user->role_id == 5) { //مديرة الدار
            $input_data['colleges_dorr'] = College::where('id', $user->college_id)->where('deleted', '0')->pluck('name_' . app()->getLocale(), 'id');
        } elseif ($user->role_id == 7) {//مديرة الدور النسائية
            $input_data['colleges_dorr'] = College::where('type', 'dorr')->where('deleted', '0')->pluck('name_' . app()->getLocale(), 'id');
        } elseif ($user->role_id == 2) {//مديرة النظام
            $input_data['colleges_mogmaa'] = College::where('type', 'college')->where('deleted', '0')->pluck('name_' . app()->getLocale(), 'id');
            $input_data['colleges_dorr'] = College::where('type', 'dorr')->where('deleted', '0')->pluck('name_' . app()->getLocale(), 'id');
        } elseif ($user->role_id == 8) {//مسئول المقرأة
            $input_data['colleges_mogmaa'] = [];
            $input_data['colleges_dorr'] = [];
        } else {
            $input_data['colleges_mogmaa'] = [];
            $input_data['colleges_dorr'] = [];
        }

        return view('admin.reports.data.index', compact('data', 'input_data'));
    }

    public function get_zones(Request $request, $id)
    {
        $data = Zone::where('country_id', $id)->get();
        return view('admin.reports.data.parts.zones', compact('data'));
    }

    public function get_students(Request $request, $id)
    {
        $student_ids = Episode_student::where('episode_id', $id)->where('deleted', '0')->pluck('student_id');
        $data = Student::whereIn('id', $student_ids)->get();
        return view('admin.reports.data.parts.students', compact('data'));
    }

    public function get_teachers(Request $request, $id)
    {
        $teacher_ids = Episode_teacher::where('episode_id', $id)->pluck('teacher_id');
        $baic_teacher = Episode::whereId($id)->first()->teacher_id;
        if ($baic_teacher) {
            $teacher_ids[count($teacher_ids)] = $baic_teacher;
        }
        $data = Teacher::whereIn('id', $teacher_ids)->get();
        return view('admin.reports.data.parts.teachers', compact('data'));
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

    public function get_episodes(Request $request, $id)
    {
        $data = Episode::where('college_id', $id)->get();
        return view('admin.reports.data.parts.episodes', compact('data'));
    }

    public function search(Request $request)
    {

        $result = Student::query();

        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {//مدير المجمع
            $episode_ids = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->pluck('id')->toArray();
            $student_epo_ids = Episode_student::whereIn('episode_id', $episode_ids)->where('deleted', '0')->pluck('student_id')->toArray();
            $result = $result->whereIn('id', $student_epo_ids);
        } elseif ($user->role_id == 6) {//مديرة المجمعات
            $episode_ids = Episode::where('type', 'mogmaa')->pluck('id')->toArray();
            $student_epo_ids = Episode_student::whereIn('episode_id', $episode_ids)->where('deleted', '0')->pluck('student_id')->toArray();
            $result = $result->whereIn('id', $student_epo_ids);
        } elseif ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            $episode_ids = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->pluck('id')->toArray();
            $student_epo_ids = Episode_student::whereIn('episode_id', $episode_ids)->where('deleted', '0')->pluck('student_id')->toArray();
            $result = $result->whereIn('id', $student_epo_ids);
        } elseif ($user->role_id == 7) {//مديرة الدور النسائية
            $episode_ids = Episode::where('type', 'dorr')->pluck('id')->toArray();
            $student_epo_ids = Episode_student::whereIn('episode_id', $episode_ids)->where('deleted', '0')->pluck('student_id')->toArray();
            $result = $result->whereIn('id', $student_epo_ids);
        } elseif ($user->role_id == 8) {//مسئول المقرأة
            $episode_ids = Episode::where('type', 'mqraa')->where('gender', $user->gender)->pluck('id')->toArray();
            $student_epo_ids = Episode_student::whereIn('episode_id', $episode_ids)->where('deleted', '0')->pluck('student_id')->toArray();
            $result = $result->whereIn('id', $student_epo_ids);
        }

        $result = $result->where('is_new', 'accepted')->where('interview', 'y')->where('is_verified', '1');

        if ($request->student_name != null) {
            $student_ids = Student::where('first_name_ar', 'like', '%' . $request->student_name . '%')
                ->orWhere('user_name', 'like', '%' . $request->student_name . '%')
                ->orWhere('mid_name_ar', 'like', '%' . $request->student_name . '%')
                ->orWhere('last_name_ar', 'like', '%' . $request->student_name . '%')
                ->orWhere('first_name_en', 'like', '%' . $request->student_name . '%')
                ->orWhere('mid_name_en', 'like', '%' . $request->student_name . '%')
                ->orWhere('last_name_en', 'like', '%' . $request->student_name . '%')->pluck('id')->toArray();
            $result = $result->whereIn('id', $student_ids);
        }

        if ($request->college_id != null) {
            $episode_ids = Episode::where('type', 'mogmaa')->where('college_id', $request->college_id)->pluck('id')->toArray();
            $student_epo_ids = Episode_student::whereIn('episode_id', $episode_ids)->where('deleted', '0')->pluck('student_id')->toArray();
            $result = $result->whereIn('id', $student_epo_ids);
        }
        if ($request->dorr_id != null) {
            $episode_ids = Episode::where('type', 'dorr')->where('college_id', $request->dorr_id)->pluck('id')->toArray();
            $student_epo_ids = Episode_student::whereIn('episode_id', $episode_ids)->where('deleted', '0')->pluck('student_id')->toArray();
            $result = $result->whereIn('id', $student_epo_ids);
        }
        if ($request->episode_id != null) {
            $episode_ids = Episode::where('id', $request->episode_id)->pluck('id')->toArray();
            $student_epo_ids = Episode_student::whereIn('episode_id', $episode_ids)->where('deleted', '0')->pluck('student_id')->toArray();
            $result = $result->whereIn('id', $student_epo_ids);
        }
        if ($request->phone != null) {
            $result = $result->where('phone', $request->phone);
        }
        if ($request->ident_num != null) {
            $result = $result->where('ident_num', $request->ident_num);
        }
        if ($request->nationality != null) {
            $result = $result->where('nationality', $request->nationality);
        }
        if ($request->qualification != null) {
            $result = $result->where('qualification', $request->qualification);
        }
        if ($request->country != null) {
            $result = $result->where('country', $request->country);
        }
        if ($request->city_id != null) {
            if ($request->district_id != null) {
                $result = $result->where('district_id', $request->district_id);
            }
        }
        if ($request->level_id != null) {
            $result = $result->where('level_id', $request->level_id);
            if ($request->subject_id != null) {
                $result = $result->where('subject_id', $request->subject_id);
            }
            if ($request->subject_level_id != null) {
                $result = $result->where('subject_level_id', $request->subject_level_id);
            }
        }

        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }

        $data = $result->get();

        $user = auth()->user();
        if ($user->role_id == 3) {//مدير المجمع
            $input_data['colleges_mogmaa'] = College::where('id', $user->college_id)->where('deleted', '0')->pluck('name_' . app()->getLocale(), 'id');
        } elseif ($user->role_id == 6) {//مديرة المجمعات
            $input_data['colleges_mogmaa'] = College::where('type', 'college')->where('deleted', '0')->pluck('name_' . app()->getLocale(), 'id');
        } elseif ($user->role_id == 5) { //مديرة الدار
            $input_data['colleges_dorr'] = College::where('id', $user->college_id)->where('deleted', '0')->pluck('name_' . app()->getLocale(), 'id');
        } elseif ($user->role_id == 7) {//مديرة الدور النسائية
            $input_data['colleges_dorr'] = College::where('type', 'dorr')->where('deleted', '0')->pluck('name_' . app()->getLocale(), 'id');
        } elseif ($user->role_id == 2) {//مديرة النظام
            $input_data['colleges_mogmaa'] = College::where('type', 'college')->where('deleted', '0')->pluck('name_' . app()->getLocale(), 'id');
            $input_data['colleges_dorr'] = College::where('type', 'dorr')->where('deleted', '0')->pluck('name_' . app()->getLocale(), 'id');
        } elseif ($user->role_id == 8) {//مسئول المقرأة
            $input_data['colleges_mogmaa'] = [];
            $input_data['colleges_dorr'] = [];
        } else {
            $input_data['colleges_mogmaa'] = [];
            $input_data['colleges_dorr'] = [];
        }
        return view('admin.reports.data.index', compact('data', 'input_data'));
    }
}
