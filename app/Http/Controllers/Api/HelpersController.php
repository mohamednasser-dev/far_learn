<?php

namespace App\Http\Controllers\Api;

use Alkoumi\LaravelHijriDate\Hijri;
use App\Http\Controllers\Controller;
use App\Http\Resources\EpisodeQuestionsResource;
use App\Http\Resources\LevelResource;
use App\Http\Resources\PlanSurahResource;
use App\Http\Resources\qualficationResource;
use App\Models\City;
use App\Models\Episode_rate_question;
use App\Models\Plan\Plan_surah;
use App\Models\Web_setting;
use Carbon\Carbon;
use Illuminate\Support\Facades\Session;
use App\Models\Country;
use App\Models\District;
use App\Models\Episode;
use App\Models\Job_name;
use App\Models\Level;
use App\Models\Nationality;
use App\Models\Qualification;
use App\Models\Relation;
use App\Models\Save_limit;
use App\Models\Student;
use App\Models\Teacher;
use App\Models\Zone;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Validator;

class HelpersController extends Controller
{


    public function episode_rate_questions(Request $request)
    {
        $lang = $request->header('lang');
        $data = Episode_rate_question::where('status', 'show')->where('deleted', '0')->orderBy('created_at', 'desc')->get();
        $data = EpisodeQuestionsResource::collection($data);
        return msgdata($request, success(), 'success', $data);
    }
    public function qualifications(Request $request)
    {
        $lang = $request->header('lang');
        $data = Qualification::where('deleted', '0')->get();
        return msgdata($request, success(), 'success', $data);
    }

    public function countries(Request $request)
    {
        $lang = $request->header('lang');
        $data = Country::where('deleted', '0')->get();
        return msgdata($request, success(), 'success', $data);
    }

    public function surah(Request $request)
    {
        $lang = $request->header('lang');
        $data = Plan_surah::where('deleted', '0')->orderBy('id', 'asc')->get();
        $data = PlanSurahResource::collection($data)->response()->getData(true);
        return msgdata($request, success(), 'success', $data);
    }

    public function surah_aya_numbers(Request $request, $surah_id)
    {
        $lang = $request->header('lang');
        $data = Plan_surah::where('id', $surah_id)->first();
        $surah_num = $data->ayat_num + 1;
        $numbers = [];
        for ($i = 1; $i < $surah_num; $i++) {
            array_push($numbers, $i);
        }
        return msgdata($request, success(), 'success', $numbers);
    }

    public function zones(Request $request, $id)
    {
        $lang = $request->header('lang');
        $data = Zone::where('deleted', '0')->get();
        return msgdata($request, success(), 'success', $data);
    }

    public function cities(Request $request, $id)
    {
        $lang = $request->header('lang');
        $data = City::where('zone_id', $id)->where('deleted', '0')->get();
        return msgdata($request, success(), 'success', $data);
    }

    public function districts(Request $request, $id)
    {
        $lang = $request->header('lang');
        $data = District::where('city_id', $id)->where('deleted', '0')->get();
        return msgdata($request, success(), 'success', $data);
    }

    public function levels(Request $request, $type)
    {
        $data = Level::where('type', $type)->orderBy('created_at', 'desc')->where('deleted', '0')->get();
        $data = LevelResource::collection($data);
        return msgdata($request, success(), 'success', $data);
    }

    public function job_names(Request $request)
    {
        $lang = $request->header('lang');
        $data = Job_name::where('deleted', '0')->get();
        return msgdata($request, success(), 'success', $data);
    }

    public function nationalities(Request $request)
    {
        $lang = $request->header('lang');
        $data = Nationality::where('deleted', '0')->get();
        return msgdata($request, success(), 'success', $data);
    }

    public function save_limits(Request $request)
    {
        $lang = $request->header('lang');
        $data = Save_limit::where('deleted', '0')->get();
        return msgdata($request, success(), 'success', $data);
    }

    public function relations(Request $request)
    {
        $lang = $request->header('lang');
        $data = Relation::where('deleted', '0')->get();
        return msgdata($request, success(), 'success', $data);
    }

    public function config(Request $request)
    {

        $data = Web_setting::where('id', 1)->first();
        return msgdata($request, success(), 'success', $data);
    }

    public function episodes(Request $request, $type)
    {
        $lang = $request->header('lang');
        Session::put('api_lang', $lang);
        $data = Episode::with('Readings_api')
            ->select('id', 'name_ar', 'gender', 'name_en', 'type', 'time_from', 'time_to', 'listen_type', 'student_number','teacher_id')
            ->where('active', 'y')->whereHas('Teacher')->where('type', $type)
            ->where('deleted', '0')->paginate(8);
        $data->setCollection(
            $data->getCollection()->makeHidden(['Students','Teacher'])
                ->map(function ($data) {
                    $data->teacher_name = $data->Teacher->user_name ;
                    $students = count($data->Students);
                    if ($students == $data->student_number) {
                        $data->complete_students = true;
                    } else {
                        $data->complete_students = false;
                    }
                    if ($data->gender == 'male') {
                        $data->gender = trans('s_admin.male');
                    } else {
                        $data->gender = trans('s_admin.female');
                    }
                    if ($data->type == 'mqraa') {
                        $data->type = trans('s_admin.mqraa');
                    }

                    if ($data->listen_type == 'single') {
                        $data->listen_type = trans('s_admin.single');
                    } elseif ($data->listen_type == 'group') {
                        $data->listen_type = trans('s_admin.group');
                    }
                    $data->time_from = Carbon::parse($data->time_from)->translatedFormat("g:i a");
                    $data->time_to = Carbon::parse($data->time_to)->translatedFormat("g:i a");
                    return $data;
                })
        );
        return msgdata($request, success(), 'success', $data);
    }

    public function change_lang(Request $request)
    {
        if ($request->lang) {
            $lang = $request->lang;
        } else {
            $lang = 'ar';
        }
        Session::put('api_lang', $lang);
        $user = check_api_token($request->header('apitoken'));
        if ($user) {
            if ($user->type == 'student') {
                Student::whereId($user->id)->update(['main_lang' => $lang]);
            } elseif ($user->type == 'student') {
                Teacher::whereId($user->id)->update(['main_lang' => $lang]);
            }
            return msgdata($request, success(), trans('s_admin.language_changed_successfully'), (object)[]);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }
}
