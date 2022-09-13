<?php

namespace App\Http\Resources;

use App\Models\Episode;
use App\Models\Episode_course_days;
use App\Models\Episode_section;
use App\Models\Plan_section_degree;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EpisodeSectionsResource extends JsonResource
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

        $episode_section = Episode_section::where('episode_id', $this->episode_id)->where('epo_date', $this->date)->first();
        if ($episode_section) {
            $exist_degree = Plan_section_degree::where('section_id', $episode_section->id)->where('student_id',self::$data)->first();
            if ($exist_degree) {
                if ($exist_degree->type == 'absence') {
                    $status = 'absence';
                } elseif ($exist_degree->type == 'degree' || $exist_degree->type == 'ask') {
                    if ($exist_degree->type == 'ask') {
                        $from_surah = $exist_degree->Ask->From_Surah->name;
                        $from_aya = $exist_degree->Ask->from_num;
                        $to_surah = $exist_degree->Ask->To_Surah->name;
                        $to_aya = $exist_degree->Ask->to_num;
                        $degree = $exist_degree->AskDegree->name;
                    } else {
                        if ($exist_degree->plan_type == 'new') {
                            $from_surah = $exist_degree->Plan_new->From_Surah->name;
                            $from_aya = $exist_degree->Plan_new->from_num;
                            $to_surah = $exist_degree->Plan_new->To_Surah->name;
                            $to_aya = $exist_degree->Plan_new->from_num;
                        } elseif ($exist_degree->plan_type == 'tracomy') {
                            $from_surah = $exist_degree->Plan_tracomy->From_Surah->name;
                            $from_aya = $exist_degree->Plan_tracomy->from_num;
                            $to_surah = $exist_degree->Plan_tracomy->To_Surah->name;
                            $to_aya = $exist_degree->Plan_tracomy->from_num;
                        } elseif ($exist_degree->plan_type == 'revision') {
                            $from_surah = $exist_degree->Plan_revision->From_Surah->name_en;
                            $from_aya = $exist_degree->Plan_revision->from_num;
                            $to_surah = $exist_degree->Plan_revision->To_Surah->name;
                            $to_aya = $exist_degree->Plan_revision->from_num;
                        }
                        //degree
                        if ($exist_degree->degree == 'absence') {
                            $degree = trans('s_admin.abs');
                        } elseif ($exist_degree->degree == 'good') {
                            $degree = trans('s_admin.good');
                        } elseif ($exist_degree->degree == 'very_good') {
                            $degree = trans('s_admin.very_good');
                        } elseif ($exist_degree->degrefrom_surahe == 'excellent') {
                            $degree = trans('s_admin.excellent');
                        } elseif ($exist_degree->degree == 'not_pathing') {
                            $degree = trans('s_admin.not_pathing');
                        }
                    }
                    $status = 'attendance';
                }
            } else {
                $status = 'not_started';
            }

        } else {
            $status = 'not_started';
        }

        return [
            'id' => $this->id,
            'day' => Carbon::parse($this->date)->translatedFormat("l"),
            'date' => $this->date,
            'status' => $status,
            'from_surah' => $from_surah,
            'from_aya' => (string)$from_aya,
            'to_surah' => $to_surah,
            'to_aya' => (string)$to_aya,
            'degree' => $degree,
        ];
    }

    public static function customCollection($resource, $data): \Illuminate\Http\Resources\Json\AnonymousResourceCollection
    {

        //you can add as many params as you want.
        self::$data = $data;
        return parent::collection($resource);
    }
}
