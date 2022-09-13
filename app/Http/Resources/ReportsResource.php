<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ReportsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        $from_surah = "";
        $To_Surah = "";
        $from_num = 0;
        $to_num = 0;
        if ($this->type == 'ask') {
            if ($request->header('lang') == 'ar') {
                $from_surah = ( $this->Ask)? $this->Ask->From_Surah->name_ar : "";
                $To_Surah = ( $this->Ask)? $this->Ask->To_Surah->name_ar : "";
            } else {
                $from_surah = ( $this->Ask)? $this->Ask->From_Surah->name_en : "";
                $To_Surah = ( $this->Ask)? $this->Ask->To_Surah->name_en : "";
            }
            $from_num = ( $this->Ask)? $this->Ask->from_num : 0;
            $to_num = ( $this->Ask)? $this->Ask->to_num : 0;
        } else {
            if ($this->plan_type == 'new') {
                if ($request->header('lang') == 'ar') {
                    $from_surah = $this->Plan_new->From_Surah->name_ar;
                    $To_Surah = $this->Plan_new->To_Surah->name_ar;
                } else {
                    $from_surah = $this->Plan_new->From_Surah->name_en;
                    $To_Surah = $this->Plan_new->To_Surah->name_en;
                }
                $from_num = $this->Plan_new->from_num;
                $to_num = $this->Plan_new->to_num;
            } elseif ($this->plan_type == 'tracomy') {
                if ($request->header('lang') == 'ar') {
                    $from_surah = $this->Plan_tracomy->From_Surah->name_ar;
                    $To_Surah = $this->Plan_tracomy->To_Surah->name_ar;
                } else {
                    $from_surah = $this->Plan_tracomy->From_Surah->name_en;
                    $To_Surah = $this->Plan_tracomy->To_Surah->name_en;
                }
                $from_num = $this->Plan_tracomy->from_num;
                $to_num = $this->Plan_tracomy->to_num;
            } elseif ($this->plan_type == 'revision') {
                if ($request->header('lang') == 'ar') {
                    $from_surah = $this->Plan_revision->From_Surah->name_ar;
                    $To_Surah = $this->Plan_revision->To_Surah->name_ar;
                } else {
                    $from_surah = $this->Plan_revision->From_Surah->name_en;
                    $To_Surah = $this->Plan_revision->To_Surah->name_en;
                }
                $from_num = $this->Plan_revision->from_num;
                $to_num = $this->Plan_revision->to_num;
            }
        }
        return [
            "id" => $this->id,
            "episode_name" => $this->Section->Episode->name,
            "degree" => $this->Ask_degree->name,
            "degree_number" => (integer)$this->degree,
            'listen_type' => trans('s_admin.' . $this->Section->Episode->listen_type),
            "from_surah" => $from_surah,
            "from_aya_num" => (integer)$from_num,
            "to_surah" => $To_Surah,
            "to_aya" => (integer)$to_num,
            "created_at" => \Carbon\Carbon::parse($this->created_at)->translatedFormat('l Y-m-d'),
            "user_name" => $this->Student->name,
            "saved_lines" => $this->saved_lines,
        ];
    }
}
