<?php

namespace App\Http\Controllers\Admin\Reports;

use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\District;
use App\Models\Episode;
use App\Models\Episode_day;
use App\Models\Episode_student;
use App\Models\Plan_section_degree;
use App\Models\Student;
use App\Models\Student_attendance;
use App\Models\Zone;
use Carbon\Carbon;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;

class AttendanceController extends Controller
{
    public function index()
    {
        $data = [];
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {//مدير المجمع
            $episodes = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 6) {//مديرة المجمعات
            $episodes = Episode::where('type', 'mogmaa')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            $episodes = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 7) {//مديرة الدور النسائية
            $episodes = Episode::where('type', 'dorr')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 2) {//مديرة النظام
            $episodes = Episode::where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 8) {//مسئول المقرأة
            $episodes = Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } else {
            $episodes = [];
        }
        $type = 'step_one';
        $persentage = 0;
        return view('admin.reports.student_attendance.index', compact('persentage', 'data', 'episodes', 'type'));
    }

    //step one search
    public function search_step_one(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'episode_id' => 'required|exists:episodes,id',
                'student_id' => 'required|exists:students,id',
                'from' => 'required',
                'to' => 'required|after_or_equal:' . $request->from,
            ]);

        $fromTime = strtotime($request->from);
        $from = date("Y-m-d", $fromTime);

        $toTime = strtotime($request->to);
        $to = date("Y-m-d", $toTime);

        $student = Student::find($request->student_id);
        $attendance_data = Student_attendance::where('student_id', $request->student_id)
            ->whereBetween('created_at', [$from, $to])
            ->whereHas('Episode', function ($q) use ($request) {
                $q->where('id', $request->episode_id);
            })
            ->orderBy('created_at', 'desc')->get();
        $absence_data = Plan_section_degree::where('student_id', $request->student_id)
            ->whereBetween('created_at', [$from, $to])
            ->whereHas('Episode', function ($q) use ($request) {
                $q->where('id', $request->episode_id);
            })
            ->where('type', 'absence')->orderBy('created_at', 'desc')->get();
        $data = collect($attendance_data)->merge($absence_data)->SortByDesc('created_at');

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

        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {//مدير المجمع
            $episodes = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 6) {//مديرة المجمعات
            $episodes = Episode::where('type', 'mogmaa')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            $episodes = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 7) {//مديرة الدور النسائية
            $episodes = Episode::where('type', 'dorr')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 2) {//مديرة النظام
            $episodes = Episode::where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 8) {//مسئول المقرأة
            $episodes = Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } else {
            $episodes = [];
        }
        $type = $request->type;
        return view('admin.reports.student_attendance.index', compact('type', 'data', 'from_date', 'to_date', 'attendance_data', 'absence_data', 'student', 'persentage', 'episodes'));
    }

    //step two search
    public function search_step_two(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'episode_id' => 'required',
                'from' => 'required',
                'to' => 'required|after_or_equal:' . $request->from,
            ]);

        $fromTime = strtotime($request->from);
        $from = date("Y-m-d", $fromTime);
        $toTime = strtotime($request->to);
        $to = date("Y-m-d", $toTime);

        $data = Episode_student::query()->with('Student')->whereHas('Student');
        if ($request->episode_id != 0) {
            $data = $data->where('episode_id', $request->episode_id);
        }
        $data = $data->get()->map(function ($data) use ($request, $to, $from) {
            $attendance_count = Student_attendance::query()->where('student_id', $data->student_id)->whereBetween('created_at', [$from, $to]);
            if ($request->episode_id != 0) {
                $attendance_count = $attendance_count->whereHas('Episode', function ($q) use ($request) {
                    $q->where('id', $request->episode_id);
                });
            } else {
                $attendance_count = $attendance_count->whereHas('Episode');
            }
            $attendance_count = $attendance_count->count();
            $absence_count = Plan_section_degree::query()->where('student_id', $data->student_id)
                ->whereBetween('created_at', [$from, $to]);
            if ($request->episode_id != 0) {
                $absence_count = $absence_count->whereHas('Episode', function ($q) use ($request) {
                    $q->where('id', $request->episode_id);
                });
            } else {

                $absence_count = $absence_count->whereHas('Episode');
            }
            $absence_count = $absence_count->where('type', 'absence')->orderBy('created_at', 'desc')->count();

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
        $count_rows = $data->count();
        $sum_persentage_rows = $data->sum('persentage');
        $persentage = $sum_persentage_rows / $count_rows;
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {//مدير المجمع
            $episodes = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 6) {//مديرة المجمعات
            $episodes = Episode::where('type', 'mogmaa')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            $episodes = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 7) {//مديرة الدور النسائية
            $episodes = Episode::where('type', 'dorr')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 2) {//مديرة النظام
            $episodes = Episode::where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 8) {//مسئول المقرأة
            $episodes = Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } else {
            $episodes = [];
        }
        $type = $request->type;
        return view('admin.reports.student_attendance.index', compact('type', 'data', 'from', 'to', 'episodes', 'persentage'));
    }

//step three search
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

        $student = Student::find($request->student_id);
        $attendance_data = Student_attendance::whereBetween('created_at', [$from, $to])
            ->whereHas('Episode', function ($q) use ($request) {
                $q->where('id', $request->episode_id);
            })
            ->orderBy('created_at', 'desc')->get();
        $absence_data = Plan_section_degree::whereBetween('created_at', [$from, $to])
            ->whereHas('Episode', function ($q) use ($request) {
                $q->where('id', $request->episode_id);
            })->where('type', 'absence')->orderBy('created_at', 'desc')->get();
        $data = collect($attendance_data)->merge($absence_data)->SortByDesc('created_at');

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

        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {//مدير المجمع
            $episodes = Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 6) {//مديرة المجمعات
            $episodes = Episode::where('type', 'mogmaa')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            $episodes = Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 7) {//مديرة الدور النسائية
            $episodes = Episode::where('type', 'dorr')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 2) {//مديرة النظام
            $episodes = Episode::where('deleted', '0')->orderBy('id', 'desc')->get();
        } elseif ($user->role_id == 8) {//مسئول المقرأة
            $episodes = Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->orderBy('id', 'desc')->get();
        } else {
            $episodes = [];
        }
        $type = $request->type;
        return view('admin.reports.student_attendance.index', compact('type', 'data', 'from_date', 'to_date', 'attendance_data', 'absence_data', 'student', 'persentage', 'episodes'));
    }

