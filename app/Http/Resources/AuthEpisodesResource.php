<?php

namespace App\Http\Resources;

use App\Models\Episode_request;
use Illuminate\Http\Resources\Json\JsonResource;

class AuthEpisodesResource extends JsonResource
{
    private static $data;

    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if (self::$data){
            $episodes_request = Episode_request::where('student_id', self::$data)->where('episode_id', $this->id)->first();
            $request_type = "not_sent";
            if ($episodes_request) {
                if($episodes_request->send_times == 2){
                    $request_type ='not_available';
                }else{
                    $request_type = $episodes_request->status;
                }
            }else{
                if(count($this->Students) == $this->student_number  ){
                    $request_type = "completed";
                }else{
                    $request_type = "not_sent";
                }
            }
        }else{
            if(count($this->Students) >=$this->student_number  ){
                $request_type = "completed";
            }else{
                $request_type = "not_sent";
            }
        }
        return [
            'id' => $this->id,
            'name' => $this->name,
            'gender' => trans('s_admin.' . $this->gender),
            'episode_rate' => $this->Rates->count() > 0 ? number_format((float)($this->Rates->sum('rate') / $this->Rates->count()), 1) : "0",
            'teacher_name' => $this->Teacher ? $this->Teacher->user_name : "--",
            'type' => trans('s_admin.' . $this->type),
            'student_number' => $this->student_number,
            'episode_dates' => $this->Dates->count(),
            'episode_start_date' => $this->Dates->first() ? $this->Dates->first()->date : "--",
            'episode_days' => $this->Days2,
            'request_type' => $request_type,

        ];
    }

    public static function customCollection($resource, $data): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        //you can add as many params as you want.
        self::$data = $data;
        return parent::collection($resource);
    }
}
