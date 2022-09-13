<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class InterviewsResource extends JsonResource
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
            "id" => $this->id,
            "interview_date" => $this->interview_date,
            "interview_time" => $this->interview_time,
            "selected_date" => $this->selected_date,
            "meeting_id" => $this->meeting_id,
            "topic" => $this->topic,
            "start_time" => $this->start_time,
            "passcode" => $this->passcode,
            "agenda" => $this->agenda,
            "join_url" => $this->join_url,
        ];
    }
}
