<?php

namespace App\Http\Resources;

use App\Models\Far_learn_degree;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class PlanSectionDegreeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        if ($this->type == 'ask') {
            $degree = $this->Ask_degree->name;
            $from_surah = $this->Ask->From_Surah->name;
            $from_aya_num = $this->Ask->from_num;
            $to_surah = $this->Ask->To_Surah->name;
            $to_aya_num = $this->Ask->to_num;
            $degree_num = (integer)$this->degree;
        } else {
            $degree = $this->degree;
            if ($this->plan_type == 'new') {
                $from_surah = $this->Plan_new->From_Surah->name;
                $from_aya_num = $this->Plan_new->from_num;
                $to_surah = $this->Plan_new->To_Surah->name;
                $to_aya_num = $this->Plan_new->to_num;
            } elseif ($this->plan_type == 'tracomy') {
                $from_surah = $this->Plan_tracomy->From_Surah->name;
                $from_aya_num = $this->Plan_tracomy->from_num;
                $to_surah = $this->Plan_tracomy->To_Surah->name;
                $to_aya_num = $this->Plan_tracomy->to_num;
            } elseif ($this->plan_type == 'revision') {
                $from_surah = $this->Plan_revision->From_Surah->name;
                $from_aya_num = $this->Plan_revision->from_num;
                $to_surah = $this->Plan_revision->To_Surah->name;
                $to_aya_num = $this->Plan_revision->to_num;
            }
                $degree_num = $this->complex_degree ;
        }
        return [
            'id' => $this->id,
            'episode_name' => $this->Episode->name,
            'degree' => $degree,
            'degree_number' => $degree_num,
            'listen_type' => trans('s_admin.' . $this->Episode->listen_type),
            'from_surah' => $from_surah,
            'from_aya_num' => (integer)$from_aya_num,
            'to_surah' => $to_surah,
            'to_aya' => (integer)$to_aya_num,
            'created_at' => Carbon::parse($this->created_at)->translatedFormat('l Y-m-d'),
            "user_name" => "",
            "saved_lines" => "",
            ];
    }
}
