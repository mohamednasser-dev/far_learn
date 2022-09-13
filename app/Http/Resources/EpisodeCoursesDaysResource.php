<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeCoursesDaysResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $startTime = Carbon::parse($this->started_at);
        $endTime = Carbon::now();
        $seconds_remain = $startTime->diffInSeconds($endTime);
        return [
            'id' => $this->id,
            'episode_id' => $this->episode_id,
            'episode_name' => $this->Episode->name,
            'episode_type' => $this->Episode->episode_type,
            'teacher_name' => $this->Episode->Teacher->user_name,
            'started_at' => Carbon::parse($this->started_at)->translatedFormat('l Y-m-d'),
            'started_time' =>  Carbon::parse($this->Episode->time_from)->translatedFormat("H:i a") ,
            'seconds_remain' => $seconds_remain,
            'week' => ($this->Week)? $this->Week->name : '',
            'day' => ($this->Day)? $this->Day->name : '',
        ];
    }
}
