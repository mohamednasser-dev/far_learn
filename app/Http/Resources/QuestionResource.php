<?php

namespace App\Http\Resources;

use App\Models\Episode;
use App\Models\Episode_course_days;
use App\Models\Episode_section;
use App\Models\Plan_section_degree;
use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class QuestionResource extends JsonResource
{

    public function toArray($request)
    {
        return [
            'from_surah' => $this->From_Surah->name,
            'from_aya' => (string)$this->from_num,
            'to_surah' => $this->To_Surah->name,
            'to_aya' => (string)$this->to_num,
        ];
    }
}
