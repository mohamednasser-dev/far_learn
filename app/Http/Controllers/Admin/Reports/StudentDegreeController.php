<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\College;
use App\Models\District;
use App\Models\Episode;
use App\Models\Episode_day;
use App\Models\Episode_student;
use App\Models\Student;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StudentDegreeController extends Controller
{
    public function index()
    {
        $data = [];
        $columns = [
            "image","full_name","email","phone","level","district_S","gender","country","ident_num","nationality",
            "qualification","date_of_birth","subject","attendance_rate"
        ];
        return view('admin.reports.data.index', compact('data', 'columns'));
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

    public function get_episodes(Request $request, $id)
    {
        $data = Episode::where('college_id', $id)->get();
        return view('admin.reports.data.parts.episodes', compact('data'));
    }

    public function search(Request $request)
    {

        $result = Student::query();
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
        $columns = $request->columns;



//        Alert::success(trans('s_admin.episodes'), trans('s_admin.search_done'));
        return view('admin.reports.data.index', compact('data', 'columns'));
    }
}
