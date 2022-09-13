<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\District;
use App\Models\Episode;
use App\Models\Episode_day;
use App\Models\Episode_student;
use App\Models\Episode_teacher;
use App\Models\Plan_section_degree;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Teacher_job_name_history;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class ProductivityController extends Controller
{
    public function index()
    {
        $data = [];
        $students = $this->getStudentsData();
        $episodes = $this->getEpisodessData();
        $type = 'step_one';
        $persentage = 0;
        return view('admin.reports.Productivity.index', compact('persentage', 'students', 'data', 'episodes', 'type'));
    }

    private function getStudentsData()
    {
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {//مدير المجمع
            $episodes = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
            $episode_ids = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->pluck('id')->toArray();
            return Student::whereHas('Episode', function ($q) use ($episode_ids) {
                $q->whereIn('episode_id', $episode_ids);
            })->
            where('epo_type', 'mogmaa')->where('is_new', 'accepted')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 6) {//مديرة المجمعات
            $episodes = Episode::where('type', 'mogmaa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            $episodes = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
            $episode_ids = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->pluck('id')->toArray();
            return Student::whereHas('Episode', function ($q) use ($episode_ids) {
                $q->whereIn('episode_id', $episode_ids);
            })->where('epo_type', 'dorr')->where('is_new', 'accepted')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 7) {//مديرة الدور النسائية
            $episodes = Episode::where('type', 'dorr')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('epo_type', 'dorr')->where('is_new', 'accepted')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 2) {//مديرة النظام
            $episodes = Episode::where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('is_new', 'accepted')->orderBy('user_name', 'asc')->get();
        } elseif
        ($user->role_id == 8) {//مسئول المقرأة
            $episodes = Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('gender', $user->gender)->where('epo_type', 'far_learn')->where('is_new', 'accepted')->orderBy('user_name', 'asc')->get();
        } else {
            $episodes = [];
            return [];
        }
    }

    private function getEpisodessData()
    {
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {//مدير المجمع
            return Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif
        ($user->role_id == 6) {//مديرة المجمعات
            return Episode::where('type', 'mogmaa')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif
        ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            return Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif
        ($user->role_id == 7) {//مديرة الدور النسائية
            return Episode::where('type', 'dorr')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif
        ($user->role_id == 2) {//مديرة النظام
            return Episode::where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif
        ($user->role_id == 8) {//مسئول المقرأة
            return Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } else {
            return [];
        }
    }

    public function search_step_one(Request $request)
    {
        $data = [];
        $students = $this->getStudentsData();
        $episodes = $this->getEpisodessData();
        $type = 'step_one';
        $persentage = 0;

        $fromTime = strtotime($request->from);
        $from = date("Y-m-d", $fromTime);

        $toTime = strtotime($request->to);
        $to = date("Y-m-d", $toTime);
        $data = Plan_section_degree::where('student_id', $request->student_id)
            ->where('type', '!=', 'absence')
            ->whereBetween('created_at', [$from, $to])
            ->where('episode_id', $request->episode_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reports.Productivity.index', compact('persentage', 'data', 'episodes', 'type', 'students'));
    }

    public
    function search_step_two(Request $request)
    {
        $data = [];
        $students = $this->getStudentsData();
        $episodes = $this->getEpisodessData();
        $type = 'step_two';
        $persentage = 0;

        $fromTime = strtotime($request->from);
        $from = date("Y-m-d", $fromTime);

        $toTime = strtotime($request->to);
        $to = date("Y-m-d", $toTime);
        $data = Plan_section_degree::whereHas('Episode')->where('student_id', $request->student_id)
            ->where('type', '!=', 'absence')
            ->whereBetween('created_at', [$from, $to])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reports.Productivity.index', compact('persentage', 'data', 'episodes', 'type', 'students'));
    }

    public
    function search_step_three(Request $request)
    {
        $students = $this->getStudentsData();
        $episodes = $this->getEpisodessData();
        $type = 'step_three';
        $persentage = 0;

        $fromTime = strtotime($request->from);
        $from = date("Y-m-d", $fromTime);

        $toTime = strtotime($request->to);
        $to = date("Y-m-d", $toTime);
        $data = Episode::where('id', $request->episode_id)->get();
        return view('admin.reports.Productivity.index', compact('persentage', 'from', 'to', 'data', 'episodes', 'type', 'students'));
    }

    public
    function search_step_four(Request $request)
    {
        $data = [];
        $students = $this->getStudentsData();
        $episodes = $this->getEpisodessData();
        $type = 'step_four';
        $persentage = 0;

        $fromTime = strtotime($request->from);
        $from = date("Y-m-d", $fromTime);

        $toTime = strtotime($request->to);
        $to = date("Y-m-d", $toTime);
        $data = Plan_section_degree::where('type', '!=', 'absence')
            ->whereBetween('created_at', [$from, $to])
            ->where('episode_id', $request->episode_id)
            ->orderBy('created_at', 'desc')
            ->get();

        return view('admin.reports.Productivity.index', compact('persentage', 'data', 'episodes', 'type', 'students'));
    }

//old pages .....
    public
    function index_old()
    {
        $data = [];
        $type = 'student';
        return view('admin.reports.Productivity_old.index', compact('data', 'type'));
    }

    public
    function search(Request $request)
    {
        $type = $request->type;
        $data = [];
        if ($request->type == 'student') {
            $result = Student::query();
            $result = $result->where('is_new', 'accepted')->where('status', 'active')->where('interview', 'y')->where('is_verified', '1');

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

            if ($request->phone != null) {
                $result = $result->where('phone', $request->phone);
            }
            if ($request->ident_num != null) {
                $result = $result->where('ident_num', $request->ident_num);
            }
            $data = $result->get();
        } elseif ($request->type == 'mogmaa' && $request->episode_id != null) {
            $type = 'episodes';
            if ($request->episode_id != null) {
                $data = Episode::where('id', $request->episode_id)->get();
            }
        }
        if ($request->type == 'mogmaa') {
            if ($request->collage_id != null) {
                $data = College::where('id', $request->collage_id)->get();
            }
            if ($request->dorr_id != null) {
                $data = College::where('id', $request->dorr_id)->get();
            }
        }
        if ($request->type == 'teacher') {
            $result = Teacher::query();
            $result = $result->where('is_new', 'accepted')->where('is_verified', '1')->where('status', 'active');
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
            if ($request->teacher_phone != null) {
                $result = $result->where('phone', $request->teacher_phone);
            }
            if ($request->teacher_ident_num != null) {
                $result = $result->where('ident_num', $request->teacher_ident_num);
            }

            $data = $result->get();
        }
        return view('admin.reports.Productivity_old.index', compact('data', 'type'));
    }

    public
    function student_episodes($id)
    {
        $data = Episode_student::where('student_id', $id)->orderBy('created_at', 'desc')->get();
        $student = Student::find($id);
        return view('admin.reports.Productivity_old.student_episodes', compact('data', 'student'));
    }

    public
    function mogmaa_episodes($id)
    {
        $data = Episode::where('college_id', $id)->where('deleted', '0')->orderBy('created_at', 'desc')->get();
        return view('admin.reports.Productivity_old.mogmaa_episodes', compact('data'));
    }

    public
    function teacher_episodes($id)
    {
        $data = Episode::where('teacher_id', $id)->where('deleted', '0')->orderBy('created_at', 'desc')->get();

        $data_additional = Episode_teacher::where('teacher_id', $id)->orderBy('created_at', 'desc')->get();
        return view('admin.reports.Productivity_old.teacher_episodes', compact('data', 'data_additional'));
    }
}
