<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\District;
use App\Models\Episode;
use App\Models\Episode_day;
use App\Models\Episode_student;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Teacher_job_name_history;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherDataController extends Controller
{
    public function index()
    {
        $data = [];
        $columns = [
            'job_name', 'gender', 'email', 'country', 'phone', 'image', 'first_name',
            'qualification', 'nationality', 'date_of_birth', 'ident_num',
        ];

        return view('admin.reports.teacher_data.index', compact('data', 'columns'));
    }

    public function search(Request $request)
    {

        $result = Teacher::query();
        $teacher_ids = $this->getTeachersData();
        $result = $result->whereIn('id', $teacher_ids);
        $result = $result->where('is_new', 'accepted')->where('is_verified', '1');

        if ($request->teacher_name != null) {
            $teacher_ids = Teacher::where('first_name_ar', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('user_name', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('mid_name_ar', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('last_name_ar', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('first_name_en', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('mid_name_en', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('last_name_en', 'like', '%' . $request->teacher_name . '%')->pluck('id')->toArray();
            $result = $result->whereIn('id', $teacher_ids);
        }

        if ($request->college_id != null) {
            $teacher_ids = Episode::where('type', 'mogmaa')->where('college_id', $request->college_id)->get()->pluck('teacher_id')->toArray();
//            $student_epo_ids = Episode_student::whereIn('episode_id',$episode_ids)->where('deleted','0')->pluck('student_id')->toArray();
            $result = $result->whereIn('id', $teacher_ids);
        }
        if ($request->dorr_id != null) {
            $teacher_ids = Episode::where('type', 'dorr')->where('college_id', $request->dorr_id)->get()->pluck('teacher_id')->toArray();
//            $student_epo_ids = Episode_student::whereIn('episode_id',$episode_ids)->where('deleted','0')->pluck('student_id')->toArray();
            $result = $result->whereIn('id', $teacher_ids);
        }
        if ($request->episode_id != null) {
            $episode_ids = Episode::where('id', $request->episode_id)->get()->pluck('teacher_id')->toArray();
//            $student_epo_ids = Episode_student::whereIn('episode_id',$episode_ids)->where('deleted','0')->pluck('student_id')->toArray();
            $result = $result->whereIn('id', $episode_ids);
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


        if ($request->status != null) {
            $result = $result->where('status', $request->status);
        }

        $data = $result->get();
        $columns = $request->columns;
//        Alert::success(trans('s_admin.episodes'), trans('s_admin.search_done'));
        return view('admin.reports.teacher_data.index', compact('data', 'columns'));
    }

    private function getTeachersData()
    {
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {//مدير المجمع
            $episodes = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
            $episode_ids = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->pluck('id')->toArray();
            return Teacher::whereHas('Episodes', function ($q) use ($episode_ids) {
                $q->whereIn('id', $episode_ids);
            })->
            where('epo_type', 'mogmaa')->where('is_new', 'accepted')->orderBy('user_name', 'asc')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 6) {//مديرة المجمعات
            $episodes = Episode::where('type', 'mogmaa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Teacher::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->orderBy('user_name', 'asc')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            $episodes = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
            $episode_ids = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->pluck('id')->toArray();
            return Teacher::whereHas('Episodes', function ($q) use ($episode_ids) {
                $q->whereIn('id', $episode_ids);
            })->where('epo_type', 'dorr')->where('is_new', 'accepted')->orderBy('user_name', 'asc')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 7) {//مديرة الدور النسائية
            $episodes = Episode::where('type', 'dorr')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Teacher::where('epo_type', 'dorr')->where('is_new', 'accepted')->orderBy('user_name', 'asc')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 2) {//مديرة النظام
            $episodes = Episode::where('deleted', '0')->orderBy('id', 'desc')->get();
            return Teacher::where('is_new', 'accepted')->orderBy('user_name', 'asc')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 8) {//مسئول المقرأة
            $episodes = Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Teacher::where('gender', $user->gender)->where('epo_type', 'far_learn')->where('is_new', 'accepted')->orderBy('user_name', 'asc')->pluck('id')->toArray();
        } else {
            $episodes = [];
            return [];
        }
    }

    public function job_name_history($id)
    {
        $data = Teacher_job_name_history::where('teacher_id', $id)->orderBy('created_at', 'desc')->get();
        return view('admin.reports.teacher_data.history', compact('data'));
    }
}
