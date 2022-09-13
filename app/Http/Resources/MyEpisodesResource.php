<?php

namespace App\Http\Resources;

use App\Models\Episode;
use App\Models\Episode_course_days;
use App\Models\Episode_request;
use App\Models\Episode_section;
use App\Models\Episode_student;
use App\Models\Student_Questions_episode;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class MyEpisodesResource extends JsonResource
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
        $episode_status = 'no_section_today';
        $your_turn = 0;
        $current_turn = 0;
        $section_id = 0;
        $mytime = Carbon::now();
        $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
        $exist_epo = Episode::where('id', $this->episode_id)->where('start_date', '<', $today)->first();
        $course_data = Episode_course_days::where('episode_id', $this->episode_id)->where('date', $today)->first();
        if ($course_data != null) {
            $course_date_id = $course_data->id;
            $section_today = Episode_section::where('episode_id', $this->episode_id)->where('epo_date', $today)->first();
            if ($section_today != null) {
                $section_id = $section_today->id;
                $current_turn = $section_today->order_num;
                $stud_epo = Episode_student::where('student_id', $user->id)->where('episode_id', $this->episode_id)->first();
                $your_turn = $stud_epo->order_num;
                if ($section_today->status == 'started') {
                    if ($this->Episode->type == 'mqraa' && Student_Questions_episode::where('episode_id', $this->episode_id)->where('student_id', $user->id)->where('episode_course_id', $course_data->id)->first() == null) {
                        $episode_status = 'join';
                    } else {
                        $episode_status = 'started';
                    }
                } elseif ($section_today->status == 'ended') {
                    $episode_status = 'ended';
                }
            } else {
                $episode_status = 'wait';
            }
        } else {
            $episode_status = 'no_section_today';
            $course_date_id = 0;
        }
        return [
            'id' => $this->id,
            'episode_id' => $this->episode_id,
            'section_id' => $section_id,
            'name' => $this->Episode->name,
            'episode_rate' => $this->Episode->Rates->count() > 0 ? number_format((float)($this->Episode->Rates->sum('rate') / $this->Episode->Rates->count()), 1) : "0",
            'teacher_name' => $this->Episode->Teacher ? $this->Episode->Teacher->user_name : "--",
            'time_from' => Carbon::parse($this->Episode->time_from)->translatedFormat("H:i a"),
            'time_to' => Carbon::parse($this->Episode->time_to)->translatedFormat("H:i a"),
            'type' => trans('s_admin.' . $this->Episode->type),
            'listen_type' => trans('s_admin.' . $this->Episode->listen_type),
            'Readings' => $this->Episode->Readings->count() > 0 ? $this->Episode->Readings->first()->name : "--",
            'course_date_id' => $course_date_id,
            'episode_status' => $episode_status,
            'your_turn' => $your_turn,
            'current_turn' => $current_turn,
            'student_level_name' => $user->Level->name,
        ];
    }

    public static function customCollection($resource): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        return parent::collection($resource);
    }
}
