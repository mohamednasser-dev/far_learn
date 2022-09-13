<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Episode;
use App\Models\Episode_student;
use App\Models\Episode_teacher;
use App\Models\Student;
use App\Models\Teacher;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherAchievementsController extends Controller
{
    public function index()
    {
        $data = [];
        $type = 'student';
        return view('admin.reports.teacher_achievements.index', compact('data', 'type'));
    }

    public function search(Request $request)
    {
        $type = $request->type;
        $result = Teacher::query();
        $teacher_ids = $this->getTeachersData();
        $result = $result->whereIn('id', $teacher_ids);
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
        return view('admin.reports.teacher_achievements.index', compact('data', 'type'));
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
    public function teacher_episodes($id)
    {
        $data = Episode::where('teacher_id', $id)->where('deleted', '0')->orderBy('created_at', 'desc')->get();
        $data_additional = Episode_teacher::where('teacher_id', $id)->orderBy('created_at', 'desc')->get();
        return view('admin.reports.teacher_achievements.teacher_episodes', compact('data', 'data_additional'));
    }
}
