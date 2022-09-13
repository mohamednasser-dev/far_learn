<?php

namespace App\Http\Resources;

use App\Models\Episode;
use App\Models\Episode_course_days;
use App\Models\Episode_section;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeInfoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        $episode_status = 'no_section_today';
        $mytime = Carbon::now();
        $today = Carbon::parse($mytime->toDateTimeString())->format('Y-m-d');
        $exist_epo = Episode::where('id', $this->id)->where('start_date', '<', $today)->first();
        $course_data = Episode_course_days::where('episode_id', $this->id)->where('date', $today)->first();
        if($this->cost == 'free'){
            $cost = trans('s_admin.free') ;
        }else{
            $cost = $this->cost ;
        }
        if($this->Rates->count() > 0){
            $rating_int = $this->Rates->sum('rate') / $this->Rates->count() ;
            $rating = (string)$rating_int ;
        }else{
            $rating = '0';
        }

        return [
            'id' => $this->id,
            'name' => $this->name,
            'started_date' => $this->Dates->count() > 0 ? $this->Dates->first()->date : " - ",
            'episode_rate' => number_format((float)($rating), 1),
            'teacher_name' => $this->Teacher ? $this->Teacher->user_name : "--",
            'gender' => trans('s_admin.' . $this->gender),
            'time_from' => Carbon::parse($this->time_from)->translatedFormat("H:i a"),
            'time_to' => Carbon::parse($this->time_to)->translatedFormat("H:i a"),
            'type' => trans('s_admin.' . $this->type),
            'listen_type' => trans('s_admin.' . $this->listen_type),
            'cost' => $cost ,
            'Readings' => $this->Readings->count() > 0 ? $this->Readings->first()->name : "--",
            'episode_days' => $this->Days->count() > 0 ? $this->Days : "--",
        ];
    }
}