//    old code


    public function search(Request $request)
    {
//        dd($request);
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

        if ($request->percent != null) {
            $method = $request->selected_method;
            $percent = $request->percent;

            $result = $result->where('attendance_rate', $method, $percent);
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


        $data = $result->get();

//        Alert::success(trans('s_admin.episodes'), trans('s_admin.search_done'));
        return view('admin.reports.student_attendance.index', compact('data'));
    }


    public function attendance_details(Request $request, $id)
    {
        $attendance_data = Student_attendance::where('student_id', $id)->orderBy('created_at', 'desc')->get();
        $absence_data = Plan_section_degree::where('student_id', $id)->where('type', 'absence')->orderBy('created_at', 'desc')->get();
        $student = Student::where('id', $id)->first();
        $persentage = $student->attendance_rate;
        $student = Student::find($id);
        $today = Carbon::now();
        $today = strtotime($today);
        $from_date = date("mm/dd/yyyy", $today);
        $to_date = date("mm/dd/yyyy", $today);
        return view('admin.reports.student_attendance.details', compact('from_date', 'to_date', 'attendance_data', 'absence_data', 'student', 'persentage'));
    }

    public function search_period(Request $request, $id)
    {
        $data = $this->validate(\request(),
            [
                'from' => 'required',
                'to' => 'required|after_or_equal:' . $request->from,
            ]);

        $fromTime = strtotime($request->from);
        $from = date("Y-m-d", $fromTime);

        $toTime = strtotime($request->to);
        $to = date("Y-m-d", $toTime);
        $student = Student::find($id);
        $attendance_data = Student_attendance::where('student_id', $id)->whereBetween('created_at', [$from, $to])->orderBy('created_at', 'desc')->get();
        $absence_data = Plan_section_degree::where('student_id', $id)->whereBetween('created_at', [$from, $to])->where('type', 'absence')->orderBy('created_at', 'desc')->get();

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

        return view('admin.reports.student_attendance.details', compact('from_date', 'to_date', 'attendance_data', 'absence_data', 'student', 'persentage'));
    }

}
