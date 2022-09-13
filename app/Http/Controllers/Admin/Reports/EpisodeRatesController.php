<?php

namespace App\Http\Controllers\Admin\Reports;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Http\Controllers\Controller;
use App\Models\Certificat;
use App\Models\College;
use App\Models\Episode;
use App\Models\Episode_course_days;
use App\Models\Episode_day;
use App\Models\Episode_student;
use App\Models\Far_learn_degree;
use App\Models\Notification;
use App\Models\Plan_section_degree;
use App\Models\Student;
use App\Models\Student_episode_rate;
use App\Models\Subject;
use App\Models\Subject_level;
use http\Exception;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use RealRashid\SweetAlert\Facades\Alert;

class EpisodeRatesController extends Controller
{
    public function index($type)
    {
        $episodes_ids = $this->getEpisodesIDSData();
        $data = Student_episode_rate::whereHas('Episode', function ($q) use ($type,$episodes_ids) {
            $q->where('type', $type)->whereIn('id',$episodes_ids);
        })->orderBy('created_at', 'desc')->paginate(10);

        $episodes = $this->getEpisodessData();
        $sum = Student_episode_rate::whereHas('Episode', function ($q) use ($type,$episodes_ids) {
            $q->where('type', $type)->whereIn('id',$episodes_ids);
        })->orderBy('created_at', 'desc')->get()->sum('rate');
        $count = Student_episode_rate::whereHas('Episode', function ($q) use ($type,$episodes_ids) {
            $q->where('type', $type)->whereIn('id',$episodes_ids);
        })->orderBy('created_at', 'desc')->get()->count();
        if ($count == 0) {
            $total_rating = 0;
        } else {
            $total_rating = $sum / $count;
        }
        return view('admin.reports.episode_rates.index', compact('data', 'episodes', 'total_rating'));
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
    private function getEpisodesIDSData()
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

    public function search(Request $request)
    {
        $data = $this->validate(\request(),
            [
                'episode_id' => 'required|exists:episodes,id'
            ]);
        $data = Student_episode_rate::where('episode_id', $request->episode_id)->orderBy('created_at', 'desc')->paginate(10);
        $episode = Episode::find($request->episode_id);
        $episodes = Episode::where('type', $episode->type)->get();

        $sum = Student_episode_rate::where('episode_id', $request->episode_id)->orderBy('created_at', 'desc')->get()->sum('rate');
        $count = Student_episode_rate::where('episode_id', $request->episode_id)->orderBy('created_at', 'desc')->get()->count();
        if ($count == 0) {
            $total_rating = 0;
        } else {
            $total_rating = $sum / $count;
        }
        return view('admin.reports.episode_rates.index', compact('data', 'episodes', 'total_rating'));
    }

    public function epo_type()
    {
        return view('admin.reports.episode_rates.epo_type');
    }
}
