<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Resources\AccountsResource;
use App\Http\Resources\EpisodeCoursesDaysResource;
use App\Http\Resources\MyEpisodesResource;
use App\Http\Resources\SlidersResource;
use App\Http\Resources\UserResource;
use App\Http\Controllers\Controller;
use App\Models\Episode_course_days;
use App\Models\Episode_student;
use App\Models\Episode_teacher;
use App\Models\Notification;
use App\Models\Student;
use App\Models\Teacher;
use Illuminate\Http\Request;
use App\Models\Episode;
use App\Models\Slider;
use Carbon\Carbon;
use Validator;

class HomeController extends Controller
{
    public function home(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));

        $exists_accounts = [];
        if ($user) {
            $exists_accounts['student'] = Student::select('id', 'user_name', 'user_phone', 'date_of_birth')->where('user_phone', $user->user_phone)->first();
            if ($exists_accounts['student'] == null) {
                $exists_accounts['student'] = (object)[];
            }
            $exists_accounts['teacher'] = Teacher::select('id', 'user_name', 'user_phone', 'date_of_birth')->where('user_phone', $user->user_phone)->first();
            if ($exists_accounts['teacher'] == null) {
                $exists_accounts['teacher'] = (object)[];
            }
            $exists_accounts['parent'] = (object)[];
        }
//        $data = AccountsResource::collection($data);
        $data['accounts'] = $exists_accounts;
        //slider
        $sliders = Slider::get();
        $data['sliders'] = (SlidersResource::collection($sliders));

        if ($user && $user->type == 'student') {
            $unread_notifications = Notification::where('student_id', $user->id)->where('readed', '0')->count();
            $data['unread_notifications'] = $unread_notifications;
            $data['user_data'] = (new UserResource($user));

            //next episodes
            $carbon = Carbon::now();
            $student_episodes = Episode_student::where('deleted', '0')->where('student_id', $user->id)->pluck('episode_id')->toArray();
//            dd($student_episodes);
            if (count($student_episodes) > 0) {
                $next_episode = Episode_course_days::whereHas('Episode')
                    ->whereIn('episode_id', $student_episodes)
                    ->where('started_at', '>', $carbon)
                    ->orderBy('started_at', 'asc')
                    ->first();
                if ($next_episode) {
                    $data['next_episode'] = new EpisodeCoursesDaysResource($next_episode);
                } else {
                    $data['next_episode'] = (object)[];
                }
            } else {
                $data['next_episode'] = (object)[];
            }
            //mail count
            $inbox_count = Notification::where('student_id', $user->id)->where('readed', '0')->whereNotNull('inbox_id')->count();
            $data['mail_count'] = $inbox_count;
            //episodes count
            $user_type = $user->epo_type;
            if ($user_type == 'far_learn') {
                $type = 'mqraa';
            } elseif ($user_type == 'dorr') {
                $type = 'dorr';
            } elseif ($user_type == 'mogmaa') {
                $type = 'mogmaa';
            }
            $episode_count = Episode::where('teacher_id', '!=', null)->where('type', $type)->where('active', 'y')->where('deleted', '0')->get()->count();
            $data['episode_count'] = $episode_count;
            //public rates
            $data['public_rate'] = '4.7';

        } elseif ($user && $user->type == 'teacher') {
            $unread_notifications = Notification::where('teacher_id', $user->id)->where('readed', '0')->count();
            $data['unread_notifications'] = $unread_notifications;
            $data['user_data'] = (new UserResource($user));

            //next episodes
            $carbon = Carbon::now();
            $episodes_id = $this->teacherEpisodes_id($user->id);

            if (count($episodes_id) > 0) {
                $next_episode = Episode_course_days::whereHas('Episode')
                    ->whereIn('episode_id', $episodes_id)
                    ->where('started_at', '>', $carbon)
                    ->orderBy('started_at', 'asc')
                    ->first();
                if ($next_episode) {
                    $data['next_episode'] = new EpisodeCoursesDaysResource($next_episode);
                } else {
                    $data['next_episode'] = (object)[];
                }
            } else {
                $data['next_episode'] = (object)[];
            }
            //mail count
            $inbox_count = Notification::where('teacher_id', $user->id)->where('readed', '0')->whereNotNull('inbox_id')->count();
            $data['mail_count'] = $inbox_count;
            //episodes count
            $data['episode_count'] = count($episodes_id);
            //public rates
            $data['public_rate'] = '4.7';

        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
        return msgdata($request, success(), trans('s_admin.shown_s'), $data);
    }

    public function mail_count(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            //mail count
            $inbox_count = Notification::where('student_id', $user->id)->where('readed', '0')->whereNotNull('inbox_id')->count();
            $data['mail_count'] = $inbox_count;
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function check_accounts(Request $request)
    {
        $api_token = $request->header('apitoken');
        $user = check_api_token($api_token);
        if (!$user) {
            return response()->json(msg($request, not_authoize(), 'invalid_data'));
        }
        $data = [];
        $data['students'] = Student::select('id', 'user_name', 'user_phone', 'date_of_birth')->where('user_phone', $user->user_phone)->first()->makeHidden(['name', 'Attendance']);
        $data['teachers'] = Teacher::select('id', 'user_name', 'user_phone', 'date_of_birth')->where('user_phone', $user->user_phone)->first()->makeHidden(['name']);
//        $data = AccountsResource::collection($data);

        return response()->json(msgdata($request, success(), 'logout_success', $data));
    }


}

