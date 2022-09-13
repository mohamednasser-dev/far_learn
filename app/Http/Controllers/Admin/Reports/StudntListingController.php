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
use Illuminate\Support\Facades\Auth;
use RealRashid\SweetAlert\Facades\Alert;

class StudntListingController extends Controller
{

    public function index()
    {
        $episode_ids = $this->getEpisodessData();
        $data = Plan_section_degree::whereIn('episode_id', $episode_ids)->whereDate('created_at', Carbon::now())->where('type', '!=', 'absence')->get();
        $today_date = Carbon::now()->format('d-m-Y');
        return view('admin.reports.student_listing.index', compact('data', 'today_date'));
    }

    public function search(Request $request)
    {
        $time = strtotime($request->selected_date);
        $selected_date = date('Y-m-d', $time);
        $episode_ids = $this->getEpisodessData();
        $data = Plan_section_degree::whereIn('episode_id', $episode_ids)->whereDate('created_at', $selected_date)->where('type', '!=', 'absence')->get();
        $today_date = $request->selected_date;
        return view('admin.reports.student_listing.index', compact('data', 'today_date'));
    }

    private function getEpisodessData()
    {
        $user = \auth()->user();
        if ($user->role_id == 3 || $user->role_id == 9 || $user->role_id == 10 || $user->role_id == 11) {//مدير المجمع
            return Episode::where('type', 'mogmaa')->where('college_id', $user->college_id)->where('deleted', '0')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 6) {//مديرة المجمعات
            return Episode::where('type', 'mogmaa')->where('deleted', '0')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 5 || $user->role_id == 12 || $user->role_id == 13 || $user->role_id == 14) { //مديرة الدار
            return Episode::where('type', 'dorr')->where('college_id', $user->college_id)->where('deleted', '0')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 7) {//مديرة الدور النسائية
            return Episode::where('type', 'dorr')->where('deleted', '0')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 2) {//مديرة النظام
            return Episode::where('deleted', '0')->pluck('id')->toArray();
        } elseif
        ($user->role_id == 8) {//مسئول المقرأة
            return Episode::where('gender', $user->gender)->where('type', 'mqraa')->where('deleted', '0')->pluck('id')->toArray();
        } else {
            return [];
        }
    }

}
