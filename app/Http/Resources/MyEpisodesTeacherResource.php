<?php

namespace App\Http\Resources;

use App\Models\Episode;
use App\Models\Episode_course_days;
use App\Models\Episode_request;
use App\Models\Episode_restart_request;
use App\Models\Episode_section;
use App\Models\Episode_student;
use App\Models\Student_Questions_episode;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MyEpisodesTeacherResource extends JsonResource
{

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $user = check_api_token($request->header('apitoken'));
        $episode_status = 't_no_section_today';
        $time_now = Carbon::now()->format('H:i');
        $mytime = Carbon::now();
        $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
        $course_data = Episode_course_days::where('episode_id', $this->id)->where('date', $today)->first();
        $section_id = 0;
        if ($course_data != null) {
            $section_today = Episode_section::where('episode_id', $this->id)->where('epo_date', $today)->first();

            if ($section_today != null) {
                $section_id = $section_today->id;
                if ($section_today->status == 'started') {
                    if (Carbon::parse($this->time_from)->format('H:i') < $time_now && Carbon::parse($this->time_to)->format('H:i') > $time_now) {
                        $episode_status = 't_started';
                    } else {
                        $exists_request = Episode_restart_request::where('teacher_id', $user->id)->where('section_id', $section_today->id)->where('status', 'accepted')->first();
                        if ($exists_request) {
                            $episode_status = 't_started';
                        } else {
                            $episode_status = 't_today_but_not_now';
                        }

                    }
                } elseif ($section_today->status == 'ended') {
                    if (Carbon::parse($this->time_from)->format('H:i') < $time_now && Carbon::parse($this->time_to)->format('H:i') > $time_now) {
                        $episode_status = 't_restart_again';
                    } else {
                        $episode_status = 't_restart_again_after_time';
                    }
                }
            } else {
                if (Carbon::parse($this->time_from)->format('H:i') < $time_now && Carbon::parse($this->time_to)->format('H:i') > $time_now) {
                    $episode_status = 't_show';
                } else {
                    $episode_status = 't_today_but_not_now';
                }
            }
        } else {
            $episode_status = 't_no_section_today';
        }
        return [
            'id' => $this->id,
            'episode_id' => $this->id,
            'section_id' => $section_id,
            'name' => $this->name,
            'episode_rate' => $this->Rates->count() > 0 ?  number_format((float)($this->Rates->sum('rate') / $this->Rates->count()), 1) : '0',
            'teacher_name' => $this->Teacher ? $this->Teacher->user_name : "--",
            'time_from' => Carbon::parse($this->time_from)->translatedFormat("H:i a"),
            'time_to' => Carbon::parse($this->time_to)->translatedFormat("H:i a"),
            'type' => trans('s_admin.' . $this->type),
            'listen_type' => trans('s_admin.' . $this->listen_type),
            'Readings' => $this->Readings->count() > 0 ? $this->Readings->first()->name : "--",
            'course_date_id' => 0,
            'episode_status' => $episode_status,
            'your_turn' => 0,
            'current_turn' => 0,
            'student_level_name' => "",
        ];
    }

    public static function customCollection($resource): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        return parent::collection($resource);
    }
}
