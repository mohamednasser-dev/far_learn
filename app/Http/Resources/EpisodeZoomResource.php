<?php

namespace App\Http\Resources;

use App\Models\Episode;
use App\Models\Episode_course_days;
use App\Models\Episode_section;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeZoomResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'meeting_id' => $this->meeting_id,
            'topic' => $this->topic,
            'agenda' => $this->agenda,
            'start_time' => $this->start_time,
            'passcode' => $this->passcode,
            'join_url' => $this->join_url,

        ];
    }
}
