<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\Certificat;
use App\Models\College;
use App\Models\District;
use App\Models\Episode;
use App\Models\Episode_day;
use App\Models\Episode_student;
use App\Models\Student;
use App\Models\Student_level_history;
use App\Models\Teacher;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StudentHistoryController extends Controller
{
    public function index()
    {
        $data = [];
        $student_ids = $this->getStudentsData();
        $students = Student::whereIn('id', $student_ids)->get();
        return view('admin.reports.student_history.index', compact('data', 'students'));
    }

    public function search(Request $request)
    {
        $student_ids = $this->getStudentsData();
        $students = Student::whereIn('id', $student_ids)->get();
        $exists_student = Student::where('id', $request->student_id)->first();
        if($exists_student){
            $student_id = $request->student_id;
        }else{
            $result = Student::query();
            $result = $result->whereIn('id', $student_ids);
            $result = $result->where('ident_num', $request->ident_num);
            $result = $result->where('is_new', 'accepted')->where('interview', 'y')->where('is_verified', '1');
            $searched_student = $result->first();
            if ($searched_student) {
                $student_id = $searched_student->id;
            }else{
                $student_id = 0;
            }
        }

        $data = Certificat::where('student_id', $student_id)->get();
        return view('admin.reports.student_history.index', compact('data', 'students'));
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
            where('epo_type', 'mogmaa')->where('is_new', 'accepted')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 6) {//مديرة المجمعات
            $episodes = Episode::where('type', 'mogmaa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('epo_type', 'mogmaa')->where('is_new', 'accepted')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            $episodes = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
            $episode_ids = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->pluck('id')->toArray();
            return Student::whereHas('Episode', function ($q) use ($episode_ids) {
                $q->whereIn('episode_id', $episode_ids);
            })->where('epo_type', 'dorr')->where('is_new', 'accepted')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 7) {//مديرة الدور النسائية
            $episodes = Episode::where('type', 'dorr')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('epo_type', 'dorr')->where('is_new', 'accepted')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 2) {//مديرة النظام
            $episodes = Episode::where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('is_new', 'accepted')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 8) {//مسئول المقرأة
            $episodes = Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->orderBy('id', 'desc')->get();
            return Student::where('gender', $user->gender)->where('epo_type', 'far_learn')->where('is_new', 'accepted')->pluck('id')->toArray();
        } else {
            $episodes = [];
            return [];
        }
    }

    public function show_history($id)
    {
        $data = Student_level_history::where('student_id', $id)->get();
        return view('admin.reports.student_history.history', compact('data'));
    }


}
