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
use App\Models\Student_attendance;
use App\Models\Teacher;
use App\Models\Teacher_absence;
use App\Models\Teacher_job_name_history;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class TeacherAttendanceController extends Controller
{
    public function index()
    {
        $data = [];
        $episodes = $this->getEpisodessData();
        $type = 'step_one';
        $persentage = 0;
        return view('admin.reports.teacher_attendance.index', compact('persentage', 'data', 'episodes', 'type'));

    }

    private function getEpisodessData()
    {
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {//مدير المجمع
            return Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->get();
        } elseif
        ($user->role_id == 6) {//مديرة المجمعات
            return Episode::where('type', 'mogmaa')->where('deleted', '0')->get();
        } elseif
        ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            return Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->get();
        } elseif
        ($user->role_id == 7) {//مديرة الدور النسائية
            return Episode::where('type', 'dorr')->where('deleted', '0')->get();
        } elseif
        ($user->role_id == 2) {//مديرة النظام
            return Episode::where('deleted', '0')->get();
        } elseif
        ($user->role_id == 8) {//مسئول المقرأة
            return Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->get();
        } else {
            return [];
        }
    }

    public function search_step_one(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'episode_id' => 'required|exists:episodes,id',
                'teacher_id' => 'required|exists:teachers,id',
                'from' => 'required',
                'to' => 'required|after_or_equal:' . $request->from,
            ]);
        $fromTime = strtotime($request->from);
        $from = date("Y-m-d", $fromTime);
        $toTime = strtotime($request->to);
        $to = date("Y-m-d", $toTime);

        $teacher = Teacher::find($request->teacher_id);
        $absence_data = Teacher_absence::where('teacher_id', $request->teacher_id)->whereBetween('created_at', [$from, $to])->where('type', 'absence')->orderBy('created_at', 'desc')->get();
        $attendance_data = Teacher_absence::where('teacher_id', $request->teacher_id)->whereBetween('created_at', [$from, $to])->where('type', 'attendance')->orderBy('created_at', 'desc')->get();
        $data = Teacher_absence::where('teacher_id', $request->teacher_id)->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->get();

        //Begain generate attendance persentage
        $attendance = count($attendance_data);
        $absence = count($absence_data);
        $total_days = $attendance + $absence;
        if ($total_days == 0) {
            $persentage = 0;
        } else {
            $persentage = ($attendance / $total_days) * 100;
        }
        $floatVal = floatval($persentage);
        // If the parsing succeeded and the value is not equivalent to an int
        if ($floatVal && intval($floatVal) != $floatVal) {
            $persentage = number_format((float)$persentage, 1, '.', '');
        }
        //End generate attendance ...

        $from_date = date("mm/dd/yyyy", $fromTime);
        $to_date = date("mm/dd/yyyy", $toTime);

        $episodes = $this->getEpisodessData();
        $type = $request->type;
        return view('admin.reports.teacher_attendance.index', compact('type', 'data', 'from_date', 'to_date', 'attendance_data', 'absence_data', 'teacher', 'persentage', 'episodes'));
    }

    //step two search
    public function search_step_two(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'episode_id' => 'required|exists:episodes,id',
                'from' => 'required',
                'to' => 'required|after_or_equal:' . $request->from,
            ]);

        $fromTime = strtotime($request->from);
        $from = date("Y-m-d", $fromTime);
        $toTime = strtotime($request->to);
        $to = date("Y-m-d", $toTime);

        //get episode teachers [basic and additional] ...
        $teacher_ids = Episode_teacher::where('episode_id', $request->episode_id)->pluck('teacher_id');
        $baic_teacher = Episode::whereId($request->episode_id)->first()->teacher_id;
        if ($baic_teacher) {
            $teacher_ids[count($teacher_ids)] = $baic_teacher;
        }
        $data = Teacher::whereIn('id', $teacher_ids)->get()->map(function ($data) use ($request, $to, $from) {
            $attendance_count = Teacher_absence::where('teacher_id', $data->id)->where('episode_id', $request->episode_id)
                ->whereBetween('created_at', [$from, $to])->where('type', 'absence')
                ->count();
            $absence_count = Teacher_absence::where('teacher_id', $data->id)->where('episode_id', $request->episode_id)
                ->whereBetween('created_at', [$from, $to])->where('type', 'attendance')->count();
            $data->attendance_count = $attendance_count;
            $data->absence_count = $absence_count;

            $total_days = $attendance_count + $absence_count;
            if ($total_days == 0) {
                $persentage = 0;
            } else {
                $persentage = ($attendance_count / $total_days) * 100;
            }
            $floatVal = floatval($persentage);
            // If the parsing succeeded and the value is not equivalent to an int
            if ($floatVal && intval($floatVal) != $floatVal) {
                $persentage = number_format((float)$persentage, 1, '.', '');
            }

            $data->persentage = $persentage;
            return $data;
        });
        $episodes = $this->getEpisodessData();
        $type = $request->type;
        return view('admin.reports.teacher_attendance.index', compact('type', 'data', 'from', 'to', 'episodes'));
    }
    public function search_step_three(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'episode_id' => 'required|exists:episodes,id',
                'from' => 'required',
                'to' => 'required|after_or_equal:' . $request->from,
            ]);
        $fromTime = strtotime($request->from);
        $from = date("Y-m-d", $fromTime);
        $toTime = strtotime($request->to);
        $to = date("Y-m-d", $toTime);

        $absence_data = Teacher_absence::where('episode_id',$request->episode_id)->whereBetween('created_at', [$from, $to])->where('type', 'absence')->orderBy('created_at', 'desc')->get();
        $attendance_data = Teacher_absence::where('episode_id',$request->episode_id)->whereBetween('created_at', [$from, $to])->where('type', 'attendance')->orderBy('created_at', 'desc')->get();
        $data = Teacher_absence::where('episode_id',$request->episode_id)->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->get();

        //Begain generate attendance persentage
        $attendance = count($attendance_data);
        $absence = count($absence_data);
        $total_days = $attendance + $absence;
        if ($total_days == 0) {
            $persentage = 0;
        } else {
            $persentage = ($attendance / $total_days) * 100;
        }
        $floatVal = floatval($persentage);
        // If the parsing succeeded and the value is not equivalent to an int
        if ($floatVal && intval($floatVal) != $floatVal) {
            $persentage = number_format((float)$persentage, 1, '.', '');
        }
        //End generate attendance ...

        $from_date = date("mm/dd/yyyy", $fromTime);
        $to_date = date("mm/dd/yyyy", $toTime);

        $episodes = $this->getEpisodessData();
        $type = $request->type;
        return view('admin.reports.teacher_attendance.index', compact('type', 'data', 'from_date', 'to_date', 'attendance_data', 'absence_data', 'persentage', 'episodes'));
    }

    //old
    public function search(Request $request)
    {

        $result = Teacher::query();
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

        $data = $result->get();

//        Alert::success(trans('s_admin.episodes'), trans('s_admin.search_done'));
        return view('admin.reports.teacher_attendance.index', compact('data'));
    }


    public function details($id)
    {
        $absence_data = Teacher_absence::where('teacher_id', $id)->where('type', 'absence')->orderBy('created_at', 'desc')->get();
        $attendance_data = Teacher_absence::where('teacher_id', $id)->where('type', 'attendance')->orderBy('created_at', 'desc')->get();
        $teacher = Teacher::find($id);

        //Begain generate attendance persentage
        $attendance = count($attendance_data);
        $absence = count($absence_data);
        $total_days = $attendance + $absence;
        if ($total_days == 0) {
            $persentage = 0;
        } else {
            $persentage = ($attendance / $total_days) * 100;
        }
        $floatVal = floatval($persentage);
        // If the parsing succeeded and the value is not equivalent to an int
        if ($floatVal && intval($floatVal) != $floatVal) {
            $persentage = number_format((float)$persentage, 1, '.', '');
        }
        //End generate attendance ...
        $today = Carbon::now();
        $from_date = $today->format('m/d/Y');
        $to_date = $today->format('m/d/Y');
        return view('admin.reports.teacher_attendance.details', compact('absence_data', 'attendance_data', 'teacher', 'persentage', 'from_date', 'to_date'));
    }

    public function search_period(Request $request, $id)
    {
        $data = $this->validate(\request(),
            [
                'from' => 'required',
                'to' => 'required|after:' . $request->from,
            ]);

        $fromTime = strtotime($request->from);
        $from = date("Y-m-d", $fromTime);

        $toTime = strtotime($request->to);
        $to = date("Y-m-d", $toTime);
        $teacher = Teacher::find($id);
        $absence_data = Teacher_absence::where('teacher_id', $id)->whereBetween('absence_date', [$from, $to])->where('type', 'absence')->orderBy('created_at', 'desc')->get();
        $attendance_data = Teacher_absence::where('teacher_id', $id)->whereBetween('absence_date', [$from, $to])->where('type', 'attendance')->orderBy('created_at', 'desc')->get();
        //Begain generate attendance persentage
        $attendance = count($attendance_data);
        $absence = count($absence_data);
        $total_days = $attendance + $absence;
        if ($total_days == 0) {
            $persentage = 0;
        } else {
            $persentage = ($attendance / $total_days) * 100;
        }
        $floatVal = floatval($persentage);
        // If the parsing succeeded and the value is not equivalent to an int
        if ($floatVal && intval($floatVal) != $floatVal) {
            $persentage = number_format((float)$persentage, 1, '.', '');
        }
        //End generate attendance ...

        $from_date = date("m/d/Y", $fromTime);
        $to_date = date("m/d/Y", $toTime);

//        $from_date = $request->from->format('m/d/Y') ;
//        $to_date = $request->to->format('m/d/Y') ;

        return view('admin.reports.teacher_attendance.details', compact('attendance_data', 'absence_data', 'teacher', 'persentage', 'from_date', 'to_date'));
    }
}
