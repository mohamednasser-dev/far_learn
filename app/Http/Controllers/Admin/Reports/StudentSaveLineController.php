<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Episode;
use App\Models\Episode_student;
use App\Models\Episode_teacher;
use App\Models\Student;
use App\Models\Student_teacher_rate;
use App\Models\Teacher;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class StudentSaveLineController extends Controller
{
    public function index()
    {
        $data = [];
        $type = 'student';
        return view('admin.reports.Save_Lines.index', compact('data', 'type'));
    }

    public function search(Request $request)
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
//dd($data);
        }
        return view('admin.reports.Save_Lines.index', compact('data', 'type'));
    }

    public function student_episodes($id)
    {
        $data = Episode_student::where('student_id', $id)->orderBy('created_at', 'desc')->get();
        $student = Student::find($id);
        return view('admin.reports.Productivity.student_episodes', compact('data', 'student'));
    }

    public function mogmaa_episodes($id)
    {
        $data = Episode::where('college_id', $id)->where('deleted', '0')->orderBy('created_at', 'desc')->get();
        return view('admin.reports.Productivity.mogmaa_episodes', compact('data'));
    }

    public function teacher_episodes($id)
    {
        $data = Episode::where('teacher_id', $id)->where('deleted', '0')->orderBy('created_at', 'desc')->get();

        $data_additional = Episode_teacher::where('teacher_id', $id)->orderBy('created_at', 'desc')->get();
        return view('admin.reports.Productivity.teacher_episodes', compact('data', 'data_additional'));
    }
}
