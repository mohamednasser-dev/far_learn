<?php

namespace App\Http\Controllers\Api\Students;

use App\Http\Controllers\Controller;
use App\Http\Resources\AuthEpisodesResource;
use App\Models\Episode;
use App\Models\Episode_request;
use App\Models\Teacher;
use Illuminate\Http\Request;
use Validator;

class EpisodeSearchController extends Controller
{
    public function Episodes(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $user_type = $user->epo_type;
            if ($user_type == 'far_learn') {
                $type = 'mqraa';
            } elseif ($user_type == 'dorr') {
                $type = 'dorr';
            } elseif ($user_type == 'mogmaa') {
                $type = 'mogmaa';
            }
            $data = Episode::where('teacher_id', '!=', null)->where('type', $type)->where('active', 'y')->where('deleted', '0')->paginate(10);
            $data->user_id = $user->id;

            $data = AuthEpisodesResource::customCollection($data, $user->id)->response()->getData(true);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function Search(Request $request)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $user_type = $user->epo_type;
            if ($user_type == 'far_learn') {
                $type = 'mqraa';
            } elseif ($user_type == 'dorr') {
                $type = 'dorr';
            } elseif ($user_type == 'mogmaa') {
                $type = 'mogmaa';
            }

            $result = Episode::query();
            if ($request->request_type) {
                if ($request->request_type == 'my_requests') {
                    $accepted_episodes = Episode_request::where('student_id', $user->id)->whereIn('status', ['new', 'rejected'])->pluck('episode_id')->toArray();
                } else {
                    $accepted_episodes = Episode_request::where('student_id', $user->id)->where('status', $request->request_type)->pluck('episode_id')->toArray();
                }
                $result = $result->whereIn('id', $accepted_episodes);
            }
            $result = $result->where('type', $type)->where('active', 'y')->where('deleted', '0')->where('teacher_id', '!=', null);
            if ($request->teacher_name != null) {
                $teacher_ids = Teacher::where('first_name_ar', 'like', '%' . $request->teacher_name . '%')
                    ->orWhere('user_name', 'like', '%' . $request->teacher_name . '%')
                    ->orWhere('mid_name_ar', 'like', '%' . $request->teacher_name . '%')
                    ->orWhere('last_name_ar', 'like', '%' . $request->teacher_name . '%')
                    ->orWhere('first_name_en', 'like', '%' . $request->teacher_name . '%')
                    ->orWhere('mid_name_en', 'like', '%' . $request->teacher_name . '%')
                    ->orWhere('last_name_en', 'like', '%' . $request->teacher_name . '%')->pluck('id')->toArray();
                $result = $result->whereIn('teacher_id', $teacher_ids);
            }
            if ($request->gender) {
                $result = $result->where('gender', $request->gender);
            }
            if ($request->level_id) {
                if ($request->level_id != 'all') {
                    $result = $result->where('level_id', $request->level_id);
                }
            }
            if ($request->language) {
                $teacher_ids = Teacher::Where('main_lang', $request->language)->pluck('id')->toArray();
                $result = $result->whereIn('teacher_id', $teacher_ids);
            }
            if ($request->cost) {
                if ($request->cost == 'cost') {
                    $result = $result->where('cost', '!=', 'free');
                } else if ($request->cost == 'free') {
                    $result = $result->where('cost', 'free');
                }
            }
            $result = $result->paginate(10);
            $result->user_id = $user->id;
            $data = AuthEpisodesResource::customCollection($result, $user->id)->response()->getData(true);
            return msgdata($request, success(), trans('s_admin.shown_s'), $data);
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function join(Request $request, $episode_id)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $epo = Episode::findOrFail($episode_id);
            if (count($epo->Students) < $epo->student_number) {
                try {
                    if ($user->gender == $epo->gender) {
                        $data['episode_id'] = $episode_id;
                        $data['student_id'] = $user->id;
                        Episode_request::create($data);
                        return msgdata($request, success(), trans('s_admin.request_done_s'), (object)[]);
                    } else {
                        return msgdata($request, not_acceptable(), trans('s_admin.you_not_same_grnder'), (object)[]);
                    }

                } catch (\Exception $exception) {
                    return msgdata($request, success(), trans('s_admin.request_done_before_s'), (object)[]);
                }
            } else {
                return msgdata($request, failed(), trans('s_admin.no_enght_place'), (object)[]);
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function join_again(Request $request, $episode_id)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $epo = Episode::findOrFail($episode_id);
            if (count($epo->Students) < $epo->student_number) {
                $epo = Episode_request::where('student_id', $user->id)->where('episode_id', $episode_id)->first();
                if ($epo) {
                    if($epo->send_times == 2){
                        return msgdata($request, failed(), trans('s_admin.chances_used_before'), (object)[]);
                    }
                    $epo->status = 'new';
                    $epo->send_times = 2;
                    $epo->save();
                    return msgdata($request, success(), trans('s_admin.request_done_again_s'), (object)[]);
                } else {
                    return msgdata($request, failed(), trans('s_admin.no_episode_to_sent_again'), (object)[]);
                }
            } else {
                return msgdata($request, success(), trans('s_admin.no_enght_place'), (object)[]);

            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);

        }

    }

