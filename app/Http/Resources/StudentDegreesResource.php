<?php

namespace App\Http\Resources;

use App\Models\Episode;
use App\Models\Episode_course_days;
use App\Models\Episode_section;
use App\Models\Plan_section_degree;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class StudentDegreesResource extends JsonResource
{

    private static $data;

    public function toArray($request)
    {

        $status = 'not_started';
        $from_surah = "";
        $from_aya = "";
        $to_surah = "";
        $to_aya = "";
        $degree = "";
        $degree_num = 0;
                if ($this->type == 'absence') {
                    $status = 'absence';
                } elseif ($this->type == 'degree' || $this->type == 'ask') {
                    if ($this->type == 'ask') {
                        $from_surah = $this->Ask->From_Surah->name;
                        $from_aya = $this->Ask->from_num;
                        $to_surah = $this->Ask->To_Surah->name;
                        $to_aya = $this->Ask->to_num;
                        $degree = $this->AskDegree->name;
                        $degree_num = (integer)$this->degree;
                    } else {
                        if ($this->plan_type == 'new') {
                            $from_surah = $this->Plan_new->From_Surah->name;
                            $from_aya = $this->Plan_new->from_num;
                            $to_surah = $this->Plan_new->To_Surah->name;
                            $to_aya = $this->Plan_new->from_num;
                        } elseif ($this->plan_type == 'tracomy') {
                            $from_surah = $this->Plan_tracomy->From_Surah->name;
                            $from_aya = $this->Plan_tracomy->from_num;
                            $to_surah = $this->Plan_tracomy->To_Surah->name;
                            $to_aya = $this->Plan_tracomy->from_num;
                        } elseif ($this->plan_type == 'revision') {
                            $from_surah = $this->Plan_revision->From_Surah->name_en;
                            $from_aya = $this->Plan_revision->from_num;
                            $to_surah = $this->Plan_revision->To_Surah->name;
                            $to_aya = $this->Plan_revision->from_num;
                        }
                        //degree
                        if ($this->degree == 'absence') {
                            $degree = trans('s_admin.abs');
                        } elseif ($this->degree == 'good') {
                            $degree = trans('s_admin.good');
                        } elseif ($this->degree == 'very_good') {
                            $degree = trans('s_admin.very_good');
                        } elseif ($this->degrefrom_surahe == 'excellent') {
                            $degree = trans('s_admin.excellent');
                        } elseif ($this->degree == 'not_pathing') {
                            $degree = trans('s_admin.not_pathing');
                        }
                        $degree_num = $this->complex_degree ;
                    }
                    $status = 'attendance';
                }

        return [
            'id' => $this->id,
            'episode_name' => $this->Episode->name,
            'degree' => $degree,
            'degree_number' => (integer)$degree_num,
            'listen_type' => trans('s_admin.' . $this->Episode->listen_type),
            'from_surah' => $from_surah,
            'from_aya_num' => (string)$from_aya,
            'to_surah' => $to_surah,
            'to_aya' => (string)$to_aya,
            'created_at' => Carbon::parse($this->created_at)->translatedFormat("Y-m-d l"),
            "user_name" => "",
            "saved_lines" => "",
            'status' => $status,
        ];
    }
    public static function customCollection($resource, $data): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        //you can add as many params as you want.
        self::$data = $data;
        return parent::collection($resource);
    }
}