    public function Cancel_join(Request $request, $episode_id)
    {
        $user = check_api_token($request->header('apitoken'));
        if ($user && $user->type == 'student') {
            $epo_request = Episode_request::where('student_id', $user->id)->where('episode_id', $episode_id)->first();
            if ($epo_request) {
                try {
                    $epo_request->delete();
                    return msgdata($request, success(), trans('s_admin.request_cancel_done_s'), (object)[]);
                } catch (\Exception $exception) {
                    return msgdata($request, failed(), trans('s_admin.error'), (object)[]);
                }
            } else {
                return msgdata($request, failed(), trans('s_admin.no_old_episode'), (object)[]);
            }
        } else {
            return msgdata($request, not_authoize(), trans('s_admin.not_authorize'), (object)[]);
        }
    }

    public function SearchUnAuth(Request $request)
    {

        $rules = [
            'epo_type' => 'required|in:far_learn,dorr,mogmaa',

        ];
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json(msg($request, failed(), $validator->messages()->first()));
        }
        $user_type = $request->epo_type;
        if ($user_type == 'far_learn') {
            $type = 'mqraa';
        } elseif ($user_type == 'dorr') {
            $type = 'dorr';
        } elseif ($user_type == 'mogmaa') {
            $type = 'mogmaa';
        }

        $result = Episode::query();
        $result = $result->where('type', $type)->where('active', 'y')->where('deleted', '0')->where('teacher_id', '!=', null);
        if ($request->teacher_name != null) {
            $teacher_ids = Teacher::where('first_name_ar', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('user_name', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('mid_name_ar', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('last_name_ar', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('first_name_en', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('mid_name_en', 'like', '%' . $request->teacher_name . '%')
                ->orWhere('last_name_en', 'like', '%' . $request->teacher_name . '%')->pluck('id')->toArray();
            $result = $result->whereIn('teacher_id', $teacher_ids);
        }
        if ($request->gender) {
            $result = $result->where('gender', $request->gender);
        }
        if ($request->level_id) {
            if ($request->level_id != 'all') {
                $result = $result->where('level_id', $request->level_id);
            }
        }
        if ($request->language) {
            $teacher_ids = Teacher::Where('main_lang', $request->language)->pluck('id')->toArray();
            $result = $result->whereIn('teacher_id', $teacher_ids);
        }
        if ($request->cost) {

            if ($request->cost == 'cost') {
                $result = $result->where('cost', '!=', 'free');
            } else if ($request->cost == 'free') {
                $result = $result->where('cost', 'free');
            }

        }
        $result = $result->paginate(10);
        $result->user_id = null;
        $data = AuthEpisodesResource::customCollection($result, $result->user_id)->response()->getData(true);
        return msgdata($request, success(), trans('s_admin.shown_s'), $data);

    }

}
